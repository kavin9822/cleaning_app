<?php 
 $pdf = $_SESSION['pdffile'];
// var_dump($pdf); 
?>





<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($title)){echo $title;} ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/bootstrap/css/bootstrap.min.css">
     <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/mfi.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/skins/skin-blue.min.css">
    
     <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datepicker/datepicker3.css">
      
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/select2/select2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css" media="print">
     @page { 
        size: auto;   /* auto is the initial value */    
        margin: 0;  /* this affects the margin in the printer settings */
     }    
    </style>
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">



      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo $home; ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?php echo $company_short_name; ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php if(isset($company_name)){echo $company_name;} ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                 <!--  Messages: style can be found in dropdown.less ,Note:to show mail count change id to mailcount-->
            <?php if($_SESSION){ ?>
              <li class="dropdown messages-menu">
                  <a href="<?php echo $home.'/'.'user/reg/mailbox'; ?>">
                  <i class="fa fa-envelope-o fa-lg"></i>
                  <span class="label label-success" id="mailcount" style="font-size:12px;"></span>
                </a>
                <!-- commented by me<a href="#" onclick="return false;">-->
                <!--  <i class="fa fa-envelope-o fa-lg"></i>-->
                <!--  <span class="label label-success" id="mailcounts" style="font-size:12px;"></span>-->
                <!--</a>-->
              </li> 
             <?php } ?>  
              <!-- Tasks Menu - put other menus here -->
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img style="margin-right: 10px;height:20px;" src="<?php echo $logo_image; ?>" class="user" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php if(isset($whoIsOnline)){echo $whoIsOnline;} ?></span>                  
                </a>              
                <?php echo $user_menu; ?>
              </li>   
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $logo_image; ?>" class="img-responsive" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php if(isset($whoIsOnline)){echo $whoIsOnline;} ?></p>
                <!-- Status -->
              <i class="fa fa-gears text-success"><?php if(isset($whoIsOnline_status)){echo $whoIsOnline_status;} ?></i>
            </div>
          </div>


          <!-- Sidebar Menu -->
          
          <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <?php 
            $rbumenu = $_SESSION['RoleBasedUserMenu'] ;
            // var_dump($rbumenu);
           
           
            
            //  var_dump($_SESSION);
                
            
             if(!empty($rbumenu)){echo $rbumenu;} 
             ?>
           
          </ul>             
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <!--<h1>-->
          <!--  <?php if(isset($page_header)){echo $page_header;} ?>-->
          <!--    <small style="color: #F39C12;font-weight: bold"><?php if(isset($message)){echo $message;} ?></small>-->
          <!--</h1>-->
          
          
          <!-- try to layout_chart in layout_datepicker start -->

               <div class="row">
                                  
                         <div class="col-md-8">
          <h3>
            <?php if(isset($page_header)){echo $page_header;} ?>
              <small style="color: #F39C12;font-weight: bold"><?php if(isset($message)){echo $message;} ?></small>
          </h3>
          </div>
          
            <div class="col-md-4">
                <?php  
            $enitytdetails = $_SESSION['AllEntityDetails'] ;  
           
             $entityID =  $_SESSION['user']['entity_ID'];
          
             if(!empty($enitytdetails)){ 
             ?>
             <div class="row">
                 <div class="col-md-2">
                    <div class="margin">
                        <label> Branch </label>
                     </div>
                 </div>

               

             <div class="col-md-4">
              <select class="form-control" name="entity_ID" id="entity_ID" disabled onchange=ChangeentityID('<?php echo $home ?>',this.value)>
                        <option value="" disabled selected style="display:none;" >Select</option>
                            <?php  foreach ($enitytdetails as $enitytdetails_value): ?>
                            
                            <?php   if ($enitytdetails_value['ID'] ==$entityID) {
                                      $isselected = 'selected="selected"';
                                  }else{
                                      $isselected = '';
                                  } ?> 
                                  
                                 <option   <?php echo $isselected; ?> value="<?php echo $enitytdetails_value['ID']; ?>" title="<?php echo $enitytdetails_value['Title']; ?>"><?php echo $enitytdetails_value['Title']; ?></option>
                                  
                            <?php endforeach; ?>
                        </select>
                        <?php } ?>
                        </div>
                        <div class="col-md-6">
                           <a  class="btn btn-primary" onclick="ChangeEntity()" > Change Branch </a>
                           </div>
                        </div>
                        </div>
          </div>


