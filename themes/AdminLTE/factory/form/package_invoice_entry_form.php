<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="height:80px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->


        <div class="row">
            <div class="col-md-6">       
                <div class="form-group">
                    <label for="customer_ID" class="col-sm-2 control-label">Farmer</label>
                    <div class="col-sm-10">
                        <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onmouseover="ycssel()" onchange="$('#DueDate').val($('#customer_ID').find(':selected').data('duedate'));          
          $('#PackageId_1').val($('#customer_ID').find(':selected').data('pac'));
          $('#packageName').val($('#customer_ID').find(':selected').data('pacname'));
          $('#StartDate_1').val($('#customer_ID').find(':selected').data('stdate'));
          $('#EndDate_1').val($('#customer_ID').find(':selected').data('endate'));        
          $('#Amount_1').val($('#customer_ID').find(':selected').data('amt'));     
           " required>
           <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($customer_data as $cd_opt_value): ?>
                                <option  value="<?php echo $cd_opt_value['ID']; ?>" data-duedate= "<?php echo $cd_opt_value['DueDate']; ?>"
          data-pac= "<?php echo $cd_opt_value['package_ID']; ?>"
          data-pacname= "<?php echo $cd_opt_value['SMPackName']; ?>"
          data-stdate= "<?php echo $cd_opt_value['PackStartDate']; ?>" 
          data-endate= "<?php echo $cd_opt_value['PackExpireDate']; ?>"          
          data-amt= "<?php echo $cd_opt_value['Amount']; ?>" > <?php echo $cd_opt_value['ID']; ?><?php echo " | "; ?><?php echo $cd_opt_value['FirstName']; ?><?php echo " | "; ?><?php echo $cd_opt_value['MobileNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="InvoiceNo" class="col-sm-2 control-label">Bill No.</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="InvoiceNo" name="InvoiceNo" value="<?php echo $inv_number; ?>" placeholder="Invoice No" type="text" readonly >
                    </div>
                </div>
      
            </div><!-- /.left column -->

            <div class="col-md-6">

                <div class="form-group">
                    <label for="InvoiceDate" class="col-sm-2 control-label">Invoice Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" id="InvoiceDate" name="InvoiceDate" value="<?php echo date('Y-m-d') ?>" type="text">
                    </div>
                </div>   

                <div class="form-group">
                    <label for="PaymentMode" class="col-sm-2 control-label">Payment Mode</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="PaymentMode" id="PaymentMode">
                            <?php foreach ($payment_mode as $pm_opt_key => $pm_opt_value): ?>
                                <option  value="<?php echo $pm_opt_key; ?>" title="<?php echo $pm_opt_key; ?>"><?php echo $pm_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div><!-- /.left column -->            
        </div>
        
        <!-- /.header part  -->
        
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody id="invoice_listing_table">

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
                                        <select class="form-control" name="ItemName_1" id="ItemName_1">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($product_data as $prd_opt_key => $prd_opt_value): ?>
                                                <option  value="<?php echo $prd_opt_value['ID']; ?>" title="<?php echo $prd_opt_value['ItemName']; ?>"><?php echo $prd_opt_value['ItemName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>

                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_1" name="Note_1" value="" placeholder="Description">
                                    </div>
         	                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))">
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Rate_1" name="Rate_1" value="" placeholder="Rate" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))"> 
                                    </div>
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Amount_1" name="Amount_1" value="" placeholder="Amount" type="text" readonly>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRow()">
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->




        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead"><b>Amount</b></p>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive">
                        <tbody>
                            <!--
                            <tr>
                                <th style="width:40%">Subtotal:</th>
                                <th style="width:15%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><span id="subTotal"></span></td>
                            </tr>
                            
                            <tr>
                                <th>Rebate If applicable:</th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><input class="form-control" type="text" id="Rebate" name="Rebate" value="0.00"></td>
                            </tr>
                            -->
                            <tr>
                                <th>Total:</th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <th><span id="Total"></span>
                                    <input type="hidden" value="" name="BillAmount" id="BillAmount">
                                    <input type="hidden" value="" id="maxCount" name="maxCount">
                                </th>
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
<a href="<?php echo $home . '/' . $module . '/' . $controller . '/manage'; ?>" class="btn btn-primary" ><i class="fa fa-list"></i> List Invoice</a>
                <button type ="submit" class="btn btn-success pull-right" onmouseover="subtotal()" onfocus="subtotal()"><i class="fa fa-credit-card"></i> Submit Payment</button>
            </div>
        </div>
    </form>

</section>