<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pengaturan'); ?>">Data diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('pengaturan/avatar'); ?>">Avatar</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <!-- form tema -->
                        <form action="<?= base_url('pengaturan/avatar'); ?>" method="POST" class="mt-3">
                            <div class="row">
                                <div class="main-container-tema">
                                    <div class="radio-buttons-tema">

                                        <?php foreach ($avatar as $a) : ?>
                                            <label class="custom-radio-tema">
                                                <input type="radio" name="avatar" <?= ($users['avatar'] == $a['kode_avatar']) ? "checked" : "" ?> value="<?= $a['kode_avatar']; ?>">
                                                <span class="radio-btn-tema"><i class="las la-check"></i>
                                                    <div class="hobbies-icon">
                                                        <img src="<?= base_url('layout/img/avatar/' . $a['url']); ?>" alt="" class="gambar-tema">
                                                        <h3><?= $a['nama_avatar']; ?></h3>
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
                    <div class="col-lg-5 mt-4">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/image_option.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>