<?php
class MA0060_model extends MY_Model {  
	
    function MA0060_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_GROUP';
    	$this->pkId = "group_code";
    }  
		
    function getDataDetail($param){
    	//$this->db->select('id,group_code');
		$this->db->where('group_code',$param);
		$this->db->order_by('menu_code','asc');
    	return $this->db->get('SYS_GROUPMENU');    		
	}

	function getGroupList($param){
		$sql = "SELECT a.menu_code as menu_code
				FROM SYS_MENU a
				LEFT JOIN SYS_GROUPMENU b ON a.menu_code = b.menu_code and b.group_code = ?
				WHERE b.menu_code is null and a.delete_flag = '0'
				ORDER BY a.menu_code asc";
		return $this->db->query($sql, $param);
	}	
	
	
    function getRowCountD(){  
    	return $this->db->count_all_results('SYS_GROUPMENU');  
	}	
	
	function getAllDataD(){  
    	return $this->db->get('SYS_GROUPMENU');  
	}
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('SYS_GROUPMENU');
	}

    function getDataDLimit($limit,$offset,$conditions){
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != '')
				$this->db->like($key,$value,'after');  
		}
    	
    	return $this->db->get('SYS_GROUPMENU',$limit,$offset);  
	}
	
    function getDataDAt($id){
		$this->db->flush_cache();
    	$this->db->where('id',$id);  
    	return $this->db->get('SYS_GROUPMENU');  
	} 
	
	function insertDRow($data){
		$this->db->insert('SYS_GROUPMENU', $data); 
	}
	
	function deleteDAt($id){
		$this->db->where('id', $id);
		$this->db->delete('SYS_GROUPMENU'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('SYS_GROUPMENU', $data); 
	}	
	
	
}