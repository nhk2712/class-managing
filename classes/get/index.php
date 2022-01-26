<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();

if (!isset($_GET['classid'])) die('Invalid query!');
$classId = $_GET['classid'];

mysqli_set_charset($db,"utf8");

$cmd1 = "SELECT classOwner,classList,className FROM classes WHERE classId='$classId'";
$query1 = mysqli_query($db,$cmd1);

$num1 = mysqli_num_rows($query1);
if (!$num1) die('Invalid class ID!');

$res1 = mysqli_fetch_array($query1);
if ($res1['classOwner']!=$_SESSION['uid']) die("You do not have permission to access to this class!");
$_SESSION['classId']=$classId;

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

echo '<div class="container">';
echo '<div>Class <strong>'.$res1['className'].'</strong></div>';

$owner=$res1['classOwner'];
$cmd2="SELECT username FROM accounts WHERE uid='$owner'";
$query2=mysqli_query($db,$cmd2);
$res2=mysqli_fetch_array($query2)['username'];
echo '<div>Class owner: <strong>'.$res2.'</strong></div>';
?>

<a href="delete.php"><button type="button" class="btn btn-outline-danger">Delete class</button></a>
<a href="rename"><button type="button" class="btn btn-outline-warning">Rename class</button></a>

<?
if ($res1['classList']=='[]') {
die('<br>You do not have any students. Wanna add some?<br/>'.'<a href="add"><button type="button" class="btn btn-outline-primary">Add students</button></a>');
}
?>

<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
        <td>Student's name</td>
        <td>D.O.B</td>
</tr>
</thead>
<tbody>
<?php
$list=json_decode($res1['classList'],true);
for ($i=0;$i<count($list);$i++){
        $date=date_parse($list[$i]['dob']);
        echo '<tr>';
        echo '<td>'.$list[$i]['name'].'</td>';
        echo '<td>'.$date['day'].'/'.$date['month'].'/'.$date['year'].'</td>';
        echo '</tr>';
}
?>
</tbody>
</table>
</div>

<style>
thead{
font-weight:bold;
}
table{
border:3px solid black !important;
}
td{
border: 1px solid black;
text-align:center;
}
</style>

<a href="add"><button type="button" class="btn btn-outline-success">Add students</button></a>
<a href="edit"><button type="button" class="btn btn-outline-primary">Edit students' details</button></a>
</div>