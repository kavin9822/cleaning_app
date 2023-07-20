<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:150px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
      

        <div class="row">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
            <div class="form-group">
            <label  class="col-sm-3 control-label">Product Code</label>
             <div class="col-sm-9">
                
             <input class="form-control" id="ItemCode" name="ItemCode" value="<?php if(isset($FmData[0]['ItemCode'])){echo $FmData[0]['ItemCode'];}else{echo $po_number;}?>" type="text" readonly>
               
            </div>
            </div>
            
         	<div class="form-group">
            <label class="col-sm-3 control-label">Type of Product </label>
            
            <div class="col-sm-9">
                    
             <select class="form-control" name="Type" id="Type"  required> 
                    <option value="" disabled selected style="display:none;">Select</option>
                    <option <?php  if(isset($FmData[0]['Type']) && $FmData[0]['Type']=='Auto'){echo 'selected="selected"';} ?> value="Auto" title="Auto">Auto</option>
                    <option <?php if(isset($FmData[0]['Type']) && $FmData[0]['Type']=='Non-Auto'){echo 'selected="selected"';} ?> value="Non-Auto" title="Non-Auto">Non-Auto</option>
            </select>
            
             </div>
             
            </div>
            
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Part Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Description" name="Description" value="<?php echo $FmData[0]['Description'];?>" type="text" required>
                    </div>
                </div>
                
            <div class="form-group">
            <label  class="col-sm-3 control-label">Weight</label>
             <div class="col-sm-9">
            
            <input class="form-control" id="weight" name="weight" value="<?php echo $FmData[0]['weight'];?>" type="text" required>
            
            </div>
            </div>
                
            <div class="form-group">
            <label  class="col-sm-3 control-label">Cycle Time</label>
             <div class="col-sm-9">
            <input class="form-control" id="CycleTime" name="CycleTime" value="<?php echo $FmData[0]['CycleTime'];?>" type="text" required>
            </div>
            </div>
         
                </div>
                
                
         <div class="col-md-6"> 
         
             <div class="form-group">
            <label  class="col-sm-3 control-label">Product Type</label>
             <div class="col-sm-9">
            <select class="form-control" name="Producttype_ID" id="Producttype_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($producttype_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['Producttype_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductType']; ?>"><?php echo $v['ProductType']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
         
            <div class="form-group">
            <label  class="col-sm-3 control-label">Part No</label>
             <div class="col-sm-9">
            <input class="form-control" id="ItemName" name="ItemName" value="<?php echo $FmData[0]['ItemName'];?>" type="text" required>
             
            </div>
            </div>
            
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Product Unit</label>
                     <div class="col-sm-9">
                <select class="form-control" name="unit_ID" id="unit_ID" required>
                <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($unitdata as $k => $v): 
                    if ($v['ID'] == $FmData[0]['unit_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
             
           <div class="form-group">
            <label  class="col-sm-3 control-label">Weight Unit</label>
             <div class="col-sm-9">
            <select class="form-control" name="WeightUnit" id="WeightUnit" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($unitdata as $k => $v): 
                    if ($v['ID'] == $FmData[0]['WeightUnit']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
         
            </div>  
            <div class="form-group">
            <label  class="col-sm-3 control-label">Threshold Quantiity</label>
             <div class="col-sm-9">
            <input class="form-control" id="ThresholdQuantity" name="ThresholdQuantity" value="<?php echo $FmData[0]['ThresholdQuantity'];?>" type="text">
             
            </div>
            </div>
             </div>
             </div>
      
         
<!-- /.header part  -->
        <br/>
       
<!--<input type="hidden" value="1"  id="maxCount"  name="maxCount">     -->
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
            
            
            