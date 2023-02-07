<?php 
class Dashboard_model extends CI_Model
{

	public function count_today_order () {
		$curr_date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('sales');
		$this->db->where('DATE(sold_date)', $curr_date);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_requests ($start, $end) {
        $curr_date = date('Y-m-d');
	    $this->db->select('*');
		$this->db->from('requests');
        if ($start)
        {
            $this->db->where('Date(created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(created_at) <=', date("Y-m-d", strtotime($end)));
        }
        else
        {
            $this->db->where('Date(created_at)', $curr_date);
        }
		$query = $this->db->get();
		return $query->result_array();
	}
    public function get_pending_request ($start, $end) {
        $this->db->select('*');
        $this->db->from('requests');
        if ($start)
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $this->db->where('status', 3);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_process_request ($start, $end) {
        $this->db->select('*');
        $this->db->from('requests');
        if ($start)
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $this->db->where('status', 2);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_complete_request ($start, $end) {
        $this->db->select('*');
        $this->db->from('requests');
        if ($start)
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_decline_request ($start, $end) {
        $this->db->select('*');
        $this->db->from('requests');
        if ($start)
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_total_banks ($start, $end) {
        $this->db->select('*');
        $this->db->from('bank');
        if ($start)
        {
            $this->db->where('Date(bank.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(bank.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_active_banks ($start, $end) {
        $this->db->select('*');
        $this->db->from('bank');
        if ($start)
        {
            $this->db->where('Date(bank.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(bank.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_total_deposit ($start, $end) {
        $this->db->select('*');
        $this->db->from('deposit_type');
        if ($start)
        {
            $this->db->where('Date(deposit_types.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(deposit_types.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_total_users ($start, $end) {
        $this->db->select('*');
        $this->db->from('admin_users');
        if ($start)
        {
            $this->db->where('Date(admin_users.created_at) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(admin_users.created_at) <=', date("Y-m-d", strtotime($end)));
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

//	public function get_incomes () {
//		$curr_date = date('Y-m-d');
//		$this->db->select('sales.*, sold_products.*');
//		$this->db->from('sales');
//		$this->db->join('sold_products', 'sales.id = sold_products.sale_id', 'left');
//    	$this->db->where('DATE(sales.sold_date)', $curr_date);
//		$query = $this->db->get();
//		return $query->result_array();
//	}

	public function getAllClients(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role', 'client');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAllBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAllPendingBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAllAssignedBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAllCompletedBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('status', 3);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAllCancelledBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('status', 2);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_users()
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();

	}				
	public function get_notifications()
	{
		$this->db->select('notification.*');
		$this->db->select('users.first_name');
		$this->db->select('users.last_name');
		$this->db->select('admin_messages.message');
		$this->db->from('notification');
		$this->db->join('admin_messages', 'notification.message_id = admin_messages.id', 'left');
		$this->db->join('users', 'notification.n_from = users.id', 'left');
		$this->db->where("notification.for_admin",1);
		$this->db->order_by("notification.id","desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function count_unread_notifications()
	{
		$this->db->select('*');
		$this->db->from('notification');
		$this->db->where("for_admin",1);
		$this->db->where('is_admin_notified',0);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function total_notifications()
	{
		$this->db->select('*');
		$this->db->where("for_admin",1);
		$this->db->from('notification');
		$query = $this->db->get();
		return $query->num_rows();;
	}
	public function read_admin_notifications()
	{
		$this->db->set('is_admin_notified',1);
		$this->db->where("for_admin",1);
		$this->db->update('notification');
		return $this->db->affected_rows();
	}
	public function get_expenses_by_month($date) {
		$this->db->select('*');
		$this->db->from('expenses');
		$this->db->where('month', date("m" , strtotime($date)));
		$result = $this->db->get()->result_array();
		return $result;
	}
}

?>