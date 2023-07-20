<section class="content-header">
    <h1 class="text-center"><?php echo $company_name; ?> Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $home; ?>/user/reg/chart"><i class="fa fa-bar-chart"></i> View on chart</a></li>        
    </ol>    
</section>
<br/>
<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
<section class="content">
    <div class="row">
    <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Overall</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Inventory</a></li>
              <li class=""><a href="#tab_3-3" data-toggle="tab" aria-expanded="false">Architecture</a></li>
              <!--<li class=""><a href="#tab_4-4" data-toggle="tab" aria-expanded="false">Inbox</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                  
                  <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Customer List</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered" style="border:1px solid #c5c5c5">
                <tbody><tr>
                  <th>Customer Type</th>
                  <th>Joined This Month(May'18)</th>
                  <th>Projected / Expected(Jun'18)</th>                   
                </tr>
                <tr>
                  <td>Platinum</td>
                  <td>60</td>
                  <td>75</td>                  
                </tr>
                <tr>
                  <td>Diamond</td>
                  <td>100</td>
                  <td>120</td>                  
                </tr>
                <tr>
                  <td>Gold</td>
                  <td>200</td>
                  <td>250</td>                  
                </tr>
                <tr>
                  <td>Silver</td>
                  <td>100</td>
                  <td>120</td>                  
                </tr>
                <tr>
                  <td>Bronze</td>
                  <td>80</td>
                  <td>100</td>                  
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="col-xs-12 col-md-6">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Available Raw Materials</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered" style="border:1px solid #c5c5c5">
                <tbody><tr>
                  <th>Raw Material</th>
                  <th>Unit</th>
                  <th>Available Quantity</th>
                  <th>Required Quantity</th>                  
                </tr>
                <tr>
                  <td>PVC plastic</td>
                  <td>kg</td>
                  <td>200</td>
                  <td>2500</td>                  
                </tr>
                <tr>
                  <td>Thread</td>
                  <td>nos</td>
                  <td>500</td>
                  <td>7500</td>                  
                </tr>
                <tr>
                  <td>Polypropylene(PP) non-woven fabric</td>
                  <td>mt</td>
                  <td>700</td>
                  <td>10000</td>                  
                </tr>
                <tr>
                  <td>Cotton</td>
                  <td>kg</td>
                  <td>100</td>
                  <td>1200</td>                  
                </tr>
                <tr>
                  <td>Polythene</td>
                  <td>kg</td>
                  <td>130</td>
                  <td>1500</td>                  
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="col-xs-12 col-md-6">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Sales Order Stage Wise</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered" style="border:1px solid #c5c5c5">
                <tbody><tr>
                  <th>Stage</th>
                  <th>No</th>
                  <th>Expected Despatch</th>
                  <tr>
                </tr>   
                <tr>
                  <td>PPC</td>
                  <td>4</td>
                  <td>2018-06-20</td>
                </tr>
                <tr>
                  <td>Store</td>
                  <td>5</td>
                  <td>2018-06-20</td>       
                </tr>
                <tr>
                  <td>Manufacturing</td>
                  <td>3</td>
                  <td>2018-06-15</td>           
                </tr>
                <tr>
                  <td>QA</td>
                  <td>5</td>
                  <td>2018-06-12</td>          
                </tr>
                <tr>
                  <td>Finished Goods</td>
                  <td>20</td>
                  <td>2018-06-12</td>           
                </tr>
              </tbody> </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="col-xs-12 col-md-6">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Sales</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered" style="border:1px solid #c5c5c5 !important">
                <tbody><tr>
                  <th rowspan='2'><br>Product Category</th>
                  <th >Current</th>
                  <th colspan='2' class="text-center">Projection</th>
                  <tr>
                  <th>Sales April'18</th>
                  <th>Sales May'18</th>
                  <th>Sales June'18</th></tr>
                </tr>   
                <tr>
                  <td>Med-Care</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 10,75,555.48</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 12,00,000.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 13,00,000.00</td> 
                </tr>
                <tr>
                  <td>Industrial-Care</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 5,65,555.65</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 6,00,555.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 7,05,555.00</td>               
                </tr>
                <tr>
                  <td>Home-Care</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 25,15,555.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 28,05,550.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 30,00,000.00</td>              
                </tr>
                <tr>
                  <td>Packaging-Care</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 55,50,750.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 57,50,000.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 60,00,000.00</td> 
                </tr>
              </tbody> </table><p class="pull-right" style="color:red;">* Costs shown in lakhs</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    
</div>
                  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                  <div class="row">
                      
            <div class="col-xs-12 col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Dynamic Stock Update</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <tbody><tr>
                  <th >Product</th>
                  <th >Total Quantity</th>
                  <th >Last Updated Rate</th>
                  <th >Total Value</th>
                  <th >Last Updated By</th>
                  <th >Last Date Time</th>
                </tr>
                
                <?php foreach($stk_data as $key=>$value){ ?>
                <tr>
                  <td><?php echo $value['ItemName']; ?></td>
                  <td><?php echo $value['TotalQty']; ?></td>
                  <td><?php echo $value['LastUpdatedRate']; ?></td>
                  <td><?php echo $value['TotalValue']; ?></td>
                  <td><?php echo $value['user_nicename']; ?></td>
                  <td><?php echo $value['AuditDateTime']; ?></td>
                </tr>
                <?php } ?>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            <div class="col-xs-12 col-md-12">          
           <p ></br></br></p>        
          </div>
                  <div class="col-xs-12 col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inventory</h3>              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <tbody><tr>
                  <th rowspan='2'>Inventory Type</th>
                  <th rowspan='2'>Total Cost</th>
                  <th colspan='2' class="text-center">Required Cost</th>
                  <tr>
                  <th>May'18</th>
                  <th>June'18</th></tr>
                </tr>
                <tr>
                  <td>Transportation</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 1,45,254.00</td>   
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 1,56,876.00</td>   
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 1,56,000.00</td>    
                </tr>
                <tr>
                  <td>Raw Materials</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 2,12,000.80</td>  
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 2,50,000.00</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 2,50,000.00</td>  
                </tr>
                <tr>
                  <td>Assets</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 7,58,987.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 7,98,600.00</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 7,98,600.00</td>      
                </tr>
                <tr>
                  <td>Equipment Purchase</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 1,75,555.48</td> 
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 56,893.00</td>
                  <td><i class="fa fa-inr" aria-hidden="true"></i> 57,500.00</td>     
                </tr>
              </tbody>
              </table><p class="pull-right" style="color:red;">* Costs shown in lakhs</p> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
              </div>
              
              <div class="tab-pane" id="tab_3-3">
                  <center><img src="<?php echo $themePath; ?>/architecture.png" alt="Web Application Architecture"> </center>
               </div> 
               
               
         <!--     <div class="tab-pane active" id="tab_4-4">-->
         <!--        <div class="row">-->
         <!--<div class="box box-primary">-->
         <!--   <div class="box-header with-border">-->
         <!--     <h3 class="box-title">Inbox</h3>-->

             
         <!--   </div>-->
            <!-- /.box-header -->
         <!--   <div class="box-body no-padding">-->
         <!--     <div class="mailbox-controls">-->
                <!-- Check all button -->
                <!--<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>-->
                <!--</button>-->
                <!--<div class="btn-group">-->
                 
                <!--  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>-->
               
                <!--</div>-->
                <!-- /.btn-group -->
         <!--       <button type="button" class="btn btn-default btn-sm" onclick='window.location.reload(true);'><i class="fa fa-refresh"></i></button>-->
                
         <!--       </div>-->
                <!-- /.pull-right -->
         <!--     </div>-->
         <!--     <div class="table-responsive mailbox-messages">-->
         <!--       <table class="table table-hover table-striped">-->
         <!--         <tbody><tr>-->
                      <!--<th></th>-->
         <!--         <th >Sender</th>-->
         <!--         <th >Message</th>-->
         <!--         <th>Time</th>-->
         <!--         <th>Action</th>-->
         <!--       </tr>-->
               
         <!--       <?php  foreach($sqlinbox_data as $key=>$value){ ?>-->
         <!--       <tr>-->
                    <!--<td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;">-->
                    <!--    <input type="checkbox" style="position: absolute; opacity: 0;">-->
                        
                    <!--    </div>-->
                    <!--    </td>-->
         <!--         <td class="mailbox-name" ><?php echo $value['SendFrmUser']; ?></td>-->
         <!--         <td class="mailbox-subject"> <?php echo $value['ProcessType']; ?> has been generated.Please Check and Confirm <input type="hidden" class="btn btn-default btn-sm" name="ProcessType" value='<?php echo $value['ProcessType']; ?>'></td>-->
         <!--          <td ><?php echo $value['age']; ?> ago <input type="hidden" class="btn btn-default btn-sm" name="process_ID" value='<?php echo $value['process_ID']; ?>'></td>-->
         <!--          <td ><input type="submit" class="btn btn-default btn-sm" name="Action" value="Approve"><i class="fa fa-reply"></i> </input></td>-->
         <!--         </tr>-->
         <!--       <?php } ?>-->
                  
         <!--         </tbody>-->
         <!--       </table>-->
                <!-- /.table -->
         <!--     </div>-->
              <!-- /.mail-box-messages -->
         <!--   </div>-->
            <!-- /.box-body -->
            <!--<div class="box-footer no-padding">-->
            <!--  <div class="mailbox-controls">-->
                <!-- Check all button -->
                <!--<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>-->
                <!--</button>-->
                <!--<div class="btn-group">-->
                 
                <!--  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>-->
                  
                <!--</div>-->
                <!-- /.btn-group -->
            <!--    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>-->
                
                  <!-- /.btn-group -->
            <!--    </div>-->
                <!-- /.pull-right -->
            <!--  </div>-->
         <!--   </div>-->
         <!-- </div>-->
          <!-- /. box -->
        </div>
               </div>  
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    
    
    </div>


    </section><br>
    
  