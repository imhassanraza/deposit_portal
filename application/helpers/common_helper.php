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

if ( ! function_exists('fb_login'))
{
	function fb_login()
	{
		$CI = get_instance();
		return $CI->facebook->login_url();
	}

}

if ( ! function_exists('get_session'))
{
	function get_session($session_name)
	{
		$CI = get_instance();
		return $CI->session->userdata($session_name);
	}

}
if ( ! function_exists('set_session'))
{
	function set_session($session_name, $value)
	{
		$CI = get_instance();
		return $CI->session->set_userdata($session_name, $value);
	}

}
if ( ! function_exists('unset_session'))
{
	function unset_session($session_name)
	{
		$CI = get_instance();
		return $CI->session->unset_userdata($session_name);
	}
}
if ( ! function_exists('admin_email'))
{
	function admin_email()
	{
		return get_section_content('contactus' , 'contactus_email');
	}
}


if ( ! function_exists('show'))
{
	function show($data){
		echo "<pre>";
		print_r($data);
	}
}


if ( ! function_exists('dorage_url_title'))
{
	function dorage_url_title($str, $separator = 'dash', $lowercase = FALSE)
	{

		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
			'&\#\d+?;'				=> '',
			'&\S+?;'				=> '',
			'\s+'					=> $replace,
			$replace.'+'			=> $replace,
			$replace.'$'			=> $replace,
			'^'.$replace			=> $replace,
			'\.+$'					=> ''
		);

		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		$str = str_replace('&','and',$str);
		$str = str_replace(' ','-',$str);
		$str = str_replace('/','-',$str);
		$str = str_replace('?','-',$str);
		$str = str_replace(',','',$str);
		$str = str_replace('(','',$str);
		$str = str_replace(')','',$str);
		$str = str_replace('+','',$str);
		$str = str_replace("'",'',$str);

		return trim(stripslashes($str));
	}
}

if ( ! function_exists('get_list_image'))
{
	function get_list_image($listings_id)
	{
		$CI = get_instance();
		$CI->load->model('home/home_model');
		$image = $CI->home_model->get_list_image($listings_id);

		if (empty($image)) {
			return "no-image.jpg";
		}
		return $image;
	}
}
if ( ! function_exists('get_meta_value'))
{
	function get_meta_value($meta_key , $listings_id)
	{
		$CI =& get_instance();
		$CI->db->select('meta_value');
		$CI->db->where('meta_key', $meta_key);
		$CI->db->where('listings_id',$listings_id);
		$CI->db->from('listings_meta');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['meta_value'];
	}
}

if ( ! function_exists('get_favourite'))
{
	function get_favourite()
	{
		$CI =& get_instance();
		$CI->db->select('listings.*');
		$CI->db->from('favourite');
		$CI->db->join('listings' , 'favourite.listings_id = listings.id' ,'left');
		$CI->db->where('favourite.users_id' , $CI->session->userdata('user_id'));
		$query = $CI->db->get();
		return  $query->result_array();
	}
}


if ( ! function_exists('get_similar_lists'))
{
	function get_similar_lists($id,$latitude,$longitude,$sizetype,$storagetype,$roomspace)
	{
		$CI =& get_instance();
		$CI->db->select('id');

		if($latitude != ''){
			$CI->db->select('(3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance');            
			$CI->db->having('distance <=',15);  
		}
		$CI->db->where('list_type' , 0);
		$CI->db->where('id !=' ,$id);
		$query = $CI->db->get('listings');

		$listingsids = $query->result_array();

		$listings_arr1 = array();
		$listings_arr1[] = 0;


		foreach ($listingsids as $list) {
			$listings_arr1[] = $list['id'];
		}

		$listings_arr5 = $listings_arr1;


		$CI->db->select('listings_id');
		$CI->db->where('meta_key' , 'storage_size_type');
		$CI->db->where('meta_value' , $sizetype);
		if (!empty($listings_arr5)) {
			$CI->db->where_in('listings_id' , $listings_arr5);
		}
		$query = $CI->db->get('listings_meta');
		$sizetypeids = $query->result_array();

		$listings_arr2 = array();
		$listings_arr2[] = 0;

		foreach ($sizetypeids as $list) {
			$listings_arr2[] = $list['listings_id'];
		}

		$listings_arr5 = $listings_arr2;


		$CI->db->select('listings_id');
		$CI->db->where('meta_key' , 'space_storage_type');
		$CI->db->where('meta_value' , $storagetype);
		if (!empty($listings_arr5)) {
			$CI->db->where_in('listings_id' , $listings_arr5);
		}
		$query = $CI->db->get('listings_meta');
		$spacetypeids = $query->result_array();

		$listings_arr3 = array();
		$listings_arr3[] = 0;

		foreach ($spacetypeids as $list) {
			$listings_arr3[] = $list['listings_id'];
		}

		$listings_arr5 = $listings_arr3;


		$CI->db->select('listings_id');
		$CI->db->where('meta_key' , 'room_space_character');
		$CI->db->where('meta_value' , $roomspace);
		if (!empty($listings_arr5)) {
			$CI->db->where_in('listings_id' , $listings_arr5);
		}
		$query = $CI->db->get('listings_meta');
		$chartypeids = $query->result_array();

		$listings_arr4 = array();
		$listings_arr4[] = 0;

		foreach ($chartypeids as $list) {
			$listings_arr4[] = $list['listings_id'];
		}

		$listings_arr5 = $listings_arr4;


		$CI->db->select("listings.*");
		$CI->db->from("listings");
		
		$CI->db->join('users', 'users.id = listings.users_id ', 'left');
		$CI->db->where('users.status',1);
		$CI->db->where('users.is_banned',0);

		$CI->db->where('listings.is_published' , 1);
		$CI->db->where('listings.status' , 1);
		$CI->db->where('listings.is_banned',0);
		$CI->db->where('listings.list_type' , 0);
		$CI->db->where_in('listings.id' ,$listings_arr5);
		$query = $CI->db->get();
		return  $query->result_array();
	}
}

