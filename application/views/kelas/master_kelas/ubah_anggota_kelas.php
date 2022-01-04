<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/mkak') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>">Master Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mkak') . '?kk=' . $this->input->get('kk', TRUE); ?>">Anggota Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Anggota</li>
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
                        <?php if ($anggota_kelas['status'] == 'proses') : ?>
                            <a href="<?= base_url('kelas/permintaan_gabung?kk=') . $this->input->get('kk', TRUE); ?>" class="btn btn-warning"><i class="far fa-bell text-light"></i> Setujui Permintaan Anggota</a>
                        <?php else : ?>
                            <form action="<?= base_url('kelas/ubah_anggota_kelas') . '?kk=' . $this->input->get('kk', TRUE) . '&kr=' .  $this->input->get('kr', TRUE); ?>" method="POST">
                                <fieldset class="form-group row">
                                    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Role</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="role1" value="ketua kelas" <?= ($anggota_kelas['role'] == 'ketua kelas' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="role1">
                                                Ketua kelas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="role2" value="anggota" <?= ($anggota_kelas['role'] == 'anggota' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="role2">
                                                Anggota
                                            </label>
                                        </div>
                                        <?= form_error('role', '<small class="text-danger">', '</small>'); ?>
                                </fieldset>
                                <hr>
                                <fieldset class="form-group row">
                                    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Status</legend>
                                    <div class="col-sm-10">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="aktif" <?= ($anggota_kelas['status'] == 'aktif' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="status1">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="blokir" <?= ($anggota_kelas['status'] == 'blokir' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="status2">
                                                Blokir
                                            </label>
                                        </div>
                                        <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                                </fieldset>
                                <hr>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/personal_setting.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>