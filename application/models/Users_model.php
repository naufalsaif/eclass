<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function users()
    {
        $this->db->select('users.*, avatar.url, avatar.nama_avatar');
        $this->db->from('users');
        $this->db->join('avatar', 'avatar.kode_avatar = users.avatar');
        $this->db->where(['users.kunci_rahasia' => $this->session->userdata('kunci_rahasia')]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function profile($username)
    {
        $this->db->select('users.username, users.online, users.nama, users.jenis_kelamin, users.kelas, users.telepon, users.tanggal_lahir, users.bio, users.tanggal_buat, users.role, users.aktivitas_login, avatar.url');
        $this->db->from('users');
        $this->db->join('avatar', 'avatar.kode_avatar = users.avatar');
        $this->db->where(['users.username' => $username]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function cek_kode_kelas($kode_kelas)
    {
        $query = $this->db->get_where('anggota_kelas', ['kode_kelas' => $kode_kelas])->row_array();
        return $query;
    }
}
