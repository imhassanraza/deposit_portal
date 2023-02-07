<?php 
class Admin_lib {
	function __construct()
	{		
		$this->ci =& get_instance();
		$this->ci->load->model($this->ci->config->item('admin_controller').'admin_model');
		$this->ci->load->model($this->ci->config->item('admin_controller').'dashboard_model');
	}
	public function validate_login($username,$password)
	{	
		
		$result=$this->ci->admin_model->get_login($username,$password);
        

		if(count($result)>0)
			{	
				$log_id = $this->ci->admin_model->login_log($result->userid);
				$permissions =$this->ci->admin_model->get_permissions($result->userid);
				$array=array(
				'admin_id'=>$result->userid,
				'admin_username'=>$result->username,
				'email'=>$result->email,
				'user_type'=>$result->user_type,
				'admin_login'=>true,
				'admin_logged_in'=>true,
                'permissions' => $permissions,
                'admin_log_id' => $log_id
			);

			$this->ci->session->set_userdata($array);
			$this->ci->admin_model->update_ip($result->userid);
			return true;
			}
			else
			{			
				return false;			
			}
		
	}

	public function get_route_clinics($route_id)
	{
		$result=$this->ci->dashboard_model->get_route_clinics($route_id);
		return $result;
	}
	public function get_route_drivers($route_id)
	{
		$result=$this->ci->dashboard_model->get_route_drivers($route_id);
		return $result;
	}
	public function get_not_selected_clinics($route_id)
	{
		$result=$this->ci->dashboard_model->get_not_selected_clinics($route_id);
		return $result;
	}
	public function get_selected_clinics($route_id)
	{
		$result=$this->ci->dashboard_model->get_selected_clinics($route_id);
		return $result;
	}
	public function get_post_image($post_id)
	{	
		$result=$this->ci->dashboard_model->get_ad_picture($post_id);
		return $result;
		
	}
	public function get_category_dtls($id)
	{
		$cat_name = $this->ci->dashboard_model->get_category_dtls($id);
		return $cat_name;
	}
	public function get_category_name($id)
	{
		$cat_name = $this->ci->dashboard_model->category_name($id);
		return $cat_name;
	}
	public function get_country_state_by_id($id)
	{
		$result = $this->ci->dashboard_model->get_country_state_by_id($id);
		return $result;
	}
}

