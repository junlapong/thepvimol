<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class SL0041 extends MY_Controller {

		
	function SL0041()
	{
		parent::MY_Controller();
		
		$this->scrPath = "SL";
		$this->scrId = "SL0041";
		$this->scrFull = "SL/SL0041";
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
	
	
	function updateJob()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			//$jobNo  	= strtoupper($this->input->post('job_no'));
			$orderNo 		= $this->input->post('order_no');
			$invNo 			= $this->input->post('inv_no');		
			
			$vCount = $this->model->getRecordCount($orderNo,$invNo);
			if($vCount > 0)
			{
				$ret['success'] = false;
				$ret['message'] = "ข้อมูลซ้ำ ให้ลองทำใหม่";
				echo json_encode($ret);
				return;
			}
			
			$row = array();
			$row['order_no'] 		= $orderNo;
			$row['inv_no'] 			= $invNo;
			$row['payment_no'] 		= $this->input->post('payment_no');
			$row['payment_type'] 	= $this->input->post('pay_con_v');
			$row['payment'] 	 	= $this->input->post('payment');

			$row['transfer_to'] 	 = $this->input->post('transfer_to');
			$row['trans_ref_code'] 	 = $this->input->post('trans_ref_code');
			$row['transfer_date'] 	 = $this->input->post('transfer_date');
			
			$row['CHQ_NO'] 	 = $this->input->post('CHQ_NO');
			$row['CHQ_bank_name'] 	 = $this->input->post('CHQ_bank_name');
			$row['CHQ_date'] 	 = $this->input->post('CHQ_date');
			
			$row['received_date'] 	 = $this->input->post('received_date');
			
			$row['delete_flag'] = '0';
			$row['notes'] = $this->input->post('notes');
			$row['created_date'] = null;
			$row['updated_date'] = null;
			$row['created_user'] = $this->session->userdata('username');
			$row['updated_user'] = $this->session->userdata('username');

			$this->model->insertRow($row);
			
			// Update Issue_flag in DELIVERY_LEDGER
			$arr = array(
               		'payment_flag' => '1',
               		'payment_date' => $this->input->post('received_date')
			); 
			$this->model->updatePaymentFlag($invNo,$arr);				
				
			
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['job_no'] = $this->input->post('inv_no'); 			
		}
	
		echo json_encode($ret);	
				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */