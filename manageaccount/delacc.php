<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

$uid=$_SESSION['uid'];

$cmd1="DELETE FROM accounts WHERE uid='$uid'";
$query1=mysqli_query($db,$cmd1);

$cmd2="DELETE FROM classes WHERE classOwner='$uid'";
$query2=mysqli_query($db,$cmd2);

echo 'Deleted account successfully!';
$db->close();
unset($_SESSION['uid']);

echo '<script>location.href="/"</script>';

?>