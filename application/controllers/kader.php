<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kader extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('web_model');
        $this->load->model('crud_sifat_surat');
    }

    /**
     * Show Kader List
     * @return mixed
     */
    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act                    = $this->uri->segment(3);
        $idu                    = $this->uri->segment(4);

        $id =  addslashes($this->input->post('id'));
        $data = array(
            'name' => addslashes($this->input->post('name')),
            'phoneNumber' => addslashes($this->input->post('phoneNumber')),
            'rw' => addslashes($this->input->post('rw')),
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id', 'kader');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('kader/index');
        } else if ($act == "add") {
            $a['page'] = "kader/f_kader";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id','kader');
            $a['page'] = "kader/f_kader";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id', $data, 'kader');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('kader/index');
        } else if ($act == "act_add") {
            $this->web_model->insert('kader', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('kader/index');
        } else {
            $a['data'] =  $this->web_model->read('kader');
            $a['page'] = "kader/l_kader";
        }

        $this->load->view('admin/index', $a);
    }
}
