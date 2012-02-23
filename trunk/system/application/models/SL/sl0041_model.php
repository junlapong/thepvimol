<?php
class SL0041_model extends MY_Model {  
	
    function SL0041_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'PAYMENT_LEDGER';
    	$this->pkId = "id";
    }  
 
    // Overrider function
    function getDataLimit($limit,$offset,$conditions){
		$query = $this->getInvList($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount($limit,$offset,$conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getInvList($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
	
    // GET ORDER LIST
    function getInvList(){
    	$sql = "SELECT a.ref_doc as inv_no
						,o.order_no
						,a.delivery_date as order_date
						,sum( a.order_qty * ( sale_price - ( sale_price * discount1 /100 ) ) ) as sale_price
						,o.customer_code
						,(select trader_short_name from VENDOR_MASTER where vendor_code = o.customer_code) as customer_name 
						,(select (select nickname from SALEMAN_MASTER where sale_code = x.sale_code) from SALEMAN_CUSTOMER_MASTER x where x.vendor_code = o.customer_code) as sale_name
				FROM (
							 select d.order_no,d.delivery_no,d.item_code,d.ref_doc,d.order_qty,d.delivery_date
							 from DELIVERY_LEDGER d
							 where d.cancel_flag = 0 and d.delete_flag = 0 and payment_flag = 0 and issue_flag = 1
				) a
				JOIN (SELECT * FROM ORDER_LEDGER where cancel_flag = 0 and delete_flag = 0 and sale_condition <> '-1') o ON o.order_no = a.order_no and o.item_code = a.item_code
				group by a.ref_doc,a.order_no
				order by o.customer_code,a.ref_doc";
    	
		return $sql;
    }
    
    // Data verified
	function getRecordCount($orderNo,$invNo){  

    	$query = "SELECT COUNT(*) as count FROM 
    				(
    				 SELECT *
    				 FROM PAYMENT_LEDGER
    				 WHERE order_no = '".$orderNo."' and inv_no = '".$invNo."'
    				) as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
	
    function updatePaymentFlag($invNo,$arr){
		$this->db->where('ref_doc',$invNo);
    	$this->db->update('DELIVERY_LEDGER', $arr); 
    }    
 
}