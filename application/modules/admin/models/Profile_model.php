<?php 
class Profile_model extends CI_Model
{
	
	public function check_password_exist ($data) {
		$user_id = $this->session->userdata('admin_id');
		$hash_pass="password('".trim($data['old_password'])."')";

		$this->db->select('*');
		$this->db->where('password',$hash_pass,FALSE);
		$this->db->where('userid', $user_id);
		$this->db->from('admin_users');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function change_admin_password($data)
   {
		$hash_pass="password('".$data['password']."')";
		$this->db->set('password',$hash_pass, FALSE);
		$this->db->where('userid', $this->session->userdata('admin_id'));
		$result = $this->db->update('admin_users');
		return $this->db->affected_rows();
	}
}

?>