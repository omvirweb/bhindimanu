<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Person</h1>
            <?php $isEdit = $this->app_model->have_access_role(JOB_WORKER_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(JOB_WORKER_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(JOB_WORKER_MODULE_ID, "add"); ?>
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
                            <table class="table table-striped table-bordered job_worker-table"style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Person Name</th>
                                        <th>Wastage / Loss Allowed</th>
                                        <th>Used Moti On</th>
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
                        <form class="form-horizontal" action="master/save_job_worker" id="job_worker_form"  method="post" name="job_worker_form" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="card-body">
                                <?php if(isset($job_worker->id) && !empty($job_worker->id)){ ?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $job_worker->id; ?>">
                                <?php }?>
                                <div class="form-group">
                                    <label for="job_worker">Person Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="job_worker" name="job_worker" class="form-control" value="<?php echo isset($job_worker->job_worker) && !empty($job_worker->job_worker) ? $job_worker->job_worker : ''; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="wastage_loss_allowed">Wastage / Loss Allowed<span class="required-sign">&nbsp;*</span> <small class="text-info">Loss Allowed @ 100 Gram</small></label>
                                    <input type="text" id="wastage_loss_allowed" name="wastage_loss_allowed" class="form-control" value="<?php echo isset($job_worker->wastage_loss_allowed) && !empty($job_worker->wastage_loss_allowed) ? $job_worker->wastage_loss_allowed : '0'; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="used_moti_on">
                                        <input type="checkbox" id="used_moti_on" name="used_moti_on" value="1" <?php echo isset($job_worker->used_moti_on) && !empty($job_worker->used_moti_on) ? 'Checked' : ''; ?> >
                                        If you want Used Moti = Issue Moti - Receive Moti, tick here (Not tick means it will depend on weight)
                                    </label>
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
        table = $('.job_worker-table').DataTable({
            "serverSide": true,
            "ordering": true,
            "searching": true,
            "aaSorting": [[1, 'asc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                    "url": "<?php echo base_url('master/job_worker_datatable')?>",
                    "type": "POST",
                    "data": function (d) {
                    },
            },
            "scrollY": '350',
            "scrollX": true,
            "columnDefs": [
                {
                    "className": "text-right",
                    "targets": [2],
                },
            ]
        });

        $(document).on('submit', '#job_worker_form', function () {
            $(window).unbind('beforeunload');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_job_worker') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: postData,
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json['error'] == 'Exist') {
                        toastr.error(json['error_exist']);
                        //show_notify(json['error_exist'], false);
                    }
                    if (json['success'] == false) {
                        $.each(json['message'], function (key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group').find('.error-msg').remove();
                            //element.closest('div.form-group').removeClass('has-error').addClass(value.length > 0 ? 'has-error' : 'has-success').find('.text-danger').remove();
                            element.after(value);
                        });
                    }
                    if (json['success'] == 'Added') {
                        $('#job_worker_form').find('input, select, textarea').val('');
                        $('#job_worker_form').find('input[type="checkbox"]').prop('checked', false);;
                        table.draw();
                        toastr.success('Person Addedd Successfully!');
                    }
                    if (json['success'] == 'Updated') {
                        window.location.href = "<?= base_url('master/job_worker') ?>";
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
                    data: 'id_name=id&table_name=job_worker',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Person. This Person has been used.', false);
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