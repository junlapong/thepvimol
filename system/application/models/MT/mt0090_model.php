<?php
class MT0090_model extends MY_Model {  
	
    function MT0090_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'BILL_MASTER';
    	$this->pkId = "id";
    }  
}