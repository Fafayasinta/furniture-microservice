import express from 'express';
import morgan from 'morgan';
import { createProxyMiddleware } from 'http-proxy-middleware';

const app = express();
const PORT = 3000;

// Logging
app.use(morgan('dev'));

// Proxy rules
app.use('/auth', createProxyMiddleware({
  target: 'http://localhost:8001', // auth-service
  changeOrigin: true,
  pathRewrite: { '^/auth': '' },
}));

app.use('/order', createProxyMiddleware({
  target: 'http://localhost:8002', // order-service
  changeOrigin: true,
  pathRewrite: { '^/order': '' },
}));

app.use('/product', createProxyMiddleware({
  target: 'http://localhost:8003', // product-service
  changeOrigin: true,
  pathRewrite: { '^/product': '' },
}));

// (Optional) Proxy for frontends if needed
// app.use('/admin', createProxyMiddleware({
//   target: 'http://localhost:8004', // admin-frontend
//   changeOrigin: true,
//   pathRewrite: { '^/admin': '' },
// }));
// app.use('/user', createProxyMiddleware({
//   target: 'http://localhost:8005', // user-frontend
//   changeOrigin: true,
//   pathRewrite: { '^/user': '' },
// }));

app.get('/', (req, res) => {
  res.send('API Gateway is running');
});

app.listen(PORT, () => {
  console.log(`API Gateway listening on port ${PORT}`);
});
