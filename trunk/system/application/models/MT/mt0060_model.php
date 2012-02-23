<?php
class MT0060_model extends MY_Model {  
	
    function MT0060_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'COUNTRY_MASTER';
    	$this->pkId = "country_code";
    }  
}