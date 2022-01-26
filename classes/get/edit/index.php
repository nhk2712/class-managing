<?php
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
session_start();

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

$classId = $_SESSION['classId'];
mysqli_set_charset($db,"utf8");

$cmd1 = "SELECT classOwner,classList,className FROM classes WHERE classId='$classId'";
$query1 = mysqli_query($db,$cmd1);

$res1 = mysqli_fetch_array($query1);
$_SESSION['classId']=$classId;

echo '<div class="container">';
echo '<div>Class <strong>'.$res1['className'].'</strong></div>';

$owner=$res1['classOwner'];
$cmd2="SELECT username FROM accounts WHERE uid='$owner'";
$query2=mysqli_query($db,$cmd2);
$res2=mysqli_fetch_array($query2)['username'];
echo '<div>Class owner: <strong>'.$res2.'</strong></div>';

if ($res1['classList']=='[]') {
die('You do not have any students. Wanna add some?<br/>'.'<a href="add"><button type="button" class="btn btn-outline-primary">Add students</button></a>');
}
?>

<div class="table-responsive">
<table class="table">
<thead>
<tr>
        <td>Student's name</td>
        <td>D.O.B</td>
        <td>Actions</td>
</tr>
</thead>
<tbody id="content">

<script>var list</script>
<?php
$list=$res1['classList'];
echo '<script>list='.$list.'</script>';
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
input::focus{
border-color:unset;
}
</style>

<script>
var content=document.querySelector('#content')

for (var i=0;i<list.length;i++){
content.innerHTML+="<tr class='tile'> <td><input type='text' class='studentName form-control' value='"+list[i].name+"' required></td> <td><input type='date' class='studentDob form-control' value='"+list[i].dob+"' required></td> <td><button type='button' class='btn btn-outline-danger del' id='"+i.toString()+"'>Delete</button></td> </tr>"
}

var studentName, studentDob,tile,del
query()
delEv()

function save(){
        var valid=true
        for (var i=0;i<list.length;i++){
                if (studentName[i].value=='') {
                        studentName[i].style.borderColor='red'
                        valid=false
                }
                if (studentDob[i].value=='') {
                        studentDob[i].style.borderColor='red'
                        valid=false
                }
        }

        if (valid) {
                inpToList()
                var form = document.createElement('form')
                form.style.display="none"
                form.method="POST"
                form.action='edit.php'
                document.body.appendChild(form)
                var data = document.createElement('input')
                data.type="text"
                data.name="list"
                data.value=JSON.stringify(list)
                form.appendChild(data)
                form.submit()
        }

}

function inpToList(){
        for (var i=0;i<list.length;i++){
                list[i].name=studentName[i].value
                list[i].dob=studentDob[i].value
        }
}

function query(){
        studentName=document.querySelectorAll('.studentName')
        studentDob = document.querySelectorAll('.studentDob')
        tile = document.querySelectorAll('.tile')
        del = document.querySelectorAll('.del')
        
        for (var i=0;i<del.length;i++) del[i].id=i
}

function delEv(){
        if (list.length==1) return
        for (var i=0;i<list.length;i++){
                del[i].onclick=function(){
                        content.removeChild(tile[this.id])
                        list.splice(this.id,1)
                        query()
                }
        }
}

function add(){
        inpToList()

        list[list.length]={name:'',dob:''}
        content.innerHTML+="<tr class='tile'> <td><input type='text' class='studentName form-control' value='"+list[list.length-1].name+"' required></td> <td><input type='date' class='studentDob form-control' value='"+list[list.length-1].dob+"' required></td> <td><button type='button' class='btn btn-outline-danger del' id='"+(list.length-1).toString()+"'>Delete</button></td> </tr>"

        query()

        for (var i=0;i<list.length;i++){
                studentName[i].value=list[i].name
                studentDob[i].value=list[i].dob
        }
        
        delEv()

}
</script>

<button onclick="add()" type="button" class="btn btn-outline-primary">Add students</button>
<button onclick="save()" type="button" class="btn btn-outline-success">Save</button>
</div>