<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0040 extends MY_Controller {

		
	function MT0040()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MT";
		$this->scrId = "MT0040";
		$this->scrFull = "MT/MT0040";
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
	
	function getLocaByItemRoll()
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
			$data = $this->model->getLocaByItemRoll($item)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	// For Issue
	function getLocaByItem1()
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
			$data = $this->model->getLocaByItem1($item)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getLocaByItemK()
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
			$data = $this->model->getLocaByItemK($item)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	
}
// END Header class

/* End of file MT0040 */
/* Location: ./system/application/controllers/MT/MT0040.php */