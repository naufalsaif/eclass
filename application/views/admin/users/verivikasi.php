<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/verivikasi_user?kr=' . $this->input->get('kr', TRUE)); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/users'); ?>">Users</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/verivikasi_user?kr=' . $this->input->get('kr', TRUE)); ?>">Verivikasi User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Verivikasi Token</li>
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
                        <form action="<?= base_url('admin/verivikasi?kr=' . $this->input->get('kr', TRUE)); ?>" method="POST">
                            <div class="form-group">
                                <label for="status">Token</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected disabled>-- Pilih Token --</option>
                                    <option value="aktivasi">Aktivasi</option>
                                    <option value="ubah password">Ubah password</option>
                                    <option value="ubah email">Ubah email</option>
                                    <option value="blokir">Blokir</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email_baru">Email baru</label>
                                <input type="text" class="form-control" id="email_baru" name="email_baru" value="<?= set_value('email_baru'); ?>">
                                <?php if (!form_error('email_baru')) : ?>
                                    <small id="status" class="form-text text-muted">Masukkan email baru jika anda meminta token ubah email saja</small>
                                <?php endif; ?>
                                <?= form_error('email_baru', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="minta" class="btn btn-primary mt-3 mb-3">Minta</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/autentikasi.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>