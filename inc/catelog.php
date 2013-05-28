<?php

class catelog {
	
	private $catelog = array();
	
	public function get($key)
	{
		return isset( $this->catelog[$key]) ? $this->catelog[$key] : NULL;
	}
	
	public function set($key, $value)
	{
		$this->catelog[$key] = $value;
	}
	
}