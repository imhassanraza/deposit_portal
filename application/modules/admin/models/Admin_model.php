<?php 
class Admin_model extends CI_Model
{
	public function getAllUsers()
    {
        $this->db->select('*');
        $query=$this->db->get('admin_users');
        return $query->result_array();
    }


    public function report_users()
    {
        $this->db->select('*');
        if(get_session('user_type') == 0){
            $this->db->where('userid',get_session('admin_id'));
        }
        $query=$this->db->get('admin_users');
        return $query->result_array();
    }

	public function get_login($email,$password)
	{
		$hash_pass="password('".$password."')";	
		$this->db->select('*');
		$this->db->where('email',$email);		
		$this->db->where('password',$hash_pass, FALSE);
		$this->db->from('admin_users');		
		$query=$this->db->get();	
		return $query->row();	
	}

    public function update_ip($userid)
    {
        $this->db->set('login_ip',$_SERVER['REMOTE_ADDR']);   
        $this->db->where('userid',$userid);   
        $query=$this->db->update('admin_users');    
        return $this->db->affected_rows();
    }
	public function getTotalConfirmed($id, $data)
    {

        $this->db->select('*');
        $this->db->where('user_id',$id);
        $this->db->where('status',1);
        if(!empty($data['start']))
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($data['start'])));
        }
        if(!empty($data['end']))
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($data['end'])));
        }
        $this->db->from('requests');
        $query=$this->db->get();
        
        return $query->num_rows();
    }
    public function getTotalDeclined($id, $data)
    {
        $this->db->select('*');
        $this->db->where('user_id',$id);
        $this->db->where('status',0);
        if(!empty($data['start']))
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($data['start'])));
        }
        if(!empty($data['end']))
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($data['end'])));
        }
        $this->db->from('requests');
        $query=$this->db->get();
        return $query->num_rows();
    }
    public function getTotalConfirmedAmount($id, $data)
    {
        $this->db->select_sum('confirmDeposit');
        $this->db->where('user_id',$id);
        $this->db->where('status',1);
        if(!empty($data['start']))
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($data['start'])));
        }
        if(!empty($data['end']))
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($data['end'])));
        }
        $this->db->from('requests');
        $query=$this->db->get();
        return $query->row();
    }
    public function getTotalDeclinedAmount($id, $data)
    {
        $this->db->select_sum('deposit_amount');
        $this->db->where('user_id',$id);
        $this->db->where('status',0);
        if(!empty($data['start']))
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($data['start'])));
        }
        if(!empty($data['end']))
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($data['end'])));
        }
        $this->db->from('requests');
        $query=$this->db->get();
        return $query->row();
    }
	public function getAlluserReports()
    {
        $this->db->select('admin_users.* , COUNT(cf.id) as numberOfConfirmations, SUM(cf.deposit_amount) as totalConfirmedAmount, COUNT(df.id) as numberOfDeclined, SUM(df.deposit_amount) as totalDeclinedAmount');
//        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->join('requests as cf', 'admin_users.userid = cf.user_id', 'left');
        $this->db->join('requests as df', 'cf.user_id = df.user_id', 'left');
        $this->db->where('cf.status', 1);
        $this->db->where('df.status', 0);
        $this->db->order_by('userid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_permissions($userid)
    {
        $this->db->select('*');
        $this->db->where('userid',$userid);
        $this->db->from('permissions');
        $query=$this->db->get();
        return $query->row();
    }
	public function get_user($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);		
		$query=$this->db->get('admin_users');	
		return $query->row();	
	}	
	public function update_password($email, $new_password)
	{
		$hash_pass="password('".$new_password."')";
		$this->db->set('password',$hash_pass, FALSE);	
		$this->db->where('email',$email);		
		$query=$this->db->update('admin_users');	
		return $this->db->affected_rows();
	}
	public function check_email($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$query = $this->db->get('admin_users');
		return $query->num_rows();
	}

	public function set_admin_password($email, $new_password)
	{
		$hash_pass="password('".$new_password."')";
		$this->db->set('password',$hash_pass, FALSE);	
		$this->db->where('email',$email);	
		$query=$this->db->update('admin_users');	
		return $this->db->affected_rows();
	}

    function login_log($userid){
        $data = array(
            'user_id' =>$userid,
            'login_time' =>date('Y-m-d H:i:s'),
            'ip' =>$_SERVER['REMOTE_ADDR']
        );
        $this->db->insert('admin_logs', $data);
        return $this->db->insert_id();
    }

    function logout_log(){
        $id = $this->session->userdata('admin_log_id');
        $this->db->set('logout_time', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $this->db->update('admin_logs');
    }	

    public function get_login_log()
    {
        $this->db->select('u.username, a.login_time, a.logout_time, a.ip');
        $this->db->from('admin_logs as a');
        $this->db->join('admin_users as u', 'u.userid = a.user_id', 'left');
        $this->db->order_by('a.id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }

}

?>