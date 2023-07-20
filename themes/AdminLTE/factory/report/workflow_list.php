<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo $invoice_logo; ?>" class="img" alt="Company Logo" style="width:12%"> &nbsp;
                    <?php echo $page_title; ?>
                    <small class="pull-right">Date: <?php echo date('d/M/Y') ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        
<div class="row">
    <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th>S.No.</th>
                  <th>PurchaseOrder No.</th>
                  <th>Customer</th>
                  <th>Batch No.</th>
                  <th>PurchaseOrder Date</th>
                  <th>Stage</th>
                </tr>
                <?php $i=1;foreach($flow_data as $k=>$v) { ?>
       
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $v['PurchaseOrderNo'];?></td>
                  <td><?php echo $v['FirstName'];?></td>
                  <td><?php echo $v['BatchNo']; ?></td>
                  <td><?php echo $v['PurchaseOrderDate']; ?></td>
                  <td><?php echo $v['Stage']; ?></td>
                </tr>
                
                <?php $i++; } ?>
              </tbody></table>
            </div>
    
</div>
    </form>

</section>
