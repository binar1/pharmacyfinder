<?php
/**
* 
*/
class Imagevalidation
{
	private $_passed=false,
           $_error=array(),
           $_db=null;
	function __construct()
	{
		$this->_db=DB::getInstance();
	}

	public function check($source,$fields = array())
	{
        foreach ($items as $item => $rules) {
        	foreach ($rules as $value => $rules_value) {
        		# code...
        	}
        }


	}
}

?>