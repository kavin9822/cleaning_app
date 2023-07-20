<?php
include_once 'util/php-export-data.class.php';
$excel = new ExportDataExcel('file');

$ajxSess = new Session();
$userEntityId = $ajxSess->get('user')['entity_ID'];	
$userId = $ajxSess->get('user')['ID'];
$excel->filename = "/resource/report/$userEntityId-$userId-customerlist.xls";
?>

<div class="row visible-print-block">
    <div class="col-md-12"><img class="img" src="<?php if(!empty($themePath)){echo $themePath;} ?>/dist/img/user7-128x128.jpg" alt="User Avatar">
        &ensp;&emsp;   <h2 class="widget-user-username text-center" style="display:inline-block"><?php {echo $company_name;} ?></h2>
    </div>            
    <div class="col-md-12">
        <h3 class="widget-user-username text-center"><?php if(!empty($report_title)){echo $report_title;} ?></h3>
       <h5 class="widget-user-desc  text-center"><?php if(!empty($report_desc)){echo $report_desc;} ?></h5>
    </div>
</div><!-- /header -->

<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title  hidden-print"><?php if(!empty($form_title)){echo $form_title;} ?></h3>

        <form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post">

            <div class="row hidden-print">
                <div class="col-md-3 hidden-xs"><?php if(!empty($widget_1)){echo $widget_1;} ?></div>
                <div class="col-md-5 col-xs-5"><?php if(!empty($widget_2)){echo $widget_2;} ?></div>
                <div class="col-md-4 col-xs-7 text-right">
                    <input tabindex="2" style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name="search" value="Search">  
                    <button class="btn btn-info" onclick="javascript:window.print()">Print</button>
                    <?php if ($wp): ?>
                    <a href="http://crm.spit.co.in/resource/report/<?php echo $userEntityId; ?>-<?php echo $userId; ?>-customerlist.xls" download><input type="button" class="btn btn-success" value="Download Report"></a>	
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
                                        <th width="25px">S.No</th>
                                            <?php
                                            if(!$ID_column_required){
                                                array_shift($table_columns);
                                            }
                                            $i = 3;
                                            foreach ($table_columns as $tab_columns) :
                                                ?>
                                            <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 150px;" colspan="1" rowspan="1" aria-controls="example1" tabindex="0" class="sorting_asc">
                                                <?php
                                                if ($tab_columns) {
                                                    echo $tab_columns;
                                                } else {
                                                    echo $tab_columns;
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
				<?php $excel->initialize(); ?>
                                <?php $excel->addRow($table_columns); ?>				                              
                                    <?php foreach ($sql_data_rows as $key => $sql_data_value) : ?>
                                        <?php
                                        $cls = 'odd';
                                        if ($key % 2 == 0) {
                                            $cls = 'even';
                                        }
                                        ?>    
                                                                     
                                     <?php $excel->addRow($sql_data_value); ?>
                                    <tr class="<?php if(isset($cls)){echo $cls;} ?>" role="row" >
                                            
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


                                            foreach ($sql_data_value as $sql_Key => $sql_value) :

                                                  if(!empty($FKEY) && $FKEY == $sql_Key):   
                                                ?>
                                       <td><?php if(array_key_exists($sql_value,$FKEYVAL)){echo $FKEYVAL[$sql_value] .'('.$sql_value.')' ;} ?></td>
                                                  
                                                  <?php elseif(!empty($FKEY1) && $FKEY1 == $sql_Key ): ?>

                                         <td><?php if(array_key_exists($sql_value,$FKEYVAL1)){ echo $FKEYVAL1[$sql_value] . '('.$sql_value.')' ;} ?></td>  
                                                  <?php else: ?>
                                                   <td><?php if(!empty($sql_value)){echo $sql_value;} ?></td>   
                                                  <?php endif; ?>                                              

                                                <?php
                                                if ($i == $cols_limit) {
                                                    break;
                                                }
                                                $i++;
                                            endforeach;
                                            ?>
                                        </tr>
                                            <?php endforeach; ?>
                                          <?php  $excel->finalize(); ?>
                                </tbody>
                                
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
