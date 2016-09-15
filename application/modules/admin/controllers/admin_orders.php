<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_orders extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->Model('Orders_model');
        $this->load->Model('Products_model');
        $this->load->Model('Users_model');
        $this->load->Model('Coupon_model');
        if(!$this->session->has_userdata('user_login')){
			redirect(base_url().'admin/Admin_login' ,'location');
			return;
        }else{
        	if($this->auth['role'] < 2){
        		redirect(base_url() ,'location');
				return;
        	}
        }
    }

	public function index()
	{
		/*-----Info Pagination-----*/
		$string_search = $this->input->get('namesearch') ? $this->input->get('namesearch') : '';
		$string_search = trim($string_search);
		
		if($string_search != '' && is_numeric($string_search)){
			$condition     = 'WHERE receiver_phone = '.$string_search.' ';
			$string_search = 'namesearch='.$string_search.' ';
		}else if($string_search != '' && !is_numeric($string_search)){
			$condition     = 'WHERE receiver_name LIKE "%'.$string_search.'%" ';
			$string_search = 'namesearch='.$string_search.' ';
		}else{
			$condition     = '';
			$string_search = '';
		}
		$get_config_pagi = $this->get_config_pagi('Orders_model',$condition,$string_search);
		$data['data_orders'] = $this->Orders_model->listorders($condition.' ORDER BY ID DESC LIMIT '.$get_config_pagi['start'].' , '.$get_config_pagi['limit'].' ');
		// print_r($get_config_pagi);die;
		/*--Info Default Page--*/
		$data['info_default']['contents_subview'] = 'contents/index_orders_layout';
		$data['info_default']['title'] = 'Trang Chủ Đơn Đặt Hàng';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_orders_layout';
		$data['info_default']['css_subview'] = 'header_css/css_orders_layout';
		/*-End info default page---*/
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		/*---Pagination---*/
		$this->load->view('contents/main_layout',$data);
	}

	public function add()
	{
		$this->load->Model('Acreages_model');
		$data['info_default']['contents_subview'] = 'contents/add_orders_layout';
		$data['info_default']['title'] = 'Thêm Đơn Đặt Hàng';
		$data['info_default']['is_page'] = 'add';
		$data['info_default']['js_subview'] = 'footer_js/js_orders_layout';
		$data['info_default']['css_subview'] = 'header_css/css_orders_layout';
		/*-End info default page---*/
		$data['data_users'] = $this->Users_model->listusers('Where role = 0 ');
		$data['data_acreages'] = $this->Acreages_model->listacreage_parent();
		$this->load->view('contents/main_layout',$data);

	}

	public function add_orders(){
		if($this->input->post()){
			$get_info_orders     = $this->input->post(NULL,TRUE);
			$list_product        = json_decode($get_info_orders['list_product'],true);
			$coupon              = $get_info_orders['coupon'] ? $get_info_orders['coupon'] : '';
			$note_product        = $get_info_orders['note'] ? $get_info_orders['note'] : '';
			$count_money         = 0;
			$count_money_product = 0;
			foreach ($list_product as $key => $value) {
				$check_product = $this->Products_model->infoproducts($value['id']);
				if(!$check_product){
					$result_all['status']  = 'false';
					$result_all['message'] = 'Đơn hàng chứa sản phẩm không tồn tại trong hệ thống';
					echo json_encode($result_all);
					return;
				}else {
					if($check_product['price_sell_new'] == 0){
						$price_product = $check_product['price_sell_old'];
					}else{
						$price_product = $check_product['price_sell_new'];
					}
					if($check_product['quantity'] == 0){
						$result_all['status']  = 'false';
						$result_all['message'] = 'Sản phẩm này hiện tại đã hết hàng';
						echo json_encode($result_all);
						return;
					}else if($check_product['quantity'] > 0&& $check_product['quantity'] < $value['quantity']){
						$result_all['status']  = 'false';
						$result_all['message'] = 'Số lượng sản phẩm còn lại không đủ để đặt hàng';
						echo json_encode($result_all);
						return;
					}else{
						$count_money_product = $value['quantity']*$price_product;
						$count_money += $count_money_product;
					}
				}
			}
			$data_insert_orders = array(
				'customer_id'       => $get_info_orders['customer_id'],
				'user_id'           => $this->auth['id'] ,
				'receiver_name'     => $get_info_orders['receiver_name'],
				'receiver_phone'    => $get_info_orders['receiver_phone'],
				'receiver_email'    => $get_info_orders['receiver_email'],
				'receiver_address'  => $get_info_orders['receiver_address'],
				'receiver_city'     => $get_info_orders['receiver_city'],
				'receiver_district' => $get_info_orders['receiver_district'],
			);
			foreach ($data_insert_orders as $key => $value) {
				if($value == '' && $key != 'receiver_email'){
					$result_all['status']  = 'false';
					$result_all['message'] = $key. ' không được để trống';
					echo json_encode($result_all);
					return;
				}
			}
			$check_coupon = $this->Coupon_model->infocoupon($coupon);
			if($check_coupon){
				$id_coupon = $check_coupon['id'];
				if(time() <= strtotime($check_coupon['date_end'])){
					$cash_discount_coupon = $count_money/100*$check_coupon['coupon_value'];
				}else{
					$result_all['status']  = 'false';
					$result_all['message'] = 'Phiếu mua hàng này đã được sử dụng hoặc không hợp lệ';
					echo json_encode($result_all);
					return;
				}
			}else{
				$cash_discount_coupon = 0;
				$id_coupon            = 0;
			}
			$data_insert_orders['total_money_product'] = $count_money;	
			$data_insert_orders['cash_discount']       = $cash_discount_coupon ? $cash_discount_coupon : 0;	
			$data_insert_orders['total_money']         = $count_money-$cash_discount_coupon;	
			$data_insert_orders['note']                = $note_product;	
			$data_insert_orders['coupon_id']           = $id_coupon;	
			$data_insert_orders['created']             = time();	
			$data_insert_orders['updated']             = time();
			$result_addorders = $this->Orders_model->addorders($data_insert_orders);
			if($result_addorders['status'] == 'true'){
				foreach ($list_product as $key => $value) {
					$data_insert_ordersitem['orders_id']         = $result_addorders['last_insert_id'];
					$data_insert_ordersitem['products_id']       = $value['id'];
					$data_insert_ordersitem['products_price']    = $value['price'];
					$data_insert_ordersitem['products_size']     = $value['size'];
					$data_insert_ordersitem['products_color']    = $value['color'];
					$data_insert_ordersitem['products_quantity'] = $value['quantity'];
					$data_insert_ordersitem['created']           = time();
					$data_insert_ordersitem['updated']           = time();
					$result_addordersitem = $this->Orders_model->addordersitem($data_insert_ordersitem);
				}
				if($result_addordersitem == 'true'){
					$result_all['status']  = 'true';
					$result_all['message'] = 'Tạo đơn đặt hàng thành công';
					$result_mess = $this->message_action('Tạo đơn đặt hàng thành công' , 1 );
				}else{
					$result_all['status']  = 'false';
					$result_all['message'] = 'Xảy ra lỗi trong quá trình tạo item đơn đặt hàng';
				}
			}else{
				$result_all['status']  = 'false';
				$result_all['message'] = 'Xảy ra lỗi trong quá trình tạo đơn đặt hàng';
			}
			echo json_encode($result_all);
		}
	}

	public function searchproducts(){
		$keysearch = $this->input->post('keysearch') ? $this->input->post('keysearch') : '';
		$keysearch = strtolower($keysearch);
		if(substr($keysearch,0,2) == 'sp'){
			$data_search = $this->Products_model->listproductssearch_code($keysearch);
		}else if(strlen($keysearch) > 0){
			$data_search = $this->Products_model->listproductssearch_name($keysearch);
		}else if(strlen($keysearch) == 0){
			$data_search = '';
		}
		echo json_encode($data_search);
		return;
	}

	public function update()
	{
		$data['info_default']['contents_subview'] = 'contents/update_orders_layout';
		$data['info_default']['title'] = 'Cập Nhật Đơn Đặt Hàng';
		$data['info_default']['is_page'] = 'update';
		$data['info_default']['js_subview'] = 'footer_js/js_orders_layout';
		$data['info_default']['css_subview'] = 'header_css/css_orders_layout';
		$this->load->view('contents/main_layout',$data);
	}

	public function infoorders(){
		$get_id = $this->input->post('id');
		$get_info = $this->Orders_model->infoorders($get_id);
		if(!$get_info){
			$result_all['status']  = 'false';
			$result_all['message'] = 'Đơn đặt hàng này không tồn tại trong hệ thống';
			echo json_encode($data_search);
			return;
		}else{
			foreach ($get_info['list_item_orders'] as $key => &$value) {
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
			$get_info['data_orders']['orders_created'] = date('d-m-Y',$get_info['data_orders']['orders_created']);

			echo json_encode($get_info);
		}
	}

	public function activeorders(){
		$get_id_active     = $this->input->post('id');
		$get_status_active = $this->input->post('status');
		$get_info_orders          = $this->Orders_model->infoorders_id($get_id_active);
		if($this->input->post()){
			if($get_status_active == 0){
				redirect(base_url().'admin/admin_orders','location');
				return;
			}
			if(!$get_info_orders){
				$result_all['status']  = 'false';
				$result_mess = $this->message_action('Đơn đặt hàng này không tồn tại trong hệ thống' , 0 );
				echo json_encode($result_all);
				return;
			}else{
				if($get_info_orders['status'] == 1 && $get_status_active == 1){
					$result_mess = $this->message_action('Hóa đơn này hiện tại đang được giao hàng' , 0 );
					$result['status'] = 'true';
					echo json_encode($result);
					return;
				}
				if($get_info_orders['status'] == 2 && $get_status_active == 2){
					$result_mess = $this->message_action('Hóa đơn này hiện tại đã giao hàng hoàn tất' , 0 );
					$result['status'] = 'true';
					echo json_encode($result);
					return;
				}
				$get_order_item = $this->Orders_model->getordersitem($get_info_orders['id']);
				if($get_status_active != 0){
					$count_abc = 0;
					$name_qty = '' ;
					foreach ($get_order_item as $key => $value) {
						if($value['products_quantity'] < $value['ordersitem_productsquantity']){
							$result['status'] = 'true';
							$count_abc++;
							$name_qty .= '</br>- '.$value['products_name'] .' - Số lượng còn : '.$value['products_quantity'];
						}
					}
					if($count_abc > 0){
						$result_mess =$this->message_action('Sản phẩm : '.$name_qty.'</br>'. 'Không đủ để giao hàng ! Vui lòng nhập thêm' , 0 );
						echo json_encode($result);
						return;
					}
					if($get_info_orders['status'] == 0 && $get_status_active == 1){
						$data_update_status_order = array('status' => $get_status_active);
						$result_update_status_order = $this->Orders_model->updateorders($get_id_active , $data_update_status_order);
						$result_mess = $this->message_action('Cập nhật trạng thái đơn đặt hàng thành công' , 1 );
						$result['status'] = 'true';
						echo json_encode($result);
						return;
					}
					if(($get_info_orders['status'] == 0 || $get_info_orders['status'] == 1) && $get_status_active == 2){
						$data_update_status_order = array('status' => $get_status_active);
						$result_update_status_order = $this->Orders_model->updateorders($get_id_active , $data_update_status_order);
						foreach ($get_order_item as $key => $value) {
							$result_update_qty = $this->Orders_model->updateproduct_quantity($value['ordersitem_productsid'],$value['ordersitem_productsquantity']);
						}
						$result_mess = $this->message_action('Cập nhật trạng thái đơn đặt hàng thành công' , 1 );
						$result['status'] = 'true';
						echo json_encode($result);
						return;
					}
				}else{
					$result_all['status']  = 'false';
					$result_mess = $this->message_action('Không thể cập nhật trạng thái đơn hàng đã giao thành công sang đang chờ' , 0 );
					echo json_encode($result_all);
					return;
				}
			}
		}
	}

	public function deleteorders(){
		$get_id    = $this->input->post('id');
		$get_info          = $this->Orders_model->infoorders_id($get_id);
		if($this->input->post()){
			if(!$get_info){
				$result_all['status']  = 'false';
				$result_all['message'] = 'Đơn đặt hàng này không tồn tại trong hệ thống';
				echo json_encode($data_search);
				return;
			}else{
				$result_update = $this->Orders_model->deleteorders($get_id);
				if($result_update == 'true'){
					$result_mess = $this->message_action('Xóa đơn đặt hàng thành công' , 1 );
					$result['status'] = 'true';
				}else{
					$result_mess = $this->message_action('Xảy ra lỗi trong quá trình xóa đơn đặt hàng' , 0 );
					$result['status'] = 'false';
				}
				echo json_encode($result);
			}
		}
	}

}
