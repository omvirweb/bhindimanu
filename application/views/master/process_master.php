<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-12">
            <?php $isEdit = $this->app_model->have_access_role(PROCESS_MASTER_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(PROCESS_MASTER_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(PROCESS_MASTER_MODULE_ID, "add"); ?>
            <h1 class="m-0 text-dark"> 
                Process Master
                <?php if($isAdd) { ?>
                    <a href="<?= base_url('master/process_master') ?>" class="btn btn-primary btn-sm float-right" style="margin: 5px;">Add New Process</a>
                <?php } ?>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <?php if($isView){ ?>
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-striped table-bordered process_master-table"style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Process Name</th>
                                        <th>Sequence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <?php if($isAdd || $isEdit) { ?>
                    <div class="card card-primary">
                        <form class="form-horizontal" action="master/save_process_master" id="process_master_form"  method="post" name="process_master_form" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="card-body">
                                <?php if(isset($process_master->id) && !empty($process_master->id)){ ?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $process_master->id; ?>">
                                <?php }?>
                                <div class="form-group">
                                    <label for="process_name">Process Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="process_name" name="process_name" class="form-control" value="<?php echo !empty($process_master->process_name) ? $process_master->process_name : ''; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="sequence">Sequence<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="sequence" name="sequence" class="form-control num_only" value="<?php echo !empty($process_master->sequence) ? $process_master->sequence : ''; ?>" required="">
                                </div>
                                <div class="row d-none">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="on_how_much">Loss Allowed On How Much</label>
                                            <input type="text" id="on_how_much" name="on_how_much" class="form-control num_only" value="<?php echo !empty($process_master->on_how_much) ? $process_master->on_how_much : ''; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="allowed_loss">Allowed Loss</label>
                                            <input type="text" id="allowed_loss" name="allowed_loss" class="form-control num_only" value="<?php echo !empty($process_master->allowed_loss) ? number_format($process_master->allowed_loss, 3, '.', '') : ''; ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <small class="text-info">Allowed Loss 0 means koi pan loss allowed, 0 sivaay ni value ma report aavse</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-danger">Manufacture Issue Fields</h5>
                                    </div>
                                    <?php foreach ($process_issue_fields as $key => $process_issue_field) { ?>
                                            <div class="col-md-4 col-sm-4">
                                                <label for="<?php echo $process_issue_field['id']; ?>">
                                                    <input type="checkbox" id="<?php echo $process_issue_field['id']; ?>" name="process_issue_fields[]" value="<?php echo $process_issue_field['id']; ?>" <?php if(in_array($process_issue_field['id'], $selected_process_issue_fields)){ echo 'Checked'; } ?> <?php if($process_issue_field['text'] == 'Vetran'){ echo 'disabled=""'; } ?> >
                                                    <?php echo $process_issue_field['text']; ?>
                                                </label>
                                            </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-danger">Manufacture Receive Fields</h5>
                                    </div>
                                    <?php foreach ($process_receive_fields as $key => $process_receive_field) { ?>
                                            <div class="col-md-4 col-sm-4">
                                                <label for="<?php echo $process_receive_field['id']; ?>">
                                                    <input type="checkbox" id="<?php echo $process_receive_field['id']; ?>" name="process_receive_fields[]" value="<?php echo $process_receive_field['id']; ?>" <?php if(in_array($process_receive_field['id'], $selected_process_receive_fields)){ echo 'Checked'; } ?> <?php if($process_receive_field['text'] == 'Vetran' || $process_receive_field['text'] == 'Loss' || $process_receive_field['text'] == 'Loss Fine'){ echo 'disabled=""'; } ?> >
                                                    <?php echo $process_receive_field['text']; ?>
                                                </label>
                                            </div>
                                    <?php } ?>
                                </div><br><hr><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-danger">Columns</h5>
                                        </div>
                                        <?php
                                            $selected_columns = array();
                                            if(!empty($process_master->print_columns)) {
                                                $selected_columns = explode(',', $process_master->print_columns);
                                            }
                                            $print_columns = $this->app_model->get_process_print_columns();
                                            foreach ($print_columns as $key => $print_column) {
                                                ?>
                                                <div class="col-md-6 col-sm-6">
                                                    
                                                        <label for="prt_<?=$print_column['id']?>">
                                                            <input type="checkbox" id="prt_<?=$print_column['id']?>" name="print_columns[]" value="<?=$print_column['id']?>" <?=in_array($print_column['id'],$selected_columns)?'checked':''?>>
                                                            <?=$print_column['text']?>          
                                                        </label>
                                                    
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <div class="col-md-12">
                                            <h5 class="text-danger">Rows</h5>
                                        </div>
                                        <?php
                                            $selected_columns = array();
                                            if(!empty($process_master->print_columns)) {
                                                $selected_columns = explode(',', $process_master->print_columns);
                                            }
                                            $print_columns = $this->app_model->get_process_print_rows();
                                            foreach ($print_columns as $key => $print_column) {
                                                ?>
                                                <div class="col-md-6 col-sm-6">
                                                    
                                                        <label for="prt_<?=$print_column['id']?>">
                                                            <input type="checkbox" id="prt_<?=$print_column['id']?>" name="print_columns[]" value="<?=$print_column['id']?>" <?=in_array($print_column['id'],$selected_columns)?'checked':''?>>
                                                            <?=$print_column['text']?>          
                                                        </label>
                                                    
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info float-right">Save</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    var table;
    $(document).ready(function(){
        table = $('.process_master-table').DataTable({
            "serverSide": true,
            "ordering": true,
            "searching": true,
            "aaSorting": [[2, 'asc']],
            "ajax": {
                    "url": "<?php echo base_url('master/process_master_datatable')?>",
                    "type": "POST",
                    "data": function (d) {
                    },
            },
            "scrollY": '350',
            "scrollX": true,
            "paging": false,
            "columnDefs": [{
                    "className": "text-right",
                    "targets": [2]
            }],
        });

        $(document).on('submit', '#process_master_form', function () {
            $(window).unbind('beforeunload');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_process_master') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: postData,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json['error'] == 'Exist') {
                        toastr.error(json['error_exist']);
                    }
                    if (json['success'] == false) {
                        $.each(json['message'], function (key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group').find('.error-msg').remove();
                            element.after(value);
                        });
                    }
                    if (json['success'] == 'Added') {
                        $('#process_master_form').find('input, select, textarea').val('');
                        $('#process_master_form').find('input[type="checkbox"]').prop('checked', false);
                        table.draw();
                        toastr.success('Process Addedd Successfully!');
                    }
                    if (json['success'] == 'Updated') {
                        window.location.href = "<?= base_url('master/process_master') ?>";
                    }
                    return false;
                },
            });
            return false;
        });

        $(document).on("click",".delete_button",function(){
            if(confirm('Are you sure delete this records?')){
                $.ajax({
                    url: $(this).data('href'),
                    type: "POST",
                    data: 'id_name=id&table_name=process_master',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Process. This Process has been used.', false);
                        } else if (json['success'] == 'Deleted') {
                            table.draw();
                            show_notify('Deleted Successfully!', true);
                        }
                    }
                });
            }
        });
    });
</script>