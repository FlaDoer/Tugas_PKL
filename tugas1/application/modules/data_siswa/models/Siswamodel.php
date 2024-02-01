<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswamodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list_siswa($where = '')
    {
        $query = $this->db->select('a.*, b.username as nama_siswa FROM data_siswa a 
        LEFT JOIN user_akun b ON a.nama_siswa = b.id', false);

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        return $this->db->get();
    }
    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('data_siswa', array('id' => $id));
        return $query;
    }

    public function delete_siswa($id)
    {
        $query = $this->db->delete('data_siswa', array('id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
        return $query;
    }
    public function select_siswa()
    {
        $query = $this->db->get_where('user_akun', array('tipe_akun' => 'siswa'));
        return $query;
    }
}

/* End of file Siswamodel.php */
