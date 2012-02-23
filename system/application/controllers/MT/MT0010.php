<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Item Master
 *------------------------------------------------------------------------------
 */
class MT0010 extends MY_Controller {
		
	function MT0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MT";
		$this->scrId = "MT0010";
		$this->scrFull = "MT/MT0010";
		$this->pkId = "item_code";
		
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
	
	function itemCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->itemCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function sheetCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Sheet List";
			$data = $this->model->sheetCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}

	function bagCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Bag List";
			$data = $this->model->bagCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
}
	
// END Header class

/* End of file MT0010 */
/* Location: ./system/application/controllers/MT/MT0010.php */