<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Loginmodel');
    }

    public function index()
    {
        // "$islogin = $this->session->userdata('isLogin');" ambil data inputan dari sesi sekarang lalu masukkan userdata
        $islogin = $this->session->userdata('isLogin');
        if ($islogin == 'yes') {
            redirect('dashboard', 'refresh');
        } else {
            $this->load->view('viewLogin');
        }
    }

    public function do_login()
    {
        /* mengambil hasil inputan username dan password */
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->Loginmodel->ceklogin($username, $password);

        echo json_encode($cek);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/index', 'refresh');
    }
}