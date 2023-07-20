<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post"> 
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
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
                         
                        <?php if($mode=='edit' or $mode=='view'){?>
                         <select class="form-control js-example-basic-single" name="dc_ID" id="dc_ID" disabled>
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($deliverychallan_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['dc_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['DCNO']; ?>"><?php echo $v['DCNO']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                          <?php echo isset($FmData[0]['dc_ID']) && ($FmData[0]['dc_ID']!='') ? '<input id="dc_ID" name="dc_ID" value='.$FmData[0]["dc_ID"].'  type="hidden">' : ''; ?>
                        <?php } else{?>
                        
                        <select class="form-control js-example-basic-single" name="dc_ID" id="dc_ID" required onchange="getdeliverychallandetails('<?php echo $home; ?>',this.value);getdcproduct('<?php echo $home; ?>',this.id);" onmouseover="ycssel()">
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($deliverychallan_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['dc_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['DCNO']; ?>"><?php echo $v['DCNO']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                       <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="OrderDate" class="col-sm-3 control-label"> Gate Inward Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DeliveryDate" name="DeliveryDate" value="<?php  if (isset($DCData[0]['DeliveryDate'])){echo date('d-m-Y',strtotime($DCData[0]['DeliveryDate']));}?>"   placeholder=""  type="text" readonly >
                    </div>
                </div>

             </div>
              
            <div class="col-md-6">    

                  <div class="form-group">
                    <label for="supplier_ID" class="col-sm-3 control-label">Customer Name</label>
 
                    <div class="col-sm-9">    
                        <input class="form-control" id="customer_ID" name="customer_ID" value="" type="hidden" readonly>
                        <input class="form-control" id="customername" name="customername" value="<?php if (isset($DCData[0]['FirstName'])){echo $DCData[0]['FirstName'];} ?>" type="text"readonly>
                        
                    </div>
                </div>
                
                </div>
             
             <div class="col-md-6">  
                        <div class ="col-md-6" >
                       <div class="form-group ">
                        
                        <label class="control-label col-sm-5" for="DeliveryChoice"style="text-align:right;padding-right:0%" >Returnable</label>
                         <div class="col-sm-7" style="padding-left:9.5%;">
                        <input type="checkbox"  name="DeliveryChoice" id="DeliveryChoice" <?php if($DCData[0]['DeliveryChoice']=='Returnable'){echo "checked='checked'"; }?> value="Returnable" onclick="return false;" > 
                          </div>
                           </div>
                           </div> 
                   <div class ="col-md-6" >
                      <div class="form-group ">
                        
                        <!--<label class="control-label col-sm-5" for="DeliveryChoice"style="text-align:right;padding-right:0%" >Non-Returnable</label>-->
                        <!-- <div class="col-sm-7" style="padding-left:9.5%;">-->
                        <!--<input type="checkbox"  name="DeliveryChoice" id="DeliveryChoice"   value="Non-Returnable" <?php if($FmData[0]['DeliveryChoice']=='Non-Returnable'){echo "checked='checked'"; }?> > -->
                          </div>
                           </div> 
                            </div>
                </div> 
                   
               <!--<div class="row">
                  <div class="col-md-6">    

                  <div class="form-group">
                    <label for="materialtype" class="col-sm-3 control-label">Material Type</label>
 
                    <div class="col-sm-9">    
                        <input class="form-control" id="rawmaterialtype_ID" name="rawmaterialtype_ID" value="" type="hidden" readonly>
                        <input class="form-control" id="rawtype" name="rawtype" value="<?php if (isset($DCData[0]['RawMaterialType'])){echo $DCData[0]['RawMaterialType'];}  ?>" type="text" readonly>
                        
                    </div>
                </div>  
               </div>
             
                 </div>-->
                           <div class="row">
                  <div class="col-md-6">    

                  <div class="form-group">
                    <label for="materialtype" class="col-sm-3 control-label">Gate No</label>
 
                    <div class="col-sm-9">    
                          
                        <?php if($mode=='edit' or $mode=='view'){?>
                         <select class="form-control js-example-basic-single" name="gateinfo_ID" id="gateinfo_ID" disabled>
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($gate_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['gateinfo_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{   
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['GateNO']; ?>"><?php echo $v['GateNO']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                          <?php echo isset($FmData[0]['gateinfo_ID']) && ($FmData[0]['gateinfo_ID']!='') ? '<input id="gateinfo_ID" name="gateinfo_ID" value='.$FmData[0]["gateinfo_ID"].'  type="hidden">' : ''; ?>
                        <?php } else{?>
                        
                        <select class="form-control js-example-basic-single" name="gateinfo_ID" id="gateinfo_ID"  onmouseover="ycssel()">
                              <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($gate_data as  $k => $v):
                                     if ($v['ID'] == $FmData[0]['gateinfo_ID']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                         $isselected = '';
                                     }
                                    ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['GateNO']; ?>"><?php echo $v['GateNO']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                       <?php } ?>  
                    </div>
                </div>  
               </div>
              <div class="col-md-6">    

                  <div class="form-group">
                    <label for="Remarks" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-9">                         
                     <textarea class="form-control" id="Remarks" name="Remarks"  value="" readonly><?php if($DCData[0]['Remarks']){ echo $DCData[0]['Remarks']; } ?>
                    </textarea>   
                    </div>
                </div>
               
                </div> 
                 </div>
             
    
        
        <div class="row">
               <div class ="col-md-6" >
                    
                <div class ="col-md-6" >
                 <div class="form-group ">
                        
                        <label class="control-label col-sm-5" for="CGST_SGST"style="text-align:right;padding-right:0%"  >CGST and SGST</label>
                         <div class="col-sm-7" style="padding-left:9.5%;">
                        <input type="radio" class="radio"   name="TaxChoice" id="CGST_SGST"  value="CGST_SGST" <?php if($DCData[0]['TaxChoice']=='CGST_SGST'){echo "checked='checked'";}?>  onclick="return false;" > 
                          </div>
                           </div>
                            </div>
                    <div class ="col-md-6" >
                           <div class="form-group ">
                        <label class="control-label col-sm-10"  style="text-align:right;"  for="IGST" >IGST</label>
                         <div class="col-sm-2" style="padding-left:8%;" >
                        <input type="radio" class="radio "    name="TaxChoice" id="IGST" value="IGST" <?php if($DCData[0]['TaxChoice']=='IGST'){echo "checked='checked'";} ?> onclick="return false;" >
                          </div>
                        </div>
                         </div>
                         
                </div>
        </div>
    

         <!-- /.header part  -->
        <br/>
        
        <div class="box-body" >
            <div id="showData">
                
                
            </div>
        </div>
        
                 <!--Table row -->
       <?php if(is_array($DCData) && count($DCData) >= 1) { ?>
        <div class="row">
          
            <div class="col-xs-12 table-responsive">
            <h5><u>Delivery challan Details</u></h5>    
                <table class="table table-striped">
                    <thead>
                        <tr>
                          
                            <th>Material Name </th>
                            <th>HSN Code</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        
                        </tr>
                    </thead>
                    <tbody id="listing_table">
                            <?php 
                                if(is_array($DCData) && count($DCData) >= 1):
                                $tii = 1;
                                foreach ($DCData as $dataValue):
                            ?>
                                             
                            <tr id="Invo_data_entry_<?php echo $tii; ?>">
                                
                                  <td>                                      
                                     <div class="form-group">
                                        <div class="col-sm-12">
                                                     <input class="form-control" type="text" id="rawid_<?php echo $tii; ?>" name="rawid_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName']; } ?>" placeholder="Rawmaterial Name" readonly >
                                                        </div>
         	                                        </div>
         	                                       
                                                </td>
                                                
                                 <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     <input class="form-control" type="text" id="hsn_<?php echo $tii; ?>" name="hsn_<?php echo $tii; ?>" value="<?php if($dataValue['HSNCode']){ echo $dataValue['HSNCode']; } ?>" placeholder="HSN Code" readonly >
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="qty_<?php echo $tii; ?>" name="qty_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="Quantity" readonly>
                                        
                                    </div>
         	                </div>
                            </td>
                            
                           <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="rate_<?php echo $tii; ?>" name="rate_<?php echo $tii; ?>" value="<?php if($dataValue['Rate']){ echo $dataValue['Rate']; } ?>" placeholder="Rate"readonly >
                                        
                                    </div>
         	                </div>
                            </td>
                            
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount1_<?php echo $tii; ?>" name="Amount1_<?php echo $tii; ?>" value="<?php if($dataValue['EstimatedAmount']){ echo $dataValue['EstimatedAmount']; } ?>" placeholder="Amount" readonly >
                                        
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
                                        
                                        ?>
                                        
                              <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> 
     <?php } ?>
        <!-- /.row -->
                 
<!-- /.header part  -->
        <br/>
        <br/>
        <!-- Table row -->
       
        <div class="row">
            <div class="col-xs-12 table-responsive">
                    <h5><u>Return Delivery challan Details</u></h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>                                
                            <th>Material Name</th>
                            <th>HSN</th>
                            <th>DC Quantity </th>
                            <th>Received Qty</th>
                            <th>Pending Qty</th>

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
                                 <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()" disabled>
                                 </div>
                                 </div>
                                 </td>
                              <td>                                      
                                     <div class="form-group">
                                        <div class="col-sm-12">
                                          
                                                    <select class="form-control" name="ItemName_<?php echo $tii;?>" id="ItemName_<?php echo $tii;?>" onchange="getdcproductdetail('<?php echo $home; ?>',this.value,this.id)"  required>
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                     <?php foreach ($raw_data[$tii-1] as $k => $v): 
                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                      <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName'];?></option>
                                                        <?php endforeach; ?>
                                                         </select>
                                                     
                                                        </div>
         	                                        </div>
         	                                       
                                                </td>
                                       
                         
                            <td style="position:relative;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     
                                     <input class="form-control" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if ($dataValue['HSNCode']){echo $dataValue['HSNCode'];}?>"    placeholder="HSN Code"  type="text" readonly>
                                
                                    </div>
                                </div>
                            </td> 
                             
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                        <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['DcQuantity']){ echo $dataValue['DcQuantity']; } ?>" placeholder="Dc Quantity" type="text" readonly>
                                          
                                    </div>
                                </div>
                            </td> 
                            
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                      <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['ReceivedQuantity']){ echo $dataValue['ReceivedQuantity']; } ?>" required onkeyup="pendingqty(this.id,'please enter quantity within in DC Quantity')"  placeholder="Received Quantity" type="text" >
                                    
                                    </div>
                                </div>
                            </td> 
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                        <input class="form-control" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['PendingQuantity']){ echo $dataValue['PendingQuantity']; } ?>" placeholder="Quantity" type="text" readonly>
                                          
                                    </div>
                                </div>
                            </td> 
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)" disabled>
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
                                         <input type="hidden" name="ItemNo_1" id="ItemNo_1" value="">
                                         <select class="form-control" name="ItemName_1" id="ItemName_1"  onchange="getdcproductdetail('<?php echo $home; ?>',this.value,this.id)" required >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            
                                        </select>
                                    </div>
         	                </div>
                            </td>
                              <td>                                       
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="HSNCode" readonly >
                                    </div>
         	                </div>
                            </td>
                             <td>                                       
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_1" name="Note_1" value="" placeholder=" DC Quantity" readonly >
                                    </div>
         	                </div>
                            </td>
                            
                            
                            
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Received Qty"  required onkeyup="pendingqty(this.id,'please enter quantity within in DC Quantity')" style="text-align:right;" >
                                        
                                    </div>
         	                </div>
                            </td>
                           <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" placeholder="Pending Qty"  style="text-align:right;" readonly>
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

        <!-- /.row -->
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
                                <td  style="text-align:right;"><span id="subtotal"><?php echo $DCData[0]['BillAmount'];?></span>
                                 <input class="form-control" type="hidden" id="BillAmount" name="BillAmount" value="<?php echo $DCData[0]['BillAmount'];?>">                        
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
                                
                                <td style="width:20%"><input class="form-control"  style="text-align:right;" type="text" id="CGSTTax" name="CGSTTax" value="<?php echo $DCData[0]['CGSTTax'];?>" readonly></td>
                                
                                <td><input class="form-control" type="text" id="CGSTAmount"  style="text-align:right;" name="CGSTAmount" style="text-align:right;"  value="<?php echo $DCData[0]['CGSTAmount'];?>"  readonly></td>
                                <!--<td><span id="gst"></span></td>-->
                                
                                </tr>
                                
                                
                                
                                <tr>
                                <th> SGST :</th>
                                
                                <td style="width:20%"><input class="form-control" type="text"  id="SGSTTax"  style="text-align:right;" name="SGSTTax" value="<?php echo $DCData[0]['SGSTTax'];?>"  readonly></td>
                                
                                <td><input class="form-control" type="text" id="SGSTAmount" style="text-align:right;" name="SGSTAmount" value="<?php echo $DCData[0]['SGSTAmount'];?>"  readonly  ></td>
                                <!--<td><span id="gst"></span></td>-->
                                </tr>
                                                            
                               
                               
                                <tr>
                                <th> IGST :</th>
                                
                                <td style="width:20%"><input class="form-control" type="text" id="IGSTTax" style="text-align:right;" name="IGSTTax" value="<?php echo $DCData[0]['IGSTTax'];?> " readonly></td>
                                
                                <td><input class="form-control" type="text" id="IGSTAmount" style="text-align:right;" name="IGSTAmount" value="<?php echo $DCData[0]['IGSTAmount'];?>"  readonly></td>
                                <!--<td><span id="gst"></span></td>-->
                                </tr>
                              
                                 <tr>
                                <th>Net Amount :</th>
                                <th><span class="<?php echo $currencySymbol;?>"></span></th>
                                <th  style="text-align:right;" ><span id="Total"><?php echo $DCData[0]['NetAmount'];?></span>
                               <input class="form-control" type="hidden" id="NetAmount" name="NetAmount" value="" <?php echo $DCData[0]['NetAmount'];?> >
                               <input type="hidden" value="" id="maxCount" name="maxCount">
                                </th>
                                </tr>
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    <div class="row">
            <div class="col-xs-12">
                 <div class ="col-md-6" >
                 <div class="form-group">
                    <label  class="col-sm-2 control-label">Received Date</label>
                    <div class="col-sm-10">
                       <input class="form-control" id="ReceivedDate" name="ReceivedDate" value="<?php if (isset($FmData[0]['ReceivedDate'])){echo date('d-m-Y',strtotime($FmData[0]['ReceivedDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" >
                    </div>
                </div></div>
                <div class ="col-md-6" >
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Comments</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="Comments" name="Comments"  value=""><?php if($dataValue['Comments']){ echo $dataValue['Comments']; } ?>
                    </textarea>
                    </div>
                
                </div> 
                </div>
                </div>
           </div>                 

       
       
<br/>     
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit"  onmouseover="getCount('')" onfocus="getCount(''))"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"  onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
</section>

