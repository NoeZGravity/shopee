<?php 
session_start();
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600; 
?>
<?php
include 'admincp/connectdb.php' ;
$admin = (isset($_SESSION['admin'])) ? $_SESSION['admin']: [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assetsad/css/main.css">
    <link rel="stylesheet" href="./assetsad/css/base.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="./assetsad/font/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>
<body>
<div class="app">
        <header class="header header__admin">
            <nav class="header__navbar">
                <ul class="header__navbar-list">
                    <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate ">
                        Chào mừng quay lại Admin                                          
                    </li>
                    <li class="header__navbar-item ">
                        <span class="header__navbar-item--title"> Chúc 1 ngày tốt lành</span>                     
                    </li>              
                </ul>
                <ul class="header__navbar-list">                  
                    <?php if(isset($admin)){?>                  
                    <li class="header__navbar-item header__navbar-user">
                        <img src="<?= $admin["adimg"] ?>" alt="" class="header__navbar-user-img">
                        <span class="header__navbar-item-username"><?= $admin["admin"] ?></span>

                        <ul class="header__navbar-user-hanghoa">                         
                            <li class="header__navbar-user-detail">                             
                                <a href="logout.php"><i class="fas fa-sign-out-alt daxua3"></i>Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                    <?php  } ?>
                </ul>
            </nav>         
        </header>
        <div id="menu">
            <ul id="nav">
                <li><a href="#">Quản lý hóa đơn</a></li>
                <li><a href="#">Quản lý sản phẩm</a></li>                            
                <li><a href="#">Quản lý khách hàng</a></li>
                <li><a href="#">Xem thống kê</a></li>
            </ul>
        </div>
        <div class="container">
            <table class="table table-ad" >
            <thead>
           <tr>
      <th scope="col">STT</th>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Số lượng</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
            </table>
        </div>
</body>