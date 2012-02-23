<?php
class MT0150_model extends MY_Model {  
	
    function MT0150_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'SALEMAN_MASTER';
    	$this->pkId = "sale_code";
    }  
}
