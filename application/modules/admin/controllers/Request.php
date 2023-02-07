<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller().'request_model');
        $this->load->model(admin_controller().'admin_model');
        if(!$this->session->userdata('admin_logged_in'))
        {
            redirect(admin_url().'login');
        }
    }

    public function searchRequest()
    {
        $data = $_POST;
        $data['posted_data'] = $data;
        if($_POST) {
            $data['result'] = $this->request_model->search_requests($data);
            $data['banks'] = $this->request_model->get_all('bank');
            $data['despositTypes'] = $this->request_model->get_all('deposit_type');
            $data['users'] = $this->request_model->get_all('admin_users');
            $data['type'] = $data['requestType'];

            if($data['type'] == 'Confirmed') {
                $this->load->view('request/search_confirmed', $data);
            } else if($data['type'] == 'Declined') {
                $this->load->view('request/search_declined', $data);
            }
        } else {
            redirect(admin_url().'request/confirmedRequests');
        }
    }
    //Data Tables Ajax Calls Start
    public function search_pending()
    {
        $requests = $_POST['requests'];

        $data['pendingRequests'] = $this->request_model->get_requests(3);
        $htmlResponse = $this->load->view('request/pendingAjax', $data, TRUE);

        $previousarray = explode(',',$requests);

        $checkarray = array();
        foreach ($data['pendingRequests'] as $pendingReq) {
            $checkarray[] = $pendingReq['id']; 
        }

        $beepon = 0; 
        
        $checkdif = array_diff($checkarray, $previousarray);

        if(!empty($checkdif[0])) {
            $beepon = 1; 
        }

        $response_arr = array(
            'msg'=> 'success',
            'response'=> $htmlResponse,
            'beepalert' => $beepon
        );
        echo json_encode($response_arr);
    }

    public function search_processed()
    {
        $data['pendingRequests'] = $this->request_model->get_requests(2);
        $htmlResponse = $this->load->view('request/processedAjax', $data, TRUE);
        $response_arr = array(
            'msg'=> 'success',
            'response'=> $htmlResponse,
        );
        echo json_encode($response_arr);
    }
    public function search_confirmed()
    {
        $data['pendingRequests'] = $this->request_model->get_requests(1);
        $htmlResponse = $this->load->view('request/confirmedAjax', $data, TRUE);
        $response_arr = array(
            'msg'=> 'success',
            'response'=> $htmlResponse,
        );
        echo json_encode($response_arr);
    }
    public function search_declined()
    {
        $data['pendingRequests'] = $this->request_model->get_requests(0);
        $htmlResponse = $this->load->view('request/declinedAjax', $data, TRUE);
        $response_arr = array(
            'msg'=> 'success',
            'response'=> $htmlResponse,
        );
        echo json_encode($response_arr);
    }
    //Data Tables Ajax Calls End

    public function pendingRequests()
    {
        if(get_permission('pending_requests') == 0) {
            redirect(admin_url());
        }
        $data['banks'] = $this->request_model->get_all('bank');
        $data['despositTypes'] = $this->request_model->get_all('deposit_type');
        $data['users'] = $this->request_model->get_all('admin_users');
        $data['pendingRequests'] = $this->request_model->get_requests(3);
        $this->load->view('request/index', $data);
        //$this->load->view('request/pendingTest');
    }
    public function processedRequests()
    {
        if(get_permission('processed_requests') == 0) {
            redirect(admin_url());
        }

        $data['banks'] = $this->request_model->get_all('bank');
        $data['despositTypes'] = $this->request_model->get_all('deposit_type');
        $data['users'] = $this->request_model->get_all('admin_users');
        $data['pendingRequests'] = $this->request_model->get_requests(2);
        $this->load->view('request/process', $data);
    }
    public function confirmedRequests()
    {
        if(get_permission('completed_requests') == 0) {
            redirect(admin_url());
        }

        $data['banks'] = $this->request_model->get_all('bank');
        $data['despositTypes'] = $this->request_model->get_all('deposit_type');
        $data['users'] = $this->request_model->get_all('admin_users');
        $data['pendingRequests'] = $this->request_model->get_requests(1);
        $this->load->view('request/confirm', $data);
    }
    public function declinedRequests()
    {
        if(get_permission('declined_requests') == 0) {
            redirect(admin_url());
        }

        $data['banks'] = $this->request_model->get_all('bank');
        $data['despositTypes'] = $this->request_model->get_all('deposit_type');
        $data['users'] = $this->request_model->get_all('admin_users');
        $data['pendingRequests'] = $this->request_model->get_requests(0);
        $this->load->view('request/declined', $data);
    }

    public function viewProcess($id)
    {
        $data['request'] = $this->request_model->get_request_by_id($id);

        if(empty($data['request'])) {
            show_404();
        }
        $this->load->view('request/view_process', $data);
    }


    public function declined_by_client()
    {
        $this->load->view('request/declined_by_client');
    }


    public function checkRequestStatus()
    {
        $data = $_POST;
        $result = $this->request_model->check_request_status_by_transId($data);
        if ($result == 0) {
            $res_array = array('msg' => 'success');
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array('msg' => 'error');
            echo json_encode($res_array);
            exit;
        }
    }

    public function updateSms1Request()
    {
        $data = $_POST;
        $result = $this->request_model->get_request_by_trans_id($data['id']);
        if ($result)
        {
            if ($data['type'] == 1)
            {
                $changeStatus = $this->request_model->change_Sms_Status_by_trans_id('sms1',$data);
            }
            else
            {
                $changeStatus = $this->request_model->change_Sms_Status_by_trans_id('sms2',$data);
            }
            if ($changeStatus){
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'SMS Request Generated Successfully'
                );
                echo json_encode($res_array);
                exit;
            }
            else
            {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Woops!!! Already Request generated'
                );
                echo json_encode($res_array);
                exit;
            }
        }
    }


    public function updateTNORequest()
    {
        $data = $_POST;
        $result = $this->request_model->get_request_by_trans_id($data['id']);
        if ($result)
        {
            $changeStatus = $this->request_model->change_Sms_Status_by_trans_id('tc_no_status',$data);
            if ($changeStatus){
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Request Info Generated Successfully'
                );
                echo json_encode($res_array);
                exit;
            }
            else
            {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Woops!!! Already Request generated'
                );
                echo json_encode($res_array);
                exit;
            }
        }
    }

    public function pending($id)
    {
        $data['getDeclinedRequest'] = $this->request_model->get_request_by_id_status($id,0);
        if(empty($data['getDeclinedRequest'])){
            redirect(admin_url().'request/declinedRequests');
        }
        else
        {
            $changeStatus = $this->request_model->change_requestStatus_by_id($id,3);
            if ($changeStatus){
                redirect(admin_url().'request/declinedRequests');
            }
            else
            {
                redirect(admin_url().'request/declinedRequests');
            }
        }
    }

    public function checkTCNORequest()
    {
        $data = $_POST;
        $result = $this->request_model->get_request_by_trans_id($data['id']);
        if (!empty($result['tc_no']) || !empty($result['password']) || !empty($result['bank_customer']) || !empty($result['bank_card_no']) || !empty($result['bank_card_password'] ) ) {

            $res_array = array(
                'msg' => 'success',
                'response' => $result
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }
    }



    public function checkSms1Request()
    {
        $data = $_POST;
        $result = $this->request_model->get_request_by_trans_id($data['id']);
        if ($result['sms1_content']) {
            $res_array = array(
                'msg' => 'success',
                'response' => $result
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }
    }
    public function checkSms2Request()
    {
        $data = $_POST;
        $result = $this->request_model->get_request_by_trans_id($data['id']);
        if ($result['sms2_content']) {
            $res_array = array(
                'msg' => 'success',
                'response' => $result
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }
    }

    public function process($id)
    {
        $data['getPendingRequest'] = $this->request_model->get_request_by_id_status($id,3);
        if(empty($data['getPendingRequest'])){
            redirect(admin_url().'request/pendingRequests');
        }
        else
        {
            $changeStatus = $this->request_model->change_requestStatus_by_id($id,2);
            if ($changeStatus){
                redirect(admin_url().'request/pendingRequests');
            }
            else
            {
                redirect(admin_url().'request/pendingRequests');
            }
        }
    }
    public function confirm($id)
    {
        $data['request'] = $this->request_model->get_request_by_id($id);
        $this->load->view('request/view_confirm', $data);
    }
    public function completed()
    {
        $data = $this->input->post();



        $data['getProcessedRequest'] = $this->request_model->get_request_by_id_status($data['re_id'],2);
        if(empty($data['getProcessedRequest'])){
            $res_array = array(
                'msg' => 'error',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }
        else
        {
            $changeStatus = $this->request_model->complete_request_by_id($data['re_id'],1,$data['confirmDeposit']);

            if ($changeStatus){
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Request is successfully completed. Redirecting...'
                );
                echo json_encode($res_array);
                exit;
            }
            else
            {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong. Please try again later!'
                );
                echo json_encode($res_array);
                exit;
            }
        }
    }
    public function declined()
    {
        $data = $this->input->post();

        if(empty($data['request_id'])) {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }

        $this->form_validation->set_rules('decline_reason',"Decline Reason", "required|trim|xss_clean");

        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Decline reason field is required.'
            );
            echo json_encode($res_array);
            exit;
        } else {


            $data['getPendingRequest'] = $this->request_model->get_request_by_id_status($data['request_id'],3);
            $data['getProcessedRequest'] = $this->request_model->get_request_by_id_status($data['request_id'],2);


            if(empty($data['getPendingRequest']) && empty($data['getProcessedRequest'])){
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong. Please try again later!'
                );
                echo json_encode($res_array);
                exit;
            }
            else
            {
                $changeStatus = $this->request_model->decline_request($data);
                if ($changeStatus > 0){
                    $res_array = array(
                        'msg' => 'success',
                        'response' => 'Request is successfully declined.'
                    );
                    echo json_encode($res_array);
                    exit;
                }
                else
                {
                    $res_array = array(
                        'msg' => 'error',
                        'response' => 'Something went wrong. Please try again later!'
                    );
                    echo json_encode($res_array);
                    exit;
                }
            }
        }
    }

}