if ( ! function_exists('get_paypal_email'))
{
	function get_paypal_email()
	{
		$CI =& get_instance();
		$CI->db->select('paypal_email');
		$CI->db->from('users');
		$CI->db->where('id' , get_session('user_id'));
		$query = $CI->db->get()->row_array();
		return  $query['paypal_email'];
		
	}
}

if ( ! function_exists('get_storage_size_types'))
{
	function get_storage_size_types()
	{
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('storage_size_types');
		$CI->db->where('status' , 1);
		$CI->db->where('is_deleted' , 0);
		$query = $CI->db->get();
		return  $query->result_array();
		
	}
}
if ( ! function_exists('get_count_users'))
{
	function get_count_users($status)
	{
		$CI =& get_instance();
		return $CI->db->where(['status'=>$status])->from("users")->count_all_results();
	}
}
if ( ! function_exists('get_active_lists'))
{
	function get_active_lists()
	{
		$CI =& get_instance();
		return $CI->db->where(['list_type'=>0,'is_published'=>1,'status'=>1,'is_banned'=>0])->from("listings")->count_all_results();
	}
}
if ( ! function_exists('get_inactive_lists'))
{
	function get_inactive_lists()
	{
		$CI =& get_instance();
		return $CI->db->where(['list_type'=>0,'is_published'=>1,'status'=>0,'is_banned'=>0])->from("listings")->count_all_results();
	}
}
if ( ! function_exists('get_inactive_movers'))
{
	function get_inactive_movers()
	{
		$CI =& get_instance();
		return $CI->db->where(['list_type'=>1,'is_published'=>1,'status'=>0,'is_banned'=>0])->from("listings")->count_all_results();
	}
}
if ( ! function_exists('get_active_movers'))
{
	function get_active_movers()
	{
		$CI =& get_instance();
		return $CI->db->where(['list_type'=>1,'is_published'=>1,'status'=>1,'is_banned'=>0])->from("listings")->count_all_results();
	}
}
if ( ! function_exists('get_active_bookings'))
{
	function get_active_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id !='=>0,'booking_status'=>1,'payment_status'=>1])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_completed_bookings'))
{
	function get_completed_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id !='=>0,'booking_status'=>2,'payment_status'=>1])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_cancelled_bookings'))
{
	function get_cancelled_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id !='=>0,'booking_status'=>3,'payment_status'=>1])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_refunded_bookings'))
{
	function get_refunded_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id !='=>0,'booking_status'=>4,'payment_status'=>1])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_active_mover_bookings'))
{
	function get_active_mover_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id'=>0,'booking_status'=>1,'payment_status'=>1,'parent_id'=>0])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_cancelled_mover_bookings'))
{
	function get_cancelled_mover_bookings()
	{
		$CI =& get_instance();
		return $CI->db->where(['listings_id'=>0,'booking_status'=>3,'payment_status'=>1,'parent_id'=>0])->from("bookings")->count_all_results();
	}
}
if ( ! function_exists('get_size_type'))
{
	function get_size_type($id)
	{
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id',$id);
		$CI->db->from('storage_size_types');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['name'];
	}
}
if ( ! function_exists('get_storage_type'))
{
	function get_storage_type($id)
	{
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id',$id);
		$CI->db->from('space_storage_types');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['name'];
	}
}
if ( ! function_exists('get_room_space_character'))
{
	function get_room_space_character($id)
	{
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id',$id);
		$CI->db->from('room_space_character');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['name'];
	}
}
if ( ! function_exists('get_cancellation_policy'))
{
	function get_cancellation_policy($id)
	{
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id',$id);
		$CI->db->from('cancellation_policies');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['name'];
	}
}

