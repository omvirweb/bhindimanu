<?php $this->load->view('success_false_notify'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> User Rights</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <form class="form-horizontal main-frm">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">User Type<span class="required-sign">*</span></label>
                                <div class="col-sm-4">
                                    <select class="form-control select2" id="user_type" name="user_type" onchange="window.location='<?php echo base_url(); ?>master/user_rights?user_type='+$(this).val();">
                                        <option value="">- Select User - </option>
                                        <?php foreach($users as $user):?>
                                        <option <?php echo $user_type_id == $user->user_id ? 'selected="selected"':''; ?> value="<?php echo $user->user_id; ?>"><?php echo $user->user_name; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <a class="btn btn-success btn-update-roles float-right" style="right:30px; position:fixed;">Update</a>
                            <div class="clearfix">&nbsp;</div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="card card-primary" style="position:inherit;">
                            <div class="card-header">
                                <h3 class="card-title">Module AND Roles</h3>
                            </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="20%">Module</th>
                                                <th width="80%">
                                                    Roles
                                                    <a class="btn btn-xs btn-danger un-chk-all float-right">Un Select ALL</a>
                                                    <a class="btn btn-xs btn-primary chk-all float-right" style="margin-right: 5px;">Select ALL</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(count($modules_roles) > 0):
                                            ?>
                                            <?php foreach($modules_roles as $key => $row):?>
                                            <tr>
                                                <td><?php echo $row['title'];?></td>
                                                <td>
                                                    <?php foreach($row['roles'] as $role):?>
                                                    <label class="col-sm-2">
                                                        <input type="checkbox" <?php echo in_array($role['module_role_id'], $user_roles) ? 'checked="checked"':''; ?> class="chkids <?php echo $row['main_module']; ?>" value="<?php echo $role['module_role_id'];?>" name="roles[<?php echo $role['module_role_id'];?>_<?php echo $role['website_module_id'];?>]" /> <?php echo str_replace("_", " ", ucwords($role['title']));?>
                                                    </label>
                                                    <?php endforeach;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a class="btn btn-success btn-update-roles float-right">Update</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#user_type').select2();
        $(".chk-all").click(function(){
            $(".chkids").prop("checked",true);
        });

        $(".un-chk-all").click(function(){
            $(".chkids").prop("checked",false);
        });
        
        $(document).on("keydown", function(e){
            if(e.ctrlKey && e.which == 83){
                update_rights();
                return false;
            }
        });

        $(".btn-update-roles").click(function(){
            update_rights();
            return false;
        });
    });
    
    function update_rights(){
        $.ajax({
            type: 'post',
            url: '<?=base_url("master/update_roles/")?>',
            data: $('.main-frm').serialize(),
            success: function(data) {
                var data = JSON.parse(data);
                $msg = data.msg;
                if(data.status == 1)
                {
                    show_notify($msg,true);
                }
                else
                {
                    show_notify($msg,false);
                }

            },
        });
    }
</script>
