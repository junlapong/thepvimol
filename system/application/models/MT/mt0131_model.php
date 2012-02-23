<?php
class MT0131_model extends MY_Model {  
	
    function MT0131_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ITEM_MASTER';
    	$this->pkId = "item_code";
    }  
		
	function getRowCount($limit,$offset,$conditions){  
    	$tmp = "";
    	$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				$tmp = $tmp . "v." .$key . " like '%".$value."%' ";
			}
			$i++;
		}
		if($this->session->userdata('username') != 'admin' ){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				
				$tmp = $tmp . " v.delete_flag = '0'";
		}
		    	
    	$sql = "SELECT count(*) as count
				FROM DELIVERY_MASTER d
				join VENDOR_MASTER v on v.vendor_code = d.vendor_code
				 ". $tmp ." order by v.vendor_code";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];  
	}	

    function getDataLimit($limit,$offset,$conditions){
    	$tmp = "";
    	$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				$tmp = $tmp . "v." .$key . " like '%".$value."%' ";
			}
			$i++;
		}
		if($this->session->userdata('username') != 'admin' ){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				
				$tmp = $tmp . " v.delete_flag = '0'";
		}
		    	
    	$sql = "SELECT d.vendor_code,v.trader_name,delivery_code,delivery_name
				FROM DELIVERY_MASTER d
				join VENDOR_MASTER v on v.vendor_code = d.vendor_code
				 ". $tmp ." order by v.vendor_code
				LIMIT ".$offset.",".$limit;

    	
		return $this->db->query($sql);
	}	
    
    function getRowCountD($ven,$deli){  
		$sql = " SELECT count(*) as count
				 FROM CUSTOMER_MASTER
				 WHERE vendor_code = '". $ven . "' and delivery_code = '". $deli ."' and delete_flag = '0'";

		$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];  
	}	
	   
    function getDataDetail($ven,$deli){
		$sql = " SELECT id,vendor_code,delivery_code,item_code
				 FROM CUSTOMER_MASTER
				 WHERE vendor_code = '". $ven . "' and delivery_code = '". $deli ."' and delete_flag = '0'";
		
 		return $this->db->query($sql);   	
	}
	
	function getMAXIdD(){
		$this->db->flush_cache();
		$this->db->select_max('id');
		return $this->db->get('CUSTOMER_MASTER');
	}

	
    function getDataDAt($id){
		$sql = " SELECT id,vendor_code,delivery_code,item_code
				 FROM CUSTOMER_MASTER
				 WHERE id = '".$id."'";
    	
 		return $this->db->query($sql); 
	} 
	
	function insertDRow($data){
		$this->db->insert('CUSTOMER_MASTER', $data); 
	}
	
	function deleteDAt($id){
		$this->db->where('id', $id);
		$this->db->delete('CUSTOMER_MASTER'); 
	}
	
	function updateDAt($id,$data){
		$this->db->where('id', $id);
		$this->db->update('CUSTOMER_MASTER', $data); 
	}	
	
	
}