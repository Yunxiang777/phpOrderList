<?php
require_once ("connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitness | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <style>
    
    td {
      text-align: center;
      line-height: 120px;
    }

  </style>
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
            <!-- [目前位置]  食物資料管理 + 新增一筆 資料 -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-bone"></i>
                    <p>食物資料管理</p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>食物資料列表</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="insert.php" class="nav-link">
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
            <!-- 影音列表 -> 影音管理 + 影音管理 -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-video nav-icon" ></i>
                    <p>影音列表<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../tables_Luna/mainpageajax.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>影音管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../tables_Luna/charts.php" class="nav-link">
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
              <h1>FoodData</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">FoodData</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-info mb-2" id="insertButton"><i class="fas fa-plus"></i> 新增一筆資料</button>

                  <!-- <form method="GET" action="select.php">
                    <label for="column">選擇欄位:</label>
                    <select name="column" id="column">
                      <option value="Calorie">Calorie</option>
                      <option value="Fat">Fat</option>
                      <option value="Protein">Protein</option>
                      <option value="Carbohydrates">Carbohydrates</option>
                    </select>
                    
                    <label for="min">最小值:</label>
                    <input type="number" name="min" id="min">
                    
                    <label for="max">最大值:</label>
                    <input type="number" name="max" id="max">
                    
                    <input type="submit" value="查詢" id="select_button">
                  </form> -->
                  <table id="table2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>FoodID</th>
                        <th>FoodName</th>
                        <th>Calorie</th>
                        <th>Fat</th>
                        <th>Protein</th>
                        <th>Carbohydrates</th>
                        <th>FoodImgID</th>
                        <th>Food_categoryID</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                      <?php
                        include 'query.php';
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>FoodID</th>
                        <th>FoodName</th>
                        <th>Calorie</th>
                        <th>Fat</th>
                        <th>Protein</th>
                        <th>Carbohydrates</th>
                        <th>FoodImgID</th>
                        <th>Food_categoryID</th>
                        <th>Edit</th>
                      </tr>
                    </tfoot>
                  </table> 
                </div>
            </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#table2").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": ["colvis"]
      }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
      $('#table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

      });
      $('#insertButton').on('click', function() {
        window.location.href = "insert.php";
      })
      
    });
  </script>
</body>

</html>