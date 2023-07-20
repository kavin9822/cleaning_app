<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <img src="<?php echo $logo_image; ?>" class="img-circle" alt="User Image">
                <small class="pull-right">Date: <?php echo date('d/M/Y'); ?></small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong><?php echo $company_name; ?></strong><br>
                <?php echo $company_Address; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong><?php echo $cust_data_for_invoice['Name']; ?></strong><br>
                <?php echo $cust_data_for_invoice['Address']; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice No: <?php echo $invoicemaster['ID']; ?></b><br>
            <br>
            <b>Invoice Type:</b> <?php echo $invoicemaster['InvoiceType']; ?><br>
            <b>Order ID:</b> <?php echo $invoicemaster['OrderNo']; ?><br>
            <b>Payment Due Date:</b> <?php echo $invoicemaster['DueDate']; ?><br>
            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Package ID</th>
                        <th>Rate</th>
                        
                        <th>Quantity</th>
                        <th>Start Date</th>
                        <th>Closing Date</th>
                        
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
                        <td><?php echo $Row_arr_value['PackageId'] ; ?></td>
                        <td><?php echo $Row_arr_value['Rate'] ; ?></td>
                        <td><?php echo $Row_arr_value['Qantity'] ; ?></td>
                        <td><?php echo $Row_arr_value['StartDate'] ; ?></td>
                        <td><?php echo $Row_arr_value['EndDate'] ; ?></td>
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
        </div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Period: <?php echo $invoicemaster['Period']; ?></p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td><?php echo $currencySymbol. ' '. $sub_total; ?></td>
                        </tr>
                        
                        <?php if($invoicemaster['rebate']  > 0):?>
                        <tr>
                            <th>Rebate:</th>
                            <td>$<?php echo $invoicemaster['rebate']; ?></td>
                        </tr>
                        <?php endif;?>
                        
                        <tr>
                            <th>Tax (<?php echo $invoicemaster['Tax']; ?>%)</th>
                            <td><?php echo $currencySymbol. ' '. ($invoicemaster['Tax'] * $sub_total); ?></td>
                        </tr>
                        
                        <tr>
                            <th>Total:</th>
                            <td><?php echo $currencySymbol. ' '. $invoicemaster['BillAmount']; ?></td>
                        </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a target="_blank" class="btn btn-default btn-primary pull-right" onclick="javascript:window.print()"><i class="fa fa-print"></i> Print</a>
            
            <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-default btn-primary" ><i class="fa fa-print"></i> List Invoice</a>
        </div>
    </div>
</section>