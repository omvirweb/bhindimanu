<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_dispatch extends CI_Controller {

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
	
	function order_dispatch_list() {
        $data = array();
        $data['process_master_res'] = $this->crud->get_all_records('process_master','sequence','asc');
        $this->load->view('order_dispatch/order_dispatch_list', $data);
    }
    
    function order_dispatch_datatable() {
        $post_data = $this->input->post();
        $where = '1=1';

        $process_master_res = $this->crud->get_all_records('process_master','sequence','asc');

        $config['table'] = 'job_card jc';
        $config['select'] = 'jc.*,p.name as party_name,SUM(jci.weight) as total_weight';
        $config['joins'][] = array('join_table' => 'party p', 'join_by' => 'p.party_id = jc.party_id');
        $config['joins'][] = array('join_table' => 'job_card_items jci', 'join_by' => 'jci.job_card_id = jc.job_card_id');
        $config['column_search'] = array('jc.job_card_no','p.name','jc.melting');
        $config['column_order'] = array('jc.job_card_no','p.name','jc.melting','total_weight');
        $config['order'] = array('jc.job_card_id' => 'desc');
        $config['group_by'] = 'jc.job_card_id';
        
        if(!empty($post_data['party_id'])) {
            $where .= ' AND jc.party_id='.$post_data['party_id'];       
        }

        $config['custom_where'] = $where;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();

        foreach ($list as $job_card_row) {
            $row = array();
            $action = '';
            
            $row[] = $job_card_row->job_card_no;
            $row[] = $job_card_row->party_name;
            $row[] = number_format($job_card_row->melting, 3, '.', '');
            $row[] = number_format($job_card_row->total_weight, 3, '.', '');
            if(!empty($process_master_res)) {
                foreach ($process_master_res as $process_master_row) {
                    $query = "SELECT SUM(IF(type_id=1,weight,0)) as total_issue_weight,SUM(IF(type_id=2,weight,0)) as total_receive_weight
                                FROM manufacture_issue_receive mir
                                JOIN manufacture m ON(m.manufacture_id = mir.manufacture_id)
                                WHERE m.job_card_id=".$job_card_row->job_card_id." AND m.process_id=".$process_master_row->id." GROUP BY m.job_card_id LIMIT 1";
                    $query = $this->db->query($query);
                    if($query->num_rows() > 0) {
                        $total_weight = $query->row()->total_issue_weight - $query->row()->total_receive_weight;
                        $row[] = number_format($total_weight, 3, '.', '');
                    } else {
                        $row[] = '';
                    }
                }
            }
            $row[] = '';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all('jc.job_card_id'),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
