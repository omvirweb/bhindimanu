<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

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
	
    function add($tag_id = '') {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "edit") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $data = array();
            if(!empty($tag_id)) {
                $data['tag_row'] = $this->crud->get_data_row_by_id('tags', 'tag_id', $tag_id);
                $lineitem_objectdata = array();
                // IR Other Charges Details
                $other_charges_details_data = array();
                $other_charges_details = $this->crud->get_row_by_id('tags_other_charges_details', array('tag_id' => $tag_id));
                if(!empty($other_charges_details)){
                    foreach ($other_charges_details as $other_charges_detail){
                        $other_charges_details_lineitem = new \stdClass();
                        $other_charges_details_lineitem->other_charges_details_id = $other_charges_detail->other_charges_details_id;
                        $other_charges_details_lineitem->charges_id = $other_charges_detail->charges_id;
                        $other_charges_details_lineitem->charges_name = $this->crud->get_column_value_by_id('charges', 'charges_name', array('charges_id' => $other_charges_detail->charges_id));
                        $other_charges_details_lineitem->charges_weight = (!empty($other_charges_detail->charges_weight)) ? $other_charges_detail->charges_weight : 0;
                        $other_charges_details_lineitem->charges_rate = (!empty($other_charges_detail->charges_rate)) ? $other_charges_detail->charges_rate : 0;
                        $other_charges_details_lineitem->charges_amount = (!empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                        $other_charges_details_data[] = $other_charges_details_lineitem;
                    }
                }
                $data['tag_row']->other_charges_details = json_encode($other_charges_details_data,true);
//                print_r($data); exit;
            }
            $this->load->view('tag/add', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function save_tag(){
        $post_data = $this->input->post();
        $tag_id = 0;
//        echo "<pre>"; print_r($post_data); exit;
        $tag_data = array();
        $tag_data['job_card_id'] = $post_data['job_card_id'];
        $tag_data['item_id'] = $post_data['item_id'];
        $tag_data['tag_date'] = isset($post_data['tag_date']) && strtotime($post_data['tag_date']) > 0 ? date('Y-m-d', strtotime($post_data['tag_date'])) : NULL;
        $tag_data['remark'] = (isset($post_data['remark']) && !empty($post_data['remark'])) ? $post_data['remark'] : NULL;
        $tag_data['gross'] = (isset($post_data['gross']) && !empty($post_data['gross'])) ? $post_data['gross'] : 0;
        $tag_data['item_weight'] = (isset($post_data['item_weight']) && !empty($post_data['item_weight'])) ? $post_data['item_weight'] : 0;
        $tag_data['less'] = (isset($post_data['less']) && !empty($post_data['less'])) ? $post_data['less'] : 0;
        $tag_data['stone_wt'] = (isset($post_data['stone_wt']) && !empty($post_data['stone_wt'])) ? $post_data['stone_wt'] : 0;
        $tag_data['moti'] = (isset($post_data['moti']) && !empty($post_data['moti'])) ? $post_data['moti'] : 0;
        $tag_data['net'] = (isset($post_data['net']) && !empty($post_data['net'])) ? $post_data['net'] : 0;
        $tag_data['other_charges'] = (isset($post_data['other_charges']) && !empty($post_data['other_charges'])) ? $post_data['other_charges'] : 0;
        if(isset($post_data['image']) && !empty($post_data['image'])){
            $tag_data['image'] = $post_data['image'];
        }
        $tag_data['patch'] = (isset($post_data['patch']) && !empty($post_data['patch'])) ? $post_data['patch'] : 0;
        $tag_data['patch_wastage'] = (isset($post_data['patch_wastage']) && !empty($post_data['patch_wastage'])) ? $post_data['patch_wastage'] : 0;
        $tag_data['updated_at'] = $this->applib->get_current_date_time();
        $tag_data['updated_by'] = $this->logged_in_id;
                    
        if (!empty($post_data['tag_id'])) {
            $tag_id = $post_data['tag_id'];
            $where_array['tag_id'] = $tag_id;
            $this->crud->update('tags', $tag_data, $where_array);
            
            // Delete IR Other Charges details
            $this->crud->delete('tags_other_charges_details', array('tag_id' => $tag_id));
            // Insert Tags Other Charges details
            if(isset($post_data['other_charges_details']) && !empty($post_data['other_charges_details'])){
                $other_charges_details = json_decode($post_data['other_charges_details']);
                foreach ($other_charges_details as $other_charges_detail){
                    $insert_other_charges_detail = array();
                    $insert_other_charges_detail['tag_id'] = $tag_id;
                    $insert_other_charges_detail['charges_id'] = (isset($other_charges_detail->charges_id) && !empty($other_charges_detail->charges_id)) ? $other_charges_detail->charges_id : NULL;
                    $insert_other_charges_detail['charges_weight'] = (isset($other_charges_detail->charges_weight) && !empty($other_charges_detail->charges_weight)) ? $other_charges_detail->charges_weight : 0;
                    $insert_other_charges_detail['charges_rate'] = (isset($other_charges_detail->charges_rate) && !empty($other_charges_detail->charges_rate)) ? $other_charges_detail->charges_rate : 0;
                    $insert_other_charges_detail['charges_amount'] = (isset($other_charges_detail->charges_amount) && !empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                    $insert_other_charges_detail['created_by'] = $this->logged_in_id;
                    $insert_other_charges_detail['created_at'] = $this->now_time;
                    $insert_other_charges_detail['updated_by'] = $this->logged_in_id;
                    $insert_other_charges_detail['updated_at'] = $this->now_time;
                    $result = $this->crud->insert('tags_other_charges_details', $insert_other_charges_detail);
                }
            }

            $return['success'] = "Updated";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Tag Updated Successfully');
        } else {
            $tag_data['created_at'] = $this->applib->get_current_date_time();
            $tag_data['created_by'] = $this->logged_in_id;
            $tag_id = $this->crud->insert('tags', $tag_data);
            
            // Insert Tags Other Charges details
            if(isset($post_data['other_charges_details']) && !empty($post_data['other_charges_details'])){
                $other_charges_details = json_decode($post_data['other_charges_details']);
                foreach ($other_charges_details as $other_charges_detail){
                    $insert_other_charges_detail = array();
                    $insert_other_charges_detail['tag_id'] = $tag_id;
                    $insert_other_charges_detail['charges_id'] = (isset($other_charges_detail->charges_id) && !empty($other_charges_detail->charges_id)) ? $other_charges_detail->charges_id : NULL;
                    $insert_other_charges_detail['charges_weight'] = (isset($other_charges_detail->charges_weight) && !empty($other_charges_detail->charges_weight)) ? $other_charges_detail->charges_weight : 0;
                    $insert_other_charges_detail['charges_rate'] = (isset($other_charges_detail->charges_rate) && !empty($other_charges_detail->charges_rate)) ? $other_charges_detail->charges_rate : 0;
                    $insert_other_charges_detail['charges_amount'] = (isset($other_charges_detail->charges_amount) && !empty($other_charges_detail->charges_amount)) ? $other_charges_detail->charges_amount : 0;
                    $insert_other_charges_detail['created_by'] = $this->logged_in_id;
                    $insert_other_charges_detail['created_at'] = $this->now_time;
                    $insert_other_charges_detail['updated_by'] = $this->logged_in_id;
                    $insert_other_charges_detail['updated_at'] = $this->now_time;
                    $result = $this->crud->insert('tags_other_charges_details', $insert_other_charges_detail);
                }
            }
            $return['success'] = "Added";
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', 'Tag Added Successfully');
        }
        print json_encode($return);
        exit;
    }

    function tag_list() {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "view") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $date = array();
            $date['from_date'] = date("01-m-Y");
            $date['to_date'] = date("d-m-Y");
            $this->load->view('tag/tag_list',$date);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }

    function tag_datatable() {
        $post_data = $this->input->post();
        
        $config['table'] = 'tags t';
        $config['select'] = 't.*, jc.job_card_no, i.item_name, p.name as party_name';
        $config['joins'][] = array('join_table' => 'job_card jc', 'join_by' => 'jc.job_card_id = t.job_card_id');
        $config['joins'][] = array('join_table' => 'item i', 'join_by' => 'i.item_id = t.item_id');
        $config['joins'][] = array('join_table' => 'party p', 'join_by' => 'p.party_id = jc.party_id');
        $config['column_order'] = array('t.tag_id','jc.job_card_no','p.name');
        $config['order'] = array('t.tag_id' => 'desc');
        if (!empty($post_data['job_card_no'])) {
            $config['wheres'][] = array('column_name' => 'jc.job_card_no', 'column_value' => $post_data['job_card_no']);
        }
        if (!empty($post_data['party_id'])) {
            $config['wheres'][] = array('column_name' => 'jc.party_id', 'column_value' => $post_data['party_id']);
        }
        if (!empty($post_data['touch'])) {
            $config['wheres'][] = array('column_name' => 'jc.melting', 'column_value' => $post_data['touch']);
        }
        if($post_data['view_only_not_sell_tags'] == 'true'){
            $config['joins'][] = array('join_table' => 'sells s', 'join_by' => 't.tag_id = s.tag_id', 'join_type' => 'left');
            $config['custom_where'] = ' s.tag_id is NULL ';
        }
        $this->load->library('datatables', $config, 'datatable');
        $list = $this->datatable->get_datatables();
//        echo $this->db->last_query();
        $data = array();

        $isEdit = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "edit");
        $isDelete = $this->app_model->have_access_role(MANUFACTURE_MODULE_ID, "delete");

        foreach ($list as $tag) {
            $row = array();

            $action = '';
            if($isEdit) {
                $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'tag/add/'. $tag->tag_id.'" title="Edit Tag"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
            }
            if($isDelete) {
                    $action .= '<a href="javascript:void(0);" class="delete_button btn-danger btn-xs" data-href="' . base_url('tag/delete_tag/' . $tag->tag_id) . '"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';                    
            }
            $action .= '<a class="edit_button btn-primary btn-xs" href="' . base_url() . 'tag/tag_print/'. $tag->tag_id.'" target="blank" title="Print Tag"><i class="fa fa-print"></i></a>&nbsp;&nbsp;';
            $row[] = $action;
            $row[] = $tag->job_card_no;
            $row[] = $tag->party_name;
            $row[] = (strtotime($tag->tag_date) > 0?date('d-m-Y',strtotime($tag->tag_date)):'');
            $row[] = $tag->item_name;
            $row[] = number_format($tag->gross, 3, '.', '');
            $row[] = number_format($tag->item_weight, 3, '.', '');
            $row[] = number_format($tag->less, 3, '.', '');
            $row[] = number_format($tag->stone_wt, 3, '.', '');
            $row[] = number_format($tag->moti, 3, '.', '');
            $row[] = number_format($tag->net, 3, '.', '');
            $row[] = number_format($tag->patch, 3, '.', '');
            $row[] = number_format($tag->patch_wastage, 3, '.', '');
            $row[] = number_format($tag->other_charges, 2, '.', '');
            $image = '-';
            if(!empty($tag->image)){
                $image = '<a href="javascript:void(0)" class="btn btn-xs btn-primary item_photo_modal" data-img_src="' . base_url() . 'uploads/tag_item_photo/' . $tag->image .'" ><i class="fa fa-image"></i></a>';
            }
            $row[] = $image;
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

    
  
    function delete_tag($tag_id) {
        $res = array();
        $this->crud->delete('tags', array('tag_id' => $tag_id));
        $this->crud->delete('tags_other_charges_details', array('tag_id' => $tag_id));
        $res['status'] = "success";
        echo json_encode($res);
    }

    function get_temp_path_image() {
        $data = '';
//        echo "<pre>"; print_r($_FILES); exit;
        if (isset($_FILES['file_upload']['name']) && !empty($_FILES['file_upload']['name'])) {
            $file_element_name = 'file_upload';
            $config['upload_path'] = './uploads/tag_item_photo/';
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
    
    function tag_print($tag_id = '') {
        if ($this->applib->have_access_role(MANUFACTURE_MODULE_ID, "edit") || $this->applib->have_access_role(MANUFACTURE_MODULE_ID, "add")) {
            $data = array();
            if(!empty($tag_id)) {
                $data['tag_row'] = $this->crud->get_data_row_by_id('tags', 'tag_id', $tag_id);
//                echo "<pre>"; print_r($data); exit;
                $html = $this->load->view('tag/tag_print', $data, true);
                require_once('application/third_party/random_compat/lib/random.php');
                require_once('application/vendor/autoload.php');
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [35, 20],'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0]);
                $mpdf->SetTitle('Tag Print');
                $mpdf->WriteHTML($html);
                $mpdf->Output('tag_print.pdf', 'I'); 
            }
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }
    }
    
}
