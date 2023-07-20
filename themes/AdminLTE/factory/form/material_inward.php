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

            <div class="row" style="margin:20px">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Material Inward </label>
                    <div class="col-sm-9">
                         <!-- <input class="form-control" id="MaterialNo" name="MaterialNo" value="<?php if(isset($FmData[0]['material_inward_id'])){echo $FmData[0]['material_inward_id'];}else{echo $material_inward_id;}?>" type="text" > -->
                         <input class="form-control" id="MaterialNo" name="MaterialNo" value="<?php if(isset($FmData[0]['MaterialNo'])){echo $FmData[0]['MaterialNo'];}else{echo $MaterialNo;}?>" type="text"  readonly>
                   
                        </div>
                </div>
                <div class="form-group">
                   
                </div>              
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                <label  class="col-sm-3 control-label">Purchase Order No</label>
                    <div class="col-sm-9">                                                                                         
                    <select class="form-control js-example-basic-single" name="PurchaseNO" id="PurchaseNO"  onmouseover="ycssel()" onchange="material_inward_data(this.value,'[id^=item_id_]','[id^=po_qty_]','[id^=pending_qty_]','[id^=unitname_]','[id^=unit_]','Supplier_Name','supplier_ID')">                                                                                        
                    <!-- <select class="form-control js-example-basic-single" name="PurchaseNO" id="PurchaseNO"  onmouseover="ycssel()" onchange="material_inward_data(this.value,'purchaseorder','PurchaseOrderNo','POQuantity','rawmaterial_ID','Supplier_Name','po_qty_1','Iterm_description_1');"> -->
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($po_master_tab as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['PurchaseNO']) {
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
                
               


                <div class="form-group">
                    <label  class="col-sm-3 control-label">Supplier Name</label>
                    <div class="col-sm-9">
                    <input class="form-control" id="supplier_ID" name="supplier_ID" readonly="true" value="<?php echo $FmData[0]['supplier_ID'];?>" type="hidden">
                    <input class="form-control" id="Supplier_Name" name="Supplier_Name" readonly="true" value="<?php echo $FmData[0]['SupplierName'];?>" type="text">
                    </div>
                    
                </div>

            </div> 


        </div>
       
        <!-- <input class="form-control" id="rawmsterial_id" name="rawmsterial_id" readonly="true" value="<?php echo $FmData[0]['Supplier_Name'];?>" type="text"> -->


			<!-- stop ending -->
<!-- table start -->
		
       <!-- Table -->
			<div class="row" style="margin-top:20px;margin-bottom:20px;border:1px solid black; display:block margin-rigth:120px;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th></th>
                            <th>Item Description</th>
							<th>PO Qty</th>
                            <th>Pending Qty</th>
                            <th>Received Qty</th>
                            <th>Unit</th>
                            <th>Received Qty in Kg</th>
                            <th>Batch No.</th>
                            <th>Cost/unit</th>
                            <th>Total</th>
                            <th>Supplier Invoice No.</th>
                            <th>Invoice date</th>
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
                                        <input class="form-control" type="text" id="Iterm_description_<?php echo $tii; ?>" name="Iterm_description_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName']; } ?>"readonly style="width:230px">
                                        <!-- <input class="form-control" type="text" required id="Iterm_description_<?php echo $tii; ?>" name="Iterm_description_<?php echo $tii; ?>" value="<?php if($dataValue['Iterm_description']){ echo $dataValue['Iterm_description']; } ?>" tabindex="2" style="width:230px" required>  -->
                                        <input class="form-control" type="hidden" id="item_id_<?php echo $tii; ?>" name="item_id_<?php echo $tii; ?>" value="<?php if(isset($dataValue['rawmaterial_ID'])){ echo $dataValue['rawmaterial_ID']; } echo $dataValue['item_id']; ?>"   readonly style="width:230px">

                                        <!-- <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName']; } ?>"readonly tabindex="9">
											<input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" tabindex="10"  readonly> -->
                                    </div>
                                    </div>
                                </td>
                                <td>                                      
                               <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" id="po_qty_<?php echo $tii; ?>" name="po_qty_<?php echo $tii; ?>" value="<?php if($dataValue['po_qty']){ echo $dataValue['po_qty']; } ?>"  style="width:115px" required readonly>		
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
										
                                        <!--<input class="form-control" type="text" id="pending_qty_<?php echo $tii; ?>" name="pending_qty_<?php echo $tii; ?>" value="<?php if($dataValue['pending_qty']){ echo $dataValue['pending_qty']; } ?>"  onkeypress="return onlynumbers(event);"  style="width:115px" required readonly>		-->
                                        <!--<input class="form-control" type="text" id="pending_qty_<?php echo $tii; ?>" name="pending_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['pending_qty'])){ echo $dataValue['pending_qty']; } else{echo $dataValue['poquantity_stat'];} ?>"  onkeypress="return onlynumbers(event);"  style="width:115px" required readonly>-->
                                        <input class="form-control" type="text" id="pending_qty_<?php echo $tii; ?>" name="pending_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['pending_qty'])){ echo $dataValue['pending_qty']; } else{echo $dataValue['extra_clm'];} ?>"    style="width:115px"  readonly>
								  
						
								  
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="received_qty_<?php echo $tii; ?>" name="received_qty_<?php echo $tii; ?>" value="<?php if($dataValue['received_qty']){ echo $dataValue['received_qty']; } ?>" onkeypress="return onlynumbers(event);" onkeyup="$('#total_<?php echo $tii; ?>').val(($('#received_qty_<?php echo $tii; ?>').val() * $('#cost_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro(); nozero(this.id); material_Validationnn(this.id);" style="width:120px" required Readonly>			
                                        </div>
                                    </div>
                                </td>
								 <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <!-- <input class="form-control" type="text" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if($dataValue['unit']){ echo $dataValue['unit']; } ?>" placeholder="Enter unit" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly> -->
                                        
                                        <input class="form-control" type="hidden" id="unit_<?php echo $tii; ?>" name="unit_<?php echo $tii; ?>" value="<?php if(isset($dataValue['unit_ID'])){ echo $dataValue['unit_ID']; } echo $dataValue['unit'];?>" tabindex="15" style="width:115px">
										<input class="form-control" type="text" id="unitname_<?php echo $tii; ?>" name="unitname_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" tabindex="15" readonly style="width:115px"> 
                                        
                                        <!-- <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" tabindex="5" style="width:80px;" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['unit']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                                 <?php endforeach; ?> -->
                                    
                                    
                                    </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="received_qt_in_kg_<?php echo $tii; ?>" name="received_qt_in_kg_<?php echo $tii; ?>" value="<?php if($dataValue['received_qt_in_kg']){ echo $dataValue['received_qt_in_kg']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="batch_no_<?php echo $tii; ?>" name="batch_no_<?php echo $tii; ?>" value="<?php if($dataValue['batch_no']){ echo $dataValue['batch_no']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="cost_unit_<?php echo $tii; ?>" name="cost_unit_<?php echo $tii; ?>" value="<?php if($dataValue['cost_unit']){ echo $dataValue['cost_unit']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" onkeyup="$('#total_<?php echo $tii; ?>').val(($('#received_qty_<?php echo $tii; ?>').val() * $('#cost_unit_<?php echo $tii; ?>').val()).toFixed(2));total_pro();nozero(this.id);" required readonly>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="total_<?php echo $tii; ?>" name="total_<?php echo $tii; ?>" value="<?php if($dataValue['total']){ echo $dataValue['total']; } ?>" onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required readonly>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <input class="form-control" type="text" id="supplier_invoice_no_<?php echo $tii; ?>" name="supplier_invoice_no_<?php echo $tii; ?>" value="<?php if($dataValue['supplier_invoice_no']){ echo $dataValue['supplier_invoice_no']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required>			
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                       <div class="col-sm-12">
                                        <!-- <input class="form-control" type="text" id="invoice_date_<?php echo $tii; ?>" name="invoice_date_<?php echo $tii; ?>" value="<?php if($dataValue['invoice_date']){ echo $dataValue['invoice_date']; } ?>"  style="width:120px" required>			 -->
                                        <!-- <input class="form-control" id="invoice_date_<?php echo $tii; ?>" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_<?php echo $tii; ?>" value="<?php if(isset($FmData[0]['invoice_date']) && $FmData[0]['invoice_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));}?>" type="text" style="width:120px"> -->
                                    
                                        <input class="form-control" id="invoice_date_<?php echo $tii; ?>" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_<?php echo $tii; ?>" value="<?php if(isset($FmData[0]['invoice_date']) && $FmData[0]['invoice_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));}?>" type="text" style="width:100px" required>
                                   
                                        <!-- <input class="form-control" type="text" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"   name="Emp_<?php echo $tii; ?>" id="Emp_<?php echo $tii; ?>" value="<?php if(isset($dataValue['RequiredOn']) && $dataValue['RequiredOn']!='0000-00-00'){ echo date('d-m-Y',strtotime($dataValue['RequiredOn']));} ?>"  onkeypress="return onlyNumbernodecimal(event);"> -->
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
                                         <!-- <input class="form-control" type="text" id="Iterm_description_1" name="Iterm_description_1" value=""  tabindex="6" style="width:180px" required > -->

                                         <!-- <select class="form-control" name="Iterm_id_1" id="Iterm_id_1" required onchange="validateExist(this.id,'invoice_listing_table');Rawmaterial_Agianst_Indentdet(this.value,this.id,'po_qty_','pending_qty_','unitname_','unit_')" style="width:230px"> -->
                                         <select class="form-control" name="item_id_1" id="item_id_1" required onchange="validateExistmaterialinward(this.id,'invoice_listing_table');material_inward_fetch_data_child(this.value,this.id,'po_qty_','pending_qty_','unitname_','unit_', document.getElementById('PurchaseNO').value)" style="width:230px">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <!-- <?php foreach($rawmaterial_data as $k => $v): ?>-->                                                                                                     
                                            <!--    <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>-->
                                            <!--<?php endforeach; ?> -->
                                        </select>
 
                                        </div>
         	                    </div>
                            </td>
                            
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" id="po_qty_1" name="po_qty_1" value=""  onkeypress="return onlynumbers(event);" tabindex="8" style="width:80px" required readonly>		
								
							<!--	<input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required>		-->
								
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!-- local <input class="form-control" type="text" id="pending_qty_1" name="pending_qty_1" value=""  onkeypress="return onlyNumbernodecimal(event);" tabindex="9" style="width:80px" readonly>	-->
                                         <input class="form-control" type="text" id="pending_qty_1" name="pending_qty_1" value=""  onkeypress="return onlyNumbernodecimal(event);" tabindex="9" style="width:80px" readonly>
									 
								<!--	 <input class="form-control" id="price_unit_1" name="price_unit_1" value="" placeholder="price_unit_1" type="text" onkeyup="$('#Value_1').val(($('#price_unit_1').val() * $('#Quantity_1').val()).toFixed(2))" required> 	-->
									 
                                    </div>
         	                   </div>
                            </td> 
							<td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="received_qty_1" name="received_qty_1" value="" onkeypress="return onlynumbers(event);" onkeyup="$('#total_1').val(($('#received_qty_1').val() * $('#cost_unit_1').val()).toFixed(2));total_pro(); nozero(this.id);material_Validationnn(this.id);" style="width:80px" required>
                                    </div> 
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!-- <input class="form-control" type="text" id="unit_1" name="unit_1" value="" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" readonly> -->

                                         <input class="form-control" type="hidden" id="unit_1" name="unit_1" value="" style="width:115px">
										<input class="form-control" type="text" id="unitname_1" name="unitname_1" value="" readonly tabindex="14" style="width:115px"> 

                                         <!-- <select class="form-control" name="unit_1" id="unit_1" tabindex="10" style="width:80px">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach($unit_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                            <?php endforeach; ?>
                                      </select> -->
                                    
                                        </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="received_qt_in_kg_1" name="received_qt_in_kg_1" value="" onkeypress="return onlynumbers(event);" style="width:80px" required>
                                    </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="batch_no_1" name="batch_no_1" value="" onkeypress="return onlyNumbernodecimal(event);" style="width:80px" required>
                                    </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">

                                                

                                         <input class="form-control" type="text" id="cost_unit_1" name="cost_unit_1" value="" onkeypress="return onlyNumbernodecimal(event);" onkeyup="$('#total_1').val(($('#received_qty_1').val() * $('#cost_unit_1').val()).toFixed(2));total_pro();nozero(this.id);" style="width:80px" required>
                                    </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="total_1" name="total_1" value="" onkeypress="return onlyNumbernodecimal(event);" style="width:80px" readonly>
                                    </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="supplier_invoice_no_1" name="supplier_invoice_no_1" value="" onkeypress="return onlyNumbernodecimal(event);" style="width:80px" required>
                                         <!-- <input class="form-control" type="text" id="supplier_invoice_no_<?php echo $tii; ?>" name="supplier_invoice_no_<?php echo $tii; ?>" value="<?php if($dataValue['supplier_invoice_no']){ echo $dataValue['supplier_invoice_no']; } ?>"  onkeypress="return onlyNumbernodecimal(event);"  style="width:120px" required> -->
                                   
                                        </div>
         	                   </div>
                            </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!-- <input class="form-control" type="text" id="invoice_date_1" name="invoice_date_1" value="" onkeypress="return onlyNumbernodecimal(event);" style="width:120px" > -->
                                         <!-- <input class="form-control" id="invoice_date_1" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_1" value="" type="text" style="width:100px"> -->
                                         <input class="form-control" id="invoice_date_1" autocomplete="off" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="invoice_date_1" value="" type="text" style="width:100px" required>
                                         <!-- <input class="form-control" type="text"  name="Emp_1" id="Emp_1" value="" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"  onkeypress="return onlyNumbernodecimal(event);"> -->
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
            