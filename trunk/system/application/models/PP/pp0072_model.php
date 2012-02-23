<?php
class PP0072_model extends MY_Model {  
	
    function PP0072_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'KAE_LEDGER';
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

    function getMachineList(){
    	$sql = "
				SELECT code as machine_code
				FROM MACHINE_MASTER
				where delete_flag = 0 and type = 2
    	";
    	
		return $this->db->query($sql);
    }

    function getStaffName(){
    	$sql = "
				SELECT employee_code as staff_code,CONCAT(employee_firstname,':',employee_nickname) as staff_name
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

}