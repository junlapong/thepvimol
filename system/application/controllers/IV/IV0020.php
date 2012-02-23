<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0020 extends MY_Controller {

		
	function IV0020()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0020";
		$this->scrFull = "IV/IV0020";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function getItemList()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getItemList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);			
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function getLotNo()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$item = $this->input->post('item');
			$loca = $this->input->post('loca');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getLotNo($item,$loca)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}

	function getSeqNo()
	{
		$ret = array();
		$ret['success'] = true;
		$ret['message'] = "...";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$item = $this->input->post('item');
			$loca = $this->input->post('loca');
			$lot = $this->input->post('lot');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getSeqNo($item,$loca,$lot)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getInvQty()
	{
		$item = $this->input->post('item');
		$loca = $this->input->post('loca');
		$lot = $this->input->post('lot');
		$seq = $this->input->post('seq');
		$raw = $this->model->getCurrentInvQty($item,$loca,$lot,$seq)->result_array();
		
		$ret['success'] = true;
		$ret['message'] = "Loaded data";
		$ret['qty'] = ($raw == null)? 0 : $raw[0]['current_stock_qty'];
		
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
	
	function getUIReasonCombo()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		

		if($_POST != NULL) {
			$ret['success'] = true;
			$ret['message'] = "Update Data Complete";
			$ret['data'] = $this->common->getUiComboList()->result_array();
			
		}
	
		echo json_encode($ret);	
		
	}
	
	function insertLedger()
	{
		$ret['success'] = false;
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			$issuDate = $this->input->post('issue_date');
			$issuType = $this->input->post('issu_type_v');
			$issuReason = $this->input->post('ui_reason_val');
			
			// Generate Received_no vvv
			if($issuType == "U")
			{
					$row->{'issu_type'} = $issuType;
					$raw = $this->model->getMAXUR()->result_array();
					$maxUI = ($raw == null)? 0 : $raw[0]['issue_no'];
					$maxUI = substr($maxUI,-8);
					$imaxUI = (int)$maxUI + 1;
					$maxUI = "UI" . str_pad((int) $imaxUI,8,"0",STR_PAD_LEFT);
					//echo $maxUR;
			}
			
			$refDoc   = $this->input->post('ref_doc_no');
			if($refDoc == "" || $refDoc == null)
			{
				$refDoc = "P" . str_replace("-", "", $issuDate);
			}
			
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
				$item = $row->{'item_code'};
				$loca = $row->{'location_code'};
							
			// Insert to Received ledger
				unset($row->{'inv_qty'});
				$row->{'issue_no'} = $maxUI;
				$row->{'issue_date'} = $issuDate;
				$row->{'ref_doc_no'} = $refDoc;
				$row->{'issue_staff'} = $this->session->userdata('username');
				$row->{'issue_reason'} = $issuReason;
				$row->{'cancel_flag'} = '0';
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertRow($row);

			//	print_r($row);
				
				
				
			// Update Inventory
			// get QTY from ISSUE_LEDGER where Item_code and location_code
			// get QTY from RECEIVE_LEDGER where Item_code and location_code
			// get Start Store from INVENTORY_MASTER where item_code and location_code
				$raw = $this->model->getIssueQty($item,$loca)->result_array();
				$iQty = ($raw == null)? 0 : $raw[0]['issue_qty'];
				$raw = $this->model->getReceiveQty($item,$loca)->result_array();
				$rQty = ($raw == null)? 0 : $raw[0]['received_qty'];
				$raw = $this->model->getStartQty($item,$loca)->result_array();
				$sQty = ($raw == null)? 0 : $raw[0]['start_stock_qty'];
			// new inv = start + receive - issue
			// echo $sQty + $rQty - $iQty . "  ";
				$arr = array(
	               		'current_stock_qty' => $sQty + $rQty - $iQty,
	               		'last_issue_date' => $issuDate,
						'updated_date' => null,
						'updated_user' => $this->session->userdata('username')
				); 
				$this->model->updateInventory($item,$loca,$arr);


			// Update INV_LOT_MASTER
			// Check find record in INV_LOT_MASTER ? if yes then update else create
				$lot = $row->{'lot_no'};
				$seq = $row->{'seq_no'};
				
				$count = $this->model->getRecordCount($item,$loca,$lot,$seq);
				
				if ($count > 0)
				{	   // Update
					$raw = $this->model->getLotQty($item,$loca,$lot,$seq)->result_array();
					$lQty = ($raw == null)? 0 : $raw[0]['current_stock_qty'];
					$newQty = $lQty - $row->{'issue_qty'};
					$arr = array(
	            	   		'current_stock_qty' => $newQty,
	               			'last_issue_date' => $issuDate,
							'updated_date' => null,
							'updated_user' => $this->session->userdata('username')
						); 
						$this->model->updateLotInv($item,$loca,$lot,$seq,$arr);
				}else{ // Create
						$arr = array(
	            	   		'item_code' => $item,
							'location_code' => $loca,
	            	   		'lot_no' => $lot,
							'seq_no' => $seq,
							'start_stock_qty' => -$row->{'issue_qty'},
							'current_stock_qty' => -$row->{'issue_qty'},
	               			'last_received_date' => '0000-00-00 00:00:00',
	               			'last_issue_date' => $issuDate,
							'delete_flag' => 0,
							'notes' => 'none',
							'created_date' => null,
							'created_user' => $this->session->userdata('username'),
							'updated_date' => null,
							'updated_user' => $this->session->userdata('username')
						); 
						$this->model->insertLotInv($arr);					
				}
				
				
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