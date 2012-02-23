<?php
class SL0030_model extends MY_Model {  
	
    function SL0030_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ORDER_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getMaxSeqOrderNo($order){
    	$sql = "SELECT SUBSTR(MAX(order_no),11,2) as seq 
    			FROM ORDER_LEDGER o
		 		WHERE o.order_no like '".$order."%'";

		return $this->db->query($sql);
    }
}