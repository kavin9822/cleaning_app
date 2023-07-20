<?php
include_once 'util/php-export-data.class.php';
$data=date("d-m-Y-H-i-a");
$excel = new ExportDataExcel('file','./resource/report/stock_'.$data.'.xls');
// $ajxSess = new Session();
// $userEntityId = $ajxSess->get('user')['entity_ID'];	
// $userId = $ajxSess->get('user')['ID'];
// $excel->filename = "./resource/report/list.xls";
?>

<div class="row visible-print-block">
    <!--<div class="col-md-12"><img class="img" src="<?php if(!empty($themePath)){echo $themePath;} ?>/dist/img/user7-128x128.jpg" alt="User Avatar">-->
     <div class="col-md-12"><img class="img" src="<?php echo $logo_image; ?>" alt="User Avatar">
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

        <form class="form-horizontal" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>" method="post" id="stock">

            <div class="row hidden-print">
                <div class="col-md-3 hidden-xs"><?php if(!empty($widget_1)){echo $widget_1;} ?></div>
                <div class="col-md-4 col-xs-5"><?php if(!empty($widget_2)){echo $widget_2;} ?></div>
                <div class="col-md-5 col-xs-7 text-right">
                    <!--<input tabindex="2" style="margin-right: 10px; margin-left: 10px" class="btn btn-info" type="submit" name="search" value="Search">  -->
                    
                    <!--<a href="<?php echo $home;?>/invoice/sch/orderedit"><input type="button" class="btn btn-info margin" value="Edit" onclick="return confirm('Are you sure you want to clear the complete list?');"></a>-->
                    <?php if ($wp): ?>
                    <?php //if(isset($NeedClear)){?>
                    <?php //} 
                    if(isset($NeedSearch)){?>
                    <input class="btn btn-info margin" type="submit"  value="Search" name="search">  
                    <?php } ?>
                    <input class="btn btn-info margin" type="submit" name ="req_from_list_view" value="Reset" onclick="document.getElementById('stock').reset();<?php $FmData='';?>">
                    <!--<button class="btn btn-info margin" onclick="javascript:window.print()">Print</button>-->
                    
                    <?php if(count($sql_data_rows)>0){?>
                    <a href="<?php echo $home;?>/resource/report/stock_<?php echo $data?>.xls" download><input type="button" class="btn btn-success margin" value="Download Report"></a>
                    <?php } ?>
                     <!--<a href="<?php echo $home;?>/invoice/sch/download3"><input type="button" class="btn btn-success margin" value="Download Reporttttt"></a>	-->
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
                                        <th class="sorting_disabled hidden-print" style="width:100px"><input type="checkbox" onclick="selectAll()"></th>
                                        <th style="width:100px">S.No</th>
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
                                <tbody id="box">
                                 
                              <h3 class="text-center"></h3>
    
				                <?php $excel->initialize(); ?>
				                
                                <?php 
                                 
                                $companyname=array("$Company_title");
                                 
                                 $excel->addRow($companyname); 
                                  
                               
                                $title=array("$page_title");
                                 
                                 $excel->addRow($title); 
                                 
                                 //$excel->addRow($img); 
                                        $a1=array("S.No");
                                        $a2=$table_columns;
                                 $excel->addRow(array_merge($a1,$a2));
                                ?>	
                                <?php $k=1 ?>			
                                
                                 <?php foreach ($sql_data_rows as $key1 => $sql_data_value1) {
                                    $sql_data_value1[0]=$k;
                                        $k++;
                                    ?>
                                    <?php $excel->addRow($sql_data_value1); ?>
                                      <?php } ?>
                                      
                                    <?php foreach ($sql_data_rows as $key => $sql_data_value) : ?>
                                   
                                        <?php
                                        $cls = 'odd';
                                        
                                     
                                        if ($key % 2 == 0) {
                                            $cls = 'even';
                                        }
                                        ?>    
                                                                     
                                     
                                    <tr class="<?php if(isset($cls)){echo $cls;} ?>" role="row" >
                                           
                                            <td class="hidden-print"><input style="width: 20px;" type="checkbox" name ="ycs_ID[]" value="<?php echo $sql_data_value[0]; ?>"></td>
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
