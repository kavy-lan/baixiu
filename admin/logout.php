<?php 
    session_start();
    unset($_SESSION['userInfo']);
    echo '正在退出';
    header('refresh:2,url=./login.php');


?>