<?php
class MT0130_model extends MY_Model {  
	
    function MT0130_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'CUSTOMER_MASTER';
    	$this->pkId = "id";
    }
      
   function getCustomerList($con){
    	
    	$sql = "select v.vendor_code as vendor_code, CONCAT( v.vendor_code,':',v.trader_short_name) as vendor_name
    		    from CUSTOMER_MASTER c
    		    join VENDOR_MASTER v on v.vendor_code = c.vendor_code
    		    where c.delete_flag = '0'"; 
    	if($con != null && $con != ""){
    		$sql = $sql . " and c.vendor_code like '" . $con . "%'";
    	}	
    	return $this->db->query($sql);
    }
    
   function getItemList($vendor,$deli){
    	$this->db->select('item_code');
		$this->db->where('delete_flag','0');
    	$this->db->where('vendor_code',$vendor);
    	$this->db->where('delivery_code',$deli);
    	return $this->db->get($this->tbl_menu);
    }
}