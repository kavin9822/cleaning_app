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
                       <label  class="col-sm-3 control-label">Work Order No</label>
			           <div class="col-sm-9">
                            <input class="form-control" id="WorkOrderNo" name="WorkOrderNo" value="<?php if(isset($FmData[0]['WorkOrderNo'])){echo $FmData[0]['WorkOrderNo'];}else{echo $WorkOrderNo;}?>" type="text" readonly>
			          </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Re Work</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['Rework'])) { ?>
                              <input id="Rework" name="Rework" value="<?php if($FmData[0]['Rework']){echo $FmData[0]['Rework'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="Rework" id="Rework" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="Rework" id="Rework" onchange="add_disabled(this.value,2,'QualityID');" >
                       <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($Rework_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Rework']) {
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
                       <label  class="col-sm-3 control-label">Employee Type</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['EmployeeType'])) { ?>
                              <input id="EmployeeType" name="EmployeeType" value="<?php if($FmData[0]['EmployeeType']){echo $FmData[0]['EmployeeType'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeType" id="EmployeeType" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="EmployeeType" id="EmployeeType" onchange="add_disabled(this.value,1,'DCRequired');add_enable_workorder(this.value,1,'EmployeeID');add_enable_workorder1(this.value,2,'Subcontractor_ID')" required>
                       <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($Employeetype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EmployeeType']) {
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
                       <label  class="col-sm-3 control-label">Employee Name</label>
			           <div class="col-sm-9">
					   <?php if(isset($FmData[0]['EmployeeID'])) { ?>
                              <input id="EmployeeID" name="EmployeeID" value="<?php if($FmData[0]['EmployeeID']){echo $FmData[0]['EmployeeID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeID" id="EmployeeID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EmployeeID" id="EmployeeID" required disabled>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($employee_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['EmployeeID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EmpName']; ?>"><?php echo $v['EmpName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">No of Quantity</label>
			           <div class="col-sm-9">
                        <?php if($mode=='add'){?>
					   <input class="form-control" id="NoofQuantity" name="NoofQuantity" value="<?php echo $FmData[0]['NoofQuantity'];?>" type="text" onkeyup="workorder_quantity_Data(this.value,'workorder','StartingProductionNo','EndProdNo','StartingProductionNo','EndProdNo');workorder_quantity()" onkeypress="return onlyNumbernodecimal(event);">
                       <?php }else{?>
                        <input class="form-control" id="NoofQuantity" name="NoofQuantity" value="<?php echo $FmData[0]['NoofQuantity'];?>" type="text" readonly>
                        <?php }?>
			          </div>
		          </div>
			        <div class="form-group" style="margin-top:73px">
                       <label  class="col-sm-3 control-label">Name of the product</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['product_ID'])) { ?>
                              <input id="product_ID" name="product_ID" value="<?php if($FmData[0]['product_ID']){echo $FmData[0]['product_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="product_ID" id="product_ID" onchange="workorder_process_Data(this.value,'BOMProcessDetail','process_ID','ProcessID');add_enable(this.value,'ProcessID')" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($product_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['product_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Size of the Product</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ProductSize" name="ProductSize" value="<?php echo $FmData[0]['ProductSize'];?>" type="text">
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Colour</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Colour" name="Colour" value="<?php echo $FmData[0]['Colour'];?>" type="text">
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Lay up Sequence Material to be issued</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SequenceMaterialIssued" name="SequenceMaterialIssued" value="<?php echo $FmData[0]['SequenceMaterialIssued'];?>" type="text">
			           </div>
		          </div>
		              <div class="form-group">
                        <label  class="col-sm-3 control-label">Details</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="Details" name="Details" value="<?php echo $FmData[0]['Details'];?>" type="text">
				      </div>
		           </div>
			
			   </div>
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Po No</label>
			           <div class="col-sm-9">
					   <?php if(isset($FmData[0]['PdnOrderID'])) { ?>
                              <input id="PdnOrderID" name="PdnOrderID" value="<?php if($FmData[0]['PdnOrderID']){echo $FmData[0]['PdnOrderID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="PdnOrderID" id="PdnOrderID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="PdnOrderID" id="PdnOrderID" tabindex="1" onchange="workorder_product_Data(this.value,'customerorder_detail','Product_ID','product_ID');add_enable(this.value,'product_ID')" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($pdn_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['PdnOrderID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PdnOrderNo']; ?>"><?php echo $v['PdnOrderNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
				     <!--<div class="form-group">
                       <label  class="col-sm-3 control-label"></label>
			           <div class="col-sm-9">
					    
			          </div>
		          </div>-->
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">QC No</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['QualityID'])) { ?>
                              <input id="QualityID" name="QualityID" value="<?php if($FmData[0]['QualityID']){echo $FmData[0]['QualityID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="QualityID" id="QualityID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="QualityID" id="QualityID" onchange="work_order_qty(this.value,'NoofQuantity')" disabled>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($quality_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['QualityID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Qcno']; ?>"><?php echo $v['Qcno']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">DC Required</label>
			           <div class="col-sm-9">
                        <?php if($mode=='add'){?>
				            <select class="form-control" name="DCRequired" id="DCRequired" disabled required> 
                        <?php }else{?>
                            <select class="form-control" name="DCRequired" id="DCRequired" readonly required> 
                        <?php }?>
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['DCRequired']) && $FmData[0]['DCRequired']=='yes'){echo 'selected="selected"';} ?> value="yes" title="yes">yes</option>
                            <option <?php if(isset($FmData[0]['DCRequired']) && $FmData[0]['DCRequired']=='No'){echo 'selected="selected"';} ?> value="No" title="No">No </option>
                        </select>
				      </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Subcontractor Name</label>
			           <div class="col-sm-9">
					   <?php if(isset($FmData[0]['Subcontractor_ID'])) { ?>
                              <input id="Subcontractor_ID" name="Subcontractor_ID" value="<?php if($FmData[0]['Subcontractor_ID']){echo $FmData[0]['Subcontractor_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="Subcontractor_ID" id="Subcontractor_ID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="Subcontractor_ID" id="Subcontractor_ID" required disabled>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($subcontractor_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Subcontractor_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['SupplierName']; ?>"><?php echo $v['SupplierName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Starting Production No</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="StartingProductionNo" name="StartingProductionNo" value="<?php if(!($FmData[0]['StartingProductionNo'])){echo '0';} else { echo $FmData[0]['StartingProductionNo']; }?>" type="text" readonly>
			           </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Ending Prod No</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="EndProdNo" name="EndProdNo" value="<?php if(!($FmData[0]['EndProdNo'])){echo '0';} else { echo $FmData[0]['EndProdNo']; }?>" type="text" readonly>
			          </div>
		          </div>
                  <div class="form-group">
                        <label  class="col-sm-3 control-label">Process</label>
			            <div class="col-sm-9">
                        <?php if(isset($FmData[0]['ProcessID'])) { ?>
                              <input id="ProcessID" name="ProcessID" value="<?php if($FmData[0]['ProcessID']){echo $FmData[0]['ProcessID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="ProcessID" id="ProcessID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="ProcessID" id="ProcessID" onchange="Fetch_workorder_raw_Data(this.value,'RMName','Quantity1','UnitName','rawmaterial_ID','unit_ID')" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($process_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['ProcessID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProcessName']; ?>"><?php echo $v['ProcessName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Thickness</label>
			            <div class="col-sm-9">
			               <input class="form-control" id="Thickness" name="Thickness" value="<?php echo $FmData[0]['Thickness'];?>" type="text">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Design</label>
			            <div class="col-sm-9">
						<input class="form-control" id="Design" name="Design" value="<?php echo $FmData[0]['Design'];?>" type="text">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">To be completed On</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="CompletedDate" name="CompletedDate" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['CompletedDate']) && ($FmData[0]['CompletedDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['CompletedDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" required>
				      </div>
		          </div>
				      
				 </div>
		       </div>
			   <div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail" >
                    <thead>
                        <tr>
                            <th>Raw material</th>
                            <th>BOM Quantity</th>
                            <th>Workorder Quantity</th>
                            <th>UOM</th>
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
                           <input class="form-control" type="text" id="RMName" name="RMName"  value="<?php echo $value['RMName'];?>" readonly>
                            <input class="form-control" type="hidden" id="rawmaterial_ID<?php echo $tii; ?>" name="rawmaterial_ID<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>"   readonly style="width:230px">
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity1" name="Quantity1" value="<?php echo $value['Quantity1'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Workorder_qty" name="Workorder_qty" value="<?php echo $value['Quantity2'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="UnitName" name="UnitName" value="<?php echo $value['UnitName'];?>" readonly>
                           <input class="form-control" type="hidden" id="unit_ID<?php echo $tii; ?>" name="unit_ID<?php echo $tii; ?>" value="<?php if($dataValue['unit_ID']){ echo $dataValue['unit_ID']; } ?>"   readonly style="width:230px">
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
        <input type="hidden" value="1" id="maxCount" name="maxCount">
			   <div class="row" style="margin:20px">
				 <div class="col-lg-6">
				 <div class="form-group">
                        <label  class="col-sm-3 control-label">Remarks</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="Remarks" name="Remarks" value="<?php echo $FmData[0]['Remarks'];?>" type="text">
				      </div>
		           </div>
				   <div class="form-group">
                       <label  class="col-sm-3 control-label">Status</label>
			           <div class="col-sm-9">
				   <select class="form-control" name="Status" id="Status" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['Status']) && $FmData[0]['Status']=='1'){echo 'selected="selected"';} ?> value="1" title="Open">Open</option>
                        </select>
				      </div>
		          </div>
		    	</div>
				<div class="col-lg-6">
				<div class="form-group">
                        <label  class="col-sm-3 control-label">Created By</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="Createdby" name="Createdby" value="<?php if($preparedby){ echo $preparedby; } ?>" type="text" readonly>
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
            