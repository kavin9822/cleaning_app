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
                       <label  class="col-sm-3 control-label">Nature</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Nature" name="Nature" value="<?php echo $FmData[0]['Nature'];?>" type="text" tabindex="1">
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Supplier Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SupplierName" name="SupplierName" value="<?php echo $FmData[0]['SupplierName'];?>" type="text" onblur="Fetch_duplicate_SupplierName_Data(this.value,'supplier','SupplierName','SupplierName')" tabindex="3" required>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Address Line 1</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo $FmData[0]['AddressLine1'];?>" type="text" tabindex="4" >  
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">City</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="City" name="City" value="<?php echo $FmData[0]['City'];?>" type="text" tabindex="6">
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Contact Person</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ContactPerson" name="ContactPerson" value="<?php echo $FmData[0]['ContactPerson'];?>" type="text" tabindex="8">
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Email</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Email" name="Email" value="<?php echo $FmData[0]['Email'];?>" type="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" tabindex="10">
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Nature Of Work</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="NatureOfWork" name="NatureOfWork" value="<?php echo $FmData[0]['NatureOfWork'];?>" type="text" tabindex="12">
			           </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Type Of Control</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="TypeOfControl" id="TypeOfControl" tabindex="14" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Selection and Evaluation of Supplier'){echo 'selected="selected"';} ?> value="Selection and Evaluation of Supplier" title="Selection and Evaluation of Supplier">Selection and Evaluation of Supplier</option>
                            <option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Subsequent Inspection of Work at our end'){echo 'selected="selected"';} ?> value="Subsequent Inspection of Work at our end" title="Subsequent Inspection of Work at our end">Subsequent Inspection of Work at our end</option>
							<option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Test Certificate from Supplier'){echo 'selected="selected"';} ?> value="Test Certificate from Supplier" title="Test Certificate from Supplier">Test Certificate from Supplier</option>
							<option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Providing our formats to collect necessary information of process control'){echo 'selected="selected"';} ?> value="Providing our formats to collect necessary information of process control" title="Providing our formats to collect necessary information of process control">Providing our formats to collect necessary information of process control</option>
							<option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Supplying material to Supplier'){echo 'selected="selected"';} ?> value="Supplying material to Supplier" title="Supplying material to Supplier">Supplying material to Supplier</option>
							<option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='System audit'){echo 'selected="selected"';} ?> value="System audit" title="System audit">System audit</option>
							<option <?php if(isset($FmData[0]['TypeOfControl']) && $FmData[0]['TypeOfControl']=='Monitoring Quality Performance of Supplier'){echo 'selected="selected"';} ?> value="Monitoring Quality Performance of Supplier" title="Monitoring Quality Performance of Supplier">Monitoring Quality Performance of Supplier</option>
                        </select>
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Approved</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="CustomerApproved" name="CustomerApproved" value="<?php echo $FmData[0]['CustomerApproved'];?>" type="text" tabindex="16">
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Supplier ISO Certified</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SupplierIsoCertified" name="SupplierIsoCertified" value="<?php echo $FmData[0]['SupplierIsoCertified'];?>" type="text" tabindex="18">
			           </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Audit Frequency</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="AuditFrequency" id="AuditFrequency" tabindex="20" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['AuditFrequency']) && $FmData[0]['AuditFrequency']=='Qtry-3 months'){echo 'selected="selected"';} ?> value="Qtry-3 months" title="Qtry-3 months">Qtry-3 months</option>
                            <option <?php if(isset($FmData[0]['AuditFrequency']) && $FmData[0]['AuditFrequency']=='halfly-6 months'){echo 'selected="selected"';} ?> value="halfly-6 months" title="halfly-6 months">halfly-6 months</option>
							<option <?php  if(isset($FmData[0]['AuditFrequency']) && $FmData[0]['AuditFrequency']=='Annual-12 months'){echo 'selected="selected"';} ?> value="Annual-12 months" title="Annual-12 months">Annual-12 months</option>
                        </select>
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Revaluation Period</label>
			           <div class="col-sm-9">
							 <input class="form-control" id="RevaluationPeriod" name="RevaluationPeriod" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['RevaluationPeriod']) && ($FmData[0]['RevaluationPeriod']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['RevaluationPeriod']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="22">
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Remarks</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Remarks" name="Remarks" value="<?php echo $FmData[0]['Remarks'];?>" type="text" tabindex="24">
			          </div>
		          </div>
			   </div>
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Supplier type</label>
			           <div class="col-sm-9">
					      <select class="form-control" name="SupplierType" id="SupplierType" tabindex="2" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['SupplierType']) && $FmData[0]['SupplierType']=='Supplier'){echo 'selected="selected"';} ?> value="Supplier" title="Supplier">Supplier</option>
                            <option <?php if(isset($FmData[0]['SupplierType']) && $FmData[0]['SupplierType']=='Sub contractor'){echo 'selected="selected"';} ?> value="Sub contractor" title="Sub contractor">Sub contractor </option>
                        </select>
			          </div>
		          </div>
				     <!--<div class="form-group">
                       <label  class="col-sm-3 control-label"></label>
			           <div class="col-sm-9">
					    
			          </div>
		          </div>-->
				     <div class="form-group" style="margin-top:60px">
                       <label  class="col-sm-3 control-label">Address Line 2</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo $FmData[0]['AddressLine2'];?>" type="text" tabindex="5"> 
			          </div>
		          </div>
		             <div class="form-group">
                       <label  class="col-sm-3 control-label"> state</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="State_ID" id="State_ID" tabindex="7" required>
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
                       <label  class="col-sm-3 control-label">Contact Number</label>
			           <div class="col-sm-9">
			              <input class="form-control" id="ContactNumber" name="ContactNumber" value="<?php echo $FmData[0]['ContactNumber'];?>" type="text" onkeyup="validateField(this.id,'number');" maxlength="10" tabindex="9">
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Code</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="Code" id="Code" tabindex="11" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Code']) && $FmData[0]['Code']=='Trader'){echo 'selected="selected"';} ?> value="Trader" title="Trader">Trader</option>
                            <option <?php if(isset($FmData[0]['Code']) && $FmData[0]['Code']=='Manufacturer'){echo 'selected="selected"';} ?> value="Manufacturer" title="Manufacturer">Manufacturer </option>
							<option <?php if(isset($FmData[0]['Code']) && $FmData[0]['Code']=='Dealer'){echo 'selected="selected"';} ?> value="Dealer" title="Dealer">Dealer </option>
							<option <?php if(isset($FmData[0]['Code']) && $FmData[0]['Code']=='Calibration'){echo 'selected="selected"';} ?> value="Calibration" title="Calibration">Calibration </option>
                        </select>
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Items</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="Items" name="Items" value="<?php echo $FmData[0]['Items'];?>" type="text" tabindex="13">
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Material Grade</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="MaterialGrade" name="MaterialGrade" value="<?php echo $FmData[0]['MaterialGrade'];?>" type="text" tabindex="15">
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Applicable statutory & regulatory requirements</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="Applicable_Statutory_Requirements" name="Applicable_Statutory_Requirements" value="<?php echo $FmData[0]['Applicable_Statutory_Requirements'];?>" type="text" tabindex="17">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Certificate Validity</label>
			            <div class="col-sm-9">
				           <input class="form-control dp" id="CertificateValidity" name="CertificateValidity" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['CertificateValidity'])){echo date('d-m-Y',strtotime($FmData[0]['CertificateValidity']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="19">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Approved Date</label>
			            <div class="col-sm-9">
				           <input class="form-control dp" id="ApprovedDate" name="ApprovedDate" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['ApprovedDate'])){echo date('d-m-Y',strtotime($FmData[0]['ApprovedDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="21">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Supplier Development</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="SupplierDevelopment" name="SupplierDevelopment" value="<?php echo $FmData[0]['SupplierDevelopment'];?>" type="text" tabindex="23">
				      </div>
		           </div>
		                <div class="form-group">
                       <label  class="col-sm-3 control-label">Qms Status</label>
			           <div class="col-sm-9">
					      <select class="form-control" name="Qms_status" id="Qms_status" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Qms_status']) && $FmData[0]['Qms_status']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
                            <option <?php if(isset($FmData[0]['Qms_status']) && $FmData[0]['Qms_status']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No</option>
                        </select>
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
  
</section>         
            