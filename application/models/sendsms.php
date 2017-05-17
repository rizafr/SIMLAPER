<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendsms extends CI_Model {

    const KADER_TYPE = 1;
    const PASIEN_TYPE = 2;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function existUser($type, $phoneNumber)
    {
        $this->db->select("id, name");
        if ($type === self::KADER_TYPE) {
            $this->db->from("kader");
        } else {
            $this->db->from("pasien");
        }
        $this->db->where("phoneNumber",$phoneNumber);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
           return $query->row();
        } else {
              return 0;
        }
    }
    
    public function getRwPasien($rwNumber)
    {
        $this->db->select("name, phoneNumber");
        $this->db->from("pasien");
        $this->db->where("rw",$rwNumber);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
           return $query->result_array();
        } else {
            return null;
        }
    }

    /**
     * Use for store original sms format.
     * @param type $datasource Include datetime, senderNumber, rawMessage.
     * @return type
     */
    public function receiveRawMessage($datasource) {
        $this->db->insert('rawMessages', $datasource);
        return $this->db->insert_id();
    }
    
    public function inbox($datasource) {
        $this->db->insert('inbox', $datasource);
        return $this->db->insert_id();
    }
    
    public function registerUser($type, $datasource) {
        if ($type === self::KADER_TYPE) {
            return $this->saveKader($datasource);
        }
        $this->db->insert('pasien', $datasource);
        return $this->db->insert_id();
    }
    
    private function saveKader($datasource) {
        $this->db->insert('kader', $datasource);
        return $this->db->insert_id();
    }
    
    public function updateUserData($id, $type, $datasource) {
        if ($type === self::KADER_TYPE) {
            return $this->updateKader($id, $datasource);
        }
        $this->db->where('id', $id);
        return $this->db->update('pasien', $datasource);
    }
    
    private function updateKader($id, $datasource) {
        $this->db->where('id', $id);
        return $this->db->update('kader', $datasource);
    }
    
    public function saveReport($datasource) {
        $this->db->insert('report', $datasource);
        return $this->db->insert_id();
    }
    
    public function response($receive, $messageText)
    {
        exec("sudo gammu sendsms TEXT ".$receive." -text ".$messageText);
    }
}

?>