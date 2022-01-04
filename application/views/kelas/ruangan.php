<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ruangan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <h1 class="h5 mb-0 text-gray-800">Hi <?= $users['nama']; ?>, selamat datang di kelas <?= $kelas['nama_kelas']; ?> 👋</h1>
    </div>
</div>

<div class="row">

    <?php if ($cek_anggota_kelas['role'] == 'ketua kelas') : ?>
        <!-- card -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h4  font-weight-bold text-danger text-uppercase mb-1">
                                Master Kelas
                            </div>
                            <div class="h6 mb-3 text-gray-800">
                                Untuk mengelola kelas.
                            </div>
                            <div>
                                <a href="<?= base_url('kelas/mk') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="text-danger">Kelola &rarr;</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-key fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
    <?php endif; ?>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h4  font-weight-bold text-warning text-uppercase mb-1">
                            Tugas
                        </div>
                        <div class="h6 mb-3 text-gray-800">
                            Berisi informasi tugas-tugas anda.
                        </div>
                        <div>
                            <a href="<?= base_url('kelas/rt') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="text-warning">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h4  font-weight-bold text-success text-uppercase mb-1">
                            Absen
                        </div>
                        <div class="h6 mb-3 text-gray-800">
                            Untuk mengecek kehadiran anda setiap hari.
                        </div>
                        <div>
                            <a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="text-success">Absen &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h4  font-weight-bold text-primary text-uppercase mb-1">
                            Jadwal
                        </div>
                        <div class="h6 mb-3 text-gray-800">
                            Jadwal kelas.
                        </div>
                        <div>
                            <a href="<?= base_url('kelas/jadwal') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="text-primary">Lihat &rarr;</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<hr class="mb-4">

<div class="card mb-3">
    <div class="card-body">
        <h1 class="h4 mb-3 text-gray-800"><strong>Informasi Kelas</strong></h1>
        <h1 class="h6 text-gray-800"><strong>Kode kelas</strong>: </h1>
        <div class="row col-lg-5 pl-0">
            <div class="col-7 pr-0">
                <input type="text" id="copyInp" class="form-control mr-0" value="<?= $kelas['kode_kelas']; ?>" readonly>
            </div>
            <div class="col-5 pl-0">
                <button type="submit" id="btnCopyInp" class="btn btn-primary ml-3 mb-2"><i class="far fa-clone"></i> Copy</button>
            </div>
        </div>
        <h1 class="h6 text-gray-800"><strong>Deskripsi kelas</strong>: <?= $kelas['deskripsi']; ?></h1>
    </div>
</div>
<div class="row justify-content-end mr-0">
    <a href="<?= base_url('kelas/keluar_kelas?kk=' . $this->input->get('kk', TRUE)); ?>" class="btn btn-danger mb-3 tombol-hapus" data-sweetalert-hapus="Apakah anda yakin ingin keluar kelas?"><i class="fas fa-sign-out-alt"></i> Keluar Kelas</a>
</div>

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
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($anggota_kelas as $ak) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $ak['username']; ?>
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
                                    <td><a href="<?= base_url('users/profile') . '?u=' . $ak['username'] . '&kk=' . $this->input->get('kk', TRUE); ?>" class="badge badge-primary">Lihat</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>