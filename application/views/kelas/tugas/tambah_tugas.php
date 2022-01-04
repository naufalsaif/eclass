<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rt') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rt') . '?kk=' . $this->input->get('kk', TRUE); ?>">Tugas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Tugas</li>
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
                            <form action="<?= base_url('kelas/tambah_tugas') . '?kk=' . $this->input->get('kk', TRUE); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama_tugas">Nama tugas</label>
                                    <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" placeholder="Masukkan nama tugas" value="<?= set_value('nama_tugas'); ?>">
                                    <?= form_error('nama_tugas', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="kode_guru">Guru</label>
                                    <select class="form-control" id="kode_guru" name="kode_guru">
                                        <?php foreach ($guru as $g) : ?>
                                            <option value="<?= $g['kode_guru']; ?>" <?= (set_value('kode_guru') == $g['kode_guru'] ? 'selected' : ''); ?>><?= substr_table($g['nama_guru'] . ' - ' . $g['mata_pelajaran']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kode_guru', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_tugas">Deskripsi tugas</label>
                                    <textarea class="form-control" id="deskripsi_tugas" name="deskripsi_tugas" rows="3"><?= set_value('deskripsi_tugas'); ?></textarea>
                                    <?php if (!form_error('deskripsi_tugas')) : ?>
                                        <small>cth: tugas soal essai kerjakan dibuku tulis</small>
                                    <?php endif; ?>
                                    <?= form_error('deskripsi_tugas', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="batas_pengumpulan">Batas pengumpulan</label>
                                    <input type="datetime-local" class="form-control" id="batas_pengumpulan" name="batas_pengumpulan" value="<?= set_value('batas_pengumpulan'); ?>">
                                    <?= form_error('batas_pengumpulan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="link_pengumpulan">Link pengumpulan(Opsional)</label>
                                    <input type="text" class="form-control" id="link_pengumpulan" name="link_pengumpulan" placeholder="Masukkan link pengumpulan jika ada" value="<?= set_value('link_pengumpulan'); ?>">
                                    <?= form_error('link_pengumpulan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                            </form>
                        </div>
                        <div class="col-lg-5 mt-4">
                            <img src="<?= base_url('layout') . '/img/ilustrasi/add_tasks.png'; ?>" alt="Illustrations" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>