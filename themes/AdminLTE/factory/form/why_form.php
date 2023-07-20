
<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Logo" style="width:65px;height:35px"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
       
        <div class="row">
            <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
            <div class="col-md-6">
                <div class="form-group">
         	     <label for="BatchNo" class="col-sm-3 control-label">Batch No</label>
                    <div class="col-sm-9">
                         <?php if(isset($FmData[0]['workorder_ID'])){ echo '<input type="hidden" name="workorder_ID" value="'.$FmData[0]['workorder_ID'].'">';} ?>
                        <select class="form-control js-example-basic-single" name="workorder_ID" id="workorder_ID" onchange="machineno(this.value)"; onmouseover="ycssel()" <?php if(isset($FmData[0]['workorder_ID'])){ echo 'disabled';} else {echo 'required'; } ?>>
                            <option value="" disabled selected style="display:none;">Select</option>
                           <?php foreach ($wo_data  as $k => $v): 
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
                    <label  class="col-sm-3 control-label">Name Of The Defect</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="DefectName" name="DefectName" value="<?php echo $FmData[0]['DefectName'];?>" type="text" required>
                    </div>
                </div>
               <div class="form-group">
                <label  class="col-sm-3 control-label">Machine Name</label>
             <div class="col-sm-9">
               <input class="form-control" id="machine_ID" name="machine_ID" value="<?php echo $machine_data[0]['ID'];?>" type="hidden" >    
               <input class="form-control" id="machinename" name="machinename" value="<?php echo $machine_data[0]['MachineName'];?>" type="text" readonly>    
            <!--<select class="form-control" name="machine_ID" id="machine_ID"  readonly>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach($machine_data as $k => $v): 
                    if ($v['ID'] == $FmData[0]['machine_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected;?> value="<?php echo $v['ID'];?>" title="<?php echo $v['MachineName'];?>"><?php echo $v['MachineName'];?></option>
            <?php endforeach; ?>
            </select>-->
            </div>
          </div> 
          
          </div>
         
          <div class="col-md-6">
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="datepicker" name="WhyDate" value="<?php if (isset($FmData[0]['WhyDate'])){echo date('d-m-Y',strtotime($FmData[0]['WhyDate']));}else{ echo date('d-m-Y');} ?>" placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY" type="text" required >
                    </div>
                    </div>
                 
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Problem Description</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ProbDesc" name="ProbDesc" value="<?php echo $FmData[0]['ProbDesc'];?>" type="text" required>
                    </div>
                </div>
                  
          <div class="form-group">
                    <label  class="col-sm-3 control-label">Occurence</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="Occurence" name="Occurence" value="<?php echo $FmData[0]['Occurence'];?>" type="text">
                    </div>
                </div>
                </div>
                </div>
                
           <h5></h5> 
               <div style="margin:auto;width:100%;border-style:solid;border-color:black;border-width:1px;padding:50px;">  
                <div class="row">       
                <!-- /.header part  -->
        <br/>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>why</th>
                            <th>Answer</th>
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
                                        <!--<input class="form-control" type="text" style="width: 60px;"  id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php if($dataValue['why']){ echo $dataValue['why']; } ?>" placeholder="why">-->
                                        <textarea class="form-control" id="EmpName_<?php echo $tii; ?>"  name="EmpName_<?php echo $tii; ?>" value="" placeholder="Why"><?php if($dataValue['why']){ echo $dataValue['why']; } ?></textarea>
                                    </div>
         	                   </div>
                             </td>
                                  
                             <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <!--<input class="form-control" type="text" style="width: 60px;"  id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php if($dataValue['answer']){ echo $dataValue['answer']; } ?>" placeholder="Answer">-->
                                        <textarea class="form-control" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>"  value="" placeholder="Answer"><?php if($dataValue['answer']){ echo $dataValue['answer']; } ?></textarea>
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
                                       <!-- <input style="width:200px !important" class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="Why">-->
                                        <textarea class="form-control"  id="EmpName_1" name="EmpName_1"  value="" placeholder="Why"></textarea>
                                    </div>
         	                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                       <!-- <input style="width:200px !important" class="form-control" type="text" id="ItemNo_1" name="ItemNo_1" value="" placeholder="answer">-->
                                         <textarea class="form-control"  id="Water_1" name="Water_1"  value="" placeholder="Answer"></textarea>
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
        </div>
        </div>
        
        <h5></h5>
                 <div style="margin:auto;width:100%;border-style:solid;border-color:black;border-width:1px;padding:50px;"> 
                <div class="row">
                    <div class="col-md-6"> 
                    <div class="form-group">
                    <label  class="col-sm-3 control-label">Containment Action</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ContainmentAction" name="ContainmentAction" value="<?php echo $FmData[0]['ContainmentAction'];?>" type="text">
                    </div>
                </div></div>
                <div class="col-md-6"> 
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Containment Response</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ContainmentResp" name="ContainmentResp" value="<?php echo $FmData[0]['ContainmentResp'];?>" type="text">
                    </div>
                </div></div>
            
                 <div class="col-md-6"> 
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">Containment Target</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="ContainmentTarget" name="ContainmentTarget" value="<?php echo $FmData[0]['ContainmentTarget'];?>" type="text">
                    </div>
                </div></div>
                </div>
                </div>
            
          <h5></h5>
           <div style="margin:auto;width:100%;border-style:solid;border-color:black;border-width:1px;padding:50px;"> 
                <div class="row">
                <div class="col-md-11">  
                 <div class="form-group">
                    <label  class="col-sm-2 control-label">Actual Root Cause</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="ActRootCause" name="ActRootCause" value="<?php echo $FmData[0]['ActRootCause'];?>" type="text">
                    </div>
                </div>
               
                 <div class="form-group">
                    <label  class="col-sm-2 control-label">Actual Root Response</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="ActRootResp" name="ActRootResp" value="<?php echo $FmData[0]['ActRootResp'];?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Actual Root Target</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="ActRooeTarget" name="ActRooeTarget" value="<?php echo $FmData[0]['ActRooeTarget'];?>" type="text">
                    </div>
                </div>
                </div>
                </div>
                </div>
                
                
              
                 <h5></h5> 
               <div style="margin:auto;width:100%;border-style:solid;border-color:black;border-width:1px;padding:50px;">  
                <div class="row">
                <div class="col-md-11">
                     <div class="form-group">
                    <label  class="col-sm-2 control-label">Corrective Action</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="CorrAction" name="CorrAction" value="<?php echo $FmData[0]['CorrAction'];?>" type="text">
                    </div>
                     </div>
                    
                     <div class="form-group">
                    <label  class="col-sm-2 control-label">Corrective Action Response</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="CorrActResp" name="CorrActResp" value="<?php echo $FmData[0]['CorrActResp'];?>" type="text">
                    </div>
                     </div>
                    
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Corrective Action Target</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="CorrActTarget" name="CorrActTarget" value="<?php echo $FmData[0]['CorrActTarget'];?>" type="text">
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                <h5></h5> 
               <div style="margin:auto;width:100%;border-style:solid;border-color:black;border-width:1px;padding:50px;">  
                <div class="row">
                <div class="col-md-11">
                     <div class="form-group">
                    <label  class="col-sm-2 control-label">Preventive Action</label>
                    <div class="col-sm-10">
                    <!--<textarea class="form-control" id="PrevAction" name="PrevAction"  value=""><?php echo $FmData[0]['PrevAction'];?></textarea>-->
                     <input class="form-control" id="PrevAction" name="PrevAction" value="<?php echo $FmData[0]['PrevAction'];?>" type="text">
                    </div>
                   </div>
                 
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">Preventive Action Response</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="PrevActResp" name="PrevActResp" value="<?php echo $FmData[0]['PrevActResp'];?>" type="text">
                    </div>
                   </div>   
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">Preventive Action Target</label>
                    <div class="col-sm-10">
                    <input class="form-control" id="PrevActTarget" name="PrevActTarget" value="<?php echo $FmData[0]['PrevActTarget'];?>" type="text">
                    </div>
                   </div>   
                 </div>
                 </div>
                 </div>
            

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
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount()" onfocus="getCount()"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
            
            
            