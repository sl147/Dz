<?php
/**
 * 
 */
class FilterInputTXT extends Filter
{
	public $flag, $output;

	function __construct($flag)
	{
		$this->flag  = $flag;
	}

	public function setFilterTXT() {
		switch($this->type)
		{
			case 'get':
			$this->output = filter_input(INPUT_GET, parent::$field, parent::$id);
			break;

			case 'post':
			$this->output = filter_input(INPUT_POST, parent::$field, parent::$id, $this->flag); 
			break;

			default:
			break;
		}
		return $this->output;		
	}	
}
?>