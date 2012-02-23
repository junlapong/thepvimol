<?php
class SL0000_model extends MY_Model {  
	
    function SL0000_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'SALE_PRICE_MASTER';
    	$this->pkId = "id";
    }  

	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
    function getDataLimit($limit,$offset,$conditions){
    	$sql = $this->getQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
	}
	
	function getQuery($conditions){
		$tmp = "";
		$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				if( $i == 0 ) { 
					$tmp = " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				$prefix = "s";
				if($key == 'vendor_name')
					$prefix = "v";
				$tmp = $tmp . $prefix. "." . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "SELECT   id
    					,s.vendor_code
    					,vendor_name
    					,item_code
    					,price_std
    					,price_crd
    					,price_csh
    					,step1_discount
    					,step1_discount_rate
    					,step2_discount
    					,step2_discount_rate
    					,step3_discount
    					,step3_discount_rate
    					,start_date as start_price_date
    					,end_date as end_price_date
    			FROM SALE_PRICE_MASTER s
    			LEFT JOIN (SELECT vendor_code,trader_name as vendor_name FROM VENDOR_MASTER) v ON v.vendor_code = s.vendor_code
    			".$tmp."
    			order by item_code
    			";
    	return $sql;		
	}
}
