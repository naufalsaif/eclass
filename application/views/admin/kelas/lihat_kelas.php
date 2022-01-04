<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/kelas'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="h3 mb-3 text-gray-800"><strong>Informasi Kelas</strong></h1>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="card-text">Kode kelas: <?= $kelas['kode_kelas']; ?></p>
                        <p class="card-text">Nama kelas: <?= $kelas['nama_kelas']; ?></p>
                        <p class="card-text">Tanggal buat: <?= date('Y-m-d H:i:s', $kelas['tanggal_buat']); ?></p>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-text mb-3">Aktif: <?php if ($kelas['aktif'] == '1') : ?>
                                <div class=" badge badge-success">
                                    Aktif
                                </div>
                            <?php else : ?>
                                <div class=" badge badge-danger">
                                    Tidak aktif
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="card-text">Pembuat kelas: <?= $kelas['pembuat_kelas']; ?></p>
                        <p class="card-text">Deskripsi: <?= $kelas['deskripsi']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal gabung</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">UID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($kelas_anggota as $ka) :  ?>
                                <tr>
                                    <td><?= $ka['email']; ?></td>
                                    <td><?= $ka['username']; ?></td>
                                    <td><?= $ka['nama']; ?></td>
                                    <td><?= date('Y-m-d H:i:s', $ka['tanggal_gabung']); ?></td>
                                    <td><?= ($ka['role'] == 'ketua kelas' ? '<i class="fas fa-crown text-primary"></i> Ketua Kelas' : 'Anggota') ?></td>
                                    <td>
                                        <?php if ($ka['status'] == 'aktif') : ?>
                                            <div class=" badge badge-success">
                                                Aktif
                                            </div>
                                        <?php elseif ($ka['status'] == 'proses') : ?>
                                            <div class=" badge badge-warning">
                                                Proses
                                            </div>
                                        <?php else : ?>
                                            <div class="badge badge-danger">
                                                Diblokir
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $ka['kunci_rahasia']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>