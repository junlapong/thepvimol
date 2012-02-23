<?php 

/*
 *------------------------------------------------------------------------------
 * Description : Customize Controller
 *------------------------------------------------------------------------------
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Controller
{	
	public $sys_lang='th';
	public $colArray;
	public $scrPath;
	public $scrId;
	public $scrFull;
	public $pkId;
	public $lastSessionID;
	
	function MY_Controller()
	{	
		parent::Controller();
		log_message('debug', "MY_Controller Class Initialized");
		$this->load->model('common/common_model','common',TRUE);
		
		
		// TODO		
		$this->lang->set_lang($this->sys_lang);
		
		$login_page = defined('LOGIN_PAGE');
		$test_page  = defined('TEST_PAGE');
		$sess_expired = $this->session->userdata("status") != 'online';
		
		if (!is_empty(get_cookie('username')))
		{
			//echo "cookie " . get_cookie('username') . " session " . $sess_expired ;
			if($sess_expired)
			{
				$this->_restore_session();
			}
		}
		else if (!($login_page || $test_page) && $sess_expired)
		{
			header("Content-Type: text/html");
			echo '<script language="JavaScript">';
			echo 'window.open("' . site_url('login') . '", "_top");';
			echo '</script>';
			exit(0);
		}
		
		//echo "My_COntroller";
		//exit();
		
	}
	
	function _restore_session()
	{
		
		$this->load->model("login_model","contor");
		$user	= get_cookie('username');
		$user_groups	      = $this->model->get_user_groups($user);
		$user_menu        = $this->model->get_user_menu($user, $user_groups);
		foreach($user_menu as $key=>$value)
		{
			$screen_permission[$value->{'menu_name'}] = $value->{'permission'};
		} 
		       
		$newdata = array(
                   'username' 		=> $user,
        		   'groups' 	  	=> $user_groups,
                   'status'   		=> 'online',
        		   'usermenu'		=> $user_menu,
        		   'permission'     => $screen_permission
               );       
       $this->session->set_userdata($newdata);
       
	}
	
	function langConv1(&$dataArray)
	{
		if($this->colArray == null)
		{
			return;
		}
		foreach($this->colArray as $col)
		{
			$r = 0;	
			foreach($dataArray as $row)
			{
				$dataArray[$r][$col]= $this->lang->line($dataArray[$r][$col]);
				$r++;
			}
		}	
	}
	
	function langConv2(&$dataArray,$col)
	{
		$r = 0;	
		foreach($dataArray as $row)
		{
			$dataArray[$r][$col]= $this->lang->line($dataArray[$r][$col]);
			$r++;
		}	
	}
		
	function view()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "ไม่สามารถหาข้อมูลได้";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');	
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCount($limit,$start,$_POST);
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataLimit($limit,$start,$_POST)->result_array();
			$this->langConv1($data);
			$ret['data'] = $data; 
			
		}
		
		echo json_encode($ret);		
	}
	
	function create()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "เพิ่มข้อมูลไม่ได้";
		$ret['data'] = json_decode($this->input->post('data'));
		if($_POST != NULL) {
			$data = json_decode($this->input->post('data'));
			foreach($data as $key1 => $value1)
			{
				if($data->{$key1} == "")
				$data->{$key1} = null;
			}

			$data->{'created_user'} = $this->session->userdata('username');
			$data->{'updated_user'} = $this->session->userdata('username');
			$this->model->insertRow($data);
			if($this->pkId == "id")
			{
				$maxId = $this->model->getMAXId()->row_array();
				$data = $this->model->getDataAt($maxId['id'])->result_array();
			}else
			{
				$data = $this->model->getDataAt($data->{$this->pkId})->result_array();
			}
			$this->langConv1($data);
			$ret['data'] = $data;
			$ret['success'] = true;
			$ret['message'] = "Inserted Data";
			
		}
		echo json_encode($ret);		
	}
	function update()
	{
		
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถแก้ไขข้อมูลได้";
		$ret['data'] = json_decode($this->input->post('data'));
		if($_POST != NULL) {
			$data = json_decode($this->input->post('data'));
			$this->model->updateAt($data->{$this->pkId},$data);
			$data = $this->model->getDataAt($data->{$this->pkId})->result_array();
			$this->langConv1($data);
			$ret['data'] = $data;
			$ret['success'] = true;
			$ret['message'] = "Updated Data";
			
		}
		echo json_encode($ret);		
	}
	
	// Default destroy function
	function destroy()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot delete Data";
		//$ret['data'] = json_decode($this->input->post('data'));
		if($_POST != NULL) {
			// Delete data at reference key
			$this->model->deleteAt(json_decode($this->input->post('data')));
			$ret['success'] = true;
			$ret['message'] = "deleted Data";
		}
		echo json_encode($ret);		
	}
	
    public function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
        {
            return $object;
        }
        if( is_object( $object ) )
        {
            $object = get_object_vars( $object );
        }
        return array_map( 'objectToArray', $object );
    }
    
	public function countdim($array)
	{
	   if (is_array(reset($array))) 
	     $return = countdim(reset($array)) + 1;
	   else
	     $return = 1;
	 
	   return $return;
	}
}

// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: application/libraries/MY_Controller.php */