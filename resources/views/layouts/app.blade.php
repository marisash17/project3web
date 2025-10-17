<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
       .sidebar {
    position: fixed;
    top: 0; 
    left: 0;
    width: 300px;
    height: 100%;
    background: linear-gradient(180deg, #2B1FC0, #4430E7);
    color: #fff;
    padding: 25px 18px;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    box-shadow: 5px 0 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.sidebar:hover {
    box-shadow: 8px 0 25px rgba(0, 0, 0, 0.25);
}

.logo {
    display: flex;
    align-items: center;
    justify-content: flex-start; 
    margin-bottom: 25px;
}

.logo img {
    max-width: 55px;
    margin-left: 5px;
    transition: transform 0.3s ease;
}


.logo img:hover {
    transform: scale(1.1);
}

.admin-info {
    font-size: 18px;
    font-weight: 500;
    color: #fff;
    margin-top: 20px;
    margin-bottom: 30px;
    text-align: center;
}

.admin-info i {
    font-size: 55px;
    display: block;
    margin-bottom: 8px;
    transition: transform 0.3s ease;
}

.admin-info i:hover {
    transform: scale(1.1);
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #d6d6f7;
    text-decoration: none;
    padding: 12px 15px;
    border-radius: 12px;
    margin: 6px 0;
    transition: all 0.3s ease;
    font-weight: 500;
}

.sidebar a i {
    font-size: 18px;
    transition: transform 0.3s ease;
}

/* efek hover */
.sidebar a:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    transform: translateX(5px);
}

/* efek aktif */
.sidebar a.active {
    background: #fff;
    color: #2B1FC0;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.sidebar a.active i {
    color: #2B1FC0;
    transform: scale(1.1);
}

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="SIBOS Logo">
        </div>

        <div class="admin-info">
            <i class="bi bi-person-circle"></i>
            <span>Admin</span>
        </div>

        <a href="{{ route('admin.customers.index') }}" 
           class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                    <span>Kelola Customer</span>
        </a>

        <a href="{{ route('admin.teknisi.index') }}" 
           class="nav-link {{ request()->is('admin/teknisi*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i>
                    <span>Kelola Teknisi</span>
        </a>

        <a href="{{ route('admin.notifikasi.index') }}" 
           class="nav-link {{ request()->is('admin/notifikasi*') ? 'active' : '' }}">
                <i class="bi bi-bell"></i>
                    <span>Kelola Notifikasi</span>
        </a>

        <a href="{{ route('admin.layanan.index') }}"  
           class="nav-link {{ request()->is('admin/layanan*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                    <span>Kelola Layanan</span>
        </a>

        <a href="{{ route('admin.pesanan.index') }}"
           class="nav-link {{ request()->is('admin/pesanan*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                    <span>Riwayat Pesanan</span>

        <a href="{{ route('admin.pendapatan.index') }}"
           class="nav-link {{ request()->is('admin/pendapatan*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                    <span>Kelola Transaksi</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="left">
           
        </div>
        <div class="right">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
