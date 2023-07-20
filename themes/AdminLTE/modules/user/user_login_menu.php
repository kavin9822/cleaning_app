<ul class="dropdown-menu">
    <!-- The user image in the menu -->
    <li class="user-header">
        <img src="<?php echo $logo_image; ?>" style="width:auto;height:50px;border:0px;margin-top:20px;" class="img" alt="Logo Image">
        <p>
            <?php if(isset($whoIsOnline)){echo $whoIsOnline;} ?>
        </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
        <div class="pull-left">
            <a href="<?php echo $home.'/user/auth/register'; ?>" class="btn btn-default btn-flat">Register</a>
        </div>
        <div class="pull-right">
            <a href="<?php echo $home.'/user/auth/login'; ?>" class="btn btn-default btn-flat">Sign in</a>
        </div>
    </li>
</ul>