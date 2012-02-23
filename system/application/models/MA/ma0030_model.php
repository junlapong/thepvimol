<?php
class MA0030_model extends MY_Model {  
	
    function MA0030_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_GROUP';
    	$this->pkId = "group_code";
    }  
    
}