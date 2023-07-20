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
                       <label  class="col-sm-3 control-label">Dispatch No</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['DispatchID'])) { ?>
                              <input id="DispatchID" name="DispatchID" value="<?php if($FmData[0]['DispatchID']){echo $FmData[0]['DispatchID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="DispatchID" id="DispatchID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="DispatchID" id="DispatchID" onchange="subcontract_address_Data(this.value,'workorder','PdnOrderID','EmployeeID','ProductionID','SubcontractorID');add_enable(this.value,'SubcontractorID');Fetch_subcontractor_materialinward1_Data(this.value,'RawMaterialType','Quantity1','itemtype_id_','pending_qty');Fetch_subcontractor_materialinward_Data(this.value,'dispatchreturnable_detail','dispatchreturnable','Rawmaterial_ID','Quantity','product_ID','RawmaterialName','Quantity','ProductName');"  required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($dispatch_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['DispatchID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Dispatchno']; ?>"><?php echo $v['Dispatchno']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Vendor Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['SubcontractorID'])) { ?>
                              <input id="SubcontractorID" name="SubcontractorID" value="<?php if($FmData[0]['SubcontractorID']){echo $FmData[0]['SubcontractorID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="SubcontractorID" id="SubcontractorID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="SubcontractorID" id="SubcontractorID" onchange="subcontract_matinward_Data(this.value,'supplier','AddressLine1','VendorAddress');add_enable(this.value,'ProductionID')" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($sub_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['SubcontractorID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['SupplierName']; ?>"><?php echo $v['SupplierName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Production Order No</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['ProductionID'])) { ?>
                              <input id="ProductionID" name="ProductionID" value="<?php if($FmData[0]['ProductionID']){echo $FmData[0]['ProductionID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="ProductionID" id="ProductionID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="ProductionID" id="ProductionID" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($production_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['ProductionID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PdnOrderNo']; ?>"><?php echo $v['PdnOrderNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Product Name</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="ProductName" name="ProductName" value="<?php echo $FmData[0]['ProductName'];?>" type="text" readonly>  
			          </div>
		          </div>
				    
				</div> 
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="Date" name="Date" value="<?php echo $FmData[0]['Date'];?>" type="text" readonly>  
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Vendor Address</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="VendorAddress" name="VendorAddress" value="<?php echo $FmData[0]['AddressLine1'];?>" type="text" readonly> 
			          </div>
		          </div>
			    </div>
		     </div>
             <div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail" >
                    <thead>
                        <tr>
                            <th>Rawmaterial Name</th>
                            <th>Quantity</th>
                            </tr>
                    </thead>
                    <tbody>  
					        <?php 
                                foreach ($ScheduleData1 as $value ):
                            ?>
  					<tr  id ="tender_row">
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="RawmaterialName" name="RawmaterialName"  value="<?php echo $value['RMName'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity" name="Quantity" value="<?php echo $value['Quantity'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                  </tr>
				  <?php
				  endforeach;
				  ?>
                </tbody>
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail2" >
                    <thead>
                        <tr>
                            <th>Semi finished Rawmaterial Name</th>
                            <th>Expected Quantity</th>
                            <th>Pending Quantity</th>
                            <th>Delivered Quantity</th>
                            </tr>
                    </thead>
                    <tbody>  
					        <?php 
                            $count =0;
                                foreach ($ScheduleData as $value ):
                            ?>
  					<tr  id ="tender_row">
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="RawMaterial" name="RawMaterial"  value="<?php echo $value['RMName'];?>" readonly>
                          <input class="form-control" type="hidden" id="item_id_<?php echo $tii; ?>" name="item_id_<?php echo $tii; ?>" value="<?php if($dataValue['item_id']){ echo $dataValue['item_id']; } ?>"   readonly style="width:230px">
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity1" name="Quantity1" value="<?php if(isset($value['Quantity1'])){ echo $value['Quantity1']; }?>" readonly>
                          </div>
         	            </div>
                     </td>
                      <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="pending_qty" name="pending_qty" value="<?php if(isset($ScheduleDat[$count]['pending_qty'])){ echo $ScheduleDat[$count]['pending_qty']; }?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Field2_" name="Field2_[]" value="<?php if(isset($ScheduleDat[$count]['Field2'])){ echo  $ScheduleDat[$count]['Field2']; }?>" >
                          </div>
         	            </div>
                     </td>
                  </tr>
				  <?php
                   $count++;
				  endforeach;
				  ?>
                </tbody>
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
        <input type="hidden" value="<?php echo $count; ?>" id="maxCount" name="maxCount">
		
				<div class="row" style="margin:20px">
				<div class="col-lg-6">
		        <div class="form-group">
                       <label  class="col-sm-3 control-label">Vehicle No</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Vehicleno" name="Vehicleno" value="<?php echo $FmData[0]['Vehicleno'];?>" type="text">  
			           </div>
		             </div>
			    <div class="form-group">
                       <label  class="col-sm-3 control-label">Driver Mobile Number</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="DriverMobileNumber" name="DriverMobileNumber" value="<?php echo $FmData[0]['DriverMobileNumber'];?>" type="text" onkeyup="validateField(this.id,'number');" maxlength="10">  
			           </div>
		             </div>
                     <div class="form-group">
                       <label  class="col-sm-3 control-label">Mode of Transport</label>
			           <div class="col-sm-9">
					      <select class="form-control" name="TransportMode" id="TransportMode" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['TransportMode']) && $FmData[0]['TransportMode']=='Transport'){echo 'selected="selected"';} ?> value="Transport" title="Transport">Transport</option>
                            <option <?php if(isset($FmData[0]['TransportMode']) && $FmData[0]['TransportMode']=='Non Transport'){echo 'selected="selected"';} ?> value="Non Transport" title="Non Transport">Sub contractor </option>
                        </select>
			          </div>
		          </div>
				 <div class="form-group">
                       <label  class="col-sm-3 control-label">LR Number</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="LRNumber" name="LRNumber" value="<?php echo $FmData[0]['LRNumber'];?>" type="text">  
			           </div>
		             </div>
                
				   </div>
                   <div class="col-lg-6">
                   <div class="form-group">
                       <label  class="col-sm-3 control-label">Driver Name</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="DriverName" name="DriverName" value="<?php echo $FmData[0]['DriverName'];?>" type="text">  
			          </div>
                   </div>
                   <div class="form-group">
                       <label  class="col-sm-3 control-label">Dispatch From</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="DispatchFrom" name="DispatchFrom" value="<?php echo $FmData[0]['DispatchFrom'];?>" type="text">  
			          </div>
                   </div>
                   <div class="form-group">
                       <label  class="col-sm-3 control-label">Name of the Transporter</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="TransporterName" name="TransporterName" value="<?php echo $FmData[0]['DispatchFrom'];?>" type="text">  
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
                <button type ="submit" class="btn btn-success pull-right" onmouseover="getRowCount()" name="edit_submit_button" value="edit"> Submit </button>
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
            