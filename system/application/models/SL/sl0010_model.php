<?php
class SL0010_model extends MY_Model {  
	
    function SL0010_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'ORDER_LEDGER';
    	$this->pkId = "id";
    }  

}
