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
    <title>影音管理</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>影音管理系統</h1>
            </div>
        </section>
        
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <!-- 新增影片 -->
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" id="btnAdd">
                            <i class="fas fa-plus-circle"></i> 新增影片
                        </button>
                    </div>
                    <!-- 影片列表 -->
                    <div class="card-body">
                        <table id="videoTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>編號</th>
                                    <th>標題</th>
                                    <th>影片</th>
                                    <th>上架日期</th>
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

<!-- 影片編輯與新增 Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle">影片編輯</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="id">
                    
                    <!-- 縮圖上傳 -->
                    <div class="form-group text-center">
                        <img id="thumbnail" src="<?= $imgBaseUrl ?>/video.png" class="img-thumbnail" style="width: 300px; height: 200px; object-fit: cover; cursor: pointer;">
                        <p class="small text-muted">點擊圖片更換縮圖</p>
                        <input type="file" id="file" hidden accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>影片標題 <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>上架日期 <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="releaseDate" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>肌群分類 <span class="text-danger">*</span></label>
                                <select class="form-control" id="muscleGroup" required>
                                    <option value="">請選擇肌群</option>
                                    <option value="1">胸肌</option>
                                    <option value="2">背肌</option>
                                    <option value="3">腹肌</option>
                                    <option value="4">腿部肌群</option>
                                    <option value="5">肩部肌群</option>
                                    <option value="6">手臂肌群</option>
                                    <option value="7">臀肌</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>影片描述</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>YouTube 影片網址 <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="url" placeholder="https://www.youtube.com/embed/..." required>
                        <small class="form-text text-muted">請輸入 YouTube 嵌入網址</small>
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

