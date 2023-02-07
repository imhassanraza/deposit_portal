<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model(admin_controller().'profile_model');
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}	
	}

	public function index()
	{	
		/*$data['products'] = $this->products_model->get_products();
		$this->load->view('products/products', $data);*/
	}

	public function password ()
	{	
		$this->load->view('profile/password');
	}

	public function update_password () {
		$data = $_POST;
		$status = $this->profile_model->check_password_exist($data);
		if ($status) {
	   		$result = $this->profile_model->change_admin_password($data);
	   		if($result){
		   		$finalResult = array('msg' => 'success', 'response'=>'<p>Your Password has been successfully changed!</p>');
				echo json_encode($finalResult);
				exit;
			}else{
				$res_array = array('msg' => 'error', 'response'=>'<p>Something went wrong! Please try again later!</p>');
				echo json_encode($res_array);
				exit;
			}
		} else {
			$res_array = array('msg' => 'error', 'response'=>'Old Password doesn\'t match. Please try again with correct password!');
			echo json_encode($res_array);
			exit;
		}
	}

}