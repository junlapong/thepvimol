<?php
class PP0063_model extends MY_Model {  
	
    function PP0063_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SCREEN_LEDGER';
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
    			FROM SCREEN_LEDGER j
    			WHERE j.delete_flag = '0'
    			order by SUBSTRING(screen_no,5,4) desc,SUBSTRING(screen_no,1,4) desc
    			";
    	return $sql;		
	}
    
}