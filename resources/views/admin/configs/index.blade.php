@extends('admin.layouts.app')

@section('title', 'Pengaturan Konfigurasi')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Konfigurasi</span>
            </div>
            <h1>Pengaturan Konfigurasi</h1>
            <p>Kelola jenis produk dan varian umur</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('admin.configs.create', ['type' => $type]) }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah {{ $configTypes[$type] ?? 'Konfigurasi' }}
            </a>
        </div>
    </div>

    <!-- Type Tabs -->
    <div class="tabs" style="margin-bottom: 1.5rem;">
        @foreach($configTypes as $key => $label)
            <a href="{{ route('admin.configs.index', ['type' => $key]) }}" 
               class="tab {{ $type === $key ? 'active' : '' }}">
                {{ $key === 'product_type' ? '🏷️' : '📅' }} {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- Config Table Card -->
    <div class="card">
        <div class="card-header">
            <h3>
                <span>⚙️</span>
                Daftar {{ $configTypes[$type] ?? 'Konfigurasi' }} ({{ $configs->total() }} data)
            </h3>
        </div>
        @if($configs->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Label</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($configs as $config)
                                <tr>
                                    <td>
                                        <code style="background: var(--light-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                            {{ $config->key }}
                                        </code>
                                    </td>
                                    <td>
                                        <strong>{{ $config->label }}</strong>
                                    </td>
                                    <td class="text-muted">{{ $config->description ?: '-' }}</td>
                                    <td>
                                        @if($config->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-gray">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-muted whitespace-nowrap">{{ $config->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="actions" style="justify-content: flex-end;">
                                            <a href="{{ route('admin.configs.edit', $config) }}" class="btn btn-secondary btn-icon btn-sm" title="Edit">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.configs.destroy', $config) }}" method="POST" class="delete-form" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger-outline btn-icon btn-sm" title="Hapus" onclick="openDeleteModal(this.closest('form'), '{{ $config->label }}')">
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
            
            @if($configs->hasPages())
                <div class="card-footer">
                    <div class="pagination">
                        {{ $configs->appends(['type' => $type])->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="card-body">
                <div class="empty-state">
                    <span class="empty-state-icon">⚙️</span>
                    <h3>Belum Ada Konfigurasi</h3>
                    <p>Tambahkan {{ strtolower($configTypes[$type] ?? 'konfigurasi') }} pertama untuk memulai.</p>
                    <a href="{{ route('admin.configs.create', ['type' => $type]) }}" class="btn btn-primary">
                        + Tambah {{ $configTypes[$type] ?? 'Konfigurasi' }}
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .tab {
        padding: 0.625rem 1.25rem;
        background: var(--white);
        border: 1px solid var(--border-gray);
        border-radius: var(--radius-md);
        text-decoration: none;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.875rem;
        transition: all var(--transition-fast);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tab:hover {
        background: var(--light-gray);
        color: var(--text-dark);
    }
    
    .tab.active {
        background: var(--primary-green);
        border-color: var(--primary-green);
        color: var(--white);
    }
</style>
@endpush
