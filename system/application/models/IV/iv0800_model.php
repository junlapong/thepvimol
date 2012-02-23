<?php
class IV0800_model extends MY_Model {  
	
    function IV0800_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){
		$query = $this->getItemCodeListQuery($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount($limit,$offset,$conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getItemCodeListQuery($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
	
	function getItemCodeListQuery($conditions){

    	$itemLike = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemLike = " and item_code like '" . $conditions['item_code'] . "%'";	
    	}
    	
    	$query = "	SELECT item_code 
    					 , sum(current_stock_qty) as qty 
    				FROM INVENTORY_MASTER i 
    				WHERE delete_flag = '0' and location_code like 'K%' "
    				. $itemLike . 
    				"group by item_code";
    	return $query;	
    		
	}
		
    function getDataDetail($limit,$offset,$conditions){
		$query = $this->getLocationListQuery($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);   		
	}
	
    // Overrider function
	function getDataDetailCount($limit,$offset,$conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getLocationListQuery($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
		
	function getLocationListQuery($conditions){

    	$lotNo = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemCode =  $conditions['item_code'] ;	
    	}
    	
	    if( array_key_exists('lot_no',$conditions) ){
    		$lotNo =  $conditions['lot_no'] ;	
    	}
    				
		$locaWhere = " ";
		$locaCode = "K%";
    	if($locaCode != null)
    	{
			$locaWhere = " and location_code like '" . $locaCode . "'";	    		
    	}
    	
    	$query = "	SELECT '*' as ri_no 
    					  ,item_code as item_code
    				      ,location_code as location_code 
    				      ,'0000-00-00' as ri_date 
    				      ,start_stock_qty as received_qty 
    				      ,'0' as issue_qty 
    				 FROM INVENTORY_MASTER im
					 WHERE item_code = '" . $itemCode . "'
					 ". $locaWhere ."
					 UNION
					 SELECT received_no as ri_no
						  ,item_code as item_code 
						  , location_code as location_code 
						  ,received_date as ri_date 
						  , sum(received_qty) as received_qty
						  , '0' as issue_qty 
					 FROM RECEIVE_LEDGER r
					 WHERE item_code = '" . $itemCode . "' and lot_no = '".$lotNo."'
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
					 WHERE item_code = '" . $itemCode . "' and lot_no = '".$lotNo."'
					 ". $locaWhere ."
					 GROUP BY issue_no, item_code, location_code, issue_date
					 order by ri_date,ri_no desc";
    				
    	//echo $query;			
    	return $query;	
    		
	}
	
    function getLot($limit,$offset,$conditions){
		$query = $this->getLotQuery($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);   		
	}
	
    // Overrider function
	function getLotCount($limit,$offset,$conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getLotQuery($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
		
	function getLotQuery($conditions){

    	$itemLike = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemLike = " WHERE item_code = '" . $conditions['item_code'] . "'";	
    	}
	    if( array_key_exists('location_code',$conditions) ){
    		$itemLike = $itemLike . " and location_code like '" . $conditions['location_code'] . "'";	
    	}
    	    	
    	$query = "	SELECT lot_no,seq_no,current_stock_qty as qty 
    				FROM INVENTORY_LOT_MASTER i "
    				. $itemLike .
    				" order by SUBSTRING(lot_no,5,4),SUBSTRING(lot_no,1,4)";
    	return $query;	
    		
	}
}