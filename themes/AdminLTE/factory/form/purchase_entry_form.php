<section class="invoice">

 

    <form class="form-horizontal" id="crud_form" enctype="multipart/form-data"  action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  

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

                    <label for="PurchaseEntryNo" class="col-sm-3 control-label">GRN No.</label>

                    <div class="col-sm-9">

                        <input class="form-control" id="PurchaseEntryNo" name="PurchaseEntryNo" value="<?php if(isset($FmData[0]['PurchaseEntryNo'])){echo $FmData[0]['PurchaseEntryNo'];}else{echo $po_number;}?>" type="text"readonly>

                    </div>

                </div>

                <div class="form-group">

                    <label for="OrderDate" class="col-sm-3 control-label">Purchase Entry Date</label>

                    <div class="col-sm-9">
                        
                     <?php if ($mode=='Confirm'){?>

                   <input class="form-control" id="PurchaseEntryDate" name="PurchaseEntryDate" value="<?php if (isset($FmData[0]['PurchaseEntryDate'])){echo date('d-m-Y',strtotime($FmData[0]['PurchaseEntryDate']));}else{ echo date('d-m-Y');} ?>"  placeholder="DD-MM-YYYY" type="text" readonly >

                    <?php } else {?>

                     <input class="form-control datepicker" id="PurchaseEntryDate" name="PurchaseEntryDate" value="<?php if (isset($FmData[0]['PurchaseEntryDate'])){echo date('d-m-Y',strtotime($FmData[0]['PurchaseEntryDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY" type="text" required  >

                     <?php } ?>

                    </div>
                    
                </div>

                <div class="form-group">

               <label for="supplier_ID" class="col-sm-3 control-label">Supplier Name</label>

                    <div class="col-sm-9">

                    <input type="text" class="form-control" name="supplier" placeholder="Supplier Name" id="supplier" onmouseover="ycssel()" value="<?php echo $FmData[0]['company']; ?>"  readonly >

                    <input type="hidden" id="supplier_ID" name="supplier_ID" value="<?php echo $FmData[0]['supplier_ID']; ?>" >


                <!-- 
                
                                     <select class="form-control" name="supplier_ID" id="supplier_ID" onmouseover="ycssel()"  required>
                
                
                
                                     <option value="" disabled selected style="display:none;">Select</option>
                
                
                
                                    <?php foreach ($Supplier_data as $k => $v): 
                
                                    if ($v['ID'] == $FmData[0]['supplier_ID']) {
                
                
                
                                        $isselected = 'selected="selected"';
                
                
                
                                    }else{
                
                
                
                                        $isselected = '';
                
                
                
                                         }
                
                                    ?>
                
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Company']; ?>"><?php echo $v['Company']; ?></option>
                
                                <?php endforeach; ?>
                
                            </select> -->
                
                                    </div>
                         </div>   



                     <div class="form-group">

                    <label for="InvoiceNo" class="col-sm-3 control-label">Invoice No</label>

                    <div class="col-sm-9">

                       <?php if ($mode=='Confirm'){?>

                        <input class="form-control" id="InvoiceNo" name="InvoiceNo" value="<?php echo $FmData[0]['InvoiceNo'];?>" placeholder="Invoice No" type="text" readonly>

                     <?php } else {?>

                      <input class="form-control" id="InvoiceNo" name="InvoiceNo" value="<?php echo $FmData[0]['InvoiceNo'];?>" placeholder="Invoice No" type="text"  required  >

                    <?php } ?>

                    </div>

                </div>   

                  <div class="form-group">

                    <label for="TermsOfDelivery" class="col-sm-3 control-label">Gate No</label>

                    <div class="col-sm-9">

                       <?php if($mode=='edit' or $mode=='Confirm' ){ ?>

                        <select class="form-control" name="gateinfo" id="gateinfo" disabled>
                       <?php } else {?>
                       
                       <select class="form-control" name="gateinfo_ID" id="gateinfo_ID"  required>
                      <?php } ?>
                      <option value="" disabled selected style="display:none;">Select</option>

                             <?php foreach ($gateinfo_data as $k => $v): 

                                    if ($v['ID'] == $FmData[0]['gateinfo_ID']) {
                
                                        $isselected = 'selected="selected"';

                                    }else{
                
                                   $isselected = '';
                                   }
                
                                    ?>

                        <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['GateNo']; ?>"><?php echo $v['GateNo']; ?></option>
        
                        <?php endforeach; ?>

                        </select>
                    <?php echo isset($FmData[0]['gateinfo_ID']) && ($FmData[0]['gateinfo_ID']!='') ? '<input id="gateinfo_ID" name="gateinfo_ID" value='.$FmData[0]["gateinfo_ID"].'  type="hidden">' : ''; ?>


                  

                </div>

                </div>


            </div><!-- /.left column -->

            <div class="col-md-6">                             

                <?php if($mode=='edit' or $mode=='Confirm' or $mode=='view' ) {?>

                 <div class="form-group">

                    <label for="purchaseorder_ID" class="col-sm-2 control-label">PurchaseOrder No</label>

                    <div class="col-sm-10">                         

                        <select class="form-control" name="purchaseorder_ID" id="purchaseorder_ID" <?php if($mode=='edit' or $mode=='Confirm' or $mode=='view' ){ echo "disabled=\"disabled\""; }else{}?> required>
                
                          <option value="" disabled selected style="display:none;">Select</option>

                                <?php foreach ($poedit_data as  $k => $v):

                                     if ($v['ID'] == $FmData[0]['purchaseorder_ID']) {

                                        $isselected = 'selected="selected"';

                                    }else{
                                        $isselected = '';

                                     }

                                ?>

                               <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PurchaseOrderNo']; ?>"><?php echo $v['PurchaseOrderNo']; ?></option>

                            <?php endforeach; ?>

                        </select>

                        <?php echo isset($FmData[0]['purchaseorder_ID']) && ($FmData[0]['purchaseorder_ID']!='') ? '<input id="purchaseorder_ID" name="purchaseorder_ID" value='.$FmData[0]["purchaseorder_ID"].'  type="hidden">' : ''; ?>


                    </div>

                </div>

                <?php } else{ ?>

                    <div class="form-group">

                      <label for="purchaseorder_ID" class="col-sm-2 control-label">PurchaseOrder No</label>

                    <div class="col-sm-10">                         



                        <select class="form-control js-example-basic-single" name="purchaseorder_ID" id="purchaseorder_ID" onchange="getpodetails('<?php echo $home; ?>',this.value);getsupplier('<?php echo $home; ?>','supplier_ID',this.value);" onmouseover="ycssel();" required>



                             <option value="" disabled selected style="display:none;">Select</option>



                                <?php foreach ($po_data as  $k => $v):



                                     if ($v['ID'] == $FmData[0]['purchaseorder_ID']) {



                                        $isselected = 'selected="selected"';



                                    }else{



                                         $isselected = '';



                                     }



                                ?>



                               <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PurchaseOrderNo']; ?>"><?php echo $v['PurchaseOrderNo']; ?></option>



                            <?php endforeach; ?>



                        </select>



                        <?php echo isset($FmData[0]['purchaseorder_ID']) && ($FmData[0]['purchaseorder_ID']!='') ? '<input id="purchaseorder_ID" name="purchaseorder_ID" value='.$FmData[0]["purchaseorder_ID"].'  type="hidden">' : ''; ?>



                    </div>



                </div>



               <?php }?>

           <!-- <div class="form-group">



                    <label for="DCNo" class="col-sm-2 control-label">DC No</label>



                    <div class="col-sm-10">



                        <input class="form-control" id="DCNo" name="DCNo" value="<?php echo $FmData[0]['DCNo'];?>" placeholder="DCNo" type="text">



                    </div>



                </div> -->


                <div class="form-group">



                    <label for="LRNo" class="col-sm-2 control-label">LR No</label>



                    <div class="col-sm-10">

                          <?php if ($mode=='Confirm'){?>

                          

                        <input class="form-control" id="LRNo" name="LRNo" value="<?php echo $FmData[0]['LRNo'];?>" placeholder="LRNo" type="text" readonly>

                        

                        <?php } else{ ?>

                        

                        <input class="form-control" id="LRNo" name="LRNo" value="<?php echo $FmData[0]['LRNo'];?>" placeholder="LRNo" type="text" >

                   

                    <?php }?>

                   

                    </div>



                </div>


                <div class="form-group">



                    <label for="Transporter" class="col-sm-2 control-label">Transporter</label>



                    <div class="col-sm-10">

                        

                      <?php if ($mode=='Confirm'){?>

                      

                        <input class="form-control" id="Transporter" name="Transporter" value="<?php echo $FmData[0]['Transporter'];?>" placeholder="Transporter" type="text" readonly>

                     

                      <?php } else{ ?>

                        

                         <input class="form-control" id="Transporter" name="Transporter" value="<?php echo $FmData[0]['Transporter'];?>" placeholder="Transporter" type="text">

                   

                    <?php }?>

   
                    </div>

                </div>

            </div><!-- /.left column -->

             

