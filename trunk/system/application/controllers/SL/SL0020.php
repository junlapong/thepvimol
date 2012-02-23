<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class SL0020 extends MY_Controller {

		
	function SL0020()
	{
		parent::MY_Controller();
		
		$this->scrPath = "SL";
		$this->scrId = "SL0020";
		$this->scrFull = "SL/SL0020";
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

	function getPaymentType()
	{
		$item 		= $this->input->post('item');
		$venCode  	= $this->input->post('vendorCode');
		$deliCode 	= $this->input->post('deliCom');
		
		$raw = $this->model->getPaymentType($venCode,$deliCode,$item)->result_array();
		
		$ret['success'] = true;
		$ret['message'] = "Loaded data";
		$ret['payType'] = ($raw == null)? -1 : $raw[0]['payment_type'];
		
		echo json_encode($ret);
	}
	
	function getPacking()
	{
		$item 		= $this->input->post('item');
		
		$raw = $this->model->getPacking($item)->result_array();
		
		$ret['success'] = true;
		$ret['message'] = "Loaded data";
		$ret['packing'] = ($raw == null)? -1 : $raw[0]['packing_qty'];
		
		echo json_encode($ret);
	}
	
	function insertLedger()
	{
		$ret['success'] = false;
		$ret['data'] = $this->input->post('data');
		$ret['message'] = "Cannot update Data";
		
		if($_POST != NULL) {
			$venCode   = $this->input->post('vendor_code');
			$deliCode  = $this->input->post('delivery_code');
			$orderDate = $this->input->post('order_date');
			$deliDate  = $this->input->post('delivery_date');
			$poNo	   = strtoupper($this->input->post('po_no'));
			$notes	   = $this->input->post('notes');
			$refDoc	   = strtoupper($this->input->post('ref_doc'));
			
			if( $this->model->isSamePo($poNo) ){
				$ret['success'] = false;
				$ret['message'] = "หมายเลข PO ซ้ำ";
				$ret['data'] = $this->input->post('data');
				echo json_encode($ret);		
				return;
			}
			// Generate Order No vvv
			$orderNO   = "PR" . str_replace("-", "", $orderDate);
			$raw 	   = $this->model->getMaxSeqOrderNo($orderNO)->result_array();
			$seq 	   = ($raw == null)? 0 : $raw[0]['seq'];
			$seq	   = $seq + 1;
			$orderNO 	= $orderNO . str_pad((int) $seq,2,"0",STR_PAD_LEFT);
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

				$row->{'order_no'} = $orderNO;
				$row->{'customer_code'} = $venCode;
				$row->{'ref_doc'} = $refDoc;
				$row->{'delivery_code'} = $deliCode;
				$row->{'order_date'} = $orderDate;
				$row->{'delivery_date'} = $deliDate;
				$row->{'po_no'} = $poNo;
				$row->{'finished_flag'} = '0';
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
			$ret['data'] = $rdata;
		}
	
		echo json_encode($ret);	
				
	}
	
	function getPriceCondition()
	{
		$item = $this->input->post('item');
		$con = $this->input->post('con');
		$qty = $this->input->post('qty');
		$vendorCode = $this->input->post('vendorCode');
		$raw = $this->model->getPriceList($vendorCode,$item)->result_array();
		$price = 0;
		$discount = 0;
		
		if($raw[0]['step1_discount'] != null 
		|| $raw[0]['step2_discount'] != null
		|| $raw[0]['step3_discount'] != null
		|| $raw[0]['step1_discount'] != -1 
		|| $raw[0]['step2_discount'] != -1
		|| $raw[0]['step3_discount'] != -1
		){
			
		}
		

		
		if($raw[0]['discount_rate_type'] == "0" )	// Percent Rate
		{
				if( $con == 0 ) // Cash
				{
					$price = $raw[0]['price_csh'];
				}else{ // Credit
					$price = $raw[0]['price_crd'];
				}	
				if($raw[0]['step1_discount_rate'] != 0 && $raw[0]['step1_discount_rate'] != null)
					$discount = $raw[0]['step1_discount_rate'];
				else
					$discount = 0;
		}else{ // fix Rate
				if( $con == 0 ) // Cash
				{
					$price = $raw[0]['price_csh'];
				}else{ // Credit
					$price = $raw[0]['price_crd'];
				}

				for($i = 1; $i <= 3; $i++){
					if($raw[0]['step'.$i.'_discount'] <= $qty && $raw[0]['step'.$i.'_discount'] != -1 && $raw[0]['step'.$i.'_discount'] != null)
						$price = $raw[0]['step'.$i.'_discount_rate'];
				}
				

		}
		
		if($con == -1)
		{
			$price = 0;
		}
		
		
		$ret['success'] = true;
		$ret['message'] = "Loaded data";
		$ret['price'] = $price;//($raw == null)? 0 : $raw[0]['current_stock_qty'];
		$ret['discount'] = $discount;//($raw == null)? 0 : $raw[0]['current_stock_qty'];
		
		echo json_encode($ret);
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */