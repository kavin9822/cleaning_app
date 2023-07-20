<form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">
<div class="form-group form-inline">
    <label for="date_from">Filter</label>
    <input class="form-control" 
       id="date_from" 
       class="datepicker"
       name="date_from" 
       value="" 
       placeholder="DD-MM-YYYY"
       type="date">   
       
<input class="form-control" 
       id="date_to" 
       class="datepicker"
       name="date_to" 
       value="" 
       placeholder="DD-MM-YYYY" 
       type="date">
   <!--
onchange="ManageDateQueryFilter('<?php echo $tableName_wo_prefix; ?>','<?php echo $home; ?>','<?php echo $Date_Filter_columName; ?>','date')"> -->    

</div>
</form>
