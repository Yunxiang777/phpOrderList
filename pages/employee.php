<?php
require_once __DIR__ . '/../bootstrap.php';
require_once ROOT_PATH . '/app/auth/auth.php';

// CSRF Token
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// 共用參數
$imgBaseUrl = $config['routes']['img'];
$api = $config['api'];
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>員工管理</title>
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>員工管理系統</h1>
            </div>
        </section>
        <!-- 員工列表 -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <!-- 新增員工 -->
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

<?php include ROOT_PATH . '/views/layout/commonJs.php'; //共用js ?>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(function () {
    const csrf = '<?= $_SESSION['csrf'] ?>';
    const imgBaseUrl = '<?= htmlspecialchars($imgBaseUrl) ?>';
    const table = $('#table').DataTable({
        responsive: true,
        language: { url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" }
    });

    // 讀取所有員工資料
    function load() {
        $.ajax({
            url: '<?= $api['getAllEmployee'] ?>',
            type: 'POST',
            dataType: 'json',
            data: { csrf },
            success: function (data) {
                table.clear();
                data.forEach(item => {
                    table.row.add([
                        `<a href="javascript:void(0)"
                            class="edit"
                            data-id="${item.e_id}">
                            ${item.e_id}
                            <span class="badge ${item.is_active == 1 ? 'bg-success' : 'bg-secondary'}">
                                ${item.is_active == 1 ? '啟用' : '停用'}
                            </span>
                        </a>`,
                        item.name,
                        item.email
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增員工
    function create(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('avatar', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['addEmployee'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案（如果有選擇新圖片）
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('avatar', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $config['api']['updateEmployee'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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

    // 編輯員工
    $('#table').on('click', '.edit', function () {
        const id = $(this).data('id');
        $.ajax({
            url: '<?= $config['api']['getEmployee'] ?>',
            type: 'POST',
            data: { id, csrf },
            dataType: 'json',
            success: function (res) {
                if (!res.success) {
                    Swal.fire('錯誤', res.errorMessage || '讀取失敗', 'error');
                    return;
                }
                const emp = res.data;
                $('#id').val(emp.e_id);
                $('#name').val(emp.name);
                $('#email').val(emp.email);
                $('#valid').val(emp.is_active);
                $('#password').val(emp.password);
                $('#avatar').attr('src', imgBaseUrl + '/employee/avatar/' + emp.avatarname);
                $('#role').val(emp.role);
                $('#birthday').val(emp.birthday);
                $('#modalTitle').text('編輯員工');
                $('#modal').modal('show');
            },
            error: handleError
        });
    });

    // 儲存或新增按鈕
    $('#btnSave').click(function() {
        const id = $('#id').val();
        const fileInput = $('#file')[0];
        let avatarname = '';
        
        // 如果有選擇新檔案，使用 UUID 重新命名
        if (fileInput.files[0]) {
            const originalFile = fileInput.files[0];
            const fileExtension = originalFile.name.split('.').pop();
            avatarname = `${generateUUID()}.${fileExtension}`;
        } else {
            // 沒有新檔案，保留原有檔名
            avatarname = $('#avatar').attr('src').split('/').pop();
        }
        
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
            avatarname: avatarname
        };
        
        // 有id則更新，無則新增
        id ? update(data) : create(data);
    });

    // 圖片預覽處理
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

    // UUID v4 生成函數
    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0;
            const v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
    
});
</script>
</body>
</html>