<?php
class Orders_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function listorders($condition = ''){
        $query=$this->db->query('select * from orders '.$condition.'  ');
        $data = $query->result_array();
        return $data;
    }
    

    public function countAll($condition = ''){
        $query=$this->db->query('select * from orders '.$condition.'  ');
        $result = $query->num_rows('orders');
        return $result; 
    }

    public function infoorders($id){
        $query_list_item= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell,  ordersitem.products_price as ordersitem_price , ordersitem.products_size as ordersitem_size , ordersitem.products_color as ordersitem_color , ordersitem.products_quantity as ordersitem_products_quantity , ordersitem.created as ordersitem_created FROM ordersitem INNER JOIN products ON ordersitem.products_id = products.id WHERE ordersitem.orders_id = '.$id.' ');
        $data['list_item_orders'] = $query_list_item->result_array();

        $query_orders = $this->db->query('SELECT id as orders_id ,customer_id as orders_customerid ,user_id as orders_userid , receiver_name as orders_receivername , receiver_phone as orders_receiverphone , receiver_email as orders_receiveremail , receiver_address as orders_receiveraddress , receiver_city as orders_receivercity , receiver_district as orders_receiverdistrict ,total_money_product as orders_total_money_product , coupon_id as orders_couponid , cash_discount as orders_cashdiscount , total_money as orders_total_money , note as orders_note , status as orders_status , created as orders_created FROM orders WHERE id = '.$id.' ');
        $data['data_orders'] = $query_orders->row_array();

        /*----*/
        $query_city = $this->db->query('SELECT name  FROM acreages WHERE id ='.$data['data_orders']['orders_receivercity'].' ');
        $data['data_orders']['orders_cityname'] = $query_city->row_array();
        $query_district = $this->db->query('SELECT name  FROM acreages WHERE id ='.$data['data_orders']['orders_receiverdistrict'].' ');
        $data['data_orders']['orders_districtname'] = $query_district->row_array();
        /*----*/
        $query_customer =$this->db->query('SELECT fullname  FROM users WHERE id ='.$data['data_orders']['orders_customerid'].' ');
        $data['data_orders']['orders_customername'] = $query_customer->row_array();

        $query_user = $this->db->query('SELECT fullname ,role FROM users WHERE id ='.$data['data_orders']['orders_userid'].' ');
        $data['data_orders']['orders_username'] = $query_user->row_array();
        /*----*/
        $query_coupon = $this->db->query('SELECT coupon_value ,coupon_code FROM coupon WHERE id ='.$data['data_orders']['orders_couponid'].' ');
        $data['data_orders']['orders_coupon'] = $query_coupon->row_array();
        return $data;
    }

    public function infoorders_id($id){
        $query=$this->db->query('select * from orders where id = '.$id.' ');
        $data = $query->row_array();
        return $data;
    }

    public function addorders($data){
    	$result = $this->db->insert("orders",$data);
        if($result == 1){
           $return['status'] = 'true';
           $return['last_insert_id'] = $this->db->insert_id();
           return $return;
        }else{
            $return['status'] = 'false';
            return $return;
        }
    }

    public function addordersitem($data){
        $result = $this->db->insert("ordersitem",$data);
        if($result == 1){
           return 'true';
        }else{
           return 'false';
        }
    }

    public function getordersitem($id_order){
        $query=$this->db->query('SELECT ordersitem.orders_id as ordersitem_orderid, ordersitem.products_quantity as ordersitem_productsquantity, ordersitem.products_id as ordersitem_productsid , products.quantity as products_quantity , products.name as products_name from ordersitem INNER JOIN products ON ordersitem.products_id = products.id WHERE ordersitem.orders_id = '.$id_order.' ');
        return $query->result_array();
    }

    public function updateproduct_quantity($id,$quantity){
        $result =$this->db->query('UPDATE products SET quantity = quantity-'.$quantity.' , count_sell = count_sell+'.$quantity.' WHERE id = '.$id.' ');
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updateorders($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("orders",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deleteorders($id){
        $this->db->where("id",$id);
        $result = $this->db->delete("orders");
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }
}