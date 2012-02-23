<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0070 extends MY_Controller {

		
	function PP0070()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0070";
		$this->scrFull = "PP/PP0070";
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

	function getMaterialList()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "ไม่สามารถ หา Material ได้";
		if($_POST != NULL) {
			//$query = $this->input->post('query');
			$query = "";
			$ret['success'] = true;
			$ret['message'] = "ค้นหา Material No";
			$data = $this->model->getMaterialList($query)->result_array();
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
			$jobNo   	= strtoupper($this->input->post('job_no'));
			$itemCode 	 = $this->input->post('item_code');
			$mcCode    	=  $this->input->post('machine_code');
			$matCode 	= $this->input->post('mat_code');
			$notes	   	= $this->input->post('notes');
			$lead		= $this->input->post('lead_code');
			$m1			= $this->input->post('staff1_code');
			$m2			= $this->input->post('staff2_code');
			$m3			= $this->input->post('staff3_code');
			$FAVG		= $this->input->post('frame_avg_height');
			$FL			= $this->input->post('frame_l_height');
			$FH			= $this->input->post('frame_h_height');
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
				$row->{'machine_code'} = $mcCode;
				$row->{'mat_code'} = $matCode;
				$row->{'notes'} = $notes;
				$row->{'finished_flag'} = $finished;
				$row->{'lead_staff'} = $lead;
				$row->{'m1_staff'} = $m1;
				$row->{'m2_staff'} = $m2;
				$row->{'m3_staff'} = $m3;
				$row->{'frame_avg_height'} = $FAVG;
				$row->{'frame_l_height'} = $FL;
				$row->{'frame_h_height'} = $FH;
				$row->{'production_date'} = $ppDate;
				
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

				$QC = Array();
				$QC["production_date"] = $row->{'production_date'};
				$QC["item_code"] = $row->{'item_code'};
				$QC["job_no"] = $row->{'job_no'};
				$QC["machine_code"] = $row->{'machine_code'};
				$QC["mat_code"] = $row->{'mat_code'};
				$QC["input_lot"] = $row->{'input_lot'};
				$QC["input_pp_date"] = $row->{'input_pp_date'};
				
				$QC['delete_flag'] = '0';
				$QC['created_date'] = null;
				$QC['updated_date'] = null;
				$QC['created_user'] = $this->session->userdata('username');
				$QC['updated_user'] = $this->session->userdata('username');
				$this->model->insertQCData($QC);
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