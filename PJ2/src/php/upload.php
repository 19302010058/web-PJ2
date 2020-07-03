<?php require_once ('config-1.php')?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传</title>
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/body.css" rel="stylesheet" type="text/css">
    <link href="../css/nav.css" rel="stylesheet" type="text/css">
    <link href="../css/upload.css" rel="stylesheet" type="text/css">
    <link href="../../../bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/nav.js"></script>
    <script type="text/javascript" src="../js/upload.js"></script>
    <script src="../../iconfont/iconfont.js" type="text/javascript"></script>
    <script src="../../iconfont1/iconfont.js" type="text/javascript"></script>
    <script src="../../../jquery/dist/jquery-3.4.1.js" type="text/javascript"></script>
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
            ?>
        </ul>
    </nav>
</header>
<section class="nav-section" id="section-up-3">
<section id="section-up-1">
    <div id="div-up-1">
        上传
    </div>
    <?php
    if(isset($_GET['path'])) {
        echo '<div>';
        echo '<img id="imgPre" src="../../images/myPicture/'.$_GET['path'].'">';
        echo '</div>';
    }else{
        echo '<div>';
        echo '<img id="imgPre">';
        echo '</div>';
    }
    ?>
</section>
<section id="section-up-2">
    <?php if(isset($_GET['path'])) {
        echo '<form method = "post" action = "modify.php" id = "form-up-1" enctype = "multipart/form-data" >';
    }else{
        echo '<form method = "post" action = "num_row.php" id = "form-up-1" enctype = "multipart/form-data" >';
    }
    ?>
        <a href="javascript:" class="file" id="a-up-1">upload
            <input type="file" name="imgOne" id="imgOne" value="upload" onchange="preImg(this.id,'imgPre');"><!--用div套住覆盖，改变样式-->
        </a>
        <div class="div-up-1">
            图片标题
        </div>
        <input type="text" class="div-up-1" name="text1" id="text-up-1">
        <div class="div-up-1">
            拍摄国家、城市、主题
        </div>
            <select id="city" name="name1">
                <option class="option">请选择国家</option>
            </select>
            <select id="area" name="name2">
                <option class="option" >请选择地区</option>
            </select>
    <select id="select-up-1" name="name3">
        <option class="option" >请选择主题</option>
        <option value="Scenery">Scenery</option>
        <option value="City">City</option>
        <option value="People">People</option>
        <option value="Animal">Animal</option>
        <option value="Building">Building</option>
        <option value="Wonder">Wonder</option>
        <option value="Other">Other</option>
    </select>
        <div class="div-up-1">
            图片描述
        </div>
        <textarea style="width: 100%" rows="5" class="div-up-1" id="textarea-up-1" name="text2"></textarea>
    <input type="hidden" id="hidden-1" name="text4">
        <!--<input type="submit" name="提交" value="提交" id="submit-up-1" onsubmit="return checkForm();">-->
    </form>
    <?php
    if(!isset($_GET['path'])) {
        echo '<input type="button" name="提交" value="提交" id="submit-up-1" onclick="checkForm();">';
    }else{
        echo '<input type="button" name="提交" value="修改" id="submit-up-1" onclick="checkForm()">';
    }
    ?>
</section>
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
<script type="text/javascript">
    var arr_city = ["China","Canada", "United Kindom","Germany","Italy","Greece","United States","Spain","Hungary","Ghana","Bahamas"];
    var arr_area = [
        ["Beijing","Shanghai","zhejiang","yunnan"],
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
    function checkForm() {
        $a = true;
      if($('#text-up-1').val()==""){
          alert('请输入图片标题！');
          $a = false;
      }
      if($('#textarea-up-1').val()==""){
          alert('请输入图片描述！');
          $a = false;
      }
      if($('#city').val()=="请选择国家"){
          alert('请选择国家！')
          $a = false;
    }
    if($('#area').val()=="请选择地区"){
        alert('请选择地区！')
        $a = false;
    }
    if($('#select-up-1').val()=="请选择主题"){
            alert('请选择主题！')
        $a = false;
        }
        if($a){
            $('#form-up-1').submit();
    }
    }

</script>
<?php
if(isset($_GET['path'])) {
    $arr = array('path' => $_GET['path'], 'title' => $_GET['title'], 'theme' => $_GET['theme'], 'country' => $_GET['country'], 'city' => $_GET['city'], 'description' => $_GET['description']);
    $str = json_encode($arr);
    echo "<script type='text/javascript'>var md = $str;
      $('#text-up-1').val(md['title']);
      $('#textarea-up-1').val(md['description']);
      $('#city').val(md['country']);
      $('#area').val(md['city']);
      $('#select-up-1').val(md['theme']);
      $('#hidden-1').val(md['path']);
</script>";
}
?>
</html>