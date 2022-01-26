<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

$uid=$_SESSION['uid'];
$current=$_POST['current'];
$current=hash('sha256',$current);

$cmd1="SELECT password FROM accounts WHERE uid='$uid'";
$query1=mysqli_query($db,$cmd1);
$res1=mysqli_fetch_array($query1);

if ($current!=$res1['password']) die('Wrong current password!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
$current="";

$new=$_POST['new'];
$cf=$_POST['cf'];

if ($new!=$cf) die('Wrong password confirmed!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
$cf="";

$new=hash("sha256",$new);

$cmd2="UPDATE accounts SET password='$new' WHERE uid='$uid'";
$query2=mysqli_query($db,$cmd2);

echo 'Changed password successfully!';
$db->close();

echo '<script>location.href="/"</script>';
?>