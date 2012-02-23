<?php
class PP0810_model extends MY_Model {  
	
    function PP0810_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_ROLL_LEDGER';
    	$this->pkId = "id";
    }  
    
    function itemCodeList($con){		
		$sql = "SELECT item_code,item_code as des_item_code 
    			FROM INVENTORY_MASTER i
		 		WHERE i.item_code like '%".$con."%' and delete_flag = 0
		 		and (i.item_code like 'S%' ) and location_code like 'K%'
		 		order by item_code
		 		";
		
		return $this->db->query($sql);
    }
    
    function getJobNo($itemCode){
    	$sql = "SELECT SUBSTR(MAX(job_no),1,2) as seq1 ,SUBSTR(MAX(job_no),4,2) as seq2 
    			FROM JOB_ROLL_LEDGER j
		 		WHERE j.delete_flag = 0 and j.item_code = '" . $itemCode . "'
		 		and YEAR(j.job_date) = YEAR(now()) 
		 		";
		// u$this->db->query($query)->result_array(); 
		// return $result[0]["count"]; 
		return $this->db->query($sql)->result_array();
    }
    
    function searchDuplicate($itemCode,$jobDate){
    	$query = "SELECT COUNT(*) as count FROM 
    				(
    				 SELECT *
    				 FROM JOB_ROLL_LEDGER
    				 WHERE item_code = '".$itemCode."' and job_date = '".$jobDate."'
    				) as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
    }
    
}