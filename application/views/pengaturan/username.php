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
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Username</li>
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
                        <form action="<?= base_url('pengaturan/username'); ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <?php if ($selisih == false) : ?>
                                    <label class="sr-only" for="username">username</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $users['username']; ?>" readonly>
                                    </div>
                                    <small>Anda bisa mengganti kembali username anda pada tanggal <?= $waktu_terbuka; ?></small>
                                <?php else : ?>
                                    <label class="sr-only" for="username">username</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $users['username']; ?>">
                                    </div>
                                    <?php if (!form_error('username')) : ?>
                                        <small>Username hanya bisa diganti 1 kali dalam 7 hari</small>
                                    <?php endif; ?>
                                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    <br>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/personal_data.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>