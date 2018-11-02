<?
require_once ('../models/Task.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$newTask = trim(strip_tags($_POST['newTask']));
$MK = new Task();
$pr = $MK->addTask($newTask);
?>