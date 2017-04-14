<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('web_model');
        $this->load->model('crud_sifat_surat');
    }

    /**
     * Show Pasien List
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
            'age' => addslashes($this->input->post('age')),
            'phoneNumber' => addslashes($this->input->post('phoneNumber')),
            'rw' => addslashes($this->input->post('rw')),
        );

        if ($act == "del") {
            $this->web_model->delete($idu,'id', 'pasien');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('pasien/index');
        } else if ($act == "add") {
            $a['page'] = "pasien/f_pasien";
        } else if ($act == "edt") {
            $a['datpil'] = $this->web_model->get_spesific($idu,'id','pasien');
            $a['page'] = "pasien/f_pasien";
        } else if ($act == "act_edt") {
            $this->web_model->update($id, 'id', $data, 'pasien');
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
            redirect('pasien/index');
        } else if ($act == "act_add") {
            $this->web_model->insert('pasien', $data);
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
            redirect('pasien/index');
        } else {
            $a['data'] =  $this->web_model->read('pasien');
            $a['page'] = "pasien/l_pasien";
        }

        $this->load->view('admin/index', $a);
    }
}
