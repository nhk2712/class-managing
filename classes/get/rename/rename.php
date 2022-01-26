<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();
$classId = $_SESSION['classId'];
$name=$_POST['name'];

mysqli_set_charset($db,"utf8");

$cmd="UPDATE classes SET className='$name' WHERE classId='$classId'";
$query=mysqli_query($db,$cmd);

echo 'Renamed class successfully!';
$db->close();

echo '<script>location.href="/classes/get?classid='.$classId.'"</script>';
?>