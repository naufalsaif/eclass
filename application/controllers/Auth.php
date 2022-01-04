<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
        $this->load->library('form_validation');
        cek_session_auth();
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password terlalu pendek',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Login'
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('auth/footer', $data);
        } else {
            // validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $verifikasi_data = $this->auth->users();
        $password = password_verify($this->input->post('password', TRUE), $verifikasi_data['password']);
        // cek email
        if (!$verifikasi_data) {
            $this->session->set_flashdata('error', 'Email atau password anda salah');
            redirect('auth');
        } else {
            // cek password
            if ($password == false) {
                if ($verifikasi_data['blokir'] == 1) {
                    $this->session->set_flashdata('error', 'Password yang anda masukkan salah. akun anda sedang diblokir, silahkan klik bantu saya.');
                    redirect('auth');
                } else {
                    // cek salah_password
                    $sisa_kesempatan = 4 - $verifikasi_data['salah_password'];
                    if ($verifikasi_data['salah_password'] == 4) {
                        $this->db->set('blokir', 'blokir + 1', FALSE)->where('email', $verifikasi_data['email'])->update('users');
                        $this->db->set('salah_password', 'salah_password + 1', false)->where('email', $verifikasi_data['email'])->update('users');
                        $this->session->set_flashdata('error', 'Akun anda terblokir silahkan klik bantu saya');
                        redirect('auth');
                    } else {
                        $this->db->set('salah_password', 'salah_password + 1', false)->where('email', $verifikasi_data['email'])->update('users');
                        $this->session->set_flashdata('error', 'Password yang anda masukkan salah, sisa kesempatan anda ' . $sisa_kesempatan . ' kali lagi');
                        redirect('auth');
                    }
                }
            } else {
                // cek aktif atau tidak
                if ($verifikasi_data['aktif'] == 0) {
                    $this->session->set_flashdata('error', 'Akun anda belum aktif, silahkan cek email anda.');
                    redirect('auth');
                } else {
                    // cek akun di blokir atau tidak
                    if ($verifikasi_data['blokir'] == 1) {
                        $this->session->set_flashdata('error', 'Akun anda sedang diblokir, silahkan klik bantu saya');
                        redirect('auth');
                    } else {
                        $this->db->where('email', $verifikasi_data['email'])->update('users', ['salah_password' => '0', 'aktivitas_login' => time(), 'online' => '1']);
                        $data = [
                            'kunci_rahasia' => $verifikasi_data['kunci_rahasia'],
                            'role' => $verifikasi_data['role'],
                        ];
                        $this->session->set_userdata($data);
                        $this->session->session_aktif = true;
                        // cek role
                        if ($verifikasi_data['role'] == 'admin') {
                            $this->session->set_flashdata('sweetalert', 'Anda berhasil login, Selamat datang ' . $verifikasi_data['nama']);
                            redirect('admin');
                        } else {
                            $this->session->set_flashdata('sweetalert', 'Anda berhasil login, Selamat datang ' . $verifikasi_data['nama']);
                            redirect('users');
                        }
                    }
                }
            }
        }
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Registrasi'
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/registrasi', $data);
            $this->load->view('auth/footer', $data);
        } else {
            $this->_registrasi();
        }
    }

    private function _registrasi()
    {
        $email = $this->input->post('email', TRUE);
        $users = $this->auth->users();
        $kunci_rahasia = 'KR' . time() . rand(1000, 9999);
        $token = base64_encode(random_bytes(32));
        if (!$users) {
            $data = [
                'username' => '',
                'email' => $email,
                'nama' => '',
                'password' => password_hash($this->input->post('password1', TRUE), PASSWORD_DEFAULT),
                'jenis_kelamin' => '',
                'telepon' => '',
                'tanggal_lahir' => '',
                'kelas' => '',
                'bio' => '',
                'avatar' => '',
                'role' => 'user',
                'aktif' => '0',
                'salah_password' => '0',
                'blokir' => '0',
                'tanggal_buat' => time(),
                'aktivitas_login' => '0',
                'aktivitas_email' => '0',
                'online' => '0',
                'kunci_rahasia' => $kunci_rahasia
            ];


            $data_aktivitas = [
                'email' => $email,
                'email_baru' => '',
                'token' => $token,
                'status' => 'aktivasi',
                'tanggal_aktivitas' => time(),
                'kode_aktivitas' => time(),
                'kunci_rahasia' => $kunci_rahasia
            ];


            if ($this->_sendEmail($token, 'aktivasi', $email) == false) {
                $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
            } else {
                $this->db->insert('users', $data);
                $this->db->insert('aktivitas_user', $data_aktivitas);
                $this->session->set_flashdata('message', 'Selamat akun berhasil dibuat, silahkan cek email untuk aktivasi akun anda!');
            }

            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Akun anda sudah terdaftar!');
            redirect('auth/registrasi');
        }
    }


    public function aktivasi()
    {
        $kelas = $this->auth->kelas_user();
        $email = $this->input->get('email', TRUE);
        $token = $this->input->get('token', TRUE);

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|is_unique[users.username]|min_length[6]', [
            'required' => 'Username tidak boleh kosong',
            'alpha_dash' => 'Username hanya berisi karakter alfanumerik, garis bawah, dan tanda hubung',
            'is_unique' => 'Username sudah terdaftar',
            'min_length' => 'Username minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required', [
            'required' => 'Nama lengkap tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'trim|required', [
            'required' => 'Jenis kelamin tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|is_unique[users.telepon]|numeric', [
            'required' => 'Telepon tidak boleh kosong',
            'is_unique' => 'Telepon sudah terdaftar',
            'numeric' => 'Telepon hanya berisi angka',
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'trim|required', [
            'required' => 'Tanggal lahir tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('bio', 'Bio', 'trim|required|max_length[250]', [
            'required' => 'Bio tidak boleh kosong',
            'max_length' => 'Bio tidak boleh melebihi 250 karakter'
        ]);
        $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required', [
            'required' => 'Mohon klik saya menyetujui jika anda ingin mengaktivasi akun anda',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aktivasi',
                'kelas' => $kelas
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/aktivasi', $data);
            $this->load->view('auth/footer', $data);
        } else {
            $this->_aktivasi();
        }
    }

    private function _aktivasi()
    {
        $kelas = $this->auth->kelas_user();
        $email = $this->input->get('email', TRUE);
        $token = $this->input->get('token', TRUE);
        // validasinya success
        $users = $this->db->get_where('users', ['email' => $email])->row_array();
        $cek_token = $this->db->get_where('aktivitas_user', ['email' => $email, 'token' => $token, 'status' => 'aktivasi'])->row_array();

        if (!$users) {
            // jika belum punya akun tidak bisa aktivasi
            $this->session->set_flashdata('error', 'Akun anda tidak ditemukan!');
            redirect('auth');
        } else {
            // jika sudah mendaftar 
            if ($users['aktif'] == '1') {
                // jika users sudah aktif maka tidak bisa aktivasi lagi
                $this->session->set_flashdata('error', 'Akun anda sudah aktif!');
                redirect('auth');
            } else {
                if (!$cek_token) {
                    $this->session->set_flashdata('error', 'Token anda tidak valid!');
                    redirect('auth');
                } else {
                    $selisih = time() - $cek_token['kode_aktivitas'] >= (60 * 60 * 24); //1 hari
                    if ($selisih == true) {
                        // jika kode aktivasi sudah melewati 1 hari
                        $this->db->where(['email' => $email, 'token' => $token, 'status' => 'aktivasi']);
                        $this->db->delete('aktivitas_user');
                        $this->session->set_flashdata('error', 'link aktivasi anda sudah tidak valid, silahkan klik bantu saya untuk meminta kode baru');
                        redirect('auth');
                    } else {
                        // jika kode aktivasi belum lewat 1 hari
                        $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
                        if ($jenis_kelamin == 'Pria') {
                            $avatar = 'KAV16365409614318';
                        } else {
                            $avatar = 'KAV16365409759218';
                        }

                        $data = [
                            'username' => $this->input->post('username', TRUE),
                            'nama' => strip_tags($this->input->post('nama', TRUE)),
                            'jenis_kelamin' => $jenis_kelamin,
                            'telepon' => $this->input->post('telepon', TRUE),
                            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                            'kelas' => $this->input->post('kelas', TRUE),
                            'bio' => strip_tags($this->input->post('bio', TRUE)),
                            'avatar' => $avatar,
                            'aktif' => $this->input->post('aktif', TRUE),
                        ];
                        $this->db->where('email', $email);
                        $this->db->update('users', $data);

                        // hapus token
                        $this->db->where(['status' => 'aktivasi', 'kunci_rahasia' => $users['kunci_rahasia']]);
                        $this->db->delete('aktivitas_user');
                        $this->session->set_flashdata('message', 'Selamat akun berhasil diaktivasi, silahkan login!');
                        redirect('auth');
                    }
                }
            }
        }
    }

    public function lupa_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah'
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Lupa Password',
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/lupa_password', $data);
            $this->load->view('auth/footer', $data);
        } else {
            // validasinya success
            $this->_lupa_password();
        }
    }

    private function _lupa_password()
    {
        $users = $this->auth->users();
        $email = $this->input->post('email', TRUE);
        $aktivitas_user = $this->db->get_where('aktivitas_user', ['kunci_rahasia' => $users['kunci_rahasia'], 'status' => 'ubah password'])->row_array();
        $token = base64_encode(random_bytes(32));
        if (!$users) {
            // jika users tidak ada
            $this->session->set_flashdata('error', 'Email tidak ditemukan');
            redirect('auth/lupa_password');
        } else {
            // jika users ada
            if (!$aktivitas_user) {
                // jika tidak ada data di aktivitas user
                $data_aktivitas = [
                    'email' => $email,
                    'email_baru' => '',
                    'token' => $token,
                    'status' => 'ubah password',
                    'tanggal_aktivitas' => time(),
                    'kode_aktivitas' => time(),
                    'kunci_rahasia' => $users['kunci_rahasia']
                ];

                if ($this->_sendEmail($token, 'lupa password', $email) == false) {
                    $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                } else {
                    $this->db->insert('aktivitas_user', $data_aktivitas);
                    $this->session->set_flashdata('message', 'Pesan berhasil dikirim silahkan cek email anda untuk reset password');
                }

                redirect('auth');
            } else {
                // kalo ada aktivitas user dia akan update
                if (time() - $aktivitas_user['kode_aktivitas'] >= (60 * 10)) { // 10 menit
                    // cek jika sudah lewat 10 menit dia bisa minta request lagi
                    $data_aktivitas = [
                        'token' => $token,
                        'tanggal_aktivitas' => time(),
                        'kode_aktivitas' => time()
                    ];

                    if ($this->_sendEmail($token, 'lupa password', $email) == false) {
                        $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                    } else {
                        $this->db->where(['status' => 'ubah password', 'kunci_rahasia' => $users['kunci_rahasia']]);
                        $this->db->update('aktivitas_user', $data_aktivitas);
                        $this->session->set_flashdata('message', 'Pesan berhasil dikirim silahkan cek email anda untuk reset password');
                    }

                    redirect('auth');
                } else {
                    // jika belum memenuhi 10 menit
                    $this->session->set_flashdata('error', 'Mohon tunggu 10 menit setelah anda meminta reset password');
                    redirect('auth/lupa_password');
                }
            }
        }
    }


    public function reset_password()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password minimal 8 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Reset Password'
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/reset_password', $data);
            $this->load->view('auth/footer', $data);
        } else {
            $this->_reset_password();
        }
    }

    private function _reset_password()
    {
        $email = $this->input->get('email', TRUE);
        $token = $this->input->get('token', TRUE);
        $users = $this->db->get_where('users', ['email' => $email])->row_array();
        $aktivitas_user = $this->db->get_where('aktivitas_user', ['token' => $token, 'status' => 'ubah password', 'kunci_rahasia' => $users['kunci_rahasia']])->row_array();
        $password = $this->input->post('password1', TRUE);

        if (!$users) {
            // cek user jika tidak ada
            $this->session->set_flashdata('error', 'Reset password gagal, email tidak ditemukan');
            redirect('auth');
        } else {
            if (!$aktivitas_user) {
                // tidak ada permintaan token
                $this->session->set_flashdata('error', 'Maaf token anda tidak valid silahkan reset password kembali');
                redirect('auth');
            } else {
                // ada permintaan token
                if (time() - $aktivitas_user['kode_aktivitas'] >= (60 * 60 * 24)) { // 1 hari
                    // jika token melebihi 1 hari
                    $this->session->set_flashdata('error', 'Maaf token anda sudah tidak aktif silahkan reset password kembali');
                    redirect('auth');
                } else {
                    // jika belum melebihi 1 hari
                    if (password_verify($password, $users['password'])) {
                        // jika password lama dan baru sama
                        $this->session->set_flashdata('error', 'Password baru sama dengan password lama silahkan ubah dengan sandi yang lebih rumit');
                        redirect('auth/reset_password?email=' . urlencode($this->input->get('email', TRUE)) . '&token=' . urlencode($this->input->get('token', TRUE)));
                    } else {
                        // jika semua sudah terpenuhi
                        $this->db->where('kunci_rahasia', $users['kunci_rahasia']);
                        $this->db->update('users', ['password' => password_hash($password, PASSWORD_DEFAULT)]);

                        // hapus token
                        $this->db->where(['status' => 'ubah password', 'kunci_rahasia' => $users['kunci_rahasia']]);
                        $this->db->delete('aktivitas_user');
                        $this->session->set_flashdata('message', 'Password anda berhasil direset');
                        redirect('auth');
                    }
                }
            }
        }
    }

    public function bantu()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah'
        ]);
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'trim|required', [
            'required' => 'Pilih keluhan anda',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Bantu Saya'
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/bantu_saya', $data);
            $this->load->view('auth/footer', $data);
        } else {
            // jika berhasil validasi form
            $this->_bantu();
        }
    }

    private function _bantu()
    {
        $users = $this->auth->users();
        $email = $this->input->post('email', TRUE);
        $keluhan = $this->input->post('keluhan', TRUE);
        $token = base64_encode(random_bytes(32));
        if (!$users) {
            $this->session->set_flashdata('error', 'Email anda tidak ditemukan');
            redirect('auth/bantu');
        } else {
            if ($keluhan == 'blokir') {
                // keluhan buka blokiran
                $user_blokir = $this->db->get_where('users', ['email' => $email, 'blokir' => '1'])->row_array();
                $aktivitas_user_blokir = $this->db->get_where('aktivitas_user', ['status' => 'blokir', 'kunci_rahasia' => $users['kunci_rahasia']])->row_array();
                if ($user_blokir) {
                    // jika user benar2 terblokir
                    if (!$aktivitas_user_blokir) {
                        // jika tidak ada permintaan
                        $data_aktivitas = [
                            'email' => $email,
                            'email_baru' => '',
                            'token' => $token,
                            'status' => 'blokir',
                            'tanggal_aktivitas' => time(),
                            'kode_aktivitas' => time(),
                            'kunci_rahasia' => $users['kunci_rahasia']
                        ];

                        if ($this->_sendEmail($token, 'blokir', $email) == false) {
                            $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                        } else {
                            $this->db->insert('aktivitas_user', $data_aktivitas);
                            $this->session->set_flashdata('message', 'Pesan pembukaan blokir berhasil dikirim silahkan cek email anda');
                        }

                        redirect('auth');
                    } else {
                        // jika ada permintaan
                        if (time() - $aktivitas_user_blokir['kode_aktivitas'] >= (60 * 10)) { // 10 menit
                            // jika sudah lewat 10 menit
                            $data_aktivitas = [
                                'token' => $token,
                                'tanggal_aktivitas' => time(),
                                'kode_aktivitas' => time()
                            ];

                            if ($this->_sendEmail($token, 'blokir', $email) == false) {
                                $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                            } else {
                                $this->db->where(['status' => 'blokir', 'kunci_rahasia' => $users['kunci_rahasia']]);
                                $this->db->update('aktivitas_user', $data_aktivitas);
                                $this->session->set_flashdata('message', 'Pesan pembukaan blokir berhasil dikirim silahkan cek email anda');
                            }

                            redirect('auth');
                        } else {
                            // jika belum memenuhi 10 menit
                            $this->session->set_flashdata('error', 'Mohon tunggu 10 menit setelah anda meminta pembukaan blokir akun');
                            redirect('auth');
                        }
                    }
                } else {
                    // jika user tidak terblokir
                    $this->session->set_flashdata('error', 'Akun anda tidak diblokir');
                    redirect('auth');
                }
            } else {
                // keluhan aktivasi
                $aktivitas_user_aktivasi = $this->db->get_where('aktivitas_user', ['email' => $email, 'status' => 'aktivasi'])->row_array();
                $user_aktivasi = $this->db->get_where('users', ['email' => $email, 'aktif' => '0'])->row_array();
                if ($user_aktivasi) {
                    if (!$aktivitas_user_aktivasi) {
                        $data_aktivitas = [
                            'email' => $email,
                            'email_baru' => '',
                            'token' => $token,
                            'status' => 'aktivasi',
                            'tanggal_aktivitas' => time(),
                            'kode_aktivitas' => time(),
                            'kunci_rahasia' => $users['kunci_rahasia']
                        ];

                        if ($this->_sendEmail($token, 'aktivasi', $email) == false) {
                            $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                        } else {
                            $this->db->insert('aktivitas_user', $data_aktivitas);
                            $this->session->set_flashdata('message', 'Pesan aktivasi akun berhasil dikirim silahkan cek email anda');
                        }

                        redirect('auth');
                    } else {
                        // jika data ada
                        if (time() - $aktivitas_user_aktivasi['kode_aktivitas'] >= (60 * 10)) { //10 menit
                            $data_aktivitas = [
                                'token' => $token,
                                'tanggal_aktivitas' => time(),
                                'kode_aktivitas' => time()
                            ];

                            if ($this->_sendEmail($token, 'aktivasi', $email) == false) {
                                $this->session->set_flashdata('error', 'Email gagal dikirim, silahkan coba lagi');
                            } else {
                                $this->db->where(['status' => 'aktivasi', 'kunci_rahasia' => $users['kunci_rahasia']]);
                                $this->db->update('aktivitas_user', $data_aktivitas);
                                $this->session->set_flashdata('message', 'Pesan aktivasi akun berhasil dikirim silahkan cek email anda');
                            }

                            redirect('auth');
                        } else {
                            // jika belum memenuhi 10 menit
                            $this->session->set_flashdata('error', 'Mohon tunggu 10 menit setelah anda meminta aktivasi akun');
                            redirect('auth');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Akun anda sudah aktif');
                    redirect('auth');
                }
            }
        }
    }

    private function _sendEmail($token, $type, $email)
    {
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
        $this->email->to($this->input->post('email', TRUE));

        if ($type == 'aktivasi') {
            $this->email->subject('Aktivasi Akun ' . $email);
            $this->email->message('Klik link ini untuk aktivasi akun anda : <a href="' . base_url() . 'auth/aktivasi?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Aktivasi</a> <br>tanggal : ' . date('Y/m/d H:i:s'));
        } else if ($type == 'lupa password') {
            $this->email->subject('Lupa Password ' . $email);
            $this->email->message('Klik disini untuk reset password kamu : <a href="' . base_url() . 'auth/reset_password?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Reset Password</a> <br>tanggal : ' . date('Y/m/d H:i:s'));
        } else if ($type == 'blokir') {
            $this->email->subject('Pembukaan Blokir ' . $email);
            $this->email->message('Klik disini untuk reset password kamu : <a href="' . base_url() . 'auth/buka_blokir?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Buka Blokir</a> <br>tanggal : ' . date('Y/m/d H:i:s'));
        }
        if ($this->email->send()) {
            return true;
        } else {
            // echo $this->email->print_debugger();
            // die;
            // return $this->session->set_flashdata('message', $this->email->print_debugger());
            return false;
        }
    }

    public function buka_blokir()
    {
        $email = $this->input->get('email', TRUE);
        $token = $this->input->get('token', TRUE);
        $users = $this->db->get_where('users', ['email' => $email])->row_array();
        $aktivitas_user = $users = $this->db->get_where('aktivitas_user', ['token' => $token, 'status' => 'blokir', 'kunci_rahasia' => $users['kunci_rahasia']])->row_array();
        if (!$users) {
            // jika users tidak terdaftar
            $this->session->set_flashdata('error', 'Email tidak ditemukan');
            redirect('auth');
        } else {
            if (!$aktivitas_user) {
                $this->session->set_flashdata('error', 'Pembukaan blokir akun gagal, token tidak ditemukan');
                redirect('auth');
            } else {
                if (time() - $aktivitas_user['kode_aktivitas'] >= (60 * 60 * 24)) { // 24 jam
                    $this->session->set_flashdata('error', 'Pembukaan blokir akun gagal, token sudah tidak aktif silahkan minta kembali');
                    redirect('auth');
                } else {
                    $data_user = [
                        'salah_password' => '0',
                        'blokir' => '0',
                    ];
                    $this->db->where('email', $email);
                    $this->db->update('users', $data_user);

                    // hapus token
                    $this->db->where(['status' => 'blokir', 'kunci_rahasia' => $users['kunci_rahasia']]);
                    $this->db->delete('aktivitas_user');
                    $this->session->set_flashdata('message', 'Pembukaan blokir akun sukses, silahkan login');
                    redirect('auth');
                }
            }
        }
    }

    public function hubungi_saya()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Format Email yang anda masukkan salah'
        ]);
        $this->form_validation->set_rules('pesan', 'Pesan', 'trim|required', [
            'required' => 'Pesan tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Hubungi Saya',
            ];
            $this->load->view('auth/header', $data);
            $this->load->view('auth/hubungi_saya', $data);
            $this->load->view('auth/footer', $data);
        } else {
            // validasinya success
            $this->_hubungi_saya();
        }
    }

    private function _hubungi_saya()
    {
        $captcha_response = trim($this->input->post('g-recaptcha-response'));
        if ($captcha_response != '') {
            $keySecret = '6LcgCSUdAAAAAAWKbDqWgV-KnLC1i-BfiS9zze7e';

            $check = [
                'secret' => $keySecret,
                'response' => $this->input->post('g-recaptcha-response')
            ];
            $startProcess = curl_init();
            curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($startProcess, CURLOPT_POST, true);
            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
            $receiveData = curl_exec($startProcess);
            $finalResponse = json_decode($receiveData, true);
            if ($finalResponse['success']) {
                $data = [
                    'kode_laporan' => 'KL' . time() . rand(1000, 9999),
                    'email' => $this->input->post('email', TRUE),
                    'pesan' => strip_tags($this->input->post('pesan', TRUE)),
                    'lihat' => '0',
                    'tanggal_pesan' => time(),
                ];
                $this->db->insert('laporan', $data);
                $this->session->set_flashdata('message', 'Laporan sudah terkirim, mohon tunggu balasan di email anda');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Validasi captcha gagal coba lagi');
                redirect('auth/hubungi_saya');
            }
        } else {
            $this->session->set_flashdata('error', 'Validasi captcha gagal coba lagi');
            redirect('auth/hubungi_saya');
        }
    }
}
