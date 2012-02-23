<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0101 extends MY_Controller {

		
	function IV0101()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0101";
		$this->scrFull = "IV/IV0101";
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
	function viewLocation()
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
			$ret['total'] = $this->model->getDataDetailCount($limit,$start,$_POST);
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($limit,$start,$_POST)->result_array();
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
		
	
	function updateData()
	{
	 	$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$desLoca = $this->input->post('des_location_code');
			$desItem = $this->input->post('des_item_code');
			$item = $this->input->post('item_code');
			$loca = $this->input->post('location_code');
			$lot = $this->input->post('lot_no');
			$seq = $this->input->post('seq_no');
			$transDate = $this->input->post('trans_date');
			$transNo = $this->input->post('trans_no');
			$transQty = $this->input->post('trans_qty');
			
			
			$raw = $this->model->getMAXTR()->result_array();
			$maxTR = ($raw == null)? 0 : $raw[0]['received_no'];
			$maxTR = substr($maxTR,-8);
			$imaxTR = (int)$maxTR + 1;
			$maxTR = str_pad((int) $imaxTR,8,"0",STR_PAD_LEFT);			
			// For Issue use TI For Receive Use TR but both use same Prefix
			
			// Issue from select location
				$row = false;
				$row->{'issue_no'} = "TI".$maxTR;
				$row->{'ref_doc_no'} = "TR".$maxTR;
				
				$row->{'item_code'} = $item;
				$row->{'location_code'} = $loca;
				$row->{'lot_no'} = $lot;
				$row->{'seq_no'} = $seq;
				$row->{'issue_qty'} = $transQty;
				
				$row->{'issue_date'} = $transDate;
				$row->{'issue_staff'} = $this->session->userdata('username');
				$row->{'issue_reason'} = "D*";
				$row->{'cancel_flag'} = '0';
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertIssue($row);
			// Receive to Dest Location
				$row = false;
				$row->{'received_no'} = "TR".$maxTR;;
				$row->{'ref_doc_no'} = "TI".$maxTR;
				
				$row->{'item_code'} = $desItem;
				$row->{'location_code'} = $desLoca;
				$row->{'lot_no'} = $lot;
				$row->{'seq_no'} = $seq;
				$row->{'received_qty'} = $transQty;
				
				$row->{'received_date'} = $transDate;
				$row->{'received_staff'} = $this->session->userdata('username');
				$row->{'received_reason'} = "D*";
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertReceived($row);
							
			// UPDATE INVENTORY_MASTER (FIND ID)
				// Issue out
				$rawInv = $this->model->getInvAt($item,$loca)->result_array();
				$invQty = $rawInv[0]['current_stock_qty'];
				$invId  = $rawInv[0]['id'];
				
				$inv = false;
				$inv->{'current_stock_qty'} = $invQty - $transQty;
				$inv->{'last_issue_date'} = $transDate;
				$this->model->updateInvAt($invId,$inv);
				
				// Receive in
				$rawInv = $this->model->getInvAt($desItem,$desLoca)->result_array();
				$invQty = $rawInv[0]['current_stock_qty'];
				$invId  = $rawInv[0]['id'];
				
				$inv = false;
				$inv->{'current_stock_qty'} = $invQty + $transQty;
				$inv->{'last_received_date'} = $transDate;
				$this->model->updateInvAt($invId,$inv);
				
			// UPDATE INVENTORY_LOT_MASTER (ID)
				// ISSUE OUT
				$rawInv = $this->model->getInvLotAt($item,$loca,$lot,$seq)->result_array();
				$invQty = $rawInv[0]['current_stock_qty'];
				$invId  = $rawInv[0]['id'];
				$inv = false;
				$inv->{'current_stock_qty'} = $invQty - $transQty;
				$inv->{'last_issue_date'} = $transDate;				
				$this->model->updateInvLotAt($invId,$inv);
							
				// Receive IN
				$count = $this->model->getRecordCount($desItem,$desLoca,$lot,$seq);
				
				if ($count > 0)
				{	   // Update
					$rawInv = $this->model->getInvLotAt($desItem,$desLoca,$lot,$seq)->result_array();
					$invQty = $rawInv[0]['current_stock_qty'];
					$invId  = $rawInv[0]['id'];
					$inv = false;
					$inv->{'current_stock_qty'} = $invQty + $transQty;
					$inv->{'last_received_date'} = $transDate;				
					$this->model->updateInvLotAt($invId,$inv);
				}else{ // Create
						$arr = array(
	            	   		'item_code' => $desItem,
							'location_code' => $desLoca,
	            	   		'lot_no' => $lot,
							'seq_no' => $seq,
							'start_stock_qty' => $transQty,
							'current_stock_qty' => $transQty,
	               			'last_received_date' => $transDate,
	               			'last_issue_date' => '0000-00-00 00:00:00',
							'delete_flag' => 0,
							'notes' => 'none',
							'created_date' => null,
							'created_user' => $this->session->userdata('username'),
							'updated_date' => null,
							'updated_user' => $this->session->userdata('username')
						); 
						$this->model->insertLotInv($arr);					
				}


				
			$ret['success'] = true;
			$ret['message'] = "Update Finish ";
			
		}
		echo json_encode($ret);		
	}
	
}
// END Header class

/* End of file MT0050 */
	/* Location: ./system/application/controllers/MT/MT0050.php */