<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

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
    <!-- Navbar -->
    
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
      <img src="img/logo.png" alt=" Logo" class=" img-rounded " style="opacity: .9; display:block; margin:auto;">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="img/avatar.jpg" class=" " alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">張溦珊</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="fooddata.php" class="nav-link active bg-warning">
                <i class="nav-icon fas fa-bone"></i>
                <p>食物資料管理</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="insert.php" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                  <p>新增一筆資料</p>
                </a>
                </li>
                
              </ul>
            </li>
             
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

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