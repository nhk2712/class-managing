<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();
$classId = $_SESSION['classId'];
$list= $_POST['list'];

mysqli_set_charset($db,"utf8");

$cmd="UPDATE classes SET classList='$list' WHERE classId='$classId'";
$query=mysqli_query($db,$cmd);

$db->close();
echo 'Updated class successfully!';

echo '<script>location.href="/classes/get?classid='.$classId.'"</script>';
?>