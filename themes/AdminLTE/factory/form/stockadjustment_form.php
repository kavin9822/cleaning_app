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
				
				
				<!-- End -->
				
				<!-- before table --> 
				
<div class="container" style="margin-top:20px;">		
				
<div class="row" >
		<div class="col-sm-6">	

			
		</div>
		<div class="col-sm-6">	
				<!-- <div class="form-group">
				<label class="col-sm-4 control-label">Store</label>
				<div class="col-sm-8">
						
                        <select class="form-control js-example-basic-single" name="store" id="store"  onmouseover="ycssel()" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($material_inward_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['store']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MaterialNo']; ?>"><?php echo $v['MaterialNo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                
                    </div>
			</div> -->
		</div>
		</div>	


	<div class="row" >
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Stock Return No.</label>
                <div class="col-sm-8">

                        <!-- <input class="form-control" id="stockreturn_no" name="stockreturn_no" value="<?php echo $FmData[0]['stockreturn_no'];?>" type="text" readonly> -->
                        <input class="form-control" id="stock_return_no" name="stock_return_no" value="<?php if(isset($FmData[0]['stock_return_no'])){echo $FmData[0]['stock_return_no'];}else{echo $stock_return_no;}?>" type="text"  readonly>

                <!-- <select class="form-control js-example-basic-single" name="stockreturn_no" id="stockreturn_no"  onmouseover="ycssel()" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($material_inward_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['stock_return_no']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MaterialNo']; ?>"><?php echo $v['MaterialNo']; ?></option>
                            <?php endforeach; ?>
                            </select> -->
				
                                        </div>
			</div>
		</div>
		<!-- <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Sub Catagory</label>
				<div class="col-sm-8">
                <select class="form-control js-example-basic-single" name="item_type" id="item_type"  onmouseover="ycssel()" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawmaterialsubtype_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['item_type']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RawMaterialSubType']; ?>"><?php echo $v['RawMaterialSubType']; ?></option>
                            <?php endforeach; ?>
                            </select>
            
            </div>
			</div>
		</div> -->
        <!--  -->
        <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Category Type</label>
				<div class="col-sm-8">
                <?php if(isset($FmData[0]['category_type_id'])) { ?>
                              <input id="category_type_id" name="category_type_id" value="<?php if($FmData[0]['category_type_id']){echo $FmData[0]['category_type_id'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="category_type_id" id="category_type_id" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="category_type_id" id="category_type_id" onchange="rawmaterialcat_Data(this.value,'item_type');add_enable(this.value,'item_type')" required >
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($rawmaterialtype_tab_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['category_type_id']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RawMaterialType']; ?>"><?php echo $v['RawMaterialType']; ?></option>
                              <?php endforeach; ?>
                              </select>
				</div>
			</div>
		</div>
        <!--  -->
    </div>	
    	<div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Item Name</label>
				<div class="col-sm-8">
						<!-- <input class="form-control" id="Company" name="Company" value="<?php echo $FmData[0]['CompanyName'];?>" type="text" readonly> -->
                        <!-- <input class="form-control" id="workorder_no" name="workorder_no" value="<?php echo $FmData[0]['workorder_no'];?>" type="text" > -->
                        <select class="form-control js-example-basic-single" name="item_name" id="item_name"  onmouseover="ycssel()" onchange="Fetch_stockadjust_Data(this.value,'batch_no','availabel_qty')" required disabled>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawmaterial_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['item_name']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                            <?php endforeach; ?>
                            </select>



                    </div>	
			</div>
		</div>
		<!--  -->

        <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Sub Catagory</label>
				<div class="col-sm-8">
				<!-- <input class="form-control" id="pono" name="pono" value="<?php echo $FmData[0]['PONo'];?>" type="text" readonly>		 -->
                <select class="form-control js-example-basic-single" name="item_type" id="item_type"  onmouseover="ycssel()" onchange="rawmaterial_Data(this.value,'item_name'); add_enable(this.value,'item_name');" required disabled>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawmaterialsubtype_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['item_type']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RawMaterialSubType']; ?>"><?php echo $v['RawMaterialSubType']; ?></option>
                            <?php endforeach; ?>
                            </select>
            
            </div>
			</div>
		</div>
        <!--  -->
	</div>	

<!--  -->
<div class="row" >
		<div class="col-sm-6">	
				 <div class="form-group">
                       <label  class="col-sm-4 control-label">Employee Type</label>
			           <div class="col-sm-8">
                       <?php if(isset($FmData[0]['EmployeeType'])) { ?>
                              <input id="EmployeeType" name="EmployeeType" value="<?php if($FmData[0]['EmployeeType']){echo $FmData[0]['EmployeeType'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeType" id="EmployeeType" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="EmployeeType" id="EmployeeType" onchange="add_enable_workorder(this.value,1,'EmployeeID');add_enable_workorder1(this.value,2,'Subcontractor_ID')" required>
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
		</div>
		<div class="col-sm-6">	
			<div class="form-group">
                       <label  class="col-sm-4 control-label">Employee Name</label>
			           <div class="col-sm-8">
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
                  </div>
                  </div>
<!--  -->
                  <div class="row" >
		<div class="col-sm-6">	
				 <div class="form-group">
			
                       <label  class="col-sm-4 control-label">Batch No</label>
			           <div class="col-sm-8">
					   <input class="form-control" id="batch_no" name="batch_no" value="<?php echo $FmData[0]['batch_no'];?>" type="text" readonly>
			          </div>
		          </div> 
                            </div>
                            <div class="col-sm-6">	
			                <div class="form-group">
                       <label  class="col-sm-4 control-label">Subcontractor Name</label>
                       <div class="col-sm-8">
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
		          </div>
                  </div>
    <!--  -->
    <div class="row" >
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Production Order NO</label>
                <div class="col-sm-8">

                        <!-- <input class="form-control" id="stockreturn_no" name="stockreturn_no" value="<?php echo $FmData[0]['stockreturn_no'];?>" type="text" readonly> -->
                        <!-- <input class="form-control" id="stock_return_no" name="stock_return_no" value="<?php if(isset($FmData[0]['stock_return_no'])){echo $FmData[0]['stock_return_no'];}else{echo $stock_return_no;}?>" type="text"  readonly> -->

                 <select class="form-control js-example-basic-single" name="prod_order_no" id="prod_order_no" onmouseover="ycssel()" onchange="stockadjustment_wrd(this.value,'work_order_no'); add_disabled_det(this.id,'work_order_no')" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($productionorder_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['prod_order_no']) {
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
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">work Order no.</label>
				<div class="col-sm-8">
				<!-- <input class="form-control" id="pono" name="pono" value="<?php echo $FmData[0]['PONo'];?>" type="text" readonly>		 -->
                <select class="form-control js-example-basic-single" name="work_order_no" id="work_order_no"  onmouseover="ycssel()" disabled="true" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($workorder_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['work_order_no']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['WorkOrderNo']; ?>"><?php echo $v['WorkOrderNo']; ?></option>
                            <?php endforeach; ?>
                            </select>
            
            </div>
			</div>
		</div>
    </div>
<!--  -->

		<div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Availabel Quantity</label>
				<div class="col-sm-8">
						<!-- <input class="form-control" id="Company" name="Company" value="<?php echo $FmData[0]['CompanyName'];?>" type="text" readonly> -->
                        <input class="form-control" id="availabel_qty" name="availabel_qty" value="<?php echo $FmData[0]['availabel_qty'];?>" type="text" readonly>
            
                    </div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Adjustment Type:</label>
				<div class="col-sm-8">
                        <!--<select class="form-control" name="adjustment_type" id="adjustment_type" required> -->
                        <!--    <option value="" disabled selected style="display:none;">Select</option>-->
                        <!--    <option <?php  if(isset($FmData[0]['adjustment_type']) && $FmData[0]['adjustment_type']=='stockin'){echo 'selected="selected"';} ?> value="stockin" title="stockin">StockIN</option>-->
                        <!--    <option <?php if(isset($FmData[0]['adjustment_type']) && $FmData[0]['adjustment_type']=='stockout'){echo 'selected="selected"';} ?> value="stockout" title=" stockout">StockOut</option>-->
                        <!--</select>-->
                         <?php if(isset($FmData[0]['adjustment_type'])) { ?>
                              <input id="adjustment_type" name="adjustment_type" value="<?php if($FmData[0]['adjustment_type']){echo $FmData[0]['adjustment_type'];}?>"  type="hidden" >
                              <select class="form-control js-example-basic-single" name="adjustment_type" id="adjustment_type" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="adjustment_type" id="adjustment_type"  onchange="add_disabled_dett(this.id,'quantity_to_be_adjust');">
                       <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($adjustment_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['adjustment_type']) {
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
		</div>
		</div>
        <div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Quantity To Be Adjusted</label>
				<div class="col-sm-8">
                        <!--<select class="form-control" name="quantity_to_be_adjust" id="quantity_to_be_adjust" required> -->
                        <!--    <option value="" disabled selected style="display:none;">Select</option>-->
                        <!--    <option <?php  if(isset($FmData[0]['quantity_to_be_adjust']) && $FmData[0]['quantity_to_be_adjust']=='stockin'){echo 'selected="selected"';} ?> value="stockin" title="stockin">StockIN</option>-->
                        <!--    <option <?php if(isset($FmData[0]['quantity_to_be_adjust']) && $FmData[0]['quantity_to_be_adjust']=='stockout'){echo 'selected="selected"';} ?> value="stockout" title=" stockout">StockOut</option>-->
                        <!--</select>-->
                        
                         <?php if($mode=='add'){?>
                        
                         <input class="form-control" id="quantity_to_be_adjust" name="quantity_to_be_adjust" value="<?php echo $FmData[0]['quantity_to_be_adjust'];?>" type="text" onkeypress="return onlynumbers(event);" onkeyup="add_disabled_val();nozero(this.id);" disabled="true" required>
                      <?php  } else{ ?>
                            <input class="form-control" id="quantity_to_be_adjust" name="quantity_to_be_adjust" value="<?php echo $FmData[0]['quantity_to_be_adjust'];?>" type="text" readonly>
                            <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php echo $FmData[0]['quantity_to_be_adjust'];?>"   readonly style="width:230px">
                            <?php }?> 

                    </div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Reason For Adjustment</label>
				<div class="col-sm-8">
						<input class="form-control" id="reasone_for_adjust" name="reasone_for_adjust" value="<?php echo $FmData[0]['reasone_for_adjust'];?>" type="text" >
				</div>
			</div>
		</div>
		</div>
        <div class="row" >
		<div class="col-sm-6">	

			
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">comment</label>
				<div class="col-sm-8">
						<input class="form-control" id="comment" name="comment" value="<?php echo $FmData[0]['comment'];?>" type="text" >
				</div>
			</div>
		</div>
		</div>
		
		
		
   
		
		
		


</div>				
				
	<!-- Table -->		
    
                <!-- COPY tHE tABLE INTO WINDOWS FOLDER  nAME IS fOLDER2 -->
	<!-- GST -->


					


				
				
				
				
				
				<!-- End -->
				
				
				
        <!-- this row will not appear when printing -->
     <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getRowCount()"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" > Submit </button>
                <?php } ?>
            </div>
        </div> 
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
	
	
	