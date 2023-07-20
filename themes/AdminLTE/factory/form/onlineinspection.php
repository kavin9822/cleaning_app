<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
   
    <?php
    // var_dump($wo_data);
    ?>

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
        <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
        <div class="row">
            <div class="col-md-4">
               
               
               
                <div class="form-group">
                    <label for="BatchNo" class="col-sm-3 control-label">Batch No.</label>
                    <div class="col-sm-9">
                         
                         <input type="hidden" name="BatchNo" id="BatchNo" value="<?php echo $value['BatchNo']; ?>">

                        <select class="form-control js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getinspDetails('<?php echo $home; ?>',this.value);getppDetails('<?php echo $home; ?>',this.value,'PPShift');" onmouseover="ycssel()" <?php if(isset($FmData[0]['workorder_ID'])!=''){echo'disabled';}?> required>

                            <option value="" disabled selected style="display:none;">Select</option>

                            <?php  foreach ($wo_data as $key => $value): 
                              
                                  if ($value['ID'] == $FmData[0]['workorder_ID']){
                                  $isselected ='selected="selected"';
                                  }else{
                                  $isselected = '';
                                  }
                                
                                  ?>
                                <option  <?php echo $isselected;?> value="<?php echo $value['ID']; ?>" title="<?php echo $value['BatchNo']; ?>"><?php echo $value['BatchNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                </div> 





                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="datepicker" name="InspDate" value="<?php if (isset($FmData[0]['InspDate'])){echo date('d-m-Y',strtotime($FmData[0]['InspDate']));}else{ echo date('d-m-Y');} ?>"  placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" required >
                   
                    </div>
                </div>
                
                 <div class="form-group">
                    <label for="PartName" class="col-sm-3 control-label">Part Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PartName" name="PartName" value="<?php echo $FmData[0]['ItemName']; ?>" placeholder="Part  Name" type="text" readonly>  
                        <input class="form-control" id="productid" name="product_ID" value="<?php echo $FmData[0]['product_ID']; ?>" type="hidden">  
                    
                    </div>
                </div> 
                
                

            </div><!-- /.left column -->
          
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="MachineName" class="col-sm-3 control-label">Prod. Shift</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="PPShift" id="PPShift" onchange="getppqtyDetails('<?php echo $home; ?>',this.value,'TotInspQty');"  required>
                            <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($ppshift_data as $key => $value): 
                                  if ($value['ID'] == $FmData[0]['pipeproduction_ID']) {
                                  $isselected = 'selected="selected"';
                                  }else{
                                  $isselected = '';
                                  }
                                  ?>
                                <option <?php echo $isselected; ?>  value="<?php echo $value['ID']; ?>"  title="<?php echo $value['ShiftName']; ?>"><?php echo $value['ShiftName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                      </div>
                     <div class="form-group">
                    <label for="productiontime" class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="productiontime"  data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()"  name="productiontime" value="<?php if ($FmData[0]['InspTime']){echo $FmData[0]['InspTime'];} else{ echo date('H:i ');} ?>"  type="text" required >
                    </div>
                </div>
                
                  <div class="form-group">
                    <label for="PartNo" class="col-sm-3 control-label">Color</label>
                    <div class="col-sm-9">
                       <input class="form-control" id="Colour" name="Colour" value="" placeholder="Colour" type="text" readonly>
                       <input class="form-control" id="PartNo" name="PartNo" value="" placeholder="Part NO" type="text" readonly style="display:none;">  
                    </div>
                </div> 
                
            </div><!-- /.left column -->
          
     
        
         <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="OperatorName" class="col-sm-3 control-label">Line</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="MachineName" name="MachineName" value="<?php echo $FmData[0]['EquipmentName']; ?>" placeholder="MachineName" type="text" readonly>
                      <!--<select class="form-control" name="OperatorName" id="OperatorName" >-->
                      <!--      <option value="" disabled selected style="display:none;">Select</option>-->
                            
                            <?php foreach ($empl_data as $key => $value): 
                                  if ($value['ID'] == $FmData[0]['operator_ID']) {
                                  $isselected = 'selected="selected"';
                                  }else{
                                  $isselected = '';
                                  }
                                  ?>
                           
                      <!--          <option <?php echo $isselected; ?>  value="<?php echo $value['ID']; ?>"  title="<?php echo $value['EmpName']; ?>"><?php echo $value['EmpName']; ?></option>-->
                      <!--      <?php endforeach; ?>-->
                      <!--  </select>-->
                    </div>
                     
                </div>
         
                <div class="form-group">
                    <label for="Shift" class="col-sm-3 control-label">Shift</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="Shift" id="Shift" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($shift_data as $key => $value):
                              if ($value['ID'] == $FmData[0]['shift_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                            <option <?php echo $isselected; ?>   value="<?php echo $value['ID']; ?>"  title="<?php echo $value['ShiftName']; ?>"><?php echo $value['ShiftName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label for="Colour" class="col-sm-3 control-label">Operator Name</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="OperatorName" id="OperatorName"  required>
                            <option value="" disabled selected style="display:none;">Select</option>
                            
                            <?php foreach ($empl_data as $key => $value): 
                                  if ($value['ID'] == $FmData[0]['operator_ID']) {
                                  $isselected = 'selected="selected"';
                                  }else{
                                  $isselected = '';
                                  }
                                  ?>
                           
                                <option <?php echo $isselected; ?>  value="<?php echo $value['ID']; ?>"  title="<?php echo $value['EmpName']; ?>"><?php echo $value['EmpName']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
            
                 </div>
          <!-- /.left column -->  
            
            </div><!-- /.left column -->

          
        </div>
        
        <div class="row" style="display:none">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="PartName" class="col-sm-3 control-label">Part Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PartName" name="PartName" value="<?php echo $FmData[0]['ItemName']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-4" >                 
                <div class="form-group">
                    <label for="PartNo" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                       <input class="form-control" id="Colour" name="Colour" value="" placeholder="Colour" type="text" readonly>
                       <input class="form-control" id="PartNo" name="PartNo" value="" placeholder="Part NO" type="text" readonly style="display:none;">  
                    </div>
                </div> 
        
            </div><!-- /.left column -->
              
                           
                <div class="col-md-4"> 
               
                 </div>
           
        </div>
        
        <h5><u>Inspection Details</u></h5>
        
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="TotInspQty" class="col-sm-4 control-label">Total Inspection Mtrs/Qty</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="TotInspQty" name="TotInspQty" value="<?php echo $FmData[0]['TotInspQty']; ?>" placeholder="Total Inspection Mtrs/Qty" type="text" readonly >  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-6">                 

                <div class="form-group">
                        <label for="RejectionPPM" class="col-sm-4 control-label">Rejection PPM</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="RejectionPPM" name="RejectionPPM" value="<?php echo $FmData[0]['RejectionPPM']; ?>" placeholder="Rejection PPM" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
          
        </div>
        
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="AcceptedQty" class="col-sm-4 control-label">Acccepted Mtrs/Qty</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="AcceptedQty" name="AcceptedQty" onkeypress="return onlyNumbernodecimal(event)" value="<?php echo $FmData[0]['AcceptedQty']; ?>" placeholder="Accepted Qty" type="text" onkeyup="oninspec(this.id); " onfocusout = "equaltotoalinspec()"required>  
                        <input type="hidden" id="Availableqty" name="Availableqty" value="<?php echo $FmData[0]['AcceptedQty']; ?>">
                                  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-6">                 
                <div class="form-group">
                    <label for="ReworkPPM" class="col-sm-4 control-label">Rework PPM</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="ReworkPPM" name="ReworkPPM" value="<?php echo $FmData[0]['ReworkPPM']; ?>" placeholder="Rework PPM" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
          
               
          
        </div>
        
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ReworkQty" class="col-sm-4 control-label">Rework Mtr/Qty</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="ReworkQty" name="ReworkQty" value="<?php echo $FmData[0]['ReworkQty']; ?>" placeholder="Rework Qty" type="text" onkeypress="return onlyNumbernodecimal(event)"  onkeyup="oninspec(this.id)" onfocusout="equaltotoalinspec()" requried>  
                    </div>
                </div> 
            </div><!-- /.left column -->

             <div class="col-md-6">
                <div class="form-group">
                    <label for="RejectedQty" class="col-sm-4 control-label">Rejected Mtr/Qty</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="RejectedQty" name="RejectedQty" onkeypress="return onlyNumbernodecimal(event)" value="<?php echo $FmData[0]['RejectedQty']; ?>" placeholder="Rejected Qty" type="text" onkeyup="oninspec(this.id);productvalue(this.value);" onfocusout="equaltotoalinspec()" required>
                    </div>
                </div> 
                </div>
                </div>
            <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>      
                            <th>Problem Mtr/Qty</th>
                            <th>Problem Description</th>
                        </tr>
                    </thead>
                    <tbody id="Listing_table">
                         <?php 
                                if(is_array($FmDataSub) && count($FmDataSub) >= 1):
                                $tii = 1;
                                foreach ($FmDataSub as $dataValue):
                                  
                            ?>

                         <tr id="Data_entry_<?php echo $tii; ?>">
                            <td>
                                 <div class="form-group">
                                 <div class="col-sm-12">
                                 <input class="form-control btn-danger" id="SUBREM_<?php echo $tii; ?>" name="SUBREM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Data_entry_<?php echo $tii; ?>').remove()">
                                 </div>
                                 </div>
                            </td>
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Rat_<?php echo $tii; ?>"  name="Rat_<?php echo $tii; ?>"  value="<?php  if($dataValue['ProbQty']){ echo $dataValue['ProbQty'];}else {echo " ";}  ?>"placeholder="Problem Quantity" type="text" readonly required onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <textarea class="form-control" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value=" " placeholder="Problem Description" type="text" style="width:100%;height:35px;" readonly required ><?php if($dataValue['ProbDesc']){ echo $dataValue['ProbDesc']; } ?></textarea>
                                    </div>
                                </div>
                            </td> 
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="SUBADD" name="SUBADD" value="+"  type="button"  onclick="addRowSub(<?php echo count($FmDataSub)+1; ?>,'edit')">
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
                                        
                            <tr id="Data_entry_1">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="SUBREM_1" name="SUBREM_1" value="-"  type="button">
                                    </div>
                                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Rat_1"  name="Rat_1"  value="" placeholder="Problem Quantity" type="text" readonly required onkeypress="return onlyNumbernodecimal(event)">  
                                    </div>
         	                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <textarea class="form-control" id="Water_1" name="Water_1" value="" placeholder="Problem Description" type="text" style="width:100%;height:35px;" readonly required></textarea>
                                    </div>
                                </div>
                            </td> 
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="SUBADD" name="SUBADD" value="+"  type="button" onclick="addRowSub()">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div><!-- /.col -->
                             
            <!--<div class="col-md-6">-->

            <!--    <div class="form-group">-->
            <!--        <label for="CorrugatedRPM" class="col-sm-4 control-label">Problem Description</label>-->
            <!--        <div class="col-sm-8">-->
            <!--            <textarea class="form-control" id="ProbDesc" name="ProbDesc" value="" placeholder="Problem Description" type="text" row="2" ><?php echo $FmData[0]['ProbDesc']; ?>  </textarea>-->
            <!--        </div>-->
            <!--    </div>-->
                
            <!--</div><!-- /.left column -->
              

       
        
         <!--<div class="row">-->
           
         <!--   </div><!-- /.left column -->

            
            <!--<div class="col-md-6">                 -->

            <!--    <div class="form-group">-->
            <!--        <label for="ProblemQty" class="col-sm-4 control-label">Problem Mtr/Qty</label>-->
            <!--        <div class="col-sm-8">-->
            <!--            <input class="form-control" id="ProblemQty" name="ProblemQty" value="<?php echo $FmData[0]['ProbQty']; ?>" placeholder="Problem Quantity" type="text" row="2" >  -->
            <!--        </div>-->
            <!--    </div>-->
                
            <!--</div><!-- /.left column -->
              

       
        
        
        
         
        
         <h5><u>Actual Observation</u></h5>
         
         <div class="row">
            <div class="col-xs-12 table-responsive">
                 <?php  
                    if(is_array($FmData) && count($FmData) >= 1 ):   ?>
                                        	     
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Inspection Parameter</th>
                            <th>Dimension/Specification</th>
                            <th>Equipment Name</th>
                              <th>Ins 1</th>
                              <th>Ins 2</th>
                              <th>Ins 3</th>
                              <th>Ins 4</th>
                              <th>Ins 5</th>
                              <th>Ins 6</th>
                              <th>Ins 7</th>
                              <th>Ins 8</th>
                              <th>Result</th>
                        </tr>
                    </thead>
                    <tbody id="invoice_listing_table11">
                        <?php  
                                        	
                                        	$tii = 1;
                                                foreach ($FmData as $dataValue):
                                                  
                                                ?>
                                             
                                            <tr id="Invoice_data_entry1_<?php echo $tii; ?>">
                                               
                                               <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['Parameter']; ?>" placeholder="Parameter" readonly > 
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                               
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Spec_<?php echo $tii; ?>" name="Spec_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ParamValue']; ?>" placeholder="Parameter" disabled > 
                                                            <input class="form-control" type="hidden" id="RMID_<?php echo $tii; ?>" name="RMID_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ID']; ?>"  > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                              
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Qty_<?php echo $tii; ?>" name="Qty_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['EquipmentName']; ?>" placeholder="Value" readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs1_<?php echo $tii; ?>" name="Obs1_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue1']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs2_<?php echo $tii; ?>" name="Obs2_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue2']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs3_<?php echo $tii; ?>" name="Obs3_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue3']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs4_<?php echo $tii; ?>" name="Obs4_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue4']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs5_<?php echo $tii; ?>" name="Obs5_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue5']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs6_<?php echo $tii; ?>" name="Obs6_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue6']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs7_<?php echo $tii; ?>" name="Obs7_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue7']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Obs8_<?php echo $tii; ?>" name="Obs8_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsValue8']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Result_<?php echo $tii; ?>" name="Result_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['InsResult']; ?>" placeholder="Value" > 
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
                                            
                                            
                                            <?php
                                        else: 
                                        ?>
                                                
                                                
                      
                        <?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
        
         <input type="hidden" value="<?php if(isset($FmData) != null){echo $tii;} ?>"  id="partSpecmaxCount" name="partSpecmaxCount">
         
        <div class="box-body">
            <div id="rawmaterialshowData" class="table-responsive-lg">
                
                
            </div>
        </div>
        
         <?php
         
       
         if(isset($FmData)  == null && isset($FmsubData)== null)
         {
             $FmData=$SOPMaster_data;
         } 
         else 
         {
              $FmData=$FmsubData;
         }
         
         ?>
        <h5><u>Extruder Process Parameters</u></h5>
          <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Group Name</th>
                            <th>Parameter</th>
                            <th>Spec(+-)</th>
                            <th>FPA</th>
                            <th>MPA</th>
                            <th>LPA</th>
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
                                                            <input class="form-control" type="text" id="GroupName_<?php echo $tii; ?>" name="GroupName_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['GroupName']; ?>" placeholder="Parameter" readonly > 
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ParameterName']; ?>" placeholder="Parameter" readonly > 
                                                             <input class="form-control" type="hidden" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ID']; ?>"  > 
                                                        </div>
                                                    </div>
                                                </td>
                                                 
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Spec_<?php echo $tii; ?>" name="Spec_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['Spec']; ?>" placeholder="Parameter" disabled > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                              
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="FPA_<?php echo $tii; ?>" name="FPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['FPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="MPA_<?php echo $tii; ?>" name="MPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['MPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="LPA_<?php echo $tii; ?>" name="LPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['LPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                             
                                            </tr>
                                            
                                        <?php 
                                        
                                        $tii = $tii+1;
                                            endforeach;
                                            ?>
                                            <?php if(isset($FmsubData) == null) { ?> 
                                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                               
                                               <td>
                                                    
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="No of mtrs/cycle" placeholder="No of mtrs/cycle" readonly > 
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                                 
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Spec_<?php echo $tii; ?>" name="Spec_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['Spec']; ?>" placeholder="Parameter" readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                              
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="FPA_<?php echo $tii; ?>" name="FPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii]['FPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="MPA_<?php echo $tii; ?>" name="MPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii]['MPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="LPA_<?php echo $tii; ?>" name="LPA_<?php echo $tii; ?>" value="<?php echo $FmData[$tii]['LPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                             
                                            </tr>
                                            
                                            <tr id="Invoice_data_entry_<?php echo $tii+1; ?>">
                                               
                                               <td>
                                                    
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="ItemNo_<?php echo $tii+1; ?>" name="ItemNo_<?php echo $tii+1; ?>" value="Result" placeholder="Parameter" readonly > 

                                                        </div>
                                                    </div>
                                                </td>
                                                 
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Spec_<?php echo $tii+1; ?>" name="Spec_<?php echo $tii+1; ?>" value="<?php echo $FmData[$tii]['Spec']; ?>" placeholder="Parameter" disabled > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                              
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="FPA_<?php echo $tii+1; ?>" name="FPA_<?php echo $tii+1; ?>" value="<?php echo $FmData[$tii]['FPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="MPA_<?php echo $tii+1; ?>" name="MPA_<?php echo $tii+1; ?>" value="<?php echo $FmData[$tii]['MPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="LPA_<?php echo $tii+1; ?>" name="LPA_<?php echo $tii+1; ?>" value="<?php echo $FmData[$tii]['LPA']; ?>" placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                             
                                            </tr>
                                            <?php } ?>
                                            <?php 
                                        else: 
                                        ?>
                                                
                                                
                        <tr id="Invoice_data_entry_1">
                           
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="Available. Qty" > 
                                    </div>
                                </div>
                            </td>
                            
                            <td>   
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="Quantity"  > 
                                    </div>
                                </div>
                            </td>

                           
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
<input type="hidden" value="<?php echo $tii; ?>" id="maxCount" name="maxCount">
<input type="hidden" value="1" id="maxCountSub" name="maxCountSub" >
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount(),getCountSub()" onfocus="getCount(),getCountSub()"> Submit </button>
                <?php } else if($mode == 'add') { ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount(),getCountSub();" onfocus="getCount(),getCountSub()"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
