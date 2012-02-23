<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0010 extends MY_Controller {

		
	function PP0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0010";
		$this->scrFull = "PP/PP0010";
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
	
	function billView()
	{
		$node = $this->input->post('node');
		$nodes = array();
			// Get Child list ( Item_list )
			$tmp = $this->model->subNodeList($node)->result_array();
			$i = 0;
			//print_r($tmp);
			foreach($tmp as $aa){
				//print_r($aa);
				$nodes[$i++] = array(
				                'text' => $aa['child_item_code'],
				                'id'   => $aa['child_item_code'],
				                //'leaf' => true,
				                //'qtip' => $qtip,
				                //'qtipTitle' => $f,
				                'cls'  => 'file'
				            );
			}
 
		
		echo json_encode($nodes);	
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
			$recvDate = $this->input->post('received_date');
			$recvType = $this->input->post('recv_type_v');

			// Generate Received_no vvv
			if($recvType == "U")
			{
					$row->{'recv_type'} = $recvType;
					$raw = $this->model->getMAXUR()->result_array();
					$maxUR = ($raw == null)? 0 : $raw[0]['received_no'];
					$maxUR = substr($maxUR,-8);
					$imaxUR = (int)$maxUR + 1;
					$maxUR = "UR" . str_pad((int) $imaxUR,8,"0",STR_PAD_LEFT);
					//echo $maxUR;
			}
			
			$refDoc   = $this->input->post('ref_doc_no');
			if($refDoc == "" || $refDoc == null)
			{
				$refDoc = "P" . str_replace("-", "", $recvDate);
			}

			$rdata = json_decode($this->input->post('data'));

			// Convert 1 Row data to array (if there are only 1 ROW)
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
				$row->{'received_no'} = $maxUR;
				$row->{'received_date'} = $recvDate;
				$row->{'ref_doc_no'} = $refDoc;
				$row->{'received_staff'} = $this->session->userdata('username');
				$row->{'delete_flag'} = '0';
				$row->{'notes'} = 'notes';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertRow($row);


			// Update Inventory vvv
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
	               		'last_received_date' => $recvDate,
						'updated_date' => null,
						'updated_user' => $this->session->userdata('username')
				); 
				$this->model->updateInventory($item,$loca,$arr);
				
			// Update Inventory ^^^	
				
			// Update INV_LOT_MASTER
			// Check find record in INV_LOT_MASTER ? if yes then update else create
				$lot = $row->{'lot_no'};
				$seq = $row->{'seq_no'};
				
				$count = $this->model->getRecordCount($item,$loca,$lot,$seq);
				
				if ($count > 0)
				{	   // Update
					$raw = $this->model->getLotQty($item,$loca,$lot,$seq)->result_array();
					$lQty = ($raw == null)? 0 : $raw[0]['current_stock_qty'];
					$newQty = $lQty + $row->{'received_qty'};
					$arr = array(
	            	   		'current_stock_qty' => $newQty,
	               			'last_received_date' => $recvDate,
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
							'start_stock_qty' => $row->{'received_qty'},
							'current_stock_qty' => $row->{'received_qty'},
	               			'last_received_date' => $recvDate,
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