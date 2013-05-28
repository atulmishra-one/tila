<?php

class controller {
	
	protected $catelog;
	
	function __construct($catelog)
	{
		$this->catelog = $catelog;
	}
	
	public function __set($name, $value)
	{
		$this->catelog->set($name, $value);
	}
	
	 public function __get($key)
	{
		return $this->catelog->get($key);
	}
}