<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Item</h1>
            <?php $isEdit = $this->app_model->have_access_role(ITEM_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(ITEM_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(ITEM_MODULE_ID, "add"); ?>
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
                            <table class="table table-striped table-bordered item-table"style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="80px">Action</th>
                                        <th>Item Name</th>
                                        <th>Short Name</th>
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
                        <form class="form-horizontal" action="master/save_item" id="item_form"  method="post" name="item_form" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="card-body">
                                <?php if(isset($item->item_id) && !empty($item->item_id)){ ?>
                                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $item->item_id; ?>">
                                <?php }?>
                                <div class="form-group">
                                    <label for="item_name">Item Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="item_name" name="item_name" class="form-control" value="<?php echo isset($item->item_name) && !empty($item->item_name) ? $item->item_name : ''; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="short_name">Short Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="short_name" name="short_name" class="form-control" value="<?php echo isset($item->short_name) && !empty($item->short_name) ? $item->short_name : ''; ?>" required="" autofocus="">
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
        table = $('.item-table').DataTable({
            "serverSide": true,
            "ordering": true,
            "searching": true,
            "aaSorting": [[1, 'asc']],
            "scroller": {
                loadingIndicator: true
            },
            "ajax": {
                    "url": "<?php echo base_url('master/item_datatable')?>",
                    "type": "POST",
                    "data": function (d) {
                    },
            },
            "scrollY": '350',
            "scrollX": true,
        });

        $(document).on('submit', '#item_form', function () {
            $(window).unbind('beforeunload');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_item') ?>",
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
                        $('#item_form').find('input, select, textarea').val('');
                        table.draw();
                        toastr.success('Item Addedd Successfully!');
                    }
                    if (json['success'] == 'Updated') {
                        window.location.href = "<?= base_url('master/item') ?>";
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
                    data: 'id_name=item_id&table_name=item',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Item. This Item has been used.', false);
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