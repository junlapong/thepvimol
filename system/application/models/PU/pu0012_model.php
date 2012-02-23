<?php
class PU0012_model extends MY_Model {  
	
    function PU0012_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'PURCHASE_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getMaxSeqOrderNo(){
    	$sql = "SELECT SUBSTR(MAX(po_no),3,8) as seq 
    			FROM PURCHASE_LEDGER o";

		return $this->db->query($sql);
    }
    
    function viewPRItem($limit,$offset){
    	$sql = $this->getViewPRItem()."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function viewPRItemCount(){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getViewPRItem().") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getViewPRItem(){
    	$sql = "select item_code
						, (select item_name from ITEM_MASTER where item_code = pr.item_code) as item_name 
						, sum(order_qty) as order_qty
						, count(pr_no) as pr_count
				from PURCHASE_REQUEST_LEDGER pr
				where approved_flag = 1 and delete_flag = 0 and cancel_flag = 0 and finished_flag = 0 and (po_no = '' OR po_no is null)
				group by item_code
    			";
    	return $sql;		
	}
	
	function updatePrByPo($po,$date,$itemCode)
	{
		$sql = "update PURCHASE_REQUEST_LEDGER
				set po_no = '".$po."', order_date = '".$date."'
				where item_code = '".$itemCode."' 
					and (po_no = '' OR po_no is null) 
					and approved_flag = 1 
					and finished_flag = 0
					and cancel_flag = 0
					and delete_flag = 0
					";
		$this->db->query($sql);
	}

    function viewVendor($limit,$offset,$item){
    	$sql = $this->getViewVendor($item); //."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function viewVendorCount($item){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getViewVendor($item).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getViewVendor($item){
    	$sql = "select vendor_code
							,( select trader_name from VENDOR_MASTER where vendor_code = y.vendor_code ) as vendor_name
							,price as price_qty
							,unit
							,CONCAT(step1_discount_rate,'%')
							,CONCAT(step2_discount_rate,'%')
				from PURCHASE_PRICE_MASTER y
				where delete_flag = 0
					and cancel_flag = 0 
					and approved_flag = 1 
					and item_code like '".$item."'
					and CURRENT_DATE() BETWEEN start_date and end_date
					and start_date = (select max(start_date) 
															from PURCHASE_PRICE_MASTER 
															where vendor_code = y.vendor_code 
																and item_code = y.item_code 
														group by vendor_code,item_code)
    			";
    	return $sql;		
	}

   function getCustomerList($con){
    	
    	$sql = "SELECT *
				FROM (
				SELECT vendor_code
							,CONCAT( ppm.vendor_code,':',(select trader_name from VENDOR_MASTER where vendor_code = ppm.vendor_code )) as vendor_name
				FROM (
						select item_code
						from PURCHASE_REQUEST_LEDGER pr
						where approved_flag = 1 and delete_flag = 0 and cancel_flag = 0 and finished_flag = 0 and (po_no = '' OR po_no is null)
						group by item_code ) a
				JOIN 
					(
						SELECT *
						FROM PURCHASE_PRICE_MASTER y
						where delete_flag = 0
							and cancel_flag = 0 
							and approved_flag = 1 
							and CURRENT_DATE() BETWEEN start_date and end_date
							and start_date = (select max(start_date) 
																	from PURCHASE_PRICE_MASTER 
																	where vendor_code = y.vendor_code 
																		and item_code = y.item_code 
																group by vendor_code,item_code) 
					) ppm ON ppm.item_code = a.item_code
				GROUP BY vendor_code
				) x";

    	if($con != null && $con != ""){
    		$sql = $sql . " WHERE vendor_name like '%" . $con . "%' ";
    	}	

    	return $this->db->query($sql);
    }
    
}