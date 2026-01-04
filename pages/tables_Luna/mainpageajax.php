<!DOCTYPE html>
  <?php
  require_once ("connect_pdo.php");
  session_start();
  ?>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

  <style>

    .img-wrap {
            width: 150px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
            border: 3px dotted transparent;
            background-color: silver;
        }

    #inputimg {
    display: none;
    } 

    #img1{
    width: 100%;
    height: 100%;
    }

    #dialog {
        max-width: 800px;
        margin: 30px auto;
    }

    #mbody {
    position:relative;
    padding:0px;
    }
    .close {
    position:absolute;
    right:-30px;
    top:0;
    z-index:999;
    font-size:2rem;
    font-weight: normal;
    color:#fff;
    opacity:1;
    }

  </style>

  </head>

  <body class="hold-transition sidebar-mini">
  <div class="wrapper">
     <!-- 側邊欄全部 start -->
 <aside class="main-sidebar sidebar-dark-warning elevation-4">

<!-- Logo圖 點選前往首頁-->
<a href="../../index.php" class="brand-link">
    <img src="../tables_7/user_image/logo.png" alt=" Logo" class=" img-rounded "
        style="opacity: .9;display:block ;margin:auto;">
</a>

<!-- 側邊欄位開始 -->
<div class="sidebar">
    <!-- 個人資料 -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../tables_7/user_image/<?php echo $_SESSION["avatar"];?>" class="img-circle elevation-2"
                    alt="User Image"/>
                    <!-- 頭像 -->
                </div>
            <div class="info">
                <a href="../../index.php" class="d-block ml-3">
                    <?php echo  $_SESSION["user"] ; ?>
                </a>
                <!-- 員工名字 -->
            </div>
        </div>
    
    <!--  側欄內容 -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <!-- 員工列表 -> 員工管理 -->
            <li class="nav-item ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-table"></i>
                    <p>員工列表<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../tables_7/employee.php" class="nav-link ">
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
                        <a href="../tables_7/member.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>會員管理</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--  食物資料管理 + 新增一筆 資料 -->
            <li class="nav-item ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-bone"></i>
                    <p>食物資料管理</p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../table_33/fooddata.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>食物資料列表</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_33/insert.php" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>新增一筆資料</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 商品管理 -> 商品檢視-->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>商品管理<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../table_Tung/product1.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>商品檢視</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!--  影音列表 -> 影音管理 + 影音管理 -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="fas fa-video nav-icon" ></i>
                    <p>影音列表<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <!-- [目前位置] -->
                        <a href="#" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>影音管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="charts.php" class="nav-link">
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
                        <a href="../table_AYun/order_chart.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>銷售圖表分析</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_AYun/realItem_order.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>商品訂單管理</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../table_AYun/vedio_order.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>影片訂單管理</p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        
    </nav>
    <a href="../login/logOut.php" class="mt-auto sidebar-link">登出</a>
        <!-- 登出按鈕 -->
</div>

</aside>
<!-- 側邊欄結束 End -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>影音管理平台</h1>
            </div> 
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- 卡片區 -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                  <div class="col-6">
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#vidModal" data-whatever="@mdo">新增影片</button>
                </div>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
    <table id="vidTable" class="table table-bordered table-hover">
      <thead style="text-align:center">
        <tr>
          <th>ID</th>
          <th>縮圖</th>
          <th>標題</th>
          <th>Date</th>
          <th>描述</th>
          <th>影片</th>
          <th>肌群</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <!-- 資料將由 JavaScript 動態生成 -->
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- Modal區 -->
  <div class="modal fade" id="vidModal" tabindex="-1" aria-labelledby="vidModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vidModalLabel">修改影片</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="vidForm" name="vidForm" >
            <div class="form-group">
            <label for="VideoID" class="col-form-label">影片ID(默認)</label>
            <input type="text" class="form-control" id="VideoID" name="VideoID" placeholder="ID將自動生成" disabled>
          </div>
          <div class="form-group">
            <label for="inputimg" class="col-form-label">影片縮圖</label>
            <div class="img-wrap"><img id="img1" src="./video_image/video.png"></div>
            <input type="file" class="form-control" id="inputimg" name="inputimg"></input>
          </div>

          <div class="form-group">
            <label for="Title" class="col-form-label">標題</label>
            <input type="text" class="form-control" id="Title" name="Title"  placeholder="輸入影片標題">
          </div>
          <div class="form-group">
            <label for="ReleaseDate" class="col-form-label">上架時間</label>
            <input type="date" class="form-control" id="ReleaseDate" name="ReleaseDate"  placeholder="輸入上架時間">
          </div>
          <div class="form-group">
            <label for="Description" class="col-form-label">影片描述</label>
            <textarea cols="30" rows="3" class="form-control" id="Description" name="Description"  placeholder="輸入影片描述"></textarea>
          </div>
          <div class="form-group">
            <label for="URL" class="col-form-label">URL</label>
            <input type="text" class="form-control" id="URL" name="URL"  placeholder="輸入影片網址">
          </div>
          <div class="form-group col-md-4">
            <label for="musclegroupID">肌群分類</label>
            <select id="musclegroupID" class="form-control" name="musclegroupID">
              <option selected>選擇肌群</option>
              <option value="1" >胸肌</option>
              <option value="2">背肌</option>
              <option value="3">腹肌</option>
              <option value="4">腿部肌群</option>
              <option value="5">肩部肌群</option>
              <option value="6">手臂肌群</option>
              <option value="7">臀肌</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button id="buttonAdd" type="button" class="btn btn-primary">新增</button>
        <button id="buttonUpdate" type="button" class="btn btn-primary">修改</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
  </div>
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
  <!-- videoModal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="mbody">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="" id="fit"  allowscriptaccess="always" allow="autoplay"></iframe>
        </div>   
      </div>
    </div>
  </div>
