<?php
require_once ('../models/Task.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$id = intval(trim(strip_tags($_POST['id'])));
if ($id) {
	$MK = new Task();
	$pr = $MK->deleteTask($id);
}
?>