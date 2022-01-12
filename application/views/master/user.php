<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> User</h1>
            <?php $isEdit = $this->app_model->have_access_role(USER_MODULE_ID, "edit");
            $isView = $this->app_model->have_access_role(USER_MODULE_ID, "view");
            $isAdd = $this->app_model->have_access_role(USER_MODULE_ID, "add"); ?>
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

                            <table id="user_table" class="table table-striped table-bordered"style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Action</th>
                                        <th>Name</th>
                                        <th>Username</th> 
                                        <th>Email Id</th>
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
                        <form class="form-horizontal" action="master/save_user" id="user_form"  method="post" name="user_form" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="card-body">
                                <?php if(isset($user_data->user_id) && !empty($user_data->user_id)){ ?>
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data->user_id; ?>">
                                <?php }?>
                                <div class="form-group">
                                    <label for="name">Name<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($user_data->name) && !empty($user_data->name) ? $user_data->name : ''; ?>" required="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email Id<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="user_email" name="user_email" class="form-control" value="<?php echo isset($user_data->user_email) && !empty($user_data->user_email) ? $user_data->user_email : ''; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="user_name">Username<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo isset($user_data->user_name) && !empty($user_data->user_name) ? $user_data->user_name : ''; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="password" name="password" class="form-control" value="" autofocus="">
                                </div>
                                <div class="form-group">
                                    <?php if (isset($user_data->user_id) && !empty($user_data->user_id)) { ?>
                                        <span>
                                            <small>Remain Password box blank, if you do Not want to change Password</small>
                                        </span>
                                        <br>
                                    <?php } ?>
                                    <label for="confirm_pass">Confirm Password<span class="required-sign">&nbsp;*</span></label>
                                    <input type="text" id="confirm_pass" name="confirm_pass" class="form-control" value="" autofocus="">
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
        table = $('#user_table').DataTable({
            "serverSide": true,
            "scrollY": "480px",
            "scrollX": true,
            "search": true,
            "ordering": [1, "desc"],
            "scroller": {
                loadingIndicator: true
            },
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('master/user_datatable') ?>",
                "type": "POST",
                "data": function (d) {
                },
            }

        });

        $(document).on('submit', '#user_form', function () {

            if ($.trim($("#name").val()) == '') {
                show_notify('Please Enter Name.', false);
                $("#name").focus();
                return false;
            }

            var user_email = $('#user_email').val();
            if(user_email != ''){
                if( !validateEmail(user_email)) {
                    show_notify('Please Enter Valid Email.', false);
                    $("#user_email").focus();
                    return false;
                }
            }
            if ($.trim($("#user_name").val()) == '') {
                show_notify('Please Enter Username.', false);
                $("#user_name").focus();
                return false;
            }


            if($.trim($("#user_id").val()) == ""){
                if ($.trim($("#password").val()) == '') {
                    show_notify('Please Enter password.', false);
                    $("#password").focus();
                    return false;
                }
                if($.trim($("#confirm_pass").val()) == ""){
                    show_notify('Please enter confirm password.',false);
                    $("#confirm_pass").focus();
                    return false;
                }
                if($.trim($("#password").val()) != $.trim($("#confirm_pass").val())) {
                    show_notify('Please re-enter confirm password.',false);
                    $("#confirm_pass").val("");
                    $("#confirm_pass").focus();
                    return false;
                }
            } else {
                if ($.trim($("#password").val()) != '') {
                    if($.trim($("#confirm_pass").val()) == ""){
                        show_notify('Please enter confirm password.',false);
                        $("#confirm_pass").focus();
                        return false;
                    }

                    if($.trim($("#password").val()) != $.trim($("#confirm_pass").val())) {
                        show_notify('Please re-enter confirm password.',false);
                        $("#confirm_pass").val("");
                        $("#confirm_pass").focus();
                        return false;
                    }
                }
            }

            $('.module_save_btn').attr('disabled', 'disabled');
            var postData = new FormData(this);
            $.ajax({
                url: "<?= base_url('master/save_user') ?>",
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: postData,
                success: function (response) {
                    var json = $.parseJSON(response);

                    if (json['error'] == 'Exist') {
                        show_notify(json['error_exist'], false);
                    } else if (json['success'] == 'Added') {
                        $('input').val('');
                        table.draw();
                        show_notify('User Added Successfully!', true);
                    } else if (json['success'] == 'Updated') {
                        $('#note').val('');
                        window.location.href = "<?php echo base_url('master/user') ?>";
                    }
                    $('.module_save_btn').removeAttr('disabled', 'disabled');
                    return false;
                },
            });
            return false;
        });

        $(document).on("click",".delete_button",function(){
            if(confirm('Are you sure delete this User?')){
                $.ajax({
                    url: $(this).data('href'),
                    type: "POST",
                    data: 'id_name=user_id&table_name=user',
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json['error'] == 'Error') {
                            show_notify('You cannot delete this User. This User has been used.', false);
                        } else if (json['success'] == 'Deleted') {
                            table.draw();
                            show_notify('User Deleted Successfully!', true);
                        }
                    }
                });
            }
        });
    });
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }
</script>