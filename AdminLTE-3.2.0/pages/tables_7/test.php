<!-- 側邊欄全部 start -->
<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Logo圖 -->
    <a href="../../index3.html" class="brand-link" >
      <img src="./user_image/logo.png" alt=" Logo" class=" img-rounded " style="opacity: .9;display:block ;margin:auto;" >
      
    </a>

    <!-- 側邊欄位開始 -->
    <div class="sidebar">
      <!-- 個人資料 -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="./user_image/<?php echo $_SESSION["avatar"]; ?>" class="img-circle elevation-2" alt="User Image"/>
                                          <!-- 頭像 -->
        </div>
        <div class="info">
          <a href="#" class="d-block ml-3"><?php echo  $_SESSION["user"] ; ?></a>
                                                        <!-- 員工名字 -->
        </div>
      </div>
      <!--  側欄內容 -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- 員工列表 -> 員工管理 -->   
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>員工列表<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employee.php" class="nav-link active">
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
                <a href="member.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>會員管理</p>
                </a>
              </li>
            </ul>
        </li>
        <!-- 食物資料管理 + 新增一筆 資料 -->
        <li class="nav-item">
              <a href="fooddata.php" class="nav-link">
                <i class="nav-icon fas fa-bone"></i>
                <p>食物資料管理</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="insert.php" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                  <p>新增一筆資料</p>
                </a>
                </li>
              </ul>
        </li>
        <!-- 商品管理 -> 商品檢視 + 新增商品 -->
        <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>商品管理<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="product1.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>商品檢視</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link" data-toggle="modal" data-target="#productModal">
                    <i class="far fa-circle nav-icon"></i>
                    <p>新增商品</p>
                  </a>
                </li>
              </ul>
        </li>
        <!-- 影音列表 -> 影音管理 + 影音管理 -->
        <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-video" style="color: #f5f5f5;"></i>
                <p>影音列表<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="mainpageajax.php" class="nav-link">
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
        <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-video" style="color: #f5f5f5;"></i>
                <p>訂單管理<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="mainpageajax.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>銷售圖表分析</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="mainpageajax.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>商品訂單管理</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="charts.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>影片訂單管理</p>
                  </a>
                </li>
              </ul>
        </li>

        </ul>
        <a href="../login/logOut.php" class="mt-auto sidebar-link">登出</a>
                    <!-- 登出按鈕 -->
      </nav>
    </div>
</aside>
<!-- 側邊欄結束 End -->