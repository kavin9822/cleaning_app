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
    <?php if(isset($FmData) == null){$FmData=$SOPMaster_data; }  ?>
        <div class="row">
            
             <div class="col-md-6">
                        
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Part No</label>
                    <div class="col-sm-9">
                    <!--js-example-basic-single-->
                    <!--<input type="hidden" id="productID" name="productID" value="<?php echo $FmData[0]['product_ID'] ?>">-->
                       
                       <?php if($mode=='view'){?>
                       
                       <select class="form-control js-example-basic-single" name="product_ID" id="pdtid"  onmouseover="ycssel()" disabled onchange="sopoutput(this.value),sopproductid(this.value);" <?php if($mode=='edit'){ echo "disabled=\"disabled\""; }else{}?> >
                     
                       <?php  } else {?>
                       
                       <select class="form-control js-example-basic-single" name="product_ID" id="pdtid"  onmouseover="ycssel()" required onchange="sopoutput(this.value),sopproductid(this.value);" <?php if($mode=='edit'){ echo "disabled=\"disabled\""; }else{}?> >
                     
                       <?php } ?>
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
                         <?php echo isset($FmData[0]['product_ID']) && ($FmData[0]['product_ID']!='') ? '<input id="product_ID" name="product_ID" value='.$FmData[0]["product_ID"].'  type="hidden">' : ''; ?>

                         
                    </div>
                </div>

            </div><!-- /.left column -->  
               
                  <div class="col-md-6">
                        
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Output per minute</label>
                    <div class="col-sm-9">
                    <!--js-example-basic-single-->
                    <input type="text" id="outputpermin" class="form-control" name="outputpermin" value="<?php echo $FmData[0]['outputpermin'] ?>" readonly >
                       
                    </div>
                </div>

            </div>
        </div>
         
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                             
                            <th>Parameter</th>
                            <th>GroupName</th>
                            <th>UOM</th>
                            <th>Spec(+-)</th>
                            <th>Value</th>
                            
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
                                                            <input class="form-control" type="text" id="ItemNo_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ParameterName']; ?>" placeholder="Parameter" disabled > 
                                                             <input class="form-control" type="hidden" id="ItemName_<?php echo $tii; ?>" name="ItemName_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['ID']; ?>"  > 
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="GroupName_<?php echo $tii; ?>" name="GroupName_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['GroupName']; ?>" placeholder="GroupName" disabled > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Unit_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['UnitName']; ?>" placeholder="Parameter" disabled > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                 <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Spec_<?php echo $tii; ?>" name="ItemNo_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['Spec']; ?>" placeholder="Parameter" disabled > 
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                
                                               
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" type="text" id="Water_<?php echo $tii; ?>" name="Water_<?php echo $tii; ?>" value="<?php echo $FmData[$tii-1]['SOPvalue']; ?>" placeholder="Value" > 
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
                                        <input class="form-control" type="text" id="Water_1" name="Water_1" value="" placeholder="Available. Qty" > 
                                    </div>
                                </div>
                            </td>
                            
                            <td>   
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="ItemName_1" name="ItemName_1" value="" placeholder="Quantity" required onkeyup="validateField(this.id,'number');validateSeedCount(this.id,'Water','QtyReqforfrmr')"> 
                                    </div>
                                </div>
                            </td>

                           
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->
<input type="hidden" value=<?php echo $tii; ?> id="maxCount" name="maxCount">
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()"> Submit </button>
                <?php } else if($mode == 'add') { ?>
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