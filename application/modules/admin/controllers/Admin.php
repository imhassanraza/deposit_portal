<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(admin_controller().'admin_lib');
		$this->load->model(admin_controller().'admin_model');
		if(!empty($this->session->userdata('admin_logged_in')))
		{
			redirect(admin_url().'dashboard/');
		}
        $this->session->set_userdata('language','english');
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function users()
    {
        echo "Working";
//        $data['users'] = $this->admin_model->getAllUsers();
//        $this->load->view('users/index',$data);
    }

	public function update_counter()
	{
		for ($i=0; $i <= 10; $i++) {
		    echo $i;
		    sleep(3); // this should halt for 3 seconds for every loop
		}
	}

	public function login_verify()
	{
		if($_POST){
			$admin_email = $this->input->post('admin_email');
			$password = $this->input->post('password');
			if($this->admin_lib->validate_login($admin_email, $password))
			{
				redirect(admin_url().'dashboard/');
			}
			else
			{
				$this->session->set_flashdata('admin_email',$this->input->post('admin_email'));
				$this->session->set_flashdata('login_error','Incorrect Email or Password');
				redirect(admin_url());
			}
		}else{
			$this->session->set_flashdata('admin_email','');
			$this->session->set_flashdata('login_error','Incorrect Email or Password');
			redirect(admin_url());
		}
	}

	public function retrieve_password()
	{
	   $data = $_POST;
	   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_email_exist');
       
	   if ($this->form_validation->run($this) == FALSE)
	   	{
	   		$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
	   	}else{
	   		$this->load->helper('string');
	   		$status = false;
            $data['password'] = random_string('alnum',8);
            $userdata = $this->admin_model->get_user($data['email']);
            
            $status = $this->admin_model->set_admin_password($data['email'] , $data['password']);
            
	   		if($status){
				$htmlresponse = $this->load->view('recover_admin_pass_email', $data, TRUE);
				$this->send_confirmation_email( $data['email'] , $htmlresponse);    
				$finalResult = array('msg' => 'success', 'response'=>'<p>Password Updated Please check Your Email Inbox!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
	   	}
	}
	public function email_exist($email)
	{
		$email = $this->admin_model->check_email($email);
		if ($email > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_exist', 'This email is not exist.');
			return FALSE;
		}
	}

	public function send_confirmation_email($user_email , $email_body)
	{
		$to = $user_email;
		$subject = 'Recover Password';
		$body = $email_body;
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <noreply.expolrelogics@gmail.com>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

}
