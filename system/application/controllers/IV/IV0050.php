<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0050 extends MY_Controller {

		
	function IV0050()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0050";
		$this->scrFull = "IV/IV0050";
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
			$locatioin_code = $this->input->post('location_code');
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCount();
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($locatioin_code)->result_array();
			$ret['data'] = $data; 
			
		}
		
		echo json_encode($ret);	
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */