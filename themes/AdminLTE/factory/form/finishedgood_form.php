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
            <label  class="col-sm-3 control-label">Batch No</label>
             <div class="col-sm-9">
            <?php if($mode==view) { ?> 
            
             <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" disabled  onmouseover="ycssel()" >
                 
            <?php } else { ?>
            
             <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" required onchange="wrkorderChg(this.value);"  onmouseover="ycssel()" >
            
            <?php } ?>
           
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($wo_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['workorder_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['BatchNo']; ?>"><?php echo $v['BatchNo']; ?></option>
            <?php endforeach; ?>
            </select>  
            </div>
            </div>
            
         	<div class="form-group">
            <label class="col-sm-3 control-label">Package Type </label>
            
            <div class="col-sm-9">
                    
             <select class="form-control" name="PackageType" id="PackageType" > 
                    <option value="" disabled selected style="display:none;">Select</option>
                    <option <?php  if(isset($FmData[0]['PackageType']) && $FmData[0]['PackageType']=='box'){echo 'selected="selected"';} ?> value="box" title="Box">Box</option>
                    <option <?php if(isset($FmData[0]['PackageType']) && $FmData[0]['PackageType']=='bag'){echo 'selected="selected"';} ?> value="bag" title="Bag">Bag</option>
            </select>
            
             </div>
             
            </div>
            
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                    <input class="form-control datepicker" id="FGDate" name="FGDate" value="<?php if (isset($FmData[0]['FGDate'])){echo date('d-m-Y',strtotime($FmData[0]['FGDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY"  type="text" required >
                   <!--<input class="form-control" id="FGDate" name="FGDate" value="<?php if (isset($FmData[0]['FGDate'])){echo date('d-m-Y',strtotime($FmData[0]['FGDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" required >-->
                   
                    </div>
                </div>
                
            <div class="form-group">
            <label  class="col-sm-3 control-label">No of Box</label>
             <div class="col-sm-9">
            
            <input class="form-control" id="NoofBox" name="NoofBox" value="<?php echo $FmData[0]['NoofBox'];?>" type="text" >
            
            </div>
            </div>
                
            <div class="form-group">
            <label  class="col-sm-3 control-label">Quantity</label>
             <div class="col-sm-9">
            <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" readonly>
            </div>
            </div>
         
                </div>
                
                
         <div class="col-md-6"> 
         
             <div class="form-group">
            <label  class="col-sm-3 control-label">Shift</label>
             <div class="col-sm-9">
            <select class="form-control" name="shift_ID" id="shift_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($shiftdata as $k => $v): 
                    if ($v['ID'] == $FmData[0]['shift_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ShiftName']; ?>"><?php echo $v['ShiftName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
         
            <div class="form-group">
            <label  class="col-sm-3 control-label">Box No</label>
             <div class="col-sm-9">
            <input class="form-control" id="BoxNo" name="BoxNo" value="<?php echo $FmData[0]['BoxNo'];?>" type="text" >
             
            </div>
            </div>
            
            
            <div class="form-group">
            <label  class="col-sm-3 control-label">Remark</label>
             <div class="col-sm-9">
            <input class="form-control" id="Remark" name="Remark" value="<?php echo $FmData[0]['Remark'];?>" type="text">
             
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
            
            
            