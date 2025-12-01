@extends('layouts.app')

@section('title', 'Detail Teknisi')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .detail-card {
        background: white;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .detail-title {
        font-size: 28px;
        font-weight: 700;
        background: linear-gradient(135deg, #2B1FC0, #5A46FF);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
        margin-bottom: 30px;
    }

    .detail-content {
        display: grid;
        gap: 15px;
        margin-bottom: 30px;
    }

    .detail-row {
        display: flex;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        min-height: 24px;
    }

    .label-colon {
        display: flex;
        width: 180px;
        flex-shrink: 0;
    }

    .label {
        font-weight: 600;
        color: #3120CD;
        text-align: left;
        width: 140px;
    }

    .colon {
        font-weight: 600;
        color: #3120CD;
        margin-left: 5px;
    }

    .value {
        color: #333;
        line-height: 1.5;
        word-wrap: break-word;
        flex: 1;
    }

    .sertifikat-container {
        margin-top: 10px;
    }

    .sertifikat-img {
        max-width: 300px;
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        border: 1px solid #e0e0e0;
    }

    .no-certificate {
        color: #6c757d;
        font-style: italic;
        margin: 5px 0;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-back {
        background: #3120CD;
        color: white;
    }

    .btn-back:hover {
        background: #2B1FC0;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(49, 32, 205, 0.3);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 0 15px;
            margin: 20px auto;
        }

        .detail-card {
            padding: 20px;
        }

        .detail-row {
            flex-direction: column;
            gap: 8px;
            padding: 10px 0;
        }

        .label-colon {
            width: 100%;
        }

        .label {
            width: auto;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="detail-container">
    <div class="detail-card">
        <h2 class="detail-title">Detail Teknisi</h2>

        <div class="detail-content">
            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Nama</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->user->name }}</span>
            </div>
            
            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Email</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->user->email }}</span>
            </div>
            
            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Alamat</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->user->alamat }}</span>
            </div>
            
            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">No HP</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->user->no_hp }}</span>
            </div>

            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Keahlian</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->keahlian }}</span>
            </div>
            
            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Pengalaman</span>
                    <span class="colon">:</span>
                </div>
                <span class="value">{{ $teknisi->pengalaman }}</span>
            </div>

            <div class="detail-row">
                <div class="label-colon">
                    <span class="label">Sertifikat</span>
                    <span class="colon">:</span>
                </div>
                <div class="value sertifikat-container">
                    @if($teknisi->sertifikat)
                        <img src="{{ asset('storage/' . $teknisi->sertifikat) }}" 
                             alt="Sertifikat Teknisi" 
                             class="sertifikat-img">
                    @else
                        <p class="no-certificate">Tidak ada sertifikat</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('admin.teknisi.index') }}" class="btn btn-back">
                Kembali ke Daftar
            </a>
            
            <form action="{{ route('admin.teknisi.destroy', $teknisi->id) }}" 
                  method="POST" 
                  style="display: inline;"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus teknisi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">
                    Hapus Teknisi
                </button>
            </form>
        </div>
    </div>
</div>

@endsection