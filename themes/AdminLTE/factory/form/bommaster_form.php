<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

    <?php  

    if($mode == 'edit' or $mode == 'view')
    { ?>

        <script>
        // console.log('data is coming while editing');
        
function myfunction(a , b)
{
var quantity = document.getElementById('table').rows.length;
var RowCount = Number(quantity) - 1;

console.log(RowCount);
var totalQuantity = 0;
for (var i = 1 ; i <= RowCount; i++)
{
    var Quantity = document.getElementById('Quantity_'+i).value;
    var totalQuantity = Number(totalQuantity) + Number(Quantity);
}
console.log(totalQuantity);
document.getElementById('totalQuantity').value = totalQuantity ;
document.getElementById('maxCount').value = RowCount;


}

if(window.addEventListener)
     {
         window.addEventListener('load', myfunction) 
    
    }
    else
    { 
        window.attachEvent('onload', myfunction)
    }
        </script>
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
      

        <div class="row">
            <div class="col-md-6">
                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
            <div class="form-group">
            <label  class="col-sm-3 control-label">Part Name</label>
             <div class="col-sm-9">
            
            <?php if($mode=='view'){?>
          
            <select class="form-control js-example-basic-single" name="Producttype_ID" id="Producttype_ID" onchange="Prodfilter('<?php echo $home; ?>',this.value,'product_ID')" disabled onmouseover="ycssel()">
           
            <?php } else{?>
            
            <select class="form-control js-example-basic-single" name="Producttype_ID" id="Producttype_ID" onchange="Prodfilter('<?php echo $home; ?>',this.value,'product_ID')" required onmouseover="ycssel()">
        
            <?php } ?>
            
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($pdttype_data as $k => $v): 
                    if ($v['ProductType'] == $FmData[0]['ProductType']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                     
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ProductType']; ?>"><?php echo $v['ProductType']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
            
         	<div class="form-group">
            <label class="col-sm-3 control-label">Mould </label>
            <div class="col-sm-9">
            <select class="form-control" name="mould_ID" id="mould_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($mould_data as $k => $v): 
                    if ($v['MouldName'] == $FmData[0]['MouldName']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MouldName']; ?>"><?php echo $v['MouldName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
            
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Mould Quantity</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MouldQty" name="MouldQty" value="<?php echo $FmData[0]['MouldQty'];?>" type="text" onkeypress="return onlyNumberKey(event);">
                    </div>
                </div>
         
                </div>
                
                
         <div class="col-md-6">  
         <div class="form-group">
            <label  class="col-sm-3 control-label">Part No</label>
             <div class="col-sm-9">
            <select class="form-control" name="product_ID" id="product_ID" required>
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($pdt_data as $k => $v): 
                    if ($v['ItemName'] == $FmData[0]['ItemName']) {
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
            <label  class="col-sm-3 control-label">Customer</label>
             <div class="col-sm-9">
                 
            <?php if($mode=='view'){?>
            
            <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onmouseover="ycssel()"  disabled>
            
            <?php } else { ?>
            
             <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onmouseover="ycssel()"  required>
             
             <?php } ?>   
             
            <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($customer_data as $k => $v): 
                    if ($v['FirstName'] == $FmData[0]['FirstName']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['FirstName']; ?>"><?php echo $v['FirstName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
            
            <div class="form-group">
                    <label  class="col-sm-3 control-label">Machine</label>
                     <div class="col-sm-9">
                <select class="form-control" name="machine_ID" id="machine_ID" required>
                <option value="" disabled selected style="display:none;">Select</option>
                    <?php foreach ($machine_data as $k => $v): 
                    if ($v['MachineName'] == $FmData[0]['MachineName']) {
                        $isselected = 'selected="selected"';
                    }else{
                        $isselected = '';
                         }
                    ?>
            <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['MachineName']; ?>"><?php echo $v['MachineName']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
            </div>
                    
             </div>
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
                            <th>RawMaterial </th>
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
                                 <input class="form-control btn-danger" id="REM_<?php echo $tii; ?>" name="REM_<?php echo $tii; ?>" value="-"  type="button" onclick="$('#Invoice_data_entry_<?php echo $tii; ?>').remove(); bom(this.id)">
                                 </div>
                                 </div>
                                 </td>
                                  <td>                                      
                                     <div class="form-group">
                                                       <div class="col-sm-12">
                                                        
                                                         <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>"  onchange="uom(this.value,this.id)" >
                                                           <option value="" disabled selected style="display:none;">Select</option>
                                                             <?php foreach ($rawmaterial_data as $k => $v): 
                                                                    if ($v['RMName'] == $dataValue['RMName']) {
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
                                        <input class="form-control" type="text" id="Quantity_<?php echo $tii; ?>" name="Quantity_<?php echo $tii; ?>" value="<?php if($dataValue['Qty']){ echo $dataValue['Qty']; } ?>" placeholder="Quantity" onkeyup="bom(this.id)" onkeypress="return onlyNumberKey(event);" required>
                                    </div>
         	                </div>
                            </td>
                                             
                            <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_<?php echo $tii; ?>" name="Amount_<?php echo $tii; ?>" value="<?php if($dataValue['UnitName']){ echo $dataValue['UnitName']; } ?>" placeholder="Unit Of Measure" readonly>
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
                                        <input class="form-control btn-danger" id="REM_1" name="REM_1" value="-" onkeyup="bom(this.id)"  type="button">
                                    </div>
                                </div>
                            </td>
                            
                              <td>                                      
                                <div class="form-group">
                                    <div class="col-sm-12">
                                         <!--<input type="hidden"  class="form-control" name="ItemNo_1" id="ItemNo_1" value="">-->
                                         <select class="form-control" name="ItemNo_1" id="ItemNo_1" required onchange="uom(this.value,this.id);" >
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
                                        <input class="form-control" type="text" id="Quantity_1" name="Quantity_1" value="" placeholder="Quantity" onkeyup="bom(this.id);" onkeypress="return onlyNumberKey(event);" required>
                                         
                                    </div>
         	                </div>
                            </td>
                            <td>
                             <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" id="Amount_1" name="Amount_1" value="" placeholder="Unit Of Measure" readonly>
                                         
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
<input type="hidden" value="1"  id="maxCount"  name="maxCount">     
 
 <div class="row">
<div class="col-md-6">
<div  class="col-sm-3">
<label for="totalQuantity"> Total Quantity : </label>
</div>
<div class="col-sm-9">
<input class="form-control "  type="text" value="" id="totalQuantity" name="totalQuantity" readonly>
</div>
</div>
</div>
<br/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <?php if($mode != 'view'){ ?>
                <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
                <?php } ?>
                <?php if($mode == 'edit'){ ?>
                <button type ="text" class="btn btn-success pull-right" name="edit_submit_button" value="edit" onmouseover="getCount()" onfocus="getCount()" > Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add" onmouseover="getCount()" onfocus="getCount()" onsubmit=alert('Quantity should entered)')> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>

</section>
            
            
            