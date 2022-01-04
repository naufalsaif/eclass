<div class="row">
    <div class="col">
        <a href="<?= base_url('admin'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <a href="<?= base_url('admin/tambah_user'); ?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah User</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Role</th>
                                <th scope="col">UID</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $u) :  ?>
                                <tr>
                                    <td><?= $u['email']; ?> <?= ($u['kunci_rahasia'] == $this->session->userdata('kunci_rahasia') ? '<h1 class="h6 badge badge-primary"><i class="fas fa-check"></i> saya</h1>' : '') ?></td>
                                    <td><?= $u['username']; ?></td>
                                    <td><?= $u['nama']; ?></td>
                                    <td><?= $u['telepon']; ?></td>
                                    <td><?= $u['role']; ?></td>
                                    <td><?= $u['kunci_rahasia']; ?></td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('admin/lihat_user?kr=' . $u['kunci_rahasia']); ?>">Lihat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?= base_url('admin/ubah_user?kr=' . $u['kunci_rahasia']); ?>">Ubah</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?= base_url('admin/verivikasi_user?kr=' . $u['kunci_rahasia']); ?>">Verivikasi</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/hapus_user?kr=' . $u['kunci_rahasia']); ?>" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
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