<div class="col-md-6">

    <div class="form-group">

 <?php if($mode != 'Confirm'){ ?>

                    <label for="DCNo" class="col-sm-2 control-label">GRN Attachment</label>


                    <div class="col-sm-10">

                  <!--<input  id="files" name="files[]" value="<?php echo $FmData[0]['documentpath'];?>" placeholder="" type="file" multiple/>-->

                               <div id="fileupload">
                                   
                                       
                                        <div class="row files">

                                            <span class="btn btn-default btn-files add_new_btn pt-2">

                                                 Add  <input type="file"  name="files2[]"  id="files2" accept="image/*"   multiple />

                                            </span>

                                            <p class="fileList mt-5">

                                            <label class="head_cls">Uploaded Items</label>

                                            </p>

                                            <!--<span style="position: relative;bottom: 10px;color: #f70000;margin: 0 auto;">-->

                                            <!--    Only png, jpg, jpeg files are allowed. File size upto 500 KB.</span>-->

                                        </div>
                               
                                        

                                    <?php if($mode == 'edit'){ ?>

                                    <?php if(!empty($FmDataimage) ){ ?>

                                        <div class="row files">
                                    <?php if(count($FmDataimage)>0) { ?>
                                    <p class="fileList mt-3" id="imagedata">

                                    <?php } ?>
                                       
                                    <?php   $i=0; foreach ($FmDataimage as $datavalue):  ?>

                                            <?php if(isset($FmDataimage[$i]['documentpath']))?>

                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataimage[$i]['documentpath']; ?>">

                                            <?php echo ltrim($FmDataimage[$i]['documentpath'],"resource/images/."); ?>

                                            <span class="col-sm-6 col-lg-6 col-xl-6" ><a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"

                                            onclick="productremove('<?php echo ($FmDataimage[$i]['ID']); ?>');$(imglist_<?php echo $i?>).remove();return false;">Remove</a><span>

                                            </span>&nbsp;</a>

                                            <br><br>

                                            <?php $i++; endforeach;  ?>

                                            </p>

                                        </div>

                                        <br>

                                    <?php } elseif(!empty($FmDatadocument))?>

                                    <div class="row files">
                                    <?php if(count($FmDatadocument)>0) { ?>
                                    <p class="fileList mt-3" id="imagedata">
                                    <?php } ?>

                                    <?php   $i=0; foreach ($FmDatadocument as $datavalue):  ?>

                                            <?php if(isset($FmDatadocument[$i]['documentpath']))?>

                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDatadocument[$i]['documentpath']; ?>">

                                            <?php echo ltrim($FmDatadocument[$i]['documentpath'],"resource/documents/."); ?>

                                            <span class="col-sm-6 col-lg-6 col-xl-6" ><a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"

                                            onclick="productremove('<?php echo ($FmDatadocument[$i]['ID']); ?>');$(imglist_<?php echo $i?>).remove();return false;">Remove</a><span>

                                            </span>&nbsp;</a>

                                            <br><br>

                                            <?php $i++; endforeach;  ?>

                                            </p>

                                        </div>

                                        <br>

                                <?php } ?>
                                
                                      

                              

                    </div>



                </div> 

                </div>
                
                 <?php }  ?>

