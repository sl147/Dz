<?php
require_once ('../models/Task.php');

$pr=[];
$MK = new Task();
$pr = $MK->getTasksAllVue();

echo json_encode($pr);
?>