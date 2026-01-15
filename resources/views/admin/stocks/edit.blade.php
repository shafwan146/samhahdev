@extends('admin.layouts.app')

@section('title', 'Edit Stok')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.stocks.index') }}">Manajemen Stok</a>
                <span>/</span>
                <span>Edit #{{ $stock->id }}</span>
            </div>
            <h1>Edit Stok</h1>
            <p>Perbarui data stok {{ $stock->product_name }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card" style="max-width: 640px;">
        <div class="card-header">
            <h3>
                <span>✏️</span>
                Informasi Stok
            </h3>
            <span class="badge badge-{{ $stock->product_type === 'ayam_pelung' ? 'green' : 'orange' }}">
                ID: #{{ $stock->id }}
            </span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stocks.update', $stock) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="product_name">
                        Nama Produk <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="product_name" 
                        name="product_name" 
                        class="form-control @error('product_name') error @enderror"
                        value="{{ old('product_name', $stock->product_name) }}"
                        placeholder="Contoh: Ayam Pelung Siap Panen"
                        required
                    >
                    @error('product_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p class="form-hint">Nama yang akan ditampilkan untuk produk ini</p>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="product_type">
                            Jenis Produk <span class="required">*</span>
                        </label>
                        <select 
                            id="product_type" 
                            name="product_type" 
                            class="form-control @error('product_type') error @enderror"
                            required
                        >
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($productTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('product_type', $stock->product_type) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_type')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="age_variant">
                            Umur <span class="required">*</span>
                        </label>
                        <select 
                            id="age_variant" 
                            name="age_variant" 
                            class="form-control @error('age_variant') error @enderror"
                            required
                        >
                            <option value="">-- Pilih Umur --</option>
                            @foreach($ageVariants as $value => $label)
                                <option value="{{ $value }}" {{ old('age_variant', $stock->age_variant) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('age_variant')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="quantity">
                            Jumlah Stok <span class="required">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="quantity" 
                            name="quantity" 
                            class="form-control @error('quantity') error @enderror"
                            value="{{ old('quantity', $stock->quantity) }}"
                            min="0"
                            placeholder="0"
                            required
                        >
                        @error('quantity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Jumlah ayam dalam satuan ekor</p>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="price">
                            Harga per Ekor (Rp) <span class="required">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            class="form-control @error('price') error @enderror"
                            value="{{ old('price', $stock->price) }}"
                            min="0"
                            placeholder="0"
                            required
                        >
                        @error('price')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Harga jual per ekor dalam Rupiah</p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="notes">Catatan</label>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        class="form-control"
                        placeholder="Catatan tambahan tentang stok ini (opsional)..."
                        rows="3"
                    >{{ old('notes', $stock->notes) }}</textarea>
                    <p class="form-hint">Informasi tambahan seperti kondisi ayam, tanggal masuk, dll</p>
                </div>

                <!-- Meta Info -->
                <div class="alert alert-info" style="margin-top: 1rem;">
                    <span class="alert-icon">ℹ️</span>
                    <div class="alert-content">
                        <strong>Terakhir diperbarui:</strong> {{ $stock->updated_at->format('d M Y, H:i') }} WIB
                    </div>
                </div>
                
                <div class="btn-group" style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            <path d="M17 21v-8H7v8M7 3v5h8"/>
                        </svg>
                        Update Stok
                    </button>
                    <a href="{{ route('admin.stocks.index') }}" class="btn btn-secondary btn-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
