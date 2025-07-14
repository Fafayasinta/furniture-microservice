require('dotenv').config();
const express = require('express');
const axios = require('axios');
const app = express();

app.use(express.json());

// ENV
const AUTH_SERVICE_URL = process.env.AUTH_SERVICE_URL || 'http://localhost:8000';
const ORDER_SERVICE_URL = process.env.ORDER_SERVICE_URL || 'http://localhost:8001';
const PRODUCT_SERVICE_URL = process.env.PRODUCT_SERVICE_URL || 'http://localhost:8002';

// Middleware: validasi token & cek role admin
const validateToken = async (req, res, next) => {
    const token = req.headers['authorization'];
    if (!token) return res.status(401).json({ error: 'No token provided' });

    try {
        const response = await axios.get(`${AUTH_SERVICE_URL}/admin`, {
            headers: { Authorization: token }
        });

        const user = response.data.user;
        if (user?.role !== 'admin') return res.status(403).json({ error: 'Admin only' });

        req.user = user; // simpan user kalau mau dipakai
        next();
    } catch (error) {
        return res.status(401).json({ error: 'Invalid token' });
    }
};

// =====================
// ROUTES
// =====================

// LOGIN (tidak butuh token)
app.post('/auth/login', async (req, res) => {
    try {
        const response = await axios.post(`${AUTH_SERVICE_URL}/login`, req.body);
        res.status(response.status).json(response.data);
    } catch (error) {
        res.status(error.response?.status || 500).json(error.response?.data || { error: 'Auth service error' });
    }
});

// LOGOUT (butuh token)
app.post('/auth/logout', validateToken, async (req, res) => {
    try {
        const response = await axios.post(`${AUTH_SERVICE_URL}/logout`, {}, {
            headers: { Authorization: req.headers['authorization'] }
        });
        res.status(response.status).json(response.data);
    } catch (error) {
        res.status(error.response?.status || 500).json(error.response?.data || { error: 'Logout failed' });
    }
});

// GET PRODUCTS
app.get('/product/products', validateToken, async (req, res) => {
    try {
        const response = await axios.get(`${PRODUCT_SERVICE_URL}/`, {
            headers: { Authorization: req.headers['authorization'] }
        });
        res.status(response.status).json(response.data);
    } catch (error) {
        res.status(error.response?.status || 500).json(error.response?.data || { error: 'Product error' });
    }
});

// GET ORDERS
app.get('/order/orders', validateToken, async (req, res) => {
    try {
        const response = await axios.get(`${ORDER_SERVICE_URL}/orders`, {
            headers: { Authorization: req.headers['authorization'] }
        });
        res.status(response.status).json(response.data);
    } catch (error) {
        res.status(error.response?.status || 500).json(error.response?.data || { error: 'Order error' });
    }
});

const PORT = process.env.PORT || 8005;
app.listen(PORT, () => {
    console.log(`✅ API Gateway running on http://localhost:${PORT}`);
});
