<?php
class Menu_model extends MY_Model {  

	function Menu(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SYS_MENU';
    	$this->pkId = "menu_code";
    }
    
    // get person by id  
    function getAllMenuList(){  
    	$this->db->where('delete_flag', '0'); 
    	return $this->db->get($this->tbl_menu);  
	} 
}
