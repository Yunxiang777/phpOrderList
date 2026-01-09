<?php
require_once __DIR__ . '/../bootstrap.php';
require_once ROOT_PATH . '/app/auth/auth.php';

// CSRF Token
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

// 共用參數
$imgBaseUrl = $config['routes']['img'];
$api = $config['api'];
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>食物資料管理</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>食物資料管理系統</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <!-- 新增食物 -->
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" id="btnAdd">
                            <i class="fas fa-plus-circle"></i> 新增食物
                        </button>
                    </div>
                    <!-- 食物列表 -->
                    <div class="card-body">
                        <table id="foodTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>食物編號</th>
                                    <th>食物名稱</th>
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

<!-- 食物編輯與新增 Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">食物編輯</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="id">
                    
                    <!-- 圖片上傳 -->
                    <div class="form-group text-center">
                        <img id="foodImg" src="<?= $imgBaseUrl ?>/default-food.png" class="img-thumbnail" style="width: 200px; height: 150px; object-fit: cover; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換</p>
                        <input type="file" id="file" hidden accept="image/*">
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>食物名稱 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="foodName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>分類 <span class="text-danger">*</span></label>
                                <select class="form-control" id="categoryId" required>
                                    <option value="1">飯</option>
                                    <option value="2">麵</option>
                                    <option value="3">早餐</option>
                                    <option value="4">湯</option>
                                    <option value="5">飲料</option>
                                    <option value="6">其他</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>熱量 (cal) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="calorie" min="0" step="0.1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>脂肪 (g) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="fat" min="0" step="0.1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>蛋白質 (g) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="protein" min="0" step="0.1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>碳水化合物 (g) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="carbohydrates" min="0" step="0.1" required>
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
<script src="<?= BASE_PATH ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_PATH ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_PATH ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_PATH ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script>
$(function () {
    const csrf = '<?= $_SESSION['csrf'] ?>';
    const imgBaseUrl = '<?= htmlspecialchars($imgBaseUrl) ?>';
    
    // 分類對應
    const categories = {
        1: '飯', 2: '麵', 3: '早餐', 
        4: '湯', 5: '飲料', 6: '其他'
    };
    
    // 初始化 DataTable
    const table = $('#foodTable').DataTable({
        responsive: true,
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" 
        }
    });

    // 讀取所有食物資料
    function load() {
        $.ajax({
            url: '<?= $api['getAllFood'] ?>',
            type: 'POST',
            dataType: 'json',
            data: { csrf },
            success: function (data) {
                table.clear();                
                data.forEach(item => {
                    table.row.add([
                        `<a href="javascript:void(0)" class="edit" data-id="${item.FoodID}">${item.FoodID}</a>`,
                          item.FoodName + 
                          `<span class="ms-2 text-danger delete" 
                              data-id="${item.FoodID}" 
                              style="cursor:pointer"
                              title="刪除">
                            &times;
                          </span>`
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增食物
    function create(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('foodImg', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['addFood'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '食物已新增', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '新增失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 更新食物
    function update(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案（如果有選擇新圖片）
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('foodImg', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['updateFood'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '食物已更新', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '更新失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 刪除食物
    function deleteFood(id) {
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
                    url: '<?= $api['deleteFood'] ?>',
                    type: 'POST',
                    data: { id, csrf },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('刪除成功', '食物已被刪除', 'success');
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
        $('#foodImg').attr('src', `${imgBaseUrl}/default-food.png`);
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
        $('#modalTitle').text('新增食物');
        $('#modal').modal('show');
    });

    // 編輯食物
    $('#foodTable').on('click', '.edit', function () {
        const id = $(this).data('id');
        $.ajax({
            url: '<?= $api['getFood'] ?>',
            type: 'POST',
            data: { id, csrf },
            dataType: 'json',
            success: function (res) {                
                const food = res.data;
                $('#id').val(food.FoodID);
                $('#foodName').val(food.FoodName);
                $('#calorie').val(food.Calorie);
                $('#fat').val(food.Fat);
                $('#protein').val(food.Protein);
                $('#carbohydrates').val(food.Carbohydrates);
                $('#categoryId').val(food.Food_categoryID);
                $('#foodImg').attr('src', `${imgBaseUrl}/food/${food.FoodImgID}`);
                
                $('#modalTitle').text('編輯食物');
                $('#modal').modal('show');
            },
            error: handleError
        });
    });

    // 刪除食物
    $('#foodTable').on('click', '.delete', function () {
        const id = $(this).data('id');
        deleteFood(id);
    });

    // 儲存按鈕
    $('#btnSave').click(function() {
        // 表單驗證
        if (!$('#foodName').val() || !$('#calorie').val()) {
            Swal.fire('錯誤', '請填寫必填欄位', 'warning');
            return;
        }

        const id = $('#id').val();
        const fileInput = $('#file')[0];
        let imgFileName = '';
        
        // 處理圖片檔名
        if (fileInput.files[0]) {
            const originalFile = fileInput.files[0];
            const fileExtension = originalFile.name.split('.').pop();
            imgFileName = `${generateUUID()}.${fileExtension}`;
        } else {
            imgFileName = $('#foodImg').attr('src').split('/').pop();
        }
        
        const data = {
            csrf,
            id,
            foodName: $('#foodName').val(),
            calorie: $('#calorie').val(),
            fat: $('#fat').val(),
            protein: $('#protein').val(),
            carbohydrates: $('#carbohydrates').val(),
            categoryId: $('#categoryId').val(),
            imgFileName: imgFileName
        };
        
        // 有id則更新，無則新增
        id ? update(data) : create(data);
    });

    // 圖片預覽處理
    $('#foodImg').click(() => $('#file').click());
    
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
            reader.onload = (e) => $('#foodImg').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // Modal 關閉時重置
    $('#modal').on('hidden.bs.modal', reset);
});
</script>
</body>
</html>