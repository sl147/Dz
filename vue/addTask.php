<?
require_once ('../models/Task.php');

$newTask = trim(strip_tags($_GET['newTask']));
$MK = new Task();
$pr = $MK->addTask($newTask);

/*
$sql="INSERT INTO emaker (name_m) VALUES ('$name')";
$result = mysqli_query($link,$sql);*/
?>