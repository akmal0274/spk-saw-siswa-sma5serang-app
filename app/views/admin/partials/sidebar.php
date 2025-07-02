<?php
function is_active($controller, $method = '') {
    $currentController = App::$currentController ?: 'AdminDashboardController';
    $currentMethod = App::$currentMethod ?: 'index';
    $isActive = ($currentController == $controller . 'Controller');
    if ($method !== '') {
        $isActive = $isActive && ($currentMethod == $method);
    }
    return $isActive ? 'active' : '';
}
?>

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-center my-2">
        <img src="/spk-saw-siswa-sma5serang-app/public/assets/logo.png" alt="Logo Sekolah" style="max-width: 60px;">
        <div class="sidebar-brand-text mx-3 text-left">
            SPK Siswa Dengan SAW
        </div>
    </div>
    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= is_active('AdminDashboard') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminSiswa') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/siswa">
            <i class="fas fa-list"></i>
            <span>Kelola Siswa</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminKriteria') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/kriteria">
            <i class="fas fa-tags"></i>
            <span>Kelola Kriteria</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminSubkriteria') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/subkriteria">
            <i class="fas fa-certificate"></i>
            <span>Kelola Sub Kriteria</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminAlternatif') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/alternatif">
            <i class="fas fa-balance-scale"></i>
            <span>Input Penilaian</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminSaw') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/saw">
            <i class="fas fa-calculator"></i>
            <span>Proses SAW</span>
        </a>
    </li>

    <li class="nav-item <?= is_active('AdminRankingakhir') ?>">
        <a class="nav-link" href="/spk-saw-siswa-sma5serang-app/admin/rankingakhir">
            <i class="fas fa-medal"></i>
            <span>Lihat Hasil</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
