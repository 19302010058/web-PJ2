<?php
require_once ('config-2.php');
?>
<?php
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['text1'])&&isset($_POST['text2'])&&isset($_POST['password1'])){
        $sql1 = "select count(*) from user where Username = '" . $_POST["text1"] . "'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if($rowCount < 1) {
            $username = $_POST['text1'];
            $password = $_POST['password1'];
            $email = $_POST['text2'];
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO user(Username,Password,email) VALUE ('$username', '$pass', '$email')";
            $result = $pdo->exec($sql);
            if ($result) {
                Header("Location:../../index.php");
            }
        }else{
            echo '<script>alert("此用户名已存在，请重新输入！")</script>';
        }
}
?>
<! DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
    <link rel="stylesheet" href="../css/reset.css" type="text/css">
    <link rel="stylesheet" href="../css/body.css" type="text/css">
    <link rel="stylesheet" href="../css/Log%20in.css" type="text/css">
    <link rel="stylesheet" href="../css/nav.css" type="text/css">
</head>
<body >
<section>
    <div id="div-L-2">
<div id="div-L-1">注册</div>
    <form action="" name="form1" method="post" id="form-log-1" onsubmit="return checkForm()">
        <div >
        <span class="span-L-1">用户名</span>
        <input type="text" name="text1" id="text1">
        <span class="span-L-1" >邮箱</span>
        <input type="text" name="text2" id="email">
        <span class="span-L-1">密码</span>
        <input type="password" name="password1" id="password1">
        <span class="span-L-1">确认密码</span>
        <input type="password" name="password2" id="password2">
            <input type="submit" name="注册" value="注册" id="bt-L-1">
        </div>
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
    <script type="text/javascript">
        function checkForm(){
            var name = document.getElementById("text1").value;
            var email = document.getElementById("email").value;
            var pword1 = document.getElementById("password1").value;
            var pword2 = document.getElementById("password2").value;
            var reg1 = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            var reg2 = /^(?![0-9]+$)(?![a-z]+$)(?![A-Z]+$)(?!([^(0-9a-zA-Z)])+$).{6,20}$/;
            var form = true;
            if(name === ""){
                alert('用户名不能为空！');
                form = false;
            }
            if(!reg1.test(email)){
                alert("邮箱格式不符，请重新输入！");
                form = false;
            }
            if(!reg2.test(pword1)){
                alert("弱密码，请重新输入");
                form = false;
            }
            if((pword1 !== pword2)||pword2==""){
                alert("两次输入的密码不同，请重新输入！");
                form = false
            }
              return form;
            }
</script>
</html>