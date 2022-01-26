<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();

$classId = $_SESSION['classId'];
$name=$_POST['name'];
$dob=$_POST['dob'];

mysqli_set_charset($db,"utf8");

$cmd1 = "SELECT * FROM classes WHERE classId='$classId'";
$query1 = mysqli_query($db,$cmd1);
$res1 = mysqli_fetch_array($query1);
$list=$res1['classList'];

$list=json_decode($list,true);
$student=array("name"=>$name,"dob"=>$dob);
array_push($list,$student);
$list=json_encode($list,JSON_UNESCAPED_UNICODE);

$cmd2="UPDATE classes SET classList='$list' WHERE classId='$classId'";
$query2=mysqli_query($db,$cmd2);

echo 'Added student successfully!';
$db->close();

echo '<script>location.href="/classes/get?classid='.$classId.'"</script>';

?>
