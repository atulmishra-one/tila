<?php

class main_model extends model {
	
	public function setMood($data)
	{
		$msg =  $this->db->escape($data['status']);
		
		$sets = array(
		'mood' => $msg
		);
		
		if( $this->db->update('users_details', $sets, array('uid' => $_SESSION['userdata']['id'])) )
		return true;
		else 
		return false;
	}
	public function getMood()
	{/*
		$q =  $this->db->select('users_details')
					   ->where( array('uid' => $room))
					   ->order_by('timesent desc')
					   ->limit(0, 16)
					   ->fetch();
		if( $this->db->num_rows() )
		return $this->db->result();
		else
		return array();*/
	}
}