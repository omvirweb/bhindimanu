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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manufacture: <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'View Process Wise' : 'Add Issue/Receive'; ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="body-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form id="save_manufacture" class="form-horizontal" action=""  method="post"  novalidate enctype="multipart/form-data">
                        <input type="hidden" name="manufacture_id" id="manufacture_id" value="<?php echo isset($manufacture_row->manufacture_id) ? $manufacture_row->manufacture_id : ''; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="job_card_id"> Job No<span style="color:red"> *</span></label>
                                        <select name="job_card_id" id="job_card_id" class="form-control" data-index="1" <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'disabled' : ''; ?> ></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="party"> Party<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="party" id="party" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="melting"> Touch<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="melting" id="melting" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="process_id"> Process<span style="color:red"> *</span></label>
                                        <select name="process_id" id="process_id" class="form-control" data-index="2"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0 <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'd-none' : ''; ?> ">
                                    <div class="form-group">
                                        <label for="close_to_calculate_loss"> Close To Calculate Loss</label>
                                        <select name="close_to_calculate_loss" id="close_to_calculate_loss" class="form-control select2" data-index="3">
                                            <option value="1" <?php echo isset($manufacture_row->close_to_calculate_loss) && $manufacture_row->close_to_calculate_loss == 1 ? 'selected' : ''; ?> >Open</option>
                                            <option value="2" <?php echo isset($manufacture_row->close_to_calculate_loss) && $manufacture_row->close_to_calculate_loss == 2 ? 'selected' : ''; ?> >Close</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'd-none' : ''; ?> ">
                                    <div class="form-group">
                                        <label for="remark"> Remark</label>
                                        <textarea name="remark" id="remark" class="form-control" data-index="4"><?php echo isset($manufacture_row->remark) ? $manufacture_row->remark : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="line_item_form <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'd-none' : ''; ?> ">
                            <div class="row">
                                <input type="hidden" name="line_items_index" id="line_items_index" />
                                <input type="hidden" name="line_items_data[manufacture_ir_id]" id="manufacture_ir_id"  value="0" />
                                <div class="col-md-2 pr-0" style="">
                                    <div class="form-group">
                                        <label for="type_id"> Issue/Receive<span style="color:red"> *</span></label>
                                        <select class="" name="line_items_data[type_id]" id="type_id" data-index="5">
                                            <option value="">- Select -</option>
                                            <option value="<?php echo MANUFACTURE_TYPE_ISSUE_FINISH_ID; ?>">Issue Finish Work</option>
                                            <option value="<?php echo MANUFACTURE_TYPE_ISSUE_SCRAP_ID; ?>">Issue Scrap</option>
                                            <option value="<?php echo MANUFACTURE_TYPE_RECEIVE_FINISH_ID; ?>">Receive Finish Work</option>
                                            <option value="<?php echo MANUFACTURE_TYPE_RECEIVE_SCRAP_ID; ?>">Receive Scrap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0" style="">
                                    <div class="form-group">
                                        <label for="ir_date"> Date<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control pl-2 pr-2" value="<?php echo date('d-m-Y'); ?>" name="line_items_data[ir_date]" id="ir_date" data-index="6">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="job_worker_id"> Person</label>
                                        <select class="form-control" name="line_items_data[job_worker_id]" id="job_worker_id" data-index="7"></select>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="item_id"> Item<span style="color:red"> *</span></label>
                                        <select class="form-control" name="line_items_data[item_id]" id="item_id" data-index="8"></select>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="gross"><a href="javascript:void(0)" id="gross_details" class="" style="">Gross</a><span style="color:red"> *</span></label>
                                        <input type="text" name="line_items_data[gross]" id="gross" class="form-control num_only" data-index="9">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="touch"> Touch</label>
                                        <input type="text" name="line_items_data[touch]" id="touch" class="form-control num_only" data-index="10">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_wastage prf_wastage d-none">
                                    <div class="form-group">
                                        <label for="wastage"> Wastage</label>
                                        <input type="text" name="line_items_data[wastage]" id="wastage" class="form-control num_only" data-index="11">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <div class="form-group">
                                        <label for="fine"> Fine</label>
                                        <input type="text" name="line_items_data[fine]" id="fine" class="form-control num_only" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-0 person_current_details d-none">
                                    <div class="form-group">
                                        <label for="person_current_fine" style="font-size: 12px;">Person Current Fine : <span id="person_current_fine" style="font-weight: 500;"></span></label>
                                        <label for="person_current_amount" style="font-size: 12px;">Person Current Amount : <span id="person_current_amount" style="font-weight: 500;"></span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 pr-0 dynamic_field pif_ad_weight prf_ad_weight d-none">
                                    <div class="form-group">
                                        <label for="ad_weight"> Ad Weight</label>
                                        <input type="text" name="line_items_data[ad_weight]" id="ad_weight" class="form-control num_only" data-index="12">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_ad_pcs prf_ad_pcs d-none">
                                    <div class="form-group">
                                        <label for="ad_pcs"> Ad Pcs</label>
                                        <input type="text" name="line_items_data[ad_pcs]" id="ad_pcs" class="form-control num_only" data-index="13">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_before_meena d-none">
                                    <div class="form-group">
                                        <label for="before_meena" style="font-size: 14px;"> Before Meena</label>
                                        <input type="text" name="line_items_data[before_meena]" id="before_meena" class="form-control num_only" data-index="14">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_meena_wt d-none">
                                    <div class="form-group">
                                        <label for="meena_wt"> Meena Wt.</label>
                                        <input type="text" name="line_items_data[meena_wt]" id="meena_wt" class="form-control num_only" data-index="15">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_item_weight d-none">
                                    <div class="form-group">
                                        <label for="item_weight"> Item Weight</label>
                                        <input type="text" name="line_items_data[item_weight]" id="item_weight" class="form-control num_only" data-index="16">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_kundan d-none">
                                    <div class="form-group">
                                        <label for="kundan"> Kundan</label>
                                        <input type="text" name="line_items_data[kundan]" id="kundan" class="form-control num_only" data-index="17">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_sm d-none">
                                    <div class="form-group">
                                        <label for="sm"> SM</label>
                                        <input type="text" name="line_items_data[sm]" id="sm" class="form-control num_only" data-index="18">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_vetran prf_vetran d-none">
                                    <div class="form-group">
                                        <label for="vetran"> Vetran</label>
                                        <input type="text" name="line_items_data[vetran]" id="vetran" class="form-control num_only" data-index="19">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_v_pcs prf_v_pcs d-none">
                                    <div class="form-group">
                                        <label for="v_pcs"> V Pcs</label>
                                        <input type="text" name="line_items_data[v_pcs]" id="v_pcs" class="form-control num_only" data-index="20">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_stone_pcs prf_stone_pcs d-none">
                                    <div class="form-group">
                                        <label for="stone_pcs"><a href="javascript:void(0)" id="stone_pcs_details" class="" style="">Stone Pcs</a></label>
                                        <input type="text" name="line_items_data[stone_pcs]" class="form-control" id="stone_pcs" placeholder="" value="" data-index="21">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_stone_wt prf_stone_wt d-none">
                                    <div class="form-group">
                                        <label for="stone_weight">Stone Wt</label>
                                        <input type="text" name="line_items_data[stone_weight]" class="form-control" id="stone_weight" placeholder="" value="" data-index="22">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_stone_charges d-none">
                                    <div class="form-group">
                                        <label for="stone_charges" style="font-size: 14px;">Stone Charges</label>
                                        <input type="text" name="line_items_data[stone_charges]" class="form-control" id="stone_charges" placeholder="" value="" data-index="23">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_moti prf_moti d-none">
                                    <div class="form-group">
                                        <label for="moti"><a href="javascript:void(0)" id="moti_details" class="" style="">Moti</a></label>
                                        <input type="text" name="line_items_data[moti]" class="form-control" id="moti" placeholder="" value="" data-index="24">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field pif_moti_amount prf_moti_amount d-none">
                                    <div class="form-group">
                                        <label for="moti_amount">Moti Amount</label>
                                        <input type="text" name="line_items_data[moti_amount]" class="form-control" id="moti_amount" placeholder="" value="" data-index="25">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_other_charges d-none">
                                    <div class="form-group">
                                        <label for="other_charges"><a href="javascript:void(0)" id="other_charges_details" class="" style="margin: 0; font-size: 14px;">Other Charges</a></label>
                                        <input type="text" name="line_items_data[other_charges]" class="form-control" id="other_charges" placeholder="" value="" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_loss d-none">
                                    <div class="form-group">
                                        <label for="loss"> Loss</label>
                                        <input type="text" name="line_items_data[loss]" id="loss" class="form-control num_only" data-index="26">
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0 dynamic_field prf_loss_fine d-none">
                                    <div class="form-group">
                                        <label for="loss_fine"> Loss Fine</label>
                                        <input type="text" name="line_items_data[loss_fine]" id="loss_fine" class="form-control num_only" data-index="27">
                                    </div>
                                </div>
