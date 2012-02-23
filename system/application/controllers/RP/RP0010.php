<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class RP0010 extends MY_Controller {

		
	function RP0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "RP";
		$this->scrId = "RP0010";
		$this->scrFull = "RP/RP0010";
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
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item Code by vendor_code and delivery_code";
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCount($limit,$start,$_POST);
			$ret['message'] = "Get Item List";
			$data = $this->model->getProductionResultList($limit,$start,$_POST)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getOrderDateCombo()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		

		if($_POST != NULL) {
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['data'] = $this->model->getOrderDateCombo()->result_array();		
		}
	
		echo json_encode($ret);		
	}

}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */