<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <img src="<?php echo $logo_image; ?>" class="img-circle" alt="Company Logo" width="12%">
                <?php echo " "; ?><?php echo $page_title; ?>
                <small class="pull-right">Date: <?php echo date('d/M/Y'); ?></small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    
    <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
            From
            <address>
                <strong><?php echo $cust_data['FirstName'].' '.$cust_data['LastName']; ?></strong><br>
                <?php echo $cust_data['Address']; ?>
            </address>
        </div><!-- /.col -->
        <!--<div class="col-sm-4 invoice-col">-->
           <!-- To -->
        <!--    <address>-->
        <!--        <strong><?php if(isset($supp_data_for_purchase_order)){echo $supp_data_for_purchase_order['Name'];} ?></strong><br>-->
        <!--        <?php if(isset($supp_data_for_purchase_order)){echo $supp_data_for_purchase_order['Address'];} ?>-->
        <!--    </address>-->
        <!--</div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>PurchaseOrder No: <?php echo $pur_order['PurchaseOrderNo']; ?></b><br>
            <br>            
            <b>Batch No:</b> <?php echo $pur_order['BatchNo']; ?><br>
            <b>Purchase Order Date:</b> <?php echo $pur_order['PurchaseOrderDate']; ?><br>
            
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
                        <th>Quantity</th>                        
                        <th>Estimated Amount</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    $sub_total = 0;
                    //var_dump($pur_ord_detail);
                    foreach ($pur_ord_detail as $key => $Row_arr_value) :
                     
                      $sub_total += $Row_arr_value['Amount'];  
                    
                    ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $Row_arr_value['ItemName'] ; ?></td> 
                        <td><?php echo $Row_arr_value['Quantity'] ; ?></td>
                        <td><?php echo $Row_arr_value['EstimatedAmount'] ; ?></td>
                        
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
            <p class="lead">InvoiceDate: <?php echo $pur_order['InvoiceDate']; ?></p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <!--<tr>-->
                        <!--    <th style="width:50%">Subtotal:</th>-->
                        <!--    <td><i class="fa fa-inr"></i><?php echo ' '. $sub_total; ?></td>-->
                        <!--</tr>-->
                        	
                        <!--<?php if($pur_order['FreightAmount']  > 0):?>-->
                        <!--<tr>-->
                        <!--    <th>Rebate:</th>-->
                        <!--    <td>$<?php echo $pur_order['FreightAmount']; ?></td>-->
                        <!--</tr>-->
                        <!--<?php endif;?>-->
                        
                        <!--<?php if($pur_order['rebate']  > 0):?>-->
                        <!--<tr>-->
                        <!--    <th>Rebate:</th>-->
                        <!--    <td>$<?php echo $pur_order['rebate']; ?></td>-->
                        <!--</tr>-->
                        <!--<?php endif;?>-->
                        
                        <!--<tr>-->
                        <!--    <th>Tax (<?php echo $pur_order['Tax']; ?>%)</th>-->
                        <!--    <td><i class="fa fa-inr"></i><?php echo ' '. ($pur_order['Tax'] * $sub_total); ?></td>-->
                        <!--</tr>-->
                        
                        <tr>
                            <th>Total:</th>
                            <td><i class="fa fa-inr"></i><?php echo ' '.$pur_order['BillAmount']; ?></td>
                        </tr>
                    </tbody></table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a target="_blank" class="btn btn-default btn-primary pull-right" onclick="javascript:window.print()"><i class="fa fa-print"></i> Print</a>
            
            <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-default btn-primary" ><i class="fa fa-print"></i> List PurchaseOrder</a>
        </div>
    </div>
</section>