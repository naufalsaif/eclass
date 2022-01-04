<div class="row">
    <div class="col">
        <a href="<?= base_url('pengaturan'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('pengaturan'); ?>">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Verivikasi Email Baru</li>
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
                        <h1 class="h6 mb-0 text-gray-800 mb-3">Email baru anda <?= $cek_aktivitas_email['email_baru']; ?>, ingin mengganti? <a href="<?= base_url('pengaturan/hapus_email_baru'); ?>" class="text-primary">Ganti email</a> </h1>
                        <form action="<?= base_url('pengaturan/k_verivikasi'); ?>" method="POST">
                            <div class="form-group">
                                <label for="token">Kode verivikasi</label>
                                <div class="input-group mb-3 col-lg-6 px-0">
                                    <input type="text" class="form-control" id="token" name="token" placeholder="Masukkan kode verivikasi">
                                    <div class="input-group-append">
                                        <a href="<?= base_url('pengaturan/e_verivikasi'); ?>" class="btn btn-outline-primary">Minta kode</a>
                                    </div>
                                </div>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="verivikasi" class="btn btn-primary mb-5 mt-1">Verivikasi</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/secure.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>