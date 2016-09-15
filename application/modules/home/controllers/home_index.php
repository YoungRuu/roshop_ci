<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_index extends Frontend_Controller {
	public function __construct(){
        parent::__construct();
        $this->output->cache(20) ;
		$this->load->Model('Home_model');
    }

	public function index()
	{	
		$data = $this->getinfo_default_page('Trang Chủ','contents/content_index','home');
		$this->load->view('contents/main_layout',$data);
	}



	public function categories($categories_alias = '')
	{
		$categories_alias = strtolower($categories_alias);
		/*-----Info Pagination-----*/
		$link_full =  base_url().$categories_alias.'?page={page}';
		$link_first = base_url().$categories_alias;
		/*-----End Info Pagination-----*/
		/*Get info cate*/
		$get_name_cate= $this->Home_model->infocategories_alias($categories_alias);
		$data['type_data_products'] = $get_name_cate['name'];

		if(!$get_name_cate && $categories_alias != 'san-pham-moi' && $categories_alias != 'khuyen-mai'){
			redirect(base_url(),'location');
		}else{
			$data = $this->getinfo_default_page('Danh Mục Sản Phẩm','contents/content_categories','categories');
			if($get_name_cate['parent_id'] != '0' && $categories_alias != 'san-pham-moi' && $categories_alias != 'khuyen-mai'){
				$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,$categories_alias, "categories_child" );
				// Lấy tổng số sản phẩm theo danh mục và kèm start , limit phân trang
				$data['data_products'] = $this->Home_model->get_products_categories($get_name_cate['id'] ,$get_config_pagi['start'],$get_config_pagi['limit']);
				/*-----------------*/
				$data['type_data_products'] = $get_name_cate['name'];
				$data['type_data_products_alias'] = $get_name_cate['name_alias'];
			}else{

				if($categories_alias == 'thoi-trang-nam'){
					$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,'type_gender = "male" ', 'categories_parent');
					$data['data_products'] = $this->Home_model->get_products_type_gender('male',$get_config_pagi['start'],$get_config_pagi['limit']);
					/*-----------------*/
					$data['type_data_products'] = 'Thời Trang Nam';
					$data['type_data_products_alias'] = 'thoi-trang-nam';
				}else if($categories_alias == 'thoi-trang-nu'){
					$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,'type_gender = "female" ' , 'categories_parent');
					$data['data_products'] = $this->Home_model->get_products_type_gender('female',$get_config_pagi['start'],$get_config_pagi['limit']);
					$data['type_data_products'] = 'Thời Trang Nữ';
					$data['type_data_products_alias'] = 'thoi-trang-nu';
				}else if($categories_alias == 'san-pham-moi'){
					$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,'new = 1 ', 'categories_parent');
					$data['data_products'] = $this->Home_model->get_products_new('1' , $get_config_pagi['start'],$get_config_pagi['limit']);
					$data['type_data_products'] = 'Sản Phẩm Mới';
					$data['type_data_products_alias'] = 'san-pham-moi';
				}else if($categories_alias == 'khuyen-mai'){
					$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,'new = "100" ' , 'categories_parent');
					$data['data_products'] = array();
					$data['type_data_products'] = 'Khuyến Mãi';
					$data['type_data_products_alias'] = 'khuyen-mai';
				}
			}
			foreach ($data['data_products'] as $key => &$value) {
					$value['list_image'] = json_decode($value['list_image'],true); 
			}
		}
		if($categories_alias != 'san-pham-moi'){
			$data['info_cate_product']['breadcrumb'] = array(
				'0'  => array('name' => 'Trang chủ' , 'link' => '/'),
				'1'  => array('name' => $get_name_cate['name'] , 'link' => '/'.$get_name_cate['name_alias']),
			);
		}else{
			$data['info_cate_product']['breadcrumb'] = array(
				'0'  => array('name' => 'Trang chủ' , 'link' => '/'),
				'1'  => array('name' => 'Sản phẩm mới' , 'link' => '/san-pham-moi'),
			);
		}
		
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		$this->load->view('contents/main_layout',$data);
	}

	public function productdetail($categories , $product_name , $product_id = ''){
		if(!is_numeric($product_id)){
			redirect(base_url(),'location');
		}
		$data = $this->getinfo_default_page('Chi Tiết Sản Phẩm','contents/content_productdetail','productdetail');
		$data['data_acreages'] 				 = $this->Home_model->listacreage_parent();
		$data['info_item_product']           = $this->Home_model->infoproducts($product_id);
		if(!$data['info_item_product']){
			redirect(base_url(),'location');
		}else{
			$get_name_cate					 = $this->Home_model->infocategories_id($data['info_item_product']['categories_id']);
		}
		if($data['info_item_product'] && $get_name_cate['name_alias'] != $categories){
			redirect(base_url().$get_name_cate['name_alias'].'/'.$data['info_item_product']['name_alias'].'-'.$data['info_item_product']['id'] ,'localtion');
		}
		if($data['info_item_product'] && $get_name_cate['name_alias'] == $categories && $data['info_item_product']['name_alias'] != $product_name){
			redirect(base_url().$get_name_cate['name_alias'].'/'.$data['info_item_product']['name_alias'].'-'.$data['info_item_product']['id'] ,'localtion');
		}
		$data['info_item_product']['list_image'] = json_decode($data['info_item_product']['list_image'],true);
		$data['info_item_product']['color']      = json_decode($data['info_item_product']['color'],true);
		$data['info_item_product']['size']       = json_decode($data['info_item_product']['size'],true);
		$data['info_item_product']['breadcrumb'] = array(
			'0'  => array('name' => 'Trang chủ' , 'link' => '/'),
			'1'  => array('name' => $get_name_cate['name'] , 'link' => '/'.$get_name_cate['name_alias']),
			'2'  => array(
				'name' => $data['info_item_product']['name'] , 
				'link' => '/'.$get_name_cate['name_alias'].'/'.$data['info_item_product']['name_alias'].'-'.$data['info_item_product']['id'] ),
		);
		$data['list_products_lq'] = $this->Home_model->get_products_involve($categories,$product_id);
		foreach ($data['list_products_lq'] as $key => $value) {
			$data['list_products_lq'][$key]['list_image'] = json_decode($value['list_image'],true); 
		}
		$data['list_products_sale'] = $this->Home_model->get_products_sale_detail($data['info_item_product']['id']);
		foreach ($data['list_products_sale'] as $key => $value) {
			$data['list_products_sale'][$key]['list_image'] = json_decode($value['list_image'],true); 
		}
		// print_r($data['list_products_sale']);die;
		$this->load->view('contents/main_layout',$data);
	}

	public function info_cart_multi(){
		$data = $this->getinfo_default_page('Thông tin giỏ hàng','contents/content_checkout' ,'checkout');
		$data['data_acreages'] 			= $this->Home_model->listacreage_parent();
		if(empty($this->data_cart)){
			redirect(base_url().'gio-hang-trong');
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function add_orders_fast(){
		if($this->input->post()){
			$info_product     = $this->Home_model->infoproducts($this->input->post('product_id'));
			$quantity_product = $this->input->post('quantity') ? $this->input->post('quantity') : 1;
			$coupon_product   = $this->input->post('coupon') ? $this->input->post('coupon') : '';
			$note_product     = $this->input->post('note') ? $this->input->post('note') : '';
			if($info_product['price_sell_new'] == 0){
				$price_product = $info_product['price_sell_old'];
			}else{
				$price_product = $info_product['price_sell_new'];
			}
			$info_coupon = $this->Home_model->infocoupon($coupon_product);
			if($info_coupon){
				$id_coupon = $info_coupon['id'];
				if(time() <= strtotime($info_coupon['date_end'])){
					$cash_discount_coupon = ($quantity_product*$price_product)/100*$info_coupon['coupon_value'];
				}else{
					$result_all['status']  = 'false';
					$result_all['message'] = 'Phiếu mua hàng này đã được sử dụng hoặc không hợp lệ';
					echo json_encode($result_all);
					return;
				}
			}else{
				$cash_discount_coupon = 0;
				$id_coupon = 0;
			}
			if(!$info_product){
				$result_all['status']  = 'false';
				$result_all['message'] = 'Sản phẩm này không tồn tại';
				echo json_encode($result_all);
				return;
			}else {
				if($info_product['quantity'] == 0){
					$result_all['status']  = 'false';
					$result_all['message'] = 'Sản phẩm này hiện tại đã hết hàng';
					echo json_encode($result_all);
					return;
				}else if($info_product['quantity'] > 0 && $info_product['quantity'] < $quantity_product){
					$result_all['status']  = 'false';
					$result_all['message'] = 'Số lượng sản phẩm còn lại không đủ để đặt hàng';
					echo json_encode($result_all);
					return;
				}else{
					$data_insert_orders = array(
						'customer_id'       => $this->auth['id'] ? $this->auth['id'] : 0 ,
						'receiver_name'     => $this->input->post('receiver_name'),
						'receiver_phone'    => $this->input->post('receiver_phone'),
						'receiver_email'    => $this->input->post('receiver_email')?$this->input->post('receiver_email'):'',
						'receiver_address'  => $this->input->post('receiver_address'),
						'receiver_city'     => $this->input->post('receiver_city'),
						'receiver_district' => $this->input->post('receiver_district'),
					);
					$name_key = '';
					foreach ($data_insert_orders as $key => $value) {
						if($key == 'receiver_name'){
							$name_key = 'Tên người nhận';
						}else if($key == 'receiver_phone'){
							$name_key = 'Số điện thoại người nhận';
						}else if($key == 'receiver_address'){
							$name_key = 'Địa chỉ người nhận';
						}else if($key == 'receiver_district'){
							$name_key = 'Vị trí ở tỉnh thành';
						}
						if($value == '' && 
							$key != 'customer_id' && 
							$key != 'receiver_email'){
							$result_all['status'] = 'false';
							$result_all['message'] = $name_key. ' không được để trống';
							echo json_encode($result_all);
							return;
						}
					}
					$data_insert_orders['total_money_product'] =$quantity_product*$price_product;	
					$data_insert_orders['cash_discount'] =$cash_discount_coupon ? $cash_discount_coupon : 0;	
					$data_insert_orders['total_money'] =($quantity_product*$price_product)-$cash_discount_coupon;	
					$data_insert_orders['note']        = $note_product;	
					$data_insert_orders['coupon_id']   = $id_coupon;	
					$data_insert_orders['created']     = time();	
					$data_insert_orders['updated']     = time();
					$result_addorders = $this->Home_model->addorders($data_insert_orders);
					if($result_addorders['status'] == 'true'){
						$data_insert_ordersitem['orders_id']         = $result_addorders['last_insert_id'];
						$data_insert_ordersitem['products_id']       = $info_product['id'];
						$data_insert_ordersitem['products_price']    = $price_product;
						$data_insert_ordersitem['products_size']     = $this->input->post('size');
						$data_insert_ordersitem['products_color']    = $this->input->post('color');
						$data_insert_ordersitem['products_quantity'] = $quantity_product;
						$data_insert_ordersitem['created']           = time();
						$data_insert_ordersitem['updated'] 			 = time();
						$result_addordersitem = $this->Home_model->addordersitem($data_insert_ordersitem);
						if($result_addordersitem == 'true'){
							/*--Update lại count_sell--*/
							// $result_update_countsell = $this->Home_model->updatecountquantity($quantity_product, $info_product['id']);
							/*--Khi người dùng nhập phiếu mua hàng thì check phiếu đã sử dụng--*/
							if($info_coupon != ''){
								$result_update_coupon = $this->Home_model->updateactivecoupon($id_coupon);
								if($result_update_coupon == 'true'){
									$result_all['status'] = 'true';
									$result_all['message'] = 'Tạo đơn đặt hàng thành công';
									echo json_encode($result_all);
									return;
								}else{
									$result_all['status'] = 'false';
									$result_all['message'] = 'Xảy ra lỗi trong quá trình sử dụng phiếu mua hàng';
									echo json_encode($result_all);
									return;
								}
							}else{
								$result_all['status'] = 'true';
								$result_all['message'] = 'Tạo đơn đặt hàng thành công';
								echo json_encode($result_all);
								return;
							}
						}else{
							$result_all['status'] = 'false';
							$result_all['message'] = 'Xảy ra lỗi trong quá trình tạo item đơn đặt hàng';
							echo json_encode($result_all);
							return;
						}
					}else{
						$result_all['status'] = 'false';
						$result_all['message'] = 'Xảy ra lỗi trong quá trình tạo đơn đặt hàng';
						echo json_encode($result_all);
						return;
					}
					echo json_encode($result_all);
				}
			}
		}
	}

	

	public function add_orders_multi(){
		if($this->input->post()){
			$coupon_product   = $this->input->post('coupon') ? $this->input->post('coupon') : '';
			$note_product     = $this->input->post('receiver_note') ? $this->input->post('receiver_note') : '';
			foreach ($this->data_cart as $key => $value) {
				$info_product 	  = $this->Home_model->infoproducts($value['id']);
				if($info_product){
					if($info_product['price_sell_new'] == 0){
						$price_product = $info_product['price_sell_old'];
					}else{
						$price_product = $info_product['price_sell_new'];
					}
					if($info_product['quantity'] == 0){
						$result_all['status']  = 'false';
						$result_all['message'] = 'Sản phẩm này hiện tại đã hết hàng';
						echo json_encode($result_all);
						return;
					}else if($info_product['quantity'] > 0 && $info_product['quantity'] < $value['qty']){
						$result_all['status']  = 'false';
						$result_all['message'] = 'Số lượng sản phẩm "'.$value['name'].'" còn lại không đủ để đặt hàng';
						echo json_encode($result_all);
						return;
					}else if($price_product != $value['price']){
						$result_all['status']  = 'false';
						$result_all['message'] = 'Có vẻ như thông tin sản phẩm trong đơn đặt hàng của bạn không trùng khớp với hệ thống của chúng tôi . Vui lòng liên hệ tổng đài ROSHOP.VN để được hỗ trợ';
						echo json_encode($result_all);
						return;
					}else{
						
					}
				}else{
					$result_all['status']  = 'false';
					$result_all['message'] = 'Sản phẩm '.$value['name'].' không tồn tại trong hệ thống';
					echo json_encode($result_all);
					return;
				}
			}/*End foreach*/
			$data_insert_orders = array(
				'customer_id'       => $this->auth['id'] ? $this->auth['id'] : 0 ,
				'receiver_name'     => $this->input->post('receiver_name'),
				'receiver_phone'    => $this->input->post('receiver_phone'),
				'receiver_email'    => $this->input->post('receiver_email')?$this->input->post('receiver_email'):'',
				'receiver_address'  => $this->input->post('receiver_address'),
				'receiver_city'     => $this->input->post('receiver_city'),
				'receiver_district' => $this->input->post('receiver_district'),
			);
			$name_key = '';
			foreach ($data_insert_orders as $key => $value) {
				if($key == 'receiver_name'){
					$name_key = 'Tên người nhận';
				}else if($key == 'receiver_phone'){
					$name_key = 'Số điện thoại người nhận';
				}else if($key == 'receiver_address'){
					$name_key = 'Địa chỉ người nhận';
				}else if($key == 'receiver_district'){
					$name_key = 'Vị trí ở tỉnh thành';
				}
				if($value == '' && $key != 'customer_id' && $key != 'receiver_email' ){
					$result_all['status'] = 'false';
					$result_all['message'] = $name_key. ' không được để trống';
					echo json_encode($result_all);
					return;
				}
			}

			$info_coupon = $this->Home_model->infocoupon($coupon_product);
			if($info_coupon){
				$id_coupon = $info_coupon['id'];
				if(time() <= strtotime($info_coupon['date_end'])){
					$cash_discount_coupon = $this->cart->total()/100*$info_coupon['coupon_value'];
				}else{
					$result_all['status']  = 'false';
					$result_all['message'] = 'Phiếu mua hàng này đã được sử dụng hoặc không hợp lệ';
					echo json_encode($result_all);
					return;
				}
			}else{
				$cash_discount_coupon = 0;
				$id_coupon = 0;
			}
			$data_insert_orders['total_money_product'] = $this->cart->total();	
			$data_insert_orders['cash_discount']       = $cash_discount_coupon ? $cash_discount_coupon : 0;	
			$data_insert_orders['total_money']         = $this->cart->total()-$cash_discount_coupon;	
			$data_insert_orders['note']                = $note_product;	
			$data_insert_orders['coupon_id']           = $id_coupon;	
			$data_insert_orders['created']             = time();	
			$data_insert_orders['updated']             = time();	
			$result_addorders = $this->Home_model->addorders($data_insert_orders);
			if($result_addorders['status'] == 'true'){
				foreach ($this->data_cart as $key => $value) {
					$data_insert_ordersitem['orders_id']         = $result_addorders['last_insert_id'];
					$data_insert_ordersitem['products_id']       = $value['id'];
					$data_insert_ordersitem['products_price']    = $value['price'];
					$data_insert_ordersitem['products_size']     = $value['options']['op_size'];
					$data_insert_ordersitem['products_color']    = $value['options']['op_color'];
					$data_insert_ordersitem['products_quantity'] = $value['qty'];
					$data_insert_ordersitem['created']           = time();
					$data_insert_ordersitem['updated'] 			 = time();
					$result_addordersitem = $this->Home_model->addordersitem($data_insert_ordersitem);
				}
				/*--Khi người dùng nhập phiếu mua hàng thì check phiếu đã sử dụng--*/
				if($id_coupon != 0){ // Đồng nghĩa với việc đã tồn tại và vượt qa check
					$result_update_coupon = $this->Home_model->updateactivecoupon($id_coupon);
				}
				$this->cart->destroy();
				$result_all['status'] = 'true';
				$result_all['message'] = 'Tạo đơn đặt hàng thành công';
				echo json_encode($result_all);
				return;
			}else{
				$result_all['status'] = 'false';
				$result_all['message'] = 'Xảy ra lỗi trong quá trình tạo đơn đặt hàng';
				echo json_encode($result_all);
				return;
			}
		}
	}

	public function search(){
		$data = $this->getinfo_default_page('Tìm kiếm sản phẩm','contents/content_search' ,'search');
		$keysearch = $this->input->get('key') ? $this->input->get('key') : '' ;
		$gender    = $this->input->get('gender') ? $this->input->get('gender') : '' ;
		if($keysearch != '' || $gender != ''){
			$link_full =  base_url().'tim-kiem-san-pham'.'?page={page}&key='.$keysearch.'&gender='.$gender;
			$link_first = base_url().'tim-kiem-san-pham?key='.$keysearch.'&gender='.$gender;
		}else{
			$link_full =  base_url().'tim-kiem-san-pham'.'?page={page}';
			$link_first = base_url().'tim-kiem-san-pham';
		}
		$get_config_pagi = $this->get_config_pagi('Home_model' , $link_full, $link_first ,$keysearch, 'type_search' , $gender);
		$data['data_products'] = $this->Home_model->get_products_search($keysearch,$gender,$get_config_pagi['start'] , $get_config_pagi['limit']);
		foreach ($data['data_products'] as $key => $value) {
			$data['data_products'][$key]['list_image'] = json_decode($value['list_image'],true); 
		}
		
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		$this->load->view('contents/main_layout',$data);
	}
	
	public function checkout_complete(){
		$data = $this->getinfo_default_page('Đơn hàng đã được gửi','contents/content_checkoutcomplete' ,'checkout_complete');
		$this->load->view('contents/main_layout',$data);
	}

	public function cart_clear(){
		$data = $this->getinfo_default_page('Giỏ hàng trống','contents/content_cartclear' ,'cart_clear');
		$this->cart->destroy();
		$this->load->view('contents/main_layout',$data);
	}

	public function get_city_district(){
		$parent_id = $this->input->post('parent_id') ? $this->input->post('parent_id') : '' ;
		$acreage_children = $this->Home_model->listacreage_children($parent_id);
		echo json_encode($acreage_children);
	}

	public function ajaxAdditemorders(){
		$get_item_cart = $this->input->post('add_cart');
		$get_item_cart = json_decode($get_item_cart,true);
		$get_item_cart['options'] = json_decode($get_item_cart['options'],true);
		if($this->cart->insert($get_item_cart)){
			$result['status']      = 'true';
			$result['message']     = 'Đã thêm sản phẩm vào giỏ hàng';
			$result['data']        = $this->cart->contents();
			$result['total_money'] = $this->cart->total();
			$result['total_items'] = count($this->cart->contents());
        }else{
			$result['status']  = 'false';
			$result['message'] = 'Xảy ra lỗi trong quá trình thêm sản phẩm vào giỏ hàng';
        }
		echo json_encode($result);
	}

	public function ajaxRemoveitemorders(){
		$row_id = $this->input->post('rowid');
		if($row_id != ''){
			if($this->cart->remove($row_id)){
				$result['status']      = 'true';
				$result['message']     = 'Đã xóa sản phẩm khỏi giỏ hàng';
				$result['data']        = $this->cart->contents();
				$result['total_money'] = $this->cart->total();
				$result['total_items'] = count($this->cart->contents());
			}else{
				$result['status']  = 'false';
				$result['message'] = 'Sản phẩm này hiện không tồn tại trong giỏ hàng';
			}
		}else{
			$result['status']  = 'false';
			$result['message'] = 'Không xác định được sản phẩm cần xóa khỏi giỏ hàng';
		}
		echo json_encode($result);
	}

	public function ajaxUpdateitemorders(){
		$row_id = $this->input->post('rowid');
		$qty    = $this->input->post('qty');
		if($row_id != ''){
			$data_update = array(
				'rowid' => $row_id,
				'qty'	=> $qty,
			);
			if($this->cart->update($data_update)){
				$result['status']      = 'true';
				$result['message']     = 'Cập nhật số lượng sản phẩm thành công';
				$result['data']        = $this->cart->contents();
				$result['total_money'] = $this->cart->total();
				$result['total_items'] = count($this->cart->contents());
			}else{
				$result['status']  = 'false';
				$result['message'] = 'Xảy ra lỗi trong qua trình cập nhật số lượng sản phẩm';
			}
		}else{
			$result['status']  = 'false';
			$result['message'] = 'Không xác định được sản phẩm cần cập nhật ';
		}
		echo json_encode($result);
	}

	public function customer_login(){
		if($this->auth){
			redirect(base_url().'khach-hang/tai-khoan','location');
			return;
		}
		$data = $this->getinfo_default_page('Đăng nhập','contents/content_customerlogin');
		$this->load->view('contents/main_layout',$data);
	}

	public function customer_account(){
		if(!$this->auth){
			redirect(base_url().'khach-hang/dang-nhap');
			return;
		}
		$data = $this->getinfo_default_page('Thông tin tài khoản','contents/main_layout_customer' ,'account');
		$data['info_default']['contents_subview_customer'] = 'contents/content_customeraccount';
		$data['info_user'] = $this->Home_model->checkuser_id($this->auth['id']);
      	$data['menu_static'] = $this->get_menu_page_customer();
		$this->load->view('contents/main_layout',$data);
	}

	public function customer_update_info(){
		if(!$this->auth){
			redirect(base_url().'khach-hang/dang-nhap' ,'location');
			return;
        }
		if($this->input->post()){
			$data_update = $this->input->post();
			$data_update['birthday'] = strtotime($data_update['birthday']);
			$result_update = $this->Home_model->updateuser($this->auth['id'],$data_update);
			if($result_update == 'true'){
				$result_mess = $this->message_action('Cập nhật thông tin tài khoản thành công' , 1 );
				redirect(base_url().'khach-hang/tai-khoan' ,'location');
				return;
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong qua trình cập nhật' , 0 );
				redirect(base_url().'khach-hang/tai-khoan' ,'location');
				return;
			}
		}
	}

	public function customer_update_pass(){
		if(!$this->auth){
			redirect(base_url().'khach-hang/dang-nhap' ,'location');
			return;
        }
		$this->load->library('bcrypt_password'); // Thư viện Hash Password.
		if($this->input->post()){
			$data_update = $this->input->post();
			if ($this->bcrypt_password->check_password($data_update['password_old'] ,$this->auth['password'])){
				if($data_update['password'] != $data_update['confirm']){
					$result_mess = $this->message_action('Mật khẩu mới và xác nhận mật khẩu không trùng khớp' , 0 );
					redirect($_SERVER['HTTP_REFERER'] ,'location');
					return;
				}else{
					unset($data_update['confirm'],$data_update['password_old']);
					$data_update['password'] = $this->bcrypt_password->hash_password($data_update['password']);
				    $result_update = $this->Home_model->updateuser($this->auth['id'],$data_update);
					if($result_update == 'true'){
						$result_mess = $this->message_action('Cập nhật thông tin tài khoản thành công' , 1 );
						redirect($_SERVER['HTTP_REFERER'] ,'location');
						return;
					}else{
						$result_mess = $this->message_action('Xảy ra lỗi trong qua trình cập nhật' , 0 );
						redirect($_SERVER['HTTP_REFERER'] ,'location');
						return;
					}
				}
			}else{
			    $result_mess = $this->message_action('Mật khẩu cũ không đúng' , 0 );
				redirect($_SERVER['HTTP_REFERER'] ,'location');
				return;
			}
		}
	}

	public function customer_order(){
		if(!$this->auth){
			redirect(base_url().'khach-hang/dang-nhap' ,'location');
			return;
        }
		$data = $this->getinfo_default_page('Quản lý đơn đặt hàng','contents/main_layout_customer','orders');
		$data['menu_static'] = $this->get_menu_page_customer();
		$data['info_default']['contents_subview_customer'] = 'contents/content_customerorder';
		$data['info_orders_customer'] = $this->Home_model->infoorders_customer($this->auth['id']);
		foreach ($data['info_orders_customer']['list_item_orders'] as $key => &$value) {
			$list_image = json_decode($value['list_image'],true);
			foreach ($list_image as $key1 => &$value1) {
				if($key1 > 0){
					unset($list_image[$key1]);
				}else{
					$value1 = '/uploads/thumb/thumb75x60_'.$value1;
				}
			}
			$value['list_image'] = $list_image;
		}
		
		// print_r($data['info_orders_customer']);die;
		$this->load->view('contents/main_layout',$data);
	}

	public function customer_staticpage($get_path =''){
		$data = $this->getinfo_default_page('Quản lý đơn đặt hàng','contents/main_layout_customer','gioithieu');
		$data['menu_static'] = $this->get_menu_page_customer();
		switch ($get_path) {
		    case 'gioi-thieu-roshop':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_gioithieu';
		        $data['info_default']['title']   = 'Giới thiệu';
		       break;
		    case 'tai-sao-chon-chung-toi':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_taisaochonchungtoi';
		        $data['info_default']['title']   = 'Tại sao chọn chúng tôi';
		        break;
		    case 'huong-dan-dat-hang':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_huongdandathang';
		        $data['info_default']['title']   = 'Hướng dẫn đặt hàng';
		        break;
		    case 'chinh-sach-giao-nhan':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_chinhsachgiaonhan';
		        $data['info_default']['title']   = 'Chính sách giao nhận';
		        break;
		    case 'chinh-sach-bao-mat':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_chinhsachbaomat';
		        $data['info_default']['title']   = 'Chính sách bảo mật';
		        break;
		    case 'chinh-sach-doi-tra':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_chinhsachdoitra';
		        $data['info_default']['title']   = 'Chính sách đổi trả';
		        break;
		    case 'phi-van-chuyen':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_phivanchuyen';
		        $data['info_default']['title']   = 'Phí vận chuyển';
		        break;
		    case 'quyen-rieng-tu':
		        $data['info_default']['contents_subview_customer'] = 'staticpage/static_quyenriengtu';
		        $data['info_default']['title']   = 'Quyền riêng tư';
		        break;
		    default:
		    	$data['info_default']['contents_subview_customer'] = 'staticpage/static_lienhe';
		    	$data['info_default']['title']   = 'Liên hệ';
		        break;
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function customer_register(){
		$this->load->library('bcrypt_password');
		$data = $this->getinfo_default_page('Đăng ký','contents/main_layout_customer');
		$data['info_default']['contents_subview_customer'] = 'contents/content_customerregister';
		$data['menu_static'] = $this->get_menu_page_customer();
		if($this->auth){
			redirect(base_url().'khach-hang/tai-khoan' ,'location');
			return;
		}
		if($this->input->post()){
			$data_add = $this->input->post();
			foreach ($data_add as $key => $value) {
				if($value == ''){
					$result_mess = $this->message_action('Yêu cầu nhập đầy đủ các trường' , 0 );
					$this->session->set_flashdata('data_form_regis' ,$data_add); 
					redirect($_SERVER['HTTP_REFERER'] ,'location');
					return;
				}
			}
			$check_username = $this->Home_model->checkusername($data_add['username']);
			if($check_username){
				$result_mess = $this->message_action('Tài khoản này đã được sử dụng' , 0 );
				$this->session->set_flashdata('data_form_regis' ,$data_add); 
				redirect($_SERVER['HTTP_REFERER'] ,'location');
				return;
			}
			if($data_add['password'] != $data_add['confirm']){
				$result_mess = $this->message_action('Mật khẩu và nhập lại mật khẩu không trùng khớp' , 0 );
				$this->session->set_flashdata('data_form_regis' ,$data_add); 
				redirect($_SERVER['HTTP_REFERER'] ,'location');
				return;
			}
			unset($data_add['confirm']);
			$data_add['birthday'] = strtotime($data_add['birthday']);
			$pass_real = $data_add['password'];
			$data_add['password'] = $this->bcrypt_password->hash_password($data_add['password']);
			$data_add['created'] = time();
			$data_add['updated'] = time();
			$result_add = $this->Home_model->adduser($data_add);
			if($result_add == 'true'){
				$this->login($data_add['username'],$pass_real);
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong qua trình đăng ký' , 0 );
				redirect($_SERVER['HTTP_REFERER'] ,'location');
				return;
			}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function getinfo_default_page($title = '' , $content_page = '' , $is_page = ''){
		$data['info_default']['contents_subview'] = $content_page;
		$data['info_default']['title']            = $title;
		$data['info_default']['is_page']          = $is_page;
		$data['info_default']['js_subview']       = 'footer_js/js_home_layout';
		$data['info_default']['css_subview']      = 'header_css/css_home_layout';
		$data['info_default']['get_menu']	 	  = $this->Home_model->listcate('WHERE status = 1');
		if($is_page == 'home'){
			$data['data_products_hot']    = $this->Home_model->get_products_hot_index();
			$data['data_products_male']   = $this->Home_model->get_products_male_index();
			$data['data_products_female'] = $this->Home_model->get_products_female_index();
			foreach ($data['data_products_hot'] as $key => $value) {
				$data['data_products_hot'][$key]['list_image'] = json_decode($value['list_image'],true); 
			}
			foreach ($data['data_products_male'] as $key => $value) {
				$data['data_products_male'][$key]['list_image'] = json_decode($value['list_image'],true); 
			}
			foreach ($data['data_products_female'] as $key => $value) {
				$data['data_products_female'][$key]['list_image'] = json_decode($value['list_image'],true); 
			}
		}
		foreach ($data['info_default']['get_menu'] as $key => &$value) {
			if($value['parent_id'] == 0 && $value['name_alias'] == 'thoi-trang-nam'){
				$data['info_default']['get_menu'][$key]['products_bestsell'] = $this->Home_model->get_products_bestselling('male');
			}else if($value['parent_id'] == 0 && $value['name_alias'] == 'thoi-trang-nu'){
				$data['info_default']['get_menu'][$key]['products_bestsell'] = $this->Home_model->get_products_bestselling('female');
			}
		}
		foreach ($data['info_default']['get_menu'] as $key => &$value) {
			if(!empty($value['products_bestsell'])){
				foreach ($value['products_bestsell'] as $key1 => &$value1) {
					$value1['list_image'] = json_decode($value1['list_image'],true);
				}
			}
		}
		return $data;
	}

	public function login($username = '' , $password = ''){
		$this->load->library('bcrypt_password');
		/*--Info default page--*/
		$data['info_default']['title'] = 'Đăng Nhập';
		/*--Info default page--*/
		if($this->input->post()){
			$info_login = $this->input->post();
			$info_user = $this->Home_model->checkusername($info_login['username']);
			if($info_user){
				if ($this->bcrypt_password->check_password($info_login['password'], $info_user['password'])){
				    $this->session->set_userdata('customer_login',$info_user);
					redirect(base_url().'khach-hang/tai-khoan' ,'location');
					return;
				}else{
				    $result_mess = $this->message_action('Tài khoản hoặc mật khẩu không đúng' , 0 );
					redirect(base_url().'khach-hang/dang-nhap' ,'location');
					return;
				}
			}else{
				$result_mess = $this->message_action('Tài khoản này không tồn tại' , 0 );
				redirect(base_url().'khach-hang/dang-nhap' ,'location');
				return;
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('customer_login');
		redirect($_SERVER['HTTP_REFERER'] ,'location');
		return;
	}

}
