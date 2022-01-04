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
                <li class="breadcrumb-item active" aria-current="page">Gabung Kelas</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row">
    <div class="col">
        <h1 class="h5 mb-3 text-gray-800">Status :
            <?php if ($kelas['aktif'] == '0') : ?>
                <div class="badge badge-danger">
                    Kelas tidak aktif
                </div>
            <?php else : ?>
                <?php if ($anggota_kelas['status'] == 'blokir') : ?>
                    <div class="badge badge-danger">
                        Anda diblokir
                    </div>
                <?php elseif ($anggota_kelas['status'] == 'proses') : ?>
                    <div class="badge badge-warning">
                        Permintaan sedang diproses
                    </div>
                <?php elseif ($anggota_kelas['status'] == 'aktif') : ?>
                    <div class="badge badge-success">
                        Sudah gabung
                    </div>
                <?php else : ?>
                    <div class="badge badge-danger">
                        Belum gabung
                    </div>
                <?php endif; ?>
            <?php endif; ?>
    </div>
</div>

<!-- card -->
<div class="col-lg-6 pl-0 mb-3">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-lg-4">
                <img src="<?= base_url('layout/img/tema/' . $kelas['url']); ?>" alt="<?= $kelas['nama_tema']; ?>" class="img-fluid">
            </div>
            <div class="col-lg-8">
                <div class="card-body">
                    <h5 class="card-title"><strong><?= $kelas['nama_kelas']; ?></strong></h5>
                    <div class="card-text"><strong>Kode kelas</strong>: <?= $kelas['kode_kelas']; ?></div>
                    <div class="card-text"><strong>Deskripsi</strong>: <?= $kelas['deskripsi']; ?></div>
                    <div class="card-text"><strong>Ketua kelas</strong>:
                        <?php $no = 1; ?>
                        <?php foreach ($ketua_kelas as $ketua) : ?>
                            <h1 class="h6 mb-3 badge badge-primary">
                                #<?= $no++; ?> <?= $ketua['nama'] . '<br>'; ?>
                            </h1>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-text mb-3"><small class="text-muted"><strong>Dibuat</strong>: <?= date('Y-m-d', $kelas['tanggal_buat']);  ?></small></div>

                    <?php if ($kelas['aktif'] == '0') : ?>
                        <div class="alert alert-danger">
                            Kelas ini sudah tidak aktif
                        </div>
                    <?php else : ?>
                        <?php if ($anggota_kelas['status'] == 'blokir') : ?>
                            <div class="alert alert-danger">
                                Mohon maaf anda diblokir dari kelas ini
                            </div>
                        <?php elseif ($anggota_kelas['status'] == 'proses') : ?>
                            <div class="alert alert-warning">
                                Silahkan di tunggu atau hubungi ketua kelas anda untuk menerima perminataan gabung
                            </div>
                        <?php elseif ($anggota_kelas['status'] == 'aktif') : ?>
                            <a href="<?= base_url('kelas/r') . '?kk=' . $kode_kelas; ?>" class="text-primary">Masuk &rarr;</a>
                        <?php else : ?>
                            <a href="<?= base_url('kelas/gabung_kelas') . '?kk=' . $kode_kelas; ?>" class="btn btn-primary"><i class="fas fa-door-open"></i> Gabung</a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>