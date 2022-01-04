<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function total_users()
    {
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function total_kelas()
    {
        $query = $this->db->get('kelas');
        return $query->num_rows();
    }

    public function total_avatar()
    {
        $query = $this->db->get('avatar');
        return $query->num_rows();
    }

    public function total_tema()
    {
        $query = $this->db->get('tema');
        return $query->num_rows();
    }

    public function total_laporan()
    {
        $query = $this->db->get('laporan');
        return $query->num_rows();
    }

    public function users_all()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users')->result_array();
        return $query;
    }

    public function user($kunci_rahasia)
    {
        $this->db->select('users.*, avatar.url, avatar.nama_avatar');
        $this->db->from('users');
        $this->db->join('avatar', 'avatar.kode_avatar = users.avatar');
        $this->db->where(['users.kunci_rahasia' => $kunci_rahasia]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function kelas_user()
    {
        return $this->db->get('kelas_user')->result_array();
    }

    public function aktivitas_user($kunci_rahasia)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('aktivitas_user', ['kunci_rahasia' => $kunci_rahasia])->result_array();
    }

    public function cek_aktivitas_user($status, $kunci_rahasia)
    {
        return $this->db->get_where('aktivitas_user', ['status' => $status, 'kunci_rahasia' => $kunci_rahasia])->row_array();
    }

    public function cek_token($id, $kunci_rahasia)
    {
        return $this->db->get_where('aktivitas_user', ['id' => $id, 'kunci_rahasia' => $kunci_rahasia])->row_array();
    }

    public function kelas_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('kelas')->result_array();
    }

    public function kelas($kode_kelas)
    {
        return $this->db->get_where('kelas', ['kode_kelas' => $kode_kelas])->row_array();
    }

    public function kelas_anggota($kode_kelas)
    {
        $this->db->select('anggota_kelas.tanggal_gabung, anggota_kelas.role, anggota_kelas.status, users.email, users.username, users.kunci_rahasia, users.nama');
        $this->db->from('anggota_kelas');
        $this->db->join('users', 'users.kunci_rahasia = anggota_kelas.kunci_rahasia');
        $this->db->order_by('anggota_kelas.id', 'DESC');
        $this->db->where(['anggota_kelas.kode_kelas' => $kode_kelas]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function avatar_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('avatar')->result_array();
    }

    public function avatar($kode_avatar)
    {
        return $this->db->get_where('avatar', ['kode_avatar' => $kode_avatar])->row_array();
    }

    public function tema_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('tema')->result_array();
    }

    public function tema($kode_tema)
    {
        return $this->db->get_where('tema', ['kode_tema' => $kode_tema])->row_array();
    }

    public function laporan_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('laporan')->result_array();
    }

    public function laporan($kode_laporan)
    {
        return $this->db->get_where('laporan', ['kode_laporan' => $kode_laporan])->row_array();
    }
}
