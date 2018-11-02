<?php

class Task
{

	public static function getConnection() {
		$params = include('db_params.php');
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$db = new PDO($dsn,$params['user'],$params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);		
		return $db;
	}

	public static function getTasksAll() {
		$list = [];
		$db   = self::getConnection();
		$sql  = "SELECT * FROM Dzuba_tasks ORDER BY date_Task DESC ";
		$result = $db -> query($sql);
		while ($row = $result->fetch()) {
			$list[] = $row;
		}
		return $list;		
	}

	public static function getTasksAllVue() {
		$list = [];
		$db = self::getConnection();
		$sql = "SELECT * FROM Dzuba_tasks ORDER BY date_Task DESC ";
		//$result = $db -> query($sql);
		$result = $db->query($sql);
		while ($row = $result->fetch()) {
			$list[] = $row;
		}
		return $list;
	}
	public static function addTask($task) {
		$db = self::getConnection();
		$sql="INSERT INTO Dzuba_tasks (task) VALUES(:task)";
		$result = $db -> prepare($sql);
		$result -> bindParam(':task', $task, PDO::PARAM_STR);

		return $result -> execute();		
	}

	public static function editTask($id, $task) {
		if (intval($id)) {
		$db = self::getConnection();
		$sql = "UPDATE Dzuba_tasks SET task=:task WHERE id=$id";
		$result = $db -> prepare($sql);
		$result -> bindParam(':task', $task, PDO::PARAM_STR);

		return $result -> execute();
		}		
	}

	public static function deleteTask($id) {
		$db = self::getConnection();
		$sql = "DELETE FROM Dzuba_tasks WHERE id=:id";		
		$result = $db -> prepare($sql);
		$result -> bindParam(':id', $id, PDO::PARAM_STR);

		return $result -> execute();		
	}
}	
?>