<?php
include 'admincp/connectdb.php';
unset($_SESSION['user']);
header('location: loginpage.php');
?>
<?php
session_destroy();
?>