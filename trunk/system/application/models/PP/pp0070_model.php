<?php
class PP0070_model extends MY_Model {  
	
    function PP0070_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'VAC_LEDGER';
    	$this->pkId = "id";
    }  
    
    function getJobNoList(){
    	$sql = "
				SELECT *
				FROM JOB_LEDGER
				where finish_flag = 0 and cancel_flag = 0
    	";
    	
		return $this->db->query($sql);
    }
    
    function getItemCode($query){
    	$sql = "
				SELECT *
				FROM JOB_LEDGER
				where finish_flag = 0 and cancel_flag = 0
				and job_no = '".$query."'
    	";
  
		return $this->db->query($sql);
    }

    function getMaterialList(){
    	$sql = "
				SELECT item_code as mat_code
				FROM INVENTORY_MASTER
				where delete_flag = 0 and item_code like 'S%' 
    	";
    	
		return $this->db->query($sql);
    }

    function getMachineList(){
    	$sql = "
				SELECT code as machine_code
				FROM MACHINE_MASTER
				where delete_flag = 0 and type = 1
    	";
    	
		return $this->db->query($sql);
    }
    function getLeadName(){
    	$sql = "
				SELECT employee_code as lead_code, CONCAT(employee_firstname,':',employee_nickname) as lead_name
				FROM EMPLOYEE_MASTER
				where delete_flag = 0 and end_date = '0000-00-00 00:00:00' and dept_code = '30' and employee_code like 'BF%'
    	";
    	
		return $this->db->query($sql);
    }
    function getStaffName(){
    	$sql = "
				SELECT employee_code as staff1_code,employee_code as staff2_code,employee_code as staff3_code, CONCAT(employee_firstname,':',employee_nickname) as staff_name
				FROM EMPLOYEE_MASTER
				where delete_flag = 0 and end_date = '0000-00-00 00:00:00' and dept_code = '30' and employee_code like 'BF%'
    	";
    	
		return $this->db->query($sql);
    }
 
    
    function getLotNo($query){
    	$sql = "
				SELECT lot_no
				FROM INVENTORY_LOT_MASTER
				where delete_flag = 0 and item_code = '".$query."'
    	";
  
		return $this->db->query($sql);
    }
    
	function insertQCData($data){
		$this->db->insert("QC_VAC_LEDGER", $data); 
	}

}