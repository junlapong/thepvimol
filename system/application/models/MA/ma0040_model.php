<?php
class MA0040_model extends MY_Model {  
	
    function MA0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_USER';
    	$this->pkId = "username";
    }  
		
    function getDataDetail($param){
    	//$this->db->select('id,group_code');
		$this->db->where('username',$param);
    	return $this->db->get('SYS_USERGROUP');    		
	}

	function getGroupList($user){
		$sql = "select a.group_code as group_code
				from SYS_GROUP a
				Left join SYS_USERGROUP b on a.group_code = b.group_code and b.username = ?
				where b.group_code is null and a.delete_flag = '0'
				";
		return $this->db->query($sql, $user);
	}	
	
	
    function getRowCountD(){  
    	return $this->db->count_all_results('SYS_USERGROUP');  
	}	
	
	function getAllDataD(){  
    	return $this->db->get('SYS_USERGROUP');  
	}
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('SYS_USERGROUP');
	}

    function getDataDLimit($limit,$offset,$conditions){
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != '')
				$this->db->like($key,$value,'after');  
		}
    	
    	return $this->db->get('SYS_USERGROUP',$limit,$offset);  
	}
	
    function getDataDAt($id){
		$this->db->flush_cache();
    	$this->db->where('id',$id);  
    	return $this->db->get('SYS_USERGROUP');  
	} 
	
	function insertDRow($data){
		$this->db->insert('SYS_USERGROUP', $data); 
	}
	
	function deleteDAt($id){
		$this->db->where('id', $id);
		$this->db->delete('SYS_USERGROUP'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('SYS_USERGROUP', $data); 
	}	
	
	
}