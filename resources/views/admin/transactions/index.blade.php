@extends('admin.layouts.app')

@section('title', 'Manajemen Transaksi')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Transaksi</span>
            </div>
            <h1>Manajemen Transaksi</h1>
            <p>Kelola catatan penjualan ayam Samhah Farm</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('admin.transactions.export') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>
                </svg>
                Export Excel
            </a>
            <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Transaksi
            </a>
        </div>
    </div>

    <!-- Transaction Table Card -->
    <div class="card">
        <div class="card-header">
            <h3>
                <span>💰</span>
                Daftar Transaksi ({{ $transactions->total() }} data)
            </h3>
        </div>
        @if($transactions->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>
                                        <code style="background: var(--light-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">
                                            {{ $transaction->transaction_code }}
                                        </code>
                                    </td>
                                    <td class="whitespace-nowrap">{{ $transaction->transaction_date->format('d M Y') }}</td>
                                    <td>
                                        <div class="table-product-info">
                                            <div class="table-product-name">{{ $transaction->customer_name }}</div>
                                            @if($transaction->customer_phone)
                                                <div class="table-product-meta">{{ $transaction->customer_phone }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 500;">
                                            {{ $productTypes[$transaction->product_type] ?? ucwords(str_replace('_', ' ', $transaction->product_type)) }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
                                            {{ $ageVariants[$transaction->age_variant] ?? ucwords(str_replace('_', ' ', $transaction->age_variant)) }}
                                        </div>
                                    </td>
                                    <td class="font-bold">{{ number_format($transaction->quantity) }}</td>
                                    <td class="whitespace-nowrap font-bold">{{ $transaction->formatted_total_price }}</td>
                                    <td>
                                        <div class="actions" style="justify-content: flex-end;">
                                            <a href="{{ route('admin.transactions.edit', $transaction) }}" class="btn btn-secondary btn-icon btn-sm" title="Edit">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" class="delete-form" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger-outline btn-icon btn-sm" title="Hapus" onclick="openDeleteModal(this.closest('form'), '{{ $transaction->transaction_code }}')">
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
            
            @if($transactions->hasPages())
                <div class="card-footer">
                    <div class="pagination">
                        {{ $transactions->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="card-body">
                <div class="empty-state">
                    <span class="empty-state-icon">💰</span>
                    <h3>Belum Ada Transaksi</h3>
                    <p>Mulai catat transaksi penjualan pertama Anda.</p>
                    <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">
                        + Tambah Transaksi Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
