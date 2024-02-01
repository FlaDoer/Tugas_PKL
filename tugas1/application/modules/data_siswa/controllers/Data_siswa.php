<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_siswa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswamodel');
    }

    public function index()
    {
        $isLogin = $this->session->userdata('isLogin');
        if ($isLogin == "yes") {
            $data['hasilquery'] = $this->Siswamodel->list_siswa();
            $data['menu'] = 'viewMenu';
            $data['konten'] = 'viewDataSiswa';
            $data['js'] = 'dataSiswa.js';

            $this->load->view('dashboard', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function tabel_data_siswa()
    {
        $q = $this->Siswamodel->list_siswa();
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

    public function tambah_siswa()
    {
        $selectSiswa = $this->Siswamodel->select_siswa();

        $ret['status'] = true;
        $ret['selectSiswa'] = $selectSiswa->result();

        echo json_encode($ret);
    }

    public function simpan_siswa()
    {
        $id = $this->input->post('id');
        $data['nama_siswa'] = $this->input->post('nama_siswa');
        $data['kelas'] = $this->input->post('kelas');
        $data['tingkat'] = $this->input->post('tingkat');
        $isLogin = $this->session->userdata('isLogin');

        if ($id) {
            //update
            $cek_user = $this->db->get_where('data_siswa', array('nama_siswa' => $data['nama_siswa'], 'id !=' => $id));
            if ($cek_user->num_rows()) {
                if ($isLogin == "yes") {
                    $ret['status'] = false;
                    $ret['msg'] = 'Data Gagal Di Update';
                }
            } else {
                $update = $this->db->update('data_siswa', $data, array('id' => $id));
                if ($update) {
                    $ret['status'] = true;
                    $ret['msg'] = 'Data Berhasil Di Update';
                } else {
                    $ret['status'] = false;
                    $ret['msg'] = 'Data Gagal Di Update';
                }
            }
        } else {
            $cek_user = $this->db->get_where('data_siswa', array('nama_siswa' => $data['nama_siswa']));
            if ($cek_user->num_rows()) {
                if ($isLogin == "yes") {
                    $ret['status'] = false;
                    $ret['msg'] = 'Nama Sudah Ada Di Simpan';
                }
            } else {
                $insert = $this->db->insert('data_siswa', $data);
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

    public function edit_siswa($id)
    {
        $cekUser = $this->Siswamodel->get_user_by_id($id);
        if ($cekUser->num_rows()) {
            $row = $cekUser->row();
            $data['id'] = $row->id;
            $data['nama_siswa'] = $row->nama_siswa;
            $data['kelas'] = $row->kelas;
            $data['tingkat'] = $row->tingkat;
            $selectSiswa = $this->Siswamodel->select_siswa();

            $ret['status'] = true;
            $ret['data'] = $data;
            $ret['selectSiswa'] = $selectSiswa->result();
        } else {
            $ret['status'] = false;
            $ret['data'] = '';
            $ret['selectSiswa'] = '';
        }
        echo json_encode($ret);
    }

    public function hapus_siswa($id = NULL)
    {
        $delete = $this->Siswamodel->delete_siswa($id);
        if ($delete) {
            $ret['status'] = true;
            $ret['msg'] = 'Data Berhasil Di Hapus';
        } else {
            $ret['status'] = false;
            $ret['msg'] = 'Data Gagal Di Hapus';
        }
        echo json_encode($ret);
    }
}

/* End of file .php */
