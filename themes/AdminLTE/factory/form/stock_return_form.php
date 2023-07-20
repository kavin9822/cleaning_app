<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
    <?php if($mode == 'edit'){ ?>

<script>
    
          if(window.addEventListener)
         {
             window.addEventListener('load', myfunction);
            //  window.addEventListener('load', myreturnquantity);
        }
        else
        { 
            window.attachEvent('onload', myfunction);
            // window.attachEvent('onload', myreturnquantity);
        }


function myfunction(){

     var tablee = document.getElementById('tableId');
     var tablerowlength = tablee.rows.length;
    //  console.log(tablerowlength);

     for(var i = 1 ; i<tablerowlength ;i++)
     {
        //  var rawmaterialdata = document.getElementById('ItemNo_'+ i).value;
        // //  console.log(rawmaterialdata);
        //  var basePath ='https://dev.kosherp.com';
        //  //console.log(i);
         
        //  $.post(basePath + "/lib/ajax/get_fieldValue.php", {'poid': rawmaterialdata}, function (data) {
        //     console.log(i);
        // $('#Grade_'+ i).val(data[0]['Grade']);
        // $('#Unit_'+ i).val(data[0]['UnitName']);
        // $('#IssuedQuantity_'+i).val(data[0]['IssQty']);

        // }, "json");


     }
    


    // var poid1 = document.getElementById('workorder_ID').value;
    // var poid2 = document.getElementById('materialissue_value').value;
    // var poid4 = document.getElementById('ItemNo_1').value;
   
    // console.log(poid3);

 

    //      $.post(poid3 + "/lib/ajax/get_fieldValue.php", {'poid': poid4}, function (data) {

    //     $('#Grade_1').val(data[0]['Grade']);
    //     $('#Unit_1').val(data[0]['UnitName']);
    //     $('#IssuedQuantity_1').val(data[0]['IssQty']);

    //     }, "json");



} 

</script>


 <?php  } ?>
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

        
            <!-- <div class="col-md-3"> 
                <div class="form-group">
                    <label for="ReceiptDate" class="col-sm-4 control-label">Material Issue Date</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="datepicker" name="MaterialIssueDate" value="<?php if (isset($FmData[0]['MaterialIssueDate'])){echo date('d-m-Y',strtotime($FmData[0]['MaterialIssueDate']));} ?>"  data-provide="datetimepicker" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" onblur="getBatchforStkRtn('<?php echo $home; ?>',this.value,'workorder_ID');"  type="text" required>
                    </div>
                </div>
            </div> -->
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="BatchNo" class="col-sm-3 control-label">Batch No.</label>
                   
                    <div class="col-sm-9">
                        <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                       <?php if($mode=='view'){?>
                       
                       <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" onmouseover="ycssel()" onchange="get('<?php echo $home; ?>',this.value,'MaterialIssueNo');" disabled> 
                     
                       <?php } else {?>
                       
                       <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" onmouseover="ycssel()" onchange="get('<?php echo $home; ?>',this.value,'MaterialIssueNo');" required> 
                     
                       <?php } ?>
                           <option value="" disabled selected style="display:none;">Select</option>
                           
                            <?php foreach ($wrkorder_data as $work_opt_value): ?>
                            <?php   if ($work_opt_value['ID'] == $FmData[0]['workorder_ID']) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 

                                <option <?php echo $isselected; ?> value="<?php echo $work_opt_value['ID']; ?>" title="<?php echo $work_opt_value['BatchNo']; ?>"><?php echo $work_opt_value['BatchNo']; ?></option>
                            <?php endforeach; ?>
                        
                        
                        </select>
                        
                    </div>
                </div>
            </div>   

                 <div class="col-md-4">

                <div class="form-group">
                    <label for="Section"  class="col-sm-4 control-label">Material Issue No.</label>
                    <div class="col-sm-8">
                        <select class="form-control"  name="MaterialIssueNo" id="MaterialIssueNo"  onchange="getarea('<?php echo $home;?>',this.value,'area_ID','Area_idvalue');getRawMaterialFromBatchNo('<?php echo $home ;?>');getBatchDetails('<?php echo $home ;?>');getItName(this.id);" required>
                       
                        <option value="" disabled selected style="display:none;">Select</option>

                            <?php foreach ($FmData as $area_opt_value): ?>
                            <?php  if($area_opt_value['MaterialIssueNo'] != null ) { 
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 
                               
                                <option <?php echo $isselected; ?> value="<?php echo $area_opt_value['ID']; ?>" title="<?php echo $area_opt_value['MaterialIssueNo']; ?>"><?php echo $area_opt_value['MaterialIssueNo']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <input type="hidden" name="materialissue_value" value="<?php echo $FmData[0]['MaterialIssueNo'] ?>"  id="materialissue_value">
                    </div>
                </div>
            </div> 
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Area"  class="col-sm-4 control-label">Area</label>
                    <div class="col-sm-8">

                        <input class="form-control" id="area_ID" name="area_ID" value="<?php echo $area_data[0]['AreaName']; ?>"  placeholder="Material Issue No." type="text" readonly >

                        <input type="hidden" value="<?php echo $FmData[0]['area_ID']; ?>" name="Area_idvalue" id="Area_idvalue">


                        <!-- <select class="form-control" name="area_ID" id="area_ID" required onchange="getmisno('<?php echo $home; ?>',this.value,'MaterialIssueNo');getrawmaterial('<?php echo $home; ?>',this.value,this.id);">
                        <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($area_data as $area_opt_value): ?>
                            <?php  if($area_opt_value['ID'] == $FmData[0]['area_ID']) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 
                                <option <?php echo $isselected; ?> value="<?php echo $area_opt_value['ID']; ?>" title="<?php echo $area_opt_value['AreaName']; ?>"><?php echo $area_opt_value['AreaName']; ?></option>
                            <?php endforeach; ?>
                        </select> -->

                    </div>
                </div>
            </div>

        
            
        </div>
        
        <!-- /.header part  -->
        <br/>
        <!-- <div class="box-body">
            <div id="showData">
                
                
            </div>
        </div>  -->
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <h5><u>Issued Raw Materials</u></h5>
                <table id="tableId" class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>RawMaterial</th>
                            <th>Grade</th>
                            <th>Unit Of Measurement</th>
                            <th>Issued Quantity</th>
                            <th>Return Quantity</th>
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
                                 <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove()" >
                                 </div>
                                 </div>
                                 </td>
                                  <td>
                                     <div class="form-group">
                                                       <div class="col-sm-12">
                                                         <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" onchange="getfieldvalue('<?php echo $home;?>',this.value,this.id );validateExist(this.id,'invoice_listing_table');" required>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($rawMaterial_data as $k => $v): 
                                                                    
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
                                                         <!-- <select class="form-control" name="Grade_<?php echo $tii; ?>" id="Grade_<?php echo $tii; ?>" >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($rawmaterial_grade_data as $k => $v): 
                                                                    if ($v['Grade'] == $dataValue['Grade']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select> -->
                                                         <input class="form-control" type="text" id="Grade_<?php echo $tii; ?>" name="Grade_<?php echo $tii; ?>" value="<?php if($dataValue['Grade']){ echo $dataValue['Grade']; } ?>" placeholder="Grade" readonly >
                                                        </div>
         	                                        </div>
                                                </td>
                                                
                                
                                    <td>                                      
                                     <div class="form-group">
                                                       <div class="col-sm-12">
<!-- 
                                                         <select class="form-control" name="EmpName_<?php echo $tii; ?>" id="EmpName_<?php echo $tii; ?>">
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($grndetail_data as $k => $v): 
                                                                    if ($v['LotNo'] == $dataValue['LotNo']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['LotNo']; ?>" title="<?php echo $v['LotNo']; ?>"><?php echo $v['LotNo']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select> -->

                                                         <input class="form-control" type="text" id="Unit_<?php echo $tii; ?>" name="Unit_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Unit" readonly  >
                                                        </div>
         	                                        </div>
                                                </td>
                           
                            
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="IssuedQuantity_<?php echo $tii; ?>" name="IssuedQuantity_<?php echo $tii; ?>" value="<?php if($dataValue['IssQty']){ echo $dataValue['IssQty']; } ?>" placeholder="Issued Quantity" readonly  >
                                        
                                    </div>
         	                </div>
                            </td>
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <input class="form-control" type="text" id="ReturnQuantity_<?php echo $tii; ?>" name="ReturnQuantity_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>" placeholder="Return Quantity" required onkeyup ="quantityvalidation(this.id,this.value);" onkeydown="return onlyNumberKey(event);"  onfocusout="matissue(this.id);" >
                                  
                                    <input type="hidden" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php if($dataValue['Quantity']){ echo $dataValue['Quantity']; } ?>">
                                    </div>
         	                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowcalc(<?php echo count($FmData)+1; ?>)" >
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
                                         <select class="form-control" name="ItemNo_1" id="ItemNo_1" onchange="getfieldvalue('<?php echo $home;?>',this.value,this.id);validateExist(this.id,'invoice_listing_table');" required >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                        
                                            <?php foreach ($rawMaterial_data as $k=>$v):
                                    
                                                if ( $v['ID'] == $FmData["rawmaterial_ID"] )
                                                            {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                         }
                                                                ?>
                                                <option <?php echo $isselected; ?>  value="<?php echo $v['ID']; ?>" title="<?php echo $v['RMName']; ?>"><?php echo $v['RMName']; ?></option>
                                            <?php  endforeach; ?>
                                        </select>
                                    </div>
         	                </div>
                            </td>
                          <!--   <td> -->
                          <!--      <div class="form-group">-->
                          <!--          <div class="col-sm-12">-->
                          <!--               <select class="form-control" name="Grade_1" id="Grade_1" required>-->
                          <!--                  <option value="" disabled selected style="display:none;">Select</option>-->
                          <!--                  <?php foreach ($rmmixingdet_data as $k => $v): ?>-->
                          <!--                      <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['GDNO']; ?>"><?php echo $v['GDNO']; ?></option>-->
                          <!--                  <?php endforeach; ?>-->
                          <!--              </select>-->
                          <!--          </div>-->
         	                <!--</div>-->
                          <!--  </td>-->
                           <td> 
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!-- <select class="form-control" name="Grade_1" id="Grade_1" >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($rawmaterial_grade_data as $k => $v): ?>
                                                <option  value="<?php echo $v['Grade']; ?>" title="<?php echo $v['Grade']; ?>"><?php echo $v['Grade']; ?></option>
                                            <?php endforeach; ?>
                                        </select> -->

                                        <input class="form-control" type="text" id="Grade_1" name="Grade_1" value="" placeholder="Grade" readonly >


                                    </div>
         	                </div>
                            </td>
                           
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!-- <select class="form-control" name="EmpName_1" id="EmpName_1" >
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($grndetail_data as $k => $v): ?>
                                                <option  value="<?php echo $v['LotNo']; ?>" title="<?php echo $v['LotNo']; ?>"><?php echo $v['LotNo']; ?></option>
                                            <?php endforeach; ?>
                                        </select> -->

                                        <input class="form-control" type="text" id="Unit_1" name="Unit_1" value="" placeholder="Unit " readonly    >

                                    </div>
         	                </div>
                            </td>
                             
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="IssuedQuantity_1" name="IssuedQuantity_1" value="" placeholder="Issued Quantity" readonly  >
                                        
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="ReturnQuantity_1" name="ReturnQuantity_1" value="<?php if($FmData[0]['Quantity']==true) {var_dump( $FmData[0]['Quantity']);}else {echo "";} ?>" required placeholder="Return Quantity" onkeyup ="quantityvalidation(this.id,this.value);" onkeydown="return onlyNumberKey(event)"  required onfocusout="matissue(this.id);">
                                         
                                    </div>
         	                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRowcalc()">
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
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()" onclick="return confirm('Are you sure you want to return item to stock?');"> Submit </button>
                <?php } else if($mode == 'add') { ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount()" onfocus="getCount()" onclick="return confirm('Are you sure you want to return item to stock?');"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary no-print" > List </a>
        <?php } ?>
    </form>

</section>