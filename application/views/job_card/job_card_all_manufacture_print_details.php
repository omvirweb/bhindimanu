<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 pr-0">
                            <div class="form-group">
                                <label for="process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"> Process<span style="color:red"> *</span></label>
                                <select name="process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" id="process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" class="form-control" data-index="2" ></select>
                            </div>
                        </div>
                        <div class="col-md-2 pr-0 ">
                            <div class="form-group">
                                <label for="close_to_calculate_loss"> Calculate Loss</label>
                                <select class="form-control select2" data-index="3" disabled="">
                                    <option value="1" <?php echo isset($manufacture_row->close_to_calculate_loss) && $manufacture_row->close_to_calculate_loss == 1 ? 'selected' : ''; ?> >Open</option>
                                    <option value="2" <?php echo isset($manufacture_row->close_to_calculate_loss) && $manufacture_row->close_to_calculate_loss == 2 ? 'selected' : ''; ?> >Close</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="form-group">
                                <label for="remark"> Remark</label>
                                <textarea class="form-control" rows="1" data-index="4"><?php echo isset($manufacture_row->remark) ? $manufacture_row->remark : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4 style="text-align: center">Issue Table</h4>
                            <div class="table-responsive">
                                <table style="border-color: #dee2e6;" class="table custom-table item-table issue_table<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" border='1'>
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
                                    <tbody id="issue_lineitem_list<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></tbody>
                                    <tfoot>
                                        <tr class="i_rows r_issue_total_finish">
                                            <th class="i_columns" colspan="3">Total Finish</th>
                                            <th class="i_columns c_issue_person"></th>
                                            <th class="i_columns c_issue_item"></th>
                                            <th class="i_columns text-right" id="total_issue_finish_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right" id="total_issue_finish_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_finish_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right" id="total_issue_finish_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_finish_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_finish_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_finish_before_meena"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_finish_meena_wt"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_finish_item_weight"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_finish_kundan"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_finish_sm"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_finish_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_finish_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_finish_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_finish_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_finish_stone_charges"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_finish_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_finish_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
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
                                            <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_scrap_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right" id="total_issue_scrap_fine"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_scrap_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_scrap_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_scrap_before_meena"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_scrap_meena_wt"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_scrap_item_weight"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_scrap_kundan"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_scrap_sm"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_scrap_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_scrap_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_scrap_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_scrap_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_scrap_stone_charges"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_scrap_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_scrap_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
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
                                            <th class="i_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_issue_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right" id="total_issue_fine"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_issue_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_issue_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_before_meena d-none" id="total_issue_before_meena"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_meena_wt d-none" id="total_issue_meena_wt"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_item_weight d-none" id="total_issue_item_weight"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_kundan d-none" id="total_issue_kundan"></th>-->
                                            <!--<th class="i_columns text-right dynamic_column prf_sm d-none" id="total_issue_sm"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_issue_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_issue_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_issue_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_issue_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <!--<th class="i_columns text-right dynamic_column prf_stone_charges d-none" id="total_issue_stone_charges"></th>-->
                                            <th class="i_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_issue_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="i_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_issue_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
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
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4 style="text-align: center">Receive Table</h4>
                            <div class="table-responsive">
                                <table style="border-color: #dee2e6;" class="table custom-table item-table receive_table<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" border = '1'>
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
                                    <tbody id="receive_lineitem_list<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></tbody>
                                    <tfoot>
                                        <tr class="s_rows r_receive_total_finish">
                                            <th class="r_columns" colspan="3">Total Finish</th>
                                            <th class="r_columns c_receive_person"></th>
                                            <th class="r_columns c_receive_item"></th>
                                            <th class="r_columns text-right" id="total_receive_finish_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns  text-right" id="total_receive_finish_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_finish_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns  text-right" id="total_receive_finish_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_finish_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_finish_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_finish_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_finish_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_finish_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_finish_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_finish_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_finish_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_finish_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_finish_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_finish_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_finish_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_finish_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_finish_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_finish_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_finish_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_finish_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns"></th>
                                            <th class="r_columns"></th>
                                        </tr>
                                        <tr class="s_rows r_receive_total_scrap">
                                            <th class="r_columns" colspan="3">Total Scrap</th>
                                            <th class="r_columns c_receive_person"></th>
                                            <th class="r_columns c_receive_item"></th>
                                            <th class="r_columns text-right" id="total_receive_scrap_gross"></th>
                                            <th class="r_columns text-right" id="total_receive_scrap_touch"></th>
                                            <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_scrap_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right" id="total_receive_scrap_fine"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_scrap_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_scrap_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_scrap_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_scrap_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_scrap_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_scrap_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_scrap_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_scrap_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_scrap_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_scrap_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_scrap_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_scrap_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_scrap_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_scrap_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_scrap_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_scrap_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_scrap_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns"></th>
                                            <th class="r_columns"></th>
                                        </tr>
                                        <tr class="s_rows r_receive_total">
                                            <th class="r_columns" colspan="3">Total Receive</th>
                                            <th class="r_columns c_receive_person"></th>
                                            <th class="r_columns c_receive_item"></th>
                                            <th class="r_columns text-right" id="total_receive_gross"></th>
                                            <th class="r_columns text-right" id="total_receive_touch"></th>
                                            <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="total_receive_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right" id="total_receive_fine"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="total_receive_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="total_receive_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="total_receive_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="total_receive_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="total_receive_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_kundan d-none" id="total_receive_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_sm d-none" id="total_receive_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="total_receive_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="total_receive_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="total_receive_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="total_receive_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="total_receive_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="total_receive_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="total_receive_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="total_receive_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss d-none" id="total_receive_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="total_receive_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns"></th>
                                            <th class="r_columns"></th>
                                        </tr>
                                        <tr class="balance_row bg-success">
                                            <th colspan="3" class="r_columns row_label">Balance</th>
                                            <th class="r_columns c_receive_person"></th>
                                            <th class="r_columns c_receive_item"></th>
                                            <th class="r_columns text-right" id="balance_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right" id="balance_touch_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_wastage prf_wastage d-none" id="balance_wastage_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right" id="balance_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_weight prf_ad_weight d-none" id="balance_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_ad_pcs prf_ad_pcs d-none" id="balance_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_before_meena d-none" id="balance_before_meena_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_meena_wt d-none" id="balance_meena_wt_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_item_weight d-none" id="balance_item_weight_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_kundan d-none" id="balance_kundan_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_sm d-none" id="balance_sm_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_vetran prf_vetran d-none" id="balance_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_v_pcs prf_v_pcs d-none" id="balance_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_pcs prf_stone_pcs d-none" id="balance_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_stone_wt prf_stone_wt d-none" id="balance_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_stone_charges d-none" id="balance_stone_charges_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti prf_moti d-none" id="balance_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column pif_moti_amount prf_moti_amount d-none" id="balance_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_other_charges d-none" id="balance_other_charges_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss d-none" id="balance_loss_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns text-right dynamic_column prf_loss_fine d-none" id="balance_loss_fine_noneed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></th>
                                            <th class="r_columns"></th>
                                            <th class="r_columns"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row vetran_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> d-none">
                        <div class="col-sm-6 pr-0">
                            <label for="total_issue_vetran_item_gross" style="font-size: 12px;">Vetran Item Issue Total : <span id="total_issue_vetran_item_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" style="font-weight: 500;"></span></label>
                        </div>
                        <div class="col-sm-6 pr-0">
                            <label for="total_receive_vetran_item_gross" style="font-size: 12px;">Vetran Item Receive Total : <span id="total_receive_vetran_item_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" style="font-weight: 500;"></span></label>
                        </div>
                        <div class="col-sm-12 pr-0"></div>
                        <div class="col-sm-6 pr-0">
                            <label for="used_vetran" style="font-size: 12px;">Used Vetran : <span id="used_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" style="font-weight: 500;"></span></label>
                        </div>
                        <div class="col-sm-6 pr-0">
                            <label for="used_moti" style="font-size: 12px;">Used Moti : <span id="used_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" style="font-weight: 500;"></span></label>
                        </div>
                        <div class="col-sm-12 pr-0"></div>
                        <div class="col-sm-12 bg-success">
                            <label for="bandhanu_issue" style="font-size: 14px; padding-right: 5px; border-right: 1px solid #fff;">
                                Bandhanu Issue: <span id="bandhanu_issue<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></span>
                                <br><small>( `Bandhanu Issue` : Used Moti + Ifw Gross + Is Gross) </small>
                            </label>
                            <label for="bandhanu_receive" style="font-size: 14px;">
                                Bandhanu Receive: <span id="bandhanu_receive<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></span>
                                <br><small>( `Bandhanu Receive` : RFW Gross + Rs Gross)</small>
                            </label>
                        </div>
                        <div class="col-sm-12 pr-0"></div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12 bg-success">
                            <label for="balance_bandhanu" style="font-size: 14px;">Balance Bandhanu : <span id="balance_bandhanu<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></span></label>
                            <br><small>( `Balance Bandhanu` : Ifw Gross + Is Gross - RFW Gross - Used Moti - Used Vetran )</small>
                        </div>
                    </div>
                    <div class="row loss_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>1 d-none">
                        <div class="col-sm-1 pr-0">
                            <div class="form-group">
                                <label for="loss_allowed" style="font-size: 12px;"> Loss Allowed</label>
                                <input type="text" name="loss_allowed" id="loss_allowed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" class="form-control num_only">
                            </div>
                        </div>
                        <div class="col-sm-1 pr-0">
                            <div class="form-group">
                                <label for="loss_allowed" style="font-size: 12px;"> Allowed</label>
                                <input type="text" name="allowed" id="allowed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" class="form-control num_only" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-1 pr-0">
                            <div class="form-group">
                                <label for="actual_loss" style="font-size: 12px;"> Actual Loss</label>
                                <input type="text" name="actual_loss" id="actual_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" class="form-control num_only" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-3 pr-0">
                            <div class="form-group">
                                <label for="loss_receivable_payable" style="font-size: 12px;"> Loss Receivable / Payable</label><br>
                                <span id="loss_receivable_payable<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"></span>
                            </div>
                        </div>
                    </div>
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

