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
               

            <!-- Start heading -->

					<!-- <input class="form-control" id="Permanent_address" name="Permanent_address" value="<?php echo $FmData[0]['BillingAddress1'];?>" type="text" readonly>  -->
                        
                
            <div class="row" style="margin:20px">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">

                <div class="form-group">
                    <label  class="col-sm-3 control-label">Purchase Order</label>
                    <div class="col-sm-9">
                         <!-- <input class="form-control" id="MaterialNo" name="MaterialNo" value="<?php if(isset($FmData[0]['MaterialNo'])){echo $FmData[0]['MaterialNo'];}else{echo $MaterialNo;}?>" type="text" > -->
                        
                         
                            <select class="form-control js-example-basic-single" name="purchaseorder" id="purchaseorder"  onmouseover="ycssel()" onchange="Fetch_qc_materialiwt_Data(this.value,'material_inward_id','SupplierName','supplier_ID');add_enable_qc(this.value,'material_inward_id','purchase_indentNo');" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($indent_dataa as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['purchaseorder']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PurchaseOrderNo']; ?>"><?php echo $v['PurchaseOrderNo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            
                            
                        </div>
                </div>

                <!-- <?php foreach ($material_inward_id as $k => $v)

                print_r($v);

 ?> -->

                <div class="form-group">
                    <label  class="col-sm-3 control-label">MRN No</label>
                    <div class="col-sm-9">
                    <!-- <input class="form-control" id="purchaseorder" name="purchaseorder" value="<?php if(isset($FmData[0]['purchaseorder'])){echo $FmData[0]['purchaseorder'];}else{echo $purchaseorder;}?>" type="text" > -->
                    <!-- <input class="form-control" id="purchaseorder" name="purchaseorder" readonly="true" value="<?php echo $FmData[0]['purchaseorder'];?>" type="text"> -->
                    <!-- <input type="hidden" name="material_inward_id_hidden" value="<?php echo $FmData[0]['material_inward_id']; ?>"> -->
                  <?php if($mode=='add'){?>
                    <select class="form-control js-example-basic-single" name="material_inward_id" id="material_inward_id" disabled onmouseover="ycssel()"  onchange="Fetch_qcmaterial_Data(this.value);" required>
                    <?php }else{?>
                        <select class="form-control js-example-basic-single" name="material_inward_id" id="material_inward_id" onmouseover="ycssel()" readonly onchange="Fetch_qcmaterial_Data(this.value);">
                        <?php }?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($material_inward_id as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['material_inward_id']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MaterialNo']; ?>"><?php echo $v['MaterialNo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                    
                
                </div>
                </div>              
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Supplier Name</label>
                    <div class="col-sm-9">
                    <input class="form-control" id="SupplierName" name="SupplierName"  value="<?php echo $FmData[0]['SupplierName'];?>" type="text" readonly>
                    <input class="form-control" id="supplier_ID" name="supplier_ID"  value="<?php echo $FmData[0]['supplier_ID'];?>" type="hidden" readonly>    
                    </div>
                </div>

                
                   


                
                    
                

            </div> 


        </div>
       
        <input  id="qcmaterial_inw_id" name="qcmaterial_inw_id" value="<?php if(isset($FmData[0]['qcmaterial_inw_id'])){echo $FmData[0]['qcmaterial_inw_id'];}else{echo $qcmaterial_inw_id;}?>" type="hidden" readonly>


			<!-- stop ending -->
<!-- table start -->
		
       <!-- Table --> 
			<div class="row" style="margin-top:20px;margin-bottom:20px;border:1px solid black; display:block margin-rigth:120px;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id ="qcmaterialinward">
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Item Description</th>
							<th>Received Qty</th>
                            <th>Unit</th>
                            <th>Received qty in kg</th>
                            <th>batch No</th>
                            <th>Supplier Invoice No</th>
                            <th>invoice date</th>
                            <th>Given Qty</th> 
                            <th>Accepted Qty</th>
                            <th>Rejected Qty</th>
                            
                            <!-- <th>Rejection</th> -->
                            <th>Rejection Reason</th>
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
                                        <!-- <input class="form-control" type="text" required id="item_description_<?php echo $tii; ?>" name="item_description_<?php echo $tii; ?>" -->
									    <!-- value="<?php if($dataValue['item_description']){ echo $dataValue['item_description']; } ?>" tabindex="2" style="width:230px" required> -->
                                    
                                        <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName']; } ?>"readonly style="width:230px">
                                        <input class="form-control" type="hidden" id="item_id_<?php echo $tii; ?>" name="item_id_<?php echo $tii; ?>" value="<?php if($dataValue['item_id']){ echo $dataValue['item_id']; } ?>"   readonly style="width:230px">
                                    
                                    </div>
                                    </div>
                                </td>
                                <td>                                      
                               <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="received_qty_<?php echo $tii; ?>" name="received_qty_<?php echo $tii; ?>" value="<?php if($dataValue['received_qty']){ echo $dataValue['received_qty']; } ?>"  style="width:115px" required readonly>		
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
										
                                        <input class="form-control" type="text" id="UnitName_<?php echo $tii; ?>" name="UnitName_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>"  onkeypress="return onlynumbers(event);"  style="width:115px" required readonly>		
                                        <input class="form-control" type="hidden" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if($dataValue['unit']){ echo $dataValue['unit']; } ?>"   readonly style="width:230px">
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="received_qt_in_kg_<?php echo $tii; ?>" name="received_qt_in_kg_<?php echo $tii; ?>" value="<?php if($dataValue['received_qt_in_kg']){ echo $dataValue['received_qt_in_kg']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="batch_no_<?php echo $tii; ?>" name="batch_no_<?php echo $tii; ?>" value="<?php if($dataValue['batch_no']){ echo $dataValue['batch_no']; } ?>"  onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly>
                                    </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="supplier_invoice_no_<?php echo $tii; ?>" name="supplier_invoice_no_<?php echo $tii; ?>" value="<?php if($dataValue['supplier_invoice_no']){ echo $dataValue['supplier_invoice_no']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <!-- <input class="form-control" type="text" id="invoice_date_<?php echo $tii; ?>" name="invoice_date_<?php echo $tii; ?>" value="<?php if($dataValue['invoice_date']){ echo $dataValue['invoice_date_']; } ?>" placeholder="Enter price_unit" onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required>			 -->
                                        <input class="form-control" id="invoice_date_<?php echo $tii; ?>" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_<?php echo $tii; ?>" value="<?php if(isset($FmData[0]['invoice_date']) && $FmData[0]['invoice_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));}?>" type="text" style="width:120px" readonly>
                                    
                                    </div>
                                    </div>
                                </td>
                                 <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="material_quantity_stat_<?php echo $tii; ?>" name="material_quantity_stat_<?php echo $tii; ?>" value="<?php if(isset($dataValue['material_quantity_stat'])){ echo $dataValue['material_quantity_stat']; } else{echo $dataValue['material_quantity_stat'];} ?>"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td> 
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                           <!--<input class="form-control" type="hidden" id="material_quantity_stat_<?php echo $tii; ?>" name="material_quantity_stat_<?php echo $tii; ?>" value="<?php if(isset($dataValue['material_quantity_stat'])){ echo $dataValue['material_quantity_stat']; } else{echo $dataValue['material_quantity_stat'];} ?>">-->
                                        <input class="form-control" type="text" id="accepted_qty_<?php echo $tii; ?>" name="accepted_qty_<?php echo $tii; ?>" value="<?php if($dataValue['accepted_qty']){ echo $dataValue['accepted_qty']; } ?>" onkeypress="return onlynumbers(event);" onkeyup= "accepted_val_qc(this.id);$(rejected_qty_<?php echo $tii; ?>).val(($(received_qty_<?php echo $tii; ?>).val() - $(accepted_qty_<?php echo $tii; ?>).val()).toFixed(2));"  style="width:120px" required readonly>	
                                        <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php if($dataValue['accepted_qty']){ echo $dataValue['accepted_qty']; } ?>"   readonly style="width:230px">
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="rejected_qty_<?php echo $tii; ?>" name="rejected_qty_<?php echo $tii; ?>" value="<?php if($dataValue['rejected_qty']){ echo $dataValue['rejected_qty']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td>
                                <!-- <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="total_pending_approval_qty_<?php echo $tii; ?>" name="total_pending_approval_qty_<?php echo $tii; ?>" value="<?php if($dataValue['total_pending_approval_qty']){ echo $dataValue['total_pending_approval_qty']; } ?>"  style="width:120px" required>			
                                        <input class="form-control" id="invoice_date_<?php echo $tii; ?>" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_<?php echo $tii; ?>" value="<?php if(isset($FmData[0]['invoice_date']) && $FmData[0]['invoice_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));}?>" type="text" style="width:120px">
                                    </div>
                                    </div>
                                </td> -->
                                <!-- <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="rejected_<?php echo $tii; ?>" name="rejected_<?php echo $tii; ?>" value="<?php if($dataValue['rejected']){ echo $dataValue['rejected']; } ?>"  style="width:120px" required>			
                                      
                                    </div>
                                    </div>
                                </td> -->
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="rejection_reason_<?php echo $tii; ?>" name="rejection_reason_<?php echo $tii; ?>" value="<?php if($dataValue['rejection_reason']){ echo $dataValue['rejection_reason']; } ?>"  style="width:120px" readonly required>			
                                        <!-- <input class="form-control" id="invoice_date_<?php echo $tii; ?>" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_<?php echo $tii; ?>" value="<?php if(isset($FmData[0]['invoice_date']) && $FmData[0]['invoice_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));}?>" type="text" style="width:120px"> -->
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
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
        <input type="hidden" value="1" id="maxCount" name="maxCount">

        <!-- <div id="showData"></div> -->


<!-- table end -->


<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" onmouseover="getRowCount()" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right " name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
  
</section>         
            