<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class SL0061 extends MY_Controller {

		
	function SL0061()
	{
		parent::MY_Controller();
		
		$this->scrPath = "SL";
		$this->scrId = "SL0061";
		$this->scrFull = "SL/SL0061";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
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

	function getDlReasonCombo()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		

		if($_POST != NULL) {
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['data'] = $this->common->getDlComboList()->result_array();
			
		}
	
		echo json_encode($ret);	
		
	}
	
	function view()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$query = $this->input->post('query');
			//$item = $this->input->post('item');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getOrderDetailList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);
	}
	
	function orderNoList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$query = $this->input->post('query');
			//$item = $this->input->post('item');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getOrderNoList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);
	}
			
	function updateDelivery()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";

		if($_POST != NULL) {

			$orderNo  = $this->input->post('order_no');
			$ref_doc  = $this->input->post('ref_doc');
			$deliDate  = $this->input->post('delivery_date');
			$notes	   = $this->input->post('notes');
			
			// Generate Order No vvv
			$deliNo   = "DK" . str_replace("-", "", $deliDate);
			$raw 	   = $this->model->getMaxSeqDeliNo($deliNo)->result_array();
			$seq 	   = ($raw == null)? 0 : $raw[0]['seq'];
			$seq	   = $seq + 1;
			$deliNo 	= $deliNo . str_pad((int) $seq,2,"0",STR_PAD_LEFT);
			// Generate Order No ^^^
			
			$rdata = json_decode($this->input->post('data'));
			
			foreach($rdata as $row)
			{
				// got item_code and order_qty
				$row->{'delivery_no'} = $deliNo;
				$row->{'order_no'} = $orderNo;
				$row->{'ref_doc'} = $ref_doc;
				$row->{'delivery_date'} = $deliDate;
				$row->{'delivery_staff'} = $this->session->userdata('username');
				$row->{'cancel_flag'} = '0';
				$row->{'cancel_date'} = '0000-00-00 00:00:00';
				
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = $notes;
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertRow($row);
	
			}
			
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['deliNo'] = $deliNo; 			
		}
	
		echo json_encode($ret);	
				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */