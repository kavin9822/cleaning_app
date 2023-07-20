<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
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
                    <label  class="col-sm-3 control-label">Contact Person Name </label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PersonName" name="PersonName" autocomplete="off" value="<?php if(isset($FmData[0]['PersonName'])){echo $FmData[0]['PersonName'];}?>" type="text" onblur="Fetch_duplicate_customer_Data(this.value,'customer','PersonName','PersonName')" onkeyup="validateInput(this)" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Designation</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DesignationName" name="DesignationName" value="<?php if(isset($FmData[0]['DesignationName'])){echo $FmData[0]['DesignationName'];}?>" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Company Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="CompanyName" name="CompanyName" value="<?php if(isset($FmData[0]['CompanyName'])){echo $FmData[0]['CompanyName'];}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">GST No.</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="GSTNo" name="GSTNo" value="<?php if(isset($FmData[0]['GSTNo'])){echo $FmData[0]['GSTNo'];}?>" type="text" maxlength="15" onkeypress="specialcharacters_restriction(id)">
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
                        <input class="form-control" id="BillingAddress1" name="BillingAddress1" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingAddress2" name="BillingAddress2" value="<?php echo $FmData[0]['BillingAddress2'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingCity" name="BillingCity" value="<?php echo $FmData[0]['BillingCity'];?>" type="text" onkeyup="checksameaddress('Address_type')" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="BillingState_ID" id="BillingState_ID" onchange="checksameaddress('Address_type')" required>
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
                    <label  class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="BillingCountry_ID" id="BillingCountry_ID" onchange="checksameaddress('Address_type')" required>
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingZip" name="BillingZip" value="<?php echo $FmData[0]['BillingZip'];?>" type="text"  onkeypress="return onlynumbers(event);" onkeyup="checksameaddress('Address_type')" maxlength="6" required>
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                       <label  class="control-label">Shipping Address &nbsp;&nbsp;<input type="checkbox" id="Address_type" name="Address_type" onclick="checksameaddress(this.id)" <?php echo (($FmData[0]['Address_type'] == 'same')  ? 'checked' : '');?> value="<?php if(isset($FmData[0]['Address_type'])){ echo $FmData[0]['Address_type'];}?>">&nbsp;Same As Contact Address</label></label>
                    </div>
                </div>
                <!--<div class="form-group">-->
                <!--    <label  class="col-sm-3 control-label">Permanent Address</label>-->
                <!--    <div class="col-sm-9">-->
                <!--       <label  class="col-sm-8 control-label"> &nbsp;&nbsp;<input type="checkbox" id="Address_type" name="Address_type" onclick="checksameaddress(this.id)" <?php echo (($FmData[0]['Address_type'] == '1' || $FmData[0]['Address_type'] == '2')  ? 'checked' : '');?> value="<?php if (isset($FmData[0]['Address_type'])){ echo $FmData[0]['Address_type'];}else{ echo '1';}?>">&nbsp;Same As Contact Address</label></label>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line1</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PermntAddress1" name="PermntAddress1" value="<?php echo $FmData[0]['PermntAddress1'];?>"  type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PermntAddress2" name="PermntAddress2" value="<?php echo $FmData[0]['PermntAddress2'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PermntCity" name="PermntCity" value="<?php echo $FmData[0]['PermntCity'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control" id="PermntState" name="PermntState" value="<?php echo $FmData[0]['PermntState'];?>" type="text"  required>-->
                        <select class="form-control" name="PermntState_ID" id="PermntState_ID">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($state_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['PermntState_ID']) {
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
                        <select class="form-control" name="PermntCountry_ID" id="PermntCountry_ID" onchange="checksameaddress('Address_type')" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($country_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['PermntCountry_ID']) {
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PermntZip" name="PermntZip" value="<?php echo $FmData[0]['PermntZip'];?>" type="text" maxlength="6" onkeypress="return onlynumbers(event);">
                    </div>
                </div>
             </div>
        </div> 
        <div class="row" style="margin:20px">
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State Code</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="StateCode" name="StateCode" placeholder="State Code" value="<?php echo $FmData[0]['StateCode'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Landline</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Landline" name="Landline" autocomplete="off" value="<?php echo $FmData[0]['Landline'];?>" type="text" maxlength="10" onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Email" name="Email" autocomplete="off" value="<?php echo $FmData[0]['Email'];?>" type="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Mobile No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MobileNo" name="MobileNo" autocomplete="off" placeholder="Mobile No" value="<?php echo $FmData[0]['MobileNo'];?>" type="text" maxlength="10"  onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Ext No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ExtNo" name="ExtNo" placeholder="Ext No" value="<?php echo $FmData[0]['ExtNo'];?>" type="text"  onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Website</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Website" placeholder="Website" name="Website" value="<?php echo $FmData[0]['Website'];?>" type="text">
                    </div>
                </div>
             </div>
        </div>
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view' && $mode!= 'approve'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
