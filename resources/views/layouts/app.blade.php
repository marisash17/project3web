<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0; 
            left: 0;
            width: 300px;
            height: 100%;
            background: #3120CD;
            color: #fff;
            padding: 20px 15px;
        }
        .logo {
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 50px;
            display: block;
            margin: 0;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background: #3120CD;
        }
        .sidebar a.active {
            background: #ffffff;
            color: #3120CD !important;
            font-weight: bold;
        }
        .sidebar a.active i {
            color: #3120CD;
        }
        .header {
            position: fixed;
            top: 0;
            left: 300px; 
            right: 0;
            height: 60px;
            background-color: #3120CD;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #fff;
            z-index: 1000;
        }
        .header .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header .right a {
            color: #fff;
            font-size: 20px;
            text-decoration: none;
        }
        .header .right a:hover {
            opacity: 0.8;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 300px;
            right: 0;
            height: 50px;
            background-color: #3120CD;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .content {
            margin-left: 300px;
            padding: 80px 50px 80px 50px; 
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
            font-size: 50px;
            display: block;
            margin-bottom: 8px;
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

        <a href="{{ route('admin.pendapatan.index') }}"
           class="nav-link {{ request()->is('admin/pendapatan*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                    <span>Kelola Pendapatan</span>
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
