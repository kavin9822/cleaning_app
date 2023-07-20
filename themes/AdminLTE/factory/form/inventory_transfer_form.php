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
				

            <!-- staring the inventory Transfer -->

<div class="container" style="margin-top:20px;">


<div class="row" >
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">Inventory transfer</label>
				<div class="col-sm-8">
					<!-- <input class="form-control" id="Permanent_address" name="Permanent_address" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" readonly>  -->
                        <input class="form-control" id="Inventory_transferNo" name="Inventory_transferNo" value="<?php if(isset($FmData[0]['Inventory_transferNo'])){echo $FmData[0]['Inventory_transferNo'];}else{echo $Inventory_transferNo;}?>" type="text" readonly> 
                
                    </div>
			</div>
		</div>
			
		
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">From Warehouse</label>
                <div class="col-sm-8">
                <!-- <select class="form-control js-example-basic-single" name="from_warehouse" id="from_warehouse"  onmouseover="ycssel()" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($material_inward_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['from_warehouse']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MaterialNo']; ?>"><?php echo $v['MaterialNo']; ?></option>
                            <?php endforeach; ?>
                            </select> -->

                        <!--    <select class="form-control" name="from_warehouse" id="from_warehouse"  required> -->
                        <!--    <option value="" disabled selected style="display:none;">Select</option>-->
                        <!--    <option <?php  if(isset($FmData[0]['from_warehouse']) && $FmData[0]['from_warehouse']=='PUDUCHERRY'){echo 'selected="selected"';} ?> value="PUDUCHERRY" title="PUDUCHERRY">PUDUCHERRY</option>-->
                        <!--    <option <?php if(isset($FmData[0]['from_warehouse']) && $FmData[0]['from_warehouse']=='CUDDALORE'){echo 'selected="selected"';} ?> value="CUDDALORE" title=" CUDDALORE">CUDDALORE</option>-->
                        <!--</select>-->
                        
                        <!---->
                         <select class="form-control" name="from_warehouse" id="from_warehouse" onmouseover="hideSelect()" onmouseout="showSelect()"  readonly>
                        <option value="" disabled selected style="display:none;" >Select</option>
                            <?php  foreach ($entity_data as $enitytdetails_value): ?>
                            
                            <?php   if ($enitytdetails_value['ID'] == $entityID) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 
                                  
                                 <option   <?php echo $isselected; ?> value="<?php echo $enitytdetails_value['ID']; ?>" title="<?php echo $enitytdetails_value['Title']; ?>"><?php echo $enitytdetails_value['Title']; ?></option>
                                  
                            <?php endforeach; ?>
                        </select>
                        <!---->
				
                </div>
			</div>
		</div>
		</div>	


<div class="row" >
		<div class="col-sm-6">	
				
		</div>
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">To Warehouse</label>
                <div class="col-sm-8">
                <!-- <select class="form-control js-example-basic-single" name="to_warehouse" id="to_warehouse"  onmouseover="ycssel()" >
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($material_inward_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['to_warehouse']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MaterialNo']; ?>"><?php echo $v['MaterialNo']; ?></option>
                            <?php endforeach; ?>
                            </select> -->

                        <!--<select class="form-control" name="to_warehouse" id="to_warehouse"  required> -->
                        <!--    <option value="" disabled selected style="display:none;">Select</option>-->
                        <!--    <option <?php  if(isset($FmData[0]['to_warehouse']) && $FmData[0]['to_warehouse']=='PUDUCHERRY'){echo 'selected="selected"';} ?> value="PUDUCHERRY" title="PUDUCHERRY">PUDUCHERRY</option>-->
                        <!--    <option <?php if(isset($FmData[0]['to_warehouse']) && $FmData[0]['to_warehouse']=='CUDDALORE'){echo 'selected="selected"';} ?> value="CUDDALORE" title=" CUDDALORE">CUDDALORE</option>-->
                        <!--</select>-->
                        
                        <!---->
                        <!--<select class="form-control" name="to_warehouse" id="to_warehouse" onmouseover="disableSelectt()" onmouseout="makeSelectReadOnlyy()"  readonly>-->
                        <select class="form-control" name="to_warehouse" id="to_warehouse" onmouseover="hideSelectt()" onmouseout="showSelectt()"   readonly>
                        <option value="" disabled selected style="display:none;" >Select</option>
                            <?php  foreach ($entity_data as $enitytdetails_value): ?>
                            
                            <?php   if ($enitytdetails_value['ID'] == $area) {
                                // echo $area; die; 
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 
                                  
                                 <option   <?php echo $isselected; ?> value="<?php echo $enitytdetails_value['ID']; ?>" title="<?php echo $enitytdetails_value['Title']; ?>"><?php echo $enitytdetails_value['Title']; ?></option>
                                  
                            <?php endforeach; ?>
                        </select>  
                        <!---->
				
                </div>
			</div>
		</div>
	</div>	

    <div class="row" >
		<div class="col-sm-6">	
				
		</div>
		<div class="col-sm-6">	
       
		</div>
	</div>	

</div>

                                    <!-- Child  table Start -->

                                    <div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:80px;margin-right:80px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Item Name</th>
                            <th>Batch</th>
                            <th>Available Stocks</th>
                            <th>Transfer Quantity</th>
                            <th>Unit</th>
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
                                         <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>"  name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove();total_pro()";?> >
                                         <!-- <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" disabled name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove();tax_amount_calc();";?> tabindex="8"> -->
                                        </div>
                                    </div>
                                </td>
								<td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <!-- <input class="form-control" type="text" required id="Material_<?php echo $tii; ?>" name="Material_<?php echo $tii; ?>" 
									    value="<?php if($dataValue['Material']){ echo $dataValue['Material']; } ?>" placeholder="Enter Material" tabindex="2" style="width:230px" required>  -->
                                       
                                        <select class="form-control" name="item_name_<?php echo $tii; ?>" id="item_name_<?php echo $tii; ?>" onchange="validateExistinventory(this.id,'invoice_listing_table');" onchange="rawmtrl_agianst_batch_unit(this.value,this.id,'batch_no_','unit_','unit_id_','availabel_stock_');"  required>
                                               <option value="" disabled selected style="display:none;">Select</option>                      
                                                 <?php foreach ($rawmaterial_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['item_name']) {
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
                                </td>
                                <td>                                      
                               <div class="form-group">
                                        <div class="col-sm-12">

                                        <input class="form-control" type="text" id="batch_no_<?php echo $tii; ?>" name="batch_no_<?php echo $tii; ?>" value="<?php if($dataValue['batch_no']){ echo $dataValue['batch_no']; } ?>" onkeypress="return onlynumbers(event);" onkeyup="" readonly>	

                            <!-- <select class="form-control" name="batch_<?php echo $tii; ?>" id="batch_<?php echo $tii; ?>" readonly  required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($material_inward_detail_tab_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['batch_no_']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['batch_no']; ?>"><?php echo $v['batch_no']; ?></option>
                                                 <?php endforeach; ?>
                                            </select> -->
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
										
                                        <input class="form-control" type="text" id="availabel_stock_<?php echo $tii; ?>" name="availabel_stock_<?php echo $tii; ?>" value="<?php if(isset($dataValue['availabel_stock'])){ echo $dataValue['availabel_stock']; } else{$dataValue['available_qty'];} ?>" placeholder="Enter Available Stock" onkeypress="return onlynumbers(event);" onkeyup=""  readonly>		
								  
						
								  
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="transfer_quantity_<?php echo $tii; ?>" name="transfer_quantity_<?php echo $tii; ?>" value="<?php if($dataValue['transfer_quantity']){ echo $dataValue['transfer_quantity']; } ?>" placeholder="Enter Transfer Quantity" onkeyup="nozero(this.id);accepted_val_in(this.id);" onkeypress="return onlynumbers(event);" onkeyup="">	
                                        <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php if($dataValue['transfer_quantity']){ echo $dataValue['transfer_quantity']; } ?>"   readonly style="width:230px">
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="hidden" id="unit_id_<?php echo $tii; ?>" name="unit_id_<?php echo $tii; ?>" value="<?php if($dataValue['unit_id']){ echo $dataValue['unit_id']; } ?>" tabindex="15" style="width:115px">
                                       
                                         <input class="form-control" type="text" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="" onkeypress="return onlyNumbernodecimal(event);" style="width:100px;" readonly> 
                                       
                                <!--        <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" readonly  required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['unit']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>       -->
                                        
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
                                         <!-- <input class="form-control" type="text" id="Material_1" name="Material_1" value="" placeholder="Enter Material" tabindex="6" style="width:230px" required > -->
                                   
                                         <select class="form-control" name="item_name_1" id="item_name_1" onchange="validateExistinventory(this.id,'invoice_listing_table'); rawmtrl_agianst_batch_unit(this.value,this.id,'batch_no_','unit_','unit_id_','availabel_stock_');" required>
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
                                    <input class="form-control" type="text" id="batch_no_1" name="batch_no_1" value="" placeholder=""  readonly>
                                  <!-- <select class="form-control" name="batch_1" id="batch_1" readonly required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($material_inward_detail_tab_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['batch_no']; ?>"><?php echo $v['batch_no']; ?></option>
                                            <?php endforeach; ?>
                                        </select> -->
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" id="availabel_stock_1" name="availabel_stock_1" value="" placeholder="Enter Availabel Stock" onkeypress="return onlynumbers(event);" onkeyup="" readonly>		
								
							<!--	<input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required>		-->
								
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="transfer_quantity_1" name="transfer_quantity_1" value="" placeholder="Enter Transfer Quantity" onkeypress="return onlynumbers(event);" onkeyup="nozero(this.id);accepted_val_in(this.id);" required>	
									 
								<!--	 <input class="form-control" id="price_unit_1" name="price_unit_1" value="" placeholder="price_unit_1" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required> 	-->
									 
                                    </div>
         	                   </div>
                            </td> 
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                          <input class="form-control" type="hidden" id="unit_id_1" name="unit_id_1" value="" style="width:115px">
                                          <input class="form-control" type="text" id="unit_1" name="unit_1" value="" placeholder="" onkeypress="return onlyNumbernodecimal(event);"  readonly> 
                                    
                                   <!--      <select class="form-control" name="unit_1" id="unit_1" readonly required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($unit_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>       -->
                                        
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




                                    <!-- Child  table Stop -->



			 <!-- Ending the inventory Transfer -->
                
				
				
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
	
	
	