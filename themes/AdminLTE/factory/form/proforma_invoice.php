<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
  
            <!-- title row -->
        <div class="row"> 
            <div class="col-xs-12">
                <h2 class="page-header"> 
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:80px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
				<div class="row">
					<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                </div>
				
				
				<!-- End -->
				
				<!-- before table --> 
				
<div class="container" style="margin-top:20px;">		
				
		<div class="row" >
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Enquiry No </label>
				<div class="col-sm-8">
				<?php if($mode=='add'){?>
			    <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                <?php }else { ?>
				<select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" onchange="proforma_Data(this.value,'enquiry','customer','PONo','PersonName','CompanyName','GSTNo','BillingAddress1','BillingAddress2','BillingCity','BillingState_ID','BillingCountry_ID','BillingZip','pono','Name','Company','GSTNO','Permanent_address','Address','City','StateID','Country','Pincode');" tabindex="1" required>
				<?php } ?>
                <option value="" disabled selected style="display:none;">Select</option>
                <?php foreach ($enquiry_data as $k => $v): 
                if ($v['ID'] == $FmData[0]['EnquiryID']) {
                $isselected = 'selected="selected"';
                }else{
                $isselected = '';
                }
                ?>
									
                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                <?php endforeach; ?>
                </select>
				<?php }else{?>
				<?php if(isset($FmData[0]['EnquiryID'])) { ?>
                <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                <?php }else { ?>
				<select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID">
				<?php } ?>
                <option value="" disabled selected style="display:none;">Select</option>
                <?php foreach ($enquiry1_data as $k => $v): 
                if ($v['ID'] == $FmData[0]['EnquiryID']) {
                $isselected = 'selected="selected"';
                }else{
                $isselected = '';
                }
                ?>
									
                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                <?php endforeach; ?>
                </select>
				<?php }?>
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> Customer P.O. No. </label>
				<div class="col-sm-8">
				<input class="form-control" id="pono" name="pono" value="<?php echo $FmData[0]['PONo'];?>" type="text" readonly>		
				</div>
			</div>
		</div>
		</div>	
	<div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Company Name </label>
				<div class="col-sm-8">
						<input class="form-control" id="Company" name="Company" value="<?php echo $FmData[0]['CompanyName'];?>" type="text" readonly>
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Address Line1</label>
				<div class="col-sm-8">
						<input class="form-control" id="Permanent_address" name="Permanent_address" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" readonly>
				</div>
			</div>
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
								<div class="form-group">
				<label class="col-sm-4 control-label">Name </label>
				<div class="col-sm-8">
						<input class="form-control" id="Name" name="Name" value="<?php echo $FmData[0]['PersonName'];?>" type="text" readonly>
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Address Line2</label>
				<div class="col-sm-8">
						<input class="form-control" id="Address" name="Address" value="<?php echo $FmData[0]['BillingAddress2'];?>" type="text" readonly>
				</div>
			</div>
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">GST NO</label>
				<div class="col-sm-8">
						<input class="form-control" id="GSTNO" name="GSTNO" value="<?php echo $FmData[0]['GSTNo'];?>" type="text" onkeyup="specialcharacters_restriction(id)" readonly>
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">City </label>
				<div class="col-sm-8">
					<input class="form-control" id="City" name="City" value="<?php echo $FmData[0]['BillingCity'];?>" type="text" readonly>
			</div>	
			</div>
		</div>
		</div>
		
		<div class="row" >
		<div class="col-sm-6">	
				
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> State </label>
				<div class="col-sm-8">
				<input class="form-control" id="StateID" name="StateID" value="<?php echo $FmData[0]['StateName'];?>" type="text" readonly>
				</div>
			</div>
		</div>
		</div>
		
		<div class="row" >
		<div class="col-sm-6">	
				
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">PinCode</label>
				<div class="col-sm-8">
						<input class="form-control" id="Pincode" name="Pincode" value="<?php echo $FmData[0]['BillingZip'];?>" type="text"  onkeypress="return onlynumbers(event);" maxlength="6" readonly>
			</div>	
			</div>
		</div>
		</div>
		
		
		


</div>				
				
	<!-- Table -->
			<div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:80px;margin-right:80px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name of the Material</th>
                            <th>UOM</th>
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
                                         <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove();total_pro()";?> >
                                        </div>
                                    </div>
                                </td>
								<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Material_<?php echo $tii; ?>" name="Material_<?php echo $tii; ?>"
									    value="<?php if($dataValue['Material']){ echo $dataValue['Material']; } ?>" placeholder="Enter Material" tabindex="2" style="width:230px" required>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                               <div class="form-group">
                                        <div class="col-sm-12">
                            <select class="form-control" name="Uom_<?php echo $tii; ?>" id="Uom_<?php echo $tii; ?>" tabindex="3" style="width:120px" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['unit_ID']) {
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
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
										
                                        <input class="form-control" type="text" id="Quantitys_<?php echo $tii; ?>" name="Quantitys_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_<?php echo $tii; ?>').val(($('#Quantitys_<?php echo $tii; ?>').val() * $('#price_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro()" tabindex="4" style="width:115px" required>		
								  
						
								  
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="price_unit_<?php echo $tii; ?>" name="price_unit_<?php echo $tii; ?>" value="<?php if($dataValue['price_unit']){ echo $dataValue['price_unit']; } ?>" placeholder="Enter price_unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_<?php echo $tii; ?>').val(($('#Quantitys_<?php echo $tii; ?>').val() * $('#price_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro()" tabindex="5" style="width:120px" required>			
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
                                         <input class="form-control" type="text" id="Material_1" name="Material_1" value="" placeholder="Enter Material" tabindex="6" style="width:230px" required >
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                  <select class="form-control" name="Uom_1" id="Uom_1" tabindex="7" style="width:120px" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($unit_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" id="Quantitys_1" name="Quantitys_1" value="" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_1').val(($('#Quantitys_1').val() * $('#price_unit_1').val()).toFixed(2));total_pro()" tabindex="8" style="width:115px" required>		
								
							<!--	<input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required>		-->
								
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="price_unit_1" name="price_unit_1" value="" placeholder="Enter price_unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Value_1').val(($('#Quantitys_1').val() * $('#price_unit_1').val()).toFixed(2));total_pro()" tabindex="9" style="width:120px" required>	
									 
								<!--	 <input class="form-control" id="price_unit_1" name="price_unit_1" value="" placeholder="price_unit_1" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required> 	-->
									 
                                    </div>
         	                   </div>
                            </td> 
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Value_1" name="Value_1" value="" placeholder="Enter Amount" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly>
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
		<input type="hidden" value="1" id="maxCount" name="maxCount">	
				
	<!-- GST -->

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
				
				
				
				<!-- End -->
				
				
				
        <!-- this row will not appear when printing -->
     <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getRowCount()"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" > Submit </button>
                <?php } ?>
            </div>
        </div> 
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
	
	
	