<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0060 extends MY_Controller {

		
	function IV0060()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0060";
		$this->scrFull = "IV/IV0060";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function viewDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$item_code = $this->input->post('item_code');
			$loca_code = $this->input->post('location_code');
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCount();
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($item_code,$loca_code)->result_array();
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
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */