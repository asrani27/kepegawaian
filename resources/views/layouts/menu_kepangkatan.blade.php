<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/kepangkatan/home" class="nav-link {{Request::is('kepangkatan/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="/kepangkatan/berkala" class="nav-link {{Request::is('kepangkatan/berkala') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Berkala <span class="right badge badge-danger">{{berkalaBaru()}}</span>
                </p>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="/kepangkatan/pangkat" class="nav-link {{Request::is('kepangkatan/pangkat') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Kepangkatan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/kepangkatan/jenis_kenaikan"
                class="nav-link {{Request::is('kepangkatan/jenis_kenaikan') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Layanan Kenaikan Pangkat
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/kepangkatan/persyaratan"
                class="nav-link {{Request::is('kepangkatan/persyaratan') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Persyaratan
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/periode" class="nav-link {{Request::is('periode') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Periode
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="/kepangkatan/gantipass" class="nav-link {{Request::is('kepangkatan/gantipass') ? 'active' : ''}}">
                <i class="nav-icon fas fa-key"></i>
                <p>
                    Ganti Password
                </p>
            </a>
        </li>
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