<?php
include 'indexadmin.php';
if (!empty($_SESSION['admin'])) {
    ?>
    <div class="main-content">
        <h1>Xóa khách hàng</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include 'admincp/connectdb.php' ;
                $result = mysqli_query($conn, "DELETE FROM tbluser WHERE uid = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa khách hàng.";
                }
                mysqli_close($conn);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Thông báo</h2>
                        <h4><?= $error ?></h4>
                        <a href="indexadmin.php">Danh sách khách hàng</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Xóa khách hàng thành công</h2>
                        <a href="indexadmin.php">Danh sách khách hàng</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}

?>