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
                <div class="col-xs-4"><?php if(isset($widget_2)){echo $widget_2;} ?></div>
                <div class="col-xs-8 text-right">
                    <button class="btn btn-info" onclick="javascript:window.print()">Print</button>
                    <?php if ($wp): ?>
                        <?php if (!$update_form) : ?> <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Add"><?php endif; ?>
                        <input style="margin-right: 10px; margin-left: 10px;" class="btn btn-info" type="submit" name = "req_from_list_view" value="Edit">
                        <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Delete">
                        <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Reset" onclick ="if(!confirm('Are you sure !\nYou want to reset to the Roles\nThis will remove all the roles and set only Root Role')){return false;}">  
                        <?php endif; ?>
                    <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name= "req_from_list_view" value="View"> 
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
                                            if(!$ID_column_required){
                                                array_shift($table_columns);
                                            }
                                            $i = 3;
                                            foreach ($table_columns as $tab_columns) :
                                                ?>
                                            <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 150px;" colspan="1" rowspan="1" aria-controls="example1" tabindex="0" class="sorting_asc">
                                                <?php
                                                if ($form_content_data[$tab_columns]['label']) {
                                                    echo $form_content_data[$tab_columns]['label'];
                                                } else {
                                                    echo $form_content_data[$tab_columns];
                                                }
                                                
                                                if ($i == $cols_limit) {
                                                    break;
                                                }
                                                $i++;
                                                ?>

                                            </th>
                                    <?php endforeach; ?>     
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hidden-print">
                                        <td colspan="2"> <input style="width: 80px" class="btn btn-primary btn-sm" name="clr" value="Clear" type="text" onclick="ManageQueryFilter('<?php echo $tableName_wo_prefix; ?>','<?php echo $home; ?>','','clear')"></td>
                                        <?php echo $filter_form; ?>
                                    </tr>

                                    <?php foreach ($sql_data_rows as $key => $sql_data_value) : ?>
                                       
                                    <tr role="row" >
                                            <td class="hidden-print"><input style="width: 20px;" type="radio" name ="ycs_ID" value="<?php echo $sql_data_value['ID']; ?>"></td>
                                            <td><?php echo $key + 1; ?></td>
                                            <?php
                                            //$total_no_cols = count($sql_data_value);
                                            //To remove id column from the list
                                            if(!$ID_column_required){
                                                array_shift($sql_data_value);
                                            }
                                            
                                            ?>

                                            <?php
                                            $i = 3;
                                            foreach ($sql_data_value as $sql_value) :
                                                ?>
                                                <td><?php echo $sql_value; ?></td>

                                                <?php
                                                if ($i == $cols_limit) {
                                                    break;
                                                }
                                                $i++;
                                            endforeach;
                                            ?>
                                        </tr>
                                            <?php endforeach; ?>
                                </tbody>
                                <tfoot style="background-color:#ECF0F5;">
                                    <tr class=" text-right  hidden-print">
                                        <th colspan="<?php echo $cols_limit + 1; ?>" rowspan="1">
                                        <button class="btn btn-info" onclick="javascript:window.print()">Print</button>
                                                <?php if ($wp): ?>
                                                <?php if (!$update_form) : ?> <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Add"><?php endif; ?>
                                                <input style="margin-right: 20px; margin-left: 20px;" class="btn btn-info" type="submit" name = "req_from_list_view" value="Edit">
                                                <input style="margin-right: 20px; margin-left: 20px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Delete">
                                                <input style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name = "req_from_list_view" value="Reset" onclick ="if(!confirm('Are you sure !\nYou want to reset to the Roles\nThis will remove all the roles and set only Root Role')){return false;}">    
                                                <?php endif; ?>
                                            <input style="margin-right: 20px; margin-left: 20px" class="btn btn-info" type="submit" name= "req_from_list_view" value="View"> 

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
