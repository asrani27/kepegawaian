<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/disiplin/home" class="nav-link {{Request::is('karpeg/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/disiplin/kategori" class="nav-link {{Request::is('karpeg/karpeg*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Kategori Hukuman
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/disiplin/jenis-hukuman" class="nav-link {{Request::is('karpeg/karsu*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Jenis Hukuman
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/disiplin/hukuman" class="nav-link {{Request::is('karpeg/karis*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Hukuman Disiplin
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/disiplin/gantipass" class="nav-link {{Request::is('karpeg/gantipass') ? 'active' : ''}}">
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