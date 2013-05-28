<?php

class profile extends controller{
	
	var $config;
	
	public function __construct($catelog)
	{
		parent::__construct($catelog);
		$this->config = $this->catelog->get('config_item');
		$this->checkToken();
		
	}
	
	public function index($id = false)
	{
		$id = $id ? $id : $_SESSION['userdata']['id'];
		
		$this->load->model('common');
		
		$this->load->model('profile');
		
		$this->load->model('friends');
		
		$frens = array (
		'areFriends' => $this->friends->areFriends($id),
		
		'hasRequestFromThis' => $this->friends->hasRequestFromThis($id),
		
		'hasRequested' => $this->friends->hasRequested($id)
		
		);
		
		
		$isOwner = ( $id === $_SESSION['userdata']['id'] ) ? true: false;
		
	    $info = $this->common->getUserById($id);
		$ip = $info[0]['ip'];
		
		$country = $this->profile->getCountry($ip);
		$country =  $country['country'];
		
		
		if( empty( $info[0]['name'] ) )
		$info[0]['name'] = $info[0]['username'];
		
		if( empty( $info[0]['profile_pic'] ) ) {
			$sex = ( $info[0]['sex'] == 'F') ? 'female': 'male';
			$info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'images/'.$sex.'.png" alt="'.$sex.'" />';
		}
		else {
			$info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'uploads/profile_pic/'.$info[0]['profile_pic'].'" alt="'.$info[0]['profile_pic'].'" />';
		}
		
	    $sex= ($info[0]['sex'] === 'F') ? 'Female':'Male' ;
		
		$age = date('Y', strtotime( $info[0]['birthday'] ) );
		
		$curyear = date('Y', time() );
		
		$age = ( $curyear - $age );
		
		$data = array(
		'name' => $info[0]['name'],
		'profile_pic' => $info[0]['profile_pic'],
		'sex' => $sex,
		'age' => $age,
		'isOwner' => $isOwner,
		'country' => $country,
		'info' => $info,
		'frens' => $frens
		
		);;
		
	
		
		$layout = array(
		'title' => $this->common->getName($id).' | RockTila.com',
		'content' => $this->load->view('profile/index', $data, true),
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
	
	public function addFriend($id = false)
	{
		if( !$id)
		exit();
		
		$this->load->model('common');
		$this->load->model('friends');
		
		if( $this->friends->sendRequest($id) )
		{
			$msg = $this->common->getName($_SESSION['userdata']['id']).' is now friend with '.$this->common->getName($id);
			$this->common->insert_notification( $msg, 'P');
		    redirect($this->config['base_url'].'profile/index/'.$id.'/?token='.$_SESSION['userdata']['token']);
			exit;
		}
		else {
				set_flash('<p class="error">Oops ! Something went wrong</p>');
				redirect($this->config['base_url'].'profile/index/'.$id.'/?token='.$_SESSION['userdata']['token']);
				exit;
		}
		
	}
	
	
	public function profile_pic()
	{
		
		
		if( isset( $_POST['btn'] ) )
		{
			$this->load->model('common');
			$this->load->model('profile');
			
			if( $this->profile->update_profile_pic() ) {
				
				$hisHer = ( $this->common->getGender($_SESSION['userdata']['id']) === 'Male' ) ? 'his': 'her';
				$msg = $this->common->getName($_SESSION['userdata']['id']). ' updated '.$hisHer .' profile picture';
				
				$this->common->insert_notification( $msg, $_POST['notify_to']);
				redirect($this->config['base_url'].'profile/?token='.$_SESSION['userdata']['token']);
				exit;
			}
			else {
				set_flash('<p class="error">Please Upload Invalid Image</p>');
				redirect($this->config['base_url'].'profile/profile_pic/?token='.$_SESSION['userdata']['token']);
				exit;
			}
		}
		
		$data = array();
		
		$layout = array(
		'title' => 'RockTila.com | Change your profile picture',
		'content' => $this->load->view('profile/profile_pic', $data, true),
		'footer_links' => 
			array(
			alink($this->config['base_url'].'main') =>' # Main', 
			alink($this->config['base_url'].'chat') => 'Chat rooms',
			'terms' => 'Terms',
			alink($this->config['base_url'].'auth/logout') => 'Logout'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
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
	
	
}