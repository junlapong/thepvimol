<?php
class PP0061_model extends MY_Model {  
	
    function PP0061_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
    // GET ORDER LIST
    function getJobOrderList($limit,$offset,$conditions){
    	$sql = $this->getJobQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getJobQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getJobQuery($conditions){
    	$sql = "SELECT *
    			FROM JOB_LEDGER j
    			WHERE j.delete_flag = '0'
    			order by SUBSTRING(job_no,8,2) desc ,SUBSTRING(job_no,6,2) desc,SUBSTRING(job_no,2,3) desc
    			";
    	return $sql;		
	}
    
}