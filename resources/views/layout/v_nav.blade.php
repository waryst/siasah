<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="{{ url('profil/' . auth()->user()->id) }}"
                class="nav-link  {{ request()->is('profil/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Data Sekolah
                </p>
            </a>
        </li>
        <li class="nav-item menu-open">
            <a href=""
                class="nav-link {{ request()->is('laporan') ? 'active' : '' }} {{ request()->is('datalaporan') ? 'active' : '' }}{{ request()->is('cetaklaporan') ? 'active' : '' }}">
                <i class="nav-icon fas fa-keyboard"></i>
                <p>
                    Entry Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ url('laporan') }}" class="nav-link">
                        <i class="far fa-edit nav-icon"></i>
                        <p>Pengajuan Laporan </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('datalaporan') }}" class="nav-link">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Data Laporan </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('cetaklaporan') }}" class="nav-link">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Catak Surat </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
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
