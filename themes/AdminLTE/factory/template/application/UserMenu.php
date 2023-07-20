
<?php foreach ($UserMenu as $ModuleName => $ModuleMenuArr) : ?>

    <?php if(count($ModuleMenuArr)==2){ ?>
    <?php foreach ($ModuleMenuArr as $SubMenuKey => $SubMenuValue) : 
        if($SubMenuKey !== 'css'):
        ?>
        <li>
          <a href="<?php echo $home.'/'.$SubMenuKey; ?>">
            <i class="fa <?php echo $ModuleMenuArr['css']; ?>"></i> <span><?php echo $ModuleName; ?>
            <!--<span class="pull-right-container">              -->
            <!--  <small class="label pull-right bg-red" id="mailcount1"></small>-->
            <!--</span>-->
            </span>
          </a>
        </li>
        <?php 
        endif;
        endforeach; ?>
    <?php }else{  ?>
    <li class="treeview">
    <a href="#"><i class="fa <?php echo $ModuleMenuArr['css']; ?>"></i><span><?php echo $ModuleName; ?></span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <?php foreach ($ModuleMenuArr as $SubMenuKey => $SubMenuValue) : 
        if($SubMenuKey !== 'css'):
        ?>
            <li><a href="<?php echo $home.'/'.$SubMenuKey; ?>"><?php echo $SubMenuValue; ?></a></li>
        <?php 
        endif;
        endforeach; ?>
    </ul>
    </li>
    <?php } ?>
<?php endforeach; ?>
