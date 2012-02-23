<?php
class MT0151_model extends MY_Model {  
	
    function MT0151_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SALEMAN_MASTER';
    	$this->pkId = "sale_code";
    }  
		
    function getDataDetail($param){
		$query = $this->getDataCodeListQuery($param);
    	return $this->db->query($query);    	
	}
	
	function getRowCountD($param){  

    	$query = "SELECT COUNT(*) as count FROM (" . $this->getDataCodeListQuery($param) . ") as GRC";
    	
    	$result = $this->db->query($query)->result_array(); 
 		return $result[0]["count"];  
	}	

	function getDataCodeListQuery($param){
		$sql = " SELECT a.id,a.vendor_code,v.trader_name
				 FROM (select s.id,s.sale_code, s.vendor_code from SALEMAN_CUSTOMER_MASTER s where sale_code like '".$param."' and delete_flag = 0) a
				 JOIN VENDOR_MASTER v ON a.vendor_code = v.vendor_code
				 ";
		
    	return $sql;	
    		
	}
	
	function getLocationList($user){
		$sql = "SELECT a.vendor_code, a.trader_name
				FROM
				(select cu.vendor_code, ve.trader_name
				from CUSTOMER_MASTER cu
				join VENDOR_MASTER ve on cu.vendor_code = ve.vendor_code
				where cu.delete_flag = 0 and ve.delete_flag = 0
				GROUP BY cu.vendor_code) a
				LEFT JOIN (SELECT * FROM SALEMAN_CUSTOMER_MASTER) sm ON sm.vendor_code = a.vendor_code
				where sm.vendor_code is null
				order by a.trader_name
				";
		return $this->db->query($sql, $user);
	}	
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('SALEMAN_CUSTOMER_MASTER');
	}

	
    function getDataDAt($id){
		$sql = " SELECT i.id,i.sale_code,i.vendor_code,l.trader_name
				 FROM SALEMAN_CUSTOMER_MASTER i
				 join VENDOR_MASTER l on i.vendor_code = l.vendor_code 
				 WHERE i.id = '".$id."'";
    	
 		return $this->db->query($sql); 
	} 
	
	function insertDRow($data){
		$this->db->insert('SALEMAN_CUSTOMER_MASTER', $data); 
	}
	
	function deleteDAt($id){
		$this->db->where('id', $id);
		$this->db->delete('SALEMAN_CUSTOMER_MASTER'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('SALEMAN_CUSTOMER_MASTER', $data); 
	}	
	
	
}