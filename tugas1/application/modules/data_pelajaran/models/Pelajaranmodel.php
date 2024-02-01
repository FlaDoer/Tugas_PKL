<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaranmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list_pelajaran($where = '')
    {
        $query = $this->db->select('a.*, b.username as nama_guru FROM data_pelajaran a 
        LEFT JOIN user_akun b ON a.guru_pengajar = b.id ', false);

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        return $this->db->get();
    }
    public function get_user_by_id($id)
    {
        $query = $this->db->select('a.*, b.username as nama_guru FROM data_pelajaran a 
        LEFT JOIN user_akun b ON a.guru_pengajar = b.id ', false)->where('a.id', $id, false);

        return $this->db->get();
    }

    public function delete_pelajaran($id)
    {
        $query = $this->db->delete('data_pelajaran', array('id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
        return $query;
    }
    public function select_guru()
    {
        $query = $this->db->get_where('user_akun', array('tipe_akun' => 'guru'));
        return $query;
    }
}