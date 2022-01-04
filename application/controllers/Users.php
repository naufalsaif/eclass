<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session_login();
        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'judul' => '<i class="fas fa-home text-primary"></i> Beranda',
            'users' => $this->users->users()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function profile()
    {
        $username = $this->input->get('u', TRUE);
        $kode_kelas = $this->input->get('kk', TRUE);
        $data = [
            'title' => 'Profile',
            'judul' => 'Profile',
            'profile' => $this->users->profile($username),
            'kode_kelas' => $this->users->cek_kode_kelas($kode_kelas)
        ];

        if (!$data['profile']) {
            redirect('users');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer', $data);
    }

    public function logout()
    {
        $this->db->where('kunci_rahasia', $this->session->userdata('kunci_rahasia'))->update('users', ['aktivitas_login' => time(), 'online' => '0']);
        $this->session->sess_destroy();
        redirect('auth');
    }
}
