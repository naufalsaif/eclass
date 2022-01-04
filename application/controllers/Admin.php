<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session_login();
        cek_role_admin();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'judul' => '<i class="fas fa-chart-pie text-primary"></i> Dashboard',
            'total_users' => $this->admin->total_users(),
            'total_kelas' => $this->admin->total_kelas(),
            'total_avatar' => $this->admin->total_avatar(),
            'total_tema' => $this->admin->total_tema(),
            'total_laporan' => $this->admin->total_laporan(),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function users()
    {
        $data = [
            'title' => 'Users',
            'judul' => 'Users',
            'users' => $this->admin->users_all()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_user()
    {
        $kunci_rahasia = $this->input->get('kr', TRUE);

        $data = [
            'title' => 'Lihat User',
            'judul' => 'Lihat User',
            'user' => $this->admin->user($kunci_rahasia)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users/lihat_user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|is_unique[users.username]|min_length[6]', [
            'required' => 'Username tidak boleh kosong',
            'alpha_dash' => 'Username hanya berisi karakter alfanumerik, garis bawah, dan tanda hubung',
            'is_unique' => 'Username sudah terdaftar',
            'min_length' => 'Username minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|required', [
            'required' => 'Jenis kelamin tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|numeric|is_unique[users.telepon]', [
            'required' => 'Telepon tidak boleh kosong',
            'numeric' => 'Telepon hanya berisi angka',
            'is_unique' => 'Telepon sudah terdaftar'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required', [
            'required' => 'Tanggal lahir tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required', [
            'required' => 'Kelas tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('bio', 'Bio', 'trim|required|max_length[250]', [
            'required' => 'Bio tidak boleh kosong',
            'max_length' => 'Bio tidak boleh melebihi 250 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah User',
                'judul' => 'Tambah User',
                'kelas' => $this->admin->kelas_user()
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/users/tambah_user', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_tambah_user();
        }
    }

    private function _tambah_user()
    {
        $kunci_rahasia = 'KR' . time() . rand(1000, 9999);
        $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
        if ($jenis_kelamin == 'Pria') {
            $avatar = 'KAV16365409614318';
        } else {
            $avatar = 'KAV16365409759218';
        }

        $data = [
            'username' => $this->input->post('username', TRUE),
            'email' => $this->input->post('email', TRUE),
            'nama' => strip_tags($this->input->post('nama', TRUE)),
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
            'jenis_kelamin' => $jenis_kelamin,
            'telepon' => $this->input->post('telepon', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
            'kelas' => $this->input->post('kelas', TRUE),
            'bio' => strip_tags($this->input->post('bio', TRUE)),
            'avatar' => $avatar,
            'role' => 'user',
            'aktif' => '1',
            'salah_password' => '0',
            'blokir' => '0',
            'tanggal_buat' => time(),
            'aktivitas_login' => '0',
            'aktivitas_email' => '0',
            'online' => '0',
            'kunci_rahasia' => $kunci_rahasia
        ];
        $this->db->insert('users', $data);

        $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah data user');
        redirect('admin/users');
    }

    public function ubah_user()
    {
        $kunci_rahasia = $this->input->get('kr', TRUE);
        $password = $this->input->post('password', TRUE);

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]', [
            'min_length' => 'Password minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|required', [
            'required' => 'Jenis kelamin tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required', [
            'required' => 'Tanggal lahir tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required', [
            'required' => 'Kelas tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('bio', 'Bio', 'trim|required|max_length[250]', [
            'required' => 'Bio tidak boleh kosong',
            'max_length' => 'Bio tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('role', 'role', 'trim|required', [
            'required' => 'Role tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('aktif', 'aktif', 'trim|required', [
            'required' => 'Aktif akun tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('salah_password', 'salah password', 'trim|required', [
            'required' => 'Salah password akun tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('blokir', 'blokir', 'trim|required', [
            'required' => 'Blokir akun tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Users',
                'judul' => 'Ubah Users',
                'user' => $this->admin->user($kunci_rahasia),
                'kelas' => $this->admin->kelas_user(),
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/users/ubah_user', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if (!$password || $password == '') {
                $data = [
                    'nama' => strip_tags($this->input->post('nama', TRUE)),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                    'kelas' => $this->input->post('kelas', TRUE),
                    'bio' => strip_tags($this->input->post('bio', TRUE)),
                    'role' => $this->input->post('role', TRUE),
                    'aktif' => $this->input->post('aktif', TRUE),
                    'salah_password' => $this->input->post('salah_password', TRUE),
                    'blokir' => $this->input->post('blokir', TRUE),
                ];
            } else {
                $data = [
                    'nama' => strip_tags($this->input->post('nama', TRUE)),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                    'kelas' => $this->input->post('kelas', TRUE),
                    'bio' => strip_tags($this->input->post('bio', TRUE)),
                    'role' => $this->input->post('role', TRUE),
                    'aktif' => $this->input->post('aktif', TRUE),
                    'salah_password' => $this->input->post('salah_password', TRUE),
                    'blokir' => $this->input->post('blokir', TRUE),
                ];
            }
            $this->db->where('kunci_rahasia', $kunci_rahasia);
            $this->db->update('users', $data);

            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui data user');
            redirect('admin/users');
        }
    }

    public function verivikasi_user()
    {
        $kunci_rahasia = $this->input->get('kr', TRUE);

        $data = [
            'title' => 'Verivikasi User',
            'judul' => 'Verivikasi User',
            'aktivitas_user' => $this->admin->aktivitas_user($kunci_rahasia)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users/verivikasi_user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function verivikasi()
    {
        $kunci_rahasia = $this->input->get('kr', TRUE);
        $user = $this->admin->user($kunci_rahasia);
        $token = base64_encode(random_bytes(32));

        $this->form_validation->set_rules('status', 'status', 'trim|required', [
            'required' => 'Status akun tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email_baru', 'email baru', 'trim|valid_email|is_unique[users.email]', [
            'valid_email' => 'Format Email yang anda masukkan salah',
            'is_unique' => 'Email sudah terdaftar',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Verivikasi Token',
                'judul' => 'Verivikasi Token',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/users/verivikasi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $status = $this->input->post('status', TRUE);
            $email_baru = $this->input->post('email_baru', TRUE);
            $cek_aktivitas_user = $this->admin->cek_aktivitas_user($status, $kunci_rahasia);
            if (!$cek_aktivitas_user) {
                // jika tidak ada data di aktivitas user maka buat data baru
                if ($status == 'ubah email') {
                    // jika status ubah email
                    if (!$email_baru || $email_baru == '') {
                        // jika data email baru tidak ada
                        $this->session->set_flashdata('wrong', 'Masukkan email baru');
                        redirect('admin/verivikasi?kr=' . $kunci_rahasia);
                    } else {
                        // jika data email baru ada
                        $data_aktivitas = [
                            'email' => $user['email'],
                            'email_baru' => $email_baru,
                            'token' => rand(100000, 999999),
                            'status' => $status,
                            'tanggal_aktivitas' => time(),
                            'kode_aktivitas' => time(),
                            'kunci_rahasia' => $kunci_rahasia
                        ];
                        $this->db->insert('aktivitas_user', $data_aktivitas);
                    }
                } else {
                    // jika status yang lain
                    $data_aktivitas = [
                        'email' => $user['email'],
                        'email_baru' => '',
                        'token' => $token,
                        'status' => $status,
                        'tanggal_aktivitas' => time(),
                        'kode_aktivitas' => time(),
                        'kunci_rahasia' => $kunci_rahasia
                    ];
                    $this->db->insert('aktivitas_user', $data_aktivitas);
                }
            } else {
                // jika data sudah ada di database akan di update
                if ($status == 'ubah email') {
                    // jika status email
                    if (!$email_baru || $email_baru == '') {
                        // jika data email baru tidak ada
                        $this->session->set_flashdata('wrong', 'Masukkan email baru');
                        redirect('admin/verivikasi?kr=' . $kunci_rahasia);
                    } else {
                        // jika data email baru ada
                        $data_aktivitas = [
                            'email_baru' => $email_baru,
                            'token' => rand(100000, 999999),
                            'tanggal_aktivitas' => time(),
                            'kode_aktivitas' => time()
                        ];
                        $this->db->where(['status' => $status, 'kunci_rahasia' => $kunci_rahasia]);
                        $this->db->update('aktivitas_user', $data_aktivitas);
                    }
                } else {
                    // jika status lain
                    $data_aktivitas = [
                        'token' => $token,
                        'tanggal_aktivitas' => time(),
                        'kode_aktivitas' => time(),
                    ];
                    $this->db->where(['status' => $status, 'kunci_rahasia' => $kunci_rahasia]);
                    $this->db->update('aktivitas_user', $data_aktivitas);
                }
            }

            $this->session->set_flashdata('sweetalert', 'Token berhasil ditambahkan');
            redirect('admin/verivikasi_user?kr=' . $kunci_rahasia);
        }
    }

    public function lihat_token()
    {
        $id = $this->input->get('id', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);

        $data = [
            'title' => 'Lihat Token',
            'judul' => 'Lihat Token',
            'cek_token' => $this->admin->cek_token($id, $kunci_rahasia)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users/lihat_token', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapus_token()
    {
        $id = $this->input->get('id', TRUE);
        $kunci_rahasia = $this->input->get('kr', TRUE);

        $this->db->where(['id' => $id, 'kunci_rahasia' => $kunci_rahasia]);
        $this->db->delete('aktivitas_user');
        $this->session->set_flashdata('sweetalert', 'Token berhasil dihapus');
        redirect('admin/verivikasi_user?kr=' . $kunci_rahasia);
    }

    public function hapus_user()
    {
        $kunci_rahasia = $this->input->get('kr', TRUE);
        $this->db->where('kunci_rahasia', $kunci_rahasia);
        $this->db->delete('users');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus user');
        redirect('admin/users');
    }

    public function kelas()
    {
        $data = [
            'title' => 'Kelas',
            'judul' => 'Kelas',
            'kelas' => $this->admin->kelas_all()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);

        $data = [
            'title' => 'Lihat Kelas',
            'judul' => 'Lihat Kelas',
            'kelas' => $this->admin->kelas($kode_kelas),
            'kelas_anggota' => $this->admin->kelas_anggota($kode_kelas),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas/lihat_kelas', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman informasi kelas
    public function ubah_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required', [
            'required' => 'Nama kelas tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|max_length[250]', [
            'required' => 'Deskripsi tidak boleh kosong',
            'max_length' => 'Deskripsi tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('aktif', 'aktif', 'trim|required', [
            'required' => 'Aktif tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Kelas',
                'judul' => 'Ubah Kelas',
                'kelas' => $this->admin->kelas($kode_kelas),
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kelas/ubah_kelas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $kode_kelas = $this->input->get('kk', TRUE);

            $data = [
                'nama_kelas' => strip_tags($this->input->post('nama_kelas', TRUE)),
                'deskripsi' => strip_tags($this->input->post('deskripsi', TRUE)),
                'aktif' => $this->input->post('aktif', TRUE)
            ];
            $this->db->where('kode_kelas', $kode_kelas)->update('kelas', $data);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui kelas');
            redirect('admin/kelas');
        }
    }

    public function hapus_kelas()
    {
        $kode_kelas = $this->input->get('kk', TRUE);

        $this->db->where('kode_kelas', $kode_kelas)->delete('kelas');
        $this->db->where('kode_kelas', $kode_kelas)->delete('tugas');
        $this->db->where('kode_kelas', $kode_kelas)->delete('anggota_tugas');
        $this->db->where('kode_kelas', $kode_kelas)->delete('guru');
        $this->db->where('kode_kelas', $kode_kelas)->delete('anggota_kelas');
        $this->db->where('kode_kelas', $kode_kelas)->delete('absen');
        $this->db->where('kode_kelas', $kode_kelas)->delete('anggota_absen');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus semua data kelas');
        redirect('admin/kelas');
    }

    public function avatar()
    {

        $data = [
            'title' => 'Avatar',
            'judul' => 'Avatar',
            'avatar' => $this->admin->avatar_all(),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/avatar/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_avatar()
    {
        $this->form_validation->set_rules('nama_avatar', 'Nama avatar', 'trim|required', [
            'required' => 'Nama avatar tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'url', 'trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Avatar',
                'judul' => 'Tambah Avatar',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/avatar/tambah_avatar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_tambah_avatar();
        }
    }

    private function _tambah_avatar()
    {
        $nama_avatar = $this->input->post('nama_avatar', TRUE);

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['url']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = '1024';
            $config['upload_path'] = './layout/img/avatar/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('url')) {
                // jika upload berhasil
                $new_image = $this->upload->data('file_name');
                $data_avatar = [
                    'kode_avatar' => 'KAV' . time() . rand(1000, 9999),
                    'nama_avatar' => strip_tags($nama_avatar),
                    'url' => $new_image,
                ];
                $this->db->insert('avatar', $data_avatar);
                $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah avatar baru');
                redirect('admin/avatar');
            } else {
                // jika upload gagal
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('wrong', 'Gagal menambah avatar baru, coba lagi');
                redirect('admin/tambah_avatar');
            }
        } else {
            $this->session->set_flashdata('wrong', 'Gagal menambah avatar baru, coba lagi');
            redirect('admin/tambah_avatar');
        }
    }

    public function ubah_avatar()
    {
        $kode_avatar = $this->input->get('kav', TRUE);
        $avatar = $this->admin->avatar($kode_avatar);
        if ($kode_avatar == 'KAV16365409614318' || $kode_avatar == 'KAV16365409759218' || $kode_avatar == '' || !$avatar) {
            redirect('admin/avatar');
        }

        $this->form_validation->set_rules('nama_avatar', 'Nama avatar', 'trim|required', [
            'required' => 'Nama avatar tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'url', 'trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah Avatar',
                'judul' => 'Ubah Avatar',
                'avatar' => $avatar,
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/avatar/ubah_avatar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_ubah_avatar();
        }
    }

    private function _ubah_avatar()
    {
        $nama_avatar = $this->input->post('nama_avatar', TRUE);
        $kode_avatar = $this->input->get('kav', TRUE);
        $avatar = $this->admin->avatar($kode_avatar);

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['url']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = '1024';
            $config['upload_path'] = './layout/img/avatar/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('url')) {
                // jika upload berhasil
                $old_image = $avatar['url'];
                if ($old_image != 'default_male.png' && $old_image != 'default_female.png') {
                    unlink(FCPATH . 'layout/img/avatar/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('url', $new_image);
            } else {
                // jika upload gagal
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('wrong', 'Gagal menambah avatar, coba lagi');
                redirect('admin/ubah_avatar?kav' . $kode_avatar);
            }
        }
        $this->db->set('nama_avatar', strip_tags($nama_avatar));
        $this->db->where('kode_avatar', $kode_avatar);
        $this->db->update('avatar');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah avatar');
        redirect('admin/avatar');
    }

    // public function hapus_avatar()
    // {
    //     $kode_avatar = $this->input->get('kav', TRUE);
    //     $avatar = $this->admin->avatar($kode_avatar);
    //     if ($kode_avatar == 'KAV16364452367961' || $kode_avatar == 'KAV16364452558108' || $kode_avatar == '' || !$avatar) {
    //         redirect('admin/avatar');
    //     }

    //     $old_image = $avatar['url'];
    //     if ($old_image != 'default_male.png' && $old_image != 'default_female.png') {
    //         unlink(FCPATH . 'layout/img/avatar/' . $old_image);
    //     }
    //     $this->db->where('kode_avatar', $kode_avatar);
    //     $this->db->delete('avatar');
    //     $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus data avatar');
    //     redirect('admin/avatar');
    // }

    public function tema()
    {

        $data = [
            'title' => 'Tema',
            'judul' => 'Tema',
            'tema' => $this->admin->tema_all(),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tema/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_tema()
    {
        $this->form_validation->set_rules('nama_tema', 'Nama tema', 'trim|required', [
            'required' => 'Nama tema tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'url', 'trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Tema',
                'judul' => 'Tambah Tema',
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tema/tambah_tema', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_tambah_tema();
        }
    }

    private function _tambah_tema()
    {
        $nama_tema = $this->input->post('nama_tema', TRUE);

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['url']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = '1024';
            $config['upload_path'] = './layout/img/tema/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('url')) {
                // jika upload berhasil
                $new_image = $this->upload->data('file_name');
                $data_tema = [
                    'kode_tema' => 'KTM' . time() . rand(1000, 9999),
                    'nama_tema' => strip_tags($nama_tema),
                    'url' => $new_image,
                ];
                $this->db->insert('tema', $data_tema);
                $this->session->set_flashdata('sweetalert', 'Anda berhasil menambah tema baru');
                redirect('admin/tema');
            } else {
                // jika upload gagal
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('wrong', 'Gagal menambah tema baru, coba lagi');
                redirect('admin/tambah_tema');
            }
        } else {
            $this->session->set_flashdata('wrong', 'Gagal menambah tema baru, coba lagi');
            redirect('admin/tambah_tema');
        }
    }

    public function ubah_tema()
    {
        $kode_tema = $this->input->get('ktm', TRUE);
        $tema = $this->admin->tema($kode_tema);
        if ($kode_tema == 'KTM16365920859103' || $kode_tema == '' || !$tema) {
            redirect('admin/tema');
        }

        $this->form_validation->set_rules('nama_tema', 'Nama tema', 'trim|required', [
            'required' => 'Nama tema tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'url', 'trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Ubah tema',
                'judul' => 'Ubah tema',
                'tema' => $tema,
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tema/ubah_tema', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_ubah_tema();
        }
    }

    private function _ubah_tema()
    {
        $nama_tema = $this->input->post('nama_tema', TRUE);
        $kode_tema = $this->input->get('ktm', TRUE);
        $tema = $this->admin->tema($kode_tema);

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['url']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = '1024';
            $config['upload_path'] = './layout/img/tema/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('url')) {
                // jika upload berhasil
                $old_image = $tema['url'];
                if ($old_image != 'tema1.png') {
                    unlink(FCPATH . 'layout/img/tema/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('url', $new_image);
            } else {
                // jika upload gagal
                // echo $this->upload->display_errors();
                $this->session->set_flashdata('wrong', 'Gagal menambah tema, coba lagi');
                redirect('admin/ubah_tema?ktm=' . $kode_tema);
            }
        }
        $this->db->set('nama_tema', strip_tags($nama_tema));
        $this->db->where('kode_tema', $kode_tema);
        $this->db->update('tema');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil mengubah tema');
        redirect('admin/tema');
    }

    // public function hapus_tema()
    // {
    //     $kode_tema = $this->input->get('ktm', TRUE);
    //     $tema = $this->admin->tema($kode_tema);
    //     if ($kode_tema == 'ktm001' || $kode_tema == '' || !$tema) {
    //         redirect('admin/tema');
    //     }

    //     $old_image = $tema['url'];
    //     if ($old_image != 'tema1.png') {
    //         unlink(FCPATH . 'layout/img/tema/' . $old_image);
    //     }
    //     $this->db->where('kode_tema', $kode_tema);
    //     $this->db->delete('tema');
    //     $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus data tema');
    //     redirect('admin/tema');
    // }

    public function laporan()
    {
        $data = [
            'title' => 'Laporan',
            'judul' => 'Laporan',
            'laporan' => $this->admin->laporan_all()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_laporan()
    {
        $kode_laporan = $this->input->get('kl', TRUE);

        $data = [
            'title' => 'Lihat Laporan',
            'judul' => 'Lihat Laporan',
            'laporan' => $this->admin->laporan($kode_laporan)
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan/lihat_laporan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function baca_laporan()
    {
        $kode_laporan = $this->input->get('kl', TRUE);

        $this->db->set('lihat', '1');
        $this->db->where('kode_laporan', $kode_laporan);
        $this->db->update('laporan');
        $this->session->set_flashdata('sweetalert', 'Anda sudah membaca laporan ' . $kode_laporan);
        redirect('admin/laporan');
    }

    public function hapus_laporan()
    {
        $kode_laporan = $this->input->get('kl', TRUE);

        $this->db->where('kode_laporan', $kode_laporan);
        $this->db->delete('laporan');
        $this->session->set_flashdata('sweetalert', 'Anda berhasil menghapus laporan ' . $kode_laporan);
        redirect('admin/laporan');
    }
}
