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
                <li class="breadcrumb-item active" aria-current="page">Tema</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <a href="<?= base_url('admin/tambah_tema'); ?>" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Tema</span>
        </a>

    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Tema</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Kode tema</th>
                                <th scope="col">Nama tema</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($tema as $t) :  ?>
                                <tr>
                                    <td><?= $t['kode_tema']; ?></td>
                                    <td><?= $t['nama_tema']; ?></td>
                                    <td><img src="<?= base_url('layout/img/tema/' . $t['url']); ?>" alt="<?= $t['nama_tema']; ?>" style="max-width: 50px;" class="img-fluid"></td>
                                    <td>
                                        <?php if ($t['kode_tema'] != 'KTM16365920859103') : ?>
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('admin/ubah_tema?ktm=' . $t['kode_tema']); ?>">Ubah</a>
                                                    <!-- <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?= base_url('admin/hapus_tema?ktm=' . $t['kode_tema']); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a> -->
                                                </div>
                                            <?php endif; ?>
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