<?php
class MT0110_model extends MY_Model {  
	
    function MT0110_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'UNIT_MASTER';
    	$this->pkId = "unit_code";
    }  
}