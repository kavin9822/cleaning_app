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
    <!-- Remember Me -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/my_site.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>  
  <body class="hold-transition login-page" onload="checkCookie()">
    <div class="login-box">
      <div class="login-logo">
          <b><?php echo $company_short_name; ?></b> Login
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?php echo $home.'/'.$module.'/'.$controller .'/otp'; ?>" method="post">
          <div class="form-group has-feedback">
              <input type="number" class="form-control" value='<?php echo ($_SESSION['OTPFourDigNo']); ?>' placeholder="OTP Number" name="otp" id="otp" >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          
          <div class="form-group has-feedback">
              <button type="submit" name = "login_submit" value="submit" onclick="toggle()" class="btn btn-primary btn-block btn-flat">Sign In with OTP</button>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          
          
          <div class="form-group has-feedback">  <span class="label label-warning text-center"><?php if(isset($message)){echo $message;} ?></span> </div>
          
        </form>        
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->   

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