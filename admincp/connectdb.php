<?php
$severname = "localhost";
$username = "root";
$password = "myth2000";
$database = "dbanimal";

$conn = mysqli_connect($severname,$username,$password,$database);
if(!$conn) {
    echo ("Connect fail! Try again");
} else {
    echo ("");
}
?>