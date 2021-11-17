
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
        <li class="nav-item">
        <a href="/kepangkatan/berkala" class="nav-link {{Request::is('kepangkatan/berkala') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Berkala <span class="right badge badge-danger">{{berkalaBaru()}}</span>
            </p>
        </a>
        </li>
        
        <li class="nav-item">
        <a href="/kepangkatan/pangkat" class="nav-link {{Request::is('kepangkatan/pangkat') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Kepangkatan
            </p>
        </a>
        </li>
        {{-- <li class="nav-item">
        <a href="/kepangkatan/pmk" class="nav-link {{Request::is('kepangkatan/pmk') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            PMK
            </p>
        </a>
        </li> --}}
        
        {{-- <li class="nav-item">
        <a href="/kepangkatan/laporan" class="nav-link {{Request::is('kepangkatan/laporan') ? 'active' : ''}}">
            <i class="nav-icon fas fa-file"></i>
            <p>
            Laporan
            </p>
        </a>
        </li> --}}
        
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