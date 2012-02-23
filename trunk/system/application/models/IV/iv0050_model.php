<?php
class IV0050_model extends MY_Model {  
	
    function IV0050_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){

    	$itemLike = ""; $urLike = "";
    	if( array_key_exists('location_code',$conditions) ){
    		$itemLike = " WHERE location_code like '" . $conditions['location_code'] . "%'";	
    	}
    	$query = "	SELECT location_code 
    				FROM INVENTORY_MASTER i" .
					$itemLike
    				. " group by location_code Limit " . $offset . "," . $limit;

		$query = " SELECT x.location_code as location_code,location_name from (" . $query . ") x";
		$query = $query. " join STOCK_LOCATION_MASTER slm on slm.location_code = x.location_code ";
		$query = $query. " order by x.location_code ";
		
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount(){  
    	$query = "	SELECT location_code 
    				FROM INVENTORY_MASTER i 
					group by location_code ";
    	$query = "SELECT COUNT(*) as count FROM (" . $query . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];   
	}	
		
    function getDataDetail($locaCode){
    	$this->db->select('item_code,location_code,current_stock_qty as qty,last_received_date,last_issue_date');
		$this->db->where('location_code',$locaCode);
    	return $this->db->get('INVENTORY_MASTER');    		
	}
}