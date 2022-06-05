<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/kepegawaian/home" class="nav-link {{Request::is('kepegawaian/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('kepegawaian/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('kepegawaian/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Data
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/kepegawaian/data/agama"
                        class="nav-link {{Request::is('kepegawaian/data/agama') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Agama</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/eselon"
                        class="nav-link {{Request::is('kepegawaian/data/eselon') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Eselon</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/gender"
                        class="nav-link {{Request::is('kepegawaian/data/gender') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Gender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/goldarah"
                        class="nav-link {{Request::is('kepegawaian/data/goldarah') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Golongan Darah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/jabatan"
                        class="nav-link {{Request::is('kepegawaian/data/jabatan') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jabatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/jenis"
                        class="nav-link {{Request::is('kepegawaian/data/jenis') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jenis</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/kepegawaian/gantipass" class="nav-link {{Request::is('kepegawaian/gantipass') ? 'active' : ''}}">
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