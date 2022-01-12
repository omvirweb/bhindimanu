<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Design No</h1>
            
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <form class="form-horizontal" method="post" id="design_no_form" action="<?= base_url('master/save_upload_design_no') ?>" novalidate enctype="multipart/form-data">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label><span style="color: red">Upload Only CSV File</span></label>
                                    <br/>
                                    <label>Select File<span style="color: red">*</span></label>
                                    <input type="file" name="file_design_no" id="file_design_no" required="" >
                                    <input type="submit" name="submit" class="btn btn-primary btn-sm pull-left module_save_btn" value="Upload">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('submit', '#design_no_form', function () {
            if ($.trim($("#file_design_no").val()) == '') {
                show_notify('Please Select File.', false);
                $("#file_design_no").focus();
                return false;
            }

            $('.module_save_btn').attr('disabled', 'disabled');
        });
    });
</script>