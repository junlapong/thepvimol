<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0081 extends MY_Controller {

		
	function PP0081()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0081";
		$this->scrFull = "PP/PP0081";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function getProductionDateCombo()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		

		if($_POST != NULL) {
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['data'] = $this->model->getProductionDateCombo()->result_array();		
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