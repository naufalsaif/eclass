<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rabs') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>">Absen</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rabs') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>">Ruangan Absen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Ruangan Absen</li>
            </ol>
        </nav>
    </div>
</div>

<!-- card -->
<div class="col-lg-5 col-md-10 pl-0">
    <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h6 text-gray-800">
                        <strong>Username</strong>: @<?= $anggota_absen['username']; ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Nama</strong>: <?= $anggota_absen['nama']; ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Tanggal absen</strong>: <?= date('Y-m-d H:i:s', $anggota_absen['tanggal_absen']); ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>keterangan</strong>: <?= $anggota_absen['keterangan']; ?>
                    </div>
                    <div class="h6 text-gray-800">
                        <strong>Status</strong>: <?php if ($anggota_absen['status'] == 'hadir') :  ?>
                            <h1 class="h6 badge badge-success">Hadir</h1>
                        <?php else : ?>
                            <h1 class="h6 badge badge-warning">Izin</h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>