
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/admin/home" class="nav-link {{Request::is('/admin/home') ? 'active' : ''}}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/admin/pegawai" class="nav-link {{Request::is('admin/pegawai') ? 'active' : ''}}">
        <i class="nav-icon fa fa-users"></i>
        <p>
        Pegawai
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/admin/berkala" class="nav-link {{Request::is('admin/berkala') ? 'active' : ''}}">
        <i class="nav-icon fa fa-list"></i>
        <p>
        Berkala
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/admin/kepangkatan" class="nav-link {{Request::is('admin/kepangkatan') ? 'active' : ''}}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        Kepangkatan
        </p>
    </a>
    </li>
    
    <li class="nav-item">
    <a href="/admin/pmk" class="nav-link {{Request::is('admin/pmk') ? 'active' : ''}}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        PMK
        </p>
    </a>
    
    <li class="nav-item">
    <a href="/admin/satyalencana" class="nav-link {{Request::is('admin/satyalencana') ? 'active' : ''}}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        Satya Lencana
        </p>
    </a>
    
    <li class="nav-item">
    <a href="/admin/pensiun" class="nav-link {{Request::is('admin/pensiun') ? 'active' : ''}}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        Pensiun
        </p>
    </a>

    <li class="nav-item">
    <a href="/admin/gantipass" class="nav-link {{Request::is('admin/gantipass') ? 'active' : ''}}">
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