<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publik extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('publik/tampilan_view_1');
	}
	
	 public function table1(){        
	 	$a['data']		= $this->db->query("SELECT * FROM surat_masuk order by tgl_diterima asc ")->result();
		
        $this->load->view('publik/table2',$a);
    }
	
}
