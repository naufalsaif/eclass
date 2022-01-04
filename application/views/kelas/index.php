<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">
        <form class="form-inline" action="<?= base_url('kelas/gabung'); ?>" method="POST">
            <div class="form-group mb-2">
                <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Masukkan kode kelas">
            </div>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <button type="submit" class="btn btn-primary ml-3 mb-2">Gabung</button>
        </form>
    </h1>
    <hr class="d-sm-none">
    </hr>
    <h1 class="d-sm-inline-block">
        <a href="<?= base_url('kelas/buat_kelas'); ?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Buat Kelas</span>
        </a>
    </h1>
</div>

<hr class="d-none d-lg-block d-md-block d-xl-block">

<div class="row">
    <div class="col-12">
        <h1 class="h4 mb-0 text-gray-800">Daftar Kelas</h1>
    </div>
</div>


<div class="row mb-5">


    <?php foreach ($kelas as $k) : ?>

        <?php if ($k['status'] == 'aktif') : ?>
            <div class="col-xl-3 col-md-6 mt-4">
                <div class="card border-bottom-primary shadow h-100">
                    <img src="<?= base_url('layout/img/tema/') . $k['url']; ?>" class="card-img-top img-fluid" alt="<?= $k['nama_tema']; ?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="card-title"><strong><?= $k['nama_kelas']; ?></strong></h5>
                                <p class="card-text mb-0"><strong>Kode kelas</strong>: <?= $k['kode_kelas']; ?></p>
                                <p class="card-text"><strong>Deskripsi</strong>: <?= substr_card($k['deskripsi']); ?></p>
                                <p class="card-text"><small class="text-muted"><strong>Dibuat</strong>: <?= date('Y-m-d', $k['tanggal_buat']);  ?></small></p>
                                <a href="<?= base_url('kelas/r') . '?kk=' . $k['kode_kelas']; ?>" class="text-primary">Masuk &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($k['status'] == 'proses') : ?>
            <div class="col-xl-3 col-md-6 mt-4">
                <div class="card border-bottom-primary shadow h-100">
                    <img src="<?= base_url('layout/img/tema/') . $k['url']; ?>" class="card-img-top img-fluid" alt="<?= $k['nama_tema']; ?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="card-title"><strong><?= $k['nama_kelas']; ?></strong></h5>
                                <p class="card-text mb-0"><strong>Kode kelas</strong>: <?= $k['kode_kelas']; ?></p>
                                <p class="card-text"><strong>Deskripsi</strong>: <?= substr_card($k['deskripsi']); ?></p>
                                <p class="card-text"><small class="text-muted"><strong>Dibuat</strong>: <?= date('Y-m-d', $k['tanggal_buat']);  ?></small></p>
                                <div class="alert alert-warning">
                                    Permintaan gabung anda sedang diproses
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
        <?php endif ?>


    <?php endforeach; ?>

</div>