<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/users'); ?>">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah User</li>
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
                        <form action="<?= base_url('admin/tambah_user'); ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="<?= set_value('username'); ?>">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= set_value('email'); ?>" autocapitalize="off">
                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Pria" <?= (set_value('jenis_kelamin') == 'Pria' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin1">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Wanita" <?= (set_value('jenis_kelamin') == 'Wanita' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin2">
                                        Wanita
                                    </label>
                                </div>
                                <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon'); ?>">
                                <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" value="<?= set_value('tanggal_lahir'); ?>">
                                <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k['kelas']; ?>" <?= (set_value('kelas') == $k['kelas'] ? "selected" : ""); ?>><?= $k['kelas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"><?= set_value('bio'); ?></textarea>
                                <?= form_error('bio', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/add_user.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>