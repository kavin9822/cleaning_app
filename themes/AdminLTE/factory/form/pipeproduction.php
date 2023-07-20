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
         <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
         <?php if(isset($FmData[0]['workorder_ID']) && $FmData[0]['workorder_ID']!==''){?>
         <input id="BatchNo" name="BatchNo" value="<?php echo $FmData[0]['workorder_ID']; ?>"  type="hidden">
         <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="BatchNo" class="col-sm-3 control-label">Batch No.</label>
                    <div class="col-sm-9">
                         <select class="form-control js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getparamDetails('<?php echo $home; ?>',this.value);" onmouseover="ycssel()" <?php if(isset($FmData[0]['workorder_ID'])){echo'disabled';}?> required>
                         <option value="" disabled selected style="display:none;">Select</option>
                            
                             <?php  foreach ($wo_data as $key => $value): 
                                  if ($value['ID'] == $FmData[0]['workorder_ID']) {
                                  $isselected = 'selected="selected"';
                                  }else{
                                  $isselected = '';
                                  }
                                  ?>
                                     <option <?php echo $isselected; ?>   value="<?php echo $value['ID']; ?>"  title="<?php echo $value['BatchNo']; ?>"><?php echo $value['BatchNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="MachineName" class="col-sm-2 control-label">Line</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="MachineName" name="MachineName" value="<?php echo $FmRMData[0]['MachineName']; ?>" placeholder="MachineName" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="CustomerName" class="col-sm-4 control-label">Customer Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="CustomerName" name="CustomerName" value="<?php echo $FmRMData[0]['FirstName']; ?>" placeholder="Customer Name" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
                <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="OperatorName" class="col-sm-3 control-label">Operator Name</label>
                    <div class="col-sm-9">
                        <?php if($mode=='view'){ ?>
                         <select class="form-control js-example-basic-single" name="OperatorName" id="OperatorName" disabled  onmouseover="ycssel()">
                        <?php }else { ?>
                         <select class="form-control js-example-basic-single" name="OperatorName" id="OperatorName" required onmouseover="ycssel()">
                        <?php } ?>
                       
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
            </div><!-- /.left column -->

            
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="Shift" class="col-sm-2 control-label">Shift</label>
                    <div class="col-sm-10">
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
                
            </div><!-- /.left column -->
              
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="productiontime" class="col-sm-4 control-label">Time</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="productiontime"  data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()"  name="productiontime" value="<?php echo $FmData[0]['ProdTime']; ?>"  type="text" >
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="PartName" class="col-sm-3 control-label">Part Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PartName" name="PartName" value="<?php echo $FmRMData[0]['ItemName']; ?>" placeholder="Part  Name" type="text" readonly> 
                        
                        <input class="form-control" id="ProductID" name="ProductID" value="<?php echo $FmRMData[0]['ProductID']; ?>" placeholder="Part  Name" type="hidden" readonly> 
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-4" style="display:none;">                 

                <div class="form-group">
                    <label for="PartNo" class="col-sm-2 control-label">Part No.</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="PartNo" name="PartNo" value="" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="Colour" class="col-sm-2 control-label">Colour</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="Colour" name="Colour" value="" placeholder="Color" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
        <h5><u>Tools Dimensions and Setting Parameters</u></h5>
        
         <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="MouldQty" class="col-sm-7 control-label">No. of Moulds</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="MouldQty" name="MouldQty" value="<?php echo $FmRMData[0]['MouldQty']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="OuterNozzleOD" class="col-sm-7 control-label">Outer Nozzle OD</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="OuterNozzleOD" name="OuterNozzleOD"  value="<?php echo $FmSOPData[3]['SOPValue']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="InnerNozzleOD" class="col-sm-7 control-label">Inner Nozzle OD</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="InnerNozzleOD" name="InnerNozzleOD" value="<?php echo $FmSOPData[2]['SOPValue']; ?>" placeholder="Customer Name" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="Gauge" class="col-sm-7 control-label">Gauge</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="Gauge" name="Gauge" value="<?php echo $FmSOPData[1]['SOPValue']; ?>" placeholder="Customer Name" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
         <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="OuterNozzleID" class="col-sm-7 control-label">Outer Nozzle ID</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="OuterNozzleID" name="OuterNozzleID" value="" placeholder="" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="CentringRod" class="col-sm-7 control-label">Centring Rod OD</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="CentringRod" name="CentringRod" value="<?php echo $FmSOPData[0]['SOPValue']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="CentringRodLength" class="col-sm-7 control-label">Centring Rod Length</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="CentringRodLength" name="CentringRodLength" value="" placeholder="Customer Name" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
          
        </div>
        
         <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="WasherOD" class="col-sm-7 control-label">Washer OD</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="WasherOD" name="WasherOD" value="<?php echo $FmSOPData[4]['SOPValue']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="CorrugatedRPM" class="col-sm-7 control-label">Corrugated RPM</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="CorrugatedRPM" name="CorrugatedRPM" value="<?php echo $FmData[0]['CorrugatorAmps']; ?>" placeholder="Corrugated RPM" type="text"  onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="ExtruderSpeedRPM" class="col-sm-7 control-label">Extruder RPM</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="ExtruderSpeedRPM" name="ExtruderSpeedRPM" value="<?php echo $FmData[0]['ExtruderAmps']; ?>" placeholder="Extruder Speed" type="text" onkeypress="return onlyNumberKey(event)">
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="CoExtruderRPM" class="col-sm-7 control-label">Co Extruder RPM</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="CoExtruderRPM" name="CoExtruderRPM" value="<?php echo $FmData[0]['CoExtruderAmps']; ?>" placeholder="Co extruder RPM" type="text" onkeypress="return onlyNumberKey(event)">
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
         <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ChillerTempInput" class="col-sm-7 control-label">Chiller Temp Input</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="ChillerTempInput" name="ChillerTempInput" value="<?php echo $FmData[0]['ChillerTempInput']; ?>" placeholder="Chiller Temp Output" type="text" onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="ChillerTempOutput" class="col-sm-7 control-label">Chiller Temp Output</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="ChillerTempOutput" name="ChillerTempOutput" value="<?php echo $FmData[0]['ChillerTempOutput']; ?>" placeholder="Chiller Temp Output" type="text" onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="AirPressure" class="col-sm-7 control-label">Air Pressure(Bar)</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="AirPressure" name="AirPressure" value="<?php echo $FmData[0]['AirPressure']; ?>" placeholder="Air Pressure" type="text" onkeypress="return onlyNumberKey(event)" >
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
           
        </div>
        
          <h5><u>Extruder Temperature</u></h5>
        
          <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="EXBZ1" class="col-sm-7 control-label">BZ 1</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXBZ1" name="EXBZ1" value="<?php echo $FmSOPData[12]['SOPValue']; ?>" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="EXBZ2" class="col-sm-7 control-label">BZ 2</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXBZ2" name="EXBZ2" value="<?php echo $FmSOPData[13]['SOPValue']; ?>" placeholder="Corrugated RPM" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="EXBZ3" class="col-sm-7 control-label">BZ 3</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXBZ3" name="EXBZ3" value="<?php echo $FmSOPData[14]['SOPValue']; ?>" placeholder="Extruder Speed" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="EXDZ1" class="col-sm-7 control-label">DZ 1</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXDZ1" name="EXDZ1" value="<?php echo $FmSOPData[17]['SOPValue']; ?>" placeholder="Co extruder RPM" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
             <div class="col-md-2">                 

                <div class="form-group">
                    <label for="EXDZ2" class="col-sm-7 control-label">DZ 2</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXDZ2" name="EXDZ2" value="<?php echo $FmSOPData[18]['SOPValue']; ?>" placeholder="Extruder Speed" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="EXDZ3" class="col-sm-7 control-label">DZ 3</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="EXDZ3" name="EXDZ3" value="" placeholder="Co extruder RPM" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
        <h5><u>Co-Extruder Temperature</u></h5>
        
     <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="COEXBZ1" class="col-sm-7 control-label">BZ 1</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="COEXBZ1" name="COEXBZ1" value="<?php echo $FmSOPData[5]['SOPValue']; ?>" placeholder="PartName" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="COEXBZ2" class="col-sm-7 control-label">BZ 2</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="COEXBZ2" name="COEXBZ2" value="<?php echo $FmSOPData[6]['SOPValue']; ?>" placeholder="Corrugated RPM" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="BZ3" class="col-sm-7 control-label">BZ 3</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="BZ3" name="BZ3" value="<?php echo $FmSOPData[7]['SOPValue']; ?>" placeholder="Extruder Speed" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="COEXDZ1" class="col-sm-7 control-label">DZ 1</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="COEXDZ1" name="COEXDZ1" value="<?php echo $FmSOPData[9]['SOPValue']; ?>" placeholder="Co extruder RPM" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
             <div class="col-md-2">                 

                <div class="form-group">
                    <label for="COEXDZ2" class="col-sm-7 control-label">DZ 2</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="COEXDZ2" name="COEXDZ2" value="" placeholder="Extruder Speed" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-2">                 

                <div class="form-group">
                    <label for="COEXDZ3" class="col-sm-7 control-label">DZ 3</label>
                    <div class="col-sm-5">
                        <input class="form-control" id="COEXDZ3" name="COEXDZ3" value="" placeholder="Co extruder RPM" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
         <h5><u>Raw Materials</u></h5>
        
        <div class="box-body">
            <div id="rawshowData">
                
                
            </div>
        </div>
        
         <div class="row">
            <div class="col-xs-12 table-responsive">
                 <?php 
                    if(is_array($FmRMData) && count($FmRMData) >= 1 ):   ?>
                                        	     
                <table class="table table-striped" id="showData">
                    <thead>
                        <tr>
                            <th>Raw Material</th>
                            <th>Grade</th>
                            <th>Lot No</th>
                            <th>Opening Balance</th>
                            <!--<th>Inward Qty</th>-->
                            <th>Consumed Qty</th>
                            <th>Unit Of Measurement</th>
                            <th>Rejected Qty</th>
                            <th>Closing Balance</th>
                        </tr>
                    </thead>
     
                    <tbody id="invoice_listing_table11">
                        <?php  
                                        	
                                        	$tii = 1;
                                                foreach ($FmRMData as $dataValue):
                                                  
                                                ?>
                                             
                                            <tr id="Invoice_data_entry1_<?php echo $tii; ?>">
                                               
                                               <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['RawMaterial']; ?>" placeholder="Parameter" readonly > 
                                                             
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                               
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Grade_<?php echo $tii; ?>" name="Grade_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['Grade']; ?>" placeholder="Parameter" disabled > 
                                                            <input class="form-control" type="hidden" id="RMID_<?php echo $tii; ?>" name="RMID_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['RMID']; ?>"  > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                              
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="LotNo_<?php echo $tii; ?>" name="LotNo_<?php echo $tii; ?>" value="" placeholder="Value" readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="OpeningBalance_<?php echo $tii; ?>" name="OpeningBalance_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['OpeningQty']; ?>" placeholder="Value" onkeyup=$('#ClosingBalance_<?php echo $tii; ?>').val(((parseFloat($('#OpeningBalance_<?php echo $tii; ?>').val()))-(parseFloat($('#ConsumedQty_<?php echo $tii; ?>').val())+parseFloat($('#RejectedQty_<?php echo $tii; ?>').val()))).toFixed(2)) readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td>-->
                                                <!--    <div class="form-group">-->
                                                <!--        <div class="col-sm-12">-->
                                                <!--            <input class="form-control" type="text" id="InwardQty_<?php echo $tii; ?>" name="InwardQty_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['InwardQty']; ?>" onkeyup=$('#ClosingBalance_<?php echo $tii; ?>').val(((parseFloat($('#OpeningBalance_<?php echo $tii; ?>').val())+parseFloat($('#InwardQty_<?php echo $tii; ?>').val()))-(parseFloat($('#ConsumedQty_<?php echo $tii; ?>').val())+parseFloat($('#RejectedQty_<?php echo $tii; ?>').val()))).toFixed(2))  placeholder="Value" > -->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="ConsumedQty_<?php echo $tii; ?>" name="ConsumedQty_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['ConsumedQty']; ?>" onkeyup=$('#ClosingBalance_<?php echo $tii; ?>').val(((parseFloat($('#OpeningBalance_<?php echo $tii; ?>').val()))-(parseFloat($('#ConsumedQty_<?php echo $tii; ?>').val())+parseFloat($('#RejectedQty_<?php echo $tii; ?>').val()))))  placeholder="Value" > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['UnitName']; ?>" placeholder="Value" readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="RejectedQty_<?php echo $tii; ?>" name="RejectedQty_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['RejectedQty']; ?>" onkeyup=$('#ClosingBalance_<?php echo $tii; ?>').val(((parseFloat($('#OpeningBalance_<?php echo $tii; ?>').val()))-(parseFloat($('#ConsumedQty_<?php echo $tii; ?>').val())+parseFloat($('#RejectedQty_<?php echo $tii; ?>').val()))).toFixed(2))  placeholder="Value" readonly > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="ClosingBalance_<?php echo $tii; ?>" name="ClosingBalance_<?php echo $tii; ?>" value="<?php echo $FmRMData[$tii-1]['ClosingQty']; ?>" onkeyup=$('#ClosingBalance_<?php echo $tii; ?>').val(((parseFloat($('#OpeningBalance_<?php echo $tii; ?>').val()))-(parseFloat($('#ConsumedQty_<?php echo $tii; ?>').val())+parseFloat($('#RejectedQty_<?php echo $tii; ?>').val()))).toFixed(2)) placeholder="Value" readonly > 
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
        </div>
        
        <!-- /.header part  -->
        <!--<h5><u>Tools Dimensions and Setting Parameters</u></h5>-->
        <!--<div class="box-body">-->
        <!--    <div id="showData">-->
                
                
        <!--    </div>-->
        <!--</div>-->
 
     <h5><u>Product Parameter</u></h5>
     
      <div class="row">
          
        <div style="float:left;width:45%;border-style:solid;border-color:black;border-width: 1px;">
             <div>
             <label class="col-sm-6 control-label">CP - Tolerance</label> 
             </div>
             <div style="clear:both"></div>
            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="CPweight" class="col-sm-8 control-label">Weight of Part/mtr</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="CPweight" name="CPweight" value="<?php echo $FmRMData[0]['weight'] ?>" placeholder="Weight of Part/mtr" type="text" readonly>  
                    </div>
                </div> 
            </div><!-- /.left column -->

            <div class="col-md-6">                 

                <div class="form-group">
                    <label for="CPoutput" class="col-sm-6 control-label">Output/minute</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="CPoutput" name="CPoutput" value="<?php echo $FmSOPData[0]['outputpermin'] ?>" placeholder="Output/minute" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
            </div>
            <div style="float:right;width:45%;border-color:black;border-style:solid;border-width: 1px;">
                <div>
             <label  class="col-sm-6 control-label">Actual</label> 
             </div>
             <div style="clear:both"></div>
            <div class="col-md-6">                 
               
                <div class="form-group">
                    <label for="Actweight" class="col-sm-8 control-label">Weight of Part/mtr</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="Actweight" name="Actweight" value="<?php echo $FmData[0]['ActualWgt'] ?>" placeholder="Weight of Part/mtr" type="text" onkeypress="return onlyNumberKey(event)" >
                    </div>
                </div>
                
            </div><!-- /.left column -->
             <div class="col-md-6" style="dispaly:none">                 

                <div class="form-group">
                    <label for="ActOutput" class="col-sm-6 control-label">Output/Minute</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="ActOutput" name="ActOutput" value="<?php echo $FmData[0]['ActualOutput'] ?>" placeholder="Output/Minute" type="text" onkeypress="return onlyNumberKey(event)">
                    </div>
                </div>
                
            </div><!-- /.left column -->
            </div>
         
        </div>
     
 <h5><u>Production Details</u></h5>
 
  <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ProdStartTime" class="col-sm-8 control-label">Production Start Time</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="ProdStartTime" data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()" name="ProdStartTime" value="<?php echo $FmData[0]['ProdStartTime']; ?>" type="text"  onfocusout="timediff(this.id,'ProdStartTime','ProdEndTime','HidTotProdRunHrs','noclon');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">  
                    </div>
                </div>
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="ProdEndTime" class="col-sm-8 control-label">Production End Time</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="ProdEndTime" data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()"  name="ProdEndTime" value="<?php echo $FmData[0]['ProdEndTime']; ?>" placeholder="Corrugated RPM" type="text" onfocusout="timediff(this.id,'ProdStartTime','ProdEndTime','HidTotProdRunHrs','noclon');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">  
                        <input type="hidden" id="HidTotProdRunHrs" name="HidTotProdRunHrs" value="">
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3" style="display:none;">                 

                <div class="form-group">
                    <label for="IdleHrs" class="col-sm-8 control-label">Idle Hrs</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="IdleHrs" name="IdleHrs" value="<?php echo $FmData[0]['IdleHrs']; ?>" placeholder="Idle Hrs" type="text" >
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
           
        </div>
        <div class="row">
            
<div class="col-md-12">
                <div class="form-group" style="display:none;">
                    <label for="IdleDesc" class="col-sm-2 control-label">Idle Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"  id="IdleDesc" name="IdleDesc" value="" placeholder="Idle Description" rows="2"  ><?php echo $FmData[0]['IdleDesc']; ?></textarea>
                    </div>
                </div>
                </div>
            
        </div>
        
         <div class="row">
            <div class="col-md-3" style="display:none;">
                <div class="form-group">
                    <label for="PowerCutHrs" class="col-sm-8 control-label">Power Cut Hrs</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="PowerCutHrs" name="PowerCutHrs" value="<?php echo $FmData[0]['PowercutHrs']; ?>" placeholder="Power Cut Hrs" type="text" >  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="TotProdRunHrs" class="col-sm-8 control-label">Tot. Prod. Running Hrs (in Mins.)</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="TotProdRunHrs" name="TotProdRunHrs" value="<?php echo $FmData[0]['TotProdRunningHrs']; ?>" placeholder="Tot. Prod. Running Hrs" type="text" >  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="TotProdMtr" class="col-sm-8 control-label">Tot. Prod. in Mtr/No</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="TotProdMtr" name="TotProdMtr" value="<?php echo $FmData[0]['TotProdMtr']; ?>" placeholder="Tot. Prod. in Mtr/kg" type="text" onkeyup="batchno(this.id);"  onkeypress="return onlyNumberKey(event)">
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="TotProdKg" class="col-sm-8 control-label">Tot. Prod. in KG</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="TotProdKg" name="TotProdKg" value="<?php echo $FmData[0]['TotProdKg']; ?>" placeholder="Tot. Prod. in KG" type="text"  readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
        <h5><u>Break Down Details</u></h5>
        <br>
        
         <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>      
                            <th>BreakDown Reason</th>
                            <th>BreakDown Start Time</th>
                            <th>BreakDown End Time</th>
                            <th>BreakDown Hours</th>
                            <th>Remarks</th>
                            

                        </tr>
                    </thead>
                    <tbody id="Listing_table">
                         <?php 
                                if(is_array($FmDataSub) && count($FmDataSub) >= 1):
                                $tii = 1;
                                foreach ($FmDataSub as $dataValue):
                                    
                                   // var_dump($FmDataSub);
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
                                            <select class="form-control" name="ItemName_<?php echo $tii;?>" id="ItemName_<?php echo $tii;?>">
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                     <?php foreach ($BDreason_data as $k => $v): 
                                                              if ($v['ID'] == $dataValue['breaskdownreason_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Description']; ?>"><?php echo $v['Description'];?></option>
                                                        <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
         	                                       
                                                </td>
                                     
                                <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Rate_<?php echo $tii; ?>"  name="Rate_<?php echo $tii; ?>"  value="<?php if($dataValue['BreakDownStartTime']){ echo $dataValue['BreakDownStartTime']; }?>" data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()" type="text" onfocusout="timediff(this.id,'Rate','Note','Rat','clone');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">  
                                    </div>
                                </div>
                                </td> 
                                 <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" id="Note_<?php echo $tii; ?>"  name="Note_<?php echo $tii; ?>"  value="<?php  if($dataValue['BreakDownEndTime']){ echo $dataValue['BreakDownEndTime']; }?>"  data-provide="datetimepicker" data-date-format="HH:mm" placeholder="HH:mm" onclick="ycstime()" type="text" onfocusout="timediff(this.id,'Rate','Note','Rat','clone');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">  
                                    </div>
                                </div>
                                </td> 
                                 <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     <input class="form-control" id="Rat_<?php echo $tii; ?>" name="Rat_<?php echo $tii; ?>" value="<?php if($dataValue['BreakdownHrs']){ echo $dataValue['BreakdownHrs']; }?>" placeholder="Breakdown Hrs" type="text" readonly >  
                                    </div>
                                </div>
                                </td> 
                              
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <!--<textarea class="form-control" name="Water_<?php echo $tii;?>" id="Water_<?php echo $tii;?>" placeholder="Remarks" rows="2"  ><?php echo $dataValue[0]['Remarks']; ?></textarea>-->
                                         <input class="form-control" id="Water_<?php echo $tii; ?>"  name="Water_<?php echo $tii; ?>"  value="<?php if($dataValue['Remarks']){ echo $dataValue['Remarks']; }  ?>" placeholder="Remarks" type="text" >  
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
                                         <select class="form-control" name="ItemName_1" id="ItemName_1" >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php  foreach($BDreason_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID'];?>" title="<?php echo $v['Description']; ?>"><?php echo $v['Description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                            
                         
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Rate_1" name="Rate_1" value="<?php echo date('H:i'); ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime(this.id)" onfocusout="timediff(this.id,'Rate','Note','Rat','clone');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">
                                     
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                           <input class="form-control" type="text" id="Note_1" name="Note_1" value="<?php echo date('H:i'); ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime(this.id)" onfocusout="timediff(this.id,'Rate','Note','Rat','clone');calcTotPrdHrs('HidTotProdRunHrs','Rat','TotProdRunHrs')">
                                    </div>
         	                </div>
                            </td>
                           <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     <input class="form-control" id="Rat_1" name="Rat_1" value="" placeholder="Breakdown Hrs" type="text" readonly >  
                                    </div>
                                </div>
                                </td> 
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" id="Water_1"  name="Water_1"  value="" placeholder="Remarks" type="text" >  
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
            </div><!-- /.col -->
              <div class="row">
            
                 <div class="col-md-12">                 

                <div class="form-group">
                    <label for="Communication" class="col-sm-2 control-label">Communication</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"  id="Communication" name="Communication" value="" placeholder="Communication" rows="2"  ><?php echo $FmData[0]['Communication']; ?></textarea>
                    </div>
                </div>
                
            </div><!-- /.left column -->
                </div>
        </div><!-- /.row -->
     
        <h5><u>Scrap Generation Details</u></h5>
 
  <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="Lumps" class="col-sm-6 control-label">Lumps</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="Lumps" name="Lumps" value="<?php echo isset($FmData[0]['Lumps'])?$FmData[0]['Lumps']:0; ?>" placeholder="Lumps" onkeyup="$('#TotalScrap').val((parseFloat($('#FinsihingWaste').val())+parseFloat($('#StartupWaste').val())+parseFloat($('#Lumps').val())+parseFloat($('#CuttingWaste').val())+parseFloat($('#FailWaste').val()))),RMRejectCalc('TotalScrap');" type="text" onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="StartupWaste" class="col-sm-6 control-label">Start up Waste</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="StartupWaste" name="StartupWaste" value="<?php echo isset($FmData[0]['StartUpWaste'])?$FmData[0]['StartUpWaste']:0; ?>" placeholder="Startup Waste" onkeyup="$('#TotalScrap').val((parseFloat($('#FinsihingWaste').val())+parseFloat($('#StartupWaste').val())+parseFloat($('#Lumps').val())+parseFloat($('#CuttingWaste').val())+parseFloat($('#FailWaste').val()))),RMRejectCalc('TotalScrap');" type="text"  onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="CuttingWaste" class="col-sm-6 control-label">Cutting Waste</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="CuttingWaste" name="CuttingWaste" value="<?php echo isset($FmData[0]['CuttingWaste'])?$FmData[0]['CuttingWaste']:0; ?>" placeholder="Cutting Waste" onkeyup="$('#TotalScrap').val((parseFloat($('#FinsihingWaste').val())+parseFloat($('#StartupWaste').val())+parseFloat($('#Lumps').val())+parseFloat($('#CuttingWaste').val())+parseFloat($('#FailWaste').val()))),RMRejectCalc('TotalScrap');" type="text" onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
               
            <div class="col-md-3">                 

                <div class="form-group">
                    <label for="FinsihingWaste" class="col-sm-6 control-label">Finishing Waste</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="FinsihingWaste"   name="FinsihingWaste" value="<?php echo isset($FmData[0]['FinishingWaste'])?$FmData[0]['FinishingWaste']:0; ?>" placeholder="Finsihing Waste" onkeyup="$('#TotalScrap').val((parseFloat($('#FinsihingWaste').val())+parseFloat($('#StartupWaste').val())+parseFloat($('#Lumps').val())+parseFloat($('#CuttingWaste').val())+parseFloat($('#FailWaste').val()))),RMRejectCalc('TotalScrap');" type="text"  onkeypress="return onlyNumberKey(event)">  
                    </div>
                </div>
                
            </div><!-- /.left column -->
            
             <div class="col-md-3">                 

                <div class="form-group">
                    <label for="FailWaste" class="col-sm-6 control-label">Failure Waste</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="FailWaste" name="FailWaste" value="<?php echo isset($FmData[0]['FailureWaste'])?$FmData[0]['FailureWaste']:0; ?>" placeholder="Failure Waste" onkeyup="$('#TotalScrap').val((parseFloat($('#FinsihingWaste').val())+parseFloat($('#StartupWaste').val())+parseFloat($('#Lumps').val())+parseFloat($('#CuttingWaste').val())+parseFloat($('#FailWaste').val()))),RMRejectCalc('TotalScrap');"  type="text" onkeypress="return onlyNumberKey(event)" >
                    </div>
                </div>
                
            </div><!-- /.left column -->
       
        
             <div class="col-md-3">                 

                <div class="form-group">
                    <label for="TotalScrap" class="col-sm-6 control-label">Total</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="TotalScrap" name="TotalScrap" value="<?php echo isset($FmData[0]['TotalWaste'])?$FmData[0]['TotalWaste']:0; ?>" placeholder="Total" type="text" readonly >
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
  <input type="hidden" id="maxCount" name="maxCount" value="">
<input type="hidden" value="1" id="maxCountSub" name="maxCountSub" required>

        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('noclone'),getCountSub()" onfocus="getCount('noclone'),getCountSub()"> Submit </button>
                <?php } else if($mode == 'add') { ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('noclone'),getCountSub()" onfocus="getCount('noclone'),getCountSub()"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
