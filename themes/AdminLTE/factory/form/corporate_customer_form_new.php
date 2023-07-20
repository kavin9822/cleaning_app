<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" enctype="multipart/form-data">  
    <div class="box box-info">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a aria-expanded="true" href="#tab_1-1" data-toggle="tab">Customer Form</a></li>
                    <li class=""><a aria-expanded="false" href="#tab_2-2" data-toggle="tab">Subscriber Application Form</a></li>
                    <li class=""><a aria-expanded="false" href="#tab_3-2" data-toggle="tab">Customer Contact Details</a></li>
                    <li class=""><a aria-expanded="false" href="#tab_3-3" data-toggle="tab">Payment Details</a></li>
                    <li class=""><a aria-expanded="false" href="#tab_3-4" data-toggle="tab">Products</a></li>
                    <li class="pull-left header"><i class="fa fa-university"></i>Corporate Customer Form</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <div class="row invoice no-border">
                            <div class="col-md-6">
                                <input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                                <div class="form-group">
                                    <label for="CompanyName" class="col-sm-2 control-label">Company Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="CompanyName" name="CompanyName" value="<?php if($FmData['CompanyName']){echo $FmData['CompanyName'];}?>" placeholder="Company Name" type="text">
                                    </div>
                                </div>
                              <div class="form-group">                            
                                    <label for="FirstName" class="col-sm-2 control-label">FirstName</label>
                                       <div class="col-sm-4">
                                         <input class="form-control" id="FirstName" name="FirstName" value="<?php if($FmData['FirstName']){echo $FmData['FirstName'];}?>" placeholder="First Name" type="text">
                                       </div>  
                              
                                      <label for="LastName" class="col-sm-2 control-label">LastName</label>
                                        <div class="col-sm-4">
                                          <input class="form-control" id="LastName" name="LastName" value="<?php if($FmData['LastName']){echo $FmData['LastName'];}?>" placeholder="Last Name" type="text">
                                        </div>
                         
                             </div>
                                

                                <div class="form-group">
                                    <label for="Address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea id="Address" name="Address" class="form-control" rows="3" placeholder="Billing Address"><?php if($FmData['Address']){echo $FmData['Address'];}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="City" class="col-sm-2 control-label">City</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="City" id="City" value="<?php if($FmData['City']){echo $FmData['City'];}?>" placeholder="City" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pincode" class="col-sm-2 control-label">Pin Code</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Pincode" id="Pincode" value="<?php if($FmData['Pincode']){echo $FmData['Pincode'];}?>" placeholder="Pincode" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="State" class="col-sm-2 control-label">State</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="State" id="State" value="<?php if($FmData['State']){echo $FmData['State'];}?>" placeholder="State" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Country" class="col-sm-2 control-label">Country</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Country" id="Country" value="<?php if($FmData['Country']){echo $FmData['Country'];}?>" placeholder="Country" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Service Address is same as Address" class="col-sm-6 control-label">Service Address is same as Address</label>
                                    <div class="col-sm-2">
                                        <input id="same_address" name="same_address" value="<?php if($FmData['same_address']){echo $FmData['same_address'];}?>" onclick="sameAddress()" type="checkbox">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SAddress" class="col-sm-2 control-label">SAddress</label>
                                    <div class="col-sm-10">
                                        <textarea id="SAddress" name="SAddress" class="form-control" rows="3" placeholder="Service Address"><?php if($FmData['SAddress']){echo $FmData['SAddress'];}?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SCity" class="col-sm-2 control-label">City</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="SCity" id="SCity" value="<?php if($FmData['SCity']){echo $FmData['SCity'];}?>" placeholder="City" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SPincode" class="col-sm-2 control-label">Pin Code</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="SPincode" id="SPincode" value="<?php if($FmData['SPincode']){echo $FmData['SPincode'];}?>" placeholder="Pin Code" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SState" class="col-sm-2 control-label">State</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="SState" id="SState" value="<?php if($FmData['SState']){echo $FmData['SState'];}?>" placeholder="State" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SCountry" class="col-sm-2 control-label">Country</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="SCountry" id="SCountry" value="<?php if($FmData['SCountry']){echo $FmData['SCountry'];}?>" placeholder="Country" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="PhoneNo" class="col-sm-2 control-label">Phone No</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="PhoneNo" id="PhoneNo" value="<?php if($FmData['PhoneNo']){echo $FmData['PhoneNo'];}?>" placeholder="Phone No." type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="MobileNo" class="col-sm-2 control-label">Mobile No</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="MobileNo" id="MobileNo" value="<?php if($FmData['MobileNo']){echo $FmData['MobileNo'];}?>" placeholder="Mobile No." type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="Email" id="Email" value="<?php if($FmData['Email']){echo $FmData['Email'];}?>" placeholder="Email" type="text">
                                    </div>
                                </div>                

                                <div class="form-group">
                                    <label for="PaymentTerms" class="col-sm-2 control-label">Payment Terms</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="PaymentTerms" id="PaymentTerms">
                                            <option <?php if($FmData['PaymentTerms'] === 'Prepaid' ){echo 'selected="selected"';}?> value="Prepaid">Prepaid</option>
                                            <option <?php if($FmData['PaymentTerms'] === 'Prepaid' ){echo 'selected="selected"';}?> value="Postpaid">Postpaid</option>
                                        </select>
                                    </div>
                                </div> 

                            </div><!-- /.left column -->

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="PackageType" class="col-sm-2 control-label">Package Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="PackageType" name="PackageType" value="<?php if($FmData['PackageType']){echo $FmData['PackageType'];}?>" placeholder="Package Type" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Amount" class="col-sm-2 control-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="Amount" name="Amount" value="<?php if($FmData['Amount']){echo $FmData['Amount'];}?>" placeholder="Amount" type="text">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="Location" class="col-sm-2 control-label">AP Location</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="Location" name="Location" value="<?php if($FmData['Location']){echo $FmData['Location'];}?>" placeholder="Location" type="text">
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <label for="ApIp" class="col-sm-2 control-label">AP IP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="ApIp" name="ApIp" value="<?php if($FmData['ApIp']){echo $FmData['ApIp'];}?>" placeholder="AP IP" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ApSSID" class="col-sm-2 control-label">AP SSID</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="ApSSID" name="ApSSID" value="<?php if($FmData['ApSSID']){echo $FmData['ApSSID'];}?>" placeholder="Ap SSID" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="EquipmentMac" class="col-sm-2 control-label">Client Equipment MAC</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="EquipmentMac" name="EquipmentMac" value="<?php if($FmData['EquipmentMac']){echo $FmData['EquipmentMac'];}?>" placeholder="Client Equipment MAC" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="EquipmentName" class="col-sm-2 control-label">Client Equipment Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="EquipmentName" name="EquipmentName" value="<?php if($FmData['EquipmentName']){echo $FmData['EquipmentName'];}?>" placeholder="Client Equipment Name" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="EquipmentIp" class="col-sm-2 control-label">Client Equipment IP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="EquipmentIp" name="EquipmentIp" value="<?php if($FmData['EquipmentIp']){echo $FmData['EquipmentIp'];}?>" placeholder="Client Equipment IP" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Reference" class="col-sm-2 control-label">Reference</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="Reference" name="Reference" value="<?php if($FmData['Reference']){echo $FmData['Reference'];}?>" placeholder="Reference" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="PhotoUpload" class="col-sm-2 control-label">Upload Photo</label>
                                    <div class="col-sm-10">
                                    <?php if($FmData['PhotoUpload']):?>
        				<img class="img-thumbnail" src="<?php echo $home.'/'.$FmData['PhotoUpload']; ?>" alt="Upload the file here" width="200px">
				        <br><br>
				    <?php endif; ?>
                                        <input class="btn btn-default" id="PhotoUpload" name="PhotoUpload" placeholder="Upload Photo" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="IdProof" class="col-sm-2 control-label">ID Proof</label>
                                    <div class="col-sm-10">
                                    <?php if($FmData['IdProof']):?>
        				<img class="img-thumbnail" src="<?php echo $home.'/'.$FmData['IdProof']; ?>" alt="Upload the file here" width="200px">
				        <br><br>
				    <?php endif; ?>
                                        <input class="btn btn-default" id="IdProof" name="IdProof" placeholder="ID Proof" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="AddressProof" class="col-sm-2 control-label">Address Proof</label>
                                    <div class="col-sm-10">
                                    
                                    <?php if($FmData['AddressProof']):?>
        				<img class="img-thumbnail" src="<?php echo $home.'/'.$FmData['AddressProof']; ?>" alt="Upload the file here" width="200px">
				        <br><br>
				    <?php endif; ?>
                                        <input class="btn btn-default" id="AddressProof" name="AddressProof" placeholder="Address Proof" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="OtherProof" class="col-sm-2 control-label">Upload Others</label>
                                    <div class="col-sm-10">
                                    
                                    <?php if($FmData['OtherProof']):?>
        				<img class="img-thumbnail" src="<?php echo $home.'/'.$FmData['OtherProof']; ?>" alt="Upload the file here" width="200px">
				        <br><br>
				    <?php endif; ?>
                                        <input class="btn btn-default" id="OtherProof" name="OtherProof" placeholder="Upload Others" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="CafUpload" class="col-sm-2 control-label">Upload CAF</label>
                                    <div class="col-sm-10">
                                    
                                    <?php if($FmData['CafUpload']):?>
        				<img class="img-thumbnail" src="<?php echo $home.'/'.$FmData['CafUpload']; ?>" alt="Upload the file here" width="200px">
				        <br><br>
				    <?php endif; ?>
                                        <input class="btn btn-default" id="CafUpload" name="CafUpload" placeholder="Upload CAF" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="CustStatus" class="col-sm-2 control-label">Customer Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="CustStatus" id="CustStatus">
                                            <?php foreach ($customerstatus_data as $cs_opt_key => $cs_opt_value): ?>
                                                <?php 
                                                    if ($cs_opt_key == $FmData['CustStatus']) {
                                                            $isselected = 'selected="selected"';
                                                    }else{
                                                            $isselected = '';
                                                    } ?>
                                                <option <?php echo $isselected; ?> value="<?php echo $cs_opt_key; ?>" title="<?php echo $cs_opt_value; ?>"><?php echo $cs_opt_value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div><!-- /.left column -->
                        </div>                    
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2-2">
                        <div class="row invoice no-border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="CompanyType" class="col-sm-2 control-label">Company Type</label>
                                    <div class="col-sm-10">
                                    <input <?php if($FmData['CompanyType'] === 'Individual'){echo 'checked';}?> id="CompanyType" name="CompanyType" value="Individual" type="radio" onclick="$('#CompanyTypeOther').attr('disabled', 'disabled');">Individual
                                    <input <?php if($FmData['CompanyType'] === 'Proprietor'){echo 'checked';}?>  id="CompanyType" name="CompanyType" value="Proprietor" type="radio" onclick="$('#CompanyTypeOther').attr('disabled', 'disabled');">Proprietor
                                    <input <?php if($FmData['CompanyType'] === 'Partnership'){echo 'checked';}?>  id="CompanyType" name="CompanyType" value="Partnership" type="radio" onclick="$('#CompanyTypeOther').attr('disabled', 'disabled');">Partnership
                                    <input <?php if($FmData['CompanyType'] === 'Private Ltd.'){echo 'checked';}?>  id="CompanyType" name="CompanyType" value="Private Ltd." type="radio" onclick="$('#CompanyTypeOther').attr('disabled', 'disabled');">Private Ltd. <br>
                                    <input <?php if($FmData['CompanyType'] === 'Public Ltd.'){echo 'checked';}?>  id="CompanyType" name="CompanyType" value="Public Ltd." type="radio" onclick="$('#CompanyTypeOther').attr('disabled', 'disabled');">Public Ltd.                           
			           
			           <input <?php if($FmData['CompanyType'] != 'Individual' && $FmData['CompanyType'] != 'Proprietor' && $FmData['CompanyType'] != 'Partnership' && $FmData['CompanyType'] != 'Private Ltd.' && $FmData['CompanyType'] != 'Public Ltd.'){echo 'checked';}?>  id="CompanyType" name="CompanyType" value="Other" type="radio" onclick="$('#CompanyTypeOther').removeAttr('disabled');">Other.                           
			            
                                    <input id="CompanyTypeOther" name="CompanyTypeOther" <?php 
                                    if($FmData['CompanyType'] != 'Individual' && $FmData['CompanyType'] != 'Proprietor' && $FmData['CompanyType'] != 'Partnership' && $FmData['CompanyType'] != 'Private Ltd.' && $FmData['CompanyType'] != 'Public Ltd.'): ?>
                                    <?php echo 'value="'.$FmData['CompanyType'].'"'; ?>
                                     type="text" placeholder="Others" 
                                     <?php else:?>
                                     <?php echo 'disabled = "disabled"'; ?>
                                     <?php endif; ?>
                                     >               
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="PAN" class="col-sm-2 control-label">PAN / GIR No.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="PAN" name="PAN" value="<?php if($FmData['PAN']){echo $FmData['PAN'];}?>" placeholder="PAN / GIR No." type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SaleTaxNo" class="col-sm-2 control-label">Sale Tax No.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="SaleTaxNo" name="SaleTaxNo" value="<?php if($FmData['SaleTaxNo']){echo $FmData['SaleTaxNo'];}?>" placeholder="Sale Tax No." type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="SignedPerson" class="col-sm-2 control-label">Signed Person</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="SignedPerson" name="SignedPerson" value="<?php if($FmData['SignedPerson']){echo $FmData['SignedPerson'];}?>" placeholder="Signed Person" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="NoOfConnection" class="col-sm-2 control-label">No. Of Connection</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="NoOfConnection" name="NoOfConnection" value="<?php if($FmData['NoOfConnection']){echo $FmData['NoOfConnection'];}?>" placeholder="No. Of Connection" type="text">
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="Bandwidth" class="col-sm-2 control-label">Bandwidth</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="Bandwidth" name="Bandwidth" value="<?php if($FmData['Bandwidth']){echo $FmData['Bandwidth'];}?>" placeholder="Bandwidth" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="IpRequired" class="col-sm-2 control-label">IP Required</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="IpRequired" name="IpRequired" value="<?php if($FmData['IpRequired']){echo $FmData['IpRequired'];}?>" placeholder="IP Required" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Interface" class="col-sm-2 control-label">Interface</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="Interface" name="Interface" value="<?php if($FmData['Interface']){echo $FmData['Interface'];}?>" placeholder="Interface" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InternetPurpose" class="col-sm-2 control-label">Internet Purpose</label>
                                    <div class="col-sm-10">
                                        <input id="InternetPurpose" name="InternetPurpose" value="Data" type="radio" <?php if($FmData['InternetPurpose'] == 'Data'){echo 'checked';} ?>>Data
                                        <input id="InternetPurpose" name="InternetPurpose" value="Voice" type="radio" <?php if($FmData['InternetPurpose'] == 'Voice'){echo 'checked';} ?>>Voice
                                        <input id="InternetPurpose" name="InternetPurpose" value="Data,Voice" type="radio" <?php if($FmData['InternetPurpose'] == 'Data,Voice'){echo 'checked';} ?>>Data & Voice
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="NetworkEquipment" class="col-sm-2 control-label">Network Equipment</label>
                                    <div class="col-sm-10">
                                        <?php if($FmData['NetworkEquipment']){
                                            $netEqp = json_decode($FmData['NetworkEquipment'],TRUE);

                                        }?>
                                        <input name="NetworkEquipment_1" value="Router" type="checkbox" <?php if($netEqp['NetworkEquipment_1'] == 'Router'){echo 'checked';} ?>>Router
                                        <input  name="NetworkEquipment_2" value="Switch" type="checkbox" <?php if($netEqp['NetworkEquipment_2'] == 'Switch'){echo 'checked';} ?>>Switch
                                        <input  name="NetworkEquipment_3" value="Standalone PC" type="checkbox" <?php if($netEqp['NetworkEquipment_3'] ==  'Standalone PC'){echo 'checked';} ?>>Standalone PC 
                                        <input  name="NetworkEquipment_4" value="Proxy Server" type="checkbox" <?php if($netEqp['NetworkEquipment_4'] == 'Proxy Server'){echo 'checked';} ?>>Proxy Server
                                    </div>
                                </div>                
                            </div>
                        </div><!-- /.row -->    
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3-2">
                        <div class="invoice no-border">
                            <table aria-describedby="example2_info" role="grid" id="example2" class="table table-bordered table-hover dataTable table-striped table-responsive">
                                <thead>
                                    <tr role="row"><th class="sorting">Department</th><th class="sorting">Name</th><th class="sorting">Mobile</th><th class="sorting">Landline</th><th class="sorting">E-Mail</th></tr>
                                </thead>
                                <tbody>       
                                    <tr class="odd" role="row">
                                        <td class="">Financial</td>
                                        <td><input class="form-control" type="text" name="FinContactName" value="<?php if($FmData['FinContactName']){echo $FmData['FinContactName'];}?>"></td>
                                        <td><input class="form-control" type="text" name="FinContactMobile" value="<?php if($FmData['FinContactMobile']){echo $FmData['FinContactMobile'];}?>"></td>
                                        <td><input class="form-control" type="text" name="FinContactPhone" value="<?php if($FmData['FinContactPhone']){echo $FmData['FinContactPhone'];}?>"></td>
                                        <td><input class="form-control" type="text" name="FinContactEmail" value="<?php if($FmData['FinContactEmail']){echo $FmData['FinContactEmail'];}?>"></td>
                                    </tr><tr class="even" role="row">
                                        <td class="">Technical</td>
                                        <td><input class="form-control" type="text" name="TecContactName" value="<?php if($FmData['TecContactName']){echo $FmData['TecContactName'];}?>"></td> 
                                        <td><input class="form-control" type="text" name="TecContactMobile" value="<?php if($FmData['TecContactMobile']){echo $FmData['TecContactMobile'];}?>"></td>
                                        <td><input class="form-control" type="text" name="TecContactPhone" value="<?php if($FmData['TecContactPhone']){echo $FmData['TecContactPhone'];}?>"></td>
                                        <td><input class="form-control" type="text" name="TecContactEmail" value="<?php if($FmData['TecContactEmail']){echo $FmData['TecContactEmail'];}?>"></td>                
                                    </tr></tbody>                
                            </table>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3-3">
                        <div class="invoice no-border">
                        
                            <div class="form-group">
                                    <label for="PaymentType" class="col-sm-2 control-label">Payment Type</label>
                                    <div class="col-sm-10">
                                        <input id="PaymentType" name="PaymentType" value="Cheque" type="radio" <?php if($FmData['PaymentType'] == 'Cheque'){echo 'checked';} ?>>Cheque
                                        <input id="PaymentType" name="PaymentType" value="DemandDraft" type="radio" <?php if($FmData['PaymentType'] == 'DemandDraft'){echo 'checked';} ?>>Demand Draft
                                        <input id="PaymentType" name="PaymentType" value="Cash" type="radio" <?php if($FmData['PaymentType'] == 'Cash'){echo 'checked';} ?>>Cash             
                                        <input id="PaymentType" name="PaymentType" value="FundTransfer" type="radio" <?php if($FmData['PaymentType'] == 'FundTransfer'){echo 'checked';} ?>>Fund Transfer
                                    </div>
                            </div>                        
                        
                            <table aria-describedby="example2_info" role="grid" id="example2" class="table table-bordered table-hover dataTable">
                                <thead>
                                    <tr role="row"><th class="sorting">Cheque /DD No.</th><th class="sorting">Date of Deposit</th><th class="sorting_asc">Bank Name</th><th class="sorting">Branch & City</th><th  class="sorting">Amount</th><th class="sorting">Amount in words</th></tr>
                                </thead>
                                <tbody>       
                                    <tr class="odd" role="row">
                                        <td><input  class="form-control" type="text" name="PayChequeNo" value="<?php if($FmData['PayChequeNo']){echo $FmData['PayChequeNo'];}?>"></td>
                                        <td><input class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()" type="text" name="PayDate" value="<?php if($FmData['PayDate']){echo $FmData['PayDate'];}?>"></td>
                                        <td><input class="form-control" type="text" name="PayBranchName" value="<?php if($FmData['PayBranchName']){echo $FmData['PayBranchName'];}?>"></td>
                                        <td><input class="form-control" type="text" name="PayCity" value="<?php if($FmData['PayCity']){echo $FmData['PayCity'];}?>"></td>
                                        <td><input class="form-control" type="text" name="PayAmount" value="<?php if($FmData['PayAmount']){echo $FmData['PayAmount'];}?>"></td>
                                        <td><input class="form-control" type="text" name="PayAmountWord" value="<?php if($FmData['PayAmountWord']){echo $FmData['PayAmountWord'];}?>"></td>
                                    </tr></tbody>                
                            </table> 
                        </div>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_3-4">
                        <div class="invoice no-border">

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Product</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_listing_table">
                                        <?php 
                                                $ArrFromJson = json_decode($FmData['EquipmentProvided'],TRUE);

                                        	if(is_array($ArrFromJson) && count($ArrFromJson) >= 1):
                                        	
                                        	$tii = 1;
                                        	

                                                foreach ($ArrFromJson as $EqNoNoteArr):

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
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="ItemNo_<?php echo $tii; ?>" id="ItemNo_<?php echo $tii; ?>">
                                                                <?php foreach ($product_data as $pd_opt_key => $pd_opt_value): ?>
                                                                <?php 
                                                                    if ($pd_opt_key == $EqNoNoteArr[0]) {
                                                                        $isselected = 'selected="selected"';
                                                                    }else{
                                                                        $isselected = '';
                                                                    } ?>
                                                                    <option <?php echo $isselected; ?> value="<?php echo $pd_opt_key; ?>" title="<?php echo $pd_opt_value; ?>"><?php echo $pd_opt_value; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Note_<?php echo $tii; ?>" name="Note_<?php echo $tii; ?>" value="<?php echo $EqNoNoteArr[1]; ?>" placeholder="Note" type="text">
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
                                            
                                        <?php 
                                        //this + 5 increment is to manage new entry by javascript on edition mode
                                        // so on edit with existing entry one can add additional 4 entries can do 
                                        //or del and add many as possible
                                        $tii = $tii + 25;
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
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="ItemNo_1" id="ItemNo_1">
                                                                <?php foreach ($product_data as $pd_opt_key => $pd_opt_value): ?>
                                                                    <option <?php echo $isselected; ?> value="<?php echo $pd_opt_key; ?>" title="<?php echo $pd_opt_value; ?>"><?php echo $pd_opt_value; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="Note_1" name="Note_1" value="" placeholder="Note" type="text">
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
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="<?php echo $home.'/'.$module.'/'.$controller.'/'.$method; ?>" class="btn btn-md btn-info btn-flat pull-left">Show List</a>

                    <?php if($mode == 'edit'): ?>
                    <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit"><i class="fa fa-edit"></i> Edit </button>
                    <?php else: ?>
                    <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"><i class="fa fa-cube"></i>Add New</button>
                    <?php endif; ?>
                </div>
            </div>        
        </div>
    </div>
</form>

