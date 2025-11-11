<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?php echo ($page == "dashboard")? 'active' : '';  ?>" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Manajemen</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Data Buku
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Daftar Buku</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Tambah Buku</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    Kategori
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Daftar Kategori</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Tambah Kategori</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#colapsAnggota" aria-expanded="false" aria-controls="colapsAnggota">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Anggota
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="colapsAnggota" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Daftar Anggota</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Tambah Anggota</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Peminjaman</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Transaksi</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#colapsPeminjaman" aria-expanded="false" aria-controls="colapsPeminjaman">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Peminjaman
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="colapsPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Daftar Peminjaman</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Tambah Peminjaman</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#colapsPengembalian" aria-expanded="false" aria-controls="colapsPengembalian">
                    <div class="sb-nav-link-icon"><i class="fas fa-industry"></i></div>
                    Pengembalian
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="colapsPengembalian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Konfirmasi</a>
                    </nav>
                </div>
                <a class="nav-link" href="logout.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                    Logout
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php echo $_SESSION['admin_nama_lengkap'] ?>
        </div>
    </nav>
</div>
