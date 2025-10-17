{{-- resources/views/layouts/sidebar.blade.php --}}
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-primary" style="width: 300px; height: 70vh;">
    <h5 class="text-center mb-4">
        <i class="bi bi-person"></i> <br> Admin
    </h5>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Kelola Customer</a>
            </li>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Kelola Teknisi</a>
            </li>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Kelola Notifikasi</a>
            </li>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Kelola Layanan</a>
            </li>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Riwayat Pesanan</a>
            </li>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.') }}">Transaksi</a>
            </li>
</div>
