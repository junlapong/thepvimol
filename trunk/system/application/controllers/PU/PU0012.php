<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PU0012 extends MY_Controller {

		
	function PU0012()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PU";
		$this->scrId = "PU0012";
		$this->scrFull = "PU/PU0012";
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

	function viewPRItem()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
			
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			
			$ret['success'] = true;
			$ret['total'] = $this->model->viewPRItemCount();
			$ret['message'] = "Loaded data";
			$data = $this->model->viewPRItem($limit,$start)->result_array();
			$ret['data'] = $data; 			
		}
		echo json_encode($ret);	
		
	}
	
	function viewVendor()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
			
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$item = $this->input->post('item_code');
			
			$ret['success'] = true;
			$ret['total'] = $this->model->viewVendorCount($item);
			$ret['message'] = "Loaded data";
			$data = $this->model->viewVendor($limit,$start,$item)->result_array();
			$ret['data'] = $data; 			
		}
		echo json_encode($ret);	
		
	}

	function customerCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getCustomerList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function insertLedger()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {

			$refDoc	   = $this->input->post('ref_doc');
			$vendorCode = $this->input->post('vendor_code');
			$notes = $this->input->post('notes');
			$poDate = $this->input->post('po_date');
			
			// Generate Order No vvv
			//$orderNO   = "PR" . str_replace("-", "", $orderDate);
			$raw 	   = $this->model->getMaxSeqOrderNo()->result_array();
			$seq 	   = ($raw == null)? 0 : $raw[0]['seq'];
			$seq	   = $seq + 1;
			$orderNO 	= "PO" . str_pad((int) $seq,8,"0",STR_PAD_LEFT);
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

				$this->model->updatePrByPo($orderNO,date("Y-m-d"),$row->{'item_code'});
				$row->{'po_no'} = $orderNO;
				
				$row->{'po_date'} = $poDate;
				$row->{'ref_doc'} = $refDoc;
				$row->{'customer_code'} = $vendorCode;
				
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = $notes;
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				
				unset($row->{'request_qty'});
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