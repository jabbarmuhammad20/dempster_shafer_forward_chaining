<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('image/profile.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->type === 'admin')
                <li class="nav-item">
                    <a href="{{ route('home.pasien.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pasien</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('home.gejala.*') || Route::is('home.penyakit.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('home.gejala.*') || Route::is('home.penyakit.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Penyimpangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.gejala.index') }}" class="nav-link {{ Route::is('home.gejala.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gejala</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.penyakit.index') }}" class="nav-link {{ Route::is('home.penyakit.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penyakit</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->type === 'user')
                <li class="nav-item">
                    <a href="{{ route('home.biodata.index', Auth::user()->id) }}" class="nav-link {{ request()->is('biodata') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Biodata</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home.kuisioner.index') }}" class="nav-link {{ request()->is('kuisioner') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>Kuisioner</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
