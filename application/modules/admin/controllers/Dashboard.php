<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model(admin_controller().'dashboard_model');
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}	
	}

	public function index()
	{
        if (isset($_POST['start'])) {
            $start_date = $_POST['start'];
        } else {
            $start_date = null;
        }
        if (isset($_POST['end'])) {
            $end_date = $_POST['end'];
        } else {
            $end_date = null;
        }
        if (isset($_POST['statStart'])) {
            $stat_start_date = $_POST['statStart'];
        } else {
            $stat_start_date = null;
        }
        if (isset($_POST['statEnd'])) {
            $stat_end_date = $_POST['statEnd'];
        } else {
            $stat_end_date = null;
        }

        $data['requests'] = $this->dashboard_model->get_requests($start_date,$end_date);

		$data['pendingRequest'] = $this->dashboard_model->get_pending_request($stat_start_date, $stat_end_date);
        $data['processedRequest'] = $this->dashboard_model->get_process_request($stat_start_date, $stat_end_date);
        $data['confirmedRequest'] = $this->dashboard_model->get_complete_request($stat_start_date, $stat_end_date);
        $data['declinedRequest'] = $this->dashboard_model->get_decline_request($stat_start_date, $stat_end_date);
        $data['banks'] = $this->dashboard_model->get_total_banks($stat_start_date, $stat_end_date);
        $data['activeBanks'] = $this->dashboard_model->get_active_banks($stat_start_date, $stat_end_date);
        $data['depositOptions'] = $this->dashboard_model->get_total_deposit($stat_start_date, $stat_end_date);
        $data['users'] = $this->dashboard_model->get_total_users($stat_start_date, $stat_end_date);
		$this->load->view('dashboard', $data);
	}

	public function today_stops()
	{	
		$data['routes'] = $this->dashboard_model->today_routes();
		// print_r($data['routes']);
		// exit();
		$this->load->view('today_stops', $data);
	}
	public function selected_stops()
	{
		$data['routes'] = $this->dashboard_model->today_routes();
		// print_r($data['routes']);
		// exit();
		$this->load->view('selected_stops', $data);
	}
	public function notselected_stops()
	{
		$data['routes'] = $this->dashboard_model->today_routes();
		$this->load->view('notselected_stops', $data);
	}

	public function assign_pickup()
	{
		$data = $_POST;
		$status = $this->dashboard_model->check_availability($data);
		if($status == 0){
			$res = $this->dashboard_model->select_clinic($data);
			if ($res) {
				$finalResult = array('msg' => 'success', 'response'=>'Successfully Selected.');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'Unable to select clinic reload window and try again.');
				echo json_encode($finalResult);
				exit;
			}
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to select clinic reload window and try again.');
			echo json_encode($finalResult);
			exit;
		}
	}
	public function unassign_pickup()
	{
		$data = $_POST;
		$status = $this->dashboard_model->unassign_pickup($data);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Successfully unassigned.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to unassigned clinic try again.');
			echo json_encode($finalResult);
			exit;
		}

	}


	public function pending_stops()
	{	
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$data['reports'] = $this->report_model->pending_stops($data);
		//print_r($data['reports']);
		//$data['territories'] =  $this->report_model->get_territories();
		$this->load->view('pending_stops', $data);
	}
	public function picked_stops()
	{	
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$data['reports'] = $this->report_model->picked_stops($data);
		//print_r($data['reports']);
		//$data['territories'] =  $this->report_model->get_territories();
		$this->load->view('picked_stops', $data);
	}



	public function refresh_admin_notifications()
	{
		$notification = admin_notifications();
		$finalResult = array('notification'=> $notification);
		echo json_encode($finalResult);
		exit;
	}
	public function read_admin_notifications()
	{
		$status =  $this->dashboard_model->read_admin_notifications();
		if($status){
			$finalResult = array('msg' => 'success');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function admin_profile()
	{
		$this->load->view('profile');
	}
	public function get_sales_by_month()
	{
		$date = $_POST['date'];

		$data['expense_of_month'] = $this->dashboard_model->get_expenses_by_month($date);
		$sum = 0;

		if (!empty($data['expense_of_month'])) {

			foreach ($data['expense_of_month'] as $value) {

				$data['expence_name'] = $this->expense_model->get_expenses_name_by_id($value['type_id']);
				$sum += $value['amount'];

				$res_array[] = array(
					'msg' => 'success',
					'Category' => $data['expence_name'],
					'Description' => $value['description'],
					'Amount' => $value['amount'],
					'total_expense_of_month' => $sum,
					'response' => 'Expence of month'
				);

			}

			echo json_encode($res_array);
			exit;

		} else {
			$res_array[] = array(
				'msg' => 'success',
				'response' => 'Empty expenses'
			);
			echo json_encode($res_array);
			exit;
		}


	}

}