<?php
class IV0820_model extends MY_Model {  
	
    function IV0820_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ISSUE_LEDGER';
    	$this->pkId = "id";
    }  

    function getItemList($con){
    	
    	$this->db->select('item_code');
		$this->db->like('item_code',$con);
		$this->db->like('item_code','S','after');
		$this->db->like('location_code','K','after');
		$this->db->where('delete_flag','0');
		$this->db->group_by('item_code');
		$this->db->having('sum(current_stock_qty) >', 0);
		return $this->db->get('INVENTORY_MASTER');
    }

    function jobNoList($con){
    	$this->db->select('job_no,item_code,order_qty,finish_order_qty');
		$this->db->where('finish_flag','0');
		$this->db->where('cancel_flag','0');
		$this->db->where('delete_flag','0');
		$this->db->like('job_no',$con);
    	return $this->db->get('JOB_KORAT_LEDGER');
    }    
    
    function getLotNo($item,$loca){
    	
    	$this->db->select('lot_no');
		$this->db->where('item_code',$item);
		$this->db->where('current_stock_qty >', 0);
		$this->db->where('location_code',$loca);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    }
        
    function getSeqNo($item,$loca,$lot){
    	
    	$this->db->select('seq_no');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    }    

    function getCurrentInvQty($item,$loca,$lot,$seq){
    	$this->db->select('current_stock_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    	
    }
        
    function locationCodeList($con){
    	$this->db->select('location_code');
		$this->db->like('location_code',$con,'after');
    	return $this->db->get($this->tbl_menu);
    }

    function getMAXUR(){
		$this->db->select_max('issue_no');
    	$this->db->like('issue_no','PI','after');  
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
}