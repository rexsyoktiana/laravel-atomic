<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('download') }}/images/logo.png" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ATOMIC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ $menu == 'Master' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $menu == 'Master' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('master.dompet') }}"
                                class="nav-link {{ $submenu == 'Dompet' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dompet</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('master.kategori') }}"
                                class="nav-link {{ $submenu == 'Kategori' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $menu == 'Transaksi' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $menu == 'Transaksi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaksi.dompet.masuk') }}"
                                class="nav-link {{ $submenu == 'Dompet Masuk' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dompet Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaksi.dompet.keluar') }}"
                                class="nav-link {{ $submenu == 'Dompet Keluar' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dompet Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $menu == 'Laporan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $menu == 'Laporan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.transaksi') }}"
                                class="nav-link {{ $submenu == 'Laporan Transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
