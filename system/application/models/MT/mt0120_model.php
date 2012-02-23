<?php
class MT0120_model extends MY_Model {  
	
    function MT0120_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'DELIVERY_MASTER';
    	$this->pkId = "delivery_code";
    }  
    
    function deliveryCodeList($con){
    	$sql = "select d.delivery_code,CONCAT(d.delivery_code,':',d.delivery_name) as delivery_name
    		    from DELIVERY_MASTER d
    		    where d.delete_flag = '0'"; 
    	if($con != null && $con != ""){
    		$sql = $sql . " and d.vendor_code like '" . $con . "%'";
    	}	 	
    	return $this->db->query($sql);
    }
}