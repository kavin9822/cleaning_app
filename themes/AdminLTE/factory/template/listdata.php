<div class="row visible-print-block">
    <div class="col-md-12"><h2><img class="img" src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/img/user7-128x128.jpg" alt="Company Logo"><?php echo '   ';?><?php echo $company_name; ?></h2></div>            
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
                    <input tabindex="2" class="btn btn-info margin" type="submit" name="search" value="Search">  
                    <button class="btn btn-info margin" onclick="javascript:window.print()">Print</button>
                    <?php if ($wp): ?>
                        <?php if (!$update_form) : ?> <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Add"><?php endif; ?>
                        <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Edit">
                        <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Delete" onclick="return confirm('Are you sure you want to delete?');">  
                        <?php endif; ?>
                    <input class="btn btn-info margin" type="submit" name= "req_from_list_view" value="View"> 
                </div>
            </div>

            <div class="box-body">
                <div class="form-inline dt-bootstrap" id="example1_wrapper">

                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table aria-describedby="example1_info" role="grid" id="example1" class="table table-bordered table-striped table-responsive">
                                <thead  style="background-color:#ECF0F5;">
                                    <tr role="row">
                                        <!--<th width="50px"  class="hidden-print">Select</th>-->
                                        <!--<th width="50px">S.No</th>-->
                                        <th class="hidden-print sorting_disabled"><input type="checkbox" onclick="selectAll()"></th>
                                        <th>S.No</th>
                                            <?php
                                            if(!$ID_column_required){
                                                array_shift($table_columns_label_arr);
                                            }
                                            foreach ($table_columns_label_arr as $tab_columns) :
                                                ?>
                                            <th class="sorting_asc">
                                                <?php echo $tab_columns; ?>
                                            </th>
                                    <?php endforeach; ?>     
                                    </tr>
                                </thead>
                                <?php 
                                foreach($FmData as $k=>$v){
                                    if(strpos($k,'^')){
                                        unset($FmData[$k]);
                                    }
                                    $FmData[str_replace('^',' ',$k)] = $v;
                                }
                                     $frmDta = $FmData;               
                             ?>
                                <tbody >
                                    <tr class="odd hidden-print">   	
                                        <th style="width:30px;" class="sorting_disabled" colspan="2">
                                            <input tabindex="1" class="btn btn-info fa" type="submit" name="list" value="Clear" onclick="" /> 
                                        </th>
                                    <!--<tr class="odd hidden-print">   	-->
                                    <!--    <th width="50px"  class="hidden-print" colspan="2">-->
                                    <!--        <input tabindex="1" class="btn btn-info fa" type="submit" name="list" value="&#xf0ca;" onclick="<?php $FmData='';?>">  -->
                                    <!--        <button class="btn btn-sm btn-info" type="reset"><i class="fa fa-undo"></i></button>  -->
                                    <!--    </th>-->
                                            <?php 
                                            if(!$ID_column_required){
                                                array_shift($selectColArr);
                                            }
                                            foreach ($selectColArr as $selectColArrVal) : ?> 
                                            
                                            <th class="sorting_disabled">
                                                <?php if(strpos($selectColArrVal, 'Date') !== false){ 
                                                preg_match('#\.(.*?)\,#', $selectColArrVal, $match); $idd = $match[1];
                                                ?>
                                                <input  style="width:100%;" class="form-control input-sm" type="text" id="<?php echo $idd; ?>" name="<?php echo str_replace(' ', '^', $selectColArrVal); ?>" data-provide="datetimepicker" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)" onmouseover="ycsdate(this.id)" onfocus="ycsdate(this.id)" autocomplete="off" value="<?php if(isset($frmDta[str_replace('.', '_', $selectColArrVal)])){ echo $frmDta[str_replace('.', '_', $selectColArrVal)]; }?>">
                                                <?php }  else { ?>
                                                <input  style="width:100%;" class="form-control input-sm" type="text" name="<?php echo str_replace(' ', '^', $selectColArrVal); ?>" value="<?php if(isset($frmDta[str_replace('.', '_', $selectColArrVal)])){ echo $frmDta[str_replace('.', '_', $selectColArrVal)]; }?>" >
                                                <?php } ?>
                                            </th>
                                    <?php endforeach; ?>     
                                    </tr>
                                    <?php if(empty($sql_data_rows)){ ?>
                                            <tr><td colspan="<?php echo count($selectColArr)+1; ?>"><h3 style="color:red;" class="text-center">No records found!</h3><td><tr>
                                    <?php } ?>
                                        
                                    <?php foreach ($sql_data_rows as $key => $sql_data_value) : ?>
                                    
                                    <tr class="table-striped" role="row" >
                                            
                                            <td class="hidden-print"><input style="width: 20px;" type="checkbox" name ="ycs_ID[]" value="<?php echo $sql_data_value[0]; ?>"></td>
                                            <td><?php echo ($key+1)+($results_per_page*($current_page-1)); ?></td>
                                            <?php
                                            //To remove id column from the list
                                            if(!$ID_column_required){
                                                array_shift($sql_data_value);
                                            }
                                            
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
                                        <th colspan="8">
                                        <!--<th colspan="<?php echo count($table_columns_label_arr) + 2; ?>" rowspan="1">-->
                                                <?php if ($wp): ?>
                                                <?php if (!$update_form) : ?> <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Add"><?php endif; ?>
                                                <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Edit" onclick="return restrictCheck('edit!');">>
                                                <input class="btn btn-info margin" type="submit" name = "req_from_list_view" value="Delete" onclick="return confirm('Are you sure you want to delete?');">  
                                                <?php endif; ?>
                                            <input class="btn btn-info margin" type="submit" name= "req_from_list_view" value="View" onclick="return restrictCheck('edit!');"> 

                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                  <!-- pagination part can come here -->
                
                </div>
            </div><!-- /.box-body -->
            
            
            <?php 
            
            // Used by paginationHTML below...
