<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(admin_controller().'admin_lib');
        $this->load->model(admin_controller().'users_model');
        if(!$this->session->userdata('admin_logged_in'))
        {
            redirect(admin_url().'login');
        }
    }
    public function index()
    {
        if(get_permission('user_view') == 0) {
            redirect(admin_url());
        }

        $data['users'] = $this->users_model->getAllUsers();
        $this->load->view('users/index',$data);
    }

    public function addUser()
    {
        if(get_permission('user_add') == 0) {
            redirect(admin_url());
        }
        $this->load->view('users/add_user');
    }

    public function submit_user()
    {
        $data = $_POST;
        $this->form_validation->set_rules('name',"User Name", "required");
        $this->form_validation->set_rules('email',"Email", "required|is_unique[admin_users.email]");
        $this->form_validation->set_rules('password',"Password", "required");
        $this->form_validation->set_rules('mobile',"Mobile", "required");
        $this->form_validation->set_rules('address',"Address", "required");
        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($res_array);
            exit;
        }else{
            $result = $this->users_model->submit_user($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'User has been successfully added!'
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

    public function editUser($id)
    {   
        if(get_permission('user_edit') == 0) {
            redirect(admin_url());
        }

        $data['users'] = $this->users_model->get_user_bt_id($id);
        if(empty($data['users'])){
            redirect(admin_url().'users/addUser');
        }
        $this->load->view('users/edit_user', $data);
    }

    public function update_user()
    {
        $data = $_POST;
        if(!empty($_POST['password'])){
            $this->form_validation->set_rules('password',"Password", "min_length[5]");
        }
        $this->form_validation->set_rules('name',"User Name", "required");
        $this->form_validation->set_rules('mobile',"Mobile", "required");
        $this->form_validation->set_rules('address',"Address", "required");

        if ($this->form_validation->run() == false) {
            $res_array = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($res_array);
            exit;
        }else{
            $result = $this->users_model->update_user($data);
            if ($result) {
                $res_array = array(
                    'msg' => 'success',
                    'response' => 'User has been successfully added!'
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

    public function deleteUser ()
    {   
        if(get_permission('user_delete') == 0) {
            redirect(admin_url());
        }
        
        $id = $_POST['id'];
        $result = $this->users_model->delete_user($id);
        if ($result) {
            $res_array = array(
                'msg' => 'success',
                'response' => 'User has been successfully deleted!'
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

   // public function update_employee ()
   // {
   //     $data = $_POST;
   //     $result = $this->employees_model->update_employee($data);
   //     if ($result) {
   //         $res_array = array(
   //             'msg' => 'success',
   //             'response' => 'Employee has been successfully updated!'
   //         );
   //         echo json_encode($res_array);
   //         exit;
   //     } else {
   //         $res_array = array(
   //             'msg' => 'error',
   //             'response' => 'Something went wrong. Please try again later!'
   //         );
   //         echo json_encode($res_array);
   //         exit;
   //     }
   // }
//



   // public function delete ()
   // {
   //     $id = $_POST['id'];
   //     $result = $this->employees_model->delete_employee($id);
   //     if ($result) {
   //         $res_array = array(
   //             'msg' => 'success',
   //             'response' => 'Employee has been successfully deleted!'
   //         );
   //         echo json_encode($res_array);
   //         exit;
   //     } else {
   //         $res_array = array(
   //             'msg' => 'error',
   //             'response' => 'Something went wrong. Please try again later!'
   //         );
   //         echo json_encode($res_array);
   //         exit;
   //     }
   // }

   // public function employee_detail($id)
   // {
   //     $data['employee'] = $this->employees_model->get_employee_by_id($id);
   //     $this->load->view('users/employee_detail', $data);
   // }

}
