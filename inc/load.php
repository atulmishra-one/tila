<?php

class load {
	
	protected $catelog;
	
	public function __construct($catelog)
	{
		$this->catelog = $catelog;
	}
	
	public function view($views, $data , $return = false)
	{
		$config = $this->catelog->get('config_item');
		//if ( is_array( $data ) )
		@extract($data);
		//else
		//$data;
		
		$output = '';
		
		$view_path = $config['base_path'].'html/'.$views. '.php';
		
		if( file_exists( $view_path ) )
		{
			if( !$return ) {
				require $view_path;
			}else { 
				ob_start();
				require $view_path;
				$output = ob_get_contents();
				ob_end_clean();
			}
		}
		else { echo show_error('View Not Found'); exit; }
		
		return $output;
		
	} // close view //
	
	public function model($model)
	{
		$config = $this->catelog->get('config_item');
		$model_path = $config['base_path'].'data/'.$model.'.php';
		$class = $model.'_model';
		
		if( file_exists( $model_path ) )
		{
			require $model_path;
			
			if( class_exists( $class) ) {
				
				$obj = new $class($this->catelog);
				$this->catelog->set($model, $obj);
			}
		}
	}
	
	
}