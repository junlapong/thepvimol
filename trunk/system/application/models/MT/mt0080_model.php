<?php
class MT0080_model extends MY_Model {  
	
    function MT0080_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'WORK_SHOP_MASTER';
    	$this->pkId = "work_shop_code";
    }  
}