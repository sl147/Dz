<?
require_once ('../models/Task.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$newTask = trim(strip_tags($_POST['newTask']));
$id = intval(trim(strip_tags($_POST['id'])));
$MK = new Task();
$pr = $MK->editTask($id, $newTask);

?>