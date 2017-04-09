<?php
class Web_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function read($db)
	{
		$get = $this->db->get($db);

		return $get->result();
	}

	function insert($tabel,$data)
	{
		$this->db->insert($tabel,$data);
	}

	function update($id,$trig,$data,$tabel)
	{
		$this->db->where($trig,$id);
		$this->db->update($tabel,$data);
	}

	function delete($id,$trig,$tabel)
	{
		$this->db->where($trig,$id);
		$this->db->delete($tabel);
	}

	function get_spesific($id,$triger,$table)
	{
		$this->db->where($triger,$id);
		$get = $this->db->get($table);

		return $get->row();
	}

	function getAll($tabel) {
		$q = $this->db->query("SELECT * FROM $tabel");
		return $q->result();
	}
	
	function getSpesific($tabel, $where) {
		$q = $this->db->query("SELECT * FROM $tabel $where");
		return $q->result();	
	}
	
	function getDataByID($tabel, $kunci, $data) {
		$q = $this->db->query("SELECT * FROM $tabel WHERE $kunci='$data'");
		return $q->row();	
	}
	
	function delData($tabel, $field_mana, $id) {
		$q = $this->db->query("DELETE FROM $tabel WHERE $field_mana = '$id'");
		return $q;
	}
	
	function getValueOneField($field, $tabel, $kunci, $data) {
		$q = $this->db->query("SELECT $field FROM $tabel WHERE $kunci='$data'");
		return $q->row();	
	}
	
	function EDIT($q, $id, $tabel, $data) {
		$this->db->where($q, $id);
		$q = $this->db->update($tabel, $data);
		return $q;
	}
	function ADD($tabel, $data) {
		$q = $this->db->insert($tabel, $data);
		return $q;
	}
	

	
	#memilih level
    function get_level_list() {
        $this->db->from('level');
        $this->db->order_by('level', 'asc');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = "--Pilih Level--";
            foreach ($result->result_array() as $row) {
                $return[$row['id_level']] = $row['level'];
            }
        }
        return $return;
    }
	
	function getFieldTable($tabel, $field, $id, $id_value) {
		$q = $this->db->query("SELECT $field FROM $tabel WHERE $id = $id_value");
		return $q->row();
	}
	
	
	//Profil
	function addProfil($data) {
		$q = $this->db->insert('halaman', $data);
		return $q;
	}
	function editProfil($id, $data) {
		$this->db->where('id', $id);
		$q = $this->db->update('halaman', $data);
		return $q;
	}
	

		//qhususon...
	public function checkDuplicateCode($kode) {

		$this->db->where('kode', $kode);

		$query = $this->db->get('ref_klasifikasi');

		$count_row = $query->num_rows();

		if ($count_row > 0) {
			//if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
			return FALSE; // here I change TRUE to false.
		} else {
			// doesn't return any row means database doesn't have this email
			return TRUE; // And here false to TRUE
		}
	}
	
	public function validate(){
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
         
        // Prep the query
        $this->db->where('u', $username);
        $this->db->where('p', $password);
         
        // Run the query
        $query = $this->db->get('user');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'user' => $row->u,
                    'pass' => $row->p,
                    'name' => $row->nama,
                    'level' => $row->hakAkses,
					'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }


	/*
	 * Laporan
	 */
	function get_all_klasifikasi()
	{
		$this->db->select('*');
		$this->db->from('ref_klasifikasi');
		$this->db->order_by("kode", "asc");
		$query = $this->db->get();

		return $query->result();
	}

	function get_all_sifat_surat()
	{
		$this->db->select('*');
		$this->db->from('ref_sifat_surat');
		$this->db->order_by("deskripsi", "asc");
		$query = $this->db->get();

		return $query->result();
	}

	function get_all_pengirim_surat()
	{
		$this->db->select('*');
		$this->db->from('pengirim');
		$this->db->order_by("instansi", "asc");
		$query = $this->db->get();

		return $query->result();
	}

	function get_tujuan_disposisi()
	{
		$this->db->select('*');
		$this->db->from('ref_disposisi');
		$this->db->order_by("tujuan_disposisi", "asc");
		$query = $this->db->get();

		return $query->result();
	}



	/*
	 * Count
	 */
	public function getCountSuratMasuk() {
		$query = $this->db->get('surat_masuk');

		return $query->num_rows();
	}

	public function getCountSuratMasukNotReported() {
		$this->db->get('surat_masuk');
		$this->db->where('status_disposisi', '2');
		$query = $this->db->get('surat_masuk');
		return $query->num_rows();
	}

	public function getCountSuratMasukSelesai() {
		$this->db->get('surat_masuk');
		$this->db->where('status_disposisi', '3');
		$query = $this->db->get('surat_masuk');

		return $query->num_rows();
	}

	public function getCountSuratBelumDisposisi() {
		$this->db->get('surat_masuk');
		$this->db->where('status_disposisi', '1');
		$query = $this->db->get('surat_masuk');

		return $query->num_rows();
	}
	
	public  function getCountSifatSurat() {
		$query = $this->db->query("SELECT rd.tujuan_disposisi as disposisi_ke, count(rd.tujuan_disposisi) as jum FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi=rd.id group by rd.tujuan_disposisi ORDER BY sm.tgl_diterima desc ");
		return $query->result();
	}

	public  function getCountTujuanDisposisi() {
		$query = $this->db->query("SELECT sm.status_surat_masuk as sifat_surat, count(sm.status_surat_masuk) as jum FROM surat_masuk sm group by sm.status_surat_masuk ORDER BY sm.tgl_diterima desc ");
		return $query->result();
	}

	public  function getCountKategoriIntruksi() {
		$query = $this->db->query("SELECT d.kode_intruksi as kode_intruksi, count(d.kode_intruksi) as jum FROM surat_masuk sm, disposisi d, ref_disposisi rd WHERE d.id_surat_masuk = sm.id_surat_masuk AND d.tujuan_disposisi=rd.id GROUP BY d.kode_intruksi  ORDER BY sm.tgl_diterima desc");
		return $query->result();
	}

	
}
