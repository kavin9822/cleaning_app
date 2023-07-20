<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
  
            <!-- title row -->
        <div class="row"> 
            <div class="col-xs-12">
                <h2 class="page-header"> 
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:80px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
		<div class="row">
		   <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
        </div>
				
				<h3 style="text-align:center;"><strong>FEASIBILITY REVIEW REPORT</strong></h3>
				
		<div class="row" style="margin:20px">
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> Tender No</label>
				<div class="col-sm-8">
				    <?php if($mode=='add') {?>
				    <?php if(isset($FmData[0]['Tender_ID'])) { ?>
				    <input id="Tender_ID" name="Tender_ID" value="<?php if($FmData[0]['Tender_ID']){echo $FmData[0]['Tender_ID'];}?>"  type="hidden">
                    <select class="form-control js-example-basic-single" name="Tender_ID" id="Tender_ID" disabled>
                    <?php }else { ?>
					<select class="form-control js-example-basic-single" name="Tender_ID" id="Tender_ID" onchange="Fetch_feasibility_review_Data(this.value,'tenderdetail','tender','Title','Qty','users_ID','users_ID','Title','Quantity','Approved','Reviewed')"required>
				    <?php } ?>
                    <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($tender_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['Tender_ID']) {
                    $isselected = 'selected="selected"';
                    }else{
                    $isselected = '';
                    }
                    ?>
                    <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['TenderNo']; ?>"><?php echo $v['TenderNo']; ?></option>
                    <?php endforeach; ?>
                    </select>
				    <?php }else {?>
				    <?php if(isset($FmData[0]['Tender_ID'])) { ?>
				    <input id="Tender_ID" name="Tender_ID" value="<?php if($FmData[0]['Tender_ID']){echo $FmData[0]['Tender_ID'];}?>"  type="hidden">
                    <select class="form-control js-example-basic-single" name="Tender_ID" id="Tender_ID" disabled>
                    <?php }else { ?>
					<select class="form-control js-example-basic-single" name="Tender_ID" id="Tender_ID" onchange="Fetch_feasibility_review_Data(this.value,'tenderdetail','Title','Qty','Title','Quantity')"required>
				    <?php } ?>
                    <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($tender1_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['Tender_ID']) {
                    $isselected = 'selected="selected"';
                    }else{
                    $isselected = '';
                    }
                    ?>
                    <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['TenderNo']; ?>"><?php echo $v['TenderNo']; ?></option>
                    <?php endforeach; ?>
                    </select>
				    <?php }?>
				   </div>
			     </div>
		     </div>
		       <div class="col-sm-6">	
		       </div>
		       </div>
	  
	  <div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail" >
                    <thead>
                        <tr>
                            
                            <th>Title</th>
                            <th>Quantity</th>
                            </tr>
                    </thead>
                    <tbody>  
					        <?php 
                                foreach ($FmData as $value ):
                            ?>
  					<tr  id ="tender_row">
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Title" name="Title"  value="<?php echo $value['Title'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Qty" name="Qty" value="<?php echo $value['Qty'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                  </tr>
				  <?php
				  endforeach;
				  ?>
                </tbody>
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
			
	<div class="container mt-3"> 
		<div class="row">
			<table id="table" class="table">
				<thead>
					<tr>
						<th>Review Parameter</th>
						<th>Status</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Is Specification Clear & Legible / Customer Drawing readable</td>
						<td>
						
							<select class="form-control" name="Status" id="Status" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status']) && $FmData[0]['Status']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status']) && $FmData[0]['Status']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark" name="remark" value="<?php echo $FmData[0]['Remark'];?>"></td>
					</tr>
				<tr>
						<td>Are there any similar existing products / tender projects</td>
						<td>
						
							<select class="form-control" name="Status1" id="Status1" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status1']) && $FmData[0]['Status1']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status1']) && $FmData[0]['Status1']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No</option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark1" name="remark1" value="<?php echo $FmData[0]['Remark1'];?>"></td>
					</tr>
					
				<tr>
						<td>Are there any requirements resulting from market analysis?</td>
						<td>
						
							<select class="form-control" name="Status2" id="Status2" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status2']) && $FmData[0]['Status2']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status2']) && $FmData[0]['Status2']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark2" name="remark2" value="<?php echo $FmData[0]['Remark2'];?>"></td>
					</tr>
					<tr>
						<td>Can we meet the specified schedule ?</td>
						<td>
						
							<select class="form-control" name="Status3" id="Status3" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status3']) && $FmData[0]['Status3']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status3']) && $FmData[0]['Status3']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark3" name="remark3" value="<?php echo $FmData[0]['Remark3'];?>"></td>
					</tr>
					<tr>
						<td>Can the product be manufactured with the existing Manufacturing facility?</td>
						<td>
						
							<select class="form-control" name="Status4" id="Status4" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status4']) && $FmData[0]['Status4']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status4']) && $FmData[0]['Status4']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark4" name="remark4" value="<?php echo $FmData[0]['Remark4'];?>"></td>
					</tr>
					<tr>
						<td>Is the current manufacturing technology being sufficient / alternate technology required?</td>
						<td>
						
							<select class="form-control" name="Status5" id="Status5" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status5']) && $FmData[0]['Status5']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status5']) && $FmData[0]['Status5']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark5" name="remark5" value="<?php echo $FmData[0]['Remark5'];?>"></td>
					</tr>
					<tr>
						<td>Is there sufficient capacity to produce?</td>
						<td>
						
							<select class="form-control" name="Status6" id="Status6" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status6']) && $FmData[0]['Status6']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status6']) && $FmData[0]['Status6']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark6" name="remark6" value="<?php echo $FmData[0]['Remark6'];?>"></td>
					</tr>
					<tr>
						<td>Will dispatches of other products would be affected due to this product?</td>
						<td>
						
							<select class="form-control" name="Status7" id="Status7" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status7']) && $FmData[0]['Status7']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status7']) && $FmData[0]['Status7']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark7" name="remark7" value="<?php echo $FmData[0]['Remark7'];?>"></td>
					</tr>
					<tr>
						<td>Can we meet the delivery requirements of the customer and post-delivery requirements?</td>
						<td>
						
							<select class="form-control" name="Status8" id="Status8" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status8']) && $FmData[0]['Status8']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status8']) && $FmData[0]['Status8']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark8" name="remark8" value="<?php echo $FmData[0]['Remark8'];?>"></td>
				</tr> 
				<tr>
						<td>Do we possess the Technical Capability to produce this product?</td>
						<td>
						
							<select class="form-control" name="Status9" id="Status9" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status9']) && $FmData[0]['Status9']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status9']) && $FmData[0]['Status9']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark9" name="remark9" value="<?php echo $FmData[0]['Remark9'];?>"></td>
					</tr>
					<tr>
						<td>Any new raw materials or grade of raw materials are to be used?</td>
						<td>
						
							<select class="form-control" name="Status10" id="Status10" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status10']) && $FmData[0]['Status10']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status10']) && $FmData[0]['Status10']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark10" name="remark10" value="<?php echo $FmData[0]['Remark10'];?>"></td>
				<!-----------------------------------------   part 2  ------------------------------------------------>						
						
					</tr>
					<tr>
						<td>Any special process required?</td>
						<td>
						
							<select class="form-control" name="Status11" id="Status11" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status11']) && $FmData[0]['Status11']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status11']) && $FmData[0]['Status11']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark11" name="remark11" value="<?php echo $FmData[0]['Remark11'];?>"></td>
					</tr>
					<tr>
						<td>Is there any Special Characteristics or Specification required as per ASTM/IS/Technical Standard mentioned by customer?</td>
						<td>
						
							<select class="form-control" name="Status12" id="Status12" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status12']) && $FmData[0]['Status12']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status12']) && $FmData[0]['Status12']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark12" name="remark12" value="<?php echo $FmData[0]['Remark12'];?>"></td>
					</tr>
					<tr>
						<td>Are there any risks involved in terms of low production volume or any investments?</td>
						<td>
						
							<select class="form-control" name="Status13" id="Status13" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status13']) && $FmData[0]['Status13']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status13']) && $FmData[0]['Status13']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark13" name="remark13" value="<?php echo $FmData[0]['Remark13'];?>"></td>
					</tr>
					<tr>
						<td>Are the Control Method for Special Characteristics as per drawing / critical product characteristics available?</td>
						<td>
						
							<select class="form-control" name="Status14" id="Status14" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status14']) && $FmData[0]['Status14']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status14']) && $FmData[0]['Status14']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark14" name="remark14" value="<?php echo $FmData[0]['Remark14'];?>"></td>
					</tr>
					<tr>
						<td>Is there any special system / documentation required for the product?</td>
						<td>
						
							<select class="form-control" name="Status15" id="Status15" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status15']) && $FmData[0]['Status15']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status15']) && $FmData[0]['Status15']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark15" name="remark15" value="<?php echo $FmData[0]['Remark15'];?>"></td>
					</tr>
					<tr>
						<td>Is there any specific Special Training required to understand the process / </td>
						<td>
						
							<select class="form-control" name="Status16" id="Status16" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status16']) && $FmData[0]['Status16']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status16']) && $FmData[0]['Status16']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark16" name="remark16" value="<?php echo $FmData[0]['Remark16'];?>"></td>
					</tr>
					<tr>
						<td>Is there any special document/manual provided by the customer?</td>
						<td>
						
							<select class="form-control" name="Status17" id="Status17" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status17']) && $FmData[0]['Status17']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status17']) && $FmData[0]['Status17']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark17" name="remark17" value="<?php echo $FmData[0]['Remark17'];?>"></td>
					</tr>
					<tr>
						<td>Is there any specific requirement for packing / handling?</td>
						<td>
						
							<select class="form-control" name="Status18" id="Status18" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status18']) && $FmData[0]['Status18']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status18']) && $FmData[0]['Status18']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark18" name="remark18" value="<?php echo $FmData[0]['Remark18'];?>"></td>
					</tr>
					
				<!-----------------------------------------   part 3  ------------------------------------------------>								
					
					<tr>
						<td>Is there any specific requirement for shipping the product?</td>
						<td>
						
							<select class="form-control" name="Status19" id="Status19" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status19']) && $FmData[0]['Status19']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status19']) && $FmData[0]['Status19']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark19" name="remark19" value="<?php echo $FmData[0]['Remark19'];?>"></td>
					</tr>
					<tr>
						<td>Any other functional, non-functional and integration requirements?</td>
						<td>
						
							<select class="form-control" name="Status20" id="Status20" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status20']) && $FmData[0]['Status20']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status20']) && $FmData[0]['Status20']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark20" name="remark20" value="<?php echo $FmData[0]['Remark20'];?>"></td>
					</tr>
					<tr>
						<td>Any RAMS / LCC requirements?</td>
						<td>
						
							<select class="form-control" name="Status21" id="Status21" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status21']) && $FmData[0]['Status21']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status21']) && $FmData[0]['Status21']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark21" name="remark21" value="<?php echo $FmData[0]['Remark21'];?>"></td>
					</tr>
					<tr>
						<td>Any applicable statutory and regulatory requirements?</td>
						<td>
						
							<select class="form-control" name="Status22" id="Status22" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status22']) && $FmData[0]['Status22']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status22']) && $FmData[0]['Status22']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark22" name="remark22" value="<?php echo $FmData[0]['Remark22'];?>"></td>
					</tr>
					<tr>
						<td>Any Product Safety related requirements including hazardous or harmful factors?</td>
						<td>
						
							<select class="form-control" name="Status23" id="Status23" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status23']) && $FmData[0]['Status23']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status23']) && $FmData[0]['Status23']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark23" name="remark23" value="<?php echo $FmData[0]['Remark23'];?>"></td>
					</tr>
					<tr>
						<td>Any obsolescence requirements? (Like information coming from market, external providers, regulations)</td>
						<td>
						
							<select class="form-control" name="Status24" id="Status24" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status24']) && $FmData[0]['Status24']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status24']) && $FmData[0]['Status24']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark24" name="remark24" value="<?php echo $FmData[0]['Remark24'];?>"></td>
					</tr>
					<tr>
						<td>Any requirements regarding end of product life? (Like disposal, recycling)</td>
						<td>
						
							<select class="form-control" name="Status25" id="Status25" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status25']) && $FmData[0]['Status25']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status25']) && $FmData[0]['Status25']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark25" name="remark25" value="<?php echo $FmData[0]['Remark25'];?>"></td>
					</tr>
					
					
					
					<!--             Points to considered form our side (Other than stated by Customer)     -->
					
					<tr>
							<td><h4><strong>Points to considered form our side (Other than stated by Customer)</strong></h4> <td>
					</tr>
					<tr>
					
						<td>Any Points not stated by customer to be considered from MFI side</td>
						<td>
						
							<select class="form-control" name="Status26" id="Status26" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status26']) && $FmData[0]['Status26']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status26']) && $FmData[0]['Status26']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark26" name="remark26" value="<?php echo $FmData[0]['Remark26'];?>"></td>
					</tr>
					
					<tr>
						<td>Any differences between contract or order requirements differing from previously defined by customer?</td>
						<td>
						
							<select class="form-control" name="Status27" id="Status27" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status27']) && $FmData[0]['Status27']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status27']) && $FmData[0]['Status27']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark27" name="remark27" value="<?php echo $FmData[0]['Remark27'];?>"></td>
					</tr>
					
					<tr>
						<td>Any amendments and informed to be shared to our team members ?</td>
						<td>
						
							<select class="form-control" name="Status28" id="Status28" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status28']) && $FmData[0]['Status28']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status28']) && $FmData[0]['Status28']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark28" name="remark28" value="<?php echo $FmData[0]['Remark28'];?>"></td>
					</tr>
					<tr>
						<td>Any points to be considered for updating of Risks and Opportunities?</td>
						<td>
						
							<select class="form-control" name="Status29" id="Status29" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status29']) && $FmData[0]['Status29']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status29']) && $FmData[0]['Status29']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark29" name="remark29" value="<?php echo $FmData[0]['Remark29'];?>"></td>
					</tr>
					<tr>
						<td>Any additional points</td>
						<td>
						
							<select class="form-control" name="Status30" id="Status30" required> 
								<option value="" disabled selected style="display:none;">Select</option>
								<option <?php  if(isset($FmData[0]['Status30']) && $FmData[0]['Status30']=='Yes'){echo 'selected="selected"';} ?> value="Yes" title="Yes">Yes</option>
								<option <?php if(isset($FmData[0]['Status30']) && $FmData[0]['Status30']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
							</select>
						</td>
						<td><input class="form-control" type="text" id="remark30" name="remark30" value="<?php echo $FmData[0]['Remark30'];?>"></td>
					</tr>
					
				</tbody>
				
				     
			</table>
		
	</div>
</div> 
	                                    <!--        checkbox button    -->
			
			<h4><strong>Key Checkpoints pertaining to Execution</strong></h4>
				<div class="container">
					
						<ul class="list-group list-group-flush" style="list-style-type:none;">
							<div style="margin-right:100px;">
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check1" name="check1" value="check" <?php if($FmData[0] ['check1']=='check') echo "checked"; ?>> 
													Design & Development - New products / Concurrent products (Checklist to be used Product & Process design or Only Process design)
										</div>
									</li>
							<li class="list-group">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="check2" name="check2" value="check" <?php if($FmData[0] ['check2']=='check') echo "checked"; ?> >
										Tender Management (Checklist)
								</div>
							</li>
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check3" name="check3" value="check" <?php if($FmData[0] ['check3']=='check') echo "checked"; ?> >
										Project Management
										</div>
									</li>
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check4" name="check4" value="check" <?php if($FmData[0] ['check4']=='check') echo "checked"; ?> >
										Configuration Management (Checklist)
										</div>
									</li>
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check5" name="check5" value="check" <?php if($FmData[0] ['check5']=='check') echo "checked"; ?> >
										Change Configuration (Checklist)
										</div>
									</li>
									</div>
						</ul>
					</div>
					
										<!-- Conclusion-->
				
				<h4><strong>Conclusion</strong></h4>
					<div class="container">
				
						<ul class="list-group list-group-flush" style="list-style-type:none;">
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check6" name="check6" value="check" <?php if($FmData[0] ['check6']=='check') echo "checked"; ?> >
													Is feasible directly
										</div>
									</li>
							<li class="list-group">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="check7" name="check7" value="check" <?php if($FmData[0] ['check7']=='check') echo "checked"; ?> >
										Is not feasible
								</div>
							</li>
									<li class="list-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="check8" name="check8" value="check" <?php if($FmData[0] ['check8']=='check') echo "checked"; ?> >
										Is feasible is condition to the clarification of points
										</div>
									</li>
									<li class="list-group">
										
									</li>
						</ul>
						<input type="hidden" value='1'  id="multCheckON">
						 <div class="row" style="margin:20px">
							<div class="col-md-6">
								 <div class="form-group">
									<label  class="col-sm-3 control-label">Reason</label>
									<div class="col-sm-9">
											<textarea class="form-control" value="" id="Reason" rows="5" name="Reason"><?php echo $FmData[0]['Reason'];?> </textarea>
									</div>
								</div>
							</div>
						 </div>
						
				</div>
			
											<!--         letter  	  -->

			<div class="container">
				 <div class="row">
					  <div class="col-lg-6">
			 <div class="title" style="margin-top: 15px;">
					      <label> Regret letter sent to customer on </label>
							</div>
				     </div> 
                      <div class="col-lg-6">
					 </div>
                 </div>
			
			 <div class="row">
					  <div class="col-lg-6">
			 <div class="title" style="margin-top: 15px;">
					      <label> Reviewed By</label>
							</div>
				     </div> 
                      <div class="col-lg-6">
							<div class="title" style="margin-top: 15px;">
					      <label> Approved By</label>
						 </div>
					 </div>
                 </div>
			
			 <div class="row">
					  <div class="col-lg-6">
							<div class="title" style="margin-top: 15px;">
								<input class="form-control" id="Reviewed" name="Reviewed" value="<?php echo $FmData[0]['Reviewed_By'];?>" type="text" readonly>
							</div>
				     </div> 
                      <div class="col-lg-6">
							<div class="title" style="margin-top: 15px;">
								<input class="form-control" id="Approved" name="Approved" value="<?php echo $FmData[0]['user_nicename'];?>" type="text" readonly>
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
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" onmouseover="getCount()" onfocus="getCount()" > Submit </button>
                <?php } ?>
            </div>
        </div> 
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>