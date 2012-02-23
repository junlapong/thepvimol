<?php
class Login_model extends MY_Model
{
	function Login()
	{	
		parent::MY_Model();
	}
	
	function get_user($user) 
	{
		$this->db->where('username', $user);
		$this->db->where('delete_flag', '0');
		return $this->db->get('SYS_USER');
	}

	function check_user($user, $pass)
	{
		$sql = "SELECT COUNT(username) AS hasUser
				  FROM SYS_USER
				 WHERE username = ? 
				   AND password = ?
				   AND delete_flag = 0";

		return $this->db->query($sql, array($user, $pass));
	}

	function get_user_role($user)
	{
		return 'Admin';
	}

	function get_user_groups($user)
	{
		$sql = "SELECT group_code
				  FROM SYS_USERGROUP
				 WHERE username = ? 
				   AND delete_flag = 0";

		return $this->db->query($sql, $user)->result();		
	}
	
	function get_user_menu($user,$groups)
	{
		$i = 0;
		$sqlGroup = "";
		foreach($groups as $group)
		{
			if($i != 0) $sqlGroup .= " OR "; 
			$sqlGroup .= " g.group_code = '" . $group->{'group_code'} . "' ";
			$i++;
		}
		
		$sql = "select sm.*, sp.permission
				from SYS_MENU sm
				join (
       				SELECT ss.menu_code, BIT_OR(ss.permission) as permission
       				FROM (
       						SELECT g.menu_code, g.permission, ''
					        FROM SYS_GROUPMENU g
					        where ".$sqlGroup."
					         and g.permission & (0x4) > 0
					         and g.delete_flag = 0
					        group by g.menu_code
					        union
					        SELECT u.menu_code, u.permission as permission, u.username
					        FROM SYS_USERMENU u
					        where u.username = '".$user."'
					         and u.permission & (0x4) > 0
					         and u.delete_flag = 0
       				) ss
       				group by ss.menu_code
       			)sp on sm.menu_code = sp.menu_code
				where sm.delete_flag = 0
				order by sm.menu_code
				";
//		g.menu_code is null and 
//		echo $sql;
		return $this->db->query($sql)->result();	
	}
		
	function set_last_login($userName)
	{
		$SQL  = "";
		$SQL .= " UPDATE SYS_USER ";
		$SQL .= "    SET last_login = NOW() ";
		$SQL .= "  WHERE username  = '" . $userName . "'";
		
		$query = $this->db->query($SQL);
	}
	
}

// END Login_model class

/* End of file Login_model */
/* Location: application/models/login_model.php */