<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
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
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
         	    <div class="form-group">
                <label class="col-sm-3 control-label">Product Name</label>
                <div class="col-sm-9">
				     <?php if($mode=='add'){?>
				     <?php if(isset($FmData[0]['product_ID'])) { ?>
                     <input id="product_ID" name="product_ID" value="<?php if($FmData[0]['product_ID']){echo $FmData[0]['product_ID'];}?>"  type="hidden">
                     <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" disabled>
                     <?php }else { ?>
                    <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" onmouseover="ycssel()" required >
					<?php } ?>
                    <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($pdt_data as $k => $v): 
                            if ($v['ID'] == $FmData[0]['product_ID']) {
                                $isselected = 'selected="selected"';
                            }else{
                                $isselected = '';
                                 }
                            ?>
                    <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                    <?php endforeach; ?>
                    </select>
					 <?php }else{ ?>
					 <?php if(isset($FmData[0]['product_ID'])) { ?>
                     <input id="product_ID" name="product_ID" value="<?php if($FmData[0]['product_ID']){echo $FmData[0]['product_ID'];}?>"  type="hidden">
                     <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" disabled>
                     <?php }else { ?>
                    <select class="form-control js-example-basic-single" name="product_ID" id="product_ID" onmouseover="ycssel()" required onchange="Multi_sqlbasedjoinselect(this.value,'[id^=ItemName_]','ProcessDetail','ProcessMaster','Process','ProcessMaster_ID','Product_ID','ProcessMaster');">
					<?php } ?>
                    <option value="" disabled selected style="display:none;">Select</option>
                            <?php foreach ($pdt1_data as $k => $v): 
                            if ($v['ID'] == $FmData[0]['product_ID']) {
                                $isselected = 'selected="selected"';
                            }else{
                                $isselected = '';
                                 }
                            ?>
                    <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductName']; ?>"><?php echo $v['ProductName']; ?></option>
                    <?php endforeach; ?>
                    </select>
					 <?php }?>
                </div>
            </div>
            </div>
            <div class="col-md-3"></div>
        </div>
      
        
<!-- /.header part  -->
        <br/>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Process</th>
                            <th>Raw Material</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            </tr>
                    </thead>
                    <tbody id="invoice_listing_table">
                        <?php 
                            if(is_array($FmData) && count($FmData) >= 1)  :
                            $tii = 1;
                            foreach ($FmData as $dataValue):
                            
                        ?>
                                             
                        <tr id="Invoice_data_entry_<?php echo $tii; ?>">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" <?php if($tii>1) echo "onclick=$('#Invoice_data_entry_$tii').remove()";?> >
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">  
                                        <select class="form-control" name="ItemName_<?php echo $tii; ?>" id="ItemName_<?php echo $tii; ?>" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($process_data as $k => $v):
                                                    if ($v['ID'] == $dataValue['process_ID']) {
                                                        $isselected = 'selected="selected"';
                                                    }else{
                                                        $isselected = '';
                                                    }
                                            ?>
                                                
                                            <option <?php echo $isselected; ?>  value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProcessName']; ?>"><?php echo $v['ProcessName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
     	                        </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="rawmaterial_<?php echo $tii; ?>" id="rawmaterial_<?php echo $tii; ?>" required onchange="SqlbasedSelectdetail(this.value,this.id,'unit_','unit','rawmaterial','UnitName','unit_ID','rawmaterial');validateExist(this.id,'invoice_listing_table')">
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
                                        <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php echo $dataValue['Quantity']; ?>" onkeypress="return numbervalidation(this,this.id)" required>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="unit_<?php echo $tii; ?>" id="unit_<?php echo $tii; ?>" required >
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
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-"   type="button">
                                    </div>
                                </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="ItemName_1" id="ItemName_1" required>
                                            <option value="" disabled selected style="display:none;">Select</option>
                                            <?php foreach ($process_data as $k => $v): ?>
                                                <option  value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProcessName']; ?>"><?php echo $v['ProcessName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="rawmaterial_1" id="rawmaterial_1" required onchange="SqlbasedSelectdetail(this.value,this.id,'unit_','unit','rawmaterial','UnitName','unit_ID','rawmaterial');validateExist(this.id,'invoice_listing_table')">
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
                                        <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" required onkeypress="return numbervalidation(this,this.id)">
                                    </div>
         	                    </div>
                            </td>
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control" name="unit_1" id="unit_1" required >
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
<input type="hidden" value=""  id="maxCount"  name="maxCount">     
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount('')" onfocus="getCount('')" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount('')" onfocus="getCount('')" > Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
            
            
            