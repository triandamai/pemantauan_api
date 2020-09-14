<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

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
  
    public function user_get()
    {
        $id = $this->get('id');
        if ($id === NULL)
        {
            $data = $this->DataModel->select('*');
            $data = $this->DataModel->order_by("id","ASC");
            $data = $this->DataModel->getData('pegawai');
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
            $data = $this->db->where("id ",$id);
            $data = $this->DataModel->order_by("id","ASC");
            $data = $this->DataModel->getData('pegawai');
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
    public function register_post(){
    
        $jsonArray = json_decode(file_get_contents('php://input'),true);
  

        if ($jsonArray['nrp'] === NULL || $jsonArray['password'] === NULL)
        {
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Password Atau nrp tidak boleh kosong",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
    
        }else {
            $data_input = [
                "nip"              => $jsonArray['nip'],
                "nrp"              => $jsonArray['nrp'],
                "nama_lengkap"     => $jsonArray['nama_lengkap'],
                "golongan_pangkat" => $jsonArray['golongan_pangkat'],
                "tmt"              => $jsonArray['tmt'],
                "jabatan"          => $jsonArray['jabatan'],
                "alamat_tinggal"   => $jsonArray['alamat_tinggal'],
                "password"         => md5($jsonArray['password']),
                "level"            => $jsonArray['level'],
                "no_hp"            => $jsonArray['no_hp']

            ];
            $data = $this->DataModel->insert('pegawai', $data_input);
            if($data){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "gagal",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }
    }
    public function edit_user_post(){
        $jsonArray = json_decode(file_get_contents('php://input'),true);

        $check = $this->DataModel->getWhere('id',$jsonArray['id']);
        $check = $this->DataModel->getData("pegawai");
        if($check->num_rows() > 0){
            if($jsonArray['id'] == NULL){
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Id User Tidak Ditemukan",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
                $data= [
                    "nip" => $jsonArray['nip'],
                    "nrp" => $jsonArray['nrp'],
                    "nama_lengkap" =>$jsonArray['nama_lengkap'],
                    "golongan_pangkat" => $jsonArray['golongan_pangkat'],
                    "tmt" => $jsonArray['tmt'],
                    "jabatan" => $jsonArray['jabatan'],
                    "alamat_tinggal" => $jsonArray['alamat_tinggal'],
                    "level" => $jsonArray['level'],
                    "no_hp" => $jsonArray['no_hp']
                ];
            $simpan = $this->DataModel->update('id',$jsonArray['id'],'pegawai',$data);
            if($simpan){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Gagal Merubah ".db_error(),
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
        }
        }else{
            return $this->response(array(
                "status"                => false,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "User Tidak Ditemukan",
                "data"                  => null,
            ), REST_Controller::HTTP_OK);
        }
    }
    public function change_profil_post(){
        $jsonArray = json_decode(file_get_contents('php://input'),true);

        $check = $this->DataModel->getWhere('id',$jsonArray['id']);
        $check = $this->DataModel->getData("pegawai");
        if($check->num_rows() > 0){
            if($jsonArray['id'] == NULL){
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Id User Tidak Ditemukan",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{

            $simpan = $this->DataModel->update('id',$jsonArray['id'],'pegawai',$jsonArray);
            if($simpan){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Gagal Merubah ".db_error(),
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
        }
        }else{
            return $this->response(array(
                "status"                => false,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "User Tidak Ditemukan",
                "data"                  => null,
            ), REST_Controller::HTTP_OK);
        }
    }
    public function change_password_post(){
        $jsonArray = json_decode(file_get_contents('php://input'),true);

        $check = $this->DataModel->getWhere('id',$jsonArray['id']);
        $check = $this->DataModel->getData("pegawai");
        if($check->num_rows() > 0){
            if($jsonArray['id'] == NULL){
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Id User Tidak Ditemukan",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
            $get = $check->row();
           
            $data =[
                'password' => md5($jsonArray['newpassword'])
            ];
            if($get->password != md5($jsonArray['password'])){
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Password lama tidak sesuai",
                    "data"                  => null,
                    "lama"                  => $get->password,
                    "baru"                  => md5($jsonArray['password']),
                ), REST_Controller::HTTP_OK);
            }else{
                if($get->password ===  md5($jsonArray['newpassword'])){
                    return $this->response(array(
                        "status"                => false,
                        "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                        "response_message"      => "Password baru tidak boleh sama dengan password lama",
                        "data"                  => null,
                    ), REST_Controller::HTTP_OK);
                }else{
                   $simpan = $this->DataModel->update('id',$jsonArray['id'],'pegawai',$data);
                   if($simpan){
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_OK,
                            "response_message"      => "Berhasil",
                            "data"                  => $get->password,
                        ), REST_Controller::HTTP_OK);
                    }else{
                        return $this->response(array(
                            "status"                => false,
                            "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                            "response_message"      => "Gagal Merubah ".db_error(),
                            "data"                  => null,
                        ), REST_Controller::HTTP_OK);
                    }
               }
            }
            }
        }else{
            return $this->response(array(
                "status"                => false,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "User Tidak Ditemukan",
                "data"                  => null,
            ), REST_Controller::HTTP_OK);
        }
    }
    public function change_level_post(){
    
        $jsonArray = json_decode(file_get_contents('php://input'),true);
        
        if($jsonArray['level'] == "USER"){
            $data = [
                'level' => 'ADMIN'
            ];
        }else{
            $data = [
                'level' => 'USER'
            ];
        }

        if ($jsonArray['level'] === NULL || $jsonArray['id'] === NULL)
        {
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Tidak boleh kosong",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
    
        }else {
            
            $data = $this->DataModel->update('id',$jsonArray['id'],'pegawai', $data);
            if($data){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "gagal",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }
    }
    public function auth_post(){
    
        $jsonArray = json_decode(file_get_contents('php://input'),true);
        $data = array(
            'nrp'       => $jsonArray['nrp'],
            'password'  => md5($jsonArray['password'])
        );

        if ($jsonArray['nrp'] === NULL || $jsonArray['password'] === NULL)
        {
       
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Password Atau nrp tidak terdaftar",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
    
        }else {
            $data = $this->DataModel->get_whereArr('pegawai', $data);
            if($data->num_rows() >= 1){
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil",
                    "data"                  => $data->result(),
                ), REST_Controller::HTTP_OK);
            }else{
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "Password Atau nrp tidak terdaftar",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
            }
    
        }
    }
  
    public function delete_user_post(){
        $id = $this->post("id");

        if ($id == NULL || $id == ""){
        
                return $this->response(array(
                    "status"                => false,
                    "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                    "response_message"      => "id tidak terdaftar",
                    "data"                  => null,
                ), REST_Controller::HTTP_OK);
    
        }else {
            $data = $this->DataModel->delete("id", $id,"pegawai");
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