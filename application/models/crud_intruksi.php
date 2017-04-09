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
class Crud_intruksi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_instruksi()
    {
        $this->db->select('*');
        $this->db->from('pelaksanaan_intruksi');
        $this->db->order_by("intruksi", "asc");
        $query = $this->db->get();

        return $query->result();
    }
}