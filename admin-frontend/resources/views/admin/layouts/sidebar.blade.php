<div class="sidebar">
    <!-- SidebarSearch Form -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/product') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>Produk Furniture</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/order') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>Pesanan Furniture</p>
                </a>
            </li>
        </ul>
    </nav>
</div>