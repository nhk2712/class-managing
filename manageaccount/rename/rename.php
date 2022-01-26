<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

$name=$_POST['name'];
$uid=$_SESSION['uid'];

$cmd1="SELECT username FROM accounts WHERE username='$name'";
$query1=mysqli_query($db,$cmd1);
$num1=mysqli_num_rows($query1);

if ($num1) die('Username already exists!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');

$cmd2="UPDATE accounts SET username='$name' WHERE uid='$uid'";
$query2=mysqli_query($db,$cmd2);

echo 'Changed username successfully!';
$db->close();

echo '<script>location.href="/"</script>';
?>