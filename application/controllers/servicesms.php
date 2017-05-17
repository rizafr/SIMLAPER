<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicesms extends CI_Controller {
    
    const REGISTER = 1;
    const UPDATE = 2;

    private $_type = ['undefined', 'KADER', 'PASIEN'];

    function __construct() {
        parent::__construct();
        $this->load->model('sendsms');
    }
    
    public function index()
    {
//      testing purpose
        $receiver =  $_GET["receiver"];
        $messages =  $_GET["message"];
        $this->sendsms->response($receiver, $messages);
    }

    /**
     * Register function
     * @return void
     */
    public function register()
    {
        $sender =  $_GET["sender"];
        $content =  $_GET["content"];
        $dateTime = date("Y-m-d H:i:s");
        
        $content = trim($content);
        
        $this->sendsms->receiveRawMessage(
        array(
            "datetime" => $dateTime,
            "sender" => $sender,
            "message" => $content
        ));
        
        $arrayContent = explode("#", $content);
        
        if (count($arrayContent) < 3 || count($arrayContent) > 4) {
            $repliedText = "Maaf FORMAT REGISTRASI SALAH, mohon periksa dan ulangi registrasi";
            $this->sendResponse($sender, $repliedText);
            return;
        }
 
        if (count($arrayContent) === 4) {
            $this->registerNewUser(sendsms::PASIEN_TYPE, $sender, $arrayContent);
        } else {
            $this->registerNewUser(sendsms::KADER_TYPE, $sender, $arrayContent);
        }
    }

    private function registerNewUser($type, $sender, $arrayContent)
    {
        $isExist = $this->sendsms->existUser($type, $sender);
        if (!empty($isExist)) {
            $repliedText = "Maaf, notelp ".$sender." telah terdaftar sebelumnya atas nama " . $isExist->name;
            $this->sendResponse($sender, $repliedText);
        } else {
            $datasource = $this->structedSource(self::REGISTER, $type, $sender, $arrayContent);
            $isSaved = $this->sendsms->registerUser($type, $datasource);
            if($isSaved) {
                $repliedText = "Terima kasih, Sdr. ".$datasource['name']." telah terdaftar sebagai ".$this->_type[$type];
                $this->sendResponse($sender, $repliedText);
                return;
            } 
            $repliedText = "Maaf, Sdr. ".$datasource['name']." GAGAL tersimpan, silahkan coba lagi";
            $this->sendResponse($sender, $repliedText);
        }
    }
    
    private function structedSource($statusType, $type, $sender, $arrayContent)
    {
        $dateTime = date("Y-m-d H:i:s");
        $nama = trim(strtoupper($arrayContent[0]));
        $rw = trim(strtoupper($arrayContent[1]));
        $status = trim($arrayContent[2]);
        $datasource = array(
            "name" => $nama,
            "phoneNumber" => $sender,
            "rw" => $rw,
            "status" => $status,
        );
        
        if ($statusType == self::REGISTER) {
            $datasource["createdTime"] = $dateTime;
            $datasource["createdBy"] = "smsgateway";
        }

        if ($type == Sendsms::PASIEN_TYPE) {
            $age = trim($arrayContent[3]);
            $datasource["age"] = $age;
        }
        
        return $datasource;
    }

    /**
     * Update function
     * @return void
     */
    public function update()
    {
        $sender =  $_GET["sender"];
        $content =  $_GET["content"];
        $dateTime = date("Y-m-d H:i:s");
        
        $content = trim($content);
        
        $this->sendsms->receiveRawMessage(
        array(
            "datetime" => $dateTime,
            "sender" => $sender,
            "message" => $content
        ));
        
        $arrayContent = explode("#", $content);
        
        if (count($arrayContent) < 3 || count($arrayContent) > 4) {
            $repliedText = "Maaf FORMAT UPDATE SALAH, mohon periksa dan ulangi update";
            $this->sendResponse($sender, $repliedText);
            return;
        }

        if (count($arrayContent) === 4) {
            $this->updateUser(sendsms::PASIEN_TYPE, $sender, $arrayContent);
        } else {
            $this->updateUser(sendsms::KADER_TYPE, $sender, $arrayContent);
        }
    }
    
    private function updateUser($type, $sender, $arrayContent)
    {
        $isExist = $this->sendsms->existUser($type, $sender);
        if ($isExist) {
            $datasource = $this->structedSource(self::UPDATE, $type, $sender, $arrayContent);
            $isSaved = $this->sendsms->updateUserData($isExist->id, $type, $datasource);
            if($isSaved === true) {
                $repliedText = "Terima kasih,data Sdr. ".$datasource['name']." telah diperbaharui";
                $this->sendResponse($sender, $repliedText);
                return;
            } else {
                $repliedText = "Maaf, data Sdr. ".$datasource['name'].", GAGAL tersimpan, silahkan coba lagi";
                $this->sendResponse($sender, $repliedText);
            }
        } else {
            $repliedText = "Maaf, tidak dapat melakukan update, no ".$sender." belum terdaftar";
            $this->sendResponse($sender, $repliedText);
        }
    }
    
    /**
     * Broadcast function
     * @return void
     */
    public function broadcast()
    {
        $sender =  $_GET["sender"];
        $content =  $_GET["content"];
        $dateTime = date("Y-m-d H:i:s");
        
        $content = trim($content);
        
        $this->sendsms->receiveRawMessage(
        array(
            "datetime" => $dateTime,
            "sender" => $sender,
            "message" => $content
        ));
        
        $arrayContent = explode("#", $content);

        if (count($arrayContent) < 2 || count($arrayContent) > 2) {
            $repliedText = "Maaf FORMAT Broadcast SALAH, mohon periksa dan ulangi kembali";
            return $this->sendResponse($sender, $repliedText);
        }
        
        $rw = trim(strtoupper($arrayContent[0]));
        $messages = trim($arrayContent[1]);
        $isExist = $this->sendsms->existUser(sendsms::KADER_TYPE, $sender);
        if ($isExist) {
            $pasiens = $this->sendsms->getRwPasien($rw);
            if (empty($pasiens)) {
                $repliedText = "Maaf, tidak ditemukan pasien terdaftar di RW".$rw;
                return $this->sendResponse($sender, $repliedText);
            }
            $datasource = array(
                "datetime" => $dateTime,
                "sender" => $sender,
                "rwNumber" => $rw,
                "message" => $messages
            );
            $this->sendsms->saveReport($datasource);
            foreach ($pasiens as $pasien) {
                $this->sendResponse($pasien['phoneNumber'], $messages);
            }
        } else {
            $repliedText = "Maaf, tidak dapat melakukan proses,".$sender." tidak terdaftar terdaftar";
            $this->sendResponse($sender, $repliedText);
        }
    }

    private function sendResponse($sender, $repliedText)
    {
        $this->sendsms->response($sender, $repliedText);
        echo $repliedText;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */