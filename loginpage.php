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
include 'signin.php';
include 'loginmethod.php';

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
    <title>Dogily</title>
</head>
<body>
<div class="modal">
        <div class="modal__overlay">
        </div>
        <div class="modal-logo">        
                <li  class=" modal-logo-img">
                    <img src="./assets/img/dogily-logo.png" alt=""  class=" modal-logo-img">
                </li>                                                
        </div>
        <div class="modal__body">
            <div class="modal__inner">
                <div class="auth-form-login">
                    <form action="" method="POST">
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng nhập</h3>                                                   
                        </div>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <span class="auth_form__group-title">Username</span>
                                <input type="text" class="auth-form__input" name="usernamelog" id="usernamelog" required placeholder="Email của bạn">
                            </div>
                            <div class="auth-form__group">
                                <span class="auth_form__group-title">Password</span>
                                <input type="password" class="auth-form__input" name="pwordlog" id="pwordlog" required placeholder="Mật khẩu của bạn">
                            </div>                         
                        </div>                             
                        <div class="auth-form_controls-login">                          
                            <input type="submit" class="btn btn--primary login-btn" id="logins" name="logins" value="ĐĂNG NHẬP"></input>
                            <button class="btn btn--primary switch-btn" >ĐĂNG KÝ</button>                         
                        </div>                   
                    </div>
                    </form> 
                    <div class="auth-form__socials">
                        <a href="" class="auth-form__socials--facebook btn btn--sizes btn--with-icon">
                            <i class="fab fa-facebook-square"></i>
                            <span class="auth-form__social-text">Kết nối với Facebook</span>
                        </a>
                        <a href="" class="auth-form__socials--google btn btn--sizes btn--with-icon">
                            <i class="fab fa-google"></i>
                            <span class="auth-form__social-text"> Kết nối với Google</span>             
                        </a>
                    </div>
                                   
                </div>  
                <div class="auth-form" >
                    <form action="loginpage.php?action=submit" method="POST">
                        <div class="auth-form__container">
                            <div class="auth-form__header">
                                <h3 class="auth-form__heading">Đăng ký</h3>                                                                                               
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group">
                                    <span class="auth_form__group-title">Họ tên</span>
                                    <input type="text" class="auth-form__input"  name="fullname" id="fullname" required placeholder="Họ tên của bạn">
                                </div>
                                <div class="auth-form__group">
                                    <span class="auth_form__group-title">Username</span>
                                    <input type="text" class="auth-form__input"  name="username" id="username" required placeholder="Email của bạn">
                                </div>
                                <div class="auth-form__group">
                                    <span class="auth_form__group-title">Password</span>
                                    <input type="password" class="auth-form__input"  name="pword" id="pword" required placeholder="Mật khẩu của bạn">
                                </div>
                                <div class="form__info-gender">
                                    <span class="auth_form__group-title">Giới tính</span>
                                    <p>                                  
                                        <input class="auth__info-gender-lb" type="radio" name="gender" id="gender" value="male" ></input>
                                        <label class="type__gender">Nam</label>
                                        <input class="auth__info-gender-lb" type="radio" name="gender" id="gender" value="female" ></input>
                                        <label class="type__gender">Nữ</label>                                    
                                    </p>   
                            </div>                     
                            <div class="form__info-birthday">
                                <span class="auth_form__group-title">Ngày sinh</span>
                                <p>
                                     
                                    <label class="auth__info-birthday-lb"><input type="date" id="birthday" name="birthday"></label>
                                </p>  
                            </div>
                            <div class="auth-form__group">
                                <span class="auth_form__group-title">Số điện thoại</span>
                                <input type="text" class="auth-form__input"  name="telephone" id="telephone" required placeholder="">
                            </div>
                            <div class="auth-form__group">
                                <span class="auth_form__group-title">Địa chỉ</span>
                                <input type="text" class="auth-form__input"  name="address" id="address" required placeholder="">
                            </div>
                            </div>                              
            
                            <div class="auth-form_controls">
                                <button class="btn btn__back btn--primary">TRỞ LẠI</button>
                                 <input id="signin" class="btn btn--primary btn-signup" type="submit" name="signin" value="ĐĂNG KÝ"></input>
                            </div>                   
                        </div> 
                    </form> 
                </div>           
        </div>      
        </div>
        
</div>
<script>
    $(document).ready(function(){
    $(".switch-btn").click(function(){
      $(".auth-form").show();
      $(".auth-form-login").hide();     
    });
  });

  $(document).ready(function(){
    $(".btn__back").click(function(){
      $(".auth-form").hide();
      $(".auth-form-login").show();     
    });
  });
</script>

<script>
    $(document).ready(function () {
      $('#sigin').click(function () {
        alert('Đăng ký thành công');
        });
    });
</script>

</body>
</html>
