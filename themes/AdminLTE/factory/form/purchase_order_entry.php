<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="User Image" style="width:80px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->

        <div class="row">
            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="PurchaseOrderNo" class="col-sm-2 control-label">PurchaseEntry No.</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="ID" name="ID" value="<?php if($ycs_ID){echo $ycs_ID;}else{echo $po_number;} ?>" placeholder="PurchaseEntry No." type="text" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="supplier_ID" class="col-sm-2 control-label">Supplier ID</label>
                    <div class="col-sm-10">
                        <select class="form-control js-example-basic-single" name="supplier_ID" id="supplier_ID" onmouseover="ycssel()" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($supplier_data as $sp_opt_key => $sp_opt_value): 
                                  if ($sp_opt_key == $FmData[0]['supplier_ID']) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  }
                            ?>
                                <option  <?php echo $isselected; ?>  value="<?php echo $sp_opt_key; ?>" title="<?php echo $sp_opt_key; ?>"><?php echo $sp_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>        
                
                <div class="form-group">
                    <label for="InvoiceNo" class="col-sm-2 control-label">Invoice No.</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="InvoiceNo" name="InvoiceNo" value="<?php if(isset($FmData)){echo $FmData[0]['InvoiceNo'];} ?>" placeholder="Invoice No." type="text">
                    </div>
                </div>

                <!--<div class="form-group">-->
                <!--    <label for="OrderNo" class="col-sm-2 control-label">Order No.</label>-->
                <!--    <div class="col-sm-10">-->
                <!--        <input class="form-control" id="OrderNo" name="OrderNo" value="<?php if(isset($ord_number)){echo $ord_number;} ?>" placeholder="Order No." type="text">-->
                <!--    </div>-->
                <!--</div>   -->
                
                <!--<div class="form-group">-->
                <!--    <label for="DespatchNo" class="col-sm-2 control-label">Despatch No.</label>-->
                <!--    <div class="col-sm-10">-->
                <!--        <input class="form-control" id="DespatchNo" name="DespatchNo" value="<?php if(isset($desp_number)){echo $desp_number;} ?>" placeholder="Despatch No." type="text">-->
                <!--    </div>-->
                <!--</div>      -->
                
                <div class="form-group">
                    <label for="OrderDate" class="col-sm-2 control-label">Order Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" data-provide="datetimepicker" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY" onclick="ycsdate(this.id)" id="OrderDate" name="OrderDate" value="<?php if(isset($FmData)){echo date('d-m-Y',strtotime($FmData[0]['OrderDate']));} ?>" placeholder="Order Date" type="text" required>
                    </div>
                </div>

            </div><!-- /.left column -->

            
            <div class="col-md-6">       
                
                <div class="form-group">
                    <label for="InvoiceDate" class="col-sm-2 control-label">Invoice Date</label>
                    <div class="col-sm-10">
                        <input class="form-control" data-provide="datetimepicker" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY" onclick="ycsdate(this.id)" id="InvoiceDate" name="InvoiceDate" value="<?php if(isset($FmData)){echo date('d-m-Y',strtotime($FmData[0]['InvoiceDate']));} ?>" placeholder="Invoice Date" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label for="PaymentMode" class="col-sm-2 control-label">Payment Mode</label>
                    <div class="col-sm-10">                         
                        <select class="form-control" name="PaymentMode" id="PaymentMode" required onchange="disablePayDetail(this.id,'PaymentDetail')">
                           <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($payment_mode as $pm_opt_key => $pm_opt_value): 
                            if ($pm_opt_key == $FmData[0]['PaymentMode']) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                            }
                            
                            ?>
                                <option <?php echo $isselected; ?> value="<?php echo $pm_opt_key; ?>" title="<?php echo $pm_opt_key; ?>"><?php echo $pm_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="PaymentDetail" class="col-sm-2 control-label">Payment Detail</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="PaymentDetail" name="PaymentDetail" value="<?php if(isset($destination)){echo $destination;} ?>" placeholder="Cheque No. / Transaction ID" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="TermsOfDelivery" class="col-sm-2 control-label">Terms Of Delivery</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="TermsOfDelivery" name="TermsOfDelivery" value="<?php if(isset($FmData)){echo $FmData[0]['TermsOfDelivery'];} ?>" placeholder="Terms Of Delivery" type="text">
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
                            <th>Product</th>
                            <th>Hsn/Sac Code</th>                            
                            <th>Description</th>
                            <th>Tax %</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody id="invoice_listing_table">
                        <?php 
                                        	if(is_array($FmData) && count($FmData) >= 1):
                                        	$tii = 1;
                                                foreach ($FmData as $dataValue):
                                                ?>
                                             
                                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1){ ?>onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()"<?php } ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="Item_<?php echo $tii; ?>" id="Item_<?php echo $tii; ?>" onchange="$('#ItemName_<?php echo $tii; ?>').val($('#Item_<?php echo $tii; ?>').children(':selected').data('hsnsac')),validateExist(this.id,'invoice_listing_table')" required>
                                                                <option value="" disabled selected style="display:none;">Select</option>
                                                                <?php foreach ($product_data as $pd_opt_value): 
                                                                    if ($pd_opt_value['ID'] == $dataValue['ItemNo']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                ?>
                                                                    <option <?php echo $isselected; ?> value="<?php echo $pd_opt_value['ID']; ?>" title="<?php echo $pd_opt_value['ItemName']; ?>" data-hsnsac="<?php echo $pd_opt_value['HsnSacCode']; ?>"><?php echo $pd_opt_value['ItemName']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <script>
                                                    function my_code(){
                                                      $('#ItemName_<?php echo $tii; ?>').val($('#Item_<?php echo $tii; ?>').children(':selected').data('hsnsac'));
                                                    }
                                       
                                                    if(window.addEventListener){ window.addEventListener('load', my_code) 
                        
                                                    }else{ window.attachEvent('onload', my_code) }
                                                </script>
                                                                    
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="" placeholder="HsnSac Code" type="text" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php echo $dataValue['Description']; ?>" placeholder="Description" type="text">
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php echo $dataValue['TaxPercentage']; ?>" placeholder="Tax %" type="text">
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Rate_<?php echo $tii; ?>" name="Rate_<?php echo $tii; ?>" value="<?php echo $dataValue['Rate']; ?>" placeholder="Rate" type="text" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Rate_<?php echo $tii; ?>').val() * $('#Quantity_<?php echo $tii; ?>').val()).toFixed(2))" required>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php echo $dataValue['Quantity']; ?>" placeholder="Quantity" type="text" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Rate_<?php echo $tii; ?>').val() * $('#Quantity_<?php echo $tii; ?>').val()).toFixed(2))" required>
                                                            <input type="hidden" value="<?php echo $dataValue['Quantity']; ?>" id="Field_<?php echo $tii; ?>" name="Field_<?php echo $tii; ?>">
                                                        </div>
                                                    </div>
                                                </td>               
                                            
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php echo $dataValue['Amount']; ?>" placeholder="Amount" type="text" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                    
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRow(<?php echo count($FmData)+1; ?>,'PurEntry')">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                            
                                        <?php 
                                        //this + 5 increment is to manage new entry by javascript on edition mode
                                        // so on edit with existing entry one can add additional 4 entries can do 
                                        //or del and add many as possible
                                        $tii = $tii+1;
                                            endforeach;
                                        else: 
                                        ?>
                    
                   

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
                                        <select class="form-control" name="Item_1" id="Item_1" onchange="$('#ItemName_1').val($('#Item_1').children(':selected').data('hsnsac')),validateExist(this.id,'invoice_listing_table')" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($product_data as $pd_opt_value): ?>
                                                <option  value="<?php echo $pd_opt_value['ID']; ?>" title="<?php echo $pd_opt_value['ItemName']; ?>" data-hsnsac="<?php echo $pd_opt_value['HsnSacCode']; ?>"><?php echo $pd_opt_value['ItemName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="ItemName_1" name="ItemName_1" value="" placeholder="HsnSac Code" type="text" readonly>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Note_1" name="Note_1" value="" placeholder="Description" type="text">
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="EmpName_1" name="EmpName_1" value="0" placeholder="Tax %" type="text">
                                    </div>
                                </div>
                            </td>
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Rate_1" name="Rate_1" value="" placeholder="Rate" type="text" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))" required>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" type="text" onkeyup="$('#Amount_1').val(($('#Rate_1').val() * $('#Quantity_1').val()).toFixed(2))" required>
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
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRow('','PurEntry')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                         <?php endif; ?>
                   
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
                        <tbody><tr>
                                <th style="width:30%">Subtotal:</th>
                                <th style="width:20%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><span id="subTotal"><?php if(isset($FmData)){echo ($FmData[0]['BillAmount']-$FmData[0]['TaxAmount']-$FmData[0]['FreightAmount']);} ?></span></td>
                            </tr>
 
                            <tr>
                                <th>Tax Amount: </th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><span id="tax"><?php if(isset($FmData)){echo $FmData[0]['TaxAmount'];} ?></span></td>
                                <input class="form-control" type="hidden" id="totTaxAmount" name="totTaxAmount" value="" readonly>
                            </tr>
 
 			                <tr>
                                <th>Freight Amount:</th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td><input class="form-control" type="text" id="FreightAmount" name="FreightAmount" value="<?php if(isset($FmData)){echo $FmData[0]['FreightAmount'];}else{echo '0';} ?>" required></td>
                            </tr>

                            <input class="form-control" type="hidden" id="rebate" name="rebate" value="0" readonly>
                            <!--<tr>-->
                            <!--    <th>Rebate If applicable:</th>-->
                            <!--    <th><span class="<?php echo $currencySymbol; ?>"></span></th>-->
                            <!--    <td><input class="form-control" type="text" id="rebate" name="rebate" value="0" readonly></td>-->
                            <!--</tr>-->
                           
                            <tr>
                                <th>Total:</th>
                                <th><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <th><span id="Total"><?php if(isset($FmData)){echo $FmData[0]['BillAmount'];} ?></span>
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
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="subtotal_po(<?php echo count($FmData); ?>)" onfocus="subtotal_po(<?php echo count($FmData); ?>)"> Submit </button>
                <?php } else if($mode == 'add') { ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="subtotal_po()" onfocus="subtotal_po()"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
      </form>

</section>
