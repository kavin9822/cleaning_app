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
            <div class="col-md-4">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                 <div class="form-group">
                <label  class="col-sm-2 control-label">Machine</label>
             <div class="col-sm-9">
                 
            <?php if($mode=='view'){?>
           
            <select class="form-control js-example-basic-single" name="pmchecklistmaster_ID" id="pmchecklistmaster_ID" onchange="getPMChecklistDetail('<?php echo $home; ?>',this.value);" disabled onmouseover="ycssel()">
        
            <?php } else { ?>
            
            <select class="form-control js-example-basic-single" name="pmchecklistmaster_ID" id="pmchecklistmaster_ID" onchange="getPMChecklistDetail('<?php echo $home; ?>',this.value);" required onmouseover="ycssel()">
        
            <?php } ?>
                <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($pmchklistmaster_data  as $key => $value): 
                         if ($value['ID'] == $FmData[0]['pmchecklistmaster_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
                    <option <?php echo $isselected;?> value="<?php echo $value['ID']; ?>" data-machinename= "<?php echo $value['MachineName']; ?>" title="<?php echo $value['MachineName']; ?>"><?php echo $value['MachineName']; ?></option>
                    <?php endforeach; ?>
                    </select>
            </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                    <label  class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-9">
                        <input class="form-control datepicker" id="datepicker" name="ObsDate" value="<?php if (isset($FmData[0]['ObsDate'])){echo date('d-m-Y',strtotime($FmData[0]['ObsDate']));}else{ echo date('d-m-Y');} ?>"  placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" required >
                    </div>
                </div>
                </div>
         	
         <div class="col-md-4">	
      	 <div class="form-group">
                <label  class="col-sm-2 control-label">Approved By</label>
             <div class="col-sm-9">
                 
             <?php if($mode=='view'){?>
            
            <select class="form-control js-example-basic-single" name="Approvedby_ID" id="Approvedby_ID" disabled onmouseover="ycssel()">
           
            <?php } else { ?>
            
             <select class="form-control js-example-basic-single" name="Approvedby_ID" id="Approvedby_ID" required onmouseover="ycssel()">
       
            
            <?php } ?>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($emp_data  as $key => $value):
                        if ($value['ID'] == $FmData[0]['Approvedby_ID']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                        
                    ?>
                     <option <?php echo $isselected;?> value="<?php echo $value['ID']; ?>"  title="<?php echo $value['EmpName']; ?>"><?php echo $value['EmpName']; ?></option>
                    <?php endforeach; ?>
                    </select>
            </div>
            </div>
            </div>
        </div>
      
         
<!-- /.header part  -->
 <h5><u>PMCheckList Detail</u></h5>
        <div class="box-body">
            <div id="showData">
                
                
            </div>
        </div>
        
         <!-- Table row -->
         <?php if(is_array($FmData) && count($FmData) >= 1) { ?>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>CheckPoint</th>
                            <th>Specification</th>
                            <th>Observation</th>
                            <th>Corrective Action</th>
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
                                                    <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" readonly>
                                                        <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($pmchklistdet_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['pmchecklistdetail_ID']) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    }
                                                                   
                                                             ?>
                                                             <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['CheckPoint']; ?>"><?php echo $v['CheckPoint']; ?></option>
                                                             <?php endforeach; ?>
                                                         </select>
                                                        </div>
         	                                        </div>
                                </td>
                                
                                <td>                                      
                                    <div class="form-group">
                                            <div class="col-sm-12">
                                                    <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>" readonly>
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($pmchklistdetail_data as $k => $v): 
                                                                    if ($v['ID'] == $dataValue['pmchecklistdetail_ID']) {
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
                                        <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['Observation']){ echo $dataValue['Observation']; } ?>" placeholder="Observation" >
                                    </div>
         	                </div>
                            </td>
                            
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['CorrAction']){ echo $dataValue['CorrAction']; } ?>" placeholder="Corrective Action" >
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
<input type="hidden" value="" id="maxCount" name="maxCount">
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view' ){ ?>
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