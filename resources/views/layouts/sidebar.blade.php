<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-small-cap">--- DASHBOARD</li>
        <li>
            <a class="waves-effect waves-dark" href="/dashboard" aria-expanded="false">
                <i class="icon-speedometer"></i>
                <span class="hide-menu">Home</span>
            </a>
        </li>
        @if (auth()->user()->level == 'saksi')
            <li>
                <a class="waves-effect waves-dark" href="/input-suara-saksi" aria-expanded="false">
                    <i class="ti-layout-grid2"></i>
                    <span class="hide-menu">Suara</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->level == 'admin')
            <li>
                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="ti-layout-grid2"></i>
                    <span class="hide-menu">Suara</span>
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li>
                        <a href="/perhitungan-suara">Perhitungan Suara</a>
                    </li>
                    <li>
                        <a href="/input-suara">Input Suara</a>
                    </li>
                </ul>
            </li>
            <li class="nav-small-cap">--- MASTER DATA</li>
            <li>
                <a class="waves-effect waves-dark" href="/paslon" aria-expanded="false">
                    <i class="icons-Doctor"></i>
                    <span class="hide-menu">Paslon</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="/saksi" aria-expanded="false">
                    <i class="icons-Add-File"></i>
                    <span class="hide-menu">Saksi</span>
                </a>
            </li>
            <li>
                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="ti-layout-grid2"></i>
                    <span class="hide-menu">TPS</span>
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li>
                        <a href="/tps">Generate TPS</a>
                    </li>
                    <li>
                        <a href="/tps-list">List TPS</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="/kabupaten_kota" aria-expanded="false">
                    <i class="icons-User"></i>
                    <span class="hide-menu">Kabupaten Kota</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="/kecamatan" aria-expanded="false">
                    <i class="icons-User"></i>
                    <span class="hide-menu">Kecamatan</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="/desa_kelurahan" aria-expanded="false">
                    <i class="icons-User"></i>
                    <span class="hide-menu">Desa Kelurahan</span>
                </a>
            </li>
        @endif
        <li class="nav-small-cap">--- PENGATURAN</li>
        @if (auth()->user()->level == 'admin')
            <li>
                <a class="waves-effect waves-dark" href="/pengaturan" aria-expanded="false">
                    <i class="icons-Heart"></i>
                    <span class="hide-menu">Pengaturan</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="/pengguna" aria-expanded="false">
                    <i class="icons-Heart"></i>
                    <span class="hide-menu">Pengguna</span>
                </a>
            </li>
        @endif
        <li>
            <a class="waves-effect waves-dark" href="/logout" aria-expanded="false">
                <i class="fas fa-sign-out-alt"></i>
                <span class="hide-menu">Keluar</span>
            </a>
        </li>
    </ul>
</nav>
