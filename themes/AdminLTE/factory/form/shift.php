<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo;?>" class="img" alt="Invoice Logo" style="width:150px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>

        <div class="row">
           
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                    <div class="col-md-6">
                   <div class="form-group">
                        <label  class="col-sm-3 control-label">Date</label>
                     <div class="col-sm-9">
                    <select class="form-control js-example-basic-single" name="pipedate" id="pipedate" onmouseover="ycssel()" onchange="ppdate('pipedate','shift_ID');" required>
                    <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach($pp_data as $data): 
                           
                            ?>
                    <option value="<?php echo $data['PPDate'];?>" title="<?php echo $data['PPDate'];?>"><?php echo $data['PPDate'];?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                  </div>
                  </div>
                 <div class="col-md-6">
                <div class="form-group">
                <label  class="col-sm-3 control-label">Shift</label>
                <div class="col-sm-9">
                <select class="form-control" name="shift_ID" id="shift_ID"  onchange="ppdate('pipedate','shift_ID');">
                <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach($shift_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['ShiftName']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
                <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['ShiftName'];?>"><?php echo $v['ShiftName'];?></option>
                <?php endforeach; ?>
                </select>
                </div>
                </div>
                </div>
                </div>
       
       
         <h5><u>OEE (Overall Equipment Effectiveness)</u></h5>
        
        <div class="box-body">
            <div id="showData">
                
                
            </div>
        </div>
        
         
     
<input type="hidden" value="" id="maxCount" name="maxCount">
<br/>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <!--<?php if($mode != 'view' ){ ?>-->
                <!--<a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>-->
                <!--<?php } ?>-->
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } ?>
                
            </div>
        </div>
        <!--<?php if($mode == 'view'){ ?>-->
        <!--   </fieldset>-->
        <!--   <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>-->
        <!--<?php } ?>-->
        

    </form>

</section>
            
            
            