function paginationLink($p, $page, $URL)
{
  if ($p==$page) return '<input type="submit" class="btn btn-primary" name="pageno" value="' . $p . '">';
  return '<input type="submit" class="btn" name="pageno" value="' . $p . '">';
}


// Used by paginationHTML below...
function paginationGap($p1, $p2)
{
  $x = $p2-$p1;
  if ($x==0) return '';
  if ($x==1) return ' ';
  if ($x<=10) return ' . ';
  if ($x<=100) return ' .. ';
  return ' ... ';
}


// URL requires the $page number be appended to it.
// e.g. it should end in '&page=' or something similar.
function paginationHTML($page, $lastPage)
{
  $LINKS_PER_STEP = 2;
  $result ='<div class="col-md-2 form-group"> 
       <div class="input-group input-group-sm">
                <input type="number" class="form-control" name="pagenogo" id="pagenogo" value="">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-info btn-flat" name="pagenog" value="Go!" onclick="return restrictPage(' .$lastPage . ')">
                    </span>
              </div></div>';  
  // Nav buttons
  if ($page>1){
        $result .= '<div class="row"><div class="col-md-2"><input type="hidden" name="pagenofirst" value="1"><input type="submit" class="btn"  name="pagenof" value="&lt;&lt;">&nbsp;'
                  .'<input type="hidden" name="pagenoprev" value="' .($page-1) . '"><input type="submit"  name="pagenop" class="btn" value="&lt;">';
  }else{  $result .= '<div class="row"><div class="col-md-2"><input class="btn" type="button" value="&lt;&lt;" disabled>&nbsp;<input class="btn" type="button" value="&lt;" disabled>';}
         $result .= '&nbsp;&nbsp;' . $page . '&nbsp;&nbsp;';
  if ($page<$lastPage)
         $result .= '<input type="hidden" name="pagenonext" value="' .($page+1) . '"><input class="btn" type="submit" name="pagenon" value="&gt;">&nbsp;' .
                  '<input type="hidden" name="pagenolast" value="' .$lastPage . '"><input class="btn" type="submit" name="pagenol" value="&gt;&gt;"></div>&emsp;';
  else  $result .= '<input class="btn" type="button" value="&gt;" disabled>&nbsp;<input class="btn" type="button" value="&gt;&gt;" disabled></div>&emsp;';
     

  // Now calculate page links...
  $lastp1 = 1;
  $lastp2 = $page;
  $p1 = 1;
  $p2 = $page;
  $c1 = $LINKS_PER_STEP+1;
  $c2 = $LINKS_PER_STEP+1;
  $s1 = '';
  $s2 = '';
  $step = 1;
  while (true)
  {
    if ($c1>=$c2)
    {
      $s1 .= paginationGap($lastp1,$p1) . paginationLink($p1,$page,$URL);
      $lastp1 = $p1;
      $p1 += $step;
      $c1--;
    }
    else
    {
      $s2 = paginationLink($p2,$page,$URL) . paginationGap($p2,$lastp2) . $s2;
      $lastp2 = $p2;
      $p2 -= $step;
      $c2--;
    }
    if ($c2==0)
    {
      $step *= 10;
      $p1 += $step-1;         // Round UP to nearest multiple of $step
      $p1 -= ($p1 % $step);
      $p2 -= ($p2 % $step);   // Round DOWN to nearest multiple of $step
      $c1 = $LINKS_PER_STEP;
      $c2 = $LINKS_PER_STEP;
    }
    if ($p1>$p2)
    {
      $result .= $s1 . paginationGap($lastp1,$lastp2) . $s2;
      if (($lastp2>$page)||($page>=$lastPage)) return $result;
      $lastp1 = $page;
      $lastp2 = $lastPage;
      $p1 = $page+1;
      $p2 = $lastPage;
      $c1 = $LINKS_PER_STEP;
      $c2 = $LINKS_PER_STEP+1;
      $s1 = '';
      $s2 = '';
      $step = 1;
    }
  }
   
}
            ?>
            <?php if($whereString=='no'){ ?>
            <?=paginationHTML($current_page,$no_of_pages); ?>
            <?php } ?>
        </form>
    </div>
    
<!-- /.Print footer -->    
<div class="col-lg-10 visible-print-block">
        <h3 class="widget-user-username text-right">Signature</h3>
</div><!-- /header -->
