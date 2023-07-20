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
                       <label  class="col-sm-3 control-label">Customer Name</label>
			           <div class="col-sm-9">
			               <?php if(isset($FmData[0]['CustomerID'])) { ?>
                              <input id="CustomerID" name="CustomerID" value="<?php if($FmData[0]['CustomerID']){echo $FmData[0]['CustomerID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="CustomerID" id="CustomerID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="CustomerID" id="CustomerID" onchange="Fetch_customer_complaint_Data(this.value,'customer','customerorder_detail','PermntAddress1','Product_ID','PermntAddress1','CustomerOrderDetail_ID');add_enable(this.value,'CustomerOrderDetail_ID')" tabindex="1" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($customer_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['CustomerID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PersonName']; ?>"><?php echo $v['PersonName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Site Address</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SiteAddress" name="SiteAddress" value="<?php echo $FmData[0]['SiteAddress'];?>" type="text" tabindex="3" required>  
			           </div>
		          </div>
				    <div class="form-group">
					   <div class="title" style="margin-top:14px;">
                       <label  class="col-sm-3 control-label">Product Name</label>
					   </div>
			           <div class="col-sm-9">
			             <!-- <input class="form-control" id="ProductName" name="ProductName" value="<?php echo $FmData[0]['ProductName'];?>" type="text"  tabindex="5" required>-->
				 	<select class="form-control" name="CustomerOrderDetail_ID" id="CustomerOrderDetail_ID" tabindex="5" disabled="true" required>
                          <option value="" disabled selected style="display:none;">Select</option>
                           <?php
					       foreach ($product_data as $k => $v): 
                           if ($v['ID'] == $FmData[0]['CustomerOrderDetail_ID']) {
					       $isselected = 'selected="selected"';  
                           }else{
                           $isselected = '';
                           }
                   
					       ?>
					<option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
							<?php 
			        endforeach; ?>
                    </select>
			          </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Attended By</label>
			           <div class="col-sm-9">
					      <select class="form-control" name="Attended_userid" id="Attended_userid" tabindex="7" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($users_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Attended_userid']) {
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
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Complaint</label>
			           <div class="col-sm-9">
			               <select class="form-control" name="Complaint" id="Complaint" tabindex="9" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Complaint']) && $FmData[0]['Complaint']=='Warranty Complaint'){echo 'selected="selected"';} ?> value="Warranty Complaint" title="Warranty Complaint">Warranty Complaint</option>
                            <option <?php if(isset($FmData[0]['Complaint']) && $FmData[0]['Complaint']=='Supply Complaint'){echo 'selected="selected"';} ?> value="Supply Complaint" title="Supply Complaint">Supply Complaint</option>
                        </select>
			          </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Complaint Date</label>
			           <div class="col-sm-9">
					        <input class="form-control dp" id="ComplaintDate" onkeypress="return onlyNumbernodecimal(event);" name="ComplaintDate" value="<?php if (isset($FmData[0]['ComplaintDate'])){echo date('d-m-Y',strtotime($FmData[0]['ComplaintDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="11" required>
			          </div>
		          </div>
				    
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Root Cause Analysis</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="RootCauseAnalysis" name="RootCauseAnalysis" value="<?php echo $FmData[0]['RootCauseAnalysis'];?>" type="text" tabindex="13" required> 
					  </div>
		             </div>
					  <div class="form-group">
					   <div class="title" style="margin-top:14px;">
                       <label  class="col-sm-3 control-label">Preventive Action</label>
					   </div>
			           <div class="col-sm-9">
			               <input class="form-control" id="PreventiveAction" name="PreventiveAction" value="<?php echo $FmData[0]['PreventiveAction'];?>" type="text" tabindex="15" required> 
					  </div>
		             </div>
				      <div class="form-group">
                       <label  class="col-sm-3 control-label">File Upload</label>
			           <div class="col-sm-9">
					   <?php if($mode=='add'){?>
			               <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()" tabindex="17" required> 
					   <?php }else{?>
						   <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()" tabindex="17">
					   <?php }?>
					  </div>
		             </div>
					 <?php if($mode=='edit' && !empty($FmData[0]['FileUpload'])){ ?>
                     <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                        <a target="_blank" title="To view click here" href="<?php echo $home.'/'.$FmData[0]['FileUpload'];?>"><?php echo ltrim($FmData[0]['FileUpload'],'resource/images/.');?></a>
                     </div>
                  </div>
                     <?php }elseif($mode=='view' && !empty($FmData[0]['FileUpload'])){ ?>
                     <div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                        <a target="_blank" href="<?php echo $home.'/'.$FmData[0]['FileUpload'];?>"><?php echo ltrim($FmData[0]['FileUpload'],'resource/images/.');?></a>
                    </div>
                </div>
                     <?php }?>
				      <div class="form-group">
                       <label  class="col-sm-3 control-label">Remarks</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Remarks" name="Remarks" value="<?php echo $FmData[0]['Remarks'];?>" type="text" tabindex="19" required> 
					  </div>
		             </div>
				 </div>
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Address</label>
			           <div class="col-sm-9">
					      <input class="form-control" id="PermntAddress1" name="PermntAddress1" value="<?php echo $FmData[0]['PermntAddress1'];?>" type="text" tabindex="2" readonly> 
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Complaint RegNo</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Customer_ComplaintRegNo" name="Customer_ComplaintRegNo" value="<?php echo $FmData[0]['Customer_ComplaintRegNo'];?>" type="text" tabindex="4" onkeyup="validateField(this.id,'number');" required > 
			          </div>
		          </div>
		             <div class="form-group">
                       <label  class="col-sm-3 control-label">Quantity</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" tabindex="6" onkeyup="validateField(this.id,'number');" required> 
					  </div>
		             </div>
					  <div class="form-group">
                       <label  class="col-sm-3 control-label">Complaint Details</label>
			           <div class="col-sm-9">
					      <input class="form-control" id="ComplaintDetails" name="ComplaintDetails" value="<?php echo $FmData[0]['ComplaintDetails'];?>" type="text" tabindex="8" required> 
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Correction</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Correction" name="Correction" value="<?php echo $FmData[0]['Correction'];?>" type="text" tabindex="10" required> 
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Location</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Location" name="Location" value="<?php echo $FmData[0]['Location'];?>" type="text" tabindex="12" required> 
					  </div>
		             </div>
		             <div class="form-group">
                       <label  class="col-sm-3 control-label">Remarks From Customer</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="RemarksFromCustomer" name="RemarksFromCustomer" value="<?php echo $FmData[0]['RemarksFromCustomer'];?>" type="text" tabindex="14" required> 
			          </div>
		          </div>
					  <div class="form-group">
                       <label  class="col-sm-3 control-label">Corrective Action</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="CorrectiveAction" name="CorrectiveAction" value="<?php echo $FmData[0]['CorrectiveAction'];?>" type="text" tabindex="16" required> 
			          </div>
		          </div>
					  <div class="form-group">
                       <label  class="col-sm-3 control-label">ClosedOn</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="ClosedOn" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="ClosedOn" value="<?php if (isset($FmData[0]['ClosedOn'])){echo date('d-m-Y',strtotime($FmData[0]['ClosedOn']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="18" required>
			          </div>
		          </div>
					  <div class="form-group">
                       <label  class="col-sm-3 control-label">Status</label>
			           <div class="col-sm-9">
				   <select class="form-control" name="Status" id="Status" tabindex="20" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Status']) && $FmData[0]['Status']=='1'){echo 'selected="selected"';} ?> value="1" title="Open">Open</option>
                            <option <?php if(isset($FmData[0]['Status']) && $FmData[0]['Status']=='2'){echo 'selected="selected"';} ?> value="2" title="Closed">Closed </option>
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
                <button type ="submit" class="btn btn-success pull-right" onmouseover="getCount()" name="edit_submit_button" value="edit"> Submit </button>
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
  <style>
     input[type="file"]{
         color: transparent;
      }
  </style>
</section>         
            