<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataModel
 *
 * @author zaenur
 */
class DataModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function select($col){
        $query = $this->db->select($col);
        return $query;
    }

    function selectMax($col){
        $query = $this->db->select_max($col);
        return $query;
    }

    function set_data($field,$tipe){
        return $this->db->set($field,$tipe,FALSE);
    }

    function from($table){
        $query = $this->db->from($table);
        return $query;
    }

    function order_by($col, $type){
        $query = $this->db->order_by($col, $type);
        return $query;
    }

    function limit($limit){
        $query = $this->db->limit($limit);
        return $query;
    }
    
    function distinct(){
        $query = $this->db->distinct();
        return $query;
    }
    
    function getWhere($col,$kon){
        $query = $this->db->where($col,$kon);
        return $query;
    }
    function getWheretbl($tabel,$col,$kon){
        $this->db->where($col,$kon);
        $query = $this->db->get($tabel);
        return $query;
    }
    
    function getData($table){
        $query = $this->db->get($table);
        return $query;
    }

    function getJoin($table,$condition,$type){
        $query = $this->db->join($table, $condition, $type);
        return $query;
    }

    function insert($table,$data){
        $query = $this->db->insert($table,$data);
        return $query;
    }

    function update($col,$condition,$table,$data) {
        $this->db->where($col,$condition);
        $query = $this->db->update($table, $data);
        return $query;
    }

    function delete($col, $condition,$table) {
        $query = $this->db->where($col, $condition);
        $query = $this->db->delete($table);
        return $query;
    }
    
    function get_whereArr($table, $where) {
        return $this->db->get_where($table, $where);
    }
    function count_all($table)
    {
        return $this->db->count_all($table);
    }
    function count_where($table,$kon,$col)
    {
 
        return $this->db->where($kon, $col)->count_all_results($table);; 
    }

    function save_batch($table,$data)
    {
        return $this->db->insert_batch($table,$data);
       
    }

    function update_batch($table,$data,$id){
        return $this->db->update_batch($table,$data,$id);
    }

}
