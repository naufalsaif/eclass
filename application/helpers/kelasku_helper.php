<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('cek_session_login')) {
    function cek_session_login()
    {
        $ci = get_instance();
        if (!$ci->session->session_aktif || !$ci->session->userdata('kunci_rahasia')) {
            redirect('auth');
        }
    }
}

if (!function_exists('cek_session_auth')) {
    function cek_session_auth()
    {
        $ci = get_instance();
        if ($ci->session->session_aktif || $ci->session->userdata('kunci_rahasia')) {
            if ($ci->session->userdata('role') == 'admin') {
                redirect('admin');
            } else {
                redirect('users');
            }
        }
    }
}

if (!function_exists('pembersih_input')) {
    function pembersih_input()
    {
        return 'autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"';
    }
}

if (!function_exists('avatar')) {
    function avatar()
    {
        $ci = get_instance();
        $users = $ci->db->get_where('users', ['kunci_rahasia' => $ci->session->userdata('kunci_rahasia')])->row_array();
        return $ci->db->get_where('avatar', ['kode_avatar' => $users['avatar']])->row_array();
    }
}

if (!function_exists('data_users')) {
    function data_users()
    {
        $ci = get_instance();
        return $ci->db->get_where('users', ['kunci_rahasia' => $ci->session->userdata('kunci_rahasia')])->row_array();
    }
}

if (!function_exists('cek_absen_saya')) {
    function cek_absen_saya($kode_absen, $kode_kelas)
    {
        $ci = get_instance();
        return $ci->db->get_where('anggota_absen', ['kode_absen' => $kode_absen, 'kode_kelas' => $kode_kelas, 'kunci_rahasia' => $ci->session->userdata('kunci_rahasia')])->row_array();
    }
}

if (!function_exists('cek_akses_kelas')) {
    function cek_akses_kelas($kode_kelas)
    {
        $ci = get_instance();
        $ci->db->select('anggota_kelas.role');
        $ci->db->from('anggota_kelas');
        $ci->db->join('kelas', 'kelas.kode_kelas = anggota_kelas.kode_kelas');
        $ci->db->where(['anggota_kelas.kode_kelas' => $kode_kelas, 'anggota_kelas.kunci_rahasia' => $ci->session->userdata('kunci_rahasia'), 'kelas.aktif' => '1', 'anggota_kelas.status' => 'aktif']);
        $query = $ci->db->get()->row_array();

        if (!$query) {
            redirect('kelas');
        }
    }
}

if (!function_exists('cek_akses_ketua')) {
    function cek_akses_ketua($kode_kelas)
    {
        $ci = get_instance();
        $ci->db->select('anggota_kelas.role');
        $ci->db->from('anggota_kelas');
        $ci->db->join('kelas', 'kelas.kode_kelas = anggota_kelas.kode_kelas');
        $ci->db->where(['anggota_kelas.kode_kelas' => $kode_kelas, 'anggota_kelas.kunci_rahasia' => $ci->session->userdata('kunci_rahasia'), 'kelas.aktif' => '1', 'anggota_kelas.status' => 'aktif']);
        $query = $ci->db->get()->row_array();

        if ($query['role'] != 'ketua kelas') {
            redirect('kelas');
        }
    }
}

if (!function_exists('cek_role_admin')) {
    function cek_role_admin()
    {
        $ci = get_instance();
        if ($ci->session->userdata('role') != 'admin') {
            redirect('users');
        }
    }
}

if (!function_exists('substr_table')) {
    function substr_table($input)
    {
        $ci = get_instance();
        $kata = substr($input, 0, 50);
        $jumlah = strlen($input);
        $kalimat = $kata . ($jumlah > 50 ? '...' : '');
        return $kalimat;
    }
}

if (!function_exists('substr_card')) {
    function substr_card($input)
    {
        $ci = get_instance();
        $kata = substr($input, 0, 100);
        $jumlah = strlen($input);
        $kalimat = $kata . ($jumlah > 100 ? '...' : '');
        return $kalimat;
    }
}

if (!function_exists('cek_anggota_tugas')) {
    function cek_anggota_tugas($kode_tugas, $kode_kelas)
    {
        $ci = get_instance();
        $query = $ci->db->get_where('anggota_tugas', ['kode_tugas' => $kode_tugas, 'kode_kelas' => $kode_kelas, 'kunci_rahasia' => $ci->session->userdata('kunci_rahasia')])->row_array();
        return $query;
    }
}
