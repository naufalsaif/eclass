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
                <li class="breadcrumb-item active" aria-current="page">Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Kode kelas</th>
                                <th scope="col">Nama kelas</th>
                                <th scope="col">Tanggal buat</th>
                                <th scope="col">Pembuat</th>
                                <th scope="col">Aktif</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($kelas as $k) :  ?>
                                <tr>
                                    <td><?= $k['kode_kelas']; ?></td>
                                    <td><?= $k['nama_kelas']; ?></td>
                                    <td><?= date('Y-m-d H:i:s', $k['tanggal_buat']); ?></td>
                                    <td><?= $k['pembuat_kelas']; ?></td>
                                    <td>
                                        <?php if ($k['aktif'] == '1') : ?>
                                            <div class=" badge badge-success">
                                                Aktif
                                            </div>
                                        <?php else : ?>
                                            <div class=" badge badge-danger">
                                                Tidak aktif
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('admin/lihat_kelas?kk=' . $k['kode_kelas']); ?>">Lihat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?= base_url('admin/ubah_kelas?kk=' . $k['kode_kelas']); ?>">Ubah</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/hapus_kelas?kk=' . $k['kode_kelas']); ?>" data-sweetalert-hapus="Apakah anda yakin?">Hapus</a>
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