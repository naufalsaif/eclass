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
                        <form action="<?= base_url('admin/ubah_user?kr=' . $this->input->get('kr', TRUE)); ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="<?= $user['nama']; ?>">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password baru (opsional)</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Pria" <?= ($user['jenis_kelamin'] == 'Pria' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin1">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Wanita" <?= ($user['jenis_kelamin'] == 'Wanita' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="jenis_kelamin2">
                                        Wanita
                                    </label>
                                </div>
                                <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $user['telepon']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" value="<?= $user['tanggal_lahir']; ?>">
                                <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k['kelas']; ?>" <?= ($user['kelas'] == $k['kelas'] ? "selected" : ""); ?>><?= $k['kelas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"><?= $user['bio']; ?></textarea>
                                <?= form_error('bio', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="text" class="form-control" id="avatar" name="avatar" value="<?= $user['avatar']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="user" <?= ($user['role'] == 'user' ? 'selected' : ''); ?>>User</option>
                                    <option value="admin" <?= ($user['role'] == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                                <?= form_error('role', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="aktif">Aktif akun</label>
                                <select class="form-control" id="aktif" name="aktif">
                                    <option value="0" <?= ($user['aktif'] == '0' ? 'selected' : ''); ?>>Tidak aktif</option>
                                    <option value="1" <?= ($user['aktif'] == '1' ? 'selected' : ''); ?>>Aktif</option>
                                </select>
                                <?= form_error('aktif', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="salah_password">Salah password</label>
                                <input type="number" class="form-control" id="salah_password" name="salah_password" placeholder="Masukkan salah password" value="<?= $user['salah_password']; ?>">
                                <?= form_error('salah_password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="blokir">Blokir</label>
                                <select class="form-control" id="blokir" name="blokir">
                                    <option value="0" <?= ($user['blokir'] == '0' ? 'selected' : ''); ?>>Tidak diblokir</option>
                                    <option value="1" <?= ($user['blokir'] == '1' ? 'selected' : ''); ?>>Diblokir</option>
                                </select>
                                <?= form_error('blokir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/preference.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>