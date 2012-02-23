<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0020 extends MY_Controller {

		
	function PP0020()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0020";
		$this->scrFull = "PP/PP0020";
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
		//if($_POST != NULL) {
			//$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getJobOrderList()->result_array();
			$ret['data'] = $data;
		//}
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
		$ret['message'] = "Cannot get item Code by vendor_code and delivery_code";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getItemCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	

	function orderList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item Code by vendor_code and delivery_code";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$order = $this->input->post('order_no');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getOrderList($query,$order)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	
	
	function getOrderData()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item Code by vendor_code and delivery_code";

		if($_POST != NULL) {
			$query = $this->input->post('query'); 		// ItemCode
			$order = $this->input->post('order_no'); 	// order_no
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
		
			// Planning Production QTY ( alreadt have jobOrder and not finish )
			// Calculate from JOB_LEDGET Order_qty - finish_order_qty
			// require parameter ( item_code )
			// Database JOB_LEDGER
			$raw = $this->model->getPlanProducQty($query)->result_array();
			$jobOrderQty = ($raw[0]["order_qty"] == null)? 0 : $raw[0]["order_qty"];
			$finishQty = ($raw[0]["finish_qty"] == null)? 0 : $raw[0]["finish_qty"];
			$remainPlanQty = ($raw[0]["plan_qty"] == null)? 0 : $raw[0]["plan_qty"];
			
			// Stock INV
			// Safty_stock
			$raw = $this->model->getInventoryQty($query)->result_array();
			$currQty = ($raw[0]["current_qty"] == null)? 0 : $raw[0]["current_qty"];
			$saftyQty = ($raw[0]["safty_stock"] == null)? 0 : $raw[0]["safty_stock"];		
			
			// Total Planning Order QTY (no jobOrder yet and not cancel)
			$raw = $this->model->getOrderQty($query)->result_array();
			$totalOrderQty = ($raw[0]["total_qty"] == null)? 0 : $raw[0]["total_qty"];
			$waitingOrderQty = $totalOrderQty - $jobOrderQty;
			
			$ret['data']['jobOrderQty'] 	=  $jobOrderQty;
			$ret['data']['finishQty'] 		=  $finishQty;
			$ret['data']['remainPlanQty'] 	=  $remainPlanQty;
	
			$ret['data']['currQty'] 		=  $currQty;
			$ret['data']['saftyQty'] 		=  $saftyQty;
	
			$ret['data']['totalQty'] 		=  $totalOrderQty;
			$ret['data']['waitQty'] 		=  $waitingOrderQty;
			
			$ret['data']['reqQty']			= abs(($currQty + $remainPlanQty) - ($waitingOrderQty + $saftyQty));
		}
		
		echo json_encode($ret);		
	}
	
	
	function updateJob()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			$jobNo   = strtoupper($this->input->post('job_no'));
			$itemCode  = $this->input->post('item_code');
			$jobQty    =  $this->input->post('job_qty');
			$jobDate = $this->input->post('job_date');
			$notes	   = $this->input->post('notes');

			$row = array();
			$row['job_no'] = $jobNo;
			$row['item_code'] = $itemCode;
			$row['job_date'] = $jobDate;
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
			
			$vCount = $this->model->searchDuplicate($jobNo);
			if($vCount > 0)
			{
				$ret['success'] = false;
				$ret['message'] = "ข้อมูลซ้ำ ให้ลองทำใหม่";
				echo json_encode($ret);
				return;
			}
			
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