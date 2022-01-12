<?php
    $person_wise_balance = array();
    $person_wise_receive_ad_pcs = array();

    $total_receive_columns = 6;
    $total_issue_columns = 6;
    $total_receive_label_colspan = 2;
    $total_issue_label_colspan = 2;

    if(!empty($selected_columns)) {
        $receive_type = false;
        if(in_array('receive_type',$selected_columns)) {
            $receive_type = true;
            $total_receive_columns++;
        }
        
        $receive_less = false;
        if(in_array('receive_less',$selected_columns)) {
            $receive_less = true;
            $total_receive_columns++;
        }

        $receive_pcs = false;
        if(in_array('receive_pcs',$selected_columns)) {
            $receive_pcs = true;
            $total_receive_columns++;
        }

        $receive_alloy = false;
        if(in_array('receive_alloy',$selected_columns)) {
            $receive_alloy = true;
            $total_receive_columns++;
        }

        $receive_item = false;
        if(in_array('receive_item',$selected_columns)) {
            $receive_item = true;
            $total_receive_columns++;
        }

        $receive_person = false;
        if(in_array('receive_person',$selected_columns)) {
            $receive_person = true;
            $total_receive_columns++;
        }

        $receive_ad_weight = false;
        if(in_array('receive_ad_weight',$selected_columns)) {
            $receive_ad_weight = true;
            $total_receive_columns++;
        }

        $receive_ad_pcs = false;
        if(in_array('receive_ad_pcs',$selected_columns)) {
            $receive_ad_pcs = true;
            $total_receive_columns++;
        }


        $issue_type = false;
        if(in_array('issue_type',$selected_columns)) {
            $issue_type = true;
            $total_issue_columns++;
        }

        $issue_less = false;
        if(in_array('issue_less',$selected_columns)) {
            $issue_less = true;
            $total_issue_columns++;
        }

        $issue_pcs = false;
        if(in_array('issue_pcs',$selected_columns)) {
            $issue_pcs = true;
            $total_issue_columns++;
        }

        $issue_alloy = false;
        if(in_array('issue_alloy',$selected_columns)) {
            $issue_alloy = true;
            $total_issue_columns++;
        }

        $issue_item = false;
        if(in_array('issue_item',$selected_columns)) {
            $issue_item = true;
            $total_issue_columns++;
        }

        $issue_person = false;
        if(in_array('issue_person',$selected_columns)) {
            $issue_person = true;
            $total_issue_columns++;
        }

        $issue_ad_weight = false;
        if(in_array('issue_ad_weight',$selected_columns)) {
            $issue_ad_weight = true;
            $total_issue_columns++;
        }

        $issue_ad_pcs = false;
        if(in_array('issue_ad_pcs',$selected_columns)) {
            $issue_ad_pcs = true;
            $total_issue_columns++;
        }

        /*--- Rows ---*/
        $issue_total_finish = false;
        if(in_array('issue_total_finish',$selected_columns)) {
            $issue_total_finish = true;
        }
        $issue_total_scrap = false;
        if(in_array('issue_total_scrap',$selected_columns)) {
            $issue_total_scrap = true;
        }
        $issue_total = false;
        if(in_array('issue_total',$selected_columns)) {
            $issue_total = true;
        }
        $issue_total_with_ad = false;
        if(in_array('issue_total_with_ad',$selected_columns)) {
            $issue_total_with_ad = true;
        }

        $receive_total_finish = false;
        if(in_array('receive_total_finish',$selected_columns)) {
            $receive_total_finish = true;
        }
        $receive_total_scrap = false;
        if(in_array('receive_total_scrap',$selected_columns)) {
            $receive_total_scrap = true;
        }
        $receive_total = false;
        if(in_array('receive_total',$selected_columns)) {
            $receive_total = true;
        }
        $receive_total_with_ad = false;
        if(in_array('receive_total_with_ad',$selected_columns)) {
            $receive_total_with_ad = true;
        }
        

    } else {
        $receive_type = false;
        $receive_less = false;
        $receive_pcs = false;
        $receive_alloy = false;
        $receive_item = false;
        $receive_person = false;
        $receive_ad_weight = false;
        $receive_ad_pcs = false;

        $issue_type = false;
        $issue_less = false;
        $issue_pcs = false;
        $issue_alloy = false;
        $issue_item = false;
        $issue_person = false;
        $issue_ad_weight = false;
        $issue_ad_pcs = false;

        $issue_total_finish = false;
        $issue_total_scrap = false;
        $issue_total = false;
        $issue_total_with_ad = false;

        $receive_total_finish = false;
        $receive_total_scrap = false;
        $receive_total = false;
        $receive_total_with_ad = false;
    }

    $total_columns = ($total_receive_columns + $total_issue_columns);
    if($receive_type == false) {
        $total_receive_label_colspan = 1;
    }
    if($issue_type == false) {
        $total_issue_label_colspan = 1;
    }

    $receive_date = true;
    $receive_weight = true;
    $receive_net = true;
    $receive_touch = true;
    $receive_fine = true;
    $receive_remark = true;

    $issue_date = true;
    $issue_weight = true;
    $issue_net = true;
    $issue_touch = true;
    $issue_fine = true;
    $issue_remark = true;
