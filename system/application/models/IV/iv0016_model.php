<?php
class IV0016_model extends MY_Model {  
	
    function IV0016_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    function refDocList($con,$notlike){

        $sql = "SELECT issue_no as ref_doc
				FROM (SELECT * FROM ISSUE_LEDGER where ref_doc_no like 'S%' and delete_flag = 0 and cancel_flag = 0) i
				JOIN (SELECT screen_no FROM SCREEN_LEDGER WHERE cancel_flag = 0 and finish_flag = 0 and delete_flag = 0) s ON s.screen_no = i.ref_doc_no
				group by issue_no
		    	";
    
		return $this->db->query($sql);
    }
    
    function jobNoList($con){

        $sql = "(SELECT ref_doc_no as job_no
				FROM ISSUE_LEDGER
				WHERE issue_no = '".$con."'
				group by ref_doc_no
				order by job_no
				)
				UNION
				(
				SELECT lot_no as job_no
				FROM ISSUE_LEDGER
				WHERE issue_no = '".$con."'
				group by lot_no
				order by lot_no desc)
		    	";
    
		return $this->db->query($sql);
    }  

    function getItemCode($con,$con2){

    	if( substr($con,0,1) == "S" ){
			 $sql = "SELECT item_code
			    	FROM SCREEN_LEDGER s
			    	WHERE s.screen_no like '%" . $con . "%'
			    			    		and s.delete_flag = '0' 
			    	";    		    		
    	}else{
			 $sql = "SELECT item_code as item_code
					FROM ISSUE_LEDGER
					WHERE issue_no = '".$con2."' and lot_no = '".$con."'
					group by lot_no
					order by lot_no desc
			    	";    
    	}
    	
    	
		return $this->db->query($sql);
    }   

    function getLimitQty($con,$con2){

		$sql = "SELECT issue_no
				       ,item_code
				       ,sum(issue_qty) as issue_qty
				       ,(SELECT sum(received_qty) FROM RECEIVE_LEDGER WHERE ref_doc_no = i.issue_no) as received_qty
				FROM ISSUE_LEDGER i
				WHERE ref_doc_no like 'S%' and issue_no = '".$con2."'
				group by issue_no,item_code
    	";
    	
		return $this->db->query($sql);
    }  
    
    function itemCodeList($con,$notlike){
    	if( $notlike != "")
    	{
    		$option = " and i.item_code <> '".$notlike."'";
    	}else{
    		$option = "";
    	}
        $sql = "SELECT item_code
		    	FROM ITEM_MASTER i
		    	WHERE i.item_code like '%" . $con . "%'
		    			    		and i.delete_flag = '0' 
		    		".$option."
		    	";
    
		return $this->db->query($sql);
    }
    
    function getMAXUR(){
		$this->db->select_max('received_no');
    	$this->db->like('received_no','UR','after');  
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
    	$this->db->where('screen_no',$lot);
    	$this->db->where('cancel_flag',"0");
    	$this->db->where('delete_flag',"0");
    	return $this->db->get('SCREEN_LEDGER');  
	} 
	
    function updateJobLedger($item,$lot,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('screen_no',$lot);
    	$this->db->update('SCREEN_LEDGER', $arr); 
    }
}