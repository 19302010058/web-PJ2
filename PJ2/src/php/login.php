<?php require_once ('config-2.php');
?>
<?php
function validLogin()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "select count(*) from user where Username = '" . $_POST["username"] . "'";
    $result1 = $pdo->query($sql1);
    $row1 = $result1->fetch();
    $rowCount = $row1[0];
    if($rowCount < 1) {
        return false;
    }
        else{
    $sql = "select * from user where Username = '" . $_POST["username"] . "'";
    $result = $pdo->query($sql);
        while ($a = $result->fetch()) {
            $row = $a;
        }
        return $pass = password_verify($_POST['pword'], $row['Password']);
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(validLogin()){
        // add 1 day to the current time for expiry time
        $expiryTime = time()+60*60*24;
        setcookie("Username", $_POST['username'],$expiryTime,"/");
        $_COOKIE["Username"] = $_POST["username"];
    }
    else{
     echo '<script>alert("账号或密码错误!")</script>';

    }
}
if(isset($_COOKIE['Username'])&&$_GET['logout']==1){
    echo $_COOKIE['Username'];
    setcookie("Username","","-1","/");
}
if (isset($_COOKIE['Username'])){
    Header("Location:../../index.php");
}
?>
<! DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/Login.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <script src="../../../jquery/dist/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<section>
    <div id="div-l-2">
        <div id="div-l-1">登录</div>
    <form action="" method="post">
        <div>
            <span class="span-l-1">用户名</span>
            <input type="text" name="username">
            <span class="span-l-1">密码</span>
            <input type="password" name="pword">
        </div>
        <input type="submit" name="登录" value="登录" id="bt-l-1"></a>
        <div id="div-1-3"><a href="Log%20in.php">尚未注册？</a></div>
    </form>
    </div>
</section>
<footer>
    <img src="../../images/微信二维码.jpg" id="img-H-1">
    <div class="div-H-1">web基础应用</div>
    <div class="div-H-1">备案号：19302010058</div>
    <div class="div-H-1">邮箱：2233299790@qq.com</div>
    <span>阿里妈妈MUX倾力打造的矢量图标管理、交流平台。<br>
        设计师将图标上传到Iconfont平台，用户可以自定义下载多种格式的icon，平台也可将图标转换为字体，便于前端工程师自由调整与调用。</span>
    <span>网页图标来自iconfont</span>
</footer>
</body>
</html>