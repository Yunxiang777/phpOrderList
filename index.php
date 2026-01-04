<?php
// 驗證使用者是否已登入
require_once __DIR__ . '/pages/auth/auth.php';
// 確認使用者已登入，否則重定向到登入頁面
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healthy Fitness</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


    <style>
        .loader {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 6rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .loader:before,
        .loader:after {
            content: "";
            position: absolute;
            border-radius: 50%;
            animation: pulsOut 1.8s ease-in-out infinite;
            filter: drop-shadow(0 0 1rem rgba(255, 255, 255, 0.75));
        }

        .loader:before {
            width: 100%;
            padding-bottom: 100%;
            box-shadow: inset 0 0 0 1rem #fff;
            animation-name: pulsIn;
        }

        .loader:after {
            width: calc(100% - 2rem);
            padding-bottom: calc(100% - 2rem);
            box-shadow: 0 0 0 0 #fff;
        }

        @keyframes pulsIn {
            0% {
                box-shadow: inset 0 0 0 1rem #fff;
                opacity: 1;
            }

            50%,
            100% {
                box-shadow: inset 0 0 0 0 #fff;
                opacity: 0;
            }
        }

        @keyframes pulsOut {

            0%,
            50% {
                box-shadow: 0 0 0 0 #fff;
                opacity: 0;
            }

            100% {
                box-shadow: 0 0 0 1rem #fff;
                opacity: 1;
            }
        }



        .linked-paragraph {
            cursor: pointer;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center" style="background-color: #263038;">
            <span class="loader"></span>
        </div>


        <!-- Navbar -->

        <!-- /.navbar -->

        <!-- 側邊欄全部 start -->
        <aside class="main-sidebar sidebar-dark-warning elevation-4">

            <!-- Logo圖 點選前往首頁-->
            <a href="#" class="brand-link">
                <img src="./pages/tables_7/user_image/logo.png" alt=" Logo" class=" img-rounded "
                    style="opacity: .9;display:block ;margin:auto;">
            </a>

            <!-- 側邊欄位開始 -->
            <div class="sidebar">
                <!-- 個人資料 -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./pages/tables_7/user_image/<?php echo $_SESSION["avatar"]; ?>"
                            class="img-circle elevation-2" alt="User Image" />
                        <!-- 頭像 -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block ml-3">
                            <?php echo  $_SESSION["user"]; ?>
                        </a>
                        <!-- 員工名字 -->
                    </div>
                </div>

                <!--  側欄內容 -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- 員工列表 -> 員工管理 -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>員工列表<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/tables_7/employee.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>員工管理</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 會員列表 -> 會員管理 -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>會員列表<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/tables_7/member.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>會員管理</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- 食物資料管理 + 新增一筆 資料 -->
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-bone"></i>
                                <p>食物資料管理</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/table_33/fooddata.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>食物資料列表</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./pages/table_33/insert.php" class="nav-link">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>新增一筆資料</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- 商品管理 -> 商品檢視-->
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>商品管理<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/table_Tung/product1.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>商品檢視</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- 影音列表 -> 影音管理 + 影音管理 -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-video nav-icon"></i>
                                <p>影音列表<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/tables_Luna/mainpageajax.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>影音管理</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./pages/tables_Luna/charts.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>圖表分析</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- 訂單管理 -> 銷售圖表分析 + 商品訂單管理 + 影片訂單管理 -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas  fa-shopping-cart nav-icon"></i>
                                <p>訂單管理<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./pages/table_AYun/order_chart.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>銷售圖表分析</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./pages/table_AYun/realItem_order.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>商品訂單管理</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./pages/table_AYun/vedio_order.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>影片訂單管理</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </nav>
                <a href="./pages/login/logOut.php" class="mt-auto sidebar-link">登出</a>
                <!-- 登出按鈕 -->
            </div>

        </aside>
        <!-- 側邊欄結束 End -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">首頁</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <section class="content">
                <div class="container-fluid">

                    <div class="row">

                        <!-- 商品管理 -->
                        <div class="col-lg-2 col-6 linked-paragraph"
                            onclick="window.location.href ='./pages/table_Tung/product1.php'">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>商品管理</h3>
                                    <p class="linked-paragraph"
                                        onclick="window.location.href ='./pages/table_Tung/product1.php'">新增商品</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="./pages/table_Tung/product1.php" class="small-box-footer">More <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- 影片管理 -->
                        <div class="col-lg-2 col-6 linked-paragraph"
                            onclick="window.location.href ='./pages/tables_Luna/mainpageajax.php'">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>影片管理</h3>
                                    <p class="linked-paragraph"
                                        onclick="window.location.href ='./pages/tables_Luna/mainpageajax.php'">新增商品</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <a href="./pages/tables_Luna/mainpageajax.php" class="small-box-footer">More <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- 會員管理 -->
                        <div class="col-lg-2 col-6 linked-paragraph"
                            onclick="window.location.href ='./pages/tables_7/member.php'">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>會員管理</h3>
                                    <p class="linked-paragraph"
                                        onclick="window.location.href ='./pages/tables_7/member.php'">新增會員</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="./pages/tables_7/member.php" class="small-box-footer">More <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- 訂單管理 -->
                        <div class="col-lg-3 col-6 linked-paragraph"
                            onclick="window.location.href ='./pages/table_AYun/realItem_order.php'">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>訂單管理</h3>
                                    <p class="linked-paragraph"
                                        onclick="window.location.href ='./pages/table_AYun/realItem_order.php'">新增訂單</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-list"></i>
                                </div>
                                <a href="./pages/table_AYun/realItem_order.php" class="small-box-footer">More <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- 食物管理 -->
                        <div class="col-lg-3 col-6 linked-paragraph"
                            onclick="window.location.href ='./pages/table_33/fooddata.php'">
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>食物管理</h3>
                                    <p class="linked-paragraph"
                                        onclick="window.location.href ='./pages/table_33/fooddata.php'">新增食物</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-bone"></i>
                                </div>
                                <a href="./pages/table_33/fooddata.php" class="small-box-footer">More <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="sticky-top mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">行事曆</h4>
                                            </div>
                                            <div class="card-body">
                                                <!-- the events -->
                                                <div id="external-events">
                                                    <div class="external-event bg-success">專題發表</div>
                                                    <div class="external-event bg-warning">結帳日</div>
                                                    <div class="external-event bg-info">商品進貨</div>
                                                    <div class="external-event bg-primary">尾款繳交</div>
                                                    <div class="external-event bg-danger">影片更新</div>
                                                    <div class="checkbox">
                                                        <label for="drop-remove">
                                                            <input type="checkbox" id="drop-remove">
                                                            移除
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">新增項目</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                                    <ul class="fc-color-picker" id="color-chooser">
                                                        <li><a class="text-primary" href="#"><i
                                                                    class="fas fa-square"></i></a></li>
                                                        <li><a class="text-warning" href="#"><i
                                                                    class="fas fa-square"></i></a></li>
                                                        <li><a class="text-success" href="#"><i
                                                                    class="fas fa-square"></i></a></li>
                                                        <li><a class="text-danger" href="#"><i
                                                                    class="fas fa-square"></i></a></li>
                                                        <li><a class="text-muted" href="#"><i
                                                                    class="fas fa-square"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!-- /btn-group -->
                                                <div class="input-group">
                                                    <input id="new-event" type="text" class="form-control"
                                                        placeholder="事件">

                                                    <div class="input-group-append">
                                                        <button id="add-new-event" type="button"
                                                            class="btn btn-primary">新增</button>
                                                    </div>
                                                    <!-- /btn-group -->
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-9">
                                    <div class="card card-primary">
                                        <div class="card-body p-0">
                                            <!-- THE CALENDAR -->
                                            <div id="calendar"></div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                </div>
            </section>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/fullcalendar/main.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <script>
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: '#f56954', //red
                        borderColor: '#f56954', //red
                        allDay: true
                    },
                    {
                        title: '專題製作',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: '#f39c12', //yellow
                        borderColor: '#f39c12' //yellow
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, 3, 10, 30),
                        allDay: false,
                        backgroundColor: '#0073b7', //Blue
                        borderColor: '#0073b7' //Blue
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: '#00c0ef', //Info (aqua)
                        borderColor: '#00c0ef' //Info (aqua)
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: '#00a65a', //Success (green)
                        borderColor: '#00a65a' //Success (green)
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'https://www.google.com/',
                        backgroundColor: '#3c8dbc', //Primary (light-blue)
                        borderColor: '#3c8dbc' //Primary (light-blue)
                    }
                ],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>
</body>

</html>