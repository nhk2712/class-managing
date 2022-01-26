<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();

$className = $_POST['className'];
$uid = $_SESSION['uid'];

mysqli_set_charset($db,"utf8");

$cmd1 = "SELECT * FROM classes WHERE classOwner='$uid' and className='$className'";
$query1 = mysqli_query($db,$cmd1);
$num1 = mysqli_num_rows($query1);
if ($num1) die('<h2>Class already exists!</h2><a href="/classes/create"><button>Create again</button></a>');

$cmd2 = "INSERT INTO classes (className,classOwner,classList) VALUES ('$className','$uid','[]')";
$query2 = mysqli_query($db,$cmd2);

$db->close();
echo 'Class was created successfully!';
echo '<script>location.href="/classes"</script>';

?>