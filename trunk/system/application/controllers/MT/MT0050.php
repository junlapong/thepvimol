<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0050 extends MY_Controller {

		
	function MT0050()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MT";
		$this->scrId = "MT0050";
		$this->scrFull = "MT/MT0050";
		$this->pkId = "location_code";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function view()
	{
 		$this->colArray = null;
		parent::view();
	}
	
	function create()
	{
 		$this->colArray = null;
		parent::create();
	}
	
	function update()
	{
 		$this->colArray = null;
		parent::update();

	}
	
	function locationCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->locationCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */