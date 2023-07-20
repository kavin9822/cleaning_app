<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data"   id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

    <?php  

    if($mode == 'edit' or $mode == 'view')
    { ?>

   
<?php
    }

    ?>
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
		<div class="row" style="margin:20px">
			<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
               

            <!-- Start heading -->

            <div class="row" style="margin:20px">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Consumable Material Issue No</label>
                    <div class="col-sm-9"> 
                         <input class="form-control" id="con_materialissue_no" name="con_materialissue_no" value="<?php if(isset($FmData[0]['con_materialissue_no'])){echo $FmData[0]['con_materialissue_no'];}else{echo $con_materialissue_no;}?>" type="text"  readonly>
                        </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Emp Type</label>
                    <div class="col-sm-9">
                    <!-- <input class="form-control" id="purchaseorder" name="purchaseorder" value="<?php if(isset($FmData[0]['purchaseorder'])){echo $FmData[0]['purchaseorder'];}else{echo $purchaseorder;}?>" type="text" > -->
                    <!-- <input class="form-control" id="EmployeeType" name="EmployeeType" readonly="true" value="<?php echo $FmData[0]['EmployeeType'];?>" type="text"> -->
                    
                    <?php if(isset($FmData[0]['EmployeeType'])) { ?>
                              <input id="EmployeeType" name="EmployeeType" value="<?php if($FmData[0]['EmployeeType']){echo $FmData[0]['EmployeeType'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeType" id="EmployeeType" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="EmployeeType" id="EmployeeType" required readonly style="pointer-events: none;">
                       <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($Employeetype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EmployeeType']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                </div>              
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Consumable Material Request No</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="con_materialrequest_no" id="con_materialrequest_no"  onchange="Fetch_material_issue_Data(this.value,'EmpName','EmployeeType','Remarks');" required>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($materialrequest_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['con_materialrequest_no']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Reqno']; ?>"><?php echo $v['Reqno']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <label  class="col-sm-3 control-label">Consumable Material Request No</label>
                    <div class="col-sm-9">
                    <?php if($mode=='add') { ?>
                        <select class="form-control" name="con_materialrequest_no" id="con_materialrequest_no"  onchange="Fetch_material_issue_Data(this.value,'EmpName','EmployeeType','Remarks');">
                        <?php } else { ?>
                        <input type="hidden" name="con_materialrequest_no" id="con_materialrequest_no" class="form-control" value="<?php echo $FmData[0]['con_materialrequest_no'];?>">
                        <select class="form-control" name="con_materialrequest" id="con_materialrequest" disabled>
                        <?php } ?>
                        <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($materialrequest_tab_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['con_materialrequest_no']) {
                                        $isselected = 'selected="selected"';
                                    }else{
                                        $isselected = '';
                                         }
                                    ?>
                            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Reqno']; ?>"><?php echo $v['Reqno']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> -->
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Employee Name</label>
                    <div class="col-sm-9">
                    <!-- <input class="form-control" id="remark" name="remark"  value="<?php echo $FmData[0]['Remarks'];?>" type="text" readonly> -->
                    <input class="form-control" id="EmpName" name="EmpName" readonly="true" value="<?php if($FmData[0]['EmpName']){echo $FmData[0]['EmpName'];}else{echo $FmData[0]['SupplierName'];}?>" type="text">
                        <!-- <select class="form-control js-example-basic-single" name="emp_name" id="emp_name"  onmouseover="ycssel()">
                            
                        </select> -->
                    </div>
                </div>
                   


                <div class="form-group">
                    <label  class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-9">
                    <input class="form-control" id="Remarks" name="Remarks"  value="<?php echo $FmData[0]['Remarks'];?>" type="text" readonly>
                    </div>
                    
                </div>

            </div> 


        </div>
       



			<!-- stop ending -->
<!-- table start -->
		
       <!-- Table -->
			<div class="row" style="margin-top:20px;margin-bottom:20px;border:1px solid black; display:block margin-rigth:120px;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id ="materialIssuetools">
                    <thead>
                        <tr>
                            
                            <th>Material Name</th>
							<th>Request Qty</th>
                            <th>Available Stock Qty</th>
                            <th>Pending Qty</th>
                            <th>Issued Qty</th>
                            <!-- <th>Pending Quantity</th> -->
                            <th>Uom</th>
                           
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
                           <input class="form-control" type="text" id="RMName_<?php echo $tii; ?>" name="RMName_<?php echo $tii; ?>"  value="<?php echo $dataValue['RMName'];?>" readonly>
                           <input type="hidden" id="Rawmaterial_ID_<?php echo $tii; ?>" name="Rawmaterial_ID_<?php echo $tii; ?>" value="<?php echo $dataValue['Rawmaterial_ID'];?>"/>
                        </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php echo $dataValue['Quantity'];?>" readonly onkeyup="$(pending_qty_'+count+').val(($(Quantity_'+count+').val() - $(issued_qty_'+count+').val()).toFixed(2));nozero(this.id);rawmt_issue(this.id);" onkeypress="return onlynumbers(event);" required>
                          </div>
         	            </div>
                     </td>
                     <!---->
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="available_qty_<?php echo $tii; ?>" name="available_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['available_qty'])){echo $dataValue['available_qty'];} else{echo $dataValue['available_stock_qty'];} ?>" readonly >
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="issue_qty_<?php echo $tii; ?>" name="issue_qty_<?php echo $tii; ?>" value="<?php if(isset($dataValue['pending_qty'])){echo $dataValue['pending_qty'];}else{echo $dataValue['issue_qty'];}?>" readonly >
                          </div>
         	            </div>
                     </td>
                     <!---->
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="issued_qty_<?php echo $tii; ?>" name="issued_qty_<?php echo $tii; ?>" value="<?php echo $dataValue['issued_qty'];?>" required>
                           <input class="form-control" type="hidden" id="acceptedqty_<?php echo $tii; ?>" name="acceptedqty_<?php echo $tii; ?>" value="<?php if($dataValue['issued_qty']){ echo $dataValue['issued_qty']; } ?>"   readonly style="width:230px">
                          </div>
         	           </div>
                     </td> 
				     <!--<td>                                      -->
         <!--              <div class="form-group">-->
         <!--               <div class="col-sm-12">-->
         <!--                  <input class="form-control" type="text" id="pending_qty_<?php echo $tii; ?>" name="pending_qty_<?php echo $tii; ?>" value="<?php echo $dataValue['pending_qty'];?>" readonly>-->
         <!--                 </div>-->
         <!--	           </div>-->
         <!--             </td> -->
                      <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="UnitName_<?php echo $tii; ?>" name="UnitName_<?php echo $tii; ?>" value="<?php echo $dataValue['UnitName'];?>" readonly>
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
            </div><!-- /.col -->
        </div><!-- /.row -->
		<input type="hidden" value="1" id="maxCount" name="maxCount">	




<!-- table end -->


<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" onmouseover="getRowCount()" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right " name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
  
</section>         
            