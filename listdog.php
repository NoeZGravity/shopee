<?php
require 'admincp/connectdb.php' ;
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];

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
</head>
<body>
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
                    <!--<li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">Đăng ký</li>
                    <li class="header__navbar-item header__navbar-item--strong">Đăng nhập</li>-->
                    <li class="header__navbar-item header__navbar-user">
                        <img src="./assets/img/avamega.jpg" alt="" class="header__navbar-user-img">
                        <span class="header__navbar-item-username">Vinh Vũ</span>

                        <ul class="header__navbar-user-hanghoa">
                            <li class="header__navbar-user-detail">
                                <a   href="info.html"><i class="fas fa-user daxua1"></i>Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-detail">
                                <a  href=""><i class="fas fa-map-marker-alt daxua2"></i>Địa chỉ của tôi</a>
                            </li>
                            <li class="header__navbar-user-detail">
                               <a  href="payment.html"><i class="fas fa-clipboard-list daxua2"></i>Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-detail">                             
                                <a href="loginpage.html"><i class="fas fa-sign-out-alt daxua3"></i>Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
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
                    <div class="header__search-input-wrap">
                        <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                        <div class="header__search-history">
                            <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                            <ul class="header__search-history-list">
                                <li class="header__search-history-item">
                                    <a href="" class="header__search-history-link">Mèo Anh Lông Ngắn</a>
                                </li>
                            </ul>
                            <ul class="header__search-history-list">
                                <li class="header__search-history-item">
                                    <a href="" class="header__search-history-link">Cát cho mèo</a>
                                </li>
                            </ul>
                            <ul class="header__search-history-list">
                                <li class="header__search-history-item">
                                    <a href="" class="header__search-history-link">Thức ăn cho mèo</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <button class="header__search-btn"><i class="header__search-btn-icon fas fa-search"></i></button>

                </div>
                <div class="header__cart">
                    <div class="header__cart-wrap">
                        <i class=" header__cart-icon fas fa-shopping-cart"></i>
                        <span class="header__cart-notice">3</span>                    
                        <div class="header__cart-list ">
                            <img src="./assets/img/giohang.png" alt="" class="header__cart-list-no-cart-img">
                            <span class="header__cart-list-word">Chưa có sản phẩm</span>                           
                            <header class="header__cart-heading">
                                    <h4>Sản phẩm đã thêm</h4>
                            </header>
                            <ul class="header__cart-product-list">
                                <li class="header__cart-product-item">
                                        <img src="https://dogily.vn/wp-content/uploads/2021/12/tpcn-vita-fur-ho-tro-duong-long-va-da-1-510x510.jpg" alt="" class="header__cart-product-img">
                                        <div class="header__cart-product-infor">
                                             <div class="header__cart-product-head">
                                                 <h5 class="header__cart-product-name">TPCN Vita</h5>
                                                <div class="header__cart-product-price-wrap">
                                                    <span class="header__cart-product-price">200.000</span>
                                                    <span class="header__cart-product-multiply">x</span>
                                                    <span class="header__cart-product-qnt">2</span>
                                                 </div>
                                            </div>                                           
                                             <div class="header__cart-product-body">
                                                        <span class="header__cart-product-description">Phân loại hàng: Bạc</span>
                                                        <span class="header__cart-product-remove">Xóa</span>                                               
                                            </div>
                                        </div>                                    
                                </li> 
                                <li class="header__cart-product-item">
                                    <img src="https://dogily.vn/wp-content/uploads/2021/12/canxi-nano-cho-meo-1-510x510.jpg" alt="" class="header__cart-product-img">
                                    <div class="header__cart-product-infor">
                                         <div class="header__cart-product-head">
                                             <h5 class="header__cart-product-name">Canxi Nano</h5>
                                            <div class="header__cart-product-price-wrap">
                                                <span class="header__cart-product-price">250.000</span>
                                                <span class="header__cart-product-multiply">x</span>
                                                <span class="header__cart-product-qnt">4</span>
                                             </div>
                                        </div>                                           
                                         <div class="header__cart-product-body">
                                                    <span class="header__cart-product-description">Phân loại hàng: Bạc</span>
                                                    <span class="header__cart-product-remove">Xóa</span>                                               
                                        </div>
                                    </div>                                    
                                </li> 
                                <li class="header__cart-product-item">
                                    <img src="https://dogily.vn/wp-content/uploads/2021/12/hat-royal-canin-mini-adult-2-kg-6-510x510.jpg" alt="" class="header__cart-product-img">
                                    <div class="header__cart-product-infor">
                                         <div class="header__cart-product-head">
                                             <h5 class="header__cart-product-name">Hạt Royal Camin Mini</h5>
                                            <div class="header__cart-product-price-wrap">
                                                <span class="header__cart-product-price">500.000</span>
                                                <span class="header__cart-product-multiply">x</span>
                                                <span class="header__cart-product-qnt">3</span>
                                             </div>
                                        </div>                                           
                                         <div class="header__cart-product-body">
                                                    <span class="header__cart-product-description">Phân loại hàng: Bạc</span>
                                                    <span class="header__cart-product-remove">Xóa</span>                                               
                                        </div>
                                    </div>                                    
                                </li>                                                                                                                         
                            </ul>
                            <footer class="cart-product">
                                    <button class="cart-product-btn btn btn--primary">Xem giỏ hàng</button>
                            </footer>
                        </div>
                    </div>
                    </div>
                </div>

            </div>

        </header>
        <div id="menu">
            <ul id="nav">
                <li><a href="#">Chó cảnh</a></li>
                <li><a href="#">Mèo cảnh</a></li>
                <li>
                    <a href="#">Mua chó cảnh
                    <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav">
                        <li><a href="#">Chó HusKy</a></li>
                        <li><a href="#">Chó Corgi</a></li>
                        <li><a href="#">Chó Shiba Inu</a></li>
                        <li><a href="#">Chó Alaska</a></li>
                        <li><a href="#">Chó Akita Inu</a></li>
                        <li><a href="#">Chó BecGie</a></li>
                        <li><a href="#">Chó Bắc Hà</a></li>
                        <li><a href="#">Chó Phú Quốc</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Mua mèo cảnh
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav">
                        <li><a href="#">Mèo Anh Lông Ngắn</a></li>
                        <li><a href="#">Mèo Anh Lông Dài</a></li>
                        <li><a href="#">Mèo Ba Tư</a></li>
                        <li><a href="#">Mèo BenGel</a></li>
                        <li><a href="#">Mèo RagDoll</a></li>
                        <li><a href="#">Mèo Xiêm</a></li>
                        <li><a href="#">Mèo Maine Coon</a></li>
                        <li><a href="#">Mèo ToyGer</a></li>
                    </ul>
                </li>
                <li><a href="#">Đồ cho chó</a></li>
                <li><a href="#">Đồ cho mèo</a></li>
                <li>
                    <a href="#">
                       Sản phẩm khác
                       <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="subnav">
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
                             <li class="category-item category-item-active">
                                 <a class="category-item--link" href="">Chó </a>
                             </li>
                             <li class="category-item">
                                 <a class="category-item--link" href="">Mèo</a>
                             </li>
                             <li class="category-item">
                                 <a class="category-item--link" href="">Thức ăn cho chó</a>
                             </li>
                             <li class="category-item ">
                                <a class="category-item--link" href="">Thức ăn cho mèo</a>
                            </li>
                            <li class="category-item ">
                                <a class="category-item--link" href="">Sản phẩm khác</a>
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
                            <div class="select-input">
                                <span class="select-input-label">Giá</span>
                                <i class="fas fa-angle-down"></i>                              
                            </div>
                            <div class="home-filter-page">
                                <span class="home-filter-page-num">
                                    <span class="home-filter-page-current">1</span>/2
                                </span>
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
                                <div class="grid__column-2-4">
                                    <a href="detailpro.php?id=<? $row['pro_id']?><?$row['pro_name']?>" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://tapchithucung.vn/Uploads/images/cho-corgi-an-gi.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó Corgi</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">4.000.000 ₫</span>
                                            </div>
                                            <strong><span class="home-product-title">Xem chi tiết</span></strong>
                                        </div> 
                                    </a>                                                                  
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://azpet.com.vn/wp-content/uploads/2021/06/C12106-1-1.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó Husky</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">8.000.000 ₫</span>
                                            </div>
                                            <span class="home-product-title">Xem chi tiết</span>
                                        </div>   
                                    </a>                                                                
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://www.hoaipet.com/wp-content/uploads/2021/04/cho-shiba-inu-9-768x601.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó Shiba Inu</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">4.000.000 ₫</span>
                                            </div>
                                            <span class="home-product-title">Xem chi tiết</span>
                                        </div>   
                                    </a>                                                                
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click"><div class="home-product-item">
                                        <div class="home-product-item_img" style="background-image: url(https://traichoalaska.com/wp-content/uploads/2017/08/cho-alaska-giant-hong-phan.jpg);"></div>
                                        <h4 class="home-product-item_name">Chó Alaska</h4>
                                        <div class="home-product-item_price">
                                            <span class="home-product-item_price_now">10.000.000 ₫</span>
                                        </div>
                                        <span class="home-product-title">Xem chi tiết</span>
                                    </div>      
                                </a>                                                              
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
                                <div class="grid__column-2-4">
                                    <a href="#" class="home-product-item-click">
                                        <div class="home-product-item">
                                            <div class="home-product-item_img" style="background-image: url(https://sieupet.com/sites/default/files/pictures/images/doi-tai-cho-becgie-dat-chuan.jpg);"></div>
                                            <h4 class="home-product-item_name">Chó BecGie</h4>
                                            <div class="home-product-item_price">
                                                <span class="home-product-item_price_now">7.000.000 ₫</span>
                                            </div>
                                           <span class="home-product-title">Xem chi tiết</span>
                                        </div> 
                                    </a>                                                                   
                                </div>  
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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    
</body>
</html>