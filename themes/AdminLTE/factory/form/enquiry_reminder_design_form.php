<section class="invoice">
    <form class="form-horizontal" enctype="multipart/form-data"   id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post" >  
    <?php if($mode == 'view'){ ?>
     <fieldset disabled>
    <?php } ?>

    <?php  

    if($mode == 'edit' or $mode == 'view')
    { ?>

   
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
		<div class="row" style="margin:20px">
			<input id="ycs_ID" name="ycs_ID" value="<?php if($ycs_ID){echo $ycs_ID;}?>"  type="hidden">
                <div class="col-lg-6">
				<div class="form-group">
                       <label  class="col-sm-3 control-label">Enquiry No</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['enquiry_ID'])) { ?>
                              <input id="enquiry_ID" name="enquiry_ID" value="<?php if($FmData[0]['enquiry_ID']){echo $FmData[0]['enquiry_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="enquiry_ID" id="enquiry_ID" required>
                              <?php }else { ?>
					          <select class="form-control" name="enquiry_ID" id="enquiry_ID" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($enquiry_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['enquiry_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
				<div class="form-group">
                       <label  class="col-sm-3 control-label">Company Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['customer_ID'])) { ?>
                              <input id="customer_ID" name="customer_ID" value="<?php if($FmData[0]['customer_ID']){echo $FmData[0]['customer_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="customer_ID" id="customer_ID" required>
                              <?php }else { ?>
					          <select class="form-control" name="customer_ID" id="customer_ID" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($customer_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['customer_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Due Date</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="due_date" name="due_date" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['due_date']) && ($FmData[0]['due_date']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['due_date']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text" >
			           </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Assigned to</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['assigned_to_ID'])) { ?>
                              <input id="assigned_to_ID" name="assigned_to_ID" value="<?php if($FmData[0]['assigned_to_ID']){echo $FmData[0]['assigned_to_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="assigned_to_ID" id="assigned_to_ID" required>
                              <?php }else { ?>
					          <select class="form-control" name="assigned_to_ID" id="assigned_to_ID" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($emp_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['assigned_to_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EmpName']; ?>"><?php echo $v['EmpName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			           </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Task Repeat</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="task_repeat" id="task_repeat" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['task_repeat']) && $FmData[0]['task_repeat']=='Daily'){echo 'selected="selected"';} ?> value="Daily" title="Daily">Daily</option>
                            <option <?php if(isset($FmData[0]['task_repeat']) && $FmData[0]['task_repeat']=='Week'){echo 'selected="selected"';} ?> value="Week" title="Week">Week</option>
							<option <?php  if(isset($FmData[0]['task_repeat']) && $FmData[0]['task_repeat']=='Month'){echo 'selected="selected"';} ?> value="Month" title="Month">Month</option>
							<option <?php  if(isset($FmData[0]['task_repeat']) && $FmData[0]['task_repeat']=='Year'){echo 'selected="selected"';} ?> value="Year" title="Year">Year</option>
                        </select>
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Remainder Description</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="reminder_des" name="reminder_des" value="<?php echo $FmData[0]['reminder_des'];?>" type="text">
			           </div>
		          </div>
				  <div class="form-group">
                       <label  class="col-sm-3 control-label">Status</label>
			           <div class="col-sm-9">
			              <select class="form-control" name="status" id="status" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['status']) && $FmData[0]['status']=='1'){echo 'selected="selected"';} ?> value="1" title="Opened">Opened</option>
                            <option <?php if(isset($FmData[0]['status']) && $FmData[0]['status']=='2'){echo 'selected="selected"';} ?> value="2" title="Closed">Closed</option>
                        </select>
			          </div>
		          </div>
			   </div>
			   <div class="col-lg-6">
			        
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
                <button type ="submit" class="btn btn-success pull-right" name="edit_submit_button" value="edit"> Submit </button>
                <?php } else if($mode == 'add'){ ?>
                <button type ="submit" class="btn btn-success pull-right" name="add_submit_button" value="add"> Submit </button>
                <?php } ?>
            </div>
        </div>
        <?php if($mode == 'view'){ ?>
           </fieldset>
           <a href="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" class="btn btn-primary" > List </a>
        <?php } ?>
    </form>
  
</section>         
            