<script type="text/javascript">
    var lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = [];
    var process_dynamic_issue_columns<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = <?php echo $selected_process_issue_fields; ?>;
    var process_dynamic_receive_columns<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = <?php echo $selected_process_receive_fields; ?>;

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
    var process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = '<?php echo $manufacture_row->process_id; ?>';
    $(document).ready(function(){

        <?php if (isset($lineitem_objectdata)) { ?>
        var li_lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = <?php echo $lineitem_objectdata; ?>;
        if (li_lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> != '') {
            $.each(li_lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>, function (index, value) {
                lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>.push(value);
            });
        }
//        console.log(lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>);
        <?php } ?>

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

        initAjaxSelect2($("#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"), "<?= base_url('app/process_select2_source') ?>");
        <?php if(isset($manufacture_row->process_id)){ ?>
            setSelect2Value($("#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"),"<?=base_url('app/set_process_select2_val_by_id/'.$manufacture_row->process_id)?>");
            $('#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').val(<?php echo $manufacture_row->process_id; ?>).trigger("change");
        <?php }  ?>

//        alert(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>);
        process_dynamic_columns_fun<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>();
        $('.vetran_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').addClass('d-none');
        if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo BANDHANU_PROCESS_ID; ?>') {
            $('.vetran_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').removeClass('d-none');
        }
        $('.loss_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').addClass('d-none');
        if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo POLISH_PROCESS_ID; ?>' || process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo SETTINGS_PROCESS_ID; ?>' || process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo MEENA_PROCESS_ID; ?>') {
            $('.loss_details<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').removeClass('d-none');
        }

        $(document).on('click', '.item_photo_modal', function () {
            var src = $(this).data("img_src");
            setTimeout(function () {
                $("#doc_img_src").attr('src', src);
            }, 0);
            $('#viewImageModal').modal('show');
        });

        $(document).on('keyup change', '#loss_allowed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>', function () {
            var loss_allowed = $('#loss_allowed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').val() || 0;
            if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo MEENA_PROCESS_ID; ?>') {
                var allowed = parseFloat(total_issue_finish_gross) * parseFloat(loss_allowed) / 100;
//                allowed = setRoundOf(allowed, 2).toFixed(3);
                allowed = parseFloat(allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) - parseFloat(total_receive_scrap_gross) - parseFloat(total_receive_before_meena);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo SETTINGS_PROCESS_ID; ?>') {
//                allowed = setRoundOf(loss_allowed, 2).toFixed(3);
                allowed = parseFloat(loss_allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) + parseFloat(total_issue_ad_weight) - parseFloat(total_receive_gross) - parseFloat(total_receive_ad_weight);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> == '<?php echo POLISH_PROCESS_ID; ?>') {
                var allowed = parseFloat(total_issue_finish_gross) * parseFloat(loss_allowed) / 100;
//                allowed = setRoundOf(allowed, 2).toFixed(3);
                allowed = parseFloat(allowed).toFixed(3);
                var actual_loss = parseFloat(total_issue_finish_gross) - parseFloat(total_receive_finish_gross);
//                actual_loss = setRoundOf(actual_loss, 2).toFixed(3);
                actual_loss = parseFloat(actual_loss).toFixed(3);
            }
            $('#allowed<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').val(allowed);
            $('#actual_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').val(actual_loss);
            var loss_receivable_payable = parseFloat(allowed) - parseFloat(actual_loss);
//            loss_receivable_payable = setRoundOf(loss_receivable_payable, 2).toFixed(3);
            loss_receivable_payable = parseFloat(loss_receivable_payable).toFixed(3);
            $('#loss_receivable_payable<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(loss_receivable_payable);
        });

        display_lineitem_html<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>();
