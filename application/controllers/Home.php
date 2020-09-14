<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



use Restserver\Libraries\REST_Controller;

class Home extends REST_Controller {

    function __construct()
    {
       
        parent::__construct();
    }

    public function index_post()
    {
        $hasil = array();
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for($i = 1; $i < 65; $i++){
                $nip      = $sheetData[$i]["1"];
                $nrp      = $sheetData[$i]["2"];
                $nama     = $sheetData[$i]["3"];
                $golongan = $sheetData[$i]["4"];
                $tmt      = $sheetData[$i]["5"];
                $jabatan  = $sheetData[$i]["6"];
                $alamat   = $sheetData[$i]["7"];
                $password = $sheetData[$i]["8"];
                $level    = $sheetData[$i]["9"];
                $hp       = $sheetData[$i]["10"];
                array_push($hasil,(object)[
                    "nip"              => $nip,
                    "nrp"              => $nrp,
                    "nama_lengkap"     => $nama,
                    "golongan_pangkat" => $golongan,
                    "tmt"              => $tmt,
                    "jabatan"          => $jabatan,
                    "alamat_tinggal"   => $alamat,
                    "password"         => $password,
                    "level"            => $level,
                    "no_hp"            => $hp
                ]);

            }
            $simpan = $this->DataModel->save_batch("pegawai",$hasil);
            
            return $this->response(array(
                "status"                => false,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "Password baru tidak boleh sama dengan password lama",
                "data"                  => $simpan,
            ), REST_Controller::HTTP_OK);
       
        
}
}
    

}