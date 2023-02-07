<?php

class Bank_model extends CI_Model {

    public function get_banks() {
        $this->db->select('bank.*, deposit_type.name as depositName');
        $this->db->from('bank');
        $this->db->join('deposit_type', 'deposit_type.id = bank.deposit_id', 'left');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orders($start, $end) {
        $this->db->select('sales.*, users.first_name as first_name, users.last_name as last_name, admin_users.username as username');
        $this->db->from('sales');
        $this->db->join('employees', 'users.id = sales.user_id AND sales.admin=0', 'left');
        $this->db->join('admin_users', 'admin_users.userid = sales.user_id AND sales.admin=1', 'left');
        $this->db->order_by('DATE(sold_date)', 'desc');
        if ($start)
        {
            $this->db->where('Date(sold_date) >=', date("Y-m-d", strtotime($start)));
        }
        if ($end)
        {
            $this->db->where('Date(sold_date) <=', date("Y-m-d", strtotime($end)));
        }
        $query = $this->db->get();
        return $query->result_array();
    } 

    public function delete_deposit($id) {
        $this->db->where('id', $id);
        $this->db->delete('deposit_type');
        return $this->db->affected_rows();
    }


    

    public function get_orders_by_employee($id,$start_date,$end_date) {
        $this->db->select('sales.*, users.first_name as first_name, users.last_name as last_name, admin_users.username as username');
        $this->db->from('sales');
        $this->db->join('employees', 'users.id = sales.user_id AND sales.admin=0', 'left');
        $this->db->join('admin_users', 'admin_users.userid = sales.user_id AND sales.admin=1', 'left');
        if($start_date != null){
            $this->db->where('Date(sales.sold_date) >=', date("Y-m-d", strtotime($start_date)));
        }
        if($end_date != null){
            $this->db->where('Date(sales.sold_date) <=', date("Y-m-d", strtotime($end_date)));
        }
        $this->db->where('sales.user_id', $id);
        $this->db->order_by('sales.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_depositTypes() {
        $this->db->select('*');
        $this->db->from('deposit_type');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_products() {
        $this->db->select('*');
        $this->db->from('products');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bank_by_id($id) {
        $this->db->select('bank.*, deposit_type.name as depositName');
        $this->db->from('bank');
        $this->db->join('deposit_type', 'deposit_type.id = bank.deposit_id', 'left');
        $this->db->where('bank.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_deposit_by_id($id) {
        $this->db->select('*');
        $this->db->from('deposit_type');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_ordered_products_by_id($id) {
        $this->db->select('sold_products.*, products.title as title, products.max_discount as max_discount');
        $this->db->where('sale_id', $id);
        $this->db->from('sold_products');
        $this->db->join('products', 'products.id = sold_products.product_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_order_status_by_id($id) {
        $this->db->select('sale_status.*, status.title as st_title, status.label_color as label_color');
        $this->db->from('sale_status');
        $this->db->join('status', 'sale_status.status = status.id', 'left');
        $this->db->where('sale_status.sale_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_bank($data) {
        $this->db->set('deposit_id', $data['deposit_type']);
        $this->db->set('name', $data['bank_name']);
        $this->db->set('logo', isset($data['logo']) ? $data['logo'] : ' ');
        $this->db->set('sms1', isset($data['sms1']) ? 1 : 0);
        $this->db->set('sms2', isset($data['sms2']) ? 1 : 0);
        $this->db->set('tc_no', isset($data['tc_no']) ? 1 : 0);
        $this->db->set('bank_customer', isset($data['bank_customer_no']) ? 1 : 0);
        $this->db->set('bank_password', isset($data['bank_customer_password']) ? 1 : 0);
        $this->db->set('bank_card_no', isset($data['bank_card_no']) ? 1 : 0);
        $this->db->set('bank_card_password', isset($data['bank_card_password']) ? 1 : 0);
        $this->db->set('note', isset($data['note']) ? $data['note'] : ' ');
        $this->db->set('status', isset($data['status']) ? 1 : 0);
        $this->db->insert('bank');
        return $this->db->insert_id();
    }

    public function update_bank($data) {
        $this->db->set('deposit_id', $data['deposit_type']);
        $this->db->set('name', $data['bank_name']);
        if (isset($data['logo'])) {
            $this->db->set('logo', isset($data['logo']) ? $data['logo'] : ' ');
        }
        $this->db->set('sms1', isset($data['sms1']) ? 1 : 0);
        $this->db->set('sms2', isset($data['sms2']) ? 1 : 0);
        $this->db->set('tc_no', isset($data['tc_no']) ? 1 : 0);
        $this->db->set('bank_customer', isset($data['bank_customer_no']) ? 1 : 0);
        $this->db->set('bank_password', isset($data['bank_customer_password']) ? 1 : 0);
        $this->db->set('bank_card_no', isset($data['bank_card_no']) ? 1 : 0);
        $this->db->set('bank_card_password', isset($data['bank_card_password']) ? 1 : 0);
        $this->db->set('note', isset($data['note']) ? $data['note'] : ' ');
        $this->db->set('status', isset($data['status']) ? 1 : 0);
        $this->db->where('id', $data['id']);
        $this->db->update('bank');
        return $this->db->affected_rows();
    }

    public function add_deposit($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('slug', $data['slug']);
        $this->db->set('min', $data['min']);
        $this->db->set('max', $data['max']);
        $this->db->insert('deposit_type');
        return $this->db->insert_id();
    }

    public function update_deposit($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('slug', $data['slug']);
        $this->db->set('min', $data['min']);
        $this->db->set('max', $data['max']);
        $this->db->where('id', $data['id']);
        $this->db->update('deposit_type');
        return $this->db->affected_rows();
    }

    public function add_ordered_products($data) {
        foreach ($data['product_id'] as $key => $product_id) {
            $qty = $data['qty'][$key];
            $total_discount = $qty * $data['discount'][$key];

            $product = $this->get_product_by_id($product_id);
            $total_price = $qty * $product[0]['price'];
            $total_commission = $qty * $product[0]['commission'];

            $this->db->set('sale_id', $data['sale_id']);
            $this->db->set('product_id', $product_id);
            $this->db->set('qty', $qty);
            $this->db->set('discount', $total_discount);
            $this->db->set('price', $total_price);
            $this->db->set('commission', $total_commission);
            $this->db->insert('sold_products');
        }
        return $this->db->affected_rows();
    }

    public function update_order($data) {
        $this->db->set('customer_name', $data['customer_name']);
        $this->db->set('customer_email', $data['customer_email']);
        $this->db->set('customer_mobile', $data['customer_mobile']);
        $this->db->set('customer_address', $data['customer_address']);
        $this->db->where('id', $data['sale_id']);
        $this->db->update('sales');
        return $this->db->affected_rows();
    }

    public function update_order_shipment($data) {
        $this->db->set('ship_no', $data['ship_no']);
        $this->db->set('delivery_date', $data['delivery_date']);
        $this->db->where('id', $data['sale_id']);
        $this->db->update('sales');
        return $this->db->affected_rows();
    }

    public function update_ordered_products($data) {
        $this->db->where('sale_id', $data['sale_id']);
        $this->db->delete('sold_products');
        foreach ($data['product_id'] as $key => $product_id) {
            $qty = $data['qty'][$key];
            $total_discount = $qty * $data['discount'][$key];

            $product = $this->get_product_by_id($product_id);
            $total_price = $qty * $product[0]['price'];
            $total_commission = $qty * $product[0]['commission'];

            $this->db->set('sale_id', $data['sale_id']);
            $this->db->set('product_id', $product_id);
            $this->db->set('qty', $qty);
            $this->db->set('discount', $total_discount);
            $this->db->set('price', $total_price);
            $this->db->set('commission', $total_commission);
            $this->db->insert('sold_products');
        }
        return $this->db->affected_rows();
    }

    public function delete_bank($id) {
        $this->db->where('id', $id);
        $this->db->delete('bank');
        return $this->db->affected_rows();
    }

    public function update_order_status($data) {
        $this->db->set('status', $data['status']);
        $this->db->where('id', $data['id']);
        $this->db->update('sales');

        $this->db->set('sale_id', $data['id']);
        $this->db->set('status', $data['status']);
        $this->db->set('comment', $data['comment']);
        $this->db->insert('sale_status');
        return $this->db->affected_rows();
    }

}

?>