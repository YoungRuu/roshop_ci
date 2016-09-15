<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_products extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->output->cache(5);
        $this->load->Model('Products_model');
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
		$this->load->Model('Categories_model');
		/*-----Info Pagination-----*/
		$string_search = $this->input->get('namesearch') ? $this->input->get('namesearch') : '';
		$string_search = trim($string_search);
		if($string_search != ''){
			$condition     = 'where name LIKE "%'.$string_search.'%" ';
			$string_search = 'namesearch='.$string_search.' ';
		}else{
			$condition     = '';
			$string_search = '';
		}
		$get_config_pagi = $this->get_config_pagi('Products_model' ,$condition,$string_search);
		/*--Info Default Page--*/
		$data['info_default']['contents_subview'] = 'contents/index_products_layout';
		$data['info_default']['title'] = 'Trang Chủ Sản phẩm';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_products_layout';
		$data['info_default']['css_subview'] = 'header_css/css_products_layout';
		/*--End Info Default Page--*/
		$data['data_products'] = $this->Products_model->listproducts($condition.'ORDER BY ID DESC LIMIT '.$get_config_pagi['start'].' , '.$get_config_pagi['limit'].' ');
		$get_categories = $this->Categories_model->listcate();
		//Foreach Lấy ra tên Danh Mục Cha
		foreach ($get_categories as $v) {
			foreach ($data['data_products'] as &$v1) {
				if($v['id'] == $v1['categories_id']){
					$v1['categories_name'] = $v['name'];
				}
			}
		}
		foreach ($data['data_products'] as $key => $value) {
			$data['data_products'][$key]['list_image'] = json_decode($value['list_image'],true); 
		}
		/*---Pagination---*/
		$this->pagination($get_config_pagi);
		$data['pagination'] = $this->get_pagination_html();
		/*---Pagination---*/
		$this->load->view('contents/main_layout',$data);
	}

	public function add()
	{
		$this->load->Model('Categories_model');
		$data['categories'] = $this->Categories_model->listcate();
		/*--Info Default Page--*/
		$data['info_default']['contents_subview'] = 'contents/add_products_layout';
		$data['info_default']['title'] = 'Thêm Sản phẩm';
		$data['info_default']['is_page'] = 'index';
		$data['info_default']['js_subview'] = 'footer_js/js_products_layout';
		$data['info_default']['css_subview'] = 'header_css/css_products_layout';
		/*--END Info Default Page--*/
		if($this->input->post()){
			$data_add = $this->input->post(NULL,TRUE);
			if($data_add['price_sale'] == ''){
				$data_add['price_sale'] = 0;
			}
			/*--Màu sắc--*/
			foreach ($data_add['color'] as $key_cl => &$value_cl) {
				if($value_cl == ''){
					unset($data_add['color'][$key_cl]);
				}
			}
			if(empty($data_add['color'])){
				$data_add['color']['0'] = '#000000';
			}
			if(empty($data_update['size'])){
				$data_update['size']['0'] = 'FREE';
			}
			foreach ($data_add as $key => $value) {
				if($key == 'name'){
					$input = 'Tên sản phẩm';
				}else if($key == 'origin'){
					$input = 'Xuất xứ';
				}else if($key == 'material'){
					$input = 'Chất liệu';
				}else if($key == 'quantity'){
					$input = 'Số lượng';
				}else if($key == 'price_standard'){
					$input = 'Giá';
				}
				if($key == 'color' || $key == 'list_image' || $key == 'size' ){
					continue;
				}
				if(trim($value) == ''){
					$result_mess = $this->message_action($input.' không được để trống' , 0 );
					/*Save lại dữ liệu vào session trong trường hợp có field nào đó trống*/
			    	$this->session->set_flashdata('data_form_pr' ,$data_add); 
			    	/*End Save*/
			    	redirect($_SERVER['HTTP_REFERER'] ,'location');
			    	return;
				}
			}
			
			/*Gọi hàm create_image và Trả về status + message + list image đã upload*/
			$image_up = $this->create_image('list_image','./uploads/',$this->url_slug($data_add['name']));
			/*Tiếp tục foreach mảng hình ảnh lấy ra name để insert vào database*/
			$full_list_image = array();
			if($image_up['status'] == 'true'){
				foreach ($image_up['data_img'] as $key => $value) {
					$full_list_image[] = $value['file_name'];
				}
			}else{
				$result_mess = $this->message_action($image_up['message'] , 0 );
				/*Save lại dữ liệu vào session trong trường hợp có field nào đó trống*/
		    	$this->session->set_flashdata('data_form_pr' ,$data_add); 
		    	/*End Save*/
		    	redirect($_SERVER['HTTP_REFERER'] ,'location');
		    	return;
			}
			$data_add['list_image'] = json_encode($full_list_image);
			$data_add['name'] = $this->remove_double_space(trim($data_add['name']));
			$data_add['name_alias'] = $this->url_slug($data_add['name']);
			$check_name_products = $this->Products_model->checknameproducts($data_add['name']);
			if($check_name_products){
				$result_mess = $this->message_action('Sản phẩm này đã tồn tại' , 0 );
				$this->session->set_flashdata('data_form_pr' ,$data_add); 
			    redirect($_SERVER['HTTP_REFERER'] ,'location');
			    return;
			}else{
				$data_add['color'] = json_encode($data_add['color']);
				$data_add['size'] = json_encode($data_add['size']);
				$result_add = $this->Products_model->addproducts($data_add);
				if($result_add == 'true'){
					$result_mess = $this->message_action('Thêm sản phẩm '.$data_add['name'].' thành công' , 1 );
				    redirect(base_url().'admin/admin_products' ,'location');
				}else{
					$result_mess = $this->message_action('Xảy ra lỗi trong quá trình tạo' , 0 );
					$data_add['color'] = json_decode($data_add['color'],true);
					$this->session->set_flashdata('data_form_pr' ,$data_add); 
			    	redirect($_SERVER['HTTP_REFERER'] ,'location');
				}
			}
		}
		$this->load->view('contents/main_layout',$data);
	}

	public function update($id)
	{	
		$this->load->Model('Categories_model');
		$data['categories'] = $this->Categories_model->listcate();
		/*--Info Default Page--*/
		$data['info_default']['contents_subview'] = 'contents/update_products_layout';
		$data['info_default']['title'] = 'Cập Nhật Sản phẩm';
		$data['info_default']['is_page'] = 'update';
		$data['info_default']['js_subview'] = 'footer_js/js_products_layout';
		$data['info_default']['css_subview'] = 'header_css/css_products_layout';
		/*--END Info Default Page--*/
		$check_exist = $this->Products_model->infoproducts($id);
		if(!$check_exist){
			$result_mess = $this->message_action('Sản phẩm này không tồn tại' , 0 );
	    	redirect(base_url().'admin/admin_products' ,'location');
	    	return;
		}else{
			$data['info_item_products'] = $check_exist;
		}
		// print_r($data['info_item_products']);die;
		if($this->input->post()){
			$data_update = $this->input->post(NULL,TRUE);
			if($data_update['price_sell_new'] != $check_exist['price_sell_new']){
				// Lấy giá hiện tại chuyển sang giá cũ và cập nhật giá mới
				$data_update['price_sell_old'] = $check_exist['price_sell_new']; 
			}
			if($data_update['price_sale'] == ''){
				$data_update['price_sale'] = 0;
			}
			/*--Màu sắc--*/
			foreach ($data_update['color'] as $key_cl => &$value_cl) {
				if($value_cl == ''){
					unset($data_update['color'][$key_cl]);
				}
			}
			if(empty($data_update['color'])){
				$data_update['color']['0'] = '#000000';
			}
			if(empty($data_update['size'])){
				$data_update['size']['0'] = 'FREE';
			}
			// print_r($data_update);die;
			foreach ($data_update as $key => $value) {
				if($key == 'name'){
					$input = 'Tên sản phẩm';
				}else if($key == 'origin'){
					$input = 'Xuất xứ';
				}else if($key == 'material'){
					$input = 'Chất liệu';
				}else if($key == 'quantity'){
					$input = 'Số lượng';
				}else if($key == 'price_standard'){
					$input = 'Giá';
				}
				if($key == 'color' || $key == 'list_image' || $key == 'size' || $key == 'get_value_img'){
					continue;
				}
				if(trim($value) == ''){
					$result_mess = $this->message_action($input.' không được để trống' , 0 );
					/*Save lại dữ liệu vào session trong trường hợp có field nào đó trống*/
			    	$this->session->set_flashdata('data_form_pr' ,$data_add); 
			    	/*End Save*/
			    	redirect($_SERVER['HTTP_REFERER'] ,'location');
			    	return;
				}
			}
			/*Gọi hàm create_image và Trả về status + message + list image đã upload*/
			$image_up = $this->create_image('list_image','./uploads/',$this->url_slug($data_update['name']),$check_exist['list_image']);
			/*Tiếp tục foreach mảng hình ảnh lấy ra name để insert vào database*/
			$full_list_image = array();
			if($image_up['status'] == 'true'){
				foreach ($image_up['data_img'] as $key => $value) {
					$full_list_image[] = $value['file_name'];
				}
				foreach ($data_update['get_value_img'] as $key => &$value) {
					if(empty($value)){
						unset($data_update['get_value_img'][$key]);
					}
				}
				/*Merge List Ảnh Mới Thêm Vào Và List Ảnh Cũ */
				$ruu_full_list_image = array_merge($data_update['get_value_img'],$full_list_image); 
				$data_update['list_image'] = json_encode($ruu_full_list_image); /*Json_encode List Ảnh*/
			}else if($image_up['status'] == 'false'){
				$result_mess = $this->message_action($image_up['message'] , 0 );
				/*Save lại dữ liệu vào session trong trường hợp có field nào đó trống*/
		    	$this->session->set_flashdata('data_form_pr' ,$data_update); 
		    	/*End Save*/
		    	redirect($_SERVER['HTTP_REFERER'] ,'location');
		    	return;
			}else if($image_up['status'] == 'true_false'){
				$data_update['list_image'] = json_encode($data_update['get_value_img']); /*Json_encode List Ảnh Sau Update*/
			}
			
			$data_update['color'] = json_encode($data_update['color']);
			$data_update['size'] = json_encode($data_update['size']);

			$data_update['name'] = $this->remove_double_space(trim($data_update['name']));
			$data_update['name_alias'] = $this->url_slug($data_update['name']);
			$check_name_products = $this->Products_model->checknameproducts_update($id,$data_update['name']);
			if($check_name_products){
				$result_mess = $this->message_action('Sản phẩm này đã tồn tại' , 0 );
			    redirect($_SERVER['HTTP_REFERER'] ,'location');
			}else{
				unset($data_update['get_value_img']); /*Unset mảng thừa (Mảng này để lấy lại List ảnh update)*/
				$result_update = $this->Products_model->updateproducts($id,$data_update);
				if($result_update == 'true'){
					$result_mess = $this->message_action('Cập nhật sản phẩm '.$data_update['name'].' thành công' , 1 );
				    redirect($_SERVER['HTTP_REFERER'] ,'location');
				}else{
					$result_mess = $this->message_action('Xảy ra lỗi trong quá trình cập nhật' , 0 );
			    	redirect($_SERVER['HTTP_REFERER'] ,'location');
				}
			}
		}
		$this->load->view('contents/main_layout',$data);
	}

	private function set_upload_options(){   
	    //upload an image options
		$up_img                  = array();
		$up_img['upload_path']   = './uploads/';
		$up_img['image_library'] = 'gd2';
		$up_img['allowed_types'] = 'gif|jpg|png';
		$up_img['max_size']      = '900';
		$up_img['max_width']     = '1024';
		$up_img['max_height']    = '768';
		$up_img['remove_spaces'] = TRUE;
		$up_img['overwrite']     = FALSE;
	    return $up_img;
	}

	public function delete($id){
		$check_exist = $this->Products_model->infoproducts($id);
		if(!$check_exist){
			$result_mess = $this->message_action('Sản phẩm này không tồn tại' , 0 );
	    	redirect(base_url().'admin/admin_products' ,'location');
	    	return;
		}else{
			$result_delete = $this->Products_model->deleteproducts($id);
			if($result_delete == 'true'){
				$result_mess = $this->message_action('Xóa sản phẩm '.$check_exist['name'].' thành công' , 1 );
		    	redirect(base_url().'admin/admin_products' ,'location');
		    	return;
			}else{
				$result_mess = $this->message_action('Xảy ra lỗi trong qua trình xóa' , 0 );
		    	redirect(base_url().'admin/admin_products' ,'location');
		    	return;
			}
		}
	}

	public function create_image($input_file_name,$path,$name_product_slug = '',$list_img_old = ''){
		$this->load->library('upload');
		$this->load->library("image_lib");
		$config = array(
            'upload_path'   => $path,
            'max_size'      => 1024 * 100,
            'allowed_types' => 'gif|jpeg|jpg|png',
            'overwrite'     => FALSE,
            'remove_spaces' => TRUE,
        );
        /*--Hình ảnh--*/
		foreach ($_FILES[$input_file_name]['name'] as $key => $value) {
			/*Lọc ra những phần tử rỗng trong mảng và unset chúng*/
			if(empty($value)){
				unset($_FILES[$input_file_name]['name'][$key]);
				unset($_FILES[$input_file_name]['type'][$key]);
				unset($_FILES[$input_file_name]['tmp_name'][$key]);
				unset($_FILES[$input_file_name]['error'][$key]);
				unset($_FILES[$input_file_name]['size'][$key]);
			}
		}
		$_FILES[$input_file_name]['name']     = array_values($_FILES[$input_file_name]['name']);
		$_FILES[$input_file_name]['type']     = array_values($_FILES[$input_file_name]['type']);
		$_FILES[$input_file_name]['tmp_name'] = array_values($_FILES[$input_file_name]['tmp_name']);
		$_FILES[$input_file_name]['error']    = array_values($_FILES[$input_file_name]['error']);
		$_FILES[$input_file_name]['size']     = array_values($_FILES[$input_file_name]['size']);

		if(empty($_FILES[$input_file_name]['name']) && $list_img_old == ''){
	    	$result['status']  = "false";
            $result['message'] = 'Hình ảnh không được để trống';
	    	return $result;
		}else{
			foreach ($_FILES[$input_file_name]['type'] as $key => $value) {
				/*Kiểm tra đúng định dạng file ảnh hay không*/
				if($value != "image/jpeg" && $value != "image/png" && $value != "image/gif" && $value != "image/jpg"){
					$result['status']  = "false";
                	$result['message'] = 'Yêu cầu chọn đúng định dạng file ảnh';
			    	return $result;
				}
			}
		}
		$files = $_FILES;  //Dòng này rất quan trọng . nhưng đếch hiểu vấn đề là gì ? chắc là biến cục bộ để save giá trị khi for
		/*End hình ảnh*/
        $count = count($_FILES[$input_file_name]['name']);
        for ($i = 0; $i < $count; $i++) { // $i bắt đầu từ 0 . Để trùng với chỉ số của mảng Hình ảnh gửi lên
        	if(empty($_FILES[$input_file_name]['name'][$i])){
        		continue;
        	}
            $_FILES[$input_file_name]['name']     = $files[$input_file_name]['name'][$i];
            $_FILES[$input_file_name]['type']     = $files[$input_file_name]['type'][$i];
            $_FILES[$input_file_name]['tmp_name'] = $files[$input_file_name]['tmp_name'][$i];
            $_FILES[$input_file_name]['error']    = $files[$input_file_name]['error'][$i];
            $_FILES[$input_file_name]['size']     = $files[$input_file_name]['size'][$i];

            // $fileName = time().$i.$i . '_' . $_FILES[$input_file_name]['name'];
            $fileName = time().$i.$i . '_' . $name_product_slug;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);
            if ($this->upload->do_upload($input_file_name)) {
                
                $result['data_img'][] = $this->upload->data();
                $result['status']     = "true";
                $result['message']    = 'Upload Hình ảnh hoàn tất';
                /*Tạo ảnh thumb*/
				$thumb_img['image_library']  = 'gd2';
				// $thumb_img['create_thumb']   = TRUE;
				$thumb_img['source_image']   = $result['data_img'][$i]['full_path']; /*Lấy đầy đủ đường dẫn ảnh để tạo ảnh thumb*/
				$thumb_img['maintain_ratio'] = TRUE;
				$thumb_img['width']          = 75;
				$thumb_img['height']         = 60;
				$thumb_img['new_image']      = $result['data_img'][$i]['file_path'].'thumb/thumb75x60_'.$result['data_img'][$i]['file_name'];
				/*['new_image'] : Thiết lập lại đường dẫn ảnh tạo cạo cấu trúc lại name ảnh .v.v. */
				if(!empty($thumb_img)){
		        	$this->image_lib->initialize($thumb_img);
		        	$result_resize = $this->image_lib->resize();
		        	if (!$result_resize){
		        		$result['status']  = 'false';
				        $result['message'] = 'Xảy ra lỗi trong qua trình tạo ảnh thumb 75x60';
				    }
		        }
		        /*-------------*/
		        /*Tạo ảnh thumb*/
				// $thumb_img['create_thumb']   = TRUE;
				$thumb_img['source_image']   = $result['data_img'][$i]['full_path']; /*Lấy đầy đủ đường dẫn ảnh để tạo ảnh thumb*/
				$thumb_img['maintain_ratio'] = TRUE;
				$thumb_img['width']          = 300;
				$thumb_img['height']         = 400;
				$thumb_img['new_image']      = $result['data_img'][$i]['file_path'].'thumb/thumb300x400_'.$result['data_img'][$i]['file_name'];
				/*['new_image'] : Thiết lập lại đường dẫn ảnh tạo cạo cấu trúc lại name ảnh .v.v. */
				if(!empty($thumb_img)){
		        	$this->image_lib->initialize($thumb_img);
		        	$result_resize = $this->image_lib->resize();
		        	if (!$result_resize){
		        		$result['status']  = 'false';
				        $result['message'] = 'Xảy ra lỗi trong qua trình tạo ảnh thumb 300x400';
				    }
		        }
				/*End tạo thumb */
            } else {
                $result['status']     = 'false';
                // $result['message']    = 'Xảy ra lỗi trong quá trình upload ảnh';
                $result['message']    = $this->upload->display_errors('', '') . "\r";
            }
        }
        /*--Khi mảng hình ảnh rỗng thì ra ngoài vòng for--*/
        /*--$result sẽ rỗng .Vì không chọn file ảnh mới (trường hợp Update)--*/
        /*--$result['status'] sẽ = true_false : Có nghĩa là cả 2 đều đúng --*/
        /*--Bởi vì khi tạo sản phẩm thì buộc phải chọn ảnh Và khi update có quyền không chọn ảnh mới --*/
        /*--Ở trường hợp này . Điều chắc chắn ở đây là 1 sản phẩm đều có ít nhất 1 hình ảnh --*/
        if(!empty($result)){
        	return $result;
        }else{
			$result['status']  = 'true_false';
			$result['message'] = 'Không có ảnh nào được tải lên';
        	return $result;
        }
	}

}
