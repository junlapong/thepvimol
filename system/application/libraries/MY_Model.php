<?php 

/*
 *------------------------------------------------------------------------------
 * Description : Customize Controller
 *------------------------------------------------------------------------------
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends Model
{	
    public $tbl_menu= 'EMPLOYEE_MASTER';  
	public $pkId = "employee_code";
	
	function MY_Model()
	{	
		parent::Model();
	}
	
    function getAllRowCount(){  
    	return $this->db->count_all_results($this->tbl_menu);  
	}	
	
	function getRowCount($limit,$offset,$conditions){  
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				$value = strtoupper($value);
				$key = "upper(".$key.")";
				$this->db->like($key,$value);  
			}
		}
		if($this->session->userdata('username') != 'admin' )
    		$this->db->where('delete_flag', '0'); 
    		
    	return $this->db->count_all_results($this->tbl_menu);  
	}	
	
	function getAllData(){  
		if($this->session->userdata('username') != 'admin' )
    		$this->db->where('delete_flag', '0'); 
    	return $this->db->get($this->tbl_menu);  
	}
	
	function getMAXId(){
		$this->db->flush_cache();
		$this->db->select_max($this->pkId);
		return $this->db->get($this->tbl_menu);
	}

    function getDataLimit($limit,$offset,$conditions){
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				$value = strtoupper($value);
				$key = "upper(".$key.")";
				$this->db->like($key,$value);  
			}
		}
		if($this->session->userdata('username') != 'admin' )
    		$this->db->where('delete_flag', '0'); 
		
    	return $this->db->get($this->tbl_menu,$limit,$offset);  
	}
	
    function getDataAt($id){
		$this->db->flush_cache();
    	$this->db->where($this->pkId,$id);  
    	return $this->db->get($this->tbl_menu);  
	} 
	
	function insertRow($data){
		$this->db->insert($this->tbl_menu, $data); 
	}
	
	function deleteAt($id){
		$this->db->where($this->pkId, $id);
		$this->db->delete($this->tbl_menu); 
	}
	
	function updateAt($id,$data){
		$data->{'updated_date'} = NULL;
		$data->{'updated_user'} = $this->session->userdata('username');
		$this->db->where($this->pkId, $id);
		$this->db->update($this->tbl_menu, $data); 
	}
}

// END MY_Model class

/* End of file MY_Model.php */
/* Location: application/libraries/MY_Model.php */