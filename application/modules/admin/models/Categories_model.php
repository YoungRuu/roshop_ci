<?php
class Categories_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function listcate($condition = ''){
        $query =$this->db->query('SELECT * FROM categories '.$condition.' ');
        $data = $query->result_array();
        return $data;
    }
    
    public function countAll($condition = ''){
        $query=$this->db->query('SELECT * FROM categories '.$condition.'  ');
        $result = $query->num_rows('categories');
        return $result; 
    }

    public function infocate($id){
        $query =$this->db->query('SELECT * FROM categories where id="'.$id.'" ');
        return $query->row_array();
    }

    public function checknamecate($name){
        $query =$this->db->query('SELECT * FROM categories where name="'.$name.'" ');
        return $query->row_array();
    }

    public function addcate($data){
    	$result = $this->db->insert("categories",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updatecate($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("categories",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deletecate($id){
        $this->db->where("id",$id);
        $result = $this->db->delete("categories");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }
}