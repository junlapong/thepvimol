<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0090 extends MY_Controller {

		
	function IV0090()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0090";
		$this->scrFull = "IV/IV0090";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
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
	
	// Function for do stock taking (Adjust Stock)
	function updateLotQty()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Update Data";
		if($_POST != NULL) {
			// Get data that contain "id and new_qty" for that rows
			$data = json_decode($this->input->post('data'));
			$newQty = $data->{'new_qty'};
			
			// 1. First get OLD QTY from inventory_lot_master USING "id"
			$rawOld = $this->model->getOldDataAt($data->{'id'})->result_array();
			$oldQty = ($rawOld == null)? 0 : $rawOld[0]['qty'];
			
			// 2. if New == Old  -> No Change do nothing
			$diff = $newQty - $oldQty;
			$tranDate =  date("Y-m-d");
			if( $diff == 0 ) //Nothing change
			{
				$ret['success'] = true;
				$ret['message'] = "Updated Data";
				$ret['data'] = $rawOld;
				echo json_encode($ret);
				return;
			}
			
			/* 3. Have diff Do Following
			 *    - Create Transaction in RECEIVE_LEDGER
			 *	  - update INVENTORY_MASTER
			 *	  - update INVENTORY_LOT_MASTER
			 */
				// Create Transaction
				
				// Generate Received_no vvv
				$raw = $this->model->getMAXAR()->result_array();
				$maxAR = ($raw == null)? 0 : $raw[0]['received_no'];
				$maxAR = substr($maxAR,-8);
				$imaxAR = (int)$maxAR + 1;
				$maxAR = "AR" . str_pad((int) $imaxAR,8,"0",STR_PAD_LEFT);
								
				$row = false;
				$row->{'received_no'} = $maxAR;
				$row->{'ref_doc_no'} = "*";
				$row->{'item_code'} = $rawOld[0]['item_code'];
				$row->{'location_code'} = $rawOld[0]['location_code'];
				$row->{'lot_no'} = $rawOld[0]['lot_no'];
				$row->{'seq_no'} = $rawOld[0]['seq_no'];
				$row->{'received_qty'} = $diff;
				
				
				$row->{'received_date'} = $tranDate;
				$row->{'received_staff'} = $this->session->userdata('username');
				$row->{'received_reason'} = "*";
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertReceived($row);
			
			
				// UPDATE INVENTORY_MASTER (FIND ID)
				$rawInv = $this->model->getInvAt($rawOld[0]['item_code'],$rawOld[0]['location_code'])->result_array();
				$invQty = $rawInv[0]['current_stock_qty'];
				$invId  = $rawInv[0]['id'];
				$inv = false;
				$inv->{'current_stock_qty'} = $invQty + $diff;
				$inv->{'last_stock_taking_date'} = $tranDate;
				$this->model->updateInvAt($invId,$inv);
				
				// UPDATE INVENTORY_LOT_MASTER (ID)
				$data->{'current_stock_qty'} = $data->{'new_qty'};
				$data->{'last_stock_taking_date'} = $tranDate;
				unset($data->{'new_qty'});
				$this->model->updateInvLotAt($data->{'id'},$data);
				
				// Finish
				$ret['success'] = true;
				$ret['message'] = "Updated Data";
				$ret['data'] = $rawOld;
		}
		echo json_encode($ret);				
	}
	
	function createInitialLot()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Create Data";
		if($_POST != NULL) {
			// Get data that contain "id and new_qty" for that rows
			$data = json_decode($this->input->post('data'));
			
			/* 1. Do Following
			 *    - Create Transaction in RECEIVE_LEDGER
			 *	  - Create INVENTORY_LOT_MASTER
			 *	  - update INVENTORY_MASTER
			 */
				// Create Transaction
				
				$tranDate =  date("Y-m-d");
				
				// Generate Received_no vvv
				$raw = $this->model->getMAXAR()->result_array();
				$maxAR = ($raw == null)? 0 : $raw[0]['received_no'];
				$maxAR = substr($maxAR,-8);
				$imaxAR = (int)$maxAR + 1;
				$maxAR = "AR" . str_pad((int) $imaxAR,8,"0",STR_PAD_LEFT);
								
				$row = false;
				$row->{'received_no'} = $maxAR;
				$row->{'ref_doc_no'} = "*";
				$row->{'item_code'} = $data->{'item_code'};
				$row->{'location_code'} = $data->{'location_code'};
				$row->{'lot_no'} = $data->{'lot_no'};
				$row->{'seq_no'} = $data->{'seq_no'};
				$row->{'received_qty'} = $data->{'qty'};
				
				
				$row->{'received_date'} = $tranDate;
				$row->{'received_staff'} = $this->session->userdata('username');
				$row->{'received_reason'} = "*";
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertReceived($row);
			

				
				// INSERT INVENTORY_LOT_MASTER (ID)
				$row = false;
				$row->{'item_code'} = $data->{'item_code'};
				$row->{'location_code'} = $data->{'location_code'};
				$row->{'lot_no'} = $data->{'lot_no'};
				$row->{'seq_no'} = $data->{'seq_no'};
				$row->{'start_stock_qty'} = $data->{'qty'};
				$row->{'current_stock_qty'} = $data->{'qty'};
				
				$row->{'last_received_date'} = "0000-00-00 00:00:00";
				$row->{'last_issue_date'} = "0000-00-00 00:00:00";
				$row->{'last_stock_taking_date'} = "0000-00-00 00:00:00";
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertInvLot($row);

							
				// UPDATE INVENTORY_MASTER (FIND ID)
				$rawInv = $this->model->getInvAt($data->{'item_code'},$data->{'location_code'})->result_array();
				$invQty = $rawInv[0]['current_stock_qty'];
				$invId  = $rawInv[0]['id'];
				$inv = false;
				$inv->{'current_stock_qty'} = $invQty + $data->{'qty'};
				$inv->{'last_stock_taking_date'} = $tranDate;
				$this->model->updateInvAt($invId,$inv);
				
				// Finish
				$maxId = $this->model->getMAXInvLotId()->row_array();
				$data->{'id'} = $maxId['id'];
				$ret['success'] = true;
				$ret['message'] = "Updated Data";
				$ret['data'] = $data;
		}
		echo json_encode($ret);				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */