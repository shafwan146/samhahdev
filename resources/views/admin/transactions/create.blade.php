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
                            <!-- Pilihan diisi lewat Javascript -->
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
                            <!-- Pilihan diisi lewat Javascript -->
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
                            placeholder="Terisi otomatis"
                            min="0"
                            required
                            readonly
                            style="background: var(--light-gray);"
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const availableStocks = @json($availableStocks);
        const productTypes = @json($productTypes);
        const ageVariants = @json($ageVariants);

        const stockPrices = @json($stockPrices);

        const productTypeSelect = document.getElementById('product_type');
        const ageVariantSelect = document.getElementById('age_variant');
        const quantityInput = document.getElementById('quantity');
        const unitPriceInput = document.getElementById('unit_price');
        
        const oldProductType = '{{ old('product_type') }}';
        const oldAgeVariant = '{{ old('age_variant') }}';
        
        // Element untuk hint kuantitas maksimal
        const quantityHint = document.createElement('small');
        quantityHint.className = 'form-text text-muted';
        quantityHint.style.display = 'block';
        quantityHint.style.marginTop = '0.25rem';
        quantityInput.parentNode.appendChild(quantityHint);

        // 1. Populate Jenis Produk berdasarkan stok yang lebih dari 0
        function populateProductTypes() {
            productTypeSelect.innerHTML = '<option value="">-- Pilih Jenis Produk --</option>';
            for (const [key, label] of Object.entries(productTypes)) {
                if (availableStocks[key] && Object.keys(availableStocks[key]).length > 0) {
                    const option = document.createElement('option');
                    option.value = key;
                    option.textContent = label;
                    if (key === oldProductType) option.selected = true;
                    productTypeSelect.appendChild(option);
                }
            }
        }

        // 2. Populate Varian Umur berdasarkan Jenis Produk yang dipilih
        function populateAgeVariants() {
            const selectedProduct = productTypeSelect.value;
            ageVariantSelect.innerHTML = '<option value="">-- Pilih Varian Umur --</option>';
            
            if (selectedProduct && availableStocks[selectedProduct]) {
                const availableAges = availableStocks[selectedProduct];
                for (const [key, label] of Object.entries(ageVariants)) {
                    if (availableAges[key] !== undefined && availableAges[key] > 0) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = `${label} (Stok: ${availableAges[key]})`;
                        if (key === oldAgeVariant) option.selected = true;
                        ageVariantSelect.appendChild(option);
                    }
                }
            }
            updateMaxQuantity();
        }

        // 3. Batasi Quantity input berdasarkan varian yang dipilih
        function updateMaxQuantity() {
            const pType = productTypeSelect.value;
            const aVar = ageVariantSelect.value;

            if (pType && aVar && availableStocks[pType] && availableStocks[pType][aVar] !== undefined) {
                const maxStock = availableStocks[pType][aVar];
                quantityInput.max = maxStock;
                quantityHint.textContent = `Maksimal stok tersedia untuk varian ini: ${maxStock} ekor`;
                
                // Pastikan input tidak melebihi stok
                if (parseInt(quantityInput.value) > maxStock) {
                    quantityInput.value = maxStock;
                }
                // Set harga satuan
                if (stockPrices[pType] && stockPrices[pType][aVar] !== undefined) {
                    unitPriceInput.value = stockPrices[pType][aVar];
                }
            } else {
                quantityInput.max = '';
                quantityHint.textContent = '';
                unitPriceInput.value = '';
            }
        }

        productTypeSelect.addEventListener('change', populateAgeVariants);
        ageVariantSelect.addEventListener('change', updateMaxQuantity);

        quantityInput.addEventListener('input', function() {
            if (this.max) {
                const max = parseInt(this.max);
                const val = parseInt(this.value);
                if (val > max) {
                    this.value = max;
                }
            }
        });

        // Initialize
        populateProductTypes();
        if (oldProductType) {
            populateAgeVariants();
        }
    });
</script>
@endpush
