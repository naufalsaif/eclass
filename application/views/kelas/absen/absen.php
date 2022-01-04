<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Absen</li>
            </ol>
        </nav>
    </div>
</div>

<?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
    <div class="row my-2">
        <div class="col">
            <a href="<?= base_url('kelas/tambah_absen') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Absen Baru</span>
            </a>
        </div>
    </div>
<?php endif; ?>

<hr>

<div class="row mb-1">
    <div class="col-12">
        <h1 class="h4 mb-0 text-gray-800">Daftar Absen</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <form action="<?= base_url('kelas/rab?kk=' . $this->input->get('kk', TRUE)); ?>" method="POST">
            <div class="input-group mt-2 mb-2">
                <input type="text" class="form-control" placeholder="Masukkan kode absen" id="keyword" name="keyword" autocomplete="off">
                <div class="input-group-append">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($absen == 'null') : ?>
    <div class="row">
        <div class="col">
            <div class="text-danger" role="alert">
                Data absen belum ada.
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col">
            <?php if (empty($absen)) : ?>
                <div class="text-danger" role="alert">
                    Kode absen tidak ditemukan
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<div class="row">

    <?php if ($absen == 'null') : ?>
    <?php else : ?>

        <?php $no = 1; ?>
        <?php foreach ($absen as $a) : ?>
            <!-- card -->
            <div class="col-xl-3 col-md-6 my-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 p-2 font-weight-bold text-uppercase bg-primary text-center text-white mb-3 rounded">
                                    <i class="fas fa-user-check"></i> ABSEN <?= $no++; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Info</strong>:
                                    <?php if (cek_absen_saya($a['kode_absen'], $this->input->get('kk', TRUE))) : ?>
                                        <div class=" badge badge-success">
                                            Sudah absen
                                        </div>
                                    <?php else : ?>
                                        <div class=" badge badge-danger">
                                            Belum absen
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Kode absen</strong>: <?= $a['kode_absen']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Keterangan</strong>: <?= substr_card($a['keterangan']); ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Dibuat</strong>: <?= $a['dibuat']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Batas absen</strong>: <?= $a['batas_absen']; ?>
                                </div>

                                <?php if (date('Y-m-d H:i:s', time()) >= $a['batas_absen']) : ?>
                                    <div class="h6 text-gray-800"><strong>Status</strong>: <div class="h6 mb-3 badge badge-danger">
                                            Sudah ditutup!
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="h6 text-gray-800"><strong>Status</strong>: <div class="h6 mb-3 badge badge-primary">
                                            Masih dibuka
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <a href="<?= base_url('kelas/rabs') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $a['kode_absen']; ?>" class="text-primary">Absen &rarr;</a>
                                </div>
                                <hr class="my-3">
                                <?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
                                    <div>
                                        <a href="<?= base_url('kelas/ubah_absen') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $a['kode_absen']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('kelas/rmvab') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $a['kode_absen']; ?>" class="btn btn-danger tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif ?>



</div>