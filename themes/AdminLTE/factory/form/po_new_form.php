<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Company Logo" style="width:12%"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->


        <div class="row">
            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="PurchaseOrderNo" class="col-sm-3 control-label">PurchaseOrder No.</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ID" name="ID" value="<?php echo $po_number; ?>" placeholder="PurchaseOrder No." type="text" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="OrderDate" class="col-sm-3 control-label">Purchase Order Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" id="PurchaseOrderDate" name="PurchaseOrderDate" value="" placeholder="Purchase Order Date" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_ID" class="col-sm-3 control-label">Customer ID</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="customer_ID" id="customer_ID">
                            <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($supplier_data as $sp_opt_key => $sp_opt_value): ?>
                                <option  value="<?php echo $sp_opt_key; ?>" title="<?php echo $sp_opt_key; ?>"><?php echo $sp_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>   
                
                <div class="form-group">
                    <label for="BatchNo" class="col-sm-3 control-label">Batch No.</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="BatchNo" name="BatchNo" value="<?php if(isset($bacth_no)){echo $bacth_no;} ?>" placeholder="Batch No." type="text" readonly>
                    </div>
                </div>   

            </div><!-- /.left column -->

            
            <div class="col-md-6">    

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
                
                <div class="form-group">
                    <label for="Destination" class="col-sm-2 control-label">Destination</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="Destination" name="Destination" value="<?php if(isset($destination)){echo $destination;} ?>" placeholder="Destination" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="TermsOfDelivery" class="col-sm-2 control-label">Terms Of Delivery</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="TermsOfDelivery" name="TermsOfDelivery" value="<?php if(isset($terms_of_delivery)){echo $terms_of_delivery;} ?>" placeholder="Terms Of Delivery" type="text">
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
                            <!--<th>Description</th>-->
                            <th>Quantity</th>
                            <th>Estimated Amount</th>

                        </tr>
                    </thead>
                    <tbody id="invoice_listing_table">

                        <tr id="Invoice_data_entry_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"  type="button" >
                                    </div>
                                </div>
                            </td>                            
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="RMName_1" id="RMName_1" value="" />
                                        <select class="form-control" name="ItemNo_1" id="ItemNo_1" onchange="getRMName(this.id)">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($product_data as $pd_opt_key => $pd_opt_value): ?>
                                                <option  value="<?php echo $pd_opt_key; ?>" title="<?php echo $pd_opt_value; ?>"><?php echo $pd_opt_value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>

                            <!--<td>-->
                            <!--    <div class="form-group">-->
                            <!--        <div class="col-sm-12">-->
                            <!--            <input class="form-control" id="Note_1" name="Note_1" value="" placeholder="Description" type="text">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</td>-->
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text">
                                    </div>
                                </div>
                            </td> 

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Amount_1" name="Amount_1" value="" placeholder="Estimated Amount" type="text" >
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
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/purchaseorder'; ?>" class="btn btn-default btn-primary" ><i class="fa fa-list"></i> List Purchase Order</a>
                <button type ="submit" class="btn btn-success pull-right" onmouseover="subtotal_po()" onfocus="subtotal_po()"> Submit</button>
            </div>
        </div>
    </form>

</section>
