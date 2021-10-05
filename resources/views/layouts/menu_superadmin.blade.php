
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/superadmin/home" class="nav-link {{ Request::is('superadmin/home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    {{-- <li class="nav-item">
    <a href="/superadmin/profil" class="nav-link {{ Request::is('superadmin/profil*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Profil
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/skpd" class="nav-link {{ Request::is('superadmin/skpd*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-university"></i>
        <p>
        SKPD
        </p>
    </a>
    </li> --}}
    <li class="nav-item">
    <a href="/superadmin/pegawai" class="nav-link {{ Request::is('superadmin/pegawai*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Pegawai
        </p>
    </a>
    </li>
    
    <li class="nav-item">
    <a href="/superadmin/persyaratan" class="nav-link {{ Request::is('superadmin/persyaratan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Persyaratan
        </p>
    </a>
    </li>
    
    <li class="nav-item">
    <a href="/superadmin/layanan/" class="nav-link {{ Request::is('superadmin/layanan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Layanan
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