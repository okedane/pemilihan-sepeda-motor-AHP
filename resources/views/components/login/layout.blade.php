<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts-lts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Dec 2024 14:44:44 GMT -->

<head>

    <meta charset="utf-8" />
    <title>{{ str_replace('_', ' ', config('app.name')) }} | {{ $title }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico.png') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    <style>
        body {
            background-color: #E40521 !important;
            /* background merah */
        }

        .login-wrapper {
            background-color: #E40521 !important;
            /* full merah */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background-color: #d9d9d9;
            /* abu seperti gambar */
            padding: 40px;
            border-radius: 20px;
        }

        .title-app {
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-align: center;
            margin-bottom: 40px;
            line-height: 1.4;
        }
    </style>


</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            {{ $slot }}
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    <!-- password addon init -->
    <script src="{{ asset('assets/js/pages/pass-addon.init.js') }}"></script>

    <script>
        document.getElementById('password-confirmation-addon').addEventListener('click', function() {
            const input = document.getElementById('password_confirmation');
            if (input.type === 'password') {
                input.type = 'text';
                this.firstElementChild.classList.remove('mdi-eye-outline');
                this.firstElementChild.classList.add('mdi-eye-off-outline');
            } else {
                input.type = 'password';
                this.firstElementChild.classList.remove('mdi-eye-off-outline');
                this.firstElementChild.classList.add('mdi-eye-outline');
            }
        });
    </script>

    @if (session('success'))
        <script>
            Lobibox.notify('success', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                icon: 'bi bi-check2-circle',
                delayIndicator: false,
                position: 'top right',
                msg: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                icon: 'bi bi-x-circle',
                delayIndicator: false,
                position: 'top right',
                msg: "{{ session('error') }}"
            });
        </script>
    @endif

</body>


<!-- Mirrored from themesbrand.com/minia/layouts-lts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Dec 2024 14:44:44 GMT -->

</html>
