<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_card extends CI_Controller {

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
	
    function add($job_card_id = '') {
        if ($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "edit") || $this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "add")) {
            $data = array();
            $data['job_card_no'] = $this->get_job_card_no();
            if(!empty($job_card_id)) {
                $data['job_card_row'] = $this->crud->get_data_row_by_id('job_card', 'job_card_id', $job_card_id);
                $job_card_item_res = array();
                $this->db->select('jci.*,i.item_name as item_id_text');
                $this->db->from('job_card_items jci');
                $this->db->join('item i','i.item_id = jci.item_id','left');
                $this->db->where('jci.job_card_id',$job_card_id);
                $query = $this->db->get();
                if($query->num_rows() > 0) {
                    $job_card_item_res = $query->result();
                }                
                $lineitem_objectdata = array();
                foreach ($job_card_item_res as $key => $js_item_row) {
//                    $item_design_ids = $this->crud->getFromSQL("SELECT GROUP_CONCAT(jcd.design_id) as design_ids,GROUP_CONCAT(d.design_no) as design_ids_text FROM job_card_items_designs jcd JOIN design_no d ON(d.id = jcd.design_id) WHERE jcd.job_card_item_id= '" . $js_item_row->job_card_item_id . "'");

                    $lineitem_objectdata[] = array(
                        "job_card_item_id" => $js_item_row->job_card_item_id,
//                        "design_ids" => explode(',',$item_design_ids[0]->design_ids),
//                        "design_ids_text" => $item_design_ids[0]->design_ids_text,
                        "item_id" => $js_item_row->item_id,
                        "item_id_text" => $js_item_row->item_id_text,
                        "design_text" => $js_item_row->design_text,
                        "design_no" => $js_item_row->design_no,
                        "item_remark" => $js_item_row->remark,
                        "item_photo" => $js_item_row->item_photo,
                        "qty" => $js_item_row->qty,
                        "total_qty" => $js_item_row->total_qty,
                        "total_weight" => $js_item_row->total_weight,
                        "weight" => $js_item_row->weight,
                    );
                }
                $data['lineitem_objectdata'] = json_encode($lineitem_objectdata,true);
            }
            $this->load->view('job_card/add', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_job_card(){
        $post_data = $this->input->post();
        $job_card_id = 0;
//        echo "<pre>"; print_r($post_data);
//        echo "<pre>"; print_r(json_decode($post_data['job_card_items'])); exit;
        if (isset($post_data['job_card_no']) && !empty($post_data['job_card_no'])) {
            if (isset($post_data['job_card_id']) && !empty($post_data['job_card_id'])) {
                $job_card_duplication = $this->crud->getFromSQL('SELECT * FROM job_card WHERE RTRIM(LTRIM(REPLACE(`job_card_no`," ","" )))  = "'.strtolower(str_replace(" ", "", $post_data["job_card_no"])).'" AND job_card_id != "'.$post_data["job_card_id"].'"');
            } else {
                $job_card_duplication = $this->crud->getFromSQL('SELECT * FROM job_card WHERE RTRIM(LTRIM(REPLACE(`job_card_no`," ","" ))) = "'.strtolower(str_replace(" ", "", $post_data["job_card_no"])).'"');
            }
            if (!empty($job_card_duplication)) {
                $return['error'] = "Exist";
                $return['error_exist'] = 'Job No Already Exist.';
                print json_encode($return);
                exit;
            }
        } else {
            $return['error'] = "Exist";
            $return['error_exist'] = 'Please Enter Job No.';
            print json_encode($return);
            exit;
        }
        if (!empty($post_data['job_card_id'])) {
            $job_card_id = $post_data['job_card_id'];
            $job_card_data = array(
                'job_card_no' => $post_data['job_card_no'],
                'party_id' => $post_data['party_id'],
                'melting' => $post_data['melting'],
                'order_date' => isset($post_data['order_date']) && strtotime($post_data['order_date']) > 0 ? date('Y-m-d',strtotime($post_data['order_date'])) : NULL,
                'delivery_date' => isset($post_data['delivery_date']) && strtotime($post_data['delivery_date']) > 0 ? date('Y-m-d',strtotime($post_data['delivery_date'])) : NULL,
                'remark' => $post_data['remark'],
                'updated_at' => $this->applib->get_current_date_time(),
                'updated_by' => $this->logged_in_id,
            );
            $where_array['job_card_id'] = $job_card_id;
            $this->crud->update('job_card', $job_card_data, $where_array);
            
            $old_ids = array();
            $old_detail = $this->crud->getFromSQL("SELECT job_card_item_id FROM job_card_items WHERE job_card_id= '" . $job_card_id . "' ");
            if (!empty($old_detail)) {
                foreach ($old_detail as $old) {
                    $old_ids[] = $old->job_card_item_id;
                }
            }
            $new_ids = array();
            $job_card_items = json_decode($_POST['job_card_items'],true);
            if (!empty($job_card_items)) {
                foreach ($job_card_items as $job_card_item_row) {
                    //$job_card_item_row['design_ids'] = explode(',',$job_card_item_row['design_ids']);
                    $job_card_item_data = array(
                        'job_card_id' => $job_card_id,
                        'item_id' => $job_card_item_row['item_id'],
                        'design_text' => $job_card_item_row['design_text'],
                        'design_no' => $job_card_item_row['design_no'],
                        'qty' => $job_card_item_row['qty'],
                        'total_qty' => $job_card_item_row['total_qty'],
                        'weight' => $job_card_item_row['weight'],
                        'total_weight' => $job_card_item_row['total_weight'],
                        'remark' => $job_card_item_row['item_remark'],
                        'updated_at' => $this->applib->get_current_date_time(),
                    );
                    if(!empty($job_card_item_row['item_photo'])){
                        $job_card_item_data['item_photo'] = $job_card_item_row['item_photo'];
                    }
                    if (!empty($job_card_item_row['job_card_item_id'])) {
                        $job_card_item_data['updated_at'] = $this->applib->get_current_date_time();
                        $job_card_item_where = array('job_card_item_id' => $job_card_item_row['job_card_item_id']);
                        $this->crud->update('job_card_items',$job_card_item_data,$job_card_item_where);
                        $new_ids[] = $job_card_item_row['job_card_item_id'];
                        
//                        $item_design_ids = $this->crud->getFromSQL("SELECT GROUP_CONCAT(design_id) as design_ids FROM job_card_items_designs WHERE job_card_item_id= '" . $job_card_item_row['job_card_item_id'] . "'");
//                        $item_design_ids_arr =array();
//                        if(!empty($item_design_ids[0]->design_ids)) {
//                            $item_design_ids_arr = explode(',',$item_design_ids[0]->design_ids);
//                        }
//                        if(!empty($job_card_item_row['design_ids'])) {
//                            foreach ($job_card_item_row['design_ids'] as $design_id) {
//                                $item_design_data = array(
//                                    'job_card_item_id' => $job_card_item_row['job_card_item_id'],
//                                    'job_card_id' => $job_card_id,
//                                    'item_id' => $job_card_item_row['item_id'],
//                                    'design_id' => $design_id,
//                                    'created_at' => $this->applib->get_current_date_time(),
//                                );
//
//                                if(!in_array($design_id,$item_design_ids_arr)) {
//                                    $item_design_ids_arr[] = $this->crud->insert('job_card_items_designs',$item_design_data);
//                                }
//                            }
//                            $this->crud->execuetSQL("DELETE FROM job_card_items_designs WHERE job_card_item_id= '" . $job_card_item_row['job_card_item_id'] . "' AND design_id NOT IN('".implode("','",$job_card_item_row['design_ids'])."')");
//                        } else {
//                            $this->crud->execuetSQL("DELETE FROM job_card_items_designs WHERE job_card_item_id= '" . $job_card_item_row['job_card_item_id'] . "'");
//                        }
                    } else {
                        $job_card_item_data['created_at'] = $this->applib->get_current_date_time();
                        $job_card_item_id = $this->crud->insert('job_card_items', $job_card_item_data);

//                        if(!empty($job_card_item_row['design_ids'])) {
//                            foreach ($job_card_item_row['design_ids'] as $design_id) {
//                                $item_design_data = array(
//                                    'job_card_item_id' => $job_card_item_id,
//                                    'job_card_id' => $job_card_id,
//                                    'item_id' => $job_card_item_row['item_id'],
//                                    'design_id' => $design_id,
//                                    'created_at' => $this->applib->get_current_date_time(),
//                                );
//                                $this->crud->insert('job_card_items_designs',$item_design_data);
//                            }
//                        }
                    }
                }
                if (!empty($old_ids) && !empty($new_ids)) {
                    $ids_for_delete = array_diff($old_ids, $new_ids);
                    if (!empty($ids_for_delete)) {
                        foreach ($ids_for_delete as $id_for_delete) {
                            $this->crud->execuetSQL("DELETE FROM job_card_items WHERE job_card_item_id = '" . $id_for_delete . "'");
                        }
                    }
                }
            }
            $return['success'] = "Updated";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Job card updated successfully');
        } else {
            $job_card_data = array(
                'job_card_no' => $post_data['job_card_no'],
                'party_id' => $post_data['party_id'],
                'melting' => $post_data['melting'],
                'order_date' => isset($post_data['order_date']) && !empty($post_data['order_date']) ? date('Y-m-d',strtotime($post_data['order_date'])) : NULL,
                'delivery_date' => isset($post_data['delivery_date']) && !empty($post_data['delivery_date']) ? date('Y-m-d',strtotime($post_data['delivery_date'])) : NULL,
                'remark' => $post_data['remark'],
                'created_at' => $this->applib->get_current_date_time(),
                'created_by' => $this->logged_in_id,
            );
            $job_card_id = $this->crud->insert('job_card', $job_card_data);

            $job_card_items = json_decode($_POST['job_card_items'],true);
            if (!empty($job_card_items)) {
                foreach ($job_card_items as $job_card_item_row) {
                    $job_card_item_data = array(
                        'job_card_id' => $job_card_id,
                        'item_id' => $job_card_item_row['item_id'],
                        'design_text' => $job_card_item_row['design_text'],
                        'design_no' => $job_card_item_row['design_no'],
                        'qty' => $job_card_item_row['qty'],
                        'total_qty' => $job_card_item_row['total_qty'],
                        'weight' => $job_card_item_row['weight'],
                        'total_weight' => $job_card_item_row['total_weight'],
                        'remark' => $job_card_item_row['item_remark'],
                        'created_at' => $this->applib->get_current_date_time(),
                    );
                    if(!empty($job_card_item_row['item_photo'])){
                        $job_card_item_data['item_photo'] = $job_card_item_row['item_photo'];
                    }
                    $job_card_item_id = $this->crud->insert('job_card_items',$job_card_item_data);

//                    if(!empty($job_card_item_row['design_ids'])) {
//                        foreach ($job_card_item_row['design_ids'] as $design_id) {
//                            $item_design_data = array(
//                                'job_card_item_id' => $job_card_item_id,
//                                'job_card_id' => $job_card_id,
//                                'item_id' => $job_card_item_row['item_id'],
//                                'design_id' => $design_id,
//                                'created_at' => $this->applib->get_current_date_time(),
//                            );
//                            $this->crud->insert('job_card_items_designs',$item_design_data);
//                        }
//                    }
                }
            }
            $return['success'] = "Added";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Job card added successfully');
        }
        print json_encode($return);
        exit;
    }

    function get_job_card_no() {
        $query = $this->db->query("SELECT job_card_no FROM job_card ORDER BY job_card_no DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            $last_job_card_id = $query->row()->job_card_no;
            $last_job_card_id++;
            return $last_job_card_id;
        } else {
            return 1;
        }
    }

    function job_card_list() {
        if ($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "view") || $this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "add")) {
            $this->load->view('job_card/job_card_list');
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function job_card_datatable() {
        $post_data = $this->input->post();
        $where = '1=1';

        $config['table'] = 'job_card jc';
        $config['select'] = 'jc.*,p.name as party_name, jci.item_photo';
        $config['joins'][] = array('join_table' => 'party p', 'join_by' => 'p.party_id = jc.party_id');
        $config['joins'][] = array('join_table' => 'job_card_items jci', 'join_by' => 'jci.job_card_id = jc.job_card_id');

        $config['column_order'] = array(null,'jc.job_card_id','p.name','jc.melting','jc.order_date','jc.delivery_date');
        $config['column_search'] = array('jc.job_card_no','p.name','jc.melting','DATE_FORMAT(jc.order_date,"%d-%m-%Y")','DATE_FORMAT(jc.delivery_date,"%d-%m-%Y")');
        $config['order'] = array('jc.job_card_id' => 'desc');

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

        if(!empty($post_data['party_id'])) {
            $where .= ' AND jc.party_id='.$post_data['party_id'];   	
        }

        $config['custom_where'] = $where;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();

        $data = array();

        $isEdit = $this->app_model->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "delete");

        foreach ($list as $job_card_row) {
            $row = array();
            $action = '';
            
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'job_card/add/'. $job_card_row->job_card_id.'" title="Edit Job Card"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
//            if($isDelete) {
//                $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('job_card/delete_job_card/' . $job_card_row->job_card_id) . '"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';                    
//            }

            $action .= "<a href='javascript:void(0);' class='btn btn-primary btn-xs view_job_card_items' data-id='" . $job_card_row->job_card_id . "'>View Items</a>";
            $action .= '&nbsp;<a href="' . base_url('job_card/job_card_print/' . $job_card_row->job_card_id) . '" target="_blank" title="Job Card Print" class="detail_button btn-info btn-xs"><span class="fa fa-print"></span></a>';
            $action .= '&nbsp;<a href="' . base_url('job_card/job_card_all_manufacture_print/' . $job_card_row->job_card_id) . '" target="_blank" title="Job Card All Manufacture Print" class="btn-success btn-xs"><span class="fa fa-print"></span></a>';
            if(isset($job_card_row->item_photo) && !empty($job_card_row->item_photo)){
                $action .= '&nbsp;<a href="javascript:void(0)" class="btn btn-xs btn-primary item_photo_modal" data-img_src="' . base_url() . 'uploads/job_card_item_photo/' . $job_card_row->item_photo .'" ><i class="fa fa-image"></i></a>';
            }
            $action .= "&nbsp;&nbsp;&nbsp;<a href='" . base_url('job_card/job_card_costing/' . $job_card_row->job_card_id) . "' class='text-sm' data-id='" . $job_card_row->job_card_id . "' >View Costing</a>";
            $row[] = $action;
            $row[] = $job_card_row->job_card_no;
            $row[] = $job_card_row->party_name;
            $row[] = number_format($job_card_row->melting, 3, '.', '');
            $row[] = date('d-m-Y',strtotime($job_card_row->order_date));
            $row[] = (strtotime($job_card_row->delivery_date) > 0?date('d-m-Y',strtotime($job_card_row->delivery_date)):'');

            $job_card_labor = $this->crud->job_card_labor($job_card_row->job_card_id);
            $row[] = number_format($job_card_labor, 2, '.', '');

            $row[] = number_format($job_card_row->reference_total, 3, '.', '');
            $row[] = number_format($job_card_row->total_costing_fine, 3, '.', '');
            $row[] = number_format($job_card_row->total_costing_amount, 2, '.', '');
            $row[] = number_format($job_card_row->profit_loss_fine, 3, '.', '');
            $row[] = number_format($job_card_row->profit_loss_amount, 2, '.', '');

            $row[] = $job_card_row->remark;
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

    function job_card_items_datatable() {
        $post_data = $this->input->post();
        $where = '1=1';
        $job_card_id = $post_data['job_card_id'];

        $config['table'] = 'job_card_items jci';
        $config['select'] = 'jci.*,i.item_name';
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = jci.item_id');

        $config['column_search'] = array('i.item_name','jci.qty','jci.weight','jci.remark');
        $config['column_order'] = array(null,'i.item_name',null,'jci.qty','jci.weight','jci.remark');
        $config['order'] = array('jci.job_card_item_id' => 'desc');
        
        $where .= ' AND jci.job_card_id='.$job_card_id;
        $config['custom_where'] = $where;
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
        $data = array();

        foreach ($list as $key => $job_card_row) {
            $row = array();
            $action = '';
            
            $row[] = $key + 1;
            $row[] = $job_card_row->item_name;

//            $design_no_row = $this->crud->getFromSQL("SELECT GROUP_CONCAT(d.design_no) as design_no FROM job_card_items_designs jcid JOIN design_no d ON(d.id=jcid.design_id) WHERE job_card_item_id= '" . $job_card_row->job_card_item_id . "'");
//            $design_no_str = '';
//            if(!empty($design_no_row[0]->design_no)) {
//            	$design_no_row = explode(',',$design_no_row[0]->design_no);
//            	foreach ($design_no_row as $key => $design_no) {
//            		$design_no_str .= ' <small class="badge badge-info">'.$design_no.'</small>';
//            	}
//            }
//            $row[] = $design_no_str;
            $row[] = $job_card_row->design_text . '' . $job_card_row->design_no;
            $row[] = $job_card_row->qty;
            $row[] = $job_card_row->total_qty;
            $row[] = number_format($job_card_row->weight, 3, '.', '');
            $row[] = number_format($job_card_row->total_weight, 3, '.', '');
            $row[] = $job_card_row->remark;
            $item_photo = '-';
            if(!empty($job_card_row->item_photo)){
                $item_photo = '<a href="javascript:void(0)" class="btn btn-xs btn-primary item_photo_modal" data-img_src="' . base_url() . 'uploads/job_card_item_photo/' . $job_card_row->item_photo .'" ><i class="fa fa-image"></i></a>';
            }
            $row[] = $item_photo;
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

    function job_card_print($job_card_id){
        $result = $this->crud->get_data_row_by_id('job_card', 'job_card_id', $job_card_id);
        $party_detail = $this->crud->get_data_row_by_id('party', 'party_id', $result->party_id);

        $data = array(
                'job_card_no' => $result->job_card_no,
                'melting' => $result->melting,
                'order_date' => isset($result->order_date) && !empty($result->order_date) ? date('d/m/Y', strtotime($result->order_date)) : '',
                'delivery_date' => isset($result->delivery_date) && !empty($result->delivery_date) ? date('d/m/Y', strtotime($result->delivery_date)) : '',
                'peck_tar' => $result->peck_tar,
                'latkan' => $result->latkan,
                'remark' => $result->remark,
        );
        if(!empty($party_detail)) {
            $data['name'] = $party_detail->name;
        }

        $lineitem_arr = array();

        $item_details = $this->crud->getFromSQL("SELECT jci.*,i.item_name FROM job_card_items jci JOIN item i ON(i.item_id = jci.item_id) WHERE job_card_id= '" . $job_card_id . "'");

        $item_data = array();
        foreach ($item_details as $key => $job_card_row) {
            $row = array();
            $action = '';
            
            $row[] = $key + 1;
            $row[] = $job_card_row->item_name;

            $design_no_row = $this->crud->getFromSQL("SELECT GROUP_CONCAT(d.design_no) as design_no FROM job_card_items_designs jcid JOIN design_no d ON(d.id=jcid.design_id) WHERE job_card_item_id= '" . $job_card_row->job_card_item_id . "'");
            $design_no_str = '';
            if(!empty($design_no_row[0]->design_no)) {
            	$design_no_row = explode(',',$design_no_row[0]->design_no);
            	foreach ($design_no_row as $key => $design_no) {
                        if(!empty($design_no_str)) {
                            $design_no_str .= ', '.$design_no;
                        } else {
                            $design_no_str .= $design_no;
                        }
            	}
            }
            $row[] = $design_no_str;
            $row[] = $job_card_row->qty;
            $row[] = $job_card_row->total_qty;
            $row[] = number_format($job_card_row->weight, 3, '.', '');
            $row[] = number_format($job_card_row->total_weight, 3, '.', '');
            $row[] = $job_card_row->remark;
            $item_data[] = $row;
        }
        
        $data['card_items'] = $item_data;
        $data['item_details'] = $item_data;

        
        //print_r($html);die;

        $casting_table_html = '';
        $process_res = $this->crud->getFromSQL("SELECT process_name,id as process_id,print_columns FROM `process_master` WHERE id = ".CASTING_PROCESS_ID." ORDER BY sequence");
        if(!empty($process_res)) {
            foreach ($process_res as $key => $process_row) {
                $selected_columns = array();
                if(!empty($process_row->print_columns)) {
                    $selected_columns = explode(',', $process_row->print_columns);
                }
                $this->db->select('mir.*,i.item_name,jw.job_worker,process_id');
                $this->db->from('manufacture m');
                $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id','left');
                $this->db->join('item i','i.item_id = mir.item_id','left');
                $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
                $this->db->where('m.job_card_id',$job_card_id);
                $this->db->where('process_id',$process_row->process_id);
                $this->db->order_by('mir.manufacture_ir_id','desc');
                $query = $this->db->get();
                if($query->num_rows() > 0) {
                    $manu_res = $query->result();
                    $manu_issue_data = array();
                    $manu_receive_data = array();
                    foreach ($manu_res as $manu_row){
                        if($manu_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manu_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                            $manu_issue_data[] = $manu_row;
                        } else {
                            $manu_receive_data[] = $manu_row;
                        }
                    }
                    $tmp_data  = array();
                    $tmp_data['selected_columns'] = $selected_columns;
                    $tmp_data['melting'] = $result->melting;
                    $tmp_data['process_name'] = $process_row->process_name;
                    $tmp_data['manu_issue_data'] = $manu_issue_data;
                    $tmp_data['manu_receive_data'] = $manu_receive_data;
                    if(count($manu_issue_data) > count($manu_receive_data)){
                        $tmp_data['manu_max_count'] = count($manu_issue_data);
                    } else {
                        $tmp_data['manu_max_count'] = count($manu_receive_data);
                    }
                    $casting_table_html .= $this->load->view('job_card/job_card_process_table', $tmp_data, true);
                }
            }
        }
        //echo $casting_table_html;die();
        $data['casting_table_html'] = $casting_table_html;
        $html = $this->load->view('job_card/job_card_print', $data, true);
        
        /*echo $html;
        die();*/
        /*----------- Except Casting Processes -----------*/
        /*$print_columns = $this->app_model->get_process_print_columns();
        print_r($print_columns);die()*/
        $except_casting_html = '';
        $process_res = $this->crud->getFromSQL("SELECT process_name,id as process_id,print_columns FROM `process_master` WHERE id != ".CASTING_PROCESS_ID." ORDER BY sequence");
        if(!empty($process_res)) {
            foreach ($process_res as $key => $process_row) {
                $selected_columns = array();
                if(!empty($process_row->print_columns)) {
                    $selected_columns = explode(',', $process_row->print_columns);
                }
                $this->db->select('mir.*,i.item_name,jw.job_worker,process_id');
                $this->db->from('manufacture m');
                $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id','left');
                $this->db->join('item i','i.item_id = mir.item_id','left');
                $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
                $this->db->where('m.job_card_id',$job_card_id);
                $this->db->where('process_id',$process_row->process_id);
                $this->db->order_by('mir.manufacture_ir_id','desc');
                $query = $this->db->get();
                if($query->num_rows() > 0) {
                    $manu_res = $query->result();
                    $manu_issue_data = array();
                    $manu_receive_data = array();
                    foreach ($manu_res as $manu_row){
                        if($manu_row->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manu_row->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                            $manu_issue_data[] = $manu_row;
                        } else {
                            $manu_receive_data[] = $manu_row;
                        }
                    }
                    $tmp_data  = array();
                    $tmp_data['selected_columns'] = $selected_columns;
                    $tmp_data['process_name'] = $process_row->process_name;
                    $tmp_data['manu_issue_data'] = $manu_issue_data;
                    $tmp_data['manu_receive_data'] = $manu_receive_data;
                    if(count($manu_issue_data) > count($manu_receive_data)){
                        $tmp_data['manu_max_count'] = count($manu_issue_data);
                    } else {
                        $tmp_data['manu_max_count'] = count($manu_receive_data);
                    }
                    $except_casting_html .= $this->load->view('job_card/job_card_process_table', $tmp_data, true);
                }
            }
        }
        /*-----------/Except Casting Processes -----------*/
        /*echo $html;
        echo $except_casting_html;die();*/
        $pdfFilePath = "job_card_print.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->falseBoldWeight = 8;

        $this->m_pdf->pdf->AddPage('','', '', '', '',
                                  2, // margin_left
                                  2, // margin right
                                  2, // margin top
                                  2, // margin bottom
                                  2, // margin header
                                  2); // margin footer
        $this->m_pdf->pdf->WriteHTML($html);
        
        if(!empty($except_casting_html)) {
            $this->m_pdf->pdf->AddPage('L','', '', '', '',
                                  2, // margin_left
                                  2, // margin right
                                  2, // margin top
                                  2, // margin bottom
                                  2, // margin header
                                  2); // margin footer
            $this->m_pdf->pdf->WriteHTML($except_casting_html);
        }
        /*echo "<pre>";
        print_r($this->m_pdf->pdf);
        exit();*/
        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    }

    function job_card_all_manufacture_print($job_card_id){
        $html_data = array();
        if(!empty($job_card_id)) {
            $manufactures = $this->crud->get_row_by_id('manufacture', array('job_card_id' => $job_card_id));
            if(!empty($manufactures)){
                $this->load->view('job_card/job_card_all_manufacture_print', array('manufactures' => $manufactures));
            }
        }
//        print_r($html_data); exit;
//        foreach ($html_data as $html_row){
//            echo $html_row;
//        }
//        exit;
//        require_once('application/third_party/random_compat/lib/random.php');
//        require_once('application/vendor/autoload.php');
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0]);
//        $mpdf->SetTitle('Job Card All Manufacture Print');
////        $mpdf->defHTMLHeaderByName('myHeader2','<div style="text-align: center; font-weight: bold;">Job Card All Manufacture Print</div>');
//        $mpdf->WriteHTML($html);
//        $mpdf->Output('job_card_all_manufacture_print.pdf', 'I'); 
    }

    function job_card_costing($job_card_id, $from = '', $success_msg = '') {
        if ($this->applib->have_access_role(JOB_CARD_ENTRY_MODULE_ID, "view") && !empty($job_card_id)) {
            $data = array();
            $data['job_card_data'] = $this->crud->get_data_row_by_id('job_card', 'job_card_id', $job_card_id);
            $data['job_card_item_data'] = $this->crud->get_data_row_by_id('job_card_items', 'job_card_id', $job_card_id);
            $data['job_card_item_name'] = $this->crud->get_column_value_by_id('item', 'item_name', array('item_id' => $data['job_card_item_data']->item_id));
            $data['karigar_rfw_gross_total'] = 0;
            $data['karigar_receive_fine'] = 0;
            $data['karigar_wastage'] = 0;
            $data['meena_other_charges'] = array();
            $data['meena_other_charges_total'] = 0;
            $data['chol_item_arr'] = array();
            $data['chol_item_gross'] = 0;
            $data['chol_item_fine'] = 0;
            $data['jadtar_kundan_gross'] = 0;
            $data['jadtar_kundan'] = 0;
            $data['jadtar_stone_charges'] = 0;
            $data['jadtar_other_charges'] = 0;
            $data['used_vetran'] = 0;
            $data['vetran_fine'] = 0;
            $data['used_moti'] = 0;
            $data['bandhnu_other_charges'] = 0;
            $data['bandhnu_moti'] = 0;
            $data['bandhnu_moti_amount'] = 0;
            $data['polish_allowed_loss_costing'] = 0;
            $data['patch_weight'] = 0;
            $data['patch_fine'] = 0;
            $data['real_less'] = 0;
            $data['given_less'] = 0;
            $data['bandhanu_manufacture_ids'] = array();
            $data['jadtar_manufacture_ids'] = array();
            $kaarigar_process_receive_finish_1st_line_item_touch = 0;
            $manufacture_details = $this->crud->get_row_by_id('manufacture', array('job_card_id' => $job_card_id, 'close_to_calculate_loss' => '2'));
            if(!empty($manufacture_details)){
                foreach ($manufacture_details as $manufacture_detail){

                    // KAARIGAR PROCESS
                    if($manufacture_detail->process_id == KAARIGAR_PROCESS_ID){
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_RECEIVE_FINISH_ID));
                        if(!empty($manufacture_ir_details)){
                            foreach ($manufacture_ir_details as $key => $manufacture_ir_detail){
                                $data['karigar_rfw_gross_total'] = $data['karigar_rfw_gross_total'] + $manufacture_ir_detail->gross;
                                $fine = $manufacture_ir_detail->gross * $manufacture_ir_detail->touch / 100;
                                $data['karigar_receive_fine'] = $data['karigar_receive_fine'] + $fine;
                                $wastage = $manufacture_ir_detail->gross * $manufacture_ir_detail->wastage / 100;
                                $data['karigar_wastage'] = $data['karigar_wastage'] + $wastage;

                                if($key == 0){
                                    $kaarigar_process_receive_finish_1st_line_item_touch = $manufacture_ir_detail->touch;
                                }
                            }
                        }
                    }

                    // JADTAR PROCESS
                    if($manufacture_detail->process_id == JADTAR_PROCESS_ID){
                        $data['jadtar_manufacture_ids'][] = $manufacture_detail->manufacture_id;
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_RECEIVE_FINISH_ID));
                        if(!empty($manufacture_ir_details)){
                            $jadtar_process_receive_finish_1st_line_item_touch = 0;
                            foreach ($manufacture_ir_details as $key => $manufacture_ir_detail){
                                $data['jadtar_kundan'] = $data['jadtar_kundan'] + $manufacture_ir_detail->kundan;
                                $data['jadtar_stone_charges'] = $data['jadtar_stone_charges'] + $manufacture_ir_detail->stone_charges;
                                $data['jadtar_other_charges'] = $data['jadtar_other_charges'] + $manufacture_ir_detail->other_charges;

                                if($key == 0){
                                    $jadtar_process_receive_finish_1st_line_item_touch = $manufacture_ir_detail->touch;
                                }
                            }
//                            $data['jadtar_kundan_gross'] = $data['jadtar_kundan'] / $jadtar_process_receive_finish_1st_line_item_touch * 100;
                            $data['jadtar_kundan_gross'] = $data['jadtar_kundan'];
                        }
                    }

                    // BANDHANU PROCESS
                    if($manufacture_detail->process_id == BANDHANU_PROCESS_ID){
                        $data['bandhanu_manufacture_ids'][] = $manufacture_detail->manufacture_id;
                        $vetran_touch = 1;
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_ISSUE_FINISH_ID, 'item_id' => ITEM_VETRAN_ID));
                        if(!empty($manufacture_ir_details)){
                            $manufacture_ir_detail = $manufacture_ir_details[0];
                            $vetran_touch = $manufacture_ir_detail->touch;
                        } else {
                            $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_ISSUE_SCRAP_ID, 'item_id' => ITEM_VETRAN_ID));
                            if(!empty($manufacture_ir_details)){
                                $manufacture_ir_detail = $manufacture_ir_details[0];
                                $vetran_touch = $manufacture_ir_detail->touch;
                            }
                        }
                        $data['used_vetran'] = $data['used_vetran'] + $manufacture_detail->used_vetran;
                        $vetran_fine = $manufacture_detail->used_vetran * $vetran_touch / 100;
                        $data['vetran_fine'] = $data['vetran_fine'] + $vetran_fine;
                        $data['used_moti'] = $data['used_moti'] + $manufacture_detail->used_moti;
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id));
                        if(!empty($manufacture_ir_details)){
                            foreach ($manufacture_ir_details as $manufacture_ir_detail){
                                $data['bandhnu_other_charges'] = $data['bandhnu_other_charges'] + $manufacture_ir_detail->other_charges;
                                if($manufacture_ir_detail->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manufacture_ir_detail->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                                    $data['bandhnu_moti'] = $data['bandhnu_moti'] + $manufacture_ir_detail->moti;
                                    $data['bandhnu_moti_amount'] = $data['bandhnu_moti_amount'] + $manufacture_ir_detail->moti_amount;
                                } else if($manufacture_ir_detail->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID || $manufacture_ir_detail->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                                    $data['bandhnu_moti'] = $data['bandhnu_moti'] - $manufacture_ir_detail->moti;
                                    $data['bandhnu_moti_amount'] = $data['bandhnu_moti_amount'] - $manufacture_ir_detail->moti_amount;
                                }
                            }
                        }
                    }

                    // POLISH PROCESS
                    if($manufacture_detail->process_id == POLISH_PROCESS_ID){
                        $total_issue_finish_gross = 0;
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_ISSUE_FINISH_ID));
                        if(!empty($manufacture_ir_details)){
                            foreach ($manufacture_ir_details as $manufacture_ir_detail){
                                $total_issue_finish_gross = $total_issue_finish_gross + $manufacture_ir_detail->gross;
                            }
                        }

                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id, 'type_id' => MANUFACTURE_TYPE_RECEIVE_FINISH_ID));
                        if(!empty($manufacture_ir_details)){
                            $manufacture_ir_detail = $manufacture_ir_details[0];
                            $loss_allowed = $this->crud->get_column_value_by_id('job_worker', 'wastage_loss_allowed', array('id' => $manufacture_ir_detail->job_worker_id));
                            $allowed = $total_issue_finish_gross * $loss_allowed / 100;
                            $data['polish_allowed_loss_costing'] = $allowed * $manufacture_ir_detail->touch / 100;
                        }
                    }

                    // SETTINGS PROCESS
                    if($manufacture_detail->process_id == SETTINGS_PROCESS_ID){
                        $manufacture_ir_details = $this->crud->get_row_by_id('manufacture_issue_receive', array('manufacture_id' => $manufacture_detail->manufacture_id));
                        if(!empty($manufacture_ir_details)){
                            foreach ($manufacture_ir_details as $manufacture_ir_detail){
                                if($manufacture_ir_detail->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID || $manufacture_ir_detail->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                                    $data['real_less'] = $data['real_less'] + $manufacture_ir_detail->ad_weight;
                                } else {
                                    $data['real_less'] = $data['real_less'] - $manufacture_ir_detail->ad_weight;
                                }
                            }
                        }

                        // Get Chol item data
                        $this->db->select('"Settings Chol" AS particular, 0 - SUM(gross) AS gross_total, 0 - SUM(fine) AS fine_total');
                        $this->db->from('manufacture_issue_receive');
                        $this->db->where('manufacture_id', $manufacture_detail->manufacture_id);
                        $this->db->where('item_id', ITEM_CHOL_ID);
                        $this->db->where_in('type_id', array(MANUFACTURE_TYPE_RECEIVE_FINISH_ID, MANUFACTURE_TYPE_RECEIVE_SCRAP_ID));
                        $query = $this->db->get();
                        $chol_item_data = $query->result();
//                        print_r($chol_item_data); exit;
                        if(isset($chol_item_data) && !empty($chol_item_data)){
                            foreach($chol_item_data as $chol_item_row){
                                $data['chol_item_gross'] = $data['chol_item_gross'] + $chol_item_row->gross_total;
                                $data['chol_item_fine'] = $data['chol_item_fine'] + $chol_item_row->fine_total;
                                $data['chol_item_arr'][] = $chol_item_row;
                            }
                        } // End ********* Get Chol item data
                    }

                    // MEENA PROCESS
                    if($manufacture_detail->process_id == MEENA_PROCESS_ID){
                        $this->db->select('mir_oc.charges_amount, c.charges_name');
                        $this->db->from('manufacture_ir_other_charges_details mir_oc');
                        $this->db->join('charges c','c.charges_id = mir_oc.charges_id');
                        $this->db->where('mir_oc.manufacture_id', $manufacture_detail->manufacture_id);
                        $query = $this->db->get();
                        $meena_other_charges = $query->result();
                        if(isset($meena_other_charges) && !empty($meena_other_charges)){
                            foreach($meena_other_charges as $meena_other_charge){
                                $data['meena_other_charges_total'] = $data['meena_other_charges_total'] + $meena_other_charge->charges_amount;
                                $data['meena_other_charges'][] = $meena_other_charge;
                            }
                        }
//                        print_r($data['meena_other_charges']); exit;

                        // Get Chol item data
                        $this->db->select('"Meena Chol" AS particular, 0 - SUM(gross) AS gross_total, 0 - SUM(fine) AS fine_total');
                        $this->db->from('manufacture_issue_receive');
                        $this->db->where('manufacture_id', $manufacture_detail->manufacture_id);
                        $this->db->where('item_id', ITEM_CHOL_ID);
                        $this->db->where_in('type_id', array(MANUFACTURE_TYPE_RECEIVE_FINISH_ID, MANUFACTURE_TYPE_RECEIVE_SCRAP_ID));
                        $query = $this->db->get();
                        $chol_item_data = $query->result();
//                        print_r($chol_item_data); exit;
                        if(isset($chol_item_data) && !empty($chol_item_data)){
                            foreach($chol_item_data as $chol_item_row){
                                $data['chol_item_gross'] = $data['chol_item_gross'] + $chol_item_row->gross_total;
                                $data['chol_item_fine'] = $data['chol_item_fine'] + $chol_item_row->fine_total;
                                $data['chol_item_arr'][] = $chol_item_row;
                            }
                        } // End ********* Get Chol item data
                    }

                }
            }

            $tags_details = $this->crud->get_row_by_id('tags', array('job_card_id' => $job_card_id));
            if(!empty($tags_details)){
                $tags_detail = $tags_details[0];
                $patch_tunch = $kaarigar_process_receive_finish_1st_line_item_touch + $tags_detail->patch_wastage;
                if(empty($patch_tunch)){ $patch_tunch = 1; }
                $data['patch_weight'] = $tags_detail->patch;
                $data['patch_fine'] = $tags_detail->patch * $patch_tunch / 100;
                $data['given_less'] = $tags_detail->stone_wt;
            }

            $data['karigar_rfw_gross_total'] = number_format($data['karigar_rfw_gross_total'], 3, '.', '');
            $data['karigar_receive_fine'] = number_format($data['karigar_receive_fine'], 3, '.', '');
            $data['karigar_wastage'] = number_format($data['karigar_wastage'], 3, '.', '');
            $data['jadtar_kundan_gross'] = number_format($data['jadtar_kundan_gross'], 3, '.', '');
            $data['jadtar_kundan'] = number_format($data['jadtar_kundan'], 3, '.', '');
            $data['jadtar_stone_charges'] = number_format($data['jadtar_stone_charges'], 2, '.', '');
            $data['jadtar_other_charges'] = number_format($data['jadtar_other_charges'], 2, '.', '');
            $data['used_vetran'] = number_format($data['used_vetran'], 3, '.', '');
            $data['vetran_fine'] = number_format($data['vetran_fine'], 3, '.', '');
            $data['bandhnu_other_charges'] = number_format($data['bandhnu_other_charges'], 2, '.', '');
            $data['bandhnu_moti_amount'] = $data['used_moti'] * $data['bandhnu_moti_amount'] / $data['bandhnu_moti'];
            $data['bandhnu_moti_amount'] = empty($data['bandhnu_moti_amount']) ? $data['bandhnu_moti_amount'] : 0;
            $data['bandhnu_moti_amount'] = number_format($data['bandhnu_moti_amount'], 2, '.', '');
            $data['polish_allowed_loss_costing'] = number_format($data['polish_allowed_loss_costing'], 3, '.', '');
            $data['patch_weight'] = number_format($data['patch_weight'], 3, '.', '');
            $data['patch_fine'] = number_format($data['patch_fine'], 3, '.', '');
            $data['real_less'] = number_format($data['real_less'], 3, '.', '');
            $data['given_less'] = number_format($data['given_less'], 3, '.', '');
            $data['real_minus_given_less'] = $data['real_less'] - $data['given_less'];
            $data['real_minus_given_less'] = number_format($data['real_minus_given_less'], 3, '.', '');

            $data['reference_total'] = $data['karigar_rfw_gross_total'] + $data['chol_item_gross'] + $data['jadtar_kundan_gross'] + $data['used_vetran'] + $data['patch_weight'];
            $data['reference_total'] = number_format($data['reference_total'], 3, '.', '');
            $data['total_costing_fine'] = $data['karigar_receive_fine'] + $data['karigar_wastage'] + $data['chol_item_fine'] + $data['jadtar_kundan'] + $data['vetran_fine'] + $data['polish_allowed_loss_costing'] + $data['patch_fine'] + $data['real_minus_given_less'];
            $data['total_costing_fine'] = number_format($data['total_costing_fine'], 3, '.', '');
            $data['total_costing_amount'] = $data['meena_other_charges_total'] + $data['jadtar_stone_charges'] + $data['jadtar_other_charges'] + $data['bandhnu_other_charges'] + $data['bandhnu_moti_amount'];
            $data['total_costing_amount'] = number_format($data['total_costing_amount'], 2, '.', '');

            $data['profit_loss_fine'] = 0;
            $data['profit_loss_amount'] = 0;
            $sells_details = $this->crud->get_row_by_id('sells', array('job_card_id' => $job_card_id));
            if(!empty($sells_details)){
                $sells_detail = $sells_details[0];
                $data['profit_loss_fine'] = $sells_detail->fine - $data['total_costing_fine'];
                $data['profit_loss_amount'] = $sells_detail->other_charges - $data['total_costing_amount'];
            }
            $data['profit_loss_fine'] = number_format($data['profit_loss_fine'], 3, '.', '');
            $data['profit_loss_amount'] = number_format($data['profit_loss_amount'], 2, '.', '');

            if($from == 'after_sell'){
                $update_job_card_data = array();
                $update_job_card_data['reference_total'] = $data['reference_total'];
                $update_job_card_data['total_costing_fine'] = $data['total_costing_fine'];
                $update_job_card_data['total_costing_amount'] = $data['total_costing_amount'];
                $update_job_card_data['profit_loss_fine'] = $data['profit_loss_fine'];
                $update_job_card_data['profit_loss_amount'] = $data['profit_loss_amount'];
                $this->crud->update('job_card', $update_job_card_data, array('job_card_id' => $job_card_id));
//                echo $this->db->last_query(); exit;
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'Sell ' . $success_msg . ' Successfully');
                return 1;
            } else {
                $this->load->view('job_card/job_card_costing', $data);
            }
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }
    
    function delete_job_card($id) {
        $return = array();
        $result = $this->crud->delete('job_card', array('job_card_id' => $id));
        if(isset($result['error'])){
            $return['error'] = "Error";
        } else {
            $this->crud->delete('job_card_items', array('job_card_id' => $id));
            $this->crud->delete('job_card_items_designs', array('job_card_id' => $id));
            $return['success'] = "Deleted";
        }
        echo json_encode($return);
    }

    function get_temp_path_image() {
        $data = '';
//        echo "<pre>"; print_r($_FILES); exit;
        if (isset($_FILES['file_upload']['name']) && !empty($_FILES['file_upload']['name'])) {
            $file_element_name = 'file_upload';
            $config['upload_path'] = './uploads/job_card_item_photo/';
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
