<?php
class Employee_model extends Model {  

	function Employee_model()
	{	
		parent::Model();
	}

	function getCount($sql){
		$sql = "SELECT count(*) as count FROM ( ".$sql.") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"]; 		
	}
	
	function getListNoLimit($sql){
    	$sql = $sql; //."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}

	function getListLimit($sql,$offset,$limit){
    	$sql = $sql."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}
	
	
	function getBKKLeaderNameCount(){ return $this->getCount($this->getBKKLeaderNameSQL()); }
	function getBKKLeaderNameList() { return $this->getListNoLimit($this->getBKKLeaderNameSQL()); }	
	
	function getBKKLeaderNameSQL(){
    	$sql = "
				SELECT employee_code as lead_code
					 , CONCAT(employee_firstname,':',employee_nickname) as lead_name
				FROM EMPLOYEE_MASTER
				where delete_flag = 0 and end_date = '0000-00-00 00:00:00' and dept_code = '30' and employee_code like 'BF%'
    	";
    	
		return $sql;
    }
    
	function getBKKStaffNameSQL(){
    	$sql = "
				SELECT employee_code as staff1_code
					  ,employee_code as staff2_code
					  ,employee_code as staff3_code
					  ,CONCAT(employee_firstname,':',employee_nickname) as staff_name
				FROM EMPLOYEE_MASTER
				where delete_flag = 0 and end_date = '0000-00-00 00:00:00' and dept_code = '30' and employee_code like 'BF%'
    	";
    	
		return $sql;
    }

	function getAllStaffNameSQL(){ // No Board Name
    	$sql = "
				SELECT employee_code as staff1_code
					  ,CONCAT(employee_firstname,':',employee_nickname) as staff_name
				FROM EMPLOYEE_MASTER
				where delete_flag = 0 and end_date = '0000-00-00 00:00:00' and dept_code != '00' and employee_code like 'B%'
    	";
    	
		return $sql;
    }
    
}