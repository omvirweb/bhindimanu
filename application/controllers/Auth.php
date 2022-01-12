<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Crud $crud
 * @property AppModel $app_model
 */
class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Appmodel", "app_model");
        $this->load->model('Crud', 'crud');
        $this->logged_in_id = isset($this->session->userdata('bansijew_is_logged_in')['user_id']);
        //$this->load->library(array('session', 'form_validation', 'email'));
        $this->load->library('email');
    }

    function index()
    {
        if ($this->session->userdata('bansijew_is_logged_in')) {
            $data = array();
            $data['process_master_res'] = $this->crud->get_all_records('process_master','sequence','asc');
            $this->load->view('dashboard',$data);
        } else {
            redirect('/auth/login/');
        }
    }

    /**
     * Login user on the site
     *
     * @return void
     */
    function login()
    {
        if ($this->session->userdata('bansijew_is_logged_in')) {// logged in
            redirect('');
        } else {
            $this->form_validation->set_rules('user_name', 'username', 'trim|required');
            $this->form_validation->set_rules('user_pass', 'password', 'trim|required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            $data['errors'] = array();
            if ($this->form_validation->run()) {
                $user_name = $_POST['user_name'];
                $pass = $_POST['user_pass'];
                
                $response = $this->app_model->check_val_exist('user', 'user_name', $user_name)
                    ? $this->app_model->login($user_name, $pass) : '';

                if ($response) {
                    $response[0]['user_name'] = $response[0]['user_name'];
                    $user_id = $response[0]['user_id'];
                    $this->session->set_userdata('bansijew_is_logged_in', $response[0]);
                    $sql = "
                                SELECT
                                        ur.user_id,ur.website_module_id,ur.role_type_id, LOWER(r.title) as role, LOWER(m.title) as module
                                FROM user_roles ur
                                INNER JOIN website_modules m ON ur.website_module_id = m.website_module_id
                                INNER JOIN module_roles r ON ur.role_type_id = r.module_role_id WHERE ur.user_id = $user_id;
                            ";

                    $results = $this->crud->getFromSQL($sql); 

                    $roles = array();
                    foreach($results as $row){
                        $roles[$row->website_module_id][] = $row->role;
                    }

                    $this->session->set_userdata('user_roles',$roles);
                    //$user_roles = $this->session->userdata('user_roles');
                    //($user_roles);die;

                    redirect('');
                } else {
                    $data['errors']['invalid'] = 'Invalid username or password!';
                }
            } else {
                if (validation_errors()) {
                    $error_messages = $this->form_validation->error_array();
                    $data['errors'] = $error_messages;
                }
            }            
            $this->load->view('login_form', $data);
        }
    }

    function logout()
    {
        $this->session->unset_userdata('bansijew_is_logged_in');
        session_destroy();
        redirect('auth/login/');
    }

    function profile()
    {
        if (!$this->session->userdata('bansijew_is_logged_in')) {// logged in
            redirect('');
        }
        //if($this->applib->have_access_role(CHANGE_PASSWORD_MODULE_ID,"allow")) {
            $data = array();
            if (isset($this->session->userdata()['bansijew_is_logged_in']['user_id'])) {
                $table_name = "user";
                $get_data = array('user_id', $this->session->userdata('bansijew_is_logged_in')['user_id']);
            }
            $query['client_data'] = $this->crud->get_where($table_name, $get_data, 'row');
            set_page('change_password', $query);
        /*} else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }*/
    }

    function change_password()
    {
        $data = array();
        if (!empty($_POST)) {
            if (empty($this->input->post('old_pass'))) {
                $this->form_validation->set_rules('old_pass', 'old password', 'trim|required');
            } else {
                $this->form_validation->set_rules('old_pass', 'old password', 'trim|callback_check_old_password');
            }
            $this->form_validation->set_rules('new_pass', 'new password', 'trim|required');
            $this->form_validation->set_rules('confirm_pass', 'confirm Password', 'trim|required|matches[new_pass]');

            if ($this->form_validation->run()) {
                
                $table_name = "user";
                $update_id = array('user_id' => $this->session->userdata('bansijew_is_logged_in')['user_id']);
                /**$this->session->set_flashdata('success', false);
                $this->session->set_flashdata('message', 'Try Again!');**/
                $this->crud->update($table_name, array('user_pass' => md5($_POST['new_pass'])), $update_id);
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', 'You have successfully changed password!');
                redirect('auth/profile/');
            } else {
                if (validation_errors()) {
                    $error_messages = $this->form_validation->error_array();
                    $data['errors'] = $error_messages;
                }
            }
            set_page('change_password', $data);
        } else {
            redirect('auth/profile/');
        }
    }

    function check_old_password($old_pass)
    {
        $table_name = "user";
        $check_data = array('user_id' => $this->session->userdata('bansijew_is_logged_in')['user_id'], 'user_pass' => md5($old_pass));
        if ($this->crud->check_is_exists($table_name, $check_data)) {
            return true;
        } else {
            $this->form_validation->set_message('check_old_password', 'wrong old password.');
            return false;
        }
    }

    function person_wise_process_gross($process_id){
        if ($this->session->userdata('bansijew_is_logged_in')) {
            $data = array();
            if(!empty($process_id)) {
                $data['process_name'] = $this->crud->get_column_value_by_id('process_master', 'process_name', array('id' => $process_id));
                $select = "mir.job_worker_id,m.process_id, SUM(IF(type_id=1,IFNULL(mir.gross,0),0)) AS issue_finish,SUM(IF(type_id=2,mir.gross,0)) AS issue_scrap,SUM(IF(type_id=3,mir.gross,0)) AS receive_finish,SUM(IF(type_id=4,mir.gross,0)) AS receive_scrap, jw.job_worker";
                $this->db->select($select);
                $this->db->from('manufacture m');
                $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id');
                $this->db->join('job_worker jw','jw.id = mir.job_worker_id');
                $this->db->where('m.close_to_calculate_loss','1');
                $this->db->where('m.process_id', $process_id);
                $this->db->group_by('mir.job_worker_id');
                $query = $this->db->get();
//                echo $this->db->last_query(); exit;
                if($query->num_rows() > 0) {
                    $data['person_wise_process_gross_data'] = $query->result();
                }
            }
            $this->load->view('person_wise_process_gross',$data);
        } else {
            redirect('/auth/login/');
        }
    }
    
    function get_person_wise_detail(){
        $data = array();
        $data['person_wise_data'] = '';
        if(!empty($_POST['process_id']) && !empty($_POST['job_worker_id'])) {
            $select = "SUM(IF(type_id=1,IFNULL(mir.gross,0),0)) AS issue_finish,SUM(IF(type_id=2,mir.gross,0)) AS issue_scrap,SUM(IF(type_id=3,mir.gross,0)) AS receive_finish,SUM(IF(type_id=4,mir.gross,0)) AS receive_scrap,DATE_FORMAT(mir.ir_date, '%d-%m-%Y')  as tr_date ,m.process_id,mir.job_worker_id,m.process_id, mir.type_id,mir.gross,jw.job_worker";
            $this->db->select($select);
            $this->db->from('manufacture m');
            $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id');
            $this->db->join('job_worker jw','jw.id = mir.job_worker_id');
            $this->db->where('m.close_to_calculate_loss','1');
            $this->db->where('m.process_id', $_POST['process_id']);
            $this->db->where('mir.job_worker_id', $_POST['job_worker_id']);
            $this->db->group_by('mir.ir_date');
            $query = $this->db->get();
//                echo "<pre>"; print_r($query->result()); exit;
            if($query->num_rows() > 0) {
                $data['person_wise_data'] = $query->result();
                if(!empty($data['person_wise_data'])){
                    foreach ($data['person_wise_data'] as $key => $person_wise_data){
                        $this->db->select('mir.manufacture_id,jc.job_card_no');
                        $this->db->from('manufacture m');
                        $this->db->join('manufacture_issue_receive mir','mir.manufacture_id = m.manufacture_id');
                        $this->db->join('job_worker jw','jw.id = mir.job_worker_id');
                        $this->db->join('job_card jc','jc.job_card_id = mir.job_card_id');
                        $this->db->where('m.close_to_calculate_loss','1');
                        $this->db->where('m.process_id', $_POST['process_id']);
                        $this->db->where('mir.job_worker_id', $_POST['job_worker_id']);
                        $this->db->where('mir.ir_date', date('Y-m-d', strtotime($person_wise_data->tr_date)));
                        $this->db->group_by('mir.manufacture_id');
                        $this->db->order_by('mir.job_card_id','asc');
                        $query_job = $this->db->get();
                        $data['person_wise_data'][$key]->job_card_data = $query_job->result();
                    }
                }
            }
        }
        echo json_encode($data);
        exit;
    }
}
