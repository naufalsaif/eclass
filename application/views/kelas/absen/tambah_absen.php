<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>">Absen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Absen</li>
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
                        <form action="<?= base_url('kelas/tambah_absen') . '?kk=' . $this->input->get('kk', TRUE); ?>" method="POST">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= set_value('keterangan'); ?></textarea>
                                <?php if (!form_error('keterangan')) : ?>
                                    <small>cth: pembelajaran hari ke 1</small>
                                <?php endif; ?>
                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="dibuat">Absen dibuat</label>
                                <input type="datetime-local" class="form-control" id="dibuat" name="dibuat" value="<?= strftime('%Y-%m-%dT%H:%M', time()); ?>">
                                <?= form_error('dibuat', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="batas_absen">Batas absen</label>
                                <input type="datetime-local" class="form-control" id="batas_absen" name="batas_absen" value="<?= set_value('batas_absen'); ?>">
                                <?= form_error('batas_absen', '<small class="text-danger">', '</small>'); ?>
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