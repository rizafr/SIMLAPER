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
class Crud_ref_disposisi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_ref_disposisi()
    {
        $this->db->select('*');
        $this->db->from('ref_disposisi');
        $this->db->order_by("tujuan_disposisi", "asc");
        $query = $this->db->get();

        return $query->result();
    }

}