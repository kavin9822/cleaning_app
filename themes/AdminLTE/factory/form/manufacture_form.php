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
                        <select class="form-control" name="PurchaseOrderNo" id="PurchaseOrderNo" onchange="$('#BatchNo').val($('#PurchaseOrderNo').find(':selected').data('batchno'));getPODetailsManuf('<?php echo $home; ?>',this.value);">
                            <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($po_data as $key => $value): ?>
                                <option  value="<?php echo $value['ID']; ?>" data-batchno= "<?php echo $value['BatchNo']; ?>" title="<?php echo $value['PurchaseOrderNo']; ?>"><?php echo $value['PurchaseOrderNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-6">                 

                <div class="form-group">
                    <label for="BatchNo" class="col-sm-2 control-label">BatchNo</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="BatchNo" name="BatchNo" value="" placeholder="Destination" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        <!-- /.header part  -->
        <h5><u>Purchase Order Detail</u></h5>
        <div class="box-body">
            <div id="showData">
                
                
            </div>
        </div>
 
        <!-- Table row -->
        <!--<div class="row">-->
        <!--    <div class="col-xs-12 table-responsive">-->
        <!--        <table class="table table-striped">-->
        <!--            <thead>-->
        <!--                <tr>-->
        <!--                    <th></th>                                -->
        <!--                    <th>Raw Material</th>-->
                            <!--<th>Description</th>-->
        <!--                    <th>Quantity</th>-->

        <!--                </tr>-->
        <!--            </thead>-->
        <!--            <tbody id="invoice_listing_table">-->

        <!--                <tr id="Invoice_data_entry_1">-->
        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"  type="button" >-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>                            -->
                            
        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-10">-->
        <!--                                <input type="hidden" name="RMName_1" id="RMName_1" value="" />-->
        <!--                                <select class="form-control" name="ItemNo_1" id="ItemNo_1" onchange="getRMName(this.id)">-->
        <!--                                    <option value="" disabled selected style="display:none;">Select</option>-->
                                       
        <!--                                    <?php foreach ($rm_data as $key => $value): ?>-->
        <!--                                        <option  value="<?php echo $value['ID']; ?>" title="<?php echo $value['RMName']; ?>"><?php echo $value['RMName']; ?></option>-->
        <!--                                    <?php endforeach; ?>-->
        <!--                                </select>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>-->

        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control" id="Note_1" name="Note_1" value="" placeholder="Description" type="text">-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>-->
                            
        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))">-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td> -->
                           
        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control" id="Rate_1" name="Rate_1" value="" placeholder="Rate" type="text" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))">-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>-->

        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control" id="Amount_1" name="Amount_1" value="" placeholder="Amount" type="text" readonly>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>-->

        <!--                    <td>-->
        <!--                        <div class="form-group">-->
        <!--                            <div class="col-sm-12">-->
        <!--                                <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRow()">-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </td>-->
        <!--                </tr>-->

        <!--            </tbody>-->
        <!--        </table>-->
        <!--    </div><!-- /.col -->
        <!--</div><!-- /.row -->




        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                
            </div><!-- /.col -->
            <!--
            <div class="col-xs-6">
                <p class="lead"><b>Amount</b></p>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive">
                        <tbody><tr>
                                <th style="width:30%">Subtotal:</th>
                                <th style="width:20%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><span id="subTotal"></span></td>
                            </tr>
 
                            <tr>
                                <th>Tax (<span><?php echo $taxPercent; ?></span>%)<input type="hidden" name="taxPercent" id="taxPercent" value="<?php echo $taxPercent; ?>"> </th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><span id="tax"></span></td>
                            </tr>
 
 			                <tr>
                                <th>Freight Amount:</th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><input class="form-control" type="text" id="FreightAmount" name="FreightAmount" value="0"></td>
                            </tr>
                           
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
    <!--    </div> --><!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/manage'; ?>" class="btn btn-default btn-primary margin" ><i class="fa fa-list"></i> List Store</a>
                <button type ="submit" class="btn btn-success pull-right margin" > Submit</button>
            </div>
        </div>
    </form>

</section>
