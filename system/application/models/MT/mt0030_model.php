<?php
class MT0030_model extends MY_Model {  
	
    function MT0030_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'EMPLOYEE_MASTER';
    	$this->pkId = "employee_code";
    }  
}
