<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/avatar'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/avatar'); ?>">Avatar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Avatar</li>
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
                        <?= form_open_multipart('admin/ubah_avatar?kav=' . $this->input->get('kav', TRUE)); ?>
                        <div class="form-group">
                            <label for="nama_avatar" class="text-gray-800">Nama avatar</label>
                            <input type="text" class="form-control" id="nama_avatar" name="nama_avatar" placeholder="Masukkan nama avatar" value="<?= $avatar['nama_avatar']; ?>">
                            <?= form_error('nama_avatar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="urlgambar" class="text-gray-800">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="urlgambar" name="url" onchange="previewImg()">
                                <label class="custom-file-label" for="urlgambar">Pilih gambar</label>
                                <?php if (!form_error('url')) : ?>
                                    <small class="form-text text-muted">Upload gambar hanya bisa png, jpg, jpeg. jika melebihi 1mb resize <a href="https://squoosh.app/" class="text-primary" target="_blank"><strong>disini</strong></a></small>
                                <?php endif; ?>
                                <?= form_error('url', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <img src="<?= base_url('layout/img/avatar/' . $avatar['url']); ?>" class="img-thumbnail img-preview mt-3" style="max-width: 200px;">
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                        <!-- end form kelas -->

                    </div>
                    <div class="col-lg-5">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/edit_image.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>