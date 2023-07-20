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
                       <label  class="col-sm-3 control-label">PO Reference</label>
			           <div class="col-sm-9">
                         <input class="form-control" id="PoReference" name="PoReference" value="<?php echo $FmData[0]['PoReference'];?>" type="text" >
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Ref No</label>
			           <div class="col-sm-9">
                          <input class="form-control" id="RefNo" name="RefNo" value="<?php echo $FmData[0]['RefNo'];?>" type="text" >
			           </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Employee Name</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['EmployeeID'])) { ?>
                              <input id="EmployeeID" name="EmployeeID" value="<?php if($FmData[0]['EmployeeID']){echo $FmData[0]['EmployeeID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeID" id="EmployeeID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EmployeeID" id="EmployeeID" disabled required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($employee_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['EmployeeID']) {
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
                       <label  class="col-sm-3 control-label">week</label>
			           <div class="col-sm-9">
                       <select class="form-control" name="week" id="week" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['week']) && $FmData[0]['week']=='week1'){echo 'selected="selected"';} ?> value="week1" title="week1">week1</option>
                            <option <?php if(isset($FmData[0]['week']) && $FmData[0]['week']=='week2'){echo 'selected="selected"';} ?> value="week2" title="week2">week2</option>
                            <option <?php  if(isset($FmData[0]['week']) && $FmData[0]['week']=='week3'){echo 'selected="selected"';} ?> value="week3" title="week3">week3</option>
                            <option <?php if(isset($FmData[0]['week']) && $FmData[0]['week']=='week4'){echo 'selected="selected"';} ?> value="week4" title="week4">week4</option>
                        </select>
			          </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Unit</label>
			           <div class="col-sm-9">
                         <input class="form-control" id="Unit" name="Unit" value="<?php echo $FmData[0]['Unit'];?>" type="text" onkeypress="return onlyNumbernodecimal(event);">
			          </div>
		          </div>
			   </div>
			   <div class="col-lg-6">
               <div class="form-group">
                       <label  class="col-sm-3 control-label">Description of PO</label>
			           <div class="col-sm-9">
                          <input class="form-control" id="Descriptionofpo" name="Descriptionofpo" value="<?php echo $FmData[0]['Descriptionofpo'];?>" type="text" >
				      </div>
		          </div>
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Employee Type</label>
			           <div class="col-sm-9">
                       <?php if(isset($FmData[0]['EmployeeType'])) { ?>
                              <input id="EmployeeType" name="EmployeeType" value="<?php if($FmData[0]['EmployeeType']){echo $FmData[0]['EmployeeType'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EmployeeType" id="EmployeeType" disabled>
                              <?php }else { ?>
                       <select class="form-control" name="EmployeeType" id="EmployeeType" onchange="add_enable_workorder(this.value,1,'EmployeeID');add_enable_workorder1(this.value,2,'Subcontractor_ID')" required>
                       <?php } ?>
                            <option value="" disabled selected style="display:none;">Select</option>
                                    <?php foreach ($Employeetype_data as $k => $v): 
                                    if ($v['ID'] == $FmData[0]['EmployeeType']) {
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
                       <label  class="col-sm-3 control-label">Subcontractor Name</label>
			           <div class="col-sm-9">
					   <?php if(isset($FmData[0]['Subcontractor_ID'])) { ?>
                              <input id="Subcontractor_ID" name="Subcontractor_ID" value="<?php if($FmData[0]['Subcontractor_ID']){echo $FmData[0]['Subcontractor_ID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="Subcontractor_ID" id="Subcontractor_ID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="Subcontractor_ID" id="Subcontractor_ID" required disabled>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($subcontractor_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['Subcontractor_ID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['SupplierName']; ?>"><?php echo $v['SupplierName']; ?></option>
                              <?php endforeach; ?>
                              </select>
			          </div>
		          </div> 
                  <div class="form-group">
                       <label  class="col-sm-3 control-label">Date</label>
			           <div class="col-sm-9">
                          <input class="form-control" id="Date" name="Date" onmouseover="ycsdate(this.id)" onkeypress="return onlyNumbernodecimal(event);" value="<?php if (isset($FmData[0]['Date']) && ($FmData[0]['Date']!='0000-00-00')){echo date('d-m-Y',strtotime($FmData[0]['Date']));} ?>"   placeholder="DD-MM-YYYY" data-date-format="DD-MM-YYYY"  type="text">
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
            