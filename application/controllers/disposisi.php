<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Disposisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_intruksi');
        $this->load->model('crud_ref_disposisi');
        $this->load->library('breadcrumbs');
    }

    public function surat_disposisi()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
            $this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">Maaf Anda belum login. Silakan login terlebih dahulu</div>");
            redirect("logins/login");
        }

        //ambil variabel URL
        $act = $this->uri->segment(4);
        $id_suratu = $this->uri->segment(3);
        $id_dispu = $this->uri->segment(5);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $id_disposisi = addslashes($this->input->post('id_disposisi'));
        $id_surat_masuk = addslashes($this->input->post('id_surat_masuk'));
        $tujuan_disposisi = addslashes($this->input->post('tujuan_disposisi'));
        $kode_intruksi = addslashes($this->input->post('kode_intruksi'));
        $isi_instruksi = addslashes($this->input->post('isi_instruksi'));
        $tgl_instruksi = addslashes($this->input->post('tgl_instruksi'));
        $batas_waktu = addslashes($this->input->post('batas_waktu'));

        $kini = new DateTime('now');
        $kemarin = new DateTime($batas_waktu);
        $kemarin->diff($kini)->format('%a hari %h jam %i menit % detik');

        $datetime1 = new DateTime('now');
        $datetime2 = new DateTime($batas_waktu);
        $difference = $datetime1->diff($datetime2);

        $waktu_lama_instruksi = $kemarin->diff($kini)->format('%a');


        $paraf_kasi = addslashes($this->input->post('paraf_kasi'));
        $paraf_kajari = addslashes($this->input->post('paraf_kajari'));
        $tgl_disposisi = addslashes($this->input->post('tgl_disposisi'));
        $catatan = addslashes($this->input->post('catatan'));
        $tgl_laporan = '';


        $cari = addslashes($this->input->post('q'));

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM disposisi WHERE id_surat_masuk = '$id_suratu'")->num_rows();
        $per_page = 15000;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, base_url() . "disposisi/surat_disposisi/" . $id_suratu . "/p");

        $a['judul_surat'] = gval("surat_masuk", "id_surat_masuk", "perihal_surat_masuk", $id_suratu);
        $a['pengirim'] = gval("surat_masuk", "id_surat_masuk", "asal_surat_masuk", $id_suratu);
        $a['sifat'] = gval("surat_masuk", "id_surat_masuk", "status_surat_masuk", $id_suratu);
        $a['tgl_penyelesaian'] = gval("surat_masuk", "id_surat_masuk", "tgl_penyelesaian", $id_suratu);

        //upload config
        $config['upload_path'] 		= './upload/surat_masuk';
        $config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|ppt|pptx|xls|xlsx';
        $config['max_size']			= '2000';
        $config['max_width']  		= '3000';
        $config['max_height'] 		= '3000';

        $this->load->library('upload', $config);

        if ($act == "del") {
            $this->db->query("DELETE FROM disposisi WHERE id_disposisi = '$id_dispu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil dihapus </div>");
            redirect('disposisi/surat_disposisi/' . $id_dispu);
        } else if ($act == "add") {
            $this->breadcrumbs->push('Beranda', '/admin');
            $this->breadcrumbs->push('Surat Masuk', '/surat_masuk/masuk');
            $this->breadcrumbs->push('Surat Disposisi', 'disposisi/surat_disposisi/' . $id_suratu);
            $this->breadcrumbs->push('Tambah Surat Disposisi', 'disposisi/surat_disposisi/');
            $a['page'] = "surat_disposisi/f_surat_disposisi";
        } else if ($act == "edt") {
            $this->breadcrumbs->push('Beranda', '/admin');
            $this->breadcrumbs->push('Surat Masuk', '/surat_masuk/masuk');
            $this->breadcrumbs->push('Surat Disposisi', 'disposisi/surat_disposisi/' . $id_suratu);
            $this->breadcrumbs->push('Ubah Surat Disposisi', 'disposisi/surat_disposisi/');
            $a['datpil'] = $this->db->query("SELECT d.*, s.status_disposisi  FROM disposisi d, surat_masuk s  WHERE  d.id_disposisi = '$id_dispu' and d.id_surat_masuk = s.id_surat_masuk")->row();
            $a['page'] = "surat_disposisi/f_surat_disposisi";
        } else if ($act == "act_add") {
            if ($this->upload->do_upload('lampiran_dokumen')) {
                $lampiran_dokumen = $this->upload->data();
                $tgl_laporan = date('Y-m-d');
            }
            if ($this->upload->do_upload('lampiran_foto')) {
                $lampiran_foto = $this->upload->data();
            }
            $queryDisposi = $this->db->query("INSERT INTO disposisi(
                `id_disposisi` ,
                `id_surat_masuk` ,
                `kode_intruksi` ,
                `isi_instruksi` ,
                `tgl_instruksi` ,
                `batas_waktu` ,
                `waktu_lama_instruksi` ,
                `paraf_kasi` ,
                `paraf_kajari` ,
                `tujuan_disposisi` ,
                `tgl_disposisi` ,
                `catatan`,
                `lampiran_foto`,
                `lampiran_dokumen`
            ) 
            VALUES (NULL, '$id_surat_masuk', '$kode_intruksi', '$isi_instruksi', NOW(),'$batas_waktu', '$waktu_lama_instruksi', '$paraf_kasi', '$paraf_kajari', '$tujuan_disposisi', NOW() , '$catatan', '".$lampiran_foto['file_name']."' ,'".$lampiran_dokumen['file_name']."')");
            if ($queryDisposi) {
                if ($kode_intruksi == 1) {
                    $status = 3;
                } else {
                    $status = 2;
                }
                $this->db->query("UPDATE surat_masuk SET status_disposisi = '$status' where id_surat_masuk ='$id_surat_masuk'");
            }
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Disposisi berhasil ditambahkan</div>");
            redirect('surat_masuk/masuk');
        } else if ($act == "act_edt") {
            $lampiran = $this->db->query("SELECT lampiran_foto, lampiran_dokumen FROM disposisi WHERE id_disposisi = '$id_disposisi'")->row();
            if ($this->upload->do_upload('lampiran_dokumen')) {
                $lampiran_dokumen = $this->upload->data();
                $lampiran_dokumen = $lampiran_dokumen['file_name'];
                $tgl_laporan = date('Y-m-d');
            } else {
                $lampiran_dokumen = $lampiran->lampiran_dokumen;
            }
            if ($this->upload->do_upload('lampiran_foto')) {
                $lampiran_foto = $this->upload->data();
                $lampiran_foto = $lampiran_foto['file_name'];
            }else {
                $lampiran_foto = $lampiran->lampiran_foto;
            }
            $this->db->query("UPDATE disposisi SET tujuan_disposisi = '$tujuan_disposisi', kode_intruksi = '$kode_intruksi', isi_instruksi = '$isi_instruksi', batas_waktu = '$batas_waktu', waktu_lama_instruksi = '$waktu_lama_instruksi',  paraf_kajari = '$paraf_kajari', paraf_kasi = '$paraf_kasi', catatan = '$catatan', lampiran_foto = '".$lampiran_foto."', lampiran_dokumen = '".$lampiran_dokumen."' , tgl_laporan = '".$tgl_laporan."' WHERE id_disposisi = '$id_disposisi'");

            if ($kode_intruksi == 1) {
                $status = 3;
            } else if ($kode_intruksi == 2) {
                $status = 2;
            }
            $this->db->query("UPDATE surat_masuk SET status_disposisi = '$status' where id_surat_masuk ='$id_surat_masuk'");

            if ($lampiran_dokumen) {
                $this->db->query("UPDATE surat_masuk SET status_disposisi = '3' where id_surat_masuk ='$id_surat_masuk'");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Disposisi berhasil diubah. </div>");
            redirect('surat_masuk/masuk');
        } else {
            $this->breadcrumbs->push('Beranda', '/admin');
            $this->breadcrumbs->push('Surat Masuk', '/surat_masuk/masuk');
            $this->breadcrumbs->push('Surat Disposisi', 'disposisi/surat_disposisi/');
            $a['data'] = $this->db->query("SELECT d.*, rd.tujuan_disposisi as disposisi FROM disposisi d, ref_disposisi rd WHERE d.id_surat_masuk = '$id_suratu' and rd.id = d.tujuan_disposisi  LIMIT $awal, $akhir ")->result();
            $a['page'] = "surat_disposisi/l_surat_disposisi";
        }
        $a['ref_disposisi'] = $this->crud_ref_disposisi->get_all_ref_disposisi();
        $this->load->view('admin/index', $a);
    }


    public function disposisi_cetak()
    {
        $idu = $this->uri->segment(3);
        $a['datpil1'] = $this->db->query("SELECT * FROM surat_masuk WHERE id_surat_masuk = '$idu'")->row();
        $a['datpil2'] = $this->db->query("SELECT tujuan_disposisi FROM disposisi WHERE id_surat_masuk = '$idu'")->result();
        $a['datpil3'] = $this->db->query("SELECT d.isi_instruksi, m.status_surat_masuk, d.batas_waktu FROM disposisi d, surat_masuk m  WHERE d.id_surat_masuk = '$idu' AND d.id_surat_masuk=d.id_surat_masuk ")->result();
        $this->load->view('admin/surat_disposisi/disposisi_cetak', $a);
    }


}
