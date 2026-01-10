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
    <title>商品訂單管理</title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

    <!-- 選單列表 -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h1 class="mb-3 mb-md-0">實體商品訂單管理</h1>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="mr-2">
                                    <label class="small mb-1">起始日期</label>
                                    <input type="date" class="form-control form-control-sm" id="startDate">
                                </div>
                                <div class="mr-2">
                                    <label class="small mb-1">結束日期</label>
                                    <input type="date" class="form-control form-control-sm" id="endDate">
                                </div>
                                <div class="btn-group mt-4">
                                    <button type="button" class="btn btn-info btn-sm" id="btnSearch">
                                        <i class="fas fa-search"></i> 查詢
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" id="btnAdd">
                                        <i class="fas fa-plus"></i> 新增
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" id="btnToday">
                                        <i class="fas fa-calendar-day"></i> 本日
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" id="btnAll">
                                        <i class="fas fa-history"></i> 全部
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品列表 -->
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th width="10%">訂單編號</th>
                                    <th width="10%">會員編號</th>
                                    <th width="12%">付款方式</th>
                                    <th width="12%">物流方式</th>
                                    <th width="10%">收件人</th>
                                    <th width="12%">聯絡電話</th>
                                    <th width="20%">收件地址</th>
                                    <th width="14%">訂單日期</th>
                                </tr>
                            </thead>
                            <tbody id="orderTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
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

    // 讀取所有訂單
    function loadOrders(startDate = null, endDate = null) {
        const data = { csrf };
        if (startDate && endDate) {
            data.startDate = startDate;
            data.endDate   = endDate;
        }
        $.ajax({
            url: '<?= $api['getAllProductOrder'] ?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (orders) {
                renderOrders(orders);
            },
            error: handleError
        });
    }

    // 渲染訂單列表
    function renderOrders(orders) {
        const $tbody = $('#orderTable');
        $tbody.empty();

        if (orders.length === 0) {
            $tbody.html('<tr><td colspan="8" class="text-center text-muted py-4">查無訂單資料</td></tr>');
            return;
        }

        orders.forEach(order => {
            const row = $(`
                <tr class="order-row" data-id="${order.orderrealID}" style="cursor: pointer;">
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="mr-2">#${order.orderrealID}</span>
                            <button class="btn btn-sm btn-link edit-btn p-0" data-id="${order.orderrealID}">
                                <i class="fas fa-edit text-info"></i>
                            </button>
                            <button class="btn btn-sm btn-link delete-btn p-0 ml-2" data-id="${order.orderrealID}">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </div>
                    </td>
                    <td>${order.orderrealmemberID} (${order.member_name})</td>
                    <td><span class="badge badge-primary">${order.PAY_methods}</span></td>
                    <td><span class="badge badge-info">${order.Shipping_methods}</span></td>
                    <td>${order.receiver}</td>
                    <td>${order.receiver_phone}</td>
                    <td><small>${order.Shipping_address}</small></td>
                    <td><small>${order.orderreal_date}</small></td>
                </tr>
                <tr class="order-details" id="details-${order.orderrealID}" style="display:none;">
                    <td colspan="8" class="bg-light p-0">
                        <div class="p-3" id="items-${order.orderrealID}">
                            <div class="text-center text-muted">
                                <i class="fas fa-spinner fa-spin"></i> 載入中...
                            </div>
                        </div>
                    </td>
                </tr>
            `);
            $tbody.append(row);
        });
    }

    // 載入訂單明細
    function loadOrderDetails(orderId) {
        const $container = $(`#items-${orderId}`);
        
        $.ajax({
            url: '<?= $api['productOrderGetDetails'] ?>',
            type: 'POST',
            data: { orderId, csrf },
            dataType: 'json',
            success: function (items) {
                if (items.length === 0) {
                    $container.html('<p class="text-muted text-center">此訂單無商品項目</p>');
                    return;
                }

                let html = '<div class="row">';
                items.forEach(item => {
                    html += `
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex">
                                        <img src="${imgBaseUrl}/product/${item.p_image}" 
                                             class="mr-3" 
                                             style="width:80px;height:80px;object-fit:cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">${item.p_name}</h6>
                                            <p class="mb-1 text-muted small">
                                                規格: ${item.p_specification || '標準'} | 
                                                尺寸: ${item.p_size || '均碼'}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-primary font-weight-bold">NT$ ${item.p_price}</span>
                                                <span class="badge badge-secondary">x${item.buynum}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                $container.html(html);
            },
            error: function() {
                $container.html('<p class="text-danger text-center">載入失敗</p>');
            }
        });
    }

    // 點擊訂單行展開/收合
    $(document).on('click', '.order-row', function(e) {
        if ($(e.target).closest('button').length) return;
        
        const orderId = $(this).data('id');
        const $details = $(`#details-${orderId}`);
        
        if ($details.is(':visible')) {
            $details.hide();
        } else {
            $('.order-details').hide();
            $details.show();
            
            if ($(`#items-${orderId}`).find('.fa-spinner').length) {
                loadOrderDetails(orderId);
            }
        }
    });

    // 新增訂單
    $('#btnAdd').click(async function () {

        const { value: formValues } = await Swal.fire({
            title: '新增訂單',
            html: `
                <input id="swal-memberID" class="swal2-input" placeholder="會員編號" required>

                <select id="swal-payment" class="swal2-input">
                    <option value="">請選擇付款方式</option>
                    <option value="信用卡付款">信用卡付款</option>
                    <option value="ATM轉帳">ATM轉帳</option>
                </select>

                <select id="swal-shipping" class="swal2-input">
                    <option value="">請選擇物流方式</option>
                    <option value="7-11超商取貨">7-11超商取貨</option>
                    <option value="黑貓宅配">黑貓宅配</option>
                </select>

                <input id="swal-receiver" class="swal2-input" placeholder="收件人" required>
                <input id="swal-phone" class="swal2-input" placeholder="聯絡電話" required>
                <input id="swal-address" class="swal2-input" placeholder="收件地址" required>
                <input id="swal-code" class="swal2-input" placeholder="物流條碼">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: '下一步',
            cancelButtonText: '取消',
            preConfirm: () => {
                const memberID = $('#swal-memberID').val();
                const payment  = $('#swal-payment').val();
                const shipping = $('#swal-shipping').val();
                const receiver = $('#swal-receiver').val();
                const phone    = $('#swal-phone').val();
                const address  = $('#swal-address').val();
                const code     = $('#swal-code').val();

                if (!memberID || !payment || !shipping || !receiver || !phone || !address) {
                    Swal.showValidationMessage('請填寫所有必填欄位');
                    return false;
                }

                return {
                    memberID,
                    payment,
                    shipping,
                    receiver,
                    phone,
                    address,
                    code
                };
            }
        });

        if (formValues) {
            createOrder(formValues);
        }
    });


    // 建立訂單
    function createOrder(data) {
        $.ajax({
            url: './orderALLapi/orderInsertApi.php',
            type: 'POST',
            data: { ...data, csrf },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    addOrderItems(res.orderId);
                } else {
                    Swal.fire('錯誤', res.errorMessage || '建立訂單失敗', 'error');
                }
            },
            error: handleError
        });
    }

    // 新增訂單項目（遞迴）
    async function addOrderItems(orderId) {
        const { value: item } = await Swal.fire({
            title: `訂單 #${orderId} - 新增商品`,
            html: `
                <input id="swal-productID" class="swal2-input" placeholder="商品編號" required>
                <input id="swal-quantity" type="number" class="swal2-input" placeholder="數量" min="1" required>
            `,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: '繼續新增',
            denyButtonText: '完成',
            cancelButtonText: '取消',
            preConfirm: () => ({
                productID: $('#swal-productID').val(),
                quantity: $('#swal-quantity').val()
            })
        });

        if (item && item.productID && item.quantity) {
            $.ajax({
                url: './orderALLapi/orderAddItem.php',
                type: 'POST',
                data: { orderId, ...item, csrf },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        addOrderItems(orderId); // 繼續新增
                    } else {
                        Swal.fire('錯誤', res.errorMessage, 'error');
                    }
                },
                error: handleError
            });
        } else if (item === false) {
            // 按下"完成"
            Swal.fire('成功', '訂單已建立', 'success');
            loadOrders();
        }
    }

    // 編輯訂單
    $(document).on('click', '.edit-btn', function(e) {
        e.stopPropagation();
        const orderId = $(this).data('id');
        
        $.ajax({
            url: './orderALLapi/orderGetApi.php',
            type: 'POST',
            data: { orderId, csrf },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    showEditModal(res.data);
                }
            },
            error: handleError
        });
    });

    // 顯示編輯對話框
    async function showEditModal(order) {
        const { value: formValues } = await Swal.fire({
            title: `編輯訂單 #${order.orderrealID}`,
            html: `
                <input id="swal-payment" class="swal2-input" value="${order.PAY_methods}">
                <input id="swal-shipping" class="swal2-input" value="${order.Shipping_methods}">
                <input id="swal-receiver" class="swal2-input" value="${order.receiver}">
                <input id="swal-phone" class="swal2-input" value="${order.receiver_phone}">
                <input id="swal-address" class="swal2-input" value="${order.Shipping_address}">
            `,
            showCancelButton: true,
            confirmButtonText: '儲存',
            cancelButtonText: '取消',
            preConfirm: () => ({
                orderId: order.orderrealID,
                payment: $('#swal-payment').val(),
                shipping: $('#swal-shipping').val(),
                receiver: $('#swal-receiver').val(),
                phone: $('#swal-phone').val(),
                address: $('#swal-address').val()
            })
        });

        if (formValues) {
            updateOrder(formValues);
        }
    }

    // 更新訂單
    function updateOrder(data) {
        $.ajax({
            url: './orderALLapi/orderUpdateApi.php',
            type: 'POST',
            data: { ...data, csrf },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    Swal.fire('成功', '訂單已更新', 'success');
                    loadOrders();
                } else {
                    Swal.fire('錯誤', res.errorMessage, 'error');
                }
            },
            error: handleError
        });
    }

    // 刪除訂單
    $(document).on('click', '.delete-btn', function(e) {
        e.stopPropagation();
        const orderId = $(this).data('id');
        
        Swal.fire({
            title: '確定刪除？',
            text: `訂單 #${orderId} 及其所有商品項目將被刪除`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '確定刪除',
            cancelButtonText: '取消'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './orderALLapi/orderDeleteApi.php',
                    type: 'POST',
                    data: { orderId, csrf },
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('已刪除', '訂單已被刪除', 'success');
                            loadOrders();
                        } else {
                            Swal.fire('錯誤', res.errorMessage, 'error');
                        }
                    },
                    error: handleError
                });
            }
        });
    });

    // 查詢日期區間
    $('#btnSearch').click(function() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();
        
        if (!startDate || !endDate) {
            Swal.fire('提示', '請選擇起始和結束日期', 'warning');
            return;
        }
        
        loadOrders(startDate, endDate);
    });

    // 本日訂單
    $('#btnToday').click(function() {
        const today = new Date().toISOString().split('T')[0];
        loadOrders(today, today);
    });

    // 所有訂單
    $('#btnAll').click(function() {
        loadOrders();
    });

    // 錯誤處理
    function handleError(xhr) {
        const msg = {
            401: '登入已過期，請重新登入',
            403: '安全驗證失敗',
            500: '伺服器錯誤'
        }[xhr.status] || '操作失敗';
        
        Swal.fire('錯誤', msg, 'error');
    }

    // 初始化
    loadOrders();
});
</script>
</body>
</html>