<?php
class PU0040_model extends MY_Model {  
	
    function PU0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){
		$query = $this->getPRListSQL($conditions) . " Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount($conditions){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getPRListSQL($conditions) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}
	
    function getPRListSQL($conditions){

    	$query = "	SELECT DATE_FORMAT(request_date,'%Y-%m-%d') as pr_date
    					 , pr_no
    					 , (SELECT employee_firstname FROM EMPLOYEE_MASTER where pr.request_staff = employee_code ) as request_staff 
					FROM PURCHASE_REQUEST_LEDGER pr
					group by pr_no,request_date
					order by pr_no desc
					";
    	return $query;  
	}
		
    function getDataDetail($prNo){
    	$query = "
				 	select IF(finished_flag = 1,'ปิด',
							  IF(cancel_flag = 1,'ยกเลิก',
								IF(approved_flag = 1,
										IF(po_no = '' or po_no is null , 'รอ PO' , IF(received_date = '0000-00-00 00:00:00','รอ ส่งของ','รอปิด'))
										,'รออนุมัติ'	))) as pr_status
							, pr.*
							, (SELECT item_name FROM ITEM_MASTER where pr.item_code = item_code) as item_name
					from PURCHASE_REQUEST_LEDGER pr
					where  delete_flag = 0 and pr_no like '%".$prNo."%'
    	";	
    	
    		
	  	return $this->db->query($query);    		
    
	}
}