<?php
if(isset($_GET['logout'])) {
    setcookie("Username", "", -1);
    if (!isset($_COOKIE['Username'])) {
        echo "已退出登录！";
    }
}
//header("Location: ".$_SERVER['HTTP_REFERER']);

?>