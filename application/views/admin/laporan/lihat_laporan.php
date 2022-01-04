<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/laporan'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan'); ?>">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Laporan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7 pr-0">
                        <input type="text" id="copyInp" class="form-control mr-0" value="<?= $laporan['email']; ?>" readonly>
                    </div>
                    <div class="col-5 pl-0">
                        <button type="submit" id="btnCopyInp" class="btn btn-primary ml-3 mb-2"><i class="far fa-clone"></i> Copy</button>
                    </div>
                </div>
                <p class="card-text mt-2"><strong>Kode laporan</strong>: <?= $laporan['kode_laporan']; ?></p>
                <p class="card-text"><strong>Pesan</strong>: <?= $laporan['pesan']; ?></p>
                <p class="card-text"><strong>Tanggal pesan</strong>: <?= date('Y-m-d H:i:s', $laporan['tanggal_pesan']); ?></p>
                <?php if ($laporan['lihat'] == 0) : ?>
                    <a href="<?= base_url('admin/baca_laporan?kl=' . $this->input->get('kl', TRUE)); ?>" class="btn btn-primary mt-2">Sudah Dibaca</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>