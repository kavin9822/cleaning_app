<div class="form-group">
    <label for="<?php echo $name; ?>" class="col-sm-2 control-label"><?php echo $label; ?></label>
    <div class="col-sm-10">
        <select class="form-control" name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php echo $status; ?>>
        <?php if($default=='na'){
        
        } else {?>
        <option value="" disabled selected style="display:none;">Select</option>
     <?php   }

     foreach ($options as $opt_key => $opt_value): ?>
            <?php 
            if ($opt_key == $selected || $opt_key == $value) {
                $isselected = 'selected';
            }else{
                $isselected = '';
            } ?>
                <option <?php echo $isselected; ?> value="<?php echo $opt_key; ?>" title="<?php echo $opt_value; ?>"><?php echo $opt_value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


