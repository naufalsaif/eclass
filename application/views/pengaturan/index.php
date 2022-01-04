<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('pengaturan'); ?>">Data diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pengaturan/avatar'); ?>">Avatar</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <?php if ($this->session->flashdata('message')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <?= $this->session->flashdata('message'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <!-- Pengaturan -->
                        <div class="table-responsive">
                            <table class="table table-hover table-light">
                                <tbody>
                                    <tr>
                                        <td>Profile <i class="far fa-fw fa-user text-primary"> </i><?= $users['nama']; ?></td>
                                        <td><a href="<?= base_url('pengaturan/profile'); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Username <i class="far fa-fw fa-address-card text-primary"></i> <?= $users['username']; ?></td>
                                        <td><a href="<?= base_url('pengaturan/username'); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon <i class="fas fa-fw fa-phone text-primary"></i> <?= $users['telepon']; ?></td>
                                        <td><a href="<?= base_url('pengaturan/telepon'); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Email <i class="far fa-fw fa-envelope text-primary"></i> <?= $users['email']; ?></td>
                                        <td><a href="<?= base_url('pengaturan/email'); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Ubah password <i class="fas fa-fw fa-lock text-primary"></i> *****</td>
                                        <td><a href="<?= base_url('pengaturan/password'); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/personal_information.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>