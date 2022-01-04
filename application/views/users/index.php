<div class="row">
    <div class="col-lg-4">
        <div class="card border-bottom-primary">
            <div class="card-body">
                <!-- <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a> -->
                <div class="row">
                    <div class="col-3">
                        <img src="<?= base_url('layout/img/avatar/' . $users['url']); ?>" alt="<?= $users['nama_avatar']; ?>" class="img-fluid">
                    </div>
                    <div class="col-9">
                        <?php if ($users['online'] == 1) : ?>
                            <h1 class=" d-inline-block btn-sm btn-primary shadow-sm">Online</h1>
                        <?php else : ?>
                            <h1 class=" d-inline-block btn-sm btn-danger shadow-sm">Offline</h1>
                        <?php endif; ?>
                        <h5 class="card-title">@<?= $users['username']; ?> <?= ($this->session->userdata('role') == 'admin' ? '<i class="far fa-check-circle text-primary"></i>' : ''); ?></h5>
                        <h5 class="card-title">Nama: <?= $users['nama']; ?></h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h6 class="card-title">UID: <?= $users['kunci_rahasia']; ?></h6>
                        <h6 class="card-title">Jenis kelamin: <?= $users['jenis_kelamin']; ?></h6>
                        <h6 class="card-title">Kelas: <?= $users['kelas']; ?></h6>
                        <h6 class="card-title">Email: <?= $users['email']; ?></h6>
                        <h6 class="card-title">Telepon: <?= $users['telepon']; ?></h6>
                        <h6 class="card-title">Tangga lahir: <?= $users['tanggal_lahir']; ?></h6>
                        <h6 class="card-title">Bio: <?= $users['bio']; ?></h6>
                        <h6 class="card-title">Aktivitas login: <?= date('Y-m-d H:i:s', $users['aktivitas_login']); ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Dibuat: <?= date('d-F-Y', $users['tanggal_buat']); ?></span>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>