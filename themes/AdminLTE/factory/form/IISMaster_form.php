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
            <label  class="col-sm-3 control-label">Part No</label>
             <div class="col-sm-9">
                 
            <select class="form-control" name="product_ID" id="product_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($product_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['product_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ItemName']; ?>"><?php echo $v['ItemName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
            
         	<div class="form-group">
            <label class="col-sm-3 control-label">Approved By</label>
            <div class="col-sm-9">
            <select class="form-control" name="approvedby_ID" id="approvedby_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($emp_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['approvedby_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EmpName']; ?>"><?php echo $v['EmpName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
             </div>
            
            <div class="col-md-6">
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="datepicker" name="IISDate" value="<?php if (isset($FmData[0]['IISDate'])){echo date('d-m-Y',strtotime($FmData[0]['IISDate']));}else{ echo date('d-m-Y');} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" required >
                    </div>
                </div>
           </div>
           
           </div>
         
           
      
         
<!-- /.header part  -->
        <br/>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Description </th>
                            <th>Specification</th>
                            <th>Equipment</th>
                            <th>Class</th>
                            <th>Sample Size</th>
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
                                                         <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" required >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($iisdescmaster_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['iisdescmaster_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Description']; ?>"><?php echo $v['Description']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                                 <td>                                      
                                        <div class="form-group">
                                                       <div class="col-sm-12">
                                                         <select class="form-control" name="Qty_<?php echo $tii; ?>" id="Qty_<?php echo $tii; ?>" required >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($pmchklistdetail_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['Spec']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Specification']; ?>"><?php echo $v['Specification']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                                
                                            <td>                                      
                                                <div class="form-group">
                                                       <div class="col-sm-12">
                                                         <select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" required >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($equipment_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['equipment_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EquipmentName']; ?>"><?php echo $v['EquipmentName']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                                </td>
                                    <td>                                      
                                     <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="EmpName_<?php echo $tii; ?>" name="EmpName_<?php echo $tii; ?>" value="<?php if($dataValue['Class']){ echo $dataValue['Class']; } ?>" placeholder="Class" >
                                    </div>
         	                        </div>
                                    </td>
                                 <td>                                      
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['SampleSize']){ echo $dataValue['SampleSize']; } ?>" placeholder="SampleSize" >
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
                                            <?php foreach ($iisdescmaster_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['Description']; ?>"><?php echo $v['Description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <select class="form-control" name="Qty_1" id="Qty_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($pmchklistdetail_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['Specification']; ?>"><?php echo $v['Specification']; ?></option>
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
                                            <?php foreach ($equipment_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['EquipmentName']; ?>"><?php echo $v['EquipmentName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="EmpName_1" name="EmpName_1" value="" placeholder="Class" required>
                                         
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Sample Size" required>
                                         
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
                <?php if($mode != 'view'){ ?>
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
            
            
            