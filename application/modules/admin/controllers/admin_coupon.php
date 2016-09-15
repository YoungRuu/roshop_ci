<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_coupon extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->output->cache(5);
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

    public function index(){
    	$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    	/*-----Info Pagination-----*/
		$datestart      = $this->input->get('datestart') ? $this->input->get('datestart') : '';
		$dateend        = $this->input->get('dateend') ? $this->input->get('dateend') : '';
		$datestart_fm   = date_create($datestart.' 23:59:59');
		$dateend_fm     = date_create($dateend.' 23:59:59');
		$datestart_then = date_format($datestart_fm,'Y-m-d H:i:s');
		$dateend_then   = date_format($dateend_fm,'Y-m-d H:i:s');
		$status    = $this->input->get('status');
		$condition = '';
		$string_search = '';
		if($datestart != '' && $dateend != '' && $status == ''){
			$condition     = 'WHERE date_end BETWEEN  "'.$datestart_then.'" AND "'.$dateend_then.'"';
			$string_search = 'status='.$status.'&datestart='.$datestart.'&dateend='.$dateend;
		}
		if($status != '' && $datestart != '' && $dateend != ''){
			$condition     = 'WHERE date_end BETWEEN  "'.$datestart_then.'" AND "'.$dateend_then.'" AND status ='.$status.' ';
			$string_search = 'status='.$status.'&datestart='.$datestart.'&dateend='.$dateend;
		}
		if($status != '' && $datestart == '' && $dateend == ''){
			$condition = 'WHERE status = '.$status.' ';
			$string_search = 'status='.$status.'&datestart='.$datestart.'&dateend='.$dateend;
		}
		$get_config_pagi = $this->get_config_pagi('Coupon_model',$condition,$string_search);
		/**** Info Page Default ****/

		$data['info_default']['contents_subview'] = 'contents/index_coupon_layout';
		$data['info_default']['title'] = 'Trang Chủ Phiếu Mua Hàng';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_coupon_layout';
		$data['info_default']['css_subview'] = 'header_css/css_coupon_layout';

		/*** End Info Page Default ***/
	    $data['data_coupon'] = $this->Coupon_model->listcoupon($condition.' ORDER BY id DESC  LIMIT '.$get_config_pagi['start'].' , '.$get_config_pagi['limit'].'');
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		/*---Paginat

		die; // no chua vao day roi // vi` no' co file cache data_coupon kia` a . a xoa di la` no' VA`Oion---*/
		$this->load->view('contents/main_layout',$data);
    }

    public function add(){
    	if($this->input->post()){
    		$quantity = $this->input->post('quantity_coupon');
			$value    = $this->input->post('value_coupon');
			$dateend  = $this->input->post('dateend_coupon') ? $this->input->post('dateend_coupon').'23:59:59' : date('Y-m-d H:i:s') ;
			$dateend_fm = date_create($dateend);
			$content  = $this->input->post('content_coupon');
			for ($i = 0; $i < $quantity; $i++) {
				$data_insert = array(
					'coupon_value'   => $value,
					'coupon_content' => $content,
					'date_end'       => date_format($dateend_fm,'Y-m-d H:i:s'),
					'coupon_code'	 => $this->generateCodeCoupon(),
				);
				$result_insert = $this->Coupon_model->addcoupon($data_insert);
			}
			if($result_insert == 'true'){
				$result_mess = $this->message_action('Tạo thành công '.$quantity.' phiếu mua hàng' , 1 );
				redirect(base_url().'admin/admin_coupon','location');
				return;
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong qua trình tạo phiếu mua hàng' , 0 );
				redirect(base_url().'admin/admin_coupon','location');
				return;
			}
    	}
    }

    public function delete(){
		$id = $this->input->post('id');
    	$check_coupon = $this->Coupon_model->infocouponall($id);
    	if(!$check_coupon){
    		$result_mess = $this->message_action('Phiếu mua hàng này không tồn tại trong hệ thống' , 0 );
    		echo 'false';
    		return;
    	}else{
    		$result_delete = $this->Coupon_model->deletecoupon($id);
	    	if($result_delete == 'true'){
	    		$result_mess = $this->message_action('Xóa thành công phiếu mua hàng: '.$check_coupon['coupon_code'] , 1 );
	    		echo 'true';
	    		return;
	    	}else{
	    		$result_mess = $this->message_action('Xảy ra lỗi trong qua trình xóa phiếu mua hàng' , 0 );
	    		echo 'false';
	    		return;
	    	}
    	}
    }

    public function deletecoupon_end(){
		$result_delete = $this->Coupon_model->deletecoupon_end();
		if($result_delete == 'true'){
			$result_mess = $this->message_action('Xóa tất cả các phiếu mua hàng hết hạn thành công' , 1 );
    		echo 'true';
    		return;
		}else{
			$result_mess = $this->message_action('Xảy ra lỗi trong qua trình xóa phiếu mua hàng hết hạn' , 0 );
    		echo 'false';
    		return;
		}
    }

    public function generateCodeCoupon($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
	    }
	    return strtoupper('CP'.$randomString);
	}

	// public function updatealiascity(){
	// 	 $this->load->Model('Acreages_model');
	// 	 $list_acreage = $this->Acreages_model->listacreage();
	// 	 foreach ($list_acreage as $key => $value) {
	// 	 	$str = $this->url_slug($value['name']);
	// 		$str = str_replace( array(' ', '-'), array('', ''), $str );
	// 		$str = strtoupper($str);
	// 		$data = array(
	// 			'name_alias' => $str,
	// 		);
	// 		$this->Acreages_model->updateacreagealias($value['id'],$data);
	// 	 }
	// }

}
