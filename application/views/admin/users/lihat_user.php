<div class="row">
    <div class="col">
        <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light pl-0 py-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/users'); ?>">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat User</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-md-8">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="card-text"><strong>Username</strong>: <?= $user['username']; ?></p>
                        <p class="card-text"><strong>Email</strong>: <?= $user['email']; ?></p>
                        <p class="card-text"><strong>Nama lengkap</strong>: <?= $user['nama']; ?></p>
                        <p class="card-text"><strong>Jenis kelamin</strong>: <?= $user['jenis_kelamin']; ?></p>
                        <p class="card-text"><strong>Telepon</strong>: <?= $user['telepon']; ?></p>
                        <p class="card-text"><strong>Tanggal lahir</strong>: <?= $user['tanggal_lahir']; ?></p>
                        <p class="card-text"><strong>Kelas</strong>: <?= $user['kelas']; ?></p>
                        <p class="card-text"><strong>Bio</strong>: <?= $user['bio']; ?></p>
                        <p class="card-text"><strong>Role</strong>: <?= $user['role']; ?></p>
                        <div class="card-text mb-2"><strong>Aktif</strong>: <?= ($user['aktif'] == '1' ? '<div class="h6 badge badge-success">Aktif</div>' : '<div? class="h6 badge badge-danger">Tidak Aktif</h1>'); ?></div>
                        <p class="card-text"><strong>Salah Password</strong>: <?= $user['salah_password']; ?></p>
                        <div class="card-text mb-2"><strong>Blokir</strong>: <?= ($user['blokir'] == '0' ? '<div class="h6 badge badge-success">Tidak diblokir</div>' : '<div? class="h6 badge badge-danger">Diblokir</h1>'); ?></div>
                        <p class="card-text"><strong>Tanggal dibuat</strong>: <?= date('Y-m-d H:i:s', $user['tanggal_buat']); ?></p>
                        <p class="card-text"><strong>Aktivitas login</strong>: <?= date('Y-m-d H:i:s', $user['aktivitas_login']); ?></p>
                        <?php if ($user['aktivitas_email'] == '0' || '') : ?>
                            <p class="card-text"><strong>Aktivitas email</strong>: Tidak ada aktivitas</p>
                        <?php else : ?>
                            <p class="card-text"><strong>Aktivitas email</strong>: <?= date('Y-m-d H:i:s', $user['aktivitas_email']); ?></p>
                        <?php endif; ?>
                        <div class="card-text mb-2"><strong>Online</strong>: <?= ($user['online'] == '1' ? '<div class="h6 badge badge-primary">Online</div>' : '<div? class="h6 badge badge-danger">Offline</h1>'); ?></div>
                        <p class="card-text mb-3"><strong>UID</strong>: <?= $user['kunci_rahasia']; ?></p>
                    </div>

                    <div class="col-lg-4">
                        <img src="<?= base_url('layout/img/avatar/' . $user['url']); ?>" class="img-thumbnail" alt="<?= $user['nama_avatar']; ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>