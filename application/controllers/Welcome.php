<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
    
	public function index()
	{
		$data = array();
		$data['process_master_res'] = $this->crud->get_all_records('process_master','sequence','asc');
		$this->load->view('dashboard',$data);
	}

	public function job_card_entry()
	{
		$this->load->view('job_card_entry');
	}
	
	public function manufacture()
	{
		$this->load->view('manufacture');
	}
	
	public function order()
	{
		$this->load->view('order');
	}
	
	public function weight_detail()
	{
		$this->load->view('weight_detail');
	}
}
