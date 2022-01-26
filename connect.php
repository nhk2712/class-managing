<?php
// Connection info here, but I deleted it :>
$svname = '';
$dbuser = '';
$dbpass = '';
$dbname = '';
$port = '';

$db = mysqli_connect($svname,$dbuser,$dbpass,$dbname,$port);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>