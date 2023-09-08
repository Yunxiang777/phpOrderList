<?php
require_once ("db_database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | ChartJS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css"
    rel="stylesheet" type="text/css" />
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- logo -->
      <a href="" class="brand-link">
        <img src="../table_Tung/logo/logo.png" alt=" Logo" class=" img-rounded " style="opacity: .9; display:block; margin:auto;" >
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!----> 
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- 搜尋 -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>


        <!-- 側欄位 -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  訂單管理
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="order_chart.html" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>趨勢分析圖表</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="realItem_order.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>實體商品訂單管理</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="vedio_order.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>線上課程訂單管理</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- 側欄位 -->


      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6" style="padding-left: 170px;">
              <div
                style="display: flex; width: 100%; justify-content: space-around ; align-items: center; height: 100%;font-size: 50px; font-weight:bold;">
                <div>訂單圖表</div>
                <div style="color: rgba(210, 214, 222, 1);"> 灰色:課程</div>
                <div style="color: rgba(60,141,188,0.9);">青色:實體</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="ui form ml-5" style="width:60%; ">
                <div class="two fields ml-5">
                  <div class="field">
                    <label style=" font-size: 20px;">起始日期</label>
                    <div class=" ui calendar" id="rangestart">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="Start" id="startDate">
                      </div>
                    </div>
                  </div>
                  <div class="field">
                    <label style=" font-size: 20px;">結束日期</label>
                    <div class="ui calendar" id="rangeend">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="End" id="endDate">
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-outline-info" id="getdate"
                    style="width: 180px; height: 60px; font-size: 20px; font-weight: bold; ">查詢日期
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <canvas id="areaChart"
            style="min-height: 250px; height: 700px; max-height: 700px; max-width: 100%; margin-top: 100px;"></canvas>


        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Add Content Here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script
    src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

  <script>
    $(function () {

      // 查詢日期區間方法 開始...
      $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend')
      });
      $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart')
      });

      $('#getdate').on('click', function () {
        const startDate = new Date($('#startDate').val());
        const endDate = new Date($('#endDate').val());

        const dataList = [];
        const dayordernum = [];
        const dayordervedionum = [];
        let currentDate = new Date(startDate); // 創建一個新的日期物件

        // 將起始日期加1天，以便從下一天開始計算
        currentDate.setDate(currentDate.getDate() + 1);
        endDate.setDate(endDate.getDate() + 1);

        // 循環遍歷日期區間，將每一天加入dataList
        while (currentDate <= endDate) {
          const dateStr = currentDate.toISOString().split('T')[0];
          dataList.push(dateStr);
          currentDate.setDate(currentDate.getDate() + 1); // 將日期增加1天
        }


        var step;
        for (step = 0; step < dataList.length; step++) {
          const datenow = dataList[step]; //當天的實體訂單數量
          $.ajax({
            url: "./orderALLapi/chart_orderreal.php", // 實體商品的API
            type: 'POST',
            async: false,
            data: {
              DateconutTHIS: datenow
            },
            dataType: 'json'
          }).done(function (response) {
            var num = response.count;
            dayordernum.push(num); //把數量實體訂單加入陣列
          })
          $.ajax({
            url: "./orderALLapi/chart_ordervedio.php", // 課程的API
            type: 'POST',
            async: false,
            data: {
              DateconutVEDIOTHIS: datenow
            },
            dataType: 'json'
          }).done(function (responsevedio) {
            var numvedio = responsevedio.count;
            dayordervedionum.push(numvedio); //把數量線上課程訂單加入陣列
          })
        }




        //圖表開始
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d'); //areaChart這個id位置 , 使用2d方法

        var areaChartData = {
          labels: dataList,
          datasets: [
            { //實體商品圖表
              label: 'Digital Goods',
              backgroundColor: 'rgba(60,141,188,0.9)',
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: dayordernum
            }
            ,
            { //線上課程圖表
              label: 'Electronics',
              backgroundColor: 'rgba(210, 214, 222, 1)',
              borderColor: 'rgba(210, 214, 222, 1)',
              pointRadius: false,
              pointColor: 'rgba(210, 214, 222, 1)',
              pointStrokeColor: '#c1c7d1',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data: dayordervedionum
            }
          ]
        }

        var areaChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
              }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              }
            }]
          }
        }


        new Chart(areaChartCanvas, {
          type: 'line',
          data: areaChartData,
          options: areaChartOptions
        })
      })


    })
  </script>
</body>

</html>