</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy;<?= date('Y'); ?> NOVTECH</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah yakin ingin logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan "Logout" di bawah jika anda ingin keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('users/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('layout/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('layout/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('layout/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('layout/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('layout/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('layout/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('layout/'); ?>js/demo/datatables-demo.js"></script>

<!-- Page level plugins -->
<!-- <script src="<?= base_url('layout/'); ?>vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?= base_url('layout/'); ?>js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?= base_url('layout/'); ?>js/demo/chart-pie-demo.js"></script> -->

<!-- clock custom -->
<script src="<?= base_url('layout/'); ?>js/moment-with-locales.min.js"></script>

<!-- sweet alert -->
<script src="<?= base_url('layout/'); ?>js/sweetalert2.all.min.js"></script>

<!-- script -->
<script>
    // jam
    const jamWebsite = document.getElementById('jam-website');

    function clock() {
        // jika ingin mengubah pengaturan waktu find hooks.defineLocale('id 
        // cari di moment-with-locales.min.js
        moment.locale('id')
        const jam = jamMoment = moment().format('LTS');
        const tanggal = moment().format('YYYY-MM-DD');

        const hariIni = 'Tanggal: ' + tanggal + ' ' + jam;
        jamWebsite.innerHTML = hariIni;
    }
    setInterval(clock, 1000);
    clock();



    // sweetalert
    const flashDataSuccess = $('.flash-data-success').data('flashdata');
    const flashDataWrong = $('.flash-data-wrong').data('flashdata');

    if (flashDataSuccess) {
        Swal.fire({
            // title: 'Selamat!',
            text: flashDataSuccess,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } else if (flashDataWrong) {
        Swal.fire({
            // title: 'Selamat!',
            text: flashDataWrong,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    //  tombol hapus
    const sweetalert_hapus = $('.tombol-hapus').data('sweetalert-hapus');
    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-success mr-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            text: sweetalert_hapus,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '',
                    'Dibatalkan',
                    'error'
                )
            }
        })

    });

    //  tombol setujui
    const sweetalert_setujui = $('.tombol-setujui').data('sweetalert-setujui');
    $('.tombol-setujui').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            text: sweetalert_setujui,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '',
                    'Dibatalkan',
                    'error'
                )
            }
        })

    });

    // copy input
    const copyInp = document.getElementById("copyInp");
    const btnCopyInp = document.getElementById("btnCopyInp");

    btnCopyInp.onclick = function() {
        copyInp.select();
        copyInp.setSelectionRange(0, 99999); /* For mobile devices */
        document.execCommand("Copy");

        Swal.fire({
            // title: 'Selamat!',
            text: 'Copy berhasil',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    function previewImg() {
        const urlgambar = document.querySelector('#urlgambar');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        // mengganti nama label
        sampulLabel.textContent = urlgambar.files[0].name;

        // menggantik preview
        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(urlgambar.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<script>
    // auto logout 10 menit
    let log_off = new Date();
    log_off.setMinutes(log_off.getMinutes() + 10);
    log_off = new Date(log_off);

    let int_logoff = setInterval(function() {
        let now = new Date();
        if (now > log_off) {
            window.location.assign("<?= base_url('users/logout') ?>");
            clearInterval(int_logoff);
        }
    }, 5000);

    $('body').on('mousemove', function() {
        log_off = new Date();
        log_off.setMinutes(log_off.getMinutes() + 10);
        log_off = new Date(log_off);
    });
</script>

</body>

</html>