<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <i class="far fa-user"></i><a href="index.html">Welcome,{{ Auth::user()->level }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">TMB</a>
        </div>
        <ul class="sidebar-menu">

            @if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'admin')
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('dashboard.index') }}"> <span>Dashboard</span><i
                            class="fas fa-tachometer-alt"></i></a></li>
            @endif

            @if (Auth::user()->level == 'sales')
                <li class="{{ request()->is('dashboardsales') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('dashboardsales.index') }}"> <span>Dashboard</span><i
                            class="fas fa-tachometer-alt"></i></a></li>
            @endif

            @if (Auth::user()->level == 'accounting' || Auth::user()->level == 'gudang')
                <li class="{{ request()->is('dashboardkar') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('dashboardkar.index') }}"> <span>Dashboard</span><i
                            class="fas fa-tachometer-alt"></i></a></li>
            @endif

            @if (Auth::user()->level == 'superadmin')
                <li class="{{ request()->is('user') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('user.index') }}"><span>Data User</span><i class="fas fa-user-plus"></i></a>
                </li>
                <li class="{{ request()->is('penggajian') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('penggajian.index') }}"><span>Data Penggajian</span><i
                            class="fas fa-money-bill-alt"></i></a></li>
            @endif

            @if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'admin')
                <li class="{{ request()->is('karyawan') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('karyawan.index') }}"><span>Data Karyawan</span><i class="fas fa-users"></i>
                    </a></li>
                <li class="{{ request()->is('absensi') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('absensi.index') }}"><span>Data Absensi</span><i
                            class="far fa-calendar-check"></i></a></li>
            @endif

            @if (Auth::user()->level == 'superadmin')
                <li class="{{ request()->is('komisi') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('komisi.index') }}"><span>Data Komisi</span><i
                            class="fas fa-briefcase"></i></a></li>
            @endif

            @if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'admin')
                <li class="{{ request()->is('transaksi') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('transaksi.index') }}"><span>Data Trans. Penjualan</span><i
                            class="far fa-square"></i> </a></li>
            @endif


            @if (Auth::user()->level == 'superadmin')
                {{-- <li class="active"><a class="nav-link" href="/user"> <span>Laporan</span><i class="far fa-file-alt"></i></a></li> --}}
                <li class=" nav-item dropdown">
                    <a href="/user" class="nav-link has-dropdown" data-toggle="dropdown"> <span>Laporan</span><i
                            class="far fa-file-alt"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('filter-laporan-gaji') }}">Perincian
                                Penggajian</a></li>
                        <li><a class="nav-link" href="{{ route('filter-laporan-komisi') }}">Laporan Perincian
                                Komisi</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->level == 'sales')
                <li class=" nav-item dropdown">
                    <a href="/user" class="nav-link has-dropdown" data-toggle="dropdown"> <span>Laporan</span><i
                            class="far fa-file-alt"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('index-slip-gaji-pribadii') }}">Perincian
                                Penggajian</a></li>
                        <li><a class="nav-link" href="{{ route('index-slip-komisi-pribadii') }}">Laporan
                                Perincian
                                Komisi</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->level == 'accounting' || Auth::user()->level == 'gudang')
                {{-- <li class="active"><a class="nav-link" href="/user"> <span>Laporan</span><i class="far fa-file-alt"></i></a></li> --}}
                <li class=" nav-item dropdown">
                    <a href="/user" class="nav-link has-dropdown" data-toggle="dropdown"> <span>Laporan</span><i
                            class="far fa-file-alt"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('index-slip-gaji-pribadii') }}">Perincian
                                Penggajian</a></li>

                    </ul>
                </li>
            @endif




    </aside>
</div>
