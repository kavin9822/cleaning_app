<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?php if(!empty($form_title)){echo $form_title;} ?></h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="crud_form" action="<?php echo $home.'/'.$module.'/'.$controller.'/'.$method;?>/submit/<?php echo $crud_form_submit_from; ?>" method="post" <?php if(!empty($Form_Need_to_upload_file)) {echo 'enctype="multipart/form-data"';}?>>
        <div class="box-body">
        <?php echo $form_content_master_col_one; ?>    
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $form_footer; ?>    
        </div><!-- /.box-footer -->
    </form>
<style>
    .box-body{
        margin:20px;
    }
</style>
</div>