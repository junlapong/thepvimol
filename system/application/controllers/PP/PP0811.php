<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0811 extends MY_Controller {

		
	function PP0811()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0811";
		$this->scrFull = "PP/PP0811";
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
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->itemCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	
	
	function updateJob()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			//$this->model->getJobNo($query)->result_array();
			//$jobNo   = strtoupper($this->input->post('job_no'));
			$itemCode  = $this->input->post('item_code');
			$TjobNo	   = $this->model->getJobNo($itemCode);
			$a = "00"; $b = "00";
			if($TjobNo[0]["seq1"] == null)
			{
				$a	   = "0001";
				//$b	   = date("Y") + 543;
				//$b	   = substr($b,-2);
			}else{
				$a 	   = $TjobNo[0]["seq1"] + 1;
				$a	   = str_pad((int) $a,4,"0",STR_PAD_LEFT);
				//$b	   = $TjobNo[0]["seq2"];
			}
			$jobNo     =  "J". $a;
			$jobQty    =  $this->input->post('job_qty');
			$refDoc    =  strtoupper($this->input->post('ref_doc'));
			if($refDoc == null) $refDoc = "00000000";
			$jobDate = $this->input->post('job_date');
			$notes	   = $this->input->post('notes');
			
			$vCount = $this->model->searchDuplicate($itemCode,$jobDate);
			if($vCount > 0)
			{
				$ret['success'] = false;
				$ret['message'] = "ข้อมูลซ้ำ ให้ลองทำใหม่";
				echo json_encode($ret);
				return;
			}
			
			
			$row = array();
			$row['job_no'] = $jobNo;
			$row['item_code'] = $itemCode;
			$row['job_date'] = $jobDate;
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