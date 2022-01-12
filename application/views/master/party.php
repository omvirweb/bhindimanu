<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Party</h1>
            <?php $isEdit = $this->app_model->have_access_role(PARTY_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(PARTY_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(PARTY_MODULE_ID, "add"); ?>
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
                            <table class="table table-striped table-bordered party-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
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
                        <form class="form-horizontal" action="master/save_party" id="party_form"  method="post" name="party_form" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="card-body">
                                <?php if(isset($party->party_id) && !empty($party->party_id)){ ?>
                                    <input type="hidden" name="party_id" id="party_id" value="<?php echo $party->party_id; ?>">
                                <?php }?>
                                <div class="form-group">
                                    <label for="Name">Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($party->name) && !empty($party->name) ? $party->name : ''; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="4"><?php echo isset($party->address) && !empty($party->address) ? $party->address : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Mobile">Mobile No</label>
                                    <input type="text" id="mobile_no" name="mobile_no" maxlength="10"  pattern="[0-9]{10}" class="form-control" value="<?php echo isset($party->mobile_no) && !empty($party->mobile_no) ? $party->mobile_no : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($party->email) && !empty($party->email) ? $party->email : ''; ?>">
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
        table = $('.party-table').DataTable({
            "serverSide": true,
            "ordering": true,
            "searching": true,
            "aaSorting": [[1, 'asc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                "url": "<?php echo base_url('master/party_datatable')?>",
                "type": "POST",
                "data": function (d) {
                },
            },
            "scrollY": '350',
            "scrollX": true,
        });

        $(document).on('submit', '#party_form', function () {
            $(window).unbind('beforeunload');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_party') ?>",
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
                        $('#party_form').find('input, select, textarea').val('');
                        table.draw();
                        toastr.success('Party Addedd Successfully!');
                    }
                    if (json['success'] == 'Updated') {
                        window.location.href = "<?= base_url('master/party') ?>";
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
                    data: 'id_name=party_id&table_name=party',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Party. This Party has been used.', false);
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