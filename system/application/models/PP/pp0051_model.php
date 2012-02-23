<?php
class PP0051_model extends MY_Model {  
	
    function PP0051_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SCREEN_LEDGER';
    	$this->pkId = "id";
    }  
    
    function itemCodeList($con,$notlike){
    	if( $notlike != "")
    	{
    		$option = " and i.item_code <> '".$notlike."'";
    	}else{
    		$option = "";
    	}
    	if($con == "STOCK" || $con == null){
	        $sql = "SELECT item_code
			    	FROM ITEM_MASTER i
			    	WHERE i.delete_flag = '0' and block_code is not null
			    		".$option."
			    	";
    	}else{
	        $sql = "SELECT j.item_code as item_code
					FROM (SELECT item_code,order_no FROM ORDER_LEDGER where delete_flag = 0 and cancel_flag = 0 and finished_flag = 0 and order_no = '" . $con . "') j
					JOIN ITEM_MASTER i ON j.item_code = i.item_code
					where i.block_code is not null
					group by j.item_code
			    	";
       	}
		return $this->db->query($sql);
    }
    
    function refDocList($con,$notlike){
    	if( $notlike != "")
    	{
    		$option = " and i.item_code <> '".$notlike."'";
    	}else{
    		$option = "";
    	}
        $sql = "SELECT order_no as ref_doc FROM ORDER_LEDGER j
				join ITEM_MASTER i ON j.item_code = i.item_code
				where i.block_code is not null and j.delete_flag = 0 and j.cancel_flag = 0 and j.finished_flag = 0
				group by order_no
		    	";
    
		return $this->db->query($sql);
    }
    
    function getOrderQty($orderNo,$itemCode){

        $sql = "SELECT order_qty FROM ORDER_LEDGER o
				where item_code like '".$itemCode."' and order_no like '".$orderNo."'
				      and cancel_flag = 0 and delete_flag = 0 and finished_flag = 0;
		    	";
    
		return $this->db->query($sql);
    }
       
    function getMaxSeqJobNo($searchKey){
    	$sql = "SELECT SUBSTR(MAX(screen_no),2,3) as seq 
    			FROM SCREEN_LEDGER j
		 		WHERE j.screen_no like '%".$searchKey."'";
		return $this->db->query($sql);
    }
    
}