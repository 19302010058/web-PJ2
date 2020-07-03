<?php require_once('src/php/config-1.php'); ?>

<?php
function outputpaintings()
{
    try {
        if(isset($_GET['num'])) {
            $num = $_GET['num'];
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where  travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID limit " . "$num" . ",9";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                outputpainting($row);
            }
        }
        else{
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities,travelimagefavor where travelimage.UID =travelimagefavor.UID and travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID limit  0,9";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                outputpainting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function outputpainting($row){
    echo '<div class="div6">';
    echo '<a href="src/php/pictureDetails.php?country='.$row['Country_RegionName'].'&city='.$row['AsciiName'].'&content='.$row['Content'].'&title='.$row['Title'].'&description='.$row['Description'].'&path='.$row['PATH'].'"><img src="images/square/square-medium/'.$row['PATH'].'" alt="美景" class="img-responsive"></a>';
    echo '<div class="div3">';
    echo '<div class="div4">Title:'.$row['Title'].'</div><!--图片标题-->';
    echo '<div class="div4">Description:'.$row['Description'].'</div>';
    echo '</div>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页</title>
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/body.css" rel="stylesheet" type="text/css">
    <link href="src/css/nav.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="src/css/Home.css" />
    <script type="text/javascript" src="src/js/nav.js"></script>
    <script type="text/javascript" src="src/js/top.js"></script>
    <script src="iconfont/iconfont.js"></script>
    <script src="iconfont1/iconfont.js"></script>
    <script src="../jquery/dist/jquery-3.4.1.js" type="text/javascript"></script>
    <script src="../bootstrap-4.5.0-dist/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav >
        <div class="div1">
        <span id="spanHome">首页</span>
            <span ><a href="src/php/browsePage.php" class="a1">浏览页</a></span>
            <span><a href="src/php/searchPage.php" class="a1">搜索页</a></span>
        </div>
        <ul id="nevigation" class="ul1">
        <?php
        if(isset($_COOKIE['Username'])){
                 echo '<li  onmouseover="displaymenu(this)" onmouseout="undisplaymenu(this)">个人中心<!--鼠标移动，展示下拉菜单-->
               <ul>
                    <li value="上传" class="option1" >
                        <a href="src/php/upload.php" >
                        <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shangchuan1"></use>
                    </svg>
                            上传
                    </a></li>
                    <li value="我的收藏" class="option1">
                        <a href="src/php/myCollection.php">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-shoucang"></use>
                            </svg>
                            我的收藏</a></li>
                    <li value="我的照片" class="option1">
                        <a href="src/php/myPicture.php" >
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-picture-fill"></use>
                            </svg>
                            我的照片</a></li>
                    <li value="登录" class="option1">
                        <a href="src/php/login.php?logout=1">
                            <svg class="icon" aria-hidden="true">
                                <use xlink:href="#icon-dengchuzhanghao"></use>
                            </svg>
                            登出</a></li>
                </ul>
            </li>';} else{
            echo '<a href="src/php/login.php"><li value="登录" class="option1" id="a3" style="color: black;font-size: 25px">登录</li></a>';
        }
        ?>
        </ul>
    </nav>
</header>
<section class="nav-section" >
<img src="images/normal/medium/9498388516.jpg" class="img1">
</section>
    <div class="imgDiv">
        <?php outputpaintings();?>
    </div>
<div id="div-h-1">
    <div onClick="gotoTop();return false;" class="div-H-2">
        <svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2"><!--svg使用iconfont-->
        <use xlink:href="#icon-tubiao02" ></use>
    </svg>
    </div>
    <div class="div-H-2" >
        <?php echo '<a href="index.php?num='.mt_rand(0,20).'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2">
            <use xlink:href="#icon-shuaxin" ></use>
            </svg></a>';
            ?>
    </div>
</div>
<footer>
    <img src="images/微信二维码.jpg" id="img-H-1">
    <div class="div-H-1">web基础应用</div>
    <div class="div-H-1">备案号：19302010058</div>
    <div class="div-H-1">邮箱：2233299790@qq.com</div>
    <span>阿里妈妈MUX倾力打造的矢量图标管理、交流平台。<br>
        设计师将图标上传到Iconfont平台，用户可以自定义下载多种格式的icon，平台也可将图标转换为字体，便于前端工程师自由调整与调用。</span>
    <span>网页图标来自iconfont</span>
</footer>
<script>

</script>
</body>
</html>