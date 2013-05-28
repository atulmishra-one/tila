<?php

class home extends controller{
	
	
	public function index()
	{
		$config = $this->catelog->get('config_item');
		
		$data = array(
		'content' => 'Hello World!',
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com',
		'content' => $this->load->view('index', $data, true),
		'footer_links' => 
			array(
			$config['base_url'] .'auth/register'=>'Sign up', 
			'help' => 'Help',
			'terms' => 'Terms'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
}