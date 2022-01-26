<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

$username = $_POST['username'];
$password = $_POST['password'];
$password = hash("sha256",$password);

$cmd = "SELECT * from accounts WHERE username='$username'";
$query = mysqli_query($db,$cmd);

$num=mysqli_num_rows($query);
if (!$num) die('User does not exist. Wanna sign up?'
.'<br/>'
.'<a href="/signin"><button>Sign in again</button></a>'
.'<a href="/signup"><button>Sign up</button></a>');

session_start();
$res=mysqli_fetch_array($query);
if ($password!=$res['password']) die('Wrong password!'.'<br/>'.'<a href="/signin"><button>Sign in again</button></a>');
else{
        echo 'Signed in successfully!';
        $_SESSION['uid']=$res['uid'];
        $db->close();
        echo '<script>location.href="/"</script>';
}
?>