<?php
include 'admincp/connectdb.php' ;

require_once 'admincp/connectdb.php' ;  
$userid = $_GET['id'];
$sql3 = "SELECT * FROM tbluser WHERE uid = '$userid' " ;
$result = mysqli_query($conn, $sql3);
$user = mysqli_fetch_assoc($result);


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
    <link rel="stylesheet" href="./assets/font/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="./resources/ckeditor/ckeditor.js"></script>
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
                <li><button class=" btn btn--primary1 btn_mag-pay"> Quản lý hóa đơn</button></li>
                <li><button class=" btn btn--primary1 btn_mag-pro"> Quản lý sản phẩm</button></li>
                <li><button class=" btn btn--primary1 btn_mag-cus"> Quản lý khách hàng</button></li>                                         
                <li><a href="#">Xem thống kê</a></li>
            </ul>
        </div>
        <div class="container2 ">
            <div class="container_admin">
            <?php
include 'admincp/connectdb.php' ;
if (!empty($_SESSION['admin'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 100;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($conn, "SELECT * FROM tbluser");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $users = mysqli_query($conn, "SELECT * FROM tbluser ORDER BY uid ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($conn);
    ?>
    
    <?php }
?>
    <div class="main-content main-content-modal-edit">
        <h1>Chi tiết sản phẩm</h1>
        <div id="content-box">
        <?php if(!empty($error)) { ?>
            <div class = "container2">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "indexadmin.php">Quay lại danh sách sản phẩm</a>
                </div>
             <?php } else { ?>
                <form id="product-form" method="POST" action="indexadmin.php?action=updatecus"  >
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên khách: </label>
                        <input type="text" name="fullname" value="<?= ($user['fullname']) ?>"  required/>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>User name: </label>
                        <input type="text" name="name" value="<?= ($user['username']) ?>" required />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Password: </label>
                        <input type="text" name="pword" value="<?= ($user['pword']) ?>" required />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="imageuser" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giới tính: </label>
                        <p>                                  
                            <input class="auth__info-gender-lb" type="radio" name="gender" id="gender" value="male" ></input>
                            <label class="type__gender type_gender_admin">Nam</label>
                            <input class="auth__info-gender-lb type_gender_female" type="radio" name="gender" id="gender" value="female" ></input>
                            <label class="type__gender type_gender_admin type_gender_female">Nữ</label>                                    
                        </p>   
                        
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ngày sinh: </label>
                        <input type="date" name="birthday" value="<?= ($user['birthday']) ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Số điện thoại: </label>
                        <input type="tel" name="telephone" value="<?= ($user['utelephone']) ?>" required />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Địa chỉ: </label>
                        <input type="text" name="address" value="<?= ($user['address']) ?>" required></input>
                        <div class="clear-both"></div>
                    </div>
                    <div class="btn__footer">
                      <input type="submit" class="btn btn--primary btn_addp_cus" value="Lưu"></input>
                      </div>
                      </form>                    
                      <button class="btn btn--primary btn_backp btn_cus" onclick="window.location.href='indexadmin.php'">Quay lại</button>
                    
                
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
            <?php } ?>
            
        </div>
            </div>               
        </div>
        </div>
</div>
</body>
</html>