<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Loginmodel extends CI_Model
{

    public function ceklogin($username, $password)
    {
        #mencari username yang sama dengan input dari database
        $query = $this->db->get_where('user_akun', array('username' => $username));
        if ($query->num_rows()) {
            $row = $query->row();
            $pwd = $row->password;
            if ($password == $pwd) {
                #masuk
                $data['username'] = $username;
                $data['password'] = $password;
                $data['isLogin'] = 'yes';
                $this->session->set_userdata($data);
                $ret['status'] = true;
                $ret['msg'] = 'Login berhasil';
            } else {
                #ga masuk
                //echo 'username atau password salah...';
                $ret['status'] = false;
                $ret['msg'] = 'Password Incorrect';
            }
        } else {
            $ret['status'] = false;
            $ret['msg'] = 'Username Incorrect';
        }

        return $ret;
    }

}

/* End of file .php */
