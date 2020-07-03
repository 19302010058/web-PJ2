<?php require_once ('config-1.php')?>

<?php
function detailPainting()
{
    if (isset($_GET['country']) && isset($_GET['city']) && isset($_GET['title']) && isset($_GET['content']) && isset($_GET['description'])&&isset($_GET['path'])) {
        echo '<section id="section-pd-1">';
    echo '<div id="div-pd-2" style="font-size: larger;font-family:华文行楷,serif">'.$_GET['title'].'</div>';
    echo '<div>';
    echo '<div id="div-pd-1">';
        echo '<img src="../../images/normal/medium/'.$_GET['path'].'" id="img-pd-1">';
    echo '</div>';
    echo '<div id="div-pd-4">';
        echo '<div class="div-pd-3">';
        echo '<span class="span-pd-1">拍摄者</span>';
        echo '<span>asdfghjkl</span>';
        echo '</div>';
        echo '<div class="div-pd-3">';
        echo '<span class="span-pd-1">描述</span>';
        echo '<span>'.$_GET['description'].'</span>';
        echo '</div>';
        echo '<div class="div-pd-3">';
        echo '<span class="span-pd-1">内容</span>';
        echo '<span>'.$_GET['content'].'</span>';
        echo '</div>';
        echo '<div class="div-pd-3">';
        echo '<span class="span-pd-1">拍摄国家</span>';
        echo '<span>'.$_GET['country'].'</span>';
        echo '</div>';
        echo '<div class="div-pd-3">';
        echo '<span class="span-pd-1">拍摄城市</span>';
        echo '<span>'.$_GET['city'].'</span>';
        echo '</div>';
        echo '</div>';
    echo '<div id="div-pd-5">';
        echo '<a href="pictureDetails.php?description1='.$_GET["description"].'&content1='.$_GET["content"].'&country1='.$_GET["country"].'&city1='.$_GET["city"].'&path1='.$_GET["path"].'&title1='.$_GET['title'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" id="pt-1">';
            echo '<use xlink:href="#icon-shoucang1" ></use>';
        echo '</svg></a>';
    echo '</div>';
    echo '</div>';
    }
}
if(isset($_GET['path1'])) {
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql1 = "select count(*) from mycollection where path = '".$_GET['path1']."'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if($rowCount >= 1){
            $path = $_GET['path1'];
            $description = $_GET['description1'];
            $country = $_GET['country1'];
            $city = $_GET['city1'];
            $content = $_GET['content1'];
            $title = $_GET['title1'];
            $sql = "delete from mycollection where path='".$path."'";
            $pdo->query($sql);
            Header("Location:mycollection.php");
        }else{
            $path = $_GET['path1'];
            $description = $_GET['description1'];
            $country = $_GET['country1'];
            $city = $_GET['city1'];
            $content = $_GET['content1'];
            $title = $_GET['title1'];
            $sql = "insert into mycollection(path,description,country,city,content,title) values ('$path','$description','$country','$city','$content','$title')";
            $pdo->query($sql);
            Header("Location:mycollection.php");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>
<! DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图片详情</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <link href="../css/pictureDetails.css" rel="stylesheet" type="text/css">
    <link href="../../../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/nav.js"></script>
    <script src="../../iconfont/iconfont.js"></script>
    <script src="../../iconfont1/iconfont.js"></script>
    <script src="../../../jquery/dist/jquery-3.4.1.js"></script>
</head>
<body>
<header>
    <nav>
        <div class="div1">
            <span ><a href="../../index.php" id="pd-Home1" style="color: black">首页</a></span>
            <span ><a href="browsePage.php" class="a1">浏览页</a></span>
            <span><a href="searchPage.php" class="a1">搜索页</a></span>
        </div>
        <ul id="nevigation" class="ul1">
            <?php
            if(isset($_COOKIE['Username'])){
            echo '<li onmouseover="displaymenu(this)" onmouseout="undisplaymenu(this)">个人中心
                <ul>
                    <li value="上传" class="option1"><a href="upload.php" >
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-shangchuan1"></use>
                        </svg>
                        上传</a></li>
                    <li value="我的收藏" class="option1"><a href="myCollection.php">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-shoucang"></use>
                        </svg>
                        我的收藏</a></li>
                    <li value="我的照片" class="option1"><a href="myPicture.php" >
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-picture-fill"></use>
                        </svg>
                        我的照片</a></li>
                    <li value="登录" class="option1"><a href="login.php?logout=1">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-dengchuzhanghao"></use>
                        </svg>
                        登出</a></li>
                </ul>
            </li>';
            }else{
                 echo '<a href="login.php"><li value="登录" class="option1">登录</li></a>';
            }
//            ?>
        </ul>
    </nav>
</header>
<section>
<p id="p-pd-1">Details</p>
<section id="section-pd-1">
    <?php detailPainting(); ?>
    </section>
    <footer>
        <img src="../../images/微信二维码.jpg" id="img-H-1">
        <div class="div-H-1">web基础应用</div>
        <div class="div-H-1">备案号：19302010058</div>
        <div class="div-H-1">邮箱：2233299790@qq.com</div>
        <span >阿里妈妈MUX倾力打造的矢量图标管理、交流平台。<br>
        设计师将图标上传到Iconfont平台，用户可以自定义下载多种格式的icon，平台也可将图标转换为字体，便于前端工程师自由调整与调用。</span>
        <span >网页图标来自iconfont</span>
    </footer>
</section>
</body>
</html>