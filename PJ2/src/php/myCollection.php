<?php require_once ('config-1.php')?>

<?php
    function collectionPaintings()
    {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql1 = "select * from mycollection";
        $sql2 = "select count(*) from mycollection";
        $result1 = $pdo->query($sql2);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if ($rowCount >= 1) {
            $result = $pdo->query($sql1);
            while ($row = $result->fetch()) {
                painting($row);
            }
        } else {
            echo '<script> alert("您还没有收藏图片，赶快选择自己喜欢的图片收藏吧！");</script>';
        }
    }
    function painting($row){
        echo '
       <figure>
        <div class="div-mc-3"><a href="pictureDetails.php?title='.$row['title'].'&description='.$row['description'].'&country='.$row['country'].'&city='.$row['city'].'&path='.$row['path'].'&content='.$row['content'].'"><img src="../../images/square/square-medium/'.$row["path"].'" class="img-mc-1"></a></div>
        <div class="div-mc-2">
        <span class="span-mc-1" style="font-size: larger;font-family:华文行楷,serif">title:'.$row['title'].'</span>
        <span class="span-mc-1">content:'.$row['content'].'</span>
        <span class="span-mc-1">country:'.$row['country'].'</span>
        <span class="span-mc-1">city:'.$row['city'].'</span>
        <span class="span-mc-1">description:'.$row['description'].'</span>
        </div>
        <a href="ddCollection.php?path='.$row['path'].'"><svg class="icon svg" aria-hidden="true" style="font-size: 30px;color: #2aabd2">
            <use xlink:href="#icon-quxiao" ></use>
        </svg></a>
        </figure>';
    }
function numPaintings()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "select count(*) from mycollection";
    $result1 = $pdo->query($sql1);
    $row1 = $result1->fetch();
    $rowCount = $row1[0];
    if ($rowCount % 6 == 0) {
        $num = $rowCount / 6;
    } else {
        $num = floor($rowCount / 6) + 1;
        if ($num >= 5) {
            $num = 5;
        }
    }
    $a = 1;
    if(!isset($_GET['num'])) {
        while ($a <= $num) {
            if ($a == 1) {
                echo '<a href="mycollection.php?num=' . $a . '&page=' . $num . '"style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="mycollection.php?num=' . $a . '&page=' . $num . '" ><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['num'])) {
        $a = 1;
        while ($a <= $_GET['page']) {
            if($a == $_GET['num']){
                echo '<a href="mycollection.php?num=' . $a . '&page=' . $_GET['page'] . '" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }else{
                echo '<a href="mycollection.php?num=' . $a . '&page=' . $_GET['page'] . '" ><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
}
?>

<! DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的收藏</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <link href="../css/myCollection.css" rel="stylesheet" type="text/css">
    <link href="../../../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/nav.js"></script>
    <script src="../../iconfont/iconfont.js"></script>
    <script src="../../iconfont1/iconfont.js"></script>
</head>
<body>
<header>
    <nav>
        <div class="div1">
            <span ><a href="../../index.php" id="mc-Home1" style="color: black">首页</a></span>
            <span ><a href="browsePage.php" class="a1">浏览页</a></span>
            <span><a href="searchPage.php" class="a1">搜索页</a></span>
        </div>
        <ul id="nevigation" class="ul1">
            <?php
            if(isset($_COOKIE['Username'])) {
                echo '<li  onmouseover = "displaymenu(this)" onmouseout = "undisplaymenu(this)" > 个人中心
                <ul >
                    <li value = "上传" class="option1" ><a href = "upload.php" >
                        <svg class="icon" aria-hidden = "true" >
                            <use xlink:href = "#icon-shangchuan1" ></use>
                        </svg >
                上传</a ></li >
                    <li value = "我的收藏" class="option1" ><a href = "myCollection.php" >
                        <svg class="icon" aria-hidden = "true" >
                            <use xlink:href = "#icon-shoucang" ></use>
                        </svg >
                我的收藏</a ></li >
                    <li value = "我的照片" class="option1" ><a href = "myPicture.php" >
                        <svg class="icon" aria-hidden = "true" >
                            <use xlink:href = "#icon-picture-fill" ></use>
                        </svg >
                我的照片</a ></li >
                    <li value = "登录" class="option1" ><a href = "login.php?logout=1" >
                        <svg class="icon" aria-hidden = "true" >
                            <use xlink:href = "#icon-dengchuzhanghao" ></use>
                        </svg >
                登出</a ></li >
                </ul >
            </li >';
            }else{
                echo '<a href="login.php"><li value="登录" class="option1">登录</li></a>';
            }
            ?>
        </ul>
    </nav>
</header>
<section class="nav-section">
<p id="p-mc-1">我的收藏</p>
<section>
        <?php collectionPaintings();
        ?>
</section>
    <div id="div-mc-1">
        <?php
        if(isset($_GET['num'])) {
            echo '<a href="myCollection.php?num=1&page=' . $_GET['page'] . '"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2"><use xlink:href="#icon-diyiye"></use></svg></a>';
            if ($_GET['num'] == 1) {
                echo '<a href="myCollection.php?num=1&page=' . $_GET['page'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2"><use xlink:href="#icon-prev"></use></svg></a>';
            }else{
                $num = $_GET['num']-1;
                echo '<a href="myCollection.php?num='.$num.'&page=' . $_GET['page'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2"><use xlink:href="#icon-prev"></use></svg></a>';
            }
        }
    numPaintings();
        if(isset($_GET['num'])) {
            if($_GET['num']==$_GET['page']){
            echo '<a href="myCollection.php?num='.$_GET['page'].'&page='.$_GET['page'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2"><use xlink:href="#icon-xiayiye"></use></svg></a>';
    }else{
                $num = $_GET['num']+1;
                echo '<a href="myCollection.php?num='.$num.'&page='.$_GET['page'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2"><use xlink:href="#icon-xiayiye"></use></svg></a>';
            }
    echo '<a href="myCollection.php?num='.$_GET['page'].'&page='.$_GET['page'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2"><use xlink:href="#icon-zuihouyiye"></use>
    </svg></a>';
        }
        ?>
        </div>
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
</body>
</html>