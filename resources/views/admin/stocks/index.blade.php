@extends('admin.layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Manajemen Stok</span>
            </div>
            <h1>Manajemen Stok Ayam</h1>
            <p>Kelola semua data stok ayam Samhah Farm</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('admin.stocks.export') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                </svg>
                Export Excel
            </a>
            <a href="{{ route('admin.stocks.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Stok
            </a>
        </div>
    </div>

    <!-- Stock Table Card -->
    <div class="card">
        <div class="card-header">
            <h3>
                <span>🐔</span>
                Daftar Stok ({{ $stocks->total() }} data)
            </h3>
        </div>
        @if($stocks->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Jenis</th>
                                <th>Umur</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Catatan</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $index => $stock)
                                <tr>
                                    <td class="text-muted">{{ $stocks->firstItem() + $index }}</td>
                                    <td>
                                        <div class="table-product">
                                            <div class="table-product-icon" style="background: {{ $stock->product_type === 'ayam_pelung' ? 'var(--light-green)' : 'var(--light-orange)' }}">
                                                {{ $stock->product_type === 'ayam_pelung' ? '🐓' : '🐣' }}
                                            </div>
                                            <div class="table-product-info">
                                                <div class="table-product-name">{{ $stock->product_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $stock->product_type === 'ayam_pelung' ? 'badge-green' : 'badge-orange' }}">
                                            {{ $stock->product_type === 'ayam_pelung' ? 'Ayam Pelung' : 'Pitik Pelung' }}
                                        </span>
                                    </td>
                                    <td>{{ str_replace('_', ' ', ucfirst($stock->age_variant)) }}</td>
                                    <td>
                                        <span class="font-bold">{{ number_format($stock->quantity) }}</span>
                                        <span class="text-muted">ekor</span>
                                    </td>
                                    <td class="whitespace-nowrap">{{ $stock->formatted_price }}</td>
                                    <td class="text-muted">{{ Str::limit($stock->notes, 25) ?: '-' }}</td>
                                    <td>
                                        <div class="actions" style="justify-content: flex-end;">
                                            <a href="{{ route('admin.stocks.edit', $stock) }}" class="btn btn-secondary btn-icon btn-sm" title="Edit">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" class="delete-form" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger-outline btn-icon btn-sm" title="Hapus" onclick="openDeleteModal(this.closest('form'), '{{ $stock->product_name }}')">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($stocks->hasPages())
                <div class="card-footer">
                    <div class="pagination">
                        @if($stocks->onFirstPage())
                            <span class="disabled">← Prev</span>
                        @else
                            <a href="{{ $stocks->previousPageUrl() }}">← Prev</a>
                        @endif
                        
                        @for($i = 1; $i <= $stocks->lastPage(); $i++)
                            @if($i == $stocks->currentPage())
                                <span class="current">{{ $i }}</span>
                            @else
                                <a href="{{ $stocks->url($i) }}">{{ $i }}</a>
                            @endif
                        @endfor
                        
                        @if($stocks->hasMorePages())
                            <a href="{{ $stocks->nextPageUrl() }}">Next →</a>
                        @else
                            <span class="disabled">Next →</span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="card-body">
                <div class="empty-state">
                    <span class="empty-state-icon">📦</span>
                    <h3>Belum Ada Data Stok</h3>
                    <p>Mulai kelola stok ayam Anda dengan menambahkan data stok pertama.</p>
                    <a href="{{ route('admin.stocks.create') }}" class="btn btn-primary">
                        + Tambah Stok Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
