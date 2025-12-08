<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="SIBOS Logo">
            <div class="logo-text">SIBOS</div>
        </div>
    </div>

    <div class="admin-info">
        <div class="admin-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <div class="admin-name">Admin</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-link {{ request()->is('admin/dashboard*') || request()->is('admin') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.customers.index') }}" 
               class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Kelola Customer</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.teknisi.index') }}" 
               class="nav-link {{ request()->is('admin/teknisi*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i>
                    <span>Kelola Teknisi</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.layanan.index') }}"  
               class="nav-link {{ request()->is('admin/layanan*') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i>
                    <span>Kelola Layanan</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.statuslayanan.index') }}"
               class="nav-link {{ request()->is('admin/statuslayanan*') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i>
                    <span>Status Layanan</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.pendapatan.index') }}"
               class="nav-link {{ request()->is('admin/pendapatan*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i>
                    <span>Kelola Pendapatan</span>
            </a>
        </div>
    </nav>
</div>