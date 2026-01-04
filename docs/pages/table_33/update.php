<?php
session_start();
require_once ("connect.php");



    if(!empty($_GET['FoodID'])){
      $sql = "SELECT * FROM `fooddata` WHERE `FoodID`=?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        $_GET['FoodID']
      ]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if( empty($row)){
        header('Location: query.php');
      
        exit;
      }
    }

    //echo "連結資料庫成功!!!<br>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 取得表單提交的資料
        $FoodID = $_POST["FoodID"];
        $FoodName = $_POST["FoodName"];
        $Calorie = $_POST["Calorie"];
        $Fat = $_POST["Fat"];
        $Protein = $_POST["Protein"];
        $Carbohydrates = $_POST["Carbohydrates"];
        $Food_categoryID = $_POST["FoodCategoryID"];

        // 處理上傳的圖片
        $targetDir = __DIR__. "/img/";
        $targetFile = $targetDir . basename($_FILES["FoodImgID"]["name"]);
        $uploadOk = 1;
       

        // 檢查圖片是否成功上傳
        if ($uploadOk == 0) {
            echo "圖片上傳失敗。";
        } else {
            if (move_uploaded_file($_FILES["FoodImgID"]["tmp_name"], $targetFile)) {
                // 上傳成功後，執行更新資料庫的操作
                $update = "UPDATE `fooddata` SET `FoodName` = :na, `Calorie` = :cal, `Fat` = :fat, `Protein` = :pro, `Carbohydrates` = :car, `FoodImgID` = :img, `Food_categoryID` = :catid WHERE FoodID = :id";
                
                $pdoStmt = $pdo->prepare($update);
                $pdoStmt->bindValue(":id", $FoodID, PDO::PARAM_INT);
                $pdoStmt->bindValue(":na", $FoodName, PDO::PARAM_STR);
                $pdoStmt->bindValue(":cal", $Calorie, PDO::PARAM_INT);
                $pdoStmt->bindValue(":fat", $Fat, PDO::PARAM_INT);
                $pdoStmt->bindValue(":pro", $Protein, PDO::PARAM_INT);
                $pdoStmt->bindValue(":car", $Carbohydrates, PDO::PARAM_INT);
                $pdoStmt->bindValue(":img", basename($_FILES["FoodImgID"]["name"]), PDO::PARAM_STR);
                $pdoStmt->bindValue(":catid", $Food_categoryID, PDO::PARAM_INT);
        
                $pdoStmt->execute();
                $num = $pdoStmt->rowCount();
                
                echo "<script>alert('修改成功');</script>";
                echo "<script>setTimeout(function() { window.location.href = 'fooddata.php'; }, 300);</script>";
                exit();
            } else {
                $update = "UPDATE `fooddata` SET `FoodName` = :na, `Calorie` = :cal, `Fat` = :fat, `Protein` = :pro, `Carbohydrates` = :car, `Food_categoryID` = :catid WHERE FoodID = :id";

                $pdoStmt = $pdo->prepare($update);
                $pdoStmt->bindValue(":id", $FoodID, PDO::PARAM_INT);
                $pdoStmt->bindValue(":na", $FoodName, PDO::PARAM_STR);
                $pdoStmt->bindValue(":cal", $Calorie, PDO::PARAM_INT);
                $pdoStmt->bindValue(":fat", $Fat, PDO::PARAM_INT);
                $pdoStmt->bindValue(":pro", $Protein, PDO::PARAM_INT);
                $pdoStmt->bindValue(":car", $Carbohydrates, PDO::PARAM_INT);
                $pdoStmt->bindValue(":catid", $Food_categoryID, PDO::PARAM_INT);

                $pdoStmt->execute();
                $num = $pdoStmt->rowCount();

                echo "<script>alert('修改成功');</script>";
                echo "<script>setTimeout(function() { window.location.href = 'fooddata.php'; }, 300);</script>";
                exit();
            }
        }
    }
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">  

  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  
  <style>
    #img1 {
      width: 150px;
      height:120px
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
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
                <a href="../tables/fooddata.php" class="nav-link active bg-warning">
                  <i class="nav-icon fas fa-bone"></i>
                  <p>食物資料管理</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="insert.php" class="nav-link">
                  <i class="nav-icon fas fa-plus"></i>
                    <p> 新增一筆資料</p>
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
      <section class="content-header pt-3 pb-0">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>編輯食物資料</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="fooddata.php">FoodData</a></li>
                <li class="breadcrumb-item active">編輯食物資料</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <hr style="border: 1px solid gray">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <button class="btn btn-secondary mb-3" id="backbutton"><i class="fas fa-arrow-left"></i> 返回上一頁</button>
              <div class="card card-navy">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                
                <!-- form start -->
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                  <div class="card-body row">
                    <div class="form-group">
                      <label for="FoodID" hidden>FoodID</label>
                      <input type="text" class="form-control " name="FoodID" id="FoodID" value="<?= $row['FoodID']; ?>" placeholder="食物ID" hidden>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="FoodName">FoodName</label>
                      <input type="text" class="form-control" name="FoodName" id="FoodName" value="<?= $row['FoodName']; ?>" placeholder="食物名稱" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Calorie">cal</label>
                      <input type="text" class="form-control" name="Calorie" id="Calorie" value="<?= $row['Calorie']; ?>" placeholder="卡路里" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Fat">fat</label>
                      <input type="text" class="form-control" name="Fat" id="Fat" value="<?= $row['Fat']; ?>" placeholder="脂肪" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Protein">pro</label>
                      <input type="text" class="form-control" name="Protein" id="Protein" value="<?= $row['Protein']; ?>" placeholder="蛋白質" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="Carbohydrates">car</label>
                      <input type="text" class="form-control" name="Carbohydrates" id="Carbohydrates" value="<?= $row['Carbohydrates']; ?>" placeholder="碳水化合物" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="FoodCategoryID">CatID</label>
                      <select id="FoodCategoryID" name="FoodCategoryID" class="form-control" require>
                          <option value="1" <?php if ($row['Food_categoryID'] == 1) echo 'selected'; ?>>1. 飯</option>
                          <option value="2" <?php if ($row['Food_categoryID'] == 2) echo 'selected'; ?>>2. 麵</option>
                          <option value="3" <?php if ($row['Food_categoryID'] == 3) echo 'selected'; ?>>3. 早餐</option>
                          <option value="4" <?php if ($row['Food_categoryID'] == 4) echo 'selected'; ?>>4. 湯</option>
                          <option value="5" <?php if ($row['Food_categoryID'] == 5) echo 'selected'; ?>>5. 飲料</option>
                          <option value="6" <?php if ($row['Food_categoryID'] == 6) echo 'selected'; ?>>6. 其他</option>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="FoodImgID">img</label>
                      <div id="containerIMG"><img id="img1" src="img/<?= $row['FoodImgID']; ?>"></div>
                      <input type="file" id="FoodImgID" name="FoodImgID" style="display: none;">
                      <input type="hidden" id="selectedFileName" name="selectedFileName" value="<?= $row['FoodImgID']; ?>" required>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn bg-navy color-palette" id="submit">儲存</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
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
  <!-- Sweet Alter -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->



  <!-- Page specific script -->
  <script>
    $(function () {
      bsCustomFileInput.init();
      $('#backbutton').on('click', function() {
        window.location.href="fooddata.php";
      })

      $('#img1').click(function() {
        $('#FoodImgID').click();
      });
        $('#FoodImgID').change(function(e) {
          const file = e.target.files[0];
          const reader = new FileReader();

          reader.onload = function(event) {
            $('#img1').attr('src', event.target.result);
          };

          reader.readAsDataURL(file);
          const selectedFileName = file.name;
          $('#selectedFileName').val(selectedFileName);
        });
      

      // $('#submit').on('click', function(e) {
      //   e.preventDefault(); // 阻止表單的預設提交行為

      //   Swal.fire({
      //     title: '確定要儲存新增嗎?',
      //     showDenyButton: true,
      //     showCancelButton: true,
      //     confirmButtonText: '儲存',
      //     denyButtonText: '取消',
      //   }).then((result) => {
      //     if (result.isConfirmed) {
      //       // 在這裡執行儲存操作或提交表單的程式碼
      //       Swal.fire('已儲存！', '', 'success');
      //       // 可以使用下面的程式碼提交表單
      //       $(this).off('submit').submit();
      //       console.log('成功');
      //     } else if (result.isDenied) {
      //       Swal.fire('變更未儲存', '', 'info');
      //     }
      //   });
      // });
    });
  </script>


</body>

</html>


