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
				<div class="form-group">
				<label class="col-sm-4 control-label">Po No.</label>
                <div class="col-sm-8">
                <select class="form-control js-example-basic-single" name="po_no" id="po_no"  onmouseover="ycssel()" onchange="po_against_workorder(this.value,'work_order_no'); add_disabled_det(this.id,'work_order_no')" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($productionorder_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['po_no']) {
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
				<label class="col-sm-4 control-label"> Work Order No</label>
				<div class="col-sm-8">
				<?php if(isset($FmData[0]['work_order_no'])) { ?>
					<input id="work_order_no" name="work_order_no" value="<?php if($FmData[0]['work_order_no']){echo $FmData[0]['work_order_no'];}?>"  type="hidden">
					<select class="form-control js-example-basic-single" name="work_order_no" id="work_order_no" disabled>
					<?php }else { ?>
					<select class="form-control js-example-basic-single" name="work_order_no" id="work_order_no"  onmouseover="ycssel()" onchange="rawmaterial_issue_sub(this.value,'processmaster','workorder','employee','ProcessName','ProductSize','Thickness','Colour','Design','Quantity','CompletedDate','SequenceMaterialIssued','Details','Remarks','EmpName','process','product_size','thickness','color','design','quantity','completed_on','lay_up_sequence','details','remarks','person_name','ProductName','ProcessID','product_ID','EmployeeID','statuss');" disabled="true" required>
					<?php } ?> 
					<option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($workorder_tab_data1 as $k => $v): 
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
	<div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Name of the Person</label>
				<div class="col-sm-8">
						<input class	="form-control" id="person_name" name="person_name" value="<?php if($FmData[0]['EmpName']){echo $FmData[0]['EmpName'];}else{echo $FmData[0]['SupplierName'];} echo $FmData[0]['person_name'];?>" type="text" readonly>
                        <input class="form-control" id="EmployeeID" name="EmployeeID" value="<?php echo $FmData[0]['EmployeeID'];?>" type="hidden" readonly>
                    </div>	
			</div>																	
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Name of the Product</label>
				<div class="col-sm-8">
						<input class="form-control" id="ProductName" name="ProductName" value="<?php if($FmData[0]['ProductName']){echo $FmData[0]['ProductName'];} else{echo $FmData[0]['product_name'];}?>" type="text" readonly>
						<input class="form-control" id="product_ID" name="product_ID" value="<?php echo $FmData[0]['product_ID'];?>" type="hidden" readonly>
					</div>
			</div>
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Product Number</label>
				<div class="col-sm-8">
						<input class="form-control" id="product_number" name="product_number" value="<?php echo $FmData[0]['product_number'];?>" type="text" readonly>
						
					</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Process </label>
				<div class="col-sm-8">
						<input class="form-control" id="process" name="process" value="<?php if($FmData[0]['process']){echo $FmData[0]['process'];} else{echo $FmData[0]['ProcessName'];}?>" type="text" readonly>
						<input class="form-control" id="ProcessID" name="ProcessID" value="<?php echo $FmData[0]['ProcessID'];?>" type="hidden" readonly>
				</div>
			</div>
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">Size of the Product</label>
				<div class="col-sm-8">
						<input class="form-control" id="product_size" name="product_size" value="<?php if($FmData[0]['product_size']){echo $FmData[0]['product_size'];} else {echo $FmData[0]['ProductSize'];}	?>" type="text" onkeyup="specialcharacters_restriction(id)" readonly>
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">Thickness</label>
				<div class="col-sm-8">
					<input class="form-control" id="thickness" name="thickness" value="<?php if($FmData[0]['thickness']){echo $FmData[0]['thickness'];} else{echo $FmData[0]['Thickness'];}?>" type="text" readonly>
			</div>	
			</div>
		</div>
		</div>
		
		<div class="row" >
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label"> Colour  </label>
				<div class="col-sm-8">
				<input class="form-control" id="color" name="color" value="<?php if($FmData[0]['color']){echo $FmData[0]['color'];} else {echo $FmData[0]['Colour'];}?>" type="text" readonly>
				</div>
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> Design</label>
				<div class="col-sm-8">
				<input class="form-control" id="design" name="design" value="<?php if($FmData[0]['design']){echo $FmData[0]['design'];} else{echo $FmData[0]['Design'];}?>" type="text" readonly>
				</div>
			</div>
		</div>
		</div>
		
		<div class="row" >
		    <div class="col-sm-6">	
         <div class="form-group">
				<label class="col-sm-4 control-label"> Quantity </label>
				<div class="col-sm-8">
				<input class="form-control" id="quantity" name="quantity" value="<?php if(isset($FmData[0]['Quantity'])){echo $FmData[0]['Quantity'];}else{echo $FmData[0]['NoofQuantity'];} echo $FmData[0]['quantity'];?> " type="text" onkeypress="return onlyNumbernodecimal(event);" readonly>
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">To be completed On</label>
				<div class="col-sm-8">
						<!-- <input class="form-control" id="Pincode" name="Pincode" value="<?php echo $FmData[0]['BillingZip'];?>" type="text"  onkeypress="return onlynumbers(event);" maxlength="6" readonly> -->
                            <input class="form-control" id="completed_on" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="completed_on" value="<?php if(isset($FmData[0]['CompletedDate']) && $FmData[0]['CompletedDate']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['CompletedDate']));} else{echo date('d-m-Y',strtotime($FmData[0]['completed_on']));}?>" type="text" readonly>
            
                    </div>	
			</div>
		     </div>
	 </div>
     <div class="row" >
		    <div class="col-sm-6">	
         <div class="form-group">
				<label class="col-sm-4 control-label"> Lay Up Sequence  </label>
				<div class="col-sm-8">
				<input class="form-control" id="lay_up_sequence" name="lay_up_sequence" value="<?php if(isset($FmData[0]['lay_up_sequence'])){echo $FmData[0]['lay_up_sequence'];} else{echo $FmData[0]['SequenceMaterialIssued'];}?>" type="text" readonly>
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Details</label>
				<div class="col-sm-8">
						<input class="form-control" id="details" name="details" value="<?php if(isset($FmData[0]['details'])){echo $FmData[0]['details'];} else{echo $FmData[0]['Details'];}?>" type="text" readonly>
			</div>	
			</div>
		     </div>
	 </div>
		
		
		


</div>				
				
	<!-- Table -->
			<div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:80px;margin-right:80px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id ="rawmaterialissue_fetch">
                    <thead>
                        <tr>
                            
                            <th>Raw Material</th>
                            <th>Requested Quantity</th>
                            <th>UOM</th>
                            <th>Available Stock Qty</th>
							<th>Previous Issued Qty</th>
                            <th>Issued Qty</th>
                            <th>Excess Qty</th>
                            </tr>
                    </thead>
                                         
                    <!--  table respect to js Start -->

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
						<input type="hidden" id="rawmaterial_ID_<?php echo $tii; ?>" name="rawmaterial_ID_<?php echo $tii; ?>" value="<?php echo $dataValue['rawmaterial_ID'];?>">
                           <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>"  value="<?php if(isset($dataValue['raw_materials'])){echo $dataValue['raw_materials'];} else{echo $dataValue['RMName'];}?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity2_<?php echo $tii; ?>" name="Quantity2_<?php echo $tii; ?>" value="<?php if(isset($dataValue['request_quantity'])){echo $dataValue['request_quantity'];}  else{echo $dataValue['Quantity2'];}?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
						<input type="hidden" id="unit_ID_<?php echo $tii; ?>" name="unit_ID_<?php echo $tii; ?>" value="<?php if(isset($dataValue['unit_ID'])){echo $dataValue['unit_ID'];} else{echo $dataValue['unit_ID'];}?>">
                           <input class="form-control" type="text" id="UnitName_<?php echo $tii; ?>" name="UnitName_<?php echo $tii; ?>" value="<?php if(isset($dataValue['uom'])){echo $dataValue['uom'];} else{echo $dataValue['UnitName'];}?>" readonly>
                          </div>
         	           </div>
                     </td> 
                     
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="available_qty_<?php echo $tii; ?>" name="available_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['stock_qty'])){echo $dataValue['stock_qty'];} else{echo $dataValue['available_qty'];}?>"  required onkeypress="return onlyNumbernodecimal(event);" readonly>
                          </div>
         	           </div>
                      </td>  
				      
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="rmt_qty_<?php echo $tii; ?>" name="rmt_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['given_qty'])){echo $dataValue['given_qty'];} else{echo $dataValue['rmt_qty'];}?>"  required onkeypress="return onlyNumbernodecimal(event);" readonly>
                          </div>
         	           </div>
                      </td> 
                
				     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="issued_qty_<?php echo $tii; ?>" name="issued_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['issued_qty'])){echo $dataValue['issued_qty'];} else{echo $dataValue['issued_qty'];}?>" onkeyup= "nocopy(this.id);accepted_val_issue_raw(this.id);" onkeypress="return onlyNumbernodecimal(event);" Required readonly>
                           <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php if($dataValue['issued_qty']){ echo $dataValue['issued_qty']; } ?>"   readonly style="width:230px">
                          </div>
         	           </div>
                      </td> 
                      <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="excess_qty_<?php echo $tii; ?>" name="excess_qty_<?php echo $tii; ?>" value="<?php echo $dataValue['excess_qty'];?>"  required onkeypress="return onlyNumbernodecimal(event);" readonly>
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
                                        
                            
                        <?php endif; ?>
				  
                </tbody>

                    <!-- table respect to js End -->

                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
		<input type="hidden" value="1" id="maxCount" name="maxCount">	
				
	<!-- GST -->

<div class="container">
	

<div class="row" >
		    <div class="col-sm-6">	
         <div class="form-group">
				<label class="col-sm-4 control-label"> Remarks  </label>
				<div class="col-sm-8">
				<input class="form-control" id="remarks" name="remarks" value="<?php if(isset($FmData[0]['remarks'])){echo $FmData[0]['remarks'];} else{echo $FmData[0]['Remarks'];}?>" type="text" readonly>
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Created By</label>
				<div class="col-sm-8">
						<!-- <input class="form-control" id="created_by" name="created_by" value="<?php echo $FmData[0]['created_by'];?>" type="text" readonly > -->
						<input class="form-control" id="ApprovedBy" name="ApprovedBy" readonly value="<?php if($approver_data){ echo $approver_data[0]['user_nicename']; } ?>" type="text">
					</div>	
			</div>
		     </div>
	
</div>		
<div class="row" >
		    <div class="col-sm-6">	
         <div class="form-group">
				<label class="col-sm-4 control-label"> Status  </label>
				<div class="col-sm-8">
                <select class="form-control" name="statuss" id="statuss" required readonly style="pointer-events: none;> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['statuss']) && $FmData[0]['statuss']=='1'){echo 'selected="selected"';} ?> value="1" title="open">open</option>
                            <option <?php if(isset($FmData[0]['statuss']) && $FmData[0]['statuss']=='closed'){echo 'selected="selected"';} ?> value="closed" title=" closed">closed</option>
                        </select>
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
				
		     </div>
	
</div>			

</div>	
				
				
				
				
				
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
	
	
	