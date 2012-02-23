<?php
class PP0030_model extends MY_Model {  
	
    function PP0030_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getLocaByItem($con){
    	
    	$this->db->select('INVENTORY_MASTER.location_code,location_name');
    	$this->db->from('INVENTORY_MASTER');
    	$this->db->join('STOCK_LOCATION_MASTER', 'INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
		$this->db->where('item_code',$con);
		$this->db->where('STOCK_LOCATION_MASTER.delete_flag','0');
    	return $this->db->get();
    }
}