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
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Profile</li>
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
                        <form action="<?= base_url('pengaturan/profile'); ?>" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $users['nama']; ?>">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Pria" <?= ($users['jenis_kelamin'] == 'Pria' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin1">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Wanita" <?= ($users['jenis_kelamin'] == 'Wanita' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin2">
                                        Wanita
                                    </label>
                                </div>
                                <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $users['tanggal_lahir']; ?>">
                                <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <?php foreach ($kelas_user as $ku) : ?>
                                        <option value="<?= $ku['kelas']; ?>" <?= ($users['kelas'] == $ku['kelas'] ? "selected" : ""); ?>><?= $ku['kelas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"><?= $users['bio']; ?></textarea>
                                <?= form_error('bio', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/personal_setting.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>