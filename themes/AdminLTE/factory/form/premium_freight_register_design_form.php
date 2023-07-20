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
                       <label  class="col-sm-3 control-label">Freight Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="FreightDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="FreightDate" value="<?php if (isset($FmData[0]['FreightDate'])){echo date('d-m-Y',strtotime($FmData[0]['FreightDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="1" required>
			          </div>
		          </div>
		            <div class="form-group">
                       <label  class="col-sm-3 control-label">Rawmaterial Name</label>
			           <div class="col-sm-9">
			               <?php if(isset($FmData[0]['RawmaterialID'])) { ?>
                              <input id="RawmaterialID" name="RawmaterialID" value="<?php if($FmData[0]['RawmaterialID']){echo $FmData[0]['RawmaterialID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="RawmaterialID" id="RawmaterialID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="RawmaterialID" id="RawmaterialID" tabindex="1" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($rawmaterial_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['RawmaterialID']) {
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
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Dispatch Date</label>
			           <div class="col-sm-9">
					   <input class="form-control" id="DispatchDate" name="DispatchDate" value="<?php echo $FmData[0]['DispatchDate'];?>" type="text" tabindex="2" readonly> 
			          </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Invoice Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="InvoiceDate" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" name="InvoiceDate" value="<?php if (isset($FmData[0]['InvoiceDate'])){echo date('d-m-Y',strtotime($FmData[0]['InvoiceDate']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" tabindex="1" required>
			          </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Quantity</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Quantity" name="Quantity" value="<?php echo $FmData[0]['Quantity'];?>" type="text" tabindex="6" onkeyup="validateField(this.id,'number');" required> 
					  </div>
		           </div>
				   <div class="form-group">
                       <label  class="col-sm-3 control-label">Remarks & Sign</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Remarks" name="Remarks" value="<?php echo $FmData[0]['Remarks'];?>" type="text" tabindex="6" required> 
					  </div>
		           </div>
				 </div>
			   <div class="col-lg-6">
			   <div class="form-group">
                       <label  class="col-sm-3 control-label">Supplier Name</label>
			           <div class="col-sm-9">
			               <?php if(isset($FmData[0]['SupplierID'])) { ?>
                              <input id="SupplierID" name="SupplierID" value="<?php if($FmData[0]['SupplierID']){echo $FmData[0]['SupplierID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="SupplierID" id="SupplierID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="SupplierID" id="SupplierID" tabindex="1" onchange="Fetch_premium_freight_Data(this.value,'Purchaseorder_no','RawmaterialID','DispatchDate')" required>
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
			          </div>
		          </div>
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">PurchaseOrder No</label>
			           <div class="col-sm-9">
					      <input class="form-control" id="Purchaseorder_no" name="Purchaseorder_no" value="<?php echo $FmData[0]['Purchaseorder_no'];?>" type="text" tabindex="2" readonly> 
			          </div>
		          </div>
				     <div class="form-group">
                       <label  class="col-sm-3 control-label">Mode Of Transport</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Transport_mode" name="Transport_mode" value="<?php echo $FmData[0]['Transport_mode'];?>" type="text" tabindex="4" required > 
			          </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Invoice No</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Invoice_no" name="Invoice_no" value="<?php echo $FmData[0]['Invoice_no'];?>" type="text" tabindex="4" required > 
			          </div>
		          </div>
				    <div class="form-group">
                       <label  class="col-sm-3 control-label">Freight Paid</label>
			           <div class="col-sm-9">
			               <input class="form-control" id="Freight_paid" name="Freight_paid" value="<?php echo $FmData[0]['Freight_paid'];?>" type="text" tabindex="4" required > 
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
                <button type ="submit" class="btn btn-success pull-right" onmouseover="getCount()" name="edit_submit_button" value="edit"> Submit </button>
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
  <style>
     input[type="file"]{
         color: transparent;
      }
  </style>
</section>         
            