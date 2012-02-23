<?php
class Common_model extends Model {  

	function Common_model()
	{	
		parent::Model();
	}
	
    function getUrComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as ur_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as ur_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'ur_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }

    function getUiComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as ui_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as ui_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'ui_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }
    
    // Sheet received
    function getSrComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as ui_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as ui_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'sr_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }
    
    // Sheet issue
    function getSiComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as ui_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as ui_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'si_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }
    
    // Delivery Reason
    function getDlComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as dl_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as dl_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'dl_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }
    
    // Order Close Reason
    function getOcComboList(){
    	 $query = "	SELECT CONCAT(tl_code,'-',seq_no) as oc_reason_val
    	 				  ,tl_code
    	 				  ,seq_no
    	 				  ,descript_th as oc_reason_disp
    	 				  ,descript_en 
    				FROM TRANSLATE_MASTER tl
    				WHERE tl.tl_code = 'oc_reason' and delete_flag = '0'";
    	 		
    	return $this->db->query($query);      	
    }
}