if ( ! function_exists('get_owner_detail'))
{
	function get_owner_detail($id)
	{
		$CI =& get_instance();
		$CI->db->select('first_name,last_name,email,phone,profile_dp');
		$CI->db->where('id',$id);
		$CI->db->from('users');
		$query = $CI->db->get();
		return $query->row_array();
	}
}
if ( ! function_exists('get_time_difference'))
{
	function get_time_difference($time1)
	{

		$parking_start = date_create(date('Y-m-d G:i:s', strtotime($time1)));
		$parking_end = date_create(date('Y-m-d G:i:s', strtotime(date('Y-m-d h:i:s'))));
		$interval = date_diff($parking_start, $parking_end);
		$day = $interval->format('%a');

		return $day*24;

	}
}

if ( ! function_exists('get_section_content'))
{
	function get_section_content($page , $meta_key)
	{
		$CI =& get_instance();
		$CI->db->select('meta_value');
		$CI->db->where('page', $page);
		$CI->db->where('meta_key',$meta_key);
		$CI->db->from('settings');
		$query = $CI->db->get();
		$query = $query->row_array();
		return $query['meta_value'];
	}
}

if ( ! function_exists('is_favourite'))
{
	function is_favourite($listings_id)
	{
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->where('listings_id',$listings_id);
		$CI->db->where('users_id',$CI->session->userdata('user_id'));
		$CI->db->from('favourite');
		$query = $CI->db->get();
		$query = $query->row_array();
		if (!empty($query)) {
			return 1;
		} else {
			return 0;
		}
	}
}
if ( ! function_exists('notify_by'))
{
	function notify_by()
	{
		$CI =& get_instance();
		$CI->db->select('notify_by');
		$CI->db->where('users_id',$CI->session->userdata('user_id'));
		$CI->db->from('notification');
		$query = $CI->db->get();
		$query = $query->row_array();
		if (!empty($query)) {
			return $query['notify_by'];
		} else {
			return 3;
		}
	}
}

if ( ! function_exists('list_title'))
{
	function list_title($listings_id)
	{
		$CI =& get_instance();
		$CI->db->select('title');
		$CI->db->from('listings');
		$CI->db->where('id' ,$listings_id);
		$query = $CI->db->get()->row_array();
		return  $query['title'];
	}
}

if ( ! function_exists('singleRow'))
{
	function singleRow($table, $select_col, $where_arr = '') {
		$CI = & get_instance();

		$CI->db->select($select_col);
		$CI->db->from($table);
		if ($where_arr != '') {
			$CI->db->where($where_arr);
		}
		$query = $CI->db->get();
		return $query->row_array();
	}
}

if ( ! function_exists('getRecentChats'))
{
	function getRecentChats(){
		$CI =& get_instance();
		$query = $CI->db->query('Select IF(chat_from = '.get_session('user_id').', chat_to, chat_from) AS chatter_id from chat WHERE (chat_from = '.get_session('user_id').' OR  chat_to = '.get_session('user_id').') GROUP BY chatter_id ORDER BY sent  DESC ');
		$chatter_ids = $query->result_array();
		$recentChats = array();
		foreach ($chatter_ids as $key => $chatter) {
			$CI->db->select('c.*, concat(u.first_name," ",u.last_name) as username, u.profile_dp, concat(u2.first_name," ",u2.last_name) as username_other, u2.profile_dp as profile_dp_other, l.title as listing_title');
			$CI->db->from('chat c');
			$CI->db->join('users u', 'u.id = c.chat_from', 'left');
			$CI->db->join('users u2', 'u2.id = c.chat_to', 'left');
			$CI->db->join('listings l', 'l.unique_id = c.listing_unique_id', 'left');
			$CI->db->where('(c.chat_from = '.get_session('user_id').' and c.chat_to = '.$chatter['chatter_id'].')');
			$CI->db->or_where('(c.chat_from = '.$chatter['chatter_id'].' and c.chat_to = '.get_session('user_id').')');
			$CI->db->order_by('c.sent', 'desc');
			$query = $CI->db->get();
			$recentChats[$key] = $query->row_array();
		}
		return $recentChats;
	}
}

if ( ! function_exists('getMessageDateTime')){
	function getMessageDateTime($ts){
		$date = strtotime(date('Y-m-d', $ts));
		$today = strtotime(date('Y-m-d'));
		$yesterday = strtotime(date('Y-m-d', strtotime('-1 days')));
		if ($date == $today) {
			return date('h:i A', $ts). ", Today";
		}else if($date == $yesterday){
			return date('h:i A', $ts). ", Yesterday";
		}else{
			return date('h:i A', $ts). ", ". date('F d, Y', $ts);
		}
	}
}

