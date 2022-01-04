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
                <li class="breadcrumb-item active" aria-current="page">Tugas</li>
            </ol>
        </nav>
    </div>
</div>

<?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
    <div class="row my-2">
        <div class="col">
            <a href="<?= base_url('kelas/tambah_tugas') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tugas Baru</span>
            </a>
        </div>
    </div>
<?php endif; ?>

<hr>

<div class="row mb-1">
    <div class="col-12">
        <h1 class="h4 mb-0 text-gray-800">Daftar Tugas</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <form action="<?= base_url('kelas/rt?kk=' . $this->input->get('kk', TRUE)); ?>" method="POST">
            <div class="input-group mt-2 mb-2">
                <input type="text" class="form-control" placeholder="Masukkan kode tugas" id="keyword" name="keyword" autocomplete="off">
                <div class="input-group-append">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($tugas == 'null') : ?>
    <div class="row">
        <div class="col">
            <div class="text-danger" role="alert">
                Data tugas belum ada.
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col">
            <?php if (empty($tugas)) : ?>
                <div class="text-danger" role="alert">
                    Kode tugas tidak ditemukan
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>


<div class="row">

    <?php if ($tugas == 'null') : ?>
    <?php else : ?>

        <?php $no = 1; ?>
        <?php foreach ($tugas as $t) : ?>

            <!-- card -->
            <div class="col-xl-3 col-md-6 my-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 p-2 font-weight-bold text-uppercase bg-primary text-center text-white rounded">
                                    <i class="fas fa-clipboard"></i> TUGAS <?= $no++; ?>
                                </div>
                                <div class="h5  font-weight-bold text-primary text-uppercase mt-3">
                                    <?= $t['nama_tugas']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Info</strong>:
                                    <?php if (cek_anggota_tugas($t['kode_tugas'], $this->input->get('kk', TRUE))) : ?>
                                        <div class="h6 badge badge-success mb-0">
                                            Sudah mengumpulkan
                                        </div>
                                    <?php else : ?>
                                        <div class="h6 badge badge-danger mb-0">
                                            Belum mengumpulkan
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Kode tugas</strong>: <?= $t['kode_tugas']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Mata pelajaran</strong>: <?= $t['mata_pelajaran']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Guru</strong>: <?= $t['nama_guru']; ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Dibuat</strong>: <?= date('Y-m-d H:i:s', $t['tanggal_buat']); ?>
                                </div>
                                <div class="h6 text-gray-800">
                                    <strong>Batas pengumpulan</strong>: <?= $t['batas_pengumpulan']; ?>
                                </div>

                                <?php if (date('Y-m-d H:i:s', time()) >= $t['batas_pengumpulan']) : ?>
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
                                    <a href="<?= base_url('kelas/detail_tugas') . '?kk=' . $this->input->get('kk', TRUE) . '&kt=' . $t['kode_tugas']; ?>" class="text-primary">Lihat &rarr;</a>
                                </div>
                                <hr class="my-3">
                                <?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
                                    <div>
                                        <a href="<?= base_url('kelas/ubah_tugas') . '?kk=' . $this->input->get('kk', TRUE) . '&kt=' . $t['kode_tugas']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= base_url('kelas/rmvt') . '?kk=' . $this->input->get('kk', TRUE) . '&kt=' . $t['kode_tugas']; ?>" class="btn btn-danger tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>



</div>