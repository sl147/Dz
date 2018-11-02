<?php
//namespace CountNS;
/**
 * Кількість записів в таблиці
 * @return int к-ть записів
 */
class Count
{
	private $table, $id, $detail;

	function __construct($table, $id = 1, $detail = 'id', $idName = 'id')
	{
		 $this->table  = $table;
		 $this->id     = $id;
		 $this->detail = $detail;
		 $this->idName = $idName;
	}

	private function select($sql) {
		$db     = Db::getConnection();
		$result = $db -> query($sql);
		$result -> setFetchMode(PDO::FETCH_ASSOC);
		$row    = $result->fetch();
		//$db->close(); 

		return $row['count'];
	}

	public function get() {		
		$sql = "SELECT count($this->idName) as count FROM $this->table";
		return $this->select($sql);	
	}

	public function getId() {
		$sql = "SELECT count(id) as count FROM $this->table WHERE ".$this->detail."=".$this->id;
		return $this->select($sql); 	
	}
}
?>