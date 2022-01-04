<!-- Content Row -->
<div class="row">

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5  font-weight-bold text-danger text-uppercase mb-1">
                            Users
                        </div>
                        <div class="h5 mb-3 text-gray-800">
                            <?= $total_users; ?>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/users'); ?>" class="text-danger">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5  font-weight-bold text-warning text-uppercase mb-1">
                            Kelas
                        </div>
                        <div class="h5 mb-3 text-gray-800">
                            <?= $total_kelas; ?>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/kelas'); ?>" class="text-warning">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5  font-weight-bold text-success text-uppercase mb-1">
                            Avatar
                        </div>
                        <div class="h5 mb-3 text-gray-800">
                            <?= $total_avatar; ?>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/avatar'); ?>" class="text-success">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-image fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5  font-weight-bold text-primary text-uppercase mb-1">
                            Tema
                        </div>
                        <div class="h5 mb-3 text-gray-800">
                            <?= $total_tema; ?>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/tema'); ?>" class="text-primary">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-images fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5  font-weight-bold text-info text-uppercase mb-1">
                            Laporan
                        </div>
                        <div class="h5 mb-3 text-gray-800">
                            <?= $total_laporan; ?>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/laporan'); ?>" class="text-info">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->