//        setTimeout(function(){ display_lineitem_html(); }, 1000);
    });
    
    function display_lineitem_html<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>() {
//        console.log('display_lineitem_html ' + process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>);
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
        $.each(lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>, function (index, value) {
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
//            lineitem_edit_btn = '<span style="white-space:nowrap"> <a class="btn btn-xs btn-primary btn-edit-item edit_lineitem_' + index + '" href="javascript:void(0);" onclick="edit_lineitem(' + index + ')"><i class="fa fa-edit"></i></a> ';
//            lineitem_delete_btn = '<a class="btn btn-xs btn-danger btn-delete-item" href="javascript:void(0);" onclick="remove_lineitem(' + index + ')"><i class="fa fa-trash"></i></a> </span>';
            
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
        $('#issue_lineitem_list<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(new_issue_lineitem_html);
        
        $('#total_issue_finish_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_gross.toFixed(3));
        $('#total_issue_finish_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_touch.toFixed(2));
        $('#total_issue_finish_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_wastage.toFixed(3));
        $('#total_issue_finish_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_fine.toFixed(3));
        $('#total_issue_finish_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_ad_weight.toFixed(3));
        $('#total_issue_finish_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_ad_pcs.toFixed(0));
        $('#total_issue_finish_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_before_meena.toFixed(3));
        $('#total_issue_finish_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_meena_wt.toFixed(3));
        $('#total_issue_finish_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_item_weight.toFixed(3));
        $('#total_issue_finish_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_kundan.toFixed(3));
        $('#total_issue_finish_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_sm.toFixed(3));
        $('#total_issue_finish_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_vetran.toFixed(3));
        $('#total_issue_finish_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_v_pcs.toFixed(0));
        $('#total_issue_finish_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_stone_pcs.toFixed(0));
        $('#total_issue_finish_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_stone_weight.toFixed(3));
        $('#total_issue_finish_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_stone_charges.toFixed(3));
        $('#total_issue_finish_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_moti.toFixed(3));
        $('#total_issue_finish_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_moti_amount.toFixed(2));
        $('#total_issue_finish_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_other_charges.toFixed(2));
        $('#total_issue_finish_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_loss.toFixed(3));
        $('#total_issue_finish_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_finish_loss_fine.toFixed(3));

        $('#total_issue_scrap_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_gross.toFixed(3));
        $('#total_issue_scrap_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_touch.toFixed(2));
        $('#total_issue_scrap_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_wastage.toFixed(3));
        $('#total_issue_scrap_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_fine.toFixed(3));
        $('#total_issue_scrap_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_ad_weight.toFixed(3));
        $('#total_issue_scrap_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_ad_pcs.toFixed(0));
        $('#total_issue_scrap_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_before_meena.toFixed(3));
        $('#total_issue_scrap_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_meena_wt.toFixed(3));
        $('#total_issue_scrap_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_item_weight.toFixed(3));
        $('#total_issue_scrap_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_kundan.toFixed(3));
        $('#total_issue_scrap_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_sm.toFixed(3));
        $('#total_issue_scrap_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_vetran.toFixed(3));
        $('#total_issue_scrap_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_v_pcs.toFixed(0));
        $('#total_issue_scrap_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_stone_pcs.toFixed(0));
        $('#total_issue_scrap_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_stone_weight.toFixed(3));
        $('#total_issue_scrap_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_stone_charges.toFixed(3));
        $('#total_issue_scrap_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_moti.toFixed(3));
        $('#total_issue_scrap_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_moti_amount.toFixed(2));
        $('#total_issue_scrap_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_other_charges.toFixed(2));
        $('#total_issue_scrap_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_loss.toFixed(3));
        $('#total_issue_scrap_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_scrap_loss_fine.toFixed(3));
        
        $('#total_issue_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_gross.toFixed(3));
        $('#total_issue_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_touch.toFixed(2));
        $('#total_issue_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_wastage.toFixed(3));
        $('#total_issue_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_fine.toFixed(3));
        $('#total_issue_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_ad_weight.toFixed(3));
        $('#total_issue_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_ad_pcs.toFixed(0));
        $('#total_issue_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_before_meena.toFixed(3));
        $('#total_issue_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_meena_wt.toFixed(3));
        $('#total_issue_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_item_weight.toFixed(3));
        $('#total_issue_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_kundan.toFixed(3));
        $('#total_issue_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_sm.toFixed(3));
        $('#total_issue_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_vetran.toFixed(3));
        $('#total_issue_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_v_pcs.toFixed(0));
        $('#total_issue_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_stone_pcs.toFixed(0));
        $('#total_issue_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_stone_weight.toFixed(3));
        $('#total_issue_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_stone_charges.toFixed(3));
        $('#total_issue_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_moti.toFixed(3));
        $('#total_issue_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_moti_amount.toFixed(2));
        $('#total_issue_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_other_charges.toFixed(2));
        $('#total_issue_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_loss.toFixed(3));
        $('#total_issue_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_loss_fine.toFixed(3));
        var total_i_gross_plus_ad = parseFloat(total_issue_gross) + parseFloat(total_issue_ad_weight);
        $('#total_i_gross_plus_ad<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_i_gross_plus_ad.toFixed(3));

        // Fill Receive Data
        $('#receive_lineitem_list<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(new_receive_lineitem_html);
        
        $('#total_receive_finish_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_gross.toFixed(3));
        $('#total_receive_finish_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_touch.toFixed(2));
        $('#total_receive_finish_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_wastage.toFixed(3));
        $('#total_receive_finish_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_fine.toFixed(3));
        $('#total_receive_finish_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_ad_weight.toFixed(3));
        $('#total_receive_finish_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_ad_pcs.toFixed(0));
        $('#total_receive_finish_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_before_meena.toFixed(3));
        $('#total_receive_finish_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_meena_wt.toFixed(3));
        $('#total_receive_finish_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_item_weight.toFixed(3));
        $('#total_receive_finish_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_kundan.toFixed(3));
        $('#total_receive_finish_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_sm.toFixed(3));
        $('#total_receive_finish_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_vetran.toFixed(3));
        $('#total_receive_finish_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_v_pcs.toFixed(0));
        $('#total_receive_finish_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_stone_pcs.toFixed(0));
        $('#total_receive_finish_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_stone_weight.toFixed(3));
        $('#total_receive_finish_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_stone_charges.toFixed(3));
        $('#total_receive_finish_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_moti.toFixed(3));
        $('#total_receive_finish_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_moti_amount.toFixed(2));
        $('#total_receive_finish_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_other_charges.toFixed(2));
        $('#total_receive_finish_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_loss.toFixed(3));
        $('#total_receive_finish_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_finish_loss_fine.toFixed(3));
        
        $('#total_receive_scrap_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_gross.toFixed(3));
        $('#total_receive_scrap_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_touch.toFixed(2));
        $('#total_receive_scrap_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_wastage.toFixed(3));
        $('#total_receive_scrap_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_fine.toFixed(3));
        $('#total_receive_scrap_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_ad_weight.toFixed(3));
        $('#total_receive_scrap_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_ad_pcs.toFixed(0));
        $('#total_receive_scrap_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_before_meena.toFixed(3));
        $('#total_receive_scrap_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_meena_wt.toFixed(3));
        $('#total_receive_scrap_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_item_weight.toFixed(3));
        $('#total_receive_scrap_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_kundan.toFixed(3));
        $('#total_receive_scrap_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_sm.toFixed(3));
        $('#total_receive_scrap_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_vetran.toFixed(3));
        $('#total_receive_scrap_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_v_pcs.toFixed(0));
        $('#total_receive_scrap_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_stone_pcs.toFixed(0));
        $('#total_receive_scrap_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_stone_weight.toFixed(3));
        $('#total_receive_scrap_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_stone_charges.toFixed(3));
        $('#total_receive_scrap_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_moti.toFixed(3));
        $('#total_receive_scrap_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_moti_amount.toFixed(2));
        $('#total_receive_scrap_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_other_charges.toFixed(2));
        $('#total_receive_scrap_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_loss.toFixed(3));
        $('#total_receive_scrap_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_scrap_loss_fine.toFixed(3));

        $('#total_receive_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_gross.toFixed(3));
        $('#total_receive_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_touch.toFixed(2));
        $('#total_receive_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_wastage.toFixed(3));
        $('#total_receive_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_fine.toFixed(3));
        $('#total_receive_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_ad_weight.toFixed(3));
        $('#total_receive_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_ad_pcs.toFixed(0));
        $('#total_receive_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_before_meena.toFixed(3));
        $('#total_receive_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_meena_wt.toFixed(3));
        $('#total_receive_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_item_weight.toFixed(3));
        $('#total_receive_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_kundan.toFixed(3));
        $('#total_receive_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_sm.toFixed(3));
        $('#total_receive_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_vetran.toFixed(3));
        $('#total_receive_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_v_pcs.toFixed(0));
        $('#total_receive_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_stone_pcs.toFixed(0));
        $('#total_receive_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_stone_weight.toFixed(3));
        $('#total_receive_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_stone_charges.toFixed(3));
        $('#total_receive_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_moti.toFixed(3));
        $('#total_receive_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_moti_amount.toFixed(2));
        $('#total_receive_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_other_charges.toFixed(2));
        $('#total_receive_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_loss.toFixed(3));
        $('#total_receive_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_loss_fine.toFixed(3));

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

        $('#balance_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_gross.toFixed(3));
        $('#balance_touch<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_touch.toFixed(2));
        $('#balance_wastage<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_wastage.toFixed(3));
        $('#balance_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_fine.toFixed(3));
        $('#balance_ad_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_ad_weight.toFixed(3));
        $('#balance_ad_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_ad_pcs.toFixed(0));
        $('#balance_before_meena<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_before_meena.toFixed(3));
        $('#balance_meena_wt<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_meena_wt.toFixed(3));
        $('#balance_item_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_item_weight.toFixed(3));
        $('#balance_kundan<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_kundan.toFixed(3));
        $('#balance_sm<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_sm.toFixed(3));
        $('#balance_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_vetran.toFixed(3));
        $('#balance_v_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_v_pcs.toFixed(0));
        $('#balance_stone_pcs<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_stone_pcs.toFixed(0));
        $('#balance_stone_weight<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_stone_weight.toFixed(3));
        $('#balance_stone_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_stone_charges.toFixed(3));
        $('#balance_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_moti.toFixed(3));
        $('#balance_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_moti_amount.toFixed(2));
        $('#balance_other_charges<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_other_charges.toFixed(2));
        $('#balance_loss<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_loss.toFixed(3));
        $('#balance_loss_fine<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_loss_fine.toFixed(3));

        $('#total_issue_vetran_item_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_issue_vetran_item_gross.toFixed(3));
        $('#total_receive_vetran_item_gross<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(total_receive_vetran_item_gross.toFixed(3));
        used_vetran = parseFloat(total_issue_vetran_item_gross) - parseFloat(total_receive_vetran_item_gross);
        used_vetran = parseFloat(used_vetran).toFixed(3);
        $('#used_vetran<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(used_vetran);
        used_moti = parseFloat(total_receive_finish_gross) - parseFloat(total_issue_finish_gross) - parseFloat(used_vetran);
        used_moti = parseFloat(used_moti).toFixed(3);
        $('#used_moti<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(used_moti);

        // Bandhnu Moti Amount based on Used Moti
        var new_balance_moti_amount = parseFloat(used_moti) * parseFloat(balance_moti_amount) / parseFloat(balance_moti || 1);
        $('#balance_moti_amount<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(new_balance_moti_amount.toFixed(2));

        bandhanu_issue = parseFloat(used_moti) + parseFloat(total_issue_finish_gross) + parseFloat(total_issue_scrap_gross);
        bandhanu_issue = parseFloat(bandhanu_issue).toFixed(3);
        $('#bandhanu_issue<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(bandhanu_issue);
        bandhanu_receive = parseFloat(total_receive_finish_gross) + parseFloat(total_receive_scrap_gross);
        bandhanu_receive = parseFloat(bandhanu_receive).toFixed(3);
        $('#bandhanu_receive<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(bandhanu_receive);
        balance_bandhanu = parseFloat(total_issue_finish_gross) + parseFloat(total_issue_scrap_gross) - parseFloat(total_receive_finish_gross) - parseFloat(used_moti) - parseFloat(used_vetran);
        balance_bandhanu = parseFloat(balance_bandhanu).toFixed(3);
        $('#balance_bandhanu<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').html(balance_bandhanu);

        $("#loss_allowed").val('');
        if(rfw_firstline_job_worker_id != ''){
            $.ajax({
                url: "<?= base_url('app/get_job_worker_detail/') ?>" + rfw_firstline_job_worker_id,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success') {
                        $("#loss_allowed").val(response.wastage_loss_allowed).trigger("change");
                    }
                }
            });
        }

        $('#ajax-loader').hide();
        // If any one Lineitem is added then Process not allow to change
        if($.isEmptyObject(lineitem_objectdata<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>)){
            $('#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').removeAttr('disabled','disabled');
            $('#after_disabled_process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').remove();
        } else {
            process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> = $('#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').val();
            if(process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> != '' && process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> != null){
                $('#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').attr('disabled','disabled');
                $('#process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>').closest('div').append('<input type="hidden" name="process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" id="after_disabled_process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" value="' + process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> + '" />');
                $("#after_disabled_process_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>").trigger("change");
            }
        }
        setTimeout(function(){ process_dynamic_columns_fun<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>(); }, 2000);
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
                    } 
                }
            });
        }
    }

    function process_dynamic_columns_fun<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>(){
//        console.log('process_dynamic_columns : ' + process_dynamic_issue_columns<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>);
        $.each(process_dynamic_issue_columns<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>, function(f_index, f_value){
            $('table.issue_table<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> .dynamic_column.'+ f_value).removeClass('d-none');
        });
        $.each(process_dynamic_receive_columns<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>, function(f_index, f_value){
            $('table.receive_table<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?> .dynamic_column.'+ f_value).removeClass('d-none');
        });
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
