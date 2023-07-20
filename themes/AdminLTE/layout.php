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
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/iCheck/flat/blue.css">
  
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/skins/skin-blue.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/select2/select2.min.css">
       <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/dist/css/skins/skin-blue.min.css">
        <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datepicker/datepicker3.css">
      
    <link rel="stylesheet" href="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
              <!--  Messages: style can be found in dropdown.less,Note:to show mail count change id to mailcount -->
              <li class="dropdown messages-menu">
                <!-- commented by me <a href="<?php echo $home.'/'.'user/reg/mailbox'; ?>">-->
                <!--  <i class="fa fa-envelope-o fa-lg"></i>-->
                <!--  <span class="label label-success" id="mailcount" style="font-size:12px;"></span>-->
                <!--</a>-->
                <a href="#"  onclick="return false;">
                  <i class="fa fa-envelope-o fa-lg"></i>
                  <span class="label label-success" id="mailcounts" style="font-size:12px;"></span>
                </a>
              </li> 
              
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
             $rbumenu = $_SESSION['RoleBasedUserMenu'];
             
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
          <h1>
            <?php if(isset($page_header)){echo $page_header;} ?>
              <small style="color: #F39C12;font-weight: bold"><?php if(isset($message)){echo $message;} ?></small>
          </h1>
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
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/app.min.js"></script>
    <!-- Our custom js -->
     <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/doc_ready.js"></script>
     
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/my_site.js"></script>    
   
    <!-- Select2 -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/select2/select2.min.js"></script>  
    <!-- ChartJS -->
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/chartjs/Chart.min.js"></script> 
   <!-- FLOT CHARTS -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/flot/jquery.flot.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/flot/jquery.flot.resize.js"></script>
   <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/flot/jquery.flot.categories.js"></script>
   
    <!-- Jquery DataTable -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
     <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/moment.min.js"></script>
      
   <script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
   <!-- page script -->

<!-- AdminLTE App -->
<script src="<?php if(isset($themePath)){echo $themePath;} ?>/dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="<?php if(isset($themePath)){echo $themePath;} ?>/plugins/iCheck/icheck.min.js"></script>
    <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    
    var areaChartData = {
      labels  : ['Platinum', 'Diamond', 'Gold', 'Silver', 'Bronze'],
      datasets: [
        {
          label               : 'Joined',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [75, 120, 250, 120, 150]
        },
        {
          label               : 'Projected',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [60, 100, 200, 100, 130]
        }
      ]
    }
    
    var areaChartDataFrmr = {
      labels  : ['Nonwoven Snood Cap', 'Nonwoven Beard Cover', 'Nonwoven Clip Caps', 'Nonwoven Bouffant Caps', 'Nonwoven Mob Caps'],
      datasets: [
        {
          label               : 'Joined',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [120, 50, 70, 40, 130]
        },
        {
          label               : 'Projected',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [125, 55, 75, 50, 135]
        }
      ]
    }
    
 var donutData = <?php echo $po_stage_data;?>
 
    var areaChartDataBar = {
      labels  : ['Marakanam,TN-L', 'Sirkazhi,TN-L', 'Velan,GJ-L', 'Marakanam,TN-F', 'Velan,GJ-F'],
      datasets: [
        {
          label               : 'Joined',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [10.75,  5.65,  25.15, 55.50, 100.00]
        },
        {
          label               : 'Projected',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [12.00, 6.00, 28.05, 57.50, 105.00]
        }
        
      ]
    }


    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartDataFrmr, lineChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 550,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Platinum'
      },
      {
        value    : 350,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Diamond'
      },
      {
        value    : 400,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'Gold'
      },
      {
        value    : 654,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Silver'
      },
      {
        value    : 560,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Bronze'
      },
    ]
    
   
  
    
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(donutData, pieOptions)


      /*
     * BAR CHART
     * ---------
     */
     
    var barDataLive = <?php echo $despatch_data; ?>
    
    var bar_data = {
      data : barDataLive,
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = bar_data
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
  
</script>

 <script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
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
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>