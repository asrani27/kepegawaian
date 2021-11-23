
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="/pensiun/home" class="nav-link {{Request::is('pensiun/home') ? 'active' : ''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
            Beranda
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="/pensiun/satyalencana" class="nav-link {{Request::is('pensiun/satyalencana') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Satya Lencana <span class="right badge badge-danger"></span>
            </p>
        </a>
        </li>
        
        <li class="nav-item">
        <a href="/pensiun/pensiun" class="nav-link {{Request::is('pensiun/pensiun') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Pensiun
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
        <a href="/pensiun/gantipass" class="nav-link {{Request::is('pensiun/gantipass') ? 'active' : ''}}">
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