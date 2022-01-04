<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/kelas'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Kelas</li>
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
                        <form action="<?= base_url('admin/ubah_kelas' . '?kk=' . $this->input->get('kk', TRUE)); ?>" method="POST">
                            <div class="form-group">
                                <label for="nama_kelas" class="text-gray-800">Nama kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan nama kelas baru" value="<?= $kelas['nama_kelas']; ?>">
                                <?= form_error('nama_kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="text-gray-800">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $kelas['deskripsi']; ?></textarea>
                                <?= form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Kelas aktif</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif1" value="0" <?= ($kelas['aktif'] == '0' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="aktif1">
                                            Tidak aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="aktif" id="aktif2" value="1" <?= ($kelas['aktif'] == '1' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="aktif2">
                                            Aktif
                                        </label>
                                    </div>
                                    <?= form_error('aktif', '<small class="text-danger">', '</small>'); ?>
                            </fieldset>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                        <!-- end form kelas -->

                    </div>
                    <div class="col-lg-5">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/setting_tab.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>