<?php
class PU0041_model extends MY_Model {  
	
    function PU0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){
		$query = $this->getPRListSQL($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount($conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getPRListSQL($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}
	
    function getPRListSQL($conditions){

    	$query = "	SELECT DATE_FORMAT(po_date,'%Y-%m-%d') as po_date
    					 , po_no
					FROM PURCHASE_LEDGER po
					group by po_no,po_date
					order by po_no desc
					";
    	return $query;  
	}
		
    function getDataDetail($poNo){
    	$query = "SELECT a.* , r.received_qty
    					
    			  FROM (
				 	select po.po_no
				 		, po.item_code
				 		, po.ref_doc
				 		, po.order_qty
				 		, po.notes
				 		, po.cancel_reason
				 		, (SELECT trader_name FROM VENDOR_MASTER where po.customer_code = vendor_code) as supply_name
						, (SELECT item_name FROM ITEM_MASTER where po.item_code = item_code) as item_name
					from PURCHASE_LEDGER po
					where  delete_flag = 0 and po_no like '%".$poNo."%'
					) a
					LEFT JOIN (SELECT ref_doc_no,item_code, sum(received_qty) as received_qty
							FROM RECEIVE_LEDGER
							WHERE delete_flag = 0 and cancel_flag = 0 and ref_doc_no like '".$poNo."'
							group by ref_doc_no,item_code
					) r on r.ref_doc_no = a.po_no and r.item_code = a.item_code
    	";	
    	
    		
	  	return $this->db->query($query);    		
    
	}
}