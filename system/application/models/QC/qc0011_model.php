<?php
class QC0011_model extends MY_Model {  
	
    function QC0011_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'QC_VAC_LEDGER';
    	$this->pkId = "id";
    }  
}
