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
                       <label  class="col-sm-3 control-label">QC No</label>
			           <div class="col-sm-9">
                            <input class="form-control" id="Qcno" name="Qcno" value="<?php if(isset($FmData[0]['Qcno'])){echo $FmData[0]['Qcno'];}else{echo $Qcno;}?>" type="text" readonly>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Work Order Date</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="WorkOrderDate" name="WorkOrderDate" value="<?php echo $FmData[0]['CompletedDate'];?>" type="text" readonly>
			           </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Product Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['product_ID'])) { ?>
                              <input id="product_ID" name="product_ID" value="<?php if($FmData[0]['product_ID']){echo $FmData[0]['product_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="product_ID" id="product_ID" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($product_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['product_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                              <?php endforeach; ?>
                              </select> 
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Quantity</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" onkeypress="return onlynumbers(event);" required>
			                <input class="form-control" type="hidden" id="acceptedqty_" name="acceptedqty_" value="<?php echo $FmData[0]['Quantity'];?>"   readonly style="width:230px">
			           </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">QC Verified</label>
			           <div class="col-sm-9">
					      <select class="form-control" name="Qcverified" id="Qcverified" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Qcverified']) && $FmData[0]['Qcverified']=='Accepted'){echo 'selected="selected"';} ?> value="Accepted" title="Accepted">Accepted</option>
                            <option <?php if(isset($FmData[0]['Qcverified']) && $FmData[0]['Qcverified']=='Rework'){echo 'selected="selected"';} ?> value="Rework" title="Rework">Rework </option>
                            <option <?php if(isset($FmData[0]['Qcverified']) && $FmData[0]['Qcverified']=='Rejected'){echo 'selected="selected"';} ?> value="Rejected" title="Rejected">Rejected </option>
                        </select>
			          </div>
		          </div>
			
			   </div>
			   <div class="col-lg-6">
               <div class="form-group">
                       <label  class="col-sm-3 control-label">Workorder No</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['WorkorderID'])) { ?>
                              <input id="WorkorderID" name="WorkorderID" value="<?php if($FmData[0]['WorkorderID']){echo $FmData[0]['WorkorderID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="WorkorderID" id="WorkorderID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="WorkorderID" id="WorkorderID" onchange="qualitycontrol_Data(this.value,'WorkOrderDate','EmployeeContractorName')" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($workorder_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['WorkorderID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['WorkOrderNo']; ?>"><?php echo $v['WorkOrderNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
				      </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Employee/Subcontractor Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="EmployeeContractorName" name="EmployeeContractorName" value="<?php if($FmData[0]['EmpName']){echo $FmData[0]['EmpName'];}else{echo $FmData[0]['SupplierName'];}?>" type="text" readonly> 
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Product No</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="ProductNo" name="ProductNo" value="<?php echo $FmData[0]['ProductNo'];?>" type="text">
			          </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">File Upload</label>
			           <div class="col-sm-9">
					   <?php if($mode=='add'){?>
						   <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()" required>
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['FileUpload']; ?>" width="100px";>-->
						   <?php }else{?>
						   <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()">
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['FileUpload']; ?>" width="100px";>-->
						    <?php }?>
					      </div>
		               </div>
					    <?php if($mode=='edit' && !empty($FmData[0]['FileUpload'])){ ?>
                        <div class="form-group">
                          <label  class="col-sm-3 control-label"></label>
                           <div class="col-sm-9">
                          <a target="_blank" title="To view click here" href="<?php echo $home.'/'.$FmData[0]['FileUpload'];?>"><?php echo ltrim($FmData[0]['FileUpload'],'resource/images/.');?></a>
                           </div>
                       </div>
                        <?php }elseif($mode=='view' && !empty($FmData[0]['FileUpload'])){ ?>
                        <div class="form-group">
                           <label  class="col-sm-3 control-label"></label>
                           <div class="col-sm-9">
                          <a target="_blank" href="<?php echo $home.'/'.$FmData[0]['FileUpload'];?>"><?php echo ltrim($FmData[0]['FileUpload'],'resource/images/.');?></a>
                           </div>
                       </div>
                       <?php }?>
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
    <style>
     input[type="file"]{
         color: transparent;
      }
  </style>
  
</section>         
            