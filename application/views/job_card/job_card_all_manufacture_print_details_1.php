<div class="content" id="body-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 pr-0">Job Card No : <?php echo $manufacture_row->job_card_id ?>
                            <div class="form-group">id="job_card_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"
                                <select name="job_card_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" id="job_card_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>" class="form-control" data-index="1" <?php echo ($view_pwm == 'view_process_wise_manufacture') ? 'disabled' : ''; ?> ></select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        initAjaxSelect2($("#job_card_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"), "<?= base_url('app/job_card_select2_source') ?>");
        <?php if(isset($manufacture_row->job_card_id)){ ?>
            setSelect2Value($("#job_card_id<?php echo (isset($job_card_all_manufacture_print)) ? $job_card_all_manufacture_print : ''; ?>"),"<?=base_url('app/set_job_card_select2_val_by_id/'.$manufacture_row->job_card_id)?>");
        <?php } ?>
    });
</script>
