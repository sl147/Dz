<?php
require_once ('../models/Task.php');

$id = intval(trim(strip_tags($_GET['id'])));
if ($id) {
	$MK = new Task();
	$pr = $MK->deleteTask($id);
}
?>