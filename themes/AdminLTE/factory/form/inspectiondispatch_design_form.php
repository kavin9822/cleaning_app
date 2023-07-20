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
                       <label  class="col-sm-3 control-label">Plan type</label>
			           <div class="col-sm-9">
                       <select class="form-control" name="PlanType" id="PlanType" required> 
                            <option value="" disabled selected style="display:none;">Select</option>
                            <option <?php  if(isset($FmData[0]['PlanType']) && $FmData[0]['PlanType']=='Inspection'){echo 'selected="selected"';} ?> value="Inspection" title="Inspection">Inspection</option>
                            <option <?php if(isset($FmData[0]['PlanType']) && $FmData[0]['PlanType']=='Dispatch'){echo 'selected="selected"';} ?> value="Dispatch" title="Dispatch">Dispatch</option>
                        </select>
			          </div>
		          </div>
		            <div class="form-group">
                       <label  class="col-sm-3 control-label">PO Reference</label>
			           <div class="col-sm-9">
                         <input class="form-control" id="PoReference" name="PoReference" value="<?php echo $FmData[0]['PoReference'];?>" type="text" >
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
                         <input class="form-control" id="Unit" name="Unit" value="<?php echo $FmData[0]['Unit'];?>" type="text" onkeypress="return onlyNumbernodecimal(event);" >
			          </div>
		          </div>
			
			   </div>
			   <div class="col-lg-6">
               <div class="form-group" style="margin-top:47px">
                       <label  class="col-sm-3 control-label">Description of PO</label>
			           <div class="col-sm-9">
                          <input class="form-control" id="Descriptionofpo" name="Descriptionofpo" value="<?php echo $FmData[0]['Descriptionofpo'];?>" type="text" >
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
            