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
            $data = $this->DataModel->order_by("l.id_laporan","ASC");
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
            $data = $this->DataModel->order_by("l.id_laporan","ASC");
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
    
                $image_media = "LAPORAN_".date('y-m-d h:i:s'). ".jpg";
                file_put_contents("public/laporan/" . $image_media, $mediabase64);
    
                
                $data_input =[
                    'id_laporan'         => $name,
                    'id_pegawai'       => $detail,
                    'deskripsi'  => $idcategory,
                    'media'        => $price,
                    'lat'        => $image_media,
                    'lng'       => $status,
                    'created_at'   => date('y-m-d h:i:s'),
                    'updated_at'   => date('y-m-d h:i:s')
                ];  
    
                $data_input2 =[
                    'id_laporan'         => $name,
                    'id_pegawai'       => $detail,
                    'deskripsi'  => $idcategory,
                    'media'        => $price,
                    'lat'        => $image_media,
                    'lng'       => $status,
                    'updated_at'   => date('y-m-d h:i:s')
                ];  
                $check = $this->DataModel->getWheretbl('laporan','id_laporan',$jsonArray['id_laporan'])->num_rows();

                if($check >0){

                    $data = $this->DataModel->update("id_laporan",$jsonArray['id_laporan'],'laporan',$data_input2);
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
                    $data = $this->DataModel->insert('laporan',$data_input);
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
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Isi Gambar terlebih dahulu!",
                    "data"                  => null,
                     ), REST_Controller::HTTP_OK);
            }
            
   }
  


}