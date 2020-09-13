<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Laporan extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
       
        
    }
    public function index_get(){
        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Hai",
            "data"                  => "",
        ), REST_Controller::HTTP_OK);
    }
  
    public function laporan_get()
    {
        $id = $this->get('id');
        if ($id === NULL)
        {
            $data = $this->DataModel->select('*');
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = l.id_pegawai','INNER');
            $data = $this->DataModel->order_by("l.created_at","ASC");
            $data = $this->DataModel->getData('laporan AS l');
            if($data && $data->num_rows() >= 1){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => $data->result(),
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Gagal Mendapatkan Data",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }else {
            
            $data = $this->DataModel->select('*');
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = loc.id_pegawai','INNER');
            $data = $this->db->where("loc.id ",$id);
            $data = $this->DataModel->order_by("l.created_at","ASC");
            $data = $this->DataModel->getData('laporan AS l');
            if($data && $data->num_rows() >= 1){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => $data->result(),
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Gagal Mendapatkan Data",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }
    }
   
    public function laporan_post(){

            $jsonArray = json_decode(file_get_contents('php://input'),true);


            if(!empty($jsonArray['media'])){

                $mediabase64  = base64_decode($jsonArray['media']);
    
                $image_media = "LAPORAN_".$this->uuid().".jpg";
                file_put_contents("public/" . $image_media, $mediabase64);
    
                
                $data_input =[
                    'id_pegawai'       => $jsonArray['id_pegawai'],
                    'kode_laporan' => $this->DataModel->get_last_id(),
                    'deskripsi'  => $jsonArray['deskripsi'],
                    'media'        => $image_media,
                    'lat'        => $jsonArray['lat'],
                    'lng'       => $jsonArray['lng'],
                    'created_at'   => date('y-m-d h:i:s'),
                    'updated_at'   => date('y-m-d h:i:s')
                ];  
    
                $data_input2 =[
                    'id_pegawai'       => $jsonArray['id_pegawai'],
                    'deskripsi'  => $jsonArray['deskripsi'],
                    'media'        => $image_media,
                    'lat'        => $jsonArray['lat'],
                    'lng'       => $jsonArray['lng'],
                    'updated_at'   => date('y-m-d h:i:s')
                ];  
                if($jsonArray['id_laporan'] == null){
                    $data = $this->DataModel->insert('laporan',$data_input);
                    if($data){
                        return $this->response(array(
                       "status"                => true,
                       "response_code"         => REST_Controller::HTTP_OK,
                       "response_message"      => "Berhasil Merubah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }else{
                        return $this->response(array(
                       "status"                => false,
                       "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                       "response_message"      => "Gagal Merubah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }
                }else{
                $check = $this->DataModel->getWheretbl('laporan','id_laporan',$jsonArray['id_laporan'])->num_rows();

                if($check >0){

                    $data = $this->DataModel->update("id_laporan",$jsonArray['id_laporan'],'laporan',$data_input2);
                    if($data){
                        return $this->response(array(
                       "status"                => true,
                       "response_code"         => REST_Controller::HTTP_OK,
                       "response_message"      => "Berhasil Menambah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }else{
                        return $this->response(array(
                       "status"                => false,
                       "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                       "response_message"      => "Gagal Menambah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }
                }else{

                    $data = $this->DataModel->insert('laporan',$data_input);
                    if($data){
                        return $this->response(array(
                       "status"                => true,
                       "response_code"         => REST_Controller::HTTP_OK,
                       "response_message"      => "Berhasil Merubah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }else{
                        return $this->response(array(
                       "status"                => false,
                       "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                       "response_message"      => "Gagal Merubah Laporan",
                       "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }
                 
                }
            } 
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Isi Gambar terlebih dahulu!",
                    "data"                  => null,
                     ), REST_Controller::HTTP_OK);
            }
            
   }
  
    //TODO : generate v4 uuid
    protected function uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}