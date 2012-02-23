<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0030 extends MY_Controller {

		
	function PP0030()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0030";
		$this->scrFull = "PP/PP0030";
		$this->pkId = "id";
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
	
	function getLocaByItem()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$item = $this->input->post('item');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getLocaByItem($item)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	
}
// END Header class

/* End of file MT0040 */
/* Location: ./system/application/controllers/MT/MT0040.php */