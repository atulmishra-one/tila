<?php

class config {
	
	var $config;
	
	//var $base_url;

	
	public function __construct()
	{
		$this->load();
	}
	
	public function load()
	{
		if (is_object($this->config))
        return;
		
		$base_path = dirname( str_replace('\\', '/', dirname(__FILE__) ) );
		
		//$base_url = basename('http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'] );
		
		include $base_path. '/config.php' ;
		
		$this->config = $config;
		
		if( isset( $this->config['base_url'] ) && !empty($this->config['base_url']) )
		{
			$this->config['base_url'] = $this->config['base_url'];
		}
		else {
			$this->config['base_url'] = $this->base_url();
		}
		$this->config['base_path'] = $base_path.'/';
	}
	public function base_url()
	{
		return 'http://'.$_SERVER['HTTP_HOST']. str_replace('index.php', '', $_SERVER['SCRIPT_NAME'] );
	}
	
	
} // end of class