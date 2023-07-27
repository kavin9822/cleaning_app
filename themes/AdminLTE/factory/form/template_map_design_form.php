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
                       <label  class="col-sm-3 control-label">Service Provider Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Serviceprovider_ID" id="Serviceprovider_ID" tabindex="3" onmouseover="ycssel()" required>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($serviceprovider_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Serviceprovider_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                           <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['OwnerName']; ?>"><?php echo $v['OwnerName']; ?></option>
                           <?php endforeach; ?>
                           </select>
					  </div>
		          </div>
                  
			   </div>
			   <div class="col-lg-6">
               <div class="form-group">
                       <label  class="col-sm-3 control-label">Template Name</label>
			           <div class="col-sm-9">
			              <select class="form-control js-example-basic-single" name="Template_ID" id="Template_ID" tabindex="2" onmouseover="ycssel()" required>
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
            