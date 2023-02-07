<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller().'bank_model');
        $this->load->model(admin_controller().'admin_model');
        if(!$this->session->userdata('admin_logged_in'))
        {
            redirect(admin_url().'login');
        }

        
    }

    public function index()
    {
        if(get_permission('bank_view') == 0) {
            redirect(admin_url());
        }
        $data['banks'] = $this->bank_model->get_banks();
        $this->load->view('bank/index', $data);
    }
    public function depositOptions()
    {
        if(get_permission('deposit_view') == 0) {
            redirect(admin_url());
        }
        $data['depositTypes'] = $this->bank_model->get_depositTypes();
        $this->load->view('deposit/index', $data);
    }
    public function add()
    {
        if(get_permission('bank_add') == 0) {
            redirect(admin_url());
        }
        $data['despositTypes'] = $this->bank_model->get_depositTypes();
        $this->load->view('bank/add_bank', $data);
    }
    public function addDeposit()
    {
        if(get_permission('deposit_add') == 0) {
            redirect(admin_url());
        }
        //$data['despositTypes'] = $this->bank_model->get_depositTypes();
        $this->load->view('deposit/add');
    }
    public function submit_deposit()
    {
        $data = $_POST;

        $this->form_validation->set_rules('name',"Deposit Name", "required");
        $this->form_validation->set_rules('min',"Minimum Investment", "required");
        $this->form_validation->set_rules('max',"Maximum Investment", "required");

        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($res_array);
            exit;
        } else {
            $result = $this->bank_model->add_deposit($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Deposit Type has been successfully added!'
                );
                echo json_encode($res_array);
                exit;
                //redirect(admin_url().'bank');
            } else {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong. Please try again later!'
                );
                echo json_encode($res_array);
                exit;
                //redirect(admin_url().'bank/add');
            }
        }
    }



    public function update_deposit()
    {
        $data = $_POST;
        
        $this->form_validation->set_rules('name',"Deposit Name", "required");
        $this->form_validation->set_rules('min',"Minimum Investment", "required");
        $this->form_validation->set_rules('max',"Maximum Investment", "required");

        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($res_array);
            exit;
        } else {
            $result = $this->bank_model->update_deposit($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Deposit Type has been successfully updated!'
                );
                echo json_encode($res_array);
                exit;
                //redirect(admin_url().'bank');
            } else {
                $res_array = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong. Please try again later!'
                );
                echo json_encode($res_array);
                exit;
                //redirect(admin_url().'bank/add');
            }
        }
    }


    public function submit_bank()
    {
        $data = $_POST;
        if (! empty($_POST['deposit_type'])) {
            $this->form_validation->set_rules('deposit_type',"Deposit Type", "required");
        }
        if (! empty($_POST['name'])) {
            $this->form_validation->set_rules('name',"Bank Name", "required");
        }
        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Please select deposit type'
            );
            echo json_encode($res_array);
            exit;
        } else {
            if (!empty($_FILES['logo']['name']))
            {
                $filename = md5(uniqid(rand(), true));
                $config = array(
                    'upload_path' => 'uploads/',
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "768",
                    'max_width' => "1024"
                );

                $this->load->library('upload');
                $this->upload->initialize($config);
                if($this->upload->do_upload('logo'))
                {
                    $file_data = $this->upload->data();
                    $data['logo'] = $file_data['file_name'];
                }else{

                    $res_array = array(
                        'msg' => 'error',
                        'response' => $this->upload->display_errors()
                    );
                    echo json_encode($res_array);
                    exit;
                }
            } else {
                $res_array = array(
                    'msg' => 'error',
                    'response' => "Please select bank logo"
                );
                echo json_encode($res_array);
                exit;
            }
            $result = $this->bank_model->add_bank($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Bank has been successfully added!'
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
    }

    public function view_bank ()
    {

        $id = $_POST['id'];
        $data['bank'] = $this->bank_model->get_bank_by_id($id);
        if(empty($data['bank'])){
            $res_array = array(
                'msg' => 'error',
                'response' => '<b>Something went wrong. Please try again later!</b>'
            );
            echo json_encode($res_array);
            exit;
        }
        $html = $this->load->view('bank/view_bank', $data, true);
        if ($html) {
            $res_array = array(
                'msg' => 'success',
                'response' => $html,
            );
            echo json_encode($res_array);
            exit;
        }

    }
    public function edit ($id)
    {   
        if(get_permission('bank_edit') == 0) {
            redirect(admin_url());
        }
        $data['despositTypes'] = $this->bank_model->get_depositTypes();
        $data['bank'] = $this->bank_model->get_bank_by_id($id);
        if(empty($data['bank'])){
            redirect(admin_url().'bank');
        }
        $this->load->view('bank/edit_bank', $data);
    }

    public function update_bank()
    {
        $data = $_POST;
        if (! empty($_POST['deposit_type'])) {
            $this->form_validation->set_rules('deposit_type',"Deposit Type", "required");
        }
        if (! empty($_POST['name'])) {
            $this->form_validation->set_rules('name',"Bank Name", "required");
        }
        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => 'Please select deposit type'
            );
            echo json_encode($res_array);
            exit;
        } else {

            if (!empty($_FILES['logo']['name']))
            {
                $filename = md5(uniqid(rand(), true));
                $config = array(
                    'upload_path' => 'uploads/',
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "768",
                    'max_width' => "1024"
                );

                $this->load->library('upload');
                $this->upload->initialize($config);
                if($this->upload->do_upload('logo'))
                {
                    $file_data = $this->upload->data();
                    $data['logo'] = $file_data['file_name'];
                }else{
                    $res_array = array(
                        'msg' => 'error',
                        'response' => $this->upload->display_errors()
                    );
                    echo json_encode($res_array);
                    exit;
                }
            }


            $result = $this->bank_model->update_bank($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'Bank has been successfully update!'
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
    }


    public function deleteDeposit ()
    {

        $id = $_POST['id'];
        $result = $this->bank_model->delete_deposit($id);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Deposit Type has been successfully deleted!'
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

    public function editDeposit ($id)
    {
        if(get_permission('deposit_edit') == 0) {
            redirect(admin_url());
        }
        $data['deposit'] = $this->bank_model->get_deposit_by_id($id);
        if(empty($data['deposit'])){
            redirect(admin_url().'bank/depositOptions');
        }
        $this->load->view('deposit/edit_deposit', $data);
    }

    public function delete ()
    {
        $id = $_POST['id'];
        $result = $this->bank_model->delete_bank($id);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'Bank has been successfully deleted!'
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
}