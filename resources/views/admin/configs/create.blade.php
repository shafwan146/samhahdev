@extends('admin.layouts.app')

@section('title', 'Tambah Konfigurasi')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.configs.index', ['type' => $type]) }}">Konfigurasi</a>
                <span>/</span>
                <span>Tambah</span>
            </div>
            <h1>Tambah {{ $configTypes[$type] ?? 'Konfigurasi' }}</h1>
            <p>Tambahkan data konfigurasi baru</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card" style="max-width: 600px;">
        <div class="card-header">
            <h3>
                <span>➕</span>
                Informasi Konfigurasi
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.configs.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="type">
                        Tipe Konfigurasi <span class="required">*</span>
                    </label>
                    <select 
                        id="type" 
                        name="type" 
                        class="form-control @error('type') error @enderror"
                        required
                    >
                        @foreach($configTypes as $value => $label)
                            <option value="{{ $value }}" {{ old('type', $type) === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="key">
                        Key <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="key" 
                        name="key" 
                        class="form-control @error('key') error @enderror"
                        value="{{ old('key') }}"
                        placeholder="contoh: ayam_pelung"
                        pattern="[a-z0-9_]+"
                        required
                    >
                    @error('key')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p class="form-hint">Gunakan huruf kecil, angka, dan underscore saja. Key bersifat unik.</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="label">
                        Label <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="label" 
                        name="label" 
                        class="form-control @error('label') error @enderror"
                        value="{{ old('label') }}"
                        placeholder="contoh: Ayam Pelung"
                        required
                    >
                    @error('label')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p class="form-hint">Nama yang akan ditampilkan kepada pengguna</p>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <input 
                        type="text" 
                        id="description" 
                        name="description" 
                        class="form-control"
                        value="{{ old('description') }}"
                        placeholder="Deskripsi singkat (opsional)"
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="toggle-group" style="margin-top: 0.5rem;">
                        <label class="toggle-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="toggle-text">Aktif</span>
                        </label>
                    </div>
                </div>
                
                <div class="btn-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            <path d="M17 21v-8H7v8M7 3v5h8"/>
                        </svg>
                        Simpan
                    </button>
                    <a href="{{ route('admin.configs.index', ['type' => $type]) }}" class="btn btn-secondary btn-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .toggle-group {
        display: flex;
        align-items: center;
    }
    
    .toggle-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .toggle-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-green);
    }
    
    .toggle-text {
        font-size: 0.9rem;
        color: var(--text-dark);
    }
</style>
@endpush
