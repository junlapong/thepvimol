<?php
class MT0042_model extends MY_Model {  
	
    function MT0042_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'STOCK_LOCATION_MASTER';
    	$this->pkId = "location_code";
    }  
		
    function getDataDetail($param){
		$sql = " SELECT i.id,i.item_code,i.location_code,l.location_name
				 FROM INVENTORY_MASTER i
				 join STOCK_LOCATION_MASTER l on i.location_code = l.location_code 
				 WHERE i.location_code = '".$param."'";
    	
 		return $this->db->query($sql);   	
	}

	function getLocationList($user){
		$sql = "select i.item_code, i.item_short_name
				FROM ITEM_MASTER i
				left join INVENTORY_MASTER iv on iv.item_code = i.item_code and iv.location_code = ?
				where iv.item_code is null and i.delete_flag = '0'";
		return $this->db->query($sql, $user);
	}	
	
	
    function getRowCountD($param){  
		$sql = " SELECT count(i.item_code) as count
				 FROM INVENTORY_MASTER i
				 join STOCK_LOCATION_MASTER l on i.location_code = l.location_code 
				 WHERE i.location_code = '".$param."'";
    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];  
	}	
	
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('INVENTORY_MASTER');
	}

	
    function getDataDAt($id){
		$sql = " SELECT i.id,i.item_code,i.location_code,l.location_name
				 FROM INVENTORY_MASTER i
				 join STOCK_LOCATION_MASTER l on i.location_code = l.location_code 
				 WHERE i.id = '".$id."'";
    	
 		return $this->db->query($sql); 
	} 
	
	function insertDRow($data){
		$this->db->insert('INVENTORY_MASTER', $data); 
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