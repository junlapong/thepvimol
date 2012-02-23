<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class IV0000 extends MY_Controller {

		
	function IV0000()
	{
		parent::MY_Controller();
		
		$this->scrPath = "IV";
		$this->scrId = "IV0000";
		$this->scrFull = "IV/IV0000";
		$this->pkId = "id";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function updateCurrentQty()
	{
		$rdata = $this->model->getInvItemList()->result_array();
		
		//print_r($rdata);
		foreach($rdata as $row)
		{
			$item = $row["item_code"];
			$loca = $row["location_code"];
			
		
			// Insert to Received ledger
			
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
			//print_r($rdata);
			//echo $item . " " . $loca . " " . strval($sQty) . " " . strval($rQty) . " " . strval($iQty) . " </br> ";
			$arr = array(
	               	'current_stock_qty' => $sQty + $rQty - $iQty
	            ); 
			$this->model->updateInventory($item,$loca,$arr);
		}
		
		
		$ret['success'] = true;
		//$ret['total'] = $this->model->getRowCount();
		$ret['message'] = "Loaded data";
		//$data = $this->model->getDataLimit($limit,$start,$_POST)->result_array();
		//$this->langConv1($data);
		//$ret['data'] = $data; 

		echo json_encode($ret);	
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */