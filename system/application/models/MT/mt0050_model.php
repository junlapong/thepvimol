<?php
class MT0050_model extends MY_Model {  
	
    function MT0050_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'STOCK_LOCATION_MASTER';
    	$this->pkId = "location_code";
    }  
    
    function locationCodeList($con){
    	$this->db->select('location_code');
		$this->db->like('location_code',$con,'after');
    	return $this->db->get($this->tbl_menu);
    }
}