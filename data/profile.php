<?php

class profile_model extends model {
	
	
	function getCountry($ip = false)
	{
		$q = $this->db->query("SELECT 
	            c.country ,
				c.iso_code_2
	        FROM 
	            ip2nationCountries c,
	            ip2nation i 
	        WHERE 
	            i.ip < INET_ATON('$ip') 
	            AND 
	            c.code = i.country 
	        ORDER BY 
	            i.ip DESC 
	        LIMIT 0,1");
			 
			 if( $this->db->num_rows() )
			return array_pop($this->db->result());
	}
	
	function update_profile_pic()
	{
		$config = $this->catelog->get('config_item');
		include $config['base_path'].'inc/SimpleImage.php';
		
		$allowed = array(
		'image/jpg',
		'image/jpeg',
		'image/png',
		'image/gif'
		);
		
		if( in_array($_FILES['img']['type'], $allowed) ) {
			
			
			$q = $this->db->query("SELECT profile_pic FROM users_details WHERE uid='".$_SESSION['userdata']['id']."'");
			
			if( $this->db->num_rows() )
			{
				$img = $this->db->result();
				
				if(file_exists($config['base_path'].'uploads/profile_pic/'.$img[0]['profie_pic'])) {
						chmod( $config['base_path'].'uploads', 0777);
						chmod( $config['base_path'].'uploads/profile_pic', 0777);
						@unlink(	$config['base_path'].'uploads/profile_pic/'.$img[0]['profie_pic'] );
				}
			}
			
			
			$image = new SimpleImage();
			$image->load($_FILES['img']['tmp_name']);
			$image->resize(180,210);
            $image->save('./uploads/profile_pic/'.$_SESSION['userdata']['id'].'_'.$_FILES['img']['name']);
			$image->resize(60,60);
			$image->save('./uploads/profile_pic/thumb/'.$_SESSION['userdata']['id'].'_'.$_FILES['img']['name']);
			
			
			$data = array(
			'profile_pic' => $_SESSION['userdata']['id'].'_'.$_FILES['img']['name']
			);
			
			$this->db->update('users_details', $data, array('uid'=> $_SESSION['userdata']['id']) );
			
			
			
			return true;
		}
		else {
			return false;
		}
		
		
	}
	
}














