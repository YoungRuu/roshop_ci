<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_categories extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->Model('Categories_model');
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
		$name_search      = $this->input->get('namesearch') ? $this->input->get('namesearch') : '';
		$name_search 	  = trim($name_search);
		$parent_id_search = $this->input->get('parent') ? $this->input->get('parent') : '';
		$condition        = 'WHERE ';
		$string_search    = '';
		if($name_search != ''){
			$condition     .= 'name LIKE "%'.$name_search.'%"';
			$string_search .= 'namesearch='.$name_search;
		}
		if($name_search != '' && $parent_id_search != '' && is_numeric($parent_id_search)){
			$condition     .= ' and ';
			$string_search = 'namesearch='.$name_search.'&parent='.$parent_id_search.'' ;
		}
		if($parent_id_search != '' && is_numeric($parent_id_search)){
			$condition     .= 'parent_id = '.$parent_id_search.' ';
		}
		if($name_search == '' && $parent_id_search == ''){
			$condition    = '';
		}
		$get_config_pagi = $this->get_config_pagi('Categories_model',$condition,$string_search);
		// print_r($get_config_pagi);die;
		/*--Info default page--*/
		$data['info_default']['contents_subview'] = 'contents/index_cate_layout';
		$data['info_default']['title'] = 'Trang Chủ Danh Mục';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_cate_layout';
		$data['info_default']['css_subview'] = 'header_css/css_cate_layout';
		/*Get list cate*/
		$data['data_cate'] = $this->Categories_model->listcate($condition .' LIMIT '.$get_config_pagi['start'].' , '.$get_config_pagi['limit'].' ');
		$data_cate_name = $this->Categories_model->listcate();

		//Foreach Lấy ra tên Danh Mục Cha
		foreach ($data['data_cate'] as &$v) {
			foreach ($data_cate_name as $v1) {
				if($v['parent_id'] == $v1['id']){
					$v['parent_name'] = $v1['name'];
				}
			}
		}
		// print_r($data['data_cate_name']);die;
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		/*---Pagination---*/
		$this->load->view('contents/main_layout',$data);
	}

	public function add()
	{
		$data['info_default']['contents_subview'] = 'contents/add_cate_layout';
		$data['info_default']['title'] = 'Thêm Danh Mục';
		$data['info_default']['is_page'] = 'add';
		$data['info_default']['js_subview'] = 'footer_js/js_cate_layout';
		$data['info_default']['css_subview'] = 'header_css/css_cate_layout';
		/*Get List Parent_categories*/
		$data['list_parent_categories'] = $this->Categories_model->listcate();
		/*End Get*/
		if($this->input->post()){
			$data_post = $this->input->post(NULL,TRUE);
			$data_post['name'] = trim($this->input->post('name'));
			$data_post['name'] = $this->remove_double_space($data_post['name']);
			$data_post['name_alias'] = $this->url_slug($data_post['name']);
			foreach($data_post as $key => $value){
			    if($value == ''){
		    	    if($key == 'name'){ 
		    	     	$input = 'Tên danh mục' ;
		    	    }else if($key == 'name_alias'){ 
		    	    	$input = 'Alias' ;
		    	    }
			    	$result_mess = $this->message_action($input.' không được để trống' , 0 );
			    	redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			    }
			}
			/*Check tồn tại danh mục*/
			$check_cate = $this->Categories_model->checknamecate($data_post['name']);
			if($check_cate != ''){
				$result_mess = $this->message_action('Danh mục này đã tồn tại' , 0 );
			    redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			}
			/*End check*/
        	$result_add = $this->Categories_model->addcate($data_post);
    		if($result_add == 'true'){
	    		$result_mess = $this->message_action('Tạo danh mục thành công' , 1 );
    			redirect(base_url().'admin/admin_categories', 'location');
    		}else{
    			$result_mess = $this->message_action('Xảy ra lỗi trong qá trình tạo' , 0 );
    			redirect($_SERVER['HTTP_REFERER'] ,'localtion');
    		}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function update($id = '')
	{
		/*Get info item categories*/
		$query_item_cate = $this->db->query('SELECT id , name , parent_id , status FROM categories where id="'.$id.'" ');
		$data['info_item_categories'] = $query_item_cate->row_array();
		if($data['info_item_categories'] == ''){
			$result_mess = $this->message_action('Danh mục này không tồn tại' , 0 );
    		redirect(base_url().'admin_categories', 'location');
		}
		/*Get List Parent_categories*/
		$data['list_parent_categories'] = $this->Categories_model->listcate();
		/*End Get*/
		$data['info_default']['contents_subview'] = 'contents/update_cate_layout';
		$data['info_default']['title'] = 'Cập Nhật Danh Mục';
		$data['info_default']['is_page'] = 'update';
		$data['info_default']['js_subview'] = 'footer_js/js_cate_layout';
		$data['info_default']['css_subview'] = 'header_css/css_cate_layout';
		if($this->input->post()){
			$data_post = $this->input->post(NULL,TRUE);
			$data_post['name'] = trim($this->input->post('name'));
			$data_post['name'] = $this->remove_double_space($data_post['name']);
			$data_post['name_alias'] = $this->url_slug(trim($this->input->post('name')));
			foreach($data_post as $key => $value){
			    if($value == ''){
		    	    if($key == 'name'){ 
		    	     	$input = 'Tên danh mục' ;
		    	    }else if($key == 'name_alias'){ 
		    	    	$input = 'Alias' ;
		    	    }
			    	$result_mess = $this->message_action($input.' không được để trống' , 0 );
			    	redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			    }
			}
			/*Check tồn tại danh mục*/
			$query_cate = $this->db->query('SELECT * FROM categories WHERE name = "'.$data_post['name'].'" and id != "'.$id.'" ');
			$check = $query_cate->row_array();
			if($check != ''){
				$result_mess = $this->message_action('Danh mục này đã tồn tại' , 0 );
			    redirect($_SERVER['HTTP_REFERER'] ,'localtion');
			}
			/*End check*/
            $this->db->where("id",$id);
        	$result_update = $this->db->update("categories",$data_post);
    		if($result_update == 1){
	    		$result_mess = $this->message_action('Cập nhật danh mục thành công' , 1 );
    			redirect(base_url().'admin/admin_categories', 'location');
    		}else{
    			$result_mess = $this->message_action('Xảy ra lỗi trong qá trình cập nhật' , 0 );
    			redirect($_SERVER['HTTP_REFERER'] ,'localtion');
    		}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function delete($id = ''){
		$this->load->Model("Categories_model");
		$info_categories = $this->Categories_model->infocate($id);
		if($info_categories == ''){
			$result_mess = $this->message_action('Danh mục này không tồn tại' , 0 );
    		redirect($_SERVER['HTTP_REFERER'] ,'localtion');
		}else{
			$delete_categories = $this->Categories_model->deletecate($id);
			if($delete_categories == 'true'){
				$result_mess = $this->message_action('Xóa danh mục thành công' , 1 );
    			redirect(base_url().'admin/admin_categories', 'location');
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong quá trình xóa' , 0 );
    			redirect(base_url().'admin/admin_categories', 'location');
			}
		}
	}

	public function update_status(){
		$this->load->Model("Categories_model");
		$id = $this->input->post('id');
		$info_categories = $this->Categories_model->infocate($id);
		if($info_categories == ''){
    		$result['status'] = 'false';
    		$result['message'] = 'Danh mục này không tồn tại';
		}else{
			if($info_categories['status'] == 1){
				$data_status['status'] = 0;
			}else{
				$data_status['status'] = 1;
			}
			$update_status = $this->Categories_model->updatecate($id,$data_status);
			$result['status'] = $update_status;
			$result['message'] = 'Cập nhật danh mục thành công';
		}
		echo json_encode($result);
	}
}
