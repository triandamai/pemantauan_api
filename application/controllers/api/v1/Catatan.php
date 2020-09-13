<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Catatan extends REST_Controller {

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

    public function catatan_get(){
        $id = $this->get('id');
        if ($id === NULL)
        {
            $data = $this->DataModel->select('*');
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = c.id_pegawai','INNER');
            $data = $this->DataModel->order_by("c.tanggal","ASC");
            $data = $this->DataModel->getData('catatan AS c');
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
        
            $data = $this->DataModel->getJoin('pegawai as pegawai','pegawai.id = c.id_pegawai','INNER');
            $data = $this->db->where("c.id_pegawai ",$id);
            $data = $this->DataModel->order_by("c.tanggal","ASC");
            $data = $this->DataModel->getData('catatan AS c');
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

    public function catatan_post(){
        $jsonArray = json_decode(file_get_contents('php://input'),true);

        $data_input =[
            "id_pegawai" => $jsonArray['id_pegawai'],
            "judul"      => $jsonArray['judul'],
            "isi"        => $jsonArray['isi'],
            "tanggal"    => date('y-m-d h:i:s')
        ];
        if($jsonArray['id_catatan'] == null){
            $data = $this->DataModel->insert('catatan',$data_input);
            if($data){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil Menambah",
                    "data"                  => $data,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Gagal Menambah",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
        }else{
            $check = $this->DataModel->getWheretbl('catatan','id_catatan',$jsonArray['id_catatan'])->num_rows();

            if($check >0){

                $data = $this->DataModel->update("id_catatan",$jsonArray['id_catatan'],'catatan',$data_input);
                if($data){
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_OK,
                        "response_message"      => "Berhasil Merubah Data",
                        "data"                  => $data,
                    ), REST_Controller::HTTP_OK);
                }else{
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                        "response_message"      => "Gagal Merubah",
                        "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }
            }
        }

    }
    public function delete_post(){
        $id = $this->post("id");

        if ($id == NULL || $id == ""){
        
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "id tidak terdaftar",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
    
        }else {
            $data = $this->DataModel->delete("id_catatan", $id,"catatan");
            if($data){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => $data,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "id tidak terdaftar",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }
    }


}