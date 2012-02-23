<?php
class PP0801_model extends MY_Model {  
	
    function PP0801_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_KORAT_LEDGER';
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
    			FROM JOB_KORAT_LEDGER j
    			WHERE j.delete_flag = '0'
    			order by id desc
    			";
    	return $sql;		
	}
    
}