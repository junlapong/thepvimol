<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0800 extends MY_Controller {

		
	function PP0800()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0800";
		$this->scrFull = "PP/PP0800";
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
			$data = $this->model->getJobOrderList($limit,$start,$_POST)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function create()
	{

	}
	
	function update()
	{

			
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */