<?php
class IV0090_model extends MY_Model {  
	
    function IV0090_model(){  
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
    		$itemLike = " WHERE item_code like '" . $conditions['item_code'] . "%'";	
    	}
    	
    	$query = "	SELECT item_code 
    					 , sum(current_stock_qty)  as qty 
    				FROM INVENTORY_MASTER i "
    				. $itemLike . 
    				" group by item_code";
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

    	$itemLike = "";
    	if( array_key_exists('item_code',$conditions) ){
    		$itemLike = " WHERE item_code = '" . $conditions['item_code'] . "'";	
    	}
    	
    	$query = "	SELECT i.location_code as location_code,location_name,current_stock_qty as qty 
    				FROM INVENTORY_MASTER i 
    				JOIN STOCK_LOCATION_MASTER st ON st.location_code = i.location_code"
    				. $itemLike;
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
    		$itemLike = $itemLike . " and location_code = '" . $conditions['location_code'] . "'";	
    	}
    	    	
    	$query = "	SELECT id,item_code,location_code,lot_no,seq_no,current_stock_qty as qty,current_stock_qty as new_qty 
    				FROM INVENTORY_LOT_MASTER i "
    				. $itemLike .
    				" order by SUBSTRING(lot_no,5,4),SUBSTRING(lot_no,1,4)";
    	return $query;	
    		
	}
	
	function getOldDataAt($id)
	{
		$query = "SELECT id,item_code,location_code,lot_no,seq_no,current_stock_qty as qty,current_stock_qty as new_qty 
				 FROM INVENTORY_LOT_MASTER i 
				 WHERE id = ".$id."
				 ";
    	return $this->db->query($query);   		
	}
	
	function getMAXAR(){
		$this->db->select_max('received_no');
    	$this->db->like('received_no','AR','after');  
    	return $this->db->get('RECEIVE_LEDGER');  
	}

	function insertReceived($data){
		$this->db->insert('RECEIVE_LEDGER', $data); 
	}
	
	function insertInvLot($data){
		$this->db->insert('INVENTORY_LOT_MASTER', $data); 
	}
	
	function getMAXInvLotId(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('INVENTORY_LOT_MASTER');
	}
	
	function getInvAt($item,$location)
	{
		$query = "SELECT id,item_code,location_code,current_stock_qty 
				 FROM INVENTORY_MASTER i 
				 WHERE item_code = '".$item."' and location_code = '".$location."'
				 ";
    	return $this->db->query($query);   		
	}
	
	function updateInvAt($id,$data){
		$data->{'updated_date'} = NULL;
		$data->{'updated_user'} = $this->session->userdata('username');
		$this->db->where('id', $id);
		$this->db->update('INVENTORY_MASTER', $data); 
	}
	
	function updateInvLotAt($id,$data){
		$data->{'updated_date'} = NULL;
		$data->{'updated_user'} = $this->session->userdata('username');
		$this->db->where('id', $id);
		$this->db->update('INVENTORY_LOT_MASTER', $data); 
	}
}