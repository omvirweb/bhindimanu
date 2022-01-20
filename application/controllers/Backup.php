<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Backup
 * &@property Crud $crud
 * &@property AppLib $applib
 */
class Backup extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Crud', 'crud');
    }
    
    function index(){
        if($this->applib->have_access_role(BACKUP_MODULE_ID,"allow")) {
            $this->load->helper('file');
            $this->load->dbutil();
            $file_name = 'bhindimanu_' . date("Y-m-d-H-i-s") . '.sql.zip';
            $prefs = array(
                'format' => 'zip',
                'filename' => $file_name,
                'add_drop' => FALSE,
                'foreign_key_checks' => FALSE,
            );
            $backup = $this->dbutil->backup($prefs);
            $this->load->helper('download');
            force_download($file_name, $backup);
        } else {
            $this->session->set_flashdata('error_message', 'You have not permission to access this page.');
            redirect("/");
        }

           
    }
}