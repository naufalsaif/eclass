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
                <li class="breadcrumb-item active" aria-current="page">Pengaturan Telepon</li>
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
                        <form action="<?= base_url('pengaturan/telepon'); ?>" method="POST">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon" value="<?= $users['telepon']; ?>">
                                <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-3">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/text_field.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>