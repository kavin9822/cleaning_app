<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post"> 
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
    <?php if($mode == 'edit'){ ?>
     
    <script>
        // console.log('hi edit');
        
        
        function myfunction(){
            
       var CGST_SGST = document.getElementById('CGST_SGST').checked;
       var IGST = document.getElementById('IGST').checked;
      

   
   if(IGST == true)
   {
    document.getElementById('CGSTTax').readOnly = true ;
    document.getElementById('SGSTTax').readOnly = true ;
    document.getElementById('CGSTTax').value = 0 ;
    document.getElementById('SGSTTax').value = 0 ;
    document.getElementById('CGSTAmount').value = 0 ;
    document.getElementById('SGSTAmount').value = 0 ;

   }
   else{
  document.getElementById('CGSTTax').readOnly = false ;
    document.getElementById('SGSTTax').readOnly = false ;

   }
   
   if(CGST_SGST==true)
   {
    document.getElementById('IGSTTax').readOnly = true ;
    document.getElementById('IGSTTax').value = 0 ;
    document.getElementById('IGSTAmount').value = 0 ;
   }
   else{
    document.getElementById('IGSTTax').readOnly = false ;

   }
 }
     if(window.addEventListener)
     {
         window.addEventListener('load', myfunction) 
    
    }
    else
    { 
        window.attachEvent('onload', myfunction)
    }
        
    </script>

    <?php } ?>
     

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
                 <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label for="DCNo" class="col-sm-3 control-label">DC No.</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DCNo" name="DCNo" value="<?php if(isset($FmData[0]['DCNo'])){echo $FmData[0]['DCNo'];}else{echo $po_number;}?>" placeholder="DC No." type="text" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="OrderDate" class="col-sm-3 control-label"> Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="DeliveryDate" name="DeliveryDate" value="<?php if (isset($FmData[0]['DeliveryDate'])){echo date('d-m-Y',strtotime($FmData[0]['DeliveryDate']));}else{ echo date('d-m-Y');} ?>" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" type="text" required>
                    </div>
                </div>

             </div>
              
            <div class="col-md-6">    

                  <div class="form-group">
                    <label for="supplier_ID" class="col-sm-3 control-label">Customer Name</label>
                    <div class="col-sm-9">                         
                        <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onmouseover="ycssel()">
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($customer_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['customer_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['FirstName']; ?>"><?php echo $v['FirstName']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>
                </div>
               
                </div>
             
          
             <div class="col-md-6" id="#type0">  
                        <div class ="col-md-6" >
                       <div class="form-group ">
                        
                        <label class="control-label col-sm-5" for="DeliveryChoice"style="text-align:right;padding-right:0%" >Returnable</label>
                         <div class="col-sm-7" style="padding-left:9.5%;">
                        <input type="checkbox" class="check1"  name="DeliveryChoice" id="DeliveryChoice" <?php if($FmData[0]['DeliveryChoice']=='Returnable'){echo "checked='checked'"; }?> value="Returnable" > 
                          </div>
                           </div>
                           </div> 
                   <div class ="col-md-6" >
                      <div class="form-group ">
                        
                        <label class="control-label col-sm-5" for="DeliveryChoice"style="text-align:right;padding-right:0%" >Non-Returnable</label>
                         <div class="col-sm-7" style="padding-left:9.5%;">
                        <input type="checkbox" class="check2"  name="DeliveryChoice" id="DeliveryChoice"   value="Non-Returnable" <?php if($FmData[0]['DeliveryChoice']=='Non-Returnable'){echo "checked='checked'"; }?> > 
                          </div>
                           </div> 
                            </div>
           
                </div> 
                      
               
             
                
             
                
        </div>
        <div class="row">
                    <div class="col-md-6">    

                  <div class="form-group">
                    <label for="supplier_ID" class="col-sm-3 control-label">Material Type</label>
                    <div class="col-sm-9">                         
                        <select class="form-control js-example-basic-single" name="rawmaterialtype_ID" id="rawmaterialtype_ID" onmouseover="ycssel()" onchange="getRawMaterial('<?php echo $home;?>',this.value);" >
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawtype_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['rawmaterialtype_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RawMaterialType']; ?>"><?php echo $v['RawMaterialType']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>
                </div>
                </div>  
        </div>
        
        <div class="row" id="#type1">
               <div class ="col-md-6" >
                    
                <div class ="col-md-6" >
                 <div class="form-group ">
                        
                        <label class="control-label col-sm-6" for="CGST_SGST"style="text-align:right;padding-right:0%"  >CGST and SGST</label>
                         <div class="col-sm-6" style="padding-left:9.5%;">
                        <input type="radio"   class="check3"   name="TaxChoice" id="CGST_SGST"  value="CGST_SGST" <?php if($FmData[0]['TaxChoice']=='CGST_SGST'){echo "checked='checked'";}?>  onclick="taxChoise()" > 
                          </div>
                           </div>
                            </div>
                    <div class ="col-md-6" >
                           <div class="form-group ">
                        <label class="control-label col-sm-10"  style="text-align:right;"  for="IGST" >IGST</label>
                         <div class="col-sm-2" style="padding-left:8%;" >
                        <input type="radio"   class="check4"   name="TaxChoice" id="IGST" value="IGST" <?php if($FmData[0]['TaxChoice']=='IGST'){echo "checked='checked'";} ?> onclick="taxChoise()" >
                          </div>
                        </div>
                         </div>
                         
                </div>
        </div>
        <!-- /.header part  -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>                                
                            <th>Material Name</th>
                             <th>HSN Code</th>
                            <th>Quantity</th>
                            <th>Rate</th>
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
                                 <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()">
                                 </div>
                                 </div>
                                 </td>
                              <td>                                      
                                     <div class="form-group">
                                        <div class="col-sm-12">
                                          
                                           <input type=hidden name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" value=""  >
                                                    <select class="form-control" name="ItemNo_<?php echo $tii;?>" id="ItemNo_<?php echo $tii;?>"  required>
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                     <?php foreach ($raw_data as $k => $v): 
                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                      <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['RMName']; ?>"><?php echo  $v['RMName'];?></option>
                                                        <?php endforeach; ?>
                                                         </select>
                                                     
                                                        </div>
         	                                        </div>
         	                                       
                                                </td>
                                       
                         
                            <td style="position:relative;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     
                                     <input class="form-control" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if ($dataValue['HSNCode']){echo $dataValue['HSNCode'];}?>"   placeholder="HSN"  type="text" >
                                
                                    </div>
                                </div>
                            </td> 
                             
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                        <input class="form-control" id="Qty_<?php echo $tii; ?>" name="Qty_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" required placeholder="Quantity" type="text" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Emp_<?php echo $tii; ?>').val() * $('#Qty_<?php echo $tii; ?>').val()).toFixed(2))">
                                           <input type="hidden" value="<?php echo $dataValue['Quantity']; ?>" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>">
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                      <input class="form-control" id="Emp_<?php echo $tii; ?>" name="Emp_<?php echo $tii; ?>" value="<?php if($dataValue['Rate']){ echo $dataValue['Rate']; } ?>" required placeholder="Rate" type="text" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Emp_<?php echo $tii; ?>').val() * $('#Qty_<?php echo $tii; ?>').val()).toFixed(2))">
                                    
                                    </div>
                                </div>
                            </td> 
                       

                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                           
                                     <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['EstimatedAmount']){ echo $dataValue['EstimatedAmount']; } ?>"  placeholder="Estimated Amount" type="text" onkeyup="$('#Amount_<?php echo $tii; ?>').val(($('#Emp_<?php echo $tii; ?>').val() * $('#Qty_<?php echo $tii; ?>').val()).toFixed(2))" readonly>
                                  
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)">
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
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
                            
                              <td>                                     
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input type="hidden" name="ItemName_1" id="ItemName_1" value="">
                                         <select class="form-control" name="ItemNo_1" id="ItemNo_1" required >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                        
                                        </select>
                                    </div>
         	                </div>
                            </td>
                              <td>                                       
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="EmpName_1" name="EmpName_1" value="" placeholder="HSNCode" >
                                    </div>
         	                </div>
                            </td>
                             <td>                                       
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Qty_1" name="Qty_1" value="" placeholder="Quantity" onkeyup="$('#Amount_1').val(($('#Emp_1').val() * $('#Qty_1').val()).toFixed(2))" required>
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Emp_1" name="Emp_1" value="" placeholder="Rate"  style="text-align:right;" onkeyup="$('#Amount_1').val(($('#Emp_1').val() * $('#Qty_1').val()).toFixed(2))">
                                    </div>
         	                </div>
                            </td>
                            
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Estimated Amount"  style="text-align:right;" onkeyup="$('#Amount_1').val(($('#Emp_1').val() * $('#Qty_1').val()).toFixed(2))" readonly>
                                        
                                    </div>
         	                </div>
                            </td>
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
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
                                 
                                <th style="width:30%">Total :</th>
                                <th style="width:20%"><span class="<?php echo $currencySymbol; ?>"></span></th>
                                <td  style="text-align:right;"><span id="subtotal"><?php echo $FmData[0]['BillAmount'];?></span>
                                 <input class="form-control" type="hidden" id="BillAmount" name="BillAmount" value="<?php echo $FmData[0]['BillAmount'];?>">                        
                                 </td>
                               
                                </tr>
                               
                             <!--   <tr>
                                 <th>Input / GST :</th>
                                <td style="width:20%"><input class="form-control" type="text" id="Tax" name="Tax" value="18" <?php echo  $FmData[0]['Tax'];?> onkeyup="total()"></td>
                                <td><input class="form-control" type="text" id="GSTAmount" name="GSTAmount" value="<?php echo $FmData[0]['GSTAmount'];?>" onkeyup="total()"></td>
                                <td><span id="gst"></span></td>
                                 </tr>      -->                                                          
                                <tr>
                                <th> CGST :</th>
                                
                                <td style="width:20%"><input class="form-control" onkeypress="return onlyNumberKey(event)" style="text-align:right;" type="text" id="CGSTTax" name="CGSTTax" value=" <?php if(isset($FmData[0]['CGSTTax'])==true) { echo $FmData[0]['CGSTTax'];  }else{ echo 0;} ?> " onkeyup="total()"></td>
                                
                                <td><input class="form-control" type="text" id="CGSTAmount"  style="text-align:right;" name="CGSTAmount" style="text-align:right;"  value="<?php echo $FmData[0]['CGSTAmount'];?>" onkeyup="total()" readonly></td>
                                <!--<td><span id="gst"></span></td>-->
                                
                                </tr>
                                
                                
                                
                                <tr>
                                <th> SGST :</th>
                                
                                <td style="width:20%"><input class="form-control" type="text" onkeypress="return onlyNumberKey(event)" id="SGSTTax"  style="text-align:right;" name="SGSTTax" value=" <?php if(isset($FmData[0]['SGSTTax'])==true) { echo $FmData[0]['SGSTTax'];  }else{ echo 0;} ?> " onkeyup="total()"></td>
                                
                                <td><input class="form-control" type="text" id="SGSTAmount" style="text-align:right;" name="SGSTAmount" value="<?php echo $FmData[0]['SGSTAmount'];?>" onkeyup="total()" readonly  ></td>
                                <!--<td><span id="gst"></span></td>-->
                                </tr>
                                                            
                               
                               
                                <tr>
                                <th> IGST :</th>
                                
                                <td style="width:20%"><input class="form-control" type="text" onkeypress="return onlyNumberKey(event)"  id="IGSTTax" style="text-align:right;" name="IGSTTax" value=" <?php if(isset($FmData[0]['IGSTTax'])==true) { echo $FmData[0]['IGSTTax'];  }else{ echo 0;} ?> " onkeyup="total()"></td>
                                
                                <td><input class="form-control" type="text" id="IGSTAmount" style="text-align:right;" name="IGSTAmount" value="<?php echo $FmData[0]['IGSTAmount'];?>" onkeyup="total()" readonly></td>
                                <!--<td><span id="gst"></span></td>-->
                                </tr>
                              
                                 <tr>
                                <th>Net Amount :</th>
                                <th><span class="<?php echo $currencySymbol;?>"></span></th>
                                <th  style="text-align:right;" ><span id="Total"><?php echo $FmData[0]['NetAmount'];?></span>
                               <input class="form-control" type="hidden" id="NetAmount" name="NetAmount" value="" <?php echo $FmData[0]['NetAmount'];?> onkeyup="total()">
                               <input type="hidden" value="" id="maxCount" name="maxCount">
                                </th>
                                </tr>
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
   
                       

       
       
<br/>     
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'Confirm'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="confirm_submit_button" value="confirm" onmouseover="getCount(''),total()" onfocus="getCount(''),total()"> Confirm </button>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit"  onmouseover="getCount(''),total()" onfocus="getCount(''),total(),check('Please select any')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"  onmouseover="getCount(''),total()" onfocus="getCount(''),total(),check('Please select any')"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view' && $mode!= 'approve'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
</section>

