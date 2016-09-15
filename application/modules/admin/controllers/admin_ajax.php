<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ajax extends Backend_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->Model('Acreages_model');
    }

	public function get_city_district()
	{
		$parent_id = $this->input->post('parent_id') ? $this->input->post('parent_id') : '' ;
		$acreage_children = $this->Acreages_model->listacreage_children($parent_id);
		echo json_encode($acreage_children);
	}


}
