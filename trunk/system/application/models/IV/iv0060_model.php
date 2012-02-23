<?php
class IV0060_model extends MY_Model {  
	
    function IV0060_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){

    	$itemLike = ""; $urLike = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemLike = " WHERE item_code like '%" . $conditions['item_code'] . "%'";	
    	}
    	$query = "	SELECT item_code 
    				, sum(current_stock_qty)  as t_qty 
    				, IFNULL((SELECT sum(current_stock_qty) FROM INVENTORY_MASTER WHERE item_code = i.item_code and location_code not like 'K%'),0) as b_qty
    				, IFNULL((SELECT sum(current_stock_qty) FROM INVENTORY_MASTER WHERE item_code = i.item_code and location_code like 'K%'),0) as k_qty
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
		
    function getDataDetail($itemCode,$locaCode){
		$locaWhere = " ";
    	if($locaCode != null)
    	{
			$locaWhere = " and location_code = '" . $locaCode . "'";	    		
    	}
    	
    	$query = "SELECT '*' as ri_no 
    					  ,item_code as item_code
    				      ,location_code as location_code 
    				      ,'0000-00-00' as ri_date 
    				      ,'0' as received_qty 
    				      ,'0' as issue_qty 
    				 FROM INVENTORY_MASTER im
					 WHERE item_code = '" . $itemCode . "'  ". $locaWhere ."


					 UNION
					 SELECT received_no as ri_no
						  ,item_code as item_code 
						  , location_code as location_code 
						  ,received_date as ri_date 
						  , sum(received_qty) as received_qty
						  , '0' as issue_qty 
					 FROM RECEIVE_LEDGER r
					 WHERE item_code = '" . $itemCode . "'  and cancel_flag = 0 and delete_flag = 0
					 ". $locaWhere ."
					 GROUP BY received_no,item_code, location_code, received_date
					 UNION
					 SELECT issue_no as ri_no 
					 	  ,item_code as item_code 
					 	  ,location_code as location_code 
					 	  ,issue_date as ri_date 
					 	  ,'0' as received_qty
					 	  ,sum(issue_qty) as issue_qty 
					 FROM ISSUE_LEDGER i
					 WHERE item_code = '" . $itemCode . "' and cancel_flag = 0 and delete_flag = 0
					 ". $locaWhere ."
					 GROUP BY issue_no, item_code, location_code, issue_date 
					 order by ri_date,ri_no desc;
					     	";

    	return $this->db->query($query);     	
	}
}