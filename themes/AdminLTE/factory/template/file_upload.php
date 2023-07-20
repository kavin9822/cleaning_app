<div class="form-group">
    <label for="<?php echo $name; ?>" class="col-sm-2 control-label"><?php echo $label; ?></label>
    <div class="col-sm-10">
        <?php if($value):?>
        <img class="img-thumbnail" src="<?php echo $home.'/'.$value; ?>" alt="Upload the file here" width="200px">
        <br><br>
        <?php endif; ?>
        <input class="btn btn-default" id="<?php echo $name; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $label; ?>" type="<?php echo $type; ?>">
    </div>
</div>