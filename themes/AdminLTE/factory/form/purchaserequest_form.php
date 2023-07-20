<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } 

    if($mode == 'edit' || $mode == 'Confirm'){ 

    // var_dump($FmData);

    ?>

    <script>

        function myfunction(){

            var table = document.getElementById('tableid');
            var rowcount = table.rows.length;

            // console.log(rowcount);

            for(var i = 1 ; i < rowcount ; i++)
                {

            var MaterialName = $("#ItemNo_"+i+" option:selected").val();
            document.getElementById('ItemN_'+i).setAttribute("value", MaterialName);
            document.getElementById('ItemNo_'+i).setAttribute("disabled","disabled");
            document.getElementById('ItemNo_'+i).setAttribute("name", "Item_"+i);
            document.getElementById('ItemNo_'+i).setAttribute("id", "Item_"+i);
            document.getElementById('ItemN_'+i).setAttribute("id", "ItemNo_"+i);
            document.getElementById('ItemNo_'+i).setAttribute("name", "ItemNo_"+i);
            


            var MaterialType = $("#MaterialType_"+i+" option:selected").val();
            document.getElementById('MaterialTy_'+i).setAttribute("value", MaterialType);
            document.getElementById('MaterialType_'+i).setAttribute("disabled","disabled");
            document.getElementById('MaterialType_'+i).setAttribute("name", "MaterialT_"+i);
            document.getElementById('MaterialType_'+i).setAttribute("id", "MaterialT_"+i);
            document.getElementById('MaterialTy_'+i).setAttribute("id", "MaterialType_"+i);
            document.getElementById('MaterialType_'+i).setAttribute("name", "MaterialType_"+i);


            var grade = $("#Grade_"+i+" option:selected").val();
            console.log(grade);
            document.getElementById('Gra_'+i).setAttribute("value", grade);
            document.getElementById('Grade_'+i).setAttribute("disabled","disabled");
            document.getElementById('Grade_'+i).setAttribute("name", "Grad_"+i);
            document.getElementById('Grade_'+i).setAttribute("id", "Grad_"+i);
            document.getElementById('Gra_'+i).setAttribute("id", "Grade_"+i);
            document.getElementById('Grade_'+i).setAttribute("name", "Grade_"+i);




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
 
           
           
            <?php if($mode == 'add') {  ?>
            
 <script>
        function myfunction(){
            
                        // console.log('data removed');

                        var chec =  document.getElementById('copyMType_1');
                        // chec.parentNode.removeChild(chec);


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

   
            
            <script>
                   function myfunction(){

                   var table = document.getElementById('tableid');
                   var rowcount = table.rows.length;
                    
                   for(var i = 1;i<rowcount;i++)
                   {
                       if( (document.getElementById('Amount_'+i).value) == "" ){
                           document.getElementById('Amount_'+i).value = 0 ;
                       }

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
                   
               
        
        <?php //echo $mode;?>

        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 ">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Invoice Logo" style="width:150px;"> &nbsp;
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
                    <label  class="col-sm-3 control-label">Purchase Request No</label>
                    <div class="col-sm-9">
                         <?php if ($mode=='Confirm'){?>
                        <input class="form-control" id="PurchaseRequestNo" name="PurchaseRequestNo" value="<?php if(isset($FmData[0]['PurchaseRequestNo'])){echo $FmData[0]['PurchaseRequestNo'];}else{echo $pr_number;}?>" type="text" readonly>
                     <?php } else {?>
                      
                      <input class="form-control" id="PurchaseRequestNo" name="PurchaseRequestNo" value="<?php if(isset($FmData[0]['PurchaseRequestNo'])){echo $FmData[0]['PurchaseRequestNo'];}else{echo $pr_number;}?>" type="text" readonly>
          
                     <?php } ?>
                    </div>
                </div>
                 
                    <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                         <?php if ($mode=='Confirm'){?>
                        <input class="form-control" id="datepicker" name="PurchaseRequestDate" value="<?php if (isset($FmData[0]['PurchaseRequestDate'])){echo date('d-m-Y',strtotime($FmData[0]['PurchaseRequestDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" readonly >
                      <?php } else {?>
                      <!--<input class="form-control" id="datepicker" name="PurchaseRequestDate" value="<?php if (isset($FmData[0]['PurchaseRequestDate'])){echo date('d-m-Y',strtotime($FmData[0]['PurchaseRequestDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" required >-->
                    <input class="form-control datepicker" id="datepicker" name="PurchaseRequestDate" value="<?php if (isset($FmData[0]['PurchaseRequestDate'])){echo date('d-m-Y',strtotime($FmData[0]['PurchaseRequestDate']));}else{ echo date('d-m-Y');} ?>"  placeholder="DD-MM-YYYY"  type="text" required >
                    
                    
                     <?php } ?>
                    </div>
                </div>

               </div>
         <div class="col-md-6">  
         
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                         <?php if ($mode=='Confirm'){?>
                        <input class="form-control" id="timepicker" name="PurchaseRequestTime" value="<?php if ($FmData[0]['PurchaseRequestTime']){echo $FmData[0]['PurchaseRequestTime'];} else{ echo date('H:i');} ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime()" type="text" readonly>
                     <?php } else {?>
                     <input class="form-control" id="timepicker" name="PurchaseRequestTime" value="<?php if ($FmData[0]['PurchaseRequestTime']){echo $FmData[0]['PurchaseRequestTime'];} else{ echo date('H:i');} ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime()" type="text" required>
                     <?php } ?>
                    
                    </div>
                </div>


            </div>    
           
</div>
         
<!-- /.header part  -->
        <br/>
        
        <div class="box-body">
            <div id="showData">
                
                
            </div>
        </div>
       
        <!-- Table row -->
      <!-- 
     <?php if(is_array($matreqdata) && count($matreqdata) >= 1) { ?>
        <div class="row">
            <div class="col-xs-12 table-responsive">
            
                                
                <table class="table table-striped">
                    <thead>
                        <tr>
                          
                            <th>RawMaterial </th>
                            <th>Grade</th>
                            <th>Requested Quantity</th>
                           
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table">
                            <?php 
                                if(is_array($matreqdata) && count($matreqdata) >= 1):
                                $tii = 1;
                                foreach ($matreqdata as $dataValue):
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                
                              
                                  
                                  <td>                                      
                                     <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="rawid_<?php echo $tii; ?>" id="rawid_<?php echo $tii;?>" required readonly>
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                     <?php foreach ($rawmaterial_data as $k => $v): 
                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                        <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
         	                                       
                                                </td>
                                                
                                 <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     <input class="form-control" type="text" id="grade_<?php echo $tii; ?>" name="grade_<?php echo $tii; ?>" value="<?php if($dataValue['Grade']){ echo $dataValue['Grade']; } ?>" placeholder="Grade"readonly >
                                    </div>
         	                </div>
                            </td>
                           
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="requestedqty_<?php echo $tii; ?>" name="requestedqty_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Required Quantity"readonly >
                                        
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
     <?php } ?>-->
        <!-- /.row -->
                 
<!-- /.header part  -->
        <br/>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id="tableid">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Material Type</th>
                            <th>Material Name</th>
                            <th>Grade</th>
                            <th>Purpose</th>
                            <th>Requested Quantity</th>
                            <th>Supplier</th>
                            <th>Last Purchase Date</th>
                            <th>Available Quantity</th>
                            <th>Approximate Cost</th>
                            <th>PaymentType</th>
                            
                            <?php if ($mode=='edit' ||  $mode=='Confirm' || $mode=='view'){?>
                            <th>Approved Quantity</th>
                            <?php } ?>
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
                                <?php if ($mode=='Confirm'){?>
                                 <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()" disabled>
                                  <?php } else { ?>
                                  
                                   <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()" disabled>
                                
                                  
                                 <?php } ?>
                                 </div>
                                 </div>
                                 </td>

            <td>
                    <div class="form-group">
                    <div class="col-sm-12">
                    
                    <select class="form-control" name="MaterialType_<?php echo $tii; ?>" id="MaterialType_<?php echo $tii; ?>" required onchange="getmaterial('<?php echo $home;?>',this.value,this.id); Gradedata(this.id);" style="width:120px">

                    <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawtype_data as $k => $v):
                                           
                                           if ($v['ID'] == $dataValue['rawmaterialtype_ID']) {
                                                $isselected = 'selected="selected"';
                                            }else{
                                                 $isselected = '';
                                             }


                                        ?>

                                    <option <?php echo $isselected; ?>  value="<?php echo $v['ID']; ?>"  title="<?php echo $v['RawMaterialType']; ?>"> <?php echo $v['RawMaterialType']; ?> </option>

                                    <?php endforeach; ?>
                    </select>

                   
                    <input id="MaterialTy_<?php echo $tii; ?>" name="MaterialTy_<?php echo $tii; ?>" value=''  type="hidden">




                    </div>
                 </div>
            </td>


            


              <td>                                      
                 <div class="form-group">
                                   <div class="col-sm-12">
                                   
                                    <!-- <input type=text name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>"> -->
                                    
                                     <select class="form-control" name="ItemNo_<?php echo $tii; ?>" required id="ItemNo_<?php echo $tii; ?>" onchange="getActualQuantity('<?php echo $home;?>',this.value,this.id);GRADEDATA(this.value,this.id);" style="width:100px;" >
                                       <option value="" disabled selected style="display:none;">Select</option>

                                         <?php foreach ($raw_data as $k => $v): 
                                                if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                    $isselected = 'selected="selected"';
                                                }else{
                                                    $isselected = '';
                                                }
                                               
                                         ?>
                                         <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                     
                               

                     <input id = "ItemN_<?php echo $tii; ?>" name="ItemN_<?php echo $tii; ?>"  type="hidden" value=""> 

                 

                                    
                                   
                                     
                                   
                                    </div>
                                 </div>
                        </td>


                        <td>
                                                 <div class="form-group">
                                                       <div class="col-sm-12">
                                                           <?php if ($mode=='confirm'){?>
                                                       <!--<input type=hidden name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>"  value="<?php if($dataValue['Grade']){ echo $dataValue['Grade'];}?>">-->
                                                       <select class="form-control" name="Grade_<?php echo $tii; ?>" id="Grade_<?php echo $tii; ?>" >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php 
                                                              foreach ($rawmaterialgradee_data as $k => $v): 
                                                                     
                                                                    if ($v['Grade'] == $dataValue['grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }

                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $dataValue['grade']; ?>" title="<?php echo $dataValue['grade']; ?>"><?php echo $dataValue['grade']; ?></option>

                                                             
                                                             <?php  endforeach;  ?>
                                                         </select>


                     <input id="Gra_<?php echo $tii; ?>" name="Gra_<?php echo $tii; ?>" value=''  type="text">
                                        <?php } else {?>
                                                     <select class="form-control" name="Grade_<?php echo $tii; ?>" id="Grade_<?php echo $tii; ?>" style="width:100px" >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php 
                                                              foreach ($rawmaterialgradee_data as $k => $v): 
                                                                     
                                                                    if ($v['Grade'] == $dataValue['grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }

                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $dataValue['grade']; ?>" title="<?php echo $dataValue['grade']; ?>"><?php echo $dataValue['grade']; ?></option>

                                                             
                                                             <?php  endforeach;  ?>
                                                         </select>


                     <input id="Gra_<?php echo $tii; ?>" name="Gra_<?php echo $tii; ?>" value=''  type="hidden">


                                        <?php } ?>
                                                        </div>
         	                                        </div>
                                                </td>










                             
                                                 <td>                                      
                                                 <div class="form-group">
                                                       <div class="col-sm-12">
                                                            <?php if ($mode=='approve'){?>
                                                              <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['Purpose']){ echo $dataValue['Purpose']; } ?>" placeholder="Purpose">
                                                             
                                                              <?php } elseif ($mode=='Confirm'){?>
                                                             <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['Purpose']){ echo $dataValue['Purpose']; } ?>" placeholder="Purpose" readonly>
                                                             <?php } else {?>
                                                             <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['Purpose']){ echo $dataValue['Purpose']; } ?>" placeholder="Purpose">
                                                             <?php } ?>    
                                                        </div>
         	                                        </div>
                                                </td>



                                   


                                          
                                    <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                      <?php if ($mode=='approve'){?>
                                        <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){echo intval($dataValue['ReqQty']);} ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumbernodecimal(event);" placeholder="Requestd Quantity">
                                     <?php } elseif ($mode=='Confirm'){?>
                                     <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){echo intval($dataValue['ReqQty']);} ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumbernodecimal(event);" placeholder="Requestd Quantity" readonly>
                                    <?php } else {?>
                                     <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){echo intval($dataValue['ReqQty']);} ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumbernodecimal(event);" placeholder="Requestd Quantity">
                                
                                    <?php } ?>
                                    </div>
                             	    </div>
                                    </td>
                                    <td>                                      
                                     <div class="form-group">
                                                       <div class="col-sm-12">
                                                       <?php if ($mode=='Confirm'){ ?>
                                                          <select class="form-control" name="supplier_<?php echo $tii; ?>" id="supplier_<?php echo $tii; ?>" <?php if ($mode=='Confirm') { echo "disabled=\"disabled\""; }?>>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($supplier_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['supplier_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Company']; ?>"><?php echo $v['Company']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                  <?php if(isset($FmData[0]['supplier_ID']) && ($FmData[0]['supplier_ID']!='')) {?>
                                 <input id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value='<?php echo $FmData[0]["supplier_ID"];?>'  type="hidden">
                                 <?php } ?>
                                 <?php } else { ?>
                                     <select class="form-control" name="EmpName_<?php echo $tii; ?>" id="EmpName_<?php echo $tii; ?>" required>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($supplier_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['supplier_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Company']; ?>"><?php echo $v['Company']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                         
                                                       
                                                         
                                                         <?php } ?>
                                                        </div>
         	                                        </div>
                                                </td>
                                                
                                <td style="position:relative">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php if ($mode=='approve'){?>
                                         <input class="form-control" id="Rate_<?php echo $tii; ?>" name="Rate_<?php echo $tii; ?>" value="<?php if ($dataValue['LastPurchaseDate']){echo date('d-m-Y',strtotime($dataValue['LastPurchaseDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text">
                                          <?php } elseif ($mode=='Confirm'){?>
                                         <input class="form-control" id="Rate_<?php echo $tii; ?>" name="Rate_<?php echo $tii; ?>" value="<?php if ($dataValue['LastPurchaseDate']){echo date('d-m-Y',strtotime($dataValue['LastPurchaseDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" readonly>
                                         <?php } else {?>
                                        <input class="form-control" id="Rate_<?php echo $tii; ?>" name="Rate_<?php echo $tii; ?>" value="<?php if ($dataValue['LastPurchaseDate']){echo date('d-m-Y',strtotime($dataValue['LastPurchaseDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text">
                                       <?php } ?>
                                    
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                   
                                    <?php if ($mode=='approve'){?>
                                        
                                        <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['AvailableQty']){ echo $dataValue['AvailableQty']; } ?>"  placeholder="Available Quantity"  onkeypress=" return onlyNumberKey(event);" type="text" readonly >
                                   
                                    <?php } elseif ($mode=='Confirm'){?>
                                   
                                   <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['AvailableQty']){ echo $dataValue['AvailableQty']; } ?>"   placeholder="Available Quantity" onkeypress=" return onlyNumberKey(event);" type="text" readonly >
                               
                                    <?php } else {?>
                                   
                                   <input class="form-control" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['AvailableQty']){ echo $dataValue['AvailableQty']; } ?>"  placeholder="Available Quantity" onkeypress=" return onlyNumberKey(event);" type="text" readonly >
                               
                                    <?php } ?>
                                    </div>
                                </div>
                            </td>
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    
                                    <?php if ($mode=='approve'){?>
                                         
                                        <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['ApproxCost']){ echo $dataValue['ApproxCost']; } ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumberkey(event);"  placeholder="Approximate Cost" type="text">
                                     
                                    <?php } elseif ($mode=='Confirm'){?>
                                    
                                     <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['ApproxCost']){ echo $dataValue['ApproxCost']; } ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumberKey(event);"  placeholder="Approximate Cost" type="text" readonly>
                 
                                     <?php } else {?>
                                    
                                     <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['ApproxCost']){ echo $dataValue['ApproxCost']; } ?>" onkeyup="nozero(this.id)" onkeypress="return onlyNumberKey(event);"  placeholder="Approximate Cost" type="text">
                 
                                    <?php } ?>
                                    
                                    </div>
                                </div>
                            </td>
                            <td>
                                
                                <div class="form-group">
                                     <div class="col-sm-12">
                                         
                <?php  if ($mode=='Confirm') { ?>
                                              <select class="form-control" name="payment_<?php echo $tii; ?>" id="payment_<?php echo $tii; ?>" <?php if ($mode=='Confirm'){ echo "disabled=\"disabled\""; }?> > 
                                                        <option value="" disabled selected style="display:none;">Select</option>
                                                        <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='cash'){echo 'selected="selected"';} ?> value="cash" title="Cash">Cash</option>
                                                        <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='credit'){echo 'selected="selected"';} ?> value="credit" title="Credit">Credit</option>
                                                        </select>
                                            <?php if(isset($dataValue['PaymentType']) && ($dataValue['PaymentType']!='')) {?>
                                 <input id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value='<?php echo $dataValue["PaymentType"];?>'  type="hidden">
                                 <?php } ?>
                                            <?php } else {?>
                                            
                                                        <select class="form-control" name="Quantity_<?php echo $tii; ?>" id="Quantity_<?php echo $tii; ?>" required > 
                                                        <option value="" disabled selected style="display:none;">Select</option>
                                                        <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='cash'){echo 'selected="selected"';} ?> value="cash" title="Cash">Cash</option>
                                                        <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='credit'){echo 'selected="selected"';} ?> value="credit" title="Credit">Credit</option>
                                                        </select>
                                            
                                                        
                                            <?php } ?>
                                                        
                                                        
                                        </div>
         	                        </div>
                              
                            </td>
                            
                             
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <?php if ($mode=='approve'){?>
                                    
                                        <input class="form-control" id="BatchNo_<?php echo $tii; ?>" required name="BatchNo_<?php echo $tii; ?>" value="<?php if($dataValue['ApprovedQty']){ echo $dataValue['ApprovedQty']; } ?>"  placeholder="Approved Quantity" onkeyup="nozero(this.id);tocheckqty(this.id,'Please enter approved quantity, within the requested quantity');" onkeypress="return onlyNumberKey(event);" type="text"  >
                                   
                                    <?php } else {?>
                                    
                                     <input class="form-control" id="BatchNo_<?php echo $tii; ?>" required name="BatchNo_<?php echo $tii; ?>" value="<?php if($dataValue['ApprovedQty']){ echo $dataValue['ApprovedQty']; } ?>"  placeholder="Approved Quantity"  onkeyup="nozero(this.id);tocheckqty(this.id,'Please enter approved quantity, within the requested quantity');" onkeypress="return onlyNumberKey(event);" type="text" <?php if($mode == 'edit'){echo 'readonly';}?> >     
                                   
                                     <?php } ?>     
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        
                                         <?php if ($mode=='Confirm'){?>
                                <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)" disabled>
                                  <?php } else { ?>
                                  
                                    <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)" disabled>
                                
                                  
                                 <?php } ?>
                                        <!--<input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)">-->
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
                    <select class="form-control" name="MaterialType_1" id="MaterialType_1" onchange="getmaterial('<?php echo $home;?>',this.value,this.id); Gradedata(this.id);" style="width:120px"  required>

                    <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($rawtype_data as $k => $v):
                                           
                                           if ($v['ID'] == $FmData['rawmaterialtype_ID']) {
                                                $isselected = 'selected="selected"';
                                            }else{
                                                 $isselected = '';
                                             }


                                        ?>

                                    <option <?php echo $isselected; ?>  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RawMaterialType']; ?>"> <?php echo $v['RawMaterialType']; ?> </option>

                                    <?php endforeach; ?>
                    </select>
                    

                    <!-- <input type="text" name="MaterialType_1" id="copyMType_1" value=  >  -->

                   
                    </div>
                 </div>
                                
            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <!-- <input type=text name="ItemNo_1" id="ItemNo_1" value="">     -->

                                         <select class="form-control" style="width:100px" name="ItemNo_1" required id="ItemNo_1" onchange="getActualQuantity('<?php echo $home;?>',this.value,this.id);GRADEDATA(this.value,this.id);" >
                                            <option value=""  >Select</option>

                                            <?php if($mode == 'edit'){
                                                    foreach ($raw_data as $k => $v):

                                                ?>

                                                <option   value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php endforeach; } ?>
                                        </select>
                                    </div>
         	                         </div>
                            </td>


                                   
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="Grade_1" id="Grade_1" style="width:100px">
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php  if ($mode == 'edit'){
                                            foreach ($dataValue as $k => $v): ?>
                                              
                                                <option  value="<?php echo $v['grade']; ?>" title="<?php echo $v['grade']; ?>"> <?php echo $v['grade']; ?> </option>

                                            <?php endforeach; }?>
                                        </select>
                                    </div>
         	                </div>
                            </td>



                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="Purpose" >
                                    </div>
         	                </div>
                            </td>




                           
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="Requested Quantity" onkeyup="nozero(this.id)" onkeypress="return onlyNumbernodecimal(event);" required>
                                         
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                             <select class="form-control" name="EmpName_1" id="EmpName_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($supplier_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['Company']; ?>"><?php echo $v['Company']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Rate_1" name="Rate_1" value="<?php echo date('d-m-Y'); ?>" data-provide="datetimepicker" placeholder="DD-MM-YYYY " data-date-format="DD-MM-YYYY " onclick="ycsdate(this.id)" >
                                     
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Available Quantity"  onkeypress=" return onlyNumberKey(event);"  readonly>
                                         
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Note_1" name="Note_1" value="" placeholder="Approximate Cost" onkeypress="return onlyNumberKey(event);"  onkeyup="nozero(this.id)" required>
                                         
                                    </div>
         	                </div>
                            </td>
                            <td>
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    
                                         <select class="form-control" name="Quantity_1" id="Quantity_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                             <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='cash'){echo 'selected="selected"';} ?> value="cash" title="Cash">Cash</option>
                                            <option <?php if(isset($dataValue['PaymentType']) && $dataValue['PaymentType']=='credit'){echo 'selected="selected"';} ?> value="credit" title="Credit">Credit</option>
                                            </select>
                                    </div>
         	                </div>
                            </td>
                            
                          <!--  <td>                                      -->
                          <!--      <div class="form-group">-->
                          <!--          <div class="col-sm-12">-->
                          <!--              <input class="form-control" type="text" id="BatchNo_1" name="BatchNo_1" value="" onkeyup="nozero(this.id)" onkeypress=" return onlyNumberKey(event);" placeholder="Approved Quantity" required>-->
                                         
                          <!--          </div>-->
         	                <!--</div>-->
                          <!--  </td>-->
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
             <div class="col-md-11">
                
            <div class="form-group">
                    <label  class="col-sm-1 control-label">Remarks</label>
                    <div class="col-sm-11">
                        
                         <?php if ($mode=='approve'){?>
                                        <textarea class="form-control" id="Remarks" name="Remarks"  value=""><?php echo $FmData[0]['Remarks']; ?></textarea>
                                     <?php } elseif($mode=='Confirm'){?>
                                     <textarea class="form-control" id="Remarks" name="Remarks"  value="" readonly><?php echo $FmData[0]['Remarks']; ?></textarea>
                                    <?php } else {?>
                                     <textarea class="form-control" id="Remarks" name="Remarks"  value=""><?php echo $FmData[0]['Remarks']; ?></textarea>
                                    <?php } ?>
                     
                    </div>
                </div>
            </div>
        </div>
<input type="hidden" value="" id="maxCount" name="maxCount">
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
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } ?>
                
            </div>
        </div>
        <?php if($mode == 'view' && $mode!= 'approve'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
            
    </form>

</section>
            
            
            