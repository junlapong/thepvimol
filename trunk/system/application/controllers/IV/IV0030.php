<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0030 extends MY_Controller {

		
	function IV0030()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0030";
		$this->scrFull = "IV/IV0030";
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
			$ri_date = $this->input->post('ri_date');
			$ri_type = $this->input->post('ri_type');
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCount();
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($ri_type,$ri_date)->result_array();
			$ret['data'] = $data; 
		}
		
		echo json_encode($ret);	
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */