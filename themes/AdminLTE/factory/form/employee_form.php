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

        <div class="row">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Employee Code</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="EmpCode" name="EmpCode" value="<?php if(isset($FmData[0]['EmpCode'])){echo $FmData[0]['EmpCode'];}else{echo $EmpCode;}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Employee Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="EmpName" name="EmpName" autocomplete="off" value="<?php if(isset($FmData[0]['EmpName'])){echo $FmData[0]['EmpName'];}?>" type="text" onblur="Fetch_duplicate_employee_Data(this.value,'employee','EmpName','EmpName')" onkeyup="validateInput(this)">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Department</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="Department_ID" id="Department_ID" required onmouseover="ycssel()" onchange="SqlbasedjoinSelect(this.value,'Designation_ID','department','designation','DesignationName','Department_ID','designation');" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($department_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Department_ID']) {
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
                    <label  class="col-sm-3 control-label">Designation</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="Designation_ID" id="Designation_ID" onmouseover="ycssel()">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($designation_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Designation_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['DesignationName']; ?>"><?php echo $v['DesignationName']; ?></option>
                            <?php endforeach; ?>
                            </select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">DOB</label>
                    <div class="col-sm-9">
                     <input class="form-control datepicker" id="datepicker" name="DOB" autocomplete="off" value="<?php if (isset($FmData[0]['DOB']) && ($FmData[0]['DOB']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['DOB']));} ?>" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" autocomplete="off" value="<?php echo $FmData[0]['Email'];?>" type="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Mobile No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MobileNo" name="MobileNo" autocomplete="off" value="<?php echo $FmData[0]['MobileNo'];?>" type="text"  placeholder="Mobile No" onkeyup="validateField(this.id,'number');" maxlength="10" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Active</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="Active" id="Active"> 
                            <option  value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Active']) && $FmData[0]['Active']=='1'){echo 'selected="selected"';}else{ echo 'selected="selected"'; }  ?> value="1" title="Yes">Yes</option>
                            <option <?php if(isset($FmData[0]['Active']) && $FmData[0]['Active']=='2'){echo 'selected="selected"';} ?> value="2" title="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">  
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line1</label>
                    <div class="col-sm-9">
                        <input class="form-control" autocomplete="off" id="AddressLine1" name="AddressLine1" value="<?php if(isset($FmData[0]['AddressLine1'])){echo $FmData[0]['AddressLine1'];}?>" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Address Line2</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="AddressLine2" autocomplete="off" name="AddressLine2" value="<?php if(isset($FmData[0]['AddressLine2'])){echo $FmData[0]['AddressLine2'];}?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="City" name="City" autocomplete="off" value="<?php if(isset($FmData[0]['City'])){echo $FmData[0]['City'];}?>" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="State_ID" id="State_ID"  required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($state_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['State_ID']) {
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
                    <label class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="Country_ID" id="Country_ID"  required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($country_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Country_ID']) {
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
                        <input class="form-control" autocomplete="off" id="Pincode" name="Pincode" value="<?php echo $FmData[0]['Pincode'];?>" type="text" onkeypress="return onlynumbers(event);" maxlength="6" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Emergency Contact No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ContactNo" autocomplete="off" placeholder="Contact No" name="ContactNo" value="<?php echo $FmData[0]['ContactNo'];?>" type="text" maxlength="10" onkeyup="validateField(this.id,'number');">
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
     
