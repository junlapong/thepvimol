<?php
/*
 *------------------------------------------------------------------------------
 * Description  : Mol Master
 *------------------------------------------------------------------------------
 */
class MA0020 extends MY_Controller {

		
	function MA0020()
	{
		parent::MY_Controller();
		
		$this->scrPath = "MA";
		$this->scrId = "MA0020";
		$this->scrFull = "MA/MA0020";
		$this->pkId = "username";
		$this->load->model($this->scrFull . '_model','model',TRUE);
	}
	
	function index()
	{
		$data = array();
		$this->load->view($this->scrFull . '_view', $data);
	}
	
	function view()
	{
 		$this->colArray = null;
		parent::view();
	}
	
	// @Override Create
	function create()
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
			
			$data->{'password'} = sha1($data->{'password'});
			$data->{'created_user'} = $this->session->userdata('username');
			$data->{'updated_user'} = $this->session->userdata('username');
			$this->model->insertRow($data);
			$ret['success'] = true;
			$ret['message'] = "Inserted Data";
			if($this->pkId == "id")
			{
				$maxId = $this->model->getMAXId()->row_array();
				$data = $this->model->getDataAt($maxId['id'])->result_array();
			}else
			{
				$data = $this->model->getDataAt($data->{$this->pkId})->result_array();
			}

			$ret['data'] = $data;
		}
		echo json_encode($ret);		
	}
	
	// @Override update	
	function update()
	{
		$ret = array();
		$ret['success'] = false;
		$ret['message'] = "Cannot Update Data";
		if($_POST != NULL) {
			$data = json_decode($this->input->post('data'));
			if( array_key_exists('password',$data) ) $data->{'password'} = sha1($data->{'password'});
			$this->model->updateAt($data->{$this->pkId},$data);
			$ret['success'] = true;
			$ret['message'] = "Updated Data";
			$data = $this->model->getDataAt($data->{$this->pkId})->result_array();
			$ret['data'] = $data;
		}
		echo json_encode($ret);	
	}
	
	
}
// END Header class

/* End of file MT0050 */
/* Location: ./system/application/controllers/MT/MT0050.php */