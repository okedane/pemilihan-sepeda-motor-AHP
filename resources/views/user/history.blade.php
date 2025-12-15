<x-app>
    <x-slot:title>History</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-1 font-size-18 fw-bold">
                                <i class="fas fa-history text-danger me-2"></i>Riwayat Rekomendasi
                            </h4>
                            <p class="text-muted mb-0 small">Daftar riwayat analisis pemilihan motor Honda Anda</p>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Riwayat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-danger bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-danger">
                                            <i class="fas fa-clipboard-list font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Total Analisis</p>
                                    <h4 class="mb-0 fw-bold">{{ $riwayats->total() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-success bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-success">
                                            <i class="fas fa-motorcycle font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Rekomendasi Terbaru</p>
                                    <h6 class="mb-0 fw-bold text-truncate">
                                        {{ $riwayats->first()?->alternatif->nama ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-info bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-info">
                                            <i class="fas fa-calendar-alt font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Terakhir Dianalisis</p>
                                    <h6 class="mb-0 fw-bold">
                                        {{ $riwayats->first()?->created_at->diffForHumans() ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0 fw-bold">
                                        <i class="fas fa-list-alt text-danger me-2"></i>Daftar Riwayat
                                    </h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    @if($riwayats->count() > 0)
                                    <a href="{{ route('user.export.history.pdf') }}" class="btn btn-danger btn-sm me-2">
                                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                                    </a>
                                    @endif
                                    <a href="{{ route('inputData') }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-plus me-1"></i>Analisis Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if ($riwayats->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="px-4 py-3" style="width: 60px;">No</th>
                                                <th class="px-4 py-3">Tanggal & Waktu</th>
                                                <th class="px-4 py-3">Motor Rekomendasi</th>
                                                <th class="px-4 py-3" style="width: 120px;">Skor AHP</th>
                                                <th class="px-4 py-3 text-center" style="width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayats as $item)
                                                <tr>
                                                    <td class="px-4">
                                                        <span class="badge badge-soft-secondary rounded-pill">
                                                            {{ ($riwayats->currentPage() - 1) * $riwayats->perPage() + $loop->iteration }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4">
                                                        <div class="d-flex align-items-center">
                                                            <i class="far fa-calendar text-muted me-2"></i>
                                                            <div>
                                                                <div class="fw-medium">
                                                                    {{ $item->created_at->format('d M Y') }}</div>
                                                                <small
                                                                    class="text-muted">{{ $item->created_at->format('H:i') }}
                                                                    WIB</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs me-2">
                                                                <div
                                                                    class="avatar-title rounded-circle bg-danger bg-opacity-10">
                                                                    <i class="fas fa-motorcycle text-danger"></i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-semibold text-dark">
                                                                    {{ $item->alternatif->nama }}</div>
                                                                <small class="text-muted">Honda Motor</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4">
                                                        <span class="badge bg-danger-subtle text-danger fs-6 fw-bold">
                                                            {{ number_format($item->skor, 3) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail{{ $item->id }}"
                                                            title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="card-footer bg-white border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">
                                            Menampilkan {{ $riwayats->firstItem() }} - {{ $riwayats->lastItem() }}
                                            dari {{ $riwayats->total() }} data
                                        </div>
                                        <div>
                                            {{ $riwayats->links() }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-inbox text-muted" style="font-size: 4rem;"></i>
                                    </div>
                                    <h5 class="text-muted mb-2">Belum Ada Riwayat</h5>
                                    <p class="text-muted mb-4">Anda belum melakukan analisis pemilihan motor</p>
                                    <a href="{{ route('inputData') }}" class="btn btn-danger">
                                        <i class="fas fa-plus me-2"></i>Mulai Analisis Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($riwayats as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-gradient text-white"
                        style="background: linear-gradient(135deg, #CC0000 0%, #E60000 100%);">
                        <h5 class="modal-title fw-bold" id="modalLabel{{ $item->id }}">
                            <i class="fas fa-info-circle me-2"></i>Detail Rekomendasi
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Motor Info -->
                        <div class="card bg-danger bg-opacity-10 border-danger mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            <div class="avatar-title rounded-circle bg-danger">
                                                <i class="fas fa-motorcycle text-white font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h4 class="fw-bold text-danger mb-1">{{ $item->alternatif->nama }}</h4>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            Skor AHP: <strong
                                                class="text-danger">{{ number_format($item->skor, 3) }}</strong>
                                        </p>
                                        <p class="text-muted mb-0 small">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ $item->created_at->format('d M Y H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kriteria yang Dipilih -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>Kriteria yang Dipilih
                            </h6>
                            <div class="row g-2">
                                @foreach ($item->subkriteria_list as $sub)
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-success">
                                                                <i class="fas fa-check text-white"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <p class="mb-0 small fw-medium">{{ $sub->nama }}</p>
                                                        <small
                                                            class="text-muted">{{ $sub->kriteria->nama ?? 'Kriteria' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Info Footer -->
                        <div class="alert alert-light border-0 mb-0">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                <small class="text-muted mb-0">
                                    Hasil ini merupakan rekomendasi sistem berdasarkan metode AHP sesuai dengan kriteria
                                    yang Anda pilih.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .page-content {
            background-color: #f8f9fa;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(204, 0, 0, 0.02);
        }

        .avatar-sm {
            height: 3rem;
            width: 3rem;
        }

        .avatar-xs {
            height: 2rem;
            width: 2rem;
        }

        .avatar-lg {
            height: 4rem;
            width: 4rem;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .badge-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .bg-danger-subtle {
            background-color: rgba(204, 0, 0, 0.1);
        }

        .btn-danger {
            background: linear-gradient(135deg, #CC0000 0%, #E60000 100%);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #B30000 0%, #CC0000 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(204, 0, 0, 0.3);
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .font-size-18 {
            font-size: 1.125rem;
        }

        .font-size-20 {
            font-size: 1.25rem;
        }

        .font-size-24 {
            font-size: 1.5rem;
        }

        .modal-content {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .bg-gradient {
            position: relative;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }

            .card-body {
                padding: 1rem;
            }

            .btn-sm {
                font-size: 0.75rem;
            }
        }

        @media print {

            .btn,
            .modal-footer,
            .page-title-box {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows on load
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 50);
            });

            // Smooth scroll for pagination
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.classList.contains('disabled')) {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</x-app>
