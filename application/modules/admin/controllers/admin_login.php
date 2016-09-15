<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->Model('Users_model');
    }

	public function index()
	{
		$this->load->library('bcrypt_password');
		/*--Info default page--*/
		$data['info_default']['title'] = 'Đăng Nhập';
		/*--Info default page--*/
		if($this->input->post()){
			$info_login = $this->input->post();
			$info_user = $this->Users_model->checkusername($info_login['username']);
			if($info_user){
				if ($this->bcrypt_password->check_password($info_login['password'], $info_user['password'])){
					if($info_user['role'] > 1){
					    $this->session->set_userdata('user_login',$info_user);
						redirect(base_url().'admin/Admin_users' ,'location');
						return;
					}else{
						$result_mess = $this->message_action('Bạn không có quyền truy cập vào trang này' , 0 );
						redirect($_SERVER['HTTP_REFERER'],'location');
						return;
					}
				}else{
				   $result_mess = $this->message_action('Tài khoản hoặc mật khẩu không đúng' , 0 );
					redirect($_SERVER['HTTP_REFERER'] ,'location');
					return;
				}
			}else{
				$result_mess = $this->message_action('Tài khoản này không tồn tại' , 0 );
				redirect($_SERVER['HTTP_REFERER'] ,'location');
				return;
			}
		}
		$this->load->view('contents/login_layout',$data);
	}

	public function logout(){
		$this->session->unset_userdata('user_login');
		redirect(base_url().'admin/Admin_login' ,'location');
		return;
	}

}
