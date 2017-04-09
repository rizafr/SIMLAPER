<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('breadcrumbs');
        $this->load->model('crud_sifat_surat');
    }

    public function index() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

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


}
