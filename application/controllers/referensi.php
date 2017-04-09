<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('web_model');
        $this->load->model('crud_sifat_surat');
    }

    public function sifat_surat()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act					= $this->uri->segment(3);
        $idu					= $this->uri->segment(4);

        $id =  addslashes($this->input->post('id'));
        $data = array(
            'deskripsi' => addslashes($this->input->post('deskripsi'))
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id', 'ref_sifat_surat');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('referensi/sifat_surat');
        } else if ($act == "add") {
            $a['page'] = "referensi/f_sifat_surat";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id','ref_sifat_surat');
            $a['page'] = "referensi/f_sifat_surat";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id', $data, 'ref_sifat_surat');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('referensi/sifat_surat');
        } else if ($act == "act_add") {
            $this->web_model->insert('ref_sifat_surat', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('referensi/sifat_surat');
        } else {
            $a['data'] =  $this->web_model->read('ref_sifat_surat');
            $a['page'] = "referensi/l_sifat_surat";
        }

        $this->load->view('admin/index', $a);
    }

    public function pengirim()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act					= $this->uri->segment(3);
        $idu					= $this->uri->segment(4);

        $id =  addslashes($this->input->post('id'));
        $data = array(
            'instansi' => addslashes($this->input->post('instansi'))
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id_pengirim', 'pengirim');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('referensi/pengirim');
        } else if ($act == "add") {
            $a['page'] = "referensi/f_pengirim";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id_pengirim','pengirim');
            $a['page'] = "referensi/f_pengirim";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id_pengirim', $data, 'pengirim');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('referensi/pengirim');
        } else if ($act == "act_add") {
            $this->web_model->insert('pengirim', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('referensi/pengirim');
        } else {
            $a['data'] =  $this->web_model->read('pengirim');
            $a['page'] = "referensi/l_pengirim";
        }

        $this->load->view('admin/index', $a);
    }

    public function ref_disposisi()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act					= $this->uri->segment(3);
        $idu					= $this->uri->segment(4);

        $id =  addslashes($this->input->post('id'));
        $data = array(
            'tujuan_disposisi' => addslashes($this->input->post('tujuan_disposisi'))
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id', 'ref_disposisi');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('referensi/ref_disposisi');
        } else if ($act == "add") {
            $a['page'] = "referensi/f_ref_disposisi";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id','ref_disposisi');
            $a['page'] = "referensi/f_ref_disposisi";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id', $data, 'ref_disposisi');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('referensi/ref_disposisi');
        } else if ($act == "act_add") {
            $this->web_model->insert('ref_disposisi', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('referensi/ref_disposisi');
        } else {
            $a['data'] =  $this->web_model->read('ref_disposisi');
            $a['page'] = "referensi/l_ref_disposisi";
        }

        $this->load->view('admin/index', $a);
    }

    public function pelaksanaan_intruksi()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act					= $this->uri->segment(3);
        $idu					= $this->uri->segment(4);

        $id =  addslashes($this->input->post('id'));
        $data = array(
            'kode_intruksi' => addslashes($this->input->post('kode_intruksi')),
            'intruksi' => addslashes($this->input->post('intruksi'))
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id', 'pelaksanaan_intruksi');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('referensi/pelaksanaan_intruksi');
        } else if ($act == "add") {
            $a['page'] = "referensi/f_pelaksanaan_intruksi";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id','pelaksanaan_intruksi');
            $a['page'] = "referensi/f_pelaksanaan_intruksi";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id', $data, 'pelaksanaan_intruksi');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('referensi/pelaksanaan_intruksi');
        } else if ($act == "act_add") {
            $this->web_model->insert('pelaksanaan_intruksi', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('referensi/pelaksanaan_intruksi');
        } else {
            $a['data'] =  $this->web_model->read('pelaksanaan_intruksi');
            $a['page'] = "referensi/l_pelaksanaan_intruksi";
        }

        $this->load->view('admin/index', $a);
    }
}