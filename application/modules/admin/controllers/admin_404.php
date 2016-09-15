<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_404 extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

	public function index()
	{
		$this->output->set_status_header('404');
		$this->load->view('admin/error/404');
	}

	public function FindAJobs(){
		$my_info = array(
			'fullname'  => 'Lê Anh Rô',
			'birthday'  => '28 - 12 - 1995',
			'email'     => 'leanhro2812@gmail.com',
			'phone'     => '01664700660',
			'address'   => '31 Ni Sư Huỳnh Liên , Quận Tân Bình , TP.HCM',
		);
		$my_skills = array(
			'0'			=> 'HTML5',
			'1'			=> 'CSS3',
			'2'			=> 'Bootstrap',
			'3'			=> 'Jquery',
			'4'			=> 'Ajax',
			'5'			=> 'Mysql',
			'6'			=> 'PHP',
			'7'			=> 'Phalcon framework',
			'8'			=> 'Codeigniter framework',
			'9'			=> 'Git Basic',
			'10'		=> 'Tortoisesvn Basic',
		);
		$full_my_info[] = $my_info;
		$full_my_info[] = $my_skills;
		$need_jobs      = true;
		while ($need_jobs == true) {
			$result_find_status = $this->FindAJobs_Good($full_my_info);
			if($result_status_find == true){
				$need_jobs = false;
			}
		}
	}


}


