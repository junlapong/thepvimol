<?php
class PP0020_model extends MY_Model {  
	
    function PP0020_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "select c.*
    			from (
	    			select b.*,
						CASE when ((b.current_qty + b.plan_qty) - (b.order_qty + b.safty_stock)) > 0 THEN 0
	     					 ELSE abs((b.current_qty + b.plan_qty) - (b.order_qty + b.safty_stock)) END as req_qty
					from(
							select a.item_code, a.req_date
								   ,a.order_qty - IFNULL( ordered_qty, 0) as order_qty
							       ,IFNULL( plan_qty , 0 ) as plan_qty
							       ,IFNULL( current_qty , 0 ) as current_qty
							       ,IFNULL( safty_stock , 0 ) as safty_stock
							from (
								select o.item_code as item_code,
								      DATE_FORMAT(MIN(o.delivery_date),'%Y-%m-%d') as req_date,
								      sum(order_qty) as order_qty,
								      ordered_qty,
								      (SELECT sum(order_qty) - sum(finish_order_qty) as plan_qty FROM JOB_LEDGER j WHERE (order_qty > finish_order_qty) and j.finish_flag = 0 and j.cancel_flag = 0 and j.item_code = o.item_code) as plan_qty,
								      (select sum(current_stock_qty) as current_qty  from INVENTORY_MASTER i where i.item_code = o.item_code) as current_qty,
											(select sum(safty_stock) as safty_stock from INVENTORY_MASTER i where i.item_code = o.item_code) as safty_stock
								from ORDER_LEDGER o
								left join (SELECT d.item_code, sum(i.issue_qty) as ordered_qty
								FROM DELIVERY_LEDGER d
								join ISSUE_LEDGER i on i.order_no = d.delivery_no and i.item_code = d.item_code
								where d.cancel_flag = '0' and d.delete_flag = '0' and i.cancel_flag = '0' and i.delete_flag = '0'
								group by d.item_code) di on di.item_code = o.item_code
								where o.cancel_flag = '0' and delete_flag = '0'
								group by o.item_code
							) a
						) b
					) c
				where req_qty > 0
				order by req_date asc, req_qty desc";
    	
		return $this->db->query($sql);
    }
    
    
    
    
    // Only item that occur in order_ledger
    function getItemCodeList($con){
    	$tmp = "";
    	if($con != null || $con != "")
    	{
    		$tmp = "having o.item_code = '".$con."'";
    	}
    	$sql = "select o.item_code as item_code, 
    				   sum(order_qty) as qty, 
    				   DATE_FORMAT(MIN(o.delivery_date),'%Y-%m-%d') as date
				from ORDER_LEDGER o
				where o.item_code not in (select item_code from JOB_LEDGER) or o.order_no not in (select order_no from JOB_LEDGER)
				group by o.item_code
				".$tmp."
				order by date";
		return $this->db->query($sql);
    }   

    // Only remain order
    function getOrderList($con,$orNo){
    	$tmp = "";
    	if($orNo != null || $orNo != "")
    	{
    		$tmp = " and o.order_no = '".$orNo."'";
    	}
    	
        $sql = "select o.order_no, CONCAT(o.order_no,':',v.trader_short_name) as order_name, o.order_qty as qty
		from ORDER_LEDGER o
		join VENDOR_MASTER v on o.customer_code = v.vendor_code
		where o.item_code = '".$con."' and o.order_no not in ( select order_no from JOB_LEDGER) " . $tmp;
		return $this->db->query($sql);
    }  
    
    function getMaxSeqOrderNo($order){
    	$sql = "SELECT SUBSTR(MAX(order_no),11,2) as seq 
    			FROM ORDER_LEDGER o
		 		WHERE o.order_no like '".$order."%'";

		return $this->db->query($sql);
    }
    
    /*
     * Data for calculate Production
     * get total planning production qty
     */ 
    function getPlanProducQty($con){

    	$sql = "SELECT sum(order_qty) as order_qty , 
    		    sum(finish_order_qty) as finish_qty , 
    		    sum(order_qty) - sum(finish_order_qty) as plan_qty
				FROM JOB_LEDGER j
				WHERE j.cancel_flag = 0 and j.item_code = ?";
				
		return $this->db->query($sql,$con);
    }  

    // Function for finding safty stock and inventory qty
    function getInventoryQty($con){

    	$sql = "select sum(current_stock_qty) as current_qty ,
    				   sum(safty_stock) as safty_stock
				from INVENTORY_MASTER i
				where i.item_code = ?";
				
		return $this->db->query($sql,$con);
    }  
    
    // Function for finding total orderQty from order_ledger
    function getOrderQty($con){

    	$sql = "select sum(o.order_qty) as total_qty
				from ORDER_LEDGER o
				where o.item_code = ?";
				
		return $this->db->query($sql,$con);
    } 
    
    function searchDuplicate($jobNo){
    	$query = "SELECT COUNT(*) as count FROM 
    				(
    				 SELECT *
    				 FROM JOB_LEDGER
    				 WHERE job_no = '".$jobNo."'
    				) as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
    } 
}