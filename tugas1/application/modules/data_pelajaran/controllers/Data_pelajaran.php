<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Data_Pelajaran extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelajaranmodel');

    }
    public function index()
    {
        $isLogin = $this->session->userdata('isLogin');
        if ($isLogin == "yes") {
            $data['hasilquery'] = $this->Pelajaranmodel->list_pelajaran();
            $data['menu'] = 'viewMenu';
            $data['titlePage'] = 'Data Pelajaran';
            $data['konten'] = 'viewDataPelajaran';
            $data['js'] = 'dataPelajaran.js';

            $this->load->view('dashboard', $data);
        } else {
            redirect('login', 'refresh');
        }
    }


    public function tambah_Pelajaran()
    {
        $selectGuru = $this->Pelajaranmodel->select_guru();

        $ret['status'] = true;
        $ret['selectGuru'] = $selectGuru->result();

        echo json_encode($ret);
    }

    public function simpan_Pelajaran()
    {
        $id = $this->input->post('id');
        $data['nama_pelajaran'] = $this->input->post('nama_pelajaran');
        $data['jam_mulai'] = $this->input->post('jam_mulai');
        $data['jam_akhir'] = $this->input->post('jam_akhir');
        $data['nama_kelas'] = $this->input->post('nama_kelas');
        $data['guru_pengajar'] = $this->input->post('guru_pengajar');
        $isLogin = $this->session->userdata('isLogin');

        if ($id) {
            //update
            $update = $this->db->update('data_pelajaran', $data, array('id' => $id));
            if ($update) {
                $ret['status'] = true;
                $ret['msg'] = 'Data Berhasil Di Update';
            } else {
                $ret['status'] = false;
                $ret['msg'] = 'Data Gagal Di Update';
            }
        } else {
            $cek_user = $this->db->get_where('data_pelajaran', array('nama_pelajaran' => $data['nama_pelajaran']));
            if ($cek_user->num_rows()) {
                if ($isLogin == "yes") {
                    $ret['status'] = false;
                    $ret['msg'] = 'Nama Sudah Ada Di Simpan';
                }
            } else {
                $insert = $this->db->insert('data_pelajaran', $data);
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

    public function edit_Pelajaran($id)
    {
        $cekUser = $this->Pelajaranmodel->get_user_by_id($id);
        if ($cekUser->num_rows()) {
            $row = $cekUser->row();
            $data['id'] = $row->id;
            $data['nama_pelajaran'] = $row->nama_pelajaran;
            $data['jam_mulai'] = $row->jam_mulai;
            $data['jam_akhir'] = $row->jam_akhir;
            $data['nama_kelas'] = $row->nama_kelas;
            $data['guru_pengajar'] = $row->guru_pengajar;
            $selectGuru = $this->Pelajaranmodel->select_guru();

            $ret['status'] = true;
            $ret['data'] = $data;
            $ret['selectGuru'] = $selectGuru->result();
        } else {
            $ret['status'] = false;
            $ret['data'] = '';
            $ret['selectGuru'] = '';
            // show_404();
        }
        echo json_encode($ret);
        ;
    }

    public function hapus_Pelajaran($id = NULL)
    {
        $delete = $this->Pelajaranmodel->delete_pelajaran($id);
        if ($delete) {
            $ret['status'] = true;
            $ret['msg'] = 'Data Berhasil Di Hapus';
        } else {
            $ret['status'] = false;
            $ret['msg'] = 'Data Gagal Di Hapus';
        }
        echo json_encode($ret);
    }

    public function tabel_data_pelajaran()
    {
        $q = $this->Pelajaranmodel->list_pelajaran();
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
}

/* End of file data_Pelajaran.php */