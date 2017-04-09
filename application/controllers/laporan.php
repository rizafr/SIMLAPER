<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function __construct() {
		parent::__construct();
		 //$this->load->model('laporan_model');
		 $this->load->model('web_model');
	}
	
	//Laporan Surat Masuk
	public function laporan_surat_masuk() {
		$a['page']	= "laporan/f_laporan_surat";
		$this->load->view('admin/index', $a);
	}
	
	public function surat_cetak() {
		$jenis_surat	= $this->input->post('tipe');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		
		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT * FROM surat_masuk WHERE tgl_diterima >= '$tgl_start' AND tgl_diterima <= '$tgl_end' ORDER BY id_surat_masuk")->result();
//		$a['page']	= "laporan/surat_masuk_cetak";
		$this->load->view('admin/laporan/surat_masuk_cetak', $a);
	}

	//Laporan Surat Masuk
	public function laporan_tujuan_disposisi() {
		$a['page']	= "laporan/tujuan_disposisi/f_laporan_tujuan_disposisi";
		$a['ref_disposisi'] = $this->web_model->get_tujuan_disposisi();
		$this->load->view('admin/index', $a);
	}

	public function disposisi_cetak() {
		$tujuan_disposisi = $this->input->post('tujuan_disposisi');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');

		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT sm.*, d.*,rd.tujuan_disposisi as disposisi_ke FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE sm.tgl_diterima >= '$tgl_start' AND sm.tgl_diterima <= '$tgl_end' and d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi=rd.id AND d.tujuan_disposisi ='$tujuan_disposisi' ORDER BY sm.tgl_diterima desc")->result();
		$a['disposisi_ke']	= $this->db->query("SELECT rd.tujuan_disposisi as disposisi_ke FROM disposisi d, ref_disposisi rd WHERE d.tujuan_disposisi=rd.id AND d.tujuan_disposisi ='$tujuan_disposisi'")->row();
		$a['page']	= "laporan/tujuan_disposisi/tujuan_disposisi_cetak";
		$this->load->view('admin/index', $a);
	}

	public function laporan_sifat_surat() {
		$a['page']	= "laporan/sifat_surat/f_laporan_sifat_surat";
		$a['ref_sifat_surat'] = $this->web_model->get_all_sifat_surat();
		$this->load->view('admin/index', $a);
	}

	public function sifat_surat_cetak() {
		$sifat_surat = $this->input->post('sifat_surat');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');

		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT sm.*, d.*,rd.tujuan_disposisi as disposisi_ke FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE sm.tgl_diterima >= '$tgl_start' AND sm.tgl_diterima <= '$tgl_end' and d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi=rd.id AND sm.status_surat_masuk ='$sifat_surat' ORDER BY sm.tgl_diterima desc")->result();
		$a['sifat_surat']	= $sifat_surat;
		$a['page']	= "laporan/sifat_surat/sifat_surat_cetak";
		$this->load->view('admin/index', $a);
	}

	public function laporan_kategori_intruksi() {
		$a['page']	= "laporan/kategori_intruksi/f_laporan_kategori_intruksi";
		$this->load->view('admin/index', $a);
	}

	public function kategori_intruksi_cetak() {
		$kode_intruksi = $this->input->post('kode_intruksi');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');

		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT sm.*, d.*,rd.tujuan_disposisi as disposisi_ke FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE sm.tgl_diterima >= '$tgl_start' AND sm.tgl_diterima <= '$tgl_end' and d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi=rd.id AND d.kode_intruksi ='$kode_intruksi' ORDER BY sm.tgl_diterima desc")->result();
		$kategori_intruksi = array('1' => 'Tidak Ada Laporan', '2' => 'Ada Laporan');
		$a['kategori_intruksi']	= $kategori_intruksi[$kode_intruksi];
		$a['page']	= "laporan/kategori_intruksi/kategori_intruksi_cetak";
		$this->load->view('admin/index', $a);
	}

	public function laporan_pengirim_surat() {
		$a['page']	= "laporan/pengirim_surat/f_laporan_pengirim_surat";
		$this->load->view('admin/index', $a);
	}

	public function pengirim_surat_cetak() {
		$asal_surat_masuk = $this->input->post('asal_surat_masuk');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');

		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT sm.*, d.*,rd.tujuan_disposisi as disposisi_ke FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE sm.tgl_diterima >= '$tgl_start' AND sm.tgl_diterima <= '$tgl_end' and d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi= rd.id AND sm.asal_surat_masuk = '$asal_surat_masuk' ORDER BY sm.tgl_diterima desc")->result();
		$a['pengirim_surat'] = $asal_surat_masuk;
		$a['page']	= "laporan/pengirim_surat/pengirim_surat_cetak";
		$this->load->view('admin/index', $a);
	}

	public function laporan_klasifikasi_surat() {
		$a['page']	= "laporan/klasifikasi_surat/f_laporan_klasifikasi";
		$this->load->view('admin/index', $a);
	}

	public function klasifikasi_surat_cetak() {
		$kode_surat_masuk = $this->input->post('kode_surat_masuk');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');

		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		$a['data']	= $this->db->query("SELECT sm.*, d.*,rd.tujuan_disposisi as disposisi_ke FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE sm.tgl_diterima >= '$tgl_start' AND sm.tgl_diterima <= '$tgl_end' and d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi= rd.id AND sm.kode_surat_masuk = '$kode_surat_masuk' ORDER BY sm.tgl_diterima desc")->result();
		$a['klasifikasi_surat']	= $this->db->query("SELECT rk.nama FROM ref_klasifikasi rk, surat_masuk sm WHERE sm.kode_surat_masuk=rk.kode AND sm.kode_surat_masuk ='$kode_surat_masuk'")->row();
		$a['page']	= "laporan/klasifikasi_surat/klasifikasi_cetak";
		$this->load->view('admin/index', $a);
	}
}
