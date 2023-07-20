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
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Order No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="PdnOrderNo" name="PdnOrderNo" value="<?php if(isset($FmData[0]['PdnOrderNo'])){echo $FmData[0]['PdnOrderNo'];}else{echo $PdnOrderNo;}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Enquiry No</label>
                    <div class="col-sm-9">
                        <?php if($mode=='add') {?>
                        <?php if(isset($FmData[0]['enquiry_ID']) && !empty($FmData[0]['enquiry_ID'])){  ?>
                        <select class="form-control" name="enquiryid" id="enquiryid" disabled >
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
                        <input id="enquiry_ID" name="enquiry_ID" value="<?php echo $FmData[0]['enquiry_ID'];?>"  type="hidden">
                        <?php } else { ?>
                        <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="production_agianst_enquiry(this.value);production_order_matdetails(this.value,'Matrix_Detail','Layup_Sequence')"  aria-hidden="true" required >
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
                        <?php } ?>
                        <?php }else {?>
                            <?php if(isset($FmData[0]['enquiry_ID']) && !empty($FmData[0]['enquiry_ID'])){  ?>
                        <select class="form-control" name="enquiryid" id="enquiryid" disabled >
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
                        <input id="enquiry_ID" name="enquiry_ID" value="<?php echo $FmData[0]['enquiry_ID'];?>"  type="hidden">
                        <?php } else { ?>
                        <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" onmouseover="ycssel()" onchange="production_agianst_enquiry(this.value);production_order_matdetails(this.value,'Matrix_Detail','Layup_Sequence')"  aria-hidden="true" required >
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
                        <?php } ?>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Division</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="pdn_dept" name="pdn_dept" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['pdn_dept'])){echo $FmData[0]['pdn_dept'];}?>" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Production Date</label> 
                    <div class="col-sm-9">
                        <input class="form-control" id="PdnOrderDate" name="PdnOrderDate" readonly="true" autocomplete="off" value="<?php if(isset($FmData[0]['PdnOrderDate'])){echo date('d-m-Y',strtotime($FmData[0]['PdnOrderDate'])); }else{ echo date('d-m-Y');}?>" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Cust Order No</label>
                    <div class="col-sm-9">
                         <input class="form-control" id="cust_order_no" name="cust_order_no" value="<?php if(isset($FmData[0]['CustOrderNo'])){echo $FmData[0]['CustOrderNo'];}?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Customer PO No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="cust_pono" name="cust_pono" readonly="true" autocomplete="off" value="<?php if(isset($Cust_Purchase_Data)){echo $Cust_Purchase_Data[0]['PurchaseorderNo'];}?>" type="text">
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
        <?php if(is_array($FmDetail_Data) && count($FmDetail_Data) >= 1) { ?>
		    <div class="row">
            <div class="col-xs-12 table-responsive" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product No </th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Unit Name</th>
							<th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                            </tr>
                    </thead>
                    <tbody id="custorderdet_listing_table" >
                            <?php 
                                if(is_array($FmDetail_Data) && count($FmDetail_Data) >= 1):
                                $tii = 1;
                                foreach ($FmDetail_Data as $dataValue):
                                   
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
											<input class="form-control" type="text" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['ProductNo']){ echo $dataValue['ProductNo']; } ?>" readonly>
										</div>
         	                        </div>
         	                    </td>
                                <td>                                      
                                    <div class="form-group">         
										<div class="col-sm-12">
										<input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['ProductName']){ echo $dataValue['ProductName']; } ?>"  readonly>
										</div>
         	                        </div>
                                </td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['PdtDescription']){ echo $dataValue['PdtDescription']; } ?>" readonly>
										</div>
									</div>
								</td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" readonly>
										</div>
									</div>
								</td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											  <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" readonly> 
										</div>
									</div>
								</td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Emp_<?php echo $tii; ?>" name="Emp_<?php echo $tii; ?>" value="<?php if($dataValue['Price']){ echo $dataValue['Price']; } ?>" readonly>
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
            <div id="CustorderdetData"></div>
        </div>
        <div class="box-body" style="border:1px solid black;margin:20px;padding:15px 10px;">
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
            	<?php if(is_array($ScheduleData) && count($ScheduleData) >= 1) { ?>
		<div class="row">
            <div class="col-xs-12 table-responsive" >
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            </tr>
                    </thead>
                    <tbody id="schedule_listing_table" >
                            <?php 
                                if(is_array($ScheduleData) && count($ScheduleData) >= 1):
                                $tii = 1;
                                foreach ($ScheduleData as $dataValue):
                                   
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
											<input class="form-control" type="text" id="Field4_<?php echo $tii; ?>" name="Field4_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" readonly>
										</div>
         	                        </div>
         	                    </td>
                                <td>                                      
                                    <div class="form-group">         
										<div class="col-sm-12">
										<input class="form-control" type="text" id="Field5_<?php echo $tii; ?>" name="Field5_<?php echo $tii; ?>" value="<?php if($dataValue['StartDate']){ echo date('d M Y',strtotime($dataValue['StartDate'])); } ?>"  readonly>
										</div>
         	                        </div>
                                </td>
								<td>                                      
									<div class="form-group">
										<div class="col-sm-12">
											<input class="form-control" type="text" id="Field6_<?php echo $tii; ?>" name="Field6_<?php echo $tii; ?>" value="<?php if($dataValue['EndDate']){ echo date('d M Y',strtotime($dataValue['EndDate'])); } ?>" readonly>
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
            <div id="ScheduleData">
            </div>
        </div>
        
        <div class="row" style="margin:20px;padding:15px 10px;">
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Drawing Path</label>
                        <div class="col-sm-9">
                         <input class="form-control" id="Drawing_Path" name="Drawing_Path" readonly="true" value="<?php if(isset($FmData[0]['Drawing_Path'])){echo $FmData[0]['Drawing_Path'];}?>" type="text">
                        </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Packing Instructions</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Packing_Instn" name="Packing_Instn" readonly="true" value="<?php echo $FmData[0]['Packing_Instn'];?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">3rd Party Inspection</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Thirdparty_Inspn" name="Thirdparty_Inspn" readonly="true" value="<?php echo $FmData[0]['Thirdparty_Inspn'];?>" type="text" >
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Layup Sequence</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Layup_Sequence" name="Layup_Sequence" value="<?php echo $FmData[0]['Layup_Sequence'];?>" type="text" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Matrix Details</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Matrix_Detail" name="Matrix_Detail"  value="<?php echo $FmData[0]['Matrix_Detail'];?>" type="text" readonly>
                    </div>
                </div>
                
            </div>
        </div> 
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
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Appoved By</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="ApprovedBy" name="ApprovedBy" readonly value="<?php if($approver_data){ echo $approver_data[0]['user_nicename']; } ?>" type="text">
                        <!--<select class="form-control js-example-basic-single" name="Approved_By" id="Approved_By" <?php if($FmData[0]['ApprovedBy']) { echo 'disabled';}else{ echo 'required';} ?>  onmouseover="ycssel()"  aria-hidden="true">
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
                        </select> -->
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
                 <?php if($mode == 'Confirm'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="confirm_submit_button" value="confirm"> Confirm </button>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
