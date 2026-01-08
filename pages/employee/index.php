<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once ROOT_PATH . '/app/auth/auth.php';

// CSRF Token
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// 共用參數
$imgBaseUrl = $config['routes']['img'];
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf']) ?>">
    <title>員工管理</title>
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
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
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="employee.php" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>員工列表</p>
                        </a>
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
                        <button type="button" class="btn btn-primary" id="btnAdd">
                            <i class="fas fa-plus-circle"></i> 新增員工
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>工號</th>
                                    <th>姓名</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- 員工編輯與新增 Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">員工編輯</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="id">
                    <div class="form-group text-center">
                        <img id="avatar" src="" class="img-thumbnail" style="width: 120px; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換</p>
                        <input type="file" id="file" hidden accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
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
                    <div class="form-group">
                        <label>帳號狀態</label>
                        <select class="form-control" id="valid">
                            <option value="1">啟用</option>
                            <option value="0">停用</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="btnSave">確認儲存</button>
            </div>
        </div>
    </div>
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script>
$(function () {
    const csrf = $('meta[name="csrf-token"]').attr('content');
    const table = $('#table').DataTable({
        responsive: true,
        language: { url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" }
    });

    // 讀取員工資料
    function load() {
        $.ajax({
            url: '<?= $config['api']['getAllEmployee'] ?>',
            type: 'POST',
            dataType: 'json',
            data: { csrf },
            success: function (data) {
                table.clear();
                data.forEach(item => {
                    table.row.add([
                        item.e_id + (item.is_active == 1 ? ' (啟用)' : ' (停用)'),
                        item.name,
                        item.email,
//                        `<button class="btn btn-sm btn-success edit" data-id="${item.e_id}"><i class="fas fa-edit"></i></button>`
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增員工
    function create(data) {
        $.ajax({
            url: '<?= $config['api']['addEmployee'] ?>',
            type: 'POST',
            data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '員工已新增', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '新增失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 更新員工
    function update(data) {
        $.ajax({
            url: '<?= $config['api']['updateEmployee'] ?>',
            type: 'POST',
            data,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '員工已更新', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '更新失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 停用員工
    function disable(id) {
        Swal.fire({
            title: '確認停用?',
            text: "該員工將無法登入系統",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107', // 警告色
            confirmButtonText: '確認停用',
            cancelButtonText: '取消'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'employeeDisableApi.php', // 指向剛才建立的 API
                    type: 'POST',
                    data: { csrf, id },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('已停用', '員工帳號已停用', 'success');
                            load(); // 重新整理表格
                        } else {
                            Swal.fire('錯誤', res.errorMessage || '停用失敗', 'error');
                        }
                    },
                    error: handleError
                });
            }
        });
    }

    // 錯誤處理
    function handleError(xhr) {
        const msg = {
            401: '登入已過期，請重新登入',
            403: '安全驗證失敗',
            405: '不允許的請求方式'
        }[xhr.status] || '操作失敗';
        
        Swal.fire('錯誤', msg, 'error').then(() => {
            if (xhr.status === 401) location.href = '/VENDOR_DASHBOARD/login.php';
        });
    }

    // 重置表單
    function reset() {
        $('#form')[0].reset();
        $('#id').val('');
        $('#avatar').attr('src', '<?= "{$imgBaseUrl}/avatar.png" ?>');
    }

    // 初始化
    load();

    // 新增按鈕
    $('#btnAdd').click(function() {
        reset();
        $('#modalTitle').text('新增員工');
        $('#modal').modal('show');
    });

    // 編輯按鈕
    $('#table').on('click', '.edit', function() {
        const data = table.row($(this).parents('tr')).data();
        $('#id').val(data[0]);
        $('#name').val(data[1]);
        $('#avatar').attr('src', $(data[2]).attr('src'));
        $('#email').val(data[3]);
        $('#gender').val(data[4]);
        $('#birthday').val(data[5]);
        $('#role').val(data[6]);
        $('#valid').val(data[7]);
        $('#password').val('');
        $('#modalTitle').text('編輯員工');
        $('#modal').modal('show');
    });

    // 刪除按鈕
    $('#table').on('click', '.disable-btn', function() {
        disable($(this).data('id'));
    });

    // 儲存按鈕
    $('#btnSave').click(function() {
        const id = $('#id').val();
        const data = {
            csrf,
            id,
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            gender: $('#gender').val(),
            birthday: $('#birthday').val(),
            role: $('#role').val(),
            valid: $('#valid').val(),
            avatarname: $('#file')[0].files[0]?.name || $('#avatar').attr('src').split('/').pop()
        };
        id ? update(data) : create(data);
    });

    // 圖片預覽
    $('#avatar').click(() => $('#file').click());
    $('#file').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => $('#avatar').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // Modal關閉重置
    $('#modal').on('hidden.bs.modal', reset);
});
</script>
</body>
</html>