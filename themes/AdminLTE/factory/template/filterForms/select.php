<select class="form-control" name="<?php echo $name; ?>" id="<?php echo $name; ?>" onchange="ManageQueryFilter('<?php echo $tableName_wo_prefix; ?>','<?php echo $home; ?>','<?php echo $name; ?>','select')">

        <?php 
        foreach ($options as $cst_key => $cst_value): ?>
            <?php 
            if(isset($_SESSION['select'][$tableName_wo_prefix][$name])){
                $cst_key_set = $_SESSION['select'][$tableName_wo_prefix][$name];
            }else{
                $cst_key_set = '';
            }
            
            if ($cst_key == $cst_key_set) {
                $selected = 'SELECTED';
            } else {
                $selected = '';
            } ?>
            <option <?php echo $selected; ?> value="<?php echo $cst_key; ?>"><?php echo $cst_value; ?></option>
<?php endforeach; ?>
</select>