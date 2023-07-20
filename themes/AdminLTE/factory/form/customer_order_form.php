<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view' || $mode=='Confirm' || $FmData[0]['Status']==1){ ?>
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

        <div class="row" style="border:1px solid black;margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry No</label>
                    <div class="col-sm-9">
                         <?php if($mode=='add'){?>
						 <?php if(isset($FmData[0]['enquiry_ID'])) { ?>
                         <input id="enquiry_ID" name="enquiry_ID" value="<?php if($FmData[0]['enquiry_ID']){echo $FmData[0]['enquiry_ID'];}?>"  type="hidden">
                         <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" disabled>
                         <?php }else { ?>
                        <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="customer_agianst_enquiry(this.value)" aria-hidden="true" required >
						<?php } ?>
                          <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquiry_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['enquiry_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
						<?php }else{?>
						<?php if(isset($FmData[0]['enquiry_ID'])) { ?>
                         <input id="enquiry_ID" name="enquiry_ID" value="<?php if($FmData[0]['enquiry_ID']){echo $FmData[0]['enquiry_ID'];}?>"  type="hidden">
                         <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" disabled>
                         <?php }else { ?>
						<select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="customer_agianst_enquiry(this.value)" aria-hidden="true" required >
						<?php } ?>
                          <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquiry1_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['enquiry_ID']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Cust Order No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="CustOrderNo" name="CustOrderNo" value="<?php if(isset($FmData[0]['CustOrderNo'])){echo $FmData[0]['CustOrderNo'];}else{echo $CustOrderNo;}?>" type="text" readonly>
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Customer Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="contactperson" name="contactperson" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['PersonName'])){echo $FmData[0]['PersonName'];}?>" type="text">
                    </div>
                </div>
               
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tender No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="TenderNo" name="TenderNo" value="<?php if(isset($FmData[0]['TenderNo'])){echo $FmData[0]['TenderNo'];}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Division</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="pdn_dept" name="pdn_dept" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['pdn_dept'])){echo $FmData[0]['pdn_dept'];}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label> 
                    <div class="col-sm-9">
                        <input class="form-control" id="OrderDate" name="OrderDate" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['OrderDate'])){echo date('d-m-Y',strtotime($FmData[0]['OrderDate'])); }else{ echo date('d-m-Y');}?>" type="text">
                    </div>
                </div>
                
            </div>    
        </div>
        <div class="row" style="margin:20px;padding:15px 10px;">
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                    <label  class="control-label">Billing Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line1</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingAddress1" name="BillingAddress1" readonly="true" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingAddress2" name="BillingAddress2" readonly="true" value="<?php echo $FmData[0]['BillingAddress2'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingCity" name="BillingCity" readonly="true" value="<?php echo $FmData[0]['BillingCity'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingState" name="BillingState" readonly="true" value="<?php echo $FmData[0]['BillingState'];?>" type="text" >
                    </div>
                </div>
                <!--<div class="form-group">-->
                <!--    <label  class="col-sm-3 control-label">Country</label>-->
                <!--    <div class="col-sm-9">-->
                <!--         <input class="form-control" id="BillingCountry" name="BillingCountry" readonly="true" value="<?php echo $FmData[0]['BillingCountry'];?>" type="text" >-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingZip" name="BillingZip" value="<?php echo $FmData[0]['BillingZip'];?>" readonly="true" type="text"  onkeypress="return onlynumbers(event);" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">GST No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="GSTNo" name="GSTNo"  value="<?php echo $FmData[0]['GSTNo'];?>" type="text" maxlength="15" onkeyup="specialcharacters_restriction(id)">
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                       <label  class="control-label">Delivery Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line1</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryAddress1" name="DeliveryAddress1" readonly="true" value="<?php echo $FmData[0]['PermntAddress1'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryAddress2" name="DeliveryAddress2" readonly="true" value="<?php echo $FmData[0]['PermntAddress2'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryCity" name="DeliveryCity" readonly="true" value="<?php echo $FmData[0]['PermntCity'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryState" name="DeliveryState" readonly="true" value="<?php echo $FmData[0]['PermntState'];?>" type="text" >
                    </div>
                </div>
                <!--<div class="form-group">-->
                <!--    <label  class="col-sm-3 control-label">Country</label>-->
                <!--    <div class="col-sm-9">-->
                <!--         <input class="form-control" id="DeliveryCountry" name="DeliveryCountry" readonly="true" value="<?php echo $FmData[0]['DeliveryCountry'];?>" type="text" >-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryZip" name="DeliveryZip" value="<?php if($FmData[0]['PermntZip']!=0) { echo $FmData[0]['PermntZip']; } ?>" readonly="true" type="text"  onkeypress="return onlynumbers(event);" >
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Contact No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MobileNo" name="MobileNo" readonly="true" placeholder="" value="<?php echo $FmData[0]['MobileNo'];?>" type="text"  onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
             </div>
        </div> 
         
 <!-- Table row -->
        <div class="row" style="border:1px solid black;margin:20px;padding:15px 10px;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product No</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table">
                            <?php 
                                if(is_array($FmDetail_Data) && count($FmDetail_Data) >= 1):
                                $tii = 1;
                                foreach ($FmDetail_Data as $dataValue):
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                               
                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove();tax_amount_calc();";?>>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" required id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['ProductNo']){ echo $dataValue['ProductNo']; } ?>"  placeholder="" onkeypress="return onlynumbers(event);">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($product_data as $k => $v): 
                                                if ($v['ID'] == $dataValue['Product_ID']) {
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
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['PdtDescription']){ echo $dataValue['PdtDescription']; } ?>" placeholder="">
                                        <button class="btn btn-primary" id="showMoreBtn">Show More</button>
                                        </div>
                                    </div>

                                    <div id="popupContainer" class="popup">
                                        <div class="popup-content">
                                        <span class="close">&times;</span>
                                        <div id="popupText"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" required>
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
                                        <input class="form-control" type="text" required id="Qty_<?php echo $tii; ?>" name="Qty_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Emp_<?php echo $tii; ?>').val() * $('#Qty_<?php echo $tii; ?>').val()).toFixed(2))" onkeypress="return onlynumbers(event);">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text"  required name="Emp_<?php echo $tii; ?>" id="Emp_<?php echo $tii; ?>" value="<?php if($dataValue['Price']){ echo $dataValue['Price']; } ?>" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Emp_<?php echo $tii; ?>').val() * $('#Qty_<?php echo $tii; ?>').val()).toFixed(2))" onkeypress="return onlynumbers(event);">
                                               
                                        </div>
                                    </div>
                                </td>
                                
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text"  readonly name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['Amount']){ echo $dataValue['Amount']; } ?>">
                                               
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmDetail_Data)+1; ?>)">
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
                                        <input class="form-control" type="text" id="ItemNo_1" name="ItemNo_1" value="" placeholder="" required onkeypress="return onlynumbers(event);">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="ItemName_1" id="ItemName_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($product_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                            <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" id="Note_1" name="Note_1" placeholder="Enter text here">
                                         <button class="btn btn-primary" id="showMoreBtn">Show More</button>
                                    </div>
                            </div>

                            <div id="popupContainer" class="popup">
                                <div class="popup-content">
                                   <span class="close">&times;</span>
                                <div id="popupText"></div>
                                 </div>
                              </div>
                               
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                            <select class="form-control" name="unit_1" id="unit_1" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): ?>
                                                 <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" required type="text" id="Qty_1" name="Qty_1" value="" onkeyup="$('#Amount_1').val(($('#Emp_1').val() * $('#Qty_1').val()).toFixed(2));nozero(this.id);tax_amount_calc()" onkeypress="return onlynumbers(event);">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" required name="Emp_1" id="Emp_1" value="" onkeyup="$('#Amount_1').val(($('#Emp_1').val() * $('#Qty_1').val()).toFixed(2));nozero(this.id);tax_amount_calc()" onkeypress="return onlynumbers(event);">
                                           
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                   <input class="form-control" type="text"  name="Amount_1" id="Amount_1" value="" readonly>
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
             <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <div class ="col-md-6" style="padding-top:0; padding-bottom:20px;" >
                    <div class="form-group ">
                        <label class="control-label col-sm-6" for="CGST_SGST"style="text-align:right;padding-right:0%"  >CGST and SGST</label>
                         <div class="col-sm-6" style="padding-left:9.5%;">
                        <input type="radio" class="radio "   name="TaxChoise" id="CGST_SGST" <?php echo ($FmData[0]['CGSTTax'] == 0  ? 'checked' : 'checked');?>   value="CGST_SGST"  onclick="select_tax();tax_amount_calc();"  > 
                        </div>
                    </div>
                </div>
                <div class ="col-md-6">
                    <div class="form-group ">
                        <label class="control-label col-sm-10"  style="text-align:right;"  for="IGST" >IGST</label>
                         <div class="col-sm-2" style="padding-left:8%;" >
                         <input type="radio" class="radio "    name="TaxChoise" id="IGST" <?php echo ($FmData[0]['IGSTTax'] == 0  ? '' : 'checked');?>    value="IGST"  onclick="select_tax();tax();tax_amount_calc();" required>
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
                                <th> GST :</th>
                                <td style="width:20%"><input class="form-control" style="text-align:right;" type="text" id="GSTTax" name="GSTTax" value="<?php echo  $FmData[0]['GSTTax'];?>" onkeypress="return onlynumbers(event);" onkeyup="select_tax();tax_calc1();tax_amount_calc()" required></td>
                                <td><input class="form-control" type="text" style="text-align:right;" id="GSTAmount" readonly name="GSTAmount" value="<?php echo $FmData[0]['GSTAmount'];?>" onkeyup="tax_amount_calc()"></td>
                                </tr>        
                                 
                                <tr>
                                <th> CGST :</th>
                                <td style="width:20%"><input class="form-control" onkeypress="return onlyNumberKey(event)" style="text-align:right;" readonly type="text" id="CGSTTax" name="CGSTTax" value=" <?php if(isset($FmData[0]['CGSTTax'])==true) { echo $FmData[0]['CGSTTax'];  }else{ echo 0;} ?>" onkeyup="tax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="CGSTAmount"  style="text-align:right;" name="CGSTAmount" style="text-align:right;"  value="<?php echo $FmData[0]['CGSTAmount'];?>" onkeyup="tax_amount_calc()" readonly></td>
                                </tr>
                                
                                <tr>
                                <th> SGST :</th>
                                <td style="width:20%"><input class="form-control" type="text" readonly onkeypress="return onlyNumberKey(event)" id="SGSTTax"  style="text-align:right;" name="SGSTTax" value=" <?php if(isset($FmData[0]['SGSTTax'])==true) { echo $FmData[0]['SGSTTax'];  }else{ echo 0;} ?> " onkeyup="tax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="SGSTAmount" style="text-align:right;" name="SGSTAmount" value="<?php echo $FmData[0]['SGSTAmount'];?>" onkeyup="tax_amount_calc()" readonly  ></td>
                                </tr>
                                                            
                                <tr>
                                <th> IGST :</th>
                                <td style="width:20%"><input class="form-control" type="text" readonly onkeypress="return onlyNumberKey(event)"  id="IGSTTax" style="text-align:right;" name="IGSTTax" value=" <?php if(isset($FmData[0]['IGSTTax'])==true) { echo $FmData[0]['IGSTTax'];  }else{ echo 0;} ?> " onkeyup="tax_amount_calc()"></td>
                                <td><input class="form-control" type="text" id="IGSTAmount" style="text-align:right;" name="IGSTAmount" value="<?php echo $FmData[0]['IGSTAmount'];?>" onkeyup="tax_amount_calc()" readonly></td>
                                </tr>
                                
                                 <tr>
                                <th>Net Amount :</th>
                                <th><span class="<?php echo $currencySymbol;?>"></span></th>
                                <th  style="text-align:right;" ><span id="Total"><?php echo $FmData[0]['NetAmount'];?></span>
                                <input class="form-control" type="hidden" id="NetAmount" name="NetAmount" value="<?php echo $FmData[0]['NetAmount'];?>"  onkeyup="tax_amount_calc()">
                                </th>
                                </tr>
                                
                                <tr>
                                <th style="width:30%">Note :</th>
                                 <td colspan="2">
                                 <input class="form-control" type="text" id="Note" name="Note" value="<?php echo $FmData[0]['Note'];?>">                        
                                 </td>
                                </tr>
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.row -->
        <div class="row" style="margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Drawing Path</label>
                    <div class="input-group col-sm-9">
                        <div class="col-sm-9">
                         <input class="form-control" id="Drawing_Path" name="Drawing_Path" value="<?php if(isset($FmData[0]['Drawing_Path'])){echo $FmData[0]['Drawing_Path'];}?>" type="text">
                        </div>
                        <div class="col-sm-3">
						<?php if($mode=='edit' || $mode=='view'){?>
                        <button id="copyButton" class="btn btn-default" onclick="copytext('Drawing_Path')" type="button">Copy</button>
						<?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Others</label>
                    <div class="input-group col-sm-9">
                        <div class="col-sm-12">
                        <!--<input class="form-control" id="attach_others" name="attach_others" value="" type="file" onClick="show_imagelabel()" multiple>-->
                        <div class="files">
                            <span class="btn btn-default btn-files add_new_btn pt-2">
                                Browse <input type="file"  name="files1[]"  id="files1" onchange="hideupload()"  multiple />
                            </span>
                        </div>
                        </div>
                       <div id="uploaded_block" style="display:none;margin-top:40px;"><p class="fileList1 fileList" ><label class="head_cls">Uploaded Items</label></p></div>
                       <?php if($mode == 'edit' || $mode == 'view'){ ?>
                    
                                    <?php if(!empty($FmDataothers) && count($FmDataothers)>0){ ?>
                                    
                                        <div class="files" style="margin-top:40px;">
                                            
                                            <p class="fileList mt-3" id="imagedata">
                                             
                                    <?php   $i=0; foreach ($FmDataothers as $datavalue):  ?>
                                    
                                            <?php if(isset($FmDataothers[$i]['Othersfile']))?>
                                            
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataothers[$i]['Othersfile']; ?>">
                                            <?php echo ltrim($FmDataothers[$i]['Othersfile'],"resource/customerorder/."); ?>
                                            <span class="col-sm-6 col-lg-6 col-xl-6" ><a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataothers[$i]['ID']); ?>','custorder_attachment');$(imglist_<?php echo $i?>).remove();return false;">Remove</a><span>
                                            </span>&nbsp;</a>
                                            <br><br>
                                            <?php $i++; endforeach;  ?>
                                            </p>
                                        </div>
                                        <br>
                                    <?php } ?>
                                <?php } ?>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row" style="border:1px solid black;margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Schedule:</label>
                    <div class="col-sm-9">
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
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>      
                            <th>Quantity</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody id="Listing_table">
                         <?php 
                                if(is_array($ScheduleData) && count($ScheduleData) >= 1):
                                $tii = 1;
                                foreach ($ScheduleData as $dataValue):
                                  
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
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Field4_<?php echo $tii; ?>" name="Field4_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="" >
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Field5_<?php echo $tii; ?>" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="Field5_<?php echo $tii; ?>"  value="<?php  if($dataValue['StartDate']){ echo date('d-m-Y',strtotime($dataValue['StartDate']));} ?>" placeholder="" type="text" onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Field6_<?php echo $tii; ?>" name="Field6_<?php echo $tii; ?>" value="<?php if($dataValue['EndDate']){ echo date('d-m-Y',strtotime($dataValue['EndDate'])); } ?>" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" placeholder="" type="text">
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="SUBADD" name="SUBADD" value="+"  type="button"  onclick="addRowSub(<?php echo count($ScheduleData)+1; ?>,'edit')">
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
                                    <input class="form-control"  id="Field4_1"  name="Field4_1"  value="" type="text"   onkeypress="return onlynumbers(event)">  
                                    </div>
         	                    </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"  id="Field5_1" name="Field5_1" value=""  type="text"  >
                                    </div>
                                </div>
                            </td> 
                           <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"  id="Field6_1" name="Field6_1" value=""  type="text" style="width:100%;height:35px;" >
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
        <div class="row" style="border:1px solid black;margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-7 control-label" style="text-align:left!important">Customer Purchase Order Details:</label>
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
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>      
                            <th>Date</th>
                            <th>Purchase Order No</th>
                            <th>File Upload</th>
                        </tr>
                    </thead>
                    <tbody id="Add_Listing_table">
                         <?php 
                                if(is_array($Cust_Purchase_Data) && count($Cust_Purchase_Data) >= 1):
                                $tii = 1;
                                foreach ($Cust_Purchase_Data as $dataValue):
                                  
                            ?>

                         <tr id="New_Data_Entry_<?php echo $tii; ?>"> 
                            <td>
                                 <div class="form-group">
                                 <div class="col-sm-12">
                                 <input class="form-control btn-danger" id="REMN_<?php echo $tii; ?>" name="REMN_<?php echo $tii; ?>" value="-"  type="button"  <?php if($tii>1) echo "onclick=$('#New_Data_Entry_$tii').remove()";?>>
                                 </div>
                                 </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field1_<?php echo $tii; ?>" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="field1_<?php echo $tii; ?>" value="<?php if($dataValue['PurchaseDate']){ echo date('d-m-Y',strtotime($dataValue['PurchaseDate']));} ?> ">
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field2_<?php echo $tii; ?>"  name="field2_<?php echo $tii; ?>"  value="<?php  if($dataValue['PurchaseorderNo']){ echo $dataValue['PurchaseorderNo'];}else {echo " ";}  ?>"  type="text">  
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field3_<?php echo $tii; ?>" name="field3_<?php echo $tii; ?>" value="<?php  if($dataValue['Fileupload']){ echo $dataValue['Fileupload'];}else {echo " ";}  ?>"   type="file">
                                    <a target="_blank" id="link" title="To view click here" href="<?php echo $home.'/'.$dataValue['Fileupload'];?>"><?php echo ltrim($dataValue['Fileupload'],'resource/customerorder/.');?></a>
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="NEWADD" name="NEWADD" value="+"  type="button"  onclick="addRows(<?php echo count($Cust_Purchase_Data)+1; ?>,'Add_Listing_table','New_Data_Entry_1','New_Data_Entry_','maxCountSub_1','REMN_1','REMN_')">
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
                                        
                            <tr id="New_Data_Entry_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="REMN_1" name="REMN_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control"  id="field1_1"  name="field1_1" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" value="" type="text"   onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
         	                    </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control"   id="field2_1" name="field2_1" value=""  type="text"  >
                                    </div>
                                </div>
                            </td> 
                           <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" id="field3_1" name="field3_1" value=""  type="file"  >
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="NEWADD" name="NEWADD" value="+"  type="button" onclick="addRows('1','Add_Listing_table','New_Data_Entry_1','New_Data_Entry_','maxCountSub_1','REMN_1','REMN_')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="border:1px solid black;margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-7 control-label" style="text-align:left!important">Amendment:</label>
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
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>      
                            <th>Date</th>
                            <th>Existing Information</th>
                            <th>New Information</th>
                            <th>Amendment Number</th>
                            <th>File Upload</th>
                        </tr>
                    </thead>
                    <tbody id="Add_Listing_tables">
                         <?php 
                                if(is_array($Cust_Amendment_Data) && count($Cust_Amendment_Data) >= 1):
                                $tii = 1;
                                foreach ($Cust_Amendment_Data as $dataValue):
                                  
                            ?>

                         <tr id="New_Data_Entrys_<?php echo $tii; ?>"> 
                            <td>
                                 <div class="form-group">
                                 <div class="col-sm-12">
                                 <input class="form-control btn-danger" id="REMNS_<?php echo $tii; ?>" name="REMNS_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#New_Data_Entrys_$tii').remove()";?>>
                                 </div>
                                 </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field7_<?php echo $tii; ?>" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="field7_<?php echo $tii; ?>" value="<?php  if($dataValue['AmendDate']){ echo date('d-m-Y',strtotime($dataValue['AmendDate']));}else {echo " ";}  ?>">
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field8_<?php echo $tii; ?>"  name="field8_<?php echo $tii; ?>"  value="<?php  if($dataValue['Exsist_Info']){ echo $dataValue['Exsist_Info'];}else {echo " ";}  ?>"  type="text" >  
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field9_<?php echo $tii; ?>" name="field9_<?php echo $tii; ?>" value="<?php  if($dataValue['New_Info']){ echo $dataValue['New_Info'];}else {echo " ";}  ?>"   type="text">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field10_<?php echo $tii; ?>" name="field10_<?php echo $tii; ?>" value="<?php  if($dataValue['Amendment_No']){ echo $dataValue['Amendment_No'];}else {echo " ";}  ?>"   type="text">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="field11_<?php echo $tii; ?>" name="field11_<?php echo $tii; ?>" value="<?php  if($dataValue['Fileupload']){ echo $dataValue['Fileupload'];}else {echo " ";}  ?>"   type="file">
                                    <a target="_blank" id="link" title="To view click here" href="<?php echo $home.'/'.$dataValue['Fileupload'];?>"><?php echo ltrim($dataValue['Fileupload'],'resource/customerorder/.');?></a>
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="NEWADDS" name="NEWADDS" value="+"  type="button"  onclick="addRows(<?php echo count($Cust_Amendment_Data)+1; ?>,'Add_Listing_tables','New_Data_Entrys_1','New_Data_Entrys_','maxCountSub_2','REMNS_1','REMNS_')">
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
                                        
                            <tr id="New_Data_Entrys_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="REMNS_1" name="REMNS_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control"  id="field7_1"  name="field7_1" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" value="" type="text"   onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
         	                    </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control"   id="field8_1" name="field8_1" value=""  type="text"  >
                                    </div>
                                </div>
                            </td> 
                           <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" id="field9_1" name="field9_1" value=""  type="text"  >
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" id="field10_1" name="field10_1" value=""  type="text"  >
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input  class="form-control" id="field11_1" name="field11_1" value=""  type="file"  >
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="NEWADDS" name="NEWADDS" value="+"  type="button" onclick="addRows('1','Add_Listing_tables','New_Data_Entrys_1','New_Data_Entrys_','maxCountSub_2','REMNS_1','REMNS_')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="margin:20px;padding:15px 10px;">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Order No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Pdnorder_No" name="Pdnorder_No" value="<?php echo $FmData[0]['PdnOrderNo'];?>"  type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">GF Mat / Rovings Details</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="GF_or_Roving" name="GF_or_Roving" value="<?php if(isset($FmData[0]['GF_or_Roving'])){echo $FmData[0]['GF_or_Roving'];}?>" type="text" >
                    </div>
                </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Packing Instructions</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Packing_Instn" name="Packing_Instn" autocomplete="off" value="<?php if(isset($FmData[0]['Packing_Instn'])){echo $FmData[0]['Packing_Instn'];}?>" type="text">
                    </div>
                </div>
               
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Order Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Pdnorder_Date" name="Pdnorder_Date"  autocomplete="off" value="<?php if(isset($FmData[0]['PdnOrderDate'])){echo date('d-m-Y',strtotime($FmData[0]['PdnOrderDate'])); } ?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Type of Resin</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ResinType" name="ResinType" autocomplete="off" value="<?php if(isset($FmData[0]['ResinType'])){echo $FmData[0]['ResinType'];}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">3rd Party Inspection</label> 
                    <div class="col-sm-9">
                        <select class="form-control" name="Thirdparty_Inspn" id="Thirdparty_Inspn"  onchange="show_or_hide_option(this.value,'1','remark_block','Remarks')" >
                        <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($thirdpartyinspn_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Thirdparty_Inspn']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="<?php if(isset($FmData[0]['Thirdparty_Inspn']) && $FmData[0]['Thirdparty_Inspn']==1){ echo 'display:block'; }else{echo 'display:none';} ?>" id="remark_block">
                    <label  class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Remarks" name="Remarks" autocomplete="off" value="<?php if(isset($FmData[0]['Remarks'])){echo $FmData[0]['Remarks'];}?>" type="text">
                    </div>
                </div>
            </div>    
        </div>
        <?php if($mode == 'Confirm' || $FmData[0]['Status']==1){ ?>
           </fieldset>
        <?php }?>
        <?php if($mode=='Confirm' || $FmData[0]['Status']==1){ ?>
        <div class="row" style="border:1px solid black;padding:15px 10px;margin:20px">
                <div class="col-md-6">
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Prepared by</label>
                        <div class="col-sm-9">
                             <input class="form-control" id="PreparedBy" name="PreparedBy" readonly value="<?php if($preparedby){ echo $preparedby; } ?>" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <?php if($mode=='Confirm' || $FmData[0]['Status']==1) { ?>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Approved By</label>
                    <div class="col-sm-8">
                        <select class="form-control js-example-basic-single" name="ApprovedBy" id="ApprovedBy" <?php if($FmData[0]['Status']==1) { echo 'disabled';}else{ echo 'required';} ?>  onmouseover="ycssel()"  aria-hidden="true">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($approver_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['ApprovedBy']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['user_nicename']; ?>"><?php echo $v['user_nicename']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div> 
        <?php } ?>
<input type="hidden" value="" id="maxCount" name="maxCount">
<input type="hidden" value="" id="maxCountSub" name="maxCountSub">
<input type="hidden" value="" id="maxCountSub_1" name="maxCountSub_1">
<input type="hidden" value="" id="maxCountSub_2" name="maxCountSub_2">
<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
<input type="hidden" value="1" id="taxamount_customerorder">
<br/>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                 <?php if($mode == 'Confirm'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="confirm_submit_button" value="confirm" onmouseover="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" onfocus="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" > Confirm </button>
                <?php } ?>
                <?php if($mode == 'edit' && $FmData[0]['Status']!=1){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" onfocus="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" onmouseover="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" onfocus="getCount(''),getCountSub(),getsubcounts('Add_Listing_table','maxCountSub_1'),getsubcounts('Add_Listing_tables','maxCountSub_2'),tax_amount_calc()" > Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Get the necessary elements
const showMoreBtn = document.getElementById('showMoreBtn');
const popupContainer = document.getElementById('popupContainer');
const popupText = document.getElementById('popupText');

// Show the popup and populate it with the text when the button is clicked
showMoreBtn.addEventListener('click', function() {
  const noteText = document.getElementById('Note_1').value;
  popupText.textContent = noteText;
  popupContainer.style.display = 'block';
});

// Hide the popup when the close button is clicked
popupContainer.addEventListener('click', function(event) {
  if (event.target === popupContainer || event.target.classList.contains('close')) {
    popupContainer.style.display = 'none';
  }
});
</script>
    <style>
        .popup {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  max-width: 500px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
   </style>
</section>
     
