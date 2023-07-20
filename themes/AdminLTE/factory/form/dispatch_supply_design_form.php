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
                       <input class="form-control" id="Dispatchno" name="Dispatchno" value="<?php if(isset($FmData[0]['Dispatchno'])){echo $FmData[0]['Dispatchno'];}else{echo $Dispatchno;}?>" type="text" readonly>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['CustomerID'])) { ?>
                              <input id="CustomerID" name="CustomerID" value="<?php if($FmData[0]['CustomerID']){echo $FmData[0]['CustomerID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="CustomerID" id="CustomerID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="CustomerID" id="CustomerID" onchange="dispatchsupply_address_Data(this.value,'customer','BillingAddress1','CustomerAddress');add_enable(this.value,'ProductionID')" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($customer_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['CustomerID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PersonName']; ?>"><?php echo $v['PersonName']; ?></option>
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
					          <select class="form-control" name="ProductionID" id="ProductionID" onchange="Fetch_dispatchsupply_child_Data(this.value,'ProductName','Quantity','product_ID')" disabled required>
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
				    
				</div> 
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="Date" name="Date" value="<?php echo $FmData[0]['Date'];?>" type="text" readonly>  
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Address</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="CustomerAddress" name="CustomerAddress" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" readonly> 
			          </div>
		          </div>
			    </div>
		     </div>
		
             <div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail2" >
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Pending Quantity</th>
                            <th>Available fgStock</th>
                            <th>Issued Quantity</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table">  
					        <?php 
                                $count =0;
                                foreach ($FmData as $dataValue):
                            ?>
  				  <tr id="Invoice_data_entry_<?php echo $tii; ?>">
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="ProductName_<?php echo $tii; ?>" name="ProductName_<?php echo $tii; ?>"  value="<?php echo $dataValue['ProductName'];?>" readonly>
                            <input class="form-control" type="hidden" id="product_ID<?php echo $tii; ?>" name="product_ID<?php echo $tii; ?>" value="<?php if($dataValue['product_ID']){ echo $dataValue['product_ID']; } ?>"   readonly style="width:230px">
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php echo $dataValue['Quantity'];?>" readonly>
                          </div>
         	            </div>
         	             </td>
         	              <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="pending_qty" name="pending_qty" value="<?php echo $ScheduleDat[$count]['pending_qty'];?>" readonly>
                          </div>
         	            </div>
                     </td>
         	             <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="availablestock_<?php echo $tii; ?>" name="availablestock_<?php echo $tii; ?>" value="<?php echo $ScheduleDat[$count]['Available_stock'];?>" readonly>
                          </div>
         	            </div>
         	             </td>
         	             <td>   
         	             <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="Field2_" name="Field2_[]" value="<?php echo $ScheduleDat[$count]['Field2'];?>" >
                          </div>
         	            </div>
                     </td>
                     
                  </tr>
				   <?php 
                                //this + 5 increment is to manage new entry by javascript on edition mode
                                // so on edit with existing entry one can add additional 4 entries can do 
                                //or del and add many as possible
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
					       <input class="form-control" id="DriverName" name="DriverName" value="<?php echo $FmData[0]['DriverName'];?>" type="text" onkeyup="validateInput(this)">  
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
					       <input class="form-control" id="TransporterName" name="TransporterName" value="<?php echo $FmData[0]['TransporterName'];?>" type="text" onkeyup="validateInput(this)">  
			          </div>
                   </div>
                    </div>
		        </div>

              <!--<input type="hidden" value="1" id="maxCount" name="maxCount">	-->
            			    
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
            