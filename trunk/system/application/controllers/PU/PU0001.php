<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PU0001 extends MY_Controller {

		
	function PU0001()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PU";
		$this->scrId = "PU0001";
		$this->scrFull = "PU/PU0001";
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

	function viewPOItem()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
			
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$poNo = $this->input->post('po_no');
			
			$ret['success'] = true;
			$ret['total'] = $this->model->viewPOItemCount($poNo);
			$ret['message'] = "Loaded data";
			$data = $this->model->viewPOItem($limit,$start,$poNo)->result_array();
			$ret['data'] = $data; 			
		}
		echo json_encode($ret);	
		
	}
	
	function viewReceive()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot get item list";
			
		if($_POST != NULL) {
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$item = $this->input->post('item_code');
			$poNo = $this->input->post('po_no');
			
			$ret['success'] = true;
			$ret['total'] = $this->model->viewItemCount($item,$poNo);
			$ret['message'] = "Loaded data";
			$data = $this->model->viewItem($limit,$start,$item,$poNo)->result_array();
			$ret['data'] = $data; 			
		}
		echo json_encode($ret);	
		
	}	
	
	function update()
	{
 		$this->colArray = null;
		//parent::update();
		
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Update Data";
		
		if($_POST != NULL) {
			$finDate = $this->input->post('finished_date');
			$notes = $this->input->post('notes');
			$rdata = json_decode($this->input->post('data'));
			
			if( is_object($rdata) )
			{ 
				$temp = $rdata;
				$rdata = array();
				$rdata[0] = $temp;
			}

			foreach($rdata as $row)
			{	
				unset($data);
				if(!isset($row->{'approved_flag'}))
				{
					$row->{'approved_flag'} = false;
				}
				if(!isset($row->{'cancel_flag'}))
				{
					$row->{'cancel_flag'} = false;
				}
				
				if( $row->{'approved_flag'} == false && $row->{'cancel_flag'} == false )
				{
					continue;
				}
				
				if( $row->{'approved_flag'} == true)
				{
					$data->{"approved_date"} = $finDate;
					$data->{"approved_staff"} = $this->session->userdata('username');
					$data->{"approved_flag"} = '1';
					$this->model->updateAt($row->{'id'},$data);
				}else{
					$data->{"cancel_date"} = $finDate;
					$data->{"cancel_staff"} = $this->session->userdata('username');
					$data->{"cancel_flag"} = '1';
					$data->{"cancel_reason"} = $notes;
					$this->model->updateAt($row->{'id'},$data);					
				}
					//$this->model->updateRequestAt($row->{'po_no'},$data);
			}		
			$ret['success'] = true;
			$ret['message'] = "Updated Data";
			$ret['data'] = "";
		}
		
		echo json_encode($ret);	
			
	}
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */