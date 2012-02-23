<?php
class IV0101_model extends MY_Model {  
	
    function IV0101_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ISSUE_LEDGER';
    	$this->pkId = "id";
    }  
    
    function itemCodeList($con,$notlike){
    	if( $notlike != "")
    	{
    		$option = " and i.item_code <> '".$notlike."'";
    	}else{
    		$option = "";
    	}
    	$special_op = "";
    	if(strpos($con,'FT001') !== false)
    		$special_op = " or item_code like 'TW%PL6%' ";
    	if(strpos($con,'PL6') !== false)
    		$special_op = " or item_code like 'TW%FT001%' ";
    	if(strpos($con,'610') !== false)
    		$special_op = " or item_code like 'TW%PL4%' ";
    	if(strpos($con,'PL4') !== false)
    		$special_op = " or item_code like 'TW%610%' ";
    		    		
        $sql = "SELECT item_code,item_code as des_item_code
		    	FROM ITEM_MASTER i
		    	WHERE i.item_code like '%" . $con . "%'
		    		".$special_op.$option."
		    	";
    
		return $this->db->query($sql);
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
    	    	
    	$query = "	SELECT lot_no,seq_no,current_stock_qty as qty 
    				FROM INVENTORY_LOT_MASTER i "
    				. $itemLike .
    				" order by SUBSTRING(lot_no,5,4),SUBSTRING(lot_no,1,4)";
    	return $query;	
	}
	
	function getMAXTR(){
		$this->db->select_max('received_no');
    	$this->db->like('received_no','TR','after');  
    	return $this->db->get("RECEIVE_LEDGER");  
	}
	
	function insertIssue($data){
		$this->db->insert('ISSUE_LEDGER', $data); 
	}
	
	function insertReceived($data){
		$this->db->insert('RECEIVE_LEDGER', $data); 
	}
	
	function getInvAt($item,$location)
	{
		$query = "SELECT id,item_code,location_code,current_stock_qty 
				 FROM INVENTORY_MASTER i 
				 WHERE item_code = '".$item."' and location_code = '".$location."'
				 ";
    	return $this->db->query($query);   		
	}
	
	function getInvLotAt($item,$location,$lot,$seq)
	{
		$query = "SELECT id,item_code,location_code,current_stock_qty 
				 FROM INVENTORY_LOT_MASTER i 
				 WHERE item_code = '".$item."' and location_code = '".$location."'
				 	and lot_no = '".$lot."' and seq_no = '".$seq."'
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
	
    function getRecordCount($item,$loca,$lot,$seq){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		return $this->db->count_all_results('INVENTORY_LOT_MASTER');   
    } 
    
	function insertLotInv($data){
		$this->db->insert('INVENTORY_LOT_MASTER', $data); 
	}
}