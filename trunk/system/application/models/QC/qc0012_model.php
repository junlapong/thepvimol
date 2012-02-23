<?php
class QC0012_model extends MY_Model {  
	
    function QC0012_model(){  
    	parent::MY_Model();  
    	$this->tbl_menu = 'QC_CUT_LEDGER';
    	$this->pkId = "id";
    }  
}
