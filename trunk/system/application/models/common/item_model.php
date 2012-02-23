<?php
class Item_model extends Model {  

	function Item_model()
	{	
		parent::Model();
	}

	function getCount($sql){
		$sql = "SELECT count(*) as count FROM ( ".$sql.") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"]; 		
	}
	
	function getListNoLimit($sql){
    	$sql = $sql; //."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}

	function getListLimit($sql,$offset,$limit){
    	$sql = $sql."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}
		
	function getItemCodeSQL($itemCode){
		if($itemCode != null && $itemCode != ""){
    		$tmp = " and item_code like '%" . $itemCode . "%' ";
    	}else{
    		$tmp = "";
    	}		
		
    	$sql = "	SELECT i.item_code as item_code
    					 , i.item_code as des_item_code
    					 , CONCAT( i.item_code,':',i.item_name) as item_name
        			FROM ITEM_MASTER i
        			WHERE i.delete_flag = '0' " . $tmp;
    	return $sql;
	}
	
	function getPurchaseItemSQL(){
    	$sql = "	SELECT i.item_code as item_code
    					 , CONCAT( i.item_code,':',i.item_name) as item_name
        			FROM ITEM_MASTER i
        			WHERE i.delete_flag = '0' and purchase_flag = '1'";
    	return $sql;
	}

	function getRequestPurchaseItemByVendorSQL($vendorCode,$itemCode){
		
		// If send ItemCode
     	if($itemCode != null && $itemCode != ""){
    		$tmp = " and item_code like '%" . $itemCode . "%' ";
    	}else{
    		$tmp = "";
    	}		
    	
    	$sql = "SELECT  vendor_code
						,a.item_code
						,order_qty
						,ppm.price
						,ppm.step1_discount_rate
				FROM (
						select item_code
							, sum(order_qty) as order_qty
						from PURCHASE_REQUEST_LEDGER pr
						where approved_flag = 1 ".$tmp." and delete_flag = 0 and cancel_flag = 0 and finished_flag = 0 and (po_no = '' OR po_no is null)
						group by item_code ) a
				JOIN 
					(
						SELECT *
						FROM PURCHASE_PRICE_MASTER y
						where delete_flag = 0
							and cancel_flag = 0 
							".$tmp."
							and approved_flag = 1 
							and vendor_code = '".$vendorCode."'
							and CURRENT_DATE() BETWEEN start_date and end_date
							and start_date = (select max(start_date) 
												from PURCHASE_PRICE_MASTER 
												where vendor_code = y.vendor_code 
													".$tmp."
													and vendor_code = '".$vendorCode."'
													and item_code = y.item_code 
											group by vendor_code,item_code) 
					) ppm ON ppm.item_code = a.item_code"; 

    	$sql = $sql . "  order by a.item_code";
    	return $sql;
	}    
}