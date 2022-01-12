<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_receipt extends CI_Controller {

    public $logged_in_id = null;
    public $now_time = null;
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Appmodel', 'app_model');
        $this->load->model('Crud', 'crud');
        if (!$this->session->userdata('bansijew_is_logged_in')) {
            redirect('/auth/login/');
        }
        $this->logged_in_id = $this->session->userdata('bansijew_is_logged_in')['user_id'];
        $this->now_time = date('Y-m-d H:i:s');
    }
	
    function add($payment_receipt_id = '') {
        if ($this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "edit") || $this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "add")) {
            $data = array();
            if(!empty($payment_receipt_id)) {
                $data['payment_receipt_row'] = $this->crud->get_data_row_by_id('payment_receipt', 'payment_receipt_id', $payment_receipt_id);
            }
//            echo "<pre>"; print_r($data); exit;
            $this->load->view('payment_receipt/add', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_payment_receipt(){
        $post_data = $this->input->post();
//        echo "<pre>"; print_r($post_data); exit;
        $post_data['job_worker_id'] = isset($post_data['job_worker_id']) && !empty($post_data['job_worker_id']) ? $post_data['job_worker_id'] : null;
        $post_data['payment_receipt_date'] = isset($post_data['payment_receipt_date']) && !empty($post_data['payment_receipt_date']) ? date('Y-m-d', strtotime($post_data['payment_receipt_date'])) : null;
        $payment_receipt_data = array(
            'job_worker_id' => $post_data['job_worker_id'],
            'payment_receipt_date' => $post_data['payment_receipt_date'],
            'remark' => $post_data['remark'],
            'item_id' => $post_data['item_id'],
            'weight_jama_udhar' => $post_data['weight_jama_udhar'],
            'weight' => $post_data['weight'],
            'touch' => $post_data['touch'],
            'fine' => $post_data['fine'],
            'amount_jama_udhar' => $post_data['amount_jama_udhar'],
            'amount' => $post_data['amount'],
        );
        $payment_receipt_data['updated_at'] = $this->applib->get_current_date_time();
        $payment_receipt_data['updated_by'] = $this->logged_in_id;
        
        if (!empty($post_data['payment_receipt_id'])) {
            $payment_receipt_id = $post_data['payment_receipt_id'];
            $old_payment_receipt_data = $this->crud->get_data_row_by_id('payment_receipt', 'payment_receipt_id', $payment_receipt_id);
            if(!empty($old_payment_receipt_data)){
//                print_r($old_payment_receipt_data); exit;
                // Revert Item Stock
                if (!empty($old_payment_receipt_data->item_id)) {
                    if ($old_payment_receipt_data->weight_jama_udhar == '1') {
                        // Jama to Decrease
                        $this->applib->update_item_stock_decrease($old_payment_receipt_data->item_id, $old_payment_receipt_data->weight, $old_payment_receipt_data->touch, $old_payment_receipt_data->fine);
                        // Job Worker Fine Decrease
                        $this->applib->update_job_worker_balance_decrease($old_payment_receipt_data->job_worker_id, $old_payment_receipt_data->fine, '');
                    } else {
                        // Udhar to Increase
                        $this->applib->update_item_stock_increase($old_payment_receipt_data->item_id, $old_payment_receipt_data->weight, $old_payment_receipt_data->touch, $old_payment_receipt_data->fine);
                        // Job Worker Fine Increase
                        $this->applib->update_job_worker_balance_increase($old_payment_receipt_data->job_worker_id, $old_payment_receipt_data->fine, '');
                    }
                }
                // Revert Job Worker Amount
                if (!empty($old_payment_receipt_data->amount)) {
                    if ($old_payment_receipt_data->amount_jama_udhar == '1') {
                        // Udhar to Decrease
                        $this->applib->update_job_worker_balance_decrease($old_payment_receipt_data->job_worker_id, '', $old_payment_receipt_data->amount);
                    } else {
                        // Jama to Increase
                        $this->applib->update_job_worker_balance_increase($old_payment_receipt_data->job_worker_id, '', $old_payment_receipt_data->amount);
                    }
                }
            }

            $where_array['payment_receipt_id'] = $payment_receipt_id;
            $this->crud->update('payment_receipt', $payment_receipt_data, $where_array);

            // Update Item Stock
            if (!empty($post_data['item_id'])) {
                if ($post_data['weight_jama_udhar'] == '1') {
                    // Jama to Increase
                    $this->applib->update_item_stock_increase($post_data['item_id'], $post_data['weight'], $post_data['touch'], $post_data['fine']);
                    // Update Job Worker Fine Increase
                    $this->applib->update_job_worker_balance_increase($post_data['job_worker_id'], $post_data['fine'], '');
                } else {
                    // Udhar to Decrease
                    $this->applib->update_item_stock_decrease($post_data['item_id'], $post_data['weight'], $post_data['touch'], $post_data['fine']);
                    // Update Job Worker Fine Decrease
                    $this->applib->update_job_worker_balance_decrease($post_data['job_worker_id'], $post_data['fine'], '');
                }
            }

            // Update Job Worker Amount
            if (!empty($post_data['amount'])) {
                if ($post_data['amount_jama_udhar'] == '1') {
                    // Jama to Increase
                    $this->applib->update_job_worker_balance_increase($post_data['job_worker_id'], '', $post_data['amount']);
                } else {
                    // Udhar to Decrease
                    $this->applib->update_job_worker_balance_decrease($post_data['job_worker_id'], '', $post_data['amount']);
                }
            }

            $return['success'] = "Updated";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Payment Receipt Updated Successfully');
        } else {
            $payment_receipt_data['created_at'] = $this->applib->get_current_date_time();
            $payment_receipt_data['created_by'] = $this->logged_in_id;
            $payment_receipt_id = $this->crud->insert('payment_receipt', $payment_receipt_data);

            // Update Item Stock
            if (!empty($post_data['item_id'])) {
                if ($post_data['weight_jama_udhar'] == '1') {
                    // Jama to Increase
                    $this->applib->update_item_stock_increase($post_data['item_id'], $post_data['weight'], $post_data['touch'], $post_data['fine']);
                    // Update Job Worker Fine Increase
                    $this->applib->update_job_worker_balance_increase($post_data['job_worker_id'], $post_data['fine'], '');
                } else {
                    // Udhar to Decrease
                    $this->applib->update_item_stock_decrease($post_data['item_id'], $post_data['weight'], $post_data['touch'], $post_data['fine']);
                    // Update Job Worker Fine Decrease
                    $this->applib->update_job_worker_balance_decrease($post_data['job_worker_id'], $post_data['fine'], '');
                }
            }

            // Update Job Worker Amount
            if (!empty($post_data['amount'])) {
                if ($post_data['amount_jama_udhar'] == '1') {
                    // Jama to Increase
                    $this->applib->update_job_worker_balance_increase($post_data['job_worker_id'], '', $post_data['amount']);
                } else {
                    // Udhar to Decrease
                    $this->applib->update_job_worker_balance_decrease($post_data['job_worker_id'], '', $post_data['amount']);
                }
            }

            $return['success'] = "Added";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Payment Receipt Added Successfully');
        }
//        echo $this->db->last_query(); exit;
        print json_encode($return);
        exit;
    }

    function payment_receipt_list() {
        if ($this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "view") || $this->applib->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "add")) {
            $date = array();
            $date['from_date'] = date("01-m-Y");
            $date['to_date'] = date("d-m-Y");
            $this->load->view('payment_receipt/payment_receipt_list',$date);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function payment_receipt_datatable() {
        $post_data = $this->input->post();
        
        $config['table'] = 'payment_receipt pr';
        $config['select'] = 'pr.*, jw.job_worker as person_name, i.item_name';
        $config['joins'][] = array('join_table' => 'job_worker jw', 'join_by' => 'jw.id = pr.job_worker_id');
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = pr.item_id', 'join_type' => 'left');
        $config['column_search'] = array();
        $config['column_order'] = array();
        $config['order'] = array('pr.payment_receipt_id' => 'desc');
        if (isset($post_data['from_date']) && strtotime($post_data['from_date']) > 0) {
            $from_date = date('Y-m-d',strtotime($post_data['from_date']));
            $config['wheres'][] = array('column_name' => 'pr.payment_receipt_date >=', 'column_value' => $from_date);
        }
        if (isset($post_data['to_date']) && strtotime($post_data['to_date']) > 0) {
            $to_date = date('Y-m-d',strtotime($post_data['to_date']));
            $config['wheres'][] = array('column_name' => 'pr.payment_receipt_date <=', 'column_value' => $to_date);
        }
        if (!empty($post_data['job_worker_id'])) {
            $config['wheres'][] = array('column_name' => 'pr.job_worker_id', 'column_value' => $post_data['job_worker_id']);
        }
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(PAYMENT_RECEIPT_MODULE_ID, "delete");
        foreach ($list as $payment_receipt) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'payment_receipt/add/'. $payment_receipt->payment_receipt_id.'" title="Edit Payment Receipt"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('payment_receipt/delete_payment_receipt/' . $payment_receipt->payment_receipt_id) . '"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
            }
            $row[] = $action;
            $row[] = $payment_receipt->person_name;
            $row[] = (strtotime($payment_receipt->payment_receipt_date) > 0 ? date('d-m-Y',strtotime($payment_receipt->payment_receipt_date)) : '');
            $row[] = $payment_receipt->item_name;
            $row[] = ($payment_receipt->weight_jama_udhar == '1') ? 'Jama' : 'Udar';
            $row[] = $payment_receipt->weight;
            $row[] = $payment_receipt->touch;
            $row[] = $payment_receipt->fine;
            $row[] = ($payment_receipt->amount_jama_udhar == '1') ? 'Jama' : 'Udar';
            $row[] = $payment_receipt->amount;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function delete_payment_receipt($payment_receipt_id) {
        $res = array();
        $old_payment_receipt_data = $this->crud->get_data_row_by_id('payment_receipt', 'payment_receipt_id', $payment_receipt_id);
        if(!empty($old_payment_receipt_data)){
//            print_r($old_payment_receipt_data); exit;
            // Revert Item Stock
            if (!empty($old_payment_receipt_data->item_id)) {
                if ($old_payment_receipt_data->weight_jama_udhar == '1') {
                    // Jama to Decrease
                    $this->applib->update_item_stock_decrease($old_payment_receipt_data->item_id, $old_payment_receipt_data->weight, $old_payment_receipt_data->touch, $old_payment_receipt_data->fine);
                    // Job Worker Fine Decrease
                    $this->applib->update_job_worker_balance_decrease($old_payment_receipt_data->job_worker_id, $old_payment_receipt_data->fine, '');
                } else {
                    // Udhar to Increase
                    $this->applib->update_item_stock_increase($old_payment_receipt_data->item_id, $old_payment_receipt_data->weight, $old_payment_receipt_data->touch, $old_payment_receipt_data->fine);
                    // Job Worker Fine Increase
                    $this->applib->update_job_worker_balance_increase($old_payment_receipt_data->job_worker_id, $old_payment_receipt_data->fine, '');
                }
            }
            // Revert Job Worker Amount
            if (!empty($old_payment_receipt_data->amount)) {
                if ($old_payment_receipt_data->amount_jama_udhar == '1') {
                    // Udhar to Decrease
                    $this->applib->update_job_worker_balance_decrease($old_payment_receipt_data->job_worker_id, '', $old_payment_receipt_data->amount);
                } else {
                    // Jama to Increase
                    $this->applib->update_job_worker_balance_increase($old_payment_receipt_data->job_worker_id, '', $old_payment_receipt_data->amount);
                }
            }
            $this->crud->delete('payment_receipt', array('payment_receipt_id' => $payment_receipt_id));
            $res['status'] = "success";
        }
        echo json_encode($res);
    }

}
