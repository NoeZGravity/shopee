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
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
?>
<?php
include 'admincp/connectdb.php' ;
if(isset($_SESSION["payment"])) {
    $payment = $_SESSION["payment"] ;
}
$search_pro = (isset($_SESSION['$search_pro '])) ? $_SESSION['$search_pro ']: [];
 
$animal = mysqli_query($conn, "SELECT * FROM tblanimal WHERE animal_type = 'Dog' ");
$animal1 = mysqli_query($conn, "SELECT * FROM tblanimal WHERE animal_type = 'Cat' ");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <!-- <link rel="stylesheet" href="./assets/bootstrap-5.0.2-dist/css/bootstrap-grid.css">-->
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Trang chủ</title>
</head>
<body>
<?php
include 'admincp/connectdb.php' ;

$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:10;
$current_page = !empty($_GET['page'])?$_GET['page']:1 ;
$offset = ($current_page - 1) * $item_per_page ;
$products = mysqli_query($conn, "SELECT * FROM tblpro ORDER BY pro_id ASC LIMIT ". $item_per_page ." OFFSET ". $offset);
$totalRecords = mysqli_query($conn, "SELECT * FROM tblpro");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
?>


    <div class="app">
        <header class="header">
            <nav class="header__navbar">
                <ul class="header__navbar-list">
                    <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate ">
                        Vào cửa hàng trên ứng dụng 
                        <div class="header__qr">
                            <img src="./assets/img/QRcode.png" alt="QR code" class="header__qr-img">
                            <div class="header__qr-apps">
                                <a href="https://play.google.com/store/apps/details?id=com.shopee.vn" class="header__qr-link">
                                    <img src="./assets/img/googleplay.png" alt="ggplay" class="header__qr-download">
                                </a>
                                <a href="https://apps.apple.com/vn/app/shopee-10-10-sale-ch%C3%ADnh-h%C3%A3ng/id959841449" class="header__qr-link">
                                    <img src="./assets/img/appstore.png" alt="appstore" class="header__qr-download">
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="header__navbar-item ">
                        <span class="header__navbar-item--title"> Kết nối</span>
                        <a href="https://vi-vn.facebook.com/ShopeeVN/" class="header__navbar-icon-link">
                            <i class="header__navbar-icon fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/Shopee_VN/?hl=de" class="header__navbar-icon-link">
                            <i class="header__navbar-icon fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
                <ul class="header__navbar-list">
                    <li class="header__navbar-item header__navbar-item--notify">
                        <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-bell"></i>
                                Thông báo                             
                        </a>
                        <div class="header__notify">
                            <header class="header__notify-header">
                                <h3>Thông Báo Mới Nhận</h3>
                            </header>
                            <ul class="header__notify-list">
                                <li class="header__notify-item header__notify-item--seen">
                                    <a href="" class="header__notify-link">
                                        <img src="https://thegadgetflow.com/wp-content/uploads/2018/03/Mira-Pet-Ultrasound-Dog-Toothbrush-03.jpg" alt="" class="header__notify-link--img">
                                        <div class="header__notify-info">
                                            <span class="header__notify-name">Xác định chính hãng nguồn gốc các sản phẩm Mira-pet</span>
                                            <span class="header__notify-description">HiddenTag là giải pháp xác thực hàng chính hãng bằng công nghệ tiên tiến nhất hiện nay</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="header__notify-item header__notify-item--seen">
                                    <a href="" class="header__notify-link">
                                        <img src="https://salt.tikicdn.com/cache/w444/ts/product/c8/76/21/d399a6843b8194af2cb2ae04c944eb35.png" alt="" class="header__notify-link--img">
                                        <div class="header__notify-info">
                                            <span class="header__notify-name">Sale off 15% combo Pate Whiskas  </span>
                                            <span class="header__notify-description">Siêu sale duy nhất vào 11/11/2022</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="header__notify-item header__notify-item--seen">
                                    <a href="" class="header__notify-link">
                                        <img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/290/902/products/rantel-h1.jpg?v=1582189551640" alt="" class="header__notify-link--img">
                                        <div class="header__notify-info">
                                            <span class="header__notify-name">Có nên xổ giun chó thường xuyên không?</span>
                                            <span class="header__notify-description">Định kì bao lâu thì nên xổ giun 1 lần?</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="header__notify-item header__notify-item--seen">
                                    <a href="" class="header__notify-link">
                                        <img src="https://dogily.vn/wp-content/uploads/2021/12/pate-lon-cho-cho-smart-heart-vi-ga-va-gan-8-1-510x510.jpg" alt="" class="header__notify-link--img">
                                        <div class="header__notify-info">
                                            <span class="header__notify-name">Sắp ra mắt Pate hộp mới</span>
                                            <span class="header__notify-description">Pate hộp phiên bản mới sắp ra mắt cuối năm nay</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="header__notify-item header__notify-item--seen">
                                    <a href="" class="header__notify-link">
                                        <img src="https://dogily.vn/wp-content/uploads/2021/11/cat-nhat-cho-meo-moon-cat-huong-chanh-15l-510x510.jpg" height="60px" alt="" class="header__notify-link--img">
                                        <div class="header__notify-info">
                                            <span class="header__notify-name">Moon Cat ra mắt cát vệ sinh hương mới</span>
                                            <span class="header__notify-description">Moon Cat hương chanh - mùi hương nhẹ nhàng dễ chịu</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <footer class="footer__notify">
                                <a href="" class="footer__notify-btn">Xem tất cả</a>
                            </footer>
                        </div>
                    </li>
                    <li class="header__navbar-item">
                        <a href="" class="header__navbar-item-link">                           
                                <i class="header__navbar-icon far fa-question-circle"></i>
                                Trợ giúp
                        </a>
                    </li>
                    
                    <?php if(isset( $user["username"])){?>
                    <li class="header__navbar-item header__navbar-user">
                        <img src="<?= $user["uimg"]?>" alt="" class="header__navbar-user-img">
                        <span class="header__navbar-item-username"><?= $user["fullname"] ?></span>                       

                        <ul class="header__navbar-user-hanghoa">
                            <li class="header__navbar-user-detail">
                                <a  href="info.php?uid=<?= $user["uid"]?>"><i class="fas fa-user daxua1"></i>Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-detail">
                                <a  href=""><i class="fas fa-map-marker-alt daxua2"></i>Địa chỉ của tôi</a>
                            </li>
                            <li class="header__navbar-user-detail">
                               <a  href="payment.php"><i class="fas fa-clipboard-list daxua2"></i>Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-detail">                             
                                <a href="logout.php"><i class="fas fa-sign-out-alt daxua3"></i>Đăng xuất</a>
                            </li>
                        </ul>                       
                    </li>
                    <?php } else {?>
                        <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate"><a href="loginpage.php" class="header__comment">Đăng ký</a></li>
                        <li class="header__navbar-item header__navbar-item--strong"> <a href="loginpage.php" class="header__comment">Đăng nhập</a></li>
                        <?php  } ?>
                    
                </ul>
            </nav>
            <div class="header-with-search">
                <div class="header-logo">
                    <a href="">
                        <li  class=" header-logo-img">
                            <img src="./assets/img/dogily-logo.png" alt=""  class=" header-logo-img">
                        </li>    
                    </a>                                   
                </div>
                <div class="header__search">
                    <form action="searchpro.php" method="GET" class="form_search">
                    <div class="header__search-input-wrap">
                        <input type="text" name="tentimkiem" class="header__search-input tensp" placeholder="Nhập để tìm kiếm sản phẩm">
                         <?php if(isset($search_pro)) ?>
                        <div class="header__search-history">
                            <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                            <ul class="header__search-history-list">
                                <li class="header__search-history-item">
                                    <a href="" class="header__search-history-link">Mèo Anh Lông Ngắn</a>
                                </li>
                            </ul>                         
                        </div>
                    </div>
                    <button type="submit" name="timkiem" class="header__search-btn "><i class=" header__search-btn-icon fas fa-search"></i></button>
                    </form> 
                </div>
                <div class="header__cart">
                    <div class="header__cart-wrap">
                        <i class=" header__cart-icon fas fa-shopping-cart"></i>                      
                                          
                        <div class="header__cart-list ">                                                                       
                            <?php   
                            $num = 1;                                   
                            if (isset($payment)) {?>
                           
                                <header class="header__cart-heading">
                                    <h4>Sản phẩm đã thêm</h4>
                                </header>
                            <?php  
                              $probuyin = mysqli_query($conn, "SELECT * FROM tblpro WHERE pro_id IN (".implode(",", array_keys($payment)).")");                          
                              if (!empty($probuyin)) { 
                                while ($row = mysqli_fetch_array($probuyin)) { ?>
                                          <span class="header__cart-notice"><?=$num++?></span>
                                                <ul class="header__cart-product-list">                          
                                                   <li class="header__cart-product-item">
                                                        <img src="<?= $row["pro_img"]?>" alt="" class="header__cart-product-img">
                                                        <div class="header__cart-product-infor">
                                                         <div class="header__cart-product-head">
                                                            <h5 class="header__cart-product-name"><?= $row["pro_name"]?></h5>
                                                         </div>
                                                          <div class="header__cart-product-price-wrap">
                                                            <span class="header__cart-product-price"><?= number_format($row['pro_price'], 0, ",", ".")?></span>
                                                            <span class="header__cart-product-multiply">x</span>
                                                            <span class="header__cart-product-qnt"><?= $payment[$row['pro_id']]?></span>
                                                         </div>
                                                         </div>                                           
                                                     <div class="header__cart-product-body">
                                                                <span class="header__cart-product-description"><?= number_format($payment[$row['pro_id']] * $row['pro_price'], 0, ",", ".") ?></span>                                                                                                  
                                                    </div>                                                                              
                                                   </li>                                                                                                                                                                                      
                                                </ul>                                                       
                            <?php } ?>
                            <?php } ?>
                            
                            <footer class="cart-product">
                                            <a href="payment.php" id="cart-product-btn" class="cart-product-btn btn btn--primary">Xem giỏ hàng</a>
                            </footer>     
                                                
                            <?php } else {?>   
                                <img src="./assets/img/giohang.png" alt="" class="header__cart-list-no-cart-img">
                                <span class="header__cart-list-word">Chưa có sản phẩm</span>                                                                                                                                                                             
                                <?php } ?>
                          
                        </div>
                    </div>
                    </div>
                </div>

            </div>

        </header>
        <div id="menu">
            <ul id="nav">              
                <li>
                    <a href="#">Mua chó cảnh
                    <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav">
                        <?php  while($rowani = mysqli_fetch_array( $animal)) {?>
                        <li><a href="detailanimal.php?id=<?= $rowani['animal_id'] ?>"><?= $rowani['animal_name'] ?></a></li>                     
                       <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="#">Mua mèo cảnh
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav">
                    <?php  while($rowani1 = mysqli_fetch_array( $animal1)) {?>
                        <li><a href="detailcat.php?id=<?= $rowani1['animal_id'] ?>"><?= $rowani1['animal_name'] ?></a></li>                 
                        <?php } ?>
                    </ul>
                </li>             
                <li>
                    <a href="#">
                       Sản phẩm khác
                       <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav subnav_other">
                        <li><a href="#">Chuồng ngủ</a></li>
                        <li><a href="#">Xà bông tắm</a></li>
                        <li><a href="#">Máy sấy lông</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="grid">
                <div class="grid__row ">
                    <div class="grid__column-2">
                     <nav class="category">
                         <h3 class="category__heading">
                             <i class="fas fa-list category__heading-icon"></i>                  
                             Danh mục
                         </h3>
                         <ul class="category-list">                           
                             <li class="category-item">
                                 <a class="category-item--link" href="index.php">Tất cả</a>
                             </li>
                             <li class="category-item">
                                 <a class="category-item--link" href="index.php?type=Dog">Thức ăn cho chó</a>
                             </li>
                             <li class="category-item ">
                                <a class="category-item--link" href="index.php?type=Cat">Thức ăn cho mèo</a>
                            </li>
                            <li class="category-item ">
                                <a class="category-item--link" href="index.php?type=Other">Sản phẩm khác</a>
                            </li>
                         </ul>
                     </nav>                   
                    </div>
                    <div class="grid__column-10">
                        <div class="home-filter">
                            <span class="home-filter-label">Sắp xếp theo</span>
                            <button class="btn home-filter-btn">Phổ biến</button>
                            <button class="btn btn--primary home-filter-btn">Mới nhất</button>
                            <button class="btn home-filter-btn">Bán chạy</button>                                                 
                            <div class="home-filter-page">
                            <?php 
                                include 'pagination.php';
                            ?>
                                                                           
                             <div class="home-filter-page-control">
                                    <a href="" class="home-filter-page-btn">
                                        <i class="fas fa-angle-left home-filter-page-icon"></i>
                                    </a>
                                    <a href="" class="home-filter-page-btn">
                                        <i class="fas fa-angle-right home-filter-page-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>     
                        <div class="home-product">
                            
                            <div class="grid__row">
                                <?php
                                if(isset($_GET['type'])) {
                                    $type = $_GET['type'];
                                    $sql_type = "SELECT * FROM tblpro WHERE pro_type = '$type'";
                                    $kqtype = mysqli_query($conn, $sql_type);
                                 } else {
                                    $kqtype = $products;
                                 }
                                while($row = mysqli_fetch_array( $kqtype)) {
                                ?>
                                <div class="grid__column-2-4">
                                    <a href="detailpro.php?id=<?= $row['pro_id']?>$namee<?= $row['pro_name']?>" class="home-product-item-click" >
                                        <div class="home-product-item">
                                        <div class="home-product-item_img" style="background-image: url(<?= $row['pro_img'] ?>);"></div>                                  
                                            <h4 class="home-product-item_name"><?= $row['pro_name'] ?></h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now"><?= number_format($row['pro_price'], 0, ",", ".") ?>VNĐ</span>
                                            </div>
                                            <strong><span class="home-product-title">Xem chi tiết</span></strong>
                                        </div> 
                                    </a>                                                                  
                                </div>                          
                                <?php } ?>
                                
                            </div>                           
                        </div>                                                     
                                                                                                                                                  
                    </div>      
                                                 
                </div>       
            </div>
        </div>
        <footer class="footer">
            <div id="extra" class="footer-brand">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                <a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a>
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a>
                <p class="copyright">Powered by <a href="https://www.uit.edu.vn/">uit.edu.vn</a></p>
                
            </div>
        </footer>
    
        <script>
    $(document).ready(function(){
        $(".header__search-btn").click(function() {
            $(".tensp").blur(function(){
            var tensp=$(".tensp").val();  
            $.post("timsp_post_ajax.php",
                {
                    ten:tensp 
                },
                function(data,status){
                    if(status=="success")
                    {
                        $(".header").html(data);
                    }
            });
            
        }); 
        });     
    });   
    </script>
</body>
</html>