@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')
<style>
    :root{
      --blue: #3120CD;
    }
    .dashboard-rows{
      display: flex;
      flex-direction: column;
      gap: 90px;
      padding: 100px 30px;
    }
    .row-cards{
      display: flex;
      justify-content: center;
      gap: 70px;
    }
    .dashboard-card{
      background: var(--blue);
      color: #fff;
      border-radius: 10px;
      padding: 18px;
      width: 270px;
      min-height: 110px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      box-shadow: 0 8px 18px rgba(0,0,0,0.12);
      text-align: center;
      transition: transform 0.2s ease;
    }
    .dashboard-card:hover{
      transform: translateY(-5px);
      cursor: pointer;
    }
    .dashboard-card .icon{
      font-size: 26px;
      margin-bottom: 4px;
      opacity: 0.95;
    }
    .dashboard-card h5{
      font-size: 17px;
      margin: 2px 0;
      font-weight: 700;
    }
    .dashboard-card p{
      font-size: 18px;
      font-weight: 700;
      margin: 4px 0 0;
    }
    .row-cards:nth-child(2){
      margin-left: 60px;
    }
    .card-link {
      text-decoration: none;
      color: inherit;
    }
</style>

<div class="container-fluid">
  <div class="dashboard-rows">
    <div class="row-cards">
      <a href="{{ route('admin.customers.index') }}" class="card-link">
          <div class="dashboard-card">
              <div class="icon"><i class="bi bi-people"></i></div>
                <h5>Total Customer</h5>
                <p>{{ $totalCustomers ?? 0 }}</p>
          </div>
      </a>

        <a href="{{ route('admin.teknisi.index') }}" class="card-link">
          <div class="dashboard-card">
            <div class="icon"><i class="bi bi-person-gear"></i></div>
              <h5>Total Teknisi</h5>
              <p>{{ $totalTeknisi ?? 0 }}</p>
            </div>
        </a>

        <a href="{{ route('admin.pendapatan.index') }}" class="card-link">
          <div class="dashboard-card">
            <div class="icon"><i class="bi bi-cash-coin"></i></div>
              <h5>Total Pendapatan</h5>
              <p>Rp. {{ number_format($totalPendapatan ?? 0,0,',','.') }}</p>
          </div>
        </a>
    </div>

    {{-- Baris kedua: 2 kotak --}}
    <div class="row-cards">
      <a href="{{ route('admin.layanan.index') }}" class="card-link">
        <div class="dashboard-card">
          <div class="icon"><i class="bi bi-gear"></i></div>
          <h5>Total Layanan</h5>
          <p>{{ $totalLayanan ?? 0 }}</p>
        </div>
      </a>

      <a href="{{ route('admin.notifikasi.index') }}" class="card-link">
        <div class="dashboard-card">
          <div class="icon"><i class="bi bi-bell"></i></div>
          <h5>Total Notifikasi</h5>
          <p>{{ $totalNotifikasi ?? 0 }}</p>
        </div>
      </a>
    </div>

  </div>
</div>
@endsection
