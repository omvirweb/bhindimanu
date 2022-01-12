<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class App
 * &@property AppModel $app_model
 * &@property AppLib $applib
 * &@property Crud $crud
 */
class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Appmodel', 'app_model');
        $this->load->model('Crud', 'crud');
        $this->logged_in_id = $this->session->userdata('bda2_is_logged_in')['user_id'];
    }
    
    function get_select2_data($table_name, $id_column, $text_column, $search, $page = 1, $where = array())
    {
        $party_select2_data = array();
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;
        $this->db->select("$id_column,$text_column");
        $this->db->from("$table_name");
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->like("$text_column", $search);
        $this->db->limit($resultCount, $offset);
        
        if($table_name == 'process_master'){
            $this->db->order_by('sequence');
        } else {
            $this->db->order_by("$text_column");
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $party_row) {
                $party_select2_data[] = array(
                    'id' => $party_row->$id_column,
                    'text' => $party_row->$text_column,
                );
            }
        }
        return $party_select2_data;
    }
    
    function count_select2_data($table_name, $id_column, $text_column, $search, $where = array())
    {
        $this->db->select("$id_column");
        $this->db->from("$table_name");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->like("$text_column", $search);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function get_select2_text_by_id($table_name, $id_column, $text_column, $id_column_val)
    {
        $this->db->select("$id_column,$text_column");
        $this->db->from("$table_name");
        $this->db->where($id_column, $id_column_val);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo json_encode(array('success' => true, 'id' => $id_column_val, 'text' => $query->row()->$text_column));
            exit();
        }
        echo json_encode(array('success' => true, 'id' => '', 'text' => '--select--'));
        exit();
    }

    function item_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $where = '';
        $results = array(
                "results" => $this->get_select2_data('item', 'item_id', 'item_name', $search, $page, $where),
                "total_count" => $this->count_select2_data('item', 'item_id', 'item_name', $search, $where),
        );
        echo json_encode($results);
        exit();
    }

    function job_card_item_select2_source($job_card_id){
        $select2_data = array();
        $this->db->select("i.item_id,i.item_name");
        $this->db->from("item i");
        $this->db->join("job_card_items jci","jci.item_id=i.item_id");
        $this->db->where('jci.job_card_id',$job_card_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $select2_data[] = array(
                    'id' => $row->item_id,
                    'text' => $row->item_name,
                );
            }
        }
        $results = array(
            "results" => $select2_data,
            "total_count" => count($select2_data),
        );
        echo json_encode($results);
        exit();
    }

    function set_item_select2_val_by_id($id){
        $this->get_select2_text_by_id('item', 'item_id', 'item_name', $id);
    }

    function party_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('party', 'party_id', 'name', $search, $page),
            "total_count" => $this->count_select2_data('party', 'party_id', 'name', $search),
        );
        echo json_encode($results);
        exit();
    }

    function set_party_select2_val_by_id($id){
        $this->get_select2_text_by_id('party', 'party_id', 'name', $id);
    }
    
    function item_designs_select2_source($item_id){

        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $where = array('item_id' => $item_id);

        $party_select2_data = array();
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;
        $this->db->select("id,design_no");
        $this->db->from("design_no");
        if (!empty($where)) {
            $this->db->where($where);
        }        
        $this->db->like("design_no", $search,'after');
        $this->db->limit($resultCount, $offset);
        $this->db->order_by("CAST(design_no AS UNSIGNED )");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $party_row) {
                $party_select2_data[] = array(
                    'id' => $party_row->id,
                    'text' => $party_row->design_no,
                );
            }
        }

        $this->db->select("id");
        $this->db->from("design_no");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->like("design_no", $search,'after');
        $query = $this->db->get();
        $total_count = $query->num_rows();

        $results = array(
            "results" => $party_select2_data,
            "total_count" => $total_count,
        );
        echo json_encode($results);
        exit();

        /*$results = array(
            "results" => $this->get_select2_data('design_no', 'id', 'design_no', $search, $page,array('item_id' => $item_id)),
            "total_count" => $this->count_select2_data('design_no', 'id', 'design_no', $search,array('item_id' => $item_id)),
        );
        echo json_encode($results);
        exit();*/
    }

    function job_card_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('job_card', 'job_card_id', 'job_card_no', $search, $page),
            "total_count" => $this->count_select2_data('job_card', 'job_card_id', 'job_card_no', $search),
        );
        echo json_encode($results);
        exit();
    }

    function set_job_card_select2_val_by_id($id){
        $this->get_select2_text_by_id('job_card', 'job_card_id', 'job_card_no', $id);
    }

    function set_process_select2_val_by_id($id){
        $this->get_select2_text_by_id('process_master', 'id', 'process_name', $id);
    }

    function process_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('process_master', 'id', 'process_name', $search, $page),
            "total_count" => $this->count_select2_data('process_master', 'id', 'process_name', $search),
        );
        echo json_encode($results);
        exit();
    }

    function job_worker_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('job_worker', 'id', 'job_worker', $search, $page),
            "total_count" => $this->count_select2_data('job_worker', 'id', 'job_worker', $search),
        );
        echo json_encode($results);
        exit();
    }
    function set_job_worker_select2_val_by_id($id){
        $this->get_select2_text_by_id('job_worker', 'id', 'job_worker', $id);
    }
    function get_job_worker_detail($job_worker_id){
        $data = array();
        $this->db->select("*");
        $this->db->from("job_worker");
        $this->db->where('id',$job_worker_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
        exit();
    }

    function get_job_card_detail($job_card_id){
        $data = array();
        $this->db->select("jc.*, jci.item_id, jci.design_text, jci.design_no, p.name as party_name");
        $this->db->from("job_card jc");
        $this->db->join("job_card_items jci","jci.job_card_id=jc.job_card_id");
        $this->db->join("party p","p.party_id=jc.party_id");
        $this->db->where('jc.job_card_id',$job_card_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
        exit();
    }

    function get_job_card_tag_detail($job_card_id) {
        $data = array();
        $this->db->select("jc.*, p.name as party_name, t.tag_id, t.gross as tag_gross, t.net as tag_net, t.other_charges as tag_other_charges, t.image as tag_image, i.item_name");
        $this->db->from("job_card jc");
        $this->db->join("party p", "p.party_id=jc.party_id");
        $this->db->join("tags t", "t.job_card_id = jc.job_card_id");
        $this->db->join("item i", "i.item_id = t.item_id");
        $this->db->where('jc.job_card_id', $job_card_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
        exit();
    }

    function get_item_designs_by_item($item_id){
        return $this->applib->get_item_designs_by_item($item_id);
    }

    function get_process_gross(){
        $post_data = $this->input->post();
        $res = array();

        $select = "m.process_id,SUM(IF(type_id=1,IFNULL(mir.gross,0),0)) AS issue_finish,SUM(IF(type_id=2,mir.gross,0)) AS issue_scrap,SUM(IF(type_id=3,mir.gross,0)) AS receive_finish,SUM(IF(type_id=4,mir.gross,0)) AS receive_scrap";
        $this->db->select($select);
        $this->db->from('manufacture m');
        $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id');
        $this->db->join('job_card jc','jc.job_card_id = m.job_card_id');
        $this->db->where('m.close_to_calculate_loss','1');
        if(!empty($post_data['party_id'])) {
            $this->db->where('jc.party_id',$post_data['party_id']);
        }
        if(!empty($post_data['item_id'])) {
            $this->db->where('mir.item_id',$post_data['item_id']);
        }
        if(!empty($post_data['touch'])) {
            $this->db->where('jc.melting',$post_data['touch']);
        }
        $this->db->group_by('m.process_id');
        $query = $this->db->get();
//        echo $this->db->last_query(); exit;
        $process_gross_res = array();
        if($query->num_rows() > 0) {
            foreach ($query->result() as $key => $row) {
                $issue_finish = $row->issue_finish;
                $issue_scrap = $row->issue_scrap;
                $receive_finish = $row->receive_finish;
                $receive_scrap = $row->receive_scrap;

                $issue_gross = $issue_finish + $issue_scrap;
                $receive_gross = $receive_finish + $receive_scrap;
                $gross_bal = ($issue_gross - $receive_gross);
                $process_gross_res[$row->process_id] = $gross_bal;
            }
        }        
        $process_res = $this->crud->get_all_records('process_master','sequence','asc');
        $process_gross = array();
        foreach ($process_res as $key => $row) {
            if(isset($process_gross_res[$row->id])) {
                $process_gross[$row->id] = number_format($process_gross_res[$row->id], 3, '.', '');
            } else {
                $process_gross[$row->id] = number_format(0, 3, '.', '');
            }
            
        }
        $res['status'] = 'success';
        $res['process_gross'] = $process_gross;
        echo json_encode($res);
        exit();
    }

    function get_process_ir_columns($process_id){
        $selected_columns = array();

        $process_row =$this->crud->get_data_row_by_id('process_master', 'id', $process_id);

        if(!empty($process_row->print_columns)) {
            $selected_columns = explode(',', $process_row->print_columns);
        }

        $tmp_selected_columns = array();
        
        $all_columns = $this->app_model->get_process_print_columns();
        $all_rows = $this->app_model->get_process_print_rows();
        $all_columns = array_merge($all_columns,$all_rows);
        foreach ($all_columns as $key => $column) {
            if(in_array($column['id'],$selected_columns)) {
                $tmp_selected_columns[$column['id']] = 'show';
            } else {
                $tmp_selected_columns[$column['id']] = 'hide';
            }
        }

        echo json_encode(array('columns' => $tmp_selected_columns));
    }

    function charges_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('charges', 'charges_id', 'charges_name', $search, $page),
            "total_count" => $this->count_select2_data('charges', 'charges_id', 'charges_name', $search),
        );
        echo json_encode($results);
        exit();
    }
    function set_charges_select2_val_by_id($id){
        $this->get_select2_text_by_id('charges', 'charges_id', 'charges_name', $id);
    }

    function moti_select2_source(){
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $results = array(
            "results" => $this->get_select2_data('moti', 'moti_id', 'moti_name', $search, $page),
            "total_count" => $this->count_select2_data('moti', 'moti_id', 'moti_name', $search),
        );
        echo json_encode($results);
        exit();
    }
    function set_moti_select2_val_by_id($id){
        $this->get_select2_text_by_id('moti', 'moti_id', 'moti_name', $id);
    }

    function get_process_issue_fields($process_id, $type_id) {
        $selected_process_issue_fields = array();
        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $process_id);
        if (!empty($process_row->process_issue_fields)) {
            $selected_process_issue_fields = explode(',', $process_row->process_issue_fields);
        }
        echo json_encode($selected_process_issue_fields);
    }

    function get_process_receive_fields($process_id, $type_id) {
        $selected_process_receive_fields = array();
        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $process_id);
        if (!empty($process_row->process_receive_fields)) {
            $selected_process_receive_fields = explode(',', $process_row->process_receive_fields);
        }
        echo json_encode($selected_process_receive_fields);
    }

    function get_process_issue_receive_fields($process_id) {
        $selected_process_issue_fields = array();
        $selected_process_receive_fields = array();
        $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $process_id);
        if (!empty($process_row->process_issue_fields)) {
            $selected_process_issue_fields = explode(',', $process_row->process_issue_fields);
        }
        if (!empty($process_row->process_receive_fields)) {
            $selected_process_receive_fields = explode(',', $process_row->process_receive_fields);
        }
        $selected_process_issue_receive_fields = array_merge($selected_process_issue_fields, $selected_process_receive_fields);
        $return = array();
        $return['selected_process_issue_fields'] = $selected_process_issue_fields;
        $return['selected_process_receive_fields'] = $selected_process_receive_fields;
        $return['selected_process_issue_receive_fields'] = $selected_process_issue_receive_fields;
        $return['process_on_how_much'] = $process_row->on_how_much;
        $return['process_allowed_loss'] = $process_row->allowed_loss;
        echo json_encode($return);
    }

    function get_item_and_max_design_no($item_id, $job_card_item_id = 0){
        $data = array();
        $this->db->select("*");
        $this->db->from("item");
        $this->db->where('item_id',$item_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $last_design_no = 0;
            $query = $this->db->query("SELECT `design_no` FROM `job_card_items` WHERE `item_id` = '" . $item_id . "' AND `job_card_item_id` = '" . $job_card_item_id . "' ");
            if($query->num_rows() > 0) {
                if(!empty($query->row()->design_no)){
                    $last_design_no = $query->row()->design_no;
                }
            } else {
                $query = $this->db->query("SELECT `design_no` FROM `job_card_items` WHERE `item_id` = '" . $item_id . "' ORDER BY `design_no` DESC LIMIT 1");
                if($query->num_rows() > 0) {
                    if(!empty($query->row()->design_no)){
                        $last_design_no = $query->row()->design_no;
                    }
                }
                $last_design_no = $last_design_no + 1;
            }
            $data['design_no'] = $last_design_no;
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
        exit();
    }

    function get_charges_detail($charges_id){
        $data = array();
        $this->db->select("*");
        $this->db->from("charges");
        $this->db->where('charges_id',$charges_id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $data['status'] = 'success';
        } else {
            $data['status'] = 'fail';
        }
        echo json_encode($data);
        exit();
    }
}
