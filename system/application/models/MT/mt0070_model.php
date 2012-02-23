<?php
class MT0070_model extends MY_Model {  
	
    function MT0070_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'VENDOR_MASTER';
    	$this->pkId = "vendor_code";
    }
    
    function getVendorList($con){
    	$this->db->select('vendor_code');
		$this->db->where('delete_flag','0');
    	$this->db->like('vendor_code',$con,'after');
    	return $this->db->get($this->tbl_menu);
    }
}