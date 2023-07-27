<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data"   id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

    <?php  

    if($mode == 'edit' or $mode == 'view')
    { ?>

   
<?php
    }

    ?>
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
		<div class="row" style="margin:20px">
			<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="col-lg-6">
                <div class="form-group">
                       <label  class="col-sm-3 control-label">Property Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Property_ID" id="Property_ID" tabindex="1" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($property_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Property_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PropertyName']; ?>"><?php echo $v['PropertyName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
                 
              <div class="form-group">
                       <label  class="col-sm-3 control-label">Room No</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="RoomNo" name="RoomNo" value="<?php echo $FmData[0]['RoomNo'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="3" required>
			           </div>
		          </div>
             
              <div class="form-group">
                       <label  class="col-sm-3 control-label">Living Area</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="LivingArea" name="LivingArea" value="<?php echo $FmData[0]['LivingArea'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="5" required>
			           </div>
		          </div>
                    
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Floor</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Floor_ID" id="Floor_ID" tabindex="2" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($property_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Floor_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['NoOfFloor']; ?>"><?php echo $v['NoOfFloor']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
		           <div class="form-group">
                       <label  class="col-sm-3 control-label">Tag Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Tags" name="Tags" value="<?php echo $FmData[0]['Tags'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="4" required>
			           </div>
		          </div>
			        
				 </div>
		       </div>
					 
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit"> Submit </button>
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
            