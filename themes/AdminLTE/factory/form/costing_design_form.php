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
					   <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                              <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EnquiryID" id="EnquiryID" tabindex="1" onchange="Fetch_costing_Data(this.value,'enquiry','tender','tenderdetail','pdndepartment_ID','customer_ID','TenderSection','ClosingDateTime','InspectionAgency','ApproveAgency','RAEnabledYN','RegularOrDev','ValidityOfferDays','Title','ProcureApproveYN'
							  ,'Department','CustomerName','TenderingSection','ClosingDateTime','InspectionAgency','ApprovedAgency','RAEnabled','RegularDevelopmental','Validofofferdays','TitleID','ProcureFromApprovedSource');add_enable(this.value,'TitleID')" required>
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

			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Customer Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="CustomerName" name="CustomerName" value="<?php echo $FmData[0]['PersonName'];?>" type="text" readonly>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Closing date/Time</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ClosingDateTime" name="ClosingDateTime" value="<?php echo $FmData[0]['ClosingDateTime'];?>" type="text" readonly>  
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Procure From Approved Source</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ProcureFromApprovedSource" name="ProcureFromApprovedSource" value="<?php echo $FmData[0]['ProcureApproveYN'];?>" type="text" readonly>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">RA Enabled</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="RAEnabled" name="RAEnabled" value="<?php echo $FmData[0]['RAEnabledYN'];?>" type="text" readonly>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Valid of offer days</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Validofofferdays" name="Validofofferdays" value="<?php echo $FmData[0]['ValidityOfferDays'];?>" type="text" readonly>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">PL Code</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="PLCode" name="PLCode" value="<?php echo $FmData[0]['PLCod'];?>" type="text" readonly>
			           </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Consignee</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="Consignee" name="Consignee" value="<?php echo $FmData[0]['Consigne'];?>" type="text" readonly>
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Quantity</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Qty'];?>" type="text" readonly>
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Request for Price</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="RequestforPrice" name="RequestforPrice" value="<?php echo $FmData[0]['RequestPriceYN'];?>" type="text" readonly>
			           </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Schedule</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="Schedule" name="Schedule" value="<?php echo $FmData[0]['Schedule'];?>" type="text" readonly>
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">File Upload</label>
			           <div class="col-sm-9">
					   <?php if($mode=='add'){?>
						   <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()" required>
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['Description_Proof']; ?>" width="100px";>-->
						   <?php }else{?>
						   <input class="form-control" id="FileUpload" name="FileUpload" value="<?php echo $FmData[0]['FileUpload'];?>" type="file" onclick="show_imagelabel()">
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['Description_Proof']; ?>" width="100px";>-->
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

			   </div>
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Department</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="Department" name="Department" value="<?php echo $FmData[0]['DeptName'];?>" type="text" readonly> 
			          </div>
		          </div>
				     <!--<div class="form-group">
                       <label  class="col-sm-3 control-label"></label>
			           <div class="col-sm-9">
					    
			          </div>
		          </div>-->
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Tendering Section</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="TenderingSection" name="TenderingSection" value="<?php echo $FmData[0]['TenderSection'];?>" type="text" readonly> 
			          </div>
		          </div>
		             <div class="form-group">
                       <label  class="col-sm-3 control-label">Inspection Agency</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="InspectionAgency" name="InspectionAgency" value="<?php echo $FmData[0]['InspectionAgency'];?>" type="text" readonly> 
					  </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Approved Agency</label>
			           <div class="col-sm-9">
			              <input class="form-control" id="ApprovedAgency" name="ApprovedAgency" value="<?php echo $FmData[0]['ApproveAgency'];?>" type="text" readonly>
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Regular/Developmental</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="RegularDevelopmental" name="RegularDevelopmental" value="<?php echo $FmData[0]['RegularOrDev'];?>" type="text" readonly>
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Title</label>
			            <div class="col-sm-9">
						<?php if(isset($FmData[0]['TitleID'])) { ?>
                              <input id="TitleID" name="TitleID" value="<?php if($FmData[0]['TitleID']){echo $FmData[0]['TitleID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="TitleID" id="TitleID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="TitleID" id="TitleID" onchange="Fetch_costing_title_Data(this.value,'tenderdetail','PLCod','Description','Consigne','DeliveryLocation','Qty','UnitName','RequestPriceYN'
                                ,'PLCode','Description','Consignee','DeliveryLocation','Quantity','UOMofQuantity','RequestforPrice')" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($tenderdetail_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['TitleID']) {
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
                        <label  class="col-sm-3 control-label">Description</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="Description" name="Description" value="<?php echo $FmData[0]['Description'];?>" type="text" readonly>
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Delivery Location</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="DeliveryLocation" name="DeliveryLocation" value="<?php echo $FmData[0]['DeliveryLocation'];?>" type="text" readonly>
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">UOM of Quantity</label>
			            <div class="col-sm-9">
						<input class="form-control" id="UOMofQuantity" name="UOMofQuantity" value="<?php echo $FmData[0]['UnitName'];?>" type="text" readonly>
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Documents required</label>
			            <div class="col-sm-9">
						<input class="form-control" id="Documentsrequired" name="Documentsrequired" value="<?php echo $FmData[0]['Documentsrequired'];?>" type="text" readonly>
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Technical Specification</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="TechnicalSpecification" name="TechnicalSpecification" value="<?php echo $FmData[0]['TechnicalSpecification'];?>" type="text" readonly>
				      </div>
		           </div>
				   <div class="form-group">
                        <label  class="col-sm-3 control-label">Price to Quote</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="PricetoQuote" name="PricetoQuote" value="<?php echo $FmData[0]['PricetoQuote'];?>" type="text" >
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
	<style>
     input[type="file"]{
         color: transparent;
      }
  </style>
</section>         
            