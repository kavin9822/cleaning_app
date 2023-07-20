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
                    <label  class="col-sm-3 control-label">Material Issue No</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MaterialIssueNo" name="MaterialIssueNo" value="<?php if(isset($FmData[0]['MaterialIssueNo'])){echo $FmData[0]['MaterialIssueNo'];}else{echo $materialissue_number;}?>" type="text" readonly>
                    </div>
                </div>
                  
                  
         
         	    <div class="form-group">
         	     <label for="BatchNo" class="col-sm-3 control-label">Batch No</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" onchange="getBatchMIDetails('<?php echo $home; ?>',this.value);" required onmouseover="ycssel()">
                            <option value="" disabled selected style="display:none;">Select</option>
                           <?php foreach ($wrkorder_data  as $k => $v): 
                          if ($v['ID'] == $FmData[0]['workorder_ID']) {
                          $isselected = 'selected="selected"';
                          }else{
                          $isselected = '';
                          }
                          ?>
                                <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>"  title="<?php echo $v['BatchNo']; ?>"><?php echo $v['BatchNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="datepicker" name="MaterialIssueDate" value="<?php if (isset($FmData[0]['MaterialIssueDate'])){echo date('d-m-Y',strtotime($FmData[0]['MaterialIssueDate']));}else{ echo date('d-m-Y');} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" type="text" required >
                    </div>
                </div>

               </div>
         <div class="col-md-6">  
         
             <div class="form-group">
                    <label  class="col-sm-3 control-label">Time</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="timepicker" name="MaterialIssueTime" value="<?php if ($FmData[0]['MaterialIssueTime']){echo $FmData[0]['MaterialIssueTime'];} else{ echo date('H:i');} ?>" data-provide="datetimepicker" placeholder="HH:mm" data-date-format="YYYY-MM-DD HH:mm" onclick="ycstime()" type="text" required>
                    </div>
                </div>
            
           <div class="form-group">
                    <label  class="col-sm-3 control-label">Area</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Area" name="Area" value="<?php echo $FmData[0]['Area'];?>" type="text">
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
       <?php if(is_array($matreqdata) && count($matreqdata) >= 1) { ?>
        <div class="row">
          
            <div class="col-xs-12 table-responsive">
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                          
                            <th>RawMaterial </th>
                            <th>Grade</th>
                            <th>Lot No</th>
                            <th>Approved Quantity</th>
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
                                        <input class="form-control" type="text" id="lotno_<?php echo $tii; ?>" name="lotno_<?php echo $tii; ?>" value="<?php if($dataValue['LotNo']){ echo $dataValue['LotNo']; } ?>" placeholder="LotNo"readonly >
                                        
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="approvedqty_<?php echo $tii; ?>" name="approvedqty_<?php echo $tii; ?>" value="<?php if($dataValue['ReqQty']){ echo $dataValue['ReqQty']; } ?>" placeholder="Required Quantity"readonly >
                                        
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
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>RawMaterial</th>
                            <th>Grade</th>
                            <th>Lot No</th>
                            <th>Issued Quantity</th>
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
                                                         <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" required>
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
                                                         <select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" required>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($rmmixingdet_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['GDNO']; ?>"><?php echo $v['GDNO']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                                
                                
                               <td>                                      
                                     <div class="form-group">
                                                       <div class="col-sm-12">
                                                         <select class="form-control" name="Amount_<?php echo $tii; ?>" id="Amount_<?php echo $tii; ?>" required>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($matreqdetail_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['LotNo']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['LotNo']; ?>"><?php echo $v['LotNo']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                                <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php if($dataValue['IssQty']){ echo $dataValue['IssQty']; } ?>" placeholder="Issued Quantity">
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
                                         <select class="form-control" name="ItemNo_1" id="ItemNo_1" required>
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
                                         <select class="form-control" name="ItemName_1" id="ItemName_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($rmmixingdet_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['GDNO']; ?>"><?php echo $v['GDNO']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                           
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="Amount_1" id="Amount_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($matreqdetail_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['LotNo']; ?>"><?php echo $v['LotNo']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="Issued Quantity" required>
                                         
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
<input type="hidden" value="" id="maxCount" name="maxCount">
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')"> Submit </button>
                <?php } ?>
                
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
        
            
    </form>

</section>
            
            
            