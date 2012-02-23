<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PU0010 extends MY_Controller {

		
	function PU0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PU";
		$this->scrId = "PU0010";
		$this->scrFull = "PU/PU0010";
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
	
	function insertLedger()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			//$venCode   = $this->input->post('vendor_code');
			//$deliCode  = $this->input->post('delivery_code');
			//$orderDate = $this->input->post('order_date');
			//$deliDate  = $this->input->post('delivery_date');
			//$poNo	   = "NO PO";
			//$notes	   = $this->input->post('notes');
			$refDoc	   = strtoupper($this->input->post('ref_doc'));
			$reqStaffCode	   = strtoupper($this->input->post('staff1_code'));
			
			// Generate Order No vvv
			//$orderNO   = "PR" . str_replace("-", "", $orderDate);
			$raw 	   = $this->model->getMaxSeqOrderNo()->result_array();
			$seq 	   = ($raw == null)? 0 : $raw[0]['seq'];
			$seq	   = $seq + 1;
			$orderNO 	= "PR" . str_pad((int) $seq,8,"0",STR_PAD_LEFT);
			// Generate Order No ^^^
			
			$rdata = json_decode($this->input->post('data'));
			
			// Convert 1 Row data to array (1 Row Object to array)
			if( is_object($rdata) )
			{ 
				$temp = $rdata;
				$rdata = array();
				$rdata[0] = $temp;
			}

			foreach($rdata as $row)
			{

				$row->{'pr_no'} = $orderNO;
				//$row->{'item_code'} = $venCode;
				//$row->{'order_qty'} = $venCode;
				
				$row->{'ref_doc'} = $refDoc;
				$row->{'request_date'} = date("Y-m-d");
				$row->{'request_staff'} = $reqStaffCode;
				
				//$row->{'delivery_code'} = $deliCode;
				//$row->{'order_date'} = $orderDate;
				//$row->{'delivery_date'} = $deliDate;
				//$row->{'po_no'} = $poNo;
				//$row->{'finished_flag'} = '0';
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = $row->{'purpose'};
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				
				unset($row->{'purpose'});
				$this->model->insertRow($row);
	
			}
			
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['data'] = $rdata; 			
		}
	
		echo json_encode($ret);	
				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */