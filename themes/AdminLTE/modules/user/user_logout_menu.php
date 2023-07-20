<ul class="dropdown-menu">
    <!-- The user image in the menu -->
    <li class="user-header">
        <img src="<?php echo $logo_image; ?>" style="width:auto;height:50px;border:0px;margin-top:20px;" class="img" alt="Logo Image">
        <p>
            <?php if(isset($whoIsOnline)){echo $whoIsOnline;} ?>  <br>
            <?php if(isset($userEntity)){echo $userEntity;} ?>          
        </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
        <div class="pull-left">
            <a href="<?php echo $home.'/user/profile/view'; ?>" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
            <a href="<?php echo $home.'/user/auth/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
        </div>
    </li>
</ul>