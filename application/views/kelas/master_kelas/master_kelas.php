<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Master Kelas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">

                        <!-- Pengaturan -->
                        <div class="table-responsive">
                            <table class="table table-hover table-light">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><i class="fas fa-cog text-primary"></i> <strong>Master Kelas</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Informasi kelas <i class="fas fa-fw fa-users-cog text-primary"></i> <?= $kelas['nama_kelas']; ?></td>
                                        <td><a href="<?= base_url('kelas/informasi_kelas?kk=') . $this->input->get('kk', TRUE); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Tema kelas <i class="far fa-fw fa-image text-primary"></i></td>
                                        <td><a href="<?= base_url('kelas/tema_kelas?kk=') . $this->input->get('kk', TRUE); ?>">Ubah&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Daftar anggota<i class="far fa-fw fa-user text-primary"></i>
                                            <?php if ($cek_user_proses > 0) : ?>
                                                <a href="<?= base_url('kelas/permintaan_gabung?kk=') . $this->input->get('kk', TRUE); ?>" class="badge badge-warning"><i class="far fa-bell"></i> <?= $cek_user_proses; ?> Permintaan gabung</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="<?= base_url('kelas/mkak?kk=') . $this->input->get('kk', TRUE); ?>">Lihat&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Daftar guru <i class="fas fa-fw fa-chalkboard-teacher text-primary"></i></td>
                                        <td><a href="<?= base_url('kelas/mkg?kk=') . $this->input->get('kk', TRUE); ?>">Lihat&rarr;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Nonaktifkan kelas <i class="fas fa-users-slash text-danger"></i></td>
                                        <td><a href="<?= base_url('kelas/nonaktifkan_kelas?kk=') . $this->input->get('kk', TRUE); ?>" class="text-danger">Lihat&rarr;</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <img src="<?= base_url('layout') . '/img/ilustrasi/setting_tab.png'; ?>" alt="Illustrations" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>