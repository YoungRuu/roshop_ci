<?php
class Acreages_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function listacreage(){
        $query =$this->db->query('SELECT * FROM acreages');
        $data = $query->result_array();
        return $data;
    }

    public function listacreage_parent(){
        $query =$this->db->query('SELECT id , name , parent_id FROM acreages where parent_id = 0');
        $data = $query->result_array();
        return $data;
    }

    public function listacreage_children($parent_id = ''){
        $query =$this->db->query('SELECT id , name , parent_id FROM acreages where parent_id = '.$parent_id.' ');
        $data = $query->result_array();
        return $data;
    }

    public function updateacreagealias($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("acreages",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }
   
}