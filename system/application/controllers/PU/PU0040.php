<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PU0040 extends MY_Controller {

		
	function PU0040()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PU";
		$this->scrId = "PU0040";
		$this->scrFull = "PU/PU0040";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function viewDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$prNo = $this->input->post('pr_no');
			
			$ret['success'] = true;
			//$ret['total'] = $this->model->getRowCount();
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($prNo)->result_array();
			$ret['data'] = $data; 
		}
		
		echo json_encode($ret);	
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */