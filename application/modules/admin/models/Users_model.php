<?php
class Users_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function listusers($condition = ''){
        $query =$this->db->query('select * from users '.$condition.' ');
        $data = $query->result_array();
        return $data;
    }
    
    public function countAll($condition = ''){
        $query=$this->db->query('select * from users '.$condition.'  ');
        $result = $query->num_rows('users');
        return $result; 
    }

    public function infousers($id){
        $query =$this->db->query('SELECT * FROM users WHERE id="'.$id.'" ');
        return $query->row_array();
    }

    public function checkusername($username){
        $query =$this->db->query('SELECT * FROM users WHERE username="'.$username.'" ');
        return $query->row_array();
    }

    public function addusers($data){
    	$result = $this->db->insert("users",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updateusers($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("users",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deleteusers($id){
        $this->db->where("id",$id);
        $result = $this->db->delete("users");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }
}