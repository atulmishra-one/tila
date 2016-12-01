<?php

class friends_model extends model {
	

		var $sid;
		
		public function __construct($catelog)
		{
			parent::__construct($catelog);
			$this->sid = $_SESSION['userdata']['id'];
		}

		public function areFriends($id)
		{
			$this->db->query("SELECT * FROM friends WHERE  (tid=".$this->sid." and fid=$id) or (fid=".$this->sid." and tid=$id )");
			
			if( $this->db->num_rows() )
			return true;
			else
			return false;
		}
		
		public function hasRequestFromThis($id)
		{
			$this->db->query("SELECT * FROM friends_request WHERE tid=".$this->sid." and fid=$id");
			if( $this->db->num_rows() )
			return true;
			else
			return false;
		}
		
		public function hasRequested($id) {
			
			$this->db->query("SELECT * FROM friends_request WHERE tid=$id and fid=".$this->sid." ");
			if( $this->db->num_rows() )
			return true;
			else
			return false;
		}
		
		public function InsertRequest($id)
		{
			$data = array(
			'tid' => $id,
			'fid' => $this->sid
			);
			
			return $this->db->insert('friends_request', $data);
		}
		
		public function sendRequest($id)
		{
			if( $this->areFriends($id) ) :
			return false ;
			elseif( $this->hasRequestFromThis($id) ):
			return false ;
			elseif( $this->hasRequested($id) ) :
			return false;
			else :
			$this->InsertRequest($id);
			return true;
			endif;
		}
		
		
		
		
		
		
	
}