<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/mkg') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>">Master Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mkg') . '?kk=' . $this->input->get('kk', TRUE); ?>">Guru Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Guru</li>
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
                        <form action="<?= base_url('kelas/tambah_guru?kk=') . $this->input->get('kk', TRUE); ?>" method="POST">
                            <div class="form-group">
                                <label for="nama_guru">Nama guru</label>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Masukkan nama guru" value="<?= set_value('nama_guru'); ?>">
                                <?= form_error('nama_guru', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="mata_pelajaran">Mata pelajaran</label>
                                <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" placeholder="Masukkan mata pelajaran" value="<?= set_value('mata_pelajaran'); ?>">
                                <?= form_error('mata_pelajaran', '<small class="text-danger">', '</small>'); ?>
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