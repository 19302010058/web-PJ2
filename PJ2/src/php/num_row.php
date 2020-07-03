<?php require_once ('config-1.php')?>

<?php
//PHP上传本地图片至服务器
    if(isset($_FILES['imgOne']['name'])) {
        if ($_FILES['imgOne']['error'] > 0) {
            echo "上传图片失败";
        } else if ($_FILES['imgOne']['error'] == 0) {
            //如果使用时间戳重命名文件，其实没有必要判断该文件是否存在
            if (file_exists('../../images/myPicture/' . $_FILES['imgOne']['name'])) {
                echo "该图片已经存在";
            } else {
                //使用时间戳重命名图片，并且获取其后缀名
                //$pic = time().preg_replace("/^[^.]*/","",$_FILES['imgOne']['name']);
                //保存图片至服务器fruitUpload文件夹
                $result = move_uploaded_file($_FILES['imgOne']['tmp_name'], "../../images/myPicture/" . $_FILES['imgOne']['name']);
                if (!$result) {
                    echo "上传图片失败";
                } else {
                    //将该图片的名称$pic保存至数据库
                    echo "上传图片成功";
                    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $title = $_POST['text1'];
                    $description = $_POST['text2'];
                    $country = $_POST['name1'];
                    $city = $_POST['name2'];
                    $theme = $_POST['name3'];
                    $name = $_FILES['imgOne']['name'];
                    $sql = "insert into mypicture(path,title,description,Country,city,theme) values ('$name','$title','$description','$country','$city','$theme')";
                    $pdo->query($sql);
                }
            }
        }
    }
    Header("Location:myPicture.php");
?>