?>
<table  class="process_table" style="width: 100%; font-size:13px;">
    <thead>
        <tr align="center">
            <th colspan="<?=$total_columns?>">&nbsp;</th>
        </tr>
        <tr align="center" class="border1">
            <td align="left" colspan="<?=$total_receive_columns?>" class="border1" style="width: 50% !important;"><h4 class="TEXT_BOLD">Receive of <?=$process_name?></h4></td>
            <td align="left" colspan="<?=$total_issue_columns?>" class="border1" style="width: 50% !important;"><h4 class="TEXT_BOLD">Issue of <?=$process_name?></h4></td>
        </tr>
        <tr align="center">
            <?php if($receive_type == true) {?>
                <th align="left" class="border1"  column_id="receive_type">Type</th>
            <?php } ?>
            <?php if($receive_date == true) {?>
                <th align="left" class="border1"  column_id="receive_date">Date</th>
            <?php } ?>
            <?php if($receive_weight == true) {?>
                <th align="left" class="border1"  column_id="receive_weight">Weight</th>
            <?php } ?>
            <?php if($receive_less== true) {?>
                <th align="right" class="border1"  column_id="receive_less">Less</th>
            <?php } ?>
            <?php if($receive_net== true) {?>
                <th align="right" class="border1"  column_id="receive_net">Net Wt.</th>
            <?php } ?>
            <?php if($receive_touch== true) {?>
                <th align="right" class="border1"  column_id="receive_touch">Touch</th>
            <?php } ?>
            <?php if($receive_fine== true) {?>
                <th align="right" class="border1"  column_id="receive_fine">Fine</th>
            <?php } ?>
            <?php if($receive_pcs== true) {?>
                <th align="right" class="border1"  column_id="receive_pcs">Pcs</th>
            <?php } ?>
            <?php if($receive_alloy== true) {?>
                <th align="right" class="border1"  column_id="receive_alloy">Alloy</th>
            <?php } ?>
            <?php if($receive_item == true) {?>
                <th align="left" class="border1"  column_id="receive_item">Item</th>
            <?php } ?>
            <?php if($receive_person == true) {?>
                <th align="left" class="border1"  column_id="receive_person">Person</th>
            <?php } ?>
            <?php if($receive_ad_weight== true) {?>
                <th align="right" class="border1"  column_id="receive_ad_weight">Ad Weight</th>
            <?php } ?>
            <?php if($receive_ad_pcs== true) {?>
                <th align="right" class="border1"  column_id="receive_ad_pcs">Ad Pcs</th>
            <?php } ?>
            <?php if($receive_remark == true) {?>
                <th align="left" class="border1"  column_id="receive_remark">Remark</th>
            <?php } ?>

            <?php if($issue_type == true) {?>
                <th align="left" class="border1" column_id="issue_type">Type</th>
            <?php } ?>
            <?php if($issue_date == true) {?>
                <th align="left" class="border1" column_id="issue_date">Date</th>
            <?php } ?>
            <?php if($issue_weight == true) {?>
                <th align="left" class="border1" column_id="issue_weight">Weight</th>
            <?php } ?>
            <?php if($issue_less == true) {?>
                <th align="right" class="border1" column_id="issue_less">Less</th>
            <?php } ?>
            <?php if($issue_net == true) {?>
                <th align="right" class="border1" column_id="issue_net">Net Wt.</th>
            <?php } ?>
            <?php if($issue_touch == true) {?>
                <th align="right" class="border1" column_id="issue_touch">Touch</th>
            <?php } ?>
            <?php if($issue_fine == true) {?>
                <th align="right" class="border1" column_id="issue_fine">Fine</th>
            <?php } ?>
            <?php if($issue_pcs == true) {?>
                <th align="right" class="border1" column_id="issue_pcs">Pcs</th>
            <?php } ?>
            <?php if($issue_alloy == true) {?>
                <th align="right" class="border1" column_id="issue_alloy">Alloy</th>
            <?php } ?>
            <?php if($issue_item == true) {?>
                <th align="left" class="border1" column_id="issue_item">Item</th>
            <?php } ?>
            <?php if($issue_person == true) {?>
                <th align="left" class="border1" column_id="issue_person">Person</th>
            <?php } ?>
            <?php if($issue_ad_weight == true) {?>
                <th align="right" class="border1" column_id="issue_ad_weight">Ad Weight</th>
            <?php } ?>
            <?php if($issue_ad_pcs == true) {?>
                <th align="right" class="border1" column_id="issue_ad_pcs">Ad Pcs</th>
            <?php } ?>
            <?php if($issue_remark == true) {?>
                <th align="left" class="border1" column_id="issue_remark">Remark</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total_issue_weight = 0;
            $total_receive_weight = 0;
            $total_issue_finish_weight = 0;
            $total_receive_finish_weight = 0;
            $total_issue_scrap_weight = 0;
            $total_receive_scrap_weight = 0;
            $total_ad_issue_weight = 0;
            $total_ad_receive_weight = 0;

            $total_issue_less = 0;
            $total_receive_less = 0;
            $total_issue_finish_less = 0;
            $total_receive_finish_less = 0;
            $total_issue_scrap_less = 0;
            $total_receive_scrap_less = 0;
            $total_ad_issue_less = 0;
            $total_ad_receive_less = 0;

            $total_issue_net_weight = 0;
            $total_receive_net_weight = 0;
            $total_issue_finish_net_weight = 0;
            $total_receive_finish_net_weight = 0;
            $total_issue_scrap_net_weight = 0;
            $total_receive_scrap_net_weight = 0;
            $total_ad_issue_net_weight = 0;
            $total_ad_receive_net_weight = 0;

            $total_issue_tunch = 0;
            $total_receive_tunch = 0;
            $total_issue_finish_tunch = 0;
            $total_receive_finish_tunch = 0;
            $total_issue_scrap_tunch = 0;
            $total_receive_scrap_tunch = 0;
            $total_ad_issue_tunch = 0;
            $total_ad_receive_tunch = 0;

            $total_issue_fine = 0;
            $total_receive_fine = 0;
            $total_issue_finish_fine = 0;
            $total_receive_finish_fine = 0;
            $total_issue_scrap_fine = 0;
            $total_receive_scrap_fine = 0;
            $total_ad_issue_fine = 0;
            $total_ad_receive_fine = 0;

            $total_issue_pcs = 0;
            $total_receive_pcs = 0;
            $total_issue_finish_pcs = 0;
            $total_receive_finish_pcs = 0;
            $total_issue_scrap_pcs = 0;
            $total_receive_scrap_pcs = 0;
            $total_ad_issue_pcs = 0;
            $total_ad_receive_pcs = 0;

            $total_issue_alloy = 0;
            $total_receive_alloy = 0;
            $total_issue_finish_alloy = 0;
            $total_receive_finish_alloy = 0;
            $total_issue_scrap_alloy = 0;
            $total_receive_scrap_alloy = 0;
            $total_ad_issue_alloy = 0;
            $total_ad_receive_alloy = 0;

            $total_issue_ad_weight = 0;
            $total_receive_ad_weight = 0;
            $total_issue_finish_ad_weight = 0;
            $total_receive_finish_ad_weight = 0;
            $total_issue_scrap_ad_weight = 0;
            $total_receive_scrap_ad_weight = 0;
            $total_ad_issue_ad_weight = 0;
            $total_ad_receive_ad_weight = 0;

            $total_issue_ad_pcs = 0;
            $total_receive_ad_pcs = 0;
            $total_issue_finish_ad_pcs = 0;
            $total_receive_finish_ad_pcs = 0;
            $total_issue_scrap_ad_pcs = 0;
            $total_receive_scrap_ad_pcs = 0;
            $total_ad_issue_ad_pcs = 0;
            $total_ad_receive_ad_pcs = 0;
        ?>
        <?php for ($x = 0; $x < $manu_max_count; $x++) { ?>
            <tr align="center" class="border1">
                <?php if(isset($manu_receive_data[$x])){ ?>
                    <?php
                    if($manu_receive_data[$x]->ad_pcs > 0) {
                        if(isset($person_wise_receive_ad_pcs[$manu_receive_data[$x]->job_worker_id])) {
                            $person_wise_receive_ad_pcs[$manu_receive_data[$x]->job_worker_id]['receive_ad_pcs'] += $manu_receive_data[$x]->ad_pcs;
                        } else {
                            $person_wise_receive_ad_pcs[$manu_receive_data[$x]->job_worker_id] = array(
                                "job_worker_id" => $manu_receive_data[$x]->job_worker_id,
                                "job_worker_name" => $manu_receive_data[$x]->job_worker,
                                "receive_ad_pcs" => $manu_receive_data[$x]->ad_pcs,
                            );
                        } 
                    }
                    

                    if(isset($person_wise_balance[$manu_receive_data[$x]->job_worker_id])) {
                        $tmp_id = $manu_receive_data[$x]->job_worker_id;
                        $person_wise_balance[$tmp_id]['receive_weight'] += $manu_receive_data[$x]->weight;
                        if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                            $issue_receive_type = 'RFW';
                            $person_wise_balance[$tmp_id]['receive_finish_weight'] += $manu_receive_data[$x]->weight;
                        }
                        $person_wise_balance[$tmp_id]['receive_less'] += $manu_receive_data[$x]->less;
                        $person_wise_balance[$tmp_id]['receive_net_weight'] += $manu_receive_data[$x]->net_weight;
                        $person_wise_balance[$tmp_id]['receive_fine'] += $manu_receive_data[$x]->fine;
                        $person_wise_balance[$tmp_id]['receive_tunch'] = (($person_wise_balance[$tmp_id]['receive_fine'] > 0 && $person_wise_balance[$tmp_id]['receive_net_weight'] > 0)?(($person_wise_balance[$tmp_id]['receive_fine'] / $person_wise_balance[$tmp_id]['receive_net_weight']) * 100) : 0);
                        $person_wise_balance[$tmp_id]['receive_pcs'] += $manu_receive_data[$x]->pcs;
                        $person_wise_balance[$tmp_id]['receive_alloy'] += ($manu_receive_data[$x]->weight - $manu_receive_data[$x]->fine);
                        $person_wise_balance[$tmp_id]['receive_ad_weight'] += $manu_receive_data[$x]->ad_weight;
                        $person_wise_balance[$tmp_id]['receive_ad_pcs'] += $manu_receive_data[$x]->ad_pcs;
                        
                    } else {
                        $person_wise_balance[$manu_receive_data[$x]->job_worker_id] = array(
                            "job_worker_id" => $manu_receive_data[$x]->job_worker_id,
                            "job_worker_name" => $manu_receive_data[$x]->job_worker,
                            "receive_weight" => $manu_receive_data[$x]->weight,
                            "receive_finish_weight" => ($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID ? $manu_receive_data[$x]->weight : 0),
                            "receive_less" => $manu_receive_data[$x]->less,
                            "receive_net_weight" => $manu_receive_data[$x]->net_weight,
                            "receive_fine" => $manu_receive_data[$x]->fine,
                            "receive_tunch" => (($manu_receive_data[$x]->fine > 0 && $manu_receive_data[$x]->net_weight > 0)?(($manu_receive_data[$x]->fine / $manu_receive_data[$x]->net_weight) * 100) : 0),
                            "receive_pcs" => $manu_receive_data[$x]->pcs,
                            "receive_alloy" => ($manu_receive_data[$x]->weight - $manu_receive_data[$x]->fine),
                            "receive_ad_weight" => $manu_receive_data[$x]->ad_weight,
                            "receive_ad_pcs" => $manu_receive_data[$x]->ad_pcs,
                            "issue_weight" => 0,
                            "issue_less" => 0,
                            "issue_net_weight" => 0,
                            "issue_fine" => 0,
                            "issue_tunch" => 0,
                            "issue_pcs" => 0,
                            "issue_alloy" => 0,
                            "issue_ad_weight" => 0,
                            "issue_ad_pcs" => 0,
                        );                        
                    }

                    $issue_receive_type = $manu_receive_data[$x]->type_id;
                    if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID){
                        $issue_receive_type = 'IFW';
                    
                    } else if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                        $issue_receive_type = 'RFW';
                   
                    } else if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                        $issue_receive_type = 'IS';
                   
                    } else if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                        $issue_receive_type = 'RS';
                    }
                    ?>
                    <?php if($receive_type == true) {?>
                        <td align="left" column_id="receive_type" class="border1"><?php echo $issue_receive_type; ?></td>
                    <?php } ?>
                    
                    <?php if($receive_date == true) {?>
                        <td align="left" column_id="receive_date" class="border1 my_nowrap_class" style="display:block;white-space: nowrap;"><?php echo date('d/m/y', strtotime($manu_receive_data[$x]->ir_date)); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_weight == true) {?>
                        <td align="right" column_id="receive_weight" class="border1"><?php echo number_format($manu_receive_data[$x]->weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_less == true) {?>
                        <td align="right" column_id="receive_less" class="border1"><?php echo number_format($manu_receive_data[$x]->less, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_net == true) {?>
                        <td align="right" column_id="receive_net" class="border1"><?php echo number_format($manu_receive_data[$x]->net_weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_touch == true) {?>
                        <td align="right" column_id="receive_touch" class="border1"><?php echo number_format($manu_receive_data[$x]->tunch, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_fine == true) {?>
                        <td align="right" column_id="receive_fine" class="border1"><?php echo number_format($manu_receive_data[$x]->fine, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_pcs == true) {?>
                        <td align="right" column_id="receive_pcs" class="border1"><?php echo $manu_receive_data[$x]->pcs; ?></td>
                    <?php } ?>
                    
                    <?php $alloy_rec = $manu_receive_data[$x]->weight - $manu_receive_data[$x]->fine; ?>

                    <?php if($receive_alloy == true) {?>
                        <td align="right" column_id="receive_alloy" class="border1"><?php echo number_format($alloy_rec, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_item == true) {?>
                        <td align="left" column_id="receive_item" class="border1"><?php echo $manu_receive_data[$x]->item_name; ?></td>
                    <?php } ?>
                    
                    <?php if($receive_person == true) {?>
                        <td align="left" column_id="receive_person" class="border1"><?php echo $manu_receive_data[$x]->job_worker; ?></td>
                    <?php } ?>
                    
                    <?php if($receive_ad_weight == true) {?>
                        <td align="right" column_id="receive_ad_weight" class="border1"><?php echo number_format($manu_receive_data[$x]->ad_weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    
                    <?php if($receive_ad_pcs == true) {?>
                        <td align="right" column_id="receive_ad_pcs" class="border1"><?php echo $manu_receive_data[$x]->ad_pcs; ?></td>
                    <?php } ?>
                    
                    <?php if($receive_remark == true) {?>
                        <td align="left" column_id="receive_remark" class="border1"><?php echo trim(nl2br($manu_receive_data[$x]->remark)); ?></td>
                    <?php } ?>
                    
                    <?php 
                        $total_receive_weight = $total_receive_weight + $manu_receive_data[$x]->weight;
                        $total_receive_less = $total_receive_less + $manu_receive_data[$x]->less;
                        $total_receive_net_weight = $total_receive_net_weight + $manu_receive_data[$x]->net_weight;
                        $total_receive_fine = $total_receive_fine + $manu_receive_data[$x]->fine;
                        if($total_receive_net_weight > 0) {
                            $total_receive_tunch = ($total_receive_fine / $total_receive_net_weight) * 100;     
                        } else {
                            $total_receive_tunch = 0;
                        }
                        
                        $total_receive_pcs = $total_receive_pcs + $manu_receive_data[$x]->pcs;
                        $total_receive_alloy = $total_receive_alloy + $alloy_rec;
                        $total_receive_ad_weight = $total_receive_ad_weight + $manu_receive_data[$x]->ad_weight;
                        $total_receive_ad_pcs = $total_receive_ad_pcs + $manu_receive_data[$x]->ad_pcs;

                        if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                            $total_receive_finish_weight = $total_receive_finish_weight + $manu_receive_data[$x]->weight;
                            $total_receive_finish_less = $total_receive_finish_less + $manu_receive_data[$x]->less;
                            $total_receive_finish_net_weight = $total_receive_finish_net_weight + $manu_receive_data[$x]->net_weight;
                            $total_receive_finish_fine = $total_receive_finish_fine + $manu_receive_data[$x]->fine;
                            if($total_receive_finish_net_weight > 0) {
                                $total_receive_finish_tunch = ($total_receive_finish_fine / $total_receive_finish_net_weight) * 100;     
                            } else {
                                $total_receive_finish_tunch = 0;
                            }
                            
                            $total_receive_finish_pcs = $total_receive_finish_pcs + $manu_receive_data[$x]->pcs;
                            $total_receive_finish_alloy = $total_receive_finish_alloy + $alloy_rec;
                            $total_receive_finish_ad_weight = $total_receive_finish_ad_weight + $manu_receive_data[$x]->ad_weight;
                            $total_receive_finish_ad_pcs = $total_receive_finish_ad_pcs + $manu_receive_data[$x]->ad_pcs;
                        } else if($manu_receive_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                            $total_receive_scrap_weight = $total_receive_scrap_weight + $manu_receive_data[$x]->weight;
                            $total_receive_scrap_less = $total_receive_scrap_less + $manu_receive_data[$x]->less;
                            $total_receive_scrap_net_weight = $total_receive_scrap_net_weight + $manu_receive_data[$x]->net_weight;
                            $total_receive_scrap_fine = $total_receive_scrap_fine + $manu_receive_data[$x]->fine;
                            $total_receive_scrap_tunch = ($total_receive_scrap_fine / $total_receive_scrap_net_weight) * 100; 
                            $total_receive_scrap_pcs = $total_receive_scrap_pcs + $manu_receive_data[$x]->pcs;
                            $total_receive_scrap_alloy = $total_receive_scrap_alloy + $alloy_rec;
                            $total_receive_scrap_ad_weight = $total_receive_scrap_ad_weight + $manu_receive_data[$x]->ad_weight;
                            $total_receive_scrap_ad_pcs = $total_receive_scrap_ad_pcs + $manu_receive_data[$x]->ad_pcs;
                        }
                    ?>
                <?php } else { ?>
                    <?php if($receive_type == true) {?>
                        <td align="left" class="border1" column_id="receive_type"></td>
                    <?php } ?>
                    <?php if($receive_date == true) {?>
                        <td align="left" class="border1" column_id="receive_date"></td>
                    <?php } ?>
                    <?php if($receive_weight == true) {?>
                        <td align="left" class="border1" column_id="receive_weight"></td>
                    <?php } ?>
                    <?php if($receive_less == true) {?>
                        <td align="right" class="border1" column_id="receive_less"></td>
                    <?php } ?>
                    <?php if($receive_net == true) {?>
                        <td align="right" class="border1" column_id="receive_net"></td>
                    <?php } ?>
                    <?php if($receive_touch == true) {?>
                        <td align="right" class="border1" column_id="receive_touch"></td>
                    <?php } ?>
                    <?php if($receive_fine == true) {?>
                        <td align="right" class="border1" column_id="receive_fine"></td>
                    <?php } ?>
                    <?php if($receive_pcs == true) {?>
                        <td align="left" class="border1" column_id="receive_pcs"></td>
                    <?php } ?>
                    <?php if($receive_alloy == true) {?>
                        <td align="left" class="border1" column_id="receive_alloy"></td>
                    <?php } ?>
                    <?php if($receive_item == true) {?>
                        <td align="left" class="border1" column_id="receive_item"></td>
                    <?php } ?>
                    <?php if($receive_person == true) {?>
                        <td align="right" class="border1" column_id="receive_person"></td>
                    <?php } ?>
                    <?php if($receive_ad_weight == true) {?>
                        <td align="left" class="border1" column_id="receive_ad_weight"></td>
                    <?php } ?>
                    <?php if($receive_ad_pcs == true) {?>
                        <td align="left" class="border1" column_id="receive_ad_pcs"></td>
                    <?php } ?>
                    <?php if($receive_remark == true) {?>
                        <td align="left" class="border1" column_id="receive_remark"></td>
                    <?php } ?>
                <?php }  ?>

                <?php if(isset($manu_issue_data[$x])){ ?>
                    <?php
                    if(isset($person_wise_balance[$manu_issue_data[$x]->job_worker_id])) {
                        $tmp_id = $manu_issue_data[$x]->job_worker_id;
                        $person_wise_balance[$tmp_id]['issue_weight'] += $manu_issue_data[$x]->weight;
                        $person_wise_balance[$tmp_id]['issue_less'] += $manu_issue_data[$x]->less;
                        $person_wise_balance[$tmp_id]['issue_net_weight'] += $manu_issue_data[$x]->net_weight;
                        $person_wise_balance[$tmp_id]['issue_fine'] += $manu_issue_data[$x]->fine;
                        $person_wise_balance[$tmp_id]['issue_tunch'] = (($person_wise_balance[$tmp_id]['issue_fine'] > 0 && $person_wise_balance[$tmp_id]['issue_net_weight'] > 0)?(($person_wise_balance[$tmp_id]['issue_fine'] / $person_wise_balance[$tmp_id]['issue_net_weight']) * 100) : 0);
                        $person_wise_balance[$tmp_id]['issue_pcs'] += $manu_issue_data[$x]->pcs;
                        $person_wise_balance[$tmp_id]['issue_alloy'] += ($manu_issue_data[$x]->weight - $manu_issue_data[$x]->fine);
                        $person_wise_balance[$tmp_id]['issue_ad_weight'] += $manu_issue_data[$x]->ad_weight;
                        $person_wise_balance[$tmp_id]['issue_ad_pcs'] += $manu_issue_data[$x]->ad_pcs;

                    } else {
                        $person_wise_balance[$manu_issue_data[$x]->job_worker_id] = array(
                            "job_worker_id" => $manu_issue_data[$x]->job_worker_id,
                            "job_worker_name" => $manu_issue_data[$x]->job_worker,
                            "issue_weight" => $manu_issue_data[$x]->weight,
                            "issue_less" => $manu_issue_data[$x]->less,
                            "issue_net_weight" => $manu_issue_data[$x]->net_weight,
                            "issue_fine" => $manu_issue_data[$x]->fine,
                            "issue_tunch" => (($manu_issue_data[$x]->fine > 0 && $manu_issue_data[$x]->net_weight > 0)?(($manu_issue_data[$x]->fine / $manu_issue_data[$x]->net_weight) * 100) : 0),
                            "issue_pcs" => $manu_issue_data[$x]->pcs,
                            "issue_alloy" => ($manu_issue_data[$x]->weight - $manu_issue_data[$x]->fine),
                            "issue_ad_weight" => $manu_issue_data[$x]->ad_weight,
                            "issue_ad_pcs" => $manu_issue_data[$x]->ad_pcs,
                            "receive_weight" => 0,
                            "receive_finish_weight" => 0,
                            "receive_less" => 0,
                            "receive_net_weight" => 0,
                            "receive_fine" => 0,
                            "receive_tunch" => 0,
                            "receive_pcs" => 0,
                            "receive_alloy" => 0,
                            "receive_ad_weight" => 0,
                            "receive_ad_pcs" => 0,
                        );                        
                    }

                    $issue_receive_type = $manu_issue_data[$x]->type_id;
                    if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID){
                        $issue_receive_type = 'IFW';
                    
                    } else if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_FINISH_ID){
                        $issue_receive_type = 'RFW';
                   
                    } else if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                        $issue_receive_type = 'IS';
                   
                    } else if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_RECEIVE_SCRAP_ID){
                        $issue_receive_type = 'RS';
                    }
                    ?>
                    <?php if($issue_type == true) {?>
                        <td align="left" class="border1" column_id="issue_type"><?php echo $issue_receive_type; ?></td>
                    <?php } ?>
                    <?php if($issue_date == true) {?>
                        <td align="left" class="border1" column_id="issue_date"><?php echo date('d/m/y', strtotime($manu_issue_data[$x]->ir_date)); ?></td>
                    <?php } ?>
                    <?php if($issue_weight == true) {?>
                        <td align="right" class="border1" column_id="issue_weight"><?php echo number_format($manu_issue_data[$x]->weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_less == true) {?>
                        <td align="right" class="border1" column_id="issue_less"><?php echo number_format($manu_issue_data[$x]->less, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_net == true) {?>
                        <td align="right" class="border1" column_id="issue_net"><?php echo number_format($manu_issue_data[$x]->net_weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_touch == true) {?>
                        <td align="right" class="border1" column_id="issue_touch"><?php echo number_format($manu_issue_data[$x]->tunch, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_fine == true) {?>
                        <td align="right" class="border1" column_id="issue_fine"><?php echo number_format($manu_issue_data[$x]->fine, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_pcs == true) {?>
                        <td align="right" class="border1" column_id="issue_pcs"><?php echo $manu_issue_data[$x]->pcs; ?></td>
                    <?php } ?>
                    <?php $alloy_issue = $manu_issue_data[$x]->weight - $manu_issue_data[$x]->fine; ?>
                    <?php if($issue_alloy == true) {?>
                        <td align="right" class="border1" column_id="issue_alloy"><?php echo number_format($alloy_issue, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_item == true) {?>
                        <td align="left" class="border1" column_id="issue_item"><?php echo $manu_issue_data[$x]->item_name; ?></td>
                    <?php } ?>
                    <?php if($issue_person == true) {?>
                        <td align="left" class="border1" column_id="issue_person"><?php echo $manu_issue_data[$x]->job_worker; ?></td>
                    <?php } ?>
                    <?php if($issue_ad_weight == true) {?>
                        <td align="right" class="border1" column_id="issue_ad_weight"><?php echo number_format($manu_issue_data[$x]->ad_weight, 3, '.', ''); ?></td>
                    <?php } ?>
                    <?php if($issue_ad_pcs == true) {?>
                        <td align="right" class="border1" column_id="issue_ad_pcs"><?php echo $manu_issue_data[$x]->ad_pcs; ?></td>
                    <?php } ?>
                    <?php if($issue_remark == true) {?>
                        <td align="left" class="border1" column_id="issue_remark"><?php echo trim(nl2br($manu_issue_data[$x]->remark)); ?></td>
                    <?php } ?>
                    <?php 
                        $total_issue_weight = $total_issue_weight + $manu_issue_data[$x]->weight;
                        $total_issue_less = $total_issue_less + $manu_issue_data[$x]->less;
                        $total_issue_net_weight = $total_issue_net_weight + $manu_issue_data[$x]->net_weight;
                        $total_issue_fine = $total_issue_fine + $manu_issue_data[$x]->fine;
                        if($total_issue_fine > 0) {
                            $total_issue_tunch = ($total_issue_fine / $total_issue_net_weight) * 100; 
                        } else {
                            $total_issue_tunch = 0;
                        }
                        
                        $total_issue_pcs = $total_issue_pcs + $manu_issue_data[$x]->pcs;
                        $total_issue_alloy = $total_issue_alloy + $alloy_issue;
                        $total_issue_ad_weight = $total_issue_ad_weight + $manu_issue_data[$x]->ad_weight;
                        $total_issue_ad_pcs = $total_issue_ad_pcs + $manu_issue_data[$x]->ad_pcs;

                        if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_FINISH_ID){
                            $total_issue_finish_weight = $total_issue_finish_weight + $manu_issue_data[$x]->weight;
                            $total_issue_finish_less = $total_issue_finish_less + $manu_issue_data[$x]->less;
                            $total_issue_finish_net_weight = $total_issue_finish_net_weight + $manu_issue_data[$x]->net_weight;
                            $total_issue_finish_fine = $total_issue_finish_fine + $manu_issue_data[$x]->fine;
                            if($total_issue_finish_net_weight > 0) {
                                $total_issue_finish_tunch = ($total_issue_finish_fine / $total_issue_finish_net_weight) * 100; 
                            } else {
                                $total_issue_finish_tunch = 0;
                            }
                            
                            $total_issue_finish_pcs = $total_issue_finish_pcs + $manu_issue_data[$x]->pcs;
                            $total_issue_finish_alloy = $total_issue_finish_alloy + $alloy_issue;
                            $total_issue_finish_ad_weight = $total_issue_finish_ad_weight + $manu_issue_data[$x]->ad_weight;
                            $total_issue_finish_ad_pcs = $total_issue_finish_ad_pcs + $manu_issue_data[$x]->ad_pcs;
                        } else if($manu_issue_data[$x]->type_id == MANUFACTURE_TYPE_ISSUE_SCRAP_ID){
                            $total_issue_scrap_weight = $total_issue_scrap_weight + $manu_issue_data[$x]->weight;
                            $total_issue_scrap_less = $total_issue_scrap_less + $manu_issue_data[$x]->less;
                            $total_issue_scrap_net_weight = $total_issue_scrap_net_weight + $manu_issue_data[$x]->net_weight;
                            $total_issue_scrap_fine = $total_issue_scrap_fine + $manu_issue_data[$x]->fine;
                            $total_issue_scrap_tunch = ($total_issue_scrap_fine / $total_issue_scrap_net_weight) * 100; 
                            $total_issue_scrap_pcs = $total_issue_scrap_pcs + $manu_issue_data[$x]->pcs;
                            $total_issue_scrap_alloy = $total_issue_scrap_alloy + $alloy_issue;
                            $total_issue_scrap_ad_weight = $total_issue_scrap_ad_weight + $manu_issue_data[$x]->ad_weight;
                            $total_issue_scrap_ad_pcs = $total_issue_scrap_ad_pcs + $manu_issue_data[$x]->ad_pcs;
                        }
                    ?>
                <?php } else { ?>
                    <?php if($issue_type == true) {?>
                        <td align="left" class="border1" column_id="issue_type"></td>
                    <?php } ?>

                    <?php if($issue_date == true) {?>
                        <td align="left" class="border1" column_id="issue_date"></td>
                    <?php } ?>

                    <?php if($issue_weight == true) {?>
                        <td align="left" class="border1" column_id="issue_weight"></td>
                    <?php } ?>

                    <?php if($issue_less == true) {?>
                        <td align="right" class="border1" column_id="issue_less"></td>
                    <?php } ?>

                    <?php if($issue_net == true) {?>
                        <td align="right" class="border1" column_id="issue_net"></td>
                    <?php } ?>

                    <?php if($issue_touch == true) {?>
                        <td align="right" class="border1" column_id="issue_touch"></td>
                    <?php } ?>

                    <?php if($issue_fine == true) {?>
                        <td align="right" class="border1" column_id="issue_fine"></td>
                    <?php } ?>

                    <?php if($issue_pcs == true) {?>
                        <td align="left" class="border1" column_id="issue_pcs"></td>
                    <?php } ?>

                    <?php if($issue_alloy == true) {?>
                        <td align="left" class="border1" column_id="issue_alloy"></td>
                    <?php } ?>

                    <?php if($issue_item == true) {?>
                        <td align="left" class="border1" column_id="issue_item"></td>
                    <?php } ?>

                    <?php if($issue_person == true) {?>
                        <td align="right" class="border1" column_id="issue_person"></td>
                    <?php } ?>

                    <?php if($issue_ad_weight == true) {?>
                        <td align="left" class="border1" column_id="issue_ad_weight"></td>
                    <?php } ?>

                    <?php if($issue_ad_pcs == true) {?>
                        <td align="left" class="border1" column_id="issue_ad_pcs"></td>
                    <?php } ?>

                    <?php if($issue_remark == true) {?>
                        <td align="left" class="border1" column_id="issue_remark"></td>
                    <?php } ?>
                <?php }  ?>
            </tr>
        <?php } ?>
        
        <?php if($receive_total_finish == true || $issue_total_finish == true) { ?>
        <tr align="center" class="border1">
            <?php if($receive_total_finish == true) { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>" style="white-space: nowrap;">Total Receive Finish</th>

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_less, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_net_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_tunch, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_fine, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $total_receive_finish_pcs; ?></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_alloy, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_finish_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"><?php echo $total_receive_finish_ad_pcs; ?></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>" style="white-space: nowrap;"></th>

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>

            <?php if($issue_total_finish == true) { ?>
                <th align="right" column_id="issue_date" class="border1 text-nowrap" colspan="<?=$total_issue_label_colspan;?>">Total Issue Finish</th>

                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_less, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_net_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_tunch, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_fine, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"><?php echo $total_issue_finish_pcs; ?></th>
                <?php } ?>

                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_alloy, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_finish_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"><?php echo $total_issue_finish_ad_pcs; ?></th>
                <?php } ?>

                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>"></th>
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>

        <?php if($receive_total_scrap == true || $issue_total_scrap == true) { ?>
        <tr align="center"  class="border1 text-nowrap">
            <?php if($receive_total_scrap == true) { ?>    
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>">Total Receive Scrap</th>
                

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_less, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_net_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_tunch, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_fine, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $total_receive_scrap_pcs; ?></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_alloy, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_scrap_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"><?php echo $total_receive_scrap_ad_pcs; ?></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>" style="white-space: nowrap;"></th>

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>

            <?php if($issue_total_scrap == true) { ?> 
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>">Total Issue Scrap</th>

                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_less, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_net_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_tunch, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_fine, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"><?php echo $total_issue_scrap_pcs; ?></th>
                <?php } ?>

                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_alloy, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_scrap_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>

                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"><?php echo $total_issue_scrap_ad_pcs; ?></th>
                <?php } ?>

                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>"></th>
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>
        
        <?php if($receive_total == true || $issue_total == true) { ?>
        <tr align="center" class="border1 text-nowrap">
            <?php if($receive_total == true) { ?>
                <th align="left" column_id="receive_date" class="border1 " colspan="<?=$total_receive_label_colspan;?>">Total Receive</th>
                
                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"><?php echo number_format($total_receive_less, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($total_receive_net_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"><?php echo number_format($total_receive_tunch, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($total_receive_fine, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $total_receive_pcs; ?></th>
                <?php } ?>
                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($total_receive_alloy, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_receive_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"><?php echo $total_receive_ad_pcs; ?></th>
                <?php } ?>
                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>" style="white-space: nowrap;"></th>

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>
            
            <?php if($issue_total == true) { ?>
                <th align="right" column_id="issue_date" class="border1 text-nowrap" colspan="<?=$total_issue_label_colspan;?>">Total Issue</th>
                
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"><?php echo number_format($total_issue_less, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"><?php echo number_format($total_issue_net_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"><?php echo number_format($total_issue_tunch, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"><?php echo number_format($total_issue_fine, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"><?php echo $total_issue_pcs; ?></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"><?php echo number_format($total_issue_alloy, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_issue_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"><?php echo $total_issue_ad_pcs; ?></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>"></th>
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>

        <?php
            $total_ad_receive_weight = $total_receive_weight + $total_receive_ad_weight;
            $total_ad_receive_less = $total_receive_less;
            $total_ad_receive_net_weight = $total_ad_receive_weight - $total_ad_receive_less;
            $total_ad_receive_tunch = $total_receive_tunch;
            $total_ad_receive_fine = ($total_ad_receive_net_weight * $total_ad_receive_tunch) / 100;

            $total_ad_receive_fine = (($total_receive_finish_weight - ($total_issue_ad_weight - $total_receive_ad_weight)) * $melting) / 100;
            $total_ad_receive_tunch = (($total_ad_receive_fine / $total_receive_finish_weight) * 100);

            $total_ad_receive_pcs = $total_receive_pcs + $total_receive_ad_pcs;
            $total_ad_receive_alloy = $total_ad_receive_weight - $total_ad_receive_fine;
            $total_ad_receive_ad_weight = $total_receive_ad_weight;
            $total_ad_receive_ad_pcs = $total_receive_ad_pcs;

            $total_ad_issue_weight = $total_issue_weight + $total_issue_ad_weight;
            $total_ad_issue_less = $total_issue_less;
            $total_ad_issue_net_weight = $total_ad_issue_weight - $total_ad_issue_less;
            $total_ad_issue_fine = $total_issue_fine;
            $total_ad_issue_tunch = ($total_ad_issue_fine / $total_ad_issue_weight) * 100;
            $total_ad_issue_pcs = $total_issue_pcs + $total_issue_ad_pcs;
            $total_ad_issue_alloy = $total_ad_issue_weight - $total_ad_issue_fine;
            $total_ad_issue_ad_weight = $total_issue_ad_weight;
            $total_ad_issue_ad_pcs = $total_issue_ad_pcs;
        ?>
        
        <?php if($receive_total_with_ad == true || $issue_total_with_ad == true) { ?>
        <tr align="center" class="border1 text-nowrap">
            <?php if($receive_total_with_ad == true) { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>">Total Receive With AD</th>
                
                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_less, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_net_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_tunch, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_fine, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $total_ad_receive_pcs; ?></th>
                <?php } ?>
                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_alloy, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_ad_receive_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"><?php echo $total_ad_receive_ad_pcs; ?></th>
                <?php } ?>
                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="left" column_id="receive_date" class="border1" colspan="<?=$total_receive_label_colspan;?>" style="white-space: nowrap;"></th>

                <?php if($receive_weight == true) {?>
                    <th align="right" column_id="receive_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_less == true) {?>
                    <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_net == true) {?>
                    <th align="right" column_id="receive_net" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_touch == true) {?>
                    <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_fine == true) {?>
                    <th align="right" column_id="receive_fine" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_pcs == true) {?>
                    <th align="right" column_id="receive_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_alloy == true) {?>
                    <th align="right" column_id="receive_alloy" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_item == true) {?>
                    <th align="right" column_id="receive_item" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_person == true) {?>
                    <th align="right" column_id="receive_person" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_weight == true) {?>
                    <th align="right" column_id="receive_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_ad_pcs == true) {?>
                    <th align="right" column_id="receive_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>

                <?php if($receive_remark == true) {?>
                    <th align="right" column_id="receive_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>

            <?php if($issue_total_with_ad == true) { ?>
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>">Total Issue With AD</th>
                
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_less, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_net_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_tunch, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_fine, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"><?php echo $total_ad_issue_pcs; ?></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_alloy, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"><?php echo number_format($total_ad_issue_ad_weight, 3, '.', ''); ?></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"><?php echo $total_ad_issue_ad_pcs; ?></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } else { ?>
                <th align="right" column_id="issue_date" class="border1" colspan="<?=$total_issue_label_colspan;?>"></th>
                <?php if($issue_weight == true) {?>
                    <th align="right" column_id="issue_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_less == true) {?>
                    <th align="right" column_id="issue_less" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_net == true) {?>
                    <th align="right" column_id="issue_net" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_touch == true) {?>
                    <th align="right" column_id="issue_touch" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_fine == true) {?>
                    <th align="right" column_id="issue_fine" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_pcs == true) {?>
                    <th align="right" column_id="issue_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_alloy == true) {?>
                    <th align="right" column_id="issue_alloy" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_item == true) {?>
                    <th align="right" column_id="issue_item" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_person == true) {?>
                    <th align="right" column_id="issue_person" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_weight == true) {?>
                    <th align="right" column_id="issue_ad_weight" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_ad_pcs == true) {?>
                    <th align="right" column_id="issue_ad_pcs" class="border1 text-nowrap"></th>
                <?php } ?>
                <?php if($issue_remark == true) {?>
                    <th align="right" column_id="issue_remark" class="border1 text-nowrap"></th>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>
        
        <tr align="center" class="border1 text-nowrap">
            <?php $total_weight_bal = $total_ad_issue_weight - $total_ad_receive_weight; ?>
            <?php $total_net_weight_bal = $total_ad_issue_net_weight - $total_ad_receive_net_weight; ?>
            <?php $total_fine_bal = $total_ad_issue_fine - $total_ad_receive_fine; ?>
            <?php $total_pcs_bal = $total_ad_issue_pcs - $total_ad_receive_pcs; ?>
            <?php 
                if($receive_total_with_ad == true) {
                    $total_alloy_bal = $total_ad_issue_alloy - $total_ad_receive_alloy; 
                } else {
                    $total_alloy_bal = $total_issue_alloy - $total_receive_alloy;     
                }
                
            ?>
            
            <th align="left" column_id="receive_date" class="border1 text-nowrap" colspan="<?=$total_receive_label_colspan;?>">Balance</th>
            
            <?php if($receive_weight == true) {?>
                <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($total_weight_bal, 3, '.', ''); ?></th>
            <?php } ?>
            <?php if($receive_less == true) {?>
                <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
            <?php } ?>
            <?php if($receive_net == true) {?>
                <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($total_net_weight_bal, 3, '.', ''); ?></th>
            <?php } ?>
            <?php if($receive_touch == true) {?>
                <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
            <?php } ?>
            <?php if($receive_fine == true) {?>
                <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($total_fine_bal, 3, '.', ''); ?></th>
            <?php } ?>
            <?php if($receive_pcs == true) {?>
                <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $total_pcs_bal; ?></th>
            <?php } ?>
            <?php if($receive_alloy == true) {?>
                <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($total_alloy_bal, 3, '.', ''); ?></th>
            <?php } ?>
            <?php if($receive_item == true) {?>
                <th align="right" column_id="receive_item" class="border1"></th>
            <?php } ?>
            <?php if($receive_person == true) {?>
                <th align="right" column_id="receive_person" class="border1"></th>
            <?php } ?>
            <?php if($receive_ad_weight == true) {?>
                <th align="right" column_id="receive_ad_weight" class="border1"></th>
            <?php } ?>
            <?php if($receive_ad_pcs == true) {?>
                <th align="right" column_id="receive_ad_pcs" class="border1"></th>
            <?php } ?>
            <?php if($receive_remark == true) {?>
                <th align="right" column_id="receive_remark" class="border1"></th>
            <?php } ?>
            <?php if($issue_type == true) {?>
                <th align="right" column_id="issue_type" class="border1"></th>
            <?php } ?>
            <?php if($issue_date == true) {?>
                <th align="right" column_id="issue_date" class="border1"></th>
            <?php } ?>
            <?php if($issue_weight == true) {?>
                <th align="right" column_id="issue_weight" class="border1"></th>
            <?php } ?>
            <?php if($issue_less == true) {?>
                <th align="right" column_id="issue_less" class="border1"></th>
            <?php } ?>
            <?php if($issue_net == true) {?>
                <th align="right" column_id="issue_net" class="border1"></th>
            <?php } ?>
            <?php if($issue_touch == true) {?>
                <th align="right" column_id="issue_touch" class="border1"></th>
            <?php } ?>
            <?php if($issue_fine == true) {?>
                <th align="right" column_id="issue_fine" class="border1"></th>
            <?php } ?>
            <?php if($issue_pcs == true) {?>
                <th align="right" column_id="issue_pcs" class="border1"></th>
            <?php } ?>
            <?php if($issue_alloy == true) {?>
                <th align="right" column_id="issue_alloy" class="border1"></th>
            <?php } ?>
            <?php if($issue_item == true) {?>
                <th align="right" column_id="issue_item" class="border1"></th>
            <?php } ?>
            <?php if($issue_person == true) {?>
                <th align="right" column_id="issue_person" class="border1"></th>
            <?php } ?>
            <?php if($issue_ad_weight == true) {?>
                <th align="right" column_id="issue_ad_weight" class="border1"></th>
            <?php } ?>
            <?php if($issue_ad_pcs == true) {?>
                <th align="right" column_id="issue_ad_pcs" class="border1"></th>
            <?php } ?>
            <?php if($issue_remark == true) {?>
                <th align="right" column_id="issue_remark" class="border1"></th>
            <?php } ?>
        </tr>
        <?php
            if($receive_ad_pcs == true) {
                if(!empty($person_wise_balance)) {
                    foreach ($person_wise_balance as $key => $pwb_row) {
                        ?>
                        <tr align="center" class="border1 text-nowrap">
                            <?php
                                $total_weight_bal = $total_ad_issue_weight - $total_ad_receive_weight;
                                $total_net_weight_bal = $total_ad_issue_net_weight - $total_ad_receive_net_weight;
                                $total_fine_bal = $total_ad_issue_fine - $total_ad_receive_fine;
                                $total_pcs_bal = $total_ad_issue_pcs - $total_ad_receive_pcs;
                                if($receive_total_with_ad == true) {
                                    $total_alloy_bal = $total_ad_issue_alloy - $total_ad_receive_alloy; 
                                } else {
                                    $total_alloy_bal = $total_issue_alloy - $total_receive_alloy;     
                                }

                                $pr_ad_receive_weight = $pwb_row['receive_weight'] + $pwb_row['receive_ad_weight'];
                                $pr_ad_receive_less = $pwb_row['receive_less'];
                                $pr_ad_receive_net_weight = $pr_ad_receive_weight- $pr_ad_receive_less;
                                $pr_ad_receive_fine = (($pwb_row['receive_finish_weight'] - ($pwb_row['issue_ad_weight'] - $pwb_row['receive_ad_weight'])) * $melting) / 100;
                                $pr_ad_receive_pcs = $pwb_row['receive_pcs'] + $pwb_row['receive_ad_pcs'];
                                $pr_ad_receive_alloy = $pr_ad_receive_weight - $pr_ad_receive_fine;

                                $pr_ad_issue_weight = $pwb_row['issue_weight'] + $pwb_row['issue_ad_weight'];
                                $pr_ad_issue_less = $pwb_row['issue_less'];
                                $pr_ad_issue_net_weight = $pr_ad_issue_weight - $pr_ad_issue_less;
                                $pr_ad_issue_fine = $pwb_row['issue_fine'];
                                $pr_ad_issue_pcs = $pwb_row['issue_pcs'] + $pwb_row['issue_ad_pcs'];
                                $pr_ad_issue_alloy = $pr_ad_issue_weight - $pr_ad_issue_fine;

                                $pr_total_weight = $pr_ad_issue_weight - $pr_ad_receive_weight;
                                $pr_total_net_weight = $pr_ad_issue_net_weight - $pr_ad_receive_net_weight;
                                $pr_total_fine = $pr_ad_issue_fine - $pr_ad_receive_fine;
                                $pr_total_pcs = $pr_ad_issue_pcs - $pr_ad_receive_pcs;

                                if($receive_total_with_ad == true) {
                                    $pr_alloy_bal = $pr_ad_issue_alloy - $pr_ad_receive_alloy; 
                                } else {
                                    $pr_alloy_bal = $pwb_row['issue_alloy'] - $pwb_row['receive_alloy'];     
                                }
                                
                            ?>
                            
                            <th align="left" column_id="receive_date" class="border1 text-nowrap" colspan="<?=$total_receive_label_colspan;?>"><?=$pwb_row['job_worker_name']?></th>
                            
                            <?php if($receive_weight == true) {?>
                                <th align="right" column_id="receive_weight" class="border1 text-nowrap"><?php echo number_format($pr_total_weight, 3, '.', ''); ?></th>
                            <?php } ?>
                            <?php if($receive_less == true) {?>
                                <th align="right" column_id="receive_less" class="border1 text-nowrap"></th>
                            <?php } ?>
                            <?php if($receive_net == true) {?>
                                <th align="right" column_id="receive_net" class="border1 text-nowrap"><?php echo number_format($pr_total_net_weight, 3, '.', ''); ?></th>
                            <?php } ?>
                            <?php if($receive_touch == true) {?>
                                <th align="right" column_id="receive_touch" class="border1 text-nowrap"></th>
                            <?php } ?>
                            <?php if($receive_fine == true) {?>
                                <th align="right" column_id="receive_fine" class="border1 text-nowrap"><?php echo number_format($pr_total_fine, 3, '.', ''); ?></th>
                            <?php } ?>
                            <?php if($receive_pcs == true) {?>
                                <th align="right" column_id="receive_pcs" class="border1 text-nowrap"><?php echo $pr_total_pcs; ?></th>
                            <?php } ?>
                            <?php if($receive_alloy == true) {?>
                                <th align="right" column_id="receive_alloy" class="border1 text-nowrap"><?php echo number_format($pr_alloy_bal, 3, '.', ''); ?></th>
                            <?php } ?>
                            <?php if($receive_item == true) {?>
                                <th align="right" column_id="receive_item" class="border1"></th>
                            <?php } ?>
                            <?php if($receive_person == true) {?>
                                <th align="right" column_id="receive_person" class="border1"></th>
                            <?php } ?>
                            <?php if($receive_ad_weight == true) {?>
                                <th align="right" column_id="receive_ad_weight" class="border1"></th>
                            <?php } ?>
                            <?php if($receive_ad_pcs == true) {?>
                                <th align="right" column_id="receive_ad_pcs" class="border1"></th>
                            <?php } ?>
                            <?php if($receive_remark == true) {?>
                                <th align="right" column_id="receive_remark" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_type == true) {?>
                                <th align="right" column_id="issue_type" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_date == true) {?>
                                <th align="right" column_id="issue_date" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_weight == true) {?>
                                <th align="right" column_id="issue_weight" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_less == true) {?>
                                <th align="right" column_id="issue_less" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_net == true) {?>
                                <th align="right" column_id="issue_net" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_touch == true) {?>
                                <th align="right" column_id="issue_touch" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_fine == true) {?>
                                <th align="right" column_id="issue_fine" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_pcs == true) {?>
                                <th align="right" column_id="issue_pcs" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_alloy == true) {?>
                                <th align="right" column_id="issue_alloy" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_item == true) {?>
                                <th align="right" column_id="issue_item" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_person == true) {?>
                                <th align="right" column_id="issue_person" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_ad_weight == true) {?>
                                <th align="right" column_id="issue_ad_weight" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_ad_pcs == true) {?>
                                <th align="right" column_id="issue_ad_pcs" class="border1"></th>
                            <?php } ?>
                            <?php if($issue_remark == true) {?>
                                <th align="right" column_id="issue_remark" class="border1"></th>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                }
                if(!empty($person_wise_receive_ad_pcs)) {
                    $pw_receive_ad_pcs_html = '';
                    foreach ($person_wise_receive_ad_pcs as $key => $tmp_row) {
                        $pw_receive_ad_pcs_html .= $tmp_row['job_worker_name'].' : '.$tmp_row['receive_ad_pcs'].' &nbsp; &nbsp;';
                    }
                    ?>
                    <tr align="center" class="border1 text-nowrap">
                        <td align="left" column_id="receive_date" class="border1 text-nowrap" colspan="<?=$total_receive_columns + $total_issue_columns;?>">
                            <strong class="TEXT_BOLD">Person Receive Ad Pcs</strong>  &nbsp; &nbsp; &nbsp; &nbsp; <?=$pw_receive_ad_pcs_html;?>
                        </td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>