</div> 
<!-- videoModal End-->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <!-- Page specific script -->


  <script>

    $(function () {
      $(document).ready(function() {
      $('#vidTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      }); 

      $('#img1').on('click', function () {
            $('#inputimg').trigger('click');
            })
            $('#inputimg').change(function(e) {
          const file = e.target.files[0];
          const reader = new FileReader();

          reader.onload = function(event) {
            $('#img1').attr('src', event.target.result);
          };

          reader.readAsDataURL(file);
          const selectedFileName = file.name;
          $('#selectedFileName').val(selectedFileName);
        });

      
      
      //資料從localStorage取出來
      const videos = JSON.parse(localStorage.getItem("videos")) || [];

    //新增按鈕
    $('#buttonAdd').on('click', function(event){
    
      const inputImg = document.getElementById('inputimg');
      let filename = inputImg.files[0].name; 

      $.ajax({
          url: 'insert_api.php',
          type: 'POST', 
          async: false,
          data: {
            "VideoID": $('#VideoID').val(),
            "vidthumbnail":filename,
            "Title":$('#Title').val(),
            "ReleaseDate":$('#ReleaseDate').val(),
            "Description":$('#Description').val(),
            "URL": $('#URL').val(),
            "musclegroupID":$('#musclegroupID').val()
          },
          dataType: 'json'   
      }).done(function (data) {
          if (data.success) {
            //alert("新增成功");
            Swal.fire({
            icon: 'success',
            title: '新增成功',
            showConfirmButton: false,
            timer: 1500
            }).then(()=>{
              ShowUsers();
            });
          } else {
              alert(data.errorMessage);
          }
      });
      $('#vidModal').modal('hide'); // 隐藏 Modal

      });

   // 編輯資料  
  $('#vidTable>tbody').on('click', 'button:nth-child(1)', function () {

    const row = $(this).closest('tr');
    const VideoID = row.find('.v_id').text(); // videoid
    const Title = row.find('.v_title').text(); // title
    $('#img1').attr('src', row.find('.v_img').attr('src')); //把圖片帶入src連結
    const ReleaseDate = row.find('.v_release').text(); // date
    const Description = row.find('.v_desc').text(); // desc
    const URL = row.find('td:nth-child(6)').data('src'); // url
    $('#musclegroupID').val( row.find('.v_muscleid').attr('data-id') );
    $('#VideoID').val(VideoID);
    $('#Title').val(Title);
    $('#ReleaseDate').val(ReleaseDate);
    $('#Description').val(Description);
    $('#URL').val(URL);


    const img =  row.find('.v_img').attr('src');
    $('#inputimg').text(img);

  });


  //點下修改按鈕
  $('#vidModal').on('click','#buttonUpdate',function () {

    const inputImg = document.getElementById('inputimg');
    let filename = inputImg.files[0]?.name; 
    let img = $('#inputimg').text();
    if(filename){
    
    }else if(filename == undefined){
      filename = img.replace("./video_image/",'');
    }
    
  
    $.ajax({
          url:'update_api.php',
          type:'POST',
          async: false,
          data: {
            "VideoID": $('#VideoID').val(),
            "vidthumbnail":filename,
            "Title":$('#Title').val(),
            "ReleaseDate":$('#ReleaseDate').val(),
            "Description":$('#Description').val(),
            "URL": $('#URL').val(),
            "musclegroupID":$('#musclegroupID').val()
          },
          dataType: 'json',
      }).done(function (data) {
          if (data.success) {
              ShowUsers();
              Swal.fire("修改成功", '', 'success');
          } else {
              alert(data.errorMessage);
          }
        });
    
      $('#vidModal').modal('hide');
  

  })

    
  $('#vidModal').on('hide.bs.modal', function () {
        //清除所有input.textarea.select中的資料
        $('input').val("");
        $('textarea').val("");
        $('select').val("");
        $('#img1').attr('src', './video_image/video.png');
        })
        
          //Modal顯示
        $('#vidModal').on('shown.bs.modal', function () {
            let VideoID = $('#VideoID').val();
            if (VideoID === "") {
            $('#buttonUpdate').hide();
            $('#buttonAdd').show();
            $('#vidModalLabel').text("影片新增");
            } else {
            $('#buttonAdd').hide();
            $('#buttonUpdate').show();
            $('#vidModalLabel').text("影片修改");
        }
        });

      //刪除資料
          $('#vidTable>tbody').on('click', 'button:nth-child(2)', function () {
          Swal.fire({
          title: '真的要刪除嗎?',
          text: "經刪除無法修復哦!",
          icon: 'warning',
          showDenyButton: true,
          confirmButtonText: '確定',
          denyButtonText: '取消',
          }).then((result) => {
          if (result.isConfirmed) {
              const VideoID = $(this).parents('tr').children('td:nth-child(1)').text();
              $.ajax({
                  url: 'delete_api.php',
                  type: 'GET',
                  data: { "VideoID": VideoID },
                  dataType: 'json',
                  async: false,
              }).done(function (data) {
                  if (data.success) {
                      Swal.fire('刪除成功', '', 'success');
                      ShowUsers();
                  } else {
                      Swal.fire('刪除失敗', '', 'error');
                  }
              });
          } else if (result.isDenied) {
              // 取消按鈕被點擊
          }
      });
  });


      // 顯示資料
        function ShowUsers() {
        $.ajax({
          url: 'select_api.php',
          type: 'GET',
          async: false,
          dataType: 'json'
        }).done(function (videos) {
          const docFrag = $(document.createDocumentFragment());

          // 建立 Promise 陣列
          const promises = videos.map(function (video) {
            return new Promise(function (resolve) {
              const { VideoID, vidthumbnail, Title, ReleaseDate, Description, URL, musclegroupID } = video;

              $.ajax({
                url: 'musclegroup_api.php',
                type: 'GET',
                async: false,
                data: { musclegroupID: musclegroupID },
                dataType: 'json'
              }).done(function (response) {
                const muscleName = response.muscleName;

                const data = `
                  <tr>
                    <td class="v_id" style="text-align:center">${VideoID}</td>
                    <td><img class="v_img" src="./video_image/${vidthumbnail}" style="height:160px; width:245px"></td>
                    <td class="v_title">${Title}</td>
                    <td class="v_release">${ReleaseDate}</td>
                    <td class="v_desc">${Description}</td>
                    <td class=".v_url" data-src="${URL}">
                    <button type="button" class="btn video-btn" data-toggle="modal"
                    data-src="${URL}" data-target="#myModal">
                    <i class="fas fa-play-circle fa-lg" style="color: #ff941a;"></i>
                    </button></td>
                    <td class="v_muscleid" data-id="${musclegroupID}"><span class="badge badge-success">${muscleName}</span></td>
                    <td>
                      <button class="btn btn-sm" data-toggle="modal" data-target="#vidModal">
                      <i class="fas fa-edit" style="color: #13811b; width:20%;"></i>
                      </button>
                      <button class="btn btn-sm">
                        <i class="fas fa-trash-alt" style="color: #db0606; width:20%;" ></i>   
                      </button>
                    </td>
                  </tr>`;
                docFrag.append(data);
                resolve(); // 完成 Promise
              });
            });
          });

      // 等待所有 Promise 完成後再將資料加入表格
      Promise.all(promises).then(function () {
        $('#vidTable>tbody').html(docFrag);
      });
    });
  }

  ShowUsers();

    });
</script>

<script>
  $(document).ready(function() {
    // Gets the video src from the data-src on each button
    var $videoSrc;

    $('.video-btn').click(function() {
        $videoSrc = $(this).data("src");
        console.log($videoSrc);
    });
    // when the modal is opened autoplay it  
    $('#myModal').on('shown.bs.modal', function (e) {
        
    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
    $("#fit").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })
    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#fit").attr('src',$videoSrc); 
    }) 
    // document ready  
    });
</script>

  </body>
  </html>