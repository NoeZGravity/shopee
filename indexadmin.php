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
<?php
include 'admincp/connectdb.php' ;
include 'function.php' ; 
            if (isset($_GET['action'])) {    
                switch($_GET['action']) {
                    case "add":
                        if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                            $galleryImages = array();
                            if (empty($_POST['name'])) {
                                $error = "Bạn phải nhập tên sản phẩm";
                            } elseif (empty($_POST['price'])) {
                                $error = "Bạn phải nhập giá sản phẩm";
                            } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                                $error = "Giá nhập không hợp lệ";
                            } elseif(!isset($_FILES['image'])) {
                                $error = "Bạn chưa thêm hình";
                            }                                                                                                              
                            if (!isset($error) && isset($_FILES['image'])) {
                                $uploadedFiles = $_FILES['image'];
                                $result = uploadFiles($uploadedFiles);                              
                                $img = $result['path'];   
                               
                                $result = mysqli_query($conn, "INSERT INTO tblpro (pro_id, pro_name, pro_img, pro_price, pro_create, pro_lastupdate, pro_content, pro_type) VALUES (NULL, '" . $_POST['name'] . "','" .$img. "', " . str_replace('.', '', $_POST['price']) . ", " . time() . ", " . time() . ", '" . $_POST['content'] . "', '" . $_POST['type'] . "');");
                                $sucess = "Thêm sản phẩm thành công";  
                               
                                header('Location: indexadmin.php') ;                            
                                if (!$result ) {
                                    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                                }
                            }                                    
                            
                        } else {
                            $error = "Bạn chưa nhập thông tin sản phẩm.";
                        }

                        break;
                        case "updatepro":
                            $pro_id = $_GET['id'];
                            if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                                $galleryImages = array();
                                if (empty($_POST['name'])) {
                                    $error = "Bạn phải nhập tên sản phẩm";
                                } elseif (empty($_POST['price'])) {
                                    $error = "Bạn phải nhập giá sản phẩm";
                                } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                                    $error = "Giá nhập không hợp lệ";
                                } elseif(!isset($_FILES['image'])) {
                                    $error = "Bạn chưa thêm hình";
                                }                                                                                                              
                                if (!isset($error) && isset($_FILES['image'])) {
                                    $uploadedFiles = $_FILES['image'];
                                    $result = uploadFiles($uploadedFiles);                              
                                    $img = $result['path'];   
                                   
                                    $result = mysqli_query($conn, "UPDATE tblpro set pro_name = '" . $_POST['name'] . "', pro_img = '" .$img. "', pro_price =  " . str_replace('.', '', $_POST['price']) . ", pro_create =  " . time() . ", pro_lastupdate = " . time() . ", pro_content = '" . $_POST['content'] . "', pro_type = '" . $_POST['type'] . "'  
                                                  WHERE pro_id =  '$pro_id' ");                                  
                                    header('Location: indexadmin.php') ;  
                                }else {
                                        $result = mysqli_query($conn, "UPDATE tblpro set pro_name = '" . $_POST['name'] . "', pro_price =  " . str_replace('.', '', $_POST['price']) . ", pro_create =  " . time() . ", pro_lastupdate = " . time() . ", pro_content = '" . $_POST['content'] . "', pro_type = '" . $_POST['type'] . "'  
                                        WHERE pro_id =  '$pro_id' ");                                  
                                         header('Location: indexadmin.php') ;  
                                    }  
                                    if (!$result ) {
                                        $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                                    }                                                          
                                } else {
                                $error = "Bạn chưa nhập thông tin sản phẩm.";
                            }

                        break;
                        case "addcus":
                            if (isset($_POST['fullname']) && !empty($_POST['fullname'])) {
                                $galleryImages = array();
                                if (empty($_POST['fullname'])) {
                                    $error = "Bạn phải nhập tên khách hàng";
                                } elseif (empty($_POST['name'])) {
                                    $error = "Bạn phải nhập username";  
                                }elseif (empty($_POST['pword'])) {
                                        $error = "Bạn phải nhập password";                 
                                }
                                if (!isset($error) && isset($_FILES['imageuser'])) {
                                    $uploadedFiles = $_FILES['imageuser'];
                                    $result = uploadFiles($uploadedFiles);                              
                                    $img = $result['path'];   
                                    $result = mysqli_query($conn, "INSERT INTO tbluser (uid, fullname, username, pword, gender, birthday, address, utelephone, uimg) VALUES (NULL,'" . $_POST['fullname'] . "', '" . $_POST['name'] . "',
                                    '" . $_POST['pword'] . "', '" . $_POST['gender'] . "', '" . $_POST['birthday'] . "', '" . $_POST['address'] . "','" . $_POST['telephone'] . "', '" . $_POST['img'] . "')");
                                } else {
                                    $result = mysqli_query($conn, "INSERT INTO tbluser (uid, fullname, username, pword, gender, birthday, address, utelephone, uimg) VALUES (NULL,'" . $_POST['fullname'] . "', '" . $_POST['name'] . "',
                                    '" . $_POST['pword'] . "', '" . $_POST['gender'] . "', '" . $_POST['birthday'] . "', '" . $_POST['address'] . "','" . $_POST['telephone'] . "', NULL)");
            
                                }
                                var_dump($result);
                                if (!$result) {
                                        $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                                    }                     
                               
                            } else {
                                $error = "Bạn chưa nhập thông tin khách hàng.";
                            }
                            break;
                            case "updatecus":
                                $userid = $_GET['id'];
                                if (isset($_POST['fullname']) && !empty($_POST['fullname']) ) {
                                    $galleryImages = array();
                                    if (empty($_POST['fullname'])) {
                                        $error = "Bạn phải nhập tên khách";
                                    } elseif (empty($_POST['username'])) {
                                        $error = "Bạn phải nhập username";
                                    } elseif (empty($_POST['pword']) ) {
                                        $error = "Bạn phải nhập password";
                                    } elseif(!isset($_FILES['image'])) {
                                        $error = "Bạn chưa thêm hình";
                                    }                                                                                                              
                                    if (!isset($error) && isset($_FILES['imageuser'])) {
                                        $uploadedFiles = $_FILES['imageuser'];
                                        $result = uploadFiles($uploadedFiles);                              
                                        $img = $result['path'];   
                                       
                                        $result = mysqli_query($conn, "UPDATE tbluser set fullname = '".$_POST['fullname']."', username = '".$_POST['username']."', utelephone = '".$_POST['utelephone']."', gender = '".$_POST['gender']."', 
                                                               birthday = '".$_POST['birthday']."', address = '".$_POST['address']."', uimg = '".$_POST['imageuser']."'  
                                                                WHERE uid =  '$userid' ");                                  
                                        header('Location: indexadmin.php') ;  
                                    }else {
                                        $result = mysqli_query($conn, "UPDATE tbluser set fullname = '".$_POST['fullname']."', username = '".$_POST['username']."', utelephone = '".$_POST['utelephone']."', gender = '".$_POST['gender']."', 
                                        birthday = '".$_POST['birthday']."', address = '".$_POST['address']."' 
                                         WHERE uid =  '$userid' ");                                         
                                             header('Location: indexadmin.php') ;  
                                        }  
                                        if (!$result ) {
                                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                                        }                                                          
                                    } else {
                                    $error = "Bạn chưa nhập thông tin khách hàng.";
                                }
    
                            break;

                    }                     
                ?>
            <?php } ?>


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
<div class="app app_admin">
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
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page']:100;
    $current_page = (!empty($_GET['page'])) ? $_GET['page']:1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($conn, "SELECT * FROM tblpro");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($conn, "SELECT * FROM tblpro ORDER BY pro_id ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
   
  
    ?>
    <div class="main-content main-content_list">
        <h1>Danh sách sản phẩm</h1>
        <div class="product-items">
              
            <div class="buttons">
                <button class="btn--primary btn__add">Thêm sản phẩm</button>
            </div>         
            <ul> 
                <li class="product-item-heading">
                    <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop product-name"><span class="product-name-i">Tên sản phẩm</span></div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    <div class="product-prop product-button">
                        Copy
                    </div>
                    <div class="product-prop product-time">Giá thành</div>
                    <div class="product-prop product-time">Ngày cập nhật</div>
                    <div class="clear-both"></div>
                </li>   
                     
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>
                        <div class="product-prop product-img"><img src="<?= $row['pro_img'] ?>" width="70px" height="70px"  title="<?= $row['pro_name'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['pro_name'] ?></div>
                        <div class="product-prop product-button">
                            <a href="./product_delete.php?id=<?= $row['pro_id'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['pro_id'] ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['pro_id'] ?>&task=copy">Copy</a>
                        </div>
                        <div class="product-prop product-time"><?= number_format($row['pro_price'], 0, ",", ".")?></div>
                        <div class="product-prop product-time"><?= date('d-m-Y', strtotime($row['pro_lastupdate'])) ?></div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
                <?php
                include 'paginationad.php';
                 ?>   
            </ul>
            

            <div class="clear-both"></div>
        </div>
    </div>
    <?php }
?>
    <div class="main-content main-content-modal">
        <h1>Thêm sản phẩm</h1>
        <div id="content-box">
        <?php if(!empty($error)) { ?>
            <div class = "container2">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "indexadmin.php">Quay lại danh sách sản phẩm</a>
                </div>
             <?php } else { ?>
                <form id="product-form" method="POST" action="indexadmin.php?action=add"  enctype="multipart/form-data">
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field wrap-field-type">
                        <label>Loại sản phẩm: </label>
                        <select type="text" name="type" >
                            <option  value="Dog">Chó</option>
                            <option value="Cat">Mèo</option>
                            <option value="Other">Khác</option>
                        </select>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh sản phẩm: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <?php /*
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>*/?>
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"></textarea>
                        <div class="clear-both"></div>
                    </div>
                    <div class="btn__footer">
                      <input type="submit" class="btn btn--primary btn_addp" name="themsp" value="Thêm"></input>
                      </div>
                      </form>                    
                      <button class="btn btn--primary  btn_backp">Quay lại</button>
                    
                
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
        <div class="container_admin_cus">
        <?php
include 'admincp/connectdb.php' ;
if (!empty($_SESSION['admin'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecordcus = mysqli_query($conn, "SELECT * FROM tbluser");
    $totalRecordcus = $totalRecordcus->num_rows;
    $totalPagecus = ceil($totalRecordcus / $item_per_page);
    $useradmin = mysqli_query($conn, "SELECT * FROM tbluser ORDER BY uid ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($conn);
    ?>
    <div class="main-content main-content_list_cus">
        <h1>Danh sách khách hàng</h1>
        <div class="product-items">
            <div class="buttons">
                <button class="btn--primary btn__add_cus">Thêm khách hàng</button>
            </div>         
            <ul> 
                <li class="product-item-heading">
                    <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop product-name"><span class="product-name-i">Tên khách hàng</span></div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    <div class="product-prop product-button">
                        UID
                    </div>
                    <div class="product-prop product-time">SĐT</div>
                    <div class="product-prop product-time">Ngày sinh</div>
                    <div class="clear-both"></div>
                </li>             
                <?php
                while ($row = mysqli_fetch_array($useradmin)) {
                    ?>
                    <li>
                        <div class="product-prop product-img"><img src="<?= $row['uimg'] ?>" width="70px" height="70px"  title="<?= $row['username'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['fullname'] ?></div>
                        <div class="product-prop product-button">
                            <a href="./cus_delete.php?id=<?= $row['uid'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./cus_editing.php?id=<?= $row['uid'] ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <span><?= $row['uid'] ?></span>
                        </div>
                        <div class="product-prop product-time"><?= $row['utelephone']?></div>
                        <div class="product-prop product-time"><?=  date('d-m-Y', strtotime($row['birthday'])) ?></div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include 'pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php }
?>
    <div class="main-content main-content-modal-cus">
        <h1>Thêm khách hàng</h1>
        <div id="content-box">
         
                <?php if(!empty($error)) { ?>
            <div class = "container2">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "indexadmin.php">Quay lại danh sách khách hàng</a>
                </div>
             <?php } else { ?>            
                <form id="product-form" method="POST" action="?action=addcus"  >
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên khách: </label>
                        <input type="text" name="fullname" value=""  required/>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>User name: </label>
                        <input type="text" name="name" value="" required />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Password: </label>
                        <input type="text" name="pword" value="" required />
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
                        <input type="date" name="birthday" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Số điện thoại: </label>
                        <input type="tel" name="telephone" value="" required />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Địa chỉ: </label>
                        <input type="text" name="address" id="product-content" required></input>
                        <div class="clear-both"></div>
                    </div>
                    <div class="btn__footer">
                      <input type="submit" class="btn btn--primary btn_addp_cus" value="Thêm"></input>
                      </div>
                      </form>                    
                      <button class="btn btn--primary btn_backp_cus">Quay lại</button>
                    
                
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
        <div class="container_admin_payment">
        <?php
include 'admincp/connectdb.php' ;
if (!empty($_SESSION['admin'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 100;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecordord= mysqli_query($conn, "SELECT * FROM ord");
    $totalRecordord = $totalRecordord->num_rows;
    $totalPageord = ceil($totalRecordord / $item_per_page);
    $orderad = mysqli_query($conn, "SELECT * FROM ord ORDER BY ord_id ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($conn);
    ?>
    <div class="main-content main-content_list_payment">
        <h1>Danh sách hóa đơn</h1>
        <div class="product-items">
            <div class="buttons">
                
            </div>         
            <ul> 
                <li class="product-item-heading">
                    <div class="product-prop product-img">Mã hóa đơn</div>
                    <div class="product-prop product-name product-name-ord"><span class="product-name-i">Tên khách hàng</span></div>
                    <div class="product-prop product-button">
                        In
                    </div>                 
                    <div class="product-prop product-time product-time-pay">Điện thoại</div>
                    <div class="product-prop product-time product-time-pay">Địa chỉ</div>
                    <div class="product-prop product-time-ord ">Ngày đặt hàng</div>
                    <div class="clear-both"></div>
                </li>             
                <?php
                while ($row = mysqli_fetch_array($orderad)) {
                    ?>
                    <li>
                        <div class="product-prop product-img"><?= $row['ord_id'] ?></div>
                        <div class="product-prop product-name"><?= $row['name'] ?></div>
                        <div class="product-prop product-button">
                            <a href="order_printing.php?id=<?=$row['ord_id']?>" target="_blank">In</a>
                        </div>                  
                        <div class="product-prop product-time product-time-pay"><?= $row['address']?></div>
                        <div class="product-prop product-time product-time-pay"><?= $row['phone']?></div>
                        <div class="product-prop product-time product-time-pay"><?=  date('d-m-Y', strtotime($row['ord_create'])) ?></div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include 'pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
        </div>
<?php } ?>
    </div>

   
<script>
    $(document).ready(function(){
    $(".btn_mag-pay").click(function(){
      $(".main-content_list_payment").show();  
      $(".main-content_list_cus").hide();
      $(".main-content_list").hide();
      $(".main-content-modal").hide();
      $(".main-content-modal-cus").hide();

    });
  });
     $(document).ready(function(){
    $(".btn_mag-pro").click(function(){
      $(".main-content_list").show();  
      $(".main-content_list_cus").hide();
      $(".main-content-modal").hide();
      $(".main-content-modal-cus").hide();
      $(".main-content_list_payment").hide();

    });
  });

  $(document).ready(function(){
    $(".btn_mag-cus").click(function(){
      $(".main-content_list_cus").show();  
      $(".main-content_list").hide();
      $(".main-content-modal-cus").hide();
      $(".main-content-modal").hide();
      $(".main-content_list_payment").hide();

    });
  });
  </script>
  <script>
     $(document).ready(function(){
    $(".product-items-number").click(function(){
      $(".main-content_list").show();  
      $(".main-content_list_cus").hide();
      $(".main-content-modal").hide();
      $(".main-content-modal-cus").hide();
      $(".main-content_list_payment").hide();

    });
  });
  </script>
  

<script>
     $(document).ready(function(){
    $(".btn__add").click(function(){
      $(".main-content-modal").show();  
      $(".main-content_list").hide();  
      

    });
  });

  $(document).ready(function(){
    $(".btn_backp").click(function(){
        $(".main-content_list").show();  
       $(".main-content-modal").hide();
   
    });
  });
  $(document).ready(function(){
    $(".btn__add_cus").click(function(){
      $(".main-content-modal-cus").show();  
      $(".main-content_list_cus").hide();  

    });
  });

  $(document).ready(function(){
    $(".btn_backp_cus").click(function(){
        $(".main-content-modal-cus").hide();  
        $(".main-content_list_cus").show(); 
   
    });
  });
 </script>
        </div>

        </div>
</div>
</body>
</html>