<div class="row visible-print-block">
    <div class="col-md-4"><img class="img-circle" src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/img/user7-128x128.jpg" alt="User Avatar"></div>            
    <div class="col-md-4">
        <h3 class="widget-user-username text-center"><?php if(isset($report_title)){echo $report_title;} ?></h3>
       <h5 class="widget-user-desc  text-center"><?php if(isset($report_desc)){echo $report_desc;} ?></h5>
    </div>
    <div class="col-md-4"></div>
</div><!-- /header -->

<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title  hidden-print"><?php if(isset($form_title)){echo $form_title;} ?></h3>

        <form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">

            <div class="row hidden-print">
                <div class="col-md-2 hidden-xs"><?php if(isset($widget_1)){echo $widget_1;} ?></div>
                <div class="col-md-2 col-xs-2"><?php if(isset($widget_2)){echo $widget_2;} ?></div>
                <div class="col-md-8 col-xs-10 text-right">
                    <input tabindex="2" style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name="search" value="Search">  
                    <button class="btn btn-info" onclick="javascript:window.print()">Print</button>
                    <input style="margin-right: 10px; margin-left: 10px;" class="btn btn-info" type="submit" name = "req_from_list_view" value="Edit">
                        <?php if ($wp): ?>
                        <?php if (!$update_form) : ?> <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Register with SmartGuard"><?php endif; ?>
                        
                        <?php endif; ?>
                </div>
            </div>

            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap" id="example1_wrapper">

                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table aria-describedby="example1_info" role="grid" id="example1" class="table table-bordered table-striped dataTable table-responsive">
                                <thead  style="background-color:#ECF0F5;">
                                    <tr role="row">
                                        <th width="50px"  class="hidden-print">Select</th>
                                        <th width="50px">S.No</th>
                                            <?php
                                            foreach ($table_columns_label_arr as $tab_columns) :
                                                ?>
                                            <th colspan="1" rowspan="1" class="sorting_asc">
                                                <?php echo $tab_columns; ?>
                                            </th>
                                    <?php endforeach; ?>     
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd hidden-print">
                                        <th width="50px"  class="hidden-print" colspan="2">
                                            <input tabindex="1" style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name="search" value="Search">  
                                        </th>
                                            <?php foreach ($selectColArr as $selectColArrVal) : ?>
                                            <td colspan="1" rowspan="1" class="sorting_asc">
                                                <input style="width: 100%" class="form-control" type="text" name ="<?php echo $selectColArrVal; ?>" value="">
                                            </td>
                                    <?php endforeach; ?>     
                                    </tr>
                                    <?php foreach ($sql_data_rows as $key => $sql_data_value) : ?>
                                        
                                    <tr class="table-striped" role="row" >
                                            <td class="hidden-print">
                                             <?php  if(end($sql_data_value) !== 'YES'): ?>
                                                <input style="width: 20px;" type="radio" name ="ycs_ID" value="<?php echo $sql_data_value[0]; ?>">
                                             <?php else:?>  
                                                <i class="fa fa-check-square fa-lg" style="color:#4CAF50;" aria-hidden="true"></i>
                                             <?php endif; ?>   
                                            </td>
                                            <td><?php echo $key + 1; ?></td>
                                            <?php
                                            foreach ($sql_data_value as $sql_value) :
                                                ?>
                                                <td><?php echo $sql_value; ?></td>                                                    

                                                <?php
                                                
                                            endforeach;
                                            ?>
                                        </tr>
                                            <?php endforeach; ?>
                                </tbody>
                                <tfoot style="background-color:#ECF0F5;">
                                    <tr class=" text-right  hidden-print">
                                        <th colspan="<?php echo count($table_columns_label_arr) + 2; ?>" rowspan="1">
                                                <input style="margin-right: 20px; margin-left: 20px;" class="btn btn-info" type="submit" name = "req_from_list_view" value="Edit">
                                                <?php if ($wp): ?>
                                                <?php if (!$update_form) : ?> 
                                                <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Register with SmartGuard"><?php endif; ?>
                                                <?php endif; ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                  <!-- pagination part can come here -->
                
                </div>
            </div><!-- /.box-body -->
        </form>
    </div>
    
<!-- /.Print footer -->    
<div class="col-lg-10 visible-print-block">
        <h3 class="widget-user-username text-right">Signature</h3>
</div><!-- /header -->
