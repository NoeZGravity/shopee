<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
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
    <title>Chi tiết đơn hàng</title>
</head>
    <body>
        <?php
        session_start();
        if (!empty($_SESSION['admin'])) {
            include 'admincp/connectdb.php' ;
            $order = mysqli_query($conn, "SELECT ord.name, ord.address, ord.phone, ord.note, detailord.*, tblpro.pro_name as pro_name  
FROM ord
INNER JOIN detailord ON ord.ord_id = detailord.ord_id
INNER JOIN tblpro ON tblpro.pro_id = detailord.pro_id
WHERE ord.ord_id = " . $_GET['id']);
            $orders = mysqli_fetch_all($order, MYSQLI_ASSOC);          
    
        }
        ?>
        <div id="order-detail-wrapper">
            <div id="order-detail">           
                <h1>Chi tiết đơn hàng</h1>
                <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br/>
                <label>Điện thoại: </label><span> <?= $orders[0]['address'] ?></span><br/>
                <label>Địa chỉ: </label><span> <?= $orders[0]['phone'] ?></span><br/>
                <hr/>            
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                            <span class="item-name"><?= $row['pro_name'] ?></span>
                            <span class="item-quantity"> - SL: <?= $row['quantity'] ?> sản phẩm</span>
                        </li>
                        <?php
                        $totalMoney += ($row['dord_price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
                </ul>
                <hr/>
                <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> <?= number_format($totalMoney, 0, ",", ".") ?> đ
                <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
            </div>
        </div>

    </body>
</html>