<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class PP0062 extends MY_Controller {

		
	function PP0062()
	{
		parent::MY_Controller();
		
		$this->scrPath = "PP";
		$this->scrId = "PP0062";
		$this->scrFull = "PP/PP0062";
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
		//parent::update();
		
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Update Data";
		
		if($_POST != NULL) {
			$finDate = $this->input->post('finished_date');
			$rdata = json_decode($this->input->post('data'));
			
			if( is_object($rdata) )
			{ 
				$temp = $rdata;
				$rdata = array();
				$rdata[0] = $temp;
			}

			foreach($rdata as $row)
			{	
				if( $row->{'finish_flag'} == false )
				{
					continue;
				}
				
				$data->{"finished_date"} = $finDate;
				$data->{"finished_approver"} = $this->session->userdata('username');
				$data->{"finish_flag"} = '1';
				$this->model->updateAt($row->{'id'},$data);
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