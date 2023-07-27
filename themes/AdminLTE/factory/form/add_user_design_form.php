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
                       <label  class="col-sm-3 control-label">First Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="FirstName" name="FirstName" value="<?php echo $FmData[0]['FirstName'];?>" type="text" onkeyup="validateInput(this)" tabindex="1" required>
			           </div>
		          </div>
                 
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Email ID</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Email" name="Email" value="<?php echo $FmData[0]['Email'];?>" type="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" tabindex="3" required>
			           </div>
		          </div>
                
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Role Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Role_ID" id="Role_ID" tabindex="5" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($role_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Role_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['RoleName']; ?>"><?php echo $v['RoleName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
                
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Status</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Status" id="Status" tabindex="7" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($status_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Status']) {
                              $isselected = 'selected="selected"';
                              }else if($v['ID'] == 1){
                                $isselected = 'selected="selected"';
                               } else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Title']; ?>"><?php echo $v['Title']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
			       
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Last Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="LastName" name="LastName" value="<?php echo $FmData[0]['LastName'];?>" type="text" onkeyup="validateInput(this)" tabindex="2" required>
			           </div>
		          </div>
		          <div class="form-group">
                       <label  class="col-sm-3 control-label">User Type</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="UserType" id="UserType" tabindex="4" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($usertype_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['UserType']) {
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
                       <label  class="col-sm-3 control-label">Department Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Department_ID" id="Department_ID" tabindex="6" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($dept_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Department_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['DeptName']; ?>"><?php echo $v['DeptName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
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
    <style>
        input[type="file"]{
              color: transparent;
        }
    </style>
  
</section>         
            