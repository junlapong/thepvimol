<?php
class MT0010_model extends MY_Model {  
	
    function MT0010_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'ITEM_MASTER';
    	$this->pkId = "item_code";
    }  
    
    function itemCodeList($con){
    	$this->db->select('item_code,item_code as des_item_code');
		//$this->db->like('item_code',$con,'after');
		$this->db->like('item_code',$con);
		$this->db->where('delete_flag','0');
		return $this->db->get($this->tbl_menu);
    }
    
    function sheetCodeList($con){
    	$this->db->select('item_code,item_code as des_item_code');
		//$this->db->like('item_code',$con,'after');
		$this->db->like('item_code',$con);
		$this->db->like('item_code','S','after');
		$this->db->where('delete_flag','0');		
		return $this->db->get($this->tbl_menu);
    }
    
    function bagCodeList($con){
    	$this->db->select('item_code,item_code as des_item_code');
		//$this->db->like('item_code',$con,'after');
		$this->db->like('item_code',$con);
		$this->db->like('item_code','F','after');
		$this->db->where('delete_flag','0');		
		return $this->db->get($this->tbl_menu);
    }
}
