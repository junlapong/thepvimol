<?php
class IV0071_model extends MY_Model {  
	
    function IV0071_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

   function getPoNoList($con){
     	$query = "	SELECT po_no
     					, CONCAT(po_no,':',(SELECT trader_name FROM VENDOR_MASTER WHERE pl.customer_code = vendor_code)) as po_name
					FROM PURCHASE_LEDGER pl
					WHERE pl.delete_flag = 0 
						and cancel_flag = 0
						and finished_flag = 0
					group by po_no,customer_code
					";
    	return $this->db->query($query); 
    }
    
    function viewPOItem($limit,$offset,$poNo){
    	$sql = $this->getViewPOItemSQL($poNo)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }
    
	function viewPOItemCount($poNo){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getViewPOItemSQL($poNo).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
	
	function getViewPOItemSQL($poNo){
    	$sql = "select item_code
						, order_qty as received_qty 
						, (SELECT location_code FROM INVENTORY_MASTER where item_code = po.item_code group by item_code) as location_code
				from PURCHASE_LEDGER po
				where delete_flag = 0 and cancel_flag = 0 and finished_flag = 0 and po_no like '%".$poNo."%'
				group by item_code
    			";
    	return $sql;		
	}    

   	function updateReceiveDate($poNo,$recvDate,$itemCode){
    	$sql = " UPDATE PURCHASE_REQUEST_LEDGER
    			 SET received_date = '".$recvDate."'
    			 WHERE po_no = '".$poNo."' and item_code = '".$itemCode."'
    	";
    	
		return $this->db->query($sql);
    }
	
    function jobNoList($con){
    	$this->db->select('job_no,item_code,order_qty,finish_order_qty');
		$this->db->where('finish_flag','0');
		$this->db->where('cancel_flag','0');
		$this->db->where('delete_flag','0');
		$this->db->like('job_no',$con);
    	return $this->db->get('JOB_LEDGER');
    }    
    
    function getMAXUR(){
		$this->db->select_max('received_no');
    	$this->db->like('received_no','PR','after');  
    	return $this->db->get($this->tbl_menu);  
	} 
	
    function getIssueQty($item,$loca){
    	$this->db->select_sum('issue_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('ISSUE_LEDGER');
    }
    
    function getReceiveQty($item,$loca){
    	$this->db->select_sum('received_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('RECEIVE_LEDGER');
    }

    function getStartQty($item,$loca){
    	$this->db->select_sum('start_stock_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('INVENTORY_MASTER');
    }
    
    function updateInventory($item,$loca,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
    	$this->db->update('INVENTORY_MASTER', $arr); 
    }
    
    function getRecordCount($item,$loca,$lot,$seq){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		return $this->db->count_all_results('INVENTORY_LOT_MASTER');   
    } 

    function getLotQty($item,$loca,$lot,$seq){
    	$this->db->select_sum('current_stock_qty');
    	$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		return $this->db->get('INVENTORY_LOT_MASTER');
    }
    
    function updateLotInv($item,$loca,$lot,$seq,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
    	$this->db->update('INVENTORY_LOT_MASTER', $arr); 
    }
    
	function insertLotInv($data){
		$this->db->insert('INVENTORY_LOT_MASTER', $data); 
	}
	
	function checkJobLedger($item,$lot){
    	$this->db->where('item_code',$item);  
    	$this->db->where('job_no',$lot);
    	$this->db->where('cancel_flag',"0");
    	$this->db->where('delete_flag',"0");
    	return $this->db->get('JOB_LEDGER');  
	} 
	
    function updateJobLedger($item,$lot,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('job_no',$lot);
    	$this->db->update('JOB_LEDGER', $arr); 
    }
}