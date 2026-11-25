@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- System Notifications Banner --}}
@php
    $hasAlert = ($jumlahKadaluarsa > 0 || $jumlahHampirExp > 0 || $jumlahStokMinimum > 0);
@endphp

<div class="card border-0 mb-4 {{ $hasAlert ? 'shadow-sm' : '' }}">
    <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-3">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2 fs-6 fw-bold">
            <span class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle p-2" style="width: 32px; height: 32px;">
                <i class="bi bi-bell-fill fs-6"></i>
            </span>
            Notifikasi & Status Sistem
        </h5>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-light border" data-lte-toggle="card-collapse" title="Minimize">
                <i class="bi bi-dash-lg"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3">
            @if($jumlahKadaluarsa > 0)
                <div class="col-md-4 col-12">
                    <div class="alert alert-warning mb-0 border-0 shadow-sm d-flex align-items-center gap-3">
                        <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
                        <div>
                            <div class="fw-bold fs-6">{{ $jumlahKadaluarsa }} Batch</div>
                            <small>Obat akan segera kadaluarsa.</small>
                        </div>
                    </div>
                </div>
            @endif

            @if($jumlahHampirExp > 0)
                <div class="col-md-4 col-12">
                    <div class="alert alert-danger mb-0 border-0 shadow-sm d-flex align-items-center gap-3">
                        <i class="bi bi-x-octagon-fill fs-3 text-danger"></i>
                        <div>
                            <div class="fw-bold fs-6">{{ $jumlahHampirExp }} Batch</div>
                            <small>Obat telah melewati kadaluarsa.</small>
                        </div>
                    </div>
                </div>
            @endif

            @if($jumlahStokMinimum > 0)
                <div class="col-md-4 col-12">
                    <div class="alert alert-info mb-0 border-0 shadow-sm d-flex align-items-center gap-3">
                        <i class="bi bi-box-seam-fill fs-3" style="color: #20A67A;"></i>
                        <div>
                            <div class="fw-bold fs-6">{{ $jumlahStokMinimum }} Jenis Obat</div>
                            <small>Mencapai batas stok minimum.</small>
                        </div>
                    </div>
                </div>
            @endif

            @if(!$hasAlert)
                <div class="col-12">
                    <div class="alert alert-success mb-0 border-0 shadow-sm d-flex align-items-center gap-3">
                        <i class="bi bi-check-circle-fill fs-3" style="color: #087F5B;"></i>
                        <div>
                            <div class="fw-bold">Kondisi Sistem Normal</div>
                            <small>Tidak ada peringatan stok maupun batch kadaluarsa saat ini.</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Top Header --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
    <div>
        <h4 class="fw-bold mb-1" style="color: #25352F;">Ringkasan Apotek</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">
            Pantau pergerakan stok obat, transaksi penjualan, dan kesehatan inventaris.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
        </a>
    </div>
</div>

