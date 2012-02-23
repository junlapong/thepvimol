<?php
class MT0140_model extends MY_Model {  
	
    function MT0140_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'TRANSLATE_MASTER';
    	$this->pkId = "id";
    }
      
}