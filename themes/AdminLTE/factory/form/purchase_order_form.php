<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
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
    
        <!-- info row -->

        <div class="row" style="margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Purchase Order No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="PurchaseOrderNo" name="PurchaseOrderNo" value="<?php if(isset($FmData[0]['PurchaseOrderNo'])){echo $FmData[0]['PurchaseOrderNo'];}else{echo $PurchaseOrderNo;}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Purchase Indent No</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="purchaseindent_ID" id="purchaseindent_ID" onchange="getpurchasedetails(this.value)" onmouseover="ycssel()" aria-hidden="true" required >
                        <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($indent_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['purchaseindent_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PurchaseIndentNo']; ?>"><?php echo $v['PurchaseIndentNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Supplier Name</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="supplier_ID" id="supplier_ID" onmouseover="ycssel()" onchange="getsupplier(this.value,'supplier_address_line1','supplier_address_line2','supplier_city','supplier_state')" aria-hidden="true" required >
                        <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($supplier_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['supplier_ID']) {
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
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                        <label  class="control-label">Supplier Address : </label>
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line 1</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="supplier_address_line1" name="supplier_address_line1" value="<?php if(isset($FmData[0]['AddressLine1'])){echo $FmData[0]['AddressLine1'];}?>" type="text" readonly>
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line 2</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="supplier_address_line2" name="supplier_address_line2" value="<?php if(isset($FmData[0]['AddressLine2'])){echo $FmData[0]['AddressLine2'];}?>" type="text" readonly>
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="supplier_city" name="supplier_city" value="<?php if(isset($FmData[0]['City'])){echo $FmData[0]['City'];}?>" type="text" readonly>
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="supplier_state" name="supplier_state" value="<?php if(isset($FmData[0]['StateName'])){echo $FmData[0]['StateName'];}?>" type="text" readonly>
                    </div>
                </div>
                
            </div>    
        </div>
        <div class="box-body" style="border:1px solid black;margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-7 control-label" style="text-align:left!important">Product Information:</label>
                    <div class="col-sm-5">
                    <label  class="control-label"></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                    <label  class="control-label"></label>
                    </div>
                </div>
            </div>
        <?php if(is_array($FmData) && count($FmData) >= 1) { ?>
		    <div class="row">
            <div class="col-xs-12 table-responsive" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Name </th>
                            <th>Pack Detils</th>
                            <th>Approved Qty</th>
                            <th>Raised PO Qty</th>
							<th>PO Quantity</th>
							<th>Unit</th>
                            <th>Price</th>
                            <th>Amount</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table" >
                            <?php 
                                if(is_array($FmData) && count($FmData) >= 1):
                                $tii = 1;
                                foreach ($FmData as $dataValue): 
                                   
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
											<input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName']; } ?>" readonly>
											<input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" readonly>
										</div>
         	                        </div>
         	                    </td>
                                <td>                                      
                                    <div class="form-group">         
										<div class="col-sm-12">
										<input class="form-control" type="text" id="Packdet_<?php echo $tii; ?>" name="Packdet_<?php echo $tii; ?>" value="<?php if($dataValue['PackDetails']){ echo $dataValue['PackDetails']; } ?>"  readonly>
										</div>
         	                        </div>
                                </td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['ApprovedQty']){ echo $dataValue['ApprovedQty']; } ?>" readonly>
										</div>
									</div>
								</td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="RaisedPOQty_<?php echo $tii; ?>" name="RaisedPOQty_<?php echo $tii; ?>" value="<?php echo $dataValue['RaisedPOQty'];  ?>" readonly>
										</div>
									</div>
								</td>
							
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Qty_<?php echo $tii; ?>" name="Qty_<?php echo $tii; ?>" value="<?php if($dataValue['POQuantity']){ echo $dataValue['POQuantity']; } ?>" readonly>
										</div>
									</div>
								</td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">	
										<input class="form-control" type="hidden" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if($dataValue['unit_ID']){ echo $dataValue['unit_ID']; } ?>">
										<input class="form-control" type="text" id="unitname_<?php echo $tii; ?>" name="unitname_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" readonly> 
								        </div>
									</div>
								</td>  
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											  <input class="form-control" type="text" id="Emp_<?php echo $tii; ?>" name="Emp_<?php echo $tii; ?>" value="<?php if($dataValue['Rate']){ echo $dataValue['Rate']; } ?>" readonly> 
										</div>
									</div>
								</td>
								<td>   
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['Amount']){ echo $dataValue['Amount']; } ?>" readonly>
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
                                        
                                        ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> 
	    <?php } ?>
            <div id="showData"></div>
        </div>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <div class ="col-md-6" style="padding-top:0; padding-bottom:20px;" >
                    <div class="form-group ">
                        <label class="control-label col-sm-6" for="CGST_SGST"style="text-align:right;padding-right:0%"  >CGST and SGST</label>
                         <div class="col-sm-6" style="padding-left:9.5%;">
                        <input type="radio" class="radio "   name="TaxChoise" id="CGST_SGST" <?php echo ($FmData[0]['CGSTTax'] == 0  ? 'checked' : 'checked');?>  value="CGST_SGST"  onclick="select_tax();ajaxtax_amount_calc();"  > 
                        </div>
                    </div>
                </div>
                <div class ="col-md-6">
                    <div class="form-group ">
                        <label class="control-label col-sm-10"  style="text-align:right;"  for="IGST" >IGST</label>
                         <div class="col-sm-2" style="padding-left:8%;" >
                         <input type="radio" class="radio "    name="TaxChoise" id="IGST" <?php echo ($FmData[0]['IGSTTax'] == 0  ? '' : 'checked');?>    value="IGST"  onclick="select_tax();tax();ajaxtax_amount_calc();" required>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead"><b>Amount</b></p>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive">
                        <tbody>
                            <tr>
                                <th style="width:30%">Total :</th>
                                <th style="width:20%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td  style="text-align:right;"><span id="subtotal"><?php echo $FmData[0]['BillAmount'];?></span>
                                <input class="form-control" type="hidden" id="BillAmount" name="BillAmount" value="<?php echo $FmData[0]['BillAmount'];?>">                        
                                </td>
                                </tr>
                                 <tr>
                                <th> Discount :</th>
                                <td style="width:20%"><input class="form-control"  placeholder="Enter In (%)" type="text" id="DiscountPercent" onkeyup="ajaxtax_amount_calc()" name="DiscountPercent" value="<?php echo  $FmData[0]['DiscountPercent'];?>" onkeypress="return onlyNumbernodecimal(event);"></td>
                                <td><input class="form-control" type="text" style="text-align:right;"  placeholder="Discount Amount" id="DiscountAmount" onkeyup="ajaxtax_amount_calc()" name="DiscountAmount" value="<?php echo $FmData[0]['DiscountAmount'];?>"></td>
                                </tr> 
                                <tr>
                                <th> GST :</th>
                                <td style="width:20%"><input class="form-control" style="text-align:right;" type="text" id="GSTTax" name="GSTTax" value="<?php echo  $FmData[0]['GSTTax'];?>" onkeypress="return onlyNumbernodecimal(event);" onkeyup="select_tax();ajaxtax_amount_calc()" required></td>
                                <td><input class="form-control" type="text" style="text-align:right;" id="GSTAmount" readonly name="GSTAmount" value="<?php echo $FmData[0]['GSTAmount'];?>" onkeyup="ajaxtax_amount_calc()"></td>
                                </tr>        
                                 
                                <tr>
                                <th> CGST :</th>
                                <td style="width:20%"><input class="form-control" onkeypress="return onlyNumberKey(event)" style="text-align:right;" readonly type="text" id="CGSTTax" name="CGSTTax" value=" <?php if(isset($FmData[0]['CGSTTax'])==true) { echo $FmData[0]['CGSTTax'];  }else{ echo 0;} ?>" onkeyup="ajaxtax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="CGSTAmount"  style="text-align:right;" name="CGSTAmount" style="text-align:right;"  value="<?php echo $FmData[0]['CGSTAmount'];?>" onkeyup="ajaxtax_amount_calc()" readonly></td>
                                </tr>
                                
                                <tr>
                                <th> SGST :</th>
                                <td style="width:20%"><input class="form-control" type="text" readonly onkeypress="return onlyNumberKey(event)" id="SGSTTax"  style="text-align:right;" name="SGSTTax" value=" <?php if(isset($FmData[0]['SGSTTax'])==true) { echo $FmData[0]['SGSTTax'];  }else{ echo 0;} ?> " onkeyup="ajaxtax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="SGSTAmount" style="text-align:right;" name="SGSTAmount" value="<?php echo $FmData[0]['SGSTAmount'];?>" onkeyup="ajaxtax_amount_calc()" readonly  ></td>
                                </tr>
                                                            
                                <tr>
                                <th> IGST :</th>
                                <td style="width:20%"><input class="form-control" type="text" readonly onkeypress="return onlyNumberKey(event)"  id="IGSTTax" style="text-align:right;" name="IGSTTax" value=" <?php if(isset($FmData[0]['IGSTTax'])==true) { echo $FmData[0]['IGSTTax'];  }else{ echo 0;} ?> " onkeyup="ajaxtax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="IGSTAmount" style="text-align:right;" name="IGSTAmount" value="<?php echo $FmData[0]['IGSTAmount'];?>" onkeyup="ajaxtax_amount_calc()" readonly></td>
                                </tr>
                                
                                 <tr>
                                <th>Grand Total :</th>
                                <th><span class="<?php echo $currencySymbol;?>"></span></th>
                                <th  style="text-align:right;" ><span id="Total"><?php echo $FmData[0]['NetAmount'];?></span>
                                <input class="form-control" type="hidden" id="NetAmount" name="NetAmount" value="<?php echo $FmData[0]['NetAmount'];?>"  onkeyup="ajaxtax_amount_calc()">
                                </th>
                                </tr>
                            </tr>
                        </tbody></table>
                </div>
                
            </div><!-- /.col -->
        </div><!-- /.row -->
         <div class="box-body" style="border:1px solid black;margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-7 control-label" style="text-align:left!important">Terms And Conditions:</label>
                    <div class="col-sm-5">
                    <label  class="control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Terms Of Payment</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="PaymentTerms" autocomplete="off" name="PaymentTerms" value="<?php if(isset($FmData[0]['PaymentTerms'])){echo $FmData[0]['PaymentTerms'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Dispatch Date</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="DispatchDate" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="DispatchDate" value="<?php if(isset($FmData[0]['DispatchDate'])){echo date('d-m-Y',strtotime($FmData[0]['DispatchDate']));}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Delivery Date</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="DeliveryDate" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="DeliveryDate" value="<?php if(isset($FmData[0]['DeliveryDate'])){echo date('d-m-Y',strtotime($FmData[0]['DeliveryDate']));}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Early Warning Policy</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="EarlyWarningPolicy" autocomplete="off" name="EarlyWarningPolicy" value="<?php if(isset($FmData[0]['EarlyWarningPolicy'])){echo $FmData[0]['EarlyWarningPolicy'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Freight Charges</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="FreightCharges" autocomplete="off" name="FreightCharges" value="<?php if(isset($FmData[0]['FreightCharges'])){echo $FmData[0]['FreightCharges'];}?>" type="text" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label  class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                    <label  class="control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Name Of Transport</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="NameOfTransport" autocomplete="off" name="NameOfTransport" value="<?php if(isset($FmData[0]['NameOfTransport'])){echo $FmData[0]['NameOfTransport'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Test Certificate</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="TestCertificate" autocomplete="off" name="TestCertificate" value="<?php if(isset($FmData[0]['TestCertificate'])){echo $FmData[0]['TestCertificate'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Incase Of Failure/Damage</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="Failure_or_Damage" autocomplete="off" name="Failure_or_Damage" value="<?php if(isset($FmData[0]['Failure_or_Damage'])){echo $FmData[0]['Failure_or_Damage'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Special Note</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="SpecialNote" autocomplete="off" name="SpecialNote" value="<?php if(isset($FmData[0]['SpecialNote'])){echo $FmData[0]['SpecialNote'];}?>" type="text" >
                    </div>
                </div>
            </div>
        <input type="hidden" value="" id="maxCount" name="maxCount">
        </div>
<br/>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="get_ajaxtable_count('showData')" onfocus="get_ajaxtable_count('showData')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="get_ajaxtable_count('showData')" onfocus="get_ajaxtable_count('showData')"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
