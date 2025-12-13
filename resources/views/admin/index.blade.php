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

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .btn-soft-primary {
        color: #556ee6;
        background-color: rgba(85, 110, 230, 0.1);
        border-color: transparent;
    }

    .btn-soft-danger {
        color: #f46a6a;
        background-color: rgba(244, 106, 106, 0.1);
        border-color: transparent;
    }

    .marker-popup {
        font-size: 14px;
    }

    .current-location-marker {
        background-color: #007bff;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-8">
                                        <div class="card-body mb-4 ">
                                            <h5 class="card-title">Selamat Datang {{ strtoupper(Auth::user()->name) }}
                                                🎉
                                            </h5>
                                            <p class="mb-0">
                                                Bersiaplah untuk mengelola <span class="fw-bold">Sistem Pendukung
                                                    Keputusan Pemilihan Sepeda Motor Honda</span>
                                                dengan lebih efisien hari ini
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0  mb-2">
                                            <img src="assets/images/honda-bulat.png" height="110"
                                                alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="icons/idea.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex gap-4">
                            <div class="card radius-10 w-100 position-relative">
                                <div class="card-body">
                                    <div class="chart-container">
                                        <div class="chart-controls d-flex align-items-center gap-3 mb-3">
                                            <h4 class="card-title mb-0 flex-shrink-0">Grafik Rekomendasi Sepeda Motor
                                                Honda</h4>
                                            <div class="ms-auto">
                                                <select id="tahun" class="form-select form-select-sm w-auto">
                                                    {{-- @foreach ($tahunList as $tahun)
                                                        <option value="{{ $tahun }}"
                                                            {{ $tahun == $tahunTerpilih ? 'selected' : '' }}>
                                                            {{ $tahun }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div id="line_chart_datalabel" data-colors='["#E40521"]' class="apex-charts"
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

        let lineDatalabelColors = getChartColorsArray("#line_chart_datalabel");

        let options = {
            chart: {
                height: 380,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            colors: lineDatalabelColors,
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 3,
                curve: "straight"
            },
            series: [{
                name: "Jumlah User",
                data: [26, 24, 32, 36, 33, 31, 33, 30, 28, 35, 34, 32]
            }],
            title: {
                text: "Jumlah User Melakukan Rekomendasi Sepeda Motor",
                align: "left",
                style: {
                    fontWeight: "500"
                }
            },
            grid: {
                row: {
                    colors: ["transparent", "transparent"],
                    opacity: 0.2
                },
                borderColor: "#f1f1f1"
            },
            markers: {
                style: "inverted",
                size: 0
            },
            xaxis: {
                categories: [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ],
                title: {
                    text: "Bulan"
                }
            },
            yaxis: {
                title: {
                    text: "Jumlah User"
                },
                min: 5,
                max: 40
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                floating: true,
                offsetY: -25,
                offsetX: -5
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        toolbar: {
                            show: false
                        }
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };

        let chart = new ApexCharts(
            document.querySelector("#line_chart_datalabel"),
            options
        );
        chart.render();
    </script>

</body>

</html>
