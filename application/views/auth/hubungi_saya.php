<div class="container col-lg-8">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block"><img src="<?= base_url('layout/img/ilustrasi/messaging_fun.png'); ?>" alt="Illustrations" class="img-fluid gambar-ukuran"></div>
                        <div class="col-lg-6 form-ukuran">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="h2 text-gray-900 mb-4"><b>KELAS<sup style="font-size: 20px;">KU</sup></b></div>
                                    <hr class="mb-4">
                                    <h1 class="h4 text-gray-900 mb-4">Hubungi Kami</h1>
                                </div>
                                <?php if ($this->session->flashdata('message')) : ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $this->session->flashdata('message'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <form class="user" action="<?= base_url('auth/hubungi_saya'); ?>" method="POST">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email anda" value="<?= set_value('email'); ?>" autocapitalize="off">
                                        <?php if (!form_error('email')) : ?>
                                            <small class="form-text text-muted">Masukkan email anda yang bisa dihubungi</small>
                                        <?php endif ?>
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pesan">Pesan</label>
                                        <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
                                        <?= form_error('pesan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LcgCSUdAAAAAG2GSkabDSNq4ExxcfG31uYskJoK"></div>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    <button type="submit" class="btn btn-primary btn-user btn-block mt-4">Kirim</button>
                                </form>
                                <hr class="mt-4">
                                <div class="text-center">
                                    <small>Sudah punya akun?</small> <a class="small" href="<?= base_url('auth'); ?>">LOGIN!</a>
                                </div>
                            </div>
                            <!-- Footer -->
                            <footer class="sticky-footer bg-primary">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto text-white">
                                        <span>Copyright &copy;<?= date('Y'); ?> NOVTECH</span>
                                    </div>
                                </div>
                            </footer>
                            <!-- End of Footer -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>