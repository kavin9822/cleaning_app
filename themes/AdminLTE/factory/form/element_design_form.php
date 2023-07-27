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
                       <label  class="col-sm-3 control-label">Element Name</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ElementName" name="ElementName" value="<?php echo $FmData[0]['ElementName'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="3" required>
			           </div>
		          </div>
                  
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Notes</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="Notes" name="Notes" value="<?php echo $FmData[0]['Notes'];?>" type="text" onkeyup="specialcharacters_restriction(this.id)" tabindex="5" style="height: 50px;" placeholder="Text Area">  
			           </div>
		          </div>
             
                       <div class="form-group">
                           <label class="col-sm-3 control-label" for="imageInput">Photo</label>
                           <div class="col-sm-9">
                                 <input type="file" class="form-control-file" id="imageInput" name="Profile_image" accept="image/*">
                                 <img src="<?php echo $home .'/'. $FmData[0] ['Profile_image']; ?>" id="selectedImage" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                           </div>
                           </div>

                
			   </div>
			   <div class="col-lg-6">
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Element Type</label>
			           <div class="col-sm-9">
					      <select class="form-control js-example-basic-single" name="ElementType" id="ElementType" tabindex="2" onmouseover="ycssel()" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['ElementType']) && $FmData[0]['ElementType']=='Exterior'){echo 'selected="selected"';} ?> value="Exterior" title="Exterior">Exterior</option>
                            <option <?php if(isset($FmData[0]['ElementType']) && $FmData[0]['ElementType']=='Interior'){echo 'selected="selected"';} ?> value="Interior" title="Interior">Interior</option>
                            <option <?php  if(isset($FmData[0]['ElementType']) && $FmData[0]['ElementType']=='Device'){echo 'selected="selected"';} ?> value="Device" title="Device">Device</option>
                            <option <?php if(isset($FmData[0]['ElementType']) && $FmData[0]['ElementType']=='Items'){echo 'selected="selected"';} ?> value="Items" title="Items">Items</option>
                        </select>
			          </div>
		          </div>
		          <div class="form-group">
                       <label  class="col-sm-3 control-label">Floor</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Floor_ID" id="Floor_ID" tabindex="4" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($property_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Floor_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['NoOfFloor']; ?>"><?php echo $v['NoOfFloor']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
		           <div class="form-group">
                       <label  class="col-sm-3 control-label">Item Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Item_ID" id="Item_ID" tabindex="6" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($item_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Item_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['ItemName']; ?>"><?php echo $v['ItemName']; ?></option>
                           <?php endforeach; ?>
                           </select>
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
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','element_attachments');$(imglist_<?php echo $i?>).remove();return false;">Remove
                                            </a>
                                                 <?php } else if($mode == 'view'){?>
                                            <a href="#" class="mb-3 remove_cls removeFile<?php echo $i;?>" id="imglist_<?php echo $i;?>"
                                            onclick="removeuploadedfile('<?php echo ($FmDataattachment[$i]['ID']); ?>','element_attachments');$(imglist_<?php echo $i?>).remove();return false;">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Function to handle file input change
    function handleFileSelect(evt) {
      var files = evt.target.files; // Get the selected file(s)

      if (files.length === 0) {
        // If no file is selected, reset the image source
        $('#selectedImage').attr('src', '');
        return;
      }

      // We assume that only the first selected file will be used
      var file = files[0];

      // Check if the selected file is an image
      if (file.type.match('image.*')) {
        var reader = new FileReader(); // Create a FileReader object

        // When the file is read successfully, set the image source
        reader.onload = function(e) {
          $('#selectedImage').attr('src', e.target.result);
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
      } else {
        // If the selected file is not an image, reset the image source
        $('#selectedImage').attr('src', '');
        alert('Please select an image file.');
      }
    }

    // Bind the handleFileSelect function to the change event of the file input
    $('#imageInput').on('change', handleFileSelect);
  </script>

  <style>
    #Notes::placeholder {
  position: absolute;
  top: 0;
  left: 5px;
  color: #999;
  font-size: 14px;
}

input[type="file"]{
    color: transparent;
}
</style>
  
</section>         
            