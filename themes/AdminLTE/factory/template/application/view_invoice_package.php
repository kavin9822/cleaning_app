<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 text-center" >
              <h2 class="">
            <div class="col-md-offset-3 col-md-5">
                <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:80px;">&ensp;
                
                
                    <h2 style="display:inline;"><?php echo $company_name; ?></h2>
              
                </div>
                <small class="pull-right">Date: <?php echo date('d/M/Y'); ?></small>
             </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        
        <div class="col-sm-8 invoice-col">
            To
            <address>           
                <strong><?php echo $cust_data_for_invoice[0]['FirstName']; ?><?php echo " "; ?><?php echo $cust_data_for_invoice[0]['LastName']; ?></strong><br>
                <?php if($inv_no !== "INV"){?>
                <b>GST No. </b><?php echo $cust_data_for_invoice[0]['CustomerGSTNo'];  echo nl2br("\n");
                }?>
                <?php echo $cust_data_for_invoice[0]['Address']; ?>,
                <?php echo $cust_data_for_invoice[0]['City']; ?> - <?php echo $cust_data_for_invoice[0]['Pincode']; ?>,                
                <?php echo $cust_data_for_invoice[0]['State']; ?>.
               
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice No.: <?php echo $invoicemaster['ID']; ?></b><br>
            <br>
            <b>Invoice Date:</b> <?php echo $invoicemaster['InvoiceDate']; ?><br>
            <b>Payment Mode:</b> <?php echo $payment_mode; ?><br>           
            
            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        
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
                        <td><?php echo $pack_name["ItemName"] ; ?></td>
                        <td><?php echo $Row_arr_value['Note'] ; ?></td>
                        <td><?php echo $Row_arr_value['Quantity'] ; ?></td>
                        <td><?php echo $Row_arr_value['Rate'] ; ?></td>
                        <td><?php echo $Row_arr_value['Amount'] ; ?></td>
                        
                    </tr>
                    <?php endforeach;?>
                    
                   
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
<?php function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    if($digits_length >= 10){
        echo "Sorry this does not support more than 99 crores";
    }else {
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
    return ($Rupees ? $Rupees . 'rupee ' : '') . $paise;
    }
}



?>
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <?php if($inv_no !== "INV"){?>
            <br><br><br>
            <?php } else {?>
            <br><br><br><br><br><br>
            <?php }?>
            <h4>Amount in Words</h4>
            <h3 style="text-align:left;"><?php echo getIndianCurrency($invoicemaster['BillAmount']) . ' only'; ?></h3>
        </div><!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount</p>            
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tbody>
                                              
                        <?php if($inv_no !== "INV"){?>
                        
                        <?php } else {?>         
                        
                        
                        <?php }?>
                        
                        <?php if($invoicemaster['Rebate']  > 0):?>
                        
                        <?php endif;?>
                        
                        <tr>
                            <th align="right">Total:</th>
                            <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                            <th><?php echo $invoicemaster['BillAmount']; ?></th>
                            
                        </tr>
                       
                    </tbody></table>
            </div>
             
        </div><!-- /.col -->        

        <div class="col-xs-12">
            <p>
                <b>* This is Computer generated invoice and hence requires no signature. </b>
            </p>
        </div>
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a target="_blank" class="btn btn-success pull-right" onclick="javascript:window.print()"><i class="fa fa-print"></i> Print</a>
            <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" ><i class="fa fa-list"></i> List Invoice</a>
        </div>
    </div>
</section>
</div>