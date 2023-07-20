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
				<label class="col-sm-4 control-label">Inventory Transfer No.</label>
				<div class="col-sm-8">
                        <select class="form-control js-example-basic-single" name="Inventory_transferNo" id="Inventory_transferNo"  onmouseover="ycssel()" onchange="Fetch_qcinventory_transfer_Data(this.value,'inventory_transfer','from_warehouse','to_warehouse','from_warehouse','to_warehouse');" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($inventory_transfer_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['Inventory_transferNo']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Inventory_transferNo']; ?>"><?php echo $v['Inventory_transferNo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <!-- Inventory_transferNo -->
                
                    </div>
			</div>
			
		</div>
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">From Warehouse</label>
                <div class="col-sm-8">

                <!--<input class="form-control" id="from_warehouse" name="from_warehouse" value="<?php echo $FmData[0]['from_warehouse'];?>" type="text" readonly>-->
                 <input class="form-control" id="from_warehouse" name="from_warehouse" value="<?php IF(isset($FmData[0]['from_warehouse'])){echo $FmData[0]['from_warehouse'];}echo $FmData[0]['from_title'];?>" type="text" readonly>
                
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
                            </select>
				 -->
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

                <!--<input class="form-control" id="to_warehouse" name="to_warehouse" value="<?php echo $FmData[0]['to_warehouse'];?>" type="text" readonly>-->
                <input class="form-control" id="to_warehouse" name="to_warehouse" value="<?php if(isset($FmData[0]['to_warehouse'])){echo $FmData[0]['to_warehouse'];} echo $FmData[0]['to_title']?>" type="text" readonly>

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

                 <div class="row" style="border:1px solid black;margin:20px;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="qcinventorytransfer" >
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Batch</th>
                            <th>Available Stocks</th>
                            <th>Transfer Quantity</th>
                            <th>Accepted Quantity</th>
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
                           <input class="form-control" type="hidden" id="item_name_<?php echo $tii; ?>" name="item_name_<?php echo $tii; ?>" value="<?php if($dataValue['item_name']){ echo $dataValue['item_name']; } ?>"   readonly>
                           <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>"  value="<?php echo $dataValue['RMName'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="batch_no_<?php echo $tii; ?>" name="batch_no_<?php echo $tii; ?>" value="<?php echo $dataValue['batch_no'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="availabel_stock_<?php echo $tii; ?>" name="availabel_stock_<?php echo $tii; ?>" value="<?php if(isset($dataValue['availabel_stock'])) {echo $dataValue['availabel_stock'];} else{ echo $dataValue['available_qty'];}?>" readonly>
                          </div>
         	           </div>
                     </td> 
				     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="transfer_quantity_<?php echo $tii; ?>" name="transfer_quantity_<?php echo $tii; ?>" value="<?php echo $dataValue['transfer_quantity'];?>" readonly>
                          </div>
         	           </div>
                      </td> 
                      <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="accepted_qty_<?php echo $tii; ?>" name="accepted_qty_<?php echo $tii; ?>" value="<?php echo $dataValue['accepted_qty'];?>" onkeyup="nozero(this.id);accepted_val(this.id);" required onkeypress="return onlyNumbernodecimal(event);">
                           <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php if($dataValue['accepted_qty']){ echo $dataValue['accepted_qty']; } ?>"   readonly style="width:230px">
                          </div>
         	           </div>
                      </td> 
                      <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                        <input class="form-control" type="hidden" id="unit_id_<?php echo $tii; ?>" name="unit_id_<?php echo $tii; ?>" value="<?php if($dataValue['unit_id']){ echo $dataValue['unit_id']; } ?>"   readonly>
                           <input class="form-control" type="text" id="UnitName_<?php echo $tii; ?>" name="UnitName_<?php echo $tii; ?>" value="<?php echo $dataValue['UnitName'];?>" readonly>
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
	
	
	