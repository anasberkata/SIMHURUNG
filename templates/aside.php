<?php

$current_page = basename($_SERVER['REQUEST_URI'], ".php");

function isActive($page)
{
    global $current_page;
    return $current_page === $page ? 'active' : '';
}
?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <span class="align-middle">SIMHURUNG</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Dashboard
            </li>

            <li class="sidebar-item <?= isActive('index') ?>">
                <a class="sidebar-link" href="../view_admin/index.php">

                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Menu
            </li>

            <li class="sidebar-item <?= isActive('layanan') ?>">

                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Data Tabel</span>
                </a>
            </li>

            <li class="sidebar-item <?= isActive('barang') ?>">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="key"></i> <span class="align-middle">Akses</span>
                </a>
            </li>
            <li class="sidebar-item <?= isActive('aset') ?>">
                <a class="sidebar-link" href="../view_live/index.php">
                    <i class="align-middle" data-feather="video"></i> <span class="align-middle">Live
                        Monitoring</span>
                </a>
            </li>

            <li class="sidebar-item <?= isActive('pengguna') ?>">
                <a class="sidebar-link" href="../view_pengguna/pengguna.php">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Pengguna</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">

                <div class="d-grid">
                    <a href="../logout.php" class="btn btn-primary"
                        onclick="return confirm('Yakin ingin keluar dari aplikasi?');">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>