{{-- Metric Info Cards --}}
<div class="row g-3 mb-4">
    <!-- Total Obat -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="info-box">
            <span class="info-box-icon text-white shadow" style="background: linear-gradient(135deg, #087F5B, #20A67A);">
                <i class="bi bi-capsule-pill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Jenis Obat</span>
                <span class="info-box-number">{{ number_format($totalObat ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- Total Batch -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="info-box">
            <span class="info-box-icon text-white shadow" style="background: linear-gradient(135deg, #ef4444, #f97316);">
                <i class="bi bi-boxes"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Batch</span>
                <span class="info-box-number">{{ number_format($totalBatch ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- Total Stok -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="info-box">
            <span class="info-box-icon text-white shadow" style="background: linear-gradient(135deg, #20A67A, #A3E4C5);">
                <i class="bi bi-clipboard2-pulse-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Fisik Stok</span>
                <span class="info-box-number">{{ number_format($totalStok ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- Penjualan Hari Ini -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="info-box">
            <span class="info-box-icon text-white shadow" style="background: linear-gradient(135deg, #087F5B, #A3E4C5);">
                <i class="bi bi-cash-stack"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Penjualan Hari Ini</span>
                <span class="info-box-number">Rp {{ number_format($penjualanHariIni ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- Charts Section --}}
<div class="row g-4 mb-4">
    <!-- Line Chart: 7 Hari Terakhir -->
    <div class="col-12 col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    <i class="bi bi-graph-up me-2" style="color: #087F5B;"></i>
                    Grafik Tren Penjualan (7 Hari Terakhir)
                </h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 320px; position: relative;">
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart: 10 Obat Terlaris -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    <i class="bi  text-warning me-2"></i>
                    Top 10 Obat Terlaris
                </h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 320px; position: relative;">
                    <canvas id="chartObat"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Table Monitoring Kadaluarsa --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">
            <i class="bi bi-calendar-x text-danger me-2"></i>
            Monitoring Kadaluarsa Batch Obat
        </h5>
        <div class="card-tools">
            <a href="{{ route('batch-obat.index') }}" class="btn btn-sm btn-light border me-1">
                <i class="bi bi-arrow-right me-1"></i> Semua Batch
            </a>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                <i class="bi bi-dash-lg"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nama Obat</th>
                        <th>Nomor Batch</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expSoon as $item)
                        @php
                            $exp = \Carbon\Carbon::parse($item->tanggal_kadaluarsa);
                        @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle p-2 d-inline-flex" style="color: #087F5B; background-color: rgba(163, 228, 197, 0.25);">
                                        <i class="bi bi-capsule"></i>
                                    </div>
                                    <span class="fw-semibold" style="color: #25352F;">{{ $item->obat->nama_obat ?? '-' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $item->nomor_batch }}</span>
                            </td>
                            <td>
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ $exp->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                @if($exp->isPast())
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                        <i class="bi bi-x-circle-fill me-1"></i>Kadaluarsa
                                    </span>
                                @elseif($exp->lessThanOrEqualTo(now()->addMonths(6)))
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Hampir Kadaluarsa
                                    </span>
                                @else
                                    <span class="badge border" style="background-color: #ebf9f3; color: #087F5B; border-color: rgba(32, 166, 122, 0.3) !important;">
                                        <i class="bi bi-check-circle-fill me-1"></i>Aman
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <span class="fw-bold">{{ number_format($item->stok_sisa) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-check2-circle fs-1 text-success d-block mb-2"></i>
                                    Semua batch obat dalam kondisi aman & terpantau.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Top 10 Obat Chart
    const ctxObat = document.getElementById('chartObat');
    if (ctxObat) {
        new Chart(ctxObat, {
            type: 'bar',
            data: {
                labels: @json($labelObat ?? []),
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: @json($dataObat ?? []),
                    backgroundColor: 'rgba(8, 127, 91, 0.85)',
                    borderColor: '#087F5B',
                    borderWidth: 1.5,
                    borderRadius: 8,
                    hoverBackgroundColor: '#20A67A'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { precision: 0 }
                    },
                    y: {
                        grid: { color: 'rgba(37, 53, 47, 0.05)' }
                    }
                }
            }
        });
    }

    // 7 Days Sales Trend Line Chart
    const ctxPenjualan = document.getElementById('grafikPenjualan');
    if (ctxPenjualan) {
        const gradient = ctxPenjualan.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(8, 127, 91, 0.35)');
        gradient.addColorStop(1, 'rgba(163, 228, 197, 0.02)');

        new Chart(ctxPenjualan, {
            type: 'line',
            data: {
                labels: @json($labelGrafik ?? []),
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: @json($dataGrafik ?? []),
                    borderColor: '#087F5B',
                    borderWidth: 3,
                    pointBackgroundColor: '#FFFFFF',
                    pointBorderColor: '#20A67A',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ' Penjualan: Rp ' + Number(context.raw).toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        grid: { color: 'rgba(37, 53, 47, 0.05)' },
                        ticks: {
                            callback: function (val) {
                                if (val >= 1000000) return (val / 1000000) + ' Jt';
                                if (val >= 1000) return (val / 1000) + ' Rb';
                                return val;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush

@endsection
