<?php
/**
 * 
 */
class Filter
{

	public $type, $field,$id, $output;

	function __construct($type, $field, $id)
	{
		$this->type  = $type;
		$this->field = $field;
		$this->id    = $id;
	}

	private function outFilter($typeInput) {
		return filter_input($typeInput, $this->field, $this->id);
	}

	public function setFilter() {
		switch($this->type)
		{
			case 'get':
			$this->output = self::outFilter(INPUT_GET);
			break;

			case 'post':
			$this->output = self::outFilter(INPUT_POST); 
			break;

			default:
			break;
		}
		return $this->output;		
	}
}

?>