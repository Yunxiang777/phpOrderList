<?php
require_once ("db_database.php");
session_start();
?>

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <style>
    .img-wrap {
      width: 150px;
      height: 150px;
      border-radius: 10px;
      overflow: hidden;
      border: 3px dotted transparent;
      background-color: silver;
    }

    #p_image,
    #p_imagefix {
      display: none;
    }

    #img1,
    #img1fix {
      width: 100%;
      height: 100%;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="logo/logo.png" alt=" Logo" class=" img-rounded " style="opacity: .9; display:block; margin:auto;" >
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
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
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active bg-warning">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  商品管理
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="product1.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>商品檢視</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link" data-toggle="modal" data-target="#productModal">
                    <i class="far fa-circle nav-icon"></i>
                    <p>新增商品</p>
                  </a>
                </li>

              </ul>
            </li>
            <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h2>商品總表:</h2>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
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
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#productModal"><i
                      class="fas fa-plus"></i>
                    新增產品</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="productTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>產品名稱</th>
                        <th>產品描述</th>
                        <th>產品規格</th>
                        <th>產品尺寸</th>
                        <th>產品類別</th>
                        <th>產品價格</th>
                        <th>產品數量</th>
                        <th>產品圖片</th>
                        <th>修改/刪除</th>
                      </tr>
                    </thead>
                    <tbody id="showtable">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>產品名稱</th>
                        <th>產品描述</th>
                        <th>產品規格</th>
                        <th>產品尺寸</th>
                        <th>產品類別</th>
                        <th>產品價格</th>
                        <th>產品數量</th>
                        <th>產品圖片</th>
                        <th>修改/刪除</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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

    <!-- /.container-fluid -->
    </section>
    <!-- 新增的Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="productModalLabel">新增商品</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="productForm" name="productForm">
              <div class="form-group">
                <label for="p_name" class="col-form-label">商品名稱</label>
                <input type="text" class="form-control" id="p_name" name="p_name">
              </div>
              <div class="form-group">
                <label for="p_description" class="col-form-label">產品描述</label>
                <textarea cols="30" rows="3" class="form-control" id="p_description" name="p_description"></textarea>
              </div>
              <div class="form-group">
                <label for="p_specification" class="col-form-label">產品規格</label>
                <input type="text" class="form-control" id="p_specification" name="p_specification">
              </div>
              <div class="form-group">
                <label for="$p_size" class="col-form-label">產品尺寸</label>
                <input type="text" class="form-control" id="p_size" name="p_size">
              </div>
              <div class="form-group col-md-4">
                <label for="p_category">產品類別</label>
                <select class="form-control" id="p_category" name="p_category">
                  <option selected hidden>選擇類別</option>
                  <option value="健身器材">健身器材</option>
                  <option value="健身配件">健身配件</option>
                  <option value="運動服飾">運動服飾</option>
                </select>
              </div>
              <div class="form-group">
                <label for="p_price" class="col-form-label">產品價格</label>
                <input type="text" class="form-control" id="p_price" name="p_price" required>
              </div>
              <div class="form-group">
                <label for="p_quantity" class="col-form-label">產品數量</label>
                <input type="text" class="form-control" id="p_quantity" name="p_quantity">
              </div>
              <div class="form-group">
                <label for="p_image" class="col-form-label">產品圖片</label>
                <div id="fileInput" class="img-wrap"><img id="img1" src="./product_img/default.jpg"></div>
                <input type="file" class="form-control" id="p_image" name="p_image"></input>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            <button id="buttonAdd" type="button" class="btn btn-primary">新增</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 修改的modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="productModalLabel">修改商品</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="updateForm">
              <div id="p_idfix" style="display: hidden;"></div>
              <div class="form-group">
                <label for="p_name" class="col-form-label">商品名稱</label>
                <input type="text" class="form-control" id="p_namefix" name="p_namefix" required>
              </div>
              <div class="form-group">
                <label for="p_description" class="col-form-label">產品描述</label>
                <textarea cols="30" rows="3" class="form-control" id="p_descriptionfix" name="p_description"></textarea>
              </div>
              <div class="form-group">
                <label for="p_specification" class="col-form-label">產品規格</label>
                <input type="text" class="form-control" id="p_specificationfix" name="p_specification">
              </div>
              <div class="form-group">
                <label for="$p_size" class="col-form-label">產品尺寸</label>
                <input type="text" class="form-control" id="p_sizefix" name="p_size">
              </div>
              <div class="form-group col-md-4">
                <label for="p_category">產品類別</label>
                <select class="form-control" id="p_categoryfix" name="p_category">
                  <option selected hidden>選擇類別</option>
                  <option value="健身器材">健身器材</option>
                  <option value="健身配件">健身配件</option>
                  <option value="運動服飾">運動服飾</option>
                </select>
              </div>
              <div class="form-group">
                <label for="p_price" class="col-form-label">產品價格</label>
                <input type="text" class="form-control" id="p_pricefix" name="p_price">
              </div>
              <div class="form-group">
                <label for="p_quantity" class="col-form-label">產品數量</label>
                <input type="text" class="form-control" id="p_quantityfix" name="p_quantity">
              </div>
              <div class="form-group">
                <label for="p_image" class="col-form-label">產品圖片</label>
                <div id="fileInput" class="img-wrap"><img id="img1fix" src="./product_img/default.jpg"></div>
                <input type="file" class="form-control" id="p_imagefix" name="p_image"></input>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            <button id="buttonUpdate" type="button" class="btn btn-primary">修改</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <!-- Page specific script -->

  <script>
    $(function () {
      $(document).ready(function () {
        $('#productTable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      //Modal新增商品的即時讀檔
      $('#productModal').on('click', '#img1', function () {
        $('#p_image').change(function (e) {
          const file = e.target.files[0];
          const reader = new FileReader();

          reader.onload = function (event) {
            const imagePath = './product_img/' + file.name;
            $('#img1').attr('src', imagePath);
          };

          reader.readAsDataURL(file);
        });
      });

      //Modal新增商品的即時讀檔
      $('#updateModal').on('click', '#img1fix', function () {
        $('#p_imagefix').change(function (e) {
          const file = e.target.files[0];
          const reader = new FileReader();

          reader.onload = function (event) {
            const imagePath = './product_img/' + file.name;
            $('#img1fix').attr('src', imagePath);
          };

          reader.readAsDataURL(file);
        });
      });

      var initialImageSrc = $('#img1').attr('src'); //保存初始圖像的 src 屬性值
      $('#productModal').on('show.bs.modal', function () {
        $('#img1').attr('src', initialImageSrc); //將圖像的 src 屬性重置為初始值

      });



      //帶入修改資料
      $('#productTable').on('click', '.updateItem', function () {

        var row = $(this).closest('tr');
        var p_id = row.find('td:eq(0)').text();
        var p_name = row.find('td:eq(1)').text();
        var p_description = row.find('td:eq(2)').text();
        var p_specification = row.find('td:eq(3)').text();
        var p_size = row.find('td:eq(4)').text();
        var p_category = row.find('td:eq(5)').text();
        var p_price = row.find('td:eq(6)').text();
        var p_quantity = row.find('td:eq(7)').text();
        var p_image = row.find('td:eq(8) img').attr('src');


        $('#p_idfix').val(p_id);
        $('#p_namefix').val(p_name);
        $('#p_descriptionfix').val(p_description);
        $('#p_specificationfix').val(p_specification);
        $('#p_sizefix').val(p_size);
        $('#p_categoryfix').val(p_category);
        $('#p_pricefix').val(p_price);
        $('#p_quantityfix').val(p_quantity);
        $('#img1fix').attr('src', p_image);
        // console.log(p_id);

        $('#updateModal').modal('show');

      })

      //修改圖片的trigger
      $('#updateModal').on('click', '#img1fix', function () {
        $('#p_imagefix').trigger('click');
      });

      //修改ㄉ按鈕
      $('#buttonUpdate').on('click', function () {

        var p_name = $('#p_namefix').val();
        var p_description = $('#p_descriptionfix').val();
        var p_specification = $('#p_specificationfix').val();
        var p_size = $('#p_sizefix').val();
        var p_category = $('#p_categoryfix').val();
        var p_price = $('#p_pricefix').val();
        var p_quantity = $('#p_quantityfix').val();
        var p_image = $('#img1fix').attr('src');
        var p_id = $('#p_idfix').val();

        var p_image_name = p_image.replace("./product_img/", ""); //改成檔名
        console.log(p_image_name);
        // 使用 AJAX 將資料傳回資料庫
        $.ajax({
          url: 'update_api.php',
          type: 'POST',
          async: false,
          data: {
            'p_name': p_name,
            'p_description': p_description,
            'p_specification': p_specification,
            'p_size': p_size,
            'p_category': p_category,
            'p_price': p_price,
            'p_quantity': p_quantity,
            'p_image': p_image_name,
            'p_id': p_id
          },
          dataType: 'json'
        }).done(function (data) {
          // 根據伺服器回應處理結果
          if (data.success) {
            // 成功更新資料庫
            Swal.fire('編輯成功');
            $('#updateModal').modal('hide');
            ShowUsers();
            window.location.reload(true);
          } else {
            // 更新資料庫時發生錯誤
            // alert('更新資料庫時發生錯誤: ' + data.message);
            $('#updateModal').modal('hide');
          }
        })
      });


      //新增按鈕
      $('#buttonAdd').on('click', function () {
        const Image = document.getElementById('p_image');
        let filename = Image.files[0].name;

        const p_name = $('#p_name').val();
        const p_description = $('#p_description').val();
        const p_specification = $('#p_specification').val();
        const p_size = $('#p_size').val();
        const p_category = $('#p_category').val();
        const p_price = $('#p_price').val();
        const p_quantity = $('#p_quantity').val();

        $.ajax({
          url: 'insert_api.php',
          type: 'POST',
          async: false,
          data: {
            'p_name': p_name,
            'p_description': p_description,
            'p_specification': p_specification,
            'p_size': p_size,
            'p_category': p_category,
            'p_price': p_price,
            'p_quantity': p_quantity,
            'p_image': filename,
          },
          dataType: 'json'
        }).done(function (data) {
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: '新增成功',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              location.reload(true);
            });

          } else {
            alert(data.errorMessage);
          }
        });
        $('#productModal').modal('hide'); // 隐藏 Modal
        ShowUsers();
      });

      $('#productModal').on('click', '#img1', function () {
        $('#p_image').trigger('click');
      });


      //刪除資料
      $('#productTable>tbody').on('click', '.deleteItem', function () {
        const productID = $(this).attr('id');
        Swal.fire({
          title: '真的要刪除嗎?',
          icon: 'warning',
          showDenyButton: true,
          confirmButtonText: '確定',
          denyButtonText: '取消',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete_api.php',
              type: 'GET',
              async: false,
              data: { "p_id": productID },
              dataType: 'json'
            }).done(function (data) {
              if (data.success) {
                Swal.fire('刪除成功', '', 'success');
                ShowUsers();
                window.location.reload(true);
              } else {
                Swal.fire('刪除失敗', '', 'error');
              }
            });
          } else if (result.isDenied) {
            // 取消按鈕被點擊
          }
        });
      });


      // 顯示資料
      function ShowUsers() {
        $.ajax({
          url: 'select_api.php',
          type: 'GET',
          async: false,
          dataType: 'json'
        }).done(function (productall) {
          const docFrag = $(document.createDocumentFragment());
          $.each(productall, function (idx, product) {
            const { p_id, p_name, p_description, p_specification, p_size, p_category, p_price, p_quantity, p_image } = product;
            // console.log(p_id);
            const data = `
                 <tr>
                 <td>${p_id}</td>
                 <td>${p_name}</td>
                 <td>${p_description}</td>
                 <td>${p_specification}</td>
                 <td>${p_size}</td>
                 <td>${p_category}</td>
                 <td>${p_price}</td>
                 <td>${p_quantity}</td>
                 <td><img src="./product_img/${p_image}" style="height:100px; width:100px"></td>
                 <td>
                   <button class="btn btn-primary btn-sm updateItem" data-toggle="modal" data-target="#updateModal" id="update${p_id}">
                     <i class="fas fa-edit fa-xs"></i>
                   </button>
                   <button class="btn btn-danger btn-sm deleteItem" id="${p_id}" >
                    <i class="far fa-trash-alt" style="color: #ffffff;"></i>
                   </button>
                 </td>
               </tr>`;
            $('#showtable').append(data);
          })
        });
      }
      ShowUsers();
    });

  </script>
</body>

</html>