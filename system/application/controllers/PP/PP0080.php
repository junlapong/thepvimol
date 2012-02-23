<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0080 extends MY_Controller {

		
	function PP0080()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0080";
		$this->scrFull = "PP/PP0080";
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
	
	function getVacDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "หาข้อมูลไม่เจอ";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = 0;
			$limit = 100;	
			$ret['total'] = $this->model->getVacDetailRowCount($limit,$start,$_POST);
			$data = $this->model->getVacDataDetailLimit($limit,$start,$_POST)->result_array();
			$this->langConv1($data);
			$ret['data'] = $data; 
			$ret['success'] = true;
			$ret['message'] = "Loaded data";
			
		}
		
		echo json_encode($ret);				
	}

	function getCutDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "หาข้อมูลไม่เจอ";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = 0;
			$limit = 100;	
			$ret['total'] = $this->model->getCutDetailRowCount($limit,$start,$_POST);
			$data = $this->model->getCutDataDetailLimit($limit,$start,$_POST)->result_array();
			$this->langConv1($data);
			$ret['data'] = $data; 
			$ret['success'] = true;
			$ret['message'] = "Loaded data";
			
		}
		
		echo json_encode($ret);				
	}

	function getKaeDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "หาข้อมูลไม่เจอ";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = 0;
			$limit = 100;	
			$ret['total'] = $this->model->getKaeDetailRowCount($limit,$start,$_POST);
			$data = $this->model->getKaeDataDetailLimit($limit,$start,$_POST)->result_array();
			$this->langConv1($data);
			$ret['data'] = $data; 
			$ret['success'] = true;
			$ret['message'] = "Loaded data";
			
		}
		
		echo json_encode($ret);				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */