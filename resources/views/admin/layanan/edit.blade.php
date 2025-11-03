@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    /* ====== Card dinaikkan ke atas ====== */
    .layanan-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 80px 20px;
        background: #f8f9ff;
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.88) 100%);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 50px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
        width: 100%;
        max-width: 800px;
        animation: fadeInUp 0.6s ease-out;
    }

    .glass-card:hover {
        box-shadow: 0 12px 40px rgba(49, 32, 205, 0.2);
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 32px;
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
    }

    .page-title {
        font-weight: 700;
        font-size: 32px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #666;
        font-size: 16px;
        font-weight: 500;
    }

    /* Form */
    .form-container { margin-top: 20px; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .form-group { position: relative; }

    .form-group.full-width { grid-column: 1 / -1; }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-control-custom {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
        color: #333;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
        background-color: rgba(255, 255, 255, 0.95);
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 120px;
    }

    /* File Input Custom */
    .file-input-custom {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        color: #333;
    }

    .file-input-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
        background-color: rgba(255, 255, 255, 0.95);
    }

    /* Tombol */
    .button-group {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
    }

    .btn-submit {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .btn-cancel:hover { background: #c82333; transform: translateY(-2px); }
    .btn-submit:hover { transform: translateY(-2px); }

    /* File Preview */
    .file-preview {
        margin-top: 10px;
        text-align: center;
    }

    .file-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 2px solid rgba(49, 32, 205, 0.1);
    }

    .current-image {
        margin-bottom: 15px;
    }

    .current-image-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    /* Error Messages */
    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .error-message i {
        font-size: 14px;
    }

    /* Alert Success */
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-radius: 12px;
        color: #155724;
        padding: 16px 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Animasi */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .layanan-container {
            padding: 60px 15px;
        }
        
        .glass-card {
            padding: 30px;
        }
        
        .page-title {
            font-size: 28px;
        }
        
        .page-icon {
            width: 70px;
            height: 70px;
            font-size: 28px;
        }
        
        .button-group {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-cancel,
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .layanan-container {
            padding: 40px 10px;
        }
        
        .glass-card {
            padding: 25px;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .page-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
    }
</style>

<div class="layanan-container">
    <div class="glass-card">
        <div class="page-header">
            <div class="page-icon"><i class="bi bi-pencil-square"></i></div>
            <h1 class="page-title">Edit Layanan</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">Jenis Layanan</label>
                    <input type="text" 
                           name="jenis_layanan" 
                           class="form-control-custom" 
                           placeholder="Masukkan jenis layanan"
                           value="{{ old('jenis_layanan', $layanan->jenis_layanan) }}"
                           required>
                    @error('jenis_layanan')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">Deskripsi Layanan</label>
                    <textarea name="deskripsi" 
                              class="form-control-custom" 
                              placeholder="Masukkan deskripsi lengkap layanan"
                              rows="4"
                              required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <!-- Gambar Saat Ini -->
                    @if($layanan->gambar)
                    <div class="current-image">
                        <label class="current-image-label">Gambar Saat Ini</label>
                        <div class="file-preview">
                            <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                                 alt="Gambar Layanan Saat Ini"
                                 onerror="this.style.display='none'">
                        </div>
                    </div>
                    @endif

                    <label class="form-label">
                        {{ $layanan->gambar ? 'Ganti Gambar Layanan' : 'Pilih Gambar Layanan' }}
                    </label>
                    <input type="file" 
                           name="gambar" 
                           class="form-control-custom file-input-custom"
                           accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    @error('gambar')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="file-preview" id="filePreview"></div>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.layanan.index') }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        const formControls = document.querySelectorAll('.form-control-custom');
        
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            control.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // File preview functionality
        const fileInput = document.querySelector('input[type="file"]');
        const filePreview = document.getElementById('filePreview');
        
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    filePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar Baru">`;
                }
                reader.readAsDataURL(file);
            } else {
                filePreview.innerHTML = '';
            }
        });

        // Show success message with animation
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            successAlert.style.animation = 'fadeInUp 0.6s ease-out';
        }
    });
</script>
@endsection