<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
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

    function party($party_id = '') {
        $data = array();
        if (!empty($party_id) && isset($party_id)) {
            if ($this->applib->have_access_role(PARTY_MODULE_ID, "edit") || $this->applib->have_access_role(PARTY_MODULE_ID, "view") || $this->applib->have_access_role(PARTY_MODULE_ID, "add") || $this->applib->have_access_role(PARTY_MODULE_ID, "delete")) {
                $data['party'] = $this->crud->get_data_row_by_id('party', 'party_id', $party_id);
                set_page('master/party', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(PARTY_MODULE_ID, "add") || $this->applib->have_access_role(PARTY_MODULE_ID, "view") || $this->applib->have_access_role(PARTY_MODULE_ID, "edit") || $this->applib->have_access_role(PARTY_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/party', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_party(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['name']) && !empty($post_data['name'])) {
            if (isset($post_data['party_id']) && !empty($post_data['party_id'])) {
                $party_name_duplication = $this->crud->getFromSQL('SELECT * FROM party WHERE RTRIM(LTRIM(REPLACE(`name`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["name"])).'" AND party_id != "'.$post_data["party_id"].'"');
            } else {
                $party_name_duplication = $this->crud->getFromSQL('SELECT * FROM party WHERE RTRIM(LTRIM(REPLACE(`name`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["name"])).'"');
            }

            if (isset($party_name_duplication) && !empty($party_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Party Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['name'] = $post_data['name'];
        $data['mobile_no'] = $post_data['mobile_no'];
        $data['email'] = $post_data['email'];
        $data['address'] = $post_data['address'];
        if (isset($post_data['party_id']) && !empty($post_data['party_id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['party_id'] = $post_data['party_id'];
            $result = $this->crud->update('party', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Party Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('party', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function party_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'party p';
        $config['select'] = 'p.*';
        $config['column_order'] = array(null,'p.name', 'p.address', 'p.mobile_no', 'p.email');
        $config['column_search'] = array('p.name', 'p.address', 'p.mobile_no', 'p.email');
        $config['order'] = array('p.party_id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(PARTY_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(PARTY_MODULE_ID, "delete");
        foreach ($list as $party) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/party/'. $party->party_id.'" title="Edit Party"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $party->party_id) . '"><i class="fa fa-trash"></i></a>';                    
            }
            $row[] = $action;
            $row[] = $party->name;
            $row[] = $party->address;
            $row[] = $party->mobile_no;
            $row[] = $party->email;            
            $data[] = $row;
        }        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function delete($id){
        $return = array();
        $table = $_POST['table_name'];
        $id_name = $_POST['id_name'];
        $result = $this->crud->delete($table,array($id_name=>$id));
        if(isset($result['error'])){
            $return['error'] = "Error";
        } else {
            $return['success'] = "Deleted";
        }
        print json_encode($return);
        exit;
    }

    function item($item_id = '') {
        $data = array();
        if (!empty($item_id) && isset($item_id)) {
            if ($this->applib->have_access_role(ITEM_MODULE_ID, "edit") || $this->applib->have_access_role(ITEM_MODULE_ID, "add") || $this->applib->have_access_role(ITEM_MODULE_ID, "view") || $this->applib->have_access_role(ITEM_MODULE_ID, "delete")) {
                $data['item'] = $this->crud->get_data_row_by_id('item', 'item_id', $item_id);
                set_page('master/item', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(ITEM_MODULE_ID, "add") || $this->applib->have_access_role(ITEM_MODULE_ID, "edit") || $this->applib->have_access_role(ITEM_MODULE_ID, "view") || $this->applib->have_access_role(ITEM_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/item', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_item(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['item_name']) && !empty($post_data['item_name'])) {
            if (isset($post_data['item_id']) && !empty($post_data['item_id'])) {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM item WHERE RTRIM(LTRIM(REPLACE(`item_name`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["item_name"])).'" AND item_id != "'.$post_data["item_id"].'"');
            } else {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM item WHERE RTRIM(LTRIM(REPLACE(`item_name`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["item_name"])).'"');
            }

            if (isset($item_name_duplication) && !empty($item_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Item Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['item_name'] = $post_data['item_name'];
        $data['short_name'] = $post_data['short_name'];

        if (isset($post_data['item_id']) && !empty($post_data['item_id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['item_id'] = $post_data['item_id'];
            $result = $this->crud->update('item', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Item Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('item', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function item_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'item i';
        $config['select'] = 'i.*';
        $config['column_order'] = array(null, 'i.item_name', 'i.short_name');
        $config['column_search'] = array('i.item_name', 'i.short_name');
        $config['order'] = array('i.item_id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(ITEM_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(ITEM_MODULE_ID, "delete");
        foreach ($list as $item) {
            $row = array();
            $action = '';
            if($isEdit) {
                if($item->item_id != ITEM_VETRAN_ID && $item->item_id != ITEM_CHOL_ID){
                    $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/item/'. $item->item_id.'" title="Edit Item"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                }
            }
            if($isDelete) {
                if($item->item_id != ITEM_VETRAN_ID && $item->item_id != ITEM_CHOL_ID){
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $item->item_id) . '"><i class="fa fa-trash"></i></a>';
                }
            }
            $row[] = $action;
            $row[] = $item->item_name;
            $row[] = $item->short_name;
            $data[] = $row;
        }        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function design_no($id = '') {
        $data = array();
        if (!empty($id) && isset($id)) {
            if ($this->applib->have_access_role(DESIGN_NO_MODULE_ID, "edit") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "add") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "view") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "delete")) {
                $data['design'] = $this->crud->get_data_row_by_id('design_no', 'id', $id);
                set_page('master/design_no', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(DESIGN_NO_MODULE_ID, "edit") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "add") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "view") || $this->applib->have_access_role(DESIGN_NO_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/design_no', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_design_no(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['design_no']) && !empty($post_data['design_no'])) {
            if (isset($post_data['id']) && !empty($post_data['id'])) {
                $design_no_duplication = $this->crud->getFromSQL('SELECT * FROM design_no WHERE RTRIM(LTRIM(REPLACE(`design_no`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["design_no"])).'" AND item_id = "'.$post_data["item_id"].'" AND id != "'.$post_data["id"].'"');
            } else {
                $design_no_duplication = $this->crud->getFromSQL('SELECT * FROM design_no WHERE RTRIM(LTRIM(REPLACE(`design_no`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["design_no"])).'" AND item_id = "'.$post_data["item_id"].'"');
            }

            if (isset($design_no_duplication) && !empty($design_no_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Design No Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['design_no'] = $post_data['design_no'];
        $data['item_id'] = isset($post_data['item_id']) && !empty($post_data['item_id']) ? $post_data['item_id'] : NULL;

        if (isset($post_data['id']) && !empty($post_data['id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['id'] = $post_data['id'];
            $result = $this->crud->update('design_no', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Design No Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('design_no', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function design_no_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'design_no d';
        $config['select'] = 'd.*,i.item_name';
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = d.item_id', 'join_type' => 'left');
        $config['column_order'] = array(null,'d.design_no','i.item_name');
        $config['column_search'] = array('d.design_no','i.item_name');
        $config['order'] = array('d.id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(DESIGN_NO_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(DESIGN_NO_MODULE_ID, "delete");
        foreach ($list as $design) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/design_no/'. $design->id.'" title="Edit Design No"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $design->id) . '"><i class="fa fa-trash"></i></a>';                    
            }
            $row[] = $action;
            $row[] = $design->design_no;
            $row[] = $design->item_name;
            $data[] = $row;
        }        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function job_worker($id = '') {
        $data = array();
        if (!empty($id) && isset($id)) {
            if ($this->applib->have_access_role(JOB_WORKER_MODULE_ID, "edit") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "add") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "view") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "delete")) {
                $data['job_worker'] = $this->crud->get_data_row_by_id('job_worker', 'id', $id);
                set_page('master/job_worker', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(JOB_WORKER_MODULE_ID, "edit") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "add") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "view") || $this->applib->have_access_role(JOB_WORKER_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/job_worker', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_job_worker(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['job_worker']) && !empty($post_data['job_worker'])) {
            if (isset($post_data['id']) && !empty($post_data['id'])) {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM job_worker WHERE RTRIM(LTRIM(REPLACE(`job_worker`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["job_worker"])).'" AND id != "'.$post_data["id"].'"');
            } else {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM job_worker WHERE RTRIM(LTRIM(REPLACE(`job_worker`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["job_worker"])).'"');
            }

            if (isset($item_name_duplication) && !empty($item_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Person Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['job_worker'] = $post_data['job_worker'];
        $data['wastage_loss_allowed'] = $post_data['wastage_loss_allowed'];
        $data['used_moti_on'] = (isset($post_data['used_moti_on']) && $post_data['used_moti_on'] == '1') ? $post_data['used_moti_on'] : 0;

        if (isset($post_data['id']) && !empty($post_data['id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['id'] = $post_data['id'];
            $result = $this->crud->update('job_worker', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Person Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('job_worker', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function job_worker_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'job_worker j';
        $config['select'] = 'j.*';
        $config['column_order'] = array(null,'j.job_worker', 'j.wastage_loss_allowed', 'j.used_moti_on');
        $config['column_search'] = array('j.job_worker', 'j.wastage_loss_allowed', 'j.used_moti_on');
        $config['order'] = array('j.id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(JOB_WORKER_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(JOB_WORKER_MODULE_ID, "delete");
        foreach ($list as $job_worker) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/job_worker/'. $job_worker->id.'" title="Edit Person"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $job_worker->id) . '"><i class="fa fa-trash"></i></a>';                    
            }
            $row[] = $action;
            $row[] = $job_worker->job_worker;
            $row[] = $job_worker->wastage_loss_allowed;
            $row[] = ($job_worker->used_moti_on == '1') ? 'Checked' : '';
            $data[] = $row;
        }        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function process_master($id = '') {
        $data = array();
        $data['process_issue_fields'] = $this->get_process_issue_fields();
        $data['process_receive_fields'] = $this->get_process_receive_fields();

        if (!empty($id) && isset($id)) {
            if ($this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "edit") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "add") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "view") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "delete")) {
                $data['process_master'] = $this->crud->get_data_row_by_id('process_master','id',$id);
                $selected_process_issue_fields = array();
                if(!empty($data['process_master']->process_issue_fields)) {
                    $selected_process_issue_fields = explode(',', $data['process_master']->process_issue_fields);
                }
                $data['selected_process_issue_fields'] = $selected_process_issue_fields;
                $selected_process_receive_fields = array();
                if(!empty($data['process_master']->process_receive_fields)) {
                    $selected_process_receive_fields = explode(',', $data['process_master']->process_receive_fields);
                }
                $data['selected_process_receive_fields'] = $selected_process_receive_fields;
                set_page('master/process_master', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "edit") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "add") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "view") || $this->applib->have_access_role(PROCESS_MASTER_MODULE_ID, "delete")) {
                set_page('master/process_master', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }        
    }

    function process_master_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'process_master pm';
        $config['select'] = 'pm.*';
        $config['column_order'] = array(null,'pm.process_name','pm.sequence');
        $config['column_search'] = array('pm.process_name','pm.sequence');
        $config['order'] = array('pm.sequence' => 'asc');
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(PROCESS_MASTER_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(PROCESS_MASTER_MODULE_ID, "delete");
        foreach ($list as $process_master) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/process_master/'. $process_master->id.'" title="Edit Person"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                if($process_master->delete_allow == 1){
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $process_master->id) . '"><i class="fa fa-trash"></i></a>';
                }
            }
            $row[] = $action;
            $row[] = $process_master->process_name;
            $row[] = $process_master->sequence;
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

    function save_process_master(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (!empty($post_data['process_name'])) {
            if (isset($post_data['id']) && !empty($post_data['id'])) {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM process_master WHERE RTRIM(LTRIM(REPLACE(`process_name`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["process_name"])).'" AND id != "'.$post_data["id"].'"');
            } else {
                $item_name_duplication = $this->crud->getFromSQL('SELECT * FROM process_master WHERE RTRIM(LTRIM(REPLACE(`process_name`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["process_name"])).'"');
            }

            if (isset($item_name_duplication) && !empty($item_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Person Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['process_name'] = $post_data['process_name'];
        $data['sequence'] = $post_data['sequence'];
        $data['print_columns'] = (!empty($post_data['print_columns'])) ? implode(',',$post_data['print_columns']) : '';
        $data['on_how_much'] = isset($post_data['on_how_much']) && !empty($post_data['on_how_much']) ? $post_data['on_how_much'] : null;
        $data['allowed_loss'] = isset($post_data['allowed_loss']) && !empty($post_data['allowed_loss']) ? $post_data['allowed_loss'] : null;
        $data['process_issue_fields'] = (!empty($post_data['process_issue_fields'])) ? implode(',',$post_data['process_issue_fields']) : '';
        $data['process_receive_fields'] = (!empty($post_data['process_receive_fields'])) ? implode(',',$post_data['process_receive_fields']) : '';

        if (isset($post_data['id']) && !empty($post_data['id'])) {
            $process_id = $post_data['id'];
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['id'] = $post_data['id'];
            $result = $this->crud->update('process_master', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Process Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $process_id = $this->crud->insert('process_master', $data);
            $return['success'] = "Added";
        }
        print json_encode($return);
        exit;
    }

    function get_process_issue_fields(){
        $columns = array(
            "Wastage",
            "AD Weight",
            "AD Pcs",
            "Vetran",
            "V Pcs",
            "Stone Pcs",
            "Stone Wt",
            "Moti",
            "Moti Amount",
        );      
        $response = array();
        foreach ($columns as $key => $column) {
            $response[] = array(
                'id' => 'pif_' . strtolower(str_replace(' ','_',$column)),
                'text' => $column
            );
        }
        return $response;
    }

    function get_process_receive_fields(){
        $columns = array(
            "Wastage",
            "AD Weight",
            "AD Pcs",
            "Before Meena",
            "Meena Wt",
            "Item Weight",
            "Kundan",
            "SM",
            "Vetran",
            "V Pcs",
            "Stone Pcs",
            "Stone Wt",
            "Stone Charges",
            "Moti",
            "Moti Amount",
            "Other Charges",
            "Loss",
            "Loss Fine",
            "Allowed Loss",
        );      
        $response = array();
        foreach ($columns as $key => $column) {
            $response[] = array(
                'id' => 'prf_' . strtolower(str_replace(' ','_',$column)),
                'text' => $column
            );
        }
        return $response;
    }

    function user($user_id = '') {
        $data = array();
        if (isset($user_id) && !empty($user_id)) {
            if ($this->applib->have_access_role(USER_MODULE_ID, "edit") || $this->applib->have_access_role(USER_MODULE_ID, "add") || $this->applib->have_access_role(USER_MODULE_ID, "view") || $this->applib->have_access_role(USER_MODULE_ID, "delete")) {
                $user_data = $this->crud->get_row_by_id('user', array('user_id' => $user_id));
                $user_data = $user_data[0];

                $data['user_data'] = $user_data;
                set_page('master/user', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(USER_MODULE_ID, "edit") || $this->applib->have_access_role(USER_MODULE_ID, "add") || $this->applib->have_access_role(USER_MODULE_ID, "view") || $this->applib->have_access_role(USER_MODULE_ID, "delete")) {
                set_page('master/user', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function user_datatable() {
        $post_data = $this->input->post();
        $config['table'] = 'user u';
        $config['select'] = 'u.*';
        $config['column_search'] = array('u.name','u.user_name','u.user_email');
        $config['column_order'] = array(null,'u.name','u.user_name','u.user_email');
        $config['order'] = array('u.user_id' => 'desc');

        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();

        $data = array();
        $isEdit = $this->app_model->have_access_role(USER_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(USER_MODULE_ID, "delete");
        foreach ($list as $user) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a href="' . base_url("master/user/" . $user->user_id) . '" class="btn-primary btn-xs"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;';
            }
            if($isDelete) {
                $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $user->user_id) . '"><i class="fa fa-trash"></i></a>';
            }

            $row[] = $action;
            $row[] = $user->name;
            $row[] = $user->user_name;
            $row[] = $user->user_email;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function save_user() {
        $post_data = $this->input->post();
        $return = array();
        if (isset($post_data['user_name']) && !empty($post_data['user_name'])) {
            if (isset($post_data['user_id']) && !empty($post_data['user_id'])) {
                $user_name_duplication = $this->crud->getFromSQL("SELECT * FROM user WHERE RTRIM(LTRIM(REPLACE(`user_name`,' ','' )))  = '".strtolower(str_replace(' ', '', $post_data['user_name']))."' AND user_id != '".$post_data['user_id']."'  AND RTRIM(LTRIM(REPLACE(`name`,' ','' ))) = '".strtolower(str_replace(' ', '', $post_data['name']))."'");
            } else {
                $user_name_duplication = $this->crud->getFromSQL("SELECT * FROM user WHERE RTRIM(LTRIM(REPLACE(`user_name`,' ','' ))) = '".strtolower(str_replace(' ', '', $post_data['user_name']))."' AND RTRIM(LTRIM(REPLACE(`name`,' ','' ))) = '".strtolower(str_replace(' ', '', $post_data['name']))."'");
            }

            //print_r($user_name_duplication);die;
            if (isset($user_name_duplication) && !empty($user_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Username Already Exist';
                print json_encode($return);
                exit;
            }
        }

        //echo "<pre/>"; print_r($post_data); die;
        $user_data = array();
        $user_data['name'] = $post_data['name'];
        $user_data['user_name'] = $post_data['user_name'];
        $user_data['user_email'] = $post_data['user_email'];
        if (isset($post_data['user_id']) && !empty($post_data['user_id'])) {
            if(!empty($post_data['password'])) {
                $user_data['user_pass'] = md5($post_data['password']);
            }
            $user_data['updated_at'] = $this->now_time;
            $user_data['updated_by'] = $this->logged_in_id;
            $where_array['user_id'] = $post_data['user_id'];

            $result = $this->crud->update('user', $user_data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'User Updated Successfully');
            }
        } else {
            $user_data['user_pass'] = md5($post_data['password']);
            $user_data['created_at'] = $this->now_time;
            $user_data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('user', $user_data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function user_rights(){
        if ($this->app_model->have_access_role(USER_RIGHTS_MODULE_ID, "allow")) {
            $data = array();
            $data['users'] = $this->crud->getFromSQL("SELECT * FROM `user` ORDER BY `user_id` ASC ");
            $role_type_id = isset($_GET['user_type']) ? $_GET['user_type']:0;
            $data['user_type_id'] = $role_type_id;
            $data['modules_roles'] = $this->app_model->getModuleRoles();
            $data['user_roles'] = $this->app_model->getUserRoleIDS($role_type_id);
//            echo '<pre>'; print_r($data['user_roles']);
//            echo '<pre>'; print_r($data['modules_roles']); exit;
            set_page('master/user_rights', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }
    
    function update_roles(){
//        echo "<pre>"; print_r($this->input->post()); exit;
        $status = 1;
        $msg = "Roles has been updated successfully.";
        $user_id = $this->input->post("user_type");

        if(intval($user_id) > 0){
            $roles = $this->input->post("roles");
            
            $sql = "DELETE FROM user_roles WHERE user_id='$user_id'";
            $this->crud->execuetSQL($sql);
//            echo '<pre>'; print_r($roles); exit;
            // add new roles
            $dataToInsert = array();
            if(is_array($roles) && count($roles) > 0){
                if(!empty($user_id)){
                    
                    if (is_array($roles) && count($roles) > 0) {
                        $user_role_data = array();
                        foreach ($roles as $module_id => $role_id) {
                            $tmp = explode("_", $module_id);
                            $module_id = $tmp[1];
                            $data = array(
                                'user_id' => $user_id,
                                'website_module_id' => $module_id,
                                'role_type_id' => $role_id,
                            );
                            array_push($user_role_data, $data);
                        }
//                        echo "<pre>"; print_r($user_role_data); exit;
                        $this->db->insert_batch('user_roles', $user_role_data);
//                        echo $this->db->last_query(); exit;

                        $sql = "SELECT ur.user_id,ur.website_module_id,ur.role_type_id, LOWER(r.title) as role, LOWER(m.title) as module FROM user_roles ur
                                INNER JOIN website_modules m ON ur.website_module_id = m.website_module_id
                                INNER JOIN module_roles r ON ur.role_type_id = r.module_role_id WHERE ur.user_id = '" . $user_id ."' ";
                        $results = $this->crud->getFromSQL($sql);
                        $roles = array();
                        foreach($results as $row){
                            $roles[$row->website_module_id][] = $row->role;
                        }
                        $this->session->set_userdata('user_roles',$roles);
                    }
                }
            }
        }else{
            $status = 0;
            $msg = "Please Select User.";
        }

        echo json_encode(array("status" => $status,"msg" => $msg));
        exit;
    }

    function upload_design_no()
    {
        if ($this->applib->have_access_role(DESIGN_NO_MODULE_ID, "add") && $this->applib->have_access_role(ITEM_MODULE_ID, "add")) {
            $data = array();
            set_page('master/upload_design_no', $data);   
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_upload_design_no()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time',0);
        set_time_limit(0);
        
        if (isset($_FILES['file_design_no']['name']) && !empty($_FILES['file_design_no']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;
            $config['file_name'] = 'design_no.csv';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file_design_no')) {
                $this->session->set_flashdata('success', false);
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect("master/upload_design_no");
            } else {
                $fp = fopen('./uploads/design_no.csv', 'r') or die("can't open file");
        
                while ($row = fgetcsv($fp, 5000000)) {
                    if(!empty($row[0]) && !empty($row[1])){
                        $item_name = trim($row[0]);
                        $design_no = trim($row[1]);
                        
                        $item_row = $this->crud->getFromSQL('SELECT * FROM item WHERE RTRIM(LTRIM(REPLACE(`item_name`," ","" ))) = "'.strtolower(str_replace(" ", "",$item_name)).'"');
                        if(!empty($item_row[0]->item_id)) {
                            $item_id = $item_row[0]->item_id;
                        } else {
                            $item_data = array();
                            $item_data['item_name'] = $item_name;
                            $item_data['created_at'] = $this->now_time;
                            $item_data['created_by'] = $this->logged_in_id;
                            $item_id = $this->crud->insert('item', $item_data);
                        }

                        $design_no_row = $this->crud->getFromSQL('SELECT * FROM design_no WHERE RTRIM(LTRIM(REPLACE(`design_no`," ","" ))) = "'.strtolower(str_replace(" ", "", $design_no)).'" AND item_id = "'.$item_id.'"');
                        if(!empty($design_no_row[0]->id)) { } else {
                            $design_no_data = array();
                            $design_no_data['item_id'] = $item_id;
                            $design_no_data['design_no'] = $design_no;
                            $design_no_data['created_at'] = $this->now_time;
                            $design_no_data['created_by'] = $this->logged_in_id;
                            $this->crud->insert('design_no', $design_no_data);
                        }
                    }
                }
                if (file_exists("./uploads/design_no.csv")) {
                    unlink("./uploads/design_no.csv");
                }
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Design No Uploaded Successfully');
                redirect("master/upload_design_no");
            }
        } else {
            $this->session->set_flashdata('success', false);
            $this->session->set_flashdata('message', 'File not found');
            redirect("master/upload_design_no");
        }
    }

    function moti($moti_id = '') {
        $data = array();
        if (!empty($moti_id) && isset($moti_id)) {
            if ($this->applib->have_access_role(MOTI_MODULE_ID, "edit") || $this->applib->have_access_role(MOTI_MODULE_ID, "add") || $this->applib->have_access_role(MOTI_MODULE_ID, "view") || $this->applib->have_access_role(MOTI_MODULE_ID, "delete")) {
                $data['moti'] = $this->crud->get_data_row_by_id('moti', 'moti_id', $moti_id);
                set_page('master/moti', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(MOTI_MODULE_ID, "add") || $this->applib->have_access_role(MOTI_MODULE_ID, "edit") || $this->applib->have_access_role(MOTI_MODULE_ID, "view") || $this->applib->have_access_role(MOTI_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/moti', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_moti(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['moti_name']) && !empty($post_data['moti_name'])) {
            if (isset($post_data['moti_id']) && !empty($post_data['moti_id'])) {
                $moti_name_duplication = $this->crud->getFromSQL('SELECT * FROM moti WHERE RTRIM(LTRIM(REPLACE(`moti_name`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["moti_name"])).'" AND moti_id != "'.$post_data["moti_id"].'"');
            } else {
                $moti_name_duplication = $this->crud->getFromSQL('SELECT * FROM moti WHERE RTRIM(LTRIM(REPLACE(`moti_name`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["moti_name"])).'"');
            }

            if (isset($moti_name_duplication) && !empty($moti_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Moti Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['moti_name'] = $post_data['moti_name'];

        if (isset($post_data['moti_id']) && !empty($post_data['moti_id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['moti_id'] = $post_data['moti_id'];
            $result = $this->crud->update('moti', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Moti Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('moti', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function moti_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'moti i';
        $config['select'] = 'i.*';
        $config['column_order'] = array(null,'i.moti_name');
        $config['column_search'] = array('i.moti_name');
        $config['order'] = array('i.moti_id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(MOTI_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(MOTI_MODULE_ID, "delete");
        foreach ($list as $moti) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/moti/'. $moti->moti_id.'" title="Edit Moti"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $moti->moti_id) . '"><i class="fa fa-trash"></i></a>';                    
            }
            $row[] = $action;
            $row[] = $moti->moti_name;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function charges($charges_id = '') {
        $data = array();
        if (!empty($charges_id) && isset($charges_id)) {
            if ($this->applib->have_access_role(CHARGES_MODULE_ID, "edit") || $this->applib->have_access_role(CHARGES_MODULE_ID, "add") || $this->applib->have_access_role(CHARGES_MODULE_ID, "view") || $this->applib->have_access_role(CHARGES_MODULE_ID, "delete")) {
                $data['charges'] = $this->crud->get_data_row_by_id('charges', 'charges_id', $charges_id);
                set_page('master/charges', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        } else {
            if ($this->applib->have_access_role(CHARGES_MODULE_ID, "add") || $this->applib->have_access_role(CHARGES_MODULE_ID, "edit") || $this->applib->have_access_role(CHARGES_MODULE_ID, "view") || $this->applib->have_access_role(CHARGES_MODULE_ID, "delete")) {
                $data = array();
                set_page('master/charges', $data);
            } else {
                $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
                redirect("/");
            }
        }
    }

    function save_charges(){
        $return = array();
        $return = array("success" => FALSE, "message" => array());
        $post_data = $this->input->post();
        if (isset($post_data['charges_name']) && !empty($post_data['charges_name'])) {
            if (isset($post_data['charges_id']) && !empty($post_data['charges_id'])) {
                $charges_name_duplication = $this->crud->getFromSQL('SELECT * FROM charges WHERE RTRIM(LTRIM(REPLACE(`charges_name`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["charges_name"])).'" AND charges_id != "'.$post_data["charges_id"].'"');
            } else {
                $charges_name_duplication = $this->crud->getFromSQL('SELECT * FROM charges WHERE RTRIM(LTRIM(REPLACE(`charges_name`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["charges_name"])).'"');
            }

            if (isset($charges_name_duplication) && !empty($charges_name_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Charges Name Already Exist';
                print json_encode($return);
                exit;
            }
        }
        $data['charges_name'] = $post_data['charges_name'];
        $data['effect_person_ledger'] = (isset($post_data['effect_person_ledger']) && $post_data['effect_person_ledger'] == '1') ? $post_data['effect_person_ledger'] : 0;
        $data['rate_on_ct'] = (isset($post_data['rate_on_ct']) && $post_data['rate_on_ct'] == '1') ? $post_data['rate_on_ct'] : 0;

        if (isset($post_data['charges_id']) && !empty($post_data['charges_id'])) {
            $data['updated_at'] = $this->now_time;
            $data['updated_by'] = $this->logged_in_id;
            $where_array['charges_id'] = $post_data['charges_id'];
            $result = $this->crud->update('charges', $data, $where_array);
            if ($result) {
                $return['success'] = "Updated";
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Charges Updated Successfully');
            }
        } else {
            $data['created_at'] = $this->now_time;
            $data['created_by'] = $this->logged_in_id;
            $result = $this->crud->insert('charges', $data);
            if ($result) {
                $return['success'] = "Added";
            }
        }
        print json_encode($return);
        exit;
    }

    function charges_datatable() {
        $post_data = $this->input->post();

        $config['table'] = 'charges i';
        $config['select'] = 'i.*';
        $config['column_order'] = array(null,'i.charges_name');
        $config['column_search'] = array('i.charges_name');
        $config['order'] = array('i.charges_id' => 'desc');
        //print_r($config);die;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();
        $isEdit = $this->app_model->have_access_role(CHARGES_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(CHARGES_MODULE_ID, "delete");
        foreach ($list as $charges) {
            $row = array();
            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'master/charges/'. $charges->charges_id.'" title="Edit Charges"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('master/delete/' . $charges->charges_id) . '"><i class="fa fa-trash"></i></a>';                    
            }
            $row[] = $action;
            $row[] = $charges->charges_name;
            $row[] = ($charges->effect_person_ledger == '1') ? 'Yes' : 'No';
            $row[] = ($charges->rate_on_ct == '1') ? 'Yes' : 'No';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->count_all(),
            "recordsFiltered" => $this->datatable->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
