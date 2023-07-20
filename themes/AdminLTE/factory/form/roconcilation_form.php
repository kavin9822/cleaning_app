<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Company Logo" style="width:12%"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
         <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="BatchNo" class="col-sm-3 control-label">Batch No.</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="BatchNo" id="BatchNo" onchange="getbatchDetails(this.value)" onmouseover="ycssel()">
                            <option value="" disabled selected style="display:none;">Select</option>
                             <?php foreach ($wo_data as $key => $value): ?>
                             <option  value="<?php echo $value['ID']; ?>"  title="<?php echo $value['BatchNo']; ?>" ><?php echo $value['BatchNo']; ?></option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="MachineName" class="col-sm-3 control-label">Line</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="MachineName" name="MachineName" value="" placeholder="MachineName" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
              
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="CustomerName" class="col-sm-3 control-label">Customer Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="CustomerName" name="CustomerName" value="" placeholder="Customer Name" type="text" readonly>
                    </div>
                </div>
                
            </div><!-- /.left column -->
        </div>
        
                <div class="row">
          
            <!--<div class="col-md-4">                 -->

            <!--    <div class="form-group">-->
            <!--        <label for="Shift" class="col-sm-3 control-label">Shift</label>-->
            <!--        <div class="col-sm-9">-->
            <!--            <select class="form-control" name="Shift" id="Shift" >-->
            <!--                <option value="ALL"  selected >ALL</option>-->
            <!--                <?php foreach ($shift_data as $key => $value): ?>-->
            <!--                 <option   value="<?php echo $value['ID']; ?>"  title="<?php echo $value['ShiftName']; ?>" ><?php echo $value['ShiftName']; ?></option>-->
            <!--                <?php endforeach; ?>-->
            <!--            </select>-->
            <!--        </div>-->
            <!--    </div>-->
                
            <!--</div><!-- /.left column -->
              
               <div class="col-md-4">
                <div class="form-group">
                    <label for="PartName" class="col-sm-3 control-label">Part Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PartName" name="PartName" value="" placeholder="Part  Name" type="text" readonly> 
                        
                        <input class="form-control" id="ProductID" name="ProductID" value="" placeholder="Part  Name" type="hidden" readonly> 
                    </div>
                </div> 
            </div><!-- /.left column -->

            
            <div class="col-md-4">                 

                <div class="form-group">
                    <label for="PartNo" class="col-sm-3 control-label">Part No.</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="PartNo" name="PartNo" value="" placeholder="Part  Name" type="text" readonly>  
                    </div>
                </div>
                
            </div><!-- /.left column -->
           
        </div>
        <h5>Raw Material</h5>
        <div id="showData"></div>
        
    </form>

</section>
