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
					       <?php if($mode=='add') {?>
			               <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                              <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EnquiryID" id="EnquiryID" onchange="Fetch_tender_evaluation_Data(this.value,'tender','tenderdetail','TenderNo','ClosingDateTime','Title','PLCod','Description','Qty','TenderNo','ClosingDateTime','Title','PLCod','Description','Qty')" tabindex="1" required>
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($enquiry_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['EnquiryID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
						   <?php }else {?>
						       <?php if(isset($FmData[0]['EnquiryID'])) { ?>
                              <input id="EnquiryID" name="EnquiryID" value="<?php if($FmData[0]['EnquiryID']){echo $FmData[0]['EnquiryID'];}?>"  type="hidden">
                              <select class="form-control js-example-basic-single" name="EnquiryID" id="EnquiryID" disabled>
                              <?php }else { ?>
					          <select class="form-control" name="EnquiryID" id="EnquiryID" tabindex="1">
							  <?php } ?>
                              <option value="" disabled selected style="display:none;">Select</option>
                              <?php foreach ($enquiry1_data as $k => $v): 
                              if ($v['ID'] == $FmData[0]['EnquiryID']) {
                              $isselected = 'selected="selected"';
                              }else{
                              $isselected = '';
                              }
                              ?>
                              <option <?php echo $isselected; ?> value="<?php echo $v['ID']; ?>" title="<?php echo $v['EnquiryNo']; ?>"><?php echo $v['EnquiryNo']; ?></option>
                              <?php endforeach; ?>
                              </select>
						   <?php }?>
						   
			          </div>
		          </div>
			        <div class="form-group">
                       <label  class="col-sm-3 control-label">Closing date & time</label>
			           <div class="col-sm-9">
			                <input class="form-control" id="ClosingDateTime" name="ClosingDateTime" value="<?php echo $FmData[0]['ClosingDateTime'];?>" type="text" tabindex="3" readonly>
			           </div>
		          </div>
				</div> 
			   <div class="col-lg-6">
			         <div class="form-group">
                       <label  class="col-sm-3 control-label">Tender Number</label>
			           <div class="col-sm-9">
					       <input class="form-control" id="TenderNo" name="TenderNo" value="<?php echo $FmData[0]['TenderNo'];?>" type="text" tabindex="2" readonly>  
			          </div>
		          </div>
				   <div class="form-group">
				      <label  class="col-sm-3 control-label">Evaluation Document</label>
			            <div class="col-sm-9">
						   <?php if($mode=='add'){?>
						   <input class="form-control" id="Description_Proof" name="Description_Proof" value="<?php echo $FmData[0]['Description_Proof'];?>" type="file" onclick="show_imagelabel()" required>
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['Description_Proof']; ?>" width="100px";>-->
						   <?php }else{?>
						   <input class="form-control" id="Description_Proof" name="Description_Proof" value="<?php echo $FmData[0]['Description_Proof'];?>" type="file" onclick="show_imagelabel()">
						    <!--	<img src="<?php echo $home.'/'.$FmData[0]['Description_Proof']; ?>" width="100px";>-->
						    <?php }?>
					      </div>
		               </div>
					    <?php if($mode=='edit' && !empty($FmData[0]['Description_Proof'])){ ?>
                        <div class="form-group">
                          <label  class="col-sm-3 control-label"></label>
                           <div class="col-sm-9">
                          <a target="_blank" title="To view click here" href="<?php echo $home.'/'.$FmData[0]['Description_Proof'];?>"><?php echo ltrim($FmData[0]['Description_Proof'],'resource/images/.');?></a>
                           </div>
                       </div>
                        <?php }elseif($mode=='view' && !empty($FmData[0]['Description_Proof'])){ ?>
                        <div class="form-group">
                           <label  class="col-sm-3 control-label"></label>
                           <div class="col-sm-9">
                          <a target="_blank" href="<?php echo $home.'/'.$FmData[0]['Description_Proof'];?>"><?php echo ltrim($FmData[0]['Description_Proof'],'resource/images/.');?></a>
                           </div>
                       </div>
                       <?php }?>
			       </div>
		        </div>
				<div class="row" style="margin:20px;border:1px solid black;">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped"  id ="tenderdetail" >
                    <thead>
                        <tr>
                            
                            <th>Title</th>
                            <th>PL code</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            </tr>
                    </thead>
                    <tbody>  
					        <?php 
                                foreach ($FmData as $value ):
                            ?>
  					<tr  id ="tender_row">
					 <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Title" name="Title"  value="<?php echo $value['Title'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="PLCod" name="PLCod" value="<?php echo $value['PLCod'];?>" readonly>
                          </div>
         	            </div>
                     </td>
                     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Description" name="Description" value="<?php echo $value['Description'];?>" readonly>
                          </div>
         	           </div>
                     </td> 
				     <td>                                      
                       <div class="form-group">
                        <div class="col-sm-12">
                           <input class="form-control" type="text" id="Qty" name="Qty" value="<?php echo $value['Qty'];?>" readonly>
                          </div>
         	           </div>
                      </td>  
                  </tr>
				  <?php
				  endforeach;
				  ?>
                </tbody>
                </table> 
            </div><!-- /.col -->
        </div><!-- /.row -->
				
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
                <button type ="submit" class="btn btn-success pull-right btnSubmit" name="add_submit_button" value="add"> Submit </button>
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
            