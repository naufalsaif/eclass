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
                <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
            </ol>
        </nav>
    </div>
</div>

<?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
    <div class="row my-2">
        <div class="col">
            <a href="<?= base_url('kelas/tambah_jadwal') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Jadwal</span>
            </a>
        </div>
    </div>
<?php endif; ?>

<hr>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Guru</th>
                                <th>Mata pelajaran</th>
                                <th>Hari</th>
                                <th>Jam mulai</th>
                                <th>Jam selesai</th>
                                <?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($jadwal as $j) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $j['nama_guru']; ?></td>
                                    <td><?= $j['mata_pelajaran']; ?></td>
                                    <td><?= $j['hari']; ?></td>
                                    <td><?= $j['jam_mulai']; ?></td>
                                    <td><?= $j['jam_selesai']; ?></td>
                                    <?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('kelas/ubah_jadwal') . '?kk=' . $this->input->get('kk', TRUE) . '&kdj=' . $j['kode_jadwal']; ?>">Ubah</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?" href="<?= base_url('kelas/hapus_jadwal') . '?kk=' . $this->input->get('kk', TRUE) . '&kdj=' . $j['kode_jadwal']; ?>">Hapus</a>
                                                </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>