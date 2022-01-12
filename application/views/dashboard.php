<?php
    $this->load->view('header');
?>
<?php $this->load->view('success_false_notify'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="dashboard_party_id"> Party</label>
                    <select id="dashboard_party_id" class="form-control"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="item_id"> Item</label>
                    <select id="dashboard_item_id" class="form-control"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="Touch"> Touch</label>
                    <input type="text" id="dashboard_touch" class="form-control">
                </div>
            </div>
            <div class="col-md-1">
                <br/><button type="button" class="btn btn-info" id="btn_load_process_gross">Go</button>
            </div>
        </div>
        <br/>
        <div class="row">

            <?php
            if(!empty($process_master_res)) {
                $box_bg = array('bg-warning','bg-success','bg-info');
                $box_bg_ind = 0;
                $row_ind = 1;
                foreach ($process_master_res as $key => $process_master_row) {
                    
                    ?>
                    <div class="col-md-4">
                        <a href="<?= base_url(); ?>auth/person_wise_process_gross/<?php echo $process_master_row->id; ?>" >
                            <div class="info-box mb-3 <?=$box_bg[$box_bg_ind]?>">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?=$process_master_row->process_name?></span>
                                    <span class="info-box-number process_gross" id="process_gross_<?=$process_master_row->id?>">0.000</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    $box_bg_ind++;
                    if(($key + 1) % 3 == 0) {
                        $row_ind++;

                        if($row_ind == 1) {
                            $box_bg_ind = 0;

                        } elseif($row_ind == 2) {
                            $box_bg_ind = 1;
                        
                        } elseif($row_ind == 3) {
                            $box_bg_ind = 2;
                        } else {
                            $box_bg_ind = 0;
                        }
                        
                        
                        if($row_ind > 3) {
                            $row_ind = 1;
                        }
                    }

                    if($box_bg_ind > 2) {
                        $box_bg_ind = 0;
                    }                    
                }
            }
            ?>
        </div>
        
        <!-- /.row -->
      
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
        load_process_gross();
        initAjaxSelect2($("#dashboard_party_id"), "<?= base_url('app/party_select2_source') ?>");
        initAjaxSelect2($("#dashboard_item_id"), "<?= base_url('app/item_select2_source') ?>");
        $(document).on('click',"#btn_load_process_gross",function(){
            load_process_gross();
        });
    });
    function load_process_gross()
    {
        $.ajax({
            url: "<?= base_url('app/get_process_gross') ?>",
            type: "POST",
            data: {party_id : $("#dashboard_party_id").val(),item_id : $("#dashboard_item_id").val(),touch : $("#dashboard_touch").val()},
            dataType:'json',
            success: function (res) {
                var process_gross = res.process_gross;
                $.each(process_gross,function(ind,value){
                    if($("#process_gross_" + ind).length > 0) {
                        $("#process_gross_" + ind).html(value);
                    }
                });
            },
        });
    }
</script>
<?php
    $this->load->view('footer');
?>