<x-app>
        <x-slot:title>Hasil</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <!-- Header Section -->
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle p-3 mb-3">
                            <i class="fas fa-motorcycle text-danger" style="font-size: 2rem;"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Hasil Rekomendasi Motor Honda</h2>
                        <p class="text-muted">Analisis selesai menggunakan metode AHP berdasarkan kriteria yang Anda pilih</p>
                    </div>

                    <!-- Main Result Card -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-gradient text-white position-relative overflow-hidden"
                             style="background: linear-gradient(135deg, #CC0000 0%, #E60000 100%); border-radius: 0.5rem 0.5rem 0 0;">
                            <div class="position-absolute top-0 end-0 opacity-10">
                                <i class="fas fa-trophy" style="font-size: 4rem; transform: rotate(-15deg);"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Rekomendasi Terbaik</h5>
                                    <small class="opacity-90">Motor dengan nilai tertinggi berdasarkan analisis AHP</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-motorcycle text-danger" style="font-size: 2.5rem;"></i>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h4 class="mb-0 fw-bold text-danger me-3">{{ $terbaik['nama'] }}</h4>
                                                <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size: 1rem;">
                                                    Rp{{ number_format($terbaik['harga'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <small class="text-muted">Motor yang paling sesuai dengan kebutuhan Anda</small>
                                            @if(!empty($terbaik['deskripsi']))
                                                <div class="text-muted small" style="max-width: 400px;">
                                                    {{ $terbaik['deskripsi'] }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Berdasarkan kriteria yang dipilih, ini adalah rekomendasi terbaik untuk Anda dari CV. Sinar Baru.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Results -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-list-ul text-danger me-2"></i>
                                <h5 class="mb-0 fw-bold">Alternatif Motor Lainnya</h5>
                            </div>
                            <small class="text-muted">Urutan berdasarkan skor penilaian metode AHP</small>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-4 py-3" style="width: 60px;">Rank</th>
                                            <th class="px-4 py-3">Motor Honda</th>
                                            <th class="px-4 py-3" style="width: 120px;">Skor AHP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil as $row)
                                            <tr class="{{ $loop->first ? 'table-danger bg-opacity-10' : '' }}">
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        @if($loop->first)
                                                            <span class="badge bg-danger rounded-pill">{{ $loop->iteration }}</span>
                                                        @elseif($loop->iteration <= 3)
                                                            <span class="badge bg-warning rounded-pill">{{ $loop->iteration }}</span>
                                                        @else
                                                            <span class="badge bg-secondary rounded-pill">{{ $loop->iteration }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        @if($loop->first)
                                                            <i class="fas fa-crown text-danger me-2"></i>
                                                        @else
                                                            <i class="fas fa-motorcycle text-muted me-2"></i>
                                                        @endif
                                                        <div>
                                                            <div class="fw-semibold {{ $loop->first ? 'text-danger' : '' }}">
                                                                {{ $row['nama'] }}
                                                            </div>
                                                            @if($loop->first)
                                                                <small class="text-danger">Rekomendasi Terbaik</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="fw-bold {{ $loop->first ? 'text-danger' : '' }}">
                                                        {{ number_format($row['skor'], 3) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm card-hover">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-redo-alt text-danger mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Analisis Ulang</h6>
                                    <p class="text-muted small mb-3">Lakukan analisis baru dengan kriteria yang berbeda</p>
                                    <a href="{{ route('inputData') }}" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-plus me-1"></i>Analisis Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm card-hover">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-download text-success mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Simpan Hasil</h6>
                                    <p class="text-muted small mb-3">Download hasil rekomendasi dalam format PDF</p>
                                    <a href="{{ route('hasil.export', ['id' => $analisis_id ?? null]) }}" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm card-hover">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-home text-info mb-3" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold">Kembali</h6>
                                    <p class="text-muted small mb-3">Kembali ke dashboard utama</p>
                                    <a href="" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-arrow-left me-1"></i>Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="text-center">
                        <div class="alert alert-light border-0 shadow-sm">
                            <div class="d-flex align-items-center justify-content-center text-muted">
                                <i class="fas fa-lightbulb me-2 text-warning"></i>
                                <small>
                                    <strong>Informasi:</strong> Hasil ini merupakan rekomendasi sistem berdasarkan metode AHP. Untuk informasi lebih detail, silakan konsultasi dengan sales kami di CV. Sinar Baru.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Honda Branding Footer -->
                    <div class="text-center mt-3 mb-4">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1" style="color: #CC0000;"></i>
                            Sistem Pendukung Keputusan Pemilihan Motor Honda - CV. Sinar Baru
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .circular-chart {
            transform: rotate(-90deg);
        }

        .circle-bg {
            fill: none;
            stroke: #eee;
            stroke-width: 2;
        }

        .circle {
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            animation: progress 1s ease-in-out forwards;
        }

        @keyframes progress {
            0% {
                stroke-dasharray: 0 100;
            }
        }

        .percentage {
            fill: #CC0000;
            font-family: sans-serif;
            font-size: 0.5em;
            text-anchor: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(204, 0, 0, 0.02);
        }

        .progress {
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .progress-bar {
            border-radius: 10px;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(204, 0, 0, 0.15) !important;
        }

        .badge {
            font-size: 0.75rem;
        }

        .btn-outline-danger {
            border-color: #CC0000;
            color: #CC0000;
        }

        .btn-outline-danger:hover {
            background-color: #CC0000;
            border-color: #CC0000;
            color: white;
        }

        .table-danger {
            background-color: rgba(204, 0, 0, 0.05) !important;
        }

        .bg-danger.bg-opacity-10 {
            background-color: rgba(204, 0, 0, 0.1) !important;
        }

        @media (max-width: 768px) {
            .circular-progress svg {
                width: 80px;
                height: 80px;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .card-body {
                padding: 1.5rem;
            }
        }

        @media print {
            .btn, .alert:last-child, .row.g-4 {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate circular progress
            const circles = document.querySelectorAll('.circle');
            circles.forEach(circle => {
                const percentage = circle.closest('.circular-progress').dataset.percentage;
                circle.style.strokeDasharray = `${percentage}, 100`;
            });

            // Add fade-in animation for table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Add smooth scroll behavior
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</x-app>
