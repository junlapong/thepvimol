<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class SL0011 extends MY_Controller {

		
	function SL0011()
	{
		parent::MY_Controller();
		
		$this->scrPath = "SL";
		$this->scrId = "SL0011";
		$this->scrFull = "SL/SL0011";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function getOrderDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "หาข้อมูลไม่เจอ";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');	
			$ret['total'] = $this->model->getDetailRowCount($limit,$start,$_POST);
			$data = $this->model->getDataDetailLimit($limit,$start,$_POST)->result_array();
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