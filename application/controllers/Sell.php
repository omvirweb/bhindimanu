<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {

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
	
    function add($sell_id = '') {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "edit") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $data = array();
            if(!empty($sell_id)) {
                $data['sell_row'] = $this->crud->get_data_row_by_id('sells', 'sell_id', $sell_id);
                $lineitem_objectdata = array();
//                print_r($data); exit;
            }
            $this->load->view('sell/add', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_sell(){
        $post_data = $this->input->post();
        $sell_id = 0;
//        echo "<pre>"; print_r($post_data); exit;
        $sell_data = array();
        $sell_data['job_card_id'] = $post_data['job_card_id'];
        $sell_data['tag_id'] = $post_data['tag_id'];
        $sell_data['sell_date'] = isset($post_data['sell_date']) && strtotime($post_data['sell_date']) > 0 ? date('Y-m-d', strtotime($post_data['sell_date'])) : NULL;
        $sell_data['remark'] = (isset($post_data['remark']) && !empty($post_data['remark'])) ? $post_data['remark'] : NULL;
        $sell_data['gross'] = (isset($post_data['gross']) && !empty($post_data['gross'])) ? $post_data['gross'] : 0;
        $sell_data['net'] = (isset($post_data['net']) && !empty($post_data['net'])) ? $post_data['net'] : 0;
        $sell_data['touch'] = (isset($post_data['touch']) && !empty($post_data['touch'])) ? $post_data['touch'] : 0;
        $sell_data['wastage'] = (isset($post_data['wastage']) && !empty($post_data['wastage'])) ? $post_data['wastage'] : 0;
        $sell_data['fine'] = (isset($post_data['fine']) && !empty($post_data['fine'])) ? $post_data['fine'] : 0;
        $sell_data['other_charges'] = (isset($post_data['other_charges']) && !empty($post_data['other_charges'])) ? $post_data['other_charges'] : 0;
        $sell_data['sell_party_id'] = (isset($post_data['sell_party_id']) && !empty($post_data['sell_party_id'])) ? $post_data['sell_party_id'] : NULL;
        $sell_data['updated_at'] = $this->applib->get_current_date_time();
        $sell_data['updated_by'] = $this->logged_in_id;
                    
        if (!empty($post_data['sell_id'])) {
            $sell_id = $post_data['sell_id'];

            // Revert Sell to Increase Stock
            $old_sell_row = $this->crud->get_data_row_by_id('sells', 'sell_id', $sell_id);
            if(!empty($old_sell_row)){
                $item_id = $this->crud->get_column_value_by_id('tags', 'item_id', array('tag_id' => $old_sell_row->tag_id));
                $this->applib->update_item_stock_increase($item_id, $old_sell_row->gross, $old_sell_row->touch, $old_sell_row->fine);
            }

            $where_array['sell_id'] = $sell_id;
            $this->crud->update('sells', $sell_data, $where_array);

            // Sell to Decrease Stock
            $item_id = $this->crud->get_column_value_by_id('tags', 'item_id', array('tag_id' => $post_data['tag_id']));
            $this->applib->update_item_stock_decrease($item_id, $sell_data['gross'], $sell_data['touch'], $sell_data['fine']);

            $return['success'] = "Updated";
            $return['job_card_id'] = $post_data['job_card_id'];
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Sell Updated Successfully');
        } else {
            $sell_data['created_at'] = $this->applib->get_current_date_time();
            $sell_data['created_by'] = $this->logged_in_id;
            $sell_id = $this->crud->insert('sells', $sell_data);

            // Sell to Decrease Stock
            $item_id = $this->crud->get_column_value_by_id('tags', 'item_id', array('tag_id' => $post_data['tag_id']));
            $this->applib->update_item_stock_decrease($item_id, $sell_data['gross'], $sell_data['touch'], $sell_data['fine']);

            $return['success'] = "Added";
            $return['job_card_id'] = $post_data['job_card_id'];
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Sell Added Successfully');
        }
        print json_encode($return);
        exit;
    }

    function sell_list() {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "view") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $date = array();
            $date['from_date'] = date("01-m-Y");
            $date['to_date'] = date("d-m-Y");
            $this->load->view('sell/sell_list',$date);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function sell_datatable() {
        $post_data = $this->input->post();
        
        $config['table'] = 'sells s';
        $config['select'] = 's.*, jc.job_card_no, i.item_name, p.name as party_name, sp.name as sell_party_name';
        $config['joins'][] = array('join_table' => 'tags t', 'join_by' => 't.tag_id = s.tag_id');
        $config['joins'][] = array('join_table' => 'job_card jc', 'join_by' => 'jc.job_card_id = t.job_card_id');
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = t.item_id');
        $config['joins'][] = array('join_table' => 'party p', 'join_by' => 'p.party_id = jc.party_id');
        $config['joins'][] = array('join_table' => 'party sp', 'join_by' => 'sp.party_id = s.sell_party_id', 'join_type' => 'left');
        $config['column_order'] = array('t.sell_id','jc.job_card_no','p.name');
        $config['order'] = array('s.sell_id' => 'desc');
        if (isset($post_data['from_date']) && strtotime($post_data['from_date']) > 0) {
            $from_date = date('Y-m-d',strtotime($post_data['from_date']));
            $config['wheres'][] = array('column_name' => 's.sell_date >=', 'column_value' => $from_date);
        }
        if (isset($post_data['to_date']) && strtotime($post_data['to_date']) > 0) {
            $to_date = date('Y-m-d',strtotime($post_data['to_date']));
            $config['wheres'][] = array('column_name' => 's.sell_date <=', 'column_value' => $to_date);
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
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
//        echo $this->db->last_query();
        $data = array();

        $isEdit = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "delete");

        foreach ($list as $sell) {
            $row = array();

            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'sell/add/'. $sell->sell_id.'" title="Edit Sell"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('sell/delete_sell/' . $sell->sell_id) . '"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';                    
            }

            $row[] = $action;
            $row[] = $sell->job_card_no;
            $row[] = $sell->party_name;
            $row[] = (strtotime($sell->sell_date) > 0?date('d-m-Y',strtotime($sell->sell_date)):'');
            $row[] = $sell->item_name;
            $row[] = number_format($sell->gross, 3, '.', '');
            $row[] = number_format($sell->net, 3, '.', '');
            $row[] = number_format($sell->touch, 2, '.', '');
            $row[] = number_format($sell->wastage, 3, '.', '');
            $row[] = number_format($sell->fine, 3, '.', '');
            $row[] = number_format($sell->other_charges, 2, '.', '');
            $row[] = $sell->sell_party_name;
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

    
  
    function delete_sell($sell_id) {
        $res = array();
        if(!empty($sell_id)){
            // Revert Sell to Increase Stock
            $old_sell_row = $this->crud->get_data_row_by_id('sells', 'sell_id', $sell_id);
            if(!empty($old_sell_row)){
                $item_id = $this->crud->get_column_value_by_id('tags', 'item_id', array('tag_id' => $old_sell_row->tag_id));
                $this->applib->update_item_stock_increase($item_id, $old_sell_row->gross, $old_sell_row->touch, $old_sell_row->fine);
            }
        }
        $this->crud->delete('sells', array('sell_id' => $sell_id));
        $res['status'] = "success";
        echo json_encode($res);
    }

}
