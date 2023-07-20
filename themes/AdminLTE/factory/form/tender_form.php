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
                    <label  class="col-sm-3 control-label">Tender No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="TenderNo" name="TenderNo" value="<?php if(isset($FmData[0]['TenderNo'])){echo $FmData[0]['TenderNo'];}else{echo $TenderNo;}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry No</label>
                    <div class="col-sm-9">
                         <?php if($mode=='add'){?>
						 <?php if(isset($FmData[0]['enquiry_ID'])) { ?>
                         <input id="enquiry_ID" name="enquiry_ID" value="<?php if($FmData[0]['enquiry_ID']){echo $FmData[0]['enquiry_ID'];}?>"  type="hidden">
                         <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" disabled>
                         <?php }else { ?>
                        <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="enquiry_agianst_data(this.value)" aria-hidden="true" required >
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
						<select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="enquiry_agianst_data(this.value)" aria-hidden="true" required >
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
                    <label  class="col-sm-3 control-label">Attended By</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="employee_name" name="employee_name" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['EmpName'])){echo $FmData[0]['EmpName'];}?>" type="text">
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Dept</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="pdn_dept" name="pdn_dept" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['pdn_dept'])){echo $FmData[0]['pdn_dept'];}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Company Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="companyname" name="companyname" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['CompanyName'])){echo $FmData[0]['CompanyName'];}?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Contact Person</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="contactperson" name="contactperson" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['PersonName'])){echo $FmData[0]['PersonName'];}?>" type="text">
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
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                       <label  class="control-label">Shipping Address &nbsp;&nbsp;<input type="checkbox" disabled="true" id="Address_type" name="Address_type"  <?php echo (($FmData[0]['Address_type'] == 'same')  ? 'checked' : '');?> value="<?php if(isset($FmData[0]['Address_type'])){ echo $FmData[0]['Address_type'];}?>">&nbsp;Same As Billing Address</label></label>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingState" name="BillingState" readonly="true" value="<?php echo $FmData[0]['BillingState'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="BillingCountry" name="BillingCountry" readonly="true" value="<?php echo $FmData[0]['BillingCountry'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">PinCode</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BillingZip" name="BillingZip" value="<?php echo $FmData[0]['BillingZip'];?>" readonly="true" type="text"  onkeypress="return onlynumbers(event);" >
                    </div>
                </div>
             </div>
        </div> 
        <div class="row" style="margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Mobile No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MobileNo" name="MobileNo" readonly="true" placeholder="Enter Mobile No" value="<?php echo $FmData[0]['MobileNo'];?>" type="text"  onkeyup="validateField(this.id,'number');">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tendering Section</label>
                    <div class="col-sm-9">
                       <input class="form-control" id="TenderSection" name="TenderSection" value="<?php echo $FmData[0]['TenderSection'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Cust TenderNo</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="CustomerTenderNo" name="CustomerTenderNo" value="<?php echo $FmData[0]['CustomerTenderNo'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Opening Date</label>
                    <div class="col-sm-9">
                       <!-- <input class="form-control datepicker" id="OpeningDate" onkeypress="return onlyNumbernodecimal(event);"  name="OpeningDate" value="<?php if (isset($FmData[0]['OpeningDate'])){echo date('d-m-Y',strtotime($FmData[0]['OpeningDate']));}else{ echo date('d-m-Y');} ?>" type="text">-->
						 <input class="form-control" id="OpeningDate" name="OpeningDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['OpeningDate']) && ($FmData[0]['OpeningDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['OpeningDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Closing Date/Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ClosingDateTime" required autocomplete="off" onkeypress="return onlyNumbernodecimal(event);" onmouseover="ycsdates(this.id)" name="ClosingDateTime" value="<?php if($FmData[0]['ClosingDateTime']!='0000-00-00 00:00:00'){  echo $FmData[0]['ClosingDateTime']; }?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Bidding Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="BiddingType" id="BiddingType"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($biddingtype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['BiddingType']) {
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
                    <label  class="col-sm-3 control-label">Tender Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="TenderType" id="TenderType"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($tendertype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['TenderType']) {
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
                    <label  class="col-sm-3 control-label">Contract Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="ContractType" id="ContractType"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($contracttype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['ContractType']) {
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
                    <label  class="col-sm-3 control-label">Evaluation Criteria</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="EvaluationCriteria" name="EvaluationCriteria"  value="<?php echo $FmData[0]['EvaluationCriteria'];?>" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Bidding System</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="BiddingSystem" name="BiddingSystem"  value="<?php echo $FmData[0]['BiddingSystem'];?>" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Pre Bid Conference Required</label>
                    <div class="col-sm-9">
                     <select class="form-control" name="PreBidConfRequiredYN" id="PreBidConfRequiredYN" onchange="mandatory_add(this.value,1,'PreBidConfDate')" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($prebidconference_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['PreBidConfRequiredYN']) {
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
                    <label  class="col-sm-3 control-label">Pre Bid Conference Date</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="PreBidConfDate" name="PreBidConfDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)"  value="<?php if (isset($FmData[0]['PreBidConfDate']) && ($FmData[0]['PreBidConfDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['PreBidConfDate']));} ?>" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Inspection Agency</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="InspectionAgency" name="InspectionAgency"  value="<?php echo $FmData[0]['InspectionAgency'];?>" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tender Document Attachment</label>
                    <div class="col-sm-9">
                      <!--<input class="form-control" id="TenderDocAttachment" multiple name="TenderDocAttachment" value="<?php echo $FmData[0]['TenderDocAttachment'];?>" type="file" required>-->
                        <div class="files">
                            <span class="btn btn-default btn-files add_new_btn pt-2">
                                 Add Attachment <input type="file" <?php if(empty($FmDataattachment)){ echo 'required';} ?>  name="files2[]"  id="files2"  multiple="multiple" />
                            </span>
                        </div>
                        <div><p class="fileList2 fileList" style="margin-top:40px"><label class="head_cls">Uploaded Items</label></p></div>
                        <?php if($mode == 'edit' || $mode == 'view'){ ?>
                    
                                    <?php if(!empty($FmDataattachment)){ ?>
                                    
                                        <div class="files">
                                            
                                            <p class="fileList mt-3" id="imagedata">
                                             
                                    <?php  $i=0; foreach ($FmDataattachment as $datavalue):  ?>
                                    
                                            <?php if(isset($FmDataattachment[$i]['document_path']))?>
                                            
                                                <?php if($mode == 'edit'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataattachment[$i]['document_path']; ?>">
                                                <?php } else if($mode == 'view'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataattachment[$i]['document_path']; ?>" style="pointer-events: none;">
                                                 <?php }?>   
                                            <?php echo ltrim($FmDataattachment[$i]['document_path'],"resource/tender/."); ?>
                                            <span class="col-sm-6 col-lg-6 col-xl-6" >
                                                 <?php if($mode == 'edit'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','tender_attachments');$(imglist_<?php echo $i?>).remove();return false;">Remove
                                            </a>
                                                 <?php } else if($mode == 'view'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','tender_attachments');$(imglist_<?php echo $i?>).remove();return false;">
                                            </a>
                                                 <?php }?>  
                                            <span>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email Id</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Email" name="Email" value="<?php echo $FmData[0]['Email'];?>" type="text" readonly="true">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Bidding Done On</label>
                    <div class="col-sm-9">
                   <!--  <input class="form-control datepicker" id="BiddingDoneDate" name="BiddingDoneDate"  value="<?php if (isset($FmData[0]['BiddingDoneDate'])){echo date('d-m-Y',strtotime($FmData[0]['BiddingDoneDate']));}else{ echo date('d-m-Y');} ?>" type="text">-->
				   <input class="form-control" id="BiddingDoneDate" name="BiddingDoneDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['BiddingDoneDate']) && ($FmData[0]['BiddingDoneDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['BiddingDoneDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text">					 
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Procure From Approved Source</label>
                    <div class="col-sm-9">
                     <select class="form-control" name="ProcureApproveYN" id="ProcureApproveYN"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($procure_from_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['ProcureApproveYN']) {
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
                    <label  class="col-sm-3 control-label">Approving Agency</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="ApproveAgency" name="ApproveAgency"  value="<?php echo $FmData[0]['ApproveAgency'];?>" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tender Document Cost</label>
                    <div class="col-sm-9">
                     <!--<input class="form-control" id="TenderDocCost" name="TenderDocCost" multiple value="<?php echo $FmData[0]['TenderDocCost'];?>" type="file">   -->
                        <input class="form-control" id="TenderDocCost" name="TenderDocCost"  value="<?php echo $FmData[0]['TenderDocCost'];?>" type="text"> 
                    </div>
                </div>
                <div class="form-group"> 
                    <label  class="col-sm-3 control-label">EMD</label>
                    <div class="col-sm-9">
                     <input class="form-control" id="EMD" name="EMD"  value="<?php echo $FmData[0]['EMD'];?>" type="text">   
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">RA Enabled</label>
                    <div class="col-sm-9"> 
                     <select class="form-control" name="RAEnabledYN" id="RAEnabledYN"  onchange="add_or_remove_option(this.value,1,3,'RA Pending','BidResult')">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($ra_enabled_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['RAEnabledYN']) {
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
                    <label  class="col-sm-3 control-label">RA Date & Time</label>
                    <div class="col-sm-9">
                     <input class="form-control" name="RADateTime" id="RADateTime" onmouseover="ycsdates(this.id)" value="<?php if($FmData[0]['RADateTime']!='0000-00-00 00:00:00'){ echo $FmData[0]['RADateTime']; } ?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Regular / Developmental</label>
                    <div class="col-sm-9">
                     <select class="form-control" name="RegularOrDev" id="RegularOrDev"  >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($reg_or_dev_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['RegularOrDev']) {
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
                    <label  class="col-sm-3 control-label">Validity of Offer (Days)</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="ValidityOfferDays" name="ValidityOfferDays" value="<?php echo $FmData[0]['ValidityOfferDays'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Publishing Date</label>
                    <div class="col-sm-9">
                   <!--  <input class="form-control datepicker" id="PublishingDate" name="PublishingDate"  value="<?php if (isset($FmData[0]['PublishingDate'])){echo date('d-m-Y',strtotime($FmData[0]['PublishingDate']));}else{ echo date('d-m-Y');} ?>" type="text"> -->
                     <input class="form-control" id="PublishingDate" name="PublishingDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['PublishingDate']) && ($FmData[0]['PublishingDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['PublishingDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text">					 
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row" style="margin:20px">
             <div class="col-md-6">
                
                
                
             </div>
             <div class="col-md-6">
                
             </div>
        </div>
 <!-- Table row -->
        <div class="row" style="margin:20px;border:1px solid black;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>PL Code</th>
                            <th>Description</th>
                            <th>Consignee</th>
                            <th>Delivery Location</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>Request For Price</th>
                            <th>Price Received</th>
                            <th>Price Quoted</th>
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
                                            <input class="form-control" type="text" required id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['Title']){ echo $dataValue['Title']; } ?>"  placeholder="">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" required id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['PLCod']){ echo $dataValue['PLCod']; } ?>"  placeholder="">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['Description']){ echo $dataValue['Description']; } ?>" placeholder="">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['Consigne']){ echo $dataValue['Consigne']; } ?>" placeholder="">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Grade_<?php echo $tii; ?>" name="Grade_<?php echo $tii; ?>" value="<?php if($dataValue['DeliveryLocation']){ echo $dataValue['DeliveryLocation']; } ?>" placeholder="">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['Qty']){ echo $dataValue['Qty']; } ?>" placeholder="" onkeypress="return onlynumbers(event);">
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
                                        <select class="form-control" name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>">
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($requestforprice_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['RequestPriceYN']) {
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
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Rat_<?php echo $tii; ?>" name="Rat_<?php echo $tii; ?>" value="<?php if($dataValue['PriceReceived']){ echo $dataValue['PriceReceived']; } ?>" placeholder="">
                                        </div>
                                    </div>
                                </td><td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Rate_<?php echo $tii; ?>" name="Rate_<?php echo $tii; ?>" value="<?php if($dataValue['PriceQuoted']){ echo $dataValue['PriceQuoted']; } ?>" placeholder="">
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
                                        <input class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="ItemNo_1" name="ItemNo_1" value="" placeholder="" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_1" name="Note_1" value="" placeholder="">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Grade_1" name="Grade_1" value="" placeholder="">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" required placeholder="" onkeypress="return onlynumbers(event);">
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
                                    <select class="form-control" name="Amount_1" id="Amount_1">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($requestforprice_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Rat_1" name="Rat_1" value="" placeholder="">
                                </div>
         	                </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Rate_1" name="Rate_1" value="" placeholder="">
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
                    <label  class="col-sm-3 control-label">Techincal Specification</label>
                    <div class="col-sm-9">
                      <!--<input class="form-control" id="TechSpecAttchment" multiple name="TechSpecAttchment" value="<?php echo $FmData[0]['TechSpecAttchment'];?>" type="file" >-->
                      <div class="files">
                            <span class="btn btn-default btn-files add_new_btn pt-2">
                                 Add Specification <input type="file"  name="files3[]"  id="files3"  multiple />
                            </span>
                        </div>
                        <div><p class="fileList3 fileList" style="margin-top:40px"><label class="head_cls">Uploaded Items</label></p></div>
                        <?php if($mode == 'edit' || $mode == 'view'){ ?>
                    
                                    <?php if(!empty($FmDataspecification)){ ?>
                                    
                                        <div class="files">
                                            
                                            <p class="fileList mt-3" id="imagedata">
                                             
                                    <?php   $i=0; foreach ($FmDataspecification as $datavalue):  ?>
                                    
                                            <?php if(isset($FmDataspecification[$i]['document_path']))?>
                                            
                                             <?php if($mode == 'edit'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataspecification[$i]['document_path']; ?>">
                                                <?php } else if($mode == 'view'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataspecification[$i]['document_path']; ?>" style="pointer-events: none;">
                                                <?php }?>  
                                            <?php echo ltrim($FmDataspecification[$i]['document_path'],"resource/tender/."); ?>
                                            <span class="col-sm-6 col-lg-6 col-xl-6" >
                                               <?php if($mode == 'edit'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataspecification[$i]['ID']); ?>','tender_attachments');$(imglist_<?php echo $i?>).remove();return false;">Remove
                                            </a>
                                               <?php } else if($mode == 'view'){?>
                                                <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataspecification[$i]['ID']); ?>','tender_attachments');$(imglist_<?php echo $i?>).remove();return false;">
                                            </a>
                                               <?php }?>  
                                            <span>
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
                <div class="form-group">
                    <label  class="col-sm-3 control-label"</label>
                    <div class="col-sm-9">
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tender Status</label>
                    <div class="col-sm-9">
                       <select class="form-control" name="TenderStatus" id="TenderStatus" onchange="add_disabled(this.value,1,'BidResult')" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($tenderstatus_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['TenderStatus']) {
                                        $isselected = 'selected="selected"';
                                    }else if($v['ID'] == '1'){
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
                    <label  class="col-sm-3 control-label">Bid Result</label>
                    <div class="col-sm-9">
                       <?php if($mode=='edit' && $FmData[0]['TenderStatus']==1) { ?>
                        <select class="form-control" name="BidResult" id="BidResult" disabled="true">
                        <?php } else if($mode=='edit' && $FmData[0]['TenderStatus']!=1) { ?>
                        <select class="form-control" name="BidResult" id="BidResult" >
                        <?php } else { ?>
                        <select class="form-control" name="BidResult" id="BidResult" disabled="true">
                        <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($bidresult_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['BidResult']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                            <?php endforeach; ?>
                            <?php ?>
                        </select>
                    </div>
                </div>
             </div>
        </div>
        <div class="row" style="border:1px solid black;margin:20px">
            <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Remarks:</label>
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
                            <th>Date</th>
                            <th>Remarks</th>
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
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Field7_<?php echo $tii; ?>" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="Field7_<?php echo $tii; ?>"  value="<?php if($dataValue['RemarkDate']){ echo date('d-m-Y',strtotime($dataValue['RemarkDate']));} ?>"placeholder="" type="text" onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <textarea class="form-control" id="Field8_<?php echo $tii; ?>" name="Field8_<?php echo $tii; ?>" value=" " placeholder="" type="text" style="width:100%;height:35px;" ><?php if($dataValue['Remarks']){ echo $dataValue['Remarks']; } ?></textarea>
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
                                    <input class="form-control" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" id="Field7_1"  name="Field7_1"  value="" placeholder="" type="text"   onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
         	                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <textarea class="form-control" id="Field8_1" name="Field8_1" value="" placeholder="" type="text" style="width:100%;height:35px;" ></textarea>
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
   
<input type="hidden" value="" id="maxCount" name="maxCount">
<input type="hidden" value="" id="maxCountSub" name="maxCountSub" >

<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount(''),getCountSub()" onfocus="getCount(''),getCountSub()" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" onmouseover="getCount(''),getCountSub()" onfocus="getCount(''),getCountSub()" > Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
