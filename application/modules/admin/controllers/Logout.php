<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("admin_model");
	}
	public function index()
	{
		$this->admin_model->logout_log();
		$this->session->unset_userdata('admin_logged_in');
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_username');
		
		redirect($this->config->item('admin_url').'login');
	}
}