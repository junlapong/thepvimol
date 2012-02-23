<?php
class IV0810_model extends MY_Model {  
	
    function IV0810_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  
    
    function itemCodeList($con,$notlike){
    	if( $con != "")
    	{
    		$option = " and i.item_code like '%".$con."%'";
    	}else{
    		$option = "";
    	}
        $sql = "SELECT item_code
		    	FROM INVENTORY_MASTER i
		    	WHERE i.delete_flag = '0' and item_code like 'S%' and location_code like 'K%'
		    		".$option."
		    		order by item_code
		    	";
    
		return $this->db->query($sql);
    }
        
   function jobNoList($con){
    	//$this->db->select('job_no,item_code');
		//$this->db->where('finish_flag','0');
		//$this->db->where('cancel_flag','0');
		//$this->db->where('delete_flag','0');
		//$this->db->like('item_code',$con);
    	//return $this->db->get('JOB_ROLL_LEDGER');
        if( $con != "")
    	{
    		$option = " and i.item_code like '".$con."'";
    	}else{
    		$option = "";
    	}
        $sql = "SELECT job_no,item_code
		    	FROM JOB_ROLL_LEDGER i
		    	WHERE i.delete_flag = '0' and cancel_flag = '0' and finish_flag = '0'
		    		".$option."
		    	";
    
		return $this->db->query($sql);
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
    	return $this->db->get('JOB_ROLL_LEDGER');  
	} 
	
    function updateJobLedger($item,$lot,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('job_no',$lot);
    	$this->db->update('JOB_ROLL_LEDGER', $arr); 
    }
}