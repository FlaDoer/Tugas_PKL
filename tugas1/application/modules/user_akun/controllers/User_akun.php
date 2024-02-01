<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User_akun extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usermodel');

    }
    public function index()
    {
        $isLogin = $this->session->userdata('isLogin');
        if ($isLogin == "yes") {
            $data['hasilquery'] = $this->Usermodel->list_user();
            $data['menu'] = 'viewMenu';
            $data['konten'] = 'viewUserAkun';
            $data['js'] = 'userAkun.js';

            $this->load->view('dashboard', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    public function tabel_user_akun()
    {
        $q = $this->Usermodel->list_user();
        if ($q->num_rows()) {
            $ret['status'] = true;
            $ret['data'] = $q->result();
            $ret['msg'] = '';
        } else {
            $ret['status'] = false;
            $ret['data'] = '';
            $ret['msg'] = '';
        }

        echo json_encode($ret);
    }

    public function tambah_user()
    {
        $data['menu'] = 'viewMenu';
        $data['titlePage'] = 'Form Data User';
        $data['konten'] = 'formDataUser';
        $ret['status'] = true;

        echo json_encode($ret);
    }

    public function edit_user($id)
    {
        $cekUser = $this->Usermodel->get_user_by_id($id);
        if ($cekUser->num_rows()) {
            $row = $cekUser->row();
            $data['id'] = $row->id;
            $data['username'] = $row->username;
            $data['password'] = $row->password;
            $data['tipe_akun'] = $row->tipe_akun;

            $ret['status'] = true;
            $ret['data'] = $data;
        } else {
            $ret['status'] = false;
            $ret['data'] = '';
        }
        echo json_encode($ret);
    }

    public function simpan_user()
    {
        $id = $this->input->post('id');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $data['tipe_akun'] = $this->input->post('tipe_akun');
        $data['last_update'] = date('Y-m-d H-i-s');
        $isLogin = $this->session->userdata('isLogin');

        if ($id) {
            //update
            $cek_user = $this->db->get_where('user_akun', array('username' => $data['username'], 'id !=' => $id));
            if ($cek_user->num_rows()) {
                if ($isLogin == "yes") {
                    $data['error'] = 'yes';
                    $data['menu'] = 'viewMenu';
                    $data['titlePage'] = 'Form Akun Pengguna';
                    $data['konten'] = 'formDataUser';
                    $ret['status'] = false;
                    $ret['msg'] = 'Nama Sudah Ada Di Simpan';
                }
            } else {
                $update = $this->db->update('user_akun', $data, array('id' => $id));
                if ($update) {
                    $ret['status'] = true;
                    $ret['msg'] = 'Data Berhasil Di Update';
                } else {
                    $ret['status'] = false;
                    $ret['msg'] = 'Data Gagal Di Update';
                }
            }
        } else {
            $cek_user = $this->db->get_where('user_akun', array('username' => $data['username']));
            if ($cek_user->num_rows()) {
                if ($isLogin == "yes") {
                    $data['error'] = 'yes';
                    $data['menu'] = 'viewMenu';
                    $data['titlePage'] = 'Form Akun Pengguna';
                    $data['konten'] = 'formDataUser';
                    $ret['status'] = false;
                    $ret['msg'] = 'Nama Sudah Ada Di Simpan';
                    // $this->load->view('dashboard', $data);
                }
            } else {
                $insert = $this->db->insert('user_akun', $data);
                if ($insert) {
                    $ret['status'] = true;
                    $ret['msg'] = 'Data Berhasil Di Simpan';
                } else {
                    $ret['status'] = false;
                    $ret['msg'] = 'Data Gagal Di Simpan';
                }
            }
        }
        echo json_encode($ret);
    }

    public function hapus_user($id = NULL)
    {
        if ($id) {
            $delete = $this->Usermodel->delete_user($id);
            if ($delete) {
                $ret['status'] = true;
                $ret['msg'] = 'Data Berhasil Di Hapus';
            } else {
                $ret['status'] = false;
                $ret['msg'] = 'Data Gagal Di Hapus';
            }
        } else {
            $ret['status'] = false;
            $ret['msg'] = 'Data ID Tidak Tersedia Untuk Di Hapus';
        }
        echo json_encode($ret);
    }
}

/* End of file User_akun.php */