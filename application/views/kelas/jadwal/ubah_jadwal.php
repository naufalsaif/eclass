<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/jadwal') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/jadwal') . '?kk=' . $this->input->get('kk', TRUE); ?>">Jadwal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Jadwal</li>
            </ol>
        </nav>
    </div>
</div>

<?php if (!$guru) : ?>
    <div class="card col-lg-6">
        <div class="card-body">
            <div class="h6 text-gray-800 mt-3">
                Dikelas anda belum ada guru yang ditambahkan silahkan tambah terlebih dahulu.
            </div>
            <a href="<?= base_url('kelas/tambah_guru?kk=' . $this->input->get('kk', TRUE)); ?>" class="btn btn-primary">Tambah Guru</a>
        </div>
    </div>
<?php else : ?>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <form action="<?= base_url('kelas/ubah_jadwal') . '?kk=' . $this->input->get('kk', TRUE) . '&kdj=' . $this->input->get('kdj', TRUE); ?>" method="POST">
                                <div class="form-group">
                                    <label for="kode_guru">Guru</label>
                                    <select class="form-control" id="kode_guru" name="kode_guru">
                                        <?php foreach ($guru as $g) : ?>
                                            <option value="<?= $g['kode_guru']; ?>" <?= ($jadwal['kode_guru'] == $g['kode_guru'] ? 'selected' : ''); ?>><?= substr_table($g['nama_guru'] . ' - ' . $g['mata_pelajaran']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kode_guru', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <select class="form-control" id="hari" name="hari">
                                        <option selected disabled>-- Pilih Hari --</option>
                                        <option value="senin" <?= ($jadwal['hari'] == 'senin' ? 'selected' : ''); ?>>senin</option>
                                        <option value="selasa" <?= ($jadwal['hari'] == 'selasa' ? 'selected' : ''); ?>>selasa</option>
                                        <option value="rabu" <?= ($jadwal['hari'] == 'rabu' ? 'selected' : ''); ?>>rabu</option>
                                        <option value="kamis" <?= ($jadwal['hari'] == 'kamis' ? 'selected' : ''); ?>>kamis</option>
                                        <option value="jumat" <?= ($jadwal['hari'] == 'jumat' ? 'selected' : ''); ?>>jumat</option>
                                        <option value="sabtu" <?= ($jadwal['hari'] == 'sabtu' ? 'selected' : ''); ?>>sabtu</option>
                                        <option value="minggu" <?= ($jadwal['hari'] == 'minggu' ? 'selected' : ''); ?>>minggu</option>
                                    </select>
                                    <?= form_error('hari', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jam_mulai">Jam mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= $jadwal['jam_mulai']; ?>">
                                    <?= form_error('jam_mulai', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jam_selesai">Jam selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= $jadwal['jam_selesai']; ?>">
                                    <?= form_error('jam_selesai', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                            </form>
                        </div>
                        <div class="col-lg-5 mt-4">
                            <img src="<?= base_url('layout') . '/img/ilustrasi/jadwal_update.png'; ?>" alt="Illustrations" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>