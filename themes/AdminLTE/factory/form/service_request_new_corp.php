<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
    <div class="box box-info">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a aria-expanded="true" href="#tab_1-1" data-toggle="tab">Service Entry</a></li>
                    <li class=""><a aria-expanded="false" href="#tab_2-2" data-toggle="tab">On Phone Service</a></li>
                    <li class="pull-left header"><i class="fa fa-wrench"></i> Service Request Form</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <div class="row invoice no-border">
                            <div class="col-md-6">
                                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                               <div class="form-group">                         
                                    <label for="customer_ID" class="col-sm-3 control-label">Customer Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" onmouseover="ycssel()" onchange="hidemyFormEleStat();
		                            $('#ApIp').val($('#customer_ID').find(':selected').data('apip'));
                                            $('#EquipmentIp').val($('#customer_ID').find(':selected').data('equipip'));">

                                            <?php foreach ($company_data as $cd_opt_value): ?>
                                            <?php 
                                                    if ($cd_opt_value['ID'] == $FmData['customer_ID']) {
                                                            $isselected = 'selected="selected"';
                                                    }else{
                                                            $isselected = '';
                                                    } ?>
                                            <option <?php echo $isselected; ?> value="<?php echo $cd_opt_value['ID']; ?>" 
						    data-apip= "<?php echo $cd_opt_value['ApIp']; ?>"
						    data-equipip= "<?php echo $cd_opt_value['EquipmentIp']; ?>" > 
					    <?php echo $cd_opt_value['ID']; ?><?php echo " | "; ?>
                                            <?php echo $cd_opt_value['CompanyName']; ?><?php echo " | "; ?></option>         
                                            <?php endforeach; ?>
                                        </select>  
                                    </div>
                                </div>    
                                
                                <div class="form-group">
                                    <label for="CallAttendEmpID" class="col-sm-3 control-label">Call Attend Employee</label>
                                    <div class="col-sm-9"> 
                                       <select class="form-control" name="CallAttendEmpID" id="CallAttendEmpID">
                                         <?php foreach ($employee_data as $emp_opt_key => $emp_opt_value): ?>
                                            <?php 
                                                    if ($emp_opt_key == $FmData['CallAttendEmpID']) {
                                                            $isselected = 'selected="selected"';
                                                    }else{
                                                            $isselected = '';
                                                    } ?>                                           
                                                <option <?php echo $isselected; ?> value="<?php echo $emp_opt_key; ?>" title="<?php echo $emp_opt_value; ?>"><?php echo $emp_opt_value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class="form-group">
                                    <label for="Complaint" class="col-sm-3 control-label">Complaint</label>
                                    <div class="col-sm-9">
                                        <textarea id="Complaint" name="Complaint" class="form-control" rows="2" placeholder="Complaint"><?php if($FmData['Complaint']){echo $FmData['Complaint'];}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SrDate" class="col-sm-3 control-label">Service Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" name="SrDate" id="SrDate" value="<?php if($FmData['SrDate']){echo $FmData['SrDate'];}else{echo date('Y-m-d');}?>" type="text">
                                    </div>
                                </div>                                
                     
                                <div class="form-group">	                                
                                    <label for="SrTime" class="col-sm-3 control-label">Service Time</label>  
                                    <div class="col-sm-9">                                   
                                   	 <div class="input-group bootstrap-timepicker timepicker"> 
                                        	<input class="form-control input-small" onmouseover="ycstime()" id="timepicker" name="SrTime"  placeholder="HH:MM" value="<?php if($FmData['SrTime']){echo $FmData['SrTime'];}?>" type="text" ></input>
                                    	 </div>
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="ServTechnicianEmpID" class="col-sm-3 control-label">Service Technician Employee</label>
                                    <div class="col-sm-9"> 
                                       <select class="form-control" name="ServTechnicianEmpID" id="ServTechnicianEmpID">
                                         <?php foreach ($employee_data as $emp_opt_key => $emp_opt_value): ?>
                                            <?php 
                                                    if ($emp_opt_key == $FmData['ServTechnicianEmpID']) {
                                                            $isselected = 'selected="selected"';
                                                    }else{
                                                            $isselected = '';
                                                    } ?>                                           
                                                <option <?php echo $isselected; ?> value="<?php echo $emp_opt_key; ?>" title="<?php echo $emp_opt_value; ?>"><?php echo $emp_opt_value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                        </div><!-- /.left-side -->  
                        
                        <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="CurrentStatus" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="CurrentStatus" id="CurrentStatus" onchange = "hideFormElemStat()">
                                        	<option <?php if($FmData['CurrentStatus'] === 'Open'){echo 'selected="selected"';}?> value="Open">Open</option>
                                                <option <?php if($FmData['CurrentStatus'] === 'Closed'){echo 'selected="selected"';}?> value="Closed">Closed</option>
                                               <option <?php if($FmData['CurrentStatus'] === 'InProgress'){echo 'selected="selected"';}?> value="InProgress">In Progress</option> 
                                        </select> 
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label for="SrCloseDate" class="col-sm-3 control-label">Service Close Date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" name="SrCloseDate" id="SrCloseDate" value="<?php if($FmData['SrCloseDate']){echo $FmData['SrCloseDate'];}else{echo date('Y-m-d');}?>" type="text">
                                    </div>
                                </div>                                
                          
                                <div class="form-group">	
                                    <label for="SrCloseTime" class="col-sm-3 control-label">Service Close Time</label>
                                      <div class="col-sm-9">     
                                         <div class="input-group bootstrap-timepicker timepicker">  
                                            <input class="form-control input-small" onmouseover="ycstime1()" name="SrCloseTime" id="timepicker1" placeholder="HH:MM"value="<?php if($FmData['SrCloseTime']){echo $FmData['SrCloseTime'];}?>" type="text">
                                         </div>
                                      </div>
                                </div>  
                                
                                <div class="form-group">
                                    <label for="Remark" class="col-sm-3 control-label">Remarks</label>
                                    <div class="col-sm-9">
                                        <textarea id="Remark" name="Remark" class="form-control" rows="2" placeholder="Remarks"><?php if($FmData['Remark']){echo $FmData['Remark'];}?></textarea>
                                    </div>
                                </div>                           
                                
                                   
                                   <div class="form-group">                             
                                    <label for="ApIp" class="col-sm-3 control-label">AP IP</label>
                                       <div class="col-sm-5">
                                         <input class="form-control" id="ApIp" name="ApIp" value="<?php if ($cd_opt_value['ID'] == $FmData['customer_ID']) 
{echo $cd_opt_value['ApIp'];}
 ?>" placeholder="AP IP" type="text">       
                                       </div>
                                       <div class="col-sm-4">
                                          <button  class="btn btn-primary" id="Ping" name="Ping" style="width:153.317px" type="button" onclick="pingIp('http://crm.spit.co.in','ApIp')"><i class="fa fa-wifi"></i><?php echo" "?>Ping AP IP</button>
                                       </div>  
                                   </div>
                                  
                                  <div class="form-group"> 
                                      <label for="EquipmentIp" class="col-sm-3 control-label">Equipment IP</label>
                                        <div class="col-sm-5">
                                          <input class="form-control" id="EquipmentIp" name="EquipmentIp" value="" placeholder="Equipment IP" type="text">
                                        </div>
                                       <div class="col-sm-4">
                                          <button  class="btn btn-primary" id="Ping" name="Ping" type="button" onclick="pingIp('http://crm.spit.co.in','EquipmentIp')"><i class="fa fa-wifi"></i><?php echo" "?>Ping Equipment IP</button>
                                       </div>
                                  </div>

                            </div><!-- /.column -->                            
                        </div>                     
                                                                
                    </div><!-- /.tab-pane -->
                    
                    <div class="tab-pane" id="tab_2-2">
                        <div class="row invoice no-border">
                            <div class="col-md-6">
                                <div class="box-header with-border">
                                        <h3 class="box-title">Network is used only for Internet</h3>                                                            
                                </div><br>
                                	<?php $lancon = (!empty($FmData['LanConnectedYN']) ? true : false);  ?>                                      
                                	                                                                                                                     
                                       
                                    <div class="form-group">                                      
                                        <label for="LanConnectedYN" class="col-sm-8 control-label">Check LAN Cable Connected?</label>
                                            <div class="col-sm-4">
                                                <input <?php if($lancon && $FmData['LanConnectedYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="LanConnectedYN" name="LanConnectedYN" value="Y" type="radio">Yes
                                                <input <?php if($lancon && $FmData['LanConnectedYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="LanConnectedYN" name="LanConnectedYN" value="N" type="radio">No
                                            </div>                                                
                                    </div>
                                    
                                    <div class="form-group">                                        
                                        <label for="AdopterOnYN" class="col-sm-8 control-label">Check Adopter was ON?</label>
                                            <div class="col-sm-4">
                                            
                                        <?php 
                                        $Adopter = false;
                                        if(!empty($FmData['AdopterOnYN'])){
                                           $Adopter = true;
                                        }
                                        ?>
                                        
                                                <input <?php if($Adopter && $FmData['AdopterOnYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="AdopterOnYN" name="AdopterOnYN" value="Y" type="radio">Yes
                                                <input <?php if($Adopter && $FmData['AdopterOnYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="AdopterOnYN" name="AdopterOnYN" value="N" type="radio">No
                                            </div>    
                                    </div>
                                                                    
                                    <div class="form-group">
                                        <label for="OperatingSystem" class="col-sm-8 control-label">Type of Operating System used</label>
                                        <div class="col-sm-4">
                                        
                                        <?php 
                                        $myOsSystem = false;
                                        if(!empty($FmData['OperatingSystem'])){
                                           $myOsSystem = true;
                                        }
                                        ?>
                                        
                                            <select class="form-control" name="OperatingSystem" id="OperatingSystem">
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'WindowsXP'){echo 'selected="selected"';}?> value="WindowsXP">Windows XP</option>
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Windows7'){echo 'selected="selected"';}?> value="Windows7">Windows 7</option>
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Windows8'){echo 'selected="selected"';}?> value="Windows8">Windows 8</option>
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Windows10'){echo 'selected="selected"';}?> value="Windows10">Windows 10</option>
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Mac'){echo 'selected="selected"';}?> value="Mac">Mac</option>
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Linux'){echo 'selected="selected"';}?> value="Linux">Linux</option>                                             
                                                <option <?php if($myOsSystem && $FmData['OperatingSystem'] === 'Ubuntu'){echo 'selected="selected"';}?> value="Ubuntu">Ubuntu</option>                                                
                                            </select>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label for="NetworkConnection" class="col-sm-8 control-label">Networking symbol in monitor showing</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="NetworkConnection" id="NetworkConnection">
                                                <option <?php if(!empty($FmData['NetworkConnection']) && $FmData['NetworkConnection'] === 'Connected'){echo 'selected="selected"';}?> value="Connected">Connected</option>
                                                <option <?php if(!empty($FmData['NetworkConnection']) && $FmData['NetworkConnection'] === 'Limited'){echo 'selected="selected"';}?> value="Limited">Limited</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="PingRouterTestYN" class="col-sm-8 control-label">
                                         connection via Router - Ping Test Router IP / LAN IP(Gateway). Ping Result Successful?</label>
                                                        <div class="col-sm-4">
                                                            <input <?php if(!empty($FmData['PingRouterTestYN']) && $FmData['PingRouterTestYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="PingRouterTestYN" name="PingRouterTestYN" value="Y" type="radio">Yes
                                                            <input <?php if(!empty($FmData['PingRouterTestYN']) && $FmData['PingRouterTestYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="PingRouterTestYN" name="PingRouterTestYN" value="N" type="radio">No
                                                        </div>                                     
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="PingLanTestYN" class="col-sm-8 control-label">If connection via LAN Cable - Ping Test only LAN IP(Gateway). Ping Result Successful?</label>
                                                        <div class="col-sm-4">
                                                            <input <?php if(!empty($FmData['PingLanTestYN']) && $FmData['PingLanTestYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="PingLanTestYN" name="PingLanTestYN" value="Y" type="radio">Yes
                                                            <input <?php if(!empty($FmData['PingLanTestYN']) && $FmData['PingLanTestYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="PingLanTestYN" name="PingLanTestYN" value="N" type="radio">No
                                                        </div>                                     
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="DeviceOnYN" class="col-sm-8 control-label">Kindly check whether device ON / OFF?</label>
                                                        <div class="col-sm-4">
                                                            <input <?php if(!empty($FmData['DeviceOnYN']) && $FmData['DeviceOnYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="DeviceOnYN" name="DeviceOnYN" value="Y" type="radio">Yes
                                                            <input <?php if(!empty($FmData['DeviceOnYN']) && $FmData['DeviceOnYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="DeviceOnYN" name="DeviceOnYN" value="N" type="radio">No
                                                        </div>                                     
                                    </div>
                                    
                                    <div class="">
                                        <label class="col-sm-12 "><i class="fa fa-circle-o text-red"></i>&nbsp;&nbsp;If OFF, check the cable damage?</label>
                                        <label class="col-sm-12 "><i class="fa fa-circle-o text-red"></i>&nbsp;&nbsp;If ON, check LAN light is blinking / Not. In router check WAN port light & LAN port light is blinking / Not.</label> 
                                    </div>
                            
                            </div>

                            <div class="col-md-6">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Network is used for CCTV</h3>                                                            
                                    </div><br>
                                
                                    <div class="form-group">
                                        <label for="LanWireConnectedYN" class="col-sm-8 control-label">LAN wire connected OR / NOT?</label>
                                            <div class="col-sm-4">
                                                <input <?php if(!empty($FmData['LanWireConnectedYN']) && $FmData['LanWireConnectedYN'] === 'Y'){echo 'checked';}?> style="width: 30px;" id="LanWireConnectedYN" name="LanWireConnectedYN" value="Y" type="radio">Yes
                                                <input <?php if(!empty($FmData['LanWireConnectedYN']) && $FmData['LanWireConnectedYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="LanWireConnectedYN" name="LanWireConnectedYN" value="N" type="radio">No
                                            </div>                                     
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="WifyRouterYN" class="col-sm-8 control-label">WiFi Router Available?</label>
                                            <div class="col-sm-4">
                                                <input <?php if(!empty($FmData['WifyRouterYN']) && $FmData['WifyRouterYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="WifyRouterYN" name="WifyRouterYN" value="Y" type="radio">Yes
                                                <input <?php if(!empty($FmData['WifyRouterYN']) && $FmData['WifyRouterYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="WifyRouterYN" name="WifyRouterYN" value="N" type="radio">No
                                            </div>                                     
                                    </div>
                                    
                                    <div class="">
                                        <label class="col-sm-12"><i class="fa fa-circle-o text-red"></i>&nbsp;&nbsp;Router available means check WAN / LAN light (ON / OFF)</label>
                                        <label class="col-sm-12"><i class="fa fa-circle-o text-red"></i>&nbsp;&nbsp;If Router is not available ,kindly check LAN light (ON / OFF)? If OFF means, Service Call Book</label> 
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="PortCheckReachedYN" class="col-sm-8 control-label">Port Forward Checking in device Reach?</label>
                                            <div class="col-sm-4">
                                                <input <?php if(!empty($FmData['PortCheckReachedYN']) && $FmData['PortCheckReachedYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="PortCheckReachedYN" name="PortCheckReachedYN" value="Y" type="radio">Yes
                                                <input <?php if(!empty($FmData['PortCheckReachedYN']) && $FmData['PortCheckReachedYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="PortCheckReachedYN" name="PortCheckReachedYN" value="N" type="radio">No
                                            </div>                                     
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="WifyMobileCheckYN" class="col-sm-8 control-label">Also Check WiFi in Mobile, it is connecting?</label>
                                            <div class="col-sm-4">
                                                <input <?php if(!empty($FmData['WifyMobileCheckYN']) && $FmData['WifyMobileCheckYN'] === 'Y'){echo 'checked';}?> style="width: 30px;"  id="WifyMobileCheckYN" name="WifyMobileCheckYN" value="Y" type="radio">Yes
                                                <input <?php if(!empty($FmData['WifyMobileCheckYN']) && $FmData['WifyMobileCheckYN'] === 'N'){echo 'checked';}?> style="width: 30px;" id="WifyMobileCheckYN" name="WifyMobileCheckYN" value="N" type="radio">No
                                            </div>                                     
                                    </div>
                                               
                            </div>
                        </div><!-- /.row -->    
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">

            <div class="row no-print">
                <div class="col-xs-12">
                <a href="<?php echo $home.'/'.$module.'/'.$controller.'/'.$method; ?>" class="btn btn-md btn-info btn-flat pull-left">Show List</a>
                    <?php if(!empty($mode) && $mode == 'edit'): ?>
                    <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit"><i class="fa fa-edit"></i> Edit </button>
                    <?php else: ?>
                    <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"><i class="fa fa-cube"></i> Submit </button>
                    <?php endif; ?>
                </div>
            </div>        
        </div>
    </div>
</form>