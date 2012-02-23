<?php
class MA0020_model extends MY_Model {  
	
    function MA0020_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_USER';
    	$this->pkId = "username";
    }  
    
}