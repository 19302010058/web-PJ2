<?php require_once ('config-1.php')  ?>
<?php
if(isset($_GET['path'])){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from mycollection where path='".$_GET["path"]."'";
    $pdo->query($sql);
}
Header("Refresh:2;url=myCollection.php");
?>