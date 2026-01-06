<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once ROOT_PATH . '/app/auth/auth.php';

// CSRF Token
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf']) ?>">
  <title>VENDOR_DASHBOARD | 員工管理</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <a href="../../index.php" class="brand-link text-center">
        <img src="./user_image/logo.png" alt="Logo" style="width: 80%; opacity: .9;">
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../tables_7/user_image/<?= $_SESSION["avatar"] ?>" class="img-circle elevation-2" alt="User">
            </div>
            <div class="info">
                <a href="#" class="d-block ml-3"><?= $_SESSION["user"] ?></a>
            </div>
        </div>
    
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-users"></i>
                        <p>員工管理<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="employee.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>員工列表</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </ul>
        </nav>
        <div class="user-panel mt-3 text-center">
            <a href="../login/logOut.php" class="btn btn-danger btn-sm w-100">登出</a>
        </div>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>員工管理系統</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">
              <i class="fas fa-plus-circle"></i> 新增員工
            </button>
          </div>
          <div class="card-body">
            <table id="employeeTable" class="table table-bordered table-striped table-hover">
              <thead class="bg-light">
                <tr>
                  <th>ID</th><th>姓名</th><th>頭貼</th><th>Email</th><th>密碼</th><th>性別</th><th>生日</th><th>負責事項</th><th>操作</th>
                </tr>
              </thead>
              <tbody>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">使用者編輯</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="employeeForm">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group text-center">
                        <img id="img1" src="./user_image/avatar.png" class="img-thumbnail" style="width: 120px; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換</p>
                        <input type="file" id="inputavatar" hidden accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email (帳號)</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>密碼</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>性別</label>
                                <select class="form-control" id="gender">
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>生日</label>
                                <input type="date" class="form-control" id="birthday">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>負責事項</label>
                        <input type="text" class="form-control" id="role">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button id="buttonUpdate" type="button" class="btn btn-primary">確認儲存</button>
            </div>
        </div>
    </div>
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {
    // 初始化 DataTable (寫在外面，AJAX 完成後重繪)
    const table = $('#employeeTable').DataTable({
        "responsive": true, 
        "autoWidth": false,
        "language": { "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" } // 繁體中文優化
    });

    // 讀取員工資料
    function showEmployee() {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        $.ajax({
            url: '<?= $config['api']['getAllEmployee'] ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                csrf: csrfToken
            },
            success: function (data) {
                table.clear();

                data.forEach(item => {
                    table.row.add([
                        item.e_id,
                        item.name,
                        `<img src="/VENDOR_DASHBOARD/user_image/${item.avatarname}" style="height:50px">`,
                        item.email,
                        '******',
                        item.gender,
                        item.birthday,
                        item.role,
                        `<button class="btn btn-sm btn-success btn-edit">
                            <i class="fas fa-edit"></i>
                        </button>`
                    ]);
                });

                table.draw();
            },
            error: function (xhr) {
                switch (xhr.status) {
                    case 401:
                        alert('登入已過期，請重新登入');
                        location.href = '/VENDOR_DASHBOARD/login.php';
                        break;
                    case 403:
                        alert('安全驗證失敗，請重新整理頁面');
                        break;
                    case 405:
                        alert('不允許的請求方式');
                        break;
                    default:
                        alert('讀取員工資料失敗');
                }
            }
        });
    }


    showEmployee();

    // 圖片預覽邏輯
    $('#img1').on('click', () => $('#inputavatar').trigger('click'));
    $('#inputavatar').change(function(e) {
        const reader = new FileReader();
        reader.onload = (event) => $('#img1').attr('src', event.target.result);
        reader.readAsDataURL(e.target.files[0]);
    });

    // 編輯按鈕觸發 (使用事件委託)
    $('#employeeTable').on('click', '.btn-edit', function() {
        const data = table.row($(this).parents('tr')).data();
        $('#id').val(data[0]);
        $('#name').val(data[1]);
        $('#img1').attr('src', $(data[2]).attr('src'));
        $('#email').val(data[3]);
        $('#gender').val(data[5]);
        $('#birthday').val(data[6]);
        $('#role').val(data[7]);
        $('#employeeModal').modal('show');
    });

    // 儲存邏輯 (合併新增與修改)
    $('#buttonUpdate').on('click', function() {
        const id = $('#id').val();
        const apiUrl = id === "" ? 'employeeInsertApi.php' : 'employeeUpdateApi.php';
        
        const formData = {
            id: id,
            name: $('#name').val(),
            avatarname: $('#inputavatar')[0].files[0]?.name || $('#img1').attr('src').split('/').pop(),
            email: $('#email').val(),
            password: $('#password').val(),
            gender: $('#gender').val(),
            birthday: $('#birthday').val(),
            role: $('#role').val()
        };

        $.post(apiUrl, formData, function(res) {
            if(res.success) {
                Swal.fire('成功', id === "" ? '已新增' : '已更新', 'success');
                $('#employeeModal').modal('hide');
                showEmployee();
            } else {
                Swal.fire('錯誤', res.errorMessage, 'error');
            }
        }, 'json');
    });

    // Modal 關閉後重置
    $('#employeeModal').on('hidden.bs.modal', function() {
        $('#employeeForm')[0].reset();
        $('#id').val("");
        $('#img1').attr('src', './user_image/avatar.png');
    });
});
</script>
</body>
</html>