</div>



        </div>



                 



<!-- /.header part  -->





     



 <?php if(is_array($FmData) && count($FmData) >= 1) { ?>


        <div class="row">


            <div class="col-xs-12 table-responsive">


                <table class="table table-striped" >


                    <thead>


                        <tr>

                           
                            <th>Material Type</th>
                            
                            <th>Material Name</th>

                            <th>Lot No</th>

                            <th>PO Quantity</th>

                            <th>Actual Quantity</th>

                            <th>Unit</th>
                            
                            <th>Accepted Quantity</th>

                            <th>Rejected Quantity</th>

                            

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

                                            <?php if ($mode=='approve'){ ?>

                                              <input class="form-control" type="hidden" id="MaterialTypeid_<?php echo $tii; ?>" name="MaterialTypeid_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterialtype_ID']){ echo $dataValue['rawmaterialtype_ID']; } ?>"  >

                                              <input type=text class="form-control" name="MaterialType_<?php echo $tii; ?>" id="MaterialType_<?php echo $tii; ?>"  value="<?php if($dataValue['RMType']){ echo $dataValue['RMType'];} ?>" readonly>

                                            <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii;?>"  readonly>



                                                    <option value="" disabled selected style="display:none;">Select</option>



                                                     <?php foreach ($pod_data as $k => $v): 



                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {



                                                                        $isselected = 'selected="selected"';



                                                                }else{



                                                                        $isselected = '';



                                                                }

                                                             ?>



                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName'];?></option>



                                                        <?php endforeach; ?>



                                            </select>-->

                                          <?php } else {?>

                                          

                                              <input class="form-control" type="hidden" id="MaterialTypeid_<?php echo $tii; ?>" name="MaterialTypeid_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterialtype_ID']){ echo $dataValue['rawmaterialtype_ID']; } ?>"  >

                                              <input class="form-control" type=text name="MaterialType_<?php echo $tii; ?>" id="MaterialType_<?php echo $tii; ?>"  value="<?php if($dataValue['RMType']){ echo $dataValue['RMType'];} ?>" readonly>

                                                    

                                                    <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii;?>"  readonly>



                                                    <option value="" disabled selected style="display:none;">Select</option>



                                                     <?php foreach ($pod_data as $k => $v): 



                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {



                                                                        $isselected = 'selected="selected"';



                                                                }else{



                                                                        $isselected = '';



                                                                }



                                                               



                                                             ?>



                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName'];?></option>



                                                        <?php endforeach; ?>



                                            </select>-->

                                            

                                          <?php } ?>

                                                        </div>



         	                                        </div>



         	                                       



                            </td>


                                
                                
                               <td>                                      

                                     <div class="form-group">

                                        <div class="col-sm-12">

                                            <?php if ($mode=='approve'){?>

                                              <input class="form-control" type="hidden" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" placeholder="" >

                                              <input type=text class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                            <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii;?>"  readonly>



                                                    <option value="" disabled selected style="display:none;">Select</option>



                                                     <?php foreach ($pod_data as $k => $v): 



                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {



                                                                        $isselected = 'selected="selected"';



                                                                }else{



                                                                        $isselected = '';



                                                                }

                                                             ?>



                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName'];?></option>



                                                        <?php endforeach; ?>



                                            </select>-->

                                          <?php } else {?>

                                          

                                              <input class="form-control" type="hidden" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" placeholder="" >

                                              <input class="form-control" type=text name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                                    

                                                    <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii;?>"  readonly>



                                                    <option value="" disabled selected style="display:none;">Select</option>



                                                     <?php foreach ($pod_data as $k => $v): 



                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {



                                                                        $isselected = 'selected="selected"';



                                                                }else{



                                                                        $isselected = '';



                                                                }



                                                               



                                                             ?>



                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName'];?></option>



                                                        <?php endforeach; ?>



                                            </select>-->

                                            

                                          <?php } ?>

                                                        </div>



         	                                        </div>



         	                                       



                            </td>


                            <td>                                      

                                <div class="form-group">



                                    <div class="col-sm-12">

                                        

                                <?php if ($mode=='approve'){?>

                                

                                        <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>"  placeholder="LotNo" required>

                                 

                                  <?php } elseif ($mode=='Confirm'){?>

                                  

                                    <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>"  placeholder="LotNo" readonly>

                                 

                                 <?php } else {?>

                                 <?php if($dataValue['RMType']=='Raw Material') {?>

                                    <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>"  value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>" placeholder="LotNo" required>

                                    

                                    <?php } else {?>     

                                    <input class="form-control" type="text" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>"  value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>" placeholder="LotNo" >

                                   
                                    <?php } }?>
                                    </div>



         	                </div>



                            </td>

                        

                 

                            

                            

                              <td>                                      



                                <div class="form-group">



                                    <div class="col-sm-12">

                                        

                                     <?php if ($mode=='approve'){?>

                                     

                                     <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['POQuantity']){ echo $dataValue['POQuantity']; } ?>" placeholder="PO Quantity" readonly>

                                     

                                     <?php } else {?>

                                      

                                    <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['POQuantity']){ echo $dataValue['POQuantity']; } ?>" placeholder="PO Quantity" readonly>

                                     

                                     <?php } ?>     

                                     

                                    </div>



         	                </div>



                            </td>



                            <td>                                      



                                <div class="form-group">



                                    <div class="col-sm-12">

                                        

                                        

                                <?php if ($mode=='approve'){?>

<!-- actual quantity -->

                                     <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ActualQty']){ echo $dataValue['ActualQty']; } ?>" placeholder="Actual Quantity" onkeyup ="checkqty(this.id);  ">



                                    <!--<input class="form-control" type="hidden" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['ActualQty']){ echo $dataValue['ActualQty']; } ?>" placeholder="Actual Quantity">-->

                                

                                <?php } elseif ($mode=='Confirm'){?>

                               

                               

                               <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ActualQty']){ echo $dataValue['ActualQty']; } ?>" placeholder="Actual Quantity" onkeyup ="checkqty(this.id);" readonly>



                               

                                <?php } else {?>

                                

                                 <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ActualQty']){ echo round($dataValue['ActualQty']); } ?>" placeholder="Actual Quantity" onkeyup ="checkqty(this.id);" readonly>



                                <!--<input class="form-control" type="hidden" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['ActualQty']){ echo round($dataValue['ActualQty']); } ?>" placeholder="Actual Quantity">-->

                                

                                

                                 <?php } ?>    

                                 

                                    </div>
         	                </div>



                            </td>

                            <td>

                            <div class="form-group">

                              <div class="col-sm-12">
                                    <!--<input type=hidden name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitCode']){ echo $dataValue['UnitCode'];} ?>">-->

                            <?php if ($mode=='approve'){?>

                            <select class="form-control" name="Rat_<?php echo $tii;?>" id="Rat_<?php echo $tii;?>"  readonly>

                                <option value="" disabled selected style="display:none;">Select</option>

                                    <?php foreach ($unit_data as $k => $v): 

                                             if ($v['ID'] == $dataValue['unit_ID']) {

                                                $isselected = 'selected="selected"';

                                                 }else{

                                                 $isselected = '';

                                                }

                                                 ?>

                                        <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitCode']; ?>"><?php echo $v['UnitCode'];?></option>

                                        <?php endforeach; ?>

                                </select>

                                    <?php } else {?>

                                 <select class="form-control" name="unit_<?php echo $tii;?>" id="unit_<?php echo $tii;?>"  disabled>

                                    <option value="" disabled selected style="display:none;">Select</option>

                                        <?php foreach ($unit_data as $k => $v): 

                                                 if ($v['ID'] == $dataValue['unit_ID']) {

                                                     $isselected = 'selected="selected"';

                                                     }else{

                                                     $isselected = '';

                                                    }

                                                ?>

                                <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitCode']; ?>"><?php echo $v['UnitCode'];?></option>

                                    <?php endforeach; ?>

                                 </select>     
                                
                                 <?php if(isset($dataValue['unit_ID']) && ($dataValue['unit_ID']!='')) {?>
                                 <input id="Rat_<?php echo $tii; ?>" name="Rat_<?php echo $tii; ?>" value='<?php echo $dataValue["unit_ID"];?>'  type="hidden">
                                 <?php } ?>

                                     <?php } ?>   

                                     

                                                        </div>



         	                                        </div>



         	                                       



                                                 </td>



                                       <td>                                      



                                <div class="form-group">



                                    <div class="col-sm-12">

                                       <?php if ($mode=='approve'){?>   

                                     <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['AcceptedQty']){ echo $dataValue['AcceptedQty']; } ?>" onkeyup="checkqty(this.id);" required placeholder="Accepted Quantity" >

                                      <?php } else if($mode=='Confirm') {?>

                                      <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['AcceptedQty']){ echo $dataValue['AcceptedQty']; } ?>" onkeyup="checkqty(this.id);" required placeholder="Accepted Quantity" >
                                      
                                       <?php } else {?>

                                      <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['AcceptedQty']){ echo $dataValue['AcceptedQty']; } ?>" onkeyup="checkqty(this.id);" required placeholder="Accepted Quantity" readonly>

                                      <?php } ?>  

                                    </div>



         	                </div>



                            </td>

                            <td>                                      



                                <div class="form-group">



                                    <div class="col-sm-12">

                                      <?php if ($mode=='approve'){?>   

                                      

                                     <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['RejectedQty']){ echo $dataValue['RejectedQty']; } ?>" placeholder="Rejected Quantity" readonly>

                                     <?php } else {?>

                                      <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['RejectedQty']){ echo $dataValue['RejectedQty']; } ?>" placeholder="Rejected Quantity" readonly>

                                        <?php } ?>   

                                    </div>



         	                </div>



                            </td>

                            



                          <!--  <td style="display:none;">                                      -->



                          <!--      <div class="form-group">-->



                          <!--          <div class="col-sm-12">-->



                          <!--              <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['AcceptedQty']){ echo $dataValue['AcceptedQty']; } ?>" placeholder="Accepted Quantity" onkeyup="qty(this.id);" required>-->



                                        



                          <!--          </div>-->



         	                <!--</div>-->



                          <!--  </td>-->



                          <!-- <td style="display:none;">                                      -->



                          <!--      <div class="form-group">-->



                          <!--          <div class="col-sm-12">-->



                          <!--              <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['RejectedQty']){ echo $dataValue['RejectedQty']; } ?>" placeholder="Rejected Quantity" readonly onkeyup="qty(this.id);">-->



                                        



                          <!--          </div>-->



         	                <!--</div>-->



                          <!--  </td>-->



                            



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



        <input type="hidden" value="" id="maxCount" name="maxCount">

     

     

        <!-- Table row -->



        



     <!--   <div class="row">



            <div class="col-xs-12 table-responsive">



                <table class="table table-striped">



                    <thead>



                        <tr>



                                                         



                            <th>Raw Material</th>



                            <th>LotNo</th>



                            <th>Quantity</th>



                            <th>Accepted Quantity</th>



                            <th>Rejected Quantity</th>



                            







                        </tr>



                    </thead>



                    <tbody id="invoice_listing_table">







                        <tr id="Invoice_data_entry_1">



                                                   



                            



                            <td>



                                <div class="form-group">



                                    <div class="col-sm-10">



                                        <input type="hidden" name="RMName_" id="RMName_" value="">



                                        <select class="form-control" name="ItemNo_" id="ItemNo_" readonly>



                                            <option value="" disabled selected style="display:none;">Select</option>



                                            <?php foreach ($product_data as $pd_opt_key => $pd_opt_value): ?>



                                                <option  value="<?php echo $pd_opt_key; ?>" title="<?php echo $pd_opt_value; ?>"><?php echo $pd_opt_value; ?></option>



                                            <?php endforeach; ?>



                                        </select>



                                    </div>



                                </div>



                            </td>







                            <td>



                                <div class="form-group">



                                    <div class="col-sm-12">



                                        <input class="form-control" id="Note_" name="Note_" value="" placeholder="LotNo" type="text">



                                    </div>



                                </div>



                            </td>



                            



                            <td>



                                <div class="form-group">



                                    <div class="col-sm-12">



                                        <input class="form-control" id="Quantity_" name="Quantity_" value="" placeholder="Quantity" type="text"readonly>



                                    </div>



                                </div>



                            </td> 



                           



                          



                            <td>



                                <div class="form-group">



                                    <div class="col-sm-12">



                                        <input class="form-control" id="EmpName_" name="EmpName_" value="" placeholder="Accepted Quantity" type="text" >



                                    </div>



                                </div>



                            </td>



                            <td>



                                <div class="form-group">



                                    <div class="col-sm-12">



                                        <input class="form-control" id="ItemName_" name="ItemName_" value="" placeholder="Rejected Quantity" type="text" >



                                    </div>



                                </div>



                            </td>







                        </tr>







                    </tbody>



                </table>



            </div>



        </div> -->



















      <!--  <div class="row">



            <!-- accepted payments column -->



           <!-- <div class="col-xs-6">



                



            </div>



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



            </div>



        </div -->



       

        <br/>



        



        <div class="box-body">



            <div id="showData">



                



                



            </div>



        </div>







        <!-- this row will not appear when printing -->



     



<br/>



             <!-- this row will not appear when printing -->

        <div class="row no-print">

            <div class="col-xs-12">

                <?php if($mode != 'view' ){ ?>

                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>

                <?php } ?>

                 <?php if($mode == 'Confirm'){ ?>

                <button type ="text" class="btn btn-success pull-right" name="confirm_submit_button" value="confirm" onmouseover="getCount('')" onfocus="getCount('')"> Confirm </button>

                <?php } ?>

                <?php if($mode == 'edit'){ ?>

                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>

                <?php } else if($mode == 'add'){ ?>

                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('noclone')" onfocus="getCount('noclone')" > Submit </button>

                <?php } ?>

                

                

            </div>

        </div>

        <?php if($mode == 'view' && $mode!= 'approve'){ ?>

           </fieldset>

           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>

        <?php } ?>

        

        



            



    </form>







</section>





