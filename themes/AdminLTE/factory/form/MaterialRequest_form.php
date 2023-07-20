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
        <!-- info row -->

        <div class="row">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Material Request No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MaterialRequestNo" name="MaterialRequestNo" value="<?php if(isset($FmData[0]['MaterialRequestNo'])){echo $FmData[0]['MaterialRequestNo'];}else{echo $materialrequest_number;}?>" type="text" readonly>
                    </div>
                </div>

                  <?php  if((is_array($FmData) && count($FmData) >= 1 && $FmData[0]['MRType']=='withbatch' ) or $FmData == null){ ?>
         	    <div class="form-group" id="divBatch">
         	     <label for="BatchNo" class="col-sm-3 control-label">Batch No</label>
                    <div class="col-sm-9">
                        
                       <?php if($mode=='edit' or $mode=='Confirm' or $mode=='view'){ ?>

                        <select class="form-control" name="Batch_ID" id="Batch_ID" disabled>
                       
                       <?php } else {?>
                       
                       <select class="form-control js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getBatchRMDetails('<?php echo $home; ?>',this.value);"  onmouseover="ycssel();" >
                       
                      <?php } ?>
                       
                            <option value="" disabled selected style="display:none;">Select</option>
                           <?php  foreach ($wo_data as $k => $v): 
                          if ($v['ID'] == $FmData[0]['workorder_ID']) {
                          $isselected = 'selected="selected"';
                          }else{
                          $isselected = '';
                          }
                          ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>"  title="<?php echo $v['BatchNo']; ?>"><?php echo $v['BatchNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                         <?php echo isset($FmData[0]['workorder_ID']) && ($FmData[0]['workorder_ID']!='') ? '<input id="BatchNo" name="BatchNo" value='.$FmData[0]["workorder_ID"].'  type="hidden">' : ''; ?>

                    </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                         <?php if($mode=='edit' or $mode=='Confirm'){ ?>
                        <input class="form-control" id="datepicker" name="MaterialRequestDate" value="<?php if (isset($FmData[0]['MaterialRequestDate'])){echo date('d-m-Y',strtotime($FmData[0]['MaterialRequestDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY"   type="text"  readonly>
                   <?php } else {?>
                   <input class="form-control datepicker" id="datepicker" name="MaterialRequestDate" value="<?php if (isset($FmData[0]['MaterialRequestDate'])){echo date('d-m-Y',strtotime($FmData[0]['MaterialRequestDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text"  >
                 
                   <?php } ?>
                    </div>
                </div>

               </div>
         <div class="col-md-6">  
         <div class="form-group">
                 <label  class="col-sm-3 control-label">Material Request Type</label>
                         <div class="col-sm-9">
                             <!--<select class="form-control" name="MRType<?php echo $tii; ?>" id="MRType<?php echo $tii; ?>" onchange="hidebatchno(this.value);"  >--> 
                             <?php if($mode=='edit' or $mode=='Confirm'){ ?> 
                             <select class="form-control" name="Mattype<?php echo $tii; ?>" id="Mattype<?php echo $tii; ?>" disabled> 
                               <?php } else {?>
                               <select class="form-control" name="MRType<?php echo $tii; ?>" id="MRType<?php echo $tii; ?>" onchange="hidebatchno(this.value);" required> 
                             
                                <?php } ?>
                                <option value="" disabled selected style="display:none;">Select</option>
                                    <option <?php  if(isset($FmData[0]['MRType']) && $FmData[0]['MRType']=='withbatch'){echo 'selected="selected"';} ?> value="withbatch" title="WithBatch">With Batch</option>
                                    <option <?php if(isset($FmData[0]['MRType']) && $FmData[0]['MRType']=='withoutbatch'){echo 'selected="selected"';} ?> value="withoutbatch" title="WithoutBatch">Without Batch</option>
                                    </select>
                                     <?php echo isset($FmData[0]['MRType']) && ($FmData[0]['MRType']!='') ? '<input id="MRType" name="MRType" value='.$FmData[0]["MRType"].'  type="hidden">' : ''; ?>

                                    </div>
                            </div>
         
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                        <?php if($mode=='edit' or $mode=='Confirm'){ ?> 
                        <input class="form-control" id="timepicker" name="MaterialRequestTime" value="<?php if ($FmData[0]['MaterialRequestTime']){echo $FmData[0]['MaterialRequestTime'];} else{ echo date('H:i ');} ?>" data-provide="datetimepicker"  type="text" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime()"  readonly>
                      <?php } else {?>
                      <input class="form-control" id="timepicker" name="MaterialRequestTime" value="<?php if ($FmData[0]['MaterialRequestTime']){echo $FmData[0]['MaterialRequestTime'];} else{ echo date('H:i ');} ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="HH:mm" onclick="ycstime()" type="text" >
                   
                       <?php } ?>
                    </div>
                </div>
            
           <div class="form-group">
                    <label  class="col-sm-3 control-label">Area</label>
                    <div class="col-sm-9">
                        <?php if($mode=='edit' or $mode=='Confirm'){ ?> 
                         <select class="form-control" name="area" id="area" disabled>
                        <?php } else {?>
                        <select class="form-control" name="area_ID" id="area_ID" required>
                            <?php }  ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                           <?php  foreach ($area_data as $k => $v): 
                          if ($v['ID'] == $FmData[0]['area_ID']) {
                          $isselected = 'selected="selected"';
                          }else{
                          $isselected = '';
                          }
                          ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>"  title="<?php echo $v['AreaName']; ?>"><?php echo $v['AreaName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                          <?php echo isset($FmData[0]['area_ID']) && ($FmData[0]['area_ID']!='') ? '<input id="area_ID" name="area_ID" value='.$FmData[0]["area_ID"].'  type="hidden">' : ''; ?>

                        
                    </div>
                </div>
                </div>    
           
</div>
         

        
        
         <?php if(is_array($FmData) && count($FmData) >= 1 && $FmData[0]['MRType']=='withbatch') { ?>
        <div class="row">
            <div class="col-xs-12 table-responsive" >
                <table class="table table-striped" >
                    <thead>
                        <tr>
                          
                            <th>Rawmaterial </th>
                            <th>Grade</th>
                            <!--<th>LotNo</th>-->
                            <th>Requested Quantity</th>
                            <th>Issue Quantity</th>
                            <th>Unit Of Measurement</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table" >
                            <?php 
                                if(is_array($FmData) && count($FmData) >= 1):
                                $tii = 1;
                                foreach ($FmData as $dataValue):
                                   
                            ?>
                                             
                            <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                                
                                  <td>                                      
                                     <div class="form-group">
                                        <div class="col-sm-12">
                                            <?php if ($mode=='approve'){?>
                                            
                                              <input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" placeholder="" >

                                              <input class="form-control" type=text name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                            
                                            
                                            <!--<select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii;?>"  readonly>
                                                    <option value="" disabled selected style="display:none;">Select</option>
                                                     <?php    foreach ($rawmaterial_data as $k => $v): 
                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                                        <?php endforeach; ?>
                                                         </select>-->
                                         <?php } else {?>
                                         
                                              <input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" placeholder="" >

                                              <input class="form-control" type=text name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                                         <!--<select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii;?>" >
                                                       <option value="" disabled selected style="display:none;">Select</option>
                                                       <?php    foreach ($rawmaterial_data as $k => $v): 
                                                              if ($v['ID'] == $dataValue['rawmaterial_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                }else{
                                                                        $isselected = '';
                                                                }
                                                               
                                                             ?>
                                                    <option <?php echo $isselected;?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
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
                                                           
                                                <input class="form-control" type="text" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['Grade']){ echo $dataValue['Grade']; } ?>"  readonly>

                                                
                                                       <!--<input type=hidden name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>"  value="<?php if($dataValue['Grade']){ echo $dataValue['Grade'];}?>">-->
                                                             <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>"readonly >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($grade_data as $k => $v): 
                                                                    if ($v['Grade'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>-->
                                        <?php } else {?>
                                                     <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" onblur="matreq(this.id)">-->
                                                     <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" >
                                                          
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($grade_data as $k => $v): 
                                                                    if ($v['Grade'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>-->
                                                         <input class="form-control" type=text name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>"  value="<?php if($dataValue['Grade']){ echo $dataValue['Grade'];} ?>" readonly>

                                        <?php } ?>                 
                                                        </div>
         	                                        </div>
                                                </td>
                         
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php if ($mode=='approve'){?>
                                        <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Requested Quantity" readonly>
                                        <?php } else {?>
                                        <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Requested Quantity" readonly >
                                       <?php } ?>
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php if ($mode=='Confirm'){?>
                                        <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssuedQty']){ echo $dataValue['IssuedQty']; } ?>" placeholder="Issue Quantity" onkeyup="nozero(this.id);NotMoreThanReq(this.id);" onkeypress='return onlyNumberKey(event);' required>
                                           
                                        <!--<input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Issue Quantity" readonly>-->
                                        <?php } else {?>
                                         
                                         <!--<input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssuedQty']){ echo $dataValue['IssuedQty']; } ?>" placeholder="Issue Quantity" readonly>-->
                                          
                                          <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssuedQty']){ echo $dataValue['IssuedQty']; } ?>" placeholder="Issue Quantity" readonly> 
                                            <?php } ?>
                                    </div>
         	                </div>
                            </td>
                            
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                      <?php if ($mode=='approve'){?>
                                                <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Unit of Measurement" readonly>
                                                    <?php } else {?>
                                                        <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Unit of Measurement" readonly> 
                                                         <?php } ?>
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

      <br/>
      
        <!-- Table row -->
        <?php if((isset($FmData[0]['MRType']) && $FmData[0]['MRType']=='withoutbatch') or $FmData == null) { ?>
        
        <div class="row" id="tblRawMaterial">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>RawMaterial</th>
                            <th>Grade</th>
                            <th>Requested Quantity</th>
                            <th>Issued Quantity</th>
                            <th>Unit Of Measurement</th>
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
                                 <!--<input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()" disabled>-->
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
                                                        <?php if ($mode=='approve'){?>
                                                         <!--<select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" readonly >
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
                                                         </select>-->
                                                         <input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" >

                                                          <input class="form-control" type=text name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                                         <?php } else {?>
                                                         <!--<select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" onchange="rawdata(this.value,this.id);uom(this.value,this.id);" >
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
                                                         </select>-->
                                                          <input class="form-control" type="hidden" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['rawmaterial_ID']){ echo $dataValue['rawmaterial_ID']; } ?>" >

                                                          <input class="form-control" type=text name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>"  value="<?php if($dataValue['RMName']){ echo $dataValue['RMName'];} ?>" readonly>

                                                          
                                                         <?php } ?>
                                                        </div>
         	                                        </div>
                                                </td>
                                                 <td>                                      
                                                 <div class="form-group">
                                                       <div class="col-sm-12">
                                                        <?php if ($mode=='approve'){?>
                                                         <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" readonly >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($grade_data as $k => $v): 
                                                                    if ($v['Grade'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>-->
                                                         <input class="form-control" type=text name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>"  value="<?php if($dataValue['Grade']){ echo $dataValue['Grade'];} ?>" readonly>

                                                       <?php } else {?>
                                                       <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" onblur="matreq(this.id);">-->
                                                        <!--<select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" >
                                                      
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($grade_data as $k => $v): 
                                                                    if ($v['Grade'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>-->
                                                         <input class="form-control" type=text name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>"  value="<?php if($dataValue['Grade']){ echo $dataValue['Grade'];} ?>" readonly>

                                                         <?php } ?>
                                                        </div>
         	                                        </div>
                                                </td>
                                                  <td>                                      
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <?php if ($mode=='approve'){?>
                                                        <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Requested Quantity" readonly>
                                                        <?php } else {?>
                                                        <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Requested Quantity" readonly>
                                                       <?php } ?>
                                                    <!--<input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Requested Quantity" required>-->
                                                    </div>
                         	                </div>
                                            </td>
                                                  <td>                                      
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                              <?php if ($mode=='Confirm'){?>
                                                               <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssuedQty']){ echo $dataValue['IssuedQty']; } ?>" placeholder="Issue Quantity" onkeypress="return onlyNumberKey(event);" onkeyup="nozero(this.id );" required>
                                                                <?php } else {?>
                                                                 <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssuedQty']){ echo $dataValue['IssuedQty']; } ?>" placeholder="Issue Quantity" readonly> 
                                                                  <?php } ?>
                                                        <!--<input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Issued Quantity" readonly>-->
                                                        </div>
                             	                </div>
                                                </td>
                                                <td>                                      
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                              <?php if ($mode=='approve'){?>
                                                               <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Issue Quantity" readonly>
                                                                <?php } else {?>
                                                                 <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Issue Quantity" readonly> 
                                                                  <?php } ?>
                                                        
                                                        </div>
                             	                </div>
                                                </td>
                            
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <!--<input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)">-->
                                                <?php if ($mode=='Confirm'){?>
                                                         
                                                <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)" disabled>
                                                  <?php } else { ?>
                                                  
                                                    <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowWOcalc(<?php echo count($FmData)+1; ?>)" disabled>
  
                                  
                                                <?php } ?>  
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
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"  type="button" disabled>
                                    </div>
                                </div>
                            </td>
                            
                              <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="ItemNo_1" id="ItemNo_1" onchange="stockmaterial(this.value,this.id),rawdata(this.value,this.id);uom(this.value,this.id);" >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($rawmaterial_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="ItemName_1" id="ItemName_1" >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($grade_data as $k => $v): ?>
                                                <option  value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                           
                           
                             <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" onkeypress="return onlyNumberKey(event);" placeholder="Requested Quantity" onchange="matreq(this.id)" >
                                         
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" placeholder="Issued Quantity" readonly>
                                         
                                    </div>
         	                </div>
                            </td>
                              <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Unit Of Measurement" readonly>
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
       
        <?php } ?>
         <!-- /.header part  -->
        <br/>
        
        <div class="box-body" >
            <div id="showData">
                
                
            </div>
        </div>
        <!-- /.row -->
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
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCounts()" onfocus="getCounts()" > Submit </button>
                <?php } ?>
                
                
            </div>
        </div>
        <?php if($mode == 'view' && $mode!= 'approve'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
