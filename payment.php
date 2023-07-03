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
$useruid = $user['uid'];

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
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2-dist/css/bootstrap-grid.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
    <title>Hóa đơn</title>   
</head>
<body>
<?php
    include 'admincp/connectdb.php' ;
    if(!isset($_SESSION["payment"])) {
        $_SESSION["payment"] = array();

    }
    $sucess = false;
    $error = false;
    if(isset($_GET['action'])) {
        function update_pro($add = false) {
            foreach ($_POST['quantity'] as $pro_id => $quantity) {
                if($add ) {
                    $_SESSION["payment"][$pro_id] += $quantity; 
                } else {
                    $_SESSION["payment"][$pro_id] = $quantity; 
                }
                                
            }
        }     
        switch($_GET['action']) {
            case "clickadd":             
                    update_pro(true);
                    header('Location: ./payment.php');
                break;
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION["payment"][$_GET['id']]);                   
                }
                header('Location: ./payment.php');      
                break;
            case "submit":
                if(isset($_POST['update_click'])) {
                    update_pro();
                    header('Location: ./payment.php');
                    
                } elseif(isset($_POST['order_click'])) {
                    if(empty($_POST['name'])) {
                        $error = "Vui lòng nhập tên!";
                    } elseif (empty($_POST['address'])) {
                        $error = "Vui lòng nhập địa chỉ!";
                    } elseif (empty($_POST['phone'])) {
                        $error = "Vui lòng nhập SĐT!";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Giỏ hàng rỗng!";
                    } if ($error == false && !empty($_POST['quantity'])) {
                        $procost = mysqli_query($conn, "SELECT * FROM tblpro WHERE pro_id IN (".implode(",", array_keys($_POST['quantity'])).")");
                        $totalcost = 0;
                        $orderPro = array();
                        while($row = mysqli_fetch_array($procost)) {
                            $orderPro[] = $row;
                            $totalcost += $_POST['quantity'][$row['pro_id']] * $row['pro_price'];
                        }
                        $buyuid = $_POST['uid'];
                        $buyname = $_POST['name'];
                        $buyaddress = $_POST['address'];
                        $buyphone = $_POST['phone'];
                        $buycmt = $_POST['cmtext'];
                        $buytime = date('Y-m-d');
                        $insertOrd = "INSERT INTO ord (ord_id, uid, name, phone, address, note, total, ord_create, ord_update) VALUES (NULL, '$buyuid'
                        , '$buyname', '$buyaddress', '$buyphone', '$buycmt', '$totalcost', '$buytime', '$buytime')";
                        if($conn->query($insertOrd)===TRUE ) {
                            $_SESSION['notifybuy'] = "Đặt hàng thành công";                         
                        }
                        $orderID = $conn->insert_id;
                        $insertString = "";
                        foreach($orderPro as $key => $prodcbuy ) {
                            $insertString .= "(NULL, '$orderID', '".$prodcbuy['pro_id']."', '".$_POST['quantity'][$prodcbuy['pro_id']]."'
                            , '".$prodcbuy['pro_price']."', '$buytime', '$buytime')";
                            if ($key != count($orderPro) - 1) {
                                $insertString .= ",";
                            

                        }
                        
                        $insertDetail = mysqli_query($conn,"INSERT INTO detailord (dord_id, ord_id, pro_id, quantity, dord_price, dord_create, dord_update) VALUES (NULL, '$orderID', '".$prodcbuy['pro_id']."', '".$_POST['quantity'][$prodcbuy['pro_id']]."'
                        , '".$prodcbuy['pro_price']."', '$buytime', '$buytime') ");
                        $sucess = "Đặt hàng thành công";
                        unset($_SESSION["payment"]);
                        
                    }
                }
                break;
        }
    }
}
    if(!empty($_SESSION["payment"])) {     
        $probuy = mysqli_query($conn, "SELECT * FROM tblpro WHERE pro_id IN (".implode(",", array_keys($_SESSION["payment"])).")");
    }
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
<?php if(!empty($error)) { ?>
    <div class="notify_msg">
        <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
    </div>
<?php } elseif(!empty($sucess)) { ?>
    <div class="notify_msg">
          <?= $sucess ?>. <a href="index.php">Tiếp tục mua sắm</a>
     </div>
<?php } else { ?>
    <div class="payment_body">
    <div class="grid__column-10-2">
        <div class="headeru__info">
            <h1 class="headeru__info_name"><a href="index.php" class="headeru__info_name-a">Trang chủ</a></h1>
            <span class="headeru__title">Chi tiết đơn hàng</span>
        </div>
        <div class="table-responsive-sm bill">
            <form action="payment.php?action=submit" method="POST">
                <table class="table table-bordered table-sm tbproduct">
                    <thead class="table-light">
                        <tr>
                    <th class="product__buy">STT</th>
                    <th class="product__buy">Tên sản phẩm</th>
                    <th class="product__buy">Ảnh sản phẩm</th>
                    <th class="product__buy product__buy-pricess">Đơn giá</th>
                    <th class="product__buy">Số lượng</th>
                    <th class="product__buy">Thành tiền</th>
                    <th class="product__buy">Xóa</th>
                        </tr>
                        <?php
                        if(!empty($probuy)) {
                            $totalPro = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($probuy)) {?>
                            <tr>
                                <td class="product__buy-number"><span class="product__buy-span"><?= $num++; ?></span></td>
                                <td class="product__buy-name"><span class="product__buy-span"><?= $row['pro_name']?></span></td>
                                <td class="product__buy-img"><img src="<?= $row['pro_img']?>" width="100px" height="100px" alt=""></td>
                                <td class="product__buy-price"><span class="product__buy-span" id="product__cost"><?= number_format($row['pro_price'], 0, ",", ".")?></span></td>
                                <td class="product__buy-amount">
                                    <span class="product__buy-span">    
                                                                                                                                                    
                                        <input type="text" value="<?= $_SESSION["payment"][$row['pro_id']]?>" class="product_quanti" name="quantity[<?= $row['pro_id']?>]">    
                                                                                          
                                    </span></td>
                                <td class="product__buy-total"><span class="product__buy-span" id="product__buy-spantotal"><?= number_format($_SESSION["payment"][$row['pro_id']] * $row['pro_price'], 0, ",", ".") ?></span></td>
                                <td class="product__buy-delete"><a href="payment.php?action=delete&id=<?= $row['pro_id']?>" class="btn__delete">Xóa</a></td>
                            </tr>
                            <?php
                         $totalPro += $_SESSION["payment"][$row['pro_id']] * $row['pro_price']; }   
                          if ($totalPro !=0 ) {?>                             
                        <tr>
                            <td class="product__buy-name"></td>
                            <td class="product__buy-name product__buy-money">Tổng tiền</td>
                            <td class="product__buy-name "></td>
                            <td class="product__buy-name"></td>
                            <td class="product__buy-name"></td>                         
                            <td class="product__buy-name"><i class="total_cost"><?= number_format($totalPro, 0, ",", ".") ?></i></td>
                            <td class="product__buy-name"></td>
                        </tr>
                          <?php } ?>   
                        <?php } else {?>
                            <?php
                            unset($_SESSION["payment"]);
                            ?>
                        <?php } ?>  
                            
                    </thead>
                </table>         
        </div>
        <div class="headeru__info">          
            <input type="submit" class="btn btn--primary btn--update" name="update_click" value="Cập nhật"></input>
        </div>

        
        <div class="container mt-3">   
                 <div class="mb-3 mt-3 lb__uid">
                  <label for="email" class="form-label">Họ tên:</label>
                  <input type="text" class="form-control" id="email"  placeholder="" name="uid" value="<?= $user["uid"]?>">
                </div>                 
                <div class="mb-3 mt-3 lb__name">
                  <label for="email" class="form-label">Họ tên:</label>
                  <input type="text" class="form-control" id="email"  placeholder="" name="name" value="<?= $user["fullname"]?>">
                </div>
                <div class="mb-3 lb__address">
                  <label for="pwd" class="form-label">Địa chỉ:</label>
                  <input type="text" class="form-control" id="pwd" placeholder="" name="address" value="<?= $user["address"]?>">
                </div>    
                <div class="mb-3 lb__phone">
                    <label for="pwd" class="form-label">SĐT:</label>
                    <input type="text" class="form-control" id="pwd"  placeholder="" name="phone" value="<?= $user["utelephone"]?>">
                  </div>     
                  <div class="mb-3 lb__note">
                    <label for="pwd" class="form-label">Ghi chú:</label>
                    <textarea class="form-control" rows="5" id="comment"  name="cmtext"></textarea>
                  </div>               
                <input type="submit" class="btn  btn--primary" name="order_click" value="Đặt hàng"></input>           
          </div>
          </form>
              
        
        
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


    <?php }
       ?>



</body>
</html>