<?php
class IV0030_model extends MY_Model {  
	
    function IV0030_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'RECEIVE_LEDGER';
    	$this->pkId = "id";
    }  

    // Overrider function
    function getDataLimit($limit,$offset,$conditions){

    	$uiLike = ""; $urLike = "";
    	if( array_key_exists('received_no',$conditions) ){
    		$uiLike = " WHERE issue_no like '" . $conditions['received_no'] . "%'";	
    		$urLike = " WHERE received_no like '" . $conditions['received_no'] . "%'";	
    	}
    	$query = "	SELECT *
					FROM (
					    SELECT SUBSTRING(received_no,1,2) as ri_type
					    				,DATE_FORMAT(received_date,'%Y-%m-%d') as ri_date
					    				FROM RECEIVE_LEDGER r
					    union
										SELECT
										SUBSTRING(issue_no,1,2) as ri_type
										,DATE_FORMAT(issue_date,'%Y-%m-%d') as ri_date
					          			FROM ISSUE_LEDGER i
					) a
					group by a.ri_type, a.ri_date
					order by ri_date desc,ri_type Limit " . $offset . "," . $limit;
    	return $this->db->query($query);  
	}
	
    // Overrider function
	function getRowCount(){  
    	$query = "	SELECT *
					FROM (
					    SELECT SUBSTRING(received_no,1,2) as ri_type
					    				,DATE_FORMAT(received_date,'%Y-%m-%d') as ri_date
					    				FROM RECEIVE_LEDGER r
					    union
										SELECT
										SUBSTRING(issue_no,1,2) as ri_type
										,DATE_FORMAT(issue_date,'%Y-%m-%d') as ri_date
					          			FROM ISSUE_LEDGER i
					) a
					group by a.ri_type, a.ri_date";
    	$query = "SELECT COUNT(*) as count FROM (" . $query . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	
		
    function getDataDetail($ri_type,$ri_date){
    	
    	if(strpos($ri_type,'UI') !== false 
    	|| strpos($ri_type,'PI') !== false
    	|| strpos($ri_type,'TI') !== false
    	) // Issue ledger
    	{
	    	$query = "	SELECT issue_no as ri_no
	    					   ,item_code
	    					   ,location_name
	    					   ,lot_no
	    					   ,seq_no
	    					   ,issue_qty as ri_qty
	    					   ,issue_staff as ri_staff
	    					   ,IF( issue_reason = 'D*' , 'ปรับ Spec สินค้า'
	    					   		, IF ( issue_reason = 'T*' , 'ย้ายคลังสินค้า'
	    					   			,(SELECT descript_th FROM TRANSLATE_MASTER WHERE tl_code = substr(i.issue_reason,1,9) and seq_no = substr(i.issue_reason,11,2)) 
	    					   		))as remark
	    					   FROM ISSUE_LEDGER i 
    				LEFT JOIN STOCK_LOCATION_MASTER s ON s.location_code = i.location_code
    				WHERE i.issue_date = '".$ri_date."' and issue_no like '".$ri_type."%'";
    		
	    	return $this->db->query($query);    		
    	}else // Receive ledger
    	{
	    	$query = "	SELECT received_no as ri_no
	    					   ,item_code
	    					   ,location_name
	    					   ,lot_no
	    					   ,seq_no
	    					   ,received_qty as ri_qty
	    					   ,received_staff as ri_staff
	    					   ,IF( received_reason = 'D*' , 'ปรับ Spec สินค้า'
	    					   		, IF ( received_reason = 'T*' , 'ย้ายคลังสินค้า'
	    					   			,(SELECT descript_th FROM TRANSLATE_MASTER WHERE tl_code = substr(i.received_reason,1,9) and seq_no = substr(i.received_reason,11,2)) 
	    					   		))as remark
    				FROM RECEIVE_LEDGER i 
    				LEFT JOIN STOCK_LOCATION_MASTER s ON s.location_code = i.location_code
    				WHERE i.received_date = '".$ri_date."' and received_no like '".$ri_type."%'";
    		
	    	return $this->db->query($query);    		
    	}
	}
}