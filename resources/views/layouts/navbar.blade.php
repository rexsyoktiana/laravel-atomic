<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <div class="col-10">
        <h5 class="text-center pl-5">DOMPET REXSY OKTIANA</h5>
    </div>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user mr-1"></i>
                {{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Akun</span>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post" id="form-logout">
                    @csrf
                    <a class="dropdown-item" href="#logout"
                        onclick="document.getElementById('form-logout').submit();">
                        <i class="fas fa-user mr-2"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
