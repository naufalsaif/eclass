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
                <li class="breadcrumb-item active" aria-current="page">Lihat Token</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 pr-0">

                        <?php if ($cek_token['status'] == 'aktivasi') : ?>
                            <input type="text" id="copyInp" class="form-control mr-0" value="<?= base_url('auth/aktivasi?email=' . urlencode($cek_token['email']) . '&token=' . urlencode($cek_token['token'])); ?>" readonly>
                            <small id="emailHelp" class="form-text text-muted">berikan token ini kepada <?= $cek_token['email']; ?></small>

                        <?php elseif ($cek_token['status'] == 'ubah password') : ?>
                            <input type="text" id="copyInp" class="form-control mr-0" value="<?= base_url('auth/reset_password?email=' . urlencode($cek_token['email']) . '&token=' . urlencode($cek_token['token'])); ?>" readonly>
                            <small id="emailHelp" class="form-text text-muted">berikan token ini kepada <?= $cek_token['email']; ?></small>

                        <?php elseif ($cek_token['status'] == 'blokir') : ?>
                            <input type="text" id="copyInp" class="form-control mr-0" value="<?= base_url('auth/buka_blokir?email=' . urlencode($cek_token['email']) . '&token=' . urlencode($cek_token['token'])); ?>" readonly>
                            <small id="emailHelp" class="form-text text-muted">berikan token ini kepada <?= $cek_token['email']; ?></small>
                        <?php else : ?>
                            <input type="text" id="copyInp" class="form-control mr-0" value="<?= $cek_token['token']; ?>" readonly>
                            <small id="emailHelp" class="form-text text-muted">berikan token ini kepada <?= $cek_token['email']; ?></small>
                        <?php endif; ?>

                    </div>
                    <div class="col-5 pl-0">
                        <button type="submit" id="btnCopyInp" class="btn btn-primary ml-3 mb-2"><i class="far fa-clone"></i> Copy</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>