<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('home.logout') }}" class="dropdown-item"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <form id="logout-form" action="{{ route('home.logout') }}" method="POST" class="d-none">
                @csrf
                </form>
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title"><i class="fa fa-sign-out-alt"></i> Keluar</h3>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
