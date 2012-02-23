<?php
class RP0010_model extends MY_Model {  
	
    function RP0010_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  

	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
    
    function getProductionResultList($limit,$offset,$conditions){
    	$sql = $this->getQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }

	function getQuery($conditions){
		$tmp = "";

		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $key != 'order_status_v' && $value != ''){
			
				$tmp = $value;

			}

		}
    	$sql = "select (SELECT trader_short_name FROM VENDOR_MASTER where vendor_code = o.customer_code) as customer_name
    				  ,(SELECT delivery_name FROM DELIVERY_MASTER where delivery_code = o.delivery_code) as customer_deli
				      ,item_code
				      ,order_qty
				      ,DATE_FORMAT(delivery_date,'%Y-%m-%d') as delivery_date
				      ,po_no
				      ,ref_doc
				from ORDER_LEDGER o
				where delete_flag = 0 and cancel_flag = 0
				   and DATE_FORMAT(Date(created_date),'%Y-%m-%d') = Date_format(Date('".$tmp."'),'%Y-%m-%d') 
				order by customer_code 
    			";
    	return $sql;		
	}
	
	function getOrderDateCombo(){
    	$sql = "select  DATE_FORMAT(order_date,'%Y-%m-%d') as order_date
				from ORDER_LEDGER
				where delete_flag = 0 and cancel_flag = 0
				group by order_date
				order by order_date desc
    			";
    	return $this->db->query($sql);		
	}
}