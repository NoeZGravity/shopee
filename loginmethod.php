<?php
include 'admincp/connectdb.php' ;


if(isset($_POST['usernamelog'])) {
    $usernamelog = $_POST['usernamelog'];
    $passwordlog = $_POST['pwordlog'];
    
    $sql1 = "SELECT * FROM tbluser WHERE username = '$usernamelog' ";
    $sql0 = "SELECT * FROM admin WHERE admin = '$usernamelog' ";
    $query_run = mysqli_query($conn, $sql1);
    $query_run1 = mysqli_query($conn, $sql0);
    $data = mysqli_fetch_assoc($query_run);
    $data1 = mysqli_fetch_assoc($query_run1);
    $check_user = mysqli_num_rows($query_run);
    $check_ad = mysqli_num_rows($query_run1);

    if ($check_ad == 1 && $check_user == 0) {
        $check_p = $data1['adpword'];
        if($passwordlog == $check_p) {
            $_SESSION['admin'] = $data1;
            header('Location: indexadmin.php');
        } else{
            echo "Sai mật khẩu";
        }     

    } elseif($check_user == 1 && $check_ad == 0) {
        $checkPass = password_verify($passwordlog, $data['pword']);
        if ($checkPass) {
            $_SESSION['user'] = $data;
            header('Location: index.php'); 
        } else {
            echo "Sai mật khẩu";
        }            
    } else {
        echo "Sai thông tin";
        $_SESSION['status'] = "Đăng nhập thất bại! Vui lòng thử lại";
        header('Location: loginpage.php') ; 
    }
}


?>