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
                       <label  class="col-sm-3 control-label">Property Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Property_ID" id="Property_ID" tabindex="1" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($property_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Property_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['PropertyName']; ?>"><?php echo $v['PropertyName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
               
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Template Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Template_ID" id="Template_ID" tabindex="3" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($template_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Template_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['TemplateTitle']; ?>"><?php echo $v['TemplateTitle']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
			        
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Description</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Description" name="Description" value="<?php echo $FmData[0]['Description'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="5" required>  
			           </div>
		          </div>
				  
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Assignee Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Assignees_ID" id="Assignees_ID" tabindex="8" onmouseover="ycssel()" >
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($assignee_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Assignees_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['Assignee']; ?>"><?php echo $v['Assignee']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
                  
                       <div class="form-group">
                       <label  class="col-sm-3 control-label">Task Tags</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Tasktag_ID" id="Tasktag_ID" tabindex="4" onmouseover="ycssel()">
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($task_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Tasktag_ID']) {
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
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Department Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Department_ID" id="Department_ID" tabindex="2" onmouseover="ycssel()" required>
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
                       <label  class="col-sm-3 control-label">Task title</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="TaskTitle" name="TaskTitle" value="<?php echo $FmData[0]['TaskTitle'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="4" required>
			           </div>
		          </div>
		          <div class="form-group">
                        <label  class="col-sm-3 control-label">Estimated time</label>
                        <div class="col-sm-9">
                           <input class="form-control" id="timepicker" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event);" placeholder="HH:mm" data-date-format="HH:mm" name="EstimatedTime" value="<?php if ($FmData[0]['EstimatedTime']){echo $FmData[0]['EstimatedTime'];} else{ echo date('H:i ');} ?>" type="text" onclick="ycstime()" tabindex="6">
                       </div>
                  </div>
                 <div class="form-group">
                    <label  class="col-sm-3 control-label">File Upload</label>
                    <div class="col-sm-9">
                        <div class="files">
                            <span class="btn btn-default btn-files add_new_btn pt-2">
                                 Add Attachment <input type="file" <?php if(empty($FmDataattachment)){ echo 'required';} ?>  name="files2[]"  id="files2"  multiple="multiple" />
                            </span>
                        </div>
                        <div><p class="fileList2 fileList" style="margin-top:40px"><label class="head_cls">Uploaded Items</label></p></div>
                        <?php if($mode == 'edit' || $mode == 'view'){ ?>
                    
                                    <?php if(!empty($FmDataattachment)){ ?>
                                    
                                        <div class="files">
                                            
                                            <p class="fileList mt-3" id="imagedata">
                                             
                                    <?php  $i=0; foreach ($FmDataattachment as $datavalue):  ?>
                                    
                                            <?php if(isset($FmDataattachment[$i]['document_path']))?>
                                            
                                                <?php if($mode == 'edit'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataattachment[$i]['document_path']; ?>">
                                                <?php } else if($mode == 'view'){?>
                                            <a  target="_blank" id="imglist_<?php echo $i;?>" href="<?php echo $home.'/'. $FmDataattachment[$i]['document_path']; ?>" style="pointer-events: none;">
                                                 <?php }?>   
                                            <?php echo ltrim($FmDataattachment[$i]['document_path'],"resource/tender/."); ?>
                                            <span class="col-sm-6 col-lg-6 col-xl-6" >
                                                 <?php if($mode == 'edit'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','task_attachments');$(imglist_<?php echo $i?>).remove();return false;">Remove
                                            </a>
                                                 <?php } else if($mode == 'view'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','task_attachments');$(imglist_<?php echo $i?>).remove();return false;">
                                            </a>
                                                 <?php }?>  
                                            <span>
                                            </span>&nbsp;</a>
                                            <br><br>
                                            <?php $i++; endforeach;  ?>
                                            </p>
                                        </div>
                                        <br>
                                    <?php } ?>
                                <?php } ?>
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
            