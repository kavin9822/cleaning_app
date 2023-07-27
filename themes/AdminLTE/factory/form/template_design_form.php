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
                       <label  class="col-sm-3 control-label">Department Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Department_ID" id="Department_ID" tabindex="1" onmouseover="ycssel()" required>
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
             
              <div class="form-group">
                       <label  class="col-sm-3 control-label">Template Description</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="TemplateDescription" name="TemplateDescription" value="<?php echo $FmData[0]['TemplateDescription'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="3" required>
			           </div>
		          </div>
              
              <div class="form-group">
                       <label  class="col-sm-3 control-label">In-progress Status</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="ProgressStatus" id="ProgressStatus" tabindex="5" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($progress_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['ProgressStatus']) {
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
             
                    
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Template Title</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="TemplateTitle" name="TemplateTitle" value="<?php echo $FmData[0]['TemplateTitle'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="2" required>
			           </div>
		          </div>
		          <div class="form-group">
                       <label  class="col-sm-3 control-label">Tasktag Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="TaskTags" id="TaskTags" tabindex="4" onmouseover="ycssel()">
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($task_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['TaskTags']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['TaskTag']; ?>"><?php echo $v['TaskTag']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
		           <div class="form-group" style="margin-top:25px">
                       <label  class="col-sm-3 control-label">Section Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="SectionName" name="SectionName" value="<?php echo $FmData[0]['SectionName'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="6" required>
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
  
</section>         
            