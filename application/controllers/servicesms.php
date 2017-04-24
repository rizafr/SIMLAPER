<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicesms extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('sendsms');
    }
    
    public function index()
    {
//        nothing todo
    }


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
        
        if (count($arrayContent) < 4 || count($arrayContent) > 5) {
            $repliedText = "Maaf FORMAT REGISTRASI SALAH, mohon periksa dan ulangi registrasi";
            $this->sendResponse($sender, $repliedText);
        }
        
        $nama = trim(strtoupper($$arrayContent[1]));
        $rw = trim(strtoupper($$arrayContent[2]));
        $status = trim($$arrayContent[3]);
        $datasource = array(
            "name" => $nama,
            "phoneNumber" => $sender,
            "rw" => $rw,
            "status" => $status,
            "createdTime" => $dateTime,
            "createdBy" => "smsgateway"
        );
        if (count($arrayContent) > 4) {
            $isExist = $this->Sendsms->existUser(Sendsms::PASIEN_TYPE, $sender);
            if ($isExist) {
                $repliedText = "Maaf, no ".$sender." telah terdaftar sebelumnya atas nama " . $nama;
                $this->sendResponse($sender, $repliedText);
            } else {
                $age = trim($$arrayContent[4]);
                $datasource["age"] = $age;
                $isSaved = $this->Sendsms->registerUser(Sendsms::PASIEN_TYPE, $datasource);
                if($isSaved) {
                    $repliedText = "Terima kasih, Sdr. ".$nama." telah terdaftar sebagai PASIEN";
                    $this->sendResponse($sender, $repliedText);
                } else {
                    $repliedText = "Maaf, Sdr. ".$nama." GAGAL tersimpan, silahkan coba lagi";
                    $this->sendResponse($sender, $repliedText);
                }
            }
        } else {
            $isSaved = $this->Sendsms->registerUser(Sendsms::KADER_TYPE, $datasource);
            $repliedText = "Terima kasih, Sdr. ".$nama." telah terdaftar sebagai KADER";
            $this->sendResponse($sender, $repliedText);
        }
    }
    
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
        
        if (count($arrayContent) < 4 || count($arrayContent) > 5) {
            $repliedText = "Maaf FORMAT UPDATE SALAH, mohon periksa dan ulangi update";
            $this->sendResponse($sender, $repliedText);
        }
        
        $nama = trim(strtoupper($$arrayContent[1]));
        $rw = trim(strtoupper($$arrayContent[2]));
        $status = trim($$arrayContent[3]);
        $datasource = array(
            "name" => $nama,
            "phoneNumber" => $sender,
            "rw" => $rw,
            "status" => $status,
        );
        $isExist = $this->Sendsms->existUser(Sendsms::PASIEN_TYPE, $sender);
        if ($isExist) {
            if (count($arrayContent) > 4) {
                $age = trim($$arrayContent[4]);
                $datasource["age"] = $age;
                $isSaved = $this->Sendsms->updateUser($isExist->id, Sendsms::PASIEN_TYPE, $datasource);
                if($isSaved) {
                    $repliedText = "Terima kasih,data Sdr. ".$nama." telah diperbaharui";
                    $this->sendResponse($sender, $repliedText);
                } else {
                    $repliedText = "Maaf, Sdr. ".$nama." GAGAL tersimpan, silahkan coba lagi";
                    $this->sendResponse($sender, $repliedText);
                }
            } else {
                $isSaved = $this->Sendsms->updateUser($isExist->id, Sendsms::KADER_TYPE, $datasource);
                $repliedText = "Terima kasih, Sdr. ".$nama." telah diperbaharui";
                $this->sendResponse($sender, $repliedText);
            }
        } else {
            $repliedText = "Maaf, tidak dapat melakukan update, no ".$sender." belum terdaftar";
            $this->sendResponse($sender, $repliedText);
        }
    }
    
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
            $repliedText = "Maaf FORMAT Broadcast SALAH, mohon periksa dan ulangi broadcast";
            $this->sendResponse($sender, $repliedText);
        }
        
        $rw = trim(strtoupper($$arrayContent[0]));
        $messages = trim(strtoupper($$arrayContent[1]));
        $datasource = array(
            "datetime" => $dateTime,
            "sender" => $sender,
            "rwNumber" => $rw,
            "message" => $messages,
        );
        $isExist = $this->Sendsms->existUser(Sendsms::KADER_TYPE, $sender);
        if ($isExist) {
            $pasiens = $this->Sendsms->getRwPasien($rw);
            if ($pasiens) {
                $datasource = array(
                    "datetime" => $dateTime,
                    "sender" => $sender,
                    "rwNumber" => $rw,
                    "message" => $messages
                );
                $this->Sendsms->saveReport();
                foreach ($pasiens as $pasien) {
                    $this->sendResponse($pasien['phoneNumber'], $messages);
                }
            }
        } else {
            $repliedText = "Maaf, tidak dapat melakukan proses,".$sender." tidak terdaftar terdaftar";
            $this->sendResponse($sender, $repliedText);
        }
    }

    private function sendResponse($sender, $repliedText)
    {
        $this->Sendsms->response($sender, $repliedText);
        echo $repliedText;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */