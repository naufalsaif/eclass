<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session_login();
        $this->load->model('Pengaturan_model', 'pengaturan');
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan',
            'judul' => '<i class="fas fa-cog text-primary"></i> Pengaturan',
            'users' => $this->pengaturan->users()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // menampilkan halaman pengaturan profile
    public function profile()
    {
        $users = $this->pengaturan->users();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|required', [
            'required' => 'Jenis Kelamin tidak boleh kosong',
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
                'title' => 'Pengaturan Profile',
                'judul' => 'Pengaturan Profile',
                'kelas_user' => $this->pengaturan->kelas_user(),
                'users' => $users,
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/profile', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // validasinya success
            $data = [
                'nama' => strip_tags($this->input->post('nama', TRUE)),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'bio' => strip_tags($this->input->post('bio', TRUE))
            ];
            $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
            $this->db->update('users', $data);

            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui profile');
            redirect('pengaturan');
        }
    }

    public function username()
    {
        // pengecekan waktu aktivitas user merubah username
        $cek_aktivitas_user = $this->pengaturan->cek_aktivitas_user();
        $waktu_terbuka = $cek_aktivitas_user['tanggal_aktivitas'] + (60 * 60 * 24 * 7); // 7 hari
        $selisih = time() - $cek_aktivitas_user['tanggal_aktivitas'] >= (60 * 60 * 24 * 7);

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|is_unique[users.username]|min_length[6]', [
            'required' => 'Username tidak boleh kosong',
            'alpha_dash' => 'Username hanya berisi karakter alfanumerik, garis bawah, dan tanda hubung',
            'is_unique' => 'Username sudah terdaftar',
            'min_length' => 'Username minimal 6 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Pengaturan Username',
                'judul' => 'Pengaturan Username',
                'users' => $this->pengaturan->users(),
                'waktu_terbuka' => date('Y-m-d H:i:s', $waktu_terbuka),
                'selisih' => $selisih,
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/username', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_username();
        }
    }

    private function _username()
    {
        $users = $this->pengaturan->users();
        // pengecekan waktu aktivitas user merubah username
        $cek_aktivitas_user = $this->pengaturan->cek_aktivitas_user();
        $selisih = time() - $cek_aktivitas_user['tanggal_aktivitas'] >= (60 * 60 * 24 * 7); // 7hari
        $username = $this->input->post('username', TRUE);

        if (!$cek_aktivitas_user) {
            $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
            $this->db->update('users', ['username' => $username]);

            // user aktivitas
            $aktivitas_user = [
                'email' => $users['email'],
                'email_baru' => '',
                'token' => '',
                'status' => 'ubah username',
                'tanggal_aktivitas' => time(),
                'kode_aktivitas' => '0',
                'kunci_rahasia' => $users['kunci_rahasia']
            ];
            $this->db->insert('aktivitas_user', $aktivitas_user);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui username');
            redirect('pengaturan');
        } else {
            if ($selisih) {
                $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
                $this->db->update('users', ['username' => $username]);

                // user aktivitas
                $aktivitas_user = [
                    'email' => $users['email'],
                    'email_baru' => '',
                    'token' => '',
                    'status' => 'ubah username',
                    'tanggal_aktivitas' => time(),
                    'kode_aktivitas' => '0',
                    'kunci_rahasia' => $users['kunci_rahasia']
                ];
                $this->db->where(['status' => 'ubah username', 'kunci_rahasia' => $users['kunci_rahasia']]);
                $this->db->update('aktivitas_user', $aktivitas_user);
                $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui username');
                redirect('pengaturan');
            } else {
                $this->session->set_flashdata('wrong', 'Mohon tunggu 7 hari setelah merubah username');
                redirect('pengaturan');
            }
        }
    }

    public function telepon()
    {
        $users = $this->pengaturan->users();
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|numeric|is_unique[users.telepon]', [
            'required' => 'Telepon tidak boleh kosong',
            'numeric' => 'Telepon hanya berisi angka',
            'is_unique' => 'Telepon sudah terdaftar'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Pengaturan Telepon',
                'judul' => 'Pengaturan Telepon',
                'users' => $this->pengaturan->users()
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/telepon', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
            $this->db->update('users', ['telepon' => $this->input->post('telepon', TRUE)]);
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui telepon');
            redirect('pengaturan');
        }
    }

    public function email()
    {
        $users = $this->pengaturan->users();
        $cek_aktivitas_email = $this->pengaturan->cek_aktivitas_email();
        $selisih = time() - $users['aktivitas_email'] >= (60 * 60 * 24 * 7);
        $waktu_terbuka = $users['aktivitas_email'] + (60 * 60 * 24 * 7);

        if ($cek_aktivitas_email) {
            redirect('pengaturan/verivikasi');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Pengaturan Email',
                'judul' => 'Pengaturan Email',
                'users' => $this->pengaturan->users(),
                'selisih' => $selisih,
                'waktu_terbuka' => date('Y-m-d H:i:s', $waktu_terbuka)
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/email', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_email();
        }
    }

    // simpan email baru
    public function _email()
    {
        $users = $this->pengaturan->users();
        $password = $this->input->post('password', TRUE);
        $email = $this->input->post('email', TRUE);
        $selisih = time() - $users['aktivitas_email'] >= (60 * 60 * 24 * 7);

        if ($selisih == false) {
            // jika belum lewat 7 hari
            $this->session->set_flashdata('message', 'Anda belum bisa mengganti email tunggu 7 hari setelah perubahan!');
            redirect('pengaturan');
        } else {
            if (password_verify($password, $users['password'])) {
                // jika password benar
                $aktivitas_user = [
                    'email' => $users['email'],
                    'email_baru' => $email,
                    'token' => '',
                    'status' => 'ubah email',
                    'tanggal_aktivitas' => time(),
                    'kode_aktivitas' => '0',
                    'kunci_rahasia' => $users['kunci_rahasia']
                ];
                $this->db->insert('aktivitas_user', $aktivitas_user);
                redirect('pengaturan/verivikasi');
            } else {
                $this->session->set_flashdata('wrong', 'Password yang anda masukkan salah');
                redirect('pengaturan/email');
            }
        }
    }

    public function hapus_email_baru()
    {
        $users = $this->pengaturan->users();

        // hapus token
        $this->db->where(['status' => 'ubah email', 'kunci_rahasia' => $users['kunci_rahasia']]);
        $this->db->delete('aktivitas_user');
        redirect('pengaturan/email');
    }

    public function verivikasi()
    {
        $users = $this->pengaturan->users();
        $cek_aktivitas_email = $this->pengaturan->cek_aktivitas_email();
        $selisih = time() - $users['aktivitas_email'] >= (60 * 60 * 24 * 7);

        if ($selisih == false) {
            redirect('pengaturan');
        } else {
            if (!$cek_aktivitas_email) {
                redirect('pengaturan/email');
            } else {
                $data = [
                    'title' => 'Verivikasi Email Baru',
                    'judul' => 'Verivikasi Email Baru',
                    'users' => $this->pengaturan->users(),
                    'cek_aktivitas_email' => $cek_aktivitas_email
                ];

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pengaturan/k_verivikasi', $data);
                $this->load->view('templates/footer', $data);
            }
        }
    }

    public function e_verivikasi()
    {
        $users = $this->pengaturan->users();
        $cek_aktivitas_email = $this->pengaturan->cek_aktivitas_email();
        $selisih = time() - $cek_aktivitas_email['kode_aktivitas'] >= (60 * 10); //10 menit
        $kunci_rahasia = $users['kunci_rahasia'];
        $kode_verivikasi = rand(100000, 999999);
        $email_baru = $cek_aktivitas_email['email_baru'];
        $selisih_email = time() - $users['aktivitas_email'] >= (60 * 60 * 24 * 7);


        if ($selisih_email == false) {
            redirect('pengaturan');
        } else {
            if ($selisih == false) {
                $this->session->set_flashdata('wrong', 'Tunggu 10 menit untuk meminta kode kembali');
                redirect('pengaturan/verivikasi');
            } else {
                $config = [
                    'mailtype'    => 'html',
                    'charset'    => 'utf-8',
                    'protocol'    => 'smtp',
                    'smtp_host'    => 'ssl://smtp.googlemail.com',
                    'smtp_user'    => 'email@anda.com', // masukkan email anda 
                    'smtp_pass'    => 'password', // masukkan password anda
                    'smtp_port'    => '465',
                    'crlf'        => "\r\n",
                    'newline'    => "\r\n"
                ];


                $this->load->library('email', $config);
                $this->email->initialize($config);
                $this->email->from('no-reply@kelasku.com', 'Kelasku');
                $this->email->to($email_baru);
                $this->email->subject('Kode Verivikasi');
                $this->email->message('Kode Verivikasi anda : ' . $kode_verivikasi . '<br>tanggal : ' . date('Y/m/d H:i:s'));
                if ($this->email->send()) {
                    $aktivitas_user = [
                        'token' => $kode_verivikasi,
                        'kode_aktivitas' => time()
                    ];
                    $this->db->where(['status' => 'ubah email', 'kunci_rahasia' => $kunci_rahasia]);
                    $this->db->update('aktivitas_user', $aktivitas_user);

                    $this->session->set_flashdata('sweetalert', 'Kode verivikasi sudah terkirim silahkan cek email');
                    redirect('pengaturan/verivikasi');
                } else {
                    // echo $this->email->print_debugger();
                    // die;
                    // return $this->session->set_flashdata('message', $this->email->print_debugger());
                    $this->session->set_flashdata('wrong', 'Email gagal dikirim, silahkan coba lagi');
                    redirect('pengaturan/verivikasi');
                }
            }
        }
    }

    public function k_verivikasi()
    {
        $users = $this->pengaturan->users();
        $cek_aktivitas_email = $this->pengaturan->cek_aktivitas_email();
        $selisih = time() - $cek_aktivitas_email['kode_aktivitas'] <= (60 * 60 * 24); // 1 hari 
        $token = $this->input->post('token', TRUE);
        $email_baru = $cek_aktivitas_email['email_baru'];
        $kunci_rahasia = $cek_aktivitas_email['kunci_rahasia'];
        $selisih_email = time() - $users['aktivitas_email'] >= (60 * 60 * 24 * 7);

        if ($token) {
            if ($selisih_email == false) {
                redirect('pengaturan');
            } else {
                if ($selisih == true) {
                    if ($cek_aktivitas_email['token'] == $token) {
                        $data = [
                            'email' => $email_baru,
                            'aktivitas_email' => time()
                        ];
                        $this->db->where(['kunci_rahasia' => $kunci_rahasia]);
                        $this->db->update('users', $data);

                        // hapus
                        $this->db->where(['status' => 'ubah email', 'kunci_rahasia' => $kunci_rahasia]);
                        $this->db->delete('aktivitas_user');

                        $this->session->sess_destroy();
                        redirect('auth');
                    } else {
                        $this->session->set_flashdata('wrong', 'Kode verivikasi anda tidak valid');
                        redirect('pengaturan/verivikasi');
                    }
                } else {
                    $this->session->set_flashdata('wrong', 'Kode verivikasi anda sudah tidak aktif');
                    redirect('pengaturan/verivikasi');
                }
            }
        } else {
            $this->session->set_flashdata('wrong', 'Masukkan kode verivikasi');
            redirect('pengaturan/verivikasi');
        }
    }

    public function password()
    {
        $users = $this->pengaturan->users();
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'password tidak boleh kosong',
            'min_length' => 'Password minimal 8 karakter'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'required' => 'password tidak boleh kosong',
            'matches' => 'password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]', [
            'required' => 'password tidak boleh kosong',
            'matches' => 'password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Pengaturan Password',
                'judul' => 'Pengaturan Password',
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/password', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $password_lama = $this->input->post('password');
            $password_baru = $this->input->post('password1');
            if (!password_verify($password_lama, $users['password'])) {
                $this->session->set_flashdata('wrong', 'Password yang anda masukkan salah');
                redirect('pengaturan/password');
            } else {
                if (password_verify($password_baru, $users['password'])) {
                    $this->session->set_flashdata('wrong', 'Password baru sama dengan password lama silahkan ubah dengan sandi yang lebih rumit');
                    redirect('pengaturan/password');
                } else {
                    //password sudah oke
                    $this->db->set('password', password_hash($password_baru, PASSWORD_DEFAULT));
                    $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
                    $this->db->update('users');
                    $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui password');
                    redirect('pengaturan');
                }
            }
        }
    }

    public function avatar()
    {

        $users = $this->pengaturan->users();
        $avatar = $this->input->post('avatar', TRUE);
        $this->form_validation->set_rules('avatar', 'Password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Avatar',
                'judul' => '<i class="far fa-image text-primary"></i> Avatar',
                'users' => $this->pengaturan->users(),
                'avatar' => $this->pengaturan->avatarAll()
            ];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/avatar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->set('avatar', $avatar);
            $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
            $this->db->update('users');
            $this->session->set_flashdata('sweetalert', 'Anda berhasil memperbaharui avatar');
            redirect('pengaturan');
        }
    }
}
