<?php
require_once ('config-1.php');
if(isset($_POST['text1'])) {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "update mypicture set Country='" . $_POST['name1'] . "', city='" . $_POST['name2'] . "', theme='" . $_POST['name3'] . "' ,title='" . $_POST['text1'] . "' , description='" . $_POST['text2'] . "' where path='" . $_POST['text4'] . "'";
    $result = $pdo->query($sql);
}
Header("Refresh:2;url=myPicture.php");

?>