<?php
class QC0010_model extends MY_Model {  
	
    function QC0010_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RAW_SHEET_QC_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getReceivedDate(){
    	$sql = "
				SELECT DATE_FORMAT(rm.received_date,'%Y-%m-%d') as received_date
				FROM (
				SELECT   received_no
				      ,  item_code
				      ,  DATE_FORMAT(received_date,'%Y-%m-%d') as received_date
				      ,  lot_no
				FROM RECEIVE_LEDGER
				WHERE item_code like 'S%' and delete_flag = 0 and cancel_flag = 0 and location_code like 'B%'
				GROUP BY received_date,item_code,lot_no ) rm
				LEFT JOIN RAW_SHEET_QC_LEDGER qc
				ON rm.received_date = qc.received_date and rm.item_code = qc.item_code and rm.lot_no = qc.lot_no
				WHERE qc.id is null
				group by rm.received_date
    	";
    	
		return $this->db->query($sql);
    }
    

    function getItemCodeList($query){
    	$sql = "
				SELECT rm.item_code
				FROM (
				SELECT   received_no
				      ,  item_code
				      ,  DATE_FORMAT(received_date,'%Y-%m-%d') as received_date
				      ,  lot_no
				FROM RECEIVE_LEDGER
				WHERE item_code like 'S%' and delete_flag = 0 and cancel_flag = 0 and location_code like 'B%'
					 and received_date = '" .$query. "'
				GROUP BY received_date,item_code,lot_no ) rm
				LEFT JOIN RAW_SHEET_QC_LEDGER qc
				ON rm.received_date = qc.received_date and rm.item_code = qc.item_code and rm.lot_no = qc.lot_no
				WHERE qc.id is null
				group by rm.received_date,rm.item_code
    	";
 		return $this->db->query($sql);
    }

    function getLotNoList($query,$itemCode){
    	$sql = "
				SELECT rm.lot_no
				FROM (
				SELECT   received_no
				      ,  item_code
				      ,  DATE_FORMAT(received_date,'%Y-%m-%d') as received_date
				      ,  lot_no
				FROM RECEIVE_LEDGER
				WHERE item_code like 'S%' and delete_flag = 0 and cancel_flag = 0 and location_code like 'B%'
					 and received_date = '" .$query. "' and item_code = '".$itemCode."'
				GROUP BY received_date,item_code,lot_no ) rm
				LEFT JOIN RAW_SHEET_QC_LEDGER qc
				ON rm.received_date = qc.received_date and rm.item_code = qc.item_code and rm.lot_no = qc.lot_no
				WHERE qc.id is null
				group by rm.received_date,rm.item_code,rm.lot_no
    	";
    	
		return $this->db->query($sql);
    }


}