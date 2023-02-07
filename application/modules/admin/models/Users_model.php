<?php
class Users_model extends CI_Model
{
    public function getAllUsers()
    {
        $this->db->select('*');
        $this->db->where('user_type',0);
        $query=$this->db->get('admin_users');
        return $query->result_array();
    }
    public function get_permissions($userid)
    {
        $this->db->select('*');
        $this->db->where('userid',$userid);
        $this->db->from('permissions');
        $query=$this->db->get();
        return $query->row();
    }
    public function getUserById($id)
    {
        $this->db->select('*');
        $this->db->where('userid',$id);
        $query=$this->db->get('admin_users');
        return $query->row();
    }
    public function submit_user($data) {

        $hash_pass = "password('" . trim($data['password']) . "')";
        $this->db->set('username', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('password', $hash_pass, FALSE);
        $this->db->set('phone', $data['mobile']);
        $this->db->set('address', $data['address']);
        $this->db->insert('admin_users');
        $user_id =  $this->db->insert_id();
        if ($user_id){
            $this->db->set('userid', $user_id);
            $this->db->set('pending_requests', isset($data['pending_requests']) ? 1 : 0);
            $this->db->set('processed_requests', isset($data['processed_requests']) ? 1 : 0);
            $this->db->set('completed_requests', isset($data['completed_requests']) ? 1 : 0);
            $this->db->set('declined_requests', isset($data['declined_requests']) ? 1 : 0);
            $this->db->set('bank_view', isset($data['bank_view']) ? 1 : 0);
            $this->db->set('bank_add', isset($data['bank_add']) ? 1 : 0);
            $this->db->set('bank_edit', isset($data['bank_edit']) ? 1 : 0);
            $this->db->set('bank_delete', isset($data['bank_delete']) ? 1 : 0);
            $this->db->set('deposit_view', isset($data['deposit_view']) ? 1 : 0);
            $this->db->set('deposit_add', isset($data['deposit_add']) ? 1 : 0);
            $this->db->set('deposit_edit', isset($data['deposit_edit']) ? 1 : 0);
            $this->db->set('deposit_delete', isset($data['deposit_delete']) ? 1 : 0);
            $this->db->set('user_view', isset($data['users_view']) ? 1 : 0);
            $this->db->set('user_add', isset($data['users_add']) ? 1 : 0);
            $this->db->set('user_edit', isset($data['users_edit']) ? 1 : 0);
            $this->db->set('user_delete', isset($data['users_delete']) ? 1 : 0);
            $this->db->set('reports', isset($data['report_view']) ? 1 : 0);
            $this->db->set('admin_logs_view', isset($data['admin_logs_view']) ? 1 : 0);
            $this->db->insert('permissions');
            return $user_id;
        }
    }

    public function delete_user($id){
        $this->db->where('userid', $id);
        $this->db->delete('admin_users');
        $deleted =  $this->db->affected_rows();
        if($deleted){
            $this->db->where('userid', $id);
            $this->db->delete('permissions');
        }
        return $this->db->affected_rows();
    }

    public function get_user_bt_id($id){
        $this->db->select('*');
        $this->db->from('admin_users as u');
        $this->db->join('permissions as p', 'p.userid = u.userid', 'left');
        $this->db->where('u.userid', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_user($data) {

        if(!empty($data['password']))
        {
            $hash_pass = "password('" . trim($data['password']) . "')";
            $this->db->set('password', $hash_pass, FALSE);
        }

        $this->db->set('username', $data['name']);
        // $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['mobile']);
        $this->db->set('address', $data['address']);
        $this->db->where('userid', $data['id']);
        $query = $this->db->update('admin_users');
        $rows = $this->db->affected_rows();

        $this->db->set('pending_requests', isset($data['pending_requests']) ? 1 : 0);
        $this->db->set('processed_requests', isset($data['processed_requests']) ? 1 : 0);
        $this->db->set('completed_requests', isset($data['completed_requests']) ? 1 : 0);
        $this->db->set('declined_requests', isset($data['declined_requests']) ? 1 : 0);
        $this->db->set('bank_view', isset($data['bank_view']) ? 1 : 0);
        $this->db->set('bank_add', isset($data['bank_add']) ? 1 : 0);
        $this->db->set('bank_edit', isset($data['bank_edit']) ? 1 : 0);
        $this->db->set('bank_delete', isset($data['bank_delete']) ? 1 : 0);
        $this->db->set('deposit_view', isset($data['deposit_view']) ? 1 : 0);
        $this->db->set('deposit_add', isset($data['deposit_add']) ? 1 : 0);
        $this->db->set('deposit_edit', isset($data['deposit_edit']) ? 1 : 0);
        $this->db->set('deposit_delete', isset($data['deposit_delete']) ? 1 : 0);
        $this->db->set('user_view', isset($data['users_view']) ? 1 : 0);
        $this->db->set('user_add', isset($data['users_add']) ? 1 : 0);
        $this->db->set('user_edit', isset($data['users_edit']) ? 1 : 0);
        $this->db->set('user_delete', isset($data['users_delete']) ? 1 : 0);
        $this->db->set('reports', isset($data['report_view']) ? 1 : 0);
        $this->db->set('admin_logs_view', isset($data['admin_logs_view']) ? 1 : 0);
        $this->db->where('userid', $data['id']);
        $query =  $this->db->update('permissions');
        $prows = $this->db->affected_rows();

        if($rows > 0 || $prows > 0) {
            return 1;
        } else {
            return 0;
        }
    }


}

?>