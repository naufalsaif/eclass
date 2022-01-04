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
                <li class="breadcrumb-item active" aria-current="page">Nonaktif Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <h1 class="h6 text-gray-800">
                    <span class="text-danger">*</span> Perhatian, jika anda menonaktifkan kelas ini maka kelas ini tidak dapat digunakan kembali oleh semua anggota termasuk(ketua kelas)!
                </h1>
                <a href="<?= base_url('kelas/nonaktif_kelas?kk=' . $this->input->get('kk', TRUE)); ?>" class="btn btn-danger mt-2 tombol-hapus" data-sweetalert-hapus="Apakah anda yakin ingin menonaktifkan kelas?">Nonaktifkan</a>
            </div>
        </div>
    </div>
</div>