<?php
session_start();
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo '<meta name="viewport" content="width=device-width,initial-scale=1">';
$uid = $_SESSION['uid'];

require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
mysqli_set_charset($db,"utf8");

$cmd1 = "SELECT * FROM classes WHERE classOwner='$uid'";
$query1 = mysqli_query($db,$cmd1);
$num1 = mysqli_num_rows($query1);

if (!$num1) die('<div class="container">You do not own any classes. Wanna create one?<br/>'
.'<a href="/classes/create"><button type="button" class="btn btn-outline-primary">Create new class</button></a>'
.'<a href="/"><button type="button" class="btn btn-primary">Exit</button></a></div>');

echo '<div class="container">';
echo '<h2>My classes</h2>';
echo '<div class="list-group">';
while ($data=mysqli_fetch_array($query1)){
        echo '<a href="/classes/get?classid='.$data['classId'].'" class="list-group-item list-group-item-action">';
        echo $data['className'];
        echo '</a>';
}
echo '</div>';

$db->close();
echo '<a href="/classes/create"><button type="button" class="btn btn-outline-primary">Create class</button></a>';
?>
</div>