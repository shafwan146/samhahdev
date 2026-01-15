@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green">🐔</div>
            <div class="stat-content">
                <h4>Total Stok</h4>
                <div class="stat-value">{{ number_format($totalStock) }}</div>
                <div class="stat-change up">ekor tersedia</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">📦</div>
            <div class="stat-content">
                <h4>Jenis Produk</h4>
                <div class="stat-value">{{ $totalProducts }}</div>
                <div class="stat-change">varian produk</div>
            </div>
        </div>
        @foreach($stockByType as $stock)
            <div class="stat-card">
                <div class="stat-icon {{ $stock->product_type === 'ayam_pelung' ? 'green' : 'orange' }}">
                    {{ $stock->product_type === 'ayam_pelung' ? '🐓' : '🐣' }}
                </div>
                <div class="stat-content">
                    <h4>{{ $stock->product_type === 'ayam_pelung' ? 'Ayam Pelung' : 'Pitik Pelung' }}</h4>
                    <div class="stat-value">{{ number_format($stock->total) }}</div>
                    <div class="stat-change">ekor</div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sales Chart -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <div class="card-header">
            <h3>
                <span>📈</span>
                Grafik Penjualan Per Bulan
            </h3>
        </div>
        <div class="card-body">
            <div class="chart-container" style="position: relative; height: 300px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Stocks -->
    <div class="card">
        <div class="card-header">
            <h3>
                <span>📋</span>
                Stok Terbaru
            </h3>
            <a href="{{ route('admin.stocks.index') }}" class="btn btn-secondary btn-sm">
                Lihat Semua →
            </a>
        </div>
        @if($recentStocks->count() > 0)
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jenis</th>
                                <th>Umur</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentStocks as $stock)
                                <tr>
                                    <td>
                                        <div class="table-product">
                                            <div class="table-product-icon">
                                                {{ $stock->product_type === 'ayam_pelung' ? '🐓' : '🐣' }}
                                            </div>
                                            <div class="table-product-info">
                                                <div class="table-product-name">{{ $stock->product_name }}</div>
                                                <div class="table-product-meta">ID: #{{ $stock->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $stock->product_type === 'ayam_pelung' ? 'badge-green' : 'badge-orange' }}">
                                            {{ $stock->product_type === 'ayam_pelung' ? 'Ayam' : 'Pitik' }}
                                        </span>
                                    </td>
                                    <td>{{ str_replace('_', ' ', ucfirst($stock->age_variant)) }}</td>
                                    <td class="font-bold">{{ number_format($stock->quantity) }}</td>
                                    <td class="whitespace-nowrap">{{ $stock->formatted_price }}</td>
                                    <td class="text-muted">{{ $stock->updated_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Real data from database
    const monthlySalesData = @json($monthlySales);
    const ayamPelungData = monthlySalesData.map(item => item.ayam_pelung);
    const pitikPelungData = monthlySalesData.map(item => item.pitik_pelung);

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Ayam Pelung (ekor)',
                    data: ayamPelungData,
                    borderColor: '#2E7D32',
                    backgroundColor: 'rgba(46, 125, 50, 0.1)',
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Pitik Pelung (ekor)',
                    data: pitikPelungData,
                    borderColor: '#E65100',
                    backgroundColor: 'rgba(230, 81, 0, 0.1)',
                    tension: 0.4,
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Terjual'
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            }
        }
    });
</script>
@endpush
