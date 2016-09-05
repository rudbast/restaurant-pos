<li class="active">
    <a href="#">
        <i class="fa fa-th-large"></i>
        <span class="nav-label">Administrasi</span>
    </a>
    <ul class="nav nav-second-level">
        <li class="{{ $page == 'overview' ? 'active' : '' }}">
            <a href="{{ '' }}">Tinjauan Umum</a>
        </li>
        <li class="{{ $page == 'man-user' ? 'active' : '' }}">
            <a href="{{ '' }}">Pengaturan Pengguna</a>
        </li>
        <li class="{{ $page == 'sales' ? 'active' : '' }}">
            <a href="{{ '' }}">Laporan Penjualan</a>
        </li>
    </ul>
</li>

