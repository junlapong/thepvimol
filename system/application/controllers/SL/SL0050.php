<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class SL0050 extends MY_Controller {

		
	function SL0050()
	{
		parent::MY_Controller();
		
		$this->scrPath = "SL";
		$this->scrId = "SL0050";
		$this->scrFull = "SL/SL0050";
		$this->pkId = "item_code";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
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
	
	function getSaleCodeList()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getSaleCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);			
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */