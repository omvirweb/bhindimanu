<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
	
    function ad_pcs_report() {
        if ($this->applib->have_access_role(AD_PCS_REPORT_MODULE_ID, "view")) { 
            $data = array();
            $this->load->view('report/ad_pcs_report', $data);
            
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }
    
    function ad_pcs_report_datatable() {
        $post_data = $this->input->post();
        $where = '1=1';
        $config['table'] = 'manufacture_issue_receive mir';
        $config['select'] = 'mir.ir_date,SUM(mir.ad_pcs) as total_receive_ad_pcs,jw.job_worker';
        $config['joins'][] = array('join_table' => 'job_worker jw', 'join_by' => 'jw.id = mir.job_worker_id', 'join_type' => 'left');
        $config['column_search'] = array('DATE_FORMAT(mir.ir_date,"%d-%m-%Y")','jw.job_worker');
        $config['column_order'] = array('mir.ir_date','jw.job_worker','total_receive_ad_pcs');
        $config['order'] = array('mir.ir_date' => 'desc');

        if (isset($post_data['from_date']) && strtotime($post_data['from_date']) > 0) {
            $from_date = date('Y-m-d',strtotime($post_data['from_date']));
            $config['wheres'][] = array('column_name' => 'mir.ir_date >=', 'column_value' => $from_date);
        }
        if (isset($post_data['to_date']) && strtotime($post_data['to_date']) > 0) {
            $to_date = date('Y-m-d',strtotime($post_data['to_date']));
            $config['wheres'][] = array('column_name' => 'mir.ir_date <=', 'column_value' => $to_date);
        }
        if (isset($post_data['job_worker_id']) &&  $post_data['job_worker_id'] != 0) {
            $config['wheres'][] = array('column_name' => 'mir.job_worker_id', 'column_value' => $post_data['job_worker_id']);
        }

        $where .= ' AND mir.type_id IN ('.MANUFACTURE_TYPE_RECEIVE_FINISH_ID.','.MANUFACTURE_TYPE_RECEIVE_SCRAP_ID.') ';
        $where .= ' AND mir.ad_pcs > 0';
        
        $config['group_by'] = 'mir.ir_date,mir.job_worker_id';

        $config['custom_where'] = $where;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        foreach ($list as $key => $manufacture_ir) {
            $row = array();
            $row[] = date('d-m-y',strtotime($manufacture_ir->ir_date));
            $row[] = $manufacture_ir->job_worker;
            $row[] = $manufacture_ir->total_receive_ad_pcs;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all('mir.ir_date'),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function item_stock_status() {
        if ($this->applib->have_access_role(ITEM_STOCK_STATUS_REPORT_MODULE_ID, "view")) {
            $data = array();
            $this->load->view('report/item_stock_status', $data);

        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }
    function item_stock_status_datatable() {
        $post_data = $this->input->post();
        $where = '1=1';
        $config['table'] = 'item_stock is';
        $config['select'] = 'is.*, i.item_name';
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = is.item_id', 'join_type' => 'left');
        $config['column_search'] = array('i.item_name','is.gross','is.touch', 'is.fine');
        $config['column_order'] = array('i.item_name','is.gross','is.touch', 'is.fine');
        $config['order'] = array('i.item_name' => 'desc');
        $config['custom_where'] = 'is.gross != 0';
        if (isset($post_data['item_id']) &&  $post_data['item_id'] != 0) {
            $config['wheres'][] = array('column_name' => 'is.item_id', 'column_value' => $post_data['item_id']);
        }
        $this->load->library('datatables', $config, 'datatable');
        $item_stock_result = $this->datatable->get_datatables();
        $data = array();
        $total_gross = 0;
        $total_fine = 0;
        foreach ($item_stock_result as $key => $item_stock_row) {
            $row = array();
            $row[] = $item_stock_row->item_name;
            $row[] = number_format($item_stock_row->gross, 3, '.', '');
            $row[] = $item_stock_row->touch;
//            $row[] = number_format($item_stock_row->fine, 3, '.', '');
            $data[] = $row;
            $total_gross = $total_gross + $item_stock_row->gross;
            $total_fine = $total_fine + $item_stock_row->fine;
        }

        // Total
        $row = array();
        $row[] = '<b>Total</b>';
        $row[] = '<b>' . number_format($total_gross, 3, '.', '') . '</b>';
        $row[] = '';
        $row[] = '<b>' . number_format($total_fine, 3, '.', '') . '</b>';
        $data[] = $row;

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all('mir.ir_date'),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function person_ledger() {
        if ($this->applib->have_access_role(PERSON_LEDGER_REPORT_MODULE_ID, "view")) { 
            $data = array();
            $this->load->view('report/person_ledger', $data);

        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function person_ledger_datatable() {
        $post_data = $this->input->post();
        if (!empty($post_data['from_date'])) {
            $from_date = date('Y-m-d', strtotime($post_data['from_date']));
        }
        if (!empty($post_data['to_date'])) {
            $to_date = date('Y-m-d', strtotime($post_data['to_date']));
        }
        $manufacture_ir_data = $this->crud->get_manufacture_ir_for_person_ledger($from_date, $to_date, $post_data['job_worker_id']);
        $payment_receipt_data = $this->crud->get_payment_receipt_person_ledger($from_date, $to_date, $post_data['job_worker_id']);
//        print_r($manufacture_ir_data); exit;
        $person_ledger_data = array_merge($manufacture_ir_data, $payment_receipt_data);
        uasort($person_ledger_data, function($a, $b) {
            $value1 = strtotime($a->row_date);
            $value2 = strtotime($b->row_date);
            return $value1 - $value2;
        });

        $data = array();
        $total_receive_gross = 0;
        $total_receive_item_weight = 0;
        $total_receive_kundan = 0;
        $total_receive_meena = 0;
        $total_receive_moti = 0;
        $total_receive_stone_weight = 0;
        $total_receive_stone_pcs = 0;
        $total_receive_fine = 0;
        $total_receive_amount = 0;
        $total_issue_gross = 0;
        $total_issue_moti = 0;
        $total_issue_stone_weight = 0;
        $total_issue_stone_pcs = 0;
        $total_issue_fine = 0;
        $total_issue_amount = 0;
        $total_issue_v_pcs = 0;
        $total_receive_v_pcs = 0;
        $balance_bandhanu = 0;
        $manufacture_ids_arr = array();
        foreach ($person_ledger_data as $key => $person_ledger_row) {
            $row_date = date('d-m-Y', strtotime($person_ledger_row->row_date));
            $receive_gross = '';
            $receive_item_weight = '';
            $receive_kundan = '';
            $receive_meena = '';
            $receive_moti = '';
            $receive_stone_weight = '';
            $receive_stone_pcs = '';
            $receive_fine = '';
            $receive_amount = '';
            $issue_gross = '';
            $issue_moti = '';
            $issue_stone_weight = '';
            $issue_stone_pcs = '';
            $issue_fine = '';
            $issue_amount = '';

            if (isset($person_ledger_row->manufacture_ir_id)) {
                if ($person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID || $person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID) {
                    if ($person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID) {
                        $particular = 'Receive Finish';
                        // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                        if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                            $balance_bandhanu = $balance_bandhanu - number_format($person_ledger_row->gross, 3, '.', '');
                        }
                    } else {
                        $particular = 'Receive Scrap';
                    }
                    $particular = $particular . '<br>Job Card : ' . $person_ledger_row->job_card_no . '<br>' . $person_ledger_row->item_name;
                    $receive_gross = number_format($person_ledger_row->gross, 3, '.', '');
                    $receive_item_weight = number_format($person_ledger_row->item_weight, 3, '.', '');
                    $receive_kundan = number_format($person_ledger_row->kundan, 3, '.', '');
                    $receive_meena = number_format($person_ledger_row->meena_wt, 3, '.', '');
                    $receive_moti = number_format($person_ledger_row->moti, 3, '.', '');
                    $receive_stone_weight = number_format($person_ledger_row->stone_weight, 3, '.', '');
                    $receive_stone_pcs = number_format($person_ledger_row->stone_pcs, 2, '.', '');
                    $receive_fine = number_format($person_ledger_row->fine, 3, '.', '');
                    $receive_amount = number_format($person_ledger_row->stone_charges, 2, '.', '') + number_format($person_ledger_row->other_charges, 2, '.', '');
                    $receive_amount = number_format($receive_amount, 2, '.', '');

                    if($person_ledger_row->close_to_calculate_loss == '1'){
                        $total_receive_v_pcs = $total_receive_v_pcs + $person_ledger_row->v_pcs;
                    }
                } else if ($person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                    if ($person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID) {
                        $particular = 'Issue Finish';
                    } else {
                        $particular = 'Issue Scrap';
                    }
                    // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                    if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                        $balance_bandhanu = $balance_bandhanu + number_format($person_ledger_row->gross, 3, '.', '');
                    }
                    $particular = $particular . '<br>Job Card : ' . $person_ledger_row->job_card_no . '<br>' . $person_ledger_row->item_name;
                    $issue_gross = number_format($person_ledger_row->gross, 3, '.', '');
                    $issue_moti = number_format($person_ledger_row->moti, 3, '.', '');
                    $issue_stone_weight = number_format($person_ledger_row->stone_weight, 3, '.', '');
                    $issue_stone_pcs = number_format($person_ledger_row->stone_pcs, 2, '.', '');
                    $issue_fine = number_format($person_ledger_row->fine, 3, '.', '');
                    $issue_amount = number_format($person_ledger_row->stone_charges, 2, '.', '') + number_format($person_ledger_row->other_charges, 2, '.', '');
                    $issue_amount = number_format($issue_amount, 2, '.', '');

                    if($person_ledger_row->close_to_calculate_loss == '1'){
                        $total_issue_v_pcs = $total_issue_v_pcs + $person_ledger_row->v_pcs;
                    }
                }

                // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                    if(in_array($person_ledger_row->manufacture_id, $manufacture_ids_arr)){ } else {
                        $balance_bandhanu = $balance_bandhanu - $person_ledger_row->used_moti;
                        $balance_bandhanu = $balance_bandhanu - $person_ledger_row->used_vetran;
                        $manufacture_ids_arr[] = $person_ledger_row->manufacture_id;
                    }
                }

            } else if (isset($person_ledger_row->payment_receipt_id)) {
                $particular = 'Payment Receipt';
                if(!empty($person_ledger_row->item_name)){
                    $particular .= '<br>' . $person_ledger_row->item_name;
                }
                if ($person_ledger_row->weight_jama_udhar == '1') {
                    $receive_gross = number_format($person_ledger_row->weight, 3, '.', '');
                    $receive_fine = number_format($person_ledger_row->fine, 3, '.', '');
                } else {
                    $issue_gross = number_format($person_ledger_row->weight, 3, '.', '');
                    $issue_fine = number_format($person_ledger_row->fine, 3, '.', '');
                }
                if ($person_ledger_row->amount_jama_udhar == '1') {
                    $receive_amount = number_format($person_ledger_row->amount, 3, '.', '');
                } else {
                    $issue_amount = number_format($person_ledger_row->amount, 3, '.', '');
                }
            }

            $row = array();
            $row[] = $row_date;
            $row[] = $particular;
            $row[] = $receive_gross;
            $row[] = $receive_item_weight;
            $row[] = $receive_kundan;
            $row[] = $receive_meena;
            $row[] = $receive_moti;
            $row[] = $receive_stone_weight;
            $row[] = $receive_stone_pcs;
            $row[] = $receive_fine;
            $row[] = $receive_amount;
            $row[] = $issue_gross;
            $row[] = $issue_moti;
            $row[] = $issue_stone_weight;
            $row[] = $issue_stone_pcs;
            $row[] = $issue_fine;
            $row[] = $issue_amount;
            $data[] = $row;

            $total_receive_gross = $total_receive_gross + $receive_gross;
            $total_receive_item_weight = $total_receive_item_weight + $receive_item_weight;
            $total_receive_kundan = $total_receive_kundan + $receive_kundan;
            $total_receive_meena = $total_receive_meena + $receive_meena;
            $total_receive_moti = $total_receive_moti + $receive_moti;
            $total_receive_stone_weight = $total_receive_stone_weight + $receive_stone_weight;
            $total_receive_stone_pcs = $total_receive_stone_pcs + $receive_stone_pcs;
            $total_receive_fine = $total_receive_fine + $receive_fine;
            $total_receive_amount = $total_receive_amount + $receive_amount;
            $total_issue_gross = $total_issue_gross + $issue_gross;
            $total_issue_moti = $total_issue_moti + $issue_moti;
            $total_issue_stone_weight = $total_issue_stone_weight + $issue_stone_weight;
            $total_issue_stone_pcs = $total_issue_stone_pcs + $issue_stone_pcs;
            $total_issue_fine = $total_issue_fine + $issue_fine;
            $total_issue_amount = $total_issue_amount + $issue_amount;
        }

        // Total
        $row = array();
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '<b>' . number_format($total_receive_gross, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_item_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_kundan, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_meena, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_moti, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_stone_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_stone_pcs, 2, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_fine, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_amount, 2, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_gross, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_moti, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_stone_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_stone_pcs, 2, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_fine, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_amount, 2, '.', '') . '</b>';
        $data[] = $row;

        $balance_v_pcs = $total_issue_v_pcs - $total_receive_v_pcs;
        $kaarigar_balance_gross = $total_receive_gross - $total_issue_gross;
        $kaarigar_balance_fine = $total_receive_fine - $total_issue_fine;
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($person_ledger_data),
            "recordsFiltered" => count($person_ledger_data),
            "data" => $data,
            "total_issue_v_pcs" => number_format((float) $total_issue_v_pcs, 0, '.', ''),
            "total_receive_v_pcs" => number_format((float) $total_receive_v_pcs, 0, '.', ''),
            "balance_v_pcs" => number_format((float) $balance_v_pcs, 0, '.', ''),
            "kaarigar_balance_gross" => number_format((float) $kaarigar_balance_gross, 3, '.', ''),
            "kaarigar_balance_fine" => number_format((float) $kaarigar_balance_fine, 3, '.', ''),
            "balance_bandhanu" => number_format((float) $balance_bandhanu, 3, '.', ''),
        );
        echo json_encode($output);
    }

    function person_new_ledger() {
        if ($this->applib->have_access_role(PERSON_LEDGER_REPORT_MODULE_ID, "view")) { 
            $data = array();
            $this->load->view('report/person_new_ledger', $data);

        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function person_new_ledger_datatable() {
        $post_data = $this->input->post();
        if (!empty($post_data['from_date'])) {
            $from_date = date('Y-m-d', strtotime($post_data['from_date']));
        }
        if (!empty($post_data['to_date'])) {
            $to_date = date('Y-m-d', strtotime($post_data['to_date']));
        }
        $manufacture_ir_data = $this->crud->get_manufacture_ir_for_person_ledger($from_date, $to_date, $post_data['job_worker_id']);
        $payment_receipt_data = $this->crud->get_payment_receipt_person_ledger($from_date, $to_date, $post_data['job_worker_id']);
//        print_r($manufacture_ir_data); exit;
        $person_ledger_data = array_merge($manufacture_ir_data, $payment_receipt_data);
        uasort($person_ledger_data, function($a, $b) {
            $value1 = strtotime($a->row_date);
            $value2 = strtotime($b->row_date);
            return $value1 - $value2;
        });

        $receive_rows = array();
        $issue_rows = array();
        $data = array();
        $total_receive_gross = 0;
        $total_receive_item_weight = 0;
        $total_receive_kundan = 0;
        $total_receive_meena = 0;
        $total_receive_moti = 0;
        $total_receive_stone_weight = 0;
        $total_receive_stone_pcs = 0;
        $total_receive_fine = 0;
        $total_receive_amount = 0;
        $total_issue_gross = 0;
        $total_issue_moti = 0;
        $total_issue_stone_weight = 0;
        $total_issue_stone_pcs = 0;
        $total_issue_fine = 0;
        $total_issue_amount = 0;
        $total_issue_v_pcs = 0;
        $total_receive_v_pcs = 0;
        $balance_bandhanu = 0;
        $manufacture_ids_arr = array();
        foreach ($person_ledger_data as $key => $person_ledger_row) {
            $row_date = date('d-m-Y', strtotime($person_ledger_row->row_date));
            $receive_gross = '';
            $receive_item_weight = '';
            $receive_kundan = '';
            $receive_meena = '';
            $receive_moti = '';
            $receive_stone_weight = '';
            $receive_stone_pcs = '';
            $receive_fine = '';
            $receive_amount = '';
            $issue_gross = '';
            $issue_moti = '';
            $issue_stone_weight = '';
            $issue_stone_pcs = '';
            $issue_fine = '';
            $issue_amount = '';

            if (isset($person_ledger_row->manufacture_ir_id)) {
                if ($person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID || $person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID) {
                    if ($person_ledger_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID) {
                        $particular = 'Receive Finish';
                        // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                        if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                            $balance_bandhanu = $balance_bandhanu - number_format($person_ledger_row->gross, 3, '.', '');
                        }
                    } else {
                        $particular = 'Receive Scrap';
                    }
                    $particular = $particular . '<br>Job Card : ' . $person_ledger_row->job_card_no . '<br>' . $person_ledger_row->item_name;
                    $receive_gross = number_format($person_ledger_row->gross, 3, '.', '');
                    $receive_item_weight = number_format($person_ledger_row->item_weight, 3, '.', '');
                    $receive_kundan = number_format($person_ledger_row->kundan, 3, '.', '');
                    $receive_meena = number_format($person_ledger_row->meena_wt, 3, '.', '');
                    $receive_moti = number_format($person_ledger_row->moti, 3, '.', '');
                    $receive_stone_weight = number_format($person_ledger_row->stone_weight, 3, '.', '');
                    $receive_stone_pcs = number_format($person_ledger_row->stone_pcs, 2, '.', '');
                    $receive_fine = number_format($person_ledger_row->fine, 3, '.', '');
                    $receive_amount = number_format($person_ledger_row->stone_charges, 2, '.', '') + number_format($person_ledger_row->other_charges, 2, '.', '');
                    $receive_amount = number_format($receive_amount, 2, '.', '');

                    if($person_ledger_row->close_to_calculate_loss == '1'){
                        $total_receive_v_pcs = $total_receive_v_pcs + $person_ledger_row->v_pcs;
                    }
                } else if ($person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                    if ($person_ledger_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID) {
                        $particular = 'Issue Finish';
                    } else {
                        $particular = 'Issue Scrap';
                    }
                    // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                    if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                        $balance_bandhanu = $balance_bandhanu + number_format($person_ledger_row->gross, 3, '.', '');
                    }
                    $particular = $particular . '<br>Job Card : ' . $person_ledger_row->job_card_no . '<br>' . $person_ledger_row->item_name;
                    $issue_gross = number_format($person_ledger_row->gross, 3, '.', '');
                    $issue_moti = number_format($person_ledger_row->moti, 3, '.', '');
                    $issue_stone_weight = number_format($person_ledger_row->stone_weight, 3, '.', '');
                    $issue_stone_pcs = number_format($person_ledger_row->stone_pcs, 2, '.', '');
                    $issue_fine = number_format($person_ledger_row->fine, 3, '.', '');
                    $issue_amount = number_format($person_ledger_row->stone_charges, 2, '.', '') + number_format($person_ledger_row->other_charges, 2, '.', '');
                    $issue_amount = number_format($issue_amount, 2, '.', '');

                    if($person_ledger_row->close_to_calculate_loss == '1'){
                        $total_issue_v_pcs = $total_issue_v_pcs + $person_ledger_row->v_pcs;
                    }
                }

                // `Balance Bandhanu ` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran
                if($person_ledger_row->process_id == BANDHANU_PROCESS_ID){
                    if(in_array($person_ledger_row->manufacture_id, $manufacture_ids_arr)){ } else {
                        $balance_bandhanu = $balance_bandhanu - $person_ledger_row->used_moti;
                        $balance_bandhanu = $balance_bandhanu - $person_ledger_row->used_vetran;
                        $manufacture_ids_arr[] = $person_ledger_row->manufacture_id;
                    }
                }

            } else if (isset($person_ledger_row->payment_receipt_id)) {
                $particular = 'Payment Receipt';
                if(!empty($person_ledger_row->item_name)){
                    $particular .= '<br>' . $person_ledger_row->item_name;
                }
                if ($person_ledger_row->weight_jama_udhar == '1') {
                    $receive_gross = number_format($person_ledger_row->weight, 3, '.', '');
                    $receive_fine = number_format($person_ledger_row->fine, 3, '.', '');
                } else {
                    $issue_gross = number_format($person_ledger_row->weight, 3, '.', '');
                    $issue_fine = number_format($person_ledger_row->fine, 3, '.', '');
                }
                if ($person_ledger_row->amount_jama_udhar == '1') {
                    $receive_amount = number_format($person_ledger_row->amount, 3, '.', '');
                } else {
                    $issue_amount = number_format($person_ledger_row->amount, 3, '.', '');
                }
            }

            if(!empty($receive_gross) || !empty($receive_amount)){
                $receive_row = array();
                $receive_row[0] = $row_date;
                $receive_row[1] = $particular;
                $receive_row[2] = $receive_gross;
                $receive_row[3] = $receive_item_weight;
                $receive_row[4] = $receive_kundan;
                $receive_row[5] = $receive_meena;
                $receive_row[6] = $receive_moti;
                $receive_row[7] = $receive_stone_weight;
                $receive_row[8] = $receive_stone_pcs;
                $receive_row[9] = $receive_fine;
                $receive_row[10] = $receive_amount;
                $receive_rows[] = $receive_row;
            }
            if(!empty($issue_gross) || !empty($issue_amount)){
                $issue_row = array();
                $issue_row[11] = $row_date;
                $issue_row[12] = $particular;
                $issue_row[13] = $issue_gross;
                $issue_row[14] = $issue_moti;
                $issue_row[15] = $issue_stone_weight;
                $issue_row[16] = $issue_stone_pcs;
                $issue_row[17] = $issue_fine;
                $issue_row[18] = $issue_amount;
                $issue_rows[] = $issue_row;
            }

            $total_receive_gross = $total_receive_gross + $receive_gross;
            $total_receive_item_weight = $total_receive_item_weight + $receive_item_weight;
            $total_receive_kundan = $total_receive_kundan + $receive_kundan;
            $total_receive_meena = $total_receive_meena + $receive_meena;
            $total_receive_moti = $total_receive_moti + $receive_moti;
            $total_receive_stone_weight = $total_receive_stone_weight + $receive_stone_weight;
            $total_receive_stone_pcs = $total_receive_stone_pcs + $receive_stone_pcs;
            $total_receive_fine = $total_receive_fine + $receive_fine;
            $total_receive_amount = $total_receive_amount + $receive_amount;
            $total_issue_gross = $total_issue_gross + $issue_gross;
            $total_issue_moti = $total_issue_moti + $issue_moti;
            $total_issue_stone_weight = $total_issue_stone_weight + $issue_stone_weight;
            $total_issue_stone_pcs = $total_issue_stone_pcs + $issue_stone_pcs;
            $total_issue_fine = $total_issue_fine + $issue_fine;
            $total_issue_amount = $total_issue_amount + $issue_amount;
        }

//        print_r($receive_rows);
//        print_r($issue_rows); exit;
        $receive_rows_count = count($receive_rows);
        $issue_rows_count = count($issue_rows);
        $loop_inc = 0;
        if($receive_rows_count < $issue_rows_count){
            $loop_inc = $issue_rows_count;
        } else {
            $loop_inc = $receive_rows_count;
        }
        for($i = 0; $i < $loop_inc; $i++){
            $row = array();
            $row[] = $receive_rows[$i][0];
            $row[] = $receive_rows[$i][1];
            $row[] = $receive_rows[$i][2];
            $row[] = $receive_rows[$i][3];
            $row[] = $receive_rows[$i][4];
            $row[] = $receive_rows[$i][5];
            $row[] = $receive_rows[$i][6];
            $row[] = $receive_rows[$i][7];
            $row[] = $receive_rows[$i][8];
            $row[] = $receive_rows[$i][9];
            $row[] = $receive_rows[$i][10];
            $row[] = $issue_rows[$i][11];
            $row[] = $issue_rows[$i][12];
            $row[] = $issue_rows[$i][13];
            $row[] = $issue_rows[$i][14];
            $row[] = $issue_rows[$i][15];
            $row[] = $issue_rows[$i][16];
            $row[] = $issue_rows[$i][17];
            $row[] = $issue_rows[$i][18];
            $data[] = $row;
        }

        // Total
        $row = array();
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '<b>' . number_format($total_receive_gross, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_item_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_kundan, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_meena, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_moti, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_stone_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_stone_pcs, 2, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_fine, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_receive_amount, 2, '.', '') . '</b>';
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '<b>' . number_format($total_issue_gross, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_moti, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_stone_weight, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_stone_pcs, 2, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_fine, 3, '.', '') . '</b>';
        $row[] = '<b>' . number_format($total_issue_amount, 2, '.', '') . '</b>';
        $data[] = $row;

        $balance_v_pcs = $total_issue_v_pcs - $total_receive_v_pcs;
        $kaarigar_balance_gross = $total_receive_gross - $total_issue_gross;
        $kaarigar_balance_fine = $total_receive_fine - $total_issue_fine;
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($person_ledger_data),
            "recordsFiltered" => count($person_ledger_data),
            "data" => $data,
            "total_issue_v_pcs" => number_format((float) $total_issue_v_pcs, 0, '.', ''),
            "total_receive_v_pcs" => number_format((float) $total_receive_v_pcs, 0, '.', ''),
            "balance_v_pcs" => number_format((float) $balance_v_pcs, 0, '.', ''),
            "kaarigar_balance_gross" => number_format((float) $kaarigar_balance_gross, 3, '.', ''),
            "kaarigar_balance_fine" => number_format((float) $kaarigar_balance_fine, 3, '.', ''),
            "balance_bandhanu" => number_format((float) $balance_bandhanu, 3, '.', ''),
        );
        echo json_encode($output);
    }

}
