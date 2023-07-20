<!--<form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">-->

    <div class="row" >
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">FROM Month/Year</label>
				<div class="col-sm-8">
                <input class="form-control" id="start_date" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="start_date" value="<?php if(isset($FmData[0]['start_date']) && $FmData[0]['start_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['start_date']));}?>" type="text"> 
                    </div>
			</div>
		</div>
			
		
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">TO Month/Year</label>
                <div class="col-sm-8">
                <input class="form-control" id="end_date" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="end_date" value="<?php if(isset($FmData[0]['end_date']) && $FmData[0]['end_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['end_date']));}?>" type="text"> 
				
                </div>
			</div>
		</div>
		</div>

<!--</form>-->

<!-- <div class="row" >
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">FROM Month/Year</label>
				<div class="col-sm-8">
                <input class="form-control" id="start_date" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="start_date" value="<?php if(isset($FmData[0]['start_date']) && $FmData[0]['start_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['start_date']));}?>" type="text"> 
                    </div>
			</div>
		</div>
			
		
		<div class="col-sm-6">	
        <div class="form-group">
				<label class="col-sm-4 control-label">TO Month/Year</label>
                <div class="col-sm-8">
                <input class="form-control" id="end_date" autocomplete="off" data-provide="datetimepicker" onkeypress="return onlyNumbernodecimal(event)" onmouseover="ycsdate(this.id)" data-date-format="DD-MM-YYYY" name="end_date" value="<?php if(isset($FmData[0]['end_date']) && $FmData[0]['end_date']!='0000-00-00'){echo date('d-m-Y',strtotime($FmData[0]['end_date']));}?>" type="text"> 
				
                </div>
			</div>
		</div>
		</div>	 -->