<?php
class PP0820_model extends MY_Model {  
	
    function PP0820_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_ROLL_LEDGER';
    	$this->pkId = "id";
    }  
    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "SELECT *
    			FROM JOB_ROLL_LEDGER j
    			WHERE j.finish_flag = '0' and j.delete_flag = '0' and j.cancel_flag = '0'
    			order by j.job_no
    			";
    	
		return $this->db->query($sql);
    }
    
}