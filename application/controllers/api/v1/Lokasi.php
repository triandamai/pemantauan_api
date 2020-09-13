<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Lokasi extends REST_Controller {

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
  
    public function titik_get(){
        $data = $this->DataModel->getData('titik');
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
    public function user_get()
    {
        $hasil = array();
        $id = 0;

        $id = $this->get('id');
        if ($id === NULL)
        {
            $data = $this->DataModel->select('*');
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = loc.id_pegawai','INNER');
            $data = $this->DataModel->order_by("loc.id_lokasi","ASC");
            $data = $this->DataModel->getData('lokasi AS loc');
            $datatitik = $this->DataModel->getData('titik');
            $id=1;
            if($data && $data->num_rows() >= 1){
                foreach($data->result() as $r){
                  array_push($hasil,(object)[
                      "id" => $id,
                      "lat"=>$r->lat,
                      "lng"=>$r->lng,
                      "ket" => $r->nama_lengkap,
                      "detail" => $r->nrp
                  ]);
                  $id++;
                }
                
                
            }
            if($datatitik && $datatitik->num_rows() >= 1){
                foreach($datatitik->result() as $r){
                    array_push($hasil,(object)[
                        "id"=>$id,
                        "lat"=>$r->lat,
                        "lng"=>$r->lng,
                        "ket" => $r->nama,
                        "detail" => $r->detail
                    ]);   
                    $id++; 
                }
            }

            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil",
                "data"                  => $hasil,
            ), REST_Controller::HTTP_OK);
    
        }else {
            
            $data = $this->DataModel->select('*');
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = loc.id_pegawai','INNER');
            $data = $this->db->where("loc.id ",$id);
            $data = $this->DataModel->order_by("loc.id_lokasi","ASC");
            $data = $this->DataModel->getData('lokasi AS loc');
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
   
    public function location_post(){

            $jsonArray = json_decode(file_get_contents('php://input'),true);


            $check = $this->DataModel->getWheretbl('lokasi','id_pegawai',$jsonArray['id_pegawai'])->num_rows();
        
            if($check >0){
                $data = $this->DataModel->update("id_pegawai",$jsonArray['id_pegawai'],'lokasi',$jsonArray);
                if($data){
                    return $this->response(array(
                   "status"                => true,
                   "response_code"         => REST_Controller::HTTP_OK,
                   "response_message"      => "Berhasil Merubah Lokasi",
                   "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }else{
                    return $this->response(array(
                   "status"                => false,
                   "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                   "response_message"      => "Gagal Merubah Lokasi",
                   "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }
            }else{
                $data = $this->DataModel->insert('lokasi',$jsonArray);
                if($data){
                    return $this->response(array(
                   "status"                => true,
                   "response_code"         => REST_Controller::HTTP_OK,
                   "response_message"      => "Berhasil Menyimpan Lokasi",
                   "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }else{
                    return $this->response(array(
                   "status"                => false,
                   "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                   "response_message"      => "Gagal Menyimpan Data",
                   "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }
            }
            
      
   }
  


}