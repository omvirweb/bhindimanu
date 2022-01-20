<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacture extends CI_Controller {

    public $logged_in_id = null;
    public $now_time = null;
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Appmodel', 'app_model');
        $this->load->model('Crud', 'crud');
        if (!$this->session->userdata('bhindimanu_is_logged_in')) {
            redirect('/auth/login/');
        }
        $this->logged_in_id = $this->session->userdata('bhindimanu_is_logged_in')['user_id'];
        $this->now_time = date('Y-m-d H:i:s');
    }
	
    function add($manufacture_id = '', $view_pwm = '') {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "edit") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $data = array();
            $data['view_pwm'] = $view_pwm;
            if(!empty($manufacture_id)) {
                $data['manufacture_row'] = $this->crud->get_data_row_by_id('manufacture', 'manufacture_id', $manufacture_id);
                if($view_pwm == 'view_process_wise_manufacture'){
                    $manufacture_ir_res = array();
                    $this->db->select('mir.*,i.item_name as item_id_text,jw.job_worker as job_worker_id_text');
                    $this->db->from('manufacture_issue_receive mir');
                    $this->db->join('item i','i.item_id = mir.item_id','left');
                    $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
                    $this->db->where('mir.job_card_id', $data['manufacture_row']->job_card_id);
                    $this->db->where('mir.process_id', $data['manufacture_row']->process_id);
                    $query = $this->db->get();
                    if($query->num_rows() > 0) {
                        $manufacture_ir_res = $query->result();
                    }
                } else {
                    $manufacture_ir_res = array();
                    $this->db->select('mir.*,i.item_name as item_id_text,jw.job_worker as job_worker_id_text');
                    $this->db->from('manufacture_issue_receive mir');
                    $this->db->join('item i','i.item_id = mir.item_id','left');
                    $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
                    $this->db->where('mir.manufacture_id', $manufacture_id);
                    $query = $this->db->get();
                    if($query->num_rows() > 0) {
                        $manufacture_ir_res = $query->result();
                    }
                }
                $lineitem_objectdata = array();
                foreach ($manufacture_ir_res as $key => $manufacture_ir_row) {
                    $lineitem = array();
                    $lineitem['manufacture_ir_id'] = $manufacture_ir_row->manufacture_ir_id;
                    $lineitem['manufacture_id'] = $manufacture_id;
                    $lineitem['type_id'] = $manufacture_ir_row->type_id;
                    $lineitem['ir_date'] = date('d-m-Y', strtotime($manufacture_ir_row->ir_date));
                    $lineitem['item_id'] = $manufacture_ir_row->item_id;
                    $lineitem['item_id_text'] = $manufacture_ir_row->item_id_text;
                    $lineitem['job_worker_id'] = $manufacture_ir_row->job_worker_id;
                    $lineitem['job_worker_id_text'] = $manufacture_ir_row->job_worker_id_text;
                    $lineitem['gross'] = (!empty($manufacture_ir_row->gross)) ? $manufacture_ir_row->gross : 0;
                    $lineitem['touch'] = (!empty($manufacture_ir_row->touch)) ? $manufacture_ir_row->touch : 0;
                    $lineitem['wastage'] = (!empty($manufacture_ir_row->wastage)) ? $manufacture_ir_row->wastage : 0;
                    $lineitem['fine'] = (!empty($manufacture_ir_row->fine)) ? $manufacture_ir_row->fine : 0;
                    $lineitem['ad_weight'] = (!empty($manufacture_ir_row->ad_weight)) ? $manufacture_ir_row->ad_weight : 0;
                    $lineitem['ad_pcs'] = (!empty($manufacture_ir_row->ad_pcs)) ? $manufacture_ir_row->ad_pcs : 0;
                    $lineitem['before_meena'] = (!empty($manufacture_ir_row->before_meena)) ? $manufacture_ir_row->before_meena : 0;
                    $lineitem['meena_wt'] = (!empty($manufacture_ir_row->meena_wt)) ? $manufacture_ir_row->meena_wt : 0;
                    $lineitem['item_weight'] = (!empty($manufacture_ir_row->item_weight)) ? $manufacture_ir_row->item_weight : 0;
                    $lineitem['kundan'] = (!empty($manufacture_ir_row->kundan)) ? $manufacture_ir_row->kundan : 0;
                    $lineitem['sm'] = (!empty($manufacture_ir_row->sm)) ? $manufacture_ir_row->sm : 0;
                    $lineitem['vetran'] = (!empty($manufacture_ir_row->vetran)) ? $manufacture_ir_row->vetran : 0;
                    $lineitem['v_pcs'] = (!empty($manufacture_ir_row->v_pcs)) ? $manufacture_ir_row->v_pcs : 0;
                    $lineitem['stone_pcs'] = (!empty($manufacture_ir_row->stone_pcs)) ? $manufacture_ir_row->stone_pcs : 0;
                    $lineitem['stone_weight'] = (!empty($manufacture_ir_row->stone_weight)) ? $manufacture_ir_row->stone_weight : 0;
                    $lineitem['stone_charges'] = (!empty($manufacture_ir_row->stone_charges)) ? $manufacture_ir_row->stone_charges : 0;
                    $lineitem['moti'] = (!empty($manufacture_ir_row->moti)) ? $manufacture_ir_row->moti : 0;
                    $lineitem['moti_amount'] = (!empty($manufacture_ir_row->moti_amount)) ? $manufacture_ir_row->moti_amount : 0;
                    $lineitem['other_charges'] = (!empty($manufacture_ir_row->other_charges)) ? $manufacture_ir_row->other_charges : 0;
                    $lineitem['loss'] = (!empty($manufacture_ir_row->loss)) ? $manufacture_ir_row->loss : 0;
                    $lineitem['loss_fine'] = (!empty($manufacture_ir_row->loss_fine)) ? $manufacture_ir_row->loss_fine : 0;
                    $lineitem['item_remark'] = (!empty($manufacture_ir_row->item_remark)) ? $manufacture_ir_row->item_remark : '';
                    $lineitem['image'] = (!empty($manufacture_ir_row->image)) ? $manufacture_ir_row->image : '';

                    // IR Gross Details
                    $lineitem['gross_details'] = '';
                    $gross_details = $this->crud->get_row_by_id('manufacture_ir_gross_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_row->manufacture_ir_id));
                    if(!empty($gross_details)){
                        $gross_details_data = array();
                        foreach ($gross_details as $gross_detail){
                            $gross_details_lineitem = new \stdClass();
                            $gross_details_lineitem->gross_details_id = $gross_detail->gross_details_id;
                            $gross_details_lineitem->gross_detail_item_id = $gross_detail->gross_detail_item_id;
                            $gross_details_lineitem->item_name = $this->crud->get_column_value_by_id('item', 'item_name', array('item_id' => $gross_detail->gross_detail_item_id));
                            $gross_details_lineitem->gross_detail_weight = (!empty($gross_detail->gross_detail_weight)) ? $gross_detail->gross_detail_weight : 0;
                            $gross_details_data[] = json_encode($gross_details_lineitem);
                        }
                        $lineitem['gross_details'] = '['.implode(',', $gross_details_data).']';
                    }

                    // IR Stone Pcs Details
                    $lineitem['stone_pcs_details'] = '';
                    $stone_pcs_details = $this->crud->get_row_by_id('manufacture_ir_stone_pcs_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_row->manufacture_ir_id));
                    if(!empty($stone_pcs_details)){
                        $stone_pcs_details_data = array();
                        foreach ($stone_pcs_details as $stone_pcs_detail){
                            $stone_pcs_details_lineitem = new \stdClass();
                            $stone_pcs_details_lineitem->stone_pcs_details_id = $stone_pcs_detail->stone_pcs_details_id;
                            $stone_pcs_details_lineitem->stone_detail_pcs = (!empty($stone_pcs_detail->stone_detail_pcs)) ? $stone_pcs_detail->stone_detail_pcs : 0;
                            $stone_pcs_details_lineitem->stone_detail_weight = (!empty($stone_pcs_detail->stone_detail_weight)) ? $stone_pcs_detail->stone_detail_weight : 0;
                            $stone_pcs_details_lineitem->stone_detail_rate = (!empty($stone_pcs_detail->stone_detail_rate)) ? $stone_pcs_detail->stone_detail_rate : 0;
                            $stone_pcs_details_lineitem->stone_detail_amount = (!empty($stone_pcs_detail->stone_detail_amount)) ? $stone_pcs_detail->stone_detail_amount : 0;
                            $stone_pcs_details_data[] = json_encode($stone_pcs_details_lineitem);
                        }
                        $lineitem['stone_pcs_details'] = '['.implode(',', $stone_pcs_details_data).']';
                    }

                    // IR Moti Details
                    $lineitem['moti_details'] = '';
                    $moti_details = $this->crud->get_row_by_id('manufacture_ir_moti_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_row->manufacture_ir_id));
                    if(!empty($moti_details)){
                        $moti_details_data = array();
                        foreach ($moti_details as $moti_detail){
                            $moti_details_lineitem = new \stdClass();
                            $moti_details_lineitem->moti_details_id = $moti_detail->moti_details_id;
                            $moti_details_lineitem->moti_id = $moti_detail->moti_id;
                            $moti_details_lineitem->moti_name = $this->crud->get_column_value_by_id('moti', 'moti_name', array('moti_id' => $moti_detail->moti_id));
                            $moti_details_lineitem->moti_weight = (!empty($moti_detail->moti_weight)) ? $moti_detail->moti_weight : 0;
                            $moti_details_lineitem->moti_rate = (!empty($moti_detail->moti_rate)) ? $moti_detail->moti_rate : 0;
                            $moti_details_lineitem->moti_detail_amount = (!empty($moti_detail->moti_detail_amount)) ? $moti_detail->moti_detail_amount : 0;
                            $moti_details_data[] = json_encode($moti_details_lineitem);
                        }
                        $lineitem['moti_details'] = '['.implode(',', $moti_details_data).']';
                    }

                    // IR Other Charges Details
                    $lineitem['other_charges_details'] = '';
                    $other_charges_details = $this->crud->get_row_by_id('manufacture_ir_other_charges_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_row->manufacture_ir_id));
                    if(!empty($other_charges_details)){
                        $other_charges_details_data = array();
                        foreach ($other_charges_details as $other_charges_detail){
                            $other_charges_details_lineitem = new \stdClass();
                            $other_charges_details_lineitem->other_charges_details_id = $other_charges_detail->other_charges_details_id;
                            $other_charges_details_lineitem->charges_id = $other_charges_detail->charges_id;
                            $other_charges_details_lineitem->charges_name = $this->crud->get_column_value_by_id('charges', 'charges_name', array('charges_id' => $other_charges_detail->charges_id));
                            $other_charges_details_lineitem->charges_amount = (!empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                            $other_charges_details_data[] = json_encode($other_charges_details_lineitem);
                        }
                        $lineitem['other_charges_details'] = '['.implode(',', $other_charges_details_data).']';
                    }
                    $lineitem_objectdata[] = $lineitem;
                }
                $data['lineitem_objectdata'] = json_encode($lineitem_objectdata,true);
//                print_r($data); exit;
            }
            $this->load->view('manufacture/add', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_manufacture(){
        $post_data = $this->input->post();
        $manufacture_id = 0;
        $manufacture_issue_receive = json_decode($_POST['manufacture_issue_receive'], true);
//        echo "<pre>"; print_r($post_data); exit;
//        echo "<pre>"; print_r($manufacture_issue_receive); exit;
        $manufacture_data = array(
            'job_card_id' => $post_data['job_card_id'],
            'process_id' => $post_data['process_id'],
            'remark' => trim($post_data['remark']),
            'close_to_calculate_loss' => $post_data['close_to_calculate_loss'],
        );

        $selected_process_issue_fields = array();
        $selected_process_receive_fields = array();
        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $post_data['process_id']);
        if (!empty($process_row->process_issue_fields)) {
            $selected_process_issue_fields = explode(',', $process_row->process_issue_fields);
        }
        if (!empty($process_row->process_receive_fields)) {
            $selected_process_receive_fields = explode(',', $process_row->process_receive_fields);
        }
        $issue_type_ids = array(MANUFACTURE_TYPE_ISSUE_FINISH_ID, MANUFACTURE_TYPE_ISSUE_SCRAP_ID);
        $receive_type_ids = array(MANUFACTURE_TYPE_RECEIVE_FINISH_ID, MANUFACTURE_TYPE_RECEIVE_SCRAP_ID);

        $manufacture_data['used_vetran'] = (isset($post_data['used_vetran']) && !empty($post_data['used_vetran'])) ? $post_data['used_vetran'] : 0;
        $manufacture_data['used_moti'] = (isset($post_data['used_moti']) && !empty($post_data['used_moti'])) ? $post_data['used_moti'] : 0;
        if (!empty($post_data['manufacture_id'])) {
            $manufacture_id = $post_data['manufacture_id'];
            $old_manufacture_issue_receive_data = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_id));
            if(!empty($old_manufacture_issue_receive_data)){
                foreach ($old_manufacture_issue_receive_data as $old_manufacture_issue_receive_row) {
                    // Revert Item Stock
                    if ($old_manufacture_issue_receive_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $old_manufacture_issue_receive_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                        // Issue to Increase
                        $this->applib->update_item_stock_increase($old_manufacture_issue_receive_row->item_id, $old_manufacture_issue_receive_row->gross, $old_manufacture_issue_receive_row->touch, $old_manufacture_issue_receive_row->fine);
                        // Job Worker Fine Increase
                        $this->applib->update_job_worker_balance_increase($old_manufacture_issue_receive_row->job_worker_id, $old_manufacture_issue_receive_row->fine, '');
                    } else {
                        // Receive to Decrease
                        $this->applib->update_item_stock_decrease($old_manufacture_issue_receive_row->item_id, $old_manufacture_issue_receive_row->gross, $old_manufacture_issue_receive_row->touch, $old_manufacture_issue_receive_row->fine);
                        // Job Worker Fine / Stone Charges Decrease
                        $this->applib->update_job_worker_balance_decrease($old_manufacture_issue_receive_row->job_worker_id, $old_manufacture_issue_receive_row->fine, $old_manufacture_issue_receive_row->stone_charges);
                    }

                    // Revert Job Worker Other Charges Decrease
                    $old_manufacture_ir_other_charges_data = $this->crud->get_row_by_id('manufacture_ir_other_charges_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $old_manufacture_issue_receive_row->manufacture_ir_id));
                    if(!empty($old_manufacture_ir_other_charges_data)){
                        foreach ($old_manufacture_ir_other_charges_data as $old_manufacture_ir_other_charges_row) {
                            $effect_person_ledger = $this->crud->get_column_value_by_id('charges', 'effect_person_ledger', array('charges_id' => $old_manufacture_ir_other_charges_row->charges_id));
                            if($effect_person_ledger == '1'){
                                $this->applib->update_job_worker_balance_decrease($old_manufacture_issue_receive_row->job_worker_id, '', $old_manufacture_ir_other_charges_row->charges_amount);
                            }
                        }
                    }
                }
            }

            $manufacture_data['updated_at'] = $this->applib->get_current_date_time();
            $manufacture_data['updated_by'] = $this->logged_in_id;
            
            $where_array['manufacture_id'] = $manufacture_id;
            $this->crud->update('manufacture', $manufacture_data, $where_array);
            if (!empty($manufacture_issue_receive)) {
                $new_ids = array();
                foreach ($manufacture_issue_receive as $manufacture_ir_row) {
                    $manufacture_item_data = array();
                    $manufacture_item_data['manufacture_id'] = $manufacture_id;
                    $manufacture_item_data['job_card_id'] = $post_data['job_card_id'];
                    $manufacture_item_data['process_id'] = $post_data['process_id'];
                    $manufacture_item_data['type_id'] = $manufacture_ir_row['type_id'];
                    $manufacture_item_data['ir_date'] = isset($manufacture_ir_row['ir_date']) && strtotime($manufacture_ir_row['ir_date']) > 0 ? date('Y-m-d', strtotime($manufacture_ir_row['ir_date'])) : NULL;
                    $manufacture_item_data['item_id'] = $manufacture_ir_row['item_id'];
                    $manufacture_item_data['job_worker_id'] = $manufacture_ir_row['job_worker_id'];
                    $manufacture_item_data['gross'] = (isset($manufacture_ir_row['gross']) && !empty($manufacture_ir_row['gross'])) ? $manufacture_ir_row['gross'] : 0;
                    $manufacture_item_data['touch'] = (isset($manufacture_ir_row['touch']) && !empty($manufacture_ir_row['touch'])) ? $manufacture_ir_row['touch'] : 0;
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_wastage', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_wastage', $selected_process_receive_fields))){
                        $manufacture_item_data['wastage'] = (isset($manufacture_ir_row['wastage']) && !empty($manufacture_ir_row['wastage'])) ? $manufacture_ir_row['wastage'] : 0;
                    } else {
                        $manufacture_item_data['wastage'] = 0;
                    }
                    $manufacture_item_data['fine'] = (isset($manufacture_ir_row['fine']) && !empty($manufacture_ir_row['fine'])) ? $manufacture_ir_row['fine'] : 0;
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_ad_weight', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_ad_weight', $selected_process_receive_fields))){
                        $manufacture_item_data['ad_weight'] = (isset($manufacture_ir_row['ad_weight']) && !empty($manufacture_ir_row['ad_weight'])) ? $manufacture_ir_row['ad_weight'] : 0;
                    } else {
                        $manufacture_item_data['ad_weight'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_ad_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_ad_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['ad_pcs'] = (isset($manufacture_ir_row['ad_pcs']) && !empty($manufacture_ir_row['ad_pcs'])) ? $manufacture_ir_row['ad_pcs'] : 0;
                    } else {
                        $manufacture_item_data['ad_pcs'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_before_meena', $selected_process_receive_fields)){
                        $manufacture_item_data['before_meena'] = (isset($manufacture_ir_row['before_meena']) && !empty($manufacture_ir_row['before_meena'])) ? $manufacture_ir_row['before_meena'] : 0;
                    } else {
                        $manufacture_item_data['before_meena'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_meena_wt', $selected_process_receive_fields)){
                        $manufacture_item_data['meena_wt'] = (isset($manufacture_ir_row['meena_wt']) && !empty($manufacture_ir_row['meena_wt'])) ? $manufacture_ir_row['meena_wt'] : 0;
                    } else {
                        $manufacture_item_data['meena_wt'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_item_weight', $selected_process_receive_fields)){
                        $manufacture_item_data['item_weight'] = (isset($manufacture_ir_row['item_weight']) && !empty($manufacture_ir_row['item_weight'])) ? $manufacture_ir_row['item_weight'] : 0;
                    } else {
                        $manufacture_item_data['item_weight'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_kundan', $selected_process_receive_fields)){
                        $manufacture_item_data['kundan'] = (isset($manufacture_ir_row['kundan']) && !empty($manufacture_ir_row['kundan'])) ? $manufacture_ir_row['kundan'] : 0;
                    } else {
                        $manufacture_item_data['kundan'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_sm', $selected_process_receive_fields)){
                        $manufacture_item_data['sm'] = (isset($manufacture_ir_row['sm']) && !empty($manufacture_ir_row['sm'])) ? $manufacture_ir_row['sm'] : 0;
                    } else {
                        $manufacture_item_data['sm'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_vetran', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_vetran', $selected_process_receive_fields))){
                        $manufacture_item_data['vetran'] = (isset($manufacture_ir_row['vetran']) && !empty($manufacture_ir_row['vetran'])) ? $manufacture_ir_row['vetran'] : 0;
                    } else {
                        $manufacture_item_data['vetran'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_v_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_v_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['v_pcs'] = (isset($manufacture_ir_row['v_pcs']) && !empty($manufacture_ir_row['v_pcs'])) ? $manufacture_ir_row['v_pcs'] : 0;
                    } else {
                        $manufacture_item_data['v_pcs'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_stone_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['stone_pcs'] = (isset($manufacture_ir_row['stone_pcs']) && !empty($manufacture_ir_row['stone_pcs'])) ? $manufacture_ir_row['stone_pcs'] : 0;
                    } else {
                        $manufacture_item_data['stone_pcs'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_stone_weight', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_weight', $selected_process_receive_fields))){
                        $manufacture_item_data['stone_weight'] = (isset($manufacture_ir_row['stone_weight']) && !empty($manufacture_ir_row['stone_weight'])) ? $manufacture_ir_row['stone_weight'] : 0;
                    } else {
                        $manufacture_item_data['stone_weight'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_charges', $selected_process_receive_fields)){
                        $manufacture_item_data['stone_charges'] = (isset($manufacture_ir_row['stone_charges']) && !empty($manufacture_ir_row['stone_charges'])) ? $manufacture_ir_row['stone_charges'] : 0;
                    } else {
                        $manufacture_item_data['stone_charges'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_moti', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_moti', $selected_process_receive_fields))){
                        $manufacture_item_data['moti'] = (isset($manufacture_ir_row['moti']) && !empty($manufacture_ir_row['moti'])) ? $manufacture_ir_row['moti'] : 0;
                    } else {
                        $manufacture_item_data['moti'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_moti_amount', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_moti_amount', $selected_process_receive_fields))){
                        $manufacture_item_data['moti_amount'] = (isset($manufacture_ir_row['moti_amount']) && !empty($manufacture_ir_row['moti_amount'])) ? $manufacture_ir_row['moti_amount'] : 0;
                    } else {
                        $manufacture_item_data['moti_amount'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_other_charges', $selected_process_receive_fields)){
                        $manufacture_item_data['other_charges'] = (isset($manufacture_ir_row['other_charges']) && !empty($manufacture_ir_row['other_charges'])) ? $manufacture_ir_row['other_charges'] : 0;
                    } else {
                        $manufacture_item_data['other_charges'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_loss', $selected_process_receive_fields)){
                        $manufacture_item_data['loss'] = (isset($manufacture_ir_row['loss']) && !empty($manufacture_ir_row['loss'])) ? $manufacture_ir_row['loss'] : 0;
                    } else {
                        $manufacture_item_data['loss'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_loss_fine', $selected_process_receive_fields)){
                        $manufacture_item_data['loss_fine'] = (isset($manufacture_ir_row['loss_fine']) && !empty($manufacture_ir_row['loss_fine'])) ? $manufacture_ir_row['loss_fine'] : 0;
                    } else {
                        $manufacture_item_data['loss_fine'] = 0;
                    }
                    $manufacture_item_data['item_remark'] = (isset($manufacture_ir_row['item_remark']) && !empty($manufacture_ir_row['item_remark'])) ? $manufacture_ir_row['item_remark'] : NULL;
                    if(isset($manufacture_ir_row['image']) && !empty($manufacture_ir_row['image'])){
                        $manufacture_item_data['image'] = $manufacture_ir_row['image'];
                    }
                    $manufacture_item_data['updated_by'] = $this->logged_in_id;
                    $manufacture_item_data['updated_at'] = $this->applib->get_current_date_time();
                    if (!empty($manufacture_ir_row['manufacture_ir_id'])) {
                        $manufacture_ir_where = array('manufacture_ir_id' => $manufacture_ir_row['manufacture_ir_id']);
                        $this->crud->update('manufacture_issue_receive', $manufacture_item_data, $manufacture_ir_where);
                        $manufacture_ir_id = $manufacture_ir_row['manufacture_ir_id'];
                    } else {
                        $manufacture_item_data['created_by'] = $this->logged_in_id;
                        $manufacture_item_data['created_at'] = $this->applib->get_current_date_time();
                        $manufacture_ir_id = $this->crud->insert('manufacture_issue_receive', $manufacture_item_data);
                    }
                    $new_ids[] = $manufacture_ir_id;

                    // Delete IR Gross details
                    $this->crud->delete('manufacture_ir_gross_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_id));
                    // Insert IR Gross details
                    if(isset($manufacture_ir_row['gross_details']) && !empty($manufacture_ir_row['gross_details'])){
                        $gross_details = json_decode($manufacture_ir_row['gross_details']);
                        foreach ($gross_details as $gross_detail){
                            $insert_gross_detail = array();
                            $insert_gross_detail['manufacture_id'] = $manufacture_id;
                            $insert_gross_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_gross_detail['gross_detail_item_id'] = (isset($gross_detail->gross_detail_item_id) && !empty($gross_detail->gross_detail_item_id)) ? $gross_detail->gross_detail_item_id : 0;
                            $insert_gross_detail['gross_detail_weight'] = (isset($gross_detail->gross_detail_weight) && !empty($gross_detail->gross_detail_weight)) ? $gross_detail->gross_detail_weight : 0;
                            $insert_gross_detail['created_by'] = $this->logged_in_id;
                            $insert_gross_detail['created_at'] = $this->now_time;
                            $insert_gross_detail['updated_by'] = $this->logged_in_id;
                            $insert_gross_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_gross_details', $insert_gross_detail);
                        }
                    }

                    // Delete IR Stone Pcs details
                    $this->crud->delete('manufacture_ir_stone_pcs_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_id));
                    // Insert IR Stone Pcs details
                    if(isset($manufacture_ir_row['stone_pcs_details']) && !empty($manufacture_ir_row['stone_pcs_details'])){
                        $stone_pcs_details = json_decode($manufacture_ir_row['stone_pcs_details']);
                        foreach ($stone_pcs_details as $stone_pcs_detail){
                            $insert_stone_pcs_detail = array();
                            $insert_stone_pcs_detail['manufacture_id'] = $manufacture_id;
                            $insert_stone_pcs_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_stone_pcs_detail['stone_detail_pcs'] = (isset($stone_pcs_detail->stone_detail_pcs) && !empty($stone_pcs_detail->stone_detail_pcs)) ? $stone_pcs_detail->stone_detail_pcs : 0;
                            $insert_stone_pcs_detail['stone_detail_weight'] = (isset($stone_pcs_detail->stone_detail_weight) && !empty($stone_pcs_detail->stone_detail_weight)) ? $stone_pcs_detail->stone_detail_weight : 0;
                            $insert_stone_pcs_detail['stone_detail_rate'] = (isset($stone_pcs_detail->stone_detail_rate) && !empty($stone_pcs_detail->stone_detail_rate)) ? $stone_pcs_detail->stone_detail_rate : 0;
                            $insert_stone_pcs_detail['stone_detail_amount'] = (isset($stone_pcs_detail->stone_detail_amount) && !empty($stone_pcs_detail->stone_detail_amount)) ? $stone_pcs_detail->stone_detail_amount : 0;
                            $insert_stone_pcs_detail['created_by'] = $this->logged_in_id;
                            $insert_stone_pcs_detail['created_at'] = $this->now_time;
                            $insert_stone_pcs_detail['updated_by'] = $this->logged_in_id;
                            $insert_stone_pcs_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_stone_pcs_details', $insert_stone_pcs_detail);
                        }
                    }

                    // Delete IR Moti details
                    $this->crud->delete('manufacture_ir_moti_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_id));
                    // Insert IR Moti details
                    if(isset($manufacture_ir_row['moti_details']) && !empty($manufacture_ir_row['moti_details'])){
                        $moti_details = json_decode($manufacture_ir_row['moti_details']);
                        foreach ($moti_details as $moti_detail){
                            $insert_moti_detail = array();
                            $insert_moti_detail['manufacture_id'] = $manufacture_id;
                            $insert_moti_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_moti_detail['moti_id'] = (isset($moti_detail->moti_id) && !empty($moti_detail->moti_id)) ? $moti_detail->moti_id : NULL;
                            $insert_moti_detail['moti_weight'] = (isset($moti_detail->moti_weight) && !empty($moti_detail->moti_weight)) ? $moti_detail->moti_weight : 0;
                            $insert_moti_detail['moti_rate'] = (isset($moti_detail->moti_rate) && !empty($moti_detail->moti_rate)) ? $moti_detail->moti_rate : 0;
                            $insert_moti_detail['moti_detail_amount'] = (isset($moti_detail->moti_detail_amount) && !empty($moti_detail->moti_detail_amount)) ? $moti_detail->moti_detail_amount : 0;
                            $insert_moti_detail['created_by'] = $this->logged_in_id;
                            $insert_moti_detail['created_at'] = $this->now_time;
                            $insert_moti_detail['updated_by'] = $this->logged_in_id;
                            $insert_moti_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_moti_details', $insert_moti_detail);
                        }
                    }

                    // Delete IR Other Charges details
                    $this->crud->delete('manufacture_ir_other_charges_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $manufacture_ir_id));
                    // Insert IR Other Charges details
                    if(isset($manufacture_ir_row['other_charges_details']) && !empty($manufacture_ir_row['other_charges_details'])){
                        $other_charges_details = json_decode($manufacture_ir_row['other_charges_details']);
                        foreach ($other_charges_details as $other_charges_detail){
                            $insert_other_charges_detail = array();
                            $insert_other_charges_detail['manufacture_id'] = $manufacture_id;
                            $insert_other_charges_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_other_charges_detail['charges_id'] = (isset($other_charges_detail->charges_id) && !empty($other_charges_detail->charges_id)) ? $other_charges_detail->charges_id : NULL;
                            $insert_other_charges_detail['charges_amount'] = (isset($other_charges_detail->charges_amount) && !empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                            $insert_other_charges_detail['created_by'] = $this->logged_in_id;
                            $insert_other_charges_detail['created_at'] = $this->now_time;
                            $insert_other_charges_detail['updated_by'] = $this->logged_in_id;
                            $insert_other_charges_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_other_charges_details', $insert_other_charges_detail);

                            // Update Job Worker Other Charges Increase
                            $effect_person_ledger = $this->crud->get_column_value_by_id('charges', 'effect_person_ledger', array('charges_id' => $insert_other_charges_detail['charges_id']));
                            if($effect_person_ledger == '1'){
                                $this->applib->update_job_worker_balance_increase($manufacture_item_data['job_worker_id'], '', $insert_other_charges_detail['charges_amount']);
                            }
                        }
                    }

                    // Update Item Stock
                    if ($manufacture_item_data['type_id'] == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manufacture_item_data['type_id'] == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                        // Issue to Decrease
                        $this->applib->update_item_stock_decrease($manufacture_item_data['item_id'], $manufacture_item_data['gross'], $manufacture_item_data['touch'], $manufacture_item_data['fine']);
                        // Update Job Worker Fine Decrease
                        $this->applib->update_job_worker_balance_decrease($manufacture_item_data['job_worker_id'], $manufacture_item_data['fine'], '');
                    } else {
                        // Receive to Increase
                        $this->applib->update_item_stock_increase($manufacture_item_data['item_id'], $manufacture_item_data['gross'], $manufacture_item_data['touch'], $manufacture_item_data['fine']);
                        // Update Job Worker Fine / Stone Charges Increase
                        $this->applib->update_job_worker_balance_increase($manufacture_item_data['job_worker_id'], $manufacture_item_data['fine'], $manufacture_item_data['stone_charges']);
                    }
                }
                if (!empty($new_ids)) {
                    $new_ids[] = '-1';
                }
                $this->db->select('*');
                $this->db->from('manufacture_issue_receive');
                $this->db->where('manufacture_id', $manufacture_id);
                $this->db->where_not_in('manufacture_ir_id', $new_ids);
                $query = $this->db->get();
                if($query->num_rows() > 0) {
                    foreach ($query->result_array() as $key => $deleted_ir) {
                        $this->crud->delete('manufacture_ir_gross_details', array('manufacture_ir_id' => $deleted_ir['manufacture_ir_id']));
                        $this->crud->delete('manufacture_ir_stone_pcs_details', array('manufacture_ir_id' => $deleted_ir['manufacture_ir_id']));       
                        $this->crud->delete('manufacture_ir_moti_details', array('manufacture_ir_id' => $deleted_ir['manufacture_ir_id']));       
                        $this->crud->delete('manufacture_ir_other_charges_details', array('manufacture_ir_id' => $deleted_ir['manufacture_ir_id']));       
                        $this->crud->delete('manufacture_issue_receive', array('manufacture_ir_id' => $deleted_ir['manufacture_ir_id']));       
                    }
//                    $this->crud->update('manufacture', array('ir_deleted_by' => $this->logged_in_id,'ir_deleted_at' => $this->applib->get_current_date_time()),array('manufacture_id' => $manufacture_id));
                }
            }

            $return['success'] = "Updated";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Manufacture Updated Successfully');
        } else {
            $manufacture_data['created_at'] = $this->applib->get_current_date_time();
            $manufacture_data['created_by'] = $this->logged_in_id;
            $manufacture_id = $this->crud->insert('manufacture', $manufacture_data);
            
            if (!empty($manufacture_issue_receive)) {
                foreach ($manufacture_issue_receive as $manufacture_ir_row) {
                    $manufacture_item_data = array();
                    $manufacture_item_data['manufacture_id'] = $manufacture_id;
                    $manufacture_item_data['job_card_id'] = $post_data['job_card_id'];
                    $manufacture_item_data['process_id'] = $post_data['process_id'];
                    $manufacture_item_data['type_id'] = $manufacture_ir_row['type_id'];
                    $manufacture_item_data['ir_date'] = isset($manufacture_ir_row['ir_date']) && strtotime($manufacture_ir_row['ir_date']) > 0 ? date('Y-m-d', strtotime($manufacture_ir_row['ir_date'])) : NULL;
                    $manufacture_item_data['item_id'] = $manufacture_ir_row['item_id'];
                    $manufacture_item_data['job_worker_id'] = $manufacture_ir_row['job_worker_id'];
                    $manufacture_item_data['gross'] = (isset($manufacture_ir_row['gross']) && !empty($manufacture_ir_row['gross'])) ? $manufacture_ir_row['gross'] : 0;
                    $manufacture_item_data['touch'] = (isset($manufacture_ir_row['touch']) && !empty($manufacture_ir_row['touch'])) ? $manufacture_ir_row['touch'] : 0;
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_wastage', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_wastage', $selected_process_receive_fields))){
                        $manufacture_item_data['wastage'] = (isset($manufacture_ir_row['wastage']) && !empty($manufacture_ir_row['wastage'])) ? $manufacture_ir_row['wastage'] : 0;
                    } else {
                        $manufacture_item_data['wastage'] = 0;
                    }
                    $manufacture_item_data['fine'] = (isset($manufacture_ir_row['fine']) && !empty($manufacture_ir_row['fine'])) ? $manufacture_ir_row['fine'] : 0;
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_ad_weight', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_ad_weight', $selected_process_receive_fields))){
                        $manufacture_item_data['ad_weight'] = (isset($manufacture_ir_row['ad_weight']) && !empty($manufacture_ir_row['ad_weight'])) ? $manufacture_ir_row['ad_weight'] : 0;
                    } else {
                        $manufacture_item_data['ad_weight'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_ad_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_ad_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['ad_pcs'] = (isset($manufacture_ir_row['ad_pcs']) && !empty($manufacture_ir_row['ad_pcs'])) ? $manufacture_ir_row['ad_pcs'] : 0;
                    } else {
                        $manufacture_item_data['ad_pcs'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_before_meena', $selected_process_receive_fields)){
                        $manufacture_item_data['before_meena'] = (isset($manufacture_ir_row['before_meena']) && !empty($manufacture_ir_row['before_meena'])) ? $manufacture_ir_row['before_meena'] : 0;
                    } else {
                        $manufacture_item_data['before_meena'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_meena_wt', $selected_process_receive_fields)){
                        $manufacture_item_data['meena_wt'] = (isset($manufacture_ir_row['meena_wt']) && !empty($manufacture_ir_row['meena_wt'])) ? $manufacture_ir_row['meena_wt'] : 0;
                    } else {
                        $manufacture_item_data['meena_wt'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_item_weight', $selected_process_receive_fields)){
                        $manufacture_item_data['item_weight'] = (isset($manufacture_ir_row['item_weight']) && !empty($manufacture_ir_row['item_weight'])) ? $manufacture_ir_row['item_weight'] : 0;
                    } else {
                        $manufacture_item_data['item_weight'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_kundan', $selected_process_receive_fields)){
                        $manufacture_item_data['kundan'] = (isset($manufacture_ir_row['kundan']) && !empty($manufacture_ir_row['kundan'])) ? $manufacture_ir_row['kundan'] : 0;
                    } else {
                        $manufacture_item_data['kundan'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_sm', $selected_process_receive_fields)){
                        $manufacture_item_data['sm'] = (isset($manufacture_ir_row['sm']) && !empty($manufacture_ir_row['sm'])) ? $manufacture_ir_row['sm'] : 0;
                    } else {
                        $manufacture_item_data['sm'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_vetran', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_vetran', $selected_process_receive_fields))){
                        $manufacture_item_data['vetran'] = (isset($manufacture_ir_row['vetran']) && !empty($manufacture_ir_row['vetran'])) ? $manufacture_ir_row['vetran'] : 0;
                    } else {
                        $manufacture_item_data['vetran'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_v_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_v_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['v_pcs'] = (isset($manufacture_ir_row['v_pcs']) && !empty($manufacture_ir_row['v_pcs'])) ? $manufacture_ir_row['v_pcs'] : 0;
                    } else {
                        $manufacture_item_data['v_pcs'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_stone_pcs', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_pcs', $selected_process_receive_fields))){
                        $manufacture_item_data['stone_pcs'] = (isset($manufacture_ir_row['stone_pcs']) && !empty($manufacture_ir_row['stone_pcs'])) ? $manufacture_ir_row['stone_pcs'] : 0;
                    } else {
                        $manufacture_item_data['stone_pcs'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_stone_weight', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_weight', $selected_process_receive_fields))){
                        $manufacture_item_data['stone_weight'] = (isset($manufacture_ir_row['stone_weight']) && !empty($manufacture_ir_row['stone_weight'])) ? $manufacture_ir_row['stone_weight'] : 0;
                    } else {
                        $manufacture_item_data['stone_weight'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_stone_charges', $selected_process_receive_fields)){
                        $manufacture_item_data['stone_charges'] = (isset($manufacture_ir_row['stone_charges']) && !empty($manufacture_ir_row['stone_charges'])) ? $manufacture_ir_row['stone_charges'] : 0;
                    } else {
                        $manufacture_item_data['stone_charges'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_moti', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_moti', $selected_process_receive_fields))){
                        $manufacture_item_data['moti'] = (isset($manufacture_ir_row['moti']) && !empty($manufacture_ir_row['moti'])) ? $manufacture_ir_row['moti'] : 0;
                    } else {
                        $manufacture_item_data['moti'] = 0;
                    }
                    if((in_array($manufacture_item_data['type_id'], $issue_type_ids) && in_array('pif_moti_amount', $selected_process_issue_fields)) || (in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_moti_amount', $selected_process_receive_fields))){
                        $manufacture_item_data['moti_amount'] = (isset($manufacture_ir_row['moti_amount']) && !empty($manufacture_ir_row['moti_amount'])) ? $manufacture_ir_row['moti_amount'] : 0;
                    } else {
                        $manufacture_item_data['moti_amount'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_other_charges', $selected_process_receive_fields)){
                        $manufacture_item_data['other_charges'] = (isset($manufacture_ir_row['other_charges']) && !empty($manufacture_ir_row['other_charges'])) ? $manufacture_ir_row['other_charges'] : 0;
                    } else {
                        $manufacture_item_data['other_charges'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_loss', $selected_process_receive_fields)){
                        $manufacture_item_data['loss'] = (isset($manufacture_ir_row['loss']) && !empty($manufacture_ir_row['loss'])) ? $manufacture_ir_row['loss'] : 0;
                    } else {
                        $manufacture_item_data['loss'] = 0;
                    }
                    if(in_array($manufacture_item_data['type_id'], $receive_type_ids) && in_array('prf_loss_fine', $selected_process_receive_fields)){
                        $manufacture_item_data['loss_fine'] = (isset($manufacture_ir_row['loss_fine']) && !empty($manufacture_ir_row['loss_fine'])) ? $manufacture_ir_row['loss_fine'] : 0;
                    } else {
                        $manufacture_item_data['loss_fine'] = 0;
                    }
                    $manufacture_item_data['item_remark'] = (isset($manufacture_ir_row['item_remark']) && !empty($manufacture_ir_row['item_remark'])) ? $manufacture_ir_row['item_remark'] : NULL;
                    if(isset($manufacture_ir_row['image']) && !empty($manufacture_ir_row['image'])){
                        $manufacture_item_data['image'] = $manufacture_ir_row['image'];
                    }
                    $manufacture_item_data['created_by'] = $this->logged_in_id;
                    $manufacture_item_data['created_at'] = $this->applib->get_current_date_time();
                    $manufacture_item_data['updated_by'] = $this->logged_in_id;
                    $manufacture_item_data['updated_at'] = $this->applib->get_current_date_time();
                    $this->crud->insert('manufacture_issue_receive', $manufacture_item_data);
                    $manufacture_ir_id = $this->db->insert_id();

                    // Insert IR Gross details
                    if(isset($manufacture_ir_row['gross_details']) && !empty($manufacture_ir_row['gross_details'])){
                        $gross_details = json_decode($manufacture_ir_row['gross_details']);
                        foreach ($gross_details as $gross_detail){
                            $insert_gross_detail = array();
                            $insert_gross_detail['manufacture_id'] = $manufacture_id;
                            $insert_gross_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_gross_detail['gross_detail_item_id'] = (isset($gross_detail->gross_detail_item_id) && !empty($gross_detail->gross_detail_item_id)) ? $gross_detail->gross_detail_item_id : 0;
                            $insert_gross_detail['gross_detail_weight'] = (isset($gross_detail->gross_detail_weight) && !empty($gross_detail->gross_detail_weight)) ? $gross_detail->gross_detail_weight : 0;
                            $insert_gross_detail['created_by'] = $this->logged_in_id;
                            $insert_gross_detail['created_at'] = $this->now_time;
                            $insert_gross_detail['updated_by'] = $this->logged_in_id;
                            $insert_gross_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_gross_details', $insert_gross_detail);
                        }
                    }

                    // Insert IR Stone Pcs details
                    if(isset($manufacture_ir_row['stone_pcs_details']) && !empty($manufacture_ir_row['stone_pcs_details'])){
                        $stone_pcs_details = json_decode($manufacture_ir_row['stone_pcs_details']);
                        foreach ($stone_pcs_details as $stone_pcs_detail){
                            $insert_stone_pcs_detail = array();
                            $insert_stone_pcs_detail['manufacture_id'] = $manufacture_id;
                            $insert_stone_pcs_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_stone_pcs_detail['stone_detail_pcs'] = (isset($stone_pcs_detail->stone_detail_pcs) && !empty($stone_pcs_detail->stone_detail_pcs)) ? $stone_pcs_detail->stone_detail_pcs : 0;
                            $insert_stone_pcs_detail['stone_detail_weight'] = (isset($stone_pcs_detail->stone_detail_weight) && !empty($stone_pcs_detail->stone_detail_weight)) ? $stone_pcs_detail->stone_detail_weight : 0;
                            $insert_stone_pcs_detail['stone_detail_rate'] = (isset($stone_pcs_detail->stone_detail_rate) && !empty($stone_pcs_detail->stone_detail_rate)) ? $stone_pcs_detail->stone_detail_rate : 0;
                            $insert_stone_pcs_detail['stone_detail_amount'] = (isset($stone_pcs_detail->stone_detail_amount) && !empty($stone_pcs_detail->stone_detail_amount)) ? $stone_pcs_detail->stone_detail_amount : 0;
                            $insert_stone_pcs_detail['created_by'] = $this->logged_in_id;
                            $insert_stone_pcs_detail['created_at'] = $this->now_time;
                            $insert_stone_pcs_detail['updated_by'] = $this->logged_in_id;
                            $insert_stone_pcs_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_stone_pcs_details', $insert_stone_pcs_detail);
                        }
                    }

                    // Insert IR Moti details
                    if(isset($manufacture_ir_row['moti_details']) && !empty($manufacture_ir_row['moti_details'])){
                        $moti_details = json_decode($manufacture_ir_row['moti_details']);
                        foreach ($moti_details as $moti_detail){
                            $insert_moti_detail = array();
                            $insert_moti_detail['manufacture_id'] = $manufacture_id;
                            $insert_moti_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_moti_detail['moti_id'] = (isset($moti_detail->moti_id) && !empty($moti_detail->moti_id)) ? $moti_detail->moti_id : NULL;
                            $insert_moti_detail['moti_weight'] = (isset($moti_detail->moti_weight) && !empty($moti_detail->moti_weight)) ? $moti_detail->moti_weight : 0;
                            $insert_moti_detail['moti_rate'] = (isset($moti_detail->moti_rate) && !empty($moti_detail->moti_rate)) ? $moti_detail->moti_rate : 0;
                            $insert_moti_detail['moti_detail_amount'] = (isset($moti_detail->moti_detail_amount) && !empty($moti_detail->moti_detail_amount)) ? $moti_detail->moti_detail_amount : 0;
                            $insert_moti_detail['created_by'] = $this->logged_in_id;
                            $insert_moti_detail['created_at'] = $this->now_time;
                            $insert_moti_detail['updated_by'] = $this->logged_in_id;
                            $insert_moti_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_moti_details', $insert_moti_detail);
                        }
                    }

                    // Insert IR Other Charges details
                    if(isset($manufacture_ir_row['other_charges_details']) && !empty($manufacture_ir_row['other_charges_details'])){
                        $other_charges_details = json_decode($manufacture_ir_row['other_charges_details']);
                        foreach ($other_charges_details as $other_charges_detail){
                            $insert_other_charges_detail = array();
                            $insert_other_charges_detail['manufacture_id'] = $manufacture_id;
                            $insert_other_charges_detail['manufacture_ir_id'] = $manufacture_ir_id;
                            $insert_other_charges_detail['charges_id'] = (isset($other_charges_detail->charges_id) && !empty($other_charges_detail->charges_id)) ? $other_charges_detail->charges_id : NULL;
                            $insert_other_charges_detail['charges_amount'] = (isset($other_charges_detail->charges_amount) && !empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                            $insert_other_charges_detail['created_by'] = $this->logged_in_id;
                            $insert_other_charges_detail['created_at'] = $this->now_time;
                            $insert_other_charges_detail['updated_by'] = $this->logged_in_id;
                            $insert_other_charges_detail['updated_at'] = $this->now_time;
                            $result = $this->crud->insert('manufacture_ir_other_charges_details', $insert_other_charges_detail);

                            // Update Job Worker Other Charges Increase
                            $effect_person_ledger = $this->crud->get_column_value_by_id('charges', 'effect_person_ledger', array('charges_id' => $insert_other_charges_detail['charges_id']));
                            if($effect_person_ledger == '1'){
                                $this->applib->update_job_worker_balance_increase($manufacture_item_data['job_worker_id'], '', $insert_other_charges_detail['charges_amount']);
                            }
                        }
                    }

                    // Update Item Stock
                    if ($manufacture_item_data['type_id'] == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manufacture_item_data['type_id'] == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                        // Issue to Decrease
                        $this->applib->update_item_stock_decrease($manufacture_item_data['item_id'], $manufacture_item_data['gross'], $manufacture_item_data['touch'], $manufacture_item_data['fine']);
                        // Update Job Worker Fine Decrease
                        $this->applib->update_job_worker_balance_decrease($manufacture_item_data['job_worker_id'], $manufacture_item_data['fine'], '');
                    } else {
                        // Receive to Increase
                        $this->applib->update_item_stock_increase($manufacture_item_data['item_id'], $manufacture_item_data['gross'], $manufacture_item_data['touch'], $manufacture_item_data['fine']);
                        // Update Job Worker Fine / Stone Charges Increase
                        $this->applib->update_job_worker_balance_increase($manufacture_item_data['job_worker_id'], $manufacture_item_data['fine'], $manufacture_item_data['stone_charges']);
                    }
                }
            }
            $return['success'] = "Added";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Manufacture Added Successfully');
        }
        print json_encode($return);
        exit;
    }

    function manufacture_list() {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "view") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $date = array();
            $date['from_date'] = date("01-m-Y");
            $date['to_date'] = date("d-m-Y");
            $this->load->view('manufacture/manufacture_list',$date);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function manufacture_datatable() {
        $post_data = $this->input->post();
        
        $config['table'] = 'manufacture m';
        $config['select'] = 'm.*,jc.job_card_no,jc.order_date,jc.melting,p.name as party_name,pm.process_name';
        $config['joins'][] = array('join_table' => 'job_card jc', 'join_by' => 'jc.job_card_id = m.job_card_id');
        $config['joins'][] = array('join_table' => 'party p', 'join_by' => 'p.party_id = jc.party_id');
        $config['joins'][] = array('join_table' => 'process_master pm', 'join_by' => 'pm.id = m.process_id');
        $config['column_search'] = array('p.name','jc.job_card_no','jc.melting','jc.order_date','pm.process_name',);
        $config['column_order'] = array('m.manufacture_id','jc.job_card_no','p.name','jc.melting','jc.order_date','pm.process_name',);
        $config['order'] = array('m.manufacture_id' => 'desc');

        if (isset($post_data['from_date']) && strtotime($post_data['from_date']) > 0) {
            $from_date = date('Y-m-d',strtotime($post_data['from_date']));
            $config['wheres'][] = array('column_name' => 'jc.order_date >=', 'column_value' => $from_date);
        }
        if (isset($post_data['to_date']) && strtotime($post_data['to_date']) > 0) {
            $to_date = date('Y-m-d',strtotime($post_data['to_date']));
            $config['wheres'][] = array('column_name' => 'jc.order_date <=', 'column_value' => $to_date);
        }
        if (!empty($post_data['job_card_no'])) {
            $config['wheres'][] = array('column_name' => 'jc.job_card_no', 'column_value' => $post_data['job_card_no']);
        }
        if (!empty($post_data['party_id'])) {
            $config['wheres'][] = array('column_name' => 'jc.party_id', 'column_value' => $post_data['party_id']);
        }
        if (!empty($post_data['touch'])) {
            $config['wheres'][] = array('column_name' => 'jc.melting', 'column_value' => $post_data['touch']);
        }
        if (!empty($post_data['process_id'])) {
            $config['wheres'][] = array('column_name' => 'm.process_id', 'column_value' => $post_data['process_id']);
        }
        if(!empty($post_data['close_to_calculate_loss'])){
            $config['custom_where'] = ' m.close_to_calculate_loss = '.$post_data['close_to_calculate_loss'].' ';
        }
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
//        echo $this->db->last_query();
        $data = array();

        $isEdit = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "delete");

        foreach ($list as $manufacture) {
            $row = array();

            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $manufacture->manufacture_id.'" title="Edit Manufacture"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('manufacture/delete_manufacture/' . $manufacture->manufacture_id) . '"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';                    
            }
            $action .= "<a href='javascript:void(0);' class='btn btn-primary btn-xs view_manufacture_ir' data-id='" . $manufacture->manufacture_id . "' data-issue_receive='1,2'>Issue</a>";
            $action .= " <a href='javascript:void(0);' class='btn btn-primary btn-xs view_manufacture_ir' data-id='" . $manufacture->manufacture_id . "' data-issue_receive='3,4'>Receive</a>";
            $action .= ' <a class="btn btn-primary btn-xs" href="' . base_url() . 'manufacture/add/'. $manufacture->manufacture_id.'/view_process_wise_manufacture" title="View Manufacture Process Wise">View Process Wise</i></a>';
//            $action .= '&nbsp;<a href="' . base_url('manufacture/manufacture_print/' . $manufacture->manufacture_id) . '" target="_blank" title="Manufacture Print" class="detail_button btn-info btn-xs"><span class="fa fa-print"></span></a>';

            $row[] = $action;
            $row[] = $manufacture->job_card_no;
            $row[] = $manufacture->party_name;
            $row[] = number_format($manufacture->melting, 3, '.', '');
            $row[] = (strtotime($manufacture->order_date) > 0?date('d-m-Y',strtotime($manufacture->order_date)):'');
            $row[] = $manufacture->process_name;
            $close_to_calculate_loss = '';
            if($manufacture->close_to_calculate_loss == '1'){
                $close_to_calculate_loss = 'Open';
            } else if($manufacture->close_to_calculate_loss == '2'){
                $close_to_calculate_loss = 'Close';
            }
            $row[] = $close_to_calculate_loss;
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';

//            $costing_data = $this->job_card_cost($manufacture->job_card_id,$manufacture->melting);
//            $row[] = number_format($costing_data['costing'], 3, '.', '');
//            $row[] = number_format($costing_data['costing_per'], 2, '.', '');
            $row[] = '';
            $row[] = '';

//            $job_card_labor = $this->crud->manufacture_labor($manufacture->manufacture_id);
//            $row[] = number_format($job_card_labor, 2, '.', '');
            $row[] = '';
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

    function manufacture_print($manufacture_id)
    {
        $manufacture_row = $this->crud->get_data_row_by_id('manufacture', 'manufacture_id', $manufacture_id);
        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $manufacture_row->process_id);
        
        $process_html = '';
        $selected_columns = array();
        if(!empty($process_row->print_columns)) {
            $selected_columns = explode(',', $process_row->print_columns);
        }

        $this->db->select('mir.*,i.item_name,jw.job_worker,process_id,jc.melting');
        $this->db->from('manufacture m');
        $this->db->join('job_card jc','jc.job_card_id = m.job_card_id');
        $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id','left');
        $this->db->join('item i','i.item_id = mir.item_id','left');
        $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
        $this->db->where('m.manufacture_id',$manufacture_id);
        $this->db->order_by('mir.manufacture_ir_id','desc');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $manu_res = $query->result();
            $manu_issue_data = array();
            $manu_receive_data = array();
            $melting = 0;
            foreach ($manu_res as $manu_row){
                $melting = $manu_row->melting;
                if($manu_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manu_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                    $manu_issue_data[] = $manu_row;
                } else {
                    $manu_receive_data[] = $manu_row;
                }
            }
            $tmp_data  = array();
            $tmp_data['selected_columns'] = $selected_columns;
            $tmp_data['melting'] = $melting;
            $tmp_data['process_name'] = $process_row->process_name;
            $tmp_data['manu_issue_data'] = $manu_issue_data;
            $tmp_data['manu_receive_data'] = $manu_receive_data;
            if(count($manu_issue_data) > count($manu_receive_data)){
                $tmp_data['manu_max_count'] = count($manu_issue_data);
            } else {
                $tmp_data['manu_max_count'] = count($manu_receive_data);
            }
            $tmp_data['table_html'] = $this->load->view('job_card/job_card_process_table', $tmp_data, true);
            $process_html .= $this->load->view('manufacture/manufacture_print', $tmp_data, true);
        }

        //echo $process_html;die();
        $pdfFilePath = "manufacture_print.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->falseBoldWeight = 8;        
        $this->m_pdf->pdf->AddPage('L','', '', '', '',
                                  2, // margin_left
                                  2, // margin right
                                  2, // margin top
                                  2, // margin bottom
                                  2, // margin header
                                  2); // margin footer
        $this->m_pdf->pdf->WriteHTML($process_html);
        /*echo "<pre>";
        print_r($this->m_pdf->pdf);
        exit();*/
        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    }

    function job_card_cost($job_card_id,$melting = 0){
        $return_arr = array();
        if($melting == 0) {
            $this->db->select('melting');
            $this->db->from('job_card m');
            $this->db->where('job_card_id',$job_card_id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                $melting = $query->row()->melting;
            }
        }

        $total_loss = 0;
        $this->db->select('SUM(m.balance_net_weight) as total_loss');
        $this->db->from('manufacture m');
        $this->db->where('m.job_card_id',$job_card_id);
        $this->db->group_by('m.job_card_id');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $total_loss = $query->row()->total_loss;
        }
        $loss_fine = ($total_loss * $melting) / 100;

        $last_process_weight = 0;
        $this->db->select('m.total_receive_finish_net_weight as last_process_weight');
        $this->db->from('manufacture m');
        $this->db->where('m.job_card_id',$job_card_id);
        $this->db->order_by('m.manufacture_id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $last_process_weight = $query->row()->last_process_weight;
        }

        $total_issue_ad_weight = 0;
        $total_receive_ad_weight = 0;
        $this->db->select('SUM(IF(type_id = 1 OR type_id = 2,mir.ad_weight,0)) as total_issue_ad_weight,
            SUM(IF(type_id = 3 OR type_id = 4,mir.ad_weight,0)) as total_receive_ad_weight');
        $this->db->from('manufacture_issue_receive mir');
        $this->db->join('manufacture m','m.manufacture_id = mir.manufacture_id');
        $this->db->where('m.job_card_id',$job_card_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $total_issue_ad_weight = $query->row()->total_issue_ad_weight;
            $total_receive_ad_weight = $query->row()->total_receive_ad_weight;
        }
        
        $last_process_weight_without_ad = $last_process_weight - ($total_issue_ad_weight - $total_receive_ad_weight);
        $weight_fine = ($last_process_weight_without_ad * $melting) / 100;
        
        $costing = $weight_fine + $loss_fine;
        if(!empty($last_process_weight)){
            $costing_per = ($costing / $last_process_weight) * 100;
        } else {
            $costing_per = $costing * 100;
        }
        $return_arr['costing'] = $costing;
        $return_arr['costing_per'] = $costing_per;
        return $return_arr;
    }

    function manufacture_ir_datatable() {
        $post_data = $this->input->post();
        $manufacture_id = $post_data['manufacture_id'];
        $issue_receive = $post_data['issue_receive'];

        $config['table'] = 'manufacture_issue_receive mir';
        $config['select'] = 'mir.*,i.item_name,jw.job_worker';
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = mir.item_id', 'join_type' => 'left');
        $config['joins'][] = array('join_table' => 'job_worker jw', 'join_by' => 'jw.id = mir.job_worker_id', 'join_type' => 'left');

        $config['column_search'] = array('DATE_FORMAT(mir.ir_date,"%d-%m-%Y")','mir.gross','i.item_name','jw.job_worker','mir.item_remark');
        $config['column_order'] = array('mir.ir_date','mir.gross','i.item_name','jw.job_worker','mir.item_remark');
        $config['order'] = array('mir.manufacture_ir_id' => 'desc');

        $config['custom_where'] = ' mir.manufacture_id = ' . $manufacture_id . ' AND mir.type_id IN (' . $issue_receive . ') ';
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
//        echo $this->db->last_query();
        $data = array();
        foreach ($list as $key => $manufacture_ir) {
            $row = array();
            $row[] = date('d-m-Y',strtotime($manufacture_ir->ir_date));
            $row[] = number_format($manufacture_ir->gross, 3, '.', '');
            $row[] = '';
            $row[] = $manufacture_ir->item_name;
            $row[] = $manufacture_ir->job_worker;
            $row[] = trim($manufacture_ir->item_remark);
            $row[] = '';
            $row[] = '';
            $type = '';
            if($manufacture_ir->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manufacture_ir->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                $type = 'Finish';
            }
            if($manufacture_ir->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID || $manufacture_ir->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                $type = 'Scrap';
            }
            $row[] = $type;
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

    function delete_manufacture($manufacture_id) {
        $res = array();
        $old_manufacture_issue_receive_data = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_id));
        if(!empty($old_manufacture_issue_receive_data)){
            foreach ($old_manufacture_issue_receive_data as $old_manufacture_issue_receive_row) {
                // Revert Item Stock
                if ($old_manufacture_issue_receive_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $old_manufacture_issue_receive_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID) {
                    // Issue to Increase
                    $this->applib->update_item_stock_increase($old_manufacture_issue_receive_row->item_id, $old_manufacture_issue_receive_row->gross, $old_manufacture_issue_receive_row->touch, $old_manufacture_issue_receive_row->fine);
                    // Job Worker Fine Increase
                    $this->applib->update_job_worker_balance_increase($old_manufacture_issue_receive_row->job_worker_id, $old_manufacture_issue_receive_row->fine, '');
                } else {
                    // Receive to Decrease
                    $this->applib->update_item_stock_decrease($old_manufacture_issue_receive_row->item_id, $old_manufacture_issue_receive_row->gross, $old_manufacture_issue_receive_row->touch, $old_manufacture_issue_receive_row->fine);
                    // Job Worker Fine / Stone Charges Decrease
                    $this->applib->update_job_worker_balance_decrease($old_manufacture_issue_receive_row->job_worker_id, $old_manufacture_issue_receive_row->fine, $old_manufacture_issue_receive_row->stone_charges);
                }

                // Revert Job Worker Other Charges Decrease
                $old_manufacture_ir_other_charges_data = $this->crud->get_row_by_id('manufacture_ir_other_charges_details', array('manufacture_id' => $manufacture_id, 'manufacture_ir_id' => $old_manufacture_issue_receive_row->manufacture_ir_id));
                if(!empty($old_manufacture_ir_other_charges_data)){
                    foreach ($old_manufacture_ir_other_charges_data as $old_manufacture_ir_other_charges_row) {
                        $effect_person_ledger = $this->crud->get_column_value_by_id('charges', 'effect_person_ledger', array('charges_id' => $old_manufacture_ir_other_charges_row->charges_id));
                        if($effect_person_ledger == '1'){
                            $this->applib->update_job_worker_balance_decrease($old_manufacture_issue_receive_row->job_worker_id, '', $old_manufacture_ir_other_charges_row->charges_amount);
                        }
                    }
                }
            }
        }
        $this->crud->delete('manufacture', array('manufacture_id' => $manufacture_id));
        $this->crud->delete('manufacture_issue_receive', array('manufacture_id' => $manufacture_id));
        $this->crud->delete('manufacture_ir_gross_details', array('manufacture_id' => $manufacture_id));
        $this->crud->delete('manufacture_ir_stone_pcs_details', array('manufacture_id' => $manufacture_id));
        $this->crud->delete('manufacture_ir_moti_details', array('manufacture_id' => $manufacture_id));
        $this->crud->delete('manufacture_ir_other_charges_details', array('manufacture_id' => $manufacture_id));
        $res['status'] = "success";
        echo json_encode($res);
    }

    function update_balance_columns() {
        $column = 'alloy';
        if($column == "alloy") {
            $this->db->select('m.*');
            $this->db->from('manufacture m');
            $this->db->where('m.process_id',5);
            //$this->db->where('m.manufacture_id',321);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                foreach ($query->result() as $manu_row){
                    $this->db->select('mir.*');
                    $this->db->from('manufacture_issue_receive mir');
                    $this->db->where('mir.manufacture_id',$manu_row->manufacture_id);
                    $this->db->order_by('mir.manufacture_ir_id','desc');
                    $ir_query = $this->db->get();
                    if($ir_query->num_rows() > 0) {
                        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $manu_row->process_id);
                        $selected_columns = array();
                        if(!empty($process_row->print_columns)) {
                            $selected_columns = explode(',', $process_row->print_columns);
                        }

                        $total_issue_weight = 0;
                        $total_receive_weight = 0;
                        $total_issue_finish_weight = 0;
                        $total_receive_finish_weight = 0;
                        $total_issue_scrap_weight = 0;
                        $total_receive_scrap_weight = 0;
                        $total_ad_issue_weight = 0;
                        $total_ad_receive_weight = 0;

                        $total_issue_less = 0;
                        $total_receive_less = 0;
                        $total_issue_finish_less = 0;
                        $total_receive_finish_less = 0;
                        $total_issue_scrap_less = 0;
                        $total_receive_scrap_less = 0;
                        $total_ad_issue_less = 0;
                        $total_ad_receive_less = 0;

                        $total_issue_net_weight = 0;
                        $total_receive_net_weight = 0;
                        $total_issue_finish_net_weight = 0;
                        $total_receive_finish_net_weight = 0;
                        $total_issue_scrap_net_weight = 0;
                        $total_receive_scrap_net_weight = 0;
                        $total_ad_issue_net_weight = 0;
                        $total_ad_receive_net_weight = 0;

                        $total_issue_tunch = 0;
                        $total_receive_tunch = 0;
                        $total_issue_finish_tunch = 0;
                        $total_receive_finish_tunch = 0;
                        $total_issue_scrap_tunch = 0;
                        $total_receive_scrap_tunch = 0;
                        $total_ad_issue_tunch = 0;
                        $total_ad_receive_tunch = 0;

                        $total_issue_fine = 0;
                        $total_receive_fine = 0;
                        $total_issue_finish_fine = 0;
                        $total_receive_finish_fine = 0;
                        $total_issue_scrap_fine = 0;
                        $total_receive_scrap_fine = 0;
                        $total_ad_issue_fine = 0;
                        $total_ad_receive_fine = 0;

                        $total_issue_pcs = 0;
                        $total_receive_pcs = 0;
                        $total_issue_finish_pcs = 0;
                        $total_receive_finish_pcs = 0;
                        $total_issue_scrap_pcs = 0;
                        $total_receive_scrap_pcs = 0;
                        $total_ad_issue_pcs = 0;
                        $total_ad_receive_pcs = 0;

                        $total_issue_alloy = 0;
                        $total_receive_alloy = 0;
                        $total_issue_finish_alloy = 0;
                        $total_receive_finish_alloy = 0;
                        $total_issue_scrap_alloy = 0;
                        $total_receive_scrap_alloy = 0;
                        $total_ad_issue_alloy = 0;
                        $total_ad_receive_alloy = 0;

                        $total_issue_ad_weight = 0;
                        $total_receive_ad_weight = 0;
                        $total_issue_finish_ad_weight = 0;
                        $total_receive_finish_ad_weight = 0;
                        $total_issue_scrap_ad_weight = 0;
                        $total_receive_scrap_ad_weight = 0;
                        $total_ad_issue_ad_weight = 0;
                        $total_ad_receive_ad_weight = 0;

                        $total_issue_ad_pcs = 0;
                        $total_receive_ad_pcs = 0;
                        $total_issue_finish_ad_pcs = 0;
                        $total_receive_finish_ad_pcs = 0;
                        $total_issue_scrap_ad_pcs = 0;
                        $total_receive_scrap_ad_pcs = 0;
                        $total_ad_issue_ad_pcs = 0;
                        $total_ad_receive_ad_pcs = 0;
                        foreach ($ir_query->result() as $ir_row){
                            if($ir_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $ir_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                                $alloy_issue = $ir_row->weight - $ir_row->fine;

                                $total_issue_weight = $total_issue_weight + $ir_row->weight;
                                $total_issue_less = $total_issue_less + $ir_row->less;
                                $total_issue_net_weight = $total_issue_net_weight + $ir_row->net_weight;
                                $total_issue_fine = $total_issue_fine + $ir_row->fine;
                                if($total_issue_fine > 0) {
                                    $total_issue_tunch = ($total_issue_fine / $total_issue_net_weight) * 100; 
                                } else {
                                    $total_issue_tunch = 0;
                                }
                                
                                $total_issue_pcs = $total_issue_pcs + $ir_row->pcs;
                                $total_issue_alloy = $total_issue_alloy + $alloy_issue;
                                $total_issue_ad_weight = $total_issue_ad_weight + $ir_row->ad_weight;
                                $total_issue_ad_pcs = $total_issue_ad_pcs + $ir_row->ad_pcs;

                                if($ir_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID){
                                    $total_issue_finish_weight = $total_issue_finish_weight + $ir_row->weight;
                                    $total_issue_finish_less = $total_issue_finish_less + $ir_row->less;
                                    $total_issue_finish_net_weight = $total_issue_finish_net_weight + $ir_row->net_weight;
                                    $total_issue_finish_fine = $total_issue_finish_fine + $ir_row->fine;
                                    if($total_issue_finish_net_weight > 0) {
                                        $total_issue_finish_tunch = ($total_issue_finish_fine / $total_issue_finish_net_weight) * 100; 
                                    } else {
                                        $total_issue_finish_tunch = 0;
                                    }
                                    
                                    $total_issue_finish_pcs = $total_issue_finish_pcs + $ir_row->pcs;
                                    $total_issue_finish_alloy = $total_issue_finish_alloy + $alloy_issue;
                                    $total_issue_finish_ad_weight = $total_issue_finish_ad_weight + $ir_row->ad_weight;
                                    $total_issue_finish_ad_pcs = $total_issue_finish_ad_pcs + $ir_row->ad_pcs;
                                } else if($ir_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                                    $total_issue_scrap_weight = $total_issue_scrap_weight + $ir_row->weight;
                                    $total_issue_scrap_less = $total_issue_scrap_less + $ir_row->less;
                                    $total_issue_scrap_net_weight = $total_issue_scrap_net_weight + $ir_row->net_weight;
                                    $total_issue_scrap_fine = $total_issue_scrap_fine + $ir_row->fine;
                                    $total_issue_scrap_tunch = ($total_issue_scrap_fine / $total_issue_scrap_net_weight) * 100; 
                                    $total_issue_scrap_pcs = $total_issue_scrap_pcs + $ir_row->pcs;
                                    $total_issue_scrap_alloy = $total_issue_scrap_alloy + $alloy_issue;
                                    $total_issue_scrap_ad_weight = $total_issue_scrap_ad_weight + $ir_row->ad_weight;
                                    $total_issue_scrap_ad_pcs = $total_issue_scrap_ad_pcs + $ir_row->ad_pcs;
                                }
                            }

                            if($ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID || $ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                                $alloy_rec = $ir_row->weight - $ir_row->fine;

                                $total_receive_weight = $total_receive_weight + $ir_row->weight;
                                $total_receive_less = $total_receive_less + $ir_row->less;
                                $total_receive_net_weight = $total_receive_net_weight + $ir_row->net_weight;
                                $total_receive_fine = $total_receive_fine + $ir_row->fine;
                                if($total_receive_net_weight > 0) {
                                    $total_receive_tunch = ($total_receive_fine / $total_receive_net_weight) * 100;     
                                } else {
                                    $total_receive_tunch = 0;
                                }
                                
                                $total_receive_pcs = $total_receive_pcs + $ir_row->pcs;
                                $total_receive_alloy = $total_receive_alloy + $alloy_rec;
                                $total_receive_ad_weight = $total_receive_ad_weight + $ir_row->ad_weight;
                                $total_receive_ad_pcs = $total_receive_ad_pcs + $ir_row->ad_pcs;

                                if($ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                                    $total_receive_finish_weight = $total_receive_finish_weight + $ir_row->weight;
                                    $total_receive_finish_less = $total_receive_finish_less + $ir_row->less;
                                    $total_receive_finish_net_weight = $total_receive_finish_net_weight + $ir_row->net_weight;
                                    $total_receive_finish_fine = $total_receive_finish_fine + $ir_row->fine;
                                    if($total_receive_finish_net_weight > 0) {
                                        $total_receive_finish_tunch = ($total_receive_finish_fine / $total_receive_finish_net_weight) * 100;     
                                    } else {
                                        $total_receive_finish_tunch = 0;
                                    }
                                    
                                    $total_receive_finish_pcs = $total_receive_finish_pcs + $ir_row->pcs;
                                    $total_receive_finish_alloy = $total_receive_finish_alloy + $alloy_rec;
                                    $total_receive_finish_ad_weight = $total_receive_finish_ad_weight + $ir_row->ad_weight;
                                    $total_receive_finish_ad_pcs = $total_receive_finish_ad_pcs + $ir_row->ad_pcs;
                                } else if($ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                                    $total_receive_scrap_weight = $total_receive_scrap_weight + $ir_row->weight;
                                    $total_receive_scrap_less = $total_receive_scrap_less + $ir_row->less;
                                    $total_receive_scrap_net_weight = $total_receive_scrap_net_weight + $ir_row->net_weight;
                                    $total_receive_scrap_fine = $total_receive_scrap_fine + $ir_row->fine;
                                    $total_receive_scrap_tunch = ($total_receive_scrap_fine / $total_receive_scrap_net_weight) * 100; 
                                    $total_receive_scrap_pcs = $total_receive_scrap_pcs + $ir_row->pcs;
                                    $total_receive_scrap_alloy = $total_receive_scrap_alloy + $alloy_rec;
                                    $total_receive_scrap_ad_weight = $total_receive_scrap_ad_weight + $ir_row->ad_weight;
                                    $total_receive_scrap_ad_pcs = $total_receive_scrap_ad_pcs + $ir_row->ad_pcs;
                                }
                            }
                        }

                        $total_ad_receive_weight = $total_receive_weight + $total_receive_ad_weight;
                        $total_ad_receive_less = $total_receive_less;
                        $total_ad_receive_net_weight = $total_ad_receive_weight - $total_ad_receive_less;
                        $total_ad_receive_tunch = $total_receive_tunch;
                        $total_ad_receive_fine = (($total_receive_finish_weight - ($total_issue_ad_weight - $total_receive_ad_weight)) * $melting) / 100;
                        $total_ad_receive_tunch = (($total_ad_receive_fine / $total_receive_finish_weight) * 100);

                        $total_ad_receive_pcs = $total_receive_pcs + $total_receive_ad_pcs;
                        $total_ad_receive_alloy = $total_ad_receive_weight - $total_ad_receive_fine;
                        $total_ad_receive_ad_weight = $total_receive_ad_weight;
                        $total_ad_receive_ad_pcs = $total_receive_ad_pcs;

                        $total_ad_issue_weight = $total_issue_weight + $total_issue_ad_weight;
                        $total_ad_issue_less = $total_issue_less;
                        $total_ad_issue_net_weight = $total_ad_issue_weight - $total_ad_issue_less;
                        $total_ad_issue_fine = $total_issue_fine;
                        $total_ad_issue_tunch = ($total_ad_issue_fine / $total_ad_issue_weight) * 100;
                        $total_ad_issue_pcs = $total_issue_pcs + $total_issue_ad_pcs;
                        $total_ad_issue_alloy = $total_ad_issue_weight - $total_ad_issue_fine;
                        $total_ad_issue_ad_weight = $total_issue_ad_weight;
                        $total_ad_issue_ad_pcs = $total_issue_ad_pcs;    


                        $total_weight_bal = $total_ad_issue_weight - $total_ad_receive_weight;
                        $total_net_weight_bal = $total_ad_issue_net_weight - $total_ad_receive_net_weight;
                        $total_fine_bal = $total_ad_issue_fine - $total_ad_receive_fine;
                        $total_pcs_bal = $total_ad_issue_pcs - $total_ad_receive_pcs;

                        if(in_array('issue_total_with_ad',$selected_columns)) {
                            $total_alloy_bal = $total_ad_issue_alloy - $total_ad_receive_alloy; 
                        } else {
                            $total_alloy_bal = $total_issue_alloy - $total_receive_alloy;     
                        }
                        $total_alloy_bal = number_format($total_alloy_bal, 3, '.', '');

                        /*echo "Manufacture_id : ".$manu_row->manufacture_id;
                        echo "<br/>";
                        echo "Alloy Bal : ".$total_alloy_bal;
                        echo "<br/>";*/
                        $this->crud->update('manufacture',array('balance_alloy' => $total_alloy_bal),array('manufacture_id' => $manu_row->manufacture_id));
                    }
                }
                echo "Success";
            }
        }
    }

    function get_temp_path_image() {
        $data = '';
//        echo "<pre>"; print_r($_FILES); exit;
        if (isset($_FILES['file_upload']['name']) && !empty($_FILES['file_upload']['name'])) {
            $file_element_name = 'file_upload';
            $config['upload_path'] = './uploads/manufacture_item_photo/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;
            $config['file_name'] = date('Y_m_d_H_i_s_U');
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $return['Uploaderror'] = $this->upload->display_errors();
            }
            $file_data = $this->upload->data();
            @unlink($_FILES[$file_element_name]);
            $data = $file_data['file_name'];
        }
        print $data;
        exit;
    }
}
