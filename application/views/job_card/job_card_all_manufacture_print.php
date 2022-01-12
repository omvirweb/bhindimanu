<?php
    $this->load->view('header');
?>
<style>
    .table th{
        padding: 4px !important;
        font-size: 15px !important;
    }
    .table td{
        padding: 4px !important;
        font-size: 15px !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-dark" style="margin: 15px 5px;">Job Card All Manufacture Print</h3>
            <div class="row">
                <div class="col-md-2 pr-0">
                    <div class="form-group">
                        <label for="job_card_id"> Job No</label>
                        <select name="job_card_id" id="job_card_id" class="form-control" data-index="1" disabled ></select>
                    </div>
                </div>
                <div class="col-md-2 pr-0">
                    <div class="form-group">
                        <label for="party"> Party</label>
                        <input type="text" class="form-control" name="party" id="party" disabled="disabled">
                    </div>
                </div>
                <div class="col-md-1 pr-0">
                    <div class="form-group">
                        <label for="melting"> Touch</label>
                        <input type="text" class="form-control" name="melting" id="melting" disabled="disabled">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <?php
        foreach ($manufactures as $key => $manufacture_row) {
    //        if($key == 1){ break; }
            $data = array();
            $data['manufacture_row'] = $this->crud->get_data_row_by_id('manufacture', 'manufacture_id', $manufacture_row->manufacture_id);
            $data['job_card_all_manufacture_print'] = 'job_card_all_manufacture_print_' . $key;
            $manufacture_ir_res = array();
            $this->db->select('mir.*,i.item_name as item_id_text,jw.job_worker as job_worker_id_text');
            $this->db->from('manufacture_issue_receive mir');
            $this->db->join('item i','i.item_id = mir.item_id','left');
            $this->db->join('job_worker jw','jw.id = mir.job_worker_id','left');
            $this->db->where('mir.manufacture_id', $manufacture_row->manufacture_id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                $manufacture_ir_res = $query->result();
            }
            $lineitem_objectdata = array();
            foreach ($manufacture_ir_res as $manufacture_ir_row) {
                $lineitem = array();
                $lineitem['manufacture_ir_id'] = $manufacture_ir_row->manufacture_ir_id;
                $lineitem['manufacture_id'] = $manufacture_row->manufacture_id;
                $lineitem['type_id'] = $manufacture_ir_row->type_id;
                $lineitem['ir_date'] = date('d-m-Y', strtotime($manufacture_ir_row->ir_date));
                $lineitem['item_id'] = $manufacture_ir_row->item_id;
                $lineitem['item_id_text'] = $manufacture_ir_row->item_id_text;
                $lineitem['job_worker_id'] = $manufacture_ir_row->job_worker_id;
                $lineitem['job_worker_id_text'] = $manufacture_ir_row->job_worker_id_text;
                $lineitem['gross'] = (!empty($manufacture_ir_row->gross)) ? $manufacture_ir_row->gross : 0;
                $lineitem['touch'] = (!empty($manufacture_ir_row->touch)) ? $manufacture_ir_row->touch : 0;
                $lineitem['wastage'] = (!empty($manufacture_ir_row->wastage)) ? $manufacture_ir_row->wastage : 0;
                $lineitem['fine'] = (!empty($manufacture_ir_row->fine)) ? $manufacture_ir_row->fine : 0;
                $lineitem['ad_weight'] = (!empty($manufacture_ir_row->ad_weight)) ? $manufacture_ir_row->ad_weight : 0;
                $lineitem['ad_pcs'] = (!empty($manufacture_ir_row->ad_pcs)) ? $manufacture_ir_row->ad_pcs : 0;
                $lineitem['before_meena'] = (!empty($manufacture_ir_row->before_meena)) ? $manufacture_ir_row->before_meena : 0;
                $lineitem['meena_wt'] = (!empty($manufacture_ir_row->meena_wt)) ? $manufacture_ir_row->meena_wt : 0;
                $lineitem['item_weight'] = (!empty($manufacture_ir_row->item_weight)) ? $manufacture_ir_row->item_weight : 0;
                $lineitem['kundan'] = (!empty($manufacture_ir_row->kundan)) ? $manufacture_ir_row->kundan : 0;
                $lineitem['sm'] = (!empty($manufacture_ir_row->sm)) ? $manufacture_ir_row->sm : 0;
                $lineitem['vetran'] = (!empty($manufacture_ir_row->vetran)) ? $manufacture_ir_row->vetran : 0;
                $lineitem['v_pcs'] = (!empty($manufacture_ir_row->v_pcs)) ? $manufacture_ir_row->v_pcs : 0;
                $lineitem['stone_pcs'] = (!empty($manufacture_ir_row->stone_pcs)) ? $manufacture_ir_row->stone_pcs : 0;
                $lineitem['stone_weight'] = (!empty($manufacture_ir_row->stone_weight)) ? $manufacture_ir_row->stone_weight : 0;
                $lineitem['stone_charges'] = (!empty($manufacture_ir_row->stone_charges)) ? $manufacture_ir_row->stone_charges : 0;
                $lineitem['moti'] = (!empty($manufacture_ir_row->moti)) ? $manufacture_ir_row->moti : 0;
                $lineitem['moti_amount'] = (!empty($manufacture_ir_row->moti_amount)) ? $manufacture_ir_row->moti_amount : 0;
                $lineitem['other_charges'] = (!empty($manufacture_ir_row->other_charges)) ? $manufacture_ir_row->other_charges : 0;
                $lineitem['loss'] = (!empty($manufacture_ir_row->loss)) ? $manufacture_ir_row->loss : 0;
                $lineitem['loss_fine'] = (!empty($manufacture_ir_row->loss_fine)) ? $manufacture_ir_row->loss_fine : 0;
                $lineitem['item_remark'] = (!empty($manufacture_ir_row->item_remark)) ? $manufacture_ir_row->item_remark : '';
                $lineitem['image'] = (!empty($manufacture_ir_row->image)) ? $manufacture_ir_row->image : '';
                $lineitem_objectdata[] = $lineitem;
            }
            $data['lineitem_objectdata'] = json_encode($lineitem_objectdata,true);
    //        print_r($data); exit;
            $selected_process_issue_fields = array();
            $selected_process_receive_fields = array();
            $process_row = $this->crud->get_data_row_by_id('process_master', 'id', $manufacture_row->process_id);
            if (!empty($process_row->process_issue_fields)) {
                $selected_process_issue_fields = explode(',', $process_row->process_issue_fields);
            }
            if (!empty($process_row->process_receive_fields)) {
                $selected_process_receive_fields = explode(',', $process_row->process_receive_fields);
            }
            $data['selected_process_issue_fields'] = json_encode($selected_process_issue_fields);
            $data['selected_process_receive_fields'] = json_encode($selected_process_receive_fields);
            $this->load->view('job_card/job_card_all_manufacture_print_details', $data);
        }
    ?>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
    $this->load->view('footer');
?>