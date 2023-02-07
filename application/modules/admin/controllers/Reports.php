<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
       
        $this->load->model(admin_controller() . 'admin_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
    }



    public function index() {

        if(get_permission('reports') == 0) {
            redirect(admin_url());
        }

        $search_data = array();


        if (isset($_POST['start']) && !empty($_POST['start'])) {
            $start_date = $_POST['start'];
            $search_data['start'] = $_POST['start'];
        } else {
            $start_date = null;
        }
        if (isset($_POST['end']) && !empty($_POST['end'])) {
            $end_date = $_POST['end'];
            $search_data['end'] = $_POST['end'];
        } else {
            $end_date = null;
        }

        $users= $this->admin_model->report_users();
        $reportsData = array();
        foreach ($users as $user)
        {
            $userreport['user'] = $user;
            $userreport['totalConfirmed'] = $this->admin_model->getTotalConfirmed($user['userid'], $search_data);
            $userreport['totalConfirmedAmount'] = $this->admin_model->getTotalConfirmedAmount($user['userid'], $search_data);
            $userreport['totalDeclined'] = $this->admin_model->getTotalDeclined($user['userid'], $search_data);
            $userreport['totalDeclinedAmount'] = $this->admin_model->getTotalDeclinedAmount($user['userid'], $search_data);
            array_push($reportsData,$userreport);
        }
        $data['reports'] = $reportsData;
        $this->load->view('reports/index', $data);
    }

    public function logsReport()
    {
        if(get_permission('admin_logs_view') == 0) {
            redirect(admin_url());
        }
        $data['login_log'] = $this->admin_model->get_login_log();
        $this->load->view('reports/log_report', $data);
    }

}
