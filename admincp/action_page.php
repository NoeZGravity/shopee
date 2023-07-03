<?php
     setcookie("user_name", "NIIT", time()+ 60,'/'); // Hết hạn sau 60s
     echo 'the cookie has been set for 60 seconds';
?>
<?php
     print_r($_COOKIE);    //In ra nội dung trong biens mảng $_COOKIE 
?>