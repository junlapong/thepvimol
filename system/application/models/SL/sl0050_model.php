<?php
class SL0050_model extends MY_Model {  
	
    function SL0050_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ITEM_MASTER';
    	$this->pkId = "item_code";
    }
      
   function getSaleCodeList($con){
     	$query = "	SELECT sale_code,
					       CONCAT(sale_code,':',nickname) as sale_name
					FROM SALEMAN_MASTER s
					WHERE s.delete_flag = 0 ";
    	return $this->db->query($query); 
    }
    
	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
    function getDataLimit($limit,$offset,$conditions){
    	$sql = $this->getQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
	}
	
	function getQuery($conditions){
		$sale = "";
		$start = "";
		$end = "";
		foreach($conditions as $key=>$value){
			if($key == 'sale_code')
				$sale = $value;
			if($key == 'start_issue_date')
				$start = $value;
			if($key == 'end_issue_date')
				$end = $value;
			

		}
		
    	$sql = "SELECT @row := @row + 1 as id, z.*
    			FROM(
    			SELECT o.order_no
				      ,o.customer_code
				      , ( select trader_name from VENDOR_MASTER where vendor_code = o.customer_code ) as vendor_name
				      ,(select sale_code from SALEMAN_CUSTOMER_MASTER where vendor_code = o.customer_code) as sale_code
				      ,o.item_code
				      ,order_qty
				      ,delivery_qty
				      ,issue_qty as r_issue_qty
				      ,order_date
				      ,issue_date
							,ref_doc_no
							,ref_doc
							,sale_price as sale_price_qty
							,discount1 as discount_qty
							,(order_qty * (sale_price - (sale_price * discount1 / 100))) as total_price_qty
				FROM ( select order_no,item_code,order_qty,customer_code,order_date,sale_price,discount1
							 from ORDER_LEDGER
							 where cancel_flag = 0 and delete_flag = 0
							) o
				JOIN ( SELECT order_no,d.item_code,sum(delivery_qty) as delivery_qty,sum(IFNULL(issue_qty,0)) as issue_qty, issue_date,ref_doc_no,ref_doc
										FROM ( select delivery_no, order_no ,item_code , order_qty as delivery_qty,ref_doc
													 from DELIVERY_LEDGER 
													 where cancel_flag = 0 and delete_flag = 0
													) d 
										JOIN ( select order_no as delivery_no,item_code,sum(issue_qty) as issue_qty,issue_date,ref_doc_no
																from ISSUE_LEDGER 
																where order_no <> '0000000000' and delete_flag = 0 and cancel_flag = 0
																and issue_date between '".$start."' and '".$end."'
																group by order_no,item_code
															) i
										ON i.delivery_no = d.delivery_no and d.item_code = i.item_code
										group by order_no,item_code
										) x
				ON x.order_no = o.order_no and x.item_code = o.item_code
				-- group by ref_doc
				having sale_code = '".$sale."'
				ORDER BY ref_doc
				) z, (SELECT @row := 0) r
    			";
    	return $sql;		
	}
}