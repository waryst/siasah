<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">

        <li class="nav-item menu-open">
            <a href=""
                class="nav-link {{ request()->is('verifikasi') ? 'active' : '' }} {{ request()->is('dataverifikasi') ? 'active' : '' }}{{ request()->is('sekolah') ? 'active' : '' }}">
                <i class="nav-icon fas fa-keyboard"></i>
                <p>
                    Menu Administrator
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('verifikasi') }}" class="nav-link">
                        <i class="far fa-edit"></i>
                        <p>Verifikasi Berkas </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dataverifikasi') }}" class="nav-link">
                        <i class="fas fa-database"></i>
                        <p>Data Laporan Terverifikasi </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('sekolah') }}" class="nav-link">
                        <i class="fas fa-server"></i>
                        <p>Data Sekolah </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link  {{ request()->is('password') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    User
                    <i class="right fas fa-angle-left nav-icon"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.password.edit') }}" class="nav-link">
                        <i class="fas fa-key"></i>
                        <p>Ganti Password</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="fas fa-sign-out-alt"> </i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</nav>
