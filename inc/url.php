<?php

class url {
	
	
	var $url;
	
	var $controller;
	
	var $action;
	
	var $uri;
	
	var $controllerPath;
	
	protected $catelog;
	
	var $obj;
	
	
	public function __construct($catelog) {
		
		$this->catelog = $catelog;
		
		$this->url = isset( $_GET['route'] ) ? filter_var($_GET['route'], FILTER_SANITIZE_URL)  : NULL;	
		$this->uri = $this->uri();
	}
	
	public function uri()
	{
		$this->url = rtrim($this->url, '/' );
	    return explode('/', $this->url );	
	}
	
	public function parse()
	{
		
		$config = $this->catelog->get('config_item');
		
		
		if( ! empty( $this->uri[0] ) )
		{
			$this->controller = $this->uri[0];
		}
		else {
			$this->controller = $config['defaultController'];
		}
		
		if( !empty( $this->uri[1] ) )
		{
			$this->action = $this->uri[1];
		}
		else { 
			$this->action = 'index';
		}
		
		$this->controllerPath = $config['base_path'].'files/'. $this->controller. '.php';
		
		if( file_exists( $this->controllerPath ) )
		{
			require_once $this->controllerPath;
			
			if( class_exists( $this->controller) ) {
				
				$this->obj = new $this->controller( $this->catelog );
				
				if( method_exists( $this->obj, $this->action ) )
				{
					
				}
				else {
					echo show_error('Not found');
				}
			}
			else {
				echo show_error('Not found');
			}
		}
		else {
			echo show_error('Not found');
		}
		
		if (is_array($this->uri))
            if (count($this->uri) > 0)
                array_shift($this->uri);

        if (is_array($this->uri))
            if (count($this->uri) > 0)
                array_shift($this->uri);
		
		
	}// close function parse.
	
	
} // end of class

