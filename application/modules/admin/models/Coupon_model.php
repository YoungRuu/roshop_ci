<?php
class Coupon_model extends CI_Model{
    public function __construct(){
    	parent::__construct();
    }
 	/*--Coupon--*/
    public function infocoupon($coupon_code = ''){
        $query =$this->db->query('select * from coupon where coupon_code="'.$coupon_code.'" and status = 0 limit 1');
        return $query->row_array();
    }

    public function infocouponall($coupon_id = ''){
        $query =$this->db->query('select * from coupon where id='.$coupon_id.' ');
        return $query->row_array();
    }

    public function updateactivecoupon($coupon_id){
        $query =$this->db->query('UPDATE coupon SET status = 1 WHERE id = '.$coupon_id.' limit 1');
        return;
    }


    public function listcoupon($condition = ''){
        $query =$this->db->query('select * from coupon '.$condition.' ');
        $data = $query->result_array();
        return $data;
    }
    
    public function countAll($condition = ''){
        $query=$this->db->query('select * from coupon '.$condition.'  ');
        $result = $query->num_rows('coupon');
        return $result; 
    }

    public function addcoupon($data){
        $result = $this->db->insert("coupon",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updatecoupon($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("coupon",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deletecoupon($id){
        $this->db->where("id",$id);
        $result = $this->db->delete("coupon");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deletecoupon_end(){
        $this->db->where("UNIX_TIMESTAMP(date_end) < ",time());
        // $this->db->or_where("status", "1");
        $result = $this->db->delete("coupon");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

}