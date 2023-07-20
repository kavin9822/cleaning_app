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
                       <label  class="col-sm-3 control-label">Sub Contractor Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['SubcontractorID'])) { ?>
                              <input id="SubcontractorID" name="SubcontractorID" value="<?php if($FmData[0]['SubcontractorID']){echo $FmData[0]['SubcontractorID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="SubcontractorID" id="SubcontractorID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="SubcontractorID" id="SubcontractorID" onchange="dispatchreturnable_address_Data(this.value,'workorder','supplier','PdnOrderID','AddressLine1','ProductionID','SubContractorAddress');add_enable(this.value,'ProductionID')" required>
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
					          <select class="form-control" name="ProductionID" id="ProductionID" onchange="workorder_product_Data(this.value,'customerorder_detail','Product_ID','product_ID');add_enable(this.value,'product_ID')"  disabled required>
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
                       <?php if(isset($FmData[0]['product_ID'])) { ?>
                              <input id="product_ID" name="product_ID" value="<?php if($FmData[0]['product_ID']){echo $FmData[0]['product_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="product_ID" id="product_ID" onchange="workorder_process_Data(this.value,'BOMProcessDetail','process_ID','ProcessID')" disabled>
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
				    
				</div> 
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="Date" name="Date" value="<?php echo $FmData[0]['Date'];?>" type="text" readonly>  
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Sub Contractor Address</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="SubContractorAddress" name="SubContractorAddress" value="<?php echo $FmData[0]['AddressLine1'];?>" type="text" readonly> 
			          </div>
		          </div>
			    </div>
		     </div>
				<div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:80px;margin-right:80px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Raw Material Name</th>
                            <th>Available Stock</th>
							<th>Quantity</th>
                            <th>Price/Unit</th>
                            <th>Value</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table">
                            <?php 
                                if(is_array($FmData) && count($FmData) >= 1):
                                $tii = 1;
                                foreach ($FmData as $dataValue):
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                               
                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove()";?>>
                                        </div>
                                    </div>
                                </td>
								<td>                                      
                                     <div class="form-group">
                                         <select class="form-control" name="Rawstock_<?php echo $tii; ?>" id="Rawstock_<?php echo $tii; ?>" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($rawmaterial_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['Rawmaterial_ID']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                    </div>
                                </td>
                                	<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Field4_<?php echo $tii; ?>" name="Field4_<?php echo $tii; ?>"
									    value="<?php if(isset($dataValue['Available_stock'])){ echo $dataValue['Available_stock']; } ?>" readonly>
                                        </div>
                                    </div>
                                </td>
								<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Field3_<?php echo $tii; ?>" name="Field3_<?php echo $tii; ?>"
									    value="<?php if(isset($dataValue['Quantity'])){ echo $dataValue['Quantity']; } ?>" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_<?php echo $tii; ?>').val(($('#Field3_<?php echo $tii; ?>').val() * $('#price_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro()" required>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="price_unit_<?php echo $tii; ?>" name="price_unit_<?php echo $tii; ?>" value="<?php if($dataValue['price_unit']){ echo $dataValue['price_unit']; } ?>" placeholder="Enter price_unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_<?php echo $tii; ?>').val(($('#Field3_<?php echo $tii; ?>').val() * $('#price_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro()" tabindex="5" style="width:120px" required>			
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Value_<?php echo $tii; ?>" name="Value_<?php echo $tii; ?>" value="<?php if($dataValue['Value']){ echo $dataValue['Value']; } ?>" placeholder="Enter Value" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <?php 
                                //this + 5 increment is to manage new entry by javascript on edition mode
                                // so on edit with existing entry one can add additional 4 entries can do 
                                //or del and add many as possible
                                $tii = $tii+1;
                                    endforeach;
                                else: 
                                ?>
                                        
                            <tr id="Invoice_data_entry_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <select class="form-control" name="Rawstock_1" id="Rawstock_1"onchange="Rawmaterial_Agianst_stock(this.value,this.id,'Field4_');validateExist(this.id,'invoice_listing_table');" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($rawmaterial_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php endforeach; ?>
                                      </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Field4_1" name="Field4_1" value="" readonly>
                                    </div>
         	                    </div>
                            </td>
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Field3_1" name="Field3_1" value="" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" onkeyup="dispatch_returnable_accepted_value(this.id);$('#Value_1').val(($('#Field3_1').val() * $('#price_unit_1').val()).toFixed(2));total_pro()" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="price_unit_1" name="price_unit_1" value="" placeholder="Enter price_unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_1').val(($('#Field3_1').val() * $('#price_unit_1').val()).toFixed(2));total_pro()" tabindex="9" style="width:120px" required>	
									 
								<!--	 <input class="form-control" id="price_unit_1" name="price_unit_1" value="" placeholder="price_unit_1" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required> 	-->

                                    </div>
         	                   </div>
                            </td> 
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Value_1" name="Value_1" value="" placeholder="Enter Amount" onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" readonly>
                                    </div>
         	                   </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="container">
	
<div class="row">
		<div class="col-sm-6" style="margin-top:100px;">	
			<div class="form-group">
			<div class="col-sm-6">
			</div>
                     <div class="col-sm-6">
						<div class="col-sm-6">
                        <label class="radio-inline"><input type="radio" name="optradio" id="cgst" value="CGST and SGST" <?php echo ($FmData[0]['CGST_&_SGST_&_IGST'] == 'CGST & SGST'  ? 'checked' : '');?> checked="checked" ><strong>CGST & SGST</strong></label>
						</div>
						<div class="col-md-6">
                        <label class="radio-inline"><input type="radio" name="optradio" id="igst" value="IGST" onclick="cal()" <?php echo ($FmData[0]['CGST_&_SGST_&_IGST'] == 'IGST'  ? 'checked' : '');?> required><strong>IGST</strong></label>
						</div>
                    </div>
                </div>

		</div>
		
		<!-- sgst and advance -->
		
		
		<div class="col-sm-6">	
				
				<div class="form-group">
				<label class="col-sm-4 control-label">Total </label>
				<div class="col-sm-8">
					<input class="form-control" id="gTotal" name="Total" value="<?php echo $FmData[0]['Total'];?>" type="text" readonly>
			</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">GST % </label>
				<div class="col-sm-8">
					<input class="form-control" id="GST" name="GST" value="<?php echo $FmData[0]['GST'];?>" type="text" onkeyup="myFunction();" onkeypress="return onlynumbers(event);" tabindex="10">
			</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">CGST </label>
				<div class="col-sm-3">
					<input class="form-control" id="CGST" name="CGST" value="<?php echo $FmData[0]['CGST'];?>" type="text" style="border-style:none;" tabindex="11" readonly>
				</div>
				<div class="col-sm-5">
					<input class="form-control" id="CGSTtotal" name="CGSTtotal" value="<?php echo $FmData[0]['CGSTtotal'];?>" type="text" style="border-style:none;" tabindex="12" readonly>
				</div>	
			</div>
			<!-- radio Box -->
				
		
				<div class="form-group">
				<label class="col-sm-4 control-label"> SGST </label>
				<div class="col-sm-3">
					<input class="form-control" id="SGST" name="SGST" value="<?php echo $FmData[0]['SGST'];?>" style="border-style:none;" type="text" readonly>
				</div>
				<div class="col-sm-5">
					<input class="form-control" id="SGSTtotal" name="SGSTtotal" value="<?php echo $FmData[0]['SGSTtotal'];?>" type="text" style="border-style:none;" readonly>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"> IGST </label>
				<div class="col-sm-3">
					<input class="form-control" id="IGST" name="IGST" value="<?php echo $FmData[0]['IGST'];?>" style="border-style:none;" type="text" readonly>
				</div>
				<div class="col-sm-5">
					<input class="form-control" id="IGSTtotal" name="IGSTtotal" value="<?php echo $FmData[0]['IGSTtotal'];?>" type="text" style="border-style:none;" readonly>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"> Advance </label>
				<div class="col-sm-8">
					<input class="form-control" id="Advance" name="Advance" value="<?php echo $FmData[0]['Advance'];?>" type="text" onblur="advance();" tabindex="13">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"> Net Amount </label>
				<div class="col-sm-8">
					<input class="form-control" id="Balance" name="Balance" value="<?php echo $FmData[0]['Balance'];?>" type="text" readonly>
				</div>
			</div>
		</div>
</div>				

</div>	
				
				<input type="hidden" value="1" id="hdtotal">
				<input type="hidden" value="1" id="ghdtotal">
				<input type="hidden" value="1" id="proformainvoice">
		
        <div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:80px;margin-right:80px;border:1px solid black;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Semi finished Rawmaterial Name</th>
							<th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="Listing_table">
                         <?php 
                                if(is_array($FmDataSub) && count($FmDataSub) >= 1):
                                $tii = 1;
                                foreach ($FmDataSub as $dataValue): 
                                  
                            ?>

                         <tr id="Data_entry_<?php echo $tii; ?>">
                            <td>
                                 <div class="form-group">
                                 <div class="col-sm-12">
                                 <input class="form-control btn-danger" id="SUBREM_<?php echo $tii; ?>" name="SUBREM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Data_entry_$tii').remove()";?>>
                                 </div>
                                 </div>
                            </td>
                            <td>
                                <div class="form-group">
                                         <select class="form-control" name="ItemName_<?php echo $tii; ?>"  id="ItemName_<?php echo $tii; ?>" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($rawmaterial_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                    </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Field5_<?php echo $tii; ?>" name="Field5_<?php echo $tii; ?>" value="<?php if(isset($dataValue['Quantity1'])){ echo $dataValue['Quantity1']; } ?>" placeholder="" onkeypress="return onlynumbers(event);" required>
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="SUBADD" name="SUBADD" value="+"  type="button"  onclick="addRowSub(<?php echo count($FmDataSub)+1; ?>,'edit')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                                     <?php 
                                        //this + 5 increment is to manage new entry by javascript on edition mode
                                        // so on edit with existing entry one can add additional 4 entries can do 
                                        //or del and add many as possible
                                        $tii = $tii+1;
                                            endforeach;
                                        else: 
                                        ?>
                                        
                            <tr id="Data_entry_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="SUBREM_1" name="SUBREM_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
                            <td>
                               <div class="form-group">
                                    <div class="col-sm-12">
                                    <select class="form-control" name="ItemName_1" id="ItemName_1"  onchange="validateExist(this.id,'invoice_listing_table');" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($rawmaterial_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php endforeach; ?>
                                      </select>
                                    </div>
         	                    </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control"  id="Field5_1"  name="Field5_1"  value="" type="text" onkeypress="return onlynumbers(event)" required>  
                                    </div>
                                </div>
                            </td> 
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="SUBADD" name="SUBADD" value="+"  type="button" onclick="addRowSub()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
		
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

              <input type="hidden" value="1" id="maxCount" name="maxCount">	
              <input type="hidden" value="1" id="maxCountSub" name="maxCountSub" >
            			    
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
            