<?php
class PU0001_model extends MY_Model {  
	
    function PU0001_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'PURCHASE_REQUEST_LEDGER';
    	$this->pkId = "id";
    }  

    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "select *
    				,(SELECT sum(current_stock_qty) FROM INVENTORY_MASTER where pr.item_code = item_code group by item_code ) as stock_qty 
				from PURCHASE_REQUEST_LEDGER pr
				where delete_flag = 0 and approved_flag = 0 and finished_flag = 0 and cancel_flag = 0
				order by pr_no
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