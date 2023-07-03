<?php include 'admincp/connectdb.php' ;  
    
    if(isset($_POST['signin'])) {      
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['pword'];     
        $gender = $_POST['gender'];
        $birthday = date('Y-m-d', strtotime($_POST['birthday']));       
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
       
      
       

        if(!empty($fullname) && !empty($username) && !empty($password) && !empty($gender) &&  !empty($birthday) && !empty($address)) { 
            $pass= password_hash($password, PASSWORD_DEFAULT);  
                  
            $sql = "INSERT INTO tbluser (uid, fullname, username, pword, gender, birthday, address, utelephone) VALUES (NULL,'$fullname', '$username',
                     '$pass', '$gender', '$birthday', '$address', ' $telephone')";
                    
            if($conn->query($sql)===TRUE ) {
                $_SESSION['status'] = "Đăng ký thành công";                           
                header('Location: loginpage.php') ;  
                                  				
            } else {
                $_SESSION['status'] = "Đăng ký thất bại";  
                header('Location: loginpage.php') ;                				
            }
        }       

    }
    
?>