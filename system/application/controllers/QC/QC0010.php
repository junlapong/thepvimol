<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class QC0010 extends MY_Controller {

		
	function QC0010()
	{
		parent::MY_Controller();
		
		$this->scrPath = "QC";
		$this->scrId = "QC0010";
		$this->scrFull = "QC/QC0010";
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
		//if($_POST != NULL) {
			//$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "Get Item List";
			$data = $this->model->getJobOrderList()->result_array();
			$ret['data'] = $data;
		//}
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
	
	function getReceivedDate()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา job no ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Job No";
			$data = $this->model->getReceivedDate($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}	

	function getItemCode()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา รหัสสินค้า ได้";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "ค้นหา รหัสสินค้า";
			$data = $this->model->getItemCode($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}

	function getItemCodeList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getItemCodeList($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getLotNoList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			$itemCode = $this->input->post('itemCode');
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getLotNoList($query,$itemCode)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getLeadName()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getLeadName($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function getStaffName()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getStaffName($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}

	function getLotNo()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			$query = $this->input->post('query');
			//$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getLotNo($query)->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	function updateJob()
	{	
		
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ เพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกที";
		
		if($_POST != NULL) {

			// FORM DATA
			$recvDate   	= strtoupper($this->input->post('received_date'));
			$itemCode 	 = $this->input->post('item_code');
			$lotNo    	=  $this->input->post('lot_no');
			$notes	   	= $this->input->post('notes');
			
			// ARRAY DATA
			$rdata = json_decode($this->input->post('data'));

			foreach($rdata as $row)
			{
				$row->{'item_code'} = $itemCode;
				$row->{'lot_no'} = $lotNo;
				$row->{'received_date'} = $recvDate;

				$row->{'notes'} = $notes;
				$row->{'delete_flag'} = '0';
				$row->{'created_date'} = null;
				$row->{'updated_date'} = null;
				$row->{'created_user'} = $this->session->userdata('username');
				$row->{'updated_user'} = $this->session->userdata('username');
				$this->model->insertRow($row);
			}
						
			$ret['success'] = true;
			$ret['message'] = "เพิ่มข้อมูลเสร็จสิ้น";			
		}
	
		echo json_encode($ret);	
				
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */