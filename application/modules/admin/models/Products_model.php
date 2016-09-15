<?php
class Products_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function listproducts($condition = ''){
        $query =$this->db->query('select * from products '.$condition.' ');
        $data = $query->result_array();
        return $data;
    }
    
    public function countAll($condition = ''){
        $query=$this->db->query('select * from products '.$condition.'  ');
        $result = $query->num_rows('products');
        return $result; 
    }

    public function infoproducts($id = ''){
        $query =$this->db->query('select * from products where id="'.$id.'" ');
        return $query->row_array();
    }

    public function checknameproducts($name = ''){
        $query =$this->db->query('select * from products where name="'.$name.'" ');
        return $query->row_array();
    }
    
    public function checknameproducts_update($id = '',$name = ''){
        $query =$this->db->query('select * from products where name="'.$name.'" and id != "'.$id.'" ');
        return $query->row_array();
    }

    public function listproductssearch_name($keysearch = ''){
        $query=$this->db->query('select * from products  where name LIKE  "%'.$keysearch.'%" ');
        $data = $query->result_array();
        return $data;
    }

    public function listproductssearch_code($keysearch = ''){
        $query=$this->db->query('select * from products  where code LIKE  "%'.$keysearch.'%" ');
        $data = $query->result_array();
        return $data;
    } 

    public function addproducts($data){
    	$result = $this->db->insert("products",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updateproducts($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("products",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deleteproducts($id){
        $this->db->where("id",$id);
        $result = $this->db->delete("products");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }
}