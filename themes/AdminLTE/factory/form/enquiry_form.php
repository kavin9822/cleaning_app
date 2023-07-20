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

        <div class="row" style="margin:20px">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="EnquiryNo" name="EnquiryNo" value="<?php if(isset($FmData[0]['EnquiryNo'])){echo $FmData[0]['EnquiryNo'];}else{echo $EnquiryNo;}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry Type</label>
                    <div class="col-sm-9">
                        <?php if(isset($FmData[0]['EnquiryType'])){ ?>
                         <select class="form-control" name="type" id="type" disabled>
                         <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquirytype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EnquiryType']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                         <input class="form-control" id="EnquiryType" name="EnquiryType" value="<?php if(isset($FmData[0]['EnquiryType'])){echo $FmData[0]['EnquiryType'];}?>" type="hidden" >
                        <?php } else {?>
                        <select class="form-control" name="EnquiryType" id="EnquiryType" required >
                          <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquirytype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EnquiryType']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php } ?>
                          
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Attended By</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="employee_ID" id="employee_ID" required onmouseover="ycssel()"  aria-hidden="true">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($employee_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['employee_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EmpName']; ?>"><?php echo $v['EmpName']; ?></option>
                            <?php endforeach; ?>
                            </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Contact Person</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="contactperson" name="contactperson"  readonly tocomplete="off" value="<?php if(isset($FmData[0]['PersonName'])){echo $FmData[0]['PersonName'];}?>" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Mode of Enquiry</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="EnquiryMode" id="EnquiryMode" required >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquirymode_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EnquiryMode']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Dept</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="pdndepartment_ID" id="pdndepartment_ID" required onmouseover="ycssel()">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($department_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['pdndepartment_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['DeptName']; ?>"><?php echo $v['DeptName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Company Name</label>
                    <div class="col-sm-7">
                    <?php if(isset($FmData[0]['customer_ID'])){ ?>
                    <select class="form-control js-example-basic-single" name="customerid" id="customerid" disabled>
                        <option value="" disabled selected style="display:none;">Select</option>
                                <?php foreach($customer_data as $k => $v): 
                                if ($v['ID'] == $FmData[0]['customer_ID']) {
                                    $isselected = 'selected="selected"';
                                }else{
                                    $isselected = '';
                                     }
                                ?>
                        <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['Title'];?>"><?php echo $v['Title'];?></option>
                        <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="customer_ID" id="customer_ID" value="<?php echo $FmData[0]['customer_ID'];?>">
                    <?php } else { ?>
                    <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onchange="company_agianst_customer_data(this.value)" required onmouseover="ycssel()">
                        <option value="" disabled selected style="display:none;">Select</option>
                                <?php foreach($customer_data as $k => $v): 
                                if ($v['ID'] == $FmData[0]['customer_ID']) {
                                    $isselected = 'selected="selected"';
                                }else{
                                    $isselected = '';
                                     }
                                ?>
                        <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['Title'];?>"><?php echo $v['Title'];?></option>
                        <?php endforeach; ?>
                        </select>
                    <?php }?>
                    </div>
                    <div class="col-md-2">
                            <a href="#myModal" data-toggle="modal" style="background: none !important;border: none;" >
                                <button type="button" <?php if(isset($FmData[0]['customer_ID'])){ echo 'disabled';}?> class="btn btn-primary pull-right" name="add_button" value="Add">Add New</button>
                             </a>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row" style="border:1px solid black;margin:20px">
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
                        <input class="form-control" id="BillingAddress1" name="BillingAddress1" readonly="true" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingAddress2" name="BillingAddress2" readonly="true" value="<?php echo $FmData[0]['BillingAddress2'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingCity" name="BillingCity" readonly="true" value="<?php echo $FmData[0]['BillingCity'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                       <label  class="control-label">Shipping Address &nbsp;&nbsp;<input type="checkbox" disabled="true" id="Address_type" name="Address_type" onclick="checksameaddress(this.id)" <?php echo (($FmData[0]['Address_type'] == 'same')  ? 'checked' : '');?> value="<?php if(isset($FmData[0]['Address_type'])){ echo $FmData[0]['Address_type'];}?>">&nbsp;Same As Billing Address</label></label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="BillingState_ID" id="BillingState_ID" onchange="checksameaddress('Address_type')" readonly="true">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($state_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['BillingState_ID']) {
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
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingZip" maxlength="6" name="BillingZip" value="<?php echo $FmData[0]['BillingZip'];?>" readonly="true" type="text"  onkeypress="return onlynumbers(event);" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="BillingCountry_ID" id="BillingCountry_ID" onchange="checksameaddress('Address_type')" readonly="true">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($country_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['BillingCountry_ID']) {
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
        <div class="row" style="margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Mobile No</label>
                    <div class="col-sm-9">
                        <input class="form-control" maxlength="10" id="MobileNo" name="MobileNo" readonly="true" placeholder="Enter Mobile No" value="<?php echo $FmData[0]['MobileNo'];?>" type="text"  onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email Id</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="Email" value="<?php echo $FmData[0]['Email'];?>" type="text" readonly="true">
                    </div>
                </div>
            </div>
        </div>
 <!-- Table row -->              
 <?php if((isset($FmData[0]['EnquiryType']) && $FmData[0]['EnquiryType']==1) or $FmData == null) {?>
    <div id="enquiryblock">
        <div class="row" style="margin:20px;border:1px solid black;">
            <div class="col-xs-12 table-responsive">
                <p style="padding:6px;"><b>Product Details :</b></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Remarks</th>
                            <th>RPF If Any</th
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
                                        <div class="col-sm-12">
                                           <!-- <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>">
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($pdt_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['product_ID']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                            -->
                                            <input class="form-control" type="text" required id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['ProductName']){ echo $dataValue['ProductName']; } ?>"  placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);">
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
                                        <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['Remarks']){ echo $dataValue['Remarks']; } ?>" placeholder="Enter Remarks">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                          <input class="form-control" type="file" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['RPFIfAny']){ echo $dataValue['RPFIfAny']; } ?>" placeholder="Enter RPF IF Any">
                                          <a target="_blank" title="To view click here" href="<?php echo $home.'/'.$dataValue['RPFIfAny'];?>"><?php echo ltrim($dataValue['RPFIfAny'],'resource/enquiry/.');?></a>
                                          <!--<input class="form-control" type="file" id="Water_<?php echo $tii; ?>_<?php echo $rowIndex; ?>" name="Water_<?php echo $tii; ?>_<?php echo $rowIndex; ?>" value="<?php if($dataValue['RPFIfAny']){ echo $dataValue['RPFIfAny']; } ?>" placeholder="Enter RPF IF Any">-->
                                          <!--<a target="_blank" title="To view click here" href="<?php echo $home.'/'.$dataValue['RPFIfAny'];?>"><?php echo ltrim($dataValue['RPFIfAny'],'resource/enquiry/.');?></a>-->
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
                                        <!--<select class="form-control" name="ItemNo_1" id="ItemNo_1" >-->
                                        <!--    <option value="" disabled selected style="display:none;">Select</option>-->
                                        <!--    <?php foreach($pdt_data as $k => $v): ?>-->
                                        <!--        <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>-->
                                        <!--    <?php endforeach; ?>-->
                                        <!--</select>-->
                                        <input class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="Enter Product Name" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" required id="Quantity_1" name="Quantity_1" value="" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="unit_1" id="unit_1" required>
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
                                    <input class="form-control" type="text" id="Note_1" name="Note_1" value="" placeholder="Enter Remarks">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="file" id="Water_1" name="Water_1" value="" placeholder="Enter RPF IF Any">
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
        <div class="row" style="margin:20px">
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Costing Required</label>
                    <div class="col-sm-9">
                       <select class="form-control" name="CostRequired" id="CostRequired">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($costrequired_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['CostRequired']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry Status</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="EnquiryStatus" id="EnquiryStatus">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($enquirystatus_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EnquiryStatus']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Status Remarks</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ProductionStatus" name="ProductionStatus" value="<?php echo $FmData[0]['ProductionStatus'];?>" type="text" readonly>
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Order Received</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="OrderReceived" id="OrderReceived"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($orderreceived_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['OrderReceived']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PO Number</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="PONo" name="PONo" value="<?php echo $FmData[0]['PdnOrderNo'];?>" type="text" readonly>   
                    </div>
                </div>
             </div>
        </div>
        <div class="row" style="border:1px solid black;margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Reminder:</label>
                    <div class="col-sm-9">
                    <label  class="control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="RemaindDate" name="RemaindDate" onkeypress="return onlyNumbernodecimal(event);" placeholder="Select Date" value="<?php if (isset($FmData[0]['RemaindDate'])){echo date('d-m-Y',strtotime($FmData[0]['RemaindDate']));}else{ echo date('d-m-Y');}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="timepicker" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event);" placeholder="HH:mm" data-date-format="HH:mm" name="RemaindTime" value="<?php if ($FmData[0]['RemaindTime']){echo $FmData[0]['RemaindTime'];} else{ echo date('H:i ');} ?>" type="text" onclick="ycstime()">
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Remind About</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="RemaindAbout" name="RemaindAbout" placeholder="Enter Remaind About" value="<?php echo $FmData[0]['RemaindAbout'];?>" type="text">
                    </div>
                </div>
            </div>
        </div>
   
<input type="hidden" value="" id="maxCount" name="maxCount">
</div>
<?php } ?>
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')" > Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>
</section>
<form class="form-horizontal" id="ajax_form" action="" method="">  
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                 <!--Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Add Customer</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                 <!--Modal body -->
                <div class="modal-body">
                    <div class="row body_cls">
                        <section class="invoice">
                        <div class="row">
                            <div class="col-xs-12">
                            <h2 class="page-header">
                                <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:150px;"> &nbsp;
                                <?php echo $page_titles; ?>
                                <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                            </h2>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Contact Name <span style="color:red;font-size:14px">*</span></label>
                                     <div class="col-sm-8">
                                        <input class="form-control" id="CustomerName" name="CustomerName" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Designation</label>
                                     <div class="col-sm-8">
                                       <input class="form-control" id="DesignationName" name="DesignationName" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label  class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                    <label  class="control-label">Billing Address</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label  class="col-sm-4 control-label">Address Line1 <span style="color:red;font-size:14px">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="BillAddress1" name="BillAddress1" value="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-sm-4 control-label">Address Line2</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="BillAddress2" name="BillAddress2" value="" type="text">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label  class="col-sm-4 control-label">City <span style="color:red;font-size:14px">*</span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="BillCity" name="BillCity" value="" type="text">
                                    </div>
                                </div>
                                
                            </div>
                                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Company Name</label>
                                     <div class="col-sm-8">
                                        <input class="form-control" id="CmpyName" name="CmpyName" value="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Mobile No</label>
                                     <div class="col-sm-8">
                                       <input class="form-control" id="CustMobNo" name="CustMobNo" value="" maxlength="10" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                       <!--<label  class="control-label">Shipping Address &nbsp;&nbsp;<input type="checkbox" id="AddressType" name="AddressType" value="">&nbsp;Same As Billing Address</label></label>-->
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label  class="col-sm-4 control-label">State <span style="color:red;font-size:14px">*</span></label>
                                    <div class="col-sm-8">
                                            <select class="form-control" name="BillState_ID" id="BillState_ID">
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                    <?php foreach ($ajxstate_data as $k => $v): ?>
                                                    <option  value="<?php echo $v['ID']; ?>" <?php if($v['ID'] == '24'){ ?> selected="selected" <?php  } ?> title="<?php echo $v['StateName']; ?>"><?php echo $v['StateName']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Country <span style="color:red;font-size:14px">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="BillCountry_ID" id="BillCountry_ID">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($ajxcountry_data as $k => $v): ?>
                                            <option value="<?php echo $v['ID']; ?>" <?php if($v['ID'] == '1'){ ?> selected="selected" <?php  } ?> title="<?php echo $v['CountryName']; ?>"><?php echo $v['CountryName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">PinCode</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="BillZip" name="BillZip" value="" maxlength="6" type="text"  onkeypress="return onlynumbers(event);">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button type ="button" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" onclick="customersubmit('ajax_form')"> Submit </button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>       
 </form>