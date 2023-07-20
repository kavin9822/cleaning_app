<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo;?>" class="img" alt="Invoice Logo" style="width:150px;"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>

        <div class="row">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                    <div class="col-md-3">
                    <div class="form-group">
                    <label  class="col-sm-3 control-label">Start Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="sdate" name="sdate" value="<?if (isset($FmData[0])){echo date('Y-m-d',strtotime($FmData[0]));}else{ echo date('Y-m-d');} ?>"  onmouseover="datepicker(this.id);" placeholder="YYYY-MM-DD" type="text" required>
                    <!--<input class="form-control" id="sdate" name="sdate" value="<?if (isset($FmData[0])){echo date('Y-m-d',strtotime($FmData[0]));}else{ echo date('Y-m-d');} ?>"  data-provide="datetimepicker" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" onclick="ycsdate(this.id)" type="text" required>-->
                    </div>
                    </div>
                    </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">End Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="edate" name="edate" value="<?php if (isset($FmData[1])){echo date('Y-m-d',strtotime($FmData[1]));}else{ echo date('Y-m-d');}?>"  onmouseover="datepicker(this.id);" placeholder="YYYY-MM-DD"  type="text" required>
                    </div>
                    </div>
                    </div>
                <div class="col-md-3">
                <div class="form-group">
                <label  class="col-sm-3 control-label">Shift</label>
                <div class="col-sm-9">
                <select class="form-control" name="shift_ID" id="shift_ID">
                <option value="" disabled selected style="display:none;">Select</option>
                <option <?php  if(isset($FmData[2]) && $FmData[2]=='All'){echo 'selected="selected"';} ?> value="All" title="All">All</option>
                    <?php foreach($shift_data as $k => $v): 
                    if ($v['ID'] == $FmData[2]) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
                <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['ShiftName'];?>"><?php echo $v['ShiftName'];?></option>
                <?php endforeach; ?>
                </select>
                </div>
                </div>
                </div>
                 <span class="col-sm-2">
                  <!--<a href="<?php echo $home; ?>/product/cst/oee" target="_blank" type ="text" class="btn btn-primary pull-right" name="add_button" value="Add">Submit</a>-->
                 <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add">Submit</button>
                 </span>
                </div>
                
                
       
       <?php if(isset($result)){?>
         
         <h5><u>OEE (Overall Equipment Effectiveness)</u></h5>
        
        <!--<div class="box-body">-->
        <!--    <div id="showData" class="table-responsive">-->
                
                
        <!--    </div>-->
        <!--</div>-->
            <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                             <th>Date</th>
                            <th>Machine Name</th>
                            <th>Batch No</th>
                            <th>Item Name</th>
                            <th>Cycle Time</th>
                            <th>Output Per Minute</th>
                            <th>Target Output</th>
                            <th>Total Production Meter</th>
                            <th>Accepted Quantity</th>
                            <th>Rejected Quantity</th>
                            <th>Process Rejection Quantity</th>
                            <th>Total Rejection Quantity</th>
                            <th>Rejection Percentage</th>
                            <th>Rejection PPM</th>
                            <th>Weight</th>
                            <th>Shift Name</th>
                            <th>Total Production Running Hours</th>
                            <th>Total Production Kg</th>
                            <th>Total Consumption</th>
                            <th>Process</th>
                            <th>Change Over</th>
                            <th>Machine</th>
                            <th>Power Failure</th>
                            <th>Mould Damaged</th>
                            <th>Purchase</th>
                            <th>Stores</th>
                            <th>Others</th>
                            <th>No Man</th>
                            <th>Ideal</th>
                            <th>No Plan</th>
                            <th>Trial</th>
                            <th>Total</th>
                            <th>Production Available Hours</th>
                            <th>Total Available Hours</th>
                            <th>Available Hours In Minute</th>
                            <th>Equipment Efficiency</th>
                            <th>Production Efficiency</th>
                            <th>Quality Efficiency</th>
                            <th>OEE</th>
                            </tr>
                    </thead>
                  <tbody>
                
                <?php foreach($result as $key=>$value){ ?>
                 <tr>
                   <td><?php echo date("d-m-Y", strtotime($value['AuditDateTime'])); ?></td>
                   <td><?php echo $value['MachineName']; ?></td>
                   <td><?php echo $value['BatchNo']; ?></td>
                   <td><?php echo $value['ItemName']; ?></td>
                   <td><?php  echo $value['CycleTime']; ?></td>
                    <td><?php echo $value['outputpermin']; ?></td>
                    <td><?php echo $value['TargetOutput']; ?></td>
                    <td><?php echo $value['TotProdMtr']; ?></td>
                    <td><?php echo $value['AcceptedQty']; ?></td>
                    <td><?php echo $value['RejectedQty']; ?></td>
                    <td><?php echo $value['ProcessRejectionQty']; ?></td>
                    <td><?php echo $value['TotalRejectionQty']; ?></td>
                    <td><?php echo bcdiv($value['RejectionPerc'],1,3)?></td>
                    <td><?php echo bcdiv($value['RejectionPPM'],1,3)?></td>
                    <td><?php echo $value['weight']; ?></td>
                    <td><?php echo $value['ShiftName']; ?></td>
                    <td><?php echo $value['TotProdRunningHrs']; ?></td>
                    <td><?php echo $value['TotProdKg']; ?></td>
                    <td><?php echo $value['TotalConsumption']; ?></td>
                    <td><?php echo $value['Process']; ?></td>
                    <td><?php echo $value['ChangeOver']; ?></td>
                    <td><?php echo $value['Machine']; ?></td>
                    <td><?php echo $value['PowerFailure']; ?></td>
                    <td><?php echo $value['MouldDamaged']; ?></td>
                    <td><?php echo $value['Purchase']; ?></td>
                    <td><?php echo $value['Stores']; ?></td>
                    <td><?php echo $value['Others']; ?></td>
                    <td><?php echo $value['NoMan']; ?></td>
                    <td><?php echo $value['Ideal']; ?></td>
                    <td><?php echo $value['NoPlan']; ?></td>
                    <td><?php echo $value['Trial']; ?></td>
                    <td><?php 
                    
                    $MachineDate=date_parse($value['Machine']);
                    $MachineValue=$MachineDate['hour']  +( $MachineDate['minute'] / 60);
                    
                    
                    $ProcessDate=date_parse($value['Process']);
                    $ProcessValue=$ProcessDate['hour']  +( $ProcessDate['minute'] / 60);
                   
                    $ChangeOverDate=date_parse($value['ChangeOver']);
                    $ChangeOverValue=$ChangeOverDate['hour']  +( $ChangeOverDate['minute'] / 60);
                    
                    $PowerFailureDate=date_parse($value['PowerFailure']);
                    $PowerFailureValue=$PowerFailureDate['hour']  +( $PowerFailureDate['minute'] / 60);
                    
                    $MouldDamagedDate=date_parse($value['MouldDamaged']);
                    $MouldDamagedValue=$MouldDamagedDate['hour']  +( $MouldDamagedDate['minute'] / 60);
                     
                    $PurchaseDate=date_parse($value['Purchase']);
                    $PurchaseValue=$PurchaseDate['hour']  +( $PurchaseDate['minute'] / 60);
                    
                    $StoresDate=date_parse($value['Stores']);
                    $StoresValue=$StoresDate['hour']  +( $StoresDate['minute'] / 60);
                    
                    $OthersDate=date_parse($value['Others']);
                    $OthersValue=$OthersDate['hour']  +( $OthersDate['minute'] / 60);
                    
                    $NoManDate=date_parse($value['NoMan']);
                    $NoManValue=$NoManDate['hour']  +( $NoManDate['minute'] / 60);
                    
                    $IdealDate=date_parse($value['Ideal']);
                    $IdealValue=$IdealDate['hour']  +( $IdealDate['minute'] / 60);
                    
                    $NoPlanDate=date_parse($value['NoPlan']);
                    $NoPlanValue=$NoPlanDate['hour']  +( $NoPlanDate['minute'] / 60);
                    
                    $TrialDate=date_parse($value['Trial']);
                    $TrialValue=$TrialDate['hour']  +( $TrialDate['minute'] / 60);
                 
                    
                    echo $totalBDHrs=$ProcessValue+ $ChangeOverValue+$MachineValue+$PowerFailureValue+$MouldDamagedValue+$PurchaseValue+$StoresValue+$OthersValue+$NoManValue+$IdealValue+$NoPlanValue+$TrialValue; ?></td>
                    <td>
                        <?php
                       // $totalBDHrs=$value['Process']+ $value['ChangeOver']+ $value['Machine']+ $value['PowerFailure']+ $value['MouldDamaged']+ $value['Purchase']+$value['Stores']+$value['Others']+$value['NoMan']+$value['Ideal']+$value['NoPlan']+$value['Trial'];
                    //   if($FmData[2]=='All')
                    //     {echo 12-$totalBDHrs;
                    //     }else{
                        echo 12-$totalBDHrs;
                        // }
                        ?>
                    </td>
                   <?php $start=strtotime($FmData[0]); 
                    $end=strtotime($FmData[1]);
                 
                    $tot=($end - $start)/60/60/24; 
                   
                   ?>
                    
                    <td><?php 
                    
                    //  if($FmData[2]=='All'){
                    // echo $ShiftHrs= 12;}
                    // else{
                    echo $ShiftHrs=12;
                    
                    // }
                    ?></td>
                    <td><?Php 
                    $AvlHrsmin=($tot+1)*60;
                    if($FmData[2]=='All'){
                    echo 12*$AvlHrsmin;} else{
                    echo 12*$AvlHrsmin;    
                    }
                    ?></td>
                    <td>
                       <?php 
                       $trial=$value['Trial'];
                    //  if($FmData[2]=='All'){
                    //     //$tat=$value['Process']+ $value['ChangeOver']+ $value['Machine']+ $value['PowerFailure']+ $value['MouldDamaged']+ $value['Purchase']+$value['Stores']+$value['Others']+$value['NoMan']+$value['Ideal']+$value['NoPlan']+$value['Trial'];
                    //     $totalPrdHrs=12-$totalBDHrs;
                    //     $all=12;
                    //     //$min=$ShiftHrs*60;
                    //     $ee=bcdiv(($totalPrdHrs/($ShiftHrs-($trial/60))*100),1,3);
                    //     echo $ee;
                    //  }
                    // else{
                        //$tat=$value['Process']+ $value['ChangeOver']+ $value['Machine']+ $value['PowerFailure']+ $value['MouldDamaged']+ $value['Purchase']+$value['Stores']+$value['Others']+$value['NoMan']+$value['Ideal']+$value['NoPlan']+$value['Trial'];
                        $totalPrdHrs=12-$totalBDHrs;
                        $all=12;
                        $min=$all*60;
                       $ee=bcdiv(($totalPrdHrs/($ShiftHrs-($trial/60))*100),1,2);
                         echo $ee;
                        // }
                    ?> 
                    </td>
                    <td>
                        <?php 
                        $top=$value['TotProdMtr'];
                        $tpkg=$value['TargetOutput'];
                        $pe=bcdiv((($top/$tpkg)*100),1,3);
                        echo $pe;
                        ?>
                    </td>
                    <td>
                        <?php
                        $acceptedqty=$value['AcceptedQty']*$value['ActualWgt'];
                        $tpkg=$value['TotProdKg'];
                        
                        $qe=bcdiv(($acceptedqty/$tpkg)*100,1,3);
                        echo $qe;
                        ?>
                    </td>
                   <td>
                       <?php
                        // $ee=bcdiv((($t/($min-$tat))*100),1,3);
                        // $pe=bcdiv((($top/$tpkg)*100),1,3);
                        // $qe=bcdiv(($acceptedqty/$tpkg)*100,1,3);
                         echo bcdiv((($ee*$pe*$qe)/10000),1,3);  
                       ?>
                   </td>
                   </tr><?php } ?>
              </tbody>
              </table>
              </div>
              </div>
             <?php } ?>
         
     
<input type="hidden" value="" id="maxCount" name="maxCount">
<br/>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <!--<?php if($mode != 'view' ){ ?>-->
                <!--<a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>-->
                <!--<?php } ?>-->
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } ?>
                
            </div>
     </div>
        
</form>

</section>
            
            
            