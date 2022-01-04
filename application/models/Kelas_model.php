<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    public function kelas_all()
    {
        $query = $this->db->get('kelas')->result_array();
        return $query;
    }

    public function kelas($kode_kelas)
    {
        $this->db->select('kelas.*, tema.url, tema.nama_tema');
        $this->db->from('kelas');
        $this->db->join('tema', 'tema.kode_tema = kelas.kode_tema');
        $this->db->where(['kode_kelas' => $kode_kelas]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function ketua_kelas($kode_kelas)
    {
        $this->db->select('users.nama');
        $this->db->from('anggota_kelas');
        $this->db->join('users', 'users.kunci_rahasia = anggota_kelas.kunci_rahasia');
        $this->db->order_by('anggota_kelas.id', 'ASC');
        $this->db->where(['anggota_kelas.kode_kelas' => $kode_kelas, 'anggota_kelas.role' => 'ketua kelas']);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function cek_anggota_kelas($kode_kelas)
    {
        return $this->db->get_where('anggota_kelas', ['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $this->session->userdata('kunci_rahasia')])->row_array();
    }

    public function anggota_kelas($kode_kelas)
    {
        $this->db->select('users.nama, users.username, users.kunci_rahasia, anggota_kelas.role, anggota_kelas.status');
        $this->db->from('anggota_kelas');
        $this->db->join('users', 'users.kunci_rahasia = anggota_kelas.kunci_rahasia');
        $this->db->order_by('anggota_kelas.id', 'DESC');
        $this->db->where(['anggota_kelas.kode_kelas' => $kode_kelas]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function anggota_kelas2($kode_kelas)
    {
        $this->db->select('users.nama, users.username, users.kunci_rahasia, anggota_kelas.role, anggota_kelas.status');
        $this->db->from('anggota_kelas');
        $this->db->join('users', 'users.kunci_rahasia = anggota_kelas.kunci_rahasia');
        $this->db->order_by('anggota_kelas.id', 'DESC');
        $this->db->where(['anggota_kelas.kode_kelas' => $kode_kelas, 'anggota_kelas.status' => 'proses']);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function cek_user_proses($kode_kelas)
    {
        $query = $this->db->get_where('anggota_kelas', ['kode_kelas' => $kode_kelas, 'status' => 'proses']);
        return $query->num_rows();
    }

    public function tema_All()
    {
        return $this->db->get('tema')->result_array();
    }

    public function guruAll($kode_kelas)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('guru', ['kode_kelas' => $kode_kelas])->result_array();
    }

    public function guru($kode_kelas, $kode_guru)
    {
        return $this->db->get_where('guru', ['kode_kelas' => $kode_kelas, 'kode_guru' => $kode_guru])->row_array();
    }

    public function users()
    {
        return $this->db->get_where('users', ['kunci_rahasia' => $this->session->userdata('kunci_rahasia')])->row_array();
    }

    public function tugasAll($kode_kelas)
    {
        $this->db->select('tugas.kode_tugas, tugas.nama_tugas, tugas.tanggal_buat, tugas.batas_pengumpulan, guru.mata_pelajaran, guru.nama_guru');
        $this->db->from('tugas');
        $this->db->join('guru', 'guru.kode_guru = tugas.kode_guru');
        $this->db->order_by('tugas.id', 'DESC');
        $this->db->where(['tugas.kode_kelas' => $kode_kelas]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function cari_tugas($kode_kelas)
    {
        $keyword = $this->input->post('keyword', TRUE);
        $this->db->select('tugas.kode_tugas, tugas.nama_tugas, tugas.tanggal_buat, tugas.batas_pengumpulan, guru.mata_pelajaran, guru.nama_guru');
        $this->db->from('tugas');
        $this->db->join('guru', 'guru.kode_guru = tugas.kode_guru');
        $this->db->order_by('tugas.id', 'DESC');
        $this->db->where(['kode_tugas' => $keyword, 'tugas.kode_kelas' => $kode_kelas]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function absenAll($kode_kelas)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('absen', ['kode_kelas' => $kode_kelas])->result_array();
    }

    public function cari_absen($kode_kelas)
    {
        $keyword = $this->input->post('keyword', TRUE);
        $this->db->order_by('id', 'DESC');
        $this->db->where(['kode_absen' => $keyword, 'kode_kelas' => $kode_kelas]);
        $query = $this->db->get('absen')->result_array();
        return $query;
    }

    public function tugas($kode_kelas, $kode_tugas)
    {
        $this->db->select('tugas.kode_tugas, tugas.nama_tugas, tugas.tanggal_buat, tugas.batas_pengumpulan,tugas.deskripsi_tugas,tugas.link_pengumpulan, guru.kode_guru, guru.mata_pelajaran, guru.nama_guru');
        $this->db->from('tugas');
        $this->db->join('guru', 'guru.kode_guru = tugas.kode_guru');
        $this->db->where(['tugas.kode_kelas' => $kode_kelas, 'tugas.kode_tugas' => $kode_tugas]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function ubah_anggota_kelas($kode_kelas, $kunci_rahasia)
    {
        return $this->db->get_where('anggota_kelas', ['kode_kelas' => $kode_kelas, 'kunci_rahasia' => $kunci_rahasia])->row_array();
    }


    public function absen($kode_kelas, $kode_absen)
    {
        return $this->db->get_where('absen', ['kode_kelas' => $kode_kelas, 'kode_absen' => $kode_absen])->row_array();
    }

    public function anggota_absenAll($kode_kelas, $kode_absen)
    {
        $this->db->select('anggota_absen.status, anggota_absen.tanggal_absen, anggota_absen.kunci_rahasia, anggota_absen.keterangan, users.username, users.nama');
        $this->db->from('anggota_absen');
        $this->db->join('users', 'users.kunci_rahasia = anggota_absen.kunci_rahasia');
        $this->db->order_by('anggota_absen.id', 'DESC');
        $this->db->where(['anggota_absen.kode_kelas' => $kode_kelas, 'anggota_absen.kode_absen' => $kode_absen]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function anggota_absen($kode_kelas, $kode_absen)
    {
        $kunci_rahasia = $this->session->userdata('kunci_rahasia');

        $this->db->select('anggota_absen.tanggal_absen, anggota_absen.status, anggota_absen.keterangan, anggota_absen.kunci_rahasia, users.nama, users.username');
        $this->db->from('anggota_absen');
        $this->db->join('users', 'users.kunci_rahasia = anggota_absen.kunci_rahasia');
        $this->db->where(['anggota_absen.kode_absen' => $kode_absen, 'anggota_absen.kode_kelas' => $kode_kelas, 'anggota_absen.kunci_rahasia' => $kunci_rahasia]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function anggota_absen2($kode_kelas, $kode_absen, $kunci_rahasia)
    {
        $this->db->select('anggota_absen.tanggal_absen, anggota_absen.status, anggota_absen.keterangan, anggota_absen.kunci_rahasia, users.nama, users.username');
        $this->db->from('anggota_absen');
        $this->db->join('users', 'users.kunci_rahasia = anggota_absen.kunci_rahasia');
        $this->db->where(['anggota_absen.kode_absen' => $kode_absen, 'anggota_absen.kode_kelas' => $kode_kelas, 'anggota_absen.kunci_rahasia' => $kunci_rahasia]);
        $query = $this->db->get()->row_array();
        return $query;
    }

    // public function kelas_join()
    // {
    //     $this->db->select('kelas.*,anggota_kelas.id as ak_id, anggota_kelas.tanggal_gabung as ak_tg, anggota_kelas.kode_kelas as ak_kk, anggota_kelas.role as ak_role, anggota_kelas.status as ak_status, anggota_kelas.kunci_rahasia as ak_kr');
    //     $this->db->from('kelas');
    //     $this->db->join('anggota_kelas', 'anggota_kelas.kode_kelas = kelas.kode_kelas');
    //     $this->db->order_by('kelas.id', 'ASC');
    //     $this->db->where(['anggota_kelas.kunci_rahasia' => $this->session->userdata('kunci_rahasia'), 'anggota_kelas.status' => 'aktif']);
    //     $query = $this->db->get()->result_array();
    //     return $query;
    //     // return $query->result();
    // }

    public function kelas_join()
    {
        $this->db->select('kelas.kode_kelas, kelas.nama_kelas, kelas.kode_tema, kelas.deskripsi, kelas.tanggal_buat, anggota_kelas.status, tema.url, tema.nama_tema');
        $this->db->from('kelas');
        $this->db->join('anggota_kelas', 'anggota_kelas.kode_kelas = kelas.kode_kelas');
        $this->db->join('tema', 'tema.kode_tema = kelas.kode_tema');
        $this->db->order_by('kelas.id', 'DESC');
        $this->db->where(['anggota_kelas.kunci_rahasia' => $this->session->userdata('kunci_rahasia'), 'kelas.aktif' => '1']);
        $query = $this->db->get()->result_array();
        return $query;
        // return $query->result();
    }

    public function kelas_join_all()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('anggota_kelas', 'anggota_kelas.kode_kelas = kelas.kode_kelas');
        $this->db->join('users', 'users.kunci_rahasia = anggota_kelas.kunci_rahasia');
        $this->db->order_by('kelas.id', 'ASC');
        $this->db->where(['anggota_kelas.kunci_rahasia' => $this->session->userdata('kunci_rahasia'), 'anggota_kelas.status' => 'aktif', 'kelas.aktif' => '1']);
        $query = $this->db->get()->result_array();
        return $query;
        // return $query->result();
    }

    public function jadwalAll($kode_kelas)
    {
        $this->db->select('jadwal.*, guru.nama_guru, guru.mata_pelajaran');
        $this->db->from('jadwal');
        $this->db->join('guru', 'guru.kode_guru = jadwal.kode_guru');
        $this->db->where('jadwal.kode_kelas', $kode_kelas);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function jadwal($kode_kelas, $kode_jadwal)
    {
        return $this->db->get_where('jadwal', ['kode_jadwal' => $kode_jadwal, 'kode_kelas' => $kode_kelas])->row_array();
    }
}
