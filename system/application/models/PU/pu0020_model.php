<?php
class PU0020_model extends MY_Model {  
	
    function PU0020_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'PURCHASE_LEDGER';
    	$this->pkId = "po_no";
    }  
    function viewPOItem($limit,$offset,$poNo){
    	$sql = $this->getViewPOItem($poNo)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function viewPOItemCount($poNo){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getViewPOItem($poNo).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getViewPOItem($poNo){
    	$sql = "SELECT a.* , r.received_qty
    					
    			  FROM (
				 	select po.po_no
				 		, po.item_code
				 		, po.ref_doc
				 		, po.order_qty
				 		, po.notes
				 		, po.cancel_reason
						, (SELECT item_name FROM ITEM_MASTER where po.item_code = item_code) as item_name
						, (SELECT trader_name FROM VENDOR_MASTER where po.customer_code = vendor_code) as supply_name
					from PURCHASE_LEDGER po
					where  delete_flag = 0 and po_no like '%".$poNo."%'
					) a
					LEFT JOIN (SELECT ref_doc_no,item_code, sum(received_qty) as received_qty
							FROM RECEIVE_LEDGER
							WHERE delete_flag = 0 and cancel_flag = 0 and ref_doc_no like '".$poNo."'
							group by ref_doc_no,item_code
					) r on r.ref_doc_no = a.po_no and r.item_code = a.item_code
    			";
    	return $sql;		
	}
	
    function viewItem($limit,$offset,$item,$poNo){
    	$sql = $this->getViewItem($item,$poNo); //."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function viewItemCount($item,$poNo){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getViewItem($item,$poNo).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getViewItem($item,$poNo){
    	$sql = "select item_code
    				   , received_no
    				   , DATE_FORMAT(received_date,'%Y-%m-%d') as received_date
    				   , inv_no
    				   , received_qty
    				   , location_code
    				   , received_staff
    			FROM RECEIVE_LEDGER
    			WHERE cancel_flag = 0 and delete_flag = 0 and item_code like '%".$item."%' and ref_doc_no like '%".$poNo."%'
    			";
    	return $sql;		
	}    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "select po_no
						, po_date
						, ref_doc
						, customer_code
				from PURCHASE_LEDGER
				where finished_flag = 0 and delete_flag = 0  and cancel_flag = 0
				group by po_no
    			";
    	
		return $this->db->query($sql);
    }
    
	function updateRequestAt($id,$data){
		$data->{'updated_date'} = NULL;
		$data->{'updated_user'} = $this->session->userdata('username');
		$this->db->where("po_no", $id);
		$this->db->update("PURCHASE_REQUEST_LEDGER", $data); 
	}
    
}