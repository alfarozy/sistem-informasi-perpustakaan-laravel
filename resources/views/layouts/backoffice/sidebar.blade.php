<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion togled toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perpustakaan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    @if (Auth()->user()->level == 'anggota')

        <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku.cari') }}">
                <i class="fas fa-fw fa-search"></i>
                <span>Cari Buku</span></a>
        </li>
        <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku.riwayat') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Riwayat peminjaman</span></a>
        </li>
        <li class="nav-item {{ request()->is('profile*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.index') }}">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>Profil saya</span></a>
        </li>
    @elseif(Auth()->user()->level == 'pustakawan')
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ request()->is('anggota*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('anggota.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Kelola anggota</span></a>
        </li>
        <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Kelola buku</span></a>
        </li>
        <li class="nav-item {{ request()->is('peminjaman*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('peminjaman.index') }}">
                <i class="fas fa-fw fa-book-reader"></i>
                <span>Kelola peminjaman</span></a>
        </li>
        <li class="nav-item {{ request()->is('pengembalian*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengembalian.index') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Kelola pengembalian</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Laporan</h6>
                    <a class="collapse-item" href="{{ route('laporan.anggota') }}">Data anggota</a>
                    <a class="collapse-item" href="{{ route('laporan.buku') }}">Data buku</a>
                    <a class="collapse-item" href="{{ route('laporan.peminjaman') }}">Data peminjaman</a>
                    <a class="collapse-item" href="{{ route('laporan.pengembalian') }}">Data pengembalian</a>
                </div>
            </div>
        </li>
    @elseif(Auth()->user()->level == 'kepsek')
        <li class="nav-item {{ request()->is('laporan/data-anggota') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.anggota') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Laporan anggota</span></a>
        </li>
        <li class="nav-item {{ request()->is('laporan/data-buku') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.buku') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Laporan buku</span></a>
        </li>
        <li class="nav-item {{ request()->is('laporan/data-peminjaman') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.peminjaman') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Laporan peminjaman</span></a>
        </li>
        <li class="nav-item {{ request()->is('laporan/data-pengembalian') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan.pengembalian') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Laporan pengembalian</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
