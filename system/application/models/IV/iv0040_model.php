<?php
class IV0040_model extends MY_Model {  
	
    function IV0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){

    	$itemLike = ""; $urLike = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemLike = " WHERE item_code like '" . $conditions['item_code'] . "%'";	
    	}
    	$query = "	SELECT item_code 
    				, sum(current_stock_qty)  as qty 
    				FROM INVENTORY_MASTER i" .
					$itemLike
    				. " group by item_code Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount(){  
    	$query = "	SELECT item_code 
    				FROM INVENTORY_MASTER i 
					group by item_code ";
    	$query = "SELECT COUNT(*) as count FROM (" . $query . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];   
	}	
		
    function getDataDetail($itemCode){
    	$this->db->select('item_code,location_name,current_stock_qty as qty,last_received_date,last_issue_date');
    	$this->db->from('INVENTORY_MASTER');
		$this->db->join('STOCK_LOCATION_MASTER','INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
    	$this->db->where('item_code',$itemCode);
    	return $this->db->get();    		
	}
}