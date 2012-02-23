<?php
class MT0040_model extends MY_Model {  
	
    function MT0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'INVENTORY_MASTER';
    	$this->pkId = "id";
    }  
    
    function getLocaByItem($con){
    	
    	$this->db->select('INVENTORY_MASTER.location_code,location_name,INVENTORY_MASTER.location_code as des_location_code');
    	$this->db->from('INVENTORY_MASTER');
    	$this->db->join('STOCK_LOCATION_MASTER', 'INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
    	//$this->db->where('INVENTORY_MASTER.current_stock_qty >','0');
		$this->db->where('INVENTORY_MASTER.item_code',$con);
		$this->db->where('STOCK_LOCATION_MASTER.delete_flag','0');
    	return $this->db->get();
    }
    
    function getLocaByItemRoll($con){
    	
    	$this->db->select('INVENTORY_MASTER.location_code,location_name,INVENTORY_MASTER.location_code as des_location_code');
    	$this->db->from('INVENTORY_MASTER');
    	$this->db->join('STOCK_LOCATION_MASTER', 'INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
    	//$this->db->where('INVENTORY_MASTER.current_stock_qty >','0');
		$this->db->where('INVENTORY_MASTER.item_code',$con);
		$this->db->where('INVENTORY_MASTER.location_code','K010100');
		$this->db->where('STOCK_LOCATION_MASTER.delete_flag','0');
    	return $this->db->get();
    }
    
    // for issue
    function getLocaByItem1($con){
    	
    	$this->db->select('INVENTORY_MASTER.location_code,location_name');
    	$this->db->from('INVENTORY_MASTER');
    	$this->db->join('STOCK_LOCATION_MASTER', 'INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
		//$this->db->not_like('INVENTORY_MASTER.location_code','K','after');
		//$this->db->not_like('STOCK_LOCATION_MASTER.location_code','K','after');
    	$this->db->where('INVENTORY_MASTER.current_stock_qty >','0');
		$this->db->where('INVENTORY_MASTER.item_code',$con);
		$this->db->where('STOCK_LOCATION_MASTER.delete_flag','0');
    	return $this->db->get();
    }
    function getLocaByItemK($con){
    	
    	$this->db->select('INVENTORY_MASTER.location_code,location_name');
    	$this->db->from('INVENTORY_MASTER');
    	$this->db->join('STOCK_LOCATION_MASTER', 'INVENTORY_MASTER.location_code = STOCK_LOCATION_MASTER.location_code');
    	$this->db->where('INVENTORY_MASTER.current_stock_qty >','0');
		$this->db->like('INVENTORY_MASTER.location_code','K','after');
		$this->db->like('STOCK_LOCATION_MASTER.location_code','K','after');
		$this->db->where('INVENTORY_MASTER.item_code',$con);
		$this->db->where('STOCK_LOCATION_MASTER.delete_flag','0');
    	return $this->db->get();
    }
}