<!--                                <div class="col-md-3 pr-0 dynamic_field prf_allowed_loss d-none">
                                    <div class="form-group">
                                        <label for="loss_fine"> Allowed Loss</label><br>
                                        <span id="process_on_how_much"></span> - <span id="process_allowed_loss"></span>
                                    </div>
                                </div>-->
                                <div class="col-md-2 pr-0">
                                    <div class="form-group">
                                        <label for="item_remark"> Remark</label>
                                        <textarea name="line_items_data[item_remark]" id="item_remark" class="form-control" data-index="28"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-1 pr-0">
                                    <label for="file_upload">Image</label>
                                    <input type="file" name="line_items_data[file_upload]" id="file_upload" class="from-control" onchange="upload_file_upload(this);" accept="image/*" value="" style="width: 90px;">
                                    <input type="hidden" name="line_items_data[image]" id="image" class="from-control">
                                </div>
                                <div class="col-md-12">
                                    <button type="button" id="add_lineitem" class="btn btn-info add_lineitem float-right" data-index="29">Add</button>
                                </div>
                            </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h4 style="text-align: center">Receive Table</h4>
                                    <div class="table-responsive">
                                        <table style="border-color: #dee2e6;" class="table custom-table item-table receive_table" border = '1'>
                                            <thead>
                                                <tr>
                                                    <th class="r_columns" width="100px">Action</th>
                                                    <th class="r_columns c_receive_type text-nowrap">Type</th>
                                                    <th class="r_columns text-nowrap">Date</th>
                                                    <th class="r_columns c_receive_person">Person</th>
                                                    <th class="r_columns c_receive_item">Item</th>
                                                    <th class="r_columns text-right">Gross</th>
                                                    <th class="r_columns text-right">Touch</th>
                                                    <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none">Wastage</th>
                                                    <th class="r_columns text-right">Fine</th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none">Ad Weight</th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none">Ad Pcs</th>
                                                    <th class="r_columns text-right dynamic_column prf_before_meena d-none">Before Meena</th>
                                                    <th class="r_columns text-right dynamic_column prf_meena_wt d-none">Meena Wt</th>
                                                    <th class="r_columns text-right dynamic_column prf_item_weight d-none">Item Weight</th>
                                                    <th class="r_columns text-right dynamic_column prf_kundan d-none">Kundan</th>
                                                    <th class="r_columns text-right dynamic_column prf_sm d-none">SM</th>
                                                    <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none">Vetran</th>
                                                    <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none">V Pcs</th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none">Stone Pcs</th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none">Stone Wt</th>
                                                    <th class="r_columns text-right dynamic_column prf_stone_charges d-none">Stone Charges</th>
                                                    <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none">Moti</th>
                                                    <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none">Moti Amount</th>
                                                    <th class="r_columns text-right dynamic_column prf_other_charges d-none">Other Charges</th>
                                                    <th class="r_columns text-right dynamic_column prf_loss d-none">Loss</th>
                                                    <th class="r_columns text-right dynamic_column prf_loss_fine d-none">Loss Fine</th>
                                                    <th class="r_columns">Remark</th>
                                                    <th class="r_columns">Image</th>
                                                </tr>
                                            </thead>
                                            <tbody id="receive_lineitem_list"></tbody>
                                            <tfoot>
                                                <tr class="s_rows r_receive_total_finish">
                                                    <th class="r_columns" colspan="3">Total Finish</th>
                                                    <th class="r_columns c_receive_person"></th>
                                                    <th class="r_columns c_receive_item"></th>
                                                    <th class="r_columns text-right" id="total_receive_finish_gross"></th>
                                                    <th class="r_columns  text-right" id="total_receive_finish_touch"></th>
                                                    <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_finish_wastage_noneed"></th>
                                                    <th class="r_columns  text-right" id="total_receive_finish_fine"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_finish_ad_weight"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_finish_ad_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_finish_before_meena"></th>
                                                    <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_finish_meena_wt"></th>
                                                    <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_finish_item_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_finish_kundan"></th>
                                                    <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_finish_sm"></th>
                                                    <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_finish_vetran"></th>
                                                    <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_finish_v_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_finish_stone_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_finish_stone_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_finish_stone_charges"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_finish_moti"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_finish_moti_amount"></th>
                                                    <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_finish_other_charges"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_finish_loss"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_finish_loss_fine"></th>
                                                    <th class="r_columns"></th>
                                                    <th class="r_columns"></th>
                                                </tr>
                                                <tr class="s_rows r_receive_total_scrap">
                                                    <th class="r_columns" colspan="3">Total Scrap</th>
                                                    <th class="r_columns c_receive_person"></th>
                                                    <th class="r_columns c_receive_item"></th>
                                                    <th class="r_columns text-right" id="total_receive_scrap_gross"></th>
                                                    <th class="r_columns text-right" id="total_receive_scrap_touch"></th>
                                                    <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_scrap_wastage_noneed"></th>
                                                    <th class="r_columns text-right" id="total_receive_scrap_fine"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_scrap_ad_weight"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_scrap_ad_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_scrap_before_meena"></th>
                                                    <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_scrap_meena_wt"></th>
                                                    <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_scrap_item_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_scrap_kundan"></th>
                                                    <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_scrap_sm"></th>
                                                    <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_scrap_vetran"></th>
                                                    <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_scrap_v_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_scrap_stone_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_scrap_stone_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_scrap_stone_charges"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_scrap_moti"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_scrap_moti_amount"></th>
                                                    <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_scrap_other_charges"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_scrap_loss"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_scrap_loss_fine"></th>
                                                    <th class="r_columns"></th>
                                                    <th class="r_columns"></th>
                                                </tr>
                                                <tr class="s_rows r_receive_total">
                                                    <th class="r_columns" colspan="3">Total Receive</th>
                                                    <th class="r_columns c_receive_person"></th>
                                                    <th class="r_columns c_receive_item"></th>
                                                    <th class="r_columns text-right" id="total_receive_gross"></th>
                                                    <th class="r_columns text-right" id="total_receive_touch"></th>
                                                    <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_wastage_noneed"></th>
                                                    <th class="r_columns text-right" id="total_receive_fine"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_ad_weight"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_ad_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_before_meena"></th>
                                                    <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_meena_wt"></th>
                                                    <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_item_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_kundan"></th>
                                                    <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_sm"></th>
                                                    <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_vetran"></th>
                                                    <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_v_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_stone_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_stone_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_stone_charges"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_moti"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_moti_amount"></th>
                                                    <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_other_charges"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_loss"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_loss_fine"></th>
                                                    <th class="r_columns"></th>
                                                    <th class="r_columns"></th>
                                                </tr>
                                                <tr class="balance_row bg-success">
                                                    <th colspan="3" class="r_columns row_label">Balance</th>
                                                    <th class="r_columns c_receive_person"></th>
                                                    <th class="r_columns c_receive_item"></th>
                                                    <th class="r_columns text-right" id="balance_gross"></th>
                                                    <th class="r_columns text-right" id="balance_touch_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="balance_wastage_noneed"></th>
                                                    <th class="r_columns text-right" id="balance_fine"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="balance_ad_weight"></th>
                                                    <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="balance_ad_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="balance_before_meena_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="balance_meena_wt_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="balance_item_weight_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_kundan d-none" id="balance_kundan_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_sm d-none" id="balance_sm_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="balance_vetran"></th>
                                                    <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="balance_v_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="balance_stone_pcs"></th>
                                                    <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="balance_stone_weight"></th>
                                                    <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="balance_stone_charges_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="balance_moti"></th>
                                                    <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="balance_moti_amount"></th>
                                                    <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="balance_other_charges_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss d-none" id="balance_loss_noneed"></th>
                                                    <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="balance_loss_fine_noneed"></th>
                                                    <th class="r_columns"></th>
                                                    <th class="r_columns"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h4 style="text-align: center">Issue Table</h4>
                                    <div class="table-responsive">
                                        <table style="border-color: #dee2e6;" class="table custom-table item-table issue_table" border='1'>
                                            <thead>
                                                <tr>
                                                    <th class="i_columns" width="100px">Action</th>
                                                    <th class="i_columns c_issue_type text-nowrap">Type</th>
                                                    <th class="i_columns text-nowrap">Date</th>
                                                    <th class="i_columns c_issue_person">Person</th>
                                                    <th class="i_columns c_issue_item">Item</th>
                                                    <th class="i_columns text-right">Gross</th>
                                                    <th class="i_columns text-right">Touch</th>
                                                    <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none">Wastage</th>
                                                    <th class="i_columns text-right">Fine</th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none">Ad Weight</th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none">Ad Pcs</th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none">Before Meena</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none">Meena Wt</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none">Item Weight</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_kundan d-none">Kundan</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_sm d-none">SM</th>-->
                                                    <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none">Vetran</th>
                                                    <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none">V Pcs</th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none">Stone Pcs</th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none">Stone Wt</th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none">Stone Charges</th>-->
                                                    <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none">Moti</th>
                                                    <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none">Moti Amount</th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_other_charges d-none">Other Charges</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss d-none">Loss</th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss_fine d-none">Loss Fine</th>-->
                                                    <th class="i_columns">Remark</th>
                                                    <th class="i_columns">Image</th>
                                                </tr>
                                            </thead>
                                            <tbody id="issue_lineitem_list"></tbody>
                                            <tfoot>
                                                <tr class="i_rows r_issue_total_finish">
                                                    <th class="i_columns" colspan="3">Total Finish</th>
                                                    <th class="i_columns c_issue_person"></th>
                                                    <th class="i_columns c_issue_item"></th>
                                                    <th class="i_columns text-right" id="total_issue_finish_gross"></th>
                                                    <th class="i_columns text-right" id="total_issue_finish_touch"></th>
                                                    <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_finish_wastage_noneed"></th>
                                                    <th class="i_columns text-right" id="total_issue_finish_fine"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_finish_ad_weight"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_finish_ad_pcs"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_finish_before_meena"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_finish_meena_wt"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_finish_item_weight"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_finish_kundan"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_finish_sm"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_finish_vetran"></th>
                                                    <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_finish_v_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_finish_stone_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_finish_stone_weight"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_finish_stone_charges"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_finish_moti"></th>
                                                    <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_finish_moti_amount"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_other_charges d-none" id="total_issue_finish_other_charges"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss d-none" id="total_issue_finish_loss"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss_fine d-none" id="total_issue_finish_loss_fine"></th>-->
                                                    <th class="i_columns "></th>
                                                    <th class="i_columns "></th>
                                                </tr>
                                                <tr class="i_rows r_issue_total_scrap">
                                                    <th class="i_columns" colspan="3">Total Scrap</th>
                                                    <th class="i_columns c_issue_person"></th>
                                                    <th class="i_columns c_issue_item"></th>
                                                    <th class="i_columns text-right" id="total_issue_scrap_gross"></th>
                                                    <th class="i_columns text-right" id="total_issue_scrap_touch"></th>
                                                    <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_scrap_wastage_noneed"></th>
                                                    <th class="i_columns text-right" id="total_issue_scrap_fine"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_scrap_ad_weight"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_scrap_ad_pcs"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_scrap_before_meena"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_scrap_meena_wt"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_scrap_item_weight"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_scrap_kundan"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_scrap_sm"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_scrap_vetran"></th>
                                                    <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_scrap_v_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_scrap_stone_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_scrap_stone_weight"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_scrap_stone_charges"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_scrap_moti"></th>
                                                    <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_scrap_moti_amount"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_other_charges d-none" id="total_issue_scrap_other_charges"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss d-none" id="total_issue_scrap_loss"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss_fine d-none" id="total_issue_scrap_loss_fine"></th>-->
                                                    <th class="i_columns"></th>
                                                    <th class="i_columns"></th>
                                                </tr>
                                                <tr class="i_rows r_issue_total">
                                                    <th class="i_columns" colspan="3">Total Issue</th>
                                                    <th class="i_columns c_issue_person"></th>
                                                    <th class="i_columns c_issue_item"></th>
                                                    <th class="i_columns text-right" id="total_issue_gross"></th>
                                                    <th class="i_columns text-right" id="total_issue_touch"></th>
                                                    <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_wastage_noneed"></th>
                                                    <th class="i_columns text-right" id="total_issue_fine"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_ad_weight"></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_ad_pcs"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_before_meena"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_meena_wt"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_item_weight"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_kundan"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_sm"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_vetran"></th>
                                                    <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_v_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_stone_pcs"></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_stone_weight"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_stone_charges"></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_moti"></th>
                                                    <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_moti_amount"></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_other_charges d-none" id="total_issue_other_charges"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss d-none" id="total_issue_loss"></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss_fine d-none" id="total_issue_loss_fine"></th>-->
                                                    <th class="i_columns"></th>
                                                    <th class="i_columns"></th>
                                                </tr>
                                                <tr class="i_rows r_issue_total">
                                                    <th class="i_columns" colspan="3">Total I Gross + AD</th>
                                                    <th class="i_columns c_issue_person"></th>
                                                    <th class="i_columns c_issue_item"></th>
                                                    <th class="i_columns text-right" id="total_i_gross_plus_ad"></th>
                                                    <th class="i_columns text-right" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id=""></th>
                                                    <th class="i_columns text-right" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id=""></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id=""></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id=""></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id=""></th>-->
                                                    <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id=""></th>
                                                    <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id=""></th>
                                                    <!--<th class="i_columns text-right dynamic_column prf_other_charges d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss d-none" id=""></th>-->
                                                    <!--<th class="i_columns text-right dynamic_column prf_loss_fine d-none" id=""></th>-->
                                                    <th class="i_columns"></th>
                                                    <th class="i_columns"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row vetran_details d-none">
                                <div class="col-sm-3 pr-0">
                                    <label for="total_issue_vetran_item_gross" style="font-size: 12px;">Vetran Item Issue Total : <span id="total_issue_vetran_item_gross" style="font-weight: 500;"></span></label>
                                </div>
                                <div class="col-sm-3 pr-0">
                                    <label for="total_receive_vetran_item_gross" style="font-size: 12px;">Vetran Item Receive Total : <span id="total_receive_vetran_item_gross" style="font-weight: 500;"></span></label>
                                </div>
                                <div class="col-sm-6 pr-0"></div>
                                <div class="col-sm-3 pr-0">
                                    <label for="used_vetran" style="font-size: 12px;">Used Vetran : <span id="used_vetran" style="font-weight: 500;"></span></label>
                                </div>
                                <div class="col-sm-3 pr-0">
                                    <label for="used_moti" style="font-size: 12px;">Used Moti : <span id="used_moti" style="font-weight: 500;"></span></label>
                                </div>
                                <div class="col-sm-6 pr-0"></div>
                                <div class="col-sm-6 bg-success">
                                    <label for="bandhanu_issue" style="font-size: 14px; padding-right: 5px; border-right: 1px solid #fff;">
                                        Bandhanu Issue: <span id="bandhanu_issue"></span>
                                        <br><small>( `Bandhanu Issue` : Used Moti + Ifw Gross + Is Gross) </small>
                                    </label>
                                    <label for="bandhanu_receive" style="font-size: 14px;">
                                        Bandhanu Receive: <span id="bandhanu_receive"></span>
                                        <br><small>( `Bandhanu Receive` : RFW Gross + Rs Gross)</small>
                                    </label>
                                </div>
                                <div class="col-sm-6 pr-0"></div>
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-6 bg-success">
                                    <label for="balance_bandhanu" style="font-size: 14px;">Balance Bandhanu : <span id="balance_bandhanu"></span></label>
                                    <br><small>( `Balance Bandhanu` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran )</small>
                                </div>
                            </div>
                            <div class="row loss_details d-none">
                                <div class="col-sm-1 pr-0">
                                    <div class="form-group">
                                        <label for="loss_allowed" style="font-size: 12px;"> Loss Allowed</label>
                                        <input type="text" name="loss_allowed" id="loss_allowed" class="form-control num_only">
                                    </div>
                                </div>
                                <div class="col-sm-1 pr-0">
                                    <div class="form-group">
                                        <label for="loss_allowed" style="font-size: 12px;"> Allowed</label>
                                        <input type="text" name="allowed" id="allowed" class="form-control num_only" disabled="">
                                    </div>
                                </div>
                                <div class="col-sm-1 pr-0">
                                    <div class="form-group">
                                        <label for="actual_loss" style="font-size: 12px;"> Actual Loss</label>
                                        <input type="text" name="actual_loss" id="actual_loss" class="form-control num_only" disabled="">
                                    </div>
                                </div>
                                <div class="col-sm-3 pr-0">
                                    <div class="form-group">
                                        <label for="loss_receivable_payable" style="font-size: 12px;"> Loss Receivable / Payable</label><br>
                                        <span id="loss_receivable_payable"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="module_submit_btn" class="btn btn-info float-right <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'd-none' : ''; ?> ">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="gross_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Gross Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="gross_details_form">
                                    <input type="hidden" name="gross_details_index" id="gross_details_index" />
                                    <?php if(isset($gross_details_data) && !empty($gross_details_data)){ ?>
                                        <input type="hidden" name="gross_details_data[gross_details_id]" id="gross_details_id" />
                                    <?php } ?>
                                    <div class="col-md-4 pr-0">
                                        <label for="gross_detail_item_id">Item<span class="required-sign">&nbsp;*</span></label>
                                        <select name="gross_details_data[gross_detail_item_id]" class="form-control" id="gross_detail_item_id"></select>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="gross_detail_weight">Weight</label>
                                        <input type="text" name="gross_details_data[gross_detail_weight]" class="form-control num_only" id="gross_detail_weight" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_gross_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Item</th>
                                            <th class="text-right">Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gross_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th></th>
                                            <th class="text-right" id="total_gross_details_weight"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="stone_pcs_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Stone Pcs Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stone_pcs_details_form">
                                    <input type="hidden" name="stone_pcs_details_index" id="stone_pcs_details_index" />
                                    <?php if(isset($stone_pcs_details_data) && !empty($stone_pcs_details_data)){ ?>
                                        <input type="hidden" name="stone_pcs_details_data[stone_pcs_details_id]" id="stone_pcs_details_id" />
                                    <?php } ?>
                                    <div class="col-md-2 pr-0">
                                        <label for="stone_detail_pcs">Pcs<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="stone_pcs_details_data[stone_detail_pcs]" class="form-control num_only" id="stone_detail_pcs" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="stone_detail_weight">Weight</label>
                                        <input type="text" name="stone_pcs_details_data[stone_detail_weight]" class="form-control num_only" id="stone_detail_weight" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="stone_detail_rate">Rate</label>
                                        <input type="text" name="stone_pcs_details_data[stone_detail_rate]" class="form-control num_only" id="stone_detail_rate" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="stone_detail_amount">Amount</label>
                                        <input type="text" name="stone_pcs_details_data[stone_detail_amount]" class="form-control num_only" id="stone_detail_amount" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_stone_pcs_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Pcs</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stone_pcs_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th class="text-right" id="total_stone_pcs_details_pcs"></th>
                                            <th class="text-right" id="total_stone_pcs_details_weight"></th>
                                            <th></th>
                                            <th class="text-right" id="total_stone_pcs_details_amount"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="moti_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Moti Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="moti_details_form">
                                    <input type="hidden" name="moti_details_index" id="moti_details_index" />
                                    <?php if(isset($moti_details_data) && !empty($moti_details_data)){ ?>
                                        <input type="hidden" name="moti_details_data[moti_details_id]" id="moti_details_id" />
                                    <?php } ?>
                                    <div class="col-md-4 pr-0">
                                        <label for="moti_id">Moti<span class="required-sign">&nbsp;*</span></label>
                                        <select name="moti_details_data[moti_id]" class="form-control moti_id" id="moti_id"></select>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_weight">Weight<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_weight]" class="form-control num_only" id="moti_weight" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_rate">Rate Per Ct<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_rate]" class="form-control num_only" id="moti_rate" >
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="moti_detail_amount">Amount<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="moti_details_data[moti_detail_amount]" class="form-control num_only" id="moti_detail_amount" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_moti_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Moti</th>
                                            <th class="text-right">Weight</th>
                                            <th class="text-right">Rate Per Ct</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="moti_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th></th>
                                            <th class="text-right" id="total_moti_details_weight"></th>
                                            <th></th>
                                            <th class="text-right" id="total_moti_details_amount"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="other_charges_details_model" class="modal fade myModelClose" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#f1e8e1;">
                    <div class="modal-header">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="myModalLabel">Other Charges Details</h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body edit-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="other_charges_details_form">
                                    <input type="hidden" name="other_charges_details_index" id="other_charges_details_index" />
                                    <?php if(isset($other_charges_details_data) && !empty($other_charges_details_data)){ ?>
                                        <input type="hidden" name="other_charges_details_data[other_charges_details_id]" id="other_charges_details_id" />
                                    <?php } ?>
                                    <div class="col-md-4 pr-0">
                                        <label for="charges_id">Charges For<span class="required-sign">&nbsp;*</span></label>
                                        <select name="other_charges_details_data[charges_id]" class="form-control charges_id" id="charges_id"></select>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="charges_amount">Amount<span class="required-sign">&nbsp;*</span></label>
                                        <input type="text" name="other_charges_details_data[charges_amount]" class="form-control num_only" id="charges_amount" >
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <input type="button" id="add_other_charges_details" class="btn btn-info btn-sm" value="Add Line" style="margin-top: 21px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive"><br>
                                <table style="" class="table custom-table item-table">
                                    <thead>
                                        <tr>
                                            <th width="80px">Action</th>
                                            <th>Charges For</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="other_charges_details_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total:</th>
                                            <th></th>
                                            <th class="text-right" id="total_other_charges_details_amount"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="viewImageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 99999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body edit-content text-center">
                        <img id="doc_img_src" alt="No Image Found" class="img-responsive" width='300px'>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    $('#body-content').on('change keyup keydown click', 'input, textarea, select', function (e) {
        $(this).addClass('changed-input');
    });
    $(window).on('beforeunload', function () {
        if ($('.changed-input').length) {
            return 'Are you sure you want to leave?';
        }
    });

    var edit_gross_details_inc = 0;
    var edit_stone_pcs_details_inc = 0;
    var edit_moti_details_inc = 0;
    var edit_other_charges_details_inc = 0;

    var lineitem_objectdata = [];
    var gross_details_objectdata = [];
    var stone_pcs_details_objectdata = [];
    var moti_details_objectdata = [];
    var other_charges_details_objectdata = [];
    var process_dynamic_issue_columns = [];
    var process_dynamic_receive_columns = [];
    var process_dynamic_fields = [];
