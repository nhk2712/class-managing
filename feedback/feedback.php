<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

$uid=$_SESSION['uid'];
$title=$_POST['title'];
$rate=$_POST['rate'];
$detail=$_POST['detail'];

mysqli_set_charset($db,"utf8");

$cmd="INSERT INTO feedback (title,rate,detail,sender) VALUES ('$title','$rate','$detail','$uid')";
$query=mysqli_query($db,$cmd);

echo 'Thanks for sending feedback!<br/>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>';
$db->close();

?>