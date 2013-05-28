<?php

class main extends controller{
	
	var $config;
	
	var $token;
	
	public function __construct($catelog)
	{
		parent::__construct($catelog);
		$this->config = $this->catelog->get('config_item');
		$this->checkToken();
		
	}
	
	public function index()
	{
		//
		$this->load->model('common');
	
				
		$info = $this->common->getUserById($_SESSION['userdata']['id']);
		if( empty( $info[0]['name'] ) )
		$info[0]['name'] = $info[0]['username'];
		
		if( empty( $info[0]['profile_pic'] ) ) {
			$sex = ( $info[0]['sex'] == 'F') ? 'female48': 'male48';
			$info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'images/'.$sex.'.png" alt="'.$sex.'" />';
		}
		else {
			$info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'uploads/profile_pic/thumb/'.$info[0]['profile_pic'].'" alt="'.$info[0]['profile_pic'].'" />';
		}
		
		
		$data = array(
		'name' => $info[0]['name'],
		'profile_pic' => $info[0]['profile_pic'],
		'peoples' => $this->common->peopleYouMayknow( $_SESSION['userdata']['id']),
		'mood' => $info[0]['mood']
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com',
		'content' => $this->load->view('main', $data, true),
		'footer_links' => 
			array( 
			'help' => 'Help',
			'terms' => 'Terms'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
	
	function status()
	{
		$this->load->model('common');
		$this->load->model('main');
		
		
		if( isset( $_POST['btn'] ) )
		{
			if( !empty( $_POST['status'] ) ) {
				
				if( $this->main->setMood($_POST) )
				{
					$hisHer = ( $this->common->getGender($_SESSION['userdata']['id']) === 'Male' ) ? 'his': 'her';
					$msg = $this->common->getName($_SESSION['userdata']['id']). ' updated '.$hisHer .' status';
				
					$this->common->insert_notification( $msg, 'P');
					
					set_flash('<p class="success">Status updated!</p>');
					redirect($this->config['base_url'].'main/status/?token='.$_SESSION['userdata']['token']);
					exit;
				}
			}
		}
		
		
		$data = array();
		
		$layout = array(
		'title' => 'RockTila.com',
		'content' => $this->load->view('status', $data, true),
		'footer_links' => 
			array( 
			alink($this->config['base_url'].'main') => ' # Main'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
	
	 function checkToken()
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
	
}