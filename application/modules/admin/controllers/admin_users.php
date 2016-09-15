<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_users extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->Model('Users_model');
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
			$condition     = 'WHERE phone = '.$string_search.' ';
			$string_search = 'namesearch='.$string_search.' ';
		}else if($string_search != '' && !is_numeric($string_search)){
			$condition     = 'WHERE username LIKE "%'.$string_search.'%" ';
			$string_search = 'namesearch='.$string_search.' ';
		}else{
			$condition     = '';
			$string_search = '';
		}
		$get_config_pagi = $this->get_config_pagi('Users_model',$condition,$string_search);
		/**** Info Page Default ****/
		$data['info_default']['contents_subview'] = 'contents/index_users_layout';
		$data['info_default']['title'] = 'Trang Chủ Người Dùng';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'header_css/css_users_layout';
		/*** End Info Page Default ***/
		$data['data_users'] = $this->Users_model->listusers($condition.' LIMIT '.$get_config_pagi['start'].' , '.$get_config_pagi['limit'].' ');
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		/*---Pagination---*/
		$this->load->view('contents/main_layout',$data);
	}

	public function add()
	{
		$this->load->library('bcrypt_password'); // Thư viện Hash Password.
		/**** Info Page Default ****/
		$data['info_default']['contents_subview'] = 'contents/add_users_layout';
		$data['info_default']['title'] = 'Thêm Người Dùng';
		$data['info_default']['is_page'] = 'add';
		$data['info_default']['js_subview'] = 'footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'header_css/css_users_layout';
		/*** End Info Page Default ***/
		if($this->input->post()){
			$data_add = $this->input->post(NULL , TRUE);
			$data_add['birthday'] = strtotime($data_add['birthday']);
			/** Check xem người dùng này đã nhập đủ thông tin vào form chưa**/
			foreach ($data_add as $key => $value) {
				if($key == 'username'){
					$input = 'Tài khoản';
				}else if($key == 'password'){
					$input = 'Mật khẩu';
				}else if($key == 'fullname'){
					$input = 'Tên đầy đủ';
				}else if($key == 'phone'){
					$input = 'Số điện thoại';
				}else if($key == 'birthday'){
					$input = 'Ngày sinh';
				}else if($key == 'email'){
					$input = 'Email';
				}else if($key == 'address'){
					$input = 'Địa chỉ';
				}
				if(trim($value) == ''){
					$result_mess = $this->message_action($input.' không được để trống' , 0 );
					/*Save lại dữ liệu vào session trong trường hợp có field nào đó trống*/
			    	$this->session->set_flashdata('data_form' ,$data_add); 
			    	/*End Save*/
			    	redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			    	return;
				}
			}
			$data_add['password'] = $this->bcrypt_password->hash_password($data_add['password']);
			$data_add['created'] = time();
			$data_add['updated'] = time();
			/** Check xem người dùng này đã tồn tại chưa qua username của họ **/
			$check_username = $this->Users_model->checkusername($data_add['username']);
			/** END Check **/
			if($check_username){
				$result_mess = $this->message_action('Tên đăng nhập này đã tồn tại' , 0 );
			    redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			    return;
			}else{
				$result_add = $this->Users_model->addusers($data_add);
				if($result_add == 'true'){
					$result_mess = $this->message_action('Tạo người dùng thành công' , 1 );
				    redirect(base_url().'admin_users' ,'localtion');
				    return;
				}else{
					$result_mess = $this->message_action('Xảy ra lỗi trong qua trình tạo' , 0 );
				    redirect($_SERVER['HTTP_REFERER'] ,'localtion');
				    return;
				}
			}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function update($id)
	{
		$this->load->library('bcrypt_password'); // Thư viện Hash Password.
		/**** Info Page Default ****/
		$data['info_default']['contents_subview'] = 'contents/update_users_layout';
		$data['info_default']['title'] = 'Cập Nhật Người Dùng';
		$data['info_default']['is_page'] = 'update';
		$data['info_default']['js_subview'] = 'footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'header_css/css_users_layout';
		/*** End Info Page Default ***/
		/*Get thông tin của account để show ra trước khi update*/
		$get_info_users = $this->Users_model->infousers($id);
		$data['info_item_users'] = $get_info_users;
		/*End Get*/
		if($this->input->post()){
			$data_update = $this->input->post(NULL , TRUE);
			$data_update['birthday'] = strtotime($data_update['birthday']);
			$data_update['updated'] = time();
			if(trim($data_update['password'] != '')){
				$data_update['password'] = $this->bcrypt_password->hash_password($data_update['password']);
			}else{
				unset($data_update['password']);
			}
			/** Check xem người dùng này đã nhập đủ thông tin vào form chưa**/
			foreach ($data_update as $key => $value) {
				if($key == 'username'){
					$input = 'Tài khoản';
				}else if($key == 'fullname'){
					$input = 'Tên đầy đủ';
				}else if($key == 'phone'){
					$input = 'Số điện thoại';
				}else if($key == 'birthday'){
					$input = 'Ngày sinh';
				}else if($key == 'email'){
					$input = 'Email';
				}else if($key == 'address'){
					$input = 'Địa chỉ';
				}
				if(trim($value) == ''){
					$result_mess = $this->message_action($input.' không được để trống' , 0 );
			    	redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			    	return;
				}
			}
			$result_update = $this->Users_model->updateusers($id,$data_update);
			if($result_update == 'true'){
				$result_mess = $this->message_action('Cập nhật người dùng " '.$data['info_item_users']['username'].' " thành công' , 1 );
			    redirect(base_url().'admin/Admin_users' ,'localtion');
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong qua trình cập nhật' , 0 );
			    redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function active_user(){
		$id = $this->input->post('id');
		$info_item_users = $this->Users_model->infousers($id);
		if(!$info_item_users){
			$result_mess = $this->message_action('Người dùng này không tồn tại' , 0 );
		    redirect(base_url().'admin_users' ,'localtion');
		}else{
			if($info_item_users['status'] == 0){
				$data_active['status'] = 1;
			}else{
				$data_active['status'] = 0;
			}
			$result_active = $this->Users_model->updateusers($id,$data_active);
			if($result_active == 'true'){
				$result['status'] = 'true';
			}else{
				$result['status'] = 'false';
				$result['message'] = 'Xảy ra lỗi trong quá trình cập nhật';
			}
			echo json_encode($result);
			return;
		}
	}

	public function delete($id){
		$info_item_users = $this->Users_model->infousers($id);
		if(!$info_item_users){
			$result_mess = $this->message_action('Người dùng này không tồn tại' , 0 );
		}else{
			$result_delete = $this->Users_model->deleteusers($id);
			if($result_delete == 'true'){
				$result_mess = $this->message_action('Xóa người dùng "'.$info_item_users['username'].'" thành công' , 1);
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong quá trình xóa' , 0 );
			}
		}
		redirect(base_url().'admin/Admin_users' ,'localtion');
	}
}
