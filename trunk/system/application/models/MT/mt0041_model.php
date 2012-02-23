<?php
class MT0041_model extends MY_Model {  
	
    function MT0041_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ITEM_MASTER';
    	$this->pkId = "item_code";
    }  
		
    function getDataDetail($param){
		$sql = " SELECT i.id,i.item_code,i.location_code,l.location_name
				 FROM INVENTORY_MASTER i
				 join STOCK_LOCATION_MASTER l on i.location_code = l.location_code 
				 WHERE i.item_code = '".$param."'";
    	
 		return $this->db->query($sql);   	
	}

	function getLocationList($user){
		$sql = "select l.location_code, l.location_name
				from STOCK_LOCATION_MASTER l
				left join INVENTORY_MASTER i on i.location_code = l.location_code and i.item_code = ?
				where i.location_code is null and l.delete_flag = '0'
				";
		return $this->db->query($sql, $user);
	}	
	
	
    function getRowCountD($param){  
		$sql = " SELECT count(i.item_code) as count
				 FROM INVENTORY_MASTER i
				 join STOCK_LOCATION_MASTER l on i.location_code = l.location_code 
				 WHERE i.item_code = '".$param."'";
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
		$this->db->delete('INVENTORY_MASTER'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('INVENTORY_MASTER', $data); 
	}	
	
	
}