<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
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
                    <label  class="col-sm-3 control-label">Batch No </label>
                     <div class="col-sm-9">
            <?php if($mode=='view'){ ?>
             <select class="form-control  js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getparameterdetail('<?php echo $home; ?>',this.value);" disabled onmouseover="ycssel()">
      
            <?php } else { ?>
             <select class="form-control  js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getparameterdetail('<?php echo $home; ?>',this.value);"required onmouseover="ycssel()">
      
            <?php } ?>
                 <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($wrk_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['BatchNo']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['BatchNo']; ?>"><?php echo $v['BatchNo']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
          
              <div class="form-group">
                    <label  class="col-sm-3 control-label">Part No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="product_ID" name="product_ID" value="<?php echo $FmData[0]['product_ID'];?>" type="hidden" readonly>
                        <input class="form-control" id="productname" name="productname" value="<?php  echo $FmData[0]['ItemName'];?>" type="text" readonly>
                    </div>
                </div>
         	
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Machine </label>
                    <div class="col-sm-9">
                        <input class="form-control" id="machine_ID" name="machine_ID" value="<?php echo $FmData[0]['machine_ID'];?>" type="hidden" readonly>
                        <input class="form-control" id="machinename" name="machinename" value="<?php echo $FmData[0]['MachineName'];?>" type="text" readonly>
                    </div>
                </div>
         	
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Total Mixing</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="TotalMixing" name="TotalMixing" value="<?php echo $FmData[0]['TotalMixing'];?>" type="text" onchange="RMMixingCalc(this.value,'product_ID')"onkeyup="nozero(this.id );" onkeypress="return onlyNumberKey(event);" required>
                    </div>
                </div>
                
        </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <!--<input class="form-control datepicker" id="datepicker" name="MixingDate" value="<?php if (isset($FmData[0]['MixingDate'])){echo date('d-m-Y',strtotime($FmData[0]['MixingDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" type="text" required >-->
                   
                        <input class="form-control datepicker" id="datepicker" name="MixingDate" value="<?php if (isset($FmData[0]['MixingDate'])){echo date('d-m-Y',strtotime($FmData[0]['MixingDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY"  type="text" required >
                   
                    </div>
                </div>
            
            <div class="form-group">
            <label  class="col-sm-3 control-label">Shift </label>
             <div class="col-sm-9">
            <select class="form-control" name="shift_ID" id="shift_ID"  required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($shift_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['shift_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ShiftName']; ?>"><?php echo $v['ShiftName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
            
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Customer</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="customer_ID" name="customer_ID" value="<?php echo $FmData[0]['customer_ID'];?>" type="hidden" readonly>
                        <input class="form-control" id="customername" name="customername" value="<?php echo $FmData[0]['FirstName'];?>" type="text" readonly>
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
      
         
<!-- /.header part  -->
        <br/>
        <!-- Table row -->
        <?php if(is_array($FmData) && count($FmData) >= 1) { ?>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        
                            <th>RawMaterial </th>
                            <th>Grade </th>
                            <th style="display:none;">LotNo</th>
                            <th>RMMixing Time </th>
                            <th>Mixing Percentage</th>
                            <th>Total Consumption</th>
                             <th>UnitOfMeasurement</th>
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
                                                         <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" required readonly>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($rawmaterial_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                     <td>                                      
                                        <div class="form-group">
                                          <div class="col-sm-12">
                                          <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['GDNO']){ echo $dataValue['GDNO']; } ?>" placeholder="Grade"readonly >
                                          </div>
         	                            </div>
                                    </td>
                                    <td style="display:none;">                                      
                                       <div class="form-group">
                                            <div class="col-sm-12">
                                            <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>" placeholder="LotNumber"readonly >
                                            </div>
         	                            </div>
                                    </td>
                                  
                            
                                  <td>                                      
                                    <div class="form-group">
                                         <div class="col-sm-12">
                                         <input class="form-control" type="text" id="Water_" value="<?php if ($datavalue['RMTime']){echo $datavalue['RMTime'];}else{ echo date('H:i');}  ?>" name="Water_" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" readonly > 
                                        </div>
         	                         </div>
                                     </td>
                                <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['MixingPerc']){ echo $dataValue['MixingPerc']; } ?>" placeholder="Mixing Percentage" onkeypress="return onlyNumberKey(event);">
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['TotConsumption']){ echo $dataValue['TotConsumption']; } ?>" placeholder="Total Consumption" onkeypress="return onlyNumberKey(event);">
                                    </div>
         	                </div>
                            </td>
                              <td>                                      
                                        <div class="form-group">
                                          <div class="col-sm-12">
                                          <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Unit of measurement"readonly >
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
                                        
                    <?php endif; ?>
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
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('noclone')" onfocus="getCount('noclone')"> Submit </button>
                <?php } ?>
                  
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
            
            
            