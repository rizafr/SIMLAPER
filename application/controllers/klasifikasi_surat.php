<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Klasifikasi_surat extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('web_model');
	}
		
	public function klas_surat() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
			redirect("logins/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_klasifikasi")->num_rows();
		$per_page		= 15000;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."klasifikasi_surat/klas_surat/p");
		
		//ambil variabel URL
		$act					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$kode					= addslashes($this->input->post('kode'));
		$nama					= addslashes($this->input->post('nama'));
		$uraian					= addslashes($this->input->post('uraian'));
	
		$cari					= addslashes($this->input->post('q'));


		if ($act == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi WHERE nama LIKE '%$cari%' OR uraian LIKE '%$cari%' OR kode LIKE '%$cari%' ")->result();
			$a['page']		= "referensi/l_klas_surat";
			$a['cari']		=  $cari;
		} else if ($act == "add") {
			$a['page']		= "referensi/f_klas_surat";
		} else if ($act == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_klasifikasi WHERE id = '$idu'")->row();
			$a['page']		= "referensi/f_klas_surat";
		} else if ($act == "act_edt") {
			$this->db->query("UPDATE ref_klasifikasi SET kode = '$kode',nama = '$nama', uraian = '$uraian' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah</div>");
			redirect('klasifikasi_surat/klas_surat');
		}else if ($act == "act_add") {
			$checkCode = $this->web_model->checkDuplicateCode($kode);
			if ($checkCode) {
				$this->db->query("INSERT INTO ref_klasifikasi VALUES (NULL, '$kode', '$nama', '$uraian') ");
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id_surat_masuk=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Data berhasil ditambahkan </div>");
				redirect('klasifikasi_surat/klas_surat');
			} else {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id_surat_masuk=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Data gagal ditambahkan. Kode sudah ada </div>");
				redirect('klasifikasi_surat/klas_surat/add');
			}
		}
		else {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi LIMIT $awal, $akhir ")->result();
			$a['page']		= "referensi/l_klas_surat";
		}
		
		$this->load->view('admin/index', $a);
	}
	
	
	public function get_agenda() {
		$kode 				= $this->input->post('getAgenda',TRUE);
		
		$data 				=  $this->db->query("SELECT  no_agenda, perihal_surat_masuk FROM surat_masuk WHERE no_agenda LIKE '%$kode%' ORDER BY no_agenda ASC")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->no_agenda;
			$json_array['label']	= $d->no_agenda." - ".$d->perihal_surat_masuk;
			$klasifikasi[] 			= $json_array;
		}
		
		echo json_encode($klasifikasi);
	}
		
	public function get_klasifikasi() {
		$kode 				= trim($this->input->post('kode', TRUE));
		
		$data 				=  $this->db->query("SELECT id, kode, nama FROM ref_klasifikasi WHERE nama LIKE '%$kode%' or kode LIKE '%$kode%'  ORDER BY nama ASC")->result();

		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->kode;
			$json_array['label']	= $d->kode." - ".$d->nama;
			$klasifikasi[] 			= $json_array;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function get_instansi_pengirim() {
		$kode 				= trim($this->input->post('kode', TRUE));
		
		$data 				=  $this->db->query("SELECT instansi FROM pengirim WHERE instansi LIKE '$kode%'")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$klasifikasi[] 	= $d->instansi;
		}
		
		echo json_encode($klasifikasi);
	}
	
	
}
