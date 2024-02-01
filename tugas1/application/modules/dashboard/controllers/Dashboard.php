<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboardmodel');
    }

    public function index()
    {
        $islogin = $this->session->userdata('isLogin');
        if ($islogin == 'yes') {
            $current_date = date('Y-m-d');
            $data['menu'] = 'viewMenu';
            $data['konten'] = 'viewDashboard';
            $data['js'] = 'dashboard.js';
            $this->load->view('dashboard', $data);
        } else {
            redirect('login');
        }
    }

    public function jumlah_siswa()
    {
        $jumlah_siswa = $this->db->select('*')->from('user_akun')
            ->where('tipe_akun', 'siswa')
            ->get()
            ->num_rows();

        $ret['status'] = true;
        $ret['data'] = $jumlah_siswa;
        echo json_encode($ret);
    }

    public function jumlah_guru()
    {
        $jumlah_guru = $this->db->select('*')->from('user_akun')
            ->where('tipe_akun', 'guru')
            ->get()
            ->num_rows();

        $ret['status'] = true;
        $ret['data'] = $jumlah_guru;
        echo json_encode($ret);
    }
    public function jumlah_akun()
    {
        $jumlah_akun = $this->db->select('*')->from('user_akun')
            ->get()
            ->num_rows();

        $ret['status'] = true;
        $ret['data'] = $jumlah_akun;
        echo json_encode($ret);
    }

    public function siswa_per_kelas()
    {
        // Get distinct classes
        $jumlah_kelas_result = $this->db->distinct()->select('kelas')->from('data_siswa')->get();
        $jumlah_kelas = $jumlah_kelas_result->result();

        $data = array();

        foreach ($jumlah_kelas as $kelas) {
            // For each class, get the number of students
            $jumlah_siswa = $this->db->select('nama_siswa')->where('kelas', $kelas->kelas)->from('data_siswa')->get()->num_rows();

            $data[] = array(
                'kelas' => $kelas->kelas,
                'jumlah_siswa' => $jumlah_siswa
            );
        }

        $ret['status'] = true;
        $ret['data'] = $data;
        echo json_encode($ret);
    }

    public function chart_siswa_kelas()
    {
        $jumlah_kelas_result = $this->db->distinct()->select('kelas')->from('data_siswa')->get();
        $jumlah_kelas = $jumlah_kelas_result->result();

        $data = array();

        foreach ($jumlah_kelas as $kelas) {
            // For each class, get the number of students
            $jumlah_siswa = $this->db->select('nama_siswa')->where('kelas', $kelas->kelas)->from('data_siswa')->get()->num_rows();

            $ret['labels'][] = $kelas->kelas;
            $ret['data']['jumlah_siswa'][] = $jumlah_siswa;
            // $data[] = array(
            //     'kelas' => $kelas->kelas,
            //     'jumlah_siswa' => $jumlah_siswa
            // );
        }

        $ret['status'] = true;
        echo json_encode($ret);
    }
}