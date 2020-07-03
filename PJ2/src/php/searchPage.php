<?php require_once('config-1.php');
?>
<?php

function numPaintings()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['筛选']) && $_POST['筛选'] == '标题筛选' && isset($_POST['text-1'])) {
        $title = $_POST['text-1'];
        $sql1 = "select count(*) from travelimage where Title LIKE '%" . $title . "%'";
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
        while ($a <= $num) {
            if($a == 1){
            echo '<a href="searchPage.php?num=' . $a . '&name1=' . $title . '&page=' . $num . '&name2=title" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }else{
               echo '<a href="searchPage.php?num=' . $a . '&name1=' . $title . '&page=' . $num . '&name2=title" class="a-sh-1" ><span>' . $a . ' ' . '</span></a>';
            $a++;
            }
        }
    }
    if (isset($_POST['筛选']) && $_POST['筛选'] == '描述筛选' && isset($_POST['text-2'])) {
        $description = $_POST['text-2'];
        $sql1 = "select count(*) from travelimage where Title LIKE '%" . $description . "%'";
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
        while ($a <= $num) {
            if($a == 1){
            echo '<a href="searchPage.php?num=' . $a . '&name1=' . $description . '&page=' . $num . '&name3=description" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }else{
               echo '<a href="searchPage.php?num=' . $a . '&name1=' . $description . '&page=' . $num . '&name3=description" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }
        }
    }
    if (isset($_GET['num']) && isset($_GET['name1']) && isset($_GET['page'])&&isset($_GET['name2'])) {
        $a = 1;
        while ($a <= $_GET['page']) {
            if($a == $_GET['num']){
            echo '<a href="searchPage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2='.$_GET['name2'].'" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }else{
               echo '<a href="searchPage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2='.$_GET['name2'].'" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }
        }
    }
    if (isset($_GET['num']) && isset($_GET['name1']) && isset($_GET['page'])&&isset($_GET['name3'])) {
        $a = 1;
        while ($a <= $_GET['page']) {
            if($a == $_GET['num']){
            echo '<a href="searchPage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name3='.$_GET['name3'].'" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
            $a++;
            }else{
                echo '<a href="searchPage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name3='.$_GET['name3'].'" class="a-sh-1" ><span>' . $a . ' ' . '</span></a>';
            $a++;
            }
        }
    }
}
function searchPaintings(){
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['筛选'])&&$_POST['筛选']=='标题筛选'&& isset($_POST['text-1'])) {
            $title = $_POST['text-1'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Title LIKE '%" . $title . "%' limit 0,6";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                searchPainting($row);
            }
            }
        if (isset($_POST['筛选'])&&$_POST['筛选']=='描述筛选'&& isset($_POST['text-2'])) {
            $dp = $_POST['text-2'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Description LIKE '%" . $dp. "%' limit 0,6";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                searchPainting($row);
            }
        }
        if(isset($_GET['num'])&&isset($_GET['name1'])&&isset($_GET['name2'])&&$_GET['name2']=='title'){
            $num = ($_GET['num']-1)*6;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Title LIKE '%" . $_GET['name1']. "%' limit "."$num".",6";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                searchPainting($row);
            }
        }
        if(isset($_GET['num'])&&isset($_GET['name1'])&&isset($_GET['name3'])&&$_GET['name3']=='description'){
            $num = ($_GET['num']-1)*6;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Description LIKE '%" . $_GET['name1']. "%' limit "."$num".",6";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                searchPainting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function searchPainting($row){
    echo '<figure>';
    echo '<div class="div-s-3"><a href="pictureDetails.php?country='.$row['Country_RegionName'].'&city='.$row['AsciiName'].'&content='.$row['Content'].'&title='.$row['Title'].'&description='.$row['Description'].'&path='.$row['PATH'].'"><img src="../../images/square/square-medium/' .$row['PATH']. '" class="img-s-1"></a></div>';
    echo '<div class="div-s-2">';
    echo '<span class="span-s-1" style="font-size: larger;font-family:华文行楷,serif">Title:'.$row['Title'].'</span>';
    echo '<span class="span-s-1">'.$row['Description'].'</span>';
    echo '</div>';
    echo '</figure>';
}
function openPaintings(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID limit 0,6";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        searchPainting($row);
    }
}
?>

<! DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <link href="../css/searchPage.css" rel="stylesheet" type="text/css">
    <link href="../../../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/nav.js"></script>
    <script src="../../iconfont/iconfont.js" type="text/javascript"></script>
    <script src="../../iconfont1/iconfont.js"></script>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<header>
    <nav>
        <div class="div1">
            <span ><a href="../../index.php" class="a2">首页</a></span>
            <span><a href="browsePage.php" class="a1">浏览页</a></span>
            <span id="spanBrowsePage">搜索页</span>
        </div>
        <ul id="nevigation" class="ul1">
            <?php
            if(isset($_COOKIE['Username'])) {
                echo '<li  onmouseover="displaymenu(this)" onmouseout="undisplaymenu(this)">个人中心
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
                echo '<a href="login.php"><li value="登录" class="option1" style="color: black;font-size: 25px">登录</li></a>';
            }
            ?>
        </ul>
    </nav>
</header>
    <section class="section-s-1 nav-section">
        <div class="div-s-1">
        <p id="p-s-1">Search</p>
        <form action="" name="form1" method="post">
            <input type="radio" value="标题筛选" name = "筛选" class="radio-s-1">标题筛选<br>
            <textarea rows="1" id="textarea-s-1" name="text-1"></textarea>
            <input type="radio" value="描述筛选" name = "筛选" class="radio-s-1">描述筛选<br>
            <textarea rows="4" id="textarea-s-2" name="text-2"></textarea>
            <input type="submit" value="搜索" name="button1" id="bt-s-1">
        </form>
        </div>
    </section>
<section>
    <?php
    if(isset($_POST['筛选'])||isset($_GET['num'])) {
        searchPaintings();
    }else{
        openPaintings();
    }
    ?>
    </section>
<div class="ft-s-1">
      <?php
      if(isset($_POST['筛选'])||isset($_GET['num'])) {
          if (isset($_GET['name2'])) {
              echo '<a href="searchPage.php?num=1&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2=' . $_GET['name2'] . '"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-diyiye"></use></svg></a>';
              if ($_GET['num'] == 1) {
                  echo '<a href="searchPage.php?num=1&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2=' . $_GET['name2'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
              } else {
                  $num = $_GET['num'] - 1;
                  echo '<a href="searchPage.php?num=' . $num . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2=' . $_GET['name2'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
              }
          }
          if (isset($_GET['name3'])) {
              echo '<a href="searchPage.php?num=1&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name3=' . $_GET['name3'] . '"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-diyiye"></use></svg></a>';
              if ($_GET['num'] == 1) {
                  echo '<a href="searchPage.php?num=1&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name3=' . $_GET['name3'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
              } else {
                  $num = $_GET['num'] - 1;
                  echo '<a href="searchPage.php?num=' . $num . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name3=' . $_GET['name3'] . '"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
              }
          }
          numPaintings();
          if (isset($_GET['name2'])) {
              if($_GET['num']==$_GET['page']){
              echo '<a href="searchPage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2='.$_GET['name2'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
        }else{
                  $num = $_GET['num']+1;
                  echo '<a href="searchPage.php?num='.$num.'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2='.$_GET['name2'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
        }
              echo '<a href="searchPage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2='.$_GET['name2'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-zuihouyiye"></use></svg></a>';
          }
          if (isset($_GET['name3'])) {
              if($_GET['num']==$_GET['page']){
                  echo '<a href="searchPage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name3='.$_GET['name3'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
              }else{
                  $num = $_GET['num']+1;
                  echo '<a href="searchPage.php?num='.$num.'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name3='.$_GET['name3'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
              }
              echo '<a href="searchPage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name3='.$_GET['name3'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-zuihouyiye"></use></svg></a>';
          }
          }
        ?>
    </div>
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
<script>
 $("#textarea-s-1").dblclick(function () {
window.location.href="searchPage.php";
 })
 $("#textarea-s-2").dblclick(function () {
     window.location.href="searchPage.php";
 })
</script>
</html>