<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MT0131 extends MY_Controller {

		
	function MT0131()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MT";
		$this->scrId = "MT0131";
		$this->scrFull = "MT/MT0131";
		$this->pkId = "item_code";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function viewDetail()
	{
 		$ret = array();
		$ret['success'] = false;
		$ret['total'] = 0;
		$ret['message'] = "Cannot Search Data";
		$ret['data'] = "";
		
		if($_POST != NULL) {
			$ven = $this->input->post('vendor_code');
			$deli = $this->input->post('delivery_code');
			$ret['success'] = true;
			$ret['total'] = $this->model->getRowCountD($ven,$deli);
			$ret['message'] = "Loaded data";
			$data = $this->model->getDataDetail($ven,$deli)->result_array();
			$ret['data'] = $data; 
			
		}
		
		echo json_encode($ret);	
	}
	
	function createD()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot insert Data";
		$ret['data'] = json_decode($this->input->post('data'));
		if($_POST != NULL) {
			$data = json_decode($this->input->post('data'));
			foreach($data as $key1 => $value1)
			{
				if($data->{$key1} == "")
				$data->{$key1} = null;
			}
			unset($data->{'location_name'});
			$data->{'created_user'} = $this->session->userdata('username');
			$data->{'updated_user'} = $this->session->userdata('username');
			$this->model->insertDRow($data);
			$ret['success'] = true;
			$ret['message'] = "Inserted Data";
			$maxId = $this->model->getMAXIdD()->row_array();
			$data = $this->model->getDataDAt($maxId['id'])->result_array();
			
			$this->langConv1($data);
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	function updateD()
	{
		
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Update Data";
		if($_POST != NULL) {
			$data = json_decode($this->input->post('data'));
			$this->model->updateDAt($data->{'id'},$data);
			$ret['success'] = true;
			$ret['message'] = "Updated Data";
			$data = $this->model->getDataDAt($data->{'id'})->result_array();
			$this->langConv1($data);
			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	// Default destroy function
	function destroyD()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot delete Data";
		//$ret['data'] = json_decode($this->input->post('data'));
		if($_POST != NULL) {
			// Delete data at reference key
			$this->model->deleteDAt(json_decode($this->input->post('data')));
			$ret['success'] = true;
			$ret['message'] = "deleted Data";
		}
		echo json_encode($ret);		
	}
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */