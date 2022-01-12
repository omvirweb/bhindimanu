<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Design No</h1>
            <?php $isEdit = $this->app_model->have_access_role(DESIGN_NO_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(DESIGN_NO_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(DESIGN_NO_MODULE_ID, "add"); ?>
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
                        <table class="table row-border table-bordered table-striped design-table"style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Design No</th>
                                    <th>Item Name</th>
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
                    <form class="form-horizontal" action="master/save_design_no" id="design_form"  method="post" name="design_form" enctype="multipart/form-data" data-parsley-validate="">
                        <div class="card-body">
                            <?php if(isset($design->id) && !empty($design->id)){ ?>
                                <input type="hidden" name="id" id="id" value="<?php echo $design->id; ?>">
                            <?php }?>
                            <div class="form-group">
                                <label for="Item">Item<span class="required-sign">&nbsp;*</span></label>
                                <select name="item_id" id="item_id" class="select2" required="">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Design">Design No<span class="required-sign">&nbsp;*</span></label>
                                <input type="text" id="design_no" name="design_no" class="form-control" value="<?php echo isset($design->design_no) && !empty($design->design_no) ? $design->design_no : ''; ?>" required="">
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
        initAjaxSelect2($("#item_id"),"<?=base_url('app/item_select2_source')?>");
        <?php if(isset($design->item_id) && !empty($design->item_id)){ ?>
        setSelect2Value($("#item_id"),"<?=base_url('app/set_item_select2_val_by_id/'.$design->item_id)?>");
        <?php } ?>
        $('#item_id').select2('open');
        table = $('.design-table').DataTable({
            "serverSide": true,
            "scrollY": "480px",
            "scrollX": true,
            "search": true,
            "ordering": [1, "desc"],
            "order": [],
            scroller: {
                loadingIndicator: true
            },
            "ajax": {
                "url": "<?php echo site_url('master/design_no_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                },
                "complete": function () {
                    $('#ajax-loader').hide();
                },
            },

        });

        $(document).on('submit', '#design_form', function () {
            $(window).unbind('beforeunload');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_design_no') ?>",
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
                        $('#design_form').find('input, select, textarea').val('');
                        $("#item_id").val(null).trigger("change");
                        table.draw();
                        toastr.success('Design No Addedd Successfully!');
                    }
                    if (json['success'] == 'Updated') {
                        window.location.href = "<?= base_url('master/design_no') ?>";
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
                    data: 'id_name=id&table_name=design_no',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this Design No. This Design No has been used.', false);
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