<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0072 extends MY_Controller {

		
	function PP0072()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0072";
		$this->scrFull = "PP/PP0072";
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
	
	function getJobNoList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา job no ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Job No";
			$data = $this->model->getJobNoList($query)->result_array();
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
	
	function getMachineList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getMachineList($query)->result_array();
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

	
	function updateJob()
	{	
		
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ เพิ่มข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกที";
		
		if($_POST != NULL) {
			// FORM DATA
			$jobNo   	= strtoupper($this->input->post('job_no'));
			$itemCode 	 = $this->input->post('item_code');
			$notes	   	= $this->input->post('notes');
			$packingQty = $this->input->post('packing_qty');
			$ppDate		= $this->input->post('production_date');
			$st			= $this->input->post('starttime');
			$ft			= $this->input->post('finishTime');
			$finished	= 0;
			if( $this->input->post('finished_flag') == "on" )
			{
				$finished = 1;		
			}
			
			
			// ARRAY DATA
			$rdata = json_decode($this->input->post('data'));

			foreach($rdata as $row)
			{
				$row->{'item_code'} = $itemCode;
				$row->{'job_no'} = $jobNo;
				$row->{'notes'} = $notes;
				$row->{'finished_flag'} = $finished;
				$row->{'production_date'} = $ppDate;
				$row->{'packing_qty'} = $packingQty;
				
				$row->{'start_time'} = $ppDate." ".$st;
				if($ft < $st)
				{
					$row->{'finish_time'} = date("Y-m-d",strtotime("+1 day",strtotime($ppDate)))." ".$ft;
				}else{
					$row->{'finish_time'} = $ppDate." ".$ft;
				}
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