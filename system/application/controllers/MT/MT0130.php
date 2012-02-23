<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0130 extends MY_Controller {

		
	function MT0130()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MT";
		$this->scrId = "MT0130";
		$this->scrFull = "MT/MT0130";
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
	
	function customerCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getCustomerList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function itemCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item Code by vendor_code and delivery_code";
		if($_POST != NULL) {
			$vendor = $this->input->post('vendor_code');
			$deli = $this->input->post('delivery_code');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getItemList($vendor,$deli)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0120.php */