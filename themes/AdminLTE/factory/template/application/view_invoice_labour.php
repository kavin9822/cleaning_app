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
                <strong><?php echo $company_name; ?></strong><br>
                <?php echo $company_Address; ?>
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>           
                <strong><?php echo $cust_data_for_invoice[0]['FirstName']; ?><?php echo " "; ?><?php echo $cust_data_for_invoice[0]['LastName']; ?></strong><br>
                <?php echo $cust_data_for_invoice[0]['Address']; ?>,
                <?php echo $cust_data_for_invoice[0]['City']; ?> - <?php echo $cust_data_for_invoice[0]['Pincode']; ?>,                
                <?php echo $cust_data_for_invoice[0]['State']; ?>.
               
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice No.: <?php echo $invoicemaster['ID']; ?></b><br>
            <br>
            <b>Invoice Date:</b> <?php echo $invoicemaster['InvoiceDate']; ?><br>
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
                        <th>Description</th>
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
            <br><br>
            <div class="table table-responsive">
                <td><u><b>Company Details :</b></u></td><br>
                <td><strong>CIN No. </strong><?php echo $company_Cin; ?><?php echo " "; ?></td><br>
                <td><strong>TIN No. </strong><?php echo $company_Tin; ?><?php echo " "; ?></td><br>
                <td><strong>CST No. </strong><?php echo $company_Cst; ?><?php echo " "; ?></td><br>  
                <td><strong>ServiceTax No. </strong><?php echo $company_SerTax; ?><?php echo " "; ?></td> 
                       
             </div>
        </div><!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount</p>            
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tbody>
                        <tr>
                            <th style="width:60%" align="right">Subtotal:</th>
                            <th style="width:5%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <td><?php echo $sub_total; ?></td>
                        </tr>                         
                        
                        <tr>
                            <th align="right">Rebate:</th>
                            <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <td><?php echo $invoicemaster['Rebate']; ?></td>
                        </tr>                        
                        
                        <tr>
                            <th align="right">Total:</th>
                            <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <th><?php echo $invoicemaster['LabourCharge']; ?></th>
                        </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->        
        <div class="col-xs-12">
              <p>Please Pay by <b>DD / Crossed cheque</b> in favour of <b>"SP Internet Technologies (P) Ltd."</b><br></p>
              <p><b>Bank Details:</b> SP Internet Technologies (P) Ltd., <b>A/c No.</b> 915020038526612, <b>IFSC Code:</b> UTIB0000690, <b>Axis Bank, Tiruchengode</b> Branch</p>
        </div>
        <div class="col-xs-12">
            <p>
                <strong>Terms & Conditions:</strong><br>
                <b>1.</b> Payment should be made on or before due date.<br>
                <b>2.</b> In the case of bouncing of Cheque or settling the due beyond the credit period, interest will be collected
@24%p.a from the date of expiry of the due date (mentioned above) till the date of its Final settlement.<br>
                <b>3.</b> If the o/s balance is not settled within 5 days from the due date the link will be terminated without any
further intimation.<br>
                <b>4.</b> For Cheque bouncing <span class="<?php echo $currencySymbol; ?>"></span> 250/- will be debited in your account.
            </p>
            <p>
                <b>* This is Computer generated invoice and hence requires no signature. </b>
            </p>
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