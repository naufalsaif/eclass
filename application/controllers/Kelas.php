<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session_login();
        $this->load->model('Kelas_model', 'kelas');
    }

    // menampilkan page kelas
    public function index()
    {
        //untuk menampilkan kelas
        $data = [
            'title' => 'Kelas',
            'judul' => '<i class="fas fa-users text-primary"></i> Kelas',
            'kelas' => $this->kelas->kelas_join()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman buat kelas
    public function buat_kelas()
    {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required', [
            'required' => 'Nama kelas tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|max_length[250]', [
            'required' => 'Deskripsi tidak boleh kosong',
            'max_length' => 'Deskripsi tidak boleh melebihi 250 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Buat Kelas',
                'judul' => 'Buat Kelas'
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/buat_kelas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $users = $this->kelas->users();
            $kode_kelas = 'KK' . time() . rand(1000, 9999);
            $data = [
                'kode_kelas' => $kode_kelas,
                'nama_kelas' => strip_tags($this->input->post('nama_kelas', TRUE)),
                'deskripsi' => strip_tags($this->input->post('deskripsi', TRUE)),
                'kode_tema' => 'KTM16365920859103',
                'tanggal_buat' => time(),
                'pembuat_kelas' => $users['username'],
                'kunci_rahasia' => $users['kunci_rahasia'],
                'aktif' => '1'
            ];
            $data_anggota = [
                'tanggal_gabung' => time(),
                'kode_kelas' => $kode_kelas,
                'role' => 'ketua kelas',
                'status' => 'aktif',
                'kunci_rahasia' => $users['kunci_rahasia']
            ];
            $this->db->insert('kelas', $data);
            $this->db->insert('anggota_kelas', $data_anggota);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil membuat kelas baru');
            redirect('kelas');
        }
    }

    // menampilkan kelas gabung
    public function gabung()
    {
        $kode_kelas = $this->input->post('kode_kelas', TRUE);
        $kelas = $this->kelas->kelas($kode_kelas);
        if (!$kelas) {
            $this->session->set_flashdata('wrong', 'Kode kelas tidak ditemukan');
            redirect('kelas');
        }
        $data = [
            'title' => 'Gabung Kelas',
            'judul' => 'Gabung Kelas',
            'kelas' => $kelas,
            'ketua_kelas' => $this->kelas->ketua_kelas($kode_kelas),
            'anggota_kelas' => $this->kelas->cek_anggota_kelas($kode_kelas),
            'kode_kelas' => $kode_kelas
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/gabung', $data);
        $this->load->view('templates/footer', $data);
    }

    // simpan gabung kelas
    public function gabung_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $users = $this->kelas->users();
        $cek_kelas = $this->db->get_where('anggota_kelas', ['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $users['kunci_rahasia']])->row_array();
        if ($this->session->userdata('role') == 'admin') {
            $role = 'ketua kelas';
        } else {
            $role = 'anggota';
        }

        if (!$cek_kelas) {
            $data = [
                'tanggal_gabung' => time(),
                'kode_kelas' => $kode_kelas,
                'role' => $role,
                'status' => 'proses',
                'kunci_rahasia' => $users['kunci_rahasia']
            ];
            $this->db->insert('anggota_kelas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil gabung kelas, mohon tunggu persetujuan gabung dari ketua kelas');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('wrong', 'Maaf anda sudah bergabung');
            redirect('kelas');
        }
    }

    // menampilkan page ruangan
    public function r()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);

        $data = [
            'title' => 'Ruangan',
            'judul' => 'Ruangan',
            'kelas' => $this->kelas->kelas($kode_kelas),
            'anggota_kelas' => $this->kelas->anggota_kelas($kode_kelas),
            'users' => $this->kelas->users(),
            'cek_anggota_kelas' => $this->kelas->cek_anggota_kelas($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/ruangan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function keluar_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);

        $this->db->where(['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $this->session->userdata('kunci_rahasia'), 'status' => 'aktif']);
        $this->db->delete('anggota_kelas');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui keluar kelas');
        redirect('kelas');
    }

    // menampilkan page master kelas
    public function mk()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $data = [
            'title' => 'Master Kelas',
            'judul' => 'Master Kelas',
            'kelas' => $this->kelas->kelas($kode_kelas),
            'cek_user_proses' => $this->kelas->cek_user_proses($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/master_kelas/master_kelas', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman informasi kelas
    public function informasi_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('nama_kelas', 'Nama kelas', 'trim|required', [
            'required' => 'Nama kelas tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|max_length[250]', [
            'required' => 'Deskripsi tidak boleh kosong',
            'max_length' => 'Deskripsi tidak boleh melebihi 250 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Informasi Kelas',
                'judul' => 'Informasi Kelas',
                'kelas' => $this->kelas->kelas($kode_kelas),
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/master_kelas/informasi_kelas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $kode_kelas = $this->input->get('kk', TRUE);

            $data = [
                'nama_kelas' => strip_tags($this->input->post('nama_kelas', TRUE)),
                'deskripsi' => strip_tags($this->input->post('deskripsi', TRUE))
            ];
            $this->db->where('kode_kelas', $kode_kelas)->update('kelas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui informasi kelas');
            redirect('kelas/mk?kk=' . $kode_kelas);
        }
    }

    // menampilkan halaman tema kelas
    public function tema_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('kode_tema', 'Tema', 'required|trim', [
            'required' => 'Tema tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tema Kelas',
                'judul' => 'Tema Kelas',
                'kelas' => $this->kelas->kelas($kode_kelas),
                'tema' => $this->kelas->tema_All()
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/master_kelas/tema_kelas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->set('kode_tema', $this->input->post('kode_tema', TRUE));
            $this->db->where('kode_kelas', $kode_kelas);
            $this->db->update('kelas');
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui tema kelas');
            redirect('kelas/mk?kk=' . $kode_kelas);
        }
    }

    // menampilkan master kelas halaman anggota kelas
    public function mkak()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $data = [
            'title' => 'Anggota Kelas',
            'judul' => 'Anggota Kelas',
            'users' => $this->kelas->users(),
            'kelas' => $this->kelas->kelas($kode_kelas),
            'anggota_kelas' => $this->kelas->anggota_kelas($kode_kelas),
            'cek_user_proses' => $this->kelas->cek_user_proses($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/master_kelas/anggota_kelas', $data);
        $this->load->view('templates/footer', $data);
    }

    // permintaan gabung
    public function permintaan_gabung()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $data = [
            'title' => 'Permintaan Gabung',
            'judul' => 'Permintaan Gabung',
            'anggota_kelas' => $this->kelas->anggota_kelas2($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/master_kelas/permintaan_gabung', $data);
        $this->load->view('templates/footer', $data);
    }

    public function aksi_gabung()
    {
        $aksi = $this->input->get('a', TRUE);
        $kode_kelas = $this->input->get('kk', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        if ($aksi == 's') {
            $this->db->set('status', 'aktif');
            $this->db->where(['status' => 'proses', 'kode_kelas' => $kode_kelas, 'kunci_rahasia' => $kunci_rahasia]);
            $this->db->update('anggota_kelas');
            $this->session->set_flashdata('sweetalert', 'Selamat anda berhasil menyetujui permintaan anggota baru');
            redirect('kelas/permintaan_gabung?kk=' . $kode_kelas);
        } else {
            $this->db->where(['status' => 'proses', 'kode_kelas' => $kode_kelas, 'kunci_rahasia' => $kunci_rahasia]);
            $this->db->delete('anggota_kelas');
            $this->session->set_flashdata('sweetalert', 'Anda berhasil menolak permintaan anggota baru');
            redirect('kelas/permintaan_gabung?kk=' . $kode_kelas);
        }
    }

    // ubah anggota kelas
    public function ubah_anggota_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Role tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => 'Status tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Anggota',
                'judul' => 'Ubah Anggota',
                'anggota_kelas' => $this->kelas->ubah_anggota_kelas($kode_kelas, $kunci_rahasia),
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/master_kelas/ubah_anggota_kelas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'role' => $this->input->post('role', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];
            $this->db->where(['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $kunci_rahasia]);
            $this->db->update('anggota_kelas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui anggota kelas');
            redirect('kelas/mkak?kk=' . $kode_kelas);
        }
    }

    // menghapus/kick anggota kelas
    public function hapus_anggota_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->where(['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $kunci_rahasia]);
        $this->db->delete('anggota_kelas');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus anggota kelas');
        redirect('kelas/mkak?kk=' . $kode_kelas);
    }

    // menampilkan halaman guru
    public function mkg()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $data = [
            'title' => 'Guru Kelas',
            'judul' => 'Guru Kelas',
            'kelas' => $this->kelas->kelas($kode_kelas),
            'guru' => $this->kelas->guruAll($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/master_kelas/guru_kelas', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman tambah guru
    public function tambah_guru()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $users = $this->kelas->users();
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('nama_guru', 'Nama guru', 'required|trim', [
            'required' => 'Nama guru tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('mata_pelajaran', 'Mata pelajaran', 'required|trim', [
            'required' => 'Mata pelajaran tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Guru',
                'judul' => 'Tambah Guru',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/master_kelas/tambah_guru', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kode_guru' => 'KG' . time() . rand(1000, 9999),
                'nama_guru' => strip_tags($this->input->post('nama_guru', TRUE)),
                'mata_pelajaran' => strip_tags($this->input->post('mata_pelajaran', TRUE)),
                'kode_kelas' => $kode_kelas,
                'dibuat' => time(),
                'kunci_rahasia' => $users['kunci_rahasia']

            ];
            $this->db->insert('guru', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah data guru');
            redirect('kelas/mkg?kk=' . $kode_kelas);
        }
    }

    public function ubah_guru()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_guru = $this->input->get('kg', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('nama_guru', 'Nama guru', 'required|trim', [
            'required' => 'Nama guru tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('mata_pelajaran', 'Mata pelajaran', 'required|trim', [
            'required' => 'Mata pelajaran tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Guru',
                'judul' => 'Ubah Guru',
                'guru' => $this->kelas->guru($kode_kelas, $kode_guru)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/master_kelas/ubah_guru', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'nama_guru' => strip_tags($this->input->post('nama_guru', TRUE)),
                'mata_pelajaran' => strip_tags($this->input->post('mata_pelajaran', TRUE))

            ];
            $this->db->where(['kode_guru' => $kode_guru, 'kode_kelas' => $kode_kelas]);
            $this->db->update('guru', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah data guru');
            redirect('kelas/mkg?kk=' . $kode_kelas);
        }
    }

    public function hapus_guru()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_guru = $this->input->get('kg', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->where(['kode_guru' => $kode_guru, 'kode_kelas' => $kode_kelas]);
        $this->db->delete('guru');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus data guru');
        redirect('kelas/mkg?kk=' . $kode_kelas);
    }

    // menampilkan halaman nonaktfi kelas
    public function nonaktifkan_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $data = [
            'title' => 'Nonaktif Kelas',
            'judul' => 'Nonaktif Kelas',
            'kelas' => $this->kelas->kelas($kode_kelas),
            'guru' => $this->kelas->guruAll($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/master_kelas/nonaktif_kelas', $data);
        $this->load->view('templates/footer', $data);
    }

    public function nonaktif_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->set('aktif', '0');
        $this->db->where('kode_kelas', $kode_kelas);
        $this->db->update('kelas');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menonaktifkan kelas');
        redirect('kelas');
    }

    // menampilkan page tugas
    public function rt()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        if (!$this->input->post('keyword', TRUE) || $this->input->post('keyword', TRUE) == '') {
            // jika keyword kosong
            if (!$this->kelas->tugasAll($kode_kelas)) {
                // jika tugas all kosong
                $tugas = 'null';
            } else {
                // jika tugas all ada isinya
                $tugas = $this->kelas->tugasAll($kode_kelas);
            }
        } else {
            $tugas = $this->kelas->cari_tugas($kode_kelas);
        }

        $data = [
            'title' => 'Tugas',
            'judul' => 'Tugas',
            'tugas' => $tugas,
            'cek_anggota_kelas' => $this->kelas->cek_anggota_kelas($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/tugas/tugas', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan page tambah tugas
    public function tambah_tugas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $users = $this->kelas->users();
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('nama_tugas', 'Nama Tugas', 'trim|required', [
            'required' => 'Nama tugas tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kode_guru', 'Guru', 'trim|required', [
            'required' => 'Guru tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi tugas', 'trim|required|max_length[250]', [
            'required' => 'Deskripsi tugas tidak boleh kosong',
            'max_length' => 'Deskripsi tugas tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('batas_pengumpulan', 'Batas Pengumpulan', 'trim|required', [
            'required' => 'Batas pengumpulan tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('link_pengumpulan', 'Link Pengumpulan', 'valid_url', [
            'valid_url' => 'Url tidak valid',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Tugas',
                'judul' => 'Tambah Tugas',
                'guru' => $this->kelas->guruAll($kode_kelas)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/tugas/tambah_tugas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kode_tugas' => 'KT' . time() . rand(1000, 9999),
                'nama_tugas' => strip_tags($this->input->post('nama_tugas', TRUE)),
                'kode_guru' => $this->input->post('kode_guru', TRUE),
                'deskripsi_tugas' => strip_tags($this->input->post('deskripsi_tugas', TRUE)),
                'tanggal_buat' => time(),
                'batas_pengumpulan' => $this->input->post('batas_pengumpulan', TRUE),
                'link_pengumpulan' => $this->input->post('link_pengumpulan', TRUE),
                'kode_kelas' => $kode_kelas,
                'kunci_rahasia' => $users['kunci_rahasia']
            ];
            $this->db->insert('tugas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah tugas baru');
            redirect('kelas/rt?kk=' . $kode_kelas);
        }
    }

    // menampilkan page detail tugas
    public function detail_tugas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_tugas = $this->input->get('kt', TRUE);
        cek_akses_kelas($kode_kelas);

        $data = [
            'title' => 'Lihat Tugas',
            'judul' => 'Lihat Tugas',
            'tugas' => $this->kelas->tugas($kode_kelas, $kode_tugas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/tugas/detail_tugas', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kumpulkan()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_tugas = $this->input->get('kt', TRUE);
        $tugas = $this->kelas->tugas($kode_kelas, $kode_tugas);
        cek_akses_kelas($kode_kelas);
        if (date('Y-m-d H:i:s', time()) >= $tugas['batas_pengumpulan']) {
            $this->session->set_flashdata('wrong', 'Maaf anda sudah tidak bisa mengumpulkan karena batas waktu sudah melewati');
            redirect('kelas/rt?kk=' . $kode_kelas);
        }

        $data = [
            'tanggal_mengumpulkan' => time(),
            'kode_tugas' => $kode_tugas,
            'kode_kelas' => $kode_kelas,
            'kunci_rahasia' => $this->session->userdata('kunci_rahasia')
        ];

        $this->db->insert('anggota_tugas', $data);
        $this->session->set_flashdata('sweetalert', 'Anda berhasil mengumpulkan tugas');
        redirect('kelas/rt?kk=' . $kode_kelas);
    }

    // menampilkan page ubah tugas
    public function ubah_tugas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_tugas = $this->input->get('kt', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('nama_tugas', 'Nama Tugas', 'trim|required', [
            'required' => 'Nama tugas tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kode_guru', 'Guru', 'trim|required', [
            'required' => 'Guru tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi_tugas', 'Deskripsi tugas', 'trim|required|max_length[250]', [
            'required' => 'Deskripsi tugas tidak boleh kosong',
            'max_length' => 'Deskripsi tugas tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('batas_pengumpulan', 'Batas Pengumpulan', 'trim|required', [
            'required' => 'Batas pengumpulan tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('link_pengumpulan', 'Link Pengumpulan', 'trim|valid_url', [
            'valid_url' => 'Url tidak valid',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Tugas',
                'judul' => 'Ubah Tugas',
                'tugas' => $this->kelas->tugas($kode_kelas, $kode_tugas),
                'guru' => $this->kelas->guruAll($kode_kelas)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/tugas/ubah_tugas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'nama_tugas' => strip_tags($this->input->post('nama_tugas', TRUE)),
                'kode_guru' => $this->input->post('kode_guru', TRUE),
                'deskripsi_tugas' => strip_tags($this->input->post('deskripsi_tugas', TRUE)),
                'batas_pengumpulan' => $this->input->post('batas_pengumpulan', TRUE),
                'link_pengumpulan' => $this->input->post('link_pengumpulan', TRUE)
            ];

            $this->db->where(['kode_tugas' => $kode_tugas, 'kode_kelas' => $kode_kelas]);
            $this->db->update('tugas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah data tugas');
            redirect('kelas/rt?kk=' . $kode_kelas);
        }
    }

    // menghapus tugas
    public function rmvt()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_tugas = $this->input->get('kt', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->where(['kode_tugas' => $kode_tugas, 'kode_kelas' => $kode_kelas])->delete('anggota_tugas');
        $this->db->where(['kode_tugas' => $kode_tugas, 'kode_kelas' => $kode_kelas])->delete('tugas');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus data tugas');
        redirect('kelas/rt?kk=' . $kode_kelas);
    }

    // menampilkan halaman absen
    public function rab()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        if (!$this->input->post('keyword', TRUE) || $this->input->post('keyword', TRUE) == '') {
            // jika keyword kosong
            if (!$this->kelas->absenAll($kode_kelas)) {
                // jika absen all kosong
                $absen = 'null';
            } else {
                // jika absen all ada isinya
                $absen = $this->kelas->absenAll($kode_kelas);
            }
        } else {
            $absen = $this->kelas->cari_absen($kode_kelas);
        }

        $data = [
            'title' => 'Absen',
            'judul' => 'Absen',
            'absen' => $absen,
            'cek_anggota_kelas' => $this->kelas->cek_anggota_kelas($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/absen/absen', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman tambah absen
    public function tambah_absen()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $users = $this->kelas->users();
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|max_length[250]', [
            'required' => 'Keterangan tidak boleh kosong',
            'max_length' => 'Keterangan tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('dibuat', 'Tanggal Dibuat', 'trim|required', [
            'required' => 'Tanggal absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('batas_absen', 'Batas absen', 'trim|required', [
            'required' => 'Tanggal batas absen tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Absen',
                'judul' => 'Tambah Absen',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/absen/tambah_absen', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kode_absen' => 'AB' . time() . rand(1000, 9999),
                'keterangan' => strip_tags($this->input->post('keterangan', TRUE)),
                'dibuat' => date('Y-m-d H:i:s', strtotime($this->input->post('dibuat', TRUE))),
                'batas_absen' => $this->input->post('batas_absen', TRUE),
                'kode_kelas' => $kode_kelas,
                'kunci_rahasia' => $users['kunci_rahasia']
            ];
            $this->db->insert('absen', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah data absen');
            redirect('kelas/rab?kk=' . $kode_kelas);
        }
    }

    // menampilkan halaman ubah absen
    public function ubah_absen()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|max_length[250]', [
            'required' => 'Keterangan tidak boleh kosong',
            'max_length' => 'Keterangan tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('dibuat', 'Tanggal Dibuat', 'trim|required', [
            'required' => 'Tanggal absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('batas_absen', 'Batas absen', 'trim|required', [
            'required' => 'Tanggal batas absen tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Absen',
                'judul' => 'Ubah Absen',
                'absen' => $this->kelas->absen($kode_kelas, $kode_absen)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/absen/ubah_absen', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'keterangan' => strip_tags($this->input->post('keterangan', TRUE)),
                'dibuat' => $this->input->post('dibuat', TRUE),
                'batas_absen' => $this->input->post('batas_absen', TRUE),
            ];
            $this->db->where(['kode_kelas' => $kode_kelas, 'kode_absen' => $kode_absen]);
            $this->db->update('absen', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah data absen');
            redirect('kelas/rab?kk=' . $kode_kelas);
        }
    }

    public function rmvab()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->where(['kode_kelas' => $kode_kelas, 'kode_absen' => $kode_absen])->delete('anggota_absen');
        $this->db->where(['kode_kelas' => $kode_kelas, 'kode_absen' => $kode_absen])->delete('absen');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus data absen');
        redirect('kelas/rab?kk=' . $kode_kelas);
    }

    // menampilkan ruangan absen
    public function rabs()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        $cek_anggota_kelas = $this->kelas->cek_anggota_kelas($kode_kelas);
        cek_akses_kelas($kode_kelas);

        $data = [
            'title' => 'Ruangan Absen',
            'judul' => 'Ruangan Absen',
            'anggota_absen' => $this->kelas->anggota_absen($kode_kelas, $kode_absen),
            'anggota_absen_all' => $this->kelas->anggota_absenAll($kode_kelas, $kode_absen),
            'users' => $this->kelas->users(),
            'absen' => $this->kelas->absen($kode_kelas, $kode_absen),
            'cek_anggota_kelas' => $cek_anggota_kelas
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/absen/ruangan_absen', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilalkan page anggota absen 
    public function tambah_ruangan_absen()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        $absen = $this->kelas->absen($kode_kelas, $kode_absen);
        $users = $this->kelas->users();
        $anggota = $this->kelas->anggota_absen($kode_kelas, $kode_absen);
        cek_akses_kelas($kode_kelas);

        if ($anggota) {
            redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
        }

        if (date('Y-m-d H:i:s', time()) >= $absen['batas_absen']) {
            redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
        }

        $this->form_validation->set_rules('status', 'Status', 'trim|required', [
            'required' => 'Status absen tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|max_length[250]', [
            'required' => 'Keterangan absen tidak boleh kosong',
            'max_length' => 'Keterangan absen tidak boleh melebihi 250 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Ruangan Absen',
                'judul' => 'Tambah Ruangan Absen',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/absen/tambah_ruangan_absen', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'status' => $this->input->post('status', TRUE),
                'keterangan' => strip_tags($this->input->post('keterangan', TRUE)),
                'tanggal_absen' => time(),
                'kode_absen' => $kode_absen,
                'kode_kelas' => $kode_kelas,
                'kunci_rahasia' => $users['kunci_rahasia']

            ];
            $this->db->insert('anggota_absen', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil melakukan absen');
            redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
        }
    }


    // halaman ubah anggota absen
    public function ubah_ruangan_absen()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        $absen = $this->kelas->absen($kode_kelas, $kode_absen);
        $anggota_absen = $this->kelas->anggota_absen($kode_kelas, $kode_absen);
        $kunci_rahasia = $anggota_absen['kunci_rahasia'];
        cek_akses_kelas($kode_kelas);

        if (date('Y-m-d H:i:s', time()) >= $absen['batas_absen']) {
            redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
        }

        $this->form_validation->set_rules('status', 'Status', 'trim|required', [
            'required' => 'Status absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|max_length[250]', [
            'required' => 'Keterangan absen tidak boleh kosong',
            'max_length' => 'Keterangan absen tidak boleh melebihi 250 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Ruangan Absen',
                'judul' => 'Ubah Ruangan Absen',
                'anggota_absen' => $anggota_absen
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/absen/ubah_ruangan_absen', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'status' => $this->input->post('status', TRUE),
                'keterangan' => strip_tags($this->input->post('keterangan', TRUE)),
            ];

            $this->db->where(['kode_kelas' => $kode_kelas, 'kode_absen' => $kode_absen, 'kunci_rahasia' => $kunci_rahasia]);
            $this->db->update('anggota_absen', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah data absen anda');
            redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
        }
    }

    // halaman detail anggota absen
    public function detail_ruangan_absen()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_absen = $this->input->get('ka', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);
        $absen = $this->kelas->absen($kode_kelas, $kode_absen);
        $anggota_absen = $this->kelas->anggota_absen2($kode_kelas, $kode_absen, $kunci_rahasia);
        $cek_anggota_kelas = $this->kelas->cek_anggota_kelas($kode_kelas);
        cek_akses_kelas($kode_kelas);

        if (date('Y-m-d H:i:s', time()) <= $absen['batas_absen']) {
            if ($kunci_rahasia == $this->session->userdata('kunci_rahasia') || $cek_anggota_kelas['role'] == 'ketua kelas') {
                $data = [
                    'title' => 'Lihat Ruangan Absen',
                    'judul' => 'Lihat Ruangan Absen',
                    'anggota_absen' => $anggota_absen
                ];
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('kelas/absen/detail_ruangan_absen', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
            }
        } else {
            if ($kunci_rahasia == $this->session->userdata('kunci_rahasia') || $cek_anggota_kelas['role'] == 'ketua kelas') {
                $data = [
                    'title' => 'Lihat Ruangan Absen',
                    'judul' => 'Lihat Ruangan Absen',
                    'anggota_absen' => $anggota_absen
                ];
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('kelas/absen/detail_ruangan_absen', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect('kelas/rabs?kk=' . $kode_kelas . '&ka=' . $kode_absen);
            }
        }
    }

    // jadwal
    public function jadwal()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);

        $data = [
            'title' => 'Jadwal',
            'judul' => 'Jadwal',
            'jadwal' => $this->kelas->jadwalAll($kode_kelas),
            'cek_anggota_kelas' => $this->kelas->cek_anggota_kelas($kode_kelas)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/jadwal/jadwal', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_jadwal()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('kode_guru', 'Guru', 'trim|required', [
            'required' => 'Guru absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required', [
            'required' => 'Hari absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'trim|required', [
            'required' => 'Jam mulai absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'trim|required', [
            'required' => 'Jam selesai absen dibuat tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Jadwal',
                'judul' => 'Tambah Jadwal',
                'guru' => $this->kelas->guruAll($kode_kelas)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/jadwal/tambah_jadwal', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data_jadwal = [
                'kode_jadwal' => 'KDJ' . time() . rand(1000, 9999),
                'kode_guru' => $this->input->post('kode_guru', TRUE),
                'hari' => $this->input->post('hari', TRUE),
                'jam_mulai' => $this->input->post('jam_mulai', TRUE),
                'jam_selesai' => $this->input->post('jam_selesai', TRUE),
                'kode_kelas' => $kode_kelas,
                'kunci_rahasia' => $this->session->userdata('kunci_rahasia'),
            ];
            $this->db->insert('jadwal', $data_jadwal);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah jadwal kelas');
            redirect('kelas/jadwal?kk=' . $kode_kelas);
        }
    }

    public function ubah_jadwal()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_jadwal = $this->input->get('kdj', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->form_validation->set_rules('kode_guru', 'Guru', 'trim|required', [
            'required' => 'Guru absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('hari', 'Hari', 'trim|required', [
            'required' => 'Hari absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jam_mulai', 'Jam mulai', 'trim|required', [
            'required' => 'Jam mulai absen dibuat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jam_selesai', 'Jam selesai', 'trim|required', [
            'required' => 'Jam selesai absen dibuat tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Jadwal',
                'judul' => 'Ubah Jadwal',
                'jadwal' => $this->kelas->jadwal($kode_kelas, $kode_jadwal),
                'guru' => $this->kelas->guruAll($kode_kelas)
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/jadwal/ubah_jadwal', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data_jadwal = [
                'kode_guru' => $this->input->post('kode_guru', TRUE),
                'hari' => $this->input->post('hari', TRUE),
                'jam_mulai' => $this->input->post('jam_mulai', TRUE),
                'jam_selesai' => $this->input->post('jam_selesai', TRUE),
            ];
            $this->db->where(['kode_jadwal' => $kode_jadwal, 'kode_kelas' => $kode_kelas])->update('jadwal', $data_jadwal);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah jadwal kelas');
            redirect('kelas/jadwal?kk=' . $kode_kelas);
        }
    }

    public function hapus_jadwal()
    {
        $kode_kelas = $this->input->get('kk', TRUE);
        $kode_jadwal = $this->input->get('kdj', TRUE);
        cek_akses_kelas($kode_kelas);
        cek_akses_ketua($kode_kelas);

        $this->db->where(['kode_jadwal' => $kode_jadwal, 'kode_kelas' => $kode_kelas]);
        $this->db->delete('jadwal');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus jadwal kelas');
        redirect('kelas/jadwal?kk=' . $kode_kelas);
    }
}
