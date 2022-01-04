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
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Kode laporan</th>
                                <th scope="col">Email</th>
                                <th scope="col">Pesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $l) :  ?>
                                <tr>
                                    <td><?= $l['kode_laporan']; ?> <?= ($l['lihat'] == 0 ? (time() - $l['tanggal_pesan'] <= (60 * 60 * 24) ? '<div class="badge badge-danger">New</div>' : '') : ''); ?></td>
                                    <td><?= $l['email']; ?></td>
                                    <td><?= substr_table($l['pesan']); ?></td>
                                    <td>
                                        <?php if ($l['lihat'] == '1') : ?>
                                            <div class=" badge badge-success">
                                                Sudah dibaca
                                            </div>
                                        <?php else : ?>
                                            <div class=" badge badge-warning">
                                                Belum dibaca
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('Y-m-d H:i:s', $l['tanggal_pesan']); ?></td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('admin/lihat_laporan?kl=' . $l['kode_laporan']); ?>">Lihat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/hapus_laporan?kl=' . $l['kode_laporan']); ?>" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
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