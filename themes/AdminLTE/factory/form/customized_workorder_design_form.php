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
					          <select class="form-control" name="EmployeeID" id="EmployeeID" disabled required>
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
                       <label  class="col-sm-3 control-label">Name of the product</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ProductName" name="ProductName" value="<?php echo $FmData[0]['ProductName'];?>" type="text">
			           </div>
		          </div>
			        <div class="form-group" style="margin-top:62px">
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
                       <label  class="col-sm-3 control-label">Quantity</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" onkeypress="return onlynumbers(event);">
			           </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Lay up Sequence Material to be issued</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SequenceMaterialIssued" name="SequenceMaterialIssued" value="<?php echo $FmData[0]['SequenceMaterialIssued'];?>" type="text">
			           </div>
		          </div>
			
			   </div>
			   <div class="col-lg-6">
				     <!--<div class="form-group">
                       <label  class="col-sm-3 control-label"></label>
			           <div class="col-sm-9">
					    
			          </div>
		          </div>-->
				  <div class="form-group" style="margin-top:48px">
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
                       <label  class="col-sm-3 control-label">No of Quantity</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="NoOfQuantity" name="NoOfQuantity" value="<?php echo $FmData[0]['NoOfQuantity'];?>" type="text" onkeypress="return onlynumbers(event);">
			          </div>
		          </div>
			          <div class="form-group">
                        <label  class="col-sm-3 control-label">Process</label>
			            <div class="col-sm-9">
                            <input class="form-control" id="Process" name="Process" value="<?php echo $FmData[0]['Process'];?>" type="text">
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
				           <input class="form-control" id="CompletedDate" name="CompletedDate" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['CompletedDate']) && ($FmData[0]['CompletedDate']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['CompletedDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text">
				      </div>
		          </div>
				       <div class="form-group">
                        <label  class="col-sm-3 control-label">Details</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="Details" name="Details" value="<?php echo $FmData[0]['Details'];?>" type="text">
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
                            <th>Material Name</th>
							<th>Quantity</th>
                            <th>UOM</th>
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
                                         <select class="form-control" name="Field2_<?php echo $tii; ?>" id="Field2_<?php echo $tii; ?>" onchange="SqlbasedSelectdetail(this.value,this.id,'unit_','unit','rawmaterial','UnitName','unit_ID','rawmaterial');" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($rawmaterial_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['Rawmaterial_ID']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                    </div>
                                </td>
								<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Field3_<?php echo $tii; ?>" name="Field3_<?php echo $tii; ?>"
									    value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" required>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" required >
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
                                    <select class="form-control" name="Field2_1" id="Field2_1" onchange="SqlbasedSelectdetail(this.value,this.id,'unit_','unit','rawmaterial','UnitName','unit_ID','rawmaterial');" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($rawmaterial_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php endforeach; ?>
                                      </select>
                                    </div>
         	                    </div>
                            </td>
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Field3_1" name="Field3_1" value="" placeholder="Enter Quantity" onkeypress="return onlynumbers(event);" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <select class="form-control" name="unit_1" id="unit_1" required >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($unit_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                        <label  class="col-sm-3 control-label">Remarks</label>
			            <div class="col-sm-9">
				           <input class="form-control" id="Remarks" name="Remarks" value="<?php echo $FmData[0]['Remarks'];?>" type="text">
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
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" onmouseover="getRowCount()" value="edit"> Submit </button>
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
            