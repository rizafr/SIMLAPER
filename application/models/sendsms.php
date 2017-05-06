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

    /**
     * Send via Sms
     * @param type $host
     * @param type $port
     * @param type $username
     * @param type $password
     * @param type $phoneNoRecip
     * @param type $msgText
     * @return string
     */
    public function response($host = "127.0.0.1", $port = "8800", $username = null, $password = null, $phoneNoRecip, $msgText) {
        $fp = fsockopen($host, $port, $errno, $errstr);
        if (!$fp) {
            echo "errno: $errno \n";
            echo "errstr: $errstr\n";
            return $result;
        }
    	
        fwrite($fp, "GET /?Phone=" . rawurlencode($phoneNoRecip) . "&Text=" . rawurlencode($msgText) . " HTTP/1.0\n");
        if ($username != "") {
            $auth = $username . ":" . $password;
            $auth = base64_encode($auth);
            fwrite($fp, "Authorization: Basic " . $auth . "\n");
        }
        fwrite($fp, "\n");
        $res = "";
        while(!feof($fp)) {
            $res .= fread($fp,1);
        }
        fclose($fp);
        return $res;
    }
}

?>