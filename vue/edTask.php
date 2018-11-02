<?
require_once ('../models/Task.php');

$newTask = trim(strip_tags($_GET['newTask']));
$id = trim(strip_tags($_GET['id']));
$MK = new Task();
$pr = $MK->editTask($id, $newTask);

/*
$sql="INSERT INTO emaker (name_m) VALUES ('$name')";
$result = mysqli_query($link,$sql);*/
?>