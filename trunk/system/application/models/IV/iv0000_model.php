<?php
class IV0000_model extends MY_Model {  
	
    function IV0000_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  
    
    function locationCodeList($con){
    	$this->db->select('location_code');
		$this->db->like('location_code',$con,'after');
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
    
    function getInvItemList(){
    	$this->db->select('item_code,location_code');
    	$this->db->group_by(array("item_code", "location_code")); 
    	return $this->db->get('INVENTORY_MASTER');
    }
    
    function updateInventory($item,$loca,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
    	$this->db->update('INVENTORY_MASTER', $arr); 
    }
    
}