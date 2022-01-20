<?php

/**
 * Class Applib
 */
class Applib
{
	/**
     * Applib constructor.
     * @param array $config
     */
	function __construct()
	{
		$this->ci =& get_instance();
                $this->ci->load->database();
                $this->ci->load->model('Crud', 'crud');
                $this->ci->load->library('session');
                $this->logged_in_id = $this->ci->session->userdata('bhindimanu_is_logged_in')['user_id'];
                $this->now_date = date('Y-m-d');
                $this->now_time = date('Y-m-d H:i:s');
	}

	function get_item_designs_by_item($item_id) {
		$designs_data = array();

		$this->db->select("*");
		$this->db->from('design_no');
		$this->db->where('item_id',$item_id);
		$this->db->order_by('design_no','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $value) {
				$designs_data[] = array(
					'design_id' => $value['id'],
					'design_no' => $value['design_no'],
				);
			}	
		}
		return $designs_data;
	}

	function get_current_date_time() {
            return date('Y-m-d H:i:s');
	}

        function have_access_role($module, $role){
            $status = 0;
            $user_roles = $this->ci->session->userdata('user_roles');
            //echo '<pre>';print_r($user_roles);die();
            if(isset($user_roles[$module]) && in_array($role, $user_roles[$module]))
            {
                $status = 1;
            }
            return $status;
        }

    function update_job_worker_balance_increase($job_worker_id, $fine = '', $amount = ''){
        $job_worker_data = $this->ci->crud->get_data_row_by_id('job_worker', 'id', $job_worker_id);
        if(!empty($job_worker_data)){
            $update_array = array();
            if($fine != ''){
                $acc_current_fine = number_format((float) $job_worker_data->current_fine, '3', '.', '') + number_format((float) $fine, '3', '.', '');
                $acc_current_fine = number_format((float) $acc_current_fine, '3', '.', '');
                $update_array['current_fine'] = $acc_current_fine;
            }
            if($amount != ''){
                $acc_current_amount = number_format((float) $job_worker_data->current_amount, '2', '.', '') + number_format((float) $amount, '2', '.', '');
                $acc_current_amount = number_format((float) $acc_current_amount, '2', '.', '');
                $update_array['current_amount'] = $acc_current_amount;
            }
            $update_array['balance_date'] = $this->now_date;
            $this->ci->crud->update('job_worker', $update_array, array('id' => $job_worker_id));
        }
    }

    function update_job_worker_balance_decrease($job_worker_id, $fine = '', $amount = ''){
        $job_worker_data = $this->ci->crud->get_data_row_by_id('job_worker', 'id', $job_worker_id);
        if(!empty($job_worker_data)){
            $update_array = array();
            if($fine != ''){
                $acc_current_fine = number_format((float) $job_worker_data->current_fine, '3', '.', '') - number_format((float) $fine, '3', '.', '');
                $acc_current_fine = number_format((float) $acc_current_fine, '3', '.', '');
                $update_array['current_fine'] = $acc_current_fine;
            }
            if($amount != ''){
                $acc_current_amount = number_format((float) $job_worker_data->current_amount, '2', '.', '') - number_format((float) $amount, '2', '.', '');
                $acc_current_amount = number_format((float) $acc_current_amount, '2', '.', '');
                $update_array['current_amount'] = $acc_current_amount;
            }
            $update_array['balance_date'] = $this->now_date;
            $this->ci->crud->update('job_worker', $update_array, array('id' => $job_worker_id));
        }
    }

    function update_item_stock_increase($item_id, $gross, $touch = 100, $fine){
        $where_stock_array = array('item_id' => $item_id, 'touch' => $touch);
//        $fine = $ntwt * $touch / 100;
        $exist_item_stock = $this->ci->crud->get_row_by_where('item_stock', $where_stock_array);
        if(!empty($exist_item_stock)){
            $gross = number_format((float) $exist_item_stock->gross, '3', '.', '') + number_format((float) $gross, '3', '.', '');
            $fine = number_format((float) $exist_item_stock->fine, '3', '.', '') + number_format((float) $fine, '3', '.', '');
            $update_item_stock = array();
            $update_item_stock['gross'] = number_format((float) $gross, '3', '.', '');
            $update_item_stock['fine'] = number_format((float) $fine, '3', '.', '');
            $update_item_stock['updated_at'] = $this->now_time;
            $update_item_stock['updated_by'] = $this->logged_in_id;
            $this->ci->crud->update('item_stock', $update_item_stock, array('item_stock_id' => $exist_item_stock->item_stock_id));
        } else {
            $insert_item_stock = array();
            $insert_item_stock['item_id'] = $item_id;
            $insert_item_stock['gross'] = number_format((float) $gross, '3', '.', '');
            $insert_item_stock['touch'] = $touch;
            $insert_item_stock['fine'] = number_format((float) $fine, '3', '.', '');
            $insert_item_stock['created_at'] = $this->now_time;
            $insert_item_stock['created_by'] = $this->logged_in_id;
            $insert_item_stock['updated_at'] = $this->now_time;
            $insert_item_stock['updated_by'] = $this->logged_in_id;
            $this->ci->crud->insert('item_stock', $insert_item_stock);
        }
    }

    function update_item_stock_decrease($item_id, $gross, $touch = 100, $fine){
        $where_stock_array = array('item_id' => $item_id, 'touch' => $touch);
//        $fine = $ntwt * $touch / 100;
        $exist_item_stock = $this->ci->crud->get_row_by_where('item_stock', $where_stock_array);
        if(!empty($exist_item_stock)){
            $gross = number_format((float) $exist_item_stock->gross, '3', '.', '') - number_format((float) $gross, '3', '.', '');
            $fine = number_format((float) $exist_item_stock->fine, '3', '.', '') - number_format((float) $fine, '3', '.', '');
            $update_item_stock = array();
            $update_item_stock['gross'] = number_format((float) $gross, '3', '.', '');
            $update_item_stock['fine'] = number_format((float) $fine, '3', '.', '');
            $update_item_stock['updated_at'] = $this->now_time;
            $update_item_stock['updated_by'] = $this->logged_in_id;
            $this->ci->crud->update('item_stock', $update_item_stock, array('item_stock_id' => $exist_item_stock->item_stock_id));
        } else {
            $insert_item_stock = array();
            $insert_item_stock['item_id'] = $item_id;
            $insert_item_stock['gross'] = ZERO_VALUE - number_format((float) $gross, '3', '.', '');
            $insert_item_stock['touch'] = $touch;
            $insert_item_stock['fine'] = ZERO_VALUE - number_format((float) $fine, '3', '.', '');
            $insert_item_stock['created_at'] = $this->now_time;
            $insert_item_stock['created_by'] = $this->logged_in_id;
            $insert_item_stock['updated_at'] = $this->now_time;
            $insert_item_stock['updated_by'] = $this->logged_in_id;
            $this->ci->crud->insert('item_stock', $insert_item_stock);
        }
    }

}