<!-- 影片播放 Modal -->
<div class="modal fade" id="videoModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">影片播放</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="videoPlayer" src="" allowfullscreen></iframe>
                </div>
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
    
    // 肌群對應
    const muscleGroups = {
        1: '胸肌', 2: '背肌', 3: '腹肌', 
        4: '腿部肌群', 5: '肩部肌群', 6: '手臂肌群', 7: '臀肌'
    };
    
    // 初始化 DataTable
    const table = $('#videoTable').DataTable({
        responsive: true,
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json" 
        }
    });

    // 讀取所有影片資料
    function load() {
        $.ajax({
            url: '<?= $api['getAllVideo'] ?>',
            type: 'POST',
            data: { csrf: csrf },
            dataType: 'json',
            success: function (data) {
                table.clear();
                data.forEach(item => {
                    table.row.add([
                        `<a href="javascript:void(0)" class="edit" data-id="${item.VideoID}">
                            #${item.VideoID}
                        </a>`,
                        item.Title  + 
                          `<span class="ms-2 text-danger delete" 
                              data-id="${item.VideoID}" 
                              style="cursor:pointer"
                              title="刪除">
                            &times;
                          </span>` ,
                        `<button class="btn btn-sm btn-warning play-video" data-url="${item.URL}">
                            <i class="fas fa-play"></i> 播放
                        </button>`,
                        item.ReleaseDate,
                    ]);
                });
                table.draw();
            },
            error: handleError
        });
    }

    // 新增影片
    function create(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加縮圖檔案
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('thumbnail', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['addVideo'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '影片已新增', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '新增失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 更新影片
    function update(data) {
        const formData = new FormData();
        
        // 添加所有表單資料
        Object.keys(data).forEach(key => {
            formData.append(key, data[key]);
        });
        
        // 添加縮圖檔案（如果有選擇新圖片）
        const fileInput = $('#file')[0];
        if (fileInput.files[0]) {
            formData.append('thumbnail', fileInput.files[0]);
        }
        
        $.ajax({
            url: '<?= $api['updateVideo'] ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    Swal.fire('成功', '影片已更新', 'success');
                    $('#modal').modal('hide');
                    load();
                } else {
                    Swal.fire('錯誤', res.errorMessage || '更新失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 刪除影片
    function deleteVideo(id) {
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
                    url: '<?= $api['deleteVideo'] ?>',
                    type: 'POST',
                    data: { id: id, csrf: csrf },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('刪除成功', '影片已被刪除', 'success');
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
        $('#thumbnail').attr('src', `${imgBaseUrl}/default-video.png`);
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
        $('#modalTitle').text('新增影片');
        $('#modal').modal('show');
    });

    // 編輯影片
    $('#videoTable').on('click', '.edit', function () {
        const id = $(this).data('id');
        
        $.ajax({
            url: '<?= $api['getVideo'] ?>',
            type: 'POST',
            data: { id: id, csrf: csrf },
            dataType: 'json',
            success: function (res) {
                if (!res.success) {
                    Swal.fire('錯誤', res.errorMessage || '讀取失敗', 'error');
                    return;
                }
                
                const video = res.data;
                $('#id').val(video.VideoID);
                $('#title').val(video.Title);
                $('#releaseDate').val(video.ReleaseDate);
                $('#description').val(video.Description || '');
                $('#url').val(video.URL);
                $('#muscleGroup').val(video.musclegroupID);
                $('#thumbnail').attr('src', `${imgBaseUrl}/video/${video.vidthumbnail}`);
                
                $('#modalTitle').text('編輯影片');
                $('#modal').modal('show');
            },
            error: handleError
        });
    });

    // 刪除影片
    $('#videoTable').on('click', '.delete', function () {
        const id = $(this).data('id');
        deleteVideo(id);
    });

    // 轉換 YouTube 連結為嵌入格式
    function toYoutubeEmbed(url) {
        let videoId = '';

        // https://www.youtube.com/watch?v=xxxx
        if (url.includes('watch?v=')) {
            videoId = url.split('watch?v=')[1].split('&')[0];
        }
        // https://youtu.be/xxxx
        else if (url.includes('youtu.be/')) {
            videoId = url.split('youtu.be/')[1].split('?')[0];
        }

        return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
    }


    // 播放影片
    $('#videoTable').on('click', '.play-video', function () {
        const embedUrl = toYoutubeEmbed($(this).data('url'));

        if (!embedUrl) {
            alert('影片網址格式錯誤');
            return;
        }

        $('#videoPlayer').attr('src', embedUrl + '?autoplay=1');
        $('#videoModal').modal('show');
    });

    // 停止播放
    $('#videoModal').on('hidden.bs.modal', function () {
        $('#videoPlayer').attr('src', '');
    });

    // 儲存按鈕
    $('#btnSave').click(function() {
        // 表單驗證
        if (!$('#title').val() || !$('#releaseDate').val() || !$('#url').val() || !$('#muscleGroup').val()) {
            Swal.fire('錯誤', '請填寫必填欄位', 'warning');
            return;
        }

        const id = $('#id').val();
        const fileInput = $('#file')[0];
        let thumbnailName = '';
        
        // 處理縮圖檔名
        if (fileInput.files[0]) {
            const originalFile = fileInput.files[0];
            const fileExtension = originalFile.name.split('.').pop();
            thumbnailName = `${generateUUID()}.${fileExtension}`;
        } else {
            thumbnailName = $('#thumbnail').attr('src').split('/').pop();
        }
        
        const data = {
            csrf,
            id,
            title: $('#title').val(),
            releaseDate: $('#releaseDate').val(),
            description: $('#description').val(),
            url: $('#url').val(),
            muscleGroup: $('#muscleGroup').val(),
            thumbnailName: thumbnailName
        };
        
        // 有id則更新，無則新增
        id ? update(data) : create(data);
    });

    // 縮圖預覽處理
    $('#thumbnail').click(() => $('#file').click());
    
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
            reader.onload = (e) => $('#thumbnail').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // Modal 關閉時重置
    $('#modal').on('hidden.bs.modal', reset);
});
</script>
</body>
</html>