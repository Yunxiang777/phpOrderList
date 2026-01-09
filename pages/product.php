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
    <title>商品管理</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>商品管理系統</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <!-- 新增商品 -->
                        <button type="button" class="btn btn-primary" id="btnAdd">
                            <i class="fas fa-plus-circle"></i> 新增商品
                        </button>
                    </div>
                    <!-- 商品列表 -->
                    <div class="card-body">
                        <table id="productTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>商品編號</th>
                                    <th>商品名稱</th>
                                    <th>規格</th>
                                    <th>尺寸</th>
                                    <th>價格</th>
                                    <th>庫存</th>
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

<!-- 商品編輯與新增 Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">商品編輯</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="id">
                    
                    <!-- 圖片上傳 -->
                    <div class="form-group text-center">
                        <img id="productImg" src="<?= $imgBaseUrl ?>/default.jpg" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換</p>
                        <input type="file" id="file" hidden accept="image/*">
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>商品名稱 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>分類 <span class="text-danger">*</span></label>
                                <select class="form-control" id="category" required>
                                    <option value="">請選擇分類</option>
                                    <option value="健身器材">健身器材</option>
                                    <option value="健身配件">健身配件</option>
                                    <option value="運動服飾">運動服飾</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>商品描述</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>規格</label>
                                <input type="text" class="form-control" id="specification" placeholder="例：重量、材質等">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>尺寸</label>
                                <input type="text" class="form-control" id="size" placeholder="例：S、M、L 或尺寸規格">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>價格 (NT$) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" min="0" step="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>庫存數量 <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quantity" min="0" step="1" required>
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
    
    // 初始化 DataTable
    const table = $('#productTable').DataTable({
        responsive: true,
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" 
        }
    });

    // 讀取所有商品資料
    function load() {
        $.ajax({
            url: '<?= $api['getAllProduct'] ?>',
            type: 'POST',
            data: { csrf: csrf },
            dataType: 'json',
            success: function (data) {
                table.clear();
                data.forEach(item => {
                    table.row.add([
                        `<a href="javascript:void(0)" class="edit" data-id="${item.p_id}">
                            #${item.p_id}
                        </a>`,
                        item.p_name + 
                          `<span class="ms-2 text-danger delete" 
                              data-id="${item.p_id}" 
                              style="cursor:pointer"
                              title="刪除">
                            &times;
                          </span>`,
                        item.p_specification || '-',
                        item.p_size || '-',
                        `<span class="text-success font-weight-bold">NT$ ${Number(item.p_price).toLocaleString()}</span>`,
                        `<span class="badge ${item.p_quantity > 10 ? 'badge-success' : item.p_quantity > 0 ? 'badge-warning' : 'badge-danger'}">${item.p_quantity}</span>`,
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增商品
    function create(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('productImg', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['addProduct'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '商品已新增', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '新增失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 更新商品
    function update(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加圖片檔案（如果有選擇新圖片）
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('productImg', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['updateProduct'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '商品已更新', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '更新失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 刪除商品
    function deleteProduct(id) {
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
                    url: '<?= $api['deleteProduct'] ?>',
                    type: 'POST',
                    data: { id: id, csrf },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('刪除成功', '商品已被刪除', 'success');
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
        $('#productImg').attr('src', `${imgBaseUrl}/default-product.png`);
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
        $('#modalTitle').text('新增商品');
        $('#modal').modal('show');
    });

    // 編輯商品
    $('#productTable').on('click', '.edit', function () {
        const id = $(this).data('id');
        
        $.ajax({
            url: '<?= $api['getProduct'] ?>',
            type: 'POST',
            data: { id, csrf },
            dataType: 'json',
            success: function (res) {
                const product = res.data;
                $('#id').val(product.p_id);
                $('#name').val(product.p_name);
                $('#description').val(product.p_description || '');
                $('#specification').val(product.p_specification || '');
                $('#size').val(product.p_size || '');
                $('#category').val(product.p_category);
                $('#price').val(product.p_price);
                $('#quantity').val(product.p_quantity);
                $('#productImg').attr('src', `${imgBaseUrl}/product/${product.p_image}`);
                
                $('#modalTitle').text('編輯商品');
                $('#modal').modal('show');
            },
            error: handleError
        });
    });

    // 刪除商品
    $('#productTable').on('click', '.delete', function () {
        const id = $(this).data('id');
        deleteProduct(id);
    });

    // 儲存按鈕
    $('#btnSave').click(function() {
        // 表單驗證
        if (!$('#name').val() || !$('#category').val() || !$('#price').val() || !$('#quantity').val()) {
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
            imgFileName = $('#productImg').attr('src').split('/').pop();
        }
        
        const data = {
            csrf,
            id,
            name: $('#name').val(),
            description: $('#description').val(),
            specification: $('#specification').val(),
            size: $('#size').val(),
            category: $('#category').val(),
            price: $('#price').val(),
            quantity: $('#quantity').val(),
            imgFileName: imgFileName
        };
        
        // 有id則更新，無則新增
        id ? update(data) : create(data);
    });

    // 圖片預覽處理
    $('#productImg').click(() => $('#file').click());
    
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
            reader.onload = (e) => $('#productImg').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // Modal 關閉時重置
    $('#modal').on('hidden.bs.modal', reset);
});
</script>
</body>
</html>