//    var process_on_how_much = 0;
//    var process_allowed_loss = 0;

    var process_columns = [];
    var tmp_process_id = 0;

    var total_issue_finish_gross = 0;
    var total_issue_scrap_gross = 0;
    var total_issue_gross = 0;
    var total_receive_finish_gross = 0;
    var total_receive_scrap_gross = 0;
    var total_receive_gross = 0;

    var total_issue_finish_touch = 0;
    var total_issue_scrap_touch = 0;
    var total_issue_touch = 0;
    var total_receive_finish_touch = 0;
    var total_receive_scrap_touch = 0;
    var total_receive_touch = 0;

    var total_issue_finish_wastage = 0;
    var total_issue_scrap_wastage = 0;
    var total_issue_wastage = 0;
    var total_receive_finish_wastage = 0;
    var total_receive_scrap_wastage = 0;
    var total_receive_wastage = 0;

    var total_issue_finish_fine = 0;
    var total_issue_scrap_fine = 0;
    var total_issue_fine = 0;
    var total_receive_finish_fine = 0;
    var total_receive_scrap_fine = 0;
    var total_receive_fine = 0;

    var total_issue_finish_ad_weight = 0;
    var total_issue_scrap_ad_weight = 0;
    var total_issue_ad_weight = 0;
    var total_receive_finish_ad_weight = 0;
    var total_receive_scrap_ad_weight = 0;
    var total_receive_ad_weight = 0;

    var total_issue_finish_ad_pcs = 0;
    var total_issue_scrap_ad_pcs = 0;
    var total_issue_ad_pcs = 0;
    var total_receive_finish_ad_pcs = 0;
    var total_receive_scrap_ad_pcs = 0;
    var total_receive_ad_pcs = 0;

    var total_issue_finish_before_meena = 0;
    var total_issue_scrap_before_meena = 0;
    var total_issue_before_meena = 0;
    var total_receive_finish_before_meena = 0;
    var total_receive_scrap_before_meena = 0;
    var total_receive_before_meena = 0;

    var total_issue_finish_meena_wt = 0;
    var total_issue_scrap_meena_wt = 0;
    var total_issue_meena_wt = 0;
    var total_receive_finish_meena_wt = 0;
    var total_receive_scrap_meena_wt = 0;
    var total_receive_meena_wt = 0;

    var total_issue_finish_item_weight = 0;
    var total_issue_scrap_item_weight = 0;
    var total_issue_item_weight = 0;
    var total_receive_finish_item_weight = 0;
    var total_receive_scrap_item_weight = 0;
    var total_receive_item_weight = 0;

    var total_issue_finish_kundan = 0;
    var total_issue_scrap_kundan = 0;
    var total_issue_kundan = 0;
    var total_receive_finish_kundan = 0;
    var total_receive_scrap_kundan = 0;
    var total_receive_kundan = 0;

    var total_issue_finish_sm = 0;
    var total_issue_scrap_sm = 0;
    var total_issue_sm = 0;
    var total_receive_finish_sm = 0;
    var total_receive_scrap_sm = 0;
    var total_receive_sm = 0;

    var total_issue_finish_vetran = 0;
    var total_issue_scrap_vetran = 0;
    var total_issue_vetran = 0;
    var total_receive_finish_vetran = 0;
    var total_receive_scrap_vetran = 0;
    var total_receive_vetran = 0;

    var total_issue_finish_v_pcs = 0;
    var total_issue_scrap_v_pcs = 0;
    var total_issue_v_pcs = 0;
    var total_receive_finish_v_pcs = 0;
    var total_receive_scrap_v_pcs = 0;
    var total_receive_v_pcs = 0;

    var total_issue_finish_stone_pcs = 0;
    var total_issue_scrap_stone_pcs = 0;
    var total_issue_stone_pcs = 0;
    var total_receive_finish_stone_pcs = 0;
    var total_receive_scrap_stone_pcs = 0;
    var total_receive_stone_pcs = 0;

    var total_issue_finish_stone_weight = 0;
    var total_issue_scrap_stone_weight = 0;
    var total_issue_stone_weight = 0;
    var total_receive_finish_stone_weight = 0;
    var total_receive_scrap_stone_weight = 0;
    var total_receive_stone_weight = 0;

    var total_issue_finish_stone_charges = 0;
    var total_issue_scrap_stone_charges = 0;
    var total_issue_stone_charges = 0;
    var total_receive_finish_stone_charges = 0;
    var total_receive_scrap_stone_charges = 0;
    var total_receive_stone_charges = 0;

    var total_issue_finish_moti = 0;
    var total_issue_scrap_moti = 0;
    var total_issue_moti = 0;
    var total_receive_finish_moti = 0;
    var total_receive_scrap_moti = 0;
    var total_receive_moti = 0;

    var total_issue_finish_moti_amount = 0;
    var total_issue_scrap_moti_amount = 0;
    var total_issue_moti_amount = 0;
    var total_receive_finish_moti_amount = 0;
    var total_receive_scrap_moti_amount = 0;
    var total_receive_moti_amount = 0;

    var total_issue_finish_other_charges = 0;
    var total_issue_scrap_other_charges = 0;
    var total_issue_other_charges = 0;
    var total_receive_finish_other_charges = 0;
    var total_receive_scrap_other_charges = 0;
    var total_receive_other_charges = 0;

    var total_issue_finish_loss = 0;
    var total_issue_scrap_loss = 0;
    var total_issue_loss = 0;
    var total_receive_finish_loss = 0;
    var total_receive_scrap_loss = 0;
    var total_receive_loss = 0;

    var total_issue_finish_loss_fine = 0;
    var total_issue_scrap_loss_fine = 0;
    var total_issue_loss_fine = 0;
    var total_receive_finish_loss_fine = 0;
    var total_receive_scrap_loss_fine = 0;
    var total_receive_loss_fine = 0;

    var balance_gross = 0;
    var balance_touch = 0;
    var balance_wastage = 0;
    var balance_fine = 0;
    var balance_ad_weight = 0;
    var balance_ad_pcs = 0;
    var balance_before_meena = 0;
    var balance_meena_wt = 0;
    var balance_item_weight = 0;
    var balance_kundan = 0;
    var balance_sm = 0;
    var balance_vetran = 0;
    var balance_v_pcs = 0;
    var balance_stone_pcs = 0;
    var balance_stone_weight = 0;
    var balance_stone_charges = 0;
    var balance_moti = 0;
    var balance_moti_amount = 0;
    var balance_other_charges = 0;
    var balance_loss = 0;
    var balance_loss_fine = 0;

    var total_issue_vetran_item_gross = 0;
    var total_receive_vetran_item_gross = 0;
    var used_vetran = 0;
    var used_moti = 0;
    var bandhanu_issue = 0;
    var bandhanu_receive = 0;
    var balance_bandhanu = 0;

    var rfw_firstline_job_worker_id = '';
    var rfw_firstline_job_worker_um_on = 0;
    var process_id = '';
    $(document).ready(function(){
        
        $('.select2').select2();
        
        $('#ir_date').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });

        <?php if (isset($lineitem_objectdata)) { ?>
        var li_lineitem_objectdata = <?php echo $lineitem_objectdata; ?>;
        if (li_lineitem_objectdata != '') {
            $.each(li_lineitem_objectdata, function (index, value) {
                lineitem_objectdata.push(value);
            });
        }
        <?php } ?>
            
        $('form').on('keydown', 'input,select', function (event) {
            if (event.which === 13) {
                event.preventDefault();
                if($(this).hasClass('add_lineitem')){
                    $(this).click();
                    $('#type_id').select2('open');
                } else {
                    event.preventDefault();
//                    var $this = $(event.target);
//                    var index = parseFloat($this.attr('data-index'));
//                    $('[data-index="' + (index + 1).toString() + '"]').focus();
                    var $canfocus = $(':focusable');
                    var index = $canfocus.index(this) + 1;
                    if (index >= $canfocus.length) index = 0;
                    $canfocus.eq(index).focus();
                }
            }
        });

        initAjaxSelect2($("#job_card_id"), "<?= base_url('app/job_card_select2_source') ?>");
        <?php if(isset($manufacture_row->job_card_id)){ ?>
            setSelect2Value($("#job_card_id"),"<?=base_url('app/set_job_card_select2_val_by_id/'.$manufacture_row->job_card_id)?>");
            set_jon_card_detail();
        <?php } else { ?>
            $('#job_card_id').select2('open');
        <?php }  ?>
        $(document).on('change','#job_card_id',function(){
            set_jon_card_detail();
        });

        initAjaxSelect2($("#process_id"), "<?= base_url('app/process_select2_source') ?>");
        <?php if(isset($manufacture_row->process_id)){ ?>
            setSelect2Value($("#process_id"),"<?=base_url('app/set_process_select2_val_by_id/'.$manufacture_row->process_id)?>");
        <?php }  ?>

        <?php if(isset($manufacture_row->process_id)){ ?>
//            get_process_columns();
        <?php }  ?>
        $(document).on('change','#process_id, #after_disabled_process_id',function(){
            $("#type_id").val(null).trigger("change");
            $('.dynamic_column').addClass('d-none');
            <?php if(isset($manufacture_row->process_id)){ ?>
                process_id = $("#after_disabled_process_id").val();
            <?php } else { ?>
                process_id = $("#process_id").val();
            <?php } ?>
            if(process_id != '') {
                var ajaxUrl = "<?php echo base_url('app/') ?>";
                ajaxUrl += 'get_process_issue_receive_fields/';
                ajaxUrl += process_id;
                $.ajax({
                    url: ajaxUrl,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    async: false,
                    success: function (resdata) {
//                        var process_dynamic_columns = $.parseJSON(resdata);
                        var process_dynamic_columns = resdata;
                        process_dynamic_issue_columns = process_dynamic_columns.selected_process_issue_fields;
                        process_dynamic_receive_columns = process_dynamic_columns.selected_process_receive_fields;
//                        process_on_how_much = process_dynamic_columns.process_on_how_much;
//                        $('#process_on_how_much').html(process_on_how_much);
//                        process_allowed_loss = process_dynamic_columns.process_allowed_loss;
//                        $('#process_allowed_loss').html(process_allowed_loss);
                        process_dynamic_columns_fun();
                    }
                });
            }
            $('.vetran_details').addClass('d-none');
            if(process_id == '<?php echo BANDHANU_PROCESS_ID; ?>') {
                $('.vetran_details').removeClass('d-none');
            }
            $('.loss_details').addClass('d-none');
            if(process_id == '<?php echo POLISH_PROCESS_ID; ?>' || process_id == '<?php echo SETTINGS_PROCESS_ID; ?>' || process_id == '<?php echo MEENA_PROCESS_ID; ?>') {
                $('.loss_details').removeClass('d-none');
            }
//            get_process_columns();
        });

        $("#type_id").select2({width:'100%'});
        initAjaxSelect2($("#item_id"), "<?= base_url('app/item_select2_source') ?>");
        initAjaxSelect2($("#job_worker_id"), "<?= base_url('app/job_worker_select2_source') ?>");

        $(document).on('change','#type_id',function () {
            var type_id = $("#type_id").val();
            $('.dynamic_field').addClass('d-none');
            if(type_id != '') {
                var process_id = $("#process_id").val();
                if(process_id == '' || process_id == null) {
                    show_notify('Please select Process', false);
                    $("#process_id").select2('open');
                    $("#type_id").val(null).trigger("change");
                    return false;
                }
                var ajaxUrl = "<?php echo base_url('app/') ?>";
                if(type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_FINISH_ID; ?>' || type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_SCRAP_ID; ?>') {
                    ajaxUrl += 'get_process_issue_fields/';
                } else {
                    ajaxUrl += 'get_process_receive_fields/';
                }
                ajaxUrl += process_id + '/' + type_id;
                $.ajax({
                    url: ajaxUrl,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    async: false,
                    success: function (resdata) {
                        process_dynamic_fields = resdata;
                        process_dynamic_fields_fun();
                    }
                });
            }
        });

        $(document).on('change','#job_worker_id',function () {
            var job_worker_id = $("#job_worker_id").val();
            $("#wastage").val('');
            $(".person_current_details").addClass('d-none');
            $("#person_current_fine").html('');
            $("#person_current_amount").html('');
            if(job_worker_id != '') {
                $.ajax({
                    url: "<?= base_url('app/get_job_worker_detail/') ?>" + job_worker_id,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'success') {
                            var edit_manufacture_ir_id = $("#manufacture_ir_id").val();
                            if (typeof (edit_manufacture_ir_id) !== "undefined" && edit_manufacture_ir_id !== null && edit_manufacture_ir_id != 0) { } else {
                                $("#wastage").val(response.wastage_loss_allowed);
                            }
                            $(".person_current_details").removeClass('d-none');
                            $("#person_current_fine").html(response.current_fine);
                            $("#person_current_amount").html(response.current_amount);
                        }
                    }
                });
            }
        });

        $(document).on('input','#gross, #touch, #wastage, #before_meena, #item_weight, #kundan',function () {
            var gross = parseFloat($("#gross").val()) || 0;
            var touch = parseFloat($("#touch").val()) || 0;
            var wastage = parseFloat($("#wastage").val()) || 0;
            var fine = (parseFloat(gross) * (parseFloat(touch) + parseFloat(wastage))) / 100;
            fine = setRoundOf(fine, 2).toFixed(3);
            $("#fine").val(fine);

            <?php if(isset($manufacture_row->process_id)){ ?>
                var process_id = $("#after_disabled_process_id").val();
            <?php } else { ?>
                var process_id = $("#process_id").val();
            <?php } ?>
            if(process_id == '<?php echo JADTAR_PROCESS_ID; ?>' || process_id == '<?php echo BANDHANU_PROCESS_ID; ?>'){
                $("#fine").val(0);
            }
            var type_id = $("#type_id").val();
            if(type_id != '' || process_id != '') {
                if(type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_FINISH_ID; ?>'){
                    var before_meena = parseFloat($("#before_meena").val()) || 0;
                    var meena_wt = parseFloat(gross) - parseFloat(before_meena);
                    meena_wt = setRoundOf(meena_wt, 2).toFixed(3);
                    $("#meena_wt").val(meena_wt);
                }
            }

            var item_weight = parseFloat($("#item_weight").val()) || 0;
            var kundan = parseFloat($("#kundan").val()) || 0;
            var sm = parseFloat(gross) - parseFloat(item_weight) - parseFloat(kundan);
            sm = setRoundOf(sm, 2).toFixed(3);
            $("#sm").val(sm);
        });

        $(document).on('click', '#gross_details', function () {
            initAjaxSelect2($("#gross_detail_item_id"), "<?= base_url('app/item_select2_source/') ?>");
            $('#gross_details_model').modal('show');
            setTimeout(function(){ $('#gross_detail_item_id').select2('open'); }, 200);
            display_gross_details_html(gross_details_objectdata);
        });
        $('#gross_details_model').on('hidden.bs.modal', function () {
            var total_gross_details_weight = $('#total_gross_details_weight').html() || 0;
            $('#gross').val(total_gross_details_weight).trigger("input");
            $('#gross').focus();
        });
        $(document).on('click', '#add_gross_details', function () {
            var gross_detail_item_id = $("#gross_detail_item_id").val();
            if (gross_detail_item_id == '' || gross_detail_item_id == null) {
                $("#gross_detail_item_id").select2('open');
                show_notify("Please select Item!", false);
                return false;
            }

            $("#add_gross_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var gross_details = {};
            $('input[name^="gross_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("gross_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                gross_details[key] = value;
            });
            gross_details['gross_detail_item_id'] = gross_detail_item_id;
            var gross_detail_item_data = $('#gross_detail_item_id option:selected').html();
            gross_details['item_name'] = gross_detail_item_data;
            var new_gross_details = JSON.parse(JSON.stringify(gross_details));
            gross_details_index = $("#gross_details_index").val();
            if (gross_details_index != '') {
                gross_details_objectdata.splice(gross_details_index, 1, new_gross_details);
            } else {
                gross_details_objectdata.push(new_gross_details);
            }
            display_gross_details_html(gross_details_objectdata);
            $("#gross_details_index").val('');
            gross_details_index = '';
            $('#gross_details_id').val('');
            $("#gross_detail_item_id").val(null).trigger("change");
            $('#gross_detail_weight').val('');
            edit_gross_details_inc = 0;
            $("#add_gross_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('click', '#stone_pcs_details', function () {
            $('#stone_pcs_details_model').modal('show');
            setTimeout(function(){ $('#stone_detail_pcs').focus(); }, 200);
            display_stone_pcs_details_html(stone_pcs_details_objectdata);
        });
        $('#stone_pcs_details_model').on('hidden.bs.modal', function () {
            var total_stone_pcs_details_pcs = $('#total_stone_pcs_details_pcs').html() || 0;
            var total_stone_pcs_details_weight = $('#total_stone_pcs_details_weight').html() || 0;
            var total_stone_pcs_details_amount = $('#total_stone_pcs_details_amount').html() || 0;
            $('#stone_pcs').val(total_stone_pcs_details_pcs).trigger("change");
            $('#stone_weight').val(total_stone_pcs_details_weight).trigger("change");
            $('#stone_charges').val(total_stone_pcs_details_amount).trigger("change");
            $('#stone_pcs').focus();
        });
        $(document).on('keyup change', '#stone_detail_pcs, #stone_detail_rate', function () {
            var stone_detail_pcs = $('#stone_detail_pcs').val() || 0;
            var stone_detail_rate = $('#stone_detail_rate').val() || 0;
            var stone_detail_amount = parseFloat(stone_detail_pcs) * parseFloat(stone_detail_rate);
            $('#stone_detail_amount').val(stone_detail_amount);
        });
        $(document).on('click', '#add_stone_pcs_details', function () {
            var stone_detail_pcs = $("#stone_detail_pcs").val();
            if (stone_detail_pcs == '' || stone_detail_pcs == null) {
                $("#stone_detail_pcs").focus();
                show_notify("Please Enter Pcs!", false);
                return false;
            }

            $("#add_stone_pcs_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var stone_pcs_details = {};
            $('input[name^="stone_pcs_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("stone_pcs_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                stone_pcs_details[key] = value;
            });

            var new_stone_pcs_details = JSON.parse(JSON.stringify(stone_pcs_details));
            stone_pcs_details_index = $("#stone_pcs_details_index").val();
            if (stone_pcs_details_index != '') {
                stone_pcs_details_objectdata.splice(stone_pcs_details_index, 1, new_stone_pcs_details);
            } else {
                stone_pcs_details_objectdata.push(new_stone_pcs_details);
            }
            display_stone_pcs_details_html(stone_pcs_details_objectdata);
            $("#stone_pcs_details_index").val('');
            stone_pcs_details_index = '';
            $('#stone_pcs_details_id').val('');
            $('#stone_detail_pcs').val('');
            $('#stone_detail_weight').val('');
            $('#stone_detail_rate').val('');
            $('#stone_detail_amount').val('');
            edit_stone_pcs_details_inc = 0;
            $("#add_stone_pcs_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('click', '#moti_details', function () {
            initAjaxSelect2($("#moti_id"), "<?= base_url('app/moti_select2_source/') ?>");
            $('#moti_details_model').modal('show');
            setTimeout(function(){ $('#moti_id').select2('open'); }, 200);
            display_moti_details_html(moti_details_objectdata);
        });
        $('#moti_details_model').on('hidden.bs.modal', function () {
            var total_moti_details_weight = $('#total_moti_details_weight').html() || 0;
            var total_moti_details_amount = $('#total_moti_details_amount').html() || 0;
            $('#moti').val(total_moti_details_weight).trigger("change");
            $('#moti_amount').val(total_moti_details_amount).trigger("change");
            $('#moti_detail_amount').val('');
            $('#moti').focus();
        });
        $(document).on('keyup change', '#moti_weight, #moti_rate', function () {
            var moti_weight = $('#moti_weight').val() || 0;
            var moti_rate = $('#moti_rate').val() || 0;
            var moti_detail_amount = parseFloat(moti_weight) * parseFloat(moti_rate) * <?php echo MOTI_WT_TO_CT_TO_AMOUNT; ?>;
            $('#moti_detail_amount').val(moti_detail_amount);
        });
        $(document).on('click', '#add_moti_details', function () {
            var moti_id = $("#moti_id").val();
            if (moti_id == '' || moti_id == null) {
                $("#moti_id").select2('open');
                show_notify("Please select Moti!", false);
                return false;
            }
            var moti_detail_amount = $("#moti_detail_amount").val();
            if (moti_detail_amount == '' || moti_detail_amount == null) {
                show_notify("Amount is required!", false);
                $("#moti_detail_amount").focus();
                return false;
            }

            $("#add_moti_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var moti_details = {};
            $('input[name^="moti_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("moti_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                moti_details[key] = value;
            });
            moti_details['moti_id'] = moti_id;
            var moti_data = $('#moti_id option:selected').html();
            moti_details['moti_name'] = moti_data;
            moti_details['moti_detail_amount'] = moti_detail_amount;

            var new_moti_details = JSON.parse(JSON.stringify(moti_details));
            moti_details_index = $("#moti_details_index").val();
            if (moti_details_index != '') {
                moti_details_objectdata.splice(moti_details_index, 1, new_moti_details);
            } else {
                moti_details_objectdata.push(new_moti_details);
            }
            display_moti_details_html(moti_details_objectdata);
            $("#moti_details_index").val('');
            moti_details_index = '';
            $('#moti_details_id').val('');
            $("#moti_id").val(null).trigger("change");
            $('#moti_weight').val('');
            $('#moti_rate').val('');
            $('#moti_detail_amount').val('');
            edit_moti_details_inc = 0;
            $("#add_moti_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('click', '#other_charges_details', function () {
            initAjaxSelect2($("#charges_id"), "<?= base_url('app/charges_select2_source/') ?>");
            $('#other_charges_details_model').modal('show');
            setTimeout(function(){ $('#charges_id').select2('open'); }, 200);
            display_other_charges_details_html(other_charges_details_objectdata);
        });
        $('#other_charges_details_model').on('hidden.bs.modal', function () {
            var total_other_charges_details_amount = $('#total_other_charges_details_amount').html() || 0;
            $('#other_charges').val(total_other_charges_details_amount).trigger("change");
            $('#charges_amount').val('');
            $('#item_remark').focus();
        });
        $(document).on('click', '#add_other_charges_details', function () {
            var charges_id = $("#charges_id").val();
            if (charges_id == '' || charges_id == null) {
                $("#charges_id").select2('open');
                show_notify("Please select Charges For!", false);
                return false;
            }
            var charges_amount = $("#charges_amount").val();
            if (charges_amount == '' || charges_amount == null) {
                show_notify("Amount is required!", false);
                $("#charges_amount").focus();
                return false;
            }

            $("#add_other_charges_details").attr('disabled', 'disabled');
            var key = '';
            var value = '';
            var other_charges_details = {};
            $('input[name^="other_charges_details_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("other_charges_details_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                other_charges_details[key] = value;
            });
            other_charges_details['charges_id'] = charges_id;
            var charges_data = $('#charges_id option:selected').html();
            other_charges_details['charges_name'] = charges_data;
            other_charges_details['charges_amount'] = charges_amount;

            var new_other_charges_details = JSON.parse(JSON.stringify(other_charges_details));
            other_charges_details_index = $("#other_charges_details_index").val();
            if (other_charges_details_index != '') {
                other_charges_details_objectdata.splice(other_charges_details_index, 1, new_other_charges_details);
            } else {
                other_charges_details_objectdata.push(new_other_charges_details);
            }
            display_other_charges_details_html(other_charges_details_objectdata);
            $("#other_charges_details_index").val('');
            other_charges_details_index = '';
            $('#other_charges_details_id').val('');
            $("#charges_id").val(null).trigger("change");
            $('#charges_amount').val('');
            edit_other_charges_details_inc = 0;
            $("#add_other_charges_details").removeAttr('disabled', 'disabled');
        });

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
        });

        $(document).on('click','#add_lineitem',function () {
            var key = '';
            var value = '';
            var lineitem = {};
            if ($.trim($("#job_card_id").val()) == '') {
                show_notify('Please select job no.', false);
                $("#job_card_id").select2('open');
                return false;
            }

            if($.trim($('#type_id').val()) == '') {
                show_notify('Please select Type.', false);
                $("#type_id").select2('open');
                return false;
            }

            if($.trim($('#ir_date').val()) == '') {
                show_notify('Please select Date.', false);
                $("#ir_date").focus();
                return false;
            }

            // if($.trim($('#job_worker_id').val()) == '') {
            //     show_notify('Please select Person.', false);
            //     $("#job_worker_id").select2('open');
            //     return false;
            // }

            if($.trim($('#item_id').val()) == '') {
                show_notify('Please select Item.', false);
                $("#item_id").select2('open');
                return false;
            }

            if($.trim($('#gross').val()) == '') {
                show_notify('Please Enter Gross.', false);
                $("#gross").focus();
                return false;
            }

            $('select[name^="line_items_data"]').each(function (e) {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
                var select_data = $(this).select2('data');
                if(value != '' && value != null && value != 'null') {
                    lineitem[key + "_text"] = select_data[0].text;
                } else {
                    lineitem[key + "_text"] = '';
                }
            });
            
            $('input[name^="line_items_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
            });
            
            $('textarea[name^="line_items_data"]').each(function () {
                key = $(this).attr('name');
                key = key.replace("line_items_data[", "");
                key = key.replace("]", "");
                value = $(this).val();
                lineitem[key] = value;
            });
            lineitem['gross_details'] = JSON.stringify(gross_details_objectdata);
            gross_details_objectdata.length = 0;
            lineitem['stone_pcs_details'] = JSON.stringify(stone_pcs_details_objectdata);
            stone_pcs_details_objectdata.length = 0;
            lineitem['moti_details'] = JSON.stringify(moti_details_objectdata);
            moti_details_objectdata.length = 0;
            lineitem['other_charges_details'] = JSON.stringify(other_charges_details_objectdata);
            other_charges_details_objectdata.length = 0;

            var line_items_index = $("#line_items_index").val();
            if (line_items_index != '') {
                if(lineitem['image'] == '' || lineitem['image'] == null){
                    lineitem['image'] = lineitem_objectdata[line_items_index].image;
                }
            }
            var new_lineitem = JSON.parse(JSON.stringify(lineitem));
            if (line_items_index != '') {
                lineitem_objectdata.splice(line_items_index, 1, new_lineitem);
            } else {
                lineitem_objectdata.push(new_lineitem);
            }

            display_lineitem_html(lineitem_objectdata);
            $("#type_id").val(null).trigger("change");
            $("#type_id").removeAttr("disabled");
            $("#ir_date").datepicker("setDate",'<?=date('d-m-Y')?>');
            $("#item_id").val(null).trigger("change");
            $("#job_worker_id").val(null).trigger("change");
            $("#gross").val('');
            $("#touch").val($("#melting").val()).trigger("change");
            $("#wastage").val('');
            $("#fine").val('');
            $("#ad_weight").val('');
            $("#ad_pcs").val('');
            $("#before_meena").val('');
            $("#meena_wt").val('');
            $("#item_weight").val('');
            $("#kundan").val('');
            $("#sm").val('');
            $("#vetran").val('');
            $("#v_pcs").val('');
            $("#stone_pcs").val('');
            $("#stone_weight").val('');
            $("#stone_charges").val('');
            $("#moti").val('');
            $("#moti_amount").val('');
            $("#other_charges").val('');
            $("#loss").val('');
            $("#loss_fine").val('');
            $("#item_remark").val('');
            $("#file_upload").val('');
            $("#image").val('');
            $("#line_items_index").val('');
            $("#manufacture_ir_id").val(0);
            $('#type_id').select2('open');
        });

        $(document).on('submit', '#save_manufacture', function (e) {
            <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'return false;' : ''; ?>
            e.preventDefault();
            if ($.trim($("#job_card_id").val()) == '') {
                show_notify('Please select job no.', false);
                $("#job_card_id").select2('open');
                return false;
            }
            if ($.trim($("#process_id").val()) == '') {
                show_notify('Please select Process.', false);
                $("#process_id").select2('open');
                return false;
            }
            if(lineitem_objectdata.length == 0) {
                show_notify('Please add Issue/Receive.', false);
                $("#item_id").select2('open');
                return false;
            }

            $('#module_submit_btn').prop('disabled',true);
            $('#add_lineitem').prop('disabled',true);
            var post_data = new FormData(this);
            var lineitem_object_data_stringify = JSON.stringify(lineitem_objectdata);
            post_data.append('manufacture_issue_receive', lineitem_object_data_stringify);
            post_data.append('used_vetran', used_vetran);
            post_data.append('used_moti', used_moti);
            $.ajax({
                url: "<?= base_url('manufacture/save_manufacture') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: post_data,
                success: function (response) {
                    $('.changed-input').removeClass('changed-input');
                    
                    var json = $.parseJSON(response);
                    if (json['error'] == 'Exist') {
                        show_notify(json['error_exist'], false);
                    } else if (json['success'] == 'Added' || json['success'] == 'Updated') {
                        window.location.href = "<?php echo base_url('manufacture/manufacture_list') ?>";
                    }
                    $('.module_submit_btn').prop('disabled',false);
                    $('#add_lineitem').prop('disabled',false);
                    return false;
                }
            });
            return false;
        });

        $(document).on('keyup change', '#loss_allowed', function () {
            var loss_allowed = $('#loss_allowed').val() || 0;
            if(process_id == '<?php echo MEENA_PROCESS_ID; ?>') {
                var allowed = parseFloat(total_issue_finish_gross) * parseFloat(loss_allowed) / 100;
//                allowed = setRoundOf(allowed, 2).toFixed(3);
                allowed = parseFloat(allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) - parseFloat(total_receive_scrap_gross) - parseFloat(total_receive_before_meena);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            if(process_id == '<?php echo SETTINGS_PROCESS_ID; ?>') {
//                allowed = setRoundOf(loss_allowed, 2).toFixed(3);
                allowed = parseFloat(loss_allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) + parseFloat(total_issue_ad_weight) - parseFloat(total_receive_gross) - parseFloat(total_receive_ad_weight);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            if(process_id == '<?php echo POLISH_PROCESS_ID; ?>') {
                var allowed = parseFloat(total_issue_finish_gross) * parseFloat(loss_allowed) / 100;
//                allowed = setRoundOf(allowed, 2).toFixed(3);
                allowed = parseFloat(allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) - parseFloat(total_receive_finish_gross);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            $('#allowed').val(allowed);
            $('#actual_loss').val(actual_loss);
            var loss_receivable_payable = parseFloat(allowed) - parseFloat(actual_loss);
//            loss_receivable_payable = setRoundOf(loss_receivable_payable, 2).toFixed(3);
            loss_receivable_payable = parseFloat(loss_receivable_payable).toFixed(3);
            $('#loss_receivable_payable').html(loss_receivable_payable);
        });

        setTimeout(function(){ display_lineitem_html(lineitem_objectdata); }, 1000);
    });
    
    $('body').on('keydown', 'input,select,.select2-search__field, textarea', function(e) {
        var self = $(this)
          , form = self.parents('form:eq(0)')
          , focusable
          , next
          , prev
          ;

        var id = $(this).attr('id');
        if(id == 'add_lineitem'){
            $('#add_lineitem').click();
        } else if (e.shiftKey) {
            if (e.keyCode == 13 && $(this).is("textarea") == false) {
                focusable =   form.find('input,a,select,.select2-search__field,button,textarea').filter(':visible');
                prev = focusable.eq(focusable.index(this)-1); 

                if (prev.length) {
                   prev.focus();
                } else {
                    form.submit();
                }
            }
        } else if (e.keyCode == 13 && $(this).is("textarea") == false) {
            id_name = $(this).attr("id");
            if(id_name == 'stone_detail_pcs'){
                $('#stone_detail_weight').focus();
            }
            if(id_name == 'stone_detail_weight'){
                $('#stone_detail_rate').focus();
            }
            if(id_name == 'stone_detail_rate'){
                $('#stone_detail_amount').focus();
            }
            if(id_name == 'stone_detail_amount'){
                $('#add_stone_pcs_details').click();
                $('#stone_detail_pcs').focus();
            }
            if(id_name == 'gross_detail_weight'){
                $('#add_gross_details').click();
                $('#gross_detail_item_id').select2('open');
            }
            if(id_name == 'charges_amount'){
                $('#add_other_charges_details').click();
                $('#charges_id').select2('open');
            }
            if(id_name == 'moti_weight'){
                $('#moti_rate').focus();
            }
            if(id_name == 'moti_rate'){
                $('#moti_detail_amount').focus();
            }
            if(id_name == 'moti_detail_amount'){
                $('#add_moti_details').click();
                $('#moti_id').select2('open');
            }
            focusable = form.find('input,a,select,.select2-search__field,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
        
    });
    
    /**
        * WARNING: untested using Select2's option ['selectOnClose'=>true]
        *
        * This code was written because the Select2 widget does not handle
        * tabbing from one form field to another.  The desired behavior is that
        * the user can use [Enter] to select a value from Select2 and [Tab] to move
        * to the next field on the form.
        *
        * The following code moves focus to the next form field when a Select2 'close'
        * event is triggered.  If the next form field is a Select2 widget, the widget
        * is opened automatically.
        *
        * Users that click elsewhere on the document will cause the active Select2
        * widget to close.  To prevent the code from overriding the user's focus choice
        * a flag is added to each element that the users clicks on.  If the flag is
        * active, then the automatic focus script does not happen.
        *
        * To prevent conflicts with multiple Select2 widgets opening at once, a second
        * flag is used to indicate the open status of a Select2 widget.  It was
        * necessary to use a flag instead of reading the class '--open' because using the
        * class '--open' as an indicator flag caused timing/bubbling issues.
        *
        * To simulate a Shift+Tab event, a flag is recorded every time the shift key
        * is pressed.
        */
        var docBody = $(document.body);
        var shiftPressed = false;
        var clickedOutside = false;
        //var keyPressed = 0;

        docBody.on('keydown', function(e) {
            var keyCaptured = (e.keyCode ? e.keyCode : e.which);
            //shiftPressed = keyCaptured == 16 ? true : false;
            if (keyCaptured == 16) { shiftPressed = true; }
        });
        docBody.on('keyup', function(e) {
            var keyCaptured = (e.keyCode ? e.keyCode : e.which);
            //shiftPressed = keyCaptured == 16 ? true : false;
            if (keyCaptured == 16) { shiftPressed = false; }
        });

        docBody.on('mousedown', function(e){
            // remove other focused references
            clickedOutside = false;
            // record focus
            if ($(e.target).is('[class*="select2"]')!=true) {
                clickedOutside = true;
            }
        });

        docBody.on('select2:opening', function(e) {
            // this element has focus, remove other flags
            clickedOutside = false;
            // flag this Select2 as open
            $(e.target).attr('data-s2open', 1);
        });
        docBody.on('select2:closing', function(e) {
            // remove flag as Select2 is now closed
            $(e.target).removeAttr('data-s2open');
        });

        docBody.on('select2:close', function(e) {
            current_select2_id = $(e.target).attr('id');
            var elSelect = $(e.target);
            elSelect.removeAttr('data-s2open');
            var currentForm = elSelect.closest('form');
            var othersOpen = currentForm.has('[data-s2open]').length;
            if (othersOpen == 0 && clickedOutside==false) {
                /* Find all inputs on the current form that would normally not be focus`able:
                 *  - includes hidden <select> elements whose parents are visible (Select2)
                 *  - EXCLUDES hidden <input>, hidden <button>, and hidden <textarea> elements
                 *  - EXCLUDES disabled inputs
                 *  - EXCLUDES read-only inputs
                 */
                var inputs = currentForm.find(':input:enabled:not([readonly], input:hidden, button:hidden, textarea:hidden)')
                    .not(function () {   // do not include inputs with hidden parents
                        return $(this).parent().is(':hidden');
                    });
                var elFocus = null;
                var elFocus_old = null;
                $.each(inputs, function (index) {
                    var elInput = $(this);
                    if (elInput.attr('id') == elSelect.attr('id')) {
                        if ( shiftPressed) { // Shift+Tab
                            elFocus = inputs.eq(index - 1);
                            elFocus_old = inputs.eq(index);
                        } else {
                            elFocus = inputs.eq(index + 1);
                            elFocus_old = inputs.eq(index);
                        }
                        return false;
                    }
                });
                if (elFocus !== null) {
                    // automatically move focus to the next field on the form
                    var isSelect2 = elFocus.siblings('.select2').length > 0;
                    if (isSelect2) {
                        elFocus.select2('open');
                    } else {
                        if(elFocus_old.attr('id') == 'item_id'){
                            $('#gross_details').click();
                        } else {
                            elFocus.focus();
                        }
                    }
                }
                if(current_select2_id == 'gross_detail_item_id'){
                    $('#gross_detail_weight').focus();
                }
                if(current_select2_id == 'charges_id'){
                    $('#charges_amount').focus();
                }
                if(current_select2_id == 'moti_id'){
                    $('#moti_weight').focus();
                }
            }
        });

        /**
         * Capture event where the user entered a Select2 control using the keyboard.
         * http://stackoverflow.com/questions/20989458
         * http://stackoverflow.com/questions/1318076
         */
        docBody.on('focus', '.select2', function(e) {
            var elSelect = $(this).siblings('select');
            var test1 = elSelect.is('[disabled]');
            var test2 = elSelect.is('[data-s2open]');
            var test3 = $(this).has('.select2-selection--single').length;
            if (elSelect.is('[disabled]')==false && elSelect.is('[data-s2open]')==false
                && $(this).has('.select2-selection--single').length>0) {
                elSelect.attr('data-s2open', 1);
                elSelect.select2('open');
            }
        });
        

    function display_lineitem_html(lineitem_objectdata) {
        $('#ajax-loader').show();
        var new_issue_lineitem_html = '';
        var new_receive_lineitem_html = '';

        total_issue_finish_gross = 0;
        total_issue_scrap_gross = 0;
        total_issue_gross = 0;
        total_receive_finish_gross = 0;
        total_receive_scrap_gross = 0;
        total_receive_gross = 0;

        total_issue_finish_touch = 0;
        total_issue_scrap_touch = 0;
        total_issue_touch = 0;
        total_receive_finish_touch = 0;
        total_receive_scrap_touch = 0;
        total_receive_touch = 0;

        total_issue_finish_wastage = 0;
        total_issue_scrap_wastage = 0;
        total_issue_wastage = 0;
        total_receive_finish_wastage = 0;
        total_receive_scrap_wastage = 0;
        total_receive_wastage = 0;

        total_issue_finish_fine = 0;
        total_issue_scrap_fine = 0;
        total_issue_fine = 0;
        total_receive_finish_fine = 0;
        total_receive_scrap_fine = 0;
        total_receive_fine = 0;
        
        total_issue_finish_ad_weight = 0;
        total_issue_scrap_ad_weight = 0;
        total_issue_ad_weight = 0;
        total_receive_finish_ad_weight = 0;
        total_receive_scrap_ad_weight = 0;
        total_receive_ad_weight = 0;

        total_issue_finish_ad_pcs = 0;
        total_issue_scrap_ad_pcs = 0;
        total_issue_ad_pcs = 0;
        total_receive_finish_ad_pcs = 0;
        total_receive_scrap_ad_pcs = 0;
        total_receive_ad_pcs = 0;

        total_issue_finish_before_meena = 0;
        total_issue_scrap_before_meena = 0;
        total_issue_before_meena = 0;
        total_receive_finish_before_meena = 0;
        total_receive_scrap_before_meena = 0;
        total_receive_before_meena = 0;

        total_issue_finish_meena_wt = 0;
        total_issue_scrap_meena_wt = 0;
        total_issue_meena_wt = 0;
        total_receive_finish_meena_wt = 0;
        total_receive_scrap_meena_wt = 0;
        total_receive_meena_wt = 0;

        total_issue_finish_item_weight = 0;
        total_issue_scrap_item_weight = 0;
        total_issue_item_weight = 0;
        total_receive_finish_item_weight = 0;
        total_receive_scrap_item_weight = 0;
        total_receive_item_weight = 0;

        total_issue_finish_kundan = 0;
        total_issue_scrap_kundan = 0;
        total_issue_kundan = 0;
        total_receive_finish_kundan = 0;
        total_receive_scrap_kundan = 0;
        total_receive_kundan = 0;

        total_issue_finish_sm = 0;
        total_issue_scrap_sm = 0;
        total_issue_sm = 0;
        total_receive_finish_sm = 0;
        total_receive_scrap_sm = 0;
        total_receive_sm = 0;

        total_issue_finish_vetran = 0;
        total_issue_scrap_vetran = 0;
        total_issue_vetran = 0;
        total_receive_finish_vetran = 0;
        total_receive_scrap_vetran = 0;
        total_receive_vetran = 0;

        total_issue_finish_v_pcs = 0;
        total_issue_scrap_v_pcs = 0;
        total_issue_v_pcs = 0;
        total_receive_finish_v_pcs = 0;
        total_receive_scrap_v_pcs = 0;
        total_receive_v_pcs = 0;

        total_issue_finish_stone_pcs = 0;
        total_issue_scrap_stone_pcs = 0;
        total_issue_stone_pcs = 0;
        total_receive_finish_stone_pcs = 0;
        total_receive_scrap_stone_pcs = 0;
        total_receive_stone_pcs = 0;

        total_issue_finish_stone_weight = 0;
        total_issue_scrap_stone_weight = 0;
        total_issue_stone_weight = 0;
        total_receive_finish_stone_weight = 0;
        total_receive_scrap_stone_weight = 0;
        total_receive_stone_weight = 0;

        total_issue_finish_stone_charges = 0;
        total_issue_scrap_stone_charges = 0;
        total_issue_stone_charges = 0;
        total_receive_finish_stone_charges = 0;
        total_receive_scrap_stone_charges = 0;
        total_receive_stone_charges = 0;

        total_issue_finish_moti = 0;
        total_issue_scrap_moti = 0;
        total_issue_moti = 0;
        total_receive_finish_moti = 0;
        total_receive_scrap_moti = 0;
        total_receive_moti = 0;

        total_issue_finish_moti_amount = 0;
        total_issue_scrap_moti_amount = 0;
        total_issue_moti_amount = 0;
        total_receive_finish_moti_amount = 0;
        total_receive_scrap_moti_amount = 0;
        total_receive_moti_amount = 0;

        total_issue_finish_other_charges = 0;
        total_issue_scrap_other_charges = 0;
        total_issue_other_charges = 0;
        total_receive_finish_other_charges = 0;
        total_receive_scrap_other_charges = 0;
        total_receive_other_charges = 0;

        total_issue_finish_loss = 0;
        total_issue_scrap_loss = 0;
        total_issue_loss = 0;
        total_receive_finish_loss = 0;
        total_receive_scrap_loss = 0;
        total_receive_loss = 0;

        total_issue_finish_loss_fine = 0;
        total_issue_scrap_loss_fine = 0;
        total_issue_loss_fine = 0;
        total_receive_finish_loss_fine = 0;
        total_receive_scrap_loss_fine = 0;
        total_receive_loss_fine = 0;

        balance_gross = 0;
        balance_touch = 0;
        balance_wastage = 0;
        balance_fine = 0;
        balance_ad_weight = 0;
        balance_ad_pcs = 0;
        balance_before_meena = 0;
        balance_meena_wt = 0;
        balance_item_weight = 0;
        balance_kundan = 0;
        balance_sm = 0;
        balance_vetran = 0;
        balance_v_pcs = 0;
        balance_stone_pcs = 0;
        balance_stone_weight = 0;
        balance_stone_charges = 0;
        balance_moti = 0;
        balance_moti_amount = 0;
        balance_other_charges = 0;
        balance_loss = 0;
        balance_loss_fine = 0;

        total_issue_vetran_item_gross = 0;
        total_receive_vetran_item_gross = 0;

        rfw_firstline_job_worker_id = '';
        var rfw_line_inc = 0;

        var process_touch = parseFloat($("#melting").val()) || 0;
        $.each(lineitem_objectdata, function (index, value) {
            var lineitem_edit_btn = '';
            var lineitem_delete_btn = '';  

            var gross = parseFloat(value.gross) || 0;
            gross = setRoundOf(gross, 2).toFixed(3);
            var touch = parseFloat(value.touch) || 0;
            touch = touch.toFixed(2);
            var wastage = parseFloat(value.wastage) || 0;
            wastage = setRoundOf(wastage, 2).toFixed(3);
            var fine = parseFloat(value.fine) || 0;
            fine = setRoundOf(fine, 2).toFixed(3);
            var ad_weight = parseFloat(value.ad_weight) || 0;
            ad_weight = setRoundOf(ad_weight, 2).toFixed(3);
            var ad_pcs = parseFloat(value.ad_pcs) || 0;
            ad_pcs = ad_pcs.toFixed(0);
            var before_meena = parseFloat(value.before_meena) || 0;
            before_meena = setRoundOf(before_meena, 2).toFixed(3);
            var meena_wt = parseFloat(value.meena_wt) || 0;
            meena_wt = setRoundOf(meena_wt, 2).toFixed(3);
            var item_weight = parseFloat(value.item_weight) || 0;
            item_weight = setRoundOf(item_weight, 2).toFixed(3);
            var kundan = parseFloat(value.kundan) || 0;
            kundan = setRoundOf(kundan, 2).toFixed(3);
            var sm = parseFloat(value.sm) || 0;
            sm = setRoundOf(sm, 2).toFixed(3);
            var vetran = parseFloat(value.vetran) || 0;
            vetran = setRoundOf(vetran, 2).toFixed(3);
            var v_pcs = parseFloat(value.v_pcs) || 0;
            v_pcs = v_pcs.toFixed(0);
            var stone_pcs = parseFloat(value.stone_pcs) || 0;
            stone_pcs = stone_pcs.toFixed(0);
            var stone_weight = parseFloat(value.stone_weight) || 0;
            stone_weight = setRoundOf(stone_weight, 2).toFixed(3);
            var stone_charges = parseFloat(value.stone_charges) || 0;
            stone_charges = stone_charges.toFixed(2);
            var moti = parseFloat(value.moti) || 0;
            moti = setRoundOf(moti, 2).toFixed(3);
            var moti_amount = parseFloat(value.moti_amount) || 0;
            moti_amount = moti_amount.toFixed(2);
            var other_charges = parseFloat(value.other_charges) || 0;
            other_charges = other_charges.toFixed(2);
            var loss = parseFloat(value.loss) || 0;
            loss = setRoundOf(loss, 2).toFixed(3);
            var loss_fine = parseFloat(value.loss_fine) || 0;
            loss_fine = setRoundOf(loss_fine, 2).toFixed(3);
            lineitem_edit_btn = '<span style="white-space:nowrap"> <a class="btn btn-xs btn-primary btn-edit-item edit_lineitem_' + index + '" href="javascript:void(0);" onclick="edit_lineitem(' + index + ')"><i class="fa fa-edit"></i></a> ';
            lineitem_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item" href="javascript:void(0);" onclick="remove_lineitem(' + index + ')"><i class="fa fa-trash"></i></a> </span>';
            
            var issue_receive_type = '';
            var ir_label = '';
            if(value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_FINISH_ID; ?>'){
                var issue_receive_type = 'IFW';
                var ir_label = 'issue';

            } else if(value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_FINISH_ID; ?>'){
                var issue_receive_type = 'RFW';
                var ir_label = 'receive';

            } else if(value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_SCRAP_ID; ?>'){
                var issue_receive_type = 'IS';
                var ir_label = 'issue';

            } else if(value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_SCRAP_ID; ?>'){
                var issue_receive_type = 'RS';
                var ir_label = 'receive';
            }

            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    lineitem_edit_btn +
                    lineitem_delete_btn +
                    '</td>' +
                    '<td class="c_'+ir_label+'_type text-nowrap">' + issue_receive_type + '</td>'+
                    '<td class="text-nowrap">' + value.ir_date + '</td>'+
                    '<td class="c_'+ir_label+'_person">' + value.job_worker_id_text + '</td>' +
                    '<td class="c_'+ir_label+'_item">' + value.item_id_text + '</td>';
            row_html += '<td class="text-right">' + gross + '</td>';
            row_html += '<td class="text-right">' + touch + '</td>';
            row_html += '<td class="text-right dynamic_column pif_wastage prf_wastage d-none">' + wastage + '</td>';
            row_html += '<td class="text-right">' + fine + '</td>';
            row_html += '<td class="text-right dynamic_column pif_ad_weight prf_ad_weight d-none">' + ad_weight + '</td>';
            row_html += '<td class="text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none">' + ad_pcs + '</td>';
            row_html += '<td class="text-right dynamic_column prf_before_meena d-none">' + before_meena + '</td>';
            row_html += '<td class="text-right dynamic_column prf_meena_wt d-none">' + meena_wt + '</td>';
            row_html += '<td class="text-right dynamic_column prf_item_weight d-none">' + item_weight + '</td>';
            row_html += '<td class="text-right dynamic_column prf_kundan d-none">' + kundan + '</td>';
            row_html += '<td class="text-right dynamic_column prf_sm d-none">' + sm + '</td>';
            row_html += '<td class="text-right dynamic_column pif_vetran prf_vetran d-none">' + vetran + '</td>';
            row_html += '<td class="text-right dynamic_column pif_v_pcs prf_v_pcs d-none">' + v_pcs + '</td>';
            row_html += '<td class="text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none">' + stone_pcs + '</td>';
            row_html += '<td class="text-right dynamic_column pif_stone_wt prf_stone_wt d-none">' + stone_weight + '</td>';
            row_html += '<td class="text-right dynamic_column prf_stone_charges d-none">' + stone_charges + '</td>';
            row_html += '<td class="text-right dynamic_column pif_moti prf_moti d-none">' + moti + '</td>';
            row_html += '<td class="text-right dynamic_column pif_moti_amount prf_moti_amount d-none">' + moti_amount + '</td>';
            row_html += '<td class="text-right dynamic_column prf_other_charges d-none">' + other_charges + '</td>';
            row_html += '<td class="text-right dynamic_column prf_loss d-none">' + loss + '</td>';
            row_html += '<td class="text-right dynamic_column prf_loss_fine d-none">' + loss_fine + '</td>';
            row_html += '<td>' + value.item_remark + '</td>';
            row_html += '<td>';
            if (value.image !== null && value.image !== '') {
                var value_image = value.image;
                var img_url = '<?php echo base_url(); ?>' + 'uploads/manufacture_item_photo/' + value.image;
                row_html += '<a href="javascript:void(0)" class="btn btn-xs btn-primary item_photo_modal" data-img_src="' + img_url + '" ><i class="fa fa-image"></i></a>';
            } else {
                row_html += '-';
            }
            row_html += '</td>';
            
            if(value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_FINISH_ID; ?>' || value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_SCRAP_ID; ?>'){
                if(value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_FINISH_ID; ?>'){
                    total_receive_finish_gross = parseFloat(total_receive_finish_gross) + parseFloat(gross);
                    total_receive_finish_fine = parseFloat(total_receive_finish_fine) + parseFloat(fine);
                    total_receive_finish_touch = (parseFloat(total_receive_finish_fine) / parseFloat(total_receive_finish_gross)) * 100;
                    total_receive_finish_touch = total_receive_finish_touch || 0;
                    total_receive_finish_wastage = parseFloat(total_receive_finish_wastage) + parseFloat(wastage);
                    total_receive_finish_ad_weight = parseFloat(total_receive_finish_ad_weight) + parseFloat(ad_weight);
                    total_receive_finish_ad_pcs = parseFloat(total_receive_finish_ad_pcs) + parseFloat(ad_pcs);
                    total_receive_finish_before_meena = parseFloat(total_receive_finish_before_meena) + parseFloat(before_meena);
                    total_receive_finish_meena_wt = parseFloat(total_receive_finish_meena_wt) + parseFloat(meena_wt);
                    total_receive_finish_item_weight = parseFloat(total_receive_finish_item_weight) + parseFloat(item_weight);
                    total_receive_finish_kundan = parseFloat(total_receive_finish_kundan) + parseFloat(kundan);
                    total_receive_finish_sm = parseFloat(total_receive_finish_sm) + parseFloat(sm);
                    total_receive_finish_vetran = parseFloat(total_receive_finish_vetran) + parseFloat(vetran);
                    total_receive_finish_v_pcs = parseFloat(total_receive_finish_v_pcs) + parseFloat(v_pcs);
                    total_receive_finish_stone_pcs = parseFloat(total_receive_finish_stone_pcs) + parseFloat(stone_pcs);
                    total_receive_finish_stone_weight = parseFloat(total_receive_finish_stone_weight) + parseFloat(stone_weight);
                    total_receive_finish_stone_charges = parseFloat(total_receive_finish_stone_charges) + parseFloat(stone_charges);
                    total_receive_finish_moti = parseFloat(total_receive_finish_moti) + parseFloat(moti);
                    total_receive_finish_moti_amount = parseFloat(total_receive_finish_moti_amount) + parseFloat(moti_amount);
                    total_receive_finish_other_charges = parseFloat(total_receive_finish_other_charges) + parseFloat(other_charges);
                    total_receive_finish_loss = parseFloat(total_receive_finish_loss) + parseFloat(loss);
                    total_receive_finish_loss_fine = parseFloat(total_receive_finish_loss_fine) + parseFloat(loss_fine);

                    if(rfw_line_inc == 0){
                        rfw_firstline_job_worker_id = value.job_worker_id;
                        rfw_line_inc = rfw_line_inc + 1;
                    }
                }
                if(value.type_id == '<?php echo MANUFACTURE_TYPE_RECEIVE_SCRAP_ID; ?>'){
                    total_receive_scrap_gross = parseFloat(total_receive_scrap_gross) + parseFloat(gross);
                    total_receive_scrap_fine = parseFloat(total_receive_scrap_fine) + parseFloat(fine);
                    total_receive_scrap_touch = (parseFloat(total_receive_scrap_fine) / parseFloat(total_receive_scrap_gross)) * 100;
                    total_receive_scrap_touch = total_receive_scrap_touch || 0;
                    total_receive_scrap_wastage = parseFloat(total_receive_scrap_wastage) + parseFloat(wastage);
                    total_receive_scrap_ad_weight = parseFloat(total_receive_scrap_ad_weight) + parseFloat(ad_weight);
                    total_receive_scrap_ad_pcs = parseFloat(total_receive_scrap_ad_pcs) + parseFloat(ad_pcs);
                    total_receive_scrap_before_meena = parseFloat(total_receive_scrap_before_meena) + parseFloat(before_meena);
                    total_receive_scrap_meena_wt = parseFloat(total_receive_scrap_meena_wt) + parseFloat(meena_wt);
                    total_receive_scrap_item_weight = parseFloat(total_receive_scrap_item_weight) + parseFloat(item_weight);
                    total_receive_scrap_kundan = parseFloat(total_receive_scrap_kundan) + parseFloat(kundan);
                    total_receive_scrap_sm = parseFloat(total_receive_scrap_sm) + parseFloat(sm);
                    total_receive_scrap_vetran = parseFloat(total_receive_scrap_vetran) + parseFloat(vetran);
                    total_receive_scrap_v_pcs = parseFloat(total_receive_scrap_v_pcs) + parseFloat(v_pcs);
                    total_receive_scrap_stone_pcs = parseFloat(total_receive_scrap_stone_pcs) + parseFloat(stone_pcs);
                    total_receive_scrap_stone_weight = parseFloat(total_receive_scrap_stone_weight) + parseFloat(stone_weight);
                    total_receive_scrap_stone_charges = parseFloat(total_receive_scrap_stone_charges) + parseFloat(stone_charges);
                    total_receive_scrap_moti = parseFloat(total_receive_scrap_moti) + parseFloat(moti);
                    total_receive_scrap_moti_amount = parseFloat(total_receive_scrap_moti_amount) + parseFloat(moti_amount);
                    total_receive_scrap_other_charges = parseFloat(total_receive_scrap_other_charges) + parseFloat(other_charges);
                    total_receive_scrap_loss = parseFloat(total_receive_scrap_loss) + parseFloat(loss);
                    total_receive_scrap_loss_fine = parseFloat(total_receive_scrap_loss_fine) + parseFloat(loss_fine);
                }
                total_receive_gross = parseFloat(total_receive_gross) + parseFloat(gross);
                total_receive_fine = parseFloat(total_receive_fine) + parseFloat(fine);
                total_receive_touch = (parseFloat(total_receive_fine) / parseFloat(total_receive_gross)) * 100;
                total_receive_touch = total_receive_touch || 0;
                total_receive_wastage = parseFloat(total_receive_wastage) + parseFloat(wastage);
                total_receive_ad_weight = parseFloat(total_receive_ad_weight) + parseFloat(ad_weight);
                total_receive_ad_pcs = parseFloat(total_receive_ad_pcs) + parseFloat(ad_pcs);
                total_receive_before_meena = parseFloat(total_receive_before_meena) + parseFloat(before_meena);
                total_receive_meena_wt = parseFloat(total_receive_meena_wt) + parseFloat(meena_wt);
                total_receive_item_weight = parseFloat(total_receive_item_weight) + parseFloat(item_weight);
                total_receive_kundan = parseFloat(total_receive_kundan) + parseFloat(kundan);
                total_receive_sm = parseFloat(total_receive_sm) + parseFloat(sm);
                total_receive_vetran = parseFloat(total_receive_vetran) + parseFloat(vetran);
                total_receive_v_pcs = parseFloat(total_receive_v_pcs) + parseFloat(v_pcs);
                total_receive_stone_pcs = parseFloat(total_receive_stone_pcs) + parseFloat(stone_pcs);
                total_receive_stone_weight = parseFloat(total_receive_stone_weight) + parseFloat(stone_weight);
                total_receive_stone_charges = parseFloat(total_receive_stone_charges) + parseFloat(stone_charges);
                total_receive_moti = parseFloat(total_receive_moti) + parseFloat(moti);
                total_receive_moti_amount = parseFloat(total_receive_moti_amount) + parseFloat(moti_amount);
                total_receive_other_charges = parseFloat(total_receive_other_charges) + parseFloat(other_charges);
                total_receive_loss = parseFloat(total_receive_loss) + parseFloat(loss);
                total_receive_loss_fine = parseFloat(total_receive_loss_fine) + parseFloat(loss_fine);

                if(value.item_id == '<?php echo ITEM_VETRAN_ID; ?>'){
                    total_receive_vetran_item_gross = parseFloat(total_receive_vetran_item_gross) + parseFloat(gross);
                }

                new_receive_lineitem_html += row_html;

            } else if(value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_FINISH_ID; ?>' || value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_SCRAP_ID; ?>'){
                if(value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_FINISH_ID; ?>'){
                    total_issue_finish_gross = parseFloat(total_issue_finish_gross) + parseFloat(gross);
                    total_issue_finish_fine = parseFloat(total_issue_finish_fine) + parseFloat(fine);
                    total_issue_finish_touch = (parseFloat(total_issue_finish_fine) / parseFloat(total_issue_finish_gross)) * 100;
                    total_issue_finish_touch = total_issue_finish_touch || 0;
                    total_issue_finish_wastage = parseFloat(total_issue_finish_wastage) + parseFloat(wastage);
                    total_issue_finish_ad_weight = parseFloat(total_issue_finish_ad_weight) + parseFloat(ad_weight);
                    total_issue_finish_ad_pcs = parseFloat(total_issue_finish_ad_pcs) + parseFloat(ad_pcs);
                    total_issue_finish_before_meena = parseFloat(total_issue_finish_before_meena) + parseFloat(before_meena);
                    total_issue_finish_meena_wt = parseFloat(total_issue_finish_meena_wt) + parseFloat(meena_wt);
                    total_issue_finish_item_weight = parseFloat(total_issue_finish_item_weight) + parseFloat(item_weight);
                    total_issue_finish_kundan = parseFloat(total_issue_finish_kundan) + parseFloat(kundan);
                    total_issue_finish_sm = parseFloat(total_issue_finish_sm) + parseFloat(sm);
                    total_issue_finish_vetran = parseFloat(total_issue_finish_vetran) + parseFloat(vetran);
                    total_issue_finish_v_pcs = parseFloat(total_issue_finish_v_pcs) + parseFloat(v_pcs);
                    total_issue_finish_stone_pcs = parseFloat(total_issue_finish_stone_pcs) + parseFloat(stone_pcs);
                    total_issue_finish_stone_weight = parseFloat(total_issue_finish_stone_weight) + parseFloat(stone_weight);
                    total_issue_finish_stone_charges = parseFloat(total_issue_finish_stone_charges) + parseFloat(stone_charges);
                    total_issue_finish_moti = parseFloat(total_issue_finish_moti) + parseFloat(moti);
                    total_issue_finish_moti_amount = parseFloat(total_issue_finish_moti_amount) + parseFloat(moti_amount);
                    total_issue_finish_other_charges = parseFloat(total_issue_finish_other_charges) + parseFloat(other_charges);
                    total_issue_finish_loss = parseFloat(total_issue_finish_loss) + parseFloat(loss);
                    total_issue_finish_loss_fine = parseFloat(total_issue_finish_loss_fine) + parseFloat(loss_fine);
                }
                if(value.type_id == '<?php echo MANUFACTURE_TYPE_ISSUE_SCRAP_ID; ?>'){
                    total_issue_scrap_gross = parseFloat(total_issue_scrap_gross) + parseFloat(gross);
                    total_issue_scrap_fine = parseFloat(total_issue_scrap_fine) + parseFloat(fine);
                    total_issue_scrap_touch = (parseFloat(total_issue_scrap_fine) / parseFloat(total_issue_scrap_gross)) * 100;
                    total_issue_scrap_touch = total_issue_scrap_touch || 0;
                    total_issue_scrap_wastage = parseFloat(total_issue_scrap_wastage) + parseFloat(wastage);
                    total_issue_scrap_ad_weight = parseFloat(total_issue_scrap_ad_weight) + parseFloat(ad_weight);
                    total_issue_scrap_ad_pcs = parseFloat(total_issue_scrap_ad_pcs) + parseFloat(ad_pcs);
                    total_issue_scrap_before_meena = parseFloat(total_issue_scrap_before_meena) + parseFloat(before_meena);
                    total_issue_scrap_meena_wt = parseFloat(total_issue_scrap_meena_wt) + parseFloat(meena_wt);
                    total_issue_scrap_item_weight = parseFloat(total_issue_scrap_item_weight) + parseFloat(item_weight);
                    total_issue_scrap_kundan = parseFloat(total_issue_scrap_kundan) + parseFloat(kundan);
                    total_issue_scrap_sm = parseFloat(total_issue_scrap_sm) + parseFloat(sm);
                    total_issue_scrap_vetran = parseFloat(total_issue_scrap_vetran) + parseFloat(vetran);
                    total_issue_scrap_v_pcs = parseFloat(total_issue_scrap_v_pcs) + parseFloat(v_pcs);
                    total_issue_scrap_stone_pcs = parseFloat(total_issue_scrap_stone_pcs) + parseFloat(stone_pcs);
                    total_issue_scrap_stone_weight = parseFloat(total_issue_scrap_stone_weight) + parseFloat(stone_weight);
                    total_issue_scrap_stone_charges = parseFloat(total_issue_scrap_stone_charges) + parseFloat(stone_charges);
                    total_issue_scrap_moti = parseFloat(total_issue_scrap_moti) + parseFloat(moti);
                    total_issue_scrap_moti_amount = parseFloat(total_issue_scrap_moti_amount) + parseFloat(moti_amount);
                    total_issue_scrap_other_charges = parseFloat(total_issue_scrap_other_charges) + parseFloat(other_charges);
                    total_issue_scrap_loss = parseFloat(total_issue_scrap_loss) + parseFloat(loss);
                    total_issue_scrap_loss_fine = parseFloat(total_issue_scrap_loss_fine) + parseFloat(loss_fine);
                }
                total_issue_gross = parseFloat(total_issue_gross) + parseFloat(gross);
                total_issue_fine = parseFloat(total_issue_fine) + parseFloat(fine);
                total_issue_touch = (parseFloat(total_issue_fine) / parseFloat(total_issue_gross)) * 100;
                total_issue_touch = total_issue_touch || 0;
                total_issue_wastage = parseFloat(total_issue_wastage) + parseFloat(wastage);
                total_issue_ad_weight = parseFloat(total_issue_ad_weight) + parseFloat(ad_weight);
                total_issue_ad_pcs = parseFloat(total_issue_ad_pcs) + parseFloat(ad_pcs);
                total_issue_before_meena = parseFloat(total_issue_before_meena) + parseFloat(before_meena);
                total_issue_meena_wt = parseFloat(total_issue_meena_wt) + parseFloat(meena_wt);
                total_issue_item_weight = parseFloat(total_issue_item_weight) + parseFloat(item_weight);
                total_issue_kundan = parseFloat(total_issue_kundan) + parseFloat(kundan);
                total_issue_sm = parseFloat(total_issue_sm) + parseFloat(sm);
                total_issue_vetran = parseFloat(total_issue_vetran) + parseFloat(vetran);
                total_issue_v_pcs = parseFloat(total_issue_v_pcs) + parseFloat(v_pcs);
                total_issue_stone_pcs = parseFloat(total_issue_stone_pcs) + parseFloat(stone_pcs);
                total_issue_stone_weight = parseFloat(total_issue_stone_weight) + parseFloat(stone_weight);
                total_issue_stone_charges = parseFloat(total_issue_stone_charges) + parseFloat(stone_charges);
                total_issue_moti = parseFloat(total_issue_moti) + parseFloat(moti);
                total_issue_moti_amount = parseFloat(total_issue_moti_amount) + parseFloat(moti_amount);
                total_issue_other_charges = parseFloat(total_issue_other_charges) + parseFloat(other_charges);
                total_issue_loss = parseFloat(total_issue_loss) + parseFloat(loss);
                total_issue_loss_fine = parseFloat(total_issue_loss_fine) + parseFloat(loss_fine);

                if(value.item_id == '<?php echo ITEM_VETRAN_ID; ?>'){
                    total_issue_vetran_item_gross = parseFloat(total_issue_vetran_item_gross) + parseFloat(gross);
                }

                new_issue_lineitem_html += row_html;
            }
        });

        // Fill Issue Data
        $('#issue_lineitem_list').html(new_issue_lineitem_html);
        
        $('#total_issue_finish_gross').html(total_issue_finish_gross.toFixed(3));
        $('#total_issue_finish_touch').html(total_issue_finish_touch.toFixed(2));
        $('#total_issue_finish_wastage').html(total_issue_finish_wastage.toFixed(3));
        $('#total_issue_finish_fine').html(total_issue_finish_fine.toFixed(3));
        $('#total_issue_finish_ad_weight').html(total_issue_finish_ad_weight.toFixed(3));
        $('#total_issue_finish_ad_pcs').html(total_issue_finish_ad_pcs.toFixed(0));
        $('#total_issue_finish_before_meena').html(total_issue_finish_before_meena.toFixed(3));
        $('#total_issue_finish_meena_wt').html(total_issue_finish_meena_wt.toFixed(3));
        $('#total_issue_finish_item_weight').html(total_issue_finish_item_weight.toFixed(3));
        $('#total_issue_finish_kundan').html(total_issue_finish_kundan.toFixed(3));
        $('#total_issue_finish_sm').html(total_issue_finish_sm.toFixed(3));
        $('#total_issue_finish_vetran').html(total_issue_finish_vetran.toFixed(3));
        $('#total_issue_finish_v_pcs').html(total_issue_finish_v_pcs.toFixed(0));
        $('#total_issue_finish_stone_pcs').html(total_issue_finish_stone_pcs.toFixed(0));
        $('#total_issue_finish_stone_weight').html(total_issue_finish_stone_weight.toFixed(3));
        $('#total_issue_finish_stone_charges').html(total_issue_finish_stone_charges.toFixed(3));
        $('#total_issue_finish_moti').html(total_issue_finish_moti.toFixed(3));
        $('#total_issue_finish_moti_amount').html(total_issue_finish_moti_amount.toFixed(2));
        $('#total_issue_finish_other_charges').html(total_issue_finish_other_charges.toFixed(2));
        $('#total_issue_finish_loss').html(total_issue_finish_loss.toFixed(3));
        $('#total_issue_finish_loss_fine').html(total_issue_finish_loss_fine.toFixed(3));

        $('#total_issue_scrap_gross').html(total_issue_scrap_gross.toFixed(3));
        $('#total_issue_scrap_touch').html(total_issue_scrap_touch.toFixed(2));
        $('#total_issue_scrap_wastage').html(total_issue_scrap_wastage.toFixed(3));
        $('#total_issue_scrap_fine').html(total_issue_scrap_fine.toFixed(3));
        $('#total_issue_scrap_ad_weight').html(total_issue_scrap_ad_weight.toFixed(3));
        $('#total_issue_scrap_ad_pcs').html(total_issue_scrap_ad_pcs.toFixed(0));
        $('#total_issue_scrap_before_meena').html(total_issue_scrap_before_meena.toFixed(3));
        $('#total_issue_scrap_meena_wt').html(total_issue_scrap_meena_wt.toFixed(3));
        $('#total_issue_scrap_item_weight').html(total_issue_scrap_item_weight.toFixed(3));
        $('#total_issue_scrap_kundan').html(total_issue_scrap_kundan.toFixed(3));
        $('#total_issue_scrap_sm').html(total_issue_scrap_sm.toFixed(3));
        $('#total_issue_scrap_vetran').html(total_issue_scrap_vetran.toFixed(3));
        $('#total_issue_scrap_v_pcs').html(total_issue_scrap_v_pcs.toFixed(0));
        $('#total_issue_scrap_stone_pcs').html(total_issue_scrap_stone_pcs.toFixed(0));
        $('#total_issue_scrap_stone_weight').html(total_issue_scrap_stone_weight.toFixed(3));
        $('#total_issue_scrap_stone_charges').html(total_issue_scrap_stone_charges.toFixed(3));
        $('#total_issue_scrap_moti').html(total_issue_scrap_moti.toFixed(3));
        $('#total_issue_scrap_moti_amount').html(total_issue_scrap_moti_amount.toFixed(2));
        $('#total_issue_scrap_other_charges').html(total_issue_scrap_other_charges.toFixed(2));
        $('#total_issue_scrap_loss').html(total_issue_scrap_loss.toFixed(3));
        $('#total_issue_scrap_loss_fine').html(total_issue_scrap_loss_fine.toFixed(3));
        
        $('#total_issue_gross').html(total_issue_gross.toFixed(3));
        $('#total_issue_touch').html(total_issue_touch.toFixed(2));
        $('#total_issue_wastage').html(total_issue_wastage.toFixed(3));
        $('#total_issue_fine').html(total_issue_fine.toFixed(3));
        $('#total_issue_ad_weight').html(total_issue_ad_weight.toFixed(3));
        $('#total_issue_ad_pcs').html(total_issue_ad_pcs.toFixed(0));
        $('#total_issue_before_meena').html(total_issue_before_meena.toFixed(3));
        $('#total_issue_meena_wt').html(total_issue_meena_wt.toFixed(3));
        $('#total_issue_item_weight').html(total_issue_item_weight.toFixed(3));
        $('#total_issue_kundan').html(total_issue_kundan.toFixed(3));
        $('#total_issue_sm').html(total_issue_sm.toFixed(3));
        $('#total_issue_vetran').html(total_issue_vetran.toFixed(3));
        $('#total_issue_v_pcs').html(total_issue_v_pcs.toFixed(0));
        $('#total_issue_stone_pcs').html(total_issue_stone_pcs.toFixed(0));
        $('#total_issue_stone_weight').html(total_issue_stone_weight.toFixed(3));
        $('#total_issue_stone_charges').html(total_issue_stone_charges.toFixed(3));
        $('#total_issue_moti').html(total_issue_moti.toFixed(3));
        $('#total_issue_moti_amount').html(total_issue_moti_amount.toFixed(2));
        $('#total_issue_other_charges').html(total_issue_other_charges.toFixed(2));
        $('#total_issue_loss').html(total_issue_loss.toFixed(3));
        $('#total_issue_loss_fine').html(total_issue_loss_fine.toFixed(3));
        var total_i_gross_plus_ad = parseFloat(total_issue_gross) + parseFloat(total_issue_ad_weight);
        $('#total_i_gross_plus_ad').html(total_i_gross_plus_ad.toFixed(3));

        // Fill Receive Data
        $('#receive_lineitem_list').html(new_receive_lineitem_html);
        
        $('#total_receive_finish_gross').html(total_receive_finish_gross.toFixed(3));
        $('#total_receive_finish_touch').html(total_receive_finish_touch.toFixed(2));
        $('#total_receive_finish_wastage').html(total_receive_finish_wastage.toFixed(3));
        $('#total_receive_finish_fine').html(total_receive_finish_fine.toFixed(3));
        $('#total_receive_finish_ad_weight').html(total_receive_finish_ad_weight.toFixed(3));
        $('#total_receive_finish_ad_pcs').html(total_receive_finish_ad_pcs.toFixed(0));
        $('#total_receive_finish_before_meena').html(total_receive_finish_before_meena.toFixed(3));
        $('#total_receive_finish_meena_wt').html(total_receive_finish_meena_wt.toFixed(3));
        $('#total_receive_finish_item_weight').html(total_receive_finish_item_weight.toFixed(3));
        $('#total_receive_finish_kundan').html(total_receive_finish_kundan.toFixed(3));
        $('#total_receive_finish_sm').html(total_receive_finish_sm.toFixed(3));
        $('#total_receive_finish_vetran').html(total_receive_finish_vetran.toFixed(3));
        $('#total_receive_finish_v_pcs').html(total_receive_finish_v_pcs.toFixed(0));
        $('#total_receive_finish_stone_pcs').html(total_receive_finish_stone_pcs.toFixed(0));
        $('#total_receive_finish_stone_weight').html(total_receive_finish_stone_weight.toFixed(3));
        $('#total_receive_finish_stone_charges').html(total_receive_finish_stone_charges.toFixed(3));
        $('#total_receive_finish_moti').html(total_receive_finish_moti.toFixed(3));
        $('#total_receive_finish_moti_amount').html(total_receive_finish_moti_amount.toFixed(2));
        $('#total_receive_finish_other_charges').html(total_receive_finish_other_charges.toFixed(2));
        $('#total_receive_finish_loss').html(total_receive_finish_loss.toFixed(3));
        $('#total_receive_finish_loss_fine').html(total_receive_finish_loss_fine.toFixed(3));
        
        $('#total_receive_scrap_gross').html(total_receive_scrap_gross.toFixed(3));
        $('#total_receive_scrap_touch').html(total_receive_scrap_touch.toFixed(2));
        $('#total_receive_scrap_wastage').html(total_receive_scrap_wastage.toFixed(3));
        $('#total_receive_scrap_fine').html(total_receive_scrap_fine.toFixed(3));
        $('#total_receive_scrap_ad_weight').html(total_receive_scrap_ad_weight.toFixed(3));
        $('#total_receive_scrap_ad_pcs').html(total_receive_scrap_ad_pcs.toFixed(0));
        $('#total_receive_scrap_before_meena').html(total_receive_scrap_before_meena.toFixed(3));
        $('#total_receive_scrap_meena_wt').html(total_receive_scrap_meena_wt.toFixed(3));
        $('#total_receive_scrap_item_weight').html(total_receive_scrap_item_weight.toFixed(3));
        $('#total_receive_scrap_kundan').html(total_receive_scrap_kundan.toFixed(3));
        $('#total_receive_scrap_sm').html(total_receive_scrap_sm.toFixed(3));
        $('#total_receive_scrap_vetran').html(total_receive_scrap_vetran.toFixed(3));
        $('#total_receive_scrap_v_pcs').html(total_receive_scrap_v_pcs.toFixed(0));
        $('#total_receive_scrap_stone_pcs').html(total_receive_scrap_stone_pcs.toFixed(0));
        $('#total_receive_scrap_stone_weight').html(total_receive_scrap_stone_weight.toFixed(3));
        $('#total_receive_scrap_stone_charges').html(total_receive_scrap_stone_charges.toFixed(3));
        $('#total_receive_scrap_moti').html(total_receive_scrap_moti.toFixed(3));
        $('#total_receive_scrap_moti_amount').html(total_receive_scrap_moti_amount.toFixed(2));
        $('#total_receive_scrap_other_charges').html(total_receive_scrap_other_charges.toFixed(2));
        $('#total_receive_scrap_loss').html(total_receive_scrap_loss.toFixed(3));
        $('#total_receive_scrap_loss_fine').html(total_receive_scrap_loss_fine.toFixed(3));

        $('#total_receive_gross').html(total_receive_gross.toFixed(3));
        $('#total_receive_touch').html(total_receive_touch.toFixed(2));
        $('#total_receive_wastage').html(total_receive_wastage.toFixed(3));
        $('#total_receive_fine').html(total_receive_fine.toFixed(3));
        $('#total_receive_ad_weight').html(total_receive_ad_weight.toFixed(3));
        $('#total_receive_ad_pcs').html(total_receive_ad_pcs.toFixed(0));
        $('#total_receive_before_meena').html(total_receive_before_meena.toFixed(3));
        $('#total_receive_meena_wt').html(total_receive_meena_wt.toFixed(3));
        $('#total_receive_item_weight').html(total_receive_item_weight.toFixed(3));
        $('#total_receive_kundan').html(total_receive_kundan.toFixed(3));
        $('#total_receive_sm').html(total_receive_sm.toFixed(3));
        $('#total_receive_vetran').html(total_receive_vetran.toFixed(3));
        $('#total_receive_v_pcs').html(total_receive_v_pcs.toFixed(0));
        $('#total_receive_stone_pcs').html(total_receive_stone_pcs.toFixed(0));
        $('#total_receive_stone_weight').html(total_receive_stone_weight.toFixed(3));
        $('#total_receive_stone_charges').html(total_receive_stone_charges.toFixed(3));
        $('#total_receive_moti').html(total_receive_moti.toFixed(3));
        $('#total_receive_moti_amount').html(total_receive_moti_amount.toFixed(2));
        $('#total_receive_other_charges').html(total_receive_other_charges.toFixed(2));
        $('#total_receive_loss').html(total_receive_loss.toFixed(3));
        $('#total_receive_loss_fine').html(total_receive_loss_fine.toFixed(3));

        balance_gross = total_issue_gross - total_receive_gross;
        balance_touch = total_issue_touch - total_receive_touch;
        balance_wastage = total_issue_wastage - total_receive_wastage;
        balance_fine = total_issue_fine - total_receive_fine;
        balance_ad_weight = total_issue_ad_weight - total_receive_ad_weight;
        balance_ad_pcs = total_issue_ad_pcs - total_receive_ad_pcs;
        balance_before_meena = total_issue_before_meena - total_receive_before_meena;
        balance_meena_wt = total_issue_meena_wt - total_receive_meena_wt;
        balance_item_weight = total_issue_item_weight - total_receive_item_weight;
        balance_kundan = total_issue_kundan - total_receive_kundan;
        balance_sm = total_issue_sm - total_receive_sm;
        balance_vetran = total_issue_vetran - total_receive_vetran;
        balance_v_pcs = total_issue_v_pcs - total_receive_v_pcs;
        balance_stone_pcs = total_issue_stone_pcs - total_receive_stone_pcs;
        balance_stone_weight = total_issue_stone_weight - total_receive_stone_weight;
        balance_stone_charges = total_issue_stone_charges - total_receive_stone_charges;
        balance_moti = total_issue_moti - total_receive_moti;
        balance_moti_amount = total_issue_moti_amount - total_receive_moti_amount;
        balance_other_charges = total_issue_other_charges - total_receive_other_charges;
        balance_loss = total_issue_loss - total_receive_loss;
        balance_loss_fine = total_issue_loss_fine - total_receive_loss_fine;

        $('#balance_gross').html(balance_gross.toFixed(3));
        $('#balance_touch').html(balance_touch.toFixed(2));
        $('#balance_wastage').html(balance_wastage.toFixed(3));
        $('#balance_fine').html(balance_fine.toFixed(3));
        $('#balance_ad_weight').html(balance_ad_weight.toFixed(3));
        $('#balance_ad_pcs').html(balance_ad_pcs.toFixed(0));
        $('#balance_before_meena').html(balance_before_meena.toFixed(3));
        $('#balance_meena_wt').html(balance_meena_wt.toFixed(3));
        $('#balance_item_weight').html(balance_item_weight.toFixed(3));
        $('#balance_kundan').html(balance_kundan.toFixed(3));
        $('#balance_sm').html(balance_sm.toFixed(3));
        $('#balance_vetran').html(balance_vetran.toFixed(3));
        $('#balance_v_pcs').html(balance_v_pcs.toFixed(0));
        $('#balance_stone_pcs').html(balance_stone_pcs.toFixed(0));
        $('#balance_stone_weight').html(balance_stone_weight.toFixed(3));
        $('#balance_stone_charges').html(balance_stone_charges.toFixed(3));
        $('#balance_moti').html(balance_moti.toFixed(3));
        $('#balance_moti_amount').html(balance_moti_amount.toFixed(2));
        $('#balance_other_charges').html(balance_other_charges.toFixed(2));
        $('#balance_loss').html(balance_loss.toFixed(3));
        $('#balance_loss_fine').html(balance_loss_fine.toFixed(3));

        $("#loss_allowed").val('');
        rfw_firstline_job_worker_um_on = 0;
        if(rfw_firstline_job_worker_id != ''){
            $.ajax({
                url: "<?= base_url('app/get_job_worker_detail/') ?>" + rfw_firstline_job_worker_id,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                async: false,
                success: function (response) {
                    if(response.status == 'success') {
                        $("#loss_allowed").val(response.wastage_loss_allowed).trigger("change");
                        rfw_firstline_job_worker_um_on = response.used_moti_on;
                    }
                }
            });
        }

        $('#total_issue_vetran_item_gross').html(total_issue_vetran_item_gross.toFixed(3));
        $('#total_receive_vetran_item_gross').html(total_receive_vetran_item_gross.toFixed(3));
        used_vetran = parseFloat(total_issue_vetran_item_gross) - parseFloat(total_receive_vetran_item_gross);
        used_vetran = parseFloat(used_vetran).toFixed(3);
        $('#used_vetran').html(used_vetran);

        // Used Moti calculation base on RFW 1st lineitem Person master checkbox : 'If you want Used Moti = Issue Moti - Receive Moti, tick here (Not tick means it will depend on weight)'
        if(rfw_firstline_job_worker_um_on == 1){
            used_moti = parseFloat(total_issue_moti) - parseFloat(total_receive_moti);
        } else {
            used_moti = parseFloat(total_receive_finish_gross) - parseFloat(total_issue_finish_gross) - parseFloat(used_vetran);
        }
        used_moti = parseFloat(used_moti).toFixed(3);
        $('#used_moti').html(used_moti);

        // Bandhnu Moti Amount based on Used Moti
        var new_balance_moti_amount = parseFloat(used_moti) * parseFloat(balance_moti_amount) / parseFloat(balance_moti || 1);
        $('#balance_moti_amount').html(new_balance_moti_amount.toFixed(2));

        bandhanu_issue = parseFloat(used_moti) + parseFloat(total_issue_finish_gross) + parseFloat(total_issue_scrap_gross);
        bandhanu_issue = parseFloat(bandhanu_issue).toFixed(3);
        $('#bandhanu_issue').html(bandhanu_issue);
        bandhanu_receive = parseFloat(total_receive_finish_gross) + parseFloat(total_receive_scrap_gross);
        bandhanu_receive = parseFloat(bandhanu_receive).toFixed(3);
        $('#bandhanu_receive').html(bandhanu_receive);
        balance_bandhanu = parseFloat(total_issue_finish_gross) + parseFloat(total_issue_scrap_gross) - parseFloat(total_receive_finish_gross) - parseFloat(used_moti) - parseFloat(used_vetran);
        balance_bandhanu = parseFloat(balance_bandhanu).toFixed(3);
        $('#balance_bandhanu').html(balance_bandhanu);

        $('#ajax-loader').hide();
        // If any one Lineitem is added then Process not allow to change
        if($.isEmptyObject(lineitem_objectdata)){
            $('#process_id').removeAttr('disabled','disabled');
            $('#after_disabled_process_id').remove();
        } else {
            var process_id = $('#process_id').val();
            if(process_id != '' && process_id != null){
                $('#process_id').attr('disabled','disabled');
                $('#process_id').closest('div').append('<input type="hidden" name="process_id" id="after_disabled_process_id" value="' + process_id + '" />');
                $("#after_disabled_process_id").trigger("change");
            }
        }
//        setTimeout(function(){ process_dynamic_columns_fun(); }, 2000);
    }
    function edit_lineitem(index) {
        var value = lineitem_objectdata[index];
        $("#line_items_index").val(index);
        if (typeof (value.manufacture_ir_id) !== "undefined" && value.manufacture_ir_id !== null && value.manufacture_ir_id != 0) {
            $("#manufacture_ir_id").val(value.manufacture_ir_id);
            $("#type_id").attr("disabled","disabled");
        } else {
            $("#type_id").removeAttr("disabled");
            $("#manufacture_ir_id").val(0);
        }        
        $("#type_id").val(value.type_id).trigger("change");
        $("#ir_date").datepicker("setDate",value.ir_date);
//        $("#item_id").val(null).trigger("change");
        setSelect2Value($("#item_id"), "<?= base_url('app/set_item_select2_val_by_id/') ?>" + value.item_id);
//        $("#job_worker_id").val(null).trigger("change");
        setSelect2Value($("#job_worker_id"), "<?= base_url('app/set_job_worker_select2_val_by_id/') ?>" + value.job_worker_id);
        $("#gross").val(value.gross);
        $("#touch").val(value.touch);
        $("#wastage").val(value.wastage);
        $("#fine").val(value.fine);
        $("#ad_weight").val(value.ad_weight);
        $("#ad_pcs").val(value.ad_pcs);
        $("#before_meena").val(value.before_meena);
        $("#meena_wt").val(value.meena_wt);
        $("#item_weight").val(value.item_weight);
        $("#kundan").val(value.kundan);
        $("#sm").val(value.sm);
        $("#vetran").val(value.vetran);
        $("#v_pcs").val(value.v_pcs);
        $("#stone_pcs").val(value.stone_pcs);
        $("#stone_weight").val(value.stone_weight);
        $("#stone_charges").val(value.stone_charges);
        $("#moti").val(value.moti);
        $("#moti_amount").val(value.moti_amount);
        $("#other_charges").val(value.other_charges);
        $("#loss").val(value.loss);
        $("#loss_fine").val(value.loss_fine);
        $("#item_remark").val(value.item_remark);

        if (typeof (value.gross_details) != "undefined" && value.gross_details !== null) {
            var value_gross_details = value.gross_details;
            if(value_gross_details != ''){
                gross_details_objectdata = JSON.parse(value_gross_details);
            }
        }

        if (typeof (value.stone_pcs_details) != "undefined" && value.stone_pcs_details !== null) {
            var value_stone_pcs_details = value.stone_pcs_details;
            if(value_stone_pcs_details != ''){
                stone_pcs_details_objectdata = JSON.parse(value_stone_pcs_details);
            }
        }

        if (typeof (value.moti_details) != "undefined" && value.moti_details !== null) {
            var value_moti_details = value.moti_details;
            if(value_moti_details != ''){
                moti_details_objectdata = JSON.parse(value_moti_details);
            }
        }

        if (typeof (value.other_charges_details) != "undefined" && value.other_charges_details !== null) {
            var value_other_charges_details = value.other_charges_details;
            if(value_other_charges_details != ''){
                other_charges_details_objectdata = JSON.parse(value_other_charges_details);
            }
        }
    }
    function remove_lineitem(index) {
        if (confirm('Are you sure ?')) {
            lineitem_objectdata.splice(index, 1);
            display_lineitem_html(lineitem_objectdata);
        }
    }

    function display_gross_details_html(gross_details_objectdata) {
        $('#ajax-loader').show();
        var gross_details_html = '';
        var total_gross_details_weight = 0;

        $.each(gross_details_objectdata, function (index, value) {
            var gross_details_edit_btn = '';
            var gross_details_delete_btn = '';
            var gross_detail_weight = parseFloat(value.gross_detail_weight) || 0;
            gross_detail_weight = setRoundOf(gross_detail_weight, 2).toFixed(3);
            gross_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_stone_pcs_item edit_gross_details_' + index + '" href="javascript:void(0);" onclick="edit_gross_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            gross_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_stone_pcs_item" href="javascript:void(0);" onclick="remove_gross_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    gross_details_edit_btn +
                    gross_details_delete_btn +
                    '</td>' +
                    '<td class="text-right">' + value.item_name + '</td>' +
                    '<td class="text-right">' + gross_detail_weight + '</td>';
            total_gross_details_weight = parseFloat(total_gross_details_weight) + parseFloat(gross_detail_weight);
            gross_details_html += row_html;
        });
        $('#gross_details_list').html(gross_details_html);
        $('#total_gross_details_weight').html(total_gross_details_weight.toFixed(3));
        $('#ajax-loader').hide();
    }
    function edit_gross_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_stone_pcs_item").addClass('hide');
        gross_details_index = index;
        if (edit_gross_details_inc == 0) {
            edit_gross_details_inc = 1;
            $(".add_gross_details").removeAttr("disabled");
        }
        var value = gross_details_objectdata[index];
        $("#gross_details_index").val(index);
        $("#gross_details_delete").val(value.gross_details_delete);
        if(typeof(value.gross_details_id) !== "undefined" && value.gross_details_id !== null) {
            $("#gross_details_id").val(value.gross_details_id);
        }
        $("#gross_detail_item_id").val(null).trigger("change");
        setSelect2Value($("#gross_detail_item_id"), "<?= base_url('app/set_item_select2_val_by_id/') ?>" + value.gross_detail_item_id);
        $("#gross_detail_weight").val(value.gross_detail_weight);
        $('#ajax-loader').hide();
    }
    function remove_gross_details(index) {
        value = gross_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            gross_details_objectdata.splice(index, 1);
            display_gross_details_html(gross_details_objectdata);
        }
    }

    function display_stone_pcs_details_html(stone_pcs_details_objectdata) {
        $('#ajax-loader').show();
        var stone_pcs_details_html = '';
        var total_stone_pcs_details_pcs = 0;
        var total_stone_pcs_details_weight = 0;
        var total_stone_pcs_details_amount = 0;

        $.each(stone_pcs_details_objectdata, function (index, value) {

            var stone_pcs_details_edit_btn = '';
            var stone_pcs_details_delete_btn = '';
            var stone_detail_pcs = parseFloat(value.stone_detail_pcs) || 0;
            stone_detail_pcs = stone_detail_pcs.toFixed(0);
            var stone_detail_weight = parseFloat(value.stone_detail_weight) || 0;
            stone_detail_weight = setRoundOf(stone_detail_weight, 2).toFixed(3);
            var stone_detail_rate = parseFloat(value.stone_detail_rate) || 0;
            stone_detail_rate = setRoundOf(stone_detail_rate, 2).toFixed(2);
            var stone_detail_amount = parseFloat(value.stone_detail_amount) || 0;
            stone_detail_amount = setRoundOf(stone_detail_amount, 2).toFixed(2);
            stone_pcs_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_stone_pcs_item edit_stone_pcs_details_' + index + '" href="javascript:void(0);" onclick="edit_stone_pcs_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            stone_pcs_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_stone_pcs_item" href="javascript:void(0);" onclick="remove_stone_pcs_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    stone_pcs_details_edit_btn +
                    stone_pcs_details_delete_btn +
                    '</td>' +
                    '<td class="text-right">' + stone_detail_pcs + '</td>' +
                    '<td class="text-right">' + stone_detail_weight + '</td>' +
                    '<td class="text-right">' + stone_detail_rate + '</td>' +
                    '<td class="text-right">' + stone_detail_amount + '</td>';
            total_stone_pcs_details_pcs = parseFloat(total_stone_pcs_details_pcs) + parseFloat(stone_detail_pcs);
            total_stone_pcs_details_weight = parseFloat(total_stone_pcs_details_weight) + parseFloat(stone_detail_weight);
            total_stone_pcs_details_amount = parseFloat(total_stone_pcs_details_amount) + parseFloat(stone_detail_amount);
            stone_pcs_details_html += row_html;
        });
        $('#stone_pcs_details_list').html(stone_pcs_details_html);
        $('#total_stone_pcs_details_pcs').html(total_stone_pcs_details_pcs.toFixed(0));
        $('#total_stone_pcs_details_weight').html(total_stone_pcs_details_weight.toFixed(3));
        $('#total_stone_pcs_details_amount').html(total_stone_pcs_details_amount.toFixed(2));
        $('#ajax-loader').hide();
    }
    function edit_stone_pcs_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_stone_pcs_item").addClass('hide');
        stone_pcs_details_index = index;
        if (edit_stone_pcs_details_inc == 0) {
            edit_stone_pcs_details_inc = 1;
            $(".add_stone_pcs_details").removeAttr("disabled");
        }
        var value = stone_pcs_details_objectdata[index];
        $("#stone_pcs_details_index").val(index);
        $("#stone_pcs_details_delete").val(value.stone_pcs_details_delete);
        if(typeof(value.stone_pcs_details_id) !== "undefined" && value.stone_pcs_details_id !== null) {
            $("#stone_pcs_details_id").val(value.stone_pcs_details_id);
        }
        $("#stone_detail_pcs").val(value.stone_detail_pcs);
        $("#stone_detail_weight").val(value.stone_detail_weight);
        $("#stone_detail_rate").val(value.stone_detail_rate);
        $("#stone_detail_amount").val(value.stone_detail_amount);
        $('#ajax-loader').hide();
    }
    function remove_stone_pcs_details(index) {
        value = stone_pcs_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            stone_pcs_details_objectdata.splice(index, 1);
            display_stone_pcs_details_html(stone_pcs_details_objectdata);
        }
    }

    function display_moti_details_html(moti_details_objectdata) {
        $('#ajax-loader').show();
        var moti_details_html = '';
        var total_moti_details_weight = 0;
        var total_moti_details_amount = 0;

        $.each(moti_details_objectdata, function (index, value) {

            var moti_details_edit_btn = '';
            var moti_details_delete_btn = '';
            var moti_weight = parseFloat(value.moti_weight) || 0;
            moti_weight = setRoundOf(moti_weight, 2).toFixed(3);
            var moti_rate = parseFloat(value.moti_rate) || 0;
            moti_rate = setRoundOf(moti_rate, 2).toFixed(2);
            var moti_detail_amount = parseFloat(value.moti_detail_amount) || 0;
            moti_detail_amount = setRoundOf(moti_detail_amount, 2).toFixed(2);
            moti_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_moti_item edit_moti_details_' + index + '" href="javascript:void(0);" onclick="edit_moti_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            moti_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_moti_item" href="javascript:void(0);" onclick="remove_moti_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    moti_details_edit_btn +
                    moti_details_delete_btn +
                    '</td>' +
                    '<td>' + value.moti_name + '</td>' +
                    '<td class="text-right">' + moti_weight + '</td>' +
                    '<td class="text-right">' + moti_rate + '</td>' +
                    '<td class="text-right">' + moti_detail_amount + '</td>';
            total_moti_details_weight = parseFloat(total_moti_details_weight) + parseFloat(moti_weight);
            total_moti_details_amount = parseFloat(total_moti_details_amount) + parseFloat(moti_detail_amount);
            moti_details_html += row_html;
        });
        $('#moti_details_list').html(moti_details_html);
        $('#total_moti_details_weight').html(total_moti_details_weight.toFixed(3));
        $('#total_moti_details_amount').html(total_moti_details_amount.toFixed(2));
        $('#ajax-loader').hide();
    }
    function edit_moti_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_moti_item").addClass('hide');
        moti_details_index = index;
        if (edit_moti_details_inc == 0) {
            edit_moti_details_inc = 1;
            $(".add_moti_details").removeAttr("disabled");
        }
        var value = moti_details_objectdata[index];
        $("#moti_details_index").val(index);
        $("#moti_details_delete").val(value.moti_details_delete);
        if(typeof(value.moti_details_id) !== "undefined" && value.moti_details_id !== null) {
            $("#moti_details_id").val(value.moti_details_id);
        }
        $("#moti_id").val(null).trigger("change");
        setSelect2Value($("#moti_id"), "<?= base_url('app/set_moti_select2_val_by_id/') ?>" + value.moti_id);
        $("#moti_weight").val(value.moti_weight);
        $("#moti_rate").val(value.moti_rate);
        $("#moti_detail_amount").val(value.moti_detail_amount);
        $('#ajax-loader').hide();
    }
    function remove_moti_details(index) {
        value = moti_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            moti_details_objectdata.splice(index, 1);
            display_moti_details_html(moti_details_objectdata);
        }
    }

    function display_other_charges_details_html(other_charges_details_objectdata) {
        $('#ajax-loader').show();
        var other_charges_details_html = '';
        var total_other_charges_details_amount = 0;

        $.each(other_charges_details_objectdata, function (index, value) {

            var other_charges_details_edit_btn = '';
            var other_charges_details_delete_btn = '';
            var charges_amount = parseFloat(value.charges_amount) || 0;
            charges_amount = setRoundOf(charges_amount, 2).toFixed(2);
            other_charges_details_edit_btn = '<a class="btn btn-xs btn-primary btn-edit-item edit_charges_item edit_other_charges_details_' + index + '" href="javascript:void(0);" onclick="edit_other_charges_details(' + index + ')"><i class="fa fa-edit"></i></a> ';
            other_charges_details_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item delete_charges_item" href="javascript:void(0);" onclick="remove_other_charges_details(' + index + ')"><i class="fa fa-trash"></i></a>';
            var row_html = '<tr class="lineitem_index_' + index + '"><td class="">' +
                    other_charges_details_edit_btn +
                    other_charges_details_delete_btn +
                    '</td>' +
                    '<td>' + value.charges_name + '</td>' +
                    '<td class="text-right">' + charges_amount + '</td>';
            total_other_charges_details_amount = parseFloat(total_other_charges_details_amount) + parseFloat(charges_amount);
            other_charges_details_html += row_html;
        });
        $('#other_charges_details_list').html(other_charges_details_html);
        $('#total_other_charges_details_amount').html(total_other_charges_details_amount.toFixed(2));
        $('#ajax-loader').hide();
    }
    function edit_other_charges_details(index) {
        $("html, body").animate({scrollTop: 0}, "slow");
        $('#ajax-loader').show();
        $(".delete_charges_item").addClass('hide');
        other_charges_details_index = index;
        if (edit_other_charges_details_inc == 0) {
            edit_other_charges_details_inc = 1;
            $(".add_other_charges_details").removeAttr("disabled");
        }
        var value = other_charges_details_objectdata[index];
        $("#other_charges_details_index").val(index);
        $("#other_charges_details_delete").val(value.other_charges_details_delete);
        if(typeof(value.other_charges_details_id) !== "undefined" && value.other_charges_details_id !== null) {
            $("#other_charges_details_id").val(value.other_charges_details_id);
        }
        $("#charges_id").val(null).trigger("change");
        setSelect2Value($("#charges_id"), "<?= base_url('app/set_charges_select2_val_by_id/') ?>" + value.charges_id);
        $("#charges_amount").val(value.charges_amount);
        $('#ajax-loader').hide();
    }
    function remove_other_charges_details(index) {
        value = other_charges_details_objectdata[index];
        if (confirm('Are you sure ?')) {
            other_charges_details_objectdata.splice(index, 1);
            display_other_charges_details_html(other_charges_details_objectdata);
        }
    }

    function set_jon_card_detail() {
        var job_card_id = $("#job_card_id").val();
        $("#party").val('');
        $("#melting").val('');

        if(job_card_id != '') {
            $.ajax({
                url: "<?= base_url('app/get_job_card_detail/') ?>" + job_card_id,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success') {
                        $("#party").val(response.party_name);
                        $("#melting").val(response.melting);        
                        $("#touch").val($("#melting").val()).trigger("change");

//                        var touch = parseFloat($("#touch").val()) || 0;
//                        var net_weight = parseFloat($("#net_weight").val()) || 0;
//
//                        var fine = (+net_weight * +touch) / 100;
//                        $("#fine").val(fine.toFixed(3));
//
//                        display_lineitem_html(lineitem_objectdata);
                    } 
                }
            });
        }
    }

    function process_dynamic_columns_fun(){
        console.log('process_dynamic_columns : ' + process_dynamic_issue_columns);
        $.each(process_dynamic_issue_columns, function(f_index, f_value){
            $('table.issue_table .dynamic_column.'+ f_value).removeClass('d-none');
//            $('.dynamic_column.'+ f_value).removeClass('d-none');
        });
        $.each(process_dynamic_receive_columns, function(f_index, f_value){
            $('table.receive_table .dynamic_column.'+ f_value).removeClass('d-none');
//            $('.dynamic_column.'+ f_value).removeClass('d-none');
        });
    }

    function process_dynamic_fields_fun(){
        $.each(process_dynamic_fields, function(f_index, f_value){
            $('.dynamic_field.'+ f_value).removeClass('d-none');
        });
    }

    function get_process_columns() {
        var process_id = $("#process_id").val();
        if(process_id != '') {
            $.ajax({
                url: "<?= base_url('app/get_process_ir_columns/') ?>" + process_id,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function (res) {
                    process_columns = res.columns;
                    tmp_process_id = process_id;

                    hide_show_process_columns();
                }
            });
        }
    }
    function hide_show_process_columns() {
        var issue_type = '';
        var issue_ad_weight = '';
        var issue_ad_pcs = '';

        var receive_type = '';
        var receive_ad_weight = '';
        var receive_ad_pcs = '';
        
        $.each(process_columns,function(ind,value){
            if(value == "hide") {
                $('.c_'+ind).hide();
                $('.r_'+ind).hide();
            } else {
                $('.c_'+ind).show();
                $('.r_'+ind).show();
            }

            if(ind == 'issue_type') {
                issue_type = value;
            }

            if(ind == 'receive_type') {
                receive_type = value;
            }
        });

        if(receive_type == "show" || receive_type == '') {
            $(".r_columns[colspan='2']").attr('colspan',3);
        } else {
            $(".r_columns[colspan='3']").attr('colspan',2);
        }

        if(issue_type == "show" || issue_type == '') {
            $(".i_columns[colspan='2']").attr('colspan',3);   
        } else {
            $(".i_columns[colspan='3']").attr('colspan',2);
        }
        $(".person_wise_receive_ad_pcs").attr('colspan',$('thead tr th.r_columns:visible').length);

        if($("thead tr th.c_receive_ad_pcs").is(":visible")) {
            $(".person_wise_receive_ad_pcs").show();
            $("tr.person_wise_balance").show();
        } else {
            $(".person_wise_receive_ad_pcs").hide();
            $("tr.person_wise_balance").hide();
        }        
    }

    function setRoundOf(value, exp) {
        if (typeof exp === 'undefined' || +exp === 0)
          return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
          return NaN;

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    } // varname = setRoundOf(varname, 2).toFixed(2);

    function upload_file_upload(input) {
        if (input.files && input.files[0]) {
//            console.log(input.files);
            $("#ajax-loader").show();
            var form = new FormData();
            var myFormData = document.getElementById('file_upload').files[0];
            form.append('file_upload', myFormData);
            form.append('action', 'get_temp_path');
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                data: form,
                url: "<?= base_url('manufacture/get_temp_path_image') ?>",
                success: function (html) {
                    $('#image').val(html);
                    $("#ajax-loader").hide();
                }
            });
        }
    }
    
    (function($) {
	function visible(element) {
		return $.expr.filters.visible(element) && !$(element).parents().addBack().filter(function() {
			return $.css(this, 'visibility') === 'hidden';
		}).length;
	}

	function focusable(element, isTabIndexNotNaN) {
		var map, mapName, img, nodeName = element.nodeName.toLowerCase();
		if ('area' === nodeName) {
			map = element.parentNode;
			mapName = map.name;
			if (!element.href || !mapName || map.nodeName.toLowerCase() !== 'map') {
				return false;
			}
			img = $('img[usemap=#' + mapName + ']')[0];
			return !!img && visible(img);
		}
		return (/input|select|textarea|button|object/.test(nodeName) ?
			!element.disabled :
			'a' === nodeName ?
				element.href || isTabIndexNotNaN :
				isTabIndexNotNaN) &&
			// the element and all of its ancestors must be visible
			visible(element);
	}

	$.extend($.expr[':'], {
		focusable: function(element) {
			return focusable(element, !isNaN($.attr(element, 'tabindex')));
		}
	});
    })(jQuery);
</script>
<?php
    $this->load->view('footer');
?>