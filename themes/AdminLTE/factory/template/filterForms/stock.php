<form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">

<div class="row">
    
     <?php  if(isset($rawmaterial_data)){ ?>
      <div class="col-6 col-md-4">
      <label for="rawmaterial_ID">Rawmaterial</label>
      <select class="form-control" name="rawmaterial_ID" id="rawmaterial_ID">
                    <option value="" disabled selected style="display:none;">Select</option>
                      <option value="All" title="Select All">Select All</option>
                    <?php foreach($rawmaterial_data as $k => $v):
                   
                    ?>
                     <option value="<?php echo $v['ID'];?>" title="<?php echo $v['RMName'];?>"><?php echo $v['RMName'];?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                   <?php } else {?> 
                    <div class="col-6 col-md-4">
                    <label for="product_ID">Part name</label>
                    <select class="form-control" name="product_ID" id="product_ID">
                    <option value="" disabled selected style="display:none;">Select</option>
                    <option value="All" title="Select All">Select All</option>
                    <?php foreach($product_data as $k => $v):
                   
                    ?>
                     <option value="<?php echo $v['ID'];?>" title="<?php echo $v['ItemName'];?>"><?php echo $v['ItemName'];?></option>
                    <?php endforeach; ?>
                    </select>
                   </div>
                   <?php } ?> 
                    
  <div class="col-6 col-md-4">
      <label for="date_from">Start Date</label>
     <input class="form-control bg-aqua datepicker" id="date_from" readonly=""  name="date_from" value=""  placeholder="DD-MM-YYYY"  type="text"  >
      
      
       </div>
  <div class="col-6 col-md-4">
      <label for="date_from">End Date</label>
   <input class="form-control bg-aqua datepicker"   id="date_to"  readonly="" name="date_to" value=""  placeholder="DD-MM-YYYY" type="text"  >
  </div>
</div>

</form>