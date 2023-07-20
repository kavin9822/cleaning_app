<section class="content-header">
    <h1 class="text-center"><?php echo $company_name; ?> Inbox</h1>
</section>
<br/>
<form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
<section class="content">
    <div class="row">
    <div class="col-md-12">
         
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <!--<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>-->
                <!--</button>-->
                <!--<div class="btn-group">-->
                 
                <!--  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>-->
               
                <!--</div>-->
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onclick='window.location.reload(true);'><i class="fa fa-refresh"></i></button>
                
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody><tr>
                      <!--<th></th>-->
                  <th >Sender</th>
                  <th >Message</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
               
                <?php foreach($sqlinbox_data as $key=>$value){ ?>
                
              
                <tr>
                    <!--<td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;">-->
                    <!--    <input type="checkbox" style="position: absolute; opacity: 0;">-->
                        
                    <!--    </div>-->
                    <!--    </td>-->
                  <td class="mailbox-name" > <span style="color:blue"><?php echo $value['SendFrmUser']; ?></span></td>
                  <td class="mailbox-subject"> <b><?php echo $value['ProcessType']; ?> </b> has been generated.Please Check and Confirm <input type="hidden" class="btn btn-default btn-sm" name="ProcessType" value='<?php echo $value['ProcessType']; ?>'></td>
                   <td ><span style="color:red"><?php echo $value['age']; ?> ago </span> <input type="hidden" class="btn btn-default btn-sm" name="process_ID" value='<?php echo $value['process_ID']; ?>'></td>
                   <td ><a class="btn btn-primary btn-xs bg-purple margin"  href="<?php echo $home;?>/user/reg/mailbox/?process_ID=<?php echo $value["process_ID"]?>&amp;processtype=<?php echo $value["ProcessType"]?>">approve</a><i class="fa fa-reply"></i></td>
                  </tr>
                
                  
                <?php } ?>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
           
          
        </div>
               </div>  
              
              <!-- /.tab-pane -->
              </section><br>
    
  