<?php
class MA0050_model extends MY_Model {  
	
    function MA0050_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_USER';
    	$this->pkId = "username";
    }  
		
    function getDataDetail($param){
    	//$this->db->select('id,group_code');
		$this->db->where('username',$param);
		$this->db->order_by('menu_code','asc');
    	return $this->db->get('SYS_USERMENU');    		
	}

	function getGroupList($user){
		$sql = "SELECT a.menu_code as menu_code
				FROM SYS_MENU a
				LEFT JOIN SYS_USERMENU b ON a.menu_code = b.menu_code and b.username = ?
				WHERE b.menu_code is null and a.delete_flag = '0'
				ORDER BY a.menu_code asc";
		return $this->db->query($sql, $user);
	}	
	
	
    function getRowCountD(){  
    	return $this->db->count_all_results('SYS_USERMENU');  
	}	
	
	function getAllDataD(){  
    	return $this->db->get('SYS_USERMENU');  
	}
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('SYS_USERMENU');
	}

    function getDataDLimit($limit,$offset,$conditions){
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != '')
				$this->db->like($key,$value,'after');  
		}
    	
    	return $this->db->get('SYS_USERMENU',$limit,$offset);  
	}
	
    function getDataDAt($id){
		$this->db->flush_cache();
    	$this->db->where('id',$id);  
    	return $this->db->get('SYS_USERMENU');  
	} 
	
	function insertDRow($data){
		$this->db->insert('SYS_USERMENU', $data); 
	}
	
	function deleteDAt($id){
		$this->db->where('id', $id);
		$this->db->delete('SYS_USERMENU'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('SYS_USERMENU', $data); 
	}	
	
	
}