<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usersModel
 *
 * @author Sumapala Technologies
 */
class Crud_sifat_surat extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_sifat_surat()
    {
        $this->db->select('*');
        $this->db->from('ref_sifat_surat');
        $this->db->order_by("deskripsi", "asc");
        $query = $this->db->get();

        return $query->result();
    }
}