if ( ! function_exists('getUnreadMessagesCount')){
	function getUnreadMessagesCount(){
		$CI =& get_instance();

		$CI->db->select('*');
		$CI->db->from('chat');
		$CI->db->where('chat_to', get_session('user_id'));
		$CI->db->where('chat_read', '0');
		$query = $CI->db->get();
		return $query->num_rows();
	}
}

if (!function_exists('getListingReviews')) {
	function getListingReviews($id, $type = ''){
		$CI =& get_instance();

		$CI->db->select('concat(u.first_name, " ", u.last_name) as username, u.profile_dp ,br.*');
		$CI->db->from('bookings_rating br');
		$CI->db->join('bookings b', 'br.bookings_id = b.id', 'left');
		if (empty($type)) {
			$CI->db->join('listings l', 'l.id = b.listings_id', 'left');
		}else{
			$CI->db->join('listings l', 'l.id = b.mover_id', 'left');
		}
		$CI->db->join('users u', 'u.id = br.users_id', 'left');
		$CI->db->where('l.id', $id);
		$CI->db->order_by('br.date_added', 'desc');
		$query = $CI->db->get();
		$reviews = $query->result_array();
		// foreach ($reviews as $key => $review) {
		// 	$CI->db->select('concat(u.first_name, " ", u.last_name) as username, u.profile_dp ,lr.*');
		// 	$CI->db->from('listing_reviews lr');
		// 	$CI->db->join('users u', 'u.id = lr.user_id', 'left');
		// 	$CI->db->where('lr.parent_id', $review['id']);
		// 	$CI->db->order_by('lr.date_added', 'desc');
		// 	$query = $CI->db->get();
		// 	$reviews[$key]['reply'] = $query->result_array();
		// }
		// echo "<pre>";
		// print_r($reviews);exit;
		return $reviews;
	}
}

if (!function_exists('getListingReviews2')) {
	function getListingReviews2($id){
		$CI =& get_instance();

		$CI->db->select('concat(u.first_name, " ", u.last_name) as username, u.profile_dp ,lr.*');
		$CI->db->from('listing_reviews lr');
		$CI->db->join('users u', 'u.id = lr.user_id', 'left');
		$CI->db->where('lr.listing_id', $id);
		$CI->db->where('lr.parent_id', 0);
		$CI->db->order_by('lr.date_added', 'desc');
		$query = $CI->db->get();
		$reviews = $query->result_array();
		foreach ($reviews as $key => $review) {
			$CI->db->select('concat(u.first_name, " ", u.last_name) as username, u.profile_dp ,lr.*');
			$CI->db->from('listing_reviews lr');
			$CI->db->join('users u', 'u.id = lr.user_id', 'left');
			$CI->db->where('lr.parent_id', $review['id']);
			$CI->db->order_by('lr.date_added', 'desc');
			$query = $CI->db->get();
			$reviews[$key]['reply'] = $query->result_array();
		}
		// echo "<pre>";
		// print_r($reviews);exit;
		return $reviews;
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

if (!function_exists('getUserReview')) {
	function getUserReview($booking_id){
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('bookings_rating');
		$CI->db->where('bookings_id', $booking_id);
		$CI->db->where('users_id', get_session('user_id'));
		$query = $CI->db->get();
		return $query->row_array();
	}
}

if (!function_exists('getListingRating')) {
	function getListingRating($listing_id, $type = ''){
		$CI =& get_instance();
		$CI->db->select('count(br.id) as total_reviews, sum(br.stars) as total_stars');
		$CI->db->from('bookings_rating br');
		$CI->db->join('bookings b', 'b.id = br.bookings_id', 'left');
		if (empty($type)) {
			$CI->db->join('listings l', 'l.id = b.listings_id', 'left');
		}else{
			$CI->db->join('listings l', 'l.id = b.mover_id', 'left');			
		}
		$CI->db->where('l.id', $listing_id);
		$CI->db->group_by('l.id');
		$query = $CI->db->get();
		$record = $query->row_array();
		if (empty($record)) {
			return array(
				'total_reviews' => 0,
				'total_stars' => 0
			);
		}else{
			$return = array(
				'total_reviews' => $record['total_reviews'],
				'total_stars' => ($record['total_stars']/$record['total_reviews'])
			);
			return $return;
		}
	}
}

if (!function_exists('getMoverVehicle')) {
	function getMoverVehicle($listing_id){
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('mover_vehicles');
		$CI->db->where('listings_id' , $listing_id);
		return $CI->db->get()->result_array();
	}
}