<div class="row">
    <div class="col">
        <a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('kelas'); ?>">Kelas</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/r') . '?kk=' . $this->input->get('kk', TRUE); ?>">Ruangan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('kelas/rab') . '?kk=' . $this->input->get('kk', TRUE); ?>">Absen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ruangan Absen</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <h1 class="h5 mb-3 text-gray-800"><strong>Kode Absen</strong>:
                    <div class="row col-lg-6 pl-0 mt-2">
                        <div class="col-7 pr-0">
                            <input type="text" id="copyInp" class="form-control mr-0" value="<?= $absen['kode_absen']; ?>" readonly>
                        </div>
                        <div class="col-5 pl-0">
                            <button type="submit" id="btnCopyInp" class="btn btn-primary ml-3 mb-2"><i class="far fa-clone"></i> Copy</button>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <h1 class="h5 mb-0 mt-1 text-gray-800"><strong>Informasi</strong>:
                                <?php if (!$anggota_absen) : ?>
                                    <div class=" badge badge-danger">
                                        Belum Absen
                                    </div>
                                <?php else : ?>
                                    <div class=" badge badge-success">
                                        Sudah Absen
                                    </div>
                                <?php endif; ?>
                            </h1>
                        </div>
                    </div>

                    <h1 class="h5 text-gray-800"><strong>Status</strong>:
                        <?php if (date('Y-m-d H:i:s', time()) >= $absen['batas_absen']) : ?>
                            <div class=" badge badge-danger">
                                Sudah ditutup!
                            </div>
                        <?php else : ?>
                            <div class=" badge badge-primary">
                                Masih dibuka
                            </div>
                        <?php endif; ?>
                    </h1>
                    <h1 class="h5 text-gray-800 mt-3"><strong>Batas absen</strong>:
                        <?= $absen['batas_absen']; ?>
                    </h1>

            </div>
        </div>
    </div>
</div>


<hr>
<div class="row">
    <div class="col">
        <?php if (date('Y-m-d H:i:s', time()) <= $absen['batas_absen']) : ?>
            <?php if (!$anggota_absen) : ?>
                <div class="row mb-3">
                    <div class="col">
                        <a href="<?= base_url('kelas/tambah_ruangan_absen') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-check"></i>
                            </span>
                            <span class="text">Absen</span>
                        </a>
                    </div>
                </div>



            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header font-weight-bold text-primary">
                Daftar anggota yang sudah absen
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal absen</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($anggota_absen_all as $ab) :  ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $ab['username']; ?>
                                        <?php if ($ab['username'] == $users['username']) : ?>
                                            <h1 class="h6 badge badge-primary">
                                                <i class="fas fa-check"></i> saya
                                            </h1>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $ab['nama']; ?>
                                    </td>
                                    <td>
                                        <?php if ($ab['status'] == 'hadir') :  ?>
                                            <h1 class="h6 badge badge-success">
                                                Hadir
                                            </h1>
                                        <?php else : ?>
                                            <h1 class="h6 badge badge-warning">
                                                Izin
                                            </h1>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= substr_table($ab['keterangan']); ?>
                                    </td>
                                    <td><?= date('Y-m-d H:i:s', $ab['tanggal_absen']); ?></td>
                                    <td>
                                        <?php if ($ab['kunci_rahasia'] == $users['kunci_rahasia'] || $cek_anggota_kelas['role'] == 'ketua kelas') : ?>
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('kelas/detail_ruangan_absen') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE) . '&kr=' . $ab['kunci_rahasia']; ?>">Lihat</a>
                                                    <?php if (date('Y-m-d H:i:s', time()) <= $absen['batas_absen']) : ?>

                                                        <?php if (($ab['kunci_rahasia'] == $users['kunci_rahasia'])) : ?>

                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="<?= base_url('kelas/ubah_ruangan_absen') . '?kk=' . $this->input->get('kk', TRUE) . '&ka=' . $this->input->get('ka', TRUE); ?>">Edit</a>

                                                        <?php endif; ?>


                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>

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