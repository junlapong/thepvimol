<?php
class PP0062_model extends MY_Model {  
	
    function PP0062_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SCREEN_LEDGER';
    	$this->pkId = "id";
    }  
    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "SELECT *
    			FROM SCREEN_LEDGER j
    			WHERE j.finish_flag = '0' and j.delete_flag = '0' and j.cancel_flag = '0'
    			order by j.screen_no
    			";
    	
		return $this->db->query($sql);
    }
    
}