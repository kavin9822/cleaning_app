<?php //if ($wp || $rp) : ?> 
    <h2 class="">Login Form</h2>
    <form class="" method="POST" action="<?php echo $action_url ?>">
        <label for="userName">Your Name</label>
        <input id="userName" name ="userName"  type="text"  placeholder="User Name">
        <label for="password">Your Password</label>
        <input id="password" name="password" type="password" placeholder="Your Password">
        <?php //if ($wp) : ?> 
            <button type="submit" class="green">Login</button>  
        <?php //endif; ?>
        <?php //if ($rp) : ?> 
            <a class="" href="<?php echo $forget_password_link; ?>">Forget Password</a>
        <?php //endif; ?>
    </form>
<?php //else :?>
<?php //endif; ?>