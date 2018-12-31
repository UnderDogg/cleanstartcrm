<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('backend.dashboard') }}">
        <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="89" height="25" alt="Logo">
        <img class="navbar-brand-minimized" src="{{ asset('img/favicon-cube.png') }}" width="30" height="30" alt="Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('frontend.index') }}" target="_blank"> {{ app_name() }} </a>
        </li>
    </ul>

    <nav class="navbar navbar-dark bg-primary justify-content-between ">
        <!-- Navbar content -->
        <ul class="horizontal-navbar navbar-nav mr-auto mt-lg-0">
            @include('backend.includes.custom-menu-items', ['items' => $MyNavBar->roots()])
        </ul>
    </nav><!--/nav-->

    <ul class="nav navbar-nav ml-auto mr-5">
        <li class="nav-item d-md-down-none mr-5">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        <li class="nav-item dropdown mr-5">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset(auth()->user()->avatar) }}" class="img-avatar" alt="{{ auth()->user()->name }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-at"></i> {{ Auth::user()->email }}
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-comments"></i> Comments
                    <span class="badge badge-warning">42</span>
                </a>
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                    <i class="fas fa-lock"></i> Logout
                </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>