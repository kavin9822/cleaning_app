<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">                    
                    <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;
                    <?php echo $page_title; ?>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->


        <div class="row">
            <div class="col-md-12">   
                <div class="form-group">
                    <label for="Entity_ID" class="col-sm-2 control-label">Select Entity</label>
                    <div class="col-sm-4">
                        
                        <select class="form-control js-example-basic-single" name="Entity_ID" id="Entity_ID" onmouseover="ycssel()">
                            <?php foreach ($entity_data as $ed_opt_key => $ed_opt_value): ?>
                                <option  value="<?php echo $ed_opt_key; ?>" title="<?php echo $ed_opt_value; ?>"><?php echo $ed_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Entity_ID" class="col-sm-2 control-label">Choose Form</label>
                    <div class="col-sm-4">                        
                        <select class="form-control" name="FormID" id="FormID">                            
                                <option  value="1CSL" title="Customer List">Customer List</option>
                                <option  value="2SUR" title="Smartguard User Registration">Smartguard User Registration</option>
                                <option  value="3SCUP" title="Smartguard Change User Package">Smartguard Change User Package</option>
                                <option  value="4RER" title="Renewal Report">Renewal Report</option>
                                <option  value="6PLN" title="Plan">Entity Plan Creation</option>
                                <option  value="5PAC" title="Package">Entity Package Creation</option>                                
                        </select>
                    </div>
                </div>   
            </div><!-- /.left column -->
            
            <div class="col-md-6">
            <button type ="submit" name = "entity_submit" value="submit" onclick="toggle()" class="btn btn-success pull-right"><i class="fa fa-sign-in" aria-hidden="true"></i>  Submit</button>
            </div>
            
            

        </div><!-- /.left column -->
       
        
        
    </form>

</section>