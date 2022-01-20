<?php

/**
 * Class Crud
 * &@property CI_DB_active_record $db
 */
class Crud extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function is_login()
    {
        if (!$this->session->userdata('bhindimanu_is_logged_in')) {
            redirect('/auth/login/');
        }
    }

    /**
     * @param $table_name
     * @param $data_array
     * @return bool
     */
    function insert($table_name, $data_array)
    {
        if ($this->db->insert($table_name, $data_array)) {
            return $this->db->insert_id();
        }
        return false;
    }

    function insertFromSql($sql)
    {
        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function execuetSQL($sql)
    {
        $this->db->query($sql);
    }

    function getFromSQL($sql)
    {
        return $this->db->query($sql)->result();
    }

    /**
     * @param $table_name
     * @param $order_by_column
     * @param $order_by_value
     * @return bool
     */
    function get_all_records($table_name, $order_by_column, $order_by_value)
    {
        $this->db->select("*");
        $this->db->from($table_name);
        $this->db->order_by($order_by_column, $order_by_value);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_column_records($table_name, $column_array, $order_by_column, $order_by_value)
    {
        //return $this->db->select($column_array)->get($table_name)->result();
        return $this->db->select($column_array)->order_by($order_by_column, $order_by_value)->get($table_name)->result();
    }

    /**
     * @param $table_name
     * @param $where
     * @param $is_result
     * @return mixed
     */
    public function get_where($table_name, $where, $is_result)
    {
        if ($is_result == 'result') {
            return $this->db->get_where($table_name, $where)->result();
        } elseif ($is_result == 'result_array') {
            return $this->db->get_where($table_name, $where)->result_array();
        } elseif ($is_result == 'row') {
            return $this->db->get_where($table_name, $where)->row();
        } else {
            return false;
        }
    }

    /**
     * @param $table_name
     * @param $where
     * @return bool
     */
    public function check_is_exists($table_name, $where)
    {
        $query = $this->db->get_where($table_name, $where);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $table_name
     * @param $order_by_column
     * @param $order_by_value
     * @param $where_array
     * @return bool
     */
    function get_all_with_where($table_name, $order_by_column, $order_by_value, $where_array)
    {
        $this->db->select("*");
        $this->db->from($table_name);
        $this->db->where($where_array);
        $this->db->order_by($order_by_column, $order_by_value);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * @param $tbl_name
     * @param $column_name
     * @param $where_id
     * @return mixed
     */
    function get_column_value_by_id($tbl_name, $column_name, $where_id)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $this->db->where($where_id);
        $this->db->last_query();
        $query = $this->db->get();
        return $query->row($column_name);
    }

    /**
     * @param $table_name
     * @param $where_id
     * @return mixed
     */
    function get_row_by_id($table_name, $where_id)
    {
        $this->db->select("*");
        $this->db->from($table_name);
        $this->db->where($where_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_row_by_where($table_name,$where){
        $this->db->select("*");
        $this->db->from($table_name);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * @param $table_name
     * @param $where_array
     * @return mixed
     */
    function delete($table_name, $where_array)
    {
        $result = $this->db->delete($table_name, $where_array);
        $return = array();
        if ($result == '') {
            $return['error'] = "Error";
        } else {
            $return['success'] = 'Deleted';
        }
        return $return;
    }

    /**
     * @param $table_name
     * @param $where_id
     * @param $where_in_array
     * @return mixed
     */
    function delete_where_in($table_name, $where_id, $where_in_array)
    {
        $this->db->where_in($where_id, $where_in_array);
        $result = $this->db->delete($table_name);
        return $result;
    }

    /**
     * @param $table_name
     * @param $data_array
     * @param $where_array
     * @return mixed
     */
    function update($table_name, $data_array, $where_array)
    {
        $this->db->where($where_array);
        $rs = $this->db->update($table_name, $data_array);
        return $rs;
    }

    /**
     * @param $name
     * @param $path
     * @return bool
     */
    function upload_file($name, $path)
    {
        $config['upload_path'] = $path;
        $config ['allowed_types'] = '*';
        $this->upload->initialize($config);
        if ($this->upload->do_upload($name)) {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        }
        return false;
    }

    /**
     * @param $table
     * @param $id_column
     * @param $column
     * @param $column_val
     * @return null
     */
    function get_id_by_val($table, $id_column, $column, $column_val)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column, $column_val);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->$id_column;
        } else {
            return null;
        }
    }

    function get_id_by_val_where($table, $id_column, $column, $column_val, $where)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column, $column_val);
        $this->db->where($where);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->$id_column;
        } else {
            return null;
        }
    }

    function get_id_by_val_count($table, $id_column, $column, $column_val)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column, $column_val);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return null;
        }
    }

    function get_id_by_val_count_where($table, $id_column, $column, $column_val, $where)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column, $column_val);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return null;
        }
    }

    function get_id_by_val_not($table, $id_column, $column, $column_val, $permalink)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column, $column_val);
        $this->db->where_not_in($id_column, $permalink);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->$id_column;
        } else {
            return null;
        }
    }

    function get_same_by_val($table, $id_column, $column1, $column1_val, $column2, $column2_val, $id = null)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column1, $column1_val);
        $this->db->where($column2, $column2_val);
        $this->db->where($id_column . "!=", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->$id_column;
        } else {
            return null;
        }
    }

    function get_same_by_multi_where($table, $id_column, $column1, $column1_val, $column2, $column2_val, $column3, $column3_val, $id = null)
    {
        $this->db->select($id_column);
        $this->db->from($table);
        $this->db->where($column1, $column1_val);
        $this->db->where($column2, $column2_val);
        $this->db->where($column3, $column3_val);
        $this->db->where($id_column . "!=", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->$id_column;
        } else {
            return null;
        }
    }

    function limit_words($string, $word_limit = 30)
    {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }

    function limit_character($string, $character_limit = 30)
    {
        if (strlen($string) > $character_limit) {
            return substr($string, 0, $character_limit) . '...';
        } else {
            return $string;
        }
    }

    //select data

    function get_select_data($tbl_name)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $query = $this->db->get();
        return $query->result();
    }

    function get_select_data_where($tbl_name, $where, $where1)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $this->db->where($where);
        $this->db->where($where1);
        $this->db->order_by("name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    // Select data For specific Columns
    // $columns Array
    function get_specific_column_data($tbl_name, $columns)
    {
        $columns = implode(', ', $columns);
        $this->db->select($columns);
        $this->db->from($tbl_name);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @param $tbl_name
     * @param $where
     * @param $where_id
     * @return mixed
     */
    function get_data_row_by_id($tbl_name, $where, $where_id)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $this->db->where($where, $where_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_result_where($tbl_name, $where, $where_id)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $this->db->where($where, $where_id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_where_in_result($tbl_name, $where, $where_in)
    {
        $this->db->select("*");
        $this->db->from($tbl_name);
        $this->db->where_in($where, $where_in);
        $query = $this->db->get();
        return $query->result();
    }

    function get_max_number($tbl_name, $column_name)
    {
        $this->db->select_max($column_name);
        $result = $this->db->get($tbl_name)->row();
        return $result;
    }

    function get_last_record_by_id($table_name, $column_id, $column_val, $order_by_column, $order_by_value)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_id, $column_val);
        $this->db->order_by($order_by_column, $order_by_value);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }

    function get_last_record_by_where_array($table_name, $where_array, $order_by_column, $order_by_value)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($where_array);
        $this->db->order_by($order_by_column, $order_by_value);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }


    function get_next_autoincrement($tbl_name)
    {
        $query = $this->db->query('SHOW TABLE STATUS WHERE `Name` = "' . $tbl_name . '"');
        $data = $query->result_array();
        return $data[0]['Auto_increment'];
    }

    function get_complain_no()
    {
        $this->db->select('complain_inc_no');
        $this->db->from('complains');
        $this->db->where('YEAR(created_at)', date('Y'));
        $this->db->where('MONTH(created_at)', date('m'));
        $this->db->order_by('complain_inc_no', 'desc');
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }

    function get_manufacture_ir($manufacture_id)
    {
        $res = array();
        $this->db->select('mir.*,m.process_id');
        $this->db->from('manufacture_issue_receive mir');
        $this->db->join('manufacture m','m.manufacture_id = mir.manufacture_id');
        $this->db->where('m.manufacture_id', $manufacture_id);
        $this->db->order_by('m.manufacture_id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $res = $query->result();
        }
        return $res;
    }

    function manufacture_labor($manufacture_id){
        $total_labor = 0;
        $process_item_labor = array();
        $manu_ir_res = $this->crud->get_manufacture_ir($manufacture_id);
        if(!empty($manu_ir_res)) {
            foreach($manu_ir_res as $manu_ir_row) {
                if(!isset($process_item_labor[$manu_ir_row->process_id])) {
                    $process_row = $this->crud->get_data_row_by_id('process_master','id',$manu_ir_row->process_id);
                    if(!empty($process_row->labor_on)) {
                        $process_item_labor[$manu_ir_row->process_id]['labor_on'] = $process_row->labor_on;
                        $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'] = $process_row->labor_on_how_much;
                        $process_item_labor[$manu_ir_row->process_id]['labor_all_item'] = $process_row->labor_all_item;
                        $labor_res = $this->crud->get_result_where('process_item_labor','process_id',$manu_ir_row->process_id);
                        if(!empty($labor_res)) {
                            foreach ($labor_res as $labor_row) {
                                $process_item_labor[$manu_ir_row->process_id][$labor_row->item_id] = $labor_row->labor;
                            }
                        }
                    } else {
                        $process_item_labor[$manu_ir_row->process_id]['labor_on'] = null;
                        $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'] = null;
                        $process_item_labor[$manu_ir_row->process_id]['labor_all_item'] = null;
                    }
                }
                $manu_ir_labor = 0;
                if(!empty($process_item_labor[$manu_ir_row->process_id]['labor_on'])) {
                    if($process_item_labor[$manu_ir_row->process_id]['labor_on'] == LABOR_ON_PCS) {
                        //Receive Finish Work Weight upar count
                        if($manu_ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID) {
                            if(!empty($process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id])) {
                                $manu_ir_labor = ($manu_ir_row->pcs * $process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id]) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];
                            } else {
                                $manu_ir_labor = ($manu_ir_row->pcs * $process_item_labor[$manu_ir_row->process_id]['labor_all_item']) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];    
                            }
                            
                        }
                        
                    }

                    if($process_item_labor[$manu_ir_row->process_id]['labor_on'] == LABOR_ON_ADPCS) {
                        //Receive AD PCs upar count
                        if(!empty($manu_ir_row->ad_pcs) && in_array($manu_ir_row->type_id,array(MANUFACTURE_TYPE_RECEIVE_FINISH_ID,MANUFACTURE_TYPE_RECEIVE_SCRAP_ID))) {
                            
                            if(!empty($process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id])) {
                                $manu_ir_labor = ($manu_ir_row->ad_pcs * $process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id]) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];
                            } else {
                                $manu_ir_labor = ($manu_ir_row->ad_pcs * $process_item_labor[$manu_ir_row->process_id]['labor_all_item']) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];    
                            }
                            
                        }
                    }
                }
                $total_labor += $manu_ir_labor;
            }
        }
        return $total_labor;
    }

    function get_job_card_manufacture_ir($job_card_id)
    {
        $res = array();
        $this->db->select('mir.*,m.process_id');
        $this->db->from('manufacture_issue_receive mir');
        $this->db->join('manufacture m','m.manufacture_id = mir.manufacture_id');
        $this->db->where('m.job_card_id', $job_card_id);
        $this->db->order_by('m.manufacture_id','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $res = $query->result();
        }
        return $res;
    }

    function job_card_labor($job_card_id){
        $total_labor = 0;
        $process_item_labor = array();
        $manu_ir_res = $this->crud->get_job_card_manufacture_ir($job_card_id);
        if(!empty($manu_ir_res)) {
            foreach($manu_ir_res as $manu_ir_row) {
                if(!isset($process_item_labor[$manu_ir_row->process_id])) {
                    $process_row = $this->crud->get_data_row_by_id('process_master','id',$manu_ir_row->process_id);
                    if(!empty($process_row->labor_on)) {
                        $process_item_labor[$manu_ir_row->process_id]['labor_on'] = $process_row->labor_on;
                        $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'] = $process_row->labor_on_how_much;
                        $process_item_labor[$manu_ir_row->process_id]['labor_all_item'] = $process_row->labor_all_item;
                        $labor_res = $this->crud->get_result_where('process_item_labor','process_id',$manu_ir_row->process_id);
                        if(!empty($labor_res)) {
                            foreach ($labor_res as $labor_row) {
                                $process_item_labor[$manu_ir_row->process_id][$labor_row->item_id] = $labor_row->labor;
                            }
                        }
                    } else {
                        $process_item_labor[$manu_ir_row->process_id]['labor_on'] = null;
                        $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'] = null;
                        $process_item_labor[$manu_ir_row->process_id]['labor_all_item'] = null;
                    }
                }
                $manu_ir_labor = 0;
                if(!empty($process_item_labor[$manu_ir_row->process_id]['labor_on'])) {
                    if($process_item_labor[$manu_ir_row->process_id]['labor_on'] == LABOR_ON_PCS) {
                        //Receive Finish Work Weight upar count
                        if($manu_ir_row->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID) {
                            if(!empty($process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id])) {
                                $manu_ir_labor = ($manu_ir_row->pcs * $process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id]) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];
                            } else {
                                $manu_ir_labor = ($manu_ir_row->pcs * $process_item_labor[$manu_ir_row->process_id]['labor_all_item']) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];    
                            }
                            
                        }
                        
                    }

                    if($process_item_labor[$manu_ir_row->process_id]['labor_on'] == LABOR_ON_ADPCS) {
                        //Receive AD PCs upar count
                        if(!empty($manu_ir_row->ad_pcs) && in_array($manu_ir_row->type_id,array(MANUFACTURE_TYPE_RECEIVE_FINISH_ID,MANUFACTURE_TYPE_RECEIVE_SCRAP_ID))) {
                            
                            if(!empty($process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id])) {
                                $manu_ir_labor = ($manu_ir_row->ad_pcs * $process_item_labor[$manu_ir_row->process_id][$manu_ir_row->item_id]) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];
                            } else {
                                $manu_ir_labor = ($manu_ir_row->ad_pcs * $process_item_labor[$manu_ir_row->process_id]['labor_all_item']) / $process_item_labor[$manu_ir_row->process_id]['labor_on_how_much'];    
                            }
                            
                        }
                    }
                }
                $total_labor += $manu_ir_labor;
            }
        }
        return $total_labor;
    }

    function get_manufacture_ir_for_person_ledger($from_date, $to_date = '', $job_worker_id = '') {
        $this->db->select("mir.*, mir.ir_date as row_date, m.close_to_calculate_loss, m.used_vetran, m.used_moti, jc.job_card_no, i.item_name");
        $this->db->from('manufacture_issue_receive mir');
        $this->db->join('manufacture m', 'm.manufacture_id = mir.manufacture_id', 'left');
        $this->db->join('job_card jc', 'jc.job_card_id = mir.job_card_id', 'left');
        $this->db->join('item i', 'i.item_id= mir.item_id', 'left');
        if (!empty($to_date)) {
            $this->db->where('mir.ir_date >=', $from_date);
            $this->db->where('mir.ir_date <=', $to_date);
//        } else {
//            $this->db->where('mir.ir_date <',$from_date);
        }
        if (!empty($job_worker_id)) {
            $this->db->where('mir.job_worker_id', $job_worker_id);
        } else {
            $this->db->where('mir.job_worker_id', '-1');
        }
        $query = $this->db->get();
//        echo $this->db->last_query(); exit;
        return $query->result();
    }

    function get_payment_receipt_person_ledger($from_date, $to_date = '', $job_worker_id = '') {
        $this->db->select("pr.*, pr.payment_receipt_date as row_date, i.item_name");
        $this->db->from('payment_receipt pr');
        $this->db->join('item i', 'i.item_id= pr.item_id', 'left');
        if (!empty($to_date)) {
            $this->db->where('pr.payment_receipt_date >=', $from_date);
            $this->db->where('pr.payment_receipt_date <=', $to_date);
//        } else {
//            $this->db->where('pr.payment_receipt_date <',$from_date);
        }
        if (!empty($job_worker_id)) {
            $this->db->where('pr.job_worker_id', $job_worker_id);
        } else {
            $this->db->where('pr.job_worker_id', '-1');
        }
        $query = $this->db->get();
        return $query->result();
    }

}