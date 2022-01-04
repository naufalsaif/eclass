<div class="container col-lg-6">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col form-ukuran">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="h2 text-gray-900 mb-4"><b>KELAS<sup style="font-size: 20px;">KU</sup></b></div>
                                    <hr class="mb-4">
                                    <h1 class="h4 text-gray-900 mb-4">Aktivasi</h1>
                                </div>
                                <form class="user" action="<?= base_url('auth/aktivasi?email=' . urlencode($this->input->get('email', TRUE)) . '&token=' . urlencode($this->input->get('token', TRUE))); ?>" method="POST">
                                    <div class="form-group">
                                        <label class="sr-only" for="username">Username</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                        </div>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda" value="<?= set_value('nama'); ?>">
                                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
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
                                        <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Masukkan telepon anda" value="<?= set_value('telepon'); ?>">
                                        <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir'); ?>">
                                        <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select class="form-control" id="kelas" name="kelas" placeholder="Masukkan tanggal_lahir anda">
                                            <?php foreach ($kelas as $k) : ?>
                                                <option value="<?= $k['kelas']; ?>" <?= (set_value('kelas') == $k['kelas'] ? 'selected' : ''); ?>><?= $k['kelas']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="3"><?= set_value('bio'); ?></textarea>
                                        <?= form_error('bio', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif">
                                        <label class="form-check-label" for="aktif">
                                            <small>Saya menyetujui syarat dan ketentuan dan kebijakan privasi yang berlaku.</small><br>
                                            <?= form_error('aktif', '<small class="text-danger">', '</small>'); ?>
                                        </label>
                                    </div>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    <button type="submit" class="btn btn-primary btn-user btn-block mt-4">Aktivasi</button>
                                </form>
                                <hr class="mt-4">
                                <div class="text-center">
                                    <small>Sudah punya akun?</small> <a class="small" href="<?= base_url('auth'); ?>">LOGIN!</a>
                                </div>
                            </div>
                            <!-- Footer -->
                            <footer class="sticky-footer bg-primary">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto text-white">
                                        <span>Copyright &copy;<?= date('Y'); ?> NOVTECH</span>
                                    </div>
                                </div>
                            </footer>
                            <!-- End of Footer -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>