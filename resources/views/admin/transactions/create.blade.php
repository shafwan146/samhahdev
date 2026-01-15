@extends('admin.layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.transactions.index') }}">Transaksi</a>
                <span>/</span>
                <span>Tambah</span>
            </div>
            <h1>Tambah Transaksi Baru</h1>
            <p>Catat transaksi penjualan ayam</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h3>
                <span>💰</span>
                Form Transaksi
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="transaction_code">Kode Transaksi</label>
                        <input 
                            type="text" 
                            id="transaction_code" 
                            name="transaction_code" 
                            class="form-control"
                            value="{{ old('transaction_code', $transactionCode) }}"
                            readonly
                            style="background: var(--light-gray);"
                        >
                        @error('transaction_code')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="transaction_date">Tanggal Transaksi *</label>
                        <input 
                            type="date" 
                            id="transaction_date" 
                            name="transaction_date" 
                            class="form-control @error('transaction_date') is-invalid @enderror"
                            value="{{ old('transaction_date', date('Y-m-d')) }}"
                            required
                        >
                        @error('transaction_date')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="customer_name">Nama Customer *</label>
                        <input 
                            type="text" 
                            id="customer_name" 
                            name="customer_name" 
                            class="form-control @error('customer_name') is-invalid @enderror"
                            value="{{ old('customer_name') }}"
                            placeholder="Masukkan nama pembeli"
                            required
                        >
                        @error('customer_name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="customer_phone">No. Telepon</label>
                        <input 
                            type="tel" 
                            id="customer_phone" 
                            name="customer_phone" 
                            class="form-control @error('customer_phone') is-invalid @enderror"
                            value="{{ old('customer_phone') }}"
                            placeholder="08xxxxxxxxxx"
                        >
                        @error('customer_phone')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="product_type">Jenis Produk *</label>
                        <select 
                            id="product_type" 
                            name="product_type" 
                            class="form-control @error('product_type') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Jenis Produk --</option>
                            @foreach($productTypes as $key => $label)
                                <option value="{{ $key }}" {{ old('product_type') === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="age_variant">Varian Umur *</label>
                        <select 
                            id="age_variant" 
                            name="age_variant" 
                            class="form-control @error('age_variant') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Varian Umur --</option>
                            @foreach($ageVariants as $key => $label)
                                <option value="{{ $key }}" {{ old('age_variant') === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('age_variant')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="quantity">Jumlah (ekor) *</label>
                        <input 
                            type="number" 
                            id="quantity" 
                            name="quantity" 
                            class="form-control @error('quantity') is-invalid @enderror"
                            value="{{ old('quantity') }}"
                            placeholder="Contoh: 10"
                            min="1"
                            required
                        >
                        @error('quantity')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="unit_price">Harga Satuan (Rp) *</label>
                        <input 
                            type="number" 
                            id="unit_price" 
                            name="unit_price" 
                            class="form-control @error('unit_price') is-invalid @enderror"
                            value="{{ old('unit_price') }}"
                            placeholder="Contoh: 50000"
                            min="0"
                            required
                        >
                        @error('unit_price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="notes">Catatan</label>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        class="form-control @error('notes') is-invalid @enderror"
                        rows="3"
                        placeholder="Catatan tambahan (opsional)"
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
