
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="/karpeg/home" class="nav-link {{Request::is('karpeg/home') ? 'active' : ''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
            Beranda
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="/karpeg/karpeg" class="nav-link {{Request::is('karpeg/karpeg*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Karpeg
            </p>
        </a>
        </li>
        
        <li class="nav-item">
        <a href="/karpeg/karsu" class="nav-link {{Request::is('karpeg/karsu*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Karsu
            </p>
        </a>
        </li>
        
        <li class="nav-item">
        <a href="/karpeg/karis" class="nav-link {{Request::is('karpeg/karis*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-list"></i>
            <p>
            Karis
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
        <a href="/karpeg/gantipass" class="nav-link {{Request::is('karpeg/gantipass') ? 'active' : ''}}">
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