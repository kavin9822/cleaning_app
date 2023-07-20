<?php if(!empty($label && $name && $value )) {?>
<div class="form-group">
    <label for="<?php echo $name; ?>" class="col-sm-3 label-default"><?php echo $label; ?></label>
    <div class="col-sm-9">
        <p id="<?php echo $name; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></p>
    </div>
</div>

<?php } ?>
