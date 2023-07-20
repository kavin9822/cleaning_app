<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <div class="box box-info">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-forward"></i> Customer Confirmation Form</h3>
        </div>
        
        <div class="box-body">            
                       
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="CustId" class="col-sm-2 control-label">Customer ID</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="CustId" id="CustId">
                                            <?php foreach ($customer_data as $cd_opt_key => $cd_opt_value): ?>
                                                <option  value="<?php echo $cd_opt_key; ?>" title="<?php echo $cd_opt_value; ?>"><?php echo $cd_opt_value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="FacId" class="col-sm-2 control-label">FAC ID</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="FacId" id="FacId" value="" placeholder="FAC ID" type="text">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="TowerAddress" class="col-sm-2 control-label">Tower Address</label>
                                    <div class="col-sm-10">
                                        <textarea id="TowerAddress" name="TowerAddress" class="form-control" rows="2" placeholder="Tower Address"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Circle" class="col-sm-2 control-label">Circle</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Circle" id="Circle" value="" placeholder="Circle" type="text">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="PoDate" class="col-sm-2 control-label">PO Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" name="PoDate" id="PoDate" value="" type="date">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="SoNo" class="col-sm-2 control-label">SO No.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="SoNo" id="SoNo" value="" placeholder="Subscription Order No." type="text">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="Mode" class="col-sm-2 control-label">Mode</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Mode" id="Mode" value="" placeholder="Mode" type="text">
                                    </div>
                                </div>                               
                                
                                </div><!-- /.left column -->

                                <div class="col-md-6">  
                                
                                <div class="form-group">
                                    <label for="WanIp" class="col-sm-2 control-label">WAN IP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="WanIp" id="WanIp" value="" placeholder="WAN IP" type="text">
                                    </div>
                                </div>    
                                
                                <div class="form-group">
                                    <label for="PortNo" class="col-sm-2 control-label">Port No.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="PortNo" id="PortNo" value="" placeholder="Port No." type="text">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="CustomerCAF" class="col-sm-3 control-label">Customer CAF</label>
                                    <div class="col-sm-3">                                        
                                        <select class="form-control" name="CustomerCAF" id="CustomerCAF">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                    <label for="IpJustification" class="col-sm-3 control-label">IP Justification</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="IpJustification" id="IpJustification">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>                                       
                                    </div>
                                </div> 
                                    
                                <div class="form-group">                                    
                                    <label for="Proof" class="col-sm-3 control-label">Proof</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="Proof" name="Proof">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div> 
                                    <label for="CustomerPo" class="col-sm-3 control-label">Customer PO</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="CustomerPo" name="CustomerPo">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="DeliveryAcceptanceYN" class="col-sm-5 control-label">Link Delivery Acceptance to Reliance</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="DeliveryAcceptanceYN" name="DeliveryAcceptanceYN">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </div>  
                                    
                                <div class="form-group">
                                    <label for="CircuitId" class="col-sm-5 control-label">SUB ID / Circuit ID</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" id="CircuitId" name="CircuitId" value="" placeholder="SUB ID / Circuit ID" type="text">
                                    </div>
                                </div>                                
                                
                                <div class="form-group">
                                    <label for="CustProofDetail" class="col-sm-5 control-label">Customer Firm Proof Detail (RC No./PAN No.)</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" name="CustProofDetail" id="CustProofDetail" value="" placeholder="RC No. / PAN No." type="text">
                                    </div>
                                </div>                                     
                                
                                </div><!-- /.right column -->
                            
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>LAN IP</th>
                                                <th>Fault / Request Ticket Raised</th>
                                                <th>Termination / Upgrade Ticket Raised</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_listing_table">

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
                                                            <input class="form-control" id="ItemNo_1" name="ItemNo_1" value="" placeholder="LAN IP" type="text">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>                                
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                           <input class="form-control" id="Note_1" name="Note_1" value="" placeholder="Fault / Request Ticket Raised" type="text">                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Rate_1" name="Rate_1" value="" placeholder="Termination / Upgrade Ticket Raised" type="text">
                                                        </div>
                                                    </div>
                                                </td>                                                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Qantity_1" name="Qantity_1" value="" placeholder="Remarks" type="text">                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control btn-primary" id="ADD" name="ADD" value="+"  type="button" onclick="addRow()">                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.col -->
                            </div><!-- /.row -->                            
                        </div> 
        
        
        <div class="row"> 
            <div class="col-lg-12">               
                <div class="table-responsive">
                    <table class="table table-striped table-responsive">
                        <tbody>                            
                            <tr>                        
                                <input type="hidden" value="" id="maxCount" name="maxCount">                               
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="box-footer">
            <div class="row no-print">
                <div class="col-xs-12">
                <a href="<?php echo $home.'/'.$module.'/'.$controller.'/'.$method; ?>" class="btn btn-md btn-info btn-flat pull-left">Show List</a>
                    <?php if(!empty($mode) && $mode == 'edit'): ?>
                    <button type ="submit" class="btn btn-success pull-right" onmouseover="subtotal()" onfocus="subtotal()" name="edit_submit_button" value="edit"><i class="fa fa-edit"></i> Edit </button>
                    <?php else: ?>
                    <button type ="submit" class="btn btn-success pull-right" onmouseover="subtotal()" onfocus="subtotal()" name="add_submit_button" value="add"><i class="fa fa-cube"></i> Submit </button>
                    <?php endif; ?>
                </div>
            </div>        
        </div>   
    </div>
</form>