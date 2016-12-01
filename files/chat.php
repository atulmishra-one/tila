<?php

class chat extends controller{
	
	var $config;
	
	public function __construct($catelog)
	{
		parent::__construct($catelog);
		$this->config = $this->catelog->get('config_item');
		$this->checkToken();
		
	}
	
	public function index()
	{
		$this->load->model('common');
		
		
		$data = array(
		'content' => 'Hello World!',
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Chat',
		'content' => $this->load->view('chat/index', $data, true),
		'footer_links' => 
			array(
			alink($this->config['base_url'].'main') =>' # Main', 
			'help' => 'Help',
			'terms' => 'Terms',
			alink($this->config['base_url'].'auth/logout') => 'Logout'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
	
	public function common()
	{
		$this->load->model('common');
		$this->load->model('chat');
		
		if( isset( $_POST['btn'] ) )
		{
			$vals = array(
			'msg' => $_POST['msg'],
			'room' => 1
			);
			
			if( !empty( $vals['msg'] ) )
			$this->send($vals);
		}
		
		
		$data = array(
		'msgs' => $this->get(1)
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Chat',
		'content' => $this->load->view('chat/common', $data, true),
		'footer_links' => 
			array(
			alink($this->config['base_url'].'main') =>' # Main', 
			alink($this->config['base_url'].'chat') => 'Chat rooms',
			'terms' => 'Terms',
			alink($this->config['base_url'].'auth/logout') => 'Logout'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;',
		'refresh' => alink($this->config['base_url'].'chat/common')
		);
		$this->load->view('layout', $layout);
	}
	
	
	
	public function adult()
	{
		$this->load->model('common');
		$this->load->model('chat');
		
		if( isset( $_POST['btn'] ) )
		{
			$vals = array(
			'msg' => $_POST['msg'],
			'room' => 3
			);
			
			if( !empty( $vals['msg'] ) )
			$this->send($vals);
		}
		
		
		$data = array(
		'msgs' => $this->get(3)
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Chat',
		'content' => $this->load->view('chat/adult', $data, true),
		'footer_links' => 
			array(
			alink($this->config['base_url'].'main') =>' # Main', 
			alink($this->config['base_url'].'chat') => 'Chat rooms',
			'terms' => 'Terms',
			alink($this->config['base_url'].'auth/logout') => 'Logout'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;',
		'refresh' => alink($this->config['base_url'].'chat/common')
		);
		$this->load->view('layout', $layout);
	}
	
	public function other()
	{
		$this->load->model('common');
		$this->load->model('chat');
		
		if( isset( $_POST['btn'] ) )
		{
			$vals = array(
			'msg' => $_POST['msg'],
			'room' => 2
			);
			
			if( !empty( $vals['msg'] ) )
			$this->send($vals);
		}
		
		
		$data = array(
		'msgs' => $this->get(2)
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Chat',
		'content' => $this->load->view('chat/others', $data, true),
		'footer_links' => 
			array(
			alink($this->config['base_url'].'main') =>' # Main', 
			alink($this->config['base_url'].'chat') => 'Chat rooms',
			'terms' => 'Terms',
			alink($this->config['base_url'].'auth/logout') => 'Logout'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;',
		'refresh' => alink($this->config['base_url'].'chat/common')
		);
		$this->load->view('layout', $layout);
	}
	
	public function checkToken()
	{
		if( !isset( $_SESSION['userdata'] ) )
		{
			session_destroy();
			redirect( $this->config['base_url'] );
			exit;	
		}
		
		if( $_GET['token'] != $_SESSION['userdata']['token'] )	
		{
			session_destroy();
			redirect( $this->config['base_url'] );
			exit;
		}

	}
	
	public function send($data)
	{
		$this->chat->send($data);
	}
	
	public function get($room)
	{
		$msgs = array();
		
		foreach( $this->chat->get($room) as $m ) 
		{
			
			//$msg = ( strlen( $m['msg']) === true )? $m['msg']. "pp<br />": $m['msg'];
			
			
			$msgs[] = array(
			'chatter_id' => $m['chatter_id'],
			'name' => $this->common->getName($m['chatter_id']),
			'msg' => nl2br($m['msg']),
			'time' => date('h:i', strtotime($m['timesent'], time()) )
			);
		}
		
		return $msgs;
	}
}