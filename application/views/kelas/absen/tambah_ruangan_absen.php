<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rabs') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>">Absen</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rabs') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>">Ruangan Absen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Ruangan Absen</li>
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
                        <form action="<?= base_url('kelas/tambah_ruangan_absen') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>" method="POST">
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status2" value="hadir" <?= (set_value('status') == 'hadir' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="status2">
                                            Hadir
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1" value="izin" <?= (set_value('status') == 'izin' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="status1">
                                            Izin
                                        </label>
                                    </div>
                                    <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </fieldset>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= set_value('keterangan'); ?></textarea>
                                <?php if (!form_error('keterangan')) : ?>
                                    <small>cth: saya siap mengikuti pelajaran hari ini</small>
                                <?php endif; ?>
                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/checklist.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>