<?php
require_once __DIR__ . '/../bootstrap.php';
require_once ROOT_PATH . '/app/auth/auth.php';

// CSRF Token
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

// 配置參數
$imgBaseUrl = './user_image';
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>會員管理</title>
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <h1>會員管理系統</h1>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" id="btnAdd">
                            <i class="fas fa-plus-circle"></i> 新增會員
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="memberTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>會員編號</th>
                                    <th>姓名</th>
                                    <th>頭貼</th>
                                    <th>Email</th>
                                    <th>性別</th>
                                    <th>生日</th>
                                    <th>手機</th>
                                    <th>地址</th>
                                    <th>訂閱狀態</th>
                                    <th>帳號狀態</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- 會員編輯與新增 Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">會員編輯</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="id">
                    
                    <!-- 頭貼上傳 -->
                    <div class="form-group text-center">
                        <img id="avatar" src="<?= $imgBaseUrl ?>/avatar.png" class="img-thumbnail" style="width: 120px; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換頭貼</p>
                        <input type="file" id="file" hidden accept="image/*">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>姓名 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>密碼</label>
                                <input type="password" class="form-control" id="password" placeholder="留空則不修改">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>性別</label>
                                <select class="form-control" id="gender">
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                    <option value="其他">其他</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>生日</label>
                                <input type="date" class="form-control" id="birthday">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>手機</label>
                                <input type="text" class="form-control" id="phone_number">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>地址</label>
                        <input type="text" class="form-control" id="address">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>訂閱狀態</label>
                                <select class="form-control" id="subscribe">
                                    <option value="1">已訂閱</option>
                                    <option value="0">未訂閱</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>帳號狀態</label>
                                <select class="form-control" id="active">
                                    <option value="1">啟用</option>
                                    <option value="0">停用</option>
                                </select>
                            </div>
                        </div>
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
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {
    const csrf = '<?= $_SESSION['csrf'] ?>';
    const imgBaseUrl = '<?= htmlspecialchars($imgBaseUrl) ?>';
    
    // 初始化 DataTable
    const table = $('#memberTable').DataTable({
        responsive: true,
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" 
        },
        columnDefs: [
            { orderable: false, targets: [2, 10] } // 頭貼和操作列不排序
        ]
    });

    // 讀取所有會員資料
    function load() {
        $.ajax({
            url: 'memberSelectApi.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                table.clear();
                data.forEach(item => {
                    const statusBadge = item.帳號是否啟動 == 1 
                        ? '<span class="badge bg-success">啟用</span>' 
                        : '<span class="badge bg-secondary">停用</span>';
                    
                    const subscribeBadge = item.subscribe == 1 
                        ? '<span class="badge bg-info">已訂閱</span>' 
                        : '<span class="badge bg-light text-dark">未訂閱</span>';
                    
                    table.row.add([
                        `<a href="javascript:void(0)" class="edit" data-id="${item.MemberID}">
                            ${item.MemberID}
                        </a>`,
                        item.name,
                        `<img src="${imgBaseUrl}/${item.avatarname}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">`,
                        item.email,
                        item.gender || '-',
                        item.birthday || '-',
                        item.phone_number || '-',
                        item.address || '-',
                        subscribeBadge,
                        statusBadge,
                        `<div class="btn-group">
                            <button class="btn btn-sm btn-info edit" data-id="${item.MemberID}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete" data-id="${item.MemberID}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>`
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增會員
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
            url: 'memberInsertApi.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '會員已新增', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '新增失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 更新會員
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
            url: 'memberUpdateApi.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '會員已更新', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '更新失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 刪除會員
    function deleteMember(id) {
        Swal.fire({
            title: '確定刪除?',
            text: "此操作無法復原！",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '確定刪除',
            cancelButtonText: '取消'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'memberDeleteApi.php',
                    type: 'GET',
                    data: { id: id },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('刪除成功', '會員已被刪除', 'success');
                            load();
                        } else {
                            Swal.fire('錯誤', res.errorMessage || '刪除失敗', 'error');
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
            if (xhr.status === 401) location.href = '../login/login.php';
        });
    }

    // 重置表單
    function reset() {
        $('#form')[0].reset();
        $('#id').val('');
        $('#avatar').attr('src', `${imgBaseUrl}/avatar.png`);
        $('#password').attr('placeholder', '留空則不修改');
    }

    // UUID v4 生成函數
    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0;
            const v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    // 初始化
    load();

    // 新增按鈕
    $('#btnAdd').click(function() {
        reset();
        $('#modalTitle').text('新增會員');
        $('#password').attr('placeholder', '請輸入密碼');
        $('#modal').modal('show');
    });

    // 編輯會員
    $('#memberTable').on('click', '.edit', function () {
        const id = $(this).data('id');
        
        $.ajax({
            url: 'memberSelectApi.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                const member = data.find(m => m.MemberID == id);
                
                if (!member) {
                    Swal.fire('錯誤', '找不到會員資料', 'error');
                    return;
                }
                
                $('#id').val(member.MemberID);
                $('#name').val(member.name);
                $('#email').val(member.email);
                $('#password').val('');
                $('#gender').val(member.gender || '男');
                $('#birthday').val(member.birthday || '');
                $('#phone_number').val(member.phone_number || '');
                $('#address').val(member.address || '');
                $('#subscribe').val(member.subscribe || '0');
                $('#active').val(member.帳號是否啟動 || '1');
                $('#avatar').attr('src', `${imgBaseUrl}/${member.avatarname}`);
                
                $('#modalTitle').text('編輯會員');
                $('#password').attr('placeholder', '留空則不修改');
                $('#modal').modal('show');
            },
            error: handleError
        });
    });

    // 刪除會員
    $('#memberTable').on('click', '.delete', function () {
        const id = $(this).data('id');
        deleteMember(id);
    });

    // 儲存按鈕
    $('#btnSave').click(function() {
        // 表單驗證
        if (!$('#name').val() || !$('#email').val()) {
            Swal.fire('錯誤', '請填寫必填欄位', 'warning');
            return;
        }

        const id = $('#id').val();
        const fileInput = $('#file')[0];
        let avatarname = '';
        
        // 處理頭貼檔名
        if (fileInput.files[0]) {
            const originalFile = fileInput.files[0];
            const fileExtension = originalFile.name.split('.').pop();
            avatarname = `${generateUUID()}.${fileExtension}`;
        } else {
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
            phone_number: $('#phone_number').val(),
            address: $('#address').val(),
            subscribe: $('#subscribe').val(),
            active: $('#active').val(),
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
            // 檔案大小驗證 (5MB)
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire('錯誤', '圖片檔案不能超過 5MB', 'warning');
                $(this).val('');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = (e) => $('#avatar').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // Modal 關閉時重置
    $('#modal').on('hidden.bs.modal', reset);
});
</script>
</body>
</html>