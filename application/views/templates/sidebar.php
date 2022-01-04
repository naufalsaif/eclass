<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('users'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KELAS<sup>KU</sup></div>
    </a>

    <?php if ($this->session->userdata('role') == 'admin') : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= ($this->uri->segment(1, 0) == 'admin' ? 'active' : '') ?>">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-chart-pie"></i>
                <span>Dashboard</span></a>
        </li>
    <?php endif; ?>


    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($this->uri->segment(1, 0) == 'users' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= base_url('users'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($this->uri->segment(1, 0) == 'kelas' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= base_url('kelas'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelas</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($this->uri->segment(1, 0) == 'pengaturan' ? 'active' : '') ?>">
        <a class="nav-link" href="<?= base_url('pengaturan'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0 mt-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->