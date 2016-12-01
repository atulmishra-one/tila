<?php
/**
* @ version     1.0
* @ package     mysqli class for hrms
* @ subpackage  database
*/

//

class MyDatabase {
	
	
	var $table_prefix = '';
	
	var $con;
	
	var $result;
	
	var $select;
	
	var $where;
	
	var $order_by;
	
	var $limit;
	
	var $result_id = NULL;
	
	protected $catelog;
	
	
	
	
	public function __construct($catelog)
	{
		$this->catelog = $catelog;
		
		$config = $this->catelog->get('config_item');
		
		$prefix = @( array_key_exists('prefix', $config['prefix']) ) ? $config['prefix'] : '';
		
		$this->table_prefix = $prefix;
		
		$this->connect($config['hostname'], $config['username'], $config['password'], $config['database']);
		
	}
	
	public function connect($host, $user, $pass, $db)
	{
		$this->con = @mysqli_connect($host, $user, $pass, $db);
		
		if( $this->con )
		{	
			return 1;
		}
		else {
			echo show_error('Database Error');
			exit;
		}
	}
	
	public function insert($table, $data)
	{
	   if( count( $data ) > 0 && $data >= 1) :
	   
	   foreach( $data as $key => $value )
	   {
		   $lft[] = $key;
		   $rft[] = "'$value'";
	   }
	   
		return mysqli_query($this->con, "INSERT INTO ".$this->table_prefix."$table ( ". implode(",", $lft) ." ) 
			
									VALUES ( ". implode(",", $rft) ." ) "
						     ) or die( mysqli_error( $this->con ) );
		
		
		endif;
		
		return;
	}
	
	public function update($table, $data, $where)
	{
		if( sizeof ($data) > 0  && $data >= 1) :
		
		foreach( $data as $key => $value )
		{
			$valstr[] = $key . '=' . "'$value'";
		}
		
		foreach( $where as $wkey => $wvalue)
		{
			$wval[] = $wkey . '='. "'$wvalue'";
		}
		
		return mysqli_query($this->con, "UPDATE ".$this->table_prefix."$table SET ".implode(",", $valstr)." 
						WHERE ".implode(" and ", $wval)." ") 
		or die( mysqli_error( $this->con ) );
		
		
		endif;
		
		return;
	}
	
	public function delete($table, $condition = false)
	{
		
		if( $condition )
		{
			foreach( $condition as $key => $value ) 
			{
				$val[] = $key . '=' . "'$value'";
			}
			
			$condition = "WHERE ". implode(' and ', $val );
		}
		
		return mysqli_query( $this->con, "DELETE FROM ".$this->table_prefix."$table $condition") 
		
			   or die( mysqli_error($this->con) ) ;
	}
	
	public function query($sql)
	{
		return $this->result_id = mysqli_query( $this->con, $sql ) or die( mysqli_error($this->con) );
	}
	
	public function num_rows()
	{
		return mysqli_num_rows( $this->result_id );
	}
	
	public function insert_id()
	{
		return mysqli_insert_id( $this->con );
	}
	
	public function get_all($table)
	{
		$return = '';
		
		$s = mysqli_query( $this->con, "SELECT * FROM ".$this->table_prefix."$table") or die( mysqli_error($this->con) );
		
		while( $res = mysqli_fetch_assoc( $s ) )
		{
			$return[] = $res;
		}
		
		return $return;
	}
	
	public function select($table, $sel = "*")
	{
		$this->select = "SELECT $sel FROM ".$this->table_prefix."$table ";
		return $this;
	}
	
	public function where($condition)
	{
			foreach( $condition as $key => $value ) 
			{
				$val[] = $key . '=' . "'$value'";
			}
			
		$condition = " WHERE ". implode(' and ', $val );
	
		
		$this->where = " $condition";
		return $this;
	}
	
	public function order_by($str)
	{
		$this->order_by = " ORDER BY $str";
		return $this;
	}
	
	public function limit($start = 0, $limit)
	{
		$this->limit = " LIMIT ".$start. ',' .$limit;
		return $this;
	}
	
	public function fetch()
	{
		return $this->result_id = mysqli_query( $this->con, $this->select.$this->where.$this->order_by.$this->limit );
	}
	
	
	public function result($type = false)
	{
		$list = '';
		mysqli_data_seek( $this->result_id , 0);
		if( $type ) {
			while( $s = mysqli_fetch_object($this->result_id) )
			{
				$list[] = $s;	
			}
		}
		else {
			
			while( $s = mysqli_fetch_assoc($this->result_id) )
			{
				$list[] = $s;	
			}
		}
		
		return $list;
	}
	
	public function escape($str)
	{
		if( is_resource( $this->con ) )
		return mysqli_real_escape_string($this->con, htmlentities($str, ENT_QUOTES) );
		else
		return htmlentities($str, ENT_QUOTES);
	}
	
	
	
	
}