<?php require_once ('config-1.php')  ?>
<?php
if(isset($_GET['path'])){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from mypicture where path='".$_GET["path"]."'";
    $pdo->query($sql);
    unlink('../../images/myPicture/' . $_GET['path']);
}
Header("Refresh:2;url=myPicture.php");
?>
