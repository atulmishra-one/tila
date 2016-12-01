<?php

class common_model extends model {
	
	var $config;
	
	public function getUserById($id)
	{	
		$q = $this->db->query("SELECT * FROM users as u 
								INNER JOIN users_details as u1
								ON u.id=u1.uid WHERE u.id=$id");
					  
		return $this->db->result();
		
	}
	
	public function peopleYouMayknow($id)
	{
		
		$q = $this->db->query("SELECT * FROM users as u 
								INNER JOIN users_details as u1
								ON u.id=u1.uid WHERE u.id != $id ORDER BY rand() LIMIT 4");
								
		foreach( $this->db->result() as $r )
		{
			$list[] = array(
			'id' => $r['id'],
			'pic' => $this->profilePic($r['id']),
			'name' => $this->getName($r['id'])
			);
		}
		
		return $list;
	}
	
	function profilePic($id)
	{
		$this->config = $this->catelog->get('config_item');
		
		$info = $this->getUserById($id);
		
		if( empty( $info[0]['profile_pic'] ) ) {
			$sex = ( $info[0]['sex'] == 'F') ? 'female48': 'male48';
			return $info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'images/'.$sex.'.png" />';
		}
		else {
			return $info[0]['profile_pic'] = '<img src="'.$this->config['base_url'].'uploads/profile_pic/'.$info[0]['profile_pic'].'" />';
		}
		
	} //
	
	function insert_notification($msg, $to)
	{
		$data = array(
		'uid' => $_SESSION['userdata']['id'],
		'notify_msg' => $this->db->escape( $msg ),
		'notify_to' => $to,
		'time_r' => date('Y-m-d h:i:s', time() )
		);
		
		$this->db->insert('notifications', $data);
	}
	
	function getName($id)
	{
		$info = $this->getUserById($id);
		
		if( empty( $info[0]['name'] ) )
		return $info[0]['username'];
		else
		return $info[0]['name'];
    }
	
	
	function getGender($id)
	{
		$info = $this->getUserById($id);
		
		return ($info[0]['sex'] === 'M')? 'Male': 'Female';
	}
	
   

	
	
	
	
	
	
	
	
	
	
	
}