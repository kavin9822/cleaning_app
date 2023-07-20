<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($title)){echo $title;} ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <b><?php echo $company_short_name; ?></b> Register
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form action="<?php echo $home.'/'.$module.'/'.$controller .'/register'; ?>" method="post">
          <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Full name" name="user_nicename" value="<?php if(isset($reg_form_values['user_nicename'])){echo $reg_form_values['user_nicename'];}?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="email" class="form-control" placeholder="Email" name="user_email" value="<?php if(isset($reg_form_values['user_email'])){echo $reg_form_values['user_email'];}?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="user_pass">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Retype password" name="re_user_pass">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="number" class="form-control" placeholder="Mobile No." name="user_mobileno">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="terms" value="1"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="reg_submit">Register</button>
            </div><!-- /.col -->
          </div>
        </form>
        
        <a href="<?php echo $home.'/'.$module.'/'.$controller .'/login'; ?>" class="text-center">I already have a membership</a>  | <a href="<?php echo $home.'/'; ?>" class="text-right">Home</a>
        <br>
        <span class="label label-warning text-center"><?php if(isset($message)){echo $message;} ?></span>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
