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
			                <input class="form-control" id="PropertyName" name="PropertyName" value="<?php echo $FmData[0]['PropertyName'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="1" required>
			          </div>
		          </div>
		            <div class="form-group">
                       <label  class="col-sm-3 control-label">AccountID</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Account_ID" name="Account_ID" value="<?php echo $FmData[0]['Account_ID'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="3" required>
			          </div>
		          </div>
				   <div class="form-group">
                       <label  class="col-sm-3 control-label">Structure type</label>
			           <div class="col-sm-9">
					      <select class="form-control js-example-basic-single" name="StructureType" id="StructureType" tabindex="5" onmouseover="ycssel()" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['StructureType']) && $FmData[0]['StructureType']=='Individual Property'){echo 'selected="selected"';} ?> value="Individual Property" title="Individual Property">Individual Property</option>
                            <option <?php if(isset($FmData[0]['StructureType']) && $FmData[0]['StructureType']=='Property with individual rooms'){echo 'selected="selected"';} ?> value="Property with individual rooms" title="Property with individual rooms">Property with individual rooms</option>
                        </select>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Living Area</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="LivingArea" name="LivingArea" value="<?php echo $FmData[0]['LivingArea'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="7" required>
			           </div>
		          </div>
				 
				  <div class="form-group">
                       <label  class="col-sm-5 control-label" style="font-size:20px">Property Location</label>
			           <div class="col-sm-7">
			           </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Address Line1</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo $FmData[0]['AddressLine1'];?>" type="text" tabindex="9" required>
			           </div>
		          </div>
				 
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">City</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="City" name="City" value="<?php echo $FmData[0]['City'];?>" type="text" onkeyup="validateInput(this)" tabindex="11" required>
			           </div>
		          </div>
				 
				  <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Pincode" name="Pincode" value="<?php echo $FmData[0]['Pincode'];?>" type="text"  onkeypress="return onlynumbers(event);" maxlength="6" tabindex="13" required>
                    </div>
                </div>
				
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Description</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Description" name="Description" value="<?php echo $FmData[0]['Description'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="2" required>
			           </div>
		          </div>
		          <div class="form-group">
                       <label  class="col-sm-3 control-label">Tag</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Tag" name="Tag" value="<?php echo $FmData[0]['Tag'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="4" required>  
			           </div>
		          </div>
		          <div class="form-group">
                       <label  class="col-sm-3 control-label">No Of Floors</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="NoOfFloor" name="NoOfFloor" value="<?php echo $FmData[0]['NoOfFloor'];?>" type="text" tabindex="6" required>
			           </div>
		          </div>
		           <div class="form-group">
                       <label  class="col-sm-3 control-label">Year Built</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="BuiltYear" name="BuiltYear" value="<?php echo $FmData[0]['BuiltYear'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="8" required>
			           </div>
		          </div>
		           <div class="form-group" style="margin-top:60px">
                       <label  class="col-sm-3 control-label">Address Line2</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo $FmData[0]['AddressLine2'];?>" type="text" tabindex="10" required>
			           </div>
		          </div>
		           <div class="form-group">
                       <label  class="col-sm-3 control-label">State</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="StateID" id="StateID" tabindex="12" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($state_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['StateID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['StateName']; ?>"><?php echo $v['StateName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
		          <div class="form-group">
                    <label  class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="CountryID" id="CountryID" tabindex="14" onmouseover="ycssel()" required >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($country_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['CountryID']) {
                                        $isselected = 'selected="selected"';
                                    }else if ($v['ID'] == '1') {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['CountryName']; ?>"><?php echo $v['CountryName']; ?></option>
                            <?php endforeach; ?>
                            </select>
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
            