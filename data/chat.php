<?php

class chat_model extends model {
	
	public function send($data)
	{
		$msg =  $this->db->escape($data['msg']);
		
		$sets = array(
		'chatter_id' => $_SESSION['userdata']['id'],
		'msg' => $msg,
		'room' => $data['room'] 
		);
		
		if( $this->db->insert('chat', $sets) )
		return true;
		else 
		return false;
	}
	public function get($room)
	{
		$q =  $this->db->select('chat')
					   ->where( array('room' => $room))
					   ->order_by('timesent desc')
					   ->limit(0, 16)
					   ->fetch();
		if( $this->db->num_rows() )
		return $this->db->result();
		else
		return array();
	}
}






