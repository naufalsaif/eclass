<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>">Master Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Informasi Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">

                        <!-- form kelas -->
                        <form action="<?= base_url('kelas/informasi_kelas' . '?kk=' . $this->input->get('kk', TRUE)); ?>" method="POST">
                            <div class="form-group">
                                <label for="nama_kelas" class="text-gray-800">Nama kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan nama kelas baru" value="<?= $kelas['nama_kelas']; ?>">
                                <?= form_error('nama_kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="text-gray-800">Deskripsi kelas</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $kelas['deskripsi']; ?></textarea>
                                <?= form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                        <!-- end form kelas -->

                    </div>
                    <div class="col-lg-5">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/preference.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>