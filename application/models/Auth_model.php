<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function users()
    {
        $query = $this->db->get_where('users', ['email' => $this->input->post('email', TRUE)])->row_array();
        return $query;
    }

    public function kelas_user()
    {
        return $this->db->get('kelas_user')->result_array();
    }
}
