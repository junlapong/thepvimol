<?php
class PP0050_model extends MY_Model {  
	
    function PP0050_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
    
    function getMaxSeqOrderNo($order){
    	$sql = "SELECT SUBSTR(MAX(order_no),11,2) as seq 
    			FROM ORDER_LEDGER o
		 		WHERE o.order_no like '".$order."%'";

		return $this->db->query($sql);
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