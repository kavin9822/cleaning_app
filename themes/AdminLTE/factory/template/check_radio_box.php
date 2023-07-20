<div class="form-group">
    <label for="<?php if(!empty($label)){echo $label;} ?>" class="col-sm-6 control-label"><?php if(!empty($label)){echo $label;} ?></label>
    <div class="col-sm-6">
        <input id="<?php if(!empty($name)){echo $name;} ?>" name="<?php if(!empty($name)){echo $name;} ?>" value="" <?php if(!empty($status)){echo $status;}?> type="<?php if(!empty($type)){echo $type;} ?>">
    </div>
</div>

