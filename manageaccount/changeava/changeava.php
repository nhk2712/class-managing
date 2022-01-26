<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

echo '<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>';

$picture=$_FILES['picture'];
$uid=$_SESSION['uid'];

$target=$_SERVER['DOCUMENT_ROOT']."/userava/";
$file=$target . $uid . '.jpg';
$tmp=$picture['tmp_name'];

// Validation
$check=getimagesize($tmp);
$type = strtolower(pathinfo(basename($picture['name']),PATHINFO_EXTENSION));

if (!$check){
        die('File is not an image!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
}

if ($picture['size']>10240000){
        die('File exceeds file size limit!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
}

if ($type != "jpg" && $type != "png" && $type != "jpeg"
&& $type != "gif"){
        die('Invalid file type!<br>'.'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
}

//

if (file_exists($file)) unlink($file);

if (move_uploaded_file($tmp, $file)) {
    echo "The file has been uploaded.";
  } else {
    die("Sorry, there was an error uploading your file.<br/>".'<a href="/"><button class="btn btn-outline-primary">Return to home</button</a>');
  }
  
$name=$uid . '.jpg';
  
$cmd="UPDATE accounts SET avatar='$name' WHERE uid='$uid'";
$query=mysqli_query($db,$cmd);

echo '<br/>Changed account\'s profile picture successfully!';
$db->close();

echo '<script>location.href="/"</script>';
?>