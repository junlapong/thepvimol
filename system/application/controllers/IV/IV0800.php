<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0800 extends MY_Controller {

		
	function IV0800()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0800";
		$this->scrFull = "IV/IV0800";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function viewBalance()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = "5000";//$this->input->post('limit');
			$ret['success'] = true;
			$ret['total'] = $this->model->getDataDetailCount($limit,$start,$_POST);
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($limit,$start,$_POST)->result_array();
			$r = 0;	$trec = 0; $tiss = 0; $prev = 0;
			foreach($data as $row)
			{
				$trec = $data[$r]['received_qty'];
				$tiss = $data[$r]['issue_qty'];
				$data[$r]['balance_qty'] = $prev + $trec - $tiss;
				
				$prev = $data[$r]['balance_qty'];
				$r++;
			}			
			
			
			
			$ret['data'] = $data; 
			
		}
		
		echo json_encode($ret);	
	}
	
	function viewLot()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$ret['success'] = true;
			$ret['total'] = $this->model->getLotCount($limit,$start,$_POST);
			$ret['message'] = "Loaded data";
			$data = $this->model->getLot($limit,$start,$_POST)->result_array();
			$ret['data'] = $data; 
			
		}
		
		echo json_encode($ret);	
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */