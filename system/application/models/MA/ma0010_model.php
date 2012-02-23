<?php
class MA0010_model extends MY_Model {  
	
    function MA0010_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'SYS_MENU';
    	$this->pkId = "menu_code";
    }  
}