<!-- try to layout_chart in layout_datepicker end -->
          
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
        <?php if(isset($content )){echo $content;} ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer row no-print">
        <div class="pull-left"><strong>Copyright &copy; <?php echo date('Y'); ?> <a  target=\"_blank\" href="http://www.netkathir.com/">Netkathir Technologies Pvt.Ltd.</a></strong> All rights reserved.</div>
        <div class="pull-right" style="margin-right:15px;"><strong><a  target=\"_blank\" href="<?php echo $company_url; ?>"><?php echo $company_name; ?></a></strong></div>       
      </footer>
      <footer class="main-footer text-center visible-print-block">        
        <strong><a  target=\"_blank\" href="<?php echo $company_url; ?>"><?php echo $company_name; ?></a></strong></div>       
      </footer>
    
    </div><!-- ./wrapper -->
    
    
   


    <!-- REQUIRED JS SCRIPTS -->
 <script> 
    var basePath='<?php echo $home; ?>'; 
    var callmodal='<?php echo $callmodal; ?>';    
        </script>
        

    <!-- jQuery 2.1.4 -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/moment.min.js"></script>
      
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/app.min.js"></script>
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/my_site.js"></script>
   <!--newly added for script work on 12.03.2020-->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/mysite_1.js"></script>
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/doc_ready.js"></script>
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/docready1.js"></script>
   <!-- Select2 -->
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/select2/select2.min.js"></script>  
   <!-- Jquery DataTable -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
           <script>      
    $(document).ready(function() {
    var table = $('#example1').DataTable({
    'lengthMenu': [ [10, 25, 50], [10, 25, 50] ],
    'pageLength': 50,
    "bSortCellsTop": true,
    //disable sorting for first search column rows
    "aoColumnDefs" : [ {
            "bSortable" : false,
            "aTargets" : [ "sorting_disabled" ]
        } ],
    "paging":   false,
    "bInfo" : false
    }); 
    });
    </script>

<div class="modal" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="Button Information Modal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center text-success"><b><span style="color:#3c8dbc;font-size: 16px;">MFI</span></b></h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <input type="hidden" id="path" value='<?php $pdffile=$home.$pdf; echo $pdffile;?>'>
        <?php if($callmodal=='yes'){?>
        <!--<p id='alertbody'>Your Product has been updated successfully.</p>-->
        <embed id="pdffile" src="<?php echo $pdffile?>" frameborder="0" width="100%" height="400px">
       <?php }  ?>
       <?php //if($callmodal=='add'){?>
       <!-- <embed id="pdffile" src="<?php echo $pdffile?>" frameborder="0" width="100%" height="400px"> -->
        <?php// }  ?>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
         <div class="col-xs-12 col-md-12 col-sm-12 col-12 pb-3 mt-3">
         <div class="col-xs-4 col-md-4 col-sm-4 col-4" style="display:none"><b>Confirm To Send :</b></div>
        <div class="col-xs-4 col-md-4 col-sm-4 col-4"><button type="button" class="btn" style="background-color: #159F4C;color:#fff;font-size: 14px;padding: 3px 15px 2px 15px;display:none"  >Yes</button></div>
        <div class="col-xs-4 col-md-4 col-sm-4 col-4">
            <?php //if($formname=='Quotation'){
         echo '<a href="'.$home.'/purchase/pur/order"><button type="button" class="btn" style="background-color: #EFA221;color: #fff;font-size:14px;padding:3px 15px 2px 15px; display:none">No</button></a>';
           // }
          //  else{
        echo '<a href="'.$home.'/purchase/pur/order"><button type="button" class="btn" style="background-color: #EFA221;color: #fff;font-size:14px;padding:3px 15px 2px 15px; display:none">No</button></a>';
          //  }
            ?>
       </div>
        <!--<div class="col-sm-4 col-4"></div>-->
        </div>
         <a href="<?php echo $home; ?>/purchase/pur/order"><button class="btn btn-primary" >Ok</button></a> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AlertModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">                                 
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title text-center text-success"><b>MFI</b></h4>               
                                      </div>
                                      
                                      <!-- Modal body -->
                                      <div class="modal-body text-center">
                                        <p id='alertbody'></p>
                                      </div>
                                      
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button> 
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>      
      
  </body>
</html>