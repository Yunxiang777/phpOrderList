<?php
require_once ("connect_pdo.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | uPlot</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- uPlot -->
  <link rel="stylesheet" href="../../plugins/uplot/uPlot.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
      <!-- 側邊欄全部 start -->
 <aside class="main-sidebar sidebar-dark-warning elevation-4">

<!-- Logo圖 點選前往首頁-->
<a href="../../index.php" class="brand-link">
    <img src="../tables_7/user_image/logo.png" alt=" Logo" class=" img-rounded "
        style="opacity: .9;display:block ;margin:auto;">
</a>

<!-- 側邊欄位開始 -->
<div class="sidebar">
    <!-- 個人資料 -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../tables_7/user_image/<?php echo $_SESSION["avatar"];?>" class="img-circle elevation-2"
                    alt="User Image"/>
                    <!-- 頭像 -->
                </div>
            <div class="info">
                <a href="../../index.php" class="d-block ml-3">
                    <?php echo  $_SESSION["user"] ; ?>
                </a>
                <!-- 員工名字 -->
            </div>
        </div>
    
    <!--  側欄內容 -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <!-- 員工列表 -> 員工管理 -->
            <li class="nav-item ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-table"></i>
                    <p>員工列表<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../tables_7/employee.php" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>員工管理</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 會員列表 -> 會員管理 -->
            <li class="nav-item ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-table"></i>
                    <p>會員列表<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../tables_7/member.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>會員管理</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--  食物資料管理 + 新增一筆 資料 -->
            <li class="nav-item ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-bone"></i>
                    <p>食物資料管理</p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../table_33/fooddata.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>食物資料列表</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_33/insert.php" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>新增一筆資料</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 商品管理 -> 商品檢視-->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>商品管理<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../table_Tung/product1.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>商品檢視</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--  影音列表 -> 影音管理 + 影音管理 -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="fas fa-video nav-icon" ></i>
                    <p>影音列表<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <a href="mainpageajax.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>影音管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                       <!-- [目前位置] -->
                        <a href="charts.php" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>圖表分析</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 訂單管理 -> 銷售圖表分析 + 商品訂單管理 + 影片訂單管理 -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas  fa-shopping-cart nav-icon"></i>
                    <p>訂單管理<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../table_AYun/order_chart.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>銷售圖表分析</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_AYun/realItem_order.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>商品訂單管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_AYun/vedio_order.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>影片訂單管理</p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        
    </nav>
    <a href="../login/logOut.php" class="mt-auto sidebar-link">登出</a>
        <!-- 登出按鈕 -->
</div>

</aside>
<!-- 側邊欄結束 End -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>影音圖表分析</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
                      <!-- BAR CHART -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="card card-danger">
                            <div class="card-header">
                              <h3 class="card-title">觀眾地區分布</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card card-success">
                            <div class="card-header">
                              <h3 class="card-title">訂閱者性別比</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- /row -->
          <div class="row">
            <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">你的頻道在過去6個月內累積的觀看次數</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- card header -->
                <div class="card-body">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
                    </canvas>
                </div>
                <!-- /card body -->
              </div>
              <!-- /cardinfo -->
            </div>
            <!-- /col-md-6 -->
            <div class="col-md-4">
            <!-- USERS LIST -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">最新訂閱會員</h3>
                  <div class="card-tools">
                    <span class="badge badge-danger">8位會員</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="./logo/user1.jpg" alt="User Image">
                      <a class="users-list-name" href="#">TOM</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="./logo/user2.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="./logo/user3.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="./logo/user4.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="./logo/user5.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jack</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="./logo/user6.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="./logo/user7.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Max</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="./logo/user8.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Mady  </a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /row -->
        </div><!-- /.container-fluid -->
      </section> <!--/section -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- uPlot -->
  <script src="../../plugins/uplot/uPlot.iife.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <script>

    const ctx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月'],
                datasets: [{
                    label: '觀看次數',
                    data: [ 30 , 34 , 35, 43, 38, 39, 33],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                }]
            },
        });
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    const donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    const donutData = {
      labels: [
        '台北',
        '桃園',
        '台中',
        '台南',
        '高雄',
        '其他地區',
      ],
      datasets: [
        {
          data: [300, 500, 200, 600, 300, 100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    const donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    const areaChartData = {
      labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月'],
      datasets: [
        {
          label: '男性',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label: '女性',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }
    const barChartCanvas = $('#barChart').get(0).getContext('2d')
    const barChartData = $.extend(true, {}, areaChartData)
    const temp0 = areaChartData.datasets[0]
    const temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    const barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

  </script>
</body>

</html>