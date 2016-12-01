<?php

class auth_model extends model {
	
	
	public function login($data) {
		
		$q = $this->db->select('users')
					  ->where( array('username' => $data['u'], 'password' => $data['p']))
					  ->limit(0, 1)
					  ->fetch();
		
		if( $this->db->num_rows() )
		{
			$s = $this->db->result();
			
			$_SESSION['userdata'] = array(
			'id' => $s[0]['id'],
			'token' => md5($s[0]['id'].$data['u'])
			);
			
			//$sets = 
			$this->db->update('users', 
					array(
					'last_login' => date('Y-m-d h:i:s', time() ),
					'ip'         => $_SERVER['REMOTE_ADDR']
					
					),
					
					array('id'=> $s[0]['id'])
					
					);
			return true;
		}
		
		return false;
	}
	
	
	public function register($data)
	{
		$u = trim( str_replace(' ', '', $data['Username'] ) );
		
		$q = $this->db->select('users', 'id')
					  ->where( array('username' => $u) )
					  ->limit(0, 1)
					  ->fetch();
					  
		if( $this->db->num_rows() )
		{
			return 'u';
		}
		else {
			
			$sets1 = array(
			'username' => $this->db->escape($u),
			'password' => $this->db->escape($data['Password']),
			'last_login' => date('Y-m-d h:i:s', time() ),
			'ip'         => $_SERVER['REMOTE_ADDR']
			);
			
			if( $this->db->insert('users', $sets1) )
			{
				$id = $this->db->insert_id();
				$_SESSION['userdata'] = array(
				'id' => $id,
				'token' => md5($id.$u)
				);
				
				$sets2 = array(
				'uid' => $id,
				'sex' => $data['Gender'],
				'birthday' => $data['Birthday'],
				'reg_date' => date('Y-m-d h:i:s', time() )
				);
				
				$this->db->insert('users_details', $sets2);
				
				return 's';
				
			}
			else {
				return 'e';
			}
		}
		
	}
}