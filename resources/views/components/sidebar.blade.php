<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu </li>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('alternatif.index') }}" class="waves-effect">
                                <i data-feather="layers"></i>
                                <span data-key="t-dashboard">Alternatif</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kriteria.index') }}" class="waves-effect">
                                <i data-feather="sliders"></i>
                                <span data-key="t-dashboard">Kriteria</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hasil.index') }}" class="waves-effect">
                                <i data-feather="bar-chart-2"></i>
                                <span data-key="t-dashboard">Hasil Perhitungan</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-dashboard">Manajemen Akun</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('akun.admin') }}">Admin</a></li>
                                <li><a href="{{ route('akun.user') }}">User</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->role === 'user')
                        <li>
                            <a href="{{ route('welcome') }}" class="waves-effect">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('inputData') }}" class="waves-effect">
                                <i data-feather="database"></i>
                                <span data-key="t-input-data">Input Data</span>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('history') }}" class="waves-effect">
                                <i data-feather="clock"></i>
                                <span data-key="t-history">Riwayat</span>
                            </a>
                        </li>
                    @endif
                @endauth

            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
