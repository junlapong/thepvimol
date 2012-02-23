<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0051 extends MY_Controller {

		
	function PP0051()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0051";
		$this->scrFull = "PP/PP0051";
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

		echo json_encode($ret);		
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
			$notlike = $this->input->post('notlike');
			
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->itemCodeList($query,$notlike)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function refDocList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$notlike = $this->input->post('notlike');
			
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->refDocList($query,$notlike)->result_array();			
			$data[] = array('ref_doc' => 'STOCK');
			
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getOrderQty()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$orderNo = $this->input->post('order');
			$itemCode = $this->input->post('item');
			
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getOrderQty($orderNo,$itemCode)->result_array();			
			$data[] = array('ref_doc' => 'STOCK');
			
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
		
	function updateJob()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			$month	=  date("m");
			$year	=  date("Y") + 543;
			
			$searchkey = $month . substr($year,2,2);
			
			$raw = $this->model->getMaxSeqJobNo($searchkey)->result_array();
			$seq 	   = ($raw == null)? 0 : $raw[0]['seq'];
			$seq	   = $seq + 1;
			$jobNo 	= "S" . str_pad((int) $seq,3,"0",STR_PAD_LEFT);
			
			$jobNo = $jobNo . "/" .$searchkey;
				
			$itemCode  = $this->input->post('item_code');
			$jobQty    =  $this->input->post('job_qty');
			$refDoc    =  strtoupper($this->input->post('ref_doc'));
			if($refDoc == null) $refDoc = "00000000";
			$jobDate = $this->input->post('job_date');
			$notes	   = $this->input->post('notes');

			$row = array();
			$row['screen_no'] = $jobNo;
			$row['item_code'] = $itemCode;
			$row['screen_date'] = $jobDate;
			$row['order_no'] = $refDoc;
			$row['order_qty'] = $jobQty;
			$row['finish_order_qty'] = 0;
			$row['finish_flag'] = '0';
			$row['cancel_flag'] = '0';
			$row['cancel_date'] = '0000-00-00 00:00:00';
			
			$row['delete_flag'] = '0';
			$row['notes'] = $notes;
			$row['created_date'] = null;
			$row['updated_date'] = null;
			$row['created_user'] = $this->session->userdata('username');
			$row['updated_user'] = $this->session->userdata('username');

			$this->model->insertRow($row);
			
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['job_no'] = $jobNo; 			
		}
	
		echo json_encode($ret);	
				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */