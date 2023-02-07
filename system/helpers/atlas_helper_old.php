<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* End of file connect_helper.php */
/* Location: ./system/helpers/array_helper.php */
if (!function_exists('getProductQty')) {
	function getProductQty($product_id){
		$CI =& get_instance();
		$CI->db->select('SUM(qty) AS purchased_qty');
		$CI->db->from('purchased_products');
		$CI->db->where('product_id' , $product_id);
		$query = $CI->db->get();
		$purchased_products = $query->result_array();

		$CI->db->select('SUM(qty) AS sold_qty');
		$CI->db->from('sold_products');
		$CI->db->where('product_id' , $product_id);
		$query = $CI->db->get();
		$sold_products = $query->result_array();
		
		$qty = $purchased_products[0]['purchased_qty']-$sold_products[0]['sold_qty'];
		return $qty;
	}
}

if (!function_exists('getSoldProductQty')) {
	function getSoldProductQty($product_id, $sale_id){
		$CI =& get_instance();
		$CI->db->select('qty');
		$CI->db->from('sold_products');
		$CI->db->where('product_id' , $product_id);
		$CI->db->where('sale_id' , $sale_id);
		$query = $CI->db->get();
		$sold_products = $query->result_array();
		if ($sold_products) {
			$qty = $sold_products[0]['qty'];
		}else {
			$qty = 0;
		}
		return $qty;
	}
}

if ( ! function_exists('admin_url'))
{
	function admin_url()
	{
		$CI = get_instance();
		return $CI->config->item('admin_url');
	}

}

if ( ! function_exists('admin_controller'))
{
	function admin_controller()
	{
		$CI = get_instance();
		return $CI->config->item('admin_controller');
	}

}

if ( ! function_exists('employee_url'))
{
	function employee_url()
	{
		$CI = get_instance();
		return $CI->config->item('employee_url');
	}

}

if ( ! function_exists('employee_controller'))
{
	function employee_controller()
	{
		$CI = get_instance();
		return $CI->config->item('employee_controller');
	}

}


if ( ! function_exists('get_purchased_products'))
{
	function get_purchased_products($purchases_id)
	{
		$CI = get_instance();
		$CI->load->model('admin/purchase_model');
		return $CI->purchase_model->get_purchased_products($purchases_id);
		
	}

}
if ( ! function_exists('admin_email'))
{
	function admin_email()
	{
		$CI = get_instance();
		return $CI->config->item('admin_email');
	}
}
if ( ! function_exists('getDataFromDB'))
{
	function getDataFromDB($columns, $table, $where = '', $order = ''){
		$CI =& get_instance();
		$CI->db->select($columns);
		$CI->db->from($table);
		if (!empty($where)) {
			$CI->db->where($where);
		}
		if (!empty($order)) {
			$CI->db->order_by($order);
		}
		$query = $CI->db->get();
		return $query->result_array();
	}
}


if ( ! function_exists('show'))
{
	function show($data){
		echo "<pre>";
		print_r($data);
	}
}

if ( ! function_exists('getServiceRate'))
{
	function getServiceRate($service_id){
		$CI =& get_instance();
		$user = $CI->session->userdata('users');
		$CI->db->select('rate');
		$CI->db->where('service_id', $service_id);
		$CI->db->where('user_id', $user['user_id']);
		$CI->db->from('user_services');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['rate'];
	}
}

if ( ! function_exists('count_unread_notifications'))
{
	function count_unread_notifications()
	{
		$CI = get_instance();
		$CI->load->model('admin/dashboard_model');
		return $CI->dashboard_model->count_unread_notifications();
	}

}
if ( ! function_exists('total_notifications'))
{
	function total_notifications()
	{
		$CI = get_instance();
		$CI->load->model('admin/dashboard_model');
		return $CI->dashboard_model->total_notifications();
		
	}

}
if ( ! function_exists('admin_notifications'))
{
	function admin_notifications()
	{
		$CI = get_instance();
		$CI->load->model('admin/dashboard_model');
		$notifications = $CI->dashboard_model->get_notifications();
		$i = 0;
		$new_array = array();
		foreach($notifications as $notification) {	
			$old_msg = $notification['message'];

			$patterns = array();
			$patterns[0] = '/#THERAPIST#/';
			$patterns[1] = '/#BOOKINGID#/';
			$replacements = array();
			$replacements[0] = $notification['first_name']." ".$notification['last_name'];
			$replacements[1] = $notification['booking_id'];
			

			$string = preg_replace($patterns, $replacements, $old_msg); 
			$notification['message'] = $string;
			$new_array[$i] = $notification;
			$i++;
		}
		$data['notifications'] = $new_array;

		$response =  $CI->load->view('admin/notification_ajax',$data,TRUE);
		return $response;
		
	}

}
if ( ! function_exists('count_admin_notifications'))
{
	function count_admin_notifications()
	{
		$CI = get_instance();
		$CI->load->model('admin/admin_model');
		return $CI->admin_model->count_notifications();
		
	}

}

if ( ! function_exists('get_timeago'))
{
	function get_timeago( $ptime )
	{
		$estimate_time = time() - $ptime;

		if( $estimate_time < 1 )
		{
			return 'less than 1 second ago';
		}

		$condition = array(
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60                 =>  'hour',
			60                      =>  'minute',
			1                       =>  'second'
		);

		foreach( $condition as $secs => $str )
		{
			$d = $estimate_time / $secs;

			if( $d >= 1 )
			{
				$r = round( $d );
				return ''. $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
			}
		}
	}
}


if ( ! function_exists('total_therapist_notifications'))
{
	function total_therapist_notifications()
	{
		$CI = get_instance();
		$CI->load->model(therapist_controller().'therapist_model');
		return $CI->therapist_model->total_notifications();
		
	}

}
if ( ! function_exists('therapist_notifications'))
{
	function therapist_notifications()
	{
		$CI = get_instance();
		$CI->load->model(therapist_controller().'therapist_model');
		$notifications = $CI->therapist_model->get_therapist_notifications();
		$i = 0;
		$new_array = array();
		foreach($notifications as $notification) {	
			$old_msg = $notification['message'];

			$patterns = array();
			$patterns[0] = '/#BOOKINGID#/';
			$replacements = array();
			$replacements[0] = $notification['booking_id'];
			

			$string = preg_replace($patterns, $replacements, $old_msg); 
			$notification['message'] = $string;
			$new_array[$i] = $notification;
			$i++;
		}
		$data['notifications'] = $new_array;

		$response =  $CI->load->view('therapist/notification_ajax',$data,TRUE);
		return $response;
		
	}

}
if ( ! function_exists('count_therapist_notifications'))
{
	function count_therapist_notifications()
	{
		$CI = get_instance();
		$CI->load->model(therapist_controller().'therapist_model');
		return $CI->therapist_model->count_notifications();
		
	}

}

if ( ! function_exists('getServiceRate'))
{
	function getServiceRate($service_id, $therapist_id){
		$CI = get_instance();
		$CI->db->select('*');
		$CI->db->from('user_services');
		$CI->db->where('user_id', $therapist_id);
		$CI->db->where('service_id', $service_id);
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['rate'];
	}
}