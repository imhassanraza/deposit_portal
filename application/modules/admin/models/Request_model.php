<?php
class Request_model extends CI_Model
{
    public function get_requests ($status_id) {
        $this->db->select('deposit_type.name as depositName, bank.name as bankName, requests.*, requests.id as request_id');
        $this->db->from('requests');
        $this->db->join('deposit_type', 'deposit_type.id = requests.deposit_id', 'left');
        $this->db->join('bank', 'bank.id = requests.bank_id', 'left');
        $this->db->where('requests.status',$status_id);
        // if(get_session('user_type') == 0) {
        //     $this->db->where('requests.user_id',get_session('admin_id'));
        // }
        $this->db->order_by('requests.id', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }
    public function search_requests($data = array())
    {
        $this->db->select('deposit_type.name as depositName, bank.name as bankName, requests.* ');
        $this->db->from('requests');
        $this->db->join('deposit_type', 'deposit_type.id = requests.deposit_id', 'left');
        $this->db->join('bank', 'bank.id = requests.bank_id', 'left');
        $this->db->join('admin_users', 'admin_users.userid = requests.user_id', 'left');

        if(!empty($data['bank']))
        {
            $this->db->where('bank.id',$data['bank']);
        }
        if(!empty($data['deposit_type']))
        {
            $this->db->where('deposit_type.id',$data['deposit_type']);
        }
        if(!empty($data['user_id']))
        {
            $this->db->where('admin_users.userid',$data['user_id']);
        }
        if(!empty($data['deposit_amount']))
        {
            $this->db->where('requests.deposit_amount',$data['deposit_amount']);
        }
        if(!empty($data['start']))
        {
            $this->db->where('Date(requests.created_at) >=', date("Y-m-d", strtotime($data['start'])));
        }
        if(!empty($data['end']))
        {
            $this->db->where('Date(requests.created_at) <=', date("Y-m-d", strtotime($data['end'])));
        }
        if (isset($data['requestType']))
        {
            if ($data['requestType'] == 'Pending')
            {
                $status_id = 3;
            }
            elseif ($data['requestType'] == 'Proccess')
            {
                $status_id = 2;
            }
            elseif ($data['requestType'] == 'Confirmed')
            {
                $status_id = 1;
            }
            else
            {
                $status_id = 0;
            }
        }
        $this->db->where('requests.status',$status_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_request_by_id ($id) {
        $this->db->select('deposit_type.name as depositName, bank.name as bankName, requests.* ');
        $this->db->from('requests');
        $this->db->join('deposit_type', 'deposit_type.id = requests.deposit_id', 'left');
        $this->db->join('bank', 'bank.id = requests.bank_id', 'left');
        $this->db->where('requests.id',$id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_request_by_id_status($id,$status)
    {
        $this->db->select('*')->where('id', $id)->where('status',$status);
        $this->db->from('requests');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_request_by_trans_id($id)
    {
        $this->db->select('*')->where('trans_id', $id);
        $this->db->from('requests');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function change_requestStatus_by_id($id, $status)
    {
        $this->db->set('status', $status);
        $this->db->set('user_id', $this->session->userdata('admin_id'));
        $this->db->where('id', $id);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }


    public function decline_request($data)
    {
        $this->db->set('status',0);
        $this->db->set('user_id', $this->session->userdata('admin_id'));
        $this->db->set('decline_reason', $data['decline_reason']);
        $this->db->where('id', $data['request_id']);
        $query = $this->db->update('requests');
        return $this->db->affected_rows();
    }

    public function complete_request_by_id($id, $status, $deposit)
    {
        $this->db->set('status', $status);
        $this->db->set('confirmDeposit', $deposit);
        $this->db->set('user_id', $this->session->userdata('admin_id'));
        $this->db->where('id', $id);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }
    public function change_Sms_Status_by_trans_id($key,$data)
    {
        $this->db->set($key, 1);
        $this->db->where('trans_id', $data['id']);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }
    public function get_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function check_request_status_by_transId($data)
    {
        $this->db->select('*')->where('trans_id', $data['id']);
        $this->db->from('requests');
        $query = $this->db->get();
        return $query->num_rows();
    }
}

?>