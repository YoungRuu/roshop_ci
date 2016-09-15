<?php
class Home_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    /*--------Products---------*/
    public function listproducts(){
        $query=$this->db->get("products");
        $data = $query->result_array();
        return $data;
    }

    public function get_products_hot_index(){
        $query= $this->db->query("SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image ,products.type_gender, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.hot = 1 and products.status = 1 ORDER BY products.id DESC LIMIT 8 ");
         // $query= $this->db->query("SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.hot = 1 and products.status = 1 ORDER BY products.id DESC LIMIT 8 ");
        $data = $query->result_array();
        return $data;
    }
    public function get_products_sale_detail($not_id){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image ,products.type_gender, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 and products.id != '.$not_id.'  ORDER BY products.price_sale , products.created DESC LIMIT 3 ');
         // $query= $this->db->query("SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.hot = 1 and products.status = 1 ORDER BY products.id DESC LIMIT 8 ");
        $data = $query->result_array();
        return $data;
    }

    public function get_products_male_index(){
        $query= $this->db->query("SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image ,products.type_gender, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.type_gender = 'male' and products.status = 1 and products.hot = 0 ORDER BY products.id DESC LIMIT 8 ");
        $data = $query->result_array();
        return $data;
    }

     public function get_products_female_index(){
        $query= $this->db->query("SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image ,products.type_gender, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.type_gender = 'female' and products.status = 1 and products.hot = 0 ORDER BY products.id DESC LIMIT 8 ");
        $data = $query->result_array();
        return $data;
    }

    public function get_products_involve($categories , $product_id){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image ,products.type_gender , categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE categories.name_alias = "'.$categories.'" and products.id != '.$product_id.'  and products.status = 1 ORDER BY products.id DESC LIMIT 5 ');
        $data = $query->result_array();
        return $data;
    }

    public function get_products_bestselling($type_gender = ''){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.type_gender = "'.$type_gender.'" and products.status = 1 ORDER BY products.count_sell DESC LIMIT 5');
        $data = $query->result_array();
        return $data;
    }

    public function get_products_categories($categories_id = '' , $start  = '' , $limit = ''){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE categories.id = '.$categories_id.' and products.status = 1  ORDER BY products.id DESC LIMIT '.$start.' , '.$limit.' ');
        $data = $query->result_array();
        return $data;
    }

     public function get_products_type_gender($type_gender = ''  , $start  = '' , $limit = ''){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.type_gender = "'.$type_gender.'" and products.status = 1  ORDER BY products.id DESC LIMIT '.$start.' , '.$limit.' ');
        $data = $query->result_array();
        return $data;
    }

    public function get_products_new($is_new = ''  , $start  = '' , $limit = ''){
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.new = "'.$is_new.'" and products.status = 1  ORDER BY products.id DESC LIMIT '.$start.' , '.$limit.' ');
        $data = $query->result_array();
        return $data;
    }
     
    public function countAll_products_pagi($categories_alias = ''){
        $query = $this->db->query('SELECT id FROM products where categories_id = (SELECT id FROM categories where name_alias = "'.$categories_alias.'" ) ');
        $data = $query->num_rows();
        return $data;
    }

    public function countAll_products_pagi_more($condition = ''){
        $query = $this->db->query('SELECT id FROM products where '.$condition.' ');
        $data = $query->num_rows();
        return $data;
    }

    public function countAll_products_pagi_search($name = '' , $type_gender = ''){
        $condition = '';
        if($name != ''){
            $condition = 'and name LIKE "%'.$name.'%" ';
        }
        if($type_gender != ''){
            $condition .= 'and type_gender = "'.$type_gender.'" ';
        }
        $query = $this->db->query('SELECT id FROM products where status = 1 '.$condition.' ORDER BY id DESC ');
        $data = $query->num_rows();
        return $data;
    }

    public function get_products_search($name = '' ,$type_gender = '' , $start  = '' , $limit = ''){
        $condition = '';
        if($name != ''){
            $condition = 'and products.name LIKE "%'.$name.'%" ';
        }
        if($type_gender != ''){
            $condition .= 'and products.type_gender = "'.$type_gender.'" ';
        }
        $query= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell, categories.name as categories_name , categories.name_alias as categories_namealias , categories.parent_id as categories_parent_id FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 '.$condition.' ORDER BY products.id DESC LIMIT '.$start.' , '.$limit.' ');
        $data = $query->result_array();
        return $data;
    }
 
    public function infoproducts($id){
        $query =$this->db->query('select * from products where id="'.$id.'" ');
        return $query->row_array();
    }

    public function updatecountquantity($quantity_sell = '' , $product_id){
        $query =$this->db->query('UPDATE products SET quantity = quantity - '.$quantity_sell.' , count_sell = count_sell + '.$quantity_sell.' WHERE id = '.$product_id.' ');
        if($query == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function checknameproducts($name){
        $query =$this->db->query('select * from products where name="'.$name.'" ');
        return $query->row_array();
    }
    public function checknameproducts_update($id,$name){
        $query =$this->db->query('select * from products where name="'.$name.'" and id != "'.$id.'" ');
        return $query->row_array();
    }

    /*--Categories--*/
    public function listcate($condition = ''){
        $query =$this->db->query('select * from categories '.$condition.' ');
        $data = $query->result_array();
        return $data;
    }

    public function infocategories_alias($categories_alias = ''){
        $query =$this->db->query('select * from categories where name_alias = "'.$categories_alias.'" and status = 1  ');
        return $query->row_array();
    }
    public function infocategories_id($categories_id = ''){
        $query =$this->db->query('select * from categories where id = '.$categories_id.' and status = 1  ');
        return $query->row_array();
    }
    public function infocategories_name($categories_name = ''){
        $query =$this->db->query('select * from categories where name = '.$categories_name.' and status = 1  ');
        return $query->row_array();
    }

    /*--Acreage--*/
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

    /*--Add orders--*/
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

    public function infoorders($id){
        $query =$this->db->query('select * from orders where id="'.$id.'" ');
        return $query->row_array();
    }

     public function infoorders_customer($customer_id){
        $query_list_item= $this->db->query('SELECT products.id as products_id , products.name as products_name ,products.name_alias as products_namealias , products.price_standard , products.price_sell_old , products.price_sell_new , products.price_sale , products.list_image , products.type_gender ,products.count_sell,  ordersitem.orders_id as ordersitem_ordersid ,ordersitem.products_price as ordersitem_price , ordersitem.products_size as ordersitem_size , ordersitem.products_color as ordersitem_color , ordersitem.products_quantity as ordersitem_products_quantity , ordersitem.created as ordersitem_created FROM ordersitem INNER JOIN orders ON ordersitem.orders_id = orders.id  INNER JOIN products ON ordersitem.products_id = products.id WHERE orders.customer_id = '.$customer_id.' ');
        $data['list_item_orders'] = $query_list_item->result_array();

        // Cái này nên chuyển sang dùng MyISAM với những bảng static data như : creages sẽ nhanh hơn 
        // Note.
        $query_orders = $this->db->query('SELECT orders.id as orders_id ,orders.customer_id as orders_customerid ,orders.user_id as orders_userid , orders.receiver_name as orders_receivername , orders.code as orders_code , orders.receiver_phone as orders_receiverphone , orders.receiver_email as orders_receiveremail , orders.receiver_address as orders_receiveraddress , orders.receiver_city as orders_receivercity , orders.receiver_district as orders_receiverdistrict , orders.total_money_product as orders_total_money_product , orders.cash_discount as orders_cashdiscount , orders.total_money as orders_total_money , orders.note as orders_note , orders.status as orders_status , orders.created as orders_created , a.name as acreages_cityname , b.name as acreages_districtname FROM orders INNER JOIN acreages as a ON orders.receiver_city = a.id INNER JOIN acreages as b ON orders.receiver_district = b.id  WHERE orders.customer_id = '.$customer_id.' ');
        $data['data_orders'] = $query_orders->result_array();
        return $data;
    }

    public function checkorderscode($code){
        $query =$this->db->query('select * from orders where code="'.$code.'" ');
        return $query->row_array();
    }

    /*--Coupon--*/
    public function infocoupon($coupon_code){
        $query =$this->db->query('select * from coupon where coupon_code="'.$coupon_code.'" and status = 0 limit 1');
        return $query->row_array();
    }
    public function updateactivecoupon($coupon_id){
        $query =$this->db->query('UPDATE coupon SET status = 1 WHERE id = '.$coupon_id.' limit 1');
        if($query == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    /*--User--*/
    public function checkuser_id($id){
        $query =$this->db->query('SELECT * FROM users WHERE id='.$id.' ');
        return $query->row_array();
    }

    public function updateuser($id,$data){
        $this->db->where("id",$id);
        $result = $this->db->update("users",$data);
        if($result == 1){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function adduser($data){
        $result = $this->db->insert("users",$data);
        if($result == 1){
           return 'true';
        }else{
           return 'false';
        }
    }

    public function checkusername($username){
        $query =$this->db->query('SELECT * FROM users WHERE username="'.$username.'" ');
        return $query->row_array();
    }

}