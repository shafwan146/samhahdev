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
            @php
                $isAyam = \Illuminate\Support\Str::contains(strtolower($stock->product_type), 'ayam');
                $isPitik = \Illuminate\Support\Str::contains(strtolower($stock->product_type), 'pitik');
                
                $iconClass = 'blue';
                $emoji = '📦';
                
                if ($isAyam) {
                    $iconClass = 'green';
                    $emoji = '🐓';
                } elseif ($isPitik) {
                    $iconClass = 'orange';
                    $emoji = '🐣';
                }
            @endphp
            <div class="stat-card">
                <div class="stat-icon {{ $iconClass }}">
                    {{ $emoji }}
                </div>
                <div class="stat-content">
                    <h4>{{ $productTypes[$stock->product_type] ?? ucwords(str_replace('_', ' ', $stock->product_type)) }}</h4>
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
                                        <div style="font-weight: 500;">
                                            {{ $productTypes[$stock->product_type] ?? ucwords(str_replace('_', ' ', $stock->product_type)) }}
                                        </div>
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
    const productTypes = @json($productTypes);

    const colors = [
        { border: '#2E7D32', bg: 'rgba(46, 125, 50, 0.1)' },
        { border: '#E65100', bg: 'rgba(230, 81, 0, 0.1)' },
        { border: '#1976D2', bg: 'rgba(25, 118, 210, 0.1)' },
        { border: '#C2185B', bg: 'rgba(194, 24, 91, 0.1)' },
        { border: '#512DA8', bg: 'rgba(81, 45, 168, 0.1)' },
        { border: '#0097A7', bg: 'rgba(0, 151, 167, 0.1)' },
    ];
    
    const datasets = [];
    let colorIndex = 0;
    
    for (const [key, label] of Object.entries(productTypes)) {
        const data = monthlySalesData.map(item => item[key] || 0);
        const color = colors[colorIndex % colors.length];
        
        datasets.push({
            label: label + ' (ekor)',
            data: data,
            borderColor: color.border,
            backgroundColor: color.bg,
            tension: 0.4,
            fill: true,
        });
        colorIndex++;
    }

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: datasets
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
