<?php require_once('config-1.php'); ?>
<?php
function painting($row){
    echo '<div class="div-bp-5"><figure><a href="pictureDetails.php?country='.$row['Country_RegionName'].'&city='.$row['AsciiName'].'&content='.$row['Content'].'&title='.$row['Title'].'&description='.$row['Description'].'&path='.$row['PATH'].'"><img src="../../images/normal/small/'.$row['PATH'].'"></a></figure></div>';
}
function titlePaintings()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['titleFiler'])) {
            $title = $_POST['titleFiler'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and  travelimage.Title LIKE '%".$title."%' limit 0,12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                Painting($row);
            }
        }
        if(isset($_GET['name2'])&&$_GET['name2'] == 'title'){
            $title = $_GET['name1'];
            $num = ($_GET['num']-1)*12;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Title LIKE '%".$title."%' limit "."$num".",12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                Painting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function popularPaintings()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['name2'])&&$_GET['name2'] =='content') {
            $description = $_GET['name1'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Description LIKE '%".$description."%' limit  0,12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        if(isset($_GET['name4'])&&$_GET['name4'] =='description') {
            $description = $_GET['name3'];
            $num = ($_GET['num']-1)*12;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Description LIKE '%".$description."%' limit  "."$num".",12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function countryPaintings()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['name2'])&&$_GET['name2']=='country') {
            $country = $_GET['name1'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where  travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and  travelimage.Country_RegionCodeISO = '".$country."' limit 0,12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        if(isset($_GET['name4'])&&$_GET['name4']=='country') {
            $country = $_GET['name3'];
            $num = ($_GET['num']-1)*12;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Country_RegionCodeISO = '".$country."' limit "."$num".",12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function cityPaintings()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['name2'])&&$_GET['name2']=='city') {
            $city = $_GET['name1'];
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where  travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Country_RegionCodeISO='".$city."'limit  0,12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        if(isset($_GET['name4'])&&$_GET['name4']=='city') {
            $city = $_GET['name3'];
            $num = ($_GET['num']-1)*12;
            $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and travelimage.Country_RegionCodeISO='".$city."'limit  "."$num".",12";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {
                painting($row);
            }
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function openPaintings(){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID  limit 0,12";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        painting($row);
    }
}
function numPaintings()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['titleFiler'])) {
        $title = $_POST['titleFiler'];
        $sql1 = "select count(*) from travelimage where Title LIKE '%" . $title . "%'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if ($rowCount % 12 == 0) {
            $num = $rowCount / 12;
        } else {
            $num = floor($rowCount / 12) + 1;
            if ($num >= 5) {
                $num = 5;
            }
        }
        $a = 1;
        while ($a <= $num) {
            if ($a == 1) {
                echo '<a href="browsePage.php?num=' . $a . '&name1=' . $title . '&page=' . $num . '&name2=title" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name1=' . $title . '&page=' . $num . '&name2=title" class="a-sh-1" ><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name2'])&&$_GET['name2']=='title') {
        $a = 1;
        while ($a <= $_GET['page']) {
            if ($a == $_GET['num']) {
                echo '<a href="browsePage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2=title" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name1=' . $_GET['name1'] . '&page=' . $_GET['page'] . '&name2=title" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name2']) && $_GET['name2'] == 'content') {
        $description = $_GET['name1'];
        $sql1 = "select count(*) from travelimage where Description LIKE '%" . $description . "%'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if ($rowCount % 12 == 0) {
            $num = $rowCount / 12;
        } else {
            $num = floor($rowCount / 12) + 1;
            if ($num >= 5) {
                $num = 5;
            }
        }
        $a = 1;
        while ($a <= $num) {
            if ($a == 1) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $description . '&page=' . $num . '&name4=description" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $description . '&page=' . $num . '&name4=description" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name4'])&&$_GET['name4']=='description') {
        $a = 1;
        while ($a <= $_GET['page']) {
            if ($a == $_GET['num']) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4=description" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4=description" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name2']) && $_GET['name2'] == 'country') {
        $country = $_GET['name1'];
        $sql1 = "select count(*) from travelimage where  Country_RegionCodeISO=  '" . $country . "'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if ($rowCount % 12 == 0) {
            $num = $rowCount / 12;
        } else {
            $num = floor($rowCount / 12) + 1;
            if ($num >= 5) {
                $num = 5;
            }
        }
        $a = 1;
        while ($a <= $num) {
            if ($a == 1) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $country . '&page=' . $num . '&name4=country" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $country . '&page=' . $num . '&name4=country" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name4'])&&$_GET['name4']=='country') {
        $a = 1;
        while ($a <= $_GET['page']) {
            if ($a == $_GET['num']) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4=country" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4=country" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name2']) && $_GET['name2'] == 'city') {
        $city = $_GET['name1'];
        $sql1 = "select count(*) from travelimage where  Country_RegionCodeISO=  '" . $city . "'";
        $result1 = $pdo->query($sql1);
        $row1 = $result1->fetch();
        $rowCount = $row1[0];
        if ($rowCount % 12 == 0) {
            $num = $rowCount / 12;
        } else {
            $num = floor($rowCount / 12) + 1;
            if ($num >= 5) {
                $num = 5;
            }
        }
        $a = 1;
        while ($a <= $num) {
            if ($a == 1) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $city . '&page=' . $num . '&name4=city" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $city . '&page=' . $num . '&name4=city" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
    if (isset($_GET['name4'])&&$_GET['name4']=='city') {
        $a = 1;
        while ($a <= $_GET['page']) {
            if ($a == $_GET['num']) {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4='.$_GET['name4'].'" class="a-sh-1" style="color: #4e555b"><span>' . $a . ' ' . '</span></a>';
                $a++;
            } else {
                echo '<a href="browsePage.php?num=' . $a . '&name3=' . $_GET['name3'] . '&page=' . $_GET['page'] . '&name4='.$_GET['name4'].'" class="a-sh-1"><span>' . $a . ' ' . '</span></a>';
                $a++;
            }
        }
    }
}
function linkage()
{
    if (isset($_POST['name1']) && isset($_POST['name2']) && isset($_POST['name3'])) {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select travelimage.Title,travelimage.Description,travelimage.UID,travelimage.content,travelimage.PATH,
travelimage.Content,geocountries_regions.Country_RegionName,geocountries_regions.Population,geocities.AsciiName from travelimage,geocountries_regions,geocities where travelimage.Country_RegionCodeISO = geocountries_regions.ISO and travelimage.CityCode = geocities.GeoNameID and geocities.AsciiName='".$_POST['name3']."' limit 0,12";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            painting($row);
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>浏览</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <link href="../../../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/browsePage.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/nav.js"></script>
    <script src="../../iconfont/iconfont.js"></script>
    <script src="../../iconfont1/iconfont.js"></script>
    <script src="../../../jquery/dist/jquery-3.4.1.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav>
        <div class="div1">
            <span ><a href="../../index.php" class="a2">首页</a></span>
            <span id="spanBrowsePage">浏览页</span>
            <span><a href="searchPage.php" class="a1">搜索页</a></span>
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
<aside class="nav-section">
    <form id="form1" method="post" action="">
        <div id="div-bp-1">
            <span id="span-bp-1">标题浏览</span>
            <input type="text" name ="titleFiler" id="text-1">
           <svg class="icon" aria-hidden="true" style="font-size: 20px;color: #2aabd2" onclick="check()">
           <use xlink:href="#icon-sousuo1"></use>
           </svg>
        </div>
    </form>
        <div class="div-bp-1">
             <span class="span-bp-1">热门国家快速浏览</span>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=CA&name2=country">Canada</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=GB&name2=country">United Kingdom</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=DE&name2=country">Germany</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=ES&name2=country">Spain</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=GR&name2=country">Greece</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=IT&name2=country">Italy</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=HU&name2=country">Hungary</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=GH&name2=country">Ghana</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=US&name2=country">United States</a></span>'?>
        </div>
        <div class="div-bp-1">
             <span class="span-bp-1">热门城市快速浏览</span>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=HU&name2=city">Budapest</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=ES&name2=city">Madrid</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=GB&name2=city">London</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=US&name2=city">Washington</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=IT&name2=city">Rome</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=GH&name2=city">Accra</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=DE&name2=city">Berlin</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=BS&name2=city">Nassau</a></span>'?>
             <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=CA&name2=city">Ottawa</a></span>'?>
        </div>
    <div class="div-bp-1">
        <span class="span-bp-1">热门内容快速浏览</span>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Park&name2=content">Park</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Florence&name2=content">Florence</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Tower&name2=content">Tower</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Venice&name2=content">Venice</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Church&name2=content">Church</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Coast&name2=content">Coast</a></span>'?>
        <?php echo '<span class="span-bp-2"><a href="browsePage.php?name1=Mountain&name2=content">Mountain</a></span>'?>
    </div>
</aside>
<section class="nav-section">
    <div id="div-bp-2">
        <div id="div-bp-3">
        <form method="post" action="" id="form-bp-1">
            <select id="theme" name="name1">
                <option class="option">请选择主题</option>
                <option class="option">Scenery</option>
            </select>
            <select id="city" name="name2">
                <option class="option">请选择国家</option>
            </select>
            <select id="area" name="name3">
                <option class="option">请选择地区</option>
            </select>
            <svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" onclick="check1();">
                <use xlink:href="#icon-filter"></use>
            </svg>
        </form>
        </div>
        <figure><a href="pictureDetails.php"><img src="../../images/normal/small/5856658791.jpg" class="img-bp-2" id="img-bp-1"></a></figure>
        <figure><a href="pictureDetails.php"><img src="../../images/normal/small/222222.jpg" class="img-bp-2" id="img-bp-2"></a></figure>
    </div>
    <div class="div-bp-3">
        <?php
        if(isset($_POST['name1']) && isset($_POST['name2']) && isset($_POST['name3'])){
            linkage();
        }elseif(isset($_POST['titleFiler'])||(isset($_GET['name2'])&&$_GET['name2']=='title')) {
            titlePaintings();
        }
        elseif((isset($_GET['name1'])&&$_GET['name2']=='content')||(isset($_GET['name4'])&&$_GET['name4']=='description')) {
            popularPaintings();
        }
        elseif((isset($_GET['name1'])&&$_GET['name2']=='country')||(isset($_GET['name4'])&&$_GET['name4']=='country')){
        countryPaintings();
        }
        elseif((isset($_GET['name1'])&&$_GET['name2']=='city')||(isset($_GET['name4'])&&$_GET['name4']=='city')) {
            cityPaintings();
        }else{
            openPaintings();
        }
        ?>
    </div>
</section>
<section>
    <div id="div-bp-4">
        <?php
        if(isset($_GET['name2'])&&$_GET['name2']=='title') {
            echo '<a href="browsePage.php?num=1&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-diyiye"></use></svg></a>';
        if($_GET['num']==1){
        echo '<a href="browsePage.php?num=1&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
        }else{
            $num = $_GET['num']-1;
            echo '<a href="browsePage.php?num='.$num.'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
        }
        }
        if(isset($_GET['name4'])){
            echo '<a href="browsePage.php?num=1&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-diyiye"></use></svg></a>';
            if($_GET['num']==1){
                echo '<a href="browsePage.php?num=1&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
            }else{
                $num = $_GET['num']-1;
                echo '<a href="browsePage.php?num='.$num.'&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-prev"></use></svg></a>';
            }
        }
            numPaintings();
        if(isset($_GET['name2'])&&$_GET['name2']=='title') {
            if($_GET['num']==$_GET['page']){
            echo '<a href="browsePage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
            }else{
                $num = $_GET['num']+1;
                    echo '<a href="browsePage.php?num='.$num.'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
            }
        echo '<a href="browsePage.php?num='.$_GET['page'].'&name1='.$_GET['name1'].'&page='.$_GET['page'].'&name2=title"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-zuihouyiye"></use></svg></a>';
        }
        if(isset($_GET['name4'])){
            if($_GET['num']==$_GET['page']){
            echo '<a href="browsePage.php?num='.$_GET['page'].'&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
            }else{
                $num = $_GET['num']+1;
                    echo '<a href="browsePage.php?num='.$num.'&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 30px;color: #2aabd2" ><use xlink:href="#icon-xiayiye1"></use></svg></a>';
            }
        echo '<a href="browsePage.php?num='.$_GET['page'].'&name3='.$_GET['name3'].'&page='.$_GET['page'].'&name4='.$_GET['name4'].'"><svg class="icon" aria-hidden="true" style="font-size: 40px;color: #2aabd2" ><use xlink:href="#icon-zuihouyiye"></use></svg></a>';
        }
        ?>
    </div>
    <footer id="footer">
        <img src="../../images/微信二维码.jpg" id="img-H-1">
        <div >web基础应用</div>
        <div >备案号：19302010058</div>
        <div>邮箱：2233299790@qq.com</div>
        <span>阿里妈妈MUX倾力打造的矢量图标管理、交流平台。<br>
        设计师将图标上传到Iconfont平台，用户可以自定义下载多种格式的icon，平台也可将图标转换为字体，便于前端工程师自由调整与调用。</span>
        <span>网页图标来自iconfont</span>
    </footer>
</section>
</body>
<script>
    var arr_city = ["Canada", "United Kindom","Germany","Italy","Greece","United States","Spain","Hungary","Ghana","Bahamas"];
    var arr_area = [
        ["Calgary","Lunenburg","banff"],
        ["London", "Battle", "Lewes","Oxford"],
        ["Berlin","Koeln","Darmstadt","Frankfurt am Main"],
        ["Roman","Firenze","Milano","Verona","Padova","Venezia","Montepulciano","Pisa","Lucca"],
        ["Athens","Fira"],
        ["New York City","Orlando"],
        ["Madrid"],
        ["Budapest"],
        ["Cape Coast","Accra"],
        ["Nassau"]
    ];
    //var arr_city = $str1;
    //var arr_area = $str2;
    var city = document.getElementById("city");
    var area = document.getElementById("area");
    // 填入省选项的内容
    for(var i = 0; i < arr_city.length; i++) {
        city.options.add(new Option(arr_city[i]));
    }
    city.onchange = function getArea() {
        // 每次选择省先清空区
        area.options.length = 1;
        // 获取所选省的索引
        var cityIndex = this.selectedIndex - 1;
        // 如果所选省的索引不是0（默认选项），则填入对应区的内容
        if(cityIndex > -1) {
            for(var i = 0; i < arr_area[cityIndex].length; i++) {
                area.options.add(new Option(arr_area[cityIndex][i]));
            }
        }
    }
    function check() {
        window.location.href='browsePage.php';
     document.getElementById("form1").submit();
    }
    $("#text-1").dblclick(function () {
      window.location.href='browsePage.php';
    })
    function check1() {
        $("#form-bp-1").submit();
    }
</script>
</html>