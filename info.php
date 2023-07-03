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
    <title>Thông tin cá nhân</title>
</head>
<body>
<?php 
include 'function.php' ; 
        if (isset($_GET['action'])) {    
            switch($_GET['action']) {
                case "updatein":                 
                    $uuid = $_POST ['uid'];
                    $fullname = $_POST['fullname'];
                    $username = $_POST['username'];
                    $telephone = $_POST['telephone'];     
                    $gender = $_POST['gender'];
                    $birthday = date('Y-m-d', strtotime($_POST['birthday']));  
                    $address = $_POST['address'];
                    if (isset($_FILES['imageava'])) {
                        $uploadedFiles = $_FILES['imageava'];
                        $result = uploadFiles($uploadedFiles);                              
                         $img = $result['path'];                                               
                         $result = mysqli_query($conn,"UPDATE tbluser set fullname = '$fullname', username = '$username', utelephone = '$telephone', gender = '$gender', 
                        birthday = '$birthday', address = '$address', uimg = '$img' WHERE uid = '$uuid' ");  
                        header("Refresh: 0");
                        header('Location: info.php');                                                                                  
                                                                                           
                    } else {
                        $result = mysqli_query($conn,"UPDATE tbluser set fullname = '$fullname', username = '$username', utelephone = '$telephone', gender = '$gender', 
                        birthday = '$birthday', address = '$address' WHERE uid = '$uuid' ");                                                                                        
                        header('Location: info.php');
                                                                                                                        
                    }
                    
                    if (!$result ) {
                        $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                    }
                                       				
            }                      
        }
?>      
    <div class="app app_info">
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
                                <a  href="index.php"><i class="fas fa-map-marker-alt daxua2"></i>Trang chủ</a>
                            </li>
                            <li class="header__navbar-user-detail">
                               <a  href="payment.php"><i class="fas fa-clipboard-list daxua2"></i>Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-detail">                             
                                <a href="loginpage.php"><i class="fas fa-sign-out-alt daxua3"></i>Đăng xuất</a>
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
                            <a href="index.php"> <img src="./assets/img/dogily-logo.png" alt=""  class=" header-logo-img"></a>
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
                            if (isset($payment)) {?>
                                <header class="header__cart-heading">
                                    <h4>Sản phẩm đã thêm</h4>
                                </header>
                            <?php  
                              $probuyin = mysqli_query($conn, "SELECT * FROM tblpro WHERE pro_id IN (".implode(",", array_keys($payment)).")");                          
                              if (!empty($probuyin)) { 
                                while ($row = mysqli_fetch_array($probuyin)) { ?>                              
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
                                                
                            <?php } elseif(!isset($payment)){?>   
                                <img src="./assets/img/giohang.png" alt="" class="header__cart-list-no-cart-img">
                                <span class="header__cart-list-word">Chưa có sản phẩm</span>                                                                                                                                                                             
                                <?php } ?>
                        </div>
                    </div>
                    </div>
                </div>

    </div>
    <div class="grid body__info">
        <div class="grid__row">
            <div class="grid__column-2-2">
                <div class="info">
                    <li class="header__navbar-item header__navbar-user">
                        <img src="<?= $user["uimg"]?>" alt="" class="header__navbar-user-img">
                    </li>
                    <div class="infon">    
                            <span class="info-item-username"><?= $user["fullname"]?></span>
                                                            
                    </div>                                          
                </div>         
            </div>
            <div class="grid__column-10-2">
                <div class="headeru__info">
                    <h1 class="headeru__info_name">Hồ sơ của tôi</h1>
                    <span class="headeru__title">Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                </div>
                <div class="form__info">   
                    <form action="info.php?action=updatein" method="POST" onSubmit="window.location.reload()"  enctype="multipart/form-data">
                        <fieldset> 
                        <div class="form__info-username form__info-uid">
                                <p>
                                    UID:
                                    <input type="text" class="form__info-username-lb" name="uid" placeholder maxlength="225" value="<?= ($user['uid']) ?>" required name="">                                  
                                </p>    
                            </div>                                                                   
                            <div class="form__info-username">
                                <p>
                                    User name:
                                    <input type="text" class="form__info-username-lb" name="username" placeholder maxlength="225" value="<?= ($user['username']) ?>" required name="">                                  
                                </p>    
                            </div>
                            <div class="form__info-name">
                                    <p>
                                        Họ tên: 
                                    <input type="text" class="form__info-name-lb" name="fullname" value="<?= ($user['fullname']) ?>" placeholder maxlength="225" required name="">                                    
                                    </p>    
                            </div>
                            <div class="form__info-gender">
                                    <p>
                                        Giới tính :
                                        <label class="form__info-gender-lb"><input type="radio" name="gender" value="male" /></label>
                                        <span class="type__gender">Nam</span>
                                        <label class="form__info-gender-lb"><input type="radio" name="gender" value="female" /></label>
                                        <span class="type__gender">Nữ</span>                 
                                    </p>   
                            </div>
                            <div class="form__info-email">
                                <p>
                                   SĐT:
                                    <input type="text" class="form__info-email-lb" name="telephone" value="<?= ($user['utelephone']) ?>" placeholder maxlength="225" required name="">                                   
                                </p>       
                            </div>
                            <div class="form__info-email form_ava">
                                
                                <span class="span_ava_info"><img src="<?= ($user['uimg'])  ?>" alt="" width="150px" height="150px"></span>
                                 <label class="lb_ava_info">Ảnh đại diện </label>
                                <div class="right-wrap-field">
                                  <input type="file" name="imageava" />
                                </div> 
                            </div>                           
                            <div class="form__infoava-birthday">
                                <p>
                                     Ngày sinh:
                                    <label class="form__info-birthday-lb"><input type="date" name="birthday" value="<?= ($user['birthday']) ?>"></label>
                                </p>  
                            </div>
                            <div class="form__info-address">
                                <p>
                                    <label class="form__info-address-lb">
                                      Địa chỉ :
                                      <br />
                                      <textarea  name="address" cols="30" rows="3" class="txt__area"><?= ($user['address']) ?></textarea>
                                    </label>
                                </p>           
                            </div>
                            <div class="form__info-submit">
                                <p>                                 
                                    <input type="submit" class="btn btn--primary" name="updatein" value="Lưu"></input>
                                </p>
                            </div>                               
                          </fieldset>
                    </form>
                  
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


</body>
</html>
