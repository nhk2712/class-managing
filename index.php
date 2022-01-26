<?php
session_start();
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo '<meta name="viewport" content="width=device-width,initial-scale=1">';

if (!isset($_SESSION['uid'])){
        die('<div class="container"><a href="/signin"><button type="button" class="btn btn-primary">Sign in</button><a/>'
        .'<a href="/signup"><button type="button" class="btn btn-outline-primary">Sign up</button><a/></div>');
}

require('connect.php');

$uid=$_SESSION['uid'];
$cmd = "SELECT username,avatar FROM accounts WHERE uid='$uid'";
$query = mysqli_query($db,$cmd);
$res=mysqli_fetch_array($query);

echo '<div class="container">';
echo '<img id="userava" src="'.'/userava/'.$res['avatar'].'">';
echo "User: <strong>".$res['username'].'</strong><br/>';
?>

<b>Actions</b><br/>
<a href="/signout"><button type="button" class="btn btn-outline-danger">Sign out</button></a><br/>
<a href="/classes"><button type="button" class="btn btn-outline-success">Manage classes</button></a><br/>
<a href="/manageaccount"><button type="button" class="btn btn-outline-primary">Manage account</button></a><br/>
<a href="/feedback"><button type="button" class="btn btn-outline-warning">Feedback</button></a><br/>
</div>

<style>
#userava{
width:50px;
clip-path:circle();
}
</style>