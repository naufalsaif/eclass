<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{
    public function users()
    {
        return $this->db->get_where('users', ['kunci_rahasia' => $this->session->userdata('kunci_rahasia')])->row_array();
    }

    public function kelas_user()
    {
        return $this->db->get('kelas_user')->result_array();
    }

    public function cek_aktivitas_user()
    {
        $kunci_rahasia = $this->users()['kunci_rahasia'];
        return $this->db->get_where('aktivitas_user', ['status' => 'ubah username', 'kunci_rahasia' => $kunci_rahasia])->row_array();
    }

    public function cek_aktivitas_email()
    {
        $kunci_rahasia = $this->users()['kunci_rahasia'];
        return $this->db->get_where('aktivitas_user', ['status' => 'ubah email', 'kunci_rahasia' => $kunci_rahasia])->row_array();
    }

    public function avatarAll()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('avatar')->result_array();
    }
}
