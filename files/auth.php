<?php

class auth extends controller{
	
	var $errors;
	
	public function login()
	{
		
		$config = $this->catelog->get('config_item');
		
		if( isset( $_POST['btn'] ) )
		{
			$this->load->model('auth');
			
			if( $this->auth->login($_POST) ) {
				redirect( $config['base_url'].'main/?token='.$_SESSION['userdata']['token']);
				exit;
			}
			else {
				   set_flash('<p class="error">Wrong username or/and Password</p>');
				   redirect( $config['base_url'].'auth/login');
				   exit;
			}
		}
		
		$data = array(
		'content' => 'Hello World!',
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Login',
		'content' => $this->load->view('login', $data, true),
		'footer_links' => 
			array(
			 $config['base_url'] => '# Home',
			$config['base_url'] .'auth/register'=>'Sign up', 
			'help' => 'Help',
			'terms' => 'Terms'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
	
	
	public function register()
	{
		$config = $this->catelog->get('config_item');
		
		if( isset( $_POST['btn'] ) )
		{
			$data = array(
			'Username' => $_POST['u'],
			'Password' => $_POST['p'],
			'Gender'   => $_POST['gender'],
			'Birthday' => $_POST['dob']
			
			);
		
			 if(  ! $this->validate($data)  )
			 {
				 $this->load->model('auth');
		
				  switch( $this->auth->register($data) ) :
				   case 'u':
				    
				   set_flash('<p class="error">Sorry, that username is already taken</p>');
				   redirect( $config['base_url'].'auth/register');
				   exit;
				   break;
				   
				   case 's':
				   
				   $sele = array(
				   'title' => 'Success',
				   'content' => '<p class="txt">Hello, '. $data['Username']. ' your your registeration is successfully done</p>',
				   'links' => array(
				     $config['base_url'].'main?token='.$_SESSION['userdata']['token'] => 'Go to Main page!'
				    )
				   );
				   $this->load->view('elements/success', $sele);
				   exit;
				   break;
				   
				  endswitch;
			 }
		}
		
		
		
		$data = array(
		'errors' => $this->errors,
		
		);
		
		
		$layout = array(
		'title' => 'RockTila.com | Register',
		'content' => $this->load->view('register', $data, true),
		'footer_links' => 
			array(
			 $config['base_url'] => '# Home',
			 $config['base_url'] .'auth/login'=>'Login',  
			'help' => 'Help',
			'terms' => 'Terms'
			),
			
		'footer' => 'Copyright &copy; 2013 | Rocktila.com &trade;'
		);
		$this->load->view('layout', $layout);
	}
	
	public function doRegister()
	{
		//$this->load->model('auth');
		
		//$rs = $this->auth->register();
	}
	
	public function validate($data)
	{
		
		//$msg = '';
		
		if( empty( $data['Username'] ) || $data['Username'] == NULL )
		{
			$this->errors .= '<p class="error">Username is required.</p>';
			return 1;
		}
		if ( empty( $data['Password'] ) || $data['Password'] == NULL ){
			
			$this->errors .= '<p class="error">Password is required.</p>';
			return 1;
		}
		if ( empty( $data['Gender'] ) || $data['Gender'] == NULL ){
			
			$this->errors .= '<p class="error">Gender is required.</p>';
			return 1;
		}
		if ( trim($data['Gender']) != "M" && trim( $data['Gender'] ) != "F"){
			
			$this->errors .= '<p class="error">Gender is required.</p>';
			return 1;
		}
		if ( empty( $data['Birthday'] ) || $data['Birthday'] == NULL ){
			
			$this->errors .= '<p class="error">Birthday is required.</p>';
			return 1;
		}
		if ( preg_match('#[^0-9a-zA-z._]#i', $data['Username']) ){
			
			$this->errors .= '<p class="error">Invalid Characters in username.</p>';
			return 1;
		}
		if ( preg_match('#[^0-9-]#i', $data['Birthday']) ){
			
			$this->errors .= '<p class="error">Invalid Characters in username.</p>';
			return 1;
		}
		
		return false;
	
	}


} // 