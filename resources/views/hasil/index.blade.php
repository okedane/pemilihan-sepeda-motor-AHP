<x-app>
    <x-slot:title>Riwayat Hasil Perhitungan</x-slot:title>

    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-1 font-size-18 fw-bold">
                                <i class="fas fa-history text-danger me-2"></i>Riwayat Hasil Perhitungan AHP
                            </h4>
                            <p class="text-muted mb-0 small">Monitoring semua analisis pemilihan motor dari seluruh
                                pengguna</p>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Riwayat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Success -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm card-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-danger bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-danger">
                                            <i class="fas fa-calculator font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Total Perhitungan</p>
                                    <h4 class="mb-0 fw-bold">{{ $histories->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm card-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-primary">
                                            <i class="fas fa-users font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Total User</p>
                                    <h4 class="mb-0 fw-bold">{{ $histories->unique('user_id')->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm card-hover">
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
                                    <p class="text-muted mb-1 small">Motor Terpopuler</p>
                                    <h6 class="mb-0 fw-bold text-truncate">
                                        {{ $histories->first()?->alternatif->nama ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm card-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-info bg-opacity-10">
                                        <span class="avatar-title rounded-circle text-info">
                                            <i class="fas fa-calendar-check font-size-20"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1 small">Hari Ini</p>
                                    <h4 class="mb-0 fw-bold">
                                        {{ $histories->where('created_at', '>=', today())->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table - Group by User dengan Expand -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-4 pb-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0 fw-bold">
                                        <i class="fas fa-table text-danger me-2"></i>Data User & Riwayat Analisis
                                    </h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('admin.export.history.pdf') }}"
                                        class="btn btn-danger btn-sm me-2">
                                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-file-excel me-1"></i>Export Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @php
                                $groupedByUser = $histories->groupBy('user_id');
                            @endphp

                            @forelse ($groupedByUser as $userId => $userHistories)
                                @php
                                    $user = $userHistories->first()->user;
                                @endphp

                                <!-- User Header (Clickable) -->
                                <div class="user-header border-bottom p-3 cursor-pointer"
                                    onclick="toggleUserDetails({{ $userId }})"
                                    style="transition: background-color 0.2s;">
                                    <div class="row align-items-center">
                                        <div class="col-md-1 text-center">
                                            <span class="badge badge-soft-secondary rounded-pill fs-6">
                                                {{ $loop->iteration }}
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <div class="avatar-title rounded-circle bg-primary bg-opacity-10">
                                                        <i class="fas fa-user text-primary font-size-20"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark mb-1">{{ $user->name ?? '-' }}</div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i>{{ $user->email ?? '-' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <span class="badge bg-danger-subtle text-danger fs-6 fw-bold px-3 py-2">
                                                <i class="fas fa-chart-bar me-1"></i>{{ $userHistories->count() }}
                                                Analisis
                                            </span>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>
                                                {{ $userHistories->sortByDesc('created_at')->first()->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div class="col-md-1 text-end">
                                            <i class="fas fa-chevron-down text-muted expand-icon"
                                                id="icon-{{ $userId }}"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- User Details (Hidden by default) -->
                                <div class="user-details bg-light" id="details-{{ $userId }}"
                                    style="display: none;">
                                    <div class="p-4">
                                        <!-- Statistics Row -->
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <div class="card border-0 bg-white">
                                                    <div class="card-body text-center p-3">
                                                        <i class="fas fa-trophy text-danger mb-2"
                                                            style="font-size: 1.5rem;"></i>
                                                        <h6 class="fw-bold mb-1 small">Motor Favorit</h6>
                                                        <p class="mb-0 text-dark fw-semibold small">
                                                            {{ $userHistories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first() ? $userHistories->firstWhere('alternatif_id', $userHistories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first())->alternatif->nama : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-0 bg-white">
                                                    <div class="card-body text-center p-3">
                                                        <i class="fas fa-star text-success mb-2"
                                                            style="font-size: 1.5rem;"></i>
                                                        <h6 class="fw-bold mb-1 small">Skor Tertinggi</h6>
                                                        <p class="mb-0 text-dark fw-semibold small">
                                                            {{ number_format($userHistories->max('skor'), 3) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card border-0 bg-white">
                                                    <div class="card-body text-center p-3">
                                                        <i class="fas fa-chart-line text-info mb-2"
                                                            style="font-size: 1.5rem;"></i>
                                                        <h6 class="fw-bold mb-1 small">Rata-rata Skor</h6>
                                                        <p class="mb-0 text-dark fw-semibold small">
                                                            {{ number_format($userHistories->avg('skor'), 3) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- History Table -->
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-list text-danger me-2"></i>Detail Riwayat Analisis
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover bg-white mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="px-3 py-2" style="width: 50px;">No</th>
                                                        <th class="px-3 py-2">Tanggal & Waktu</th>
                                                        <th class="px-3 py-2">Motor Rekomendasi</th>
                                                        <th class="px-3 py-2 text-center" style="width: 120px;">Skor
                                                            AHP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($userHistories->sortByDesc('created_at') as $history)
                                                        <tr>
                                                            <td class="px-3 py-2 text-center">
                                                                <span
                                                                    class="badge bg-secondary">{{ $loop->iteration }}</span>
                                                            </td>
                                                            <td class="px-3 py-2">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="far fa-calendar text-muted me-2"></i>
                                                                    <div>
                                                                        <div class="fw-medium small">
                                                                            {{ $history->created_at->format('d M Y') }}
                                                                        </div>
                                                                        <small class="text-muted"
                                                                            style="font-size: 0.75rem;">{{ $history->created_at->format('H:i') }}
                                                                            WIB</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-3 py-2">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-xs me-2">
                                                                        <div
                                                                            class="avatar-title rounded-circle bg-danger bg-opacity-10">
                                                                            <i
                                                                                class="fas fa-motorcycle text-danger"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="fw-semibold text-dark small">
                                                                            {{ $history->alternatif->nama ?? '-' }}
                                                                        </div>
                                                                        <small class="text-muted"
                                                                            style="font-size: 0.7rem;">Motor
                                                                            Honda</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-3 py-2 text-center">
                                                                <span class="badge bg-danger text-white fw-bold">
                                                                    {{ number_format($history->skor, 3) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="text-muted">Belum Ada Riwayat Perhitungan</h5>
                                    <p class="text-muted mb-0">Data riwayat akan muncul setelah user melakukan analisis
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-content {
            background-color: #f8f9fa;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(204, 0, 0, 0.15) !important;
        }

        .user-header {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .user-header:hover {
            background-color: rgba(204, 0, 0, 0.02);
        }

        .user-details {
            border-top: 2px solid #e9ecef;
        }

        .expand-icon {
            transition: transform 0.3s ease;
        }

        .expand-icon.rotated {
            transform: rotate(180deg);
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .avatar-sm {
            height: 3rem;
            width: 3rem;
        }

        .avatar-xs {
            height: 2rem;
            width: 2rem;
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

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .font-size-18 {
            font-size: 1.125rem;
        }

        .font-size-20 {
            font-size: 1.25rem;
        }

        .card {
            border-radius: 0.5rem;
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
                padding: 0.25rem 0.5rem;
            }

            .user-header .row>div {
                margin-bottom: 0.5rem;
            }
        }

        @media print {

            .btn,
            .page-title-right,
            .card-header .text-end,
            .expand-icon {
                display: none !important;
            }

            .user-details {
                display: block !important;
            }

            .card {
                box-shadow: none !important;
            }

            .page-content {
                background-color: white;
            }
        }
    </style>

    <script>
        function toggleUserDetails(userId) {
            const details = document.getElementById('details-' + userId);
            const icon = document.getElementById('icon-' + userId);

            if (details.style.display === 'none' || details.style.display === '') {
                // Show details with animation
                details.style.display = 'block';
                icon.classList.add('rotated');

                // Animate the expansion
                details.style.opacity = '0';
                details.style.maxHeight = '0';
                setTimeout(() => {
                    details.style.transition = 'all 0.3s ease';
                    details.style.opacity = '1';
                    details.style.maxHeight = '2000px';
                }, 10);
            } else {
                // Hide details with animation
                details.style.transition = 'all 0.3s ease';
                details.style.opacity = '0';
                details.style.maxHeight = '0';
                icon.classList.remove('rotated');

                setTimeout(() => {
                    details.style.display = 'none';
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Auto dismiss alerts
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Animate user headers on load
            const userHeaders = document.querySelectorAll('.user-header');
            userHeaders.forEach((header, index) => {
                header.style.opacity = '0';
                header.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    header.style.transition = 'all 0.3s ease';
                    header.style.opacity = '1';
                    header.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</x-app>
