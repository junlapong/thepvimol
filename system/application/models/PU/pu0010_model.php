<?php
class PU0010_model extends MY_Model {  
	
    function PU0010_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'PURCHASE_REQUEST_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getMaxSeqOrderNo(){
    	$sql = "SELECT SUBSTR(MAX(pr_no),3,8) as seq 
    			FROM PURCHASE_REQUEST_LEDGER o";

		return $this->db->query($sql);
    }

}