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
                            <a href="/dashboard" class="waves-effect">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kriteria.index') }}" class="waves-effect">
                                <i data-feather="cpu"></i>
                                <span data-key="t-dashboard">Kriteria</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('alternatif.index') }}" class="waves-effect">
                                <i data-feather="cpu"></i>
                                <span data-key="t-dashboard">Alternatif</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-dashboard">Manajemen Akun</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.admin') }}">Admin</a></li>
                                <li><a href="{{ route('admin.user') }}">User</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->role === 'petani')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="activity"></i>
                                <span data-key="t-dashboard">Gejala</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('petani.input.gejala') }}">
                                        <i data-feather="alert-circle"></i>
                                        <span>Hama</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('petani.input.gejala.penyakit') }}">
                                        <i data-feather="alert-triangle"></i>
                                        <span>Penyakit</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="clock"></i>
                                <span data-key="t-dashboard">Riwayat</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('histori.hama') }}">
                                        <i data-feather="clock"></i>
                                        <span>Riwayat Hama</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('diagnosis.index') }}">
                                        <i data-feather="clock"></i>
                                        <span>Riwayat Penyakit</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth

            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
