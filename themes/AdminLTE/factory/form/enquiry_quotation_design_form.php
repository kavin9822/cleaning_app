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
                       <label  class="col-sm-3 control-label">Enquiry No</label>
			           <div class="col-sm-9">
					       <?php if($mode=='add') {?>
			               <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                              <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EnquiryID" id="EnquiryID" onchange="Fetch_enquiry_quotation_Data(this.value,'customer','CompanyName','PersonName','PermntAddress1','MobileNo','PermntCity','PermntZip','CompanyName','PersonName','PermntAddress1','MobileNo','PermntCity','PermntZip')" tabindex="1" required>
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
						   <?php }else {?>
						       <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                              <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EnquiryID" id="EnquiryID" onchange="Fetch_enquiry_quotation_Data(this.value,'customer','CompanyName','PersonName','PermntAddress1','MobileNo','PermntCity','PermntZip','CompanyName','PersonName','PermntAddress1','MobileNo','PermntCity','PermntZip')" tabindex="1" required>
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
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="PersonName" name="PersonName" value="<?php echo $FmData[0]['PersonName'];?>" type="text" readonly>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Contact No</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="MobileNo" name="MobileNo" value="<?php echo $FmData[0]['MobileNo'];?>" type="text" readonly>  
			           </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">ZIP Code</label>
			           <div class="col-sm-9">
			              <input class="form-control" id="PermntZip" name="PermntZip" value="<?php echo $FmData[0]['PermntZip'];?>" type="text" readonly>
			          </div>
		          </div>
				</div> 
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Company Name</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="CompanyName" name="CompanyName" value="<?php echo $FmData[0]['CompanyName'];?>" type="text" readonly>  
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Street Address</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="PermntAddress1" name="PermntAddress1" value="<?php echo $FmData[0]['PermntAddress1'];?>" type="text" readonly> 
			          </div>
		          </div>
		             <div class="form-group">
                       <label  class="col-sm-3 control-label">City</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="PermntCity" name="PermntCity" value="<?php echo $FmData[0]['PermntCity'];?>" type="text" readonly> 
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
                            <th>Item Name</th>
							<th>Item Description</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
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
                                        <input class="form-control" type="text" required id="Field2_<?php echo $tii; ?>" name="Field2_<?php echo $tii; ?>"
									    value="<?php if($dataValue['ItemDescription']){ echo $dataValue['ItemDescription']; } ?>" placeholder="Enter ItemName" tabindex="2" required>
                                        </div>
                                    </div>
                                </td>
								<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="ItemDescription_<?php echo $tii; ?>" name="ItemDescription_<?php echo $tii; ?>"
									    value="<?php if($dataValue['ItemDescription1']){ echo $dataValue['ItemDescription1']; } ?>" placeholder="Enter ItemDescription" tabindex="3" required>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Unit_<?php echo $tii; ?>" name="Unit_<?php echo $tii; ?>" value="<?php if($dataValue['Unit']){ echo $dataValue['Unit']; } ?>" placeholder="Enter Unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Field6_<?php echo $tii; ?>').val(($('#Unit_<?php echo $tii; ?>').val() * $('#UnitPrice_<?php echo $tii; ?>').val()).toFixed(2))" style="width:150px" tabindex="4" required>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                         <select class="form-control" name="unitmeasure_<?php echo $tii; ?>" id="unitmeasure_<?php echo $tii; ?>" tabindex="5" required>
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
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="UnitPrice_<?php echo $tii; ?>" name="UnitPrice_<?php echo $tii; ?>" value="<?php if($dataValue['UnitPrice']){ echo $dataValue['UnitPrice']; } ?>" placeholder="Enter UnitPrice" onkeypress="return onlynumbers(event);" onkeyup="$('#Field6_<?php echo $tii; ?>').val(($('#Unit_<?php echo $tii; ?>').val() * $('#UnitPrice_<?php echo $tii; ?>').val()).toFixed(2))" style="width:120px" tabindex="6" required>
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Field6_<?php echo $tii; ?>" name="Field6_<?php echo $tii; ?>" value="<?php if($dataValue['Amount']){ echo $dataValue['Amount']; } ?>" placeholder="Enter Amount" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly>
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
                                         <input class="form-control" type="text" id="Field2_1" name="Field2_1" value="" placeholder="Enter ItemName" tabindex="7" required>
                                    </div>
         	                    </div>
                            </td>
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="ItemDescription_1" name="ItemDescription_1" value="" placeholder="Enter ItemDescription" tabindex="8" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Unit_1" name="Unit_1" value="" placeholder="Enter Unit" onkeypress="return onlynumbers(event);" onkeyup="$('#Field6_1').val(($('#Unit_1').val() * $('#UnitPrice_1').val()).toFixed(2))" style="width:100px" tabindex="9" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <select class="form-control" name="unitmeasure_1" id="unitmeasure_1" tabindex="10">
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
                                         <input class="form-control" type="text" id="UnitPrice_1" name="UnitPrice_1" value="" placeholder="Enter UnitPrice" onkeypress="return onlynumbers(event);" onkeyup="$('#Field6_1').val(($('#Unit_1').val() * $('#UnitPrice_1').val()).toFixed(2))" style="width:120px" tabindex="11" required>
                                    </div>
         	                   </div>
                            </td> 
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Field6_1" name="Field6_1" value="" tabindex="19" style="width:120px" readonly>
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
				<div class="row" style="margin:20px">
				<div class="col-lg-6">
		        <div class="form-group">
                       <label  class="col-sm-3 control-label">Terms and Conditions</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="TermsAndConditions" name="TermsAndConditions" value="<?php echo $FmData[0]['TermsAndConditions'];?>" type="text" tabindex="12" required>  
			           </div>
		             </div>
			    <div class="form-group">
                       <label  class="col-sm-3 control-label">Taxes</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Taxes" name="Taxes" value="<?php echo $FmData[0]['Taxes'];?>" type="text" tabindex="14" required>  
			           </div>
		             </div>
			    <div class="form-group">
                       <label  class="col-sm-3 control-label">Freight</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Freight" name="Freight" value="<?php echo $FmData[0]['Freight'];?>" type="text" tabindex="16"required>  
			           </div>
		             </div>
				 <div class="form-group">
                       <label  class="col-sm-3 control-label">Special Condition</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SpecialCondition" name="SpecialCondition" value="<?php echo $FmData[0]['SpecialCondition'];?>" type="text" tabindex="18" required>  
			           </div>
		             </div>
				   </div>
			<div class="col-lg-6">
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Validity</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Validity" name="Validity" value="<?php echo $FmData[0]['Validity'];?>" type="text" tabindex="13" required>  
			           </div>
		             </div>
				  <div class="form-group" style="margin-top:25px">
                       <label  class="col-sm-3 control-label">Payment Terms</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="PaymentTerms" name="PaymentTerms" value="<?php echo $FmData[0]['PaymentTerms'];?>" type="text" tabindex="15" required>  
			           </div>
		             </div>
			       <div class="form-group">
                       <label  class="col-sm-3 control-label">Inspection</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Inspection" name="Inspection" value="<?php echo $FmData[0]['Inspection'];?>" type="text" tabindex="17" required>  
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
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
  
</section>         
            