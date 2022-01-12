<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PACKAGE_NAME; ?> | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
        <!-- Font Awesome -->
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/adminlte.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-------- /Parsleyjs --------->
  <link href="<?= base_url('assets/plugins/parsleyjs/src/parsley.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
        <div class="login-logo">
            <b><?=PACKAGE_NAME;?></b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <label id="username-error" class="text-danger login-box-msg" style="padding-left:50px;" for="invalid"><?php echo isset($errors['invalid'])?$errors['invalid']:''; ?></label>
                <form class="form-horizontal" action="auth/login" id="login_form"  method="post" name="login_form" enctype="multipart/form-data" data-parsley-validate="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username" autofocus="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label id="username-error" class="text-danger login-box-msg" style="padding-left:50px;" for="invalid"><?php echo isset($errors['user_name'])?$errors['user_name']:''; ?></label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label id="username-error" class="text-danger login-box-msg" style="padding-left:50px;" for="invalid"><?php echo isset($errors['user_pass'])?$errors['user_pass']:''; ?></label>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- iCheck -->
        <script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-------- /Parsleyjs --------->
        <script src="<?= base_url('assets/plugins/parsleyjs/dist/parsley.min.js');?>"></script>
        <script>
            $(function () {

            });
        </script>
    </body>
</html>
