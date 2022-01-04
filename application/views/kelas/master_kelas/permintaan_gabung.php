<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/mkak') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>">Master Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/mkak') . '?kk=' . $this->input->get('kk', TRUE); ?>">Anggota Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permintaan Gabung</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Perminataan Anggota</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($anggota_kelas as $ak) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $ak['username']; ?></td>
                                    <td><?= $ak['nama']; ?></td>
                                    <td>
                                        <div class="h6 mb-3 badge badge-warning"><?= $ak['status']; ?></div>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('kelas/aksi_gabung?a=s&kk=' . $this->input->get('kk', TRUE)  . '&kr=' . $ak['kunci_rahasia']); ?>" class="btn btn-success tombol-setujui" data-sweetalert-setujui="Apakah anda ingin menyetujui?"><i class="fas fa-check"></i> Setujui</a>
                                        <a href="<?= base_url('kelas/aksi_gabung?a=t&kk=' . $this->input->get('kk', TRUE)  . '&kr=' . $ak['kunci_rahasia']); ?>" class="btn btn-danger tombol-hapus" data-sweetalert-hapus="Apakah anda ingin menolak?"><i class="fas fa-times"></i> Tolak</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>