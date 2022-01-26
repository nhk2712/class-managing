<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();
$classId = $_SESSION['classId'];

$cmd1 = "DELETE FROM classes WHERE classId='$classId'";
$query1 = mysqli_query($db,$cmd1);;

unset($_SESSION['classId']);
$db->close();

echo 'Deleted class!';
echo '<script>location.href="/classes"</script>';
?>
