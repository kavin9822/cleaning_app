<input class="form-control" 
       id="<?php echo $name; ?>" 
       name="<?php echo $name; ?>" 
       value="<?php if(isset($_SESSION['text'][$tableName_wo_prefix][$name])){echo $_SESSION['text'][$tableName_wo_prefix][$name];}else{echo $value;} ?>" 
       placeholder="<?php echo $label; ?>" 
       type="text" 
       onchange="ManageQueryFilter('<?php echo $tableName_wo_prefix; ?>','<?php echo $home; ?>','<?php echo $name; ?>','text')">
       