<?php
class MT0100_model extends MY_Model {  
	
    function MT0100_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ROUTING_MASTER';
    	$this->pkId = "id";
    }  
}