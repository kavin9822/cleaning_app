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
				<div class="col-md-6">
				   <div class="form-group">
				           <label class="col-sm-3">Subcontractor Name</label>
						   <div class="col-sm-9">
						     <?php if($mode=='add'){?>
						      <?php if(isset($FmData[0]['SupplierID'])) { ?>
                              <input id="SupplierID" name="SupplierID" value="<?php if($FmData[0]['SupplierID']){echo $FmData[0]['SupplierID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="Supplier" id="Supplier" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="SupplierID" id="SupplierID" tabindex="1" onchange="Fetch_supplier_evaluation_Data(this.value,'supplier','ContactPerson','ContactNumber','AddressLine1','ContactPerson','ContactNumber','Address')" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($supplier_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['SupplierID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['SupplierName']; ?>"><?php echo $v['SupplierName']; ?></option>
                              <?php endforeach; ?>
                              </select>
							 <?php }else{?>
							 <?php if(isset($FmData[0]['SupplierID'])) { ?>
                              <input id="SupplierID" name="SupplierID" value="<?php if($FmData[0]['SupplierID']){echo $FmData[0]['SupplierID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="Supplier" id="Supplier" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="SupplierID" id="SupplierID" tabindex="1" onchange="Fetch_supplier_evaluation_Data(this.value,'supplier','ContactPerson','ContactNumber','AddressLine1','ContactPerson','ContactNumber','Address')">
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($supplier1_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['SupplierID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['SupplierName']; ?>"><?php echo $v['SupplierName']; ?></option>
                              <?php endforeach; ?>
                              </select>
							  <?php }?>
				           </div>
						</div>
                    <div class="form-group">
				           <label class="col-sm-3">Contact Number</label>
						   <div class="col-sm-9">  
                              <input class="form-control" id="ContactNumber" name="ContactNumber" value="<?php echo $FmData[0]['ContactNumber'];?>" type="text" onkeyup="validateField(this.id,'number');" maxlength="10" tabindex="3" readonly> 
					       </div>
                        </div>
					 </div>
			    <div class="col-md-6">
				    <div class="form-group">
				           <label class="col-sm-3">Contact Person</label>
						   <div class="col-sm-9">   
					          <input class="form-control" id="ContactPerson" name="ContactPerson" value="<?php echo $FmData[0]['ContactPerson'];?>" type="text" tabindex="2" readonly>
				           </div>
						</div>   
                    <div class="form-group">
				           <label class="col-sm-3"> Address</label>
						   <div class="col-sm-9">   
					          <input class="form-control" id="Address" name="Address" value="<?php echo $FmData[0]['AddressLine1'];?>" type="text" tabindex="4" readonly>	
					       </div>
                        </div>
					  </div>
					</div>	
					
					 <div class="row" style="margin:20px">
					     <div class="col-lg-12">
						        <label>Rating Criteria: 1 – Poor, 2 – Moderate, 3 –Good, 4-Very Good, 5- Excellent</label>
							</div>
				    </div>
					
			        <div class="row" style="margin:20px">
					     <div class="col-lg-3">
						        <label>Evaluation Criteria</label>
							</div>
						 <div class="col-lg-1">
						        <label>Max points</label>	
						    </div>
					     <div class="col-lg-4">
						        <label>Actual Rated</label>
						    </div>
						 <div class="col-lg-4">
						        <label>Remarks</label>
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						        <label>Subcontractors’ capacity assessment</label>
							</div>
						 <div class="col-lg-1">
						   	    <label>25</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated" name="ActualRated" value="<?php echo round($FmData[0]['ActualRated']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="5">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks0" name="Remarks0" value="<?php echo $FmData[0]['Remarks0'];?>" type="text" tabindex="6">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Does the Subcontractor have enough manpower resources to supply of manpower uninterruptedly as per the applicable age group? </label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated1" name="ActualRated1" value="<?php echo round($FmData[0]['ActualRated1']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="7">	
						    </div>
						 <div class="col-lg-4">
						     <input class="form-control" id="Remarks1" name="Remarks1" value="<?php echo $FmData[0]['Remarks1'];?>" type="text" tabindex="8">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Current financial turnover?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated2" name="ActualRated2" value="<?php echo round($FmData[0]['ActualRated2']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="9">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks2" name="Remarks2" value="<?php echo $FmData[0]['Remarks2'];?>" type="text" tabindex="10">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Does Subcontractors have financial stability and capacity to for the consistent supply chain?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated3" name="ActualRated3" value="<?php echo round($FmData[0]['ActualRated3']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="11">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks3" name="Remarks3" value="<?php echo $FmData[0]['Remarks3'];?>" type="text" tabindex="12">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Supplier has multi-disciplinary approach on decision making?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated4" name="ActualRated4" value="<?php echo round($FmData[0]['ActualRated4']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="13">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks4" name="Remarks4" value="<?php echo $FmData[0]['Remarks4'];?>" type="text" tabindex="14">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Any Standby requirement and provide manpower to multiple geographical location? Can support with multi linguistic resources?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated5" name="ActualRated5" value="<?php echo round($FmData[0]['ActualRated5']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="15">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks5" name="Remarks5" value="<?php echo $FmData[0]['Remarks5'];?>" type="text" tabindex="16">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Technology, Competency and Customer Service Assessment</label> 
							</div>
						 <div class="col-lg-1">
						    <label>35</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated6" name="ActualRated6" value="<?php echo round($FmData[0]['ActualRated6']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="17">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks6" name="Remarks6" value="<?php echo $FmData[0]['Remarks6'];?>" type="text" tabindex="18">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Subcontractor’s resources can understand the client technical & functional requirements And similar work experience they have?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>10</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated7" name="ActualRated7" value="<?php echo round($FmData[0]['ActualRated7']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="19">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks7" name="Remarks7" value="<?php echo $FmData[0]['Remarks7'];?>" type="text" tabindex="20">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Adequacy of current resources - Are Qualified and competent persons available (Age, Experience & Skill)?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated8" name="ActualRated8" value="<?php echo round($FmData[0]['ActualRated8']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="21">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks8" name="Remarks8" value="<?php echo $FmData[0]['Remarks8'];?>" type="text" tabindex="22">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Subcontractor’s resources can work at project site / Remote area?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated9" name="ActualRated9" value="<?php echo round($FmData[0]['ActualRated9']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="23">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks9" name="Remarks9" value="<?php echo $FmData[0]['Remarks9'];?>" type="text" tabindex="24">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Service Capability - How monitored & controlled?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated10" name="ActualRated10" value="<?php echo round($FmData[0]['ActualRated10']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="25">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks10" name="Remarks10" value="<?php echo $FmData[0]['Remarks10'];?>" type="text" tabindex="26">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Does Subcontractor have change management process?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated11" name="ActualRated11" value="<?php echo round($FmData[0]['ActualRated11']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="27">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks11" name="Remarks11" value="<?php echo $FmData[0]['Remarks11'];?>" type="text" tabindex="28">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Does Subcontractor have disaster preparedness and contingency plans for necessary contingency areas?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated12" name="ActualRated12" value="<?php echo round($FmData[0]['ActualRated12']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="29">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks12" name="Remarks12" value="<?php echo $FmData[0]['Remarks12'];?>" type="text" tabindex="30">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Material handling, Product Safety, Transportation and Housekeeping</label> 
							</div>
						 <div class="col-lg-1">
						    <label>20</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated13" name="ActualRated13" value="<?php echo round($FmData[0]['ActualRated13']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="31">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks13" name="Remarks13" value="<?php echo $FmData[0]['Remarks13'];?>" type="text" tabindex="32">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Subcontractor has methods for working environment clean & well to be maintained?</label> 
							</div>
						 <div class="col-lg-1">
						   <label>10</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated14" name="ActualRated14" value="<?php echo round($FmData[0]['ActualRated14']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="33">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks14" name="Remarks14" value="<?php echo $FmData[0]['Remarks14'];?>" type="text" tabindex="34">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Subcontractor has methods for transportation of materials as per the scope and material handling & adhere to product safety requirements?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>10</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated15" name="ActualRated15" value="<?php echo round($FmData[0]['ActualRated15']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="35">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks15" name="Remarks15" value="<?php echo $FmData[0]['Remarks15'];?>" type="text" tabindex="36">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Applicable Statutory and Regulatory Requirements</label> 
							</div>
						 <div class="col-lg-1">
						   <label>10</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated16" name="ActualRated16" value="<?php echo round($FmData[0]['ActualRated16']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="37">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks16" name="Remarks16" value="<?php echo $FmData[0]['Remarks16'];?>" type="text" tabindex="38">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Is the supplier registered with GST?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated17" name="ActualRated17" value="<?php echo round($FmData[0]['ActualRated17']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="39">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks17" name="Remarks17" value="<?php echo $FmData[0]['Remarks17'];?>" type="text" tabindex="40">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Has subcontractors identified all applicable statutory requirements and complying to those requirements?</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated18" name="ActualRated18" value="<?php echo round($FmData[0]['ActualRated18']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="41">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks18" name="Remarks18" value="<?php echo $FmData[0]['Remarks18'];?>" type="text" tabindex="42">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Supplier QMS Status including Risk management</label> 
							</div>
						 <div class="col-lg-1">
						    <label>10</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated19" name="ActualRated19" value="<?php echo round($FmData[0]['ActualRated19']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="43">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks19" name="Remarks19" value="<?php echo $FmData[0]['Remarks19'];?>" type="text" tabindex="44">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Supplier has implemented QMS and has valid QMS Certification (ISO 9001)</label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated20" name="ActualRated20" value="<?php echo round($FmData[0]['ActualRated20']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="45">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks20" name="Remarks20" value="<?php echo $FmData[0]['Remarks20'];?>" type="text" tabindex="46">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Subcontractors Risk assessment relevant to product conformity requirements and uninterrupted supply of labors </label> 
							</div>
						 <div class="col-lg-1">
						    <label>5</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated21" name="ActualRated21" value="<?php echo round($FmData[0]['ActualRated21']);?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="subcontractormax()" tabindex="47">	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks21" name="Remarks21" value="<?php echo $FmData[0]['Remarks21'];?>" type="text" tabindex="48">	
						    </div>
				    </div>
					
					<div class="row" style="margin:20px">
					     <div class="col-lg-3">
						         <label>Grand Total (1+2+3+4+5)</label> 
							</div>
						 <div class="col-lg-1">
						   <label>100</label>
						    </div>
					     <div class="col-lg-4">
						   <input class="form-control" id="ActualRated22" name="ActualRated22" value="<?php echo round($FmData[0]['ActualRated22']);?>" type="text" onkeypress="return onlynumbers(event);" tabindex="49" readonly>	
						    </div>
						 <div class="col-lg-4">
						   <input class="form-control" id="Remarks22" name="Remarks22" value="<?php echo $FmData[0]['Remarks22'];?>" type="text" tabindex="50">	
						    </div>
				    </div>
					
					<div class="row" style="border:1px solid black;padding-left:5px;padding-bottom:40px;margin-top:20px;margin-left:20%;;margin-right:20%">
					       <div class="row">
						       <div class="col-lg-12">
						         <label>Assessment Result :</label>
							 </div>
						   </div>
						   <div class="row" style="margin-right:20px">
						         <div class="col-lg-6">
								    <label>Status:</label>
							    </div>
								 <div class="col-lg-6">
								    <select class="form-control" name="Subcontractor_Status" id="Subcontractor_Status" tabindex="51" required> 
                                      <option value="" disabled selected style="display:none;">Select</option>
                                      <option <?php  if(isset($FmData[0]['Subcontractor_Status']) && $FmData[0]['Subcontractor_Status']=='1'){echo 'selected="selected"';} ?> value="1" title="Approved">Approved</option>
                                      <option <?php if(isset($FmData[0]['Subcontractor_Status']) && $FmData[0]['Subcontractor_Status']=='2'){echo 'selected="selected"';} ?> value="2" title="Not Approved">Not Approved </option>
                                 </select>
					          </div>
					       </div>
						    <div class="row" style="margin-right:20px;margin-top:20px">
						         <div class="col-lg-6">
								    <label>Approved now subject to action completion on :</label>
							    </div>
								 <div class="col-lg-6">
								   <input class="form-control" id="Action" name="Action" value="<?php echo $FmData[0]['Action'];?>" type="text" tabindex="52">
					          </div>
					       </div>
						   <div class="row" style="margin-right:20px;margin-top:20px">
						         <div class="col-lg-6">
								    <label>Evaluated Team :</label>
							    </div>
								 <div class="col-lg-6">
								   <input class="form-control" id="EvaluatedTeam" name="EvaluatedTeam" value="<?php echo $FmData[0]['EvaluatedTeam'];?>" type="text" tabindex="53">
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
            