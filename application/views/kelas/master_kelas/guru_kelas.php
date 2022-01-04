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
                <li class="breadcrumb-item active" aria-current="page">Guru Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">

        <a href="<?= base_url('kelas/tambah_guru?kk=') . $this->input->get('kk', TRUE); ?>" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Guru</span>
        </a>

    </div>
</div>

<div class="row">
    <div class="col">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama guru</th>
                                <th scope="col">Mata pelajaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($guru as $g) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $g['nama_guru']; ?></td>
                                    <td><?= $g['mata_pelajaran']; ?></td>
                                    <td>
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('kelas/ubah_guru?kk=' . $this->input->get('kk', TRUE) . '&kg=' . $g['kode_guru']); ?>">Ubah</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?" href="<?= base_url('kelas/hapus_guru?kk=' . $this->input->get('kk', TRUE) . '&kg=' . $g['kode_guru']); ?>">Hapus</a>
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