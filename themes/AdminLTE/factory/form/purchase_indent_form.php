<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view' || $mode=='Confirm' || $FmData[0]['Status']==1){ ?>
     <fieldset >
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
                
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Purchase Indent No</label>
                    <div class="col-sm-8">
                         <input class="form-control" id="PurchaseIndentNo" name="PurchaseIndentNo" value="<?php if(isset($FmData[0]['PurchaseIndentNo'])){echo $FmData[0]['PurchaseIndentNo'];}else{echo $PurchaseIndentNo;}?>" type="text" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">  
               
            </div>    
        </div>
       
 <!-- Table row -->
        <div class="row" style="border:1px solid black;margin:20px;padding:15px 10px;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Items</th>
                            <th>Grade</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            <th>Req For (PO NO)</th>
                            <th>Required On</th>
                            <th>Remarks</th>
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
                                         <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove()";?> disabled>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>" onchange="rawmtrl_agianst_grade_unit(this.value,this.id,'Grade_','unit_');validateExist(this.id,'invoice_listing_table')" disabled required>
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
                                            <input class="form-control" type="text"  readonly id="Grade_<?php echo $tii; ?>" name="Grade_<?php echo $tii; ?>" value="<?php if($dataValue['Grade']){ echo $dataValue['Grade']; } ?>"  placeholder="" >
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" required id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" onkeypress="return onlyNumbernodecimal(event);" onkeyup="nozero(this.id);" placeholder="" >
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" disabled required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): 
                                                        if ($v['ID'] == $dataValue['unit_ID']) {
                                                            $isselected = 'selected="selected"';
                                                        }else{
                                                            $isselected = '';
                                                        }
                                                       
                                                 ?>
                                                 <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text"  id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['PONo']){ echo $dataValue['PONo']; } ?>"  onkeypress="return onlyNumbernodecimal(event);" autocomplete="off" required readonly>
                                        </div>
                                    </div>
                                </td>
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"   name="Emp_<?php echo $tii; ?>" id="Emp_<?php echo $tii; ?>" value="<?php if(isset($dataValue['RequiredOn']) && $dataValue['RequiredOn']!='0000-00-00'){ echo date('d-m-Y',strtotime($dataValue['RequiredOn']));} ?>"  onkeypress="return onlyNumbernodecimal(event);" required readonly>
                                               
                                        </div>
                                    </div>
                                </td>
                                
                                <td>                                      
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <input class="form-control" type="text"  name="Water_<?php echo $tii; ?>" id="Water_<?php echo $tii; ?>" value="<?php if($dataValue['Remarks']){ echo $dataValue['Remarks']; } ?>" readonly>
                                               
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
                                        <!--<select class="form-control" name="rawmaterial_1" id="rawmaterial_1" onchange="SqlbasedSelectdetail(this.value,this.id,'unit_','unit','rawmaterial','UnitName','unit_ID','rawmaterial');" required>-->
                                            <select class="form-control" name="rawmaterial_1" id="rawmaterial_1" onchange="rawmtrl_agianst_grade_unit(this.value,this.id,'Grade_','unit_');validateExist(this.id,'invoice_listing_table')" required>   
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
                                        <input class="form-control" type="text" id="Grade_1" name="Grade_1" value="" placeholder="" readonly>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" required autocomplete="off" id="Quantity_1" name="Quantity_1" value="" placeholder="" onkeypress="return onlyNumbernodecimal(event);" onkeyup="nozero(this.id);">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                            <select class="form-control" name="unit_1" id="unit_1" required>
                                               <option value="" disabled selected style="display:none;">Select</option>
                                                 <?php foreach ($unit_data as $k => $v): ?>
                                                 <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['UnitName']; ?>"><?php echo $v['UnitName']; ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <input class="form-control"  type="text" id="Note_1" name="Note_1" value=""  onkeypress="return onlyNumbernodecimal(event);" autocomplete="off" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text"  name="Emp_1" id="Emp_1" value="" data-provide="datetimepicker" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY"  onkeypress="return onlyNumbernodecimal(event);" required>
                                           
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                   <input class="form-control" type="text"  name="Water_1" id="Water_1" value="" >
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
        
        <?php if($mode == 'Confirm' || $FmData[0]['Status']==1){ ?>
           </fieldset>
        <?php }?>
        <?php if($mode=='Confirm' || $FmData[0]['Status']==1){ ?>
        <div class="row" style="border:1px solid black;padding:15px 10px;margin:20px">
                <div class="col-md-6">
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Prepared by</label>
                        <div class="col-sm-9">
                             <input class="form-control" id="PreparedBy" name="PreparedBy" readonly value="<?php if($preparedby){ echo $preparedby; } ?>" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <?php if($mode=='Confirm' || $FmData[0]['Status']==1) { ?>
                <div class="form-group">
                    <label  class="col-sm-4 control-label">Approved By</label>
                    <div class="col-sm-8">
                        <select class="form-control js-example-basic-single" name="ApprovedBy" id="ApprovedBy" <?php if($FmData[0]['Status']==1) { echo 'disabled';}else{ echo 'required';} ?>  onmouseover="ycssel()"  aria-hidden="true">
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($approver_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['ApprovedBy']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['user_nicename']; ?>"><?php echo $v['user_nicename']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div> 
        <?php } ?>
<input type="hidden" value="" id="maxCount" name="maxCount">
<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
<br/>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                 <?php if($mode == 'Confirm'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="confirm_submit_button" value="confirm" onmouseover="getCount('')" onfocus="getCount('')" > Confirm </button>
                <?php } ?>
                <?php if($mode == 'edit' && $FmData[0]['Status']!=1){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')" > Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary"> List </a>
        <?php } ?>
        
            
    </form>

</section>
     
