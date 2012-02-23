<?php
class MT0020_model extends MY_Model {  
	
    function MT0020_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'MOL_MASTER';
    	$this->pkId = "mol_code";
    }  
}
