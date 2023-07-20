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
				<label class="col-sm-4 control-label">Rawmaterial</label>
				<div class="col-sm-8">
				<?php if(isset($FmData[0]['rawmaterial_id'])) { ?>
					<input id="rawmaterial_id" name="rawmaterial_id" value="<?php if($FmData[0]['rawmaterial_id']){echo $FmData[0]['rawmaterial_id'];}?>"  type="hidden">
					<select class="form-control js-example-basic-single" name="rawmaterial_id" id="rawmaterial_id" disabled>
					<?php }else { ?>
					<select class="form-control js-example-basic-single" name="rawmaterial_id" id="rawmaterial_id" onchange="raw_against_id(this.value,'rawmaterial_no');" onmouseover="ycssel()" required>
					<?php } ?> 
					<option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawmaterial_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['rawmaterial_id']) {
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
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> Rawmaterial No</label>
				<div class="col-sm-8">
						<input class="form-control" id="rawmaterial_no" name="rawmaterial_no" value="<?php if(isset($FmData[0]['rawmaterial_no'])){echo $FmData[0]['rawmaterial_no'];} else {echo $FmData[0]['ID'];}?>" type="text" readonly>
						<!-- <input class="form-control" id="product_ID" name="product_ID" value="<?php echo $FmData[0]['product_ID'];?>" type="hidden" readonly> -->
					</div>
			</div>
		</div>
		</div>	
	<div class="row" >
		<div class="col-sm-6">	

			<div class="form-group">
				<label class="col-sm-4 control-label">Supplier Name</label>
				<div class="col-sm-8">
				<?php if(isset($FmData[0]['supplier_id'])) { ?>
					<input id="supplier_id" name="supplier_id" value="<?php if($FmData[0]['supplier_id']){echo $FmData[0]['supplier_id'];}?>"  type="hidden">
					<select class="form-control js-example-basic-single" name="supplier_id" id="supplier_id" disabled>
					<?php }else { ?>
					<select class="form-control js-example-basic-single" name="supplier_id" id="supplier_id" onchange="supplier_against_po(this.value,'po_no','podate'); add_disabled_det(this.id,'po_no');" onmouseover="ycssel()" required>
					<?php } ?> 
					<option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($supplier_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['supplier_id']) {
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
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">PO.NO</label>
				
					<div class="col-sm-8">
				<?php if(isset($FmData[0]['po_no'])) { ?>
					<input id="po_no" name="po_no" value="<?php if($FmData[0]['po_no']){echo $FmData[0]['po_no'];}?>"  type="hidden">
					<select class="form-control js-example-basic-single" name="po_no" id="po_no" disabled>
					<?php }else { ?>
					<select class="form-control js-example-basic-single" name="po_no" id="po_no" disabled="true" onchange="po_against_date(this.value,'podate');" onmouseover="ycssel()">
					<?php } ?> 
					<option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($po_master_tab as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['po_no']) {
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
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Invoice Date</label>
				<div class="col-sm-8">
				<input class="form-control" id="invoice_date" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="invoice_date" value="<?php if (isset($FmData[0]['invoice_date'])){echo date('d-m-Y',strtotime($FmData[0]['invoice_date']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" >
						
					</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Po Date</label>
				<div class="col-sm-8">
						<input class="form-control" id="podate" name="podate" value="<?php if(isset($FmData[0]['podate'])){echo $FmData[0]['podate'];} else{echo $FmData[0]['AuditDateTime'];}?>" type="text" onkeypress="return onlyNumbernodecimal(event);" readonly>
						<!-- <input class="form-control" id="ProcessID" name="ProcessID" value="<?php echo $FmData[0]['ProcessID'];?>" type="hidden" readonly> -->
				</div>
			</div>
		</div>
		</div>	
		
		<div class="row" >
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">Quantity</label>
				<div class="col-sm-8">
						<input class="form-control" id="quantity" name="quantity" value="<?php echo $FmData[0]['quantity'];?>" type="text" onkeyup="specialcharacters_restriction(id)" onkeypress="return onlynumbers(event);">
			</div>	
			</div>
		</div>
		<div class="col-sm-6">	
				
			<div class="form-group">
				<label class="col-sm-4 control-label">Issue</label>
				<div class="col-sm-8">
					<input class="form-control" id="issue" name="issue" value="<?php echo $FmData[0]['issue'];?>" type="text">
			</div>	
			</div>
		</div>
		</div>
		
		<div class="row" >
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label"> Reason  </label>
				<div class="col-sm-8">
				<input class="form-control" id="reason" name="reason" value="<?php echo $FmData[0]['reason'];?>" type="text" >
				</div>
			</div>
		</div>
		<div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label"> Complained on  </label>
				<div class="col-sm-8">
				<input class="form-control" id="complained_on" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="complained_on" value="<?php if (isset($FmData[0]['complained_on'])){echo date('d-m-Y',strtotime($FmData[0]['complained_on']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" >
				<!-- <input class="form-control" id="complained_on" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="complained_on" value="<?php if(isset($FmData[0]['complained_on']) && $FmData[0]['complained_on']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['complained_on']));}?>" type="text" > -->
				<!-- <input class="form-control" id="design" name="design" value="<?php echo $FmData[0]['Design'];?>" type="text" > -->
				</div>
			</div>
		</div>
		</div>
		
		<div class="row" >
		    <div class="col-sm-6">	
         <div class="form-group">
				<label class="col-sm-4 control-label"> Complained to </label>
				<div class="col-sm-8">
				<input class="form-control" id="complained_to" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="complained_to" value="<?php if (isset($FmData[0]['complained_to'])){echo date('d-m-Y',strtotime($FmData[0]['complained_to']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" >
				<!-- <input class="form-control" id="complained_to" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="complained_to" value="<?php if(isset($FmData[0]['complained_to']) && $FmData[0]['complained_to']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['complained_to']));}?>" type="text" > -->
				<!-- <input class="form-control" id="quantity" name="quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" onkeypress="return onlyNumbernodecimal(event);" > -->
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
				<div class="form-group">
				<label class="col-sm-4 control-label">Remedy</label>
				<div class="col-sm-8">
						<input class="form-control" id="remedy" name="remedy" value="<?php echo $FmData[0]['remedy'];?>" type="text"   >
                            <!-- <input class="form-control" id="completed_on" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="completed_on" value="<?php if(isset($FmData[0]['CompletedDate']) && $FmData[0]['CompletedDate']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['CompletedDate']));}?>" type="text" > -->
            
                    </div>	
			</div>
		     </div>
	 </div>
     <div class="row" >
		    <div class="col-sm-6">	
			<div class="form-group">
				<label class="col-sm-4 control-label">Invoice No</label>
				<div class="col-sm-8">
						<input class="form-control" id="invoice_no" name="invoice_no" value="<?php echo $FmData[0]['invoice_no'];?>" type="text">
						<!-- <input class="form-control" id="ProcessID" name="ProcessID" value="<?php echo $FmData[0]['ProcessID'];?>" type="hidden" readonly> -->
				</div>
			</div>
		    </div>
		    <div class="col-sm-6">	
			<div class="form-group">
				<label class="col-sm-4 control-label"> Remarks & sign  </label>
				<div class="col-sm-8">
				<input class="form-control" id="remark_sign" name="remark_sign" value="<?php echo $FmData[0]['remark_sign'];?>" type="text" >
				</div>
			</div>
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
	
	
	