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
                <li class="breadcrumb-item active" aria-current="page">Anggota Kelas</li>
            </ol>
        </nav>
    </div>
</div>


<?php if ($cek_user_proses > 0) : ?>
    <div class="row">
        <div class="col">

            <a href="<?= base_url('kelas/permintaan_gabung?kk=') . $this->input->get('kk', TRUE); ?>" class="btn btn-warning btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="far fa-bell text-light"></i>
                </span>
                <span class="text"><?= $cek_user_proses; ?> Permintaan Gabung</span>
            </a>

        </div>
    </div>
<?php endif; ?>


<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($anggota_kelas as $ak) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $ak['nama']; ?>
                                        <?php if ($ak['username'] == $users['username']) : ?>
                                            <h1 class="h6 badge badge-primary">
                                                <i class="fas fa-check"></i> saya
                                            </h1>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= ($ak['role'] == 'ketua kelas' ? '<i class="fas fa-crown text-primary"></i> Ketua kelas' : 'Anggota') ?>
                                    </td>
                                    <td>
                                        <?php if ($ak['status'] == 'blokir') : ?>
                                            Diblokir
                                        <?php elseif ($ak['status'] == 'proses') : ?>
                                            Proses
                                        <?php else : ?>
                                            Aktif
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('users/profile') . '?u=' . $ak['username'] . '&kk=' . $this->input->get('kk', TRUE) . '&mk=' . $this->input->get('kk', TRUE); ?>">Lihat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?= base_url('kelas/ubah_anggota_kelas') . '?kk=' . $this->input->get('kk', TRUE) . '&kr=' . $ak['kunci_rahasia']; ?>">Ubah</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?" href="<?= base_url('kelas/hapus_anggota_kelas?kk=' . $this->input->get('kk', TRUE) . '&kr=' . $ak['kunci_rahasia']); ?>">Kick</a>
                                            </div>
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