<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">            
                <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo">
                <?php echo " "; ?><?php echo $page_title; ?>
                <small class="pull-right">Date: <?php echo date('d/M/Y'); ?></small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong><?php echo "S.P Systems,"; ?></strong><br>
                <?php echo $company_Address; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
            <?php if($cust_data_for_invoice[0] == null):?> 
            	<strong><?php echo $byr_data_for_invoice[0]['Name']; ?></strong><br>
                <?php echo $byr_data_for_invoice[0]['Address']; ?>,
                <?php echo $byr_data_for_invoice[0]['City']; ?> - <?php echo $byr_data_for_invoice[0]['Pincode']; ?>,                
                <?php echo $byr_data_for_invoice[0]['State']; ?>.
            <?php else:?>  
                <strong><?php echo $cust_data_for_invoice[0]['FirstName']; ?><?php echo " "; ?><?php echo $cust_data_for_invoice[0]['LastName']; ?></strong><br>
                <?php echo $cust_data_for_invoice[0]['Address']; ?>,
                <?php echo $cust_data_for_invoice[0]['City']; ?> - <?php echo $cust_data_for_invoice[0]['Pincode']; ?>,                
                <?php echo $cust_data_for_invoice[0]['State']; ?>. 
            <?php endif;?>                
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice No: <?php echo $invoicemaster['ID']; ?></b><br>
            
            <b>Invoice Date:</b> <?php echo $invoicemaster['InvoiceDate']; ?><br>  
            <b>Order No.:</b> <?php echo $invoicemaster['OrderNo']; ?><br>
            <b>Payment Mode:</b> <?php echo $invoicemaster['PaymentMode']; ?><br>                       
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Product</th>
                        <th>Rate</th>                        
                        <th>Quantity</th>                        
                        <th>Note</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    $sub_total = 0;
                    foreach ($invoice_details as $key => $Row_arr_value) :
                     
                      $sub_total += $Row_arr_value['Amount'];  
                    
                    ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $Row_arr_value['ItemNo'] ; ?></td>
                        <td><?php echo $Row_arr_value['Rate'] ; ?></td>
                        <td><?php echo $Row_arr_value['Qantity'] ; ?></td>
                        <td><?php echo $Row_arr_value['Description'] ; ?></td>
                        <td><?php echo $Row_arr_value['Amount'] ; ?></td>
                        
                    </tr>
                    <?php endforeach;?>
                    
                   
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <br><br><br>
            <div class="table table-responsive">
                <td><u><b>Company Details :</b></u></td><br>
                <td><strong>TIN No. </strong><?php echo " 33963204686"; ?></td><br>
                <td><strong>CST No. </strong><?php echo " 993213"; ?></td><br>  
                <td><strong>Dated: </strong><?php echo " 03-Feb-2010"; ?></td>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Amount</p>
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tbody>
                        <tr>
                            <th style="width:60%" align="right">Subtotal:</th>
                            <th  style="width:5%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <td><?php echo $sub_total; ?></td>
                        </tr>                       
                        
                        <tr>
                            <th align="right">Tax: </th>
                            <th>(<?php echo $invoicemaster['Tax']; ?>%)</th>
                            <td><?php echo round(($invoicemaster['Tax'] * $sub_total / 100),2); ?></td>
                        </tr>
                        
                        <?php if($invoicemaster['rebate']  > 0):?>
                        <tr>
                            <th align="right">Rebate:</th>
                            <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <td><?php echo $invoicemaster['rebate']; ?></td>
                        </tr>
                        <?php endif;?>
                        
                        <tr>
                            <th align="right">Total:</th>
                            <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <th><?php echo $invoicemaster['BillAmount']; ?></th>
                        </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->
        
        <div class="col-xs-8">
              <p>This is to certify that the above materials received are in the form of
		Computer parts and not in assembled condition, and in agreement of
		all terms & conditions. Subject to Tiruchengode Magistrate only.</p> 
	      <br><br>
	      <p><b>Customer Signature</b></p>             
        </div>
        
        <div class="col-xs-4 text-right">
              <br><br>
              <p style="margin-right:20px"><b>For S.P SYSTEMS,</b></p> 
	      <br><br>
	      <p style="margin-right:20px"><b>Authorised Signature</b></p>             
        </div>
        
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a target="_blank" class="btn btn-success pull-right" onclick="javascript:window.print()"><i class="fa fa-print"></i> Print</a>
            <a href="<?php echo $home . '/' . $module . '/' . $controller . '/entry'; ?>" class="btn btn-primary" ><i class="fa fa-plus-square"></i> Add Invoice</a>
            <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" ><i class="fa fa-list"></i> List Invoice</a>
        </div>
    </div>
</section>