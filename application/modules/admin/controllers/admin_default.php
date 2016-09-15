<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Name_Controller extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

	public function index()
	{
		$data['info_default']['contents_subview'] = 'admin/contents/index_users_layout';
		$data['info_default']['title'] = 'Trang Chủ Người Dùng';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'admin/footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'admin/header_css/css_users_layout';

		$this->load->view('admin/contents/main_layout',$data);
	}

	public function add()
	{
		$data['info_default']['contents_subview'] = 'admin/contents/add_users_layout';
		$data['info_default']['title'] = 'Thêm Người Dùng';
		$data['info_default']['is_page'] = 'add';
		$data['info_default']['js_subview'] = 'admin/footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'admin/header_css/css_users_layout';
		$this->load->view('admin/contents/main_layout',$data);
	}

	public function update()
	{
		$data['info_default']['contents_subview'] = 'admin/contents/update_users_layout';
		$data['info_default']['title'] = 'Cập Nhật Người Dùng';
		$data['info_default']['is_page'] = 'update';
		$data['info_default']['js_subview'] = 'admin/footer_js/js_users_layout';
		$data['info_default']['css_subview'] = 'admin/header_css/css_users_layout';
		$this->load->view('admin/contents/main_layout',$data);
	}
}
