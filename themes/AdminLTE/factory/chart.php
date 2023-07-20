<section class="content-header">
    <h1 class="text-center"><?php echo $company_name; ?> Dashboard</h1>       
    <ol class="breadcrumb">
        <li><a href="<?php echo $home; ?>/user/reg/dashboard"><i class="fa fa-table"></i> View on table</a></li>        
    </ol>  
</section>
<br/>
<section class="content">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Customer vs Joined & Projected - Area Chart</h3>              
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height: 250px; width: 510px;" width="510" height="250"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Order count - stage wise</h3>              
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height: 265px; width: 530px;" width="530" height="265"></canvas>
              <div class="row">
                          <div class="col-md-4"><span style="float:left;display: block"> PPC - </span><span style="margin-left:10px;width:30px;height:10px;background:#f56954;float: left; margin-top: 5px;"></span></div>
<div class="col-md-4"><span style="float:left; display: block"> Store - </span><span style="margin-left:10px;width:30px;height:10px;background:#00a65a;float: left; margin-top: 5px;"></span></div>
<div class="col-md-4"><span style="float:left; display: block"> Manufacturing - </span><span style="margin-left:10px;width:30px;height:10px;background:#f39c12;float: left; margin-top: 5px;"></span></div>
</div><div class="row">
<div class="col-md-4"><span style="float:left;display: block"> QA - </span><span style="margin-left:10px;width:30px;height:10px;background:#00c0ef;float: left; margin-top: 5px;"></span></div>
<div class="col-md-4"><span style="float:left; display: block"> FinishedGoods - </span><span style="margin-left:10px;width:30px;height:10px;background:#3c8dbc;float: left; margin-top: 5px;"></span></div>
<div class="col-md-4"><span style="float:left; display: block"> Despatched - </span><span style="margin-left:10px;width:30px;height:10px;background:#d2d6de;float: left; margin-top: 5px;"></span></div>
  </div>            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-xs-12 col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Products sales current & projected - Line Chart</h3>             
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height: 250px; width: 510px;" width="510" height="250"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Product wise despatched quantity</h3>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;" width="509" height="300"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div style="position: absolute; max-width: 84px; top: 282px; left: 23px; text-align: center;" class="flot-tick-label tickLabel">January</div><div style="position: absolute; max-width: 84px; top: 282px; left: 106px; text-align: center;" class="flot-tick-label tickLabel">February</div><div style="position: absolute; max-width: 84px; top: 282px; left: 197px; text-align: center;" class="flot-tick-label tickLabel">March</div><div style="position: absolute; max-width: 84px; top: 282px; left: 286px; text-align: center;" class="flot-tick-label tickLabel">April</div><div style="position: absolute; max-width: 84px; top: 282px; left: 372px; text-align: center;" class="flot-tick-label tickLabel">May</div><div style="position: absolute; max-width: 84px; top: 282px; left: 454px; text-align: center;" class="flot-tick-label tickLabel">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div style="position: absolute; top: 269px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">0</div><div style="position: absolute; top: 202px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">5</div><div style="position: absolute; top: 135px; left: 1px; text-align: right;" class="flot-tick-label tickLabel">10</div><div style="position: absolute; top: 68px; left: 1px; text-align: right;" class="flot-tick-label tickLabel">15</div><div style="position: absolute; top: 1px; left: 1px; text-align: right;" class="flot-tick-label tickLabel">20</div></div></div><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;" width="509" height="300"></canvas></div>
            </div>
            <!-- /.box-body -->
           
            
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    
</section>