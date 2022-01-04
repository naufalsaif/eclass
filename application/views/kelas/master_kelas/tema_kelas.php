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
                <li class="breadcrumb-item active" aria-current="page">Tema Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row mb-5">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">

                        <!-- form tema -->
                        <form action="<?= base_url('kelas/tema_kelas' . '?kk=' . $this->input->get('kk', TRUE)); ?>" method="POST" class="mt-3">
                            <div class="row">
                                <div class="main-container-tema">
                                    <div class="radio-buttons-tema">

                                        <?php foreach ($tema as $t) : ?>
                                            <label class="custom-radio-tema">
                                                <input type="radio" name="kode_tema" <?= ($kelas['kode_tema'] == $t['kode_tema']) ? "checked" : "" ?> value="<?= $t['kode_tema']; ?>">
                                                <span class="radio-btn-tema"><i class="las la-check"></i>
                                                    <div class="hobbies-icon">
                                                        <img src="<?= base_url('layout/img/tema/' . $t['url']); ?>" alt="<?= $t['nama_tema']; ?>" class="gambar-tema">
                                                        <h3><?= $t['nama_tema']; ?></h3>
                                                    </div>
                                                </span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="simpan" class="btn btn-primary my-3">Simpan</button>
                            </div>
                        </form>
                        <!-- end form tema -->

                    </div>
                    <div class="col-lg-5 mt-5">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/edit_photo.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>