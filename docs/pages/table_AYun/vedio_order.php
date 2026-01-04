<?php
require_once ("db_database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Simple Tables</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css"
    rel="stylesheet" type="text/css" />

  <style>
    .deleteVedio {
      cursor: pointer;
    }

    .deleteallvedioItem {
      cursor: pointer;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="" class="brand-link">
        <img src="../table_Tung/logo/logo.png" alt=" Logo" class=" img-rounded " style="opacity: .9; display:block; margin:auto;" >
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
        <!-- 側欄位 -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  訂單管理
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="order_chart.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>趨勢分析圖表</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="realItem_order.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>實體商品訂單管理</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="vedio_order.html" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>線上課程訂單管理</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- 側欄位 -->

      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div id="test"></div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header justify-content-between" style="display: flex; align-items: center; ">
                  <div class="card-title">
                    <h1 style=" font-size: 50px; font-weight: bold; ">線上課程訂單管理</h1>
                  </div>



                  <div class="ui form ml-5" style="width:60%; ">
                    <div class="two fields ml-5">
                      <div class="field">
                        <label style=" font-size: 20px;">起始日期</label>
                        <div class=" ui calendar" id="rangestart">
                          <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" placeholder="Start" id="startDate">
                          </div>
                        </div>
                      </div>
                      <div class="field">
                        <label style=" font-size: 20px;">結束日期</label>
                        <div class="ui calendar" id="rangeend">
                          <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" placeholder="End" id="endDate">
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-outline-info" id="getvediodate"
                        style="width: 180px; height: 60px; font-size: 20px; font-weight: bold; ">查詢日期
                      </button>
                      <button type="button" class="btn btn-outline-primary ml-2" id="addsub"
                        style="width: 180px; height: 60px; font-size: 20px; font-weight: bold; ">訂閱新增
                      </button>
                      <button type="button" class="btn btn-outline-warning ml-2" id="addvedio_order"
                        style="width: 180px; height: 60px; font-size: 20px; font-weight: bold; ">課程授權
                      </button>
                      <button type="button" class="btn btn-outline-success ml-2" id="historyOrder"
                        style="width: 180px; height: 60px; font-size: 20px; font-weight: bold; ">所有歷史
                      </button>

                    </div>
                  </div>



                </div>
                <!-- ./card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="text-align: center;">
                        <th>課程訂單編號</th>
                        <th>訂購會員編號</th>
                        <th>會員姓名</th>
                        <th>會員照片</th>
                        <th>聯絡信箱</th>
                        <th>聯絡電話</th>
                        <th>訂單成立日期</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyshowtalbe">

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
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

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script
    src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
  <script>



    $(document).ready(function () {

      //查詢日期區間的訂單
      function getaDate(startDate, endDate) {
        $.ajax({
          url: './orderALLapi/vedio_getdate.php',
          type: 'POST',
          async: false,
          data: {
            startDate: startDate,
            endDate: endDate
          },
          dataType: 'json'
        }).done(function (users) {

          const docFrag = $(document.createDocumentFragment()); //建立一個空的物件
          $.each(users, function (idx, vedio_order_Detail) {
            const { ordervideoID, ordervideomemberID, ordervideodDate } = vedio_order_Detail;
            //ordervideoID是主訂單流水號 , ordervideomemberID購買的會員,ordervideodDate訂單成立的時間
            $.ajax({
              url: './orderALLapi/vedio_showdetail.php',
              type: 'GET',
              async: false,
              data: { "id": ordervideomemberID },
              dataType: 'json'
            }).done(function (member) {
              const { name, avatarname, email, phone_number } = member;
              //此訂單的會員 名字,頭像,mail,電話
              const data = `
                        <tr data-widget="expandable-table" aria-expanded="false" >
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
                              ${ordervideoID}
                              <i class="fas fa-trash-alt deleteallvedioItem" style="color: #fd0d0d; margin-left: 30px; font-size: 18px; font-weight: bold;" id="allvedioItem${ordervideoID}"></i>
                            </td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;" >${ordervideomemberID}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${name}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;"><img src="./orderALLimg/user_image/${avatarname}" style="width:100px;height:100px"></td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${email}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${phone_number}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${ordervideodDate}</td>
                        </tr>
                        <tr class="expandable-body d-none" >
                            <td colspan="7" id="${ordervideoID}" >
                              
                            </td>
                        </tr>`;

              docFrag.append(data);
            })

          });
          $('#tbodyshowtalbe').html(docFrag);
        });

        // 以下開始把買斷影片的訂單細節,加到下拉部分
        $('#tbodyshowtalbe tr').each(function () {
          // console.log("123");
          $(this).find('[colspan="7"]').each(function () {
            const orderID = $(this).attr('id');
            // console.log(orderID);
            $.ajax({
              url: './orderALLapi/vedio_getbyout.php',
              type: 'GET',
              async: false,
              data: { "id": orderID },
              dataType: 'json'
              // orderID就是影片訂單的編號
            }).done(function (vedio) {
              // const docFragvedio = $(document.createDocumentFragment()); //建立一個空的物件
              $.each(vedio, function (idx, Buyvedio) {


                const { ordervideoDetail_ID, ordervideoDetail_VideoID, canview_startTime } = Buyvedio;
                //ordervideoDetail_VideoID 就是fitvideos要抓的影片id
                // ordervideoDetail_ID 是影片詳情的流水號
                $.ajax({
                  url: './orderALLapi/vedio_getvedio.php',
                  type: 'GET',
                  async: false,
                  data: { "id": ordervideoDetail_VideoID },
                  dataType: 'json'
                  // orderID就是影片訂單的編號
                }).done(function (vediodetail) {
                  $.each(vediodetail, function (idx, end) {
                    const { Title, vidthumbnail } = end;
                    const data = `<div style="display: none; background-color: rgb(248, 245, 240); font-size: 18px; font-weight: bold; border-bottom: 0.4rem solid;" class="d-flex align-items-center" >
             <div style="width:15%" >
              <img src="./orderALLimg/video_image/${vidthumbnail}" style="width:150px;height:150px">
             </div >
             <div style="width:30% ">
               課程名稱 : ${Title} 
             </div>
             <div style="width:30%">
               權限起始日:${canview_startTime} 
             </div>
             <div style="width:20%">
               權限終止日:永久
             </div>
             <div style="width:5%">
              <i class="fas fa-trash-alt deleteVedio" style="color: #fd0d0d;" id="vediodetail${ordervideoDetail_ID}"></i>
             </div>
           </div>`;
                    $('#' + orderID).append(data);
                  })
                })
              })
            })
            //把訂閱也加入
            $.ajax({
              url: './orderALLapi/vedio_getsub.php',
              type: 'GET',
              async: false,
              data: { "id": orderID },
              dataType: 'json'
              // orderID就是影片訂單的編號
            }).done(function (resultsub) {
              const { ordervideoDetail_ID, sub_time, canview_startTime, canview_endTime } = resultsub;
              // ordervideoDetail_ID 是pr_key,影片detail的流水號
              if (sub_time != null) {
                const data = `<div style="display: none; background-color: rgb(248, 245, 240); font-size: 18px; font-weight: bold; border-bottom: 0.4rem solid;" class="d-flex align-items-center" >
             <div style="width:15%" >
              <img src="https://profounder.com/wp-content/uploads/2021/06/YouTube-Watermark-Subscribe-Button.png" style="width:150px;height:150px">
             </div >
             <div style="width:30% ">
               訂閱時長 : ${sub_time}天
             </div>
             <div style="width:30%">
               權限起始日:${canview_startTime} 
             </div>
             <div style="width:20%">
               權限終止日:${canview_endTime} 
             </div>
             <div style="width:5%" >
              <i class="fas fa-trash-alt deleteVedio" style="color: #fd0d0d;" id="vediodetail${ordervideoDetail_ID}"></i>
             </div>
           </div>`;
                $('#' + orderID).append(data);
              } else { }
            })

          })
        })
      }

      //秀出整個table
      function ShowUsers() {
        //叫出影片訂單的main
        $.ajax({
          url: './orderALLapi/vedio_showtable.php',
          type: 'GET',
          async: false,
          dataType: 'json'
        }).done(function (users) {

          const docFrag = $(document.createDocumentFragment()); //建立一個空的物件
          $.each(users, function (idx, vedio_order_Detail) {
            const { ordervideoID, ordervideomemberID, ordervideodDate } = vedio_order_Detail;
            //ordervideoID是主訂單流水號 , ordervideomemberID購買的會員,ordervideodDate訂單成立的時間
            $.ajax({
              url: './orderALLapi/vedio_showdetail.php',
              type: 'GET',
              async: false,
              data: { "id": ordervideomemberID },
              dataType: 'json'
            }).done(function (member) {
              const { name, avatarname, email, phone_number } = member;
              //此訂單的會員 名字,頭像,mail,電話
              const data = `
                        <tr data-widget="expandable-table" aria-expanded="false" >
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
                              ${ordervideoID}
                              <i class="fas fa-trash-alt deleteallvedioItem" style="color: #fd0d0d; margin-left: 30px; font-size: 18px; font-weight: bold;" id="allvedioItem${ordervideoID}"></i>
                            </td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;" >${ordervideomemberID}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${name}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;"><img src="./orderALLimg/user_image/${avatarname}" style="width:100px;height:100px"></td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${email}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${phone_number}</td>
                            <td style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">${ordervideodDate}</td>
                        </tr>
                        <tr class="expandable-body d-none" >
                            <td colspan="7" id="${ordervideoID}" >
                              
                            </td>
                        </tr>`;

              docFrag.append(data);
            })

          });
          $('#tbodyshowtalbe').html(docFrag);
        });

        // 以下開始把買斷影片的訂單細節,加到下拉部分
        $('#tbodyshowtalbe tr').each(function () {
          // console.log("123");
          $(this).find('[colspan="7"]').each(function () {
            const orderID = $(this).attr('id');
            // console.log(orderID);
            $.ajax({
              url: './orderALLapi/vedio_getbyout.php',
              type: 'GET',
              async: false,
              data: { "id": orderID },
              dataType: 'json'
              // orderID就是影片訂單的編號
            }).done(function (vedio) {
              // const docFragvedio = $(document.createDocumentFragment()); //建立一個空的物件
              $.each(vedio, function (idx, Buyvedio) {


                const { ordervideoDetail_ID, ordervideoDetail_VideoID, canview_startTime } = Buyvedio;
                //ordervideoDetail_VideoID 就是fitvideos要抓的影片id
                // ordervideoDetail_ID 是影片詳情的流水號
                $.ajax({
                  url: './orderALLapi/vedio_getvedio.php',
                  type: 'GET',
                  async: false,
                  data: { "id": ordervideoDetail_VideoID },
                  dataType: 'json'
                  // orderID就是影片訂單的編號
                }).done(function (vediodetail) {
                  $.each(vediodetail, function (idx, end) {
                    const { Title, vidthumbnail } = end;
                    const data = `<div style="display: none; background-color: rgb(248, 245, 240); font-size: 18px; font-weight: bold; border-bottom: 0.4rem solid;" class="d-flex align-items-center" >
                       <div style="width:15%" >
                        <img src="./orderALLimg/video_image/${vidthumbnail}" style="width:150px;height:150px">
                       </div >
                       <div style="width:30% ">
                         課程名稱 : ${Title} 
                       </div>
                       <div style="width:30%">
                         權限起始日:${canview_startTime} 
                       </div>
                       <div style="width:20%">
                         權限終止日:永久
                       </div>
                       <div style="width:5%">
                        <i class="fas fa-trash-alt deleteVedio" style="color: #fd0d0d;" id="vediodetail${ordervideoDetail_ID}"></i>
                       </div>
                     </div>`;
                    $('#' + orderID).append(data);
                  })
                })
              })
            })
            //把訂閱也加入
            $.ajax({
              url: './orderALLapi/vedio_getsub.php',
              type: 'GET',
              async: false,
              data: { "id": orderID },
              dataType: 'json'
              // orderID就是影片訂單的編號
            }).done(function (resultsub) {
              const { ordervideoDetail_ID, sub_time, canview_startTime, canview_endTime } = resultsub;
              // ordervideoDetail_ID 是pr_key,影片detail的流水號
              if (sub_time != null) {
                const data = `<div style="display: none; background-color: rgb(248, 245, 240); font-size: 18px; font-weight: bold; border-bottom: 0.4rem solid;" class="d-flex align-items-center" >
                       <div style="width:15%" >
                        <img src="https://profounder.com/wp-content/uploads/2021/06/YouTube-Watermark-Subscribe-Button.png" style="width:150px;height:150px">
                       </div >
                       <div style="width:30% ">
                         訂閱時長 : ${sub_time}天
                       </div>
                       <div style="width:30%">
                         權限起始日:${canview_startTime} 
                       </div>
                       <div style="width:20%">
                         權限終止日:${canview_endTime} 
                       </div>
                       <div style="width:5%" >
                        <i class="fas fa-trash-alt deleteVedio" style="color: #fd0d0d;" id="vediodetail${ordervideoDetail_ID}"></i>
                       </div>
                     </div>`;
                $('#' + orderID).append(data);
              } else { }
            })

          })
        })
      }
      ShowUsers();

      //打開新增訂閱訂單彈跳視窗
      function openOrderModal() {
        Swal.fire({
          title: '新增會員訂閱',
          html: `
              <input type="text" id="memberID" class="swal2-input" placeholder="訂購會員編號">
              <div>
                <br/>
                <h1>輸入訂閱天數</h1>
                <input type="radio" id="90days" name="subscription" value="90"> <label for="90days">90天</label>
                <input type="radio" id="180days" name="subscription" value="180"> <label for="180days">180天</label>
                <input type="radio" id="365days" name="subscription" value="365"> <label for="365days">365天</label>
              </div>
            `,
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonText: '訂單執行',
          cancelButtonText: '取消動作',
          preConfirm: () => {
            const memberID = Swal.getPopup().querySelector('#memberID').value;
            const subscription = Swal.getPopup().querySelector('input[name="subscription"]:checked').value;

            $.ajax({
              url: './orderALLapi/vedio_savesuborder.php',
              type: 'POST',
              data: {
                memberID: memberID,
                subscription: subscription
              },
              dataType: 'json'
            }).done(function (response) {
              if (response.success) {
                Swal.fire('新增訂單成功', '', 'success').then(() => {
                  ShowUsers();
                });
              } else {
                Swal.fire('新增訂單失敗', response.message, 'error');
              }
            }).fail(function () {
              Swal.fire('新增訂單失敗', '發生錯誤，請稍後再試。', 'error');
            });
          }
        });
      }

      //打開課程授權訂單彈跳視窗
      function openvedioOrderModal() {
        Swal.fire({
          title: '新增課程授權訂單',
          html: `
            <input type="text" id="memberID" class="swal2-input" placeholder="訂購會員編號">
          `,
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonText: '成立訂單',
          cancelButtonText: '取消動作',
          preConfirm: () => {
            const memberID = Swal.getPopup().querySelector('#memberID').value;

            $.ajax({
              url: './orderALLapi/vedio_savevedioorder.php', // Replace with your server-side script URL
              type: 'POST',
              data: {
                memberID: memberID,
              },
              dataType: 'json'
            }).done(function (response) {
              if (response.success) {
                Swal.fire('新增訂單成功', '', 'success').then(() => {
                  openProductModal(response.ordervideoID);
                  //response.ordervideoID -> 這就是最新生成的ordervideoID
                });
              } else {
                Swal.fire('新增訂單失敗', response.message, 'error');
              }
            }).fail(function () {
              Swal.fire('新增訂單失敗', '發生錯誤，請稍後再試。', 'error');
            });
          }
        });
      }

      //新增買斷影片購物內容彈跳視窗
      function openProductModal(ordervideoID) {
        function addProductToOrder() {
          Swal.fire({
            title: `新增影片訂單號${ordervideoID}購物內容`,
            html: `
            <input type="text" id="productID" class="swal2-input" placeholder="課程編號">
          `,
            focusConfirm: false,
            confirmButtonText: '加入訂單細項',
            preConfirm: () => {
              //ordervideoID是關於影片的訂單編號
              const productID = Swal.getPopup().querySelector('#productID').value;
              // productID 是哪支影片的ID
              $.ajax({
                url: './orderALLapi/vedio_savebuynewvedio.php',
                type: 'POST',
                data: {
                  ordervideoDetail_ordervideoID: ordervideoID,
                  ordervideoDetail_VideoID: productID
                },
                dataType: 'json'
              }).done(function (response) {
                if (response.success) {
                  Swal.fire({
                    title: '新增購物內容成功',
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: '繼續新增',
                    cancelButtonText: '結束並完成'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      addProductToOrder(); // Continue adding products if "繼續新增" button is clicked
                    } else {
                      ShowUsers(); // Refresh the table when "結束並完成" button is clicked
                    }
                  });
                } else {
                  Swal.fire('新增購物內容失敗', response.message, 'error');
                }
              }).fail(function () {
                Swal.fire('新增購物內容失敗', '發生錯誤，請稍後再試。', 'error');
              });
            }
          });
        }
        addProductToOrder(); // 初始化
      }

      //新增"訂閱"執行
      $('#addsub').on('click', function () {
        openOrderModal();
      });

      //新增"課程授權"
      $('#addvedio_order').on('click', function () {
        openvedioOrderModal();
      });

      // 查詢日期區間方法 開始...
      $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend')
      });
      $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart')
      });

      $('#getvediodate').on('click', function () {
        const Date1 = new Date($('#startDate').val());
        Date1.setDate(Date1.getDate() + 1);
        const startDate = Date1.toISOString().split('T')[0];
        //startDate 是起始日期

        const Date2 = new Date($('#endDate').val());
        Date2.setDate(Date2.getDate() + 1);
        const endDate = Date2.toISOString().split('T')[0];
        //endDate 是結束日期

        getaDate(startDate, endDate);
      })
      // 查詢日期區間方法 結束...


      //刪除訂單細項的功能
      $('#tbodyshowtalbe').on('click', '.deleteVedio', function () {
        var deleteTarget = $(this).attr('id').replace('vediodetail', '');
        event.stopPropagation();
        console.log(deleteTarget);
        Swal.fire({
          title: `您將刪除此訂單細項`,
          text: "確定刪除後將無法回復操作",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '確定刪除!',
          cancelButtonText: '取消動作!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: './orderALLapi/vedio_deleteTargettik.php',
              type: 'POST',
              data: {
                deleteTarget: deleteTarget
              },
              dataType: 'json'
            }).done(function (response) {
              console.log(response);
              if (response.success) {
                Swal.fire(
                  '刪除成功!',
                  'success'
                ).then(function () {
                  ShowUsers();
                }
                );

              }
            })
          }
        })
      })

      //刪除整筆訂單的功能
      $('#tbodyshowtalbe').on('click', '.deleteallvedioItem', function () {
        var deleteTarget = $(this).attr('id').replace('allvedioItem', '');
        event.stopPropagation();
        console.log(deleteTarget);
        Swal.fire({
          title: `您將刪除訂單編號${deleteTarget}`,
          text: "確定刪除後將無法回復操作",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '確定刪除!',
          cancelButtonText: '取消動作!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: './orderALLapi/vedio_deleteAlltargetorder.php',
              type: 'POST',
              data: {
                deleteTarget: deleteTarget
              },
              dataType: 'json'
            }).done(function (response) {
              console.log(response);
              if (response.success) {
                Swal.fire(
                  '刪除成功!',
                  `訂單編號${deleteTarget}已刪除`,
                  'success'
                ).then(function () {
                  ShowUsers();
                }
                );

              }
            })
          }
        })
      })

      //所有歷史
      $('#historyOrder').on('click', function () {
        ShowUsers();
      })

    });
  </script>
</body>

</html>