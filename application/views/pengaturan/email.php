<div class="row">
    <div class="col">
        <a href="<?= base_url('pengaturan'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('pengaturan'); ?>">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Email</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <form action="<?= base_url('pengaturan/email'); ?>" method="POST">
                            <?php if ($selisih == false) : ?>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $users['email']; ?>" placeholder="masukkan email baru" disabled>
                                    <small>Anda bisa mengganti kembali email anda pada tanggal <?= $waktu_terbuka; ?></small>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="email">Email Baru</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="masukkan email baru" autocapitalize="off">
                                    <?php if (!form_error('email')) : ?>
                                        <small>Email hanya bisa diganti 1 kali dalam 7 hari</small>
                                    <?php endif; ?>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                            <?php endif; ?>


                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/email.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>