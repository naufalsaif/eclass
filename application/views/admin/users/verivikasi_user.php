<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/users'); ?>">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Verivikasi User</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <a href="<?= base_url('admin/verivikasi?kr=' . $this->input->get('kr', TRUE)); ?>" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Minta Token Baru</span>
        </a>

    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Email baru</th>
                                <th scope="col">Token</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal aktivitas</th>
                                <th scope="col">Kode aktivitas</th>
                                <th scope="col">UID</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($aktivitas_user as $au) :  ?>
                                <tr>
                                    <td><?= $au['email']; ?></td>
                                    <td><?= (!$au['email_baru'] ? '-' : $au['email_baru']); ?></td>
                                    <td><?= $au['token']; ?></td>
                                    <td><?= $au['status']; ?></td>
                                    <td><?= $au['tanggal_aktivitas']; ?></td>
                                    <td><?= $au['kode_aktivitas']; ?></td>
                                    <td><?= $au['kunci_rahasia']; ?></td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('admin/lihat_token?id=' . $au['id'] . '&kr=' . $au['kunci_rahasia']); ?>">Lihat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/hapus_token?id=' . $au['id'] . '&kr=' . $au['kunci_rahasia']); ?>" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
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