
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
$animalid = $_GET['id'];
$sql3 = "SELECT * FROM tblanimal WHERE animal_id = '$animalid' and animal_type = 'Cat' " ;
$result = mysqli_query($conn, $sql3);
$animal = mysqli_fetch_assoc($result);
$sql4 = "SELECT * FROM tblanimal WHERE animal_id = '$animalid' ";
$image = mysqli_query($conn, $sql4);
$animal['animal_imgs'] = mysqli_fetch_all($image, MYSQLI_ASSOC) ;

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
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2-dist/css/bootstrap-grid.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    
                    <?php if(isset( $user["username"])){?>
                    <li class="header__navbar-item header__navbar-user">
                        <img src="<?= $user["uimg"]?>" alt="" class="header__navbar-user-img">
                        <span class="header__navbar-item-username"><?php echo $user["fullname"] ?></span>                       

                        <ul class="header__navbar-user-hanghoa">
                            <li class="header__navbar-user-detail">
                                <a  href="info.php?uid=<?= $user["uid"]?>"><i class="fas fa-user daxua1"></i>Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-detail">
                                <a  href="index.php"><i class="fas fa-map-marker-alt daxua2"></i>Trang chủ</a>
                            </li>
                            <li class="header__navbar-user-detail">
                               <a  href="payment.php<?= $user["uid"]?>"><i class="fas fa-clipboard-list daxua2"></i>Đơn mua</a>
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
                    </li>
                </ul>
            </nav>
            <div class="header-with-search">
                <div class="header-logo">
                    <a href="index.php">
                        <li  class=" header-logo-img">
                            <img src="./assets/img/dogily-logo.png" alt=""  class=" header-logo-img">
                        </li>    
                    </a>                                   
                </div>
</header>
    </div>
    <div class="detail-body">                                         
            <div class="grid__column-10-2">
                <h1 class="headeru__info_name detail-header"><?= ($animal['animal_name']) ?></h1>
                <div class="detail-img"><img src="<?= ($animal['animal_img']) ?>" width="300px" height="300px" alt=""></div>              
                <h3 class="detail-all">Đặc điểm chung</h3> 
                <ul class="detail-animal">
                    <li class="detail-animal-name">Khả năng thích ứng: 90</li>
                    <li class="detail-animal-name">Mức độ tình cảm: 80</li>
                    <li class="detail-animal-name">Sống trong nhà phố, chung cư: 80</li>
                    <li class="detail-animal-name">Mức độ sủa: 80</li>
                    <li class="detail-animal-name">Thân thiện với mèo: 70</li>
                    <li class="detail-animal-name">Thân thiện với chó: 70</li>
                    <li class="detail-animal-name">Thân thiện với trẻ em: 80</li>
                    <li class="detail-animal-name">Thân thiện với người lạ: 60</li>
                    <li class="detail-animal-name">Nhu cầu vận động: 70</li>
                    <li class="detail-animal-name">Chải lông: 70</li>
                    <li class="detail-animal-name">Các vấn đề sức khỏe: 70</li>
                    <li class="detail-animal-name">Sự thông minh: 90</li>
                    <li class="detail-animal-name">Mức độ rụng lông: 70</li>
                    <li class="detail-animal-name">Mức độ dễ làm đẹp: 80</li>
                    <li class="detail-animal-name">Khả năng chịu nóng: 60</li>
                    <li class="detail-animal-name">Khả năng chịu lạnh: 90</li>
                </ul>
                <div class="buys-product">
                    <button class="btn btn--primary">
                        <i class="fas fa-shopping-cart"></i>
                       Liên hệ với chúng tôi
                    </button>
                </div>
                <div class="detail-infos">
                    <h4 class="detail-infos-header">Thông tin chung</h4>
                    <div class="detail-infos-main"><?= ($animal['animal_info']) ?></div>
                    <div class="detail-infos-main-next">
                        
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