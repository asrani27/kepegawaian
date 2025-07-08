<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/pegawai/home" class="nav-link {{ Request::is('pegawai/home*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/pegawai/biodata" class="nav-link {{ Request::is('pegawai/biodata*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Biodata
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="/pegawai/upload" class="nav-link {{ Request::is('pegawai/upload*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Upload
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>