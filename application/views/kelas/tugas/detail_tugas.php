<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rt') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rt') . '?kk=' . $this->input->get('kk', TRUE); ?>">Tugas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Tugas</li>
            </ol>
        </nav>
    </div>
</div>

<!-- card -->
<div class="col-lg-4 pl-0">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 p-2 font-weight-bold text-uppercase bg-primary text-center text-white mb-3 rounded">
                        <?= $tugas['nama_tugas']; ?>
                    </div>
                    <!-- <div class="h5 font-weight-bold text-primary text-uppercase mb-3">
                        </div> -->
                    <div class="h6 text-gray-800 mt-4">
                        <strong>Kode tugas</strong>:
                        <div class="row mt-2">
                            <div class="col-7 pr-0">
                                <input type="text" id="copyInp" class="form-control mr-0" value="<?= $tugas['kode_tugas']; ?>" readonly>
                            </div>
                            <div class="col-5 pl-0">
                                <button type="submit" id="btnCopyInp" class="btn btn-primary ml-3"><i class="far fa-clone"></i> Copy</button>
                            </div>
                        </div>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Informasi</strong> :
                        <?php if (cek_anggota_tugas($this->input->get('kt', TRUE), $this->input->get('kk', TRUE))) : ?>
                            <div class="h6 badge badge-success mb-0">
                                Sudah mengumpulkan
                            </div>
                        <?php else : ?>
                            <div class="h6 badge badge-danger mb-0">
                                Belum mengumpulkan
                            </div>
                        <?php endif ?>
                    </div>
                    <?php if (date('Y-m-d H:i:s', time()) >= $tugas['batas_pengumpulan']) : ?>
                        <div class="h6 text-gray-800"><strong>Status</strong>: <div class="h6 mb-0 badge badge-danger">
                                Sudah ditutup!
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="h6 text-gray-800"><strong>Status</strong>: <div class="h6 mb-0 badge badge-primary">
                                Masih dibuka
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="h6 text-gray-800">
                        <strong>Mata pelajaran</strong>: <?= $tugas['mata_pelajaran']; ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Guru</strong>: <?= $tugas['nama_guru']; ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Deskripsi</strong>: <?= $tugas['deskripsi_tugas']; ?>
                    </div>

                    <?php if (cek_anggota_tugas($this->input->get('kt', TRUE), $this->input->get('kk', TRUE))) : ?>
                        <div class="h6 text-gray-800">
                            <strong>Tanggal mengumpulkan</strong>: <?= date('Y-m-d H:i:s', cek_anggota_tugas($this->input->get('kt', TRUE), $this->input->get('kk', TRUE))['tanggal_mengumpulkan']); ?>
                        </div>
                    <?php else : ?>
                        <div class="h6 text-gray-800">
                            <strong>Dibuat</strong>: <?= date('Y-m-d H:i:s', $tugas['tanggal_buat']); ?>
                        </div>
                        <div class="h6 text-gray-800">
                            <strong>Batas pengumpulan</strong>: <?= $tugas['batas_pengumpulan']; ?>
                        </div>
                    <?php endif ?>


                    <div class="h6 text-gray-800">
                        <strong>Link pengumpulan</strong>: <?= (!$tugas['link_pengumpulan'] ? 'Tidak ada link' : $tugas['link_pengumpulan']); ?>
                    </div>

                    <?php if (cek_anggota_tugas($this->input->get('kt', TRUE), $this->input->get('kk', TRUE))) : ?>
                    <?php else : ?>
                        <?php if (date('Y-m-d H:i:s', time()) <= $tugas['batas_pengumpulan']) : ?>
                            <div class="h6 text-gray-800">
                                <strong>Klik jika sudah mengumpulakan</strong>: <a href="<?= base_url('kelas/kumpulkan?kk=' . $this->input->get('kk', TRUE) . '&kt=' . $this->input->get('kt', TRUE)); ?>" class="text-danger">Selesai</a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <hr>

                    <?php if (cek_anggota_tugas($this->input->get('kt', TRUE), $this->input->get('kk', TRUE))) : ?>
                    <?php else : ?>
                        <?php if (date('Y-m-d H:i:s', time()) <= $tugas['batas_pengumpulan']) : ?>
                            <?php if ($tugas['link_pengumpulan']) : ?>
                                <div>
                                    <a href="<?= $tugas['link_pengumpulan']; ?>" class="btn btn-primary" target="_blank"><i class="far fa-paper-plane pr-2"></i>Kumpulkan</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif ?>



                </div>
            </div>
        </div>
    </div>
</div>