<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usermodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list_user()
    {
        $query = $this->db->get('user_akun');
        return $query;
    }
    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('user_akun', array('id' => $id));
        return $query;
    }

    public function delete_user($id)
    {
        $query = $this->db->delete('user_akun', array('id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
        return $query;
    }
}