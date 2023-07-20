<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . 'marketingsms'; ?>/submit/" method="post" enctype="multipart/form-data" onsubmit="return checkCheckBoxes(this);"> 
<div class="box box-info">    
            <div class="box-header with-border">
                <h3 class="box-title text-danger"><b><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>&ensp;Marketing SMS</b></h3>
            </div>         
            <!-- /.box-header -->
            <div class="box-body">
                
                <div class="row">
                <div class="col-md-8">                

                <div class="form-group">
                    <label for="EntityID" class="col-sm-3 control-label">Entity</label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-single" name="EntityID" id="EntityID" onmouseover="ycssel()" onchange="entitySel()" required>
                           <option value="" disabled selected style="display:none;">Select</option>
                           <option value="AllEntity" title="All Entity">All Entity</option>                        
                           <?php foreach ($entity_data as $ed_opt_key => $ed_opt_value): ?>
                                <option  value="<?php echo $ed_opt_key; ?>" title="<?php echo $ed_opt_value; ?>"><?php echo $ed_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>     
                
                <div class="form-group">
                    <label for="customer_type" class="col-sm-3 control-label">Customer Type</label>
                    <div class="col-sm-9">                        
                        <select class="form-control" name="customer_type" id="customer_type" onchange="statusSel('<?php echo $home;?>','customer_type')">
                               <option value="" disabled selected style="display:none;">Select</option> 
                               <?php foreach ($cust_type as $ctype_key => $ctype_value): ?>
                                   <option  value="<?php echo $ctype_key; ?>" title="<?php echo $ctype_value; ?>"><?php echo $ctype_value; ?></option>
                               <?php endforeach; ?>                    
                        </select>
                    </div>
                </div>   
                    
                <div class="form-group">
                    <label for="customer_status" class="col-sm-3 control-label">Customer Status</label>
                    <div class="col-sm-9">                        
                        <select class="form-control" name="customer_status" id="customer_status" >                      
                        </select>
                    </div>
                </div> 
                
                <div class="form-group">
                      <label for="message" class="col-sm-3 control-label">Message</label>
                      <div class="col-sm-9">
                      	   <textarea id="message" name="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                      </div>
		</div> 
		
		<div class="form-group">
                  <div class="col-sm-offset-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="confirm_send" name="confirm_send"> Confirm Send
                      </label>
                    </div>
                  </div>
                </div> 
                    
            </div><!-- /.left column -->
                
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="row no-print">
                    <div class="col-sm-8">                        
                            <button type ="submit" class="btn btn-success btn-flat pull-right"  name="req_from_list_view" value="smsData" onclick="checkSmsFields()">Send <i class="fa fa-paper-plane" aria-hidden="true"></i></button>                                                                                                          
                    </div>
                </div>
            </div>
            <!-- /.box-footer -->
          </div>
</form>