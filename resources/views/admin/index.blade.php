<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ str_replace('_', ' ', config('app.name')) }} | Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico.png') }}">

    <!-- Plugin CSS -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Preloader CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>
    :root {
        --honda-red: #CC0000;
        --honda-red-dark: #A60000;
        --honda-red-light: #FF3333;
        --honda-black: #1A1A1A;
        --honda-gray: #2D2D2D;
        --honda-silver: #C0C0C0;
        --honda-white: #FFFFFF;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .map-container {
        height: 400px;
        width: 100%;
        border: 2px solid #ddd;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .coordinates-display {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
    }

    .coordinate-value {
        font-weight: bold;
        color: #495057;
    }

    .location-buttons {
        margin-bottom: 20px;
    }

    .location-buttons .btn {
        margin-right: 10px;
        margin-bottom: 5px;
    }

    .radius-circle {
        fill-opacity: 0.2;
        stroke-width: 2;
    }

    .page-title-box {
        padding: 20px 0;
    }

    .breadcrumb {
        background: none;
        padding: 0;
    }

    /* Honda Theme Cards */
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(204, 0, 0, 0.15);
    }

    /* Welcome Card with Honda Red Theme */
    .welcome-card {
        background: linear-gradient(135deg, var(--honda-red) 0%, var(--honda-red-dark) 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 50%;
    }

    .welcome-card .card-body {
        position: relative;
        z-index: 1;
    }

    .welcome-card h5 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .welcome-card p {
        font-size: 1rem;
        line-height: 1.6;
        opacity: 0.95;
    }

    .welcome-card .fw-bold {
        color: #FFD700;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .welcome-image {
        position: relative;
        z-index: 2;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Chart Card */
    .chart-card {
        background: white;
        border-left: 5px solid var(--honda-red);
    }

    .chart-card .card-title {
        color: var(--honda-red);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 0;
    }

    .chart-controls {
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }

    .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        font-weight: 600;
        color: var(--honda-red);
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--honda-red);
        box-shadow: 0 0 0 0.2rem rgba(204, 0, 0, 0.15);
    }

    .table th {
        background: linear-gradient(135deg, var(--honda-red) 0%, var(--honda-red-dark) 100%);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
    }

    .btn-soft-primary {
        color: var(--honda-red);
        background-color: rgba(204, 0, 0, 0.1);
        border: 2px solid transparent;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-soft-primary:hover {
        background-color: var(--honda-red);
        color: white;
        border-color: var(--honda-red);
        transform: translateY(-2px);
    }

    .btn-soft-danger {
        color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
        border: 2px solid transparent;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-soft-danger:hover {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
        transform: translateY(-2px);
    }

    .marker-popup {
        font-size: 14px;
    }

    .current-location-marker {
        background-color: var(--honda-red);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 10px rgba(204, 0, 0, 0.5);
    }

    /* Badge Style */
    .badge-honda {
        background: linear-gradient(135deg, var(--honda-red) 0%, var(--honda-red-dark) 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(204, 0, 0, 0.3);
    }

    /* Stat Cards (if you want to add) */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid var(--honda-red);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-left-width: 8px;
        box-shadow: 0 8px 24px rgba(204, 0, 0, 0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--honda-red) 0%, var(--honda-red-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--honda-red);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--honda-red-dark);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .welcome-card h5 {
            font-size: 1.3rem;
        }

        .chart-controls {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .chart-controls .ms-auto {
            margin-top: 1rem;
            margin-left: 0 !important;
        }
    }
</style>

<body>
    <div id="layout-wrapper">
        <x-header></x-header>
        <x-sidebar></x-sidebar>

        <div class="main-content">
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="row">
                        <!-- Welcome Card -->
                        <div class="col-lg-12">
                            <div class="card welcome-card">
                                <div class="d-flex align-items-center row">
                                    <div class="col-sm-7">
                                        <div class="card-body py-4">
                                            <h5 class="card-title mb-3">
                                                Selamat Datang, {{ strtoupper(Auth::user()->name) }} 🏍️
                                            </h5>
                                            <p class="mb-0">
                                                Bersiaplah untuk mengelola <span class="fw-bold">Sistem Pendukung
                                                    Keputusan Pemilihan Sepeda Motor Honda</span>
                                                dengan lebih efisien hari ini. Mari wujudkan pengalaman terbaik untuk setiap pelanggan!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center">
                                        <div class="card-body pb-0 px-0 mb-2">
                                            <img src="assets/images/honda-bulat.png" height="130"
                                                alt="Honda Logo" class="welcome-image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart Card -->
                        <div class="col-md-12">
                            <div class="card chart-card">
                                <div class="card-body p-4">
                                    <div class="chart-container">
                                        <div class="chart-controls d-flex align-items-center gap-3 mb-4">
                                            <h4 class="card-title mb-0 flex-shrink-0">
                                                📊 Grafik Rekomendasi Sepeda Motor Honda
                                            </h4>
                                            <div class="ms-auto">
                                                <select id="tahun" class="form-select form-select-sm">
                                                    @foreach ($tahunList as $tahun)
                                                        <option value="{{ $tahun }}"
                                                            {{ $tahun == $tahunTerpilih ? 'selected' : '' }}>
                                                            Tahun {{ $tahun }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="line_chart_datalabel" data-colors='["#CC0000"]' class="apex-charts"
                                            dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>

            <x-footer></x-footer>
        </div>

        <x-toast></x-toast>

    </div>

    <x-right-sidebar></x-right-sidebar>

    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="assets/libs/pace-js/pace.min.js"></script>

    <!-- apexcharts js -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="assets/js/app.js"></script>

    <script>
        function getChartColorsArray(selector) {
            let colors = $(selector).attr("data-colors");
            colors = JSON.parse(colors);

            return colors.map(color => {
                color = color.replace(" ", "");
                if (color.indexOf("--") === -1) return color;

                const cssColor = getComputedStyle(document.documentElement)
                    .getPropertyValue(color);

                return cssColor || undefined;
            });
        }

        // Data dari controller
        const jumlahRekomendasi = @json(array_values($jumlahRekomendasi));
        const namaBulanChart = @json($namaBulanChart);

        let lineDatalabelColors = getChartColorsArray("#line_chart_datalabel");

        let options = {
            chart: {
                height: 400,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            colors: lineDatalabelColors,
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#CC0000'],
                    fontSize: '12px',
                    fontWeight: 'bold'
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    borderRadius: 4,
                    padding: 4,
                    opacity: 0.9,
                    borderWidth: 1,
                    borderColor: '#CC0000'
                }
            },
            stroke: {
                width: 4,
                curve: "smooth"
            },
            series: [{
                name: "Jumlah Rekomendasi",
                data: jumlahRekomendasi
            }],
            title: {
                text: "Tren Rekomendasi Pelanggan per Bulan",
                align: "left",
                style: {
                    fontWeight: "700",
                    fontSize: '16px',
                    color: '#1A1A1A'
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 10
                }
            },
            markers: {
                size: 6,
                colors: ['#CC0000'],
                strokeColors: '#fff',
                strokeWidth: 3,
                hover: {
                    size: 9,
                    sizeOffset: 3
                }
            },
            xaxis: {
                categories: namaBulanChart,
                title: {
                    text: "Bulan",
                    style: {
                        fontSize: '14px',
                        fontWeight: 600,
                        color: '#1A1A1A'
                    }
                },
                labels: {
                    style: {
                        colors: '#666',
                        fontSize: '12px',
                        fontWeight: 500
                    }
                }
            },
            yaxis: {
                title: {
                    text: "Jumlah Rekomendasi",
                    style: {
                        fontSize: '14px',
                        fontWeight: 600,
                        color: '#1A1A1A'
                    }
                },
                labels: {
                    style: {
                        colors: '#666',
                        fontSize: '12px'
                    }
                },
                min: 0
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                floating: false,
                offsetY: 0,
                offsetX: 0,
                fontSize: '14px',
                fontWeight: 600,
                markers: {
                    width: 12,
                    height: 12,
                    radius: 12
                }
            },
            tooltip: {
                theme: 'light',
                x: {
                    show: true
                },
                y: {
                    formatter: function(val) {
                        return val + " Rekomendasi"
                    }
                },
                style: {
                    fontSize: '13px'
                }
            },
            responsive: [{
                breakpoint: 768,
                options: {
                    chart: {
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    legend: {
                        position: 'bottom',
                        offsetY: 0
                    },
                    dataLabels: {
                        enabled: false
                    }
                }
            }]
        };

        let chart = new ApexCharts(
            document.querySelector("#line_chart_datalabel"),
            options
        );
        chart.render();

        // Ganti tahun, reload page dengan query tahun
        $('#tahun').on('change', function () {
            const tahun = $(this).val();
            window.location.href = '?tahun=' + tahun;
        });
